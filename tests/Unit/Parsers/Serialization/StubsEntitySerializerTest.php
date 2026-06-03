<?php

namespace StubTests\Unit\Parsers\Serialization;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Parsers\Serializers\Stubs\StubsEntitySerializer;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;

class StubsEntitySerializerTest extends TestCase
{
    private StubsEntitySerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new StubsEntitySerializer();
    }

    public function testSerializeClassWithStubMetadata(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setNamespace('Test\\Namespace');
        $class->setId('Test\\Namespace\\TestClass');
        $class->setIsFinal(true);
        $class->setIsReadonly(false);
        $class->initStubsMetadata()->setSourcePath('/path/to/file.php');
        $class->initStubsMetadata()->setDuplicates([]);
        $class->initStubsMetadata()->setPhpDoc('/** @deprecated This class is deprecated */');
        $class->initStubsMetadata()->setSinceVersion('8.0');
        $class->initStubsMetadata()->setRemovedVersion('9.0');

        $result = $this->serializer->serialize($class);

        self::assertEquals('PHPClass', $result['_type']);
        self::assertEquals('TestClass', $result['name']);
        self::assertEquals('Test\\Namespace', $result['namespace']);
        self::assertTrue($result['isFinal']);
        self::assertEquals('/** @deprecated This class is deprecated */', $result['phpDoc']);
        self::assertEquals('8.0', $result['sinceVersion']);
        self::assertEquals('9.0', $result['removedVersion']);
        self::assertIsArray($result['methods']);
        self::assertIsArray($result['properties']);
        self::assertIsArray($result['constants']);
    }

    public function testSerializeMethodWithStubMetadata(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('TestClass');

        $method = new PHPMethod();
        $method->setName('testMethod');
        $method->setIsStatic(false);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setDeprecated(true);
        $method->setAccess(AccessModifier::PUBLIC);
        $method->setParameters([]);

        $returnType = new StandaloneType('string');
        $method->setReturnTypeFromSignature($returnType);
        $method->setHasTentativeReturnType(false);

        // Stub-specific metadata
        $method->initStubsMetadata()->setPhpDoc('/** @return string The result */');
        $method->initStubsMetadata()->setSinceVersion('7.4');
        $method->initStubsMetadata()->setRemovedVersion(null);
        $method->initStubsMetadata()->setTypeFromPhpDoc('string|false');
        $method->initStubsMetadata()->setLanguageLevelTypes(['8.0' => 'string', '7.4' => 'string|false']);
        $method->initStubsMetadata()->setDefaultType('string');

        $class->addMethod($method);

        $result = $this->serializer->serialize($class);

        self::assertCount(1, $result['methods']);
        $methodData = $result['methods'][0];

        self::assertEquals('testMethod', $methodData['name']);
        self::assertTrue($methodData['isDeprecated']);
        self::assertEquals('string', $methodData['returnType']);
        self::assertEquals('/** @return string The result */', $methodData['phpDoc']);
        self::assertEquals('7.4', $methodData['sinceVersion']);
        self::assertNull($methodData['removedVersion']);
        self::assertEquals('string|false', $methodData['returnTypeFromPhpDoc']);
        self::assertIsArray($methodData['languageLevelTypes']);
        self::assertEquals('string', $methodData['defaultType']);
    }

    public function testSerializeParameterWithStubMetadata(): void
    {
        $method = new PHPMethod();
        $method->setName('testMethod');
        $method->setAccess(AccessModifier::PUBLIC);
        $method->setIsStatic(false);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setReturnTypeFromSignature(new NoType());

        $param = new PHPParameter('testParam');
        $param->setPosition(0);
        $param->setIsOptional(true);
        $param->setIsVariadic(false);
        $param->setIsPassedByReference(false);
        $param->setHasDefaultValue(true);
        $param->setDefaultValue(null);
        $param->setType(new StandaloneType('?string'));

        // Stub-specific metadata
        $param->initStubsMetadata()->setTypeFromPhpDoc('string|null');
        $param->initStubsMetadata()->setLanguageLevelTypes(['8.0' => '?string', '7.4' => 'string']);
        $param->initStubsMetadata()->setDefaultType('string');
        $param->initStubsMetadata()->setSinceVersion('8.0');
        $param->initStubsMetadata()->setRemovedVersion(null);

        $method->setParameters([$param]);

        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('TestClass');
        $class->addMethod($method);

        $result = $this->serializer->serialize($class);

        $parameters = $result['methods'][0]['parameters'];
        self::assertCount(1, $parameters);

        $paramData = $parameters[0];
        self::assertEquals('testParam', $paramData['name']);
        self::assertEquals('?string', $paramData['type']);
        self::assertEquals('string|null', $paramData['typeFromPhpDoc']);
        self::assertIsArray($paramData['languageLevelTypes']);
        self::assertEquals('string', $paramData['defaultType']);
        self::assertEquals('8.0', $paramData['sinceVersion']);
        self::assertNull($paramData['removedVersion']);
    }

    public function testSerializePropertyWithStubMetadata(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('TestClass');

        $property = new PHPProperty();
        $property->setName('testProperty');
        $property->setIsStatic(false);
        $property->setIsReadonly(true);
        $property->setAccess(AccessModifier::PROTECTED);
        $property->setTypeFromSignature(new StandaloneType('int'));

        // Stub-specific metadata
        $property->initStubsMetadata()->setPhpDoc('/** @var int The counter */');
        $property->initStubsMetadata()->setSinceVersion('8.1');
        $property->initStubsMetadata()->setRemovedVersion(null);
        $property->initStubsMetadata()->setTypeFromPhpDoc('int|null');
        $property->initStubsMetadata()->setLanguageLevelTypes(['8.1' => 'int']);
        $property->initStubsMetadata()->setDefaultType('int');

        $class->addProperty($property);

        $result = $this->serializer->serialize($class);

        self::assertCount(1, $result['properties']);
        $propertyData = $result['properties'][0];

        self::assertEquals('testProperty', $propertyData['name']);
        self::assertEquals('int', $propertyData['type']);
        self::assertEquals('/** @var int The counter */', $propertyData['phpDoc']);
        self::assertEquals('8.1', $propertyData['sinceVersion']);
        self::assertNull($propertyData['removedVersion']);
        self::assertEquals('int|null', $propertyData['typeFromPhpDoc']);
        self::assertIsArray($propertyData['languageLevelTypes']);
        self::assertEquals('int', $propertyData['defaultType']);
    }

    public function testSerializeFunctionWithStubMetadata(): void
    {
        $function = new PHPFunction();
        $function->setName('testFunction');
        $function->setNamespace('Test\\Namespace');
        $function->setId('Test\\Namespace\\testFunction');
        $function->setDeprecated(false);
        $function->initStubsMetadata()->setSourcePath('/path/to/file.php');
        $function->initStubsMetadata()->setDuplicates([]);
        $function->setHasTentativeReturnType(false);

        $returnType = new StandaloneType('bool');
        $function->setReturnTypeFromSignature($returnType);
        $function->setParameters([]);

        // Stub-specific metadata
        $function->initStubsMetadata()->setPhpDoc('/** @return bool Success status */');
        $function->initStubsMetadata()->setSinceVersion('7.0');
        $function->initStubsMetadata()->setRemovedVersion(null);
        $function->initStubsMetadata()->setTypeFromPhpDoc('bool');
        $function->initStubsMetadata()->setLanguageLevelTypes(['8.0' => 'bool', '7.0' => 'bool']);
        $function->initStubsMetadata()->setDefaultType('bool');

        $result = $this->serializer->serialize($function);

        self::assertEquals('PHPFunction', $result['_type']);
        self::assertEquals('testFunction', $result['name']);
        self::assertEquals('bool', $result['returnType']);
        self::assertEquals('/** @return bool Success status */', $result['phpDoc']);
        self::assertEquals('7.0', $result['sinceVersion']);
        self::assertNull($result['removedVersion']);
        self::assertEquals('bool', $result['returnTypeFromPhpDoc']);
        self::assertIsArray($result['languageLevelTypes']);
        self::assertEquals('bool', $result['defaultType']);
    }

    public function testSerializeInterfaceWithStubMetadata(): void
    {
        $interface = new PHPInterface();
        $interface->setName('TestInterface');
        $interface->setNamespace('Test\\Namespace');
        $interface->setId('Test\\Namespace\\TestInterface');
        $interface->initStubsMetadata()->setSourcePath('/path/to/file.php');
        $interface->initStubsMetadata()->setDuplicates([]);

        // Stub-specific metadata
        $interface->initStubsMetadata()->setPhpDoc('/** @package Test */');
        $interface->initStubsMetadata()->setSinceVersion('8.0');
        $interface->initStubsMetadata()->setRemovedVersion(null);

        $result = $this->serializer->serialize($interface);

        self::assertEquals('PHPInterface', $result['_type']);
        self::assertEquals('TestInterface', $result['name']);
        self::assertEquals('/** @package Test */', $result['phpDoc']);
        self::assertEquals('8.0', $result['sinceVersion']);
        self::assertNull($result['removedVersion']);
    }

    public function testSerializeEnumWithStubMetadata(): void
    {
        $enum = new PHPEnum();
        $enum->setName('TestEnum');
        $enum->setNamespace('Test\\Namespace');
        $enum->setId('Test\\Namespace\\TestEnum');
        $enum->setIsFinal(true);
        $enum->setIsReadonly(false);
        $enum->initStubsMetadata()->setSourcePath('/path/to/file.php');
        $enum->initStubsMetadata()->setDuplicates([]);

        // Stub-specific metadata
        $enum->initStubsMetadata()->setPhpDoc('/** @package Test */');
        $enum->initStubsMetadata()->setSinceVersion('8.1');
        $enum->initStubsMetadata()->setRemovedVersion(null);

        $result = $this->serializer->serialize($enum);

        self::assertEquals('PHPEnum', $result['_type']);
        self::assertEquals('TestEnum', $result['name']);
        self::assertEquals('/** @package Test */', $result['phpDoc']);
        self::assertEquals('8.1', $result['sinceVersion']);
        self::assertNull($result['removedVersion']);
    }

    public function testSerializeConstantWithStubMetadata(): void
    {
        $constant = new PHPConstant();
        $constant->setName('TEST_CONSTANT');
        $constant->setNamespace('Test\\Namespace');
        $constant->setId('Test\\Namespace\\TEST_CONSTANT');
        $constant->setValue(42);
        $constant->initStubsMetadata()->setSourcePath('/path/to/file.php');
        $constant->initStubsMetadata()->setDuplicates([]);

        // Stub-specific metadata
        $constant->initStubsMetadata()->setPhpDoc('/** @var int */');
        $constant->initStubsMetadata()->setSinceVersion('7.0');
        $constant->initStubsMetadata()->setRemovedVersion('8.0');

        $result = $this->serializer->serialize($constant);

        self::assertEquals('PHPConstant', $result['_type']);
        self::assertEquals('TEST_CONSTANT', $result['name']);
        self::assertEquals(42, $result['value']);
        self::assertEquals('/** @var int */', $result['phpDoc']);
        self::assertEquals('7.0', $result['sinceVersion']);
        self::assertEquals('8.0', $result['removedVersion']);
    }

    public function testDeserializeClassWithStubMetadata(): void
    {
        $data = [
            '_type' => 'PHPClass',
            'name' => 'TestClass',
            'namespace' => 'Test\\Namespace',
            'id' => 'Test\\Namespace\\TestClass',
            'isFinal' => true,
            'isReadonly' => false,
            'sourcePath' => '/path/to/file.php',
            'duplicates' => [],
            'phpDoc' => '/** @deprecated */',
            'sinceVersion' => '8.0',
            'removedVersion' => null,
            'methods' => [],
            'properties' => [],
            'constants' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPClass::class, $result);
        self::assertEquals('TestClass', $result->getName());
        self::assertEquals('Test\\Namespace', $result->getNamespace());
        self::assertEquals('/** @deprecated */', $result->getStubsMetadata()?->getPhpDoc());
        self::assertEquals('8.0', $result->getStubsMetadata()?->getSinceVersion());
        self::assertNull($result->getStubsMetadata()?->getRemovedVersion());
    }

    public function testDeserializeMethodWithStubMetadata(): void
    {
        $data = [
            '_type' => 'PHPClass',
            'name' => 'TestClass',
            'id' => 'TestClass',
            'methods' => [
                [
                    'name' => 'testMethod',
                    'isStatic' => false,
                    'isFinal' => false,
                    'isAbstract' => false,
                    'isDeprecated' => true,
                    'accessModifier' => 'public',
                    'parameters' => [],
                    'returnType' => 'string',
                    'hasTentativeReturnType' => false,
                    'phpDoc' => '/** @return string */',
                    'sinceVersion' => '7.4',
                    'removedVersion' => null,
                    'returnTypeFromPhpDoc' => 'string|false',
                    'languageLevelTypes' => ['8.0' => 'string'],
                    'defaultType' => 'string'
                ]
            ],
            'properties' => [],
            'constants' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPClass::class, $result);
        self::assertCount(1, $result->getMethods());

        $method = $result->getMethods()[0];
        self::assertEquals('testMethod', $method->getName());
        self::assertTrue($method->isDeprecated());
        self::assertEquals('/** @return string */', $method->getStubsMetadata()?->getPhpDoc());
        self::assertEquals('7.4', $method->getStubsMetadata()?->getSinceVersion());
        self::assertNull($method->getStubsMetadata()?->getRemovedVersion());
        self::assertEquals('string|false', $method->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertIsArray($method->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('string', $method->getStubsMetadata()->getDefaultType());
    }

    public function testDeserializeParameterWithStubMetadata(): void
    {
        $data = [
            '_type' => 'PHPClass',
            'name' => 'TestClass',
            'id' => 'TestClass',
            'methods' => [
                [
                    'name' => 'testMethod',
                    'isStatic' => false,
                    'isFinal' => false,
                    'isAbstract' => false,
                    'isDeprecated' => false,
                    'accessModifier' => 'public',
                    'parameters' => [
                        [
                            'name' => 'param1',
                            'position' => 0,
                            'isOptional' => true,
                            'isVariadic' => false,
                            'isPassedByReference' => false,
                            'hasDefaultValue' => true,
                            'type' => '?string',
                            'defaultValue' => null,
                            'typeFromPhpDoc' => 'string|null',
                            'languageLevelTypes' => ['8.0' => '?string'],
                            'defaultType' => 'string',
                            'sinceVersion' => '8.0',
                            'removedVersion' => null
                        ]
                    ],
                    'returnType' => null,
                    'hasTentativeReturnType' => false
                ]
            ],
            'properties' => [],
            'constants' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertCount(1, $result->getMethods());
        $parameters = $result->getMethods()[0]->getParameters();
        self::assertCount(1, $parameters);

        $param = $parameters[0];
        self::assertEquals('param1', $param->getName());
        self::assertEquals('string|null', $param->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertIsArray($param->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('string', $param->getStubsMetadata()->getDefaultType());
        self::assertEquals('8.0', $param->getStubsMetadata()?->getSinceVersion());
        self::assertNull($param->getStubsMetadata()?->getRemovedVersion());
    }

    public function testDeserializePropertyWithStubMetadata(): void
    {
        $data = [
            '_type' => 'PHPClass',
            'name' => 'TestClass',
            'id' => 'TestClass',
            'methods' => [],
            'properties' => [
                [
                    'name' => 'testProperty',
                    'isStatic' => false,
                    'isReadonly' => true,
                    'accessModifier' => 'protected',
                    'type' => 'int',
                    'phpDoc' => '/** @var int */',
                    'sinceVersion' => '8.1',
                    'removedVersion' => null,
                    'typeFromPhpDoc' => 'int|null',
                    'languageLevelTypes' => ['8.1' => 'int'],
                    'defaultType' => 'int'
                ]
            ],
            'constants' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertCount(1, $result->getProperties());

        $property = $result->getProperties()[0];
        self::assertEquals('testProperty', $property->getName());
        self::assertEquals('/** @var int */', $property->getStubsMetadata()?->getPhpDoc());
        self::assertEquals('8.1', $property->getStubsMetadata()?->getSinceVersion());
        self::assertNull($property->getStubsMetadata()?->getRemovedVersion());
        self::assertEquals('int|null', $property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertIsArray($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('int', $property->getStubsMetadata()->getDefaultType());
    }

    public function testDeserializeFunctionWithStubMetadata(): void
    {
        $data = [
            '_type' => 'PHPFunction',
            'name' => 'testFunction',
            'namespace' => 'Test\\Namespace',
            'id' => 'Test\\Namespace\\testFunction',
            'isDeprecated' => false,
            'returnType' => 'bool',
            'sourcePath' => '/path/to/file.php',
            'duplicates' => [],
            'hasTentativeReturnType' => false,
            'parameters' => [],
            'phpDoc' => '/** @return bool */',
            'sinceVersion' => '7.0',
            'removedVersion' => null,
            'returnTypeFromPhpDoc' => 'bool',
            'languageLevelTypes' => ['8.0' => 'bool'],
            'defaultType' => 'bool'
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPFunction::class, $result);
        self::assertEquals('testFunction', $result->getName());
        self::assertEquals('/** @return bool */', $result->getStubsMetadata()?->getPhpDoc());
        self::assertEquals('7.0', $result->getStubsMetadata()?->getSinceVersion());
        self::assertNull($result->getStubsMetadata()?->getRemovedVersion());
        self::assertEquals('bool', $result->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertIsArray($result->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('bool', $result->getStubsMetadata()->getDefaultType());
    }

    public function testDeserializeConstantWithStubMetadata(): void
    {
        $data = [
            '_type' => 'PHPConstant',
            'name' => 'TEST_CONSTANT',
            'namespace' => 'Test\\Namespace',
            'id' => 'Test\\Namespace\\TEST_CONSTANT',
            'value' => 42,
            'sourcePath' => '/path/to/file.php',
            'duplicates' => [],
            'phpDoc' => '/** @var int */',
            'sinceVersion' => '7.0',
            'removedVersion' => '8.0'
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPConstant::class, $result);
        self::assertEquals('TEST_CONSTANT', $result->getName());
        self::assertEquals('/** @var int */', $result->getStubsMetadata()?->getPhpDoc());
        self::assertEquals('7.0', $result->getStubsMetadata()?->getSinceVersion());
        self::assertEquals('8.0', $result->getStubsMetadata()?->getRemovedVersion());
    }

    public function testRoundTripSerializationClassWithStubMetadata(): void
    {
        $class = new PHPClass();
        $class->setName('RoundTripClass');
        $class->setNamespace('Test');
        $class->setId('Test\\RoundTripClass');
        $class->setIsFinal(true);
        $class->setIsReadonly(false);
        $class->initStubsMetadata()->setPhpDoc('/** @since 8.0 */');
        $class->initStubsMetadata()->setSinceVersion('8.0');
        $class->initStubsMetadata()->setRemovedVersion(null);

        $method = new PHPMethod();
        $method->setName('testMethod');
        $method->setAccess(AccessModifier::PUBLIC);
        $method->setIsStatic(false);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setReturnTypeFromSignature(new StandaloneType('string'));
        $method->setParameters([]);
        $method->initStubsMetadata()->setPhpDoc('/** @return string */');
        $method->initStubsMetadata()->setSinceVersion('8.0');
        $class->addMethod($method);

        // Serialize then deserialize
        $serialized = $this->serializer->serialize($class);
        $deserialized = $this->serializer->deserialize($serialized);

        self::assertInstanceOf(PHPClass::class, $deserialized);
        self::assertEquals($class->getName(), $deserialized->getName());
        self::assertEquals($class->getStubsMetadata()?->getPhpDoc(), $deserialized->getStubsMetadata()?->getPhpDoc());
        self::assertEquals($class->getStubsMetadata()?->getSinceVersion(), $deserialized->getStubsMetadata()?->getSinceVersion());
        self::assertCount(1, $deserialized->getMethods());
        self::assertEquals('testMethod', $deserialized->getMethods()[0]->getName());
        self::assertEquals('/** @return string */', $deserialized->getMethods()[0]->getStubsMetadata()?->getPhpDoc());
        self::assertEquals('8.0', $deserialized->getMethods()[0]->getStubsMetadata()?->getSinceVersion());
    }

    public function testRoundTripSerializationFunctionWithStubMetadata(): void
    {
        $function = new PHPFunction();
        $function->setName('roundTripFunction');
        $function->setNamespace('Test');
        $function->setId('Test\\roundTripFunction');
        $function->setDeprecated(false);
        $function->setHasTentativeReturnType(false);
        $function->setReturnTypeFromSignature(new StandaloneType('void'));
        $function->initStubsMetadata()->setPhpDoc('/** @return void */');
        $function->initStubsMetadata()->setSinceVersion('7.4');
        $function->initStubsMetadata()->setRemovedVersion(null);
        $function->initStubsMetadata()->setTypeFromPhpDoc('void');
        $function->initStubsMetadata()->setLanguageLevelTypes(['8.0' => 'void']);
        $function->initStubsMetadata()->setDefaultType('void');

        $param = new PHPParameter('arg1');
        $param->setPosition(0);
        $param->setIsOptional(false);
        $param->setType(new StandaloneType('string'));
        $param->initStubsMetadata()->setTypeFromPhpDoc('string');
        $param->initStubsMetadata()->setSinceVersion('7.4');
        $function->setParameters([$param]);

        // Serialize then deserialize
        $serialized = $this->serializer->serialize($function);
        $deserialized = $this->serializer->deserialize($serialized);

        self::assertInstanceOf(PHPFunction::class, $deserialized);
        self::assertEquals($function->getName(), $deserialized->getName());
        self::assertEquals($function->getStubsMetadata()?->getPhpDoc(), $deserialized->getStubsMetadata()?->getPhpDoc());
        self::assertEquals($function->getStubsMetadata()?->getSinceVersion(), $deserialized->getStubsMetadata()?->getSinceVersion());
        self::assertEquals($function->getStubsMetadata()->getTypeFromPhpDoc(), $deserialized->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertCount(1, $deserialized->getParameters());
        self::assertEquals('arg1', $deserialized->getParameters()[0]->getName());
        self::assertEquals('string', $deserialized->getParameters()[0]->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertEquals('7.4', $deserialized->getParameters()[0]->getStubsMetadata()?->getSinceVersion());
    }

    public function testSerializeUnknownEntityType(): void
    {
        $unknown = new \stdClass();
        $unknown->someProperty = 'test';

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Cannot serialize unknown entity type: stdClass');

        $this->serializer->serialize($unknown);
    }
}
