<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Serializers\Stubs\SerializerHelperTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;

/**
 * Serializer for PHPInterface entities.
 */
class PHPInterfaceSerializer implements EntityTypeSerializerInterface
{
    use SerializerHelperTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPInterface;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        if (!$entity instanceof PHPInterface) {
            throw new \InvalidArgumentException('Expected PHPInterface entity');
        }

        $data = [
            '_type' => 'PHPInterface',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
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

        // Serialize constants
        $data['constants'] = [];
        foreach ($entity->getConstants() as $constant) {
            $data['constants'][] = $this->serializeClassConstant($constant);
        }

        // Serialize parent interfaces (just store the names)
        $data['parentInterfaces'] = [];
        foreach ($entity->getParentInterfaces() as $parentInterface) {
            $data['parentInterfaces'][] = $parentInterface->getName();
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null)
    {
        $interface = new PHPInterface();
        $interface->setName($data['name'] ?? null);
        $interface->setNamespace($data['namespace'] ?? null);
        $interface->setId($data['id'] ?? null);
        $interface->initStubsMetadata()->setSourcePath($data['sourcePath'] ?? null);
        $interface->initStubsMetadata()->setDuplicates($data['duplicates'] ?? []);

        // Stub-specific metadata
        $interfaceId = $data['id'] ?? null;
        $interface->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($interfaceId, $data['phpDoc'] ?? null, $phpDocStorage));
        $interface->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $interface->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);

        // Deserialize methods
        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $interface->addMethod($this->deserializeMethod($methodData, $interfaceId, $phpDocStorage));
            }
        }

        // Deserialize constants
        if (isset($data['constants']) && is_array($data['constants'])) {
            foreach ($data['constants'] as $constantData) {
                $interface->addConstant($this->deserializeClassConstant($constantData));
            }
        }

        // Restore parent interfaces from stored names
        if (isset($data['parentInterfaces']) && is_array($data['parentInterfaces'])) {
            foreach ($data['parentInterfaces'] as $parentInterfaceName) {
                if (!empty($parentInterfaceName)) {
                    $parentInterface = new PHPInterface();
                    $parentInterface->setName($parentInterfaceName);
                    $interface->addParentInterface($parentInterface);
                }
            }
        }

        return $interface;
    }
}
