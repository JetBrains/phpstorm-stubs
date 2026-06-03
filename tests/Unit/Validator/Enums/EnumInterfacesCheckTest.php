<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Enums\EnumInterfacesCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class EnumInterfacesCheckTest extends CheckTestCase
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
        $check = new EnumInterfacesCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Enum not found ────────────────────────────────────────────────────────

    public function testEnumNotFoundInReflectionIsFailure(): void
    {
        $enumId = '\MissingEnum';
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumInterfacesCheck($provider))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$enumId]);
    }

    public function testEnumNotFoundInStubsIsFailure(): void
    {
        $enumId = '\MissingEnum';
        $reflEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([]);

        $result = (new EnumInterfacesCheck($provider))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$enumId]);
    }

    // ── Interface matching ────────────────────────────────────────────────────

    public function testMatchingInterfacesPasses(): void
    {
        $enumId = '\RoundingMode';
        $unitEnum = $this->makeInterface('\UnitEnum');

        $reflEnum = $this->makeEnum($enumId, interfaces: [$unitEnum]);
        $stubEnum = $this->makeEnum($enumId, interfaces: [$unitEnum]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumInterfacesCheck($provider))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testEnumWithNoInterfacesPasses(): void
    {
        $enumId = '\MyEnum';
        $reflEnum = $this->makeEnum($enumId);
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumInterfacesCheck($provider))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testSpuriousInterfaceInStubsFails(): void
    {
        // Reflection says enum implements UnitEnum, stub also adds NonExistentIface (spurious)
        $enumId = '\RoundingMode';
        $unitEnum = $this->makeInterface('\UnitEnum');
        $spurious = $this->makeInterface('\NonExistentIface');

        $reflEnum = $this->makeEnum($enumId, interfaces: [$unitEnum]);
        $stubEnum = $this->makeEnum($enumId, interfaces: [$unitEnum, $spurious]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumInterfacesCheck($provider))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId, $failures);
        $this->assertStringContainsString('NonExistentIface', $failures[$enumId]);
        $this->assertStringContainsString('not in reflection', $failures[$enumId]);
    }

    public function testMissingInterfaceInStubsDoesNotFail(): void
    {
        // Reflection reports UnitEnum and BackedEnum (transitively), stub only declares BackedEnum.
        // This is fine — we only check spurious stubs entries, not missing ones.
        $enumId = '\Dom\AdjacentPosition';
        $backedEnum = $this->makeInterface('\BackedEnum');
        $unitEnum = $this->makeInterface('\UnitEnum');

        $reflEnum = $this->makeEnum($enumId, interfaces: [$backedEnum, $unitEnum]);
        $stubEnum = $this->makeEnum($enumId, interfaces: [$backedEnum]);  // UnitEnum omitted (inherited transitively)

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumInterfacesCheck($provider))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testEnumLevelKnownProblemSkipsInterfaceCheck(): void
    {
        $enumId = '\SpecialEnum';
        $spurious = $this->makeInterface('\SpuriousIface');

        $reflEnum = $this->makeEnum($enumId);
        $stubEnum = $this->makeEnum($enumId, interfaces: [$spurious]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::ENUM_TYPE,
                entityId: $enumId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::ENUM_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::LATEST),
                reason: 'Enum-level interface skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new EnumInterfacesCheck($provider, $registry))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Enum-level interface skip', $successes[0]);
    }
}
