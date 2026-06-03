<?php

namespace StubTests\Framework\Parsers\Storage;

interface ParsedDataStorageProvider
{
    public function getEntities(): array;

    public function addEntity(mixed $entity): void;
}
