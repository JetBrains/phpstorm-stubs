<?php

namespace StubTests\Unit\Validator\Enums;

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

class EnumMethodsExistCheckTest extends CheckTestCase
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
        $check = new ClassMethodsExistCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Not found ─────────────────────────────────────────────────────────────

    public function testEnumNotFoundInReflectionIsFailure(): void
    {
        $enumId = '\MissingEnum';
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertStringContainsString('Enum', $failures[$enumId]);
        $this->assertStringContainsString('not found in reflection data', $failures[$enumId]);
        $this->assertStringNotContainsString('Class', $failures[$enumId]);
    }

    public function testEnumNotFoundInStubsIsFailure(): void
    {
        $enumId = '\MissingEnum';
        $reflEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertStringContainsString('Enum', $failures[$enumId]);
        $this->assertStringContainsString('not found in stubs', $failures[$enumId]);
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testEnumWithNoMethodsSucceeds(): void
    {
        $enumId = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId);
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testAllReflectionMethodsPresentInStubs(): void
    {
        $enumId = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testMissingMethodInStubsIsReported(): void
    {
        $enumId = '\Dom\AdjacentPosition';
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('cases'),
            $this->makeMethod('from'),
        ]);
        $stubEnum = $this->makeEnum($enumId, [
            $this->makeMethod('cases'),
            // 'from' is missing
        ]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::from', $failures);
        $this->assertStringContainsString('from', $failures[$enumId . '::from']);
        $this->assertStringNotContainsString('Class', $failures[$enumId . '::from']);
    }

    // ── Interface traversal ───────────────────────────────────────────────────

    public function testMethodInheritedFromImplementedInterfaceIsCounted(): void
    {
        // UnitEnum has cases(). An enum implementing UnitEnum should provide cases() via the interface.
        $enumId = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $unitEnum = $this->makeInterface('\UnitEnum', [$this->makeMethod('cases')]);
        $stubEnum = $this->makeEnum($enumId);
        $stubEnum->setImplementedInterfaces([$unitEnum]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testMethodFromBackedEnumInterfaceIsCounted(): void
    {
        // BackedEnum has from() and tryFrom(). Dom\AdjacentPosition uses BackedEnum.
        $enumId = '\Dom\AdjacentPosition';
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('cases'),
            $this->makeMethod('from'),
            $this->makeMethod('tryFrom'),
        ]);

        $backedEnum = $this->makeInterface('\BackedEnum', [
            $this->makeMethod('from'),
            $this->makeMethod('tryFrom'),
        ]);
        $unitEnum = $this->makeInterface('\UnitEnum', [$this->makeMethod('cases')]);
        $stubEnum = $this->makeEnum($enumId);
        $stubEnum->setImplementedInterfaces([$backedEnum, $unitEnum]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── PS_UNRESERVE_PREFIX_ ──────────────────────────────────────────────────

    public function testPsUnreservePrefixIsStrippedToMatchReflectionName(): void
    {
        $enumId = '\MyEnum';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('list')]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('PS_UNRESERVE_PREFIX_list')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testEnumLevelKnownProblemSkipsAllMethodChecks(): void
    {
        $enumId = '\SpecialEnum';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('missingMethod')]);
        $stubEnum = $this->makeEnum($enumId);  // no methods

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::ENUM_TYPE,
                entityId: $enumId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::LATEST),
                reason: 'Enum-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Enum-level skip reason', $successes[0]);
    }

    public function testMultipleMissingMethodsAreReported(): void
    {
        $enumId = '\Dom\AdjacentPosition';
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('cases'),
            $this->makeMethod('from'),
            $this->makeMethod('tryFrom'),
        ]);
        $stubEnum = $this->makeEnum($enumId);  // no methods

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsExistCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(3, $result->getFailures());
    }
}
