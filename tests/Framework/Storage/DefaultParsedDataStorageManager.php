<?php

namespace StubTests\Framework\Storage;

use StubTests\Framework\Pipeline\EntityProcessingPipeline;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Model\PHPMethod;

class DefaultParsedDataStorageManager implements ParsedDataStorageManager
{
    private ParsedDataStorageProvider $parsedDataStorageProvider;
    private EntityProcessingPipeline $pipeline;
    private array $rawEntities = [];
    private ?array $cachedClasses = null;
    private ?array $cachedFunctions = null;
    private ?array $cachedInterfaces = null;
    private ?array $cachedEnums = null;
    private ?array $cachedConstants = null;

    /**
     * id => true per kind, for hasX(). Built from the already-filtered getter result, so it
     * costs one extra pass and turns each hasX() from an O(n) scan into a hash lookup.
     *
     * Measured before adding it: hasClass() over 15k classes cost ~4.5ms per call, which is
     * ~66s across one lookup per entity. Populated lazily and dropped by invalidateCache().
     *
     * @var array<string, array<string, true>>
     */
    private array $idIndexes = [];

    public function __construct(
        ParsedDataStorageProvider $parsedDataStorageProvider,
        ?EntityProcessingPipeline $pipeline = null
    ) {
        $this->parsedDataStorageProvider = $parsedDataStorageProvider;
        $this->pipeline = $pipeline ?? new EntityProcessingPipeline();
    }

    public function getParsedDataStorageProvider(): ParsedDataStorageProvider
    {
        return $this->parsedDataStorageProvider;
    }

    public function getPipeline(): EntityProcessingPipeline
    {
        return $this->pipeline;
    }

    private function invalidateCache(): void
    {
        $this->cachedClasses = null;
        $this->cachedFunctions = null;
        $this->cachedInterfaces = null;
        $this->cachedEnums = null;
        $this->cachedConstants = null;
        $this->idIndexes = [];
    }

    public function getAllEntities(): iterable
    {
        return $this->parsedDataStorageProvider->getEntities();
    }

    /**
     * Process a single entity through the pipeline and store it.
     */
    private function addProcessedEntity(mixed $entity): void
    {
        $processed = $this->pipeline->processSingle($entity);

        if ($processed !== null) {
            $this->parsedDataStorageProvider->addEntity($processed);
            $this->invalidateCache();
        }
    }

    public function addClass(PHPClass $entity): void
    {
        $this->addProcessedEntity($entity);
    }

    public function addFunction(PHPFunction $entity): void
    {
        $this->addProcessedEntity($entity);
    }

    public function addInterface(PHPInterface $entity): void
    {
        $this->addProcessedEntity($entity);
    }

    public function addEnum(PHPEnum $entity): void
    {
        $this->addProcessedEntity($entity);
    }

    public function addConstant(PHPConstant $entity): void
    {
        $this->addProcessedEntity($entity);
    }

    public function addEntity(mixed $entity): void
    {
        $this->addProcessedEntity($entity);
    }

    /**
     * Add entity without processing (deferred)
     */
    public function addEntityRaw($entity): void
    {
        $this->rawEntities[] = $entity;
    }

    /**
     * Process all raw entities through pipeline
     */
    public function process(): void
    {
        if (empty($this->rawEntities)) {
            return;
        }

        $processed = $this->pipeline->processBatch($this->rawEntities);

        foreach ($processed as $entity) {
            $this->parsedDataStorageProvider->addEntity($entity);
        }

        $this->rawEntities = [];
        $this->invalidateCache();
    }

    /**
     * Save entities to persistent storage
     */
    public function save(): void
    {
        // Process any remaining raw entities before saving
        $this->process();

        // Delegate to storage provider if it supports persistence
        if ($this->parsedDataStorageProvider instanceof ParsedDataPersistentStorageProvider) {
            $this->parsedDataStorageProvider->save();
        }
    }

    /**
     * Load entities from persistent storage
     */
    public function load(): void
    {
        // Delegate to storage provider if it supports persistence
        if ($this->parsedDataStorageProvider instanceof ParsedDataPersistentStorageProvider) {
            $this->parsedDataStorageProvider->load();
            $this->invalidateCache();
        }
    }

    /** @return PHPClass[] */
    public function getClasses(): array
    {
        if ($this->cachedClasses === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedClasses = array_values(array_filter($allEntities, fn ($e) => $e instanceof PHPClass));
        }
        return $this->cachedClasses;
    }

    public function hasClass(string $id): bool
    {
        $index = $this->idIndex('class', $this->getClasses(...));
        return isset($index[$id]);
    }

    /** @return PHPFunction[] */
    public function getFunctions(): array
    {
        if ($this->cachedFunctions === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedFunctions = array_values(array_filter($allEntities, fn ($e) => $e instanceof PHPFunction && !$e instanceof PHPMethod));
        }
        return $this->cachedFunctions;
    }

    /** @return PHPInterface[] */
    public function getInterfaces(): array
    {
        if ($this->cachedInterfaces === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedInterfaces = array_values(array_filter($allEntities, fn ($e) => $e instanceof PHPInterface));
        }
        return $this->cachedInterfaces;
    }

    public function hasInterface(string $id): bool
    {
        $index = $this->idIndex('interface', $this->getInterfaces(...));
        return isset($index[$id]);
    }

    /** @return PHPEnum[] */
    public function getEnums(): array
    {
        if ($this->cachedEnums === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedEnums = array_values(array_filter($allEntities, fn ($e) => $e instanceof PHPEnum));
        }
        return $this->cachedEnums;
    }

    public function hasEnum(string $id): bool
    {
        $index = $this->idIndex('enum', $this->getEnums(...));
        return isset($index[$id]);
    }

    /** @return PHPConstant[] */
    public function getConstants(): array
    {
        if ($this->cachedConstants === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedConstants = array_values(array_filter($allEntities, fn ($e) => $e instanceof PHPConstant));
        }
        return $this->cachedConstants;
    }

    /**
     * @param callable(): array $getter version-agnostic source of the entities for this kind
     * @return array<string, true>
     */
    private function idIndex(string $kind, callable $getter): array
    {
        if (!isset($this->idIndexes[$kind])) {
            $index = [];
            foreach ($getter() as $entity) {
                $id = $entity->getId();
                if ($id !== null) {
                    $index[$id] = true;
                }
            }
            $this->idIndexes[$kind] = $index;
        }

        return $this->idIndexes[$kind];
    }
}
