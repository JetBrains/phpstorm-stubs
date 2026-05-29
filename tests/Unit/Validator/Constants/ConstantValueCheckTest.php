<?php

namespace StubTests\Unit\Validator\Constants;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Constants\ConstantValueCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Unit\Validator\CheckTestCase;

class ConstantValueCheckTest extends CheckTestCase
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

    private function createMockReflectionProviderWithConstants(array $constants = []): ReflectionProviderInterface
    {
        $provider = $this->createMock(ReflectionProviderInterface::class);
        $manager  = $this->createMockStorageManager();
        $manager->method('getConstants')->willReturn($constants);
        $provider->method('getReflection')->willReturn($manager);
        return $provider;
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $check = new ConstantValueCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_5_6->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Non-LATEST version skips comparison ───────────────────────────────────

    public function testNonLatestVersionSkipsComparison(): void
    {
        $constantId   = '\\PHP_INT_MAX';
        $reflConstant = $this->makeGlobalConstant($constantId, 42);
        $stubConstant = $this->makeGlobalConstant($constantId, 99); // different — would fail at LATEST

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::PHP_8_0->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Matching values ───────────────────────────────────────────────────────

    public function testMatchingIntegerValuePasses(): void
    {
        $constantId   = '\\PHP_INT_MAX';
        $reflConstant = $this->makeGlobalConstant($constantId, 9223372036854775807);
        $stubConstant = $this->makeGlobalConstant($constantId, 9223372036854775807);

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testMatchingStringValuePasses(): void
    {
        $constantId   = '\\DIRECTORY_SEPARATOR';
        $reflConstant = $this->makeGlobalConstant($constantId, '/');
        $stubConstant = $this->makeGlobalConstant($constantId, '/');

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Value mismatch ────────────────────────────────────────────────────────

    public function testValueMismatchFailsAtLatestVersion(): void
    {
        $constantId   = '\\SOME_CONSTANT';
        $reflConstant = $this->makeGlobalConstant($constantId, 42);
        $stubConstant = $this->makeGlobalConstant($constantId, 0);

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($constantId, $failures);
        $this->assertStringContainsString('value mismatch', $failures[$constantId]);
        $this->assertStringContainsString("reflection='42'", $failures[$constantId]);
        $this->assertStringContainsString("stub='0'", $failures[$constantId]);
    }

    // ── Null values ───────────────────────────────────────────────────────────

    public function testNullStubValueSkipsCheck(): void
    {
        $constantId   = '\\SOME_CONSTANT';
        $reflConstant = $this->makeGlobalConstant($constantId, 42);
        $stubConstant = $this->makeGlobalConstant($constantId, null); // complex expression in stub

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testNullReflectionValueSkipsCheck(): void
    {
        $constantId   = '\\SOME_CONSTANT';
        $reflConstant = $this->makeGlobalConstant($constantId, null);
        $stubConstant = $this->makeGlobalConstant($constantId, 42);

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Resource values ───────────────────────────────────────────────────────

    public function testResourceValueSkipsCheck(): void
    {
        // Reflection stores resource constants as 'PHPSTORM_RESOURCE'
        $constantId   = '\\STDIN';
        $reflConstant = $this->makeGlobalConstant($constantId, 'PHPSTORM_RESOURCE');
        $stubConstant = $this->makeGlobalConstant($constantId, null);

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Missing constants ─────────────────────────────────────────────────────

    public function testConstantNotFoundInReflectionPasses(): void
    {
        $constantId   = '\\PHP_INT_MAX';
        $stubConstant = $this->makeGlobalConstant($constantId, 9223372036854775807);

        $provider = $this->createMockReflectionProviderWithConstants([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testConstantNotFoundInStubsPasses(): void
    {
        // Existence is ConstantExistsCheck's responsibility; value check silently skips
        $constantId   = '\\PHP_INT_MAX';
        $reflConstant = $this->makeGlobalConstant($constantId, 9223372036854775807);

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([]);

        $result = (new ConstantValueCheck($provider))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testKnownProblemSkipsCheck(): void
    {
        $constantId   = '\\ICU_CONSTANT';
        $reflConstant = $this->makeGlobalConstant($constantId, 42);
        $stubConstant = $this->makeGlobalConstant($constantId, 0); // mismatch

        $knownProblemsProvider = $this->createMock(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: $constantId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'ICU-version-dependent value'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        $result = (new ConstantValueCheck($provider, $registry))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('skipped', $result->getSuccesses()[0]);
        $this->assertStringContainsString('ICU-version-dependent value', $result->getSuccesses()[0]);
    }

    public function testKnownProblemOnlySkipsForVersionRange(): void
    {
        $constantId   = '\\SOME_CONSTANT';
        $reflConstant = $this->makeGlobalConstant($constantId, 42);
        $stubConstant = $this->makeGlobalConstant($constantId, 0); // mismatch

        $knownProblemsProvider = $this->createMock(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: $constantId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::PHP_8_3),
                reason: 'Only a known issue in 8.0-8.3'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithConstants([$reflConstant]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$stubConstant]);

        // Within the known-problem version range — skipped
        $result = (new ConstantValueCheck($provider, $registry))->run($stubs, $constantId, PhpVersions::PHP_8_1->value);
        $this->assertFalse($result->hasFailures());

        // Outside the version range (LATEST = 8.4) — not skipped, comparison runs, mismatch found
        $result = (new ConstantValueCheck($provider, $registry))->run($stubs, $constantId, PhpVersions::LATEST->value);
        $this->assertTrue($result->hasFailures());
    }
}
