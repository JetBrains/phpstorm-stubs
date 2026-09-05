<?php

namespace StubTests\Framework\Storage;

use StubTests\Framework\Serialization\EntitySerializerInterface;

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

        // JSON_PARTIAL_OUTPUT_ON_ERROR must NOT be used here. It does not skip an unencodable
        // value, it substitutes one (`0` for a non-finite float, `null` for a malformed string) — so
        // INF, -INF and NAN landed in the committed caches as the integer 0, indistinguishable from
        // a genuine 0. It also takes precedence over JSON_THROW_ON_ERROR and suppresses the false
        // return, so the corrupt cache was written and the run stayed green. Non-finite floats are
        // now rendered as sentinels by SerializerUtilsTrait::toJsonSafe(); anything still
        // unencodable here is a bug in a serializer and must stop the pipeline. JSON_THROW_ON_ERROR
        // is the only mechanism needed for that — it throws rather than returning false, so no
        // return-value guard follows.
        $json = json_encode(
            $serializedData,
            JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_THROW_ON_ERROR
        );

        $bytes = file_put_contents($this->pathToJsonFile, $json);

        if ($bytes === false) {
            throw new \RuntimeException('Failed to write to file: ' . $this->pathToJsonFile);
        }

        // Save PhpDocStorage if present and this storage owns it
        if ($this->phpDocStorage !== null && $this->ownsPhpDocStorage) {
            $this->phpDocStorage->save();
        }
    }

    /**
     * Load entities from the cache file.
     *
     * A missing file yields no entities and is not an error: callers decide whether to
     * regenerate (see `Runner::isStubsCacheComplete()`), and `MultiFileJsonStorage` constructs a
     * storage per entity type whether or not every file has been written yet.
     *
     * A file that *exists* but cannot be read as JSON is a different matter and throws. Returning
     * no entities there is indistinguishable from a legitimately empty cache, and the
     * consequences are silent: a truncated `StubsClasses.json` yielded zero classes while the
     * other four type files loaded normally, so every class-level check iterated an empty list
     * and reported success. The suite stayed green while validating nothing. This happened —
     * commit 51b2a776 carried a 2.3 MB prefix of a 20.4 MB file.
     *
     * @throws \RuntimeException if the file exists but is empty, unreadable, or not valid JSON
     */
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
        if ($jsonContent === false) {
            throw new \RuntimeException($this->corruptCacheMessage('could not be read'));
        }

        if (trim($jsonContent) === '') {
            // An empty entity type serialises to "[]", never to an empty file.
            throw new \RuntimeException($this->corruptCacheMessage('is empty'));
        }

        $data = json_decode($jsonContent, true);
        if (!is_array($data)) {
            throw new \RuntimeException($this->corruptCacheMessage(sprintf('is not valid JSON (%s)', json_last_error_msg())));
        }

        foreach ($data as $entityData) {
            if (isset($entityData['_type'])) {
                $this->addEntity($this->serializer->deserialize($entityData));
            }
        }

        $this->loaded = true;
    }

    private function corruptCacheMessage(string $problem): string
    {
        $size = @filesize($this->pathToJsonFile);

        return sprintf(
            "Cache file %s %s (%s bytes).\n"
            . "It exists, so nothing will regenerate it automatically, and treating it as empty "
            . "would let checks pass while validating nothing.\n"
            . "Regenerate with: docker compose -f docker-compose.yml run --rm test_runner php "
            . "tests/run-stubs-parser.php\n"
            . "(for a Reflection*.json file, use tests/run-all-reflection-parsers.sh instead)",
            $this->pathToJsonFile,
            $problem,
            $size === false ? 'unknown' : $size
        );
    }
}
