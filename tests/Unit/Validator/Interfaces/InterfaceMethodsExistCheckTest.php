<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsExistCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceMethodsExistCheckTest extends CheckTestCase
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
        $check = new ClassMethodsExistCheck(entityTypeConfig: EntityTypeConfig::forInterface());
        $this->assertTrue($check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Not found ─────────────────────────────────────────────────────────────

    public function testInterfaceNotFoundInReflectionIsFailure(): void
    {
        $interfaceId = '\MissingInterface';
        $stubIface = $this->makeInterface($interfaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($interfaceId, $failures);
        $this->assertStringContainsString('Interface', $failures[$interfaceId]);
        $this->assertStringContainsString('not found in reflection data', $failures[$interfaceId]);
        $this->assertStringNotContainsString('Class', $failures[$interfaceId]);
    }

    public function testInterfaceNotFoundInStubsIsFailure(): void
    {
        $interfaceId = '\MissingInterface';
        $reflIface = $this->makeInterface($interfaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($interfaceId, $failures);
        $this->assertStringContainsString('Interface', $failures[$interfaceId]);
        $this->assertStringContainsString('not found in stubs', $failures[$interfaceId]);
        $this->assertStringNotContainsString('Class', $failures[$interfaceId]);
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testInterfaceWithNoMethodsSucceeds(): void
    {
        $interfaceId = '\Countable';
        $reflIface = $this->makeInterface($interfaceId);
        $stubIface = $this->makeInterface($interfaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testAllReflectionMethodsPresentInStubs(): void
    {
        $interfaceId = '\Iterator';
        $reflIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('current'),
            $this->makeMethod('key'),
            $this->makeMethod('next'),
            $this->makeMethod('rewind'),
            $this->makeMethod('valid'),
        ]);
        $stubIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('current'),
            $this->makeMethod('key'),
            $this->makeMethod('next'),
            $this->makeMethod('rewind'),
            $this->makeMethod('valid'),
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMissingMethodInStubsIsReported(): void
    {
        $interfaceId = '\Iterator';
        $reflIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('current'),
            $this->makeMethod('next'),
        ]);
        $stubIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('current'),
            // 'next' is missing
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($interfaceId . '::next', $failures);
        $this->assertStringContainsString('next', $failures[$interfaceId . '::next']);
        $this->assertStringNotContainsString('Class', $failures[$interfaceId . '::next']);
    }

    // ── Parent interface traversal ────────────────────────────────────────────

    public function testMethodInheritedFromParentInterfaceIsCounted(): void
    {
        // OuterIterator extends Iterator. Methods from Iterator must be found via traversal.
        $outerIteratorId = '\OuterIterator';
        $reflIface = $this->makeInterface($outerIteratorId, [
            $this->makeMethod('current'),
            $this->makeMethod('getInnerIterator'),
        ]);

        $iteratorStub = $this->makeInterface('\Iterator', [$this->makeMethod('current')]);
        $outerIteratorStub = $this->makeInterface($outerIteratorId, [$this->makeMethod('getInnerIterator')]);
        $outerIteratorStub->addParentInterface($iteratorStub);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$outerIteratorStub]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $outerIteratorId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMethodInDeepParentInterfaceChainIsCounted(): void
    {
        // InterfaceC → InterfaceB → InterfaceA (has the method).
        $interfaceId = '\InterfaceC';

        $reflIface = $this->makeInterface($interfaceId, [$this->makeMethod('deepMethod')]);

        $ifaceA = $this->makeInterface('\InterfaceA', [$this->makeMethod('deepMethod')]);
        $ifaceB = $this->makeInterface('\InterfaceB');
        $ifaceB->addParentInterface($ifaceA);
        $ifaceC = $this->makeInterface($interfaceId);
        $ifaceC->addParentInterface($ifaceB);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$ifaceC]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testMethodNotYetAvailableIsExcludedFromStubs(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface = $this->makeInterface($interfaceId, [$this->makeMethod('oldMethod')]);
        $stubIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('oldMethod'),
            $this->makeMethod('newMethod', sinceVersion: '8.1'),  // since 8.1, not available in 8.0
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testRemovedMethodIsExcludedFromStubs(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface = $this->makeInterface($interfaceId, [$this->makeMethod('currentMethod')]);
        $stubIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('currentMethod'),
            $this->makeMethod('legacyMethod', removedVersion: '7.4'),  // removed before 8.0
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Cycle detection ───────────────────────────────────────────────────────

    public function testCycleInParentInterfaceChainDoesNotCauseInfiniteLoop(): void
    {
        $interfaceId = '\IfaceA';
        $reflIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('methodA'),
            $this->makeMethod('methodB'),
        ]);

        $ifaceA = $this->makeInterface('\IfaceA', [$this->makeMethod('methodA')]);
        $ifaceB = $this->makeInterface('\IfaceB', [$this->makeMethod('methodB')]);
        $ifaceA->addParentInterface($ifaceB);
        $ifaceB->addParentInterface($ifaceA);  // cycle!

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$ifaceA]);

        // Must complete without infinite recursion; both methods collected before guard fires.
        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── PS_UNRESERVE_PREFIX_ ──────────────────────────────────────────────────

    public function testPsUnreservePrefixIsStrippedToMatchReflectionName(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface = $this->makeInterface($interfaceId, [$this->makeMethod('list')]);
        $stubIface = $this->makeInterface($interfaceId, [$this->makeMethod('PS_UNRESERVE_PREFIX_list')]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testInterfaceLevelKnownProblemSkipsAllMethodChecks(): void
    {
        $interfaceId = '\SpecialInterface';
        $reflIface = $this->makeInterface($interfaceId, [$this->makeMethod('missingMethod')]);
        $stubIface = $this->makeInterface($interfaceId);  // no methods

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::INTERFACE_TYPE,
                entityId: $interfaceId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Interface-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Interface-level skip reason', $successes[0]);
    }

    public function testMethodLevelKnownProblemSkipsSpecificMethod(): void
    {
        $interfaceId = '\MyInterface';
        $missingMethodId = $interfaceId . '::missingMethod';

        $reflIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('presentMethod'),
            $this->makeMethod('missingMethod'),
        ]);
        $stubIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('presentMethod'),
            // 'missingMethod' absent, but covered by known problem
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $missingMethodId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level skip reason', array_values($skipped)[0]);
    }

    public function testMultipleMissingMethodsAreReported(): void
    {
        $interfaceId = '\Iterator';
        $reflIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('valid'),
            $this->makeMethod('current'),
            $this->makeMethod('next'),
        ]);
        $stubIface = $this->makeInterface($interfaceId);  // no methods

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(3, $result->getFailures());
    }
}
