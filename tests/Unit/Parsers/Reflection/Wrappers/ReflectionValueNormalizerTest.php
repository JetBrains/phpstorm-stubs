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

    /**
     * Build a 10-level array: ['level' => 0, 'nested' => ['level' => 1, 'nested' => [...]]].
     */
    private static function deeplyNestedArray()
    {
        $deep = ['level' => 0];
        $current = &$deep;
        for ($i = 1; $i < 10; $i++) {
            $current['nested'] = ['level' => $i];
            $current = &$current['nested'];
        }

        return $deep;
    }

    /**
     * Asserts *where* the recursion stops, not merely that it stopped.
     *
     * `assertIsArray($result)` alone could not fail: the top-level value is an array whatever
     * $maxDepth does, so deleting the depth guard entirely left the test green while the recursion
     * became unbounded. The exact expected tree below pins both halves of the contract — that
     * truncation happens, and that it happens no earlier than $maxDepth.
     */
    public function testItTruncatesAtMaxDepthInsteadOfRecursingForever()
    {
        $result = ReflectionValueNormalizer::makeSerializable(self::deeplyNestedArray(), 0, 3);

        self::assertSame(
            [
                'level' => 0,                                        // depth 1
                'nested' => [
                    'level' => 1,                                    // depth 2
                    'nested' => [
                        'level' => null,                             // depth 3 == maxDepth → cut
                        'nested' => null,
                    ],
                ],
            ],
            $result
        );
    }

    /**
     * The default $maxDepth is part of the contract: every caller in the reflection pipeline relies
     * on it rather than passing a depth. Pinned behaviourally so that changing the default fails
     * here rather than silently altering every cached reflection payload.
     */
    public function testItAppliesMaxDepthThreeByDefault()
    {
        self::assertSame(
            ReflectionValueNormalizer::makeSerializable(self::deeplyNestedArray(), 0, 3),
            ReflectionValueNormalizer::makeSerializable(self::deeplyNestedArray())
        );
    }

    /**
     * The boundary is `>=`, so a depth already at the limit yields null without inspecting the
     * value at all — including for a plain scalar that would otherwise pass straight through.
     */
    public function testItReturnsNullWhenAlreadyAtMaxDepth()
    {
        self::assertNull(ReflectionValueNormalizer::makeSerializable('scalar', 3, 3));
        self::assertNull(ReflectionValueNormalizer::makeSerializable(['a' => 1], 0, 0));
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
