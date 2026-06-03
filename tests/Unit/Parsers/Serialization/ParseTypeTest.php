<?php

namespace StubTests\Unit\Parsers\Serialization;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\Serializers\SerializerUtilsTrait;

/**
 * Exposes the protected parseType() method for testing.
 */
class ParseTypeTestHelper
{
    use SerializerUtilsTrait;

    public function parse(?string $typeStr): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        return $this->parseType($typeStr);
    }
}

class ParseTypeTest extends TestCase
{
    private \StubTests\Unit\Parsers\Serialization\ParseTypeTestHelper $helper;

    protected function setUp(): void
    {
        $this->helper = new \StubTests\Unit\Parsers\Serialization\ParseTypeTestHelper();
    }

    // ------------------------------------------------------------------
    // NoType
    // ------------------------------------------------------------------

    public function testNullReturnsNoType(): void
    {
        $result = $this->helper->parse(null);
        self::assertInstanceOf(NoType::class, $result);
        self::assertEquals('', $result->toString());
    }

    public function testEmptyStringReturnsNoType(): void
    {
        $result = $this->helper->parse('');
        self::assertInstanceOf(NoType::class, $result);
        self::assertEquals('', $result->toString());
    }

    // ------------------------------------------------------------------
    // StandaloneType
    // ------------------------------------------------------------------

    public function testSimpleTypeReturnsStandaloneType(): void
    {
        $result = $this->helper->parse('string');
        self::assertInstanceOf(StandaloneType::class, $result);
        self::assertEquals('string', $result->toString());
    }

    public function testBuiltinTypesReturnStandaloneType(): void
    {
        foreach (['int', 'float', 'bool', 'array', 'void', 'never', 'mixed', 'null', 'object'] as $type) {
            $result = $this->helper->parse($type);
            self::assertInstanceOf(StandaloneType::class, $result, "Expected StandaloneType for '$type'");
            self::assertEquals($type, $result->toString());
        }
    }

    public function testFqnClassReturnsStandaloneType(): void
    {
        $result = $this->helper->parse('\\DateTime');
        self::assertInstanceOf(StandaloneType::class, $result);
        self::assertEquals('\\DateTime', $result->toString());
    }

    // ------------------------------------------------------------------
    // NullableType — "?T" shorthand
    // ------------------------------------------------------------------

    public function testQuestionMarkPrefixReturnsNullableType(): void
    {
        $result = $this->helper->parse('?string');
        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('string|null', $result->toString());
    }

    public function testQuestionMarkPrefixOnObjectReturnsNullableType(): void
    {
        $result = $this->helper->parse('?\\DateTime');
        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('\\DateTime|null', $result->toString());
    }

    // ------------------------------------------------------------------
    // NullableType — "T|null" and "null|T" forms
    // ------------------------------------------------------------------

    public function testTypeOrNullReturnsNullableType(): void
    {
        $result = $this->helper->parse('string|null');
        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('string|null', $result->toString());
    }

    public function testNullOrTypeReturnsNullableType(): void
    {
        // null first — order must be handled symmetrically
        $result = $this->helper->parse('null|int');
        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('int|null', $result->toString());
    }

    public function testObjectOrNullReturnsNullableType(): void
    {
        $result = $this->helper->parse('\\Countable|null');
        self::assertInstanceOf(NullableType::class, $result);
        self::assertEquals('\\Countable|null', $result->toString());
    }

    // ------------------------------------------------------------------
    // UnionType
    // ------------------------------------------------------------------

    public function testTwoPartUnionWithoutNullReturnsUnionType(): void
    {
        $result = $this->helper->parse('string|false');
        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('string|false', $result->toString());
        self::assertTrue($result->containsTypes('string', 'false'));
    }

    public function testTwoPartUnionReturnsUnionType(): void
    {
        $result = $this->helper->parse('string|int');
        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('string|int', $result->toString());
        self::assertTrue($result->containsTypes('string', 'int'));
    }

    public function testThreePartUnionWithNullReturnsUnionType(): void
    {
        // 3 parts even though one is null → UnionType, not NullableType
        $result = $this->helper->parse('string|int|null');
        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('string|int|null', $result->toString());
        self::assertTrue($result->containsTypes('string', 'int', 'null'));
    }

    public function testThreePartUnionReturnsUnionType(): void
    {
        $result = $this->helper->parse('int|string|bool');
        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('int|string|bool', $result->toString());
        self::assertTrue($result->containsTypes('int', 'string', 'bool'));
    }

    public function testUnionTypeContainsTypesReturnsFalseForMissing(): void
    {
        $result = $this->helper->parse('string|int');
        self::assertInstanceOf(UnionType::class, $result);
        self::assertFalse($result->containsTypes('bool'));
    }

    // ------------------------------------------------------------------
    // IntersectionType
    // ------------------------------------------------------------------

    public function testTwoPartIntersectionReturnsIntersectionType(): void
    {
        $result = $this->helper->parse('Countable&Iterator');
        self::assertInstanceOf(IntersectionType::class, $result);
        self::assertEquals('Countable&Iterator', $result->toString());
        self::assertTrue($result->containsTypes('Countable', 'Iterator'));
    }

    public function testThreePartIntersectionReturnsIntersectionType(): void
    {
        $result = $this->helper->parse('A&B&C');
        self::assertInstanceOf(IntersectionType::class, $result);
        self::assertEquals('A&B&C', $result->toString());
        self::assertTrue($result->containsTypes('A', 'B', 'C'));
    }

    public function testIntersectionTypeContainsTypesReturnsFalseForMissing(): void
    {
        $result = $this->helper->parse('Countable&Iterator');
        self::assertInstanceOf(IntersectionType::class, $result);
        self::assertFalse($result->containsTypes('Stringable'));
    }

    // ------------------------------------------------------------------
    // Round-trip: toString() output is stable input for parseType()
    // ------------------------------------------------------------------

    public function testUnionTypeRoundTrip(): void
    {
        $original = new UnionType();
        $original->addType(new StandaloneType('string'));
        $original->addType(new StandaloneType('false'));

        $reparsed = $this->helper->parse($original->toString());
        self::assertInstanceOf(UnionType::class, $reparsed);
        self::assertEquals($original->toString(), $reparsed->toString());
    }

    public function testNullableTypeRoundTrip(): void
    {
        $original = new NullableType(new StandaloneType('string'));

        $reparsed = $this->helper->parse($original->toString());
        self::assertInstanceOf(NullableType::class, $reparsed);
        self::assertEquals($original->toString(), $reparsed->toString());
    }

    public function testIntersectionTypeRoundTrip(): void
    {
        $original = new IntersectionType();
        $original->addType(new StandaloneType('Countable'));
        $original->addType(new StandaloneType('Iterator'));

        $reparsed = $this->helper->parse($original->toString());
        self::assertInstanceOf(IntersectionType::class, $reparsed);
        self::assertEquals($original->toString(), $reparsed->toString());
    }

    public function testNoTypeRoundTrip(): void
    {
        $original = new NoType();
        $reparsed = $this->helper->parse($original->toString());
        self::assertInstanceOf(NoType::class, $reparsed);
        self::assertEquals($original->toString(), $reparsed->toString());
    }
}
