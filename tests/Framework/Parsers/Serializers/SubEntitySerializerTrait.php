<?php

namespace StubTests\Framework\Parsers\Serializers;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Serializers\SerializerUtilsTrait;

/**
 * Shared sub-entity serialization logic for both Stubs and Reflection serializers.
 *
 * Contains core serialize/deserialize methods for methods, parameters, properties,
 * and class constants. Stubs serializers override the enrich*() hooks to append
 * stub-specific metadata (phpDoc, sinceVersion, removedVersion, LanguageLevelTypeAware).
 * Reflection serializers use this trait directly — the default no-op hooks produce
 * clean reflection-only output.
 */
trait SubEntitySerializerTrait
{
    use SerializerUtilsTrait;

    // ── Serialize ──────────────────────────────────────────────────

    protected function serializeMethod(PHPMethod $method, ?string $parentId = null, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            'name' => $method->getName(),
            'isStatic' => $method->isStatic(),
            'isFinal' => $method->isFinal(),
            'isAbstract' => $method->isAbstract(),
            'isDeprecated' => $method->isDeprecated(),
        ];

        $access = $method->getAccess();
        $data['accessModifier'] = $access instanceof AccessModifier ? $access->value : 'public';

        $data['parameters'] = [];
        foreach ($method->getParameters() as $parameter) {
            $data['parameters'][] = $this->serializeParameter($parameter, $phpDocStorage);
        }

        $type = $method->getReturnTypeFromSignature();
        $data['returnType'] = $type?->toString() ?? null;
        $data['hasTentativeReturnType'] = $this->toJsonSafe($method->hasTentativeReturnType());

        $this->enrichSerializedMethod($data, $method, $parentId, $phpDocStorage);

