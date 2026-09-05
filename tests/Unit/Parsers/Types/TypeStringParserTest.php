<?php

namespace StubTests\Unit\Parsers\Types;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\Types\IntersectionType;
use StubTests\Framework\Model\Types\NoType;
use StubTests\Framework\Model\Types\NullableType;
use StubTests\Framework\Model\Types\StandaloneType;
use StubTests\Framework\Model\Types\UnionType;
use StubTests\Framework\Parsers\Types\TypeStringParser;

/**
 * Boundary tests for the structural type-string grammar.
 *
 * This is the single implementation used by the serializers, the stub type converter and the
 * validators, and it had no direct test at all — a regression here silently changes every parsed
 * type in the project. The tests below pin each grammar branch and, in particular, the two
 * precedence rules that are easy to break: `|` is examined before `&` so DNF strings are not
 * misrouted to intersection parsing, and the nullable shorthand is only applied when the non-null
 * part is not a parenthesised group.
 *
 * @see TypeStringParser
 */
class TypeStringParserTest extends TestCase
{
    private TypeStringParser $parser;

    protected function setUp(): void
    {
        $this->parser = new TypeStringParser();
    }

    /** Resolver that marks each leaf, so it is visible that every leaf passed through it. */
    private static function markingResolver(): callable
    {
        return static fn (string $leaf): string => '<' . $leaf . '>';
    }

    private static function identity(): callable
    {
        return static fn (string $leaf): string => $leaf;
    }

    #[DataProvider('grammarCases')]
    public function testGrammarProducesTheExpectedTypeShape(string $input, string $expectedClass, string $expectedString)
    {
        $result = $this->parser->parse($input, self::identity());

        self::assertInstanceOf($expectedClass, $result, "input: {$input}");
        self::assertSame($expectedString, $result->toString(), "input: {$input}");
    }

    public static function grammarCases(): array
    {
        return [
            'empty string is NoType' => ['', NoType::class, ''],
            'plain name' => ['Foo', StandaloneType::class, 'Foo'],
            'builtin scalar' => ['int', StandaloneType::class, 'int'],
            'nullable shorthand' => ['?Foo', NullableType::class, 'Foo|null'],
            'parenthesised intersection' => ['(A&B)', IntersectionType::class, 'A&B'],
            'bare intersection' => ['A&B', IntersectionType::class, 'A&B'],
            'three-way intersection' => ['A&B&C', IntersectionType::class, 'A&B&C'],
            'union of two' => ['A|B', UnionType::class, 'A|B'],
            'union of three' => ['A|B|C', UnionType::class, 'A|B|C'],
            'type|null is nullable' => ['Foo|null', NullableType::class, 'Foo|null'],
            'null|type is nullable regardless of order' => ['null|Foo', NullableType::class, 'Foo|null'],
        ];
    }

    /**
     * `|` must be examined before `&`. If the order were reversed, "int|(A&B)" would be routed to
     * intersection parsing and the union structure would be lost entirely.
     */
    public function testDnfUnionKeepsItsIntersectionMembers()
    {
        $result = $this->parser->parse('int|(A&B)', self::identity());

        self::assertInstanceOf(UnionType::class, $result);
        self::assertSame('int|(A&B)', $result->toString());
    }

    public function testDnfUnionOfTwoIntersectionGroups()
    {
        $result = $this->parser->parse('(A&B)|(C&D)', self::identity());

        self::assertInstanceOf(UnionType::class, $result);
        self::assertSame('(A&B)|(C&D)', $result->toString());
    }

    /**
     * The parenthesised-intersection branch is guarded by "contains no |". Without that guard,
     * "(A&B)|(C&D)" starts with '(' and ends with ')' and would be mis-parsed as one intersection
     * of the whole inner text.
     */
    public function testParenthesisedBranchDoesNotSwallowAWholeDnfString()
    {
        $result = $this->parser->parse('(A&B)|(C&D)', self::identity());

        self::assertNotInstanceOf(IntersectionType::class, $result);
    }

    /**
     * A nullable DNF type must stay a UnionType: the nullable shorthand cannot represent an
     * intersection as its basic type, since NullableType only accepts a StandaloneType.
     */
    public function testNullableIntersectionStaysAUnionRatherThanCollapsing()
    {
        $result = $this->parser->parse('(A&B)|null', self::identity());

        self::assertInstanceOf(UnionType::class, $result);
        self::assertSame('(A&B)|null', $result->toString());
    }

    /** Three parts including null is a union, not a nullable — nullable is the exactly-two case. */
    public function testUnionWithNullAndTwoOthersIsNotCollapsedToNullable()
    {
        $result = $this->parser->parse('A|B|null', self::identity());

        self::assertInstanceOf(UnionType::class, $result);
        self::assertSame('A|B|null', $result->toString());
    }

