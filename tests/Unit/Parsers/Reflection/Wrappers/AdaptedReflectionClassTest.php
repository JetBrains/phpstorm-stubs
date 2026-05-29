<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassReference;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionMethod;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionProperty;

class AdaptedReflectionClassTest extends TestCase
{
    // Basic extraction tests

    public function testItExtractsClassName()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getName')->willReturn('TestClass');

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertEquals('TestClass', $adapted->getName());
    }

    public function testItExtractsShortName()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getShortName')->willReturn('TestClass');

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertEquals('TestClass', $adapted->getShortName());
    }

    public function testItExtractsNamespaceName()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getNamespaceName')->willReturn('Foo\\Bar');

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertEquals('Foo\\Bar', $adapted->getNamespaceName());
    }

    public function testItExtractsIsAbstract()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('isAbstract')->willReturn(true);

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertTrue($adapted->isAbstract());
    }

    public function testItExtractsIsFinal()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('isFinal')->willReturn(false);

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertFalse($adapted->isFinal());
    }

    public function testItExtractsIsInterface()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('isInterface')->willReturn(true);

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertTrue($adapted->isInterface());
    }

    public function testItExtractsIsTrait()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('isTrait')->willReturn(false);

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertFalse($adapted->isTrait());
    }

    public function testItExtractsIsInternal()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('isInternal')->willReturn(true);

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertTrue($adapted->isInternal());
    }

    public function testItExtractsIsInstantiable()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('isInstantiable')->willReturn(false);

        $adapted = new AdaptedReflectionClass($reflectionMock);

        self::assertFalse($adapted->isInstantiable());
    }

    // Complex extraction tests (postExtract)

    public function testItWrapsMethodsAsAdaptedReflectionMethod()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getName')->willReturn('testMethod');

        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getMethods')->willReturn([$methodMock]);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $methods = $adapted->getMethods();

        self::assertIsArray($methods);
        self::assertCount(1, $methods);
        self::assertInstanceOf(AdaptedReflectionMethod::class, $methods[0]);
    }

    public function testItWrapsPropertiesAsAdaptedReflectionProperty()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('getName')->willReturn('testProperty');

        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getProperties')->willReturn([$propertyMock]);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $properties = $adapted->getProperties();

        self::assertIsArray($properties);
        self::assertCount(1, $properties);
        self::assertInstanceOf(AdaptedReflectionProperty::class, $properties[0]);
    }

    public function testItWrapsParentClassAsAdaptedReflectionClassReference()
    {
        $parentMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parentMock->method('getName')->willReturn('ParentClass');

        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getParentClass')->willReturn($parentMock);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $parent = $adapted->getParentClass();

        self::assertInstanceOf(AdaptedReflectionClassReference::class, $parent);
        self::assertEquals('ParentClass', $parent->getName());
    }

    public function testItHandlesClassWithoutParent()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getParentClass')->willReturn(false);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $parent = $adapted->getParentClass();

        self::assertFalse($parent);
    }

    public function testItWrapsInterfacesAsAdaptedReflectionClassReference()
    {
        $interfaceMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $interfaceMock->method('getName')->willReturn('TestInterface');

        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getInterfaces')->willReturn([$interfaceMock]);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $interfaces = $adapted->getInterfaces();

        self::assertIsArray($interfaces);
        self::assertCount(1, $interfaces);
        self::assertInstanceOf(AdaptedReflectionClassReference::class, $interfaces[0]);
        self::assertEquals('TestInterface', $interfaces[0]->getName());
    }

    public function testItWrapsTraitsAsAdaptedReflectionClassReference()
    {
        $traitMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $traitMock->method('getName')->willReturn('TestTrait');

        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getTraits')->willReturn([$traitMock]);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $traits = $adapted->getTraits();

        self::assertIsArray($traits);
        self::assertCount(1, $traits);
        self::assertInstanceOf(AdaptedReflectionClassReference::class, $traits[0]);
        self::assertEquals('TestTrait', $traits[0]->getName());
    }

    public function testItWrapsConstructorAsAdaptedReflectionMethod()
    {
        $constructorMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constructorMock->method('getName')->willReturn('__construct');

        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getConstructor')->willReturn($constructorMock);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $constructor = $adapted->getConstructor();

        self::assertInstanceOf(AdaptedReflectionMethod::class, $constructor);
    }

    public function testItHandlesClassWithoutConstructor()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getConstructor')->willReturn(null);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $constructor = $adapted->getConstructor();

        self::assertNull($constructor);
    }

    public function testItExtractsDocComment()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getDocComment')->willReturn('/** Test doc comment */');

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $docComment = $adapted->getDocComment();

        self::assertEquals('/** Test doc comment */', $docComment);
    }

    public function testItHandlesClassWithoutDocComment()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getDocComment')->willReturn(false);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $docComment = $adapted->getDocComment();

        self::assertFalse($docComment);
    }

    public function testItExtractsInterfaceNames()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getInterfaceNames')->willReturn(['Interface1', 'Interface2']);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $interfaceNames = $adapted->getInterfaceNames();

        self::assertIsArray($interfaceNames);
        self::assertCount(2, $interfaceNames);
        self::assertContains('Interface1', $interfaceNames);
        self::assertContains('Interface2', $interfaceNames);
    }

    public function testItExtractsTraitNames()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getTraitNames')->willReturn(['Trait1', 'Trait2']);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $traitNames = $adapted->getTraitNames();

        self::assertIsArray($traitNames);
        self::assertCount(2, $traitNames);
        self::assertContains('Trait1', $traitNames);
        self::assertContains('Trait2', $traitNames);
    }

    // Edge case tests

    public function testItHandlesEmptyMethodsList()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getMethods')->willReturn([]);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $methods = $adapted->getMethods();

        self::assertIsArray($methods);
        self::assertCount(0, $methods);
    }

    public function testItHandlesEmptyPropertiesList()
    {
        $reflectionMock = $this->getMockBuilder(ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $reflectionMock->method('getProperties')->willReturn([]);

        $adapted = new AdaptedReflectionClass($reflectionMock);
        $properties = $adapted->getProperties();

        self::assertIsArray($properties);
        self::assertCount(0, $properties);
    }
}
