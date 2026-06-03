<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Registries\SerializerRegistry;
use StubTests\Framework\Parsers\Serializers\EntitySerializerInterface;

/**
 * Serializer for stub entities that includes all stub-specific metadata:
 * - PhpDoc comments (raw text)
 * - Version information (sinceVersion, removedVersion)
 * - Type information from multiple sources (signature, PhpDoc, LanguageLevelTypeAware)
 * - LanguageLevelTypeAware attribute data (version-specific types)
 *
 * This class now acts as a facade/coordinator that delegates to entity-specific serializers
 * using the registry pattern.
 */
class StubsEntitySerializer implements EntitySerializerInterface
{
    private ?PhpDocStorage $phpDocStorage = null;
    private SerializerRegistry $registry;

    /** @var array<string, EntityTypeSerializerInterface> Explicit type name → serializer */
    private array $deserializerMap = [];

    public function __construct(?PhpDocStorage $phpDocStorage = null)
    {
        $this->phpDocStorage = $phpDocStorage;
        $this->registry = new SerializerRegistry();

        // Register all entity-specific serializers
        $classSerializer = new PHPClassSerializer();
        $functionSerializer = new PHPFunctionSerializer();
        $interfaceSerializer = new PHPInterfaceSerializer();
        $enumSerializer = new PHPEnumSerializer();
        $constantSerializer = new PHPConstantSerializer();

        $this->registry->register($classSerializer);
        $this->registry->register($functionSerializer);
        $this->registry->register($interfaceSerializer);
        $this->registry->register($enumSerializer);
        $this->registry->register($constantSerializer);

        // Explicit type → serializer map for deserialization (avoids fragile str_contains)
        $this->deserializerMap = [
            'PHPClass' => $classSerializer,
            'PHPFunction' => $functionSerializer,
            'PHPInterface' => $interfaceSerializer,
            'PHPEnum' => $enumSerializer,
            'PHPConstant' => $constantSerializer,
        ];
    }

    public function serialize($entity): array
    {
        // Find appropriate serializer for this entity
        $serializer = $this->registry->findSerializer($entity);

        if ($serializer !== null) {
            return $serializer->serialize($entity, $this->phpDocStorage);
        }

        // Unknown entity type — fail explicitly instead of using unsafe serialize()
        throw new \RuntimeException('Cannot serialize unknown entity type: ' . get_class($entity));
    }

    public function deserialize(array $data)
    {
        $type = $data['_type'] ?? 'Unknown';

        if (isset($this->deserializerMap[$type])) {
            return $this->deserializerMap[$type]->deserialize($data, $this->phpDocStorage);
        }

        throw new \RuntimeException("Cannot deserialize unknown entity type: {$type}");
    }
}
