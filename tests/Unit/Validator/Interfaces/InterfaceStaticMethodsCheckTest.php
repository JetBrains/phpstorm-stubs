<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassStaticMethodsCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceStaticMethodsCheckTest extends CheckTestCase
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
        $check = new ClassStaticMethodsCheck(entityTypeConfig: EntityTypeConfig::forInterface());
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

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

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

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Interface', $result->getFailures()[$interfaceId]);
        $this->assertStringNotContainsString('Class', $result->getFailures()[$interfaceId]);
    }

    // ── Static flag matching ──────────────────────────────────────────────────

    public function testBothStaticIsSuccess(): void
    {
        // UnitEnum::cases() is a real-world example of a static interface method.
        $interfaceId = '\UnitEnum';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('cases', isStatic: true)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('cases', isStatic: true)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothNonStaticIsSuccess(): void
    {
        $interfaceId = '\Iterator';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('current', isStatic: false)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('current', isStatic: false)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testReflectionStaticStubNonStaticIsFailure(): void
    {
        $interfaceId = '\UnitEnum';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('cases', isStatic: true)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('cases', isStatic: false)]);  // mismatch

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($interfaceId . '::cases', $failures);
        $this->assertStringContainsString('static', $failures[$interfaceId . '::cases']);
    }

    public function testReflectionNonStaticStubStaticIsFailure(): void
    {
        $interfaceId = '\Iterator';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('current', isStatic: false)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('current', isStatic: true)]);  // mismatch

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($interfaceId . '::current', $result->getFailures());
    }

    // ── Parent interface traversal ────────────────────────────────────────────

    public function testStaticMethodFromParentInterfaceIsCounted(): void
    {
        // BackedEnum extends UnitEnum. cases() is declared static in UnitEnum.
        $backedEnumId   = '\BackedEnum';
        $reflIface      = $this->makeInterface($backedEnumId, [
            $this->makeMethod('cases', isStatic: true),  // inherited from UnitEnum
            $this->makeMethod('from', isStatic: true),
        ]);

        $unitEnumStub   = $this->makeInterface('\UnitEnum', [$this->makeMethod('cases', isStatic: true)]);
        $backedEnumStub = $this->makeInterface($backedEnumId, [$this->makeMethod('from', isStatic: true)]);
        $backedEnumStub->addParentInterface($unitEnumStub);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$backedEnumStub]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $backedEnumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testStaticMismatchInParentInterfaceIsReported(): void
    {
        $backedEnumId   = '\BackedEnum';
        $reflIface      = $this->makeInterface($backedEnumId, [
            $this->makeMethod('cases', isStatic: true),  // reflection: static
        ]);

        $unitEnumStub   = $this->makeInterface('\UnitEnum', [
            $this->makeMethod('cases', isStatic: false),  // stub: non-static → mismatch
        ]);
        $backedEnumStub = $this->makeInterface($backedEnumId);
        $backedEnumStub->addParentInterface($unitEnumStub);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$backedEnumStub]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $backedEnumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($backedEnumId . '::cases', $result->getFailures());
    }

    // ── Known problems — interface level ──────────────────────────────────────

    public function testInterfaceLevelKnownProblemSkipsAllMethods(): void
    {
        $interfaceId = '\SpecialInterface';
        $reflIface   = $this->makeInterface($interfaceId, [$this->makeMethod('create', isStatic: true)]);
        $stubIface   = $this->makeInterface($interfaceId, [$this->makeMethod('create', isStatic: false)]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::INTERFACE_TYPE,
                entityId: $interfaceId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Interface-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('skipped', $result->getSuccesses()[0]);
    }
}
