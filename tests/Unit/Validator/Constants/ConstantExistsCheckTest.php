<?php

namespace StubTests\Unit\Validator\Constants;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Constants\ConstantExistsCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ConstantExistsCheckTest extends CheckTestCase
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

    public function testSupportsAllVersions(): void
    {
        $check = new ConstantExistsCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_5_6->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Constant found in stubs ───────────────────────────────────────────────

    public function testConstantFoundInStubsPasses(): void
    {
        $constantId = '\\PHP_INT_MAX';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$this->makeGlobalConstant($constantId)]);

        $result = (new ConstantExistsCheck())->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Constant not found in stubs ───────────────────────────────────────────

    public function testConstantNotFoundInStubsFails(): void
    {
        $constantId = '\\SOME_MISSING_CONSTANT';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([]);

        $result = (new ConstantExistsCheck())->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($constantId, $failures);
        $this->assertStringContainsString('not in stubs', $failures[$constantId]);
    }

    public function testConstantNotFoundOnOlderVersionFails(): void
    {
        $constantId = '\\PHP_EOL';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([]);

        $result = (new ConstantExistsCheck())->run($stubs, $constantId, PhpVersions::PHP_5_6->value);

        $this->assertTrue($result->hasFailures());
    }

    // ── Multiple constants in stubs ───────────────────────────────────────────

    public function testCorrectConstantAmongMultiplePasses(): void
    {
        $constantId = '\\PHP_MAJOR_VERSION';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([
            $this->makeGlobalConstant('\\PHP_MINOR_VERSION'),
            $this->makeGlobalConstant($constantId),
            $this->makeGlobalConstant('\\PHP_RELEASE_VERSION'),
        ]);

        $result = (new ConstantExistsCheck())->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problem skip ────────────────────────────────────────────────────

    public function testKnownProblemSkipsCheck(): void
    {
        $constantId = '\\TRUE';

        $knownProblemsProvider = $this->createMock(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: $constantId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CONSTANT_EXISTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'PHP language keyword reported as constant by reflection'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([]);

        $result = (new ConstantExistsCheck(knownProblemsRegistry: $registry))->run($stubs, $constantId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('skipped', $result->getSuccesses()[0]);
        $this->assertStringContainsString('PHP language keyword', $result->getSuccesses()[0]);
    }

    public function testKnownProblemOnlySkipsForVersionRange(): void
    {
        $constantId = '\\SOME_VERSIONED_CONSTANT';

        $knownProblemsProvider = $this->createMock(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: $constantId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CONSTANT_EXISTS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::PHP_8_3),
                reason: 'Only present in 8.0-8.3'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([]);

        // Within the version range — skipped
        $result = (new ConstantExistsCheck(knownProblemsRegistry: $registry))->run($stubs, $constantId, PhpVersions::PHP_8_1->value);
        $this->assertFalse($result->hasFailures());

        // Outside the version range (8.4) — NOT skipped, still missing → fails
        $result = (new ConstantExistsCheck(knownProblemsRegistry: $registry))->run($stubs, $constantId, PhpVersions::PHP_8_4->value);
        $this->assertTrue($result->hasFailures());
    }
}
