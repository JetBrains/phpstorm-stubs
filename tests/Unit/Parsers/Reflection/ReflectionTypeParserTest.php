<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\Reflection\ReflectionTypeParser;

class ReflectionTypeParserTest extends TestCase
{
    private ReflectionTypeParser $parser;

    protected function setUp(): void
    {
        $this->parser = new ReflectionTypeParser();
    }

    public function testItReturnsNoTypeForNullInput()
    {
        $result = $this->parser->parse(null);
        self::assertInstanceOf(NoType::class, $result);
        self::assertEquals('', $result->toString());
    }

    public function testItParsesStandaloneType()
    {
        $typeMock = $this->createMock(\ReflectionNamedType::class);
        $typeMock->method('getName')->willReturn('int');
        $typeMock->method('allowsNull')->willReturn(false);

        $result = $this->parser->parse($typeMock);

        self::assertInstanceOf(StandaloneType::class, $result);
        self::assertEquals('int', $result->toString());
    }

    public function testItParsesStandaloneStringType()
    {
        $typeMock = $this->createMock(\ReflectionNamedType::class);
        $typeMock->method('getName')->willReturn('string');
        $typeMock->method('allowsNull')->willReturn(false);

        $result = $this->parser->parse($typeMock);

        self::assertInstanceOf(StandaloneType::class, $result);
        self::assertEquals('string', $result->toString());
    }

    public function testItParsesStandaloneClassType()
    {
        $typeMock = $this->createMock(\ReflectionNamedType::class);
        $typeMock->method('getName')->willReturn('DateTime');
        $typeMock->method('allowsNull')->willReturn(false);

        $result = $this->parser->parse($typeMock);

        self::assertInstanceOf(StandaloneType::class, $result);
        self::assertEquals('DateTime', $result->toString());
    }

    public function testItParsesNullableType()
    {
        $typeMock = $this->createMock(\ReflectionNamedType::class);
        $typeMock->method('getName')->willReturn('string');
        $typeMock->method('allowsNull')->willReturn(true);

        $result = $this->parser->parse($typeMock);

        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('string|null', $result->toString());
    }

    public function testItParsesNullableObjectType()
    {
        $typeMock = $this->createMock(\ReflectionNamedType::class);
        $typeMock->method('getName')->willReturn('object');
        $typeMock->method('allowsNull')->willReturn(true);

        $result = $this->parser->parse($typeMock);

        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('object|null', $result->toString());
    }

    public function testItParsesNullableMixedType()
    {
        $typeMock = $this->createMock(\ReflectionNamedType::class);
        $typeMock->method('getName')->willReturn('mixed');
        $typeMock->method('allowsNull')->willReturn(true);

        $result = $this->parser->parse($typeMock);

        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('mixed', $result->toString());
    }

    public function testItParsesUnionType()
    {
        $namedType1 = $this->createMock(\ReflectionNamedType::class);
        $namedType1->method('getName')->willReturn('string');

        $namedType2 = $this->createMock(\ReflectionNamedType::class);
        $namedType2->method('getName')->willReturn('int');

        $namedType3 = $this->createMock(\ReflectionNamedType::class);
        $namedType3->method('getName')->willReturn('null');

        $unionTypeMock = $this->createMock(\ReflectionUnionType::class);
        $unionTypeMock->method('getTypes')->willReturn([$namedType1, $namedType2, $namedType3]);

        $result = $this->parser->parse($unionTypeMock);

        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('string|int|null', $result->toString());
    }

    public function testItParsesUnionTypeWithDuckTyping()
    {
        $namedType1 = new class() {
            public function getName() { return 'object'; }
        };

        $namedType2 = new class() {
            public function getName() { return 'string'; }
        };

        $unionTypeMock = new class($namedType1, $namedType2) {
            private $types;

            public function __construct($type1, $type2) {
                $this->types = [$type1, $type2];
            }

            public function isUnionType() { return true; }

            public function getTypes() { return $this->types; }
        };

        $result = $this->parser->parse($unionTypeMock);

        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('object|string', $result->toString());
    }

    public function testItParsesIntersectionType()
    {
        if (!class_exists('\ReflectionIntersectionType')) {
            self::markTestSkipped('ReflectionIntersectionType not available in this PHP version');
        }

        $namedType1 = $this->createMock(\ReflectionNamedType::class);
        $namedType1->method('getName')->willReturn('Countable');

        $namedType2 = $this->createMock(\ReflectionNamedType::class);
        $namedType2->method('getName')->willReturn('ArrayAccess');

        $intersectionTypeMock = $this->createMock(\ReflectionIntersectionType::class);
        $intersectionTypeMock->method('getTypes')->willReturn([$namedType1, $namedType2]);

        $result = $this->parser->parse($intersectionTypeMock);

        self::assertInstanceOf(\StubTests\Framework\Parsers\Model\Types\IntersectionType::class, $result);
        self::assertEquals('Countable&ArrayAccess', $result->toString());
    }

    public function testItParsesIntersectionTypeWithDuckTyping()
    {
        $namedType1 = new class() {
            public function getName() { return 'Foo'; }
        };

        $namedType2 = new class() {
            public function getName() { return 'Bar'; }
        };

        $intersectionTypeMock = new class($namedType1, $namedType2) {
            private $types;

            public function __construct($type1, $type2) {
                $this->types = [$type1, $type2];
            }

            public function isIntersectionType() { return true; }

            public function getTypes() { return $this->types; }
        };

        $result = $this->parser->parse($intersectionTypeMock);

        self::assertInstanceOf(\StubTests\Framework\Parsers\Model\Types\IntersectionType::class, $result);
        self::assertEquals('Foo&Bar', $result->toString());
    }
}
