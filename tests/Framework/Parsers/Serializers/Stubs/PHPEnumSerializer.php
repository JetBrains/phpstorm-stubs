<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;

/**
 * Serializer for PHPEnum entities.
 */
class PHPEnumSerializer implements EntityTypeSerializerInterface
{
    use SerializerHelperTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPEnum;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        if (!$entity instanceof PHPEnum) {
            throw new \InvalidArgumentException('Expected PHPEnum entity');
        }

        $data = [
            '_type' => 'PHPEnum',
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

        // Serialize cases
        $data['cases'] = $entity->getCaseNames();

        // Serialize constants
        $data['constants'] = [];
        foreach ($entity->getConstants() as $constant) {
            $data['constants'][] = $this->serializeClassConstant($constant);
        }

        // Serialize methods
        $data['methods'] = [];
        foreach ($entity->getMethods() as $method) {
            $data['methods'][] = $this->serializeMethod($method, $entity->getId(), $phpDocStorage);
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
        $enum = new PHPEnum();
        $enum->setName($data['name'] ?? null);
        $enum->setNamespace($data['namespace'] ?? null);
        $enum->setId($data['id'] ?? null);
        $enum->setIsFinal((bool)($data['isFinal'] ?? false));
        $enum->setIsReadonly((bool)($data['isReadonly'] ?? false));
        $enum->initStubsMetadata()->setSourcePath($data['sourcePath'] ?? null);
        $enum->initStubsMetadata()->setDuplicates($data['duplicates'] ?? []);

        // Stub-specific metadata
        $enumId = $data['id'] ?? null;
        $enum->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($enumId, $data['phpDoc'] ?? null, $phpDocStorage));
        $enum->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $enum->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);

        // Deserialize cases
        $enum->setCases(isset($data['cases']) && is_array($data['cases']) ? $data['cases'] : []);

        // Deserialize constants
        if (isset($data['constants']) && is_array($data['constants'])) {
            foreach ($data['constants'] as $constantData) {
                $enum->addConstant($this->deserializeClassConstant($constantData));
            }
        }

        // Deserialize methods
        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $enum->addMethod($this->deserializeMethod($methodData, $enumId, $phpDocStorage));
            }
        }

        // Restore interfaces from stored names
        if (isset($data['interfaces']) && is_array($data['interfaces'])) {
            foreach ($data['interfaces'] as $interfaceName) {
                if (!empty($interfaceName)) {
                    $interface = new \StubTests\Framework\Parsers\Model\PHPInterface();
                    $interface->setName($interfaceName);
                    $enum->addImplementedInterface($interface);
                }
            }
        }

        return $enum;
    }
}
