<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsTentativeReturnTypeCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceMethodsTentativeReturnTypeCheckTest extends CheckTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    public function testSupportsPhp81AndAbove(): void
    {
        $check = new ClassMethodsTentativeReturnTypeCheck(entityTypeConfig: EntityTypeConfig::forInterface());
        $this->assertFalse($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testInterfaceNotFoundInReflectionIsFailure(): void
    {
        $ifaceId = '\Iterator';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$this->makeInterface($ifaceId, [$this->makeMethod('current', isTentative: false)])]);

        $result = (new ClassMethodsTentativeReturnTypeCheck(
            reflectionProvider: $this->createMockReflectionProviderWithInterfaces([]),
            entityTypeConfig: EntityTypeConfig::forInterface()
        ))->run($stubs, $ifaceId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$ifaceId]);
    }

    public function testInterfaceNotFoundInStubsIsFailure(): void
    {
        $ifaceId = '\Iterator';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = (new ClassMethodsTentativeReturnTypeCheck(
            reflectionProvider: $this->createMockReflectionProviderWithInterfaces([$this->makeInterface($ifaceId, [$this->makeMethod('current', isTentative: true)])]),
            entityTypeConfig: EntityTypeConfig::forInterface()
        ))->run($stubs, $ifaceId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$ifaceId]);
    }

    public function testMatchingTentativeFlagsSucceed(): void
    {
        $ifaceId = '\Iterator';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$this->makeInterface($ifaceId, [$this->makeMethod('current', isTentative: true)])]);

        $result = (new ClassMethodsTentativeReturnTypeCheck(
            reflectionProvider: $this->createMockReflectionProviderWithInterfaces([$this->makeInterface($ifaceId, [$this->makeMethod('current', isTentative: true)])]),
            entityTypeConfig: EntityTypeConfig::forInterface()
        ))->run($stubs, $ifaceId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testMismatchedTentativeFlagsFailure(): void
    {
        $ifaceId = '\Iterator';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$this->makeInterface($ifaceId, [$this->makeMethod('current', isTentative: false)])]);

        $result = (new ClassMethodsTentativeReturnTypeCheck(
            reflectionProvider: $this->createMockReflectionProviderWithInterfaces([$this->makeInterface($ifaceId, [$this->makeMethod('current', isTentative: true)])]),
            entityTypeConfig: EntityTypeConfig::forInterface()
        ))->run($stubs, $ifaceId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($ifaceId . '::current', $result->getFailures());
        $this->assertStringContainsString('tentative return type', $result->getFailures()[$ifaceId . '::current']);
    }

    public function testParentInterfaceTentativeMethodMismatchIsReported(): void
    {
        $parentId = '\Iterator';
        $childId = '\RecursiveIterator';

        // Reflection reports 'current' as tentative for RecursiveIterator
        $reflChild = $this->makeInterface($childId, [$this->makeMethod('current', isTentative: true)]);

        // Stubs: RecursiveIterator has no methods but extends Iterator (stub)
        $parentStub = $this->makeInterface($parentId, [$this->makeMethod('current', isTentative: false)]);
        $childStub = $this->makeInterface($childId, parentInterfaces: [$parentStub]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$childStub]);

        $result = (new ClassMethodsTentativeReturnTypeCheck(
            reflectionProvider: $this->createMockReflectionProviderWithInterfaces([$reflChild]),
            entityTypeConfig: EntityTypeConfig::forInterface()
        ))->run($stubs, $childId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($childId . '::current', $result->getFailures());
    }
}
