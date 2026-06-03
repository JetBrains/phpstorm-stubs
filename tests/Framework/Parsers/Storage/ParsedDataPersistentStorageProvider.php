<?php

namespace StubTests\Framework\Parsers\Storage;

interface ParsedDataPersistentStorageProvider extends ParsedDataStorageProvider
{
    /**
     * Load entities from persistent storage
     */
    public function load(): void;

    /**
     * Save entities to persistent storage
     */
    public function save(): void;
}
