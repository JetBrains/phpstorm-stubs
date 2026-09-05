<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedEnumCaseReference;
use StubTests\Framework\Parsers\Reflection\Wrappers\ReflectionValueNormalizer;
use StubTests\Framework\Serialization\Reflection\ReflectionClassSerializer;
use StubTests\Unit\Parsers\Reflection\fixtures\BackedEnumFixture;
use StubTests\Unit\Parsers\Reflection\fixtures\PureEnumFixture;

/**
 * Enum-case values captured from reflection must not travel as live enum instances.
 *
 * The reflection pipeline serializes in the container for the version being reflected and
 * unserializes in test_runner. A live enum instance only survives if the declaring class exists on
 * both sides, and unlike ordinary objects an enum cannot degrade to __PHP_Incomplete_Class — so an
 * unresolvable one aborts the *entire* payload, not just that value.
 *
 * makeSerializable() had a branch meant to handle this, but it tested
 * `method_exists($value, 'name')`; `name` is a property on an enum case, not a method, so the branch
 * never fired and enums fell through to a bare class-name fallback that lost the case entirely.
 *
 * @see AdaptedEnumCaseReference
 */
class EnumCaseSerializationTest extends TestCase
{
    private function toJsonSafe(mixed $value): mixed
    {
        $serializer = new ReflectionClassSerializer();
        return (new \ReflectionMethod($serializer, 'toJsonSafe'))->invoke($serializer, $value);
    }

    public function testPureEnumCaseBecomesAPortableReference()
    {
        $result = ReflectionValueNormalizer::makeSerializable(PureEnumFixture::Auto);

        self::assertInstanceOf(AdaptedEnumCaseReference::class, $result);
        self::assertSame(PureEnumFixture::class, $result->getEnumFqn());
        self::assertSame('Auto', $result->getCaseName(), 'the case name must not be lost');
    }

    public function testBackedEnumCaseIsAlsoConverted()
    {
        $result = ReflectionValueNormalizer::makeSerializable(BackedEnumFixture::First);

        self::assertInstanceOf(AdaptedEnumCaseReference::class, $result);
        self::assertSame('First', $result->getCaseName());
    }

    /** The whole point: the converted value must survive a serialize/unserialize hop. */
    public function testReferenceSurvivesTheSerializationHop()
    {
        $reference = ReflectionValueNormalizer::makeSerializable(PureEnumFixture::Manual);

        $restored = unserialize(serialize($reference));

        self::assertInstanceOf(AdaptedEnumCaseReference::class, $restored);
        self::assertSame('Manual', $restored->getCaseName());
    }

    /**
     * A live enum instance uses PHP's `E:` serialization format, which hard-fails when the class is
     * absent. This documents the hazard the reference avoids — it is why an unresolvable enum takes
     * the entire payload down rather than degrading.
     */
    public function testLiveEnumUsesTheFragileSerializationFormat()
    {
        self::assertStringStartsWith('E:', serialize(PureEnumFixture::Auto));
        self::assertStringStartsWith('O:', serialize(new AdaptedEnumCaseReference('Some\\Enum', 'Case')));
    }

    /**
     * The reference must render exactly as a live instance did, so caches generated before and after
     * this change are byte-identical. Verified end-to-end against Reflection8.6.json as well.
     */
    public function testReferenceRendersIdenticallyToALiveEnum()
    {
        $live = $this->toJsonSafe(PureEnumFixture::Auto);
        $reference = $this->toJsonSafe(new AdaptedEnumCaseReference(PureEnumFixture::class, 'Auto'));

        self::assertSame($live, $reference);
        self::assertSame('[object:' . PureEnumFixture::class . ']', $reference);
    }

    /** A leading backslash is normalised away, matching get_class() of a real case. */
    public function testEnumFqnIsNormalised()
    {
        self::assertSame('Io\\Poll\\Backend', (new AdaptedEnumCaseReference('\\Io\\Poll\\Backend', 'Auto'))->getEnumFqn());
    }

    /** Non-enum values must be untouched by the new branch. */
    public function testOrdinaryValuesAreUnaffected()
    {
        self::assertSame(42, ReflectionValueNormalizer::makeSerializable(42));
        self::assertSame('text', ReflectionValueNormalizer::makeSerializable('text'));
        self::assertNull(ReflectionValueNormalizer::makeSerializable(null));
        self::assertSame([1, 2], ReflectionValueNormalizer::makeSerializable([1, 2]));
    }
}
