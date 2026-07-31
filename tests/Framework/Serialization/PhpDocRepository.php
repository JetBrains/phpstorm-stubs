<?php

namespace StubTests\Framework\Serialization;

/**
 * The only PhpDoc capability the serializers need: read one doc by entity id, write one doc by
 * entity id.
 *
 * Fourteen files under Serialization/ used to name Storage\PhpDocStorage directly, while
 * Storage\JsonParsedDataStorage names Serialization\EntitySerializerInterface — a cycle between the
 * two namespaces. Only two of those fourteen ever *called* anything (getPhpDoc/setPhpDoc, both in
 * SerializerHelperTrait); the other twelve mentioned the class purely in type declarations. So the
 * cycle bought nothing and cost everything: a serializer unit test had to build a real
 * PhpDocStorage — with a file path, lazy loading and a save() it must never call — to exercise a
 * pure array transform.
 *
 * Declared here rather than in Storage/ on purpose. The consumer owns the contract; Storage/ owns
 * the implementation and keeps save()/load()/clear()/getAllPhpDocs() to itself, so no serializer can
 * reach them by accident. Anything that needs the full storage lifecycle should keep depending on
 * the concrete class.
 *
 * StorageInterfaceSegregationTest::testSerializationDoesNotDependOnStorage() fails if the direct
 * coupling comes back.
 */
interface PhpDocRepository
{
    /**
     * @return string|null The stored doc comment, or null when the id has none
     */
    public function getPhpDoc(string $entityId): ?string;

    /**
     * A null or blank doc removes the entry rather than storing an empty one.
     */
    public function setPhpDoc(string $entityId, ?string $phpDoc): void;
}
