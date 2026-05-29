<?php

namespace StubTests\Framework\Parsers\Serializers\Reflection;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Serializers\EntitySerializerInterface;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Serializers\Reflection\ReflectionClassSerializer;
use StubTests\Framework\Parsers\Serializers\Reflection\ReflectionConstantSerializer;
use StubTests\Framework\Parsers\Serializers\Reflection\ReflectionEnumSerializer;
use StubTests\Framework\Parsers\Serializers\Reflection\ReflectionFunctionSerializer;
use StubTests\Framework\Parsers\Serializers\Reflection\ReflectionInterfaceSerializer;

/**
 * Facade for reflection entity serialization.
 *
 * Delegates to per-type serializers that only include data available
 * via PHP Reflection API (no PhpDoc, no sinceVersion/removedVersion,
 * no LanguageLevelTypeAware).
 *
 * @see ReflectionClassSerializer
 * @see ReflectionFunctionSerializer
 * @see ReflectionInterfaceSerializer
 * @see ReflectionEnumSerializer
 * @see ReflectionConstantSerializer
 */
class ReflectionEntitySerializer implements EntitySerializerInterface
{
    private ReflectionClassSerializer $classSerializer;
    private ReflectionFunctionSerializer $functionSerializer;
    private ReflectionInterfaceSerializer $interfaceSerializer;
    private ReflectionEnumSerializer $enumSerializer;
    private ReflectionConstantSerializer $constantSerializer;

    /** @var array<string, ReflectionClassSerializer|ReflectionFunctionSerializer|ReflectionInterfaceSerializer|ReflectionEnumSerializer|ReflectionConstantSerializer> */
    private array $deserializerMap;

    public function __construct()
    {
        $this->classSerializer = new ReflectionClassSerializer();
        $this->functionSerializer = new ReflectionFunctionSerializer();
        $this->interfaceSerializer = new ReflectionInterfaceSerializer();
        $this->enumSerializer = new ReflectionEnumSerializer();
        $this->constantSerializer = new ReflectionConstantSerializer();

        $this->deserializerMap = [
            'PHPClass' => $this->classSerializer,
            'PHPFunction' => $this->functionSerializer,
            'PHPInterface' => $this->interfaceSerializer,
            'PHPEnum' => $this->enumSerializer,
            'PHPConstant' => $this->constantSerializer,
        ];
    }

    public function serialize($entity): array
    {
        if ($entity instanceof PHPClass) {
            return $this->classSerializer->serialize($entity);
        }

        if ($entity instanceof PHPFunction && !$entity instanceof PHPMethod) {
            return $this->functionSerializer->serialize($entity);
        }

        if ($entity instanceof PHPInterface) {
            return $this->interfaceSerializer->serialize($entity);
        }

        if ($entity instanceof PHPEnum) {
            return $this->enumSerializer->serialize($entity);
        }

        if ($entity instanceof PHPConstant) {
            return $this->constantSerializer->serialize($entity);
        }

        throw new \RuntimeException('Cannot serialize unknown entity type: ' . get_class($entity));
    }

    public function deserialize(array $data)
    {
        $type = $data['_type'] ?? 'Unknown';

        if (isset($this->deserializerMap[$type])) {
            return $this->deserializerMap[$type]->deserialize($data);
        }

        throw new \RuntimeException("Cannot deserialize unknown entity type: {$type}");
    }
}
