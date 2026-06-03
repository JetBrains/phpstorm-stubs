<?php

namespace StubTests\Framework\Parsers\Serializers\Reflection;

use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;
use StubTests\Framework\Parsers\Serializers\SubEntitySerializerTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPInterface;

/**
 * Reflection serializer for PHPEnum entities.
 * Only includes data available via PHP Reflection API.
 */
class ReflectionEnumSerializer implements EntityTypeSerializerInterface
{
    use SubEntitySerializerTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPEnum;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            '_type' => 'PHPEnum',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
            'isFinal' => $this->toJsonSafe($entity->isFinal()),
            'isReadonly' => $this->toJsonSafe($entity->isReadonly()),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        $data['methods'] = [];
        foreach ($entity->getMethods() as $method) {
            $data['methods'][] = $this->serializeMethod($method);
        }

        $data['interfaces'] = [];
        foreach ($entity->getImplementedInterfaces() as $interface) {
            $data['interfaces'][] = $interface->getName();
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null): PHPEnum
    {
        $enum = new PHPEnum();
        $enum->setName($data['name'] ?? null);
        $enum->setNamespace($data['namespace'] ?? null);
        $enum->setId($data['id'] ?? null);
        $enum->setIsFinal((bool)($data['isFinal'] ?? false));
        $enum->setIsReadonly((bool)($data['isReadonly'] ?? false));

        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $enum->addMethod($this->deserializeMethod($methodData));
            }
        }

        if (isset($data['interfaces']) && is_array($data['interfaces'])) {
            foreach ($data['interfaces'] as $interfaceName) {
                if (!empty($interfaceName)) {
                    $interface = new PHPInterface();
                    $interface->setName($interfaceName);
                    $enum->addImplementedInterface($interface);
                }
            }
        }

        return $enum;
    }
}
