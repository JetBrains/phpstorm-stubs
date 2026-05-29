<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\MethodDeprecationCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceMethodDeprecationCheckTest extends CheckTestCase
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
        $check = new MethodDeprecationCheck(entityTypeConfig: EntityTypeConfig::forInterface());
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

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

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

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Interface', $result->getFailures()[$interfaceId]);
        $this->assertStringNotContainsString('Class', $result->getFailures()[$interfaceId]);
    }

    // ── Deprecation matching ──────────────────────────────────────────────────

    public function testBothNotDeprecatedIsSuccess(): void
    {
        $interfaceId = '\Iterator';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('current', isDeprecated: false)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('current', isDeprecated: false)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothDeprecatedIsSuccess(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('oldMethod', isDeprecated: true)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('oldMethod', isDeprecated: true)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testReflectionDeprecatedStubNotIsFailure(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('oldMethod', isDeprecated: true)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('oldMethod', isDeprecated: false)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($interfaceId . '::oldMethod', $failures);
        $this->assertStringContainsString('deprecated', $failures[$interfaceId . '::oldMethod']);
    }

    public function testStubDeprecatedReflectionNotIsNotReported(): void
    {
        // One-directional: only reflection-deprecated → stub must be deprecated.
        $interfaceId = '\MyInterface';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('method', isDeprecated: false)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('method', isDeprecated: true)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Parent interface traversal ────────────────────────────────────────────

    public function testDeprecatedMethodInheritedFromParentInterfaceIsCounted(): void
    {
        $childId   = '\ChildInterface';
        $reflIface = $this->makeInterface($childId, [$this->makeMethod('oldMethod', isDeprecated: true)]);

        $parentStub = $this->makeInterface('\ParentInterface', [$this->makeMethod('oldMethod', isDeprecated: true)]);
        $childStub  = $this->makeInterface($childId);
        $childStub->addParentInterface($parentStub);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$childStub]);

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $childId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testInterfaceLevelKnownProblemSkipsAllMethods(): void
    {
        $interfaceId = '\SpecialInterface';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('oldMethod', isDeprecated: true)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('oldMethod', isDeprecated: false)]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::INTERFACE_TYPE,
                entityId: $interfaceId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::DEPRECATION],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Interface-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new MethodDeprecationCheck(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('skipped', $result->getSuccesses()[0]);
    }
}
