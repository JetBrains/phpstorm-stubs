<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use ReflectionNamedType;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class AdaptedReflectionTypeTest extends TestCase
{
    public function testItExtractsTypeNameForNamedType()
    {
        $typeMock = $this->getMockBuilder(ReflectionNamedType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $typeMock->method('getName')->willReturn('string');

        $adapted = new AdaptedReflectionType($typeMock);

        self::assertEquals('string', $adapted->getName());
    }

    public function testItExtractsAllowsNull()
    {
        $typeMock = $this->getMockBuilder(ReflectionNamedType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $typeMock->method('allowsNull')->willReturn(true);

        $adapted = new AdaptedReflectionType($typeMock);

        self::assertTrue($adapted->allowsNull());
    }

    public function testItExtractsIsBuiltinForNamedType()
    {
        $typeMock = $this->getMockBuilder(ReflectionNamedType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $typeMock->method('isBuiltin')->willReturn(true);

        $adapted = new AdaptedReflectionType($typeMock);

        self::assertTrue($adapted->isBuiltin());
    }

    public function testItHandlesNamedTypeCorrectly()
    {
        $typeMock = $this->getMockBuilder(ReflectionNamedType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $typeMock->method('getName')->willReturn('int');
        $typeMock->method('allowsNull')->willReturn(false);
        $typeMock->method('isBuiltin')->willReturn(true);

        $adapted = new AdaptedReflectionType($typeMock);

        self::assertEquals('int', $adapted->getName());
        self::assertFalse($adapted->allowsNull());
        self::assertTrue($adapted->isBuiltin());
    }

    public function testItStoresTypesKeyCorrectly()
    {
        // Test that union/intersection types use 'getTypes' key
        $innerTypeMock1 = $this->getMockBuilder(ReflectionNamedType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $innerTypeMock1->method('getName')->willReturn('string');

        $innerTypeMock2 = $this->getMockBuilder(ReflectionNamedType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $innerTypeMock2->method('getName')->willReturn('int');

        // Mock union type (PHP 8.0+)
        if (class_exists('ReflectionUnionType')) {
            $unionTypeMock = $this->getMockBuilder(\ReflectionUnionType::class)
                ->disableOriginalConstructor()
                ->getMock();
            $unionTypeMock->method('getTypes')->willReturn([$innerTypeMock1, $innerTypeMock2]);

            $adapted = new AdaptedReflectionType($unionTypeMock);
            $data = $adapted->getExtractedData();

            // Verify 'getTypes' key exists (not 'types')
            self::assertArrayHasKey('getTypes', $data);
            self::assertIsArray($adapted->getTypes());
        } else {
            self::markTestSkipped('ReflectionUnionType not available in PHP < 8.0');
        }
    }

    public function testItWrapsInnerTypesRecursively()
    {
        $innerTypeMock = $this->getMockBuilder(ReflectionNamedType::class)
            ->disableOriginalConstructor()
            ->getMock();
        $innerTypeMock->method('getName')->willReturn('string');

        // Mock union type (PHP 8.0+)
        if (class_exists('ReflectionUnionType')) {
            $unionTypeMock = $this->getMockBuilder(\ReflectionUnionType::class)
                ->disableOriginalConstructor()
                ->getMock();
            $unionTypeMock->method('getTypes')->willReturn([$innerTypeMock]);

            $adapted = new AdaptedReflectionType($unionTypeMock);
            $types = $adapted->getTypes();

            self::assertIsArray($types);
            self::assertCount(1, $types);
            // getTypes() returns AdaptedReflectionNamedType objects
            self::assertInstanceOf(\StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionNamedType::class, $types[0]);
            self::assertEquals('string', $types[0]->getName());
        } else {
            self::markTestSkipped('ReflectionUnionType not available in PHP < 8.0');
        }
    }

    public function testGetNameReturnsNullForUnionTypes()
    {
        // Union types don't have a single name
        if (class_exists('ReflectionUnionType')) {
            $unionTypeMock = $this->getMockBuilder(\ReflectionUnionType::class)
                ->disableOriginalConstructor()
                ->getMock();
            $unionTypeMock->method('getTypes')->willReturn([]);

            $adapted = new AdaptedReflectionType($unionTypeMock);

            // Union types have getName() method but it returns null
            self::assertTrue($adapted->hasMethod('getName'));
            self::assertNull($adapted->getName());
        } else {
            self::markTestSkipped('ReflectionUnionType not available in PHP < 8.0');
        }
    }
}
