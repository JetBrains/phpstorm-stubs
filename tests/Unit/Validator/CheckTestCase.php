<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

/**
 * Base test case providing helper methods for creating mock entities.
 */
abstract class CheckTestCase extends TestCase
{
    /**
     * Create a mock StubDataQueryInterface.
     */
    protected function createMockStorageManager(): StubDataQueryInterface
    {
        return $this->createMock(StubDataQueryInterface::class);
    }

    /**
     * Create a mock PHPFunction with the given id/name.
     */
    protected function createMockFunction(string $name, array $parameters = [], $returnType = null): PHPFunction
    {
        $function = $this->getMockBuilder(PHPFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getParameters', 'getReturnTypeFromSignature'])
            ->getMock();

        $function->method('getId')->willReturn($name);
        $function->method('getName')->willReturn($name);
        $function->method('getParameters')->willReturn($parameters);

        if ($returnType !== null) {
            $function->method('getReturnTypeFromSignature')->willReturn($returnType);
        }

        return $function;
    }

    /**
     * Create a mock PHPClass with the given id/name.
     */
    protected function createMockClass(string $name, array $methods = []): PHPClass
    {
        $class = $this->createMock(PHPClass::class);
        $class->method('getId')->willReturn($name);
        $class->method('getName')->willReturn($name);
        $class->method('getMethods')->willReturn($methods);

        return $class;
    }

    /**
     * Create a mock PHPClass with properties (isFinal, isReadonly, namespace, parentClass).
     *
     * @param string $name Class name/ID
     * @param string|null $namespace Class namespace
     * @param bool|null $isFinal Whether class is final
     * @param bool|null $isReadonly Whether class is readonly
     * @param array $methods Array of methods
     * @param PHPClass|null $parentClass Parent class object
     * @return PHPClass
     */
    protected function createMockClassWithProperties(
        string $name,
        ?string $namespace = null,
        ?bool $isFinal = null,
        ?bool $isReadonly = null,
        array $methods = [],
        ?PHPClass $parentClass = null,
        array $interfaces = [],
        array $properties = []
    ): PHPClass {
        $class = $this->getMockBuilder(PHPClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getNamespace', 'getMethods', 'getProperties'])
            ->getMock();

        $class->method('getId')->willReturn($name);
        $class->method('getName')->willReturn($name);
        $class->method('getNamespace')->willReturn($namespace);
        $class->method('getMethods')->willReturn($methods);
        $class->method('getProperties')->willReturn($properties);

        // Set properties via setters
        if ($isFinal !== null) {
            $class->setIsFinal($isFinal);
        }
        if ($isReadonly !== null) {
            $class->setIsReadonly($isReadonly);
        }
        if ($parentClass !== null) {
            $class->setParentClass($parentClass);
        }
        if (!empty($interfaces)) {
            $class->setImplementedInterfaces($interfaces);
        }

        return $class;
    }

    /**
     * Create a mock PHPProperty with the given name and optional version bounds.
     */
    protected function createMockProperty(string $name, ?string $sinceVersion = null, ?string $removedVersion = null): PHPProperty
    {
        $property = new PHPProperty();
        $property->setName($name);
        if ($sinceVersion !== null || $removedVersion !== null) {
            $property->initStubsMetadata()->setSinceVersion($sinceVersion);
            $property->initStubsMetadata()->setRemovedVersion($removedVersion);
        }

        return $property;
    }

    /**
     * Create a mock PHPMethod with the given name.
     */
    protected function createMockMethod(string $name, array $parameters = [], $returnType = null): PHPMethod
    {
        $method = $this->getMockBuilder(PHPMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getParameters', 'getReturnTypeFromSignature'])
            ->getMock();

        $method->method('getName')->willReturn($name);
        $method->method('getParameters')->willReturn($parameters);

        if ($returnType !== null) {
            $method->method('getReturnTypeFromSignature')->willReturn($returnType);
        }

        return $method;
    }

    /**
     * Create a mock PHPParameter with the given name and type.
     *
     * Note: Supports both getDeclaredType() and getType() methods to be compatible
     * with different validators (ParameterNamesCheck uses getName, ParameterTypesCheck uses getType).
     *
     * @param string $name Parameter name
     * @param mixed|null $type Parameter type (optional)
     * @param string|null $sinceVersion Version when parameter was introduced (optional)
     * @param string|null $removedVersion Version when parameter was removed (optional)
     */
    protected function createMockParameter(string $name, $type = null, ?string $sinceVersion = null, ?string $removedVersion = null): PHPParameter
    {
        $parameter = new PHPParameter($name);
        if ($type !== null) {
            $parameter->setType($type);
        }
        if ($sinceVersion !== null || $removedVersion !== null) {
            $parameter->initStubsMetadata()->setSinceVersion($sinceVersion);
            $parameter->initStubsMetadata()->setRemovedVersion($removedVersion);
        }

        return $parameter;
    }

    /**
     * Create a StandaloneType with the given type name.
     */
    protected function createType(string $typeName): StandaloneType
    {
        return new StandaloneType($typeName);
    }

    /**
     * Create a mock type that returns a string representation.
     */
    protected function createMockType(string $typeString): object
    {
        return new class($typeString) {
            public function __construct(private readonly string $typeName) {}
            public function __toString(): string { return $this->typeName; }
            public function getTypeName(): string { return $this->typeName; }
        };
    }

    /**
     * Create a UnionType with the given types (e.g., 'string|int').
     */
    protected function createUnionType(string ...$types): UnionType
    {
        $unionType = new UnionType();
        foreach ($types as $type) {
            $unionType->addType(new StandaloneType($type));
        }
        return $unionType;
    }

    /**
     * Create a NullableType with the given base type (e.g., '?string').
     */
    protected function createNullableType(string $baseType): NullableType
    {
        return new NullableType(new StandaloneType($baseType));
    }

    /**
     * Convert a string access modifier to an AccessModifier object.
     * Helper for test compatibility.
     *
     * @param string $access One of: 'public', 'protected', 'private'
     * @return AccessModifier
     */
    protected function createAccessModifier(string $access): AccessModifier
    {
        return match ($access) {
            'private' => AccessModifier::PRIVATE,
            'protected' => AccessModifier::PROTECTED,
            default => AccessModifier::PUBLIC,
        };
    }

    /**
     * Create a mock ReflectionProviderInterface that returns the given storage manager.
     *
     * @param array $functions Array of PHPFunction mocks to return
     * @param array $classes Array of PHPClass mocks to return
     * @return ReflectionProviderInterface
     */
    protected function createMockReflectionProvider(array $functions = [], array $classes = []): ReflectionProviderInterface
    {
        $provider = $this->createMock(ReflectionProviderInterface::class);
        $manager = $this->createMockStorageManager();

        $manager->method('getFunctions')->willReturn($functions);
        $manager->method('getClasses')->willReturn($classes);

        $provider->method('getReflection')->willReturn($manager);

        return $provider;
    }

    /**
     * Create a mock ReflectionProvider returning storage with the given classes.
     */
    protected function createMockReflectionProviderWithClasses(array $classes = []): ReflectionProviderInterface
    {
        $provider = $this->createMock(ReflectionProviderInterface::class);
        $manager  = $this->createMockStorageManager();
        $manager->method('getClasses')->willReturn($classes);
        $provider->method('getReflection')->willReturn($manager);
        return $provider;
    }

    /**
     * Create a mock ReflectionProvider returning storage with the given interfaces.
     */
    protected function createMockReflectionProviderWithInterfaces(array $interfaces = []): ReflectionProviderInterface
    {
        $provider = $this->createMock(ReflectionProviderInterface::class);
        $manager  = $this->createMockStorageManager();
        $manager->method('getInterfaces')->willReturn($interfaces);
        $provider->method('getReflection')->willReturn($manager);
        return $provider;
    }

    /**
     * Create a mock ReflectionProvider returning storage with the given enums.
     */
    protected function createMockReflectionProviderWithEnums(array $enums = []): ReflectionProviderInterface
    {
        $provider = $this->createMock(ReflectionProviderInterface::class);
        $manager  = $this->createMockStorageManager();
        $manager->method('getEnums')->willReturn($enums);
        $provider->method('getReflection')->willReturn($manager);
        return $provider;
    }

    // ── Universal make* helpers (real objects, not mocks) ─────────────────────

    /**
     * Create a real PHPMethod with all optional metadata.
     */
    protected function makeMethod(
        string $name,
        mixed $returnType = null,
        array $parameters = [],
        ?string $sinceVersion = null,
        ?string $removedVersion = null,
        string $access = 'public',
        bool $isFinal = false,
        bool $isStatic = false,
        bool $isDeprecated = false,
        bool $isTentative = false,
    ): PHPMethod {
        $method = new PHPMethod();
        $method->setName($name);
        if ($returnType !== null) {
            $method->setReturnTypeFromSignature($returnType);
        }
        $method->setParameters($parameters);
        $method->setAccess($this->createAccessModifier($access));
        $method->setIsFinal($isFinal);
        $method->setIsStatic($isStatic);
        $method->setDeprecated($isDeprecated);
        $method->setHasTentativeReturnType($isTentative);
        if ($sinceVersion !== null || $removedVersion !== null) {
            $method->initStubsMetadata()->setSinceVersion($sinceVersion);
            $method->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        return $method;
    }

    /**
     * Create a real PHPParameter with all optional metadata.
     */
    protected function makeParam(
        string $name,
        mixed $type = null,
        ?string $sinceVersion = null,
        ?string $removedVersion = null,
        bool $optional = false,
        bool $variadic = false,
        bool $deprecated = false,
        bool $hasDefaultValue = false,
        mixed $defaultValue = null,
        ?array $languageLevelTypes = null,
        ?string $defaultType = null,
    ): PHPParameter {
        $param = new PHPParameter($name);
        if ($type !== null) {
            $param->setType($type);
        }
        $param->setIsOptional($optional);
        $param->setIsVariadic($variadic);
        $param->setDeprecated($deprecated);
        $param->setHasDefaultValue($hasDefaultValue);
        if ($defaultValue !== null) {
            $param->setDefaultValue($defaultValue);
        }
        if ($sinceVersion !== null || $removedVersion !== null) {
            $param->initStubsMetadata()->setSinceVersion($sinceVersion);
            $param->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        if ($languageLevelTypes !== null) {
            $param->initStubsMetadata()->setLanguageLevelTypes($languageLevelTypes);
        }
        if ($defaultType !== null) {
            $param->initStubsMetadata()->setDefaultType($defaultType);
        }
        return $param;
    }

    /**
     * Create a real PHPInterface with all optional metadata.
     */
    protected function makeInterface(
        string $id,
        array $methods = [],
        array $parentInterfaces = [],
        array $constants = [],
        ?string $namespace = null,
    ): PHPInterface {
        $interface = new PHPInterface();
        $interface->setId($id);
        $interface->setName(ltrim($id, '\\'));
        $interface->setMethods($methods);
        $interface->setParentInterfaces($parentInterfaces);
        $interface->setConstants($constants);
        if ($namespace !== null) {
            $interface->setNamespace($namespace);
        }
        return $interface;
    }

    /**
     * Create a real PHPEnum with all optional metadata.
     */
    protected function makeEnum(
        string $id,
        array $methods = [],
        array $interfaces = [],
        array $constants = [],
        array $cases = [],
        ?string $namespace = null,
        bool $isFinal = false,
    ): PHPEnum {
        $enum = new PHPEnum();
        $enum->setId($id);
        $enum->setName(ltrim($id, '\\'));
        $enum->setMethods($methods);
        $enum->setImplementedInterfaces($interfaces);
        $enum->setConstants($constants);
        foreach ($cases as $case) {
            $enum->addCase($case);
        }
        if ($namespace !== null) {
            $enum->setNamespace($namespace);
        }
        $enum->setIsFinal($isFinal);
        return $enum;
    }

    /**
     * Create a real PHPClass with all optional metadata.
     */
    protected function makeClass(
        string $id,
        array $methods = [],
        array $constants = [],
        array $interfaces = [],
        array $properties = [],
        ?PHPClass $parentClass = null,
        ?string $namespace = null,
        bool $isFinal = false,
        bool $isReadonly = false,
        ?string $phpDoc = null,
    ): PHPClass {
        $class = new PHPClass();
        $class->setId($id);
        $class->setName(ltrim($id, '\\'));
        $class->setMethods($methods);
        $class->setConstants($constants);
        $class->setImplementedInterfaces($interfaces);
        $class->setProperties($properties);
        if ($parentClass !== null) {
            $class->setParentClass($parentClass);
        }
        if ($namespace !== null) {
            $class->setNamespace($namespace);
        }
        $class->setIsFinal($isFinal);
        $class->setIsReadonly($isReadonly);
        if ($phpDoc !== null) {
            $class->initStubsMetadata()->setPhpDoc($phpDoc);
        }
        return $class;
    }

    /**
     * Create a real PHPClassConstant with all optional metadata.
     */
    protected function makeClassConstant(
        string $name,
        mixed $value = null,
        AccessModifier $visibility = AccessModifier::PUBLIC,
        bool $isFinal = false,
        ?string $sinceVersion = null,
        ?string $removedVersion = null,
    ): PHPClassConstant {
        $constant = new PHPClassConstant();
        $constant->setName($name);
        $constant->setValue($value);
        $constant->setAccess($visibility);
        $constant->setIsFinal($isFinal);
        if ($sinceVersion !== null || $removedVersion !== null) {
            $constant->initStubsMetadata()->setSinceVersion($sinceVersion);
            $constant->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        return $constant;
    }

    /**
     * Create a real PHPConstant (global constant) with all optional metadata.
     */
    protected function makeGlobalConstant(
        string $id,
        mixed $value = null,
    ): PHPConstant {
        $constant = new PHPConstant();
        $constant->setId($id);
        $constant->setValue($value);
        return $constant;
    }
}
