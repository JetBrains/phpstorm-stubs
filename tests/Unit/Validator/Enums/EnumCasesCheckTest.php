<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Enums\EnumCasesCheck;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class EnumCasesCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $check = new EnumCasesCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── All cases match ───────────────────────────────────────────────────────

    public function testMatchingCasesPasses(): void
    {
        $enumId = '\\RoundingMode';
        $cases = ['HalfAwayFromZero', 'HalfTowardsZero'];
        $reflEnum = $this->makeEnum($enumId, cases: $cases);
        $stubEnum = $this->makeEnum($enumId, cases: $cases);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumCasesCheck($provider))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── No cases ──────────────────────────────────────────────────────────────

    public function testNoCasesPasses(): void
    {
        $enumId = '\\Empty_';
        $reflEnum = $this->makeEnum($enumId);
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumCasesCheck($provider))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Missing case in stubs ─────────────────────────────────────────────────

    public function testMissingCaseInStubsFails(): void
    {
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, cases: ['HalfAwayFromZero', 'HalfTowardsZero']);
        $stubEnum = $this->makeEnum($enumId, cases: ['HalfAwayFromZero']); // missing HalfTowardsZero

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumCasesCheck($provider))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId, $failures);
        $this->assertStringContainsString('HalfTowardsZero', $failures[$enumId]);
        $this->assertStringContainsString('missing', $failures[$enumId]);
    }

    // ── Extra case in stubs not reported ─────────────────────────────────────

    public function testExtraCaseInStubsNotReported(): void
    {
        // Extra stubs cases are not this check's concern
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, cases: ['HalfAwayFromZero']);
        $stubEnum = $this->makeEnum($enumId, cases: ['HalfAwayFromZero', 'Extra']);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumCasesCheck($provider))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Enum not in reflection ────────────────────────────────────────────────

    public function testEnumNotInReflectionFails(): void
    {
        $enumId = '\\Ghost';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$this->makeEnum($enumId)]);

        $provider = $this->createMockReflectionProviderWithEnums([]); // empty reflection

        $result = (new EnumCasesCheck($provider))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection', array_values($result->getFailures())[0]);
    }

    // ── Enum not in stubs ─────────────────────────────────────────────────────

    public function testEnumNotInStubsFails(): void
    {
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, cases: ['HalfAwayFromZero']);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([]); // enum absent from stubs

        $result = (new EnumCasesCheck($provider))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', array_values($result->getFailures())[0]);
    }

    // ── Known problem skip ────────────────────────────────────────────────────

    public function testKnownProblemSkipsEnum(): void
    {
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, cases: ['HalfAwayFromZero']);
        $stubEnum = $this->makeEnum($enumId); // would fail without known problem

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $knownProblemsProvider = $this->createMock(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::ENUM_TYPE,
                entityId: $enumId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::ENUM_CASES],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::LATEST),
                reason: 'Known problem for testing.',
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $result = (new EnumCasesCheck($provider, $registry))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertFalse($result->hasFailures());
        KnownProblemsRegistry::reset();
    }
}
