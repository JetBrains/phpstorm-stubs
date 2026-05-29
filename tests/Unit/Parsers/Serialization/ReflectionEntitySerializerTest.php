<?php

namespace StubTests\Unit\Parsers\Serialization;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Parsers\Serializers\Reflection\ReflectionEntitySerializer;
use PHPUnit\Framework\TestCase;
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
use StubTests\Framework\Parsers\Model\Types\StandaloneType;

class ReflectionEntitySerializerTest extends TestCase
{
    private ReflectionEntitySerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new ReflectionEntitySerializer();
    }

    public function testSerializeSimpleClass(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setNamespace('Test\\Namespace');
        $class->setId('Test\\Namespace\\TestClass');
        $class->setIsFinal(true);
        $class->setIsReadonly(false);
        $result = $this->serializer->serialize($class);

        self::assertEquals('PHPClass', $result['_type']);
        self::assertEquals('TestClass', $result['name']);
        self::assertEquals('Test\\Namespace', $result['namespace']);
        self::assertEquals('Test\\Namespace\\TestClass', $result['id']);
        self::assertTrue($result['isFinal']);
        self::assertFalse($result['isReadonly']);
        self::assertIsArray($result['methods']);
        self::assertIsArray($result['properties']);
        self::assertIsArray($result['constants']);
        self::assertEmpty($result['methods']);
        self::assertEmpty($result['properties']);
        self::assertEmpty($result['constants']);
    }

    public function testSerializeClassWithMethod(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('TestClass');

        $method = new PHPMethod();
        $method->setName('testMethod');
        $method->setIsStatic(true);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setDeprecated(false);
        $method->setAccess(AccessModifier::PUBLIC);
        $method->setParameters([]);

        $returnType = new StandaloneType('string');
        $method->setReturnTypeFromSignature($returnType);
        $method->setHasTentativeReturnType(false);

        $class->addMethod($method);

        $result = $this->serializer->serialize($class);

        self::assertCount(1, $result['methods']);
        self::assertEquals('testMethod', $result['methods'][0]['name']);
        self::assertTrue($result['methods'][0]['isStatic']);
        self::assertFalse($result['methods'][0]['isFinal']);
        self::assertFalse($result['methods'][0]['isAbstract']);
        self::assertFalse($result['methods'][0]['isDeprecated']);
        self::assertEquals('public', $result['methods'][0]['accessModifier']);
        self::assertEquals('string', $result['methods'][0]['returnType']);
        self::assertFalse($result['methods'][0]['hasTentativeReturnType']);
        self::assertIsArray($result['methods'][0]['parameters']);
    }

    public function testSerializeMethodWithAccessModifiers(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('TestClass');

        // Test private method
        $privateMethod = new PHPMethod();
        $privateMethod->setName('privateMethod');
        $privateMethod->setAccess(AccessModifier::PRIVATE);
        $privateMethod->setIsStatic(false);
        $privateMethod->setIsFinal(false);
        $privateMethod->setIsAbstract(false);
        $privateMethod->setParameters([]);
        $privateMethod->setReturnTypeFromSignature(new NoType());
        $class->addMethod($privateMethod);

        // Test protected method
        $protectedMethod = new PHPMethod();
        $protectedMethod->setName('protectedMethod');
        $protectedMethod->setAccess(AccessModifier::PROTECTED);
        $protectedMethod->setIsStatic(false);
        $protectedMethod->setIsFinal(false);
        $protectedMethod->setIsAbstract(false);
        $protectedMethod->setParameters([]);
        $protectedMethod->setReturnTypeFromSignature(new NoType());
        $class->addMethod($protectedMethod);

        $result = $this->serializer->serialize($class);

        self::assertEquals('private', $result['methods'][0]['accessModifier']);
        self::assertEquals('protected', $result['methods'][1]['accessModifier']);
    }

    public function testSerializeMethodWithParameters(): void
    {
        $method = new PHPMethod();
        $method->setName('testMethod');
        $method->setIsStatic(false);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setAccess(AccessModifier::PUBLIC);
        $method->setReturnTypeFromSignature(new NoType());

        $param = new PHPParameter('testParam');
        $param->setPosition(0);
        $param->setIsOptional(true);
        $param->setIsVariadic(false);
        $param->setIsPassedByReference(false);
        $param->setHasDefaultValue(true);
        $param->setDefaultValue('default');
        $param->setType(new StandaloneType('string'));

        $method->setParameters([$param]);

        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('TestClass');
        $class->addMethod($method);

        $result = $this->serializer->serialize($class);

        $parameters = $result['methods'][0]['parameters'];
        self::assertCount(1, $parameters);
        self::assertEquals('testParam', $parameters[0]['name']);
        self::assertEquals(0, $parameters[0]['position']);
        self::assertTrue($parameters[0]['isOptional']);
        self::assertFalse($parameters[0]['isVariadic']);
        self::assertFalse($parameters[0]['isPassedByReference']);
        self::assertTrue($parameters[0]['hasDefaultValue']);
        self::assertEquals('default', $parameters[0]['defaultValue']);
        self::assertEquals('string', $parameters[0]['type']);
    }

    public function testSerializeClassWithProperty(): void
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

        $class->addProperty($property);

        $result = $this->serializer->serialize($class);

        self::assertCount(1, $result['properties']);
        self::assertEquals('testProperty', $result['properties'][0]['name']);
        self::assertFalse($result['properties'][0]['isStatic']);
        self::assertTrue($result['properties'][0]['isReadonly']);
        self::assertEquals('protected', $result['properties'][0]['accessModifier']);
        self::assertEquals('int', $result['properties'][0]['type']);
    }

    public function testSerializeClassWithConstant(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('TestClass');

        $constant = new PHPClassConstant();
        $constant->setName('TEST_CONSTANT');
        $constant->setValue('test_value');
        $constant->setAccess(AccessModifier::PUBLIC);
        $constant->setIsFinal(true);

        $class->addConstant($constant);

        $result = $this->serializer->serialize($class);

        self::assertCount(1, $result['constants']);
        self::assertEquals('TEST_CONSTANT', $result['constants'][0]['name']);
        self::assertEquals('test_value', $result['constants'][0]['value']);
        self::assertEquals('public', $result['constants'][0]['visibility']);
        self::assertTrue($result['constants'][0]['isFinal']);
    }

    public function testSerializeFunction(): void
    {
        $function = new PHPFunction();
        $function->setName('testFunction');
        $function->setNamespace('Test\\Namespace');
        $function->setId('Test\\Namespace\\testFunction');
        $function->setDeprecated(false);
        $function->setHasTentativeReturnType(true);

        $returnType = new StandaloneType('bool');
        $function->setReturnTypeFromSignature($returnType);
        $function->setParameters([]);

        $result = $this->serializer->serialize($function);

        self::assertEquals('PHPFunction', $result['_type']);
        self::assertEquals('testFunction', $result['name']);
        self::assertEquals('Test\\Namespace', $result['namespace']);
        self::assertEquals('Test\\Namespace\\testFunction', $result['id']);
        self::assertFalse($result['isDeprecated']);
        self::assertEquals('bool', $result['returnType']);
        self::assertTrue($result['hasTentativeReturnType']);
        self::assertIsArray($result['parameters']);
    }

    public function testSerializeInterface(): void
    {
        $interface = new PHPInterface();
        $interface->setName('TestInterface');
        $interface->setNamespace('Test\\Namespace');
        $interface->setId('Test\\Namespace\\TestInterface');
        $method = new PHPMethod();
        $method->setName('interfaceMethod');
        $method->setIsStatic(false);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setAccess(AccessModifier::PUBLIC);
        $method->setParameters([]);
        $method->setReturnTypeFromSignature(new NoType());
        $interface->addMethod($method);

        $constant = new PHPClassConstant();
        $constant->setName('INTERFACE_CONSTANT');
        $constant->setValue(123);
        $interface->addConstant($constant);

        $result = $this->serializer->serialize($interface);

        self::assertEquals('PHPInterface', $result['_type']);
        self::assertEquals('TestInterface', $result['name']);
        self::assertEquals('Test\\Namespace', $result['namespace']);
        self::assertEquals('Test\\Namespace\\TestInterface', $result['id']);
        self::assertCount(1, $result['methods']);
        self::assertCount(1, $result['constants']);
        self::assertEquals('interfaceMethod', $result['methods'][0]['name']);
        self::assertEquals('INTERFACE_CONSTANT', $result['constants'][0]['name']);
    }

    public function testSerializeEnum(): void
    {
        $enum = new PHPEnum();
        $enum->setName('TestEnum');
        $enum->setNamespace('Test\\Namespace');
        $enum->setId('Test\\Namespace\\TestEnum');
        $enum->setIsFinal(true);
        $enum->setIsReadonly(false);
        $result = $this->serializer->serialize($enum);

        self::assertEquals('PHPEnum', $result['_type']);
        self::assertEquals('TestEnum', $result['name']);
        self::assertEquals('Test\\Namespace', $result['namespace']);
        self::assertTrue($result['isFinal']);
        self::assertIsArray($result['methods']);
        self::assertIsArray($result['interfaces']);
    }

    public function testSerializeConstant(): void
    {
        $constant = new PHPConstant();
        $constant->setName('TEST_CONSTANT');
        $constant->setNamespace('Test\\Namespace');
        $constant->setId('Test\\Namespace\\TEST_CONSTANT');
        $constant->setValue(42);
        $result = $this->serializer->serialize($constant);

        self::assertEquals('PHPConstant', $result['_type']);
        self::assertEquals('TEST_CONSTANT', $result['name']);
        self::assertEquals('Test\\Namespace', $result['namespace']);
        self::assertEquals(42, $result['value']);
    }

    public function testSerializeUnknownEntityType(): void
    {
        $unknown = new \stdClass();
        $unknown->someProperty = 'test';

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Cannot serialize unknown entity type: stdClass');

        $this->serializer->serialize($unknown);
    }

    public function testDeserializeClass(): void
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
            'methods' => [],
            'properties' => [],
            'constants' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPClass::class, $result);
        self::assertEquals('TestClass', $result->getName());
        self::assertEquals('Test\\Namespace', $result->getNamespace());
        self::assertEquals('Test\\Namespace\\TestClass', $result->getId());
        self::assertTrue($result->isFinal());
        self::assertFalse($result->isReadonly());
    }

    public function testDeserializeClassWithMethod(): void
    {
        $data = [
            '_type' => 'PHPClass',
            'name' => 'TestClass',
            'id' => 'TestClass',
            'methods' => [
                [
                    'name' => 'testMethod',
                    'isStatic' => true,
                    'isFinal' => false,
                    'isAbstract' => false,
                    'isDeprecated' => false,
                    'accessModifier' => 'protected',
                    'parameters' => [],
                    'returnType' => null,  // null instead of string to avoid type conversion issues
                    'hasTentativeReturnType' => false
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
        self::assertTrue($method->isStatic());
        self::assertFalse($method->isFinal());
        self::assertFalse($method->isAbstract());
        self::assertFalse($method->isDeprecated());
        self::assertSame(AccessModifier::PROTECTED, $method->getAccess());
    }

    public function testDeserializeMethodWithParameters(): void
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
                            'defaultValue' => 'test'
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
        self::assertEquals(0, $param->getPosition());
        self::assertTrue($param->isOptional());
        self::assertFalse($param->isVariadic());
        self::assertFalse($param->isPassedByReference());
        self::assertTrue($param->hasDefaultValue());
        self::assertEquals('test', $param->getDefaultValue());
    }

    public function testDeserializeClassWithProperty(): void
    {
        $data = [
            '_type' => 'PHPClass',
            'name' => 'TestClass',
            'id' => 'TestClass',
            'methods' => [],
            'properties' => [
                [
                    'name' => 'testProperty',
                    'isStatic' => true,
                    'isReadonly' => false,
                    'accessModifier' => 'private',
                    'type' => null  // null to avoid type conversion issues
                ]
            ],
            'constants' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertCount(1, $result->getProperties());

        $property = $result->getProperties()[0];
        self::assertEquals('testProperty', $property->getName());
        self::assertTrue($property->isStatic());
        self::assertFalse($property->isReadonly());
        self::assertSame(AccessModifier::PRIVATE, $property->getAccess());
    }

    public function testDeserializeFunction(): void
    {
        $data = [
            '_type' => 'PHPFunction',
            'name' => 'testFunction',
            'namespace' => 'Test\\Namespace',
            'id' => 'Test\\Namespace\\testFunction',
            'isDeprecated' => true,
            'returnType' => null,  // null to avoid type conversion issues
            'sourcePath' => '/path/to/file.php',
            'duplicates' => [],
            'hasTentativeReturnType' => false,
            'parameters' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPFunction::class, $result);
        self::assertEquals('testFunction', $result->getName());
        self::assertEquals('Test\\Namespace', $result->getNamespace());
        self::assertTrue($result->isDeprecated());
        self::assertFalse($result->hasTentativeReturnType());
    }

    public function testDeserializeInterface(): void
    {
        $data = [
            '_type' => 'PHPInterface',
            'name' => 'TestInterface',
            'namespace' => 'Test\\Namespace',
            'id' => 'Test\\Namespace\\TestInterface',
            'sourcePath' => '/path/to/file.php',
            'duplicates' => [],
            'methods' => [],
            'constants' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPInterface::class, $result);
        self::assertEquals('TestInterface', $result->getName());
        self::assertEquals('Test\\Namespace', $result->getNamespace());
    }

    public function testDeserializeEnum(): void
    {
        $data = [
            '_type' => 'PHPEnum',
            'name' => 'TestEnum',
            'namespace' => 'Test\\Namespace',
            'id' => 'Test\\Namespace\\TestEnum',
            'isFinal' => true,
            'isReadonly' => false,
            'sourcePath' => '/path/to/file.php',
            'duplicates' => [],
            'methods' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPEnum::class, $result);
        self::assertEquals('TestEnum', $result->getName());
        self::assertTrue($result->isFinal());
    }

    public function testDeserializeConstant(): void
    {
        $data = [
            '_type' => 'PHPConstant',
            'name' => 'TEST_CONSTANT',
            'namespace' => 'Test\\Namespace',
            'id' => 'Test\\Namespace\\TEST_CONSTANT',
            'value' => 'test_value',
            'sourcePath' => '/path/to/file.php',
            'duplicates' => []
        ];

        $result = $this->serializer->deserialize($data);

        self::assertInstanceOf(PHPConstant::class, $result);
        self::assertEquals('TEST_CONSTANT', $result->getName());
        self::assertEquals('test_value', $result->getValue());
    }

    public function testRoundTripSerializationClass(): void
    {
        $class = new PHPClass();
        $class->setName('RoundTripClass');
        $class->setNamespace('Test');
        $class->setId('Test\\RoundTripClass');
        $class->setIsFinal(true);
        $class->setIsReadonly(false);

        $method = new PHPMethod();
        $method->setName('testMethod');
        $method->setAccess(AccessModifier::PUBLIC);
        $method->setIsStatic(false);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setReturnTypeFromSignature(new StandaloneType('string'));
        $method->setParameters([]);
        $class->addMethod($method);

        $property = new PHPProperty();
        $property->setName('testProp');
        $property->setIsStatic(false);
        $property->setIsReadonly(false);
        $property->setAccess(AccessModifier::PRIVATE);
        $property->setTypeFromSignature(new StandaloneType('int'));
        $class->addProperty($property);

        // Serialize then deserialize
        $serialized = $this->serializer->serialize($class);
        $deserialized = $this->serializer->deserialize($serialized);

        self::assertInstanceOf(PHPClass::class, $deserialized);
        self::assertEquals($class->getName(), $deserialized->getName());
        self::assertEquals($class->getNamespace(), $deserialized->getNamespace());
        self::assertEquals($class->isFinal(), $deserialized->isFinal());
        self::assertCount(1, $deserialized->getMethods());
        self::assertCount(1, $deserialized->getProperties());
        self::assertEquals('testMethod', $deserialized->getMethods()[0]->getName());
        self::assertEquals('testProp', $deserialized->getProperties()[0]->getName());
    }

    public function testRoundTripSerializationFunction(): void
    {
        $function = new PHPFunction();
        $function->setName('roundTripFunction');
        $function->setNamespace('Test');
        $function->setId('Test\\roundTripFunction');
        $function->setDeprecated(false);
        $function->setHasTentativeReturnType(true);
        $function->setReturnTypeFromSignature(new StandaloneType('void'));

        $param = new PHPParameter('arg1');
        $param->setPosition(0);
        $param->setIsOptional(false);
        $param->setType(new StandaloneType('string'));
        $function->setParameters([$param]);

        // Serialize then deserialize
        $serialized = $this->serializer->serialize($function);
        $deserialized = $this->serializer->deserialize($serialized);

        self::assertInstanceOf(PHPFunction::class, $deserialized);
        self::assertEquals($function->getName(), $deserialized->getName());
        self::assertEquals($function->getNamespace(), $deserialized->getNamespace());
        self::assertFalse($deserialized->isDeprecated());
        self::assertTrue($deserialized->hasTentativeReturnType());
        self::assertCount(1, $deserialized->getParameters());
        self::assertEquals('arg1', $deserialized->getParameters()[0]->getName());
    }
}