    #[DataProvider('everyLeafIsResolvedCases')]
    public function testEveryLeafNamePassesThroughTheResolver(string $input, string $expected)
    {
        self::assertSame($expected, $this->parser->parse($input, self::markingResolver())->toString());
    }

    public static function everyLeafIsResolvedCases(): array
    {
        return [
            'standalone' => ['Foo', '<Foo>'],
            'nullable shorthand' => ['?Foo', '<Foo>|null'],
            'union members' => ['A|B', '<A>|<B>'],
            'intersection members' => ['A&B', '<A>&<B>'],
            'nullable via null union' => ['Foo|null', '<Foo>|null'],
            'dnf leaves' => ['int|(A&B)', '<int>|(<A>&<B>)'],
        ];
    }

    /**
     * 'null' in a two-part union is matched literally and case-sensitively, so 'NULL' does not
     * trigger the nullable collapse. Pinned because the surrounding code lowercases elsewhere,
     * making this a plausible thing to "harmonise" and thereby change behaviour.
     */
    public function testNullMatchingInTheNullableCollapseIsCaseSensitive()
    {
        self::assertInstanceOf(NullableType::class, $this->parser->parse('Foo|null', self::identity()));
        self::assertInstanceOf(UnionType::class, $this->parser->parse('Foo|NULL', self::identity()));
    }

    /** Intersection members are trimmed, so a spaced source type hint parses the same. */
    public function testIntersectionMembersAreTrimmed()
    {
        self::assertSame('A&B', $this->parser->parse('A & B', self::identity())->toString());
    }

    /** Union parts are trimmed too, via splitUnionParts(). */
    public function testUnionPartsAreTrimmed()
    {
        self::assertSame('A|B', $this->parser->parse('A | B', self::identity())->toString());
    }

    /** A DNF group survives alongside plain members in a three-part union. */
    public function testDnfGroupSurvivesAlongsidePlainUnionMembers()
    {
        $result = $this->parser->parse('int|(A&B)|null', self::identity());

        self::assertInstanceOf(UnionType::class, $result);
        self::assertTrue($result->containsTypes('int'), 'the scalar member survives');
        self::assertTrue($result->containsTypes('null'), 'the null member survives');
        self::assertSame('int|(A&B)|null', $result->toString(), 'three members, group kept intact');
    }

    /**
     * splitUnionParts() tracks parenthesis depth, so a '|' inside a group is not a separator.
     *
     * No *valid* PHP type reaches this: DNF forbids a union inside parentheses, and every
     * well-formed input has only '&' inside its groups. So the depth counter can only be pinned
     * with a synthetic string — and it must be pinned structurally, because `toString()` renders
     * '(A|B)' either way whether the group was kept whole or split into '(A' and 'B)'. Dropping
     * the depth check passes every other test in this class, so without this one the counter is
     * unguarded.
     */
    public function testUnionSplittingRespectsParenthesisDepth()
    {
        $result = $this->parser->parse('(A|B)', self::identity());

        self::assertInstanceOf(UnionType::class, $result);
        self::assertFalse(
            $result->containsTypes('(A'),
            'the group was split mid-parenthesis, so depth tracking was ignored'
        );
        self::assertFalse($result->containsTypes('B)'), 'likewise for the trailing fragment');
    }

    /** A trailing separator yields no empty trailing member (splitUnionParts drops it). */
    public function testTrailingSeparatorDoesNotProduceAnEmptyMember()
    {
        self::assertSame('A|B', $this->parser->parse('A|B|', self::identity())->toString());
    }

    /**
     * toString() renders in a form the parser accepts again, and re-parsing is stable. Note the
     * `?Foo` shorthand normalises to `Foo|null` on the way out, so the round trip is idempotent
     * from the second pass onward rather than character-preserving on the first.
     *
     * @see NullableType::toString()
     */
    #[DataProvider('roundTripCases')]
    public function testRenderedTypesReparseToTheSameShapeAndString(string $input)
    {
        $first = $this->parser->parse($input, self::identity());
        $second = $this->parser->parse($first->toString(), self::identity());

        self::assertSame($first::class, $second::class, "shape changed on re-parse of {$input}");
        self::assertSame($first->toString(), $second->toString(), "string changed on re-parse of {$input}");
    }

    public static function roundTripCases(): array
    {
        return [
            ['Foo'], ['int'], ['?Foo'], ['Foo|null'], ['A|B'], ['A|B|C'],
            ['A&B'], ['(A&B)'], ['int|(A&B)'], ['(A&B)|(C&D)'], ['(A&B)|null'], ['int|(A&B)|null'],
        ];
    }
}
