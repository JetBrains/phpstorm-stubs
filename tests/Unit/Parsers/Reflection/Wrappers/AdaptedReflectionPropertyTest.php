<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionProperty;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class AdaptedReflectionPropertyTest extends TestCase
{
    public function testItExtractsPropertyName()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('getName')->willReturn('testProperty');

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertEquals('testProperty', $adapted->getName());
    }

    public function testItExtractsIsStatic()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('isStatic')->willReturn(true);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertTrue($adapted->isStatic());
    }

    public function testItExtractsIsPublic()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('isPublic')->willReturn(true);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertTrue($adapted->isPublic());
    }

    public function testItExtractsIsPrivate()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('isPrivate')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertFalse($adapted->isPrivate());
    }

    public function testItExtractsIsProtected()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('isProtected')->willReturn(true);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertTrue($adapted->isProtected());
    }

    public function testItStoresDeclaringClassName()
    {
        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('DeclaringClass');

        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertEquals('DeclaringClass', $adapted->getExtractedData()['declaringClassName']);
    }

    public function testItWrapsTypeAsAdaptedReflectionType()
    {
        $typeMock = $this->getMockBuilder(\ReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('hasType')->willReturn(true);
        $propertyMock->method('getType')->willReturn($typeMock);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertInstanceOf(AdaptedReflectionType::class, $adapted->getType());
    }

    public function testItHandlesPropertyWithoutType()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('hasType')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertNull($adapted->getType());
    }

    public function testHasTypeReturnsTrueWhenTypePresent()
    {
        $typeMock = $this->getMockBuilder(\ReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('hasType')->willReturn(true);
        $propertyMock->method('getType')->willReturn($typeMock);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertTrue($adapted->hasType());
    }

    public function testItExtractsDefaultValueWhenAvailable()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('hasDefaultValue')->willReturn(true);
        $propertyMock->method('getDefaultValue')->willReturn('defaultValue');

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertEquals('defaultValue', $adapted->getDefaultValue());
    }

    public function testItHandlesDefaultValueNotAvailable()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('hasDefaultValue')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertNull($adapted->getDefaultValue());
    }

    public function testHasDefaultValueReturnsTrueWhenPresent()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('hasDefaultValue')->willReturn(true);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertTrue($adapted->hasDefaultValue());
    }

    public function testItExtractsDocComment()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('getDocComment')->willReturn('/** Property doc */');

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertEquals('/** Property doc */', $adapted->getDocComment());
    }

    public function testItHandlesPropertyWithoutDocComment()
    {
        $propertyMock = $this->getMockBuilder(ReflectionProperty::class)
            ->disableOriginalConstructor()
            ->getMock();
        $propertyMock->method('getDocComment')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $propertyMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionProperty($propertyMock);

        self::assertFalse($adapted->getDocComment());
    }
}
