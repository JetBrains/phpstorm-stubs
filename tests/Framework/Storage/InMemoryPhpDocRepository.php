<?php

namespace StubTests\Framework\Storage;

use StubTests\Framework\Serialization\PhpDocRepository;

/**
 * PhpDoc repository with no file behind it, for tests that exercise the serializers' array transform
 * rather than the cache file.
 *
 * Mirrors {@see PhpDocStorage::setPhpDoc()}'s blank-doc semantics exactly — a null or whitespace-only
 * doc removes the id instead of storing an empty string — because a serializer test that passed
 * against a fake with looser semantics than the real writer would be worse than no test at all.
 *
 * Kept alongside {@see InMemoryParsedDataStorage} rather than under tests/Unit/, so tests in any
 * namespace can reach it.
 */
class InMemoryPhpDocRepository implements PhpDocRepository
{
    private array $phpDocs = [];

    public function getPhpDoc(string $entityId): ?string
    {
        return $this->phpDocs[$entityId] ?? null;
    }

    public function setPhpDoc(string $entityId, ?string $phpDoc): void
    {
        if ($phpDoc === null || trim($phpDoc) === '') {
            unset($this->phpDocs[$entityId]);
        } else {
            $this->phpDocs[$entityId] = $phpDoc;
        }
    }
}
