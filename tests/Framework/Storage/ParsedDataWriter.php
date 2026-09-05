<?php

namespace StubTests\Framework\Storage;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPInterface;

/**
 * The write side of a parsed-data store: adding entities and running them through the pipeline.
 *
 * Split out of ParsedDataStorageManager so a producer can declare only what it needs. The two
 * parsers do exactly that — AllStubsParser calls addEntityRaw() then process(), and
 * AllReflectionParser calls addEntity() — and both previously received a 22-method type that also
 * granted them save(), load() and the full read surface.
 *
 * Unlike the per-entity query interfaces removed in [W5], this one has real client types: see the
 * constructor signatures of AllStubsParser and AllReflectionParser.
 */
interface ParsedDataWriter
{
    // Write operations (processed immediately through the pipeline)
    public function addClass(PHPClass $entity): void;

    public function addFunction(PHPFunction $entity): void;

    public function addInterface(PHPInterface $entity): void;

    public function addEnum(PHPEnum $entity): void;

    public function addConstant(PHPConstant $entity): void;

    /** Generic add that auto-detects the entity type. */
    public function addEntity(mixed $entity): void;

    /** Deferred write — stored raw, processed later by process(). */
    public function addEntityRaw(mixed $entity): void;

    /** Run any deferred raw entities through the pipeline. */
    public function process(): void;
}
