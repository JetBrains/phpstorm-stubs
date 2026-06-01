<?php

namespace StubTests\Framework\Parsers\Storage;

use StubTests\Framework\Parsers\Processors\EntityProcessingPipeline;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;

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
            $this->cachedClasses = is_array($allEntities)
                ? array_filter($allEntities, fn ($e) => $e instanceof PHPClass)
                : [];
        }
        return $this->cachedClasses;
    }

    public function hasClass(string $id): bool
    {
        foreach ($this->getClasses() as $class) {
            if ($class->getId() === $id) {
                return true;
            }
        }
        return false;
    }

    /** @return PHPFunction[] */
    public function getFunctions(): array
    {
        if ($this->cachedFunctions === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedFunctions = is_array($allEntities)
                ? array_filter($allEntities, fn ($e) => $e instanceof PHPFunction && !$e instanceof PHPMethod)
                : [];
        }
        return $this->cachedFunctions;
    }

    /** @return PHPInterface[] */
    public function getInterfaces(): array
    {
        if ($this->cachedInterfaces === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedInterfaces = is_array($allEntities)
                ? array_filter($allEntities, fn ($e) => $e instanceof PHPInterface)
                : [];
        }
        return $this->cachedInterfaces;
    }

    public function hasInterface(string $id): bool
    {
        foreach ($this->getInterfaces() as $interface) {
            if ($interface->getId() === $id) {
                return true;
            }
        }
        return false;
    }

    /** @return PHPEnum[] */
    public function getEnums(): array
    {
        if ($this->cachedEnums === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedEnums = is_array($allEntities)
                ? array_filter($allEntities, fn ($e) => $e instanceof PHPEnum)
                : [];
        }
        return $this->cachedEnums;
    }

    public function hasEnum(string $id): bool
    {
        foreach ($this->getEnums() as $enum) {
            if ($enum->getId() === $id) {
                return true;
            }
        }
        return false;
    }

    /** @return PHPConstant[] */
    public function getConstants(): array
    {
        if ($this->cachedConstants === null) {
            $allEntities = $this->parsedDataStorageProvider->getEntities();
            $this->cachedConstants = is_array($allEntities)
                ? array_filter($allEntities, fn ($e) => $e instanceof PHPConstant)
                : [];
        }
        return $this->cachedConstants;
    }
}
