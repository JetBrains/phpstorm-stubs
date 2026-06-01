<?php

namespace StubTests\Framework\Parsers\Storage;

use StubTests\Framework\Parsers\Serializers\EntitySerializerInterface;

/**
 * JSON storage for parsed entities.
 * Handles file I/O operations while delegating serialization to a pluggable serializer.
 * Optionally coordinates with PhpDocStorage for separated PhpDoc storage.
 */
class JsonParsedDataStorage implements ParsedDataPersistentStorageProvider
{
    private string $pathToJsonFile;
    private EntitySerializerInterface $serializer;
    private ?PhpDocStorage $phpDocStorage = null;
    private array $entities = [];
    private bool $loaded = false;
    private bool $ownsPhpDocStorage = true;

    /**
     * @param string $pathToJsonFile Path to JSON file
     * @param EntitySerializerInterface $serializer Serializer to use (StubsEntitySerializer or ReflectionEntitySerializer)
     * @param bool $loadExisting Whether to load existing file
     * @param PhpDocStorage|null $phpDocStorage Optional PhpDoc storage for separated PhpDoc
     * @param bool $ownsPhpDocStorage Whether this storage is responsible for saving PhpDocStorage
     */
    public function __construct(
        string $pathToJsonFile,
        EntitySerializerInterface $serializer,
        bool $loadExisting = true,
        ?PhpDocStorage $phpDocStorage = null,
        bool $ownsPhpDocStorage = true
    ) {
        $this->pathToJsonFile = $pathToJsonFile;
        $this->serializer = $serializer;
        $this->phpDocStorage = $phpDocStorage;
        $this->ownsPhpDocStorage = $ownsPhpDocStorage;
        if ($loadExisting) {
            $this->load();
        } else {
            $this->loaded = true;
        }
    }

    public function getEntities(): array
    {
        return $this->entities;
    }

    public function addEntity(mixed $entity): void
    {
        $this->entities[] = $entity;
    }

    public function clearEntities(): void
    {
        $this->entities = [];
    }

    public function save(): void
    {
        $serializedData = [];
        foreach ($this->entities as $entity) {
            try {
                $serializedData[] = $this->serializer->serialize($entity);
            } catch (\JsonException|\RuntimeException $e) {
                // Skip entities that can't be serialized
                error_log("Warning: Could not serialize entity: " . $e->getMessage());
                continue;
            }
        }

        $dir = dirname($this->pathToJsonFile);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        // Use JSON_PARTIAL_OUTPUT_ON_ERROR to handle encoding errors gracefully
        $json = json_encode(
            $serializedData,
            JSON_PRETTY_PRINT|JSON_PARTIAL_OUTPUT_ON_ERROR|JSON_UNESCAPED_SLASHES
        );

        if ($json === false || $json === 'null') {
            throw new \RuntimeException('JSON encoding failed: ' . json_last_error_msg());
        }

        $bytes = file_put_contents($this->pathToJsonFile, $json);

        if ($bytes === false) {
            throw new \RuntimeException('Failed to write to file: ' . $this->pathToJsonFile);
        }

        // Save PhpDocStorage if present and this storage owns it
        if ($this->phpDocStorage !== null && $this->ownsPhpDocStorage) {
            $this->phpDocStorage->save();
        }
    }

    public function load(): void
    {
        if ($this->loaded) {
            return;
        }

        if (!file_exists($this->pathToJsonFile)) {
            $this->entities = [];
            $this->loaded = true;
            return;
        }

        $jsonContent = file_get_contents($this->pathToJsonFile);
        if ($jsonContent === false || trim($jsonContent) === '') {
            $this->entities = [];
            $this->loaded = true;
            return;
        }

        $data = json_decode($jsonContent, true);
        if (!is_array($data)) {
            $this->entities = [];
            $this->loaded = true;
            return;
        }

        foreach ($data as $entityData) {
            if (isset($entityData['_type'])) {
                $this->addEntity($this->serializer->deserialize($entityData));
            }
        }

        $this->loaded = true;
    }
}
