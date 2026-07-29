<?php

namespace StubTests\Framework\Storage;

use StubTests\Framework\Pipeline\EntityProcessingPipeline;
use StubTests\Framework\Parsers\StubDataQueryInterface;

/**
 * The full parsed-data store: queryable, writable, persistable, plus access to its internals.
 *
 * This composes four concerns rather than declaring 22 methods itself, so that each consumer can
 * name the one it actually needs:
 *  - {@see StubDataQueryInterface} — reading entities (what validators get)
 *  - {@see ParsedDataWriter}       — adding entities and processing them (what the parsers get)
 *  - {@see ParsedDataPersistence}  — save()/load() (only the cache-generation paths)
 *  - the accessors below           — the backing provider and the pipeline, for wiring and tests
 *
 * The composite still exists because DefaultParsedDataStorageManager is all four things, and the
 * cache-generation scripts legitimately use all four in sequence: build, process, save. What changed
 * is that nothing *else* has to accept all four — `Runner::getStubs()` and `getReflection()` now
 * return the read interface, so a validator holding one cannot call save() or load() on the
 * committed cache.
 */
interface ParsedDataStorageManager extends StubDataQueryInterface, ParsedDataWriter, ParsedDataPersistence
{
    public function getParsedDataStorageProvider(): ParsedDataStorageProvider;

    /** @return iterable<mixed> */
    public function getAllEntities(): iterable;

    public function getPipeline(): EntityProcessingPipeline;
}
