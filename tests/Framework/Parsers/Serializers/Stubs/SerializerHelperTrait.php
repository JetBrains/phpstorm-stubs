<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Serializers\SubEntitySerializerTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;

/**
 * Stubs-specific serialization extending the shared SubEntitySerializerTrait.
 *
 * Overrides the enrich*() hooks to append stub metadata (phpDoc, sinceVersion,
 * removedVersion, LanguageLevelTypeAware fields) to serialized/deserialized entities.
 * Also provides PhpDoc storage helper methods.
 */
trait SerializerHelperTrait
{
    use SubEntitySerializerTrait;

    // ── PhpDoc storage helpers ─────────────────────────────────────

    protected function serializePhpDoc(?string $entityId, ?string $phpDoc, ?PhpDocStorage $phpDocStorage): ?string
    {
        if ($phpDocStorage !== null && $entityId !== null) {
            $phpDocStorage->setPhpDoc($entityId, $phpDoc);
            return null;
        }
        return $this->toJsonSafe($phpDoc);
    }

    protected function deserializePhpDoc(?string $entityId, ?string $inlinePhpDoc, ?PhpDocStorage $phpDocStorage): ?string
    {
        if ($inlinePhpDoc !== null) {
            return $inlinePhpDoc;
        }
        if ($phpDocStorage !== null && $entityId !== null) {
            return $phpDocStorage->getPhpDoc($entityId);
        }
        return null;
    }

    // ── Serialize hooks ────────────────────────────────────────────

    protected function enrichSerializedMethod(array &$data, PHPMethod $method, ?string $parentId, ?PhpDocStorage $phpDocStorage): void
    {
        $methodId = $parentId ? $parentId . '::' . $method->getName() : null;
        $data['phpDoc'] = $this->serializePhpDoc($methodId, $method->getStubsMetadata()?->getPhpDoc(), $phpDocStorage);
        $data['sinceVersion'] = $this->toJsonSafe($method->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($method->getStubsMetadata()?->getRemovedVersion());
        $data['returnTypeFromPhpDoc'] = $this->toJsonSafe($method->getStubsMetadata()?->getTypeFromPhpDoc());
        $data['languageLevelTypes'] = $this->toJsonSafe($method->getStubsMetadata()?->getLanguageLevelTypes());
        $data['defaultType'] = $this->toJsonSafe($method->getStubsMetadata()?->getDefaultType());
    }

    protected function enrichSerializedParameter(array &$data, PHPParameter $parameter): void
    {
        $data['typeFromPhpDoc'] = $this->toJsonSafe($parameter->getStubsMetadata()?->getTypeFromPhpDoc());
        $data['languageLevelTypes'] = $this->toJsonSafe($parameter->getStubsMetadata()?->getLanguageLevelTypes());
        $data['defaultType'] = $this->toJsonSafe($parameter->getStubsMetadata()?->getDefaultType());
        $data['sinceVersion'] = $this->toJsonSafe($parameter->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($parameter->getStubsMetadata()?->getRemovedVersion());
    }

    protected function enrichSerializedProperty(array &$data, PHPProperty $property, ?string $parentId, ?PhpDocStorage $phpDocStorage): void
    {
        $propertyId = $parentId ? $parentId . '::$' . $property->getName() : null;
        $data['phpDoc'] = $this->serializePhpDoc($propertyId, $property->getStubsMetadata()?->getPhpDoc(), $phpDocStorage);
        $data['sinceVersion'] = $this->toJsonSafe($property->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($property->getStubsMetadata()?->getRemovedVersion());
        $data['typeFromPhpDoc'] = $this->toJsonSafe($property->getStubsMetadata()?->getTypeFromPhpDoc());
        $data['languageLevelTypes'] = $this->toJsonSafe($property->getStubsMetadata()?->getLanguageLevelTypes());
        $data['defaultType'] = $this->toJsonSafe($property->getStubsMetadata()?->getDefaultType());
    }

    protected function enrichSerializedClassConstant(array &$data, PHPClassConstant $constant): void
    {
        $data['sinceVersion'] = $this->toJsonSafe($constant->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($constant->getStubsMetadata()?->getRemovedVersion());
    }

    // ── Deserialize hooks ──────────────────────────────────────────

    protected function enrichDeserializedMethod(PHPMethod $method, array $data, ?string $parentId, ?PhpDocStorage $phpDocStorage): void
    {
        $methodId = $parentId ? $parentId . '::' . ($data['name'] ?? '') : null;
        $method->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($methodId, $data['phpDoc'] ?? null, $phpDocStorage));
        $method->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $method->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);
        $method->initStubsMetadata()->setTypeFromPhpDoc($data['returnTypeFromPhpDoc'] ?? null);
        $method->initStubsMetadata()->setLanguageLevelTypes($data['languageLevelTypes'] ?? null);
        $method->initStubsMetadata()->setDefaultType($data['defaultType'] ?? null);
    }

    protected function enrichDeserializedParameter(PHPParameter $parameter, array $data): void
    {
        $parameter->initStubsMetadata()->setTypeFromPhpDoc($data['typeFromPhpDoc'] ?? null);
        $parameter->initStubsMetadata()->setLanguageLevelTypes($data['languageLevelTypes'] ?? null);
        $parameter->initStubsMetadata()->setDefaultType($data['defaultType'] ?? null);
        $parameter->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $parameter->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);
    }

    protected function enrichDeserializedProperty(PHPProperty $property, array $data, ?string $parentId, ?PhpDocStorage $phpDocStorage): void
    {
        $propertyId = $parentId ? $parentId . '::$' . ($data['name'] ?? '') : null;
        $property->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($propertyId, $data['phpDoc'] ?? null, $phpDocStorage));
        $property->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $property->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);
        $property->initStubsMetadata()->setTypeFromPhpDoc($data['typeFromPhpDoc'] ?? null);
        $property->initStubsMetadata()->setLanguageLevelTypes($data['languageLevelTypes'] ?? null);
        $property->initStubsMetadata()->setDefaultType($data['defaultType'] ?? null);
    }

    protected function enrichDeserializedClassConstant(PHPClassConstant $constant, array $data): void
    {
        $constant->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $constant->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);
    }
}
