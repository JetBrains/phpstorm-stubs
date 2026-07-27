<?php

namespace StubTests\Framework\Storage;

use StubTests\Framework\Pipeline\EntityProcessingPipeline;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Parsers\StubDataQueryInterface;

interface ParsedDataStorageManager extends StubDataQueryInterface
{
    public function getParsedDataStorageProvider(): ParsedDataStorageProvider;

    /** @return iterable<mixed> */
    public function getAllEntities(): iterable;

    // Write operations (processed immediately through pipeline)
    public function addClass(PHPClass $entity): void;

    public function addFunction(PHPFunction $entity): void;

    public function addInterface(PHPInterface $entity): void;

    public function addEnum(PHPEnum $entity): void;

    public function addConstant(PHPConstant $entity): void;

    // Generic add that auto-detects entity type
    public function addEntity(mixed $entity): void;

    // Write operations (deferred - raw, no processing)
    public function addEntityRaw(mixed $entity): void;

    // Processing
    public function process(): void;

    // Persistence
    public function save(): void;

    public function load(): void;

    // Pipeline access
    public function getPipeline(): EntityProcessingPipeline;
}
