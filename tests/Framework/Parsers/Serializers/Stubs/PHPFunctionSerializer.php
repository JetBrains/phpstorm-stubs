<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Serializers\Stubs\SerializerHelperTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;

/**
 * Serializer for PHPFunction entities.
 */
class PHPFunctionSerializer implements EntityTypeSerializerInterface
{
    use SerializerHelperTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPFunction && !$entity instanceof PHPMethod;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        if (!$entity instanceof PHPFunction) {
            throw new \InvalidArgumentException('Expected PHPFunction entity');
        }

        $data = [
            '_type' => 'PHPFunction',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
            'sourcePath' => $this->toJsonSafe($entity->getStubsMetadata()?->getSourcePath()),
            'duplicates' => $this->toJsonSafe($entity->getStubsMetadata()?->getDuplicates() ?? []),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());
        $data['isDeprecated'] = $this->toJsonSafe($entity->isDeprecated());

        $returnType = $entity->getReturnTypeFromSignature();
        $data['returnType'] = $returnType?->toString() ?? null;
        $data['hasTentativeReturnType'] = $this->toJsonSafe($entity->hasTentativeReturnType());

        // Stub-specific metadata
        $data['phpDoc'] = $this->serializePhpDoc($entity->getId(), $entity->getStubsMetadata()?->getPhpDoc(), $phpDocStorage);
        $data['sinceVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getRemovedVersion());
        $data['returnTypeFromPhpDoc'] = $this->toJsonSafe($entity->getStubsMetadata()?->getTypeFromPhpDoc());
        $data['languageLevelTypes'] = $this->toJsonSafe($entity->getStubsMetadata()?->getLanguageLevelTypes());
        $data['defaultType'] = $this->toJsonSafe($entity->getStubsMetadata()?->getDefaultType());

        // Serialize parameters
        $data['parameters'] = [];
        foreach ($entity->getParameters() as $param) {
            $data['parameters'][] = $this->serializeParameter($param, $phpDocStorage);
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null)
    {
        $function = new PHPFunction();
        $function->setName($data['name'] ?? null);
        $function->setNamespace($data['namespace'] ?? null);
        $function->setId($data['id'] ?? null);
        $function->initStubsMetadata()->setSourcePath($data['sourcePath'] ?? null);
        $function->initStubsMetadata()->setDuplicates($data['duplicates'] ?? []);
        $function->setDeprecated($data['isDeprecated'] ?? false);

        $function->setHasTentativeReturnType($data['hasTentativeReturnType'] ?? false);

        // Only set return type if provided and not null
        if (isset($data['returnType']) && $data['returnType'] !== null) {
            $function->setReturnTypeFromSignature($this->parseType($data['returnType']));
        }

        // Stub-specific metadata
        $functionId = $data['id'] ?? null;
        $function->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($functionId, $data['phpDoc'] ?? null, $phpDocStorage));
        $function->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $function->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);
        $function->initStubsMetadata()->setTypeFromPhpDoc($data['returnTypeFromPhpDoc'] ?? null);
        $function->initStubsMetadata()->setLanguageLevelTypes($data['languageLevelTypes'] ?? null);
        $function->initStubsMetadata()->setDefaultType($data['defaultType'] ?? null);

        // Deserialize parameters
        if (isset($data['parameters']) && is_array($data['parameters'])) {
            $parameters = [];
            foreach ($data['parameters'] as $paramData) {
                $parameters[] = $this->deserializeParameter($paramData, $phpDocStorage);
            }
            $function->setParameters($parameters);
        }

        return $function;
    }
}
