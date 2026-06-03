<?php

namespace StubTests\Framework\Parsers\Serializers;

use StubTests\Framework\Parsers\Storage\PhpDocStorage;

/**
 * Interface for entity-specific serializers in the strategy pattern.
 * Each entity type (PHPClass, PHPFunction, etc.) has its own serializer implementation.
 */
interface EntityTypeSerializerInterface
{
    /**
     * Check if this serializer supports the given entity.
     *
     * @param mixed $entity The entity to check
     * @return bool True if this serializer can handle the entity
     */
    public function supports($entity): bool;

    /**
     * Serialize an entity to array format suitable for JSON encoding.
     *
     * @param mixed $entity The entity to serialize
     * @param PhpDocStorage|null $phpDocStorage Optional PhpDoc storage for external storage
     * @return array The serialized entity data
     */
    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array;

    /**
     * Deserialize an entity from array format.
     *
     * @param array $data The serialized entity data
     * @param PhpDocStorage|null $phpDocStorage Optional PhpDoc storage for external retrieval
     * @return mixed The reconstructed entity object
     */
    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null);
}
