<?php

namespace StubTests\Framework\Parsers\Serializers\Reflection;

use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;
use StubTests\Framework\Parsers\Serializers\SubEntitySerializerTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;

use StubTests\Framework\Parsers\Model\PHPInterface;

/**
 * Reflection serializer for PHPInterface entities.
 * Only includes data available via PHP Reflection API.
 */
class ReflectionInterfaceSerializer implements EntityTypeSerializerInterface
{
    use SubEntitySerializerTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPInterface;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            '_type' => 'PHPInterface',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        $data['methods'] = [];
        foreach ($entity->getMethods() as $method) {
            $data['methods'][] = $this->serializeMethod($method);
        }

        $data['constants'] = [];
        foreach ($entity->getConstants() as $constant) {
            $data['constants'][] = $this->serializeClassConstant($constant);
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null): PHPInterface
    {
        $interface = new PHPInterface();
        $interface->setName($data['name'] ?? null);
        $interface->setNamespace($data['namespace'] ?? null);
        $interface->setId($data['id'] ?? null);

        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $interface->addMethod($this->deserializeMethod($methodData));
            }
        }

        if (isset($data['constants']) && is_array($data['constants'])) {
            foreach ($data['constants'] as $constantData) {
                $interface->addConstant($this->deserializeClassConstant($constantData));
            }
        }

        return $interface;
    }
}
