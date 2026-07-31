<?php

namespace StubTests\Framework\Serialization\Stubs;

use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Serialization\PhpDocRepository;
use StubTests\Framework\Serialization\EntityTypeSerializerInterface;

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

    public function serialize($entity, ?PhpDocRepository $phpDocStorage = null): array
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

        // Persist the fully qualified name, matching PHPClassSerializer. Storing only the
        // short name left a namespaced interface indistinguishable from a global one of the
        // same name after a round-trip.
        $data['interfaces'] = [];
        foreach ($entity->getImplementedInterfaces() as $interface) {
            $data['interfaces'][] = $interface->getId() ?? $interface->getName();
        }

        return $data;
    }

    /**
     * Short name of a possibly qualified interface name (`\Foo\Bar` => `Bar`).
     */
    private function shortInterfaceName(string $name): string
    {
        $pos = strrpos($name, '\\');
        return $pos === false ? $name : substr($name, $pos + 1);
    }

    public function deserialize(array $data, ?PhpDocRepository $phpDocStorage = null)
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
                    $interface = new \StubTests\Framework\Model\PHPInterface();
                    $interface->setName($this->shortInterfaceName($interfaceName));
                    $interface->setId($interfaceName);
                    $enum->addImplementedInterface($interface);
                }
            }
        }

        return $enum;
    }
}
