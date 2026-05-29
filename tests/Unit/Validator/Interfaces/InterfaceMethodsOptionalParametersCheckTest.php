<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsOptionalParametersCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceMethodsOptionalParametersCheckTest extends CheckTestCase
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
        $check = new ClassMethodsOptionalParametersCheck(entityTypeConfig: EntityTypeConfig::forInterface());
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

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

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

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Interface', $result->getFailures()[$interfaceId]);
        $this->assertStringNotContainsString('Class', $result->getFailures()[$interfaceId]);
    }

    // ── Optional parameter matching ───────────────────────────────────────────

    public function testBothOptionalIsSuccess(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: true)]),
        ]);
        $stubIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: true)]),
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothRequiredIsSuccess(): void
    {
        $interfaceId = '\MyInterface';
        $reflIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('value', optional: false)]),
        ]);
        $stubIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('value', optional: false)]),
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testReflectionOptionalStubRequiredIsFailure(): void
    {
        $interfaceId = '\MyInterface';
        $methodId    = $interfaceId . '::doWork';

        $reflIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: true)]),  // optional
        ]);
        $stubIface = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: false)]),  // required → mismatch
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($methodId, $failures);
        $this->assertStringContainsString('optional', $failures[$methodId]);
        $this->assertStringNotContainsString('Class', $failures[$methodId]);
    }

    public function testStubOptionalReflectionRequiredIsNotReported(): void
    {
        // One-directional: only reflection-optional → stub must be optional.
        $interfaceId = '\MyInterface';
        $reflIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('value', optional: false)]),  // required
        ]);
        $stubIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('value', optional: true)]),   // optional → not reported
        ]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Parent interface traversal ────────────────────────────────────────────

    public function testOptionalParamFromParentInterfaceIsCounted(): void
    {
        $childId   = '\ChildInterface';
        $reflIface = $this->makeInterface($childId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: true)]),
        ]);

        $parentStub = $this->makeInterface('\ParentInterface', [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: true)]),
        ]);
        $childStub  = $this->makeInterface($childId);
        $childStub->addParentInterface($parentStub);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$childStub]);

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $childId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testInterfaceLevelKnownProblemSkipsAllMethods(): void
    {
        $interfaceId = '\SpecialInterface';
        $reflIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: true)]),
        ]);
        $stubIface   = $this->makeInterface($interfaceId, [
            $this->makeMethod('doWork', parameters: [$this->makeParam('config', optional: false)]),  // mismatch
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::INTERFACE_TYPE,
                entityId: $interfaceId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Interface-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('skipped', $result->getSuccesses()[0]);
    }
}
