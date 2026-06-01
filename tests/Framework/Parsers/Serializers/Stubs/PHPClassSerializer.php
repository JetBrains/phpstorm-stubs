<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;

/**
 * Serializer for PHPClass entities.
 */
class PHPClassSerializer implements EntityTypeSerializerInterface
{
    use SerializerHelperTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPClass;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        if (!$entity instanceof PHPClass) {
            throw new \InvalidArgumentException('Expected PHPClass entity');
        }

        $data = [
            '_type' => 'PHPClass',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
            'isFinal' => $this->toJsonSafe($entity->isFinal()),
            'isReadonly' => $this->toJsonSafe($entity->isReadonly()),
            'sourcePath' => $this->toJsonSafe($entity->getStubsMetadata()?->getSourcePath()),
            'duplicates' => $this->toJsonSafe($entity->getStubsMetadata()?->getDuplicates() ?? []),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        // Stub-specific metadata
        $data['phpDoc'] = $this->serializePhpDoc($entity->getId(), $entity->getStubsMetadata()?->getPhpDoc(), $phpDocStorage);
        $data['sinceVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getRemovedVersion());

        // Serialize methods
        $data['methods'] = [];
        foreach ($entity->getMethods() as $method) {
            $data['methods'][] = $this->serializeMethod($method, $entity->getId(), $phpDocStorage);
        }

        // Serialize properties
        $data['properties'] = [];
        foreach ($entity->getProperties() as $property) {
            $data['properties'][] = $this->serializeProperty($property, $entity->getId(), $phpDocStorage);
        }

        // Serialize constants
        $data['constants'] = [];
        foreach ($entity->getConstants() as $constant) {
            $data['constants'][] = $this->serializeClassConstant($constant);
        }

        // Serialize parent class (just store the name)
        if ($entity->getParentClass() !== null) {
            $data['parentClass'] = $entity->getParentClass()->getName();
        } else {
            $data['parentClass'] = null;
        }

        // Serialize interfaces (just store the names)
        $data['interfaces'] = [];
        foreach ($entity->getImplementedInterfaces() as $interface) {
            $data['interfaces'][] = $interface->getName();
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null)
    {
        $class = new PHPClass();
        $class->setName($data['name'] ?? null);
        $class->setNamespace($data['namespace'] ?? null);
        $class->setId($data['id'] ?? null);
        $class->setIsFinal((bool)($data['isFinal'] ?? false));
        $class->setIsReadonly((bool)($data['isReadonly'] ?? false));
        $class->initStubsMetadata()->setSourcePath($data['sourcePath'] ?? null);
        $class->initStubsMetadata()->setDuplicates($data['duplicates'] ?? []);

        // Stub-specific metadata
        $classId = $data['id'] ?? null;
        $class->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($classId, $data['phpDoc'] ?? null, $phpDocStorage));
        $class->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $class->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);

        // Deserialize methods
        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $class->addMethod($this->deserializeMethod($methodData, $classId, $phpDocStorage));
            }
        }

        // Deserialize properties
        if (isset($data['properties']) && is_array($data['properties'])) {
            foreach ($data['properties'] as $propertyData) {
                $class->addProperty($this->deserializeProperty($propertyData, $classId, $phpDocStorage));
            }
        }

        // Deserialize constants
        if (isset($data['constants']) && is_array($data['constants'])) {
            foreach ($data['constants'] as $constantData) {
                $class->addConstant($this->deserializeClassConstant($constantData));
            }
        }

        // Restore parent class from stored name
        if (!empty($data['parentClass'])) {
            $parentClass = new PHPClass();
            $parentClass->setName($data['parentClass']);
            $class->setParentClass($parentClass);
        }

        // Restore interfaces from stored names
        if (isset($data['interfaces']) && is_array($data['interfaces'])) {
            foreach ($data['interfaces'] as $interfaceName) {
                if (!empty($interfaceName)) {
                    $interface = new PHPInterface();
                    $interface->setName($interfaceName);
                    $class->addImplementedInterface($interface);
                }
            }
        }

        return $class;
    }
}
