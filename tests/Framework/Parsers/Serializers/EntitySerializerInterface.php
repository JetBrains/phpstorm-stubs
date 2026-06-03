<?php

namespace StubTests\Framework\Parsers\Serializers;

/**
 * Interface for entity serialization strategies.
 *
 * Different data sources (stubs vs reflection) have different metadata available,
 * so they need different serialization strategies:
 * - StubsEntitySerializer: Serializes PhpDoc, version info, LanguageLevelTypeAware, etc.
 * - ReflectionEntitySerializer: Only serializes data available via PHP Reflection API
 */
interface EntitySerializerInterface
{
    /**
     * Serialize an entity to array format suitable for JSON encoding.
     *
     * @param mixed $entity The entity to serialize (PHPClass, PHPFunction, etc.)
     * @return array The serialized entity data
     */
    public function serialize($entity): array;

    /**
     * Deserialize an entity from array format.
     *
     * @param array $data The serialized entity data
     * @return mixed The reconstructed entity object
     */
    public function deserialize(array $data);
}
