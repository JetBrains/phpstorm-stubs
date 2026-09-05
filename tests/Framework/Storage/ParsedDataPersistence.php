<?php

namespace StubTests\Framework\Storage;

/**
 * Persisting a parsed-data store to, and restoring it from, its backing files.
 *
 * Separate from {@see ParsedDataWriter} because the two have different audiences: a parser fills a
 * store, while only the cache-generation paths decide when it is written to disk. Keeping save() and
 * load() out of the type handed to read-only consumers is the point of the split — a validator that
 * receives a store for querying should not be able to overwrite the committed cache.
 */
interface ParsedDataPersistence
{
    public function save(): void;

    public function load(): void;
}
