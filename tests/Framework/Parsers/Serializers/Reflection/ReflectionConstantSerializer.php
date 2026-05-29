<?php

namespace StubTests\Framework\Parsers\Serializers\Reflection;

use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;
use StubTests\Framework\Parsers\Serializers\SubEntitySerializerTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;

use StubTests\Framework\Parsers\Model\PHPConstant;

/**
 * Reflection serializer for PHPConstant entities.
 * Only includes data available via PHP Reflection API.
 */
class ReflectionConstantSerializer implements EntityTypeSerializerInterface
{
    use SubEntitySerializerTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPConstant;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            '_type' => 'PHPConstant',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
            'value' => $this->toJsonSafe($entity->getValue()),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null): PHPConstant
    {
        $constant = new PHPConstant();
        $constant->setName($data['name'] ?? '');
        $constant->setNamespace($data['namespace'] ?? null);
        $constant->setId($data['id'] ?? null);
        $constant->setValue($data['value'] ?? null);

        return $constant;
    }
}