        return $data;
    }

    protected function serializeParameter(PHPParameter $parameter, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            'name' => $parameter->getName(),
            'position' => $parameter->getPosition(),
            'isOptional' => $parameter->isOptional(),
            'isVariadic' => $parameter->isVariadic(),
            'isPassedByReference' => $parameter->isPassedByReference(),
            'isDeprecated' => $parameter->isDeprecated(),
            'hasDefaultValue' => $parameter->hasDefaultValue(),
        ];

        $data['type'] = $parameter->getDeclaredType()->toString();

        if ($parameter->hasDefaultValue()) {
            $data['defaultValue'] = $this->toJsonSafe($parameter->getDefaultValue());
        } else {
            $data['defaultValue'] = null;
        }

        $this->enrichSerializedParameter($data, $parameter);

        return $data;
    }

    protected function serializeProperty(PHPProperty $property, ?string $parentId = null, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            'name' => $property->getName(),
            'isStatic' => $property->isStatic(),
            'isReadonly' => $property->isReadonly()
        ];

        $access = $property->getAccess();
        $data['accessModifier'] = $access instanceof AccessModifier ? $access->value : 'public';

        $type = $property->getType();
        $data['type'] = $type?->toString() ?? null;

        $this->enrichSerializedProperty($data, $property, $parentId, $phpDocStorage);

        return $data;
    }

    protected function serializeClassConstant(PHPClassConstant $constant): array
    {
        $data = [
            'name' => $constant->getName(),
            'value' => $this->toJsonSafe($constant->getValue()),
            'visibility' => $constant->getAccess()->value,
            'isFinal' => $constant->isFinal(),
        ];

        $this->enrichSerializedClassConstant($data, $constant);

        return $data;
    }

    // ── Deserialize ────────────────────────────────────────────────

    protected function deserializeMethod(array $data, ?string $parentId = null, ?PhpDocStorage $phpDocStorage = null): PHPMethod
    {
        $method = new PHPMethod();
        $method->setName($data['name'] ?? '');
        $method->setIsStatic($data['isStatic'] ?? false);
        $method->setIsFinal($data['isFinal'] ?? false);
        $method->setIsAbstract($data['isAbstract'] ?? false);
        $method->setDeprecated($data['isDeprecated'] ?? false);

        $accessModifier = $data['accessModifier'] ?? 'public';
        if ($accessModifier === 'private') {
            $method->setAccess(AccessModifier::PRIVATE);
        } elseif ($accessModifier === 'protected') {
            $method->setAccess(AccessModifier::PROTECTED);
        } else {
            $method->setAccess(AccessModifier::PUBLIC);
        }

        if (isset($data['parameters']) && is_array($data['parameters'])) {
            $parameters = [];
            foreach ($data['parameters'] as $paramData) {
                $parameters[] = $this->deserializeParameter($paramData, $phpDocStorage);
            }
            $method->setParameters($parameters);
        }

        $method->setHasTentativeReturnType($data['hasTentativeReturnType'] ?? false);

        if (isset($data['returnType']) && $data['returnType'] !== null) {
            $method->setReturnTypeFromSignature($this->parseType($data['returnType']));
        }

        $this->enrichDeserializedMethod($method, $data, $parentId, $phpDocStorage);

        return $method;
    }

    protected function deserializeParameter(array $data, ?PhpDocStorage $phpDocStorage = null): PHPParameter
    {
        $parameter = new PHPParameter($data['name'] ?? '');
        $parameter->setPosition($data['position'] ?? 0);
        $parameter->setIsOptional($data['isOptional'] ?? false);
        $parameter->setIsVariadic($data['isVariadic'] ?? false);
        $parameter->setIsPassedByReference($data['isPassedByReference'] ?? false);
        $parameter->setDeprecated($data['isDeprecated'] ?? false);
        $parameter->setHasDefaultValue($data['hasDefaultValue'] ?? false);

        if (isset($data['type']) && $data['type'] !== null) {
            $parameter->setType($this->parseType($data['type']));
        }

        if (isset($data['defaultValue'])) {
            $parameter->setDefaultValue($data['defaultValue']);
        }

        $this->enrichDeserializedParameter($parameter, $data);

        return $parameter;
    }

    protected function deserializeProperty(array $data, ?string $parentId = null, ?PhpDocStorage $phpDocStorage = null): PHPProperty
    {
        $property = new PHPProperty();
        $property->setName($data['name'] ?? '');
        $property->setIsStatic($data['isStatic'] ?? false);
        $property->setIsReadonly($data['isReadonly'] ?? false);

        $accessModifier = $data['accessModifier'] ?? 'public';
        if ($accessModifier === 'private') {
            $property->setAccess(AccessModifier::PRIVATE);
        } elseif ($accessModifier === 'protected') {
            $property->setAccess(AccessModifier::PROTECTED);
        } else {
            $property->setAccess(AccessModifier::PUBLIC);
        }

        if (isset($data['type']) && $data['type'] !== null) {
            $property->setTypeFromSignature($this->parseType($data['type']));
        }

        $this->enrichDeserializedProperty($property, $data, $parentId, $phpDocStorage);

        return $property;
    }

    protected function deserializeClassConstant(array $data): PHPClassConstant
    {
        $constant = new PHPClassConstant();
        $constant->setName($data['name'] ?? '');
        $constant->setValue($data['value'] ?? null);
        $accessModifier = $data['visibility'] ?? 'public';
        $constant->setAccess(match ($accessModifier) {
            'private' => AccessModifier::PRIVATE,
            'protected' => AccessModifier::PROTECTED,
            default => AccessModifier::PUBLIC,
        });
        $constant->setIsFinal($data['isFinal'] ?? false);

        $this->enrichDeserializedClassConstant($constant, $data);

        return $constant;
    }

    // ── Hooks (no-op defaults, overridden by Stubs variant) ────────

    protected function enrichSerializedMethod(array &$data, PHPMethod $method, ?string $parentId, ?PhpDocStorage $phpDocStorage): void {}
    protected function enrichSerializedParameter(array &$data, PHPParameter $parameter): void {}
    protected function enrichSerializedProperty(array &$data, PHPProperty $property, ?string $parentId, ?PhpDocStorage $phpDocStorage): void {}
    protected function enrichSerializedClassConstant(array &$data, PHPClassConstant $constant): void {}

    protected function enrichDeserializedMethod(PHPMethod $method, array $data, ?string $parentId, ?PhpDocStorage $phpDocStorage): void {}
    protected function enrichDeserializedParameter(PHPParameter $parameter, array $data): void {}
    protected function enrichDeserializedProperty(PHPProperty $property, array $data, ?string $parentId, ?PhpDocStorage $phpDocStorage): void {}
    protected function enrichDeserializedClassConstant(PHPClassConstant $constant, array $data): void {}
}
