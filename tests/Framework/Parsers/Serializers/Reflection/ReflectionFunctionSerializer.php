<?php

namespace StubTests\Framework\Parsers\Serializers\Reflection;

use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;
use StubTests\Framework\Parsers\Serializers\SubEntitySerializerTrait;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPMethod;

/**
 * Reflection serializer for PHPFunction entities.
 * Only includes data available via PHP Reflection API.
 */
class ReflectionFunctionSerializer implements EntityTypeSerializerInterface
{
    use SubEntitySerializerTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPFunction && !$entity instanceof PHPMethod;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        $data = [
            '_type' => 'PHPFunction',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        try {
            $data['isDeprecated'] = $this->toJsonSafe($entity->isDeprecated());
        } catch (\Error $e) {
            $data['isDeprecated'] = false;
        }

        try {
            $returnType = $entity->getReturnTypeFromSignature();
            $data['returnType'] = $returnType?->toString() ?? null;
            $data['hasTentativeReturnType'] = $this->toJsonSafe($entity->hasTentativeReturnType());
        } catch (\Error $e) {
            $data['returnType'] = null;
            $data['hasTentativeReturnType'] = false;
        }

        try {
            $parameters = $entity->getParameters();
            $data['parameters'] = [];
            foreach ($parameters ?? [] as $param) {
                $data['parameters'][] = $this->serializeParameter($param);
            }
        } catch (\Error $e) {
            $data['parameters'] = [];
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null): PHPFunction
    {
        $function = new PHPFunction();
        $function->setName($data['name'] ?? null);
        $function->setNamespace($data['namespace'] ?? null);
        $function->setId($data['id'] ?? null);
        $function->setDeprecated($data['isDeprecated'] ?? false);

        if (isset($data['returnType']) && $data['returnType'] !== null) {
            $function->setReturnTypeFromSignature($this->parseType($data['returnType']));
        }
        $function->setHasTentativeReturnType($data['hasTentativeReturnType'] ?? false);

        if (isset($data['parameters']) && is_array($data['parameters'])) {
            $parameters = [];
            foreach ($data['parameters'] as $paramData) {
                $parameters[] = $this->deserializeParameter($paramData);
            }
            $function->setParameters($parameters);
        }

        return $function;
    }
}
