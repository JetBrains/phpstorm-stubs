<?php

namespace StubTests\Framework\Parsers\Serializers\Reflection;

use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;
use StubTests\Framework\Parsers\Serializers\SubEntitySerializerTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPInterface;

/**
 * Reflection serializer for PHPClass entities.
 * Only includes data available via PHP Reflection API.
 */
class ReflectionClassSerializer implements EntityTypeSerializerInterface
{
    use SubEntitySerializerTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPClass;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            '_type' => 'PHPClass',
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

        $data['properties'] = [];
        foreach ($entity->getProperties() as $property) {
            $data['properties'][] = $this->serializeProperty($property);
        }

        $data['constants'] = [];
        foreach ($entity->getConstants() as $constant) {
            $data['constants'][] = $this->serializeClassConstant($constant);
        }

        // Persist the fully qualified name (getId, falling back to getName) so the FQN
        // survives the cache round-trip while getName() keeps only the short name.
        if ($entity->getParentClass() !== null) {
            $parent = $entity->getParentClass();
            $data['parentClass'] = $parent->getId() ?? $parent->getName();
        } else {
            $data['parentClass'] = null;
        }

        $data['interfaces'] = [];
        foreach ($entity->getImplementedInterfaces() as $interface) {
            $data['interfaces'][] = $interface->getId() ?? $interface->getName();
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null): PHPClass
    {
        $class = new PHPClass();
        $class->setName($data['name'] ?? null);
        $class->setNamespace($data['namespace'] ?? null);
        $class->setId($data['id'] ?? null);
        $class->setIsFinal((bool)($data['isFinal'] ?? false));
        $class->setIsReadonly((bool)($data['isReadonly'] ?? false));

        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $class->addMethod($this->deserializeMethod($methodData));
            }
        }

        if (isset($data['properties']) && is_array($data['properties'])) {
            foreach ($data['properties'] as $propertyData) {
                $class->addProperty($this->deserializeProperty($propertyData));
            }
        }

        if (isset($data['constants']) && is_array($data['constants'])) {
            foreach ($data['constants'] as $constantData) {
                $class->addConstant($this->deserializeClassConstant($constantData));
            }
        }

        if (!empty($data['parentClass'])) {
            $parentClass = new PHPClass();
            $parentClass->setName($this->shortClassName($data['parentClass']));
            $parentClass->setId($data['parentClass']);
            $class->setParentClass($parentClass);
        }

        if (isset($data['interfaces']) && is_array($data['interfaces'])) {
            foreach ($data['interfaces'] as $interfaceName) {
                if (!empty($interfaceName)) {
                    $interface = new PHPInterface();
                    $interface->setName($this->shortClassName($interfaceName));
                    $interface->setId($interfaceName);
                    $class->addImplementedInterface($interface);
                }
            }
        }

        return $class;
    }
}
