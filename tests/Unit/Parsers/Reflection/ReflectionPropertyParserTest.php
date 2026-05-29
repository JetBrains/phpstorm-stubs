<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Reflection\ReflectionPropertyParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionProperty;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class ReflectionPropertyParserTest extends TestCase
{
    public function testItReturnsCorrectInstance()
    {
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('prop');
        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock);
        self::assertNotNull($property);
        self::assertInstanceOf(PHPProperty::class, $property);
    }

    public function testItParsesPropertyName()
    {
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('prop');
        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock);
        self::assertEquals('prop', $property->getName());
    }

    public function testItParsesPropertyVisibility()
    {
        $reflectionPropertyMock1 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'isPublic'])
            ->getMock();
        $reflectionPropertyMock2 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'isProtected'])
            ->getMock();
        $reflectionPropertyMock3 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'isPrivate'])
            ->getMock();
        $reflectionPropertyMock1->method('getName')->willReturn('prop1');
        $reflectionPropertyMock1->method('isPublic')->willReturn(true);
        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock1);
        self::assertEquals('public', $property->getAccess()->value);
        $reflectionPropertyMock2->method('getName')->willReturn('prop2');
        $reflectionPropertyMock2->method('isProtected')->willReturn(true);
        $property2 = new ReflectionPropertyParser()->parse($reflectionPropertyMock2);
        self::assertEquals('protected', $property2->getAccess()->value);
        $reflectionPropertyMock3->method('getName')->willReturn('prop3');
        $reflectionPropertyMock3->method('isPrivate')->willReturn(true);
        $property3 = new ReflectionPropertyParser()->parse($reflectionPropertyMock3);
        self::assertEquals('private', $property3->getAccess()->value);
    }

    public function testItReturnsNoTypeIfNoType()
    {
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'hasType'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('testProperty');
        $reflectionPropertyMock->method('hasType')->willReturn(false);
        $basePHPElement = new ReflectionPropertyParser()->parse($reflectionPropertyMock);
        self::assertInstanceOf(NoType::class, $basePHPElement->getType());
    }

    public function testItParsesSimplePropertyType()
    {
        $typeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'allowsNull'])
            ->getMock();
        $typeMock->method('getName')->willReturn('string');
        $typeMock->method('allowsNull')->willReturn(false);
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getType'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('testProperty');
        $reflectionPropertyMock->method('getType')->willReturn($typeMock);
        $basePHPElement = new ReflectionPropertyParser()->parse($reflectionPropertyMock);
        self::assertEquals('string', $basePHPElement->getType()->toString());
    }

    public function testItParsesPropertyDefaultValue()
    {
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'hasDefaultValue', 'getDefaultValue'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('testProperty');
        $reflectionPropertyMock->method('hasDefaultValue')->willReturn(true);
        $reflectionPropertyMock->method('getDefaultValue')->willReturn('default_value');

        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock);

        self::assertTrue($property->hasDefaultValue());
        self::assertEquals('default_value', $property->getDefaultValue());
    }

    public function testItParsesUnionPropertyType()
    {
        // Mock union type
        $type1Mock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type1Mock->method('getName')->willReturn('string');

        $type2Mock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type2Mock->method('getName')->willReturn('int');

        $unionTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isUnionType', 'getTypes'])
            ->getMock();
        $unionTypeMock->method('isUnionType')->willReturn(true);
        $unionTypeMock->method('getTypes')->willReturn([$type1Mock, $type2Mock]);

        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getType'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('testProperty');
        $reflectionPropertyMock->method('getType')->willReturn($unionTypeMock);

        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock);

        self::assertInstanceOf(UnionType::class, $property->getType());
        self::assertTrue($property->getType()->containsTypes('string', 'int'));
        self::assertEquals('string|int', $property->getType()->toString());
    }

    public function testItParsesIntersectionPropertyType()
    {
        // Mock intersection type
        $type1Mock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type1Mock->method('getName')->willReturn('Foo');

        $type2Mock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type2Mock->method('getName')->willReturn('Bar');

        $intersectionTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isUnionType', 'isIntersectionType', 'getTypes'])
            ->getMock();
        $intersectionTypeMock->method('isUnionType')->willReturn(false);
        $intersectionTypeMock->method('isIntersectionType')->willReturn(true);
        $intersectionTypeMock->method('getTypes')->willReturn([$type1Mock, $type2Mock]);

        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getType'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('testProperty');
        $reflectionPropertyMock->method('getType')->willReturn($intersectionTypeMock);

        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock);

        // Intersection types return IntersectionType object
        self::assertInstanceOf(\StubTests\Framework\Parsers\Model\Types\IntersectionType::class, $property->getType());
        self::assertEquals('Foo&Bar', $property->getType()->toString());
        self::assertTrue($property->getType()->containsTypes('Foo', 'Bar'));
    }

    public function testItParsesNullableUnionPropertyType()
    {
        // Mock nullable union type (string|int|null)
        $type1Mock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type1Mock->method('getName')->willReturn('string');

        $type2Mock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type2Mock->method('getName')->willReturn('int');

        $type3Mock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type3Mock->method('getName')->willReturn('null');

        $unionTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isUnionType', 'getTypes'])
            ->getMock();
        $unionTypeMock->method('isUnionType')->willReturn(true);
        $unionTypeMock->method('getTypes')->willReturn([$type1Mock, $type2Mock, $type3Mock]);

        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getType'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('testProperty');
        $reflectionPropertyMock->method('getType')->willReturn($unionTypeMock);

        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock);

        self::assertInstanceOf(UnionType::class, $property->getType());
        self::assertTrue($property->getType()->containsTypes('string', 'int', 'null'));
        self::assertEquals('string|int|null', $property->getType()->toString());
    }

    public function testItParsesNullablePropertyType()
    {
        $typeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'allowsNull', 'isUnionType', 'isIntersectionType'])
            ->getMock();
        $typeMock->method('getName')->willReturn('string');
        $typeMock->method('allowsNull')->willReturn(true);
        $typeMock->method('isUnionType')->willReturn(false);
        $typeMock->method('isIntersectionType')->willReturn(false);

        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getType'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('testProperty');
        $reflectionPropertyMock->method('getType')->willReturn($typeMock);

        $property = new ReflectionPropertyParser()->parse($reflectionPropertyMock);

        self::assertInstanceOf(NullableType::class, $property->getType());
        self::assertTrue($property->getType()->hasBasicType('string'));
        self::assertEquals('string|null', $property->getType()->toString());
    }
}