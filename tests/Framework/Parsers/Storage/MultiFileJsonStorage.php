<?php

namespace StubTests\Framework\Parsers\Storage;

use StubTests\Framework\Parsers\Serializers\EntitySerializerInterface;
use StubTests\Framework\Parsers\Storage\EntityTypeFileRouter;
use StubTests\Framework\Parsers\Storage\JsonParsedDataStorage;
use StubTests\Framework\Parsers\Storage\ParsedDataPersistentStorageProvider;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;

/**
 * Multi-file JSON storage that splits entities by type into separate files.
 * Improves performance by allowing selective loading of entity types.
 */
class MultiFileJsonStorage implements ParsedDataPersistentStorageProvider
{
    private EntityTypeFileRouter $router;
    private array $entities = [];
    private bool $loaded = false;
    private array $fileStorages = [];
    private ?PhpDocStorage $phpDocStorage = null;

    /**
     * @param string $basePathToJsonFile Base path (e.g., "cache/Stubs.json")
     * @param EntitySerializerInterface $serializer Serializer to use
     * @param bool $loadExisting Whether to load existing files
     * @param PhpDocStorage|null $phpDocStorage Optional PhpDoc storage
     */
    public function __construct(
        string $basePathToJsonFile,
        EntitySerializerInterface $serializer,
        bool $loadExisting = true,
        ?PhpDocStorage $phpDocStorage = null
    ) {
        $this->router = new EntityTypeFileRouter();
        $this->phpDocStorage = $phpDocStorage;

        // Create individual JsonParsedDataStorage instances for each entity type.
        // Children do NOT own PhpDocStorage — this class saves it once in save().
        foreach ($this->router->getAllFiles() as $fileId) {
            $filePath = $this->router->buildFilePath($basePathToJsonFile, $fileId);
            $this->fileStorages[$fileId] = new JsonParsedDataStorage(
                $filePath,
                $serializer,
                $loadExisting,
                $phpDocStorage,
                ownsPhpDocStorage: false
            );
        }

        if ($loadExisting) {
            $this->load();
        } else {
            $this->loaded = true;
        }
    }

    public function getEntities(): array
    {
        if (!$this->loaded) {
            $this->load();
        }
        return $this->entities;
    }

    public function addEntity(mixed $entity): void
    {
        $this->entities[] = $entity;
    }

    public function save(): void
    {
        // Group entities by type
        $entitiesByType = [];
        foreach ($this->entities as $entity) {
            try {
                $fileId = $this->router->getFileForEntity($entity);
                if (!isset($entitiesByType[$fileId])) {
                    $entitiesByType[$fileId] = [];
                }
                $entitiesByType[$fileId][] = $entity;
            } catch (\InvalidArgumentException $e) {
                // Skip unknown entity types
                error_log("Warning: Unknown entity type, skipping: " . get_class($entity));
            }
        }

        // Clear existing entities in file storages and add new ones
        foreach ($this->fileStorages as $fileId => $fileStorage) {
            $fileStorage->clearEntities();

            // Add entities for this type
            if (isset($entitiesByType[$fileId])) {
                foreach ($entitiesByType[$fileId] as $entity) {
                    $fileStorage->addEntity($entity);
                }
            }
        }

        // Save all file storages
        foreach ($this->fileStorages as $fileStorage) {
            $fileStorage->save();
        }

        // Save PhpDocStorage once (children have ownsPhpDocStorage=false)
        $this->phpDocStorage?->save();
    }

    public function load(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->entities = [];

        // Load from all file storages
        foreach ($this->fileStorages as $fileStorage) {
            $fileStorage->load();
            $fileEntities = $fileStorage->getEntities();
            if (is_array($fileEntities)) {
                $this->entities = array_merge($this->entities, $fileEntities);
            }
        }

        $this->loaded = true;
    }

    /**
     * Get entities of a specific type without loading all files
     *
     * @param string $fileId One of EntityTypeFileRouter::FILE_* constants
     * @return array
     */
    public function getEntitiesByType(string $fileId): array
    {
        if (!isset($this->fileStorages[$fileId])) {
            return [];
        }

        $storage = $this->fileStorages[$fileId];
        $storage->load();
        return $storage->getEntities();
    }

    /**
     * Check if an entity type file has been loaded
     */
    public function isTypeLoaded(string $fileId): bool
    {
        if (!isset($this->fileStorages[$fileId])) {
            return false;
        }

        // We can't directly access the loaded property, so we check if entities exist
        // or try to load and check
        $storage = $this->fileStorages[$fileId];
        $entities = $storage->getEntities();
        return is_array($entities);
    }
}
