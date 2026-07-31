<?php

namespace StubTests\Framework\Serialization\Reflection;

use StubTests\Framework\Serialization\EntityTypeSerializerInterface;
use StubTests\Framework\Serialization\SubEntitySerializerTrait;
use StubTests\Framework\Serialization\PhpDocRepository;
use StubTests\Framework\Model\PHPConstant;

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

    public function serialize($entity, ?PhpDocRepository $phpDocStorage = null): array
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

    public function deserialize(array $data, ?PhpDocRepository $phpDocStorage = null): PHPConstant
    {
        $constant = new PHPConstant();
        $constant->setName($data['name'] ?? '');
        $constant->setNamespace($data['namespace'] ?? null);
        $constant->setId($data['id'] ?? null);
        $constant->setValue($data['value'] ?? null);

        return $constant;
    }
}
