<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\ReflectionValueNormalizer;

/**
 * Covers makeSerializable(): turning a value read from the Reflection API into something that
 * survives the Stage 1 -> Stage 2 serialization hop.
 *
 * These tests moved here with the method itself, from ReflectionMethodExtractorTest. Enum-case
 * handling is covered separately in EnumCaseSerializationTest, which also pins the rendering
 * equivalence that keeps the reflection caches byte-identical.
 *
 * @see ReflectionValueNormalizer
 */
class ReflectionValueNormalizerTest extends TestCase
{
    public function testItHandlesNullAndFalseCorrectly()
    {
        self::assertNull(ReflectionValueNormalizer::makeSerializable(null));
        self::assertFalse(ReflectionValueNormalizer::makeSerializable(false));
    }

    public function testItHandlesPrimitives()
    {
        self::assertEquals('test', ReflectionValueNormalizer::makeSerializable('test'));
        self::assertEquals(42, ReflectionValueNormalizer::makeSerializable(42));
        self::assertEquals(3.14, ReflectionValueNormalizer::makeSerializable(3.14));
        self::assertTrue(ReflectionValueNormalizer::makeSerializable(true));
    }

    public function testItRecursivelyProcessesArrays()
    {
        $input = [
            'name' => 'test',
            'count' => 5,
            'nested' => ['a' => 1, 'b' => 2]
        ];
        $result = ReflectionValueNormalizer::makeSerializable($input);

        self::assertEquals($input, $result);
        self::assertIsArray($result);
        self::assertIsArray($result['nested']);
    }

    public function testItWrapsReflectionClassToAdaptedReflectionClass()
    {
        $reflectionClass = new \ReflectionClass(\stdClass::class);
        $result = ReflectionValueNormalizer::makeSerializable($reflectionClass);

        self::assertInstanceOf(AdaptedReflectionClass::class, $result);
    }

    public function testItPreventsInfiniteRecursion()
    {
        // Create deeply nested array
        $deep = ['level' => 0];
        $current = &$deep;
        for ($i = 1; $i < 10; $i++) {
            $current['nested'] = ['level' => $i];
            $current = &$current['nested'];
        }

        // Should not throw due to max depth limit
        $result = ReflectionValueNormalizer::makeSerializable($deep, 0, 3);
        self::assertIsArray($result);
    }

    public function testItReturnsAdaptedReflectionObjectsAsIs()
    {
        $reflectionClass = new \ReflectionClass(\stdClass::class);
        $adapted = new AdaptedReflectionClass($reflectionClass);

        $result = ReflectionValueNormalizer::makeSerializable($adapted);

        self::assertSame($adapted, $result);
    }

    public function testItConvertsObjectsWithToStringToString()
    {
        $obj = new class() {
            public function __toString()
            {
                return 'StringRepresentation';
            }
        };

        $result = ReflectionValueNormalizer::makeSerializable($obj);
        self::assertEquals('StringRepresentation', $result);
    }

    public function testItReturnsClassNameForNonSerializableObjects()
    {
        $obj = new \stdClass();
        $result = ReflectionValueNormalizer::makeSerializable($obj);

        self::assertEquals('stdClass', $result);
    }
}
