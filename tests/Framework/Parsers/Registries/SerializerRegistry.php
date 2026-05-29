<?php

namespace StubTests\Framework\Parsers\Registries;

use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;

/**
 * Registry for managing entity-specific serializers.
 * Implements the strategy pattern to find the appropriate serializer for each entity type.
 */
class SerializerRegistry
{
    /** @var EntityTypeSerializerInterface[] */
    private array $serializers = [];

    /**
     * Register a new entity serializer.
     *
     * @param EntityTypeSerializerInterface $serializer
     */
    public function register(EntityTypeSerializerInterface $serializer): void
    {
        $this->serializers[] = $serializer;
    }

    /**
     * Find a serializer that supports the given entity.
     *
     * @param mixed $entity The entity to find a serializer for
     * @return EntityTypeSerializerInterface|null The matching serializer, or null if none found
     */
    public function findSerializer($entity): ?EntityTypeSerializerInterface
    {
        foreach ($this->serializers as $serializer) {
            if ($serializer->supports($entity)) {
                return $serializer;
            }
        }

        return null;
    }

    /**
     * Get all registered serializers.
     *
     * @return EntityTypeSerializerInterface[]
     */
    public function getAllSerializers(): array
    {
        return $this->serializers;
    }
}
