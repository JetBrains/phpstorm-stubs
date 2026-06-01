<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Reflection\Wrappers\ReflectionMethodExtractor;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;

class ReflectionMethodExtractorTest extends TestCase
{
    // extractData() tests

    public function testItExtractsMethodsWithCorrectPrefixes()
    {
        $mockObject = new class() {
            public function getName(): string { return 'TestName'; }

            public function isActive(): bool { return true; }

            public function hasItems(): bool { return false; }

            public function getCount(): int { return 5; }
        };

        $config = ['methodPrefixes' => ['is', 'has', 'get']];
        $result = ReflectionMethodExtractor::extractData($mockObject, $config);

        self::assertArrayHasKey('getName', $result);
        self::assertArrayHasKey('isActive', $result);
        self::assertArrayHasKey('hasItems', $result);
        self::assertArrayHasKey('getCount', $result);
        self::assertEquals('TestName', $result['getName']);
        self::assertEquals(true, $result['isActive']);
        self::assertEquals(false, $result['hasItems']);
        self::assertEquals(5, $result['getCount']);
    }

    public function testItExtractsMethodsWithAllConfiguredPrefixes()
    {
        $mockObject = new class() {
            public function allowsNull(): bool { return true; }

            public function canExecute(): bool { return false; }

            public function inNamespace(): bool { return true; }

            public function returnsReference(): bool { return false; }
        };

        $config = ['methodPrefixes' => ['allows', 'can', 'in', 'returns']];
        $result = ReflectionMethodExtractor::extractData($mockObject, $config);

        self::assertArrayHasKey('allowsNull', $result);
        self::assertArrayHasKey('canExecute', $result);
        self::assertArrayHasKey('inNamespace', $result);
        self::assertArrayHasKey('returnsReference', $result);
    }

    public function testItSkipsMethodsRequiringParameters()
    {
        // Use a real ReflectionClass - it has methods with/without params
        $reflection = new \ReflectionClass(\DateTime::class);
        $config = ['methodPrefixes' => ['get']];
        $result = ReflectionMethodExtractor::extractData($reflection, $config);

        // ReflectionClass methods without required parameters should be extracted
        self::assertArrayHasKey('getName', $result);
        self::assertArrayHasKey('getFileName', $result);
        self::assertArrayHasKey('getStartLine', $result);
        self::assertArrayHasKey('getEndLine', $result);

        // Methods requiring parameters should not be extracted
        // (getMethod, getProperty, getStaticPropertyValue all require params)
        self::assertArrayNotHasKey('getMethod', $result);
        self::assertArrayNotHasKey('getProperty', $result);
        self::assertArrayNotHasKey('getStaticPropertyValue', $result);
    }

    public function testItSkipsMagicMethods()
    {
        $reflection = new \ReflectionClass(\stdClass::class);
        $result = ReflectionMethodExtractor::extractData($reflection, []);

        // Should not extract __construct, __destruct, __toString, etc.
        self::assertArrayNotHasKey('__construct', $result);
        self::assertArrayNotHasKey('__toString', $result);
    }

    public function testItRespectsSkipMethodsConfiguration()
    {
        $mockObject = new class() {
            public function getName(): string { return 'TestName'; }

            public function getValue(): string { return 'TestValue'; }
        };

        $config = [
            'methodPrefixes' => ['get'],
            'skipMethods' => ['getValue']
        ];
        $result = ReflectionMethodExtractor::extractData($mockObject, $config);

        self::assertArrayHasKey('getName', $result);
        self::assertArrayNotHasKey('getValue', $result);
    }

    public function testItHandlesCustomHandlers()
    {
        $mockObject = new class() {
            public function getName(): string { return 'OriginalName'; }
        };

        $config = [
            'methodPrefixes' => ['get'],
            'customHandlers' => [
                'getName' => function ($obj, $methodName) {
                    return 'CustomHandled: ' . $obj->getName();
                }
            ]
        ];
        $result = ReflectionMethodExtractor::extractData($mockObject, $config);

        self::assertEquals('CustomHandled: OriginalName', $result['getName']);
    }

    public function testItCatchesExceptionsGracefully()
    {
        $mockObject = new class() {
            public function getName(): string { return 'ValidName'; }

            public function getError(): string { throw new \Exception('Test exception'); }
        };

        $config = ['methodPrefixes' => ['get']];
        $result = ReflectionMethodExtractor::extractData($mockObject, $config);

        // getName should be extracted
        self::assertArrayHasKey('getName', $result);
        // getError should be skipped due to exception
        self::assertArrayNotHasKey('getError', $result);
    }

    // makeSerializable() tests

    public function testItHandlesNullAndFalseCorrectly()
    {
        self::assertNull(ReflectionMethodExtractor::makeSerializable(null));
        self::assertFalse(ReflectionMethodExtractor::makeSerializable(false));
    }

    public function testItHandlesPrimitives()
    {
        self::assertEquals('test', ReflectionMethodExtractor::makeSerializable('test'));
        self::assertEquals(42, ReflectionMethodExtractor::makeSerializable(42));
        self::assertEquals(3.14, ReflectionMethodExtractor::makeSerializable(3.14));
        self::assertTrue(ReflectionMethodExtractor::makeSerializable(true));
    }

    public function testItRecursivelyProcessesArrays()
    {
        $input = [
            'name' => 'test',
            'count' => 5,
            'nested' => ['a' => 1, 'b' => 2]
        ];
        $result = ReflectionMethodExtractor::makeSerializable($input);

        self::assertEquals($input, $result);
        self::assertIsArray($result);
        self::assertIsArray($result['nested']);
    }

    public function testItWrapsReflectionClassToAdaptedReflectionClass()
    {
        $reflectionClass = new \ReflectionClass(\stdClass::class);
        $result = ReflectionMethodExtractor::makeSerializable($reflectionClass);

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
        $result = ReflectionMethodExtractor::makeSerializable($deep, 0, 3);
        self::assertIsArray($result);
    }

    public function testItReturnsAdaptedReflectionObjectsAsIs()
    {
        $reflectionClass = new \ReflectionClass(\stdClass::class);
        $adapted = new AdaptedReflectionClass($reflectionClass);

        $result = ReflectionMethodExtractor::makeSerializable($adapted);

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

        $result = ReflectionMethodExtractor::makeSerializable($obj);
        self::assertEquals('StringRepresentation', $result);
    }

    public function testItReturnsClassNameForNonSerializableObjects()
    {
        $obj = new \stdClass();
        $result = ReflectionMethodExtractor::makeSerializable($obj);

        self::assertEquals('stdClass', $result);
    }
}
