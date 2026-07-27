<?php

namespace StubTests\Framework\Storage;

interface ParsedDataStorageProvider
{
    public function getEntities(): array;

    public function addEntity(mixed $entity): void;
}
