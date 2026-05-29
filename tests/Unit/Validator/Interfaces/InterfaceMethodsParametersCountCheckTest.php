<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParametersCountCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceMethodsParametersCountCheckTest extends CheckTestCase
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

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassMethodsParametersCountCheck(entityTypeConfig: EntityTypeConfig::forInterface());
        $this->assertTrue($check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Not found ─────────────────────────────────────────────────────────────

    public function testInterfaceNotFoundInReflectionIsFailure(): void
    {
        $interfaceId = '\MissingInterface';
        $stubIface   = $this->makeInterface($interfaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Interface', $result->getFailures()[$interfaceId]);
        $this->assertStringNotContainsString('Class', $result->getFailures()[$interfaceId]);
    }

    public function testInterfaceNotFoundInStubsIsFailure(): void
    {
        $interfaceId = '\MissingInterface';
        $reflIface   = $this->makeInterface($interfaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Interface', $result->getFailures()[$interfaceId]);
        $this->assertStringNotContainsString('Class', $result->getFailures()[$interfaceId]);
    }

    // ── Parameter count matching ───────────────────────────────────────────────

    public function testMatchingParameterCountIsSuccess(): void
    {
        $interfaceId = '\Iterator';
        $reflIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('offsetGet', parameters: [$this->makeParam('offset')]),
        ]);
        $stubIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('offsetGet', parameters: [$this->makeParam('offset')]),
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMismatchedParameterCountIsFailure(): void
    {
        $interfaceId = '\ArrayAccess';
        $methodId    = $interfaceId . '::offsetGet';

        $reflIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('offsetGet', parameters: [$this->makeParam('offset')]),  // 1 param
        ]);
        $stubIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('offsetGet', parameters: []),  // 0 params → mismatch
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($methodId, $failures);
        $this->assertStringNotContainsString('Class', $failures[$methodId]);
    }

    public function testInterfaceWithNoMethodsSucceeds(): void
    {
        $interfaceId = '\Countable';
        $reflIface   = $this->makeInterface($interfaceId);
        $stubIface   = $this->makeInterface($interfaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Parameter version filtering ───────────────────────────────────────────

    public function testParameterRemovedBeforeVersionIsExcluded(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doSomething', parameters: [$this->makeParam('current')]),
        ]);
        $stubIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doSomething', parameters: [
                $this->makeParam('current'),
                $this->makeParam('legacy', removedVersion: '7.4'),  // removed before 8.0
            ]),
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Parent interface traversal ────────────────────────────────────────────

    public function testMethodParameterCountFromParentInterfaceIsCounted(): void
    {
        $childId   = '\ChildInterface';
        $reflIface = $this->makeInterface($childId, [
            $this->makeMethod('offsetGet', parameters: [$this->makeParam('offset')]),
        ]);

        $parentStub = $this->makeInterface('\ParentInterface', [
            $this->makeMethod('offsetGet', parameters: [$this->makeParam('offset')]),
        ]);
        $childStub  = $this->makeInterface($childId);
        $childStub->addParentInterface($parentStub);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$childStub]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $childId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testInterfaceLevelKnownProblemSkipsAllMethods(): void
    {
        $interfaceId = '\SpecialInterface';
        $reflIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('method', parameters: [$this->makeParam('a'), $this->makeParam('b')]),
        ]);
        $stubIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('method', parameters: []),  // count mismatch
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::INTERFACE_TYPE,
                entityId: $interfaceId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Interface-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('skipped', $result->getSuccesses()[0]);
    }
}
