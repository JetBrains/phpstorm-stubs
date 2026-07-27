<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\Types\NoType;
use StubTests\Framework\Model\Types\NullableType;
use StubTests\Framework\Model\Types\StandaloneType;
use StubTests\Framework\Model\Types\UnionType;
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

        self::assertInstanceOf(\StubTests\Framework\Model\Types\IntersectionType::class, $result);
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

        self::assertInstanceOf(\StubTests\Framework\Model\Types\IntersectionType::class, $result);
        self::assertEquals('Foo&Bar', $result->toString());
    }

    // ── DNF types (PHP 8.2+): a union member may itself be an intersection ────

    /**
     * Live reflection hands over a ReflectionIntersectionType inside the union. It has no
     * getName(), so the old guard skipped it outright and `null|(A&B)` parsed to just `null`
     * — a silently wrong type rather than a visible failure.
     */
    public function testUnionWithLiveIntersectionMemberKeepsTheGroup()
    {
        if (!class_exists('\ReflectionIntersectionType')) {
            self::markTestSkipped('ReflectionIntersectionType not available in this PHP version');
        }

        $inner = [$this->namedTypeMock('A'), $this->namedTypeMock('B')];
        $group = $this->createMock(\ReflectionIntersectionType::class);
        $group->method('getTypes')->willReturn($inner);

        $union = $this->createMock(\ReflectionUnionType::class);
        $union->method('getTypes')->willReturn([$group, $this->namedTypeMock('null')]);

        $result = $this->parser->parse($union);

        self::assertInstanceOf(UnionType::class, $result);
        self::assertSame('(A&B)|null', $result->toString());
    }

    /**
     * The wrapper (AdaptedReflectionType) pre-flattens a DNF group into the single name
     * "A&B". That must become an IntersectionType, not a StandaloneType, or the reflection
     * side renders `A&B|null` while the stubs side renders `(A&B)|null` and an identical
     * type compares as a mismatch.
     */
    public function testUnionWithWrapperFlattenedIntersectionMemberIsRestored()
    {
        $union = new class() {
            public function isUnionType() { return true; }

            public function isIntersectionType() { return false; }

            public function allowsNull() { return true; }

            public function getName() { return null; }

            public function getTypes()
            {
                return [
                    new class() {
 public function getName() { return 'A&B'; }
 },
                    new class() {
 public function getName() { return 'null'; }
 },
                ];
            }
        };

        $result = $this->parser->parse($union);

        self::assertInstanceOf(UnionType::class, $result);
        self::assertSame('(A&B)|null', $result->toString());
    }

    public function testUnionWithMultipleIntersectionGroups()
    {
        $union = new class() {
            public function isUnionType() { return true; }

            public function isIntersectionType() { return false; }

            public function allowsNull() { return false; }

            public function getName() { return null; }

            public function getTypes()
            {
                return [
                    new class() {
 public function getName() { return 'A&B'; }
 },
                    new class() {
 public function getName() { return 'B&C'; }
 },
                    new class() {
 public function getName() { return 'int'; }
 },
                ];
            }
        };

        self::assertSame('(A&B)|(B&C)|int', $this->parser->parse($union)->toString());
    }

    /**
     * A plain union must be unaffected — no spurious grouping.
     */
    public function testPlainUnionMembersRemainStandalone()
    {
        $union = $this->createMock(\ReflectionUnionType::class);
        $union->method('getTypes')->willReturn([$this->namedTypeMock('int'), $this->namedTypeMock('string')]);

        self::assertSame('int|string', $this->parser->parse($union)->toString());
    }

    private function namedTypeMock(string $name): \ReflectionNamedType
    {
        $mock = $this->createMock(\ReflectionNamedType::class);
        $mock->method('getName')->willReturn($name);
        return $mock;
    }
}
