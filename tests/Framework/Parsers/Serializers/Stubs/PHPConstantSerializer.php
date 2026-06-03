<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;

/**
 * Serializer for PHPConstant entities.
 */
class PHPConstantSerializer implements EntityTypeSerializerInterface
{
    use SerializerHelperTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPConstant;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        if (!$entity instanceof PHPConstant) {
            throw new \InvalidArgumentException('Expected PHPConstant entity');
        }

        $data = [
            '_type' => 'PHPConstant',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
            'value' => $this->toJsonSafe($entity->getValue()),
            'sourcePath' => $this->toJsonSafe($entity->getStubsMetadata()?->getSourcePath()),
            'duplicates' => $this->toJsonSafe($entity->getStubsMetadata()?->getDuplicates() ?? []),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        // Stub-specific metadata
        $data['phpDoc'] = $this->serializePhpDoc($entity->getId(), $entity->getStubsMetadata()?->getPhpDoc(), $phpDocStorage);
        $data['sinceVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getRemovedVersion());

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null)
    {
        $constant = new PHPConstant();
        $constant->setName($data['name'] ?? null);
        $constant->setNamespace($data['namespace'] ?? null);
        $constant->setId($data['id'] ?? null);
        $constant->setValue($data['value'] ?? null);
        $constant->initStubsMetadata()->setSourcePath($data['sourcePath'] ?? null);
        $constant->initStubsMetadata()->setDuplicates($data['duplicates'] ?? []);

        // Stub-specific metadata
        $constantId = $data['id'] ?? null;
        $constant->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($constantId, $data['phpDoc'] ?? null, $phpDocStorage));
        $constant->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $constant->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);

        return $constant;
    }
}
