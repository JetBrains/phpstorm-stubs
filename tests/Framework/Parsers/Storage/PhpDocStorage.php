<?php

namespace StubTests\Framework\Parsers\Storage;

/**
 * Storage for raw PhpDoc comments, separated from main entity data.
 * Provides lazy loading and efficient access to PhpDoc by entity ID.
 */
class PhpDocStorage
{
    private string $pathToJsonFile;
    private array $phpDocs = [];
    private bool $loaded = false;
    private bool $modified = false;

    public function __construct(string $pathToJsonFile, bool $loadExisting = true)
    {
        $this->pathToJsonFile = $pathToJsonFile;
        if ($loadExisting) {
            $this->load();
        } else {
            $this->loaded = true;
        }
    }

    /**
     * Get PhpDoc by entity ID
     */
    public function getPhpDoc(string $entityId): ?string
    {
        if (!$this->loaded) {
            $this->load();
        }
        return $this->phpDocs[$entityId] ?? null;
    }

    /**
     * Set PhpDoc for entity ID
     */
    public function setPhpDoc(string $entityId, ?string $phpDoc): void
    {
        if ($phpDoc === null || trim($phpDoc) === '') {
            unset($this->phpDocs[$entityId]);
        } else {
            $this->phpDocs[$entityId] = $phpDoc;
        }
        $this->modified = true;
    }

    /**
     * Check if PhpDoc exists for entity ID
     */
    public function hasPhpDoc(string $entityId): bool
    {
        if (!$this->loaded) {
            $this->load();
        }
        return isset($this->phpDocs[$entityId]);
    }

    /**
     * Get all PhpDocs (for debugging/testing)
     */
    public function getAllPhpDocs(): array
    {
        if (!$this->loaded) {
            $this->load();
        }
        return $this->phpDocs;
    }

    /**
     * Save PhpDocs to JSON file
     */
    public function save(): void
    {
        if (!$this->modified && file_exists($this->pathToJsonFile)) {
            // No changes, skip write
            return;
        }

        $dir = dirname($this->pathToJsonFile);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $json = json_encode(
            $this->phpDocs,
            JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE
        );

        if ($json === false) {
            throw new \RuntimeException('JSON encoding failed: ' . json_last_error_msg());
        }

        $bytes = file_put_contents($this->pathToJsonFile, $json);

        if ($bytes === false) {
            throw new \RuntimeException('Failed to write to file: ' . $this->pathToJsonFile);
        }

        $this->modified = false;
    }

    /**
     * Load PhpDocs from JSON file
     */
    public function load(): void
    {
        if ($this->loaded) {
            return;
        }

        if (!file_exists($this->pathToJsonFile)) {
            $this->phpDocs = [];
            $this->loaded = true;
            return;
        }

        $jsonContent = file_get_contents($this->pathToJsonFile);
        if ($jsonContent === false || trim($jsonContent) === '') {
            $this->phpDocs = [];
            $this->loaded = true;
            return;
        }

        $data = json_decode($jsonContent, true);
        if (!is_array($data)) {
            $this->phpDocs = [];
            $this->loaded = true;
            return;
        }

        $this->phpDocs = $data;
        $this->loaded = true;
        $this->modified = false;
    }

    /**
     * Clear all PhpDocs (for testing)
     */
    public function clear(): void
    {
        $this->phpDocs = [];
        $this->modified = true;
    }
}
