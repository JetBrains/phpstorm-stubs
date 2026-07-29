<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Reflection\Wrappers\ReflectionMethodExtractor;

/**
 * Covers extractData(): calling getter methods on a reflection object and collecting results.
 *
 * makeSerializable() used to live on this class too and its tests were here; both moved to
 * ReflectionValueNormalizer, which is what they were always about — normalising arbitrary
 * reflected values has nothing to do with extracting methods.
 *
 * @see ReflectionValueNormalizerTest
 */
class ReflectionMethodExtractorTest extends TestCase
{
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
}
