<?php

namespace StubTests\Framework\Parsers\Storage;

use StubTests\Framework\Parsers\Storage\ParsedDataStorageProvider;

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
