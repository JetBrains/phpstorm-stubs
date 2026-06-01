<?php

namespace StubTests\Unit\Validator\Classes\Constants;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsValueCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassConstantsValueCheckTest extends CheckTestCase
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
        $check = new ClassConstantsValueCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_5_6->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testClassNotFoundInReflectionFails(): void
    {
        $classId = '\\DateTime';
        $stubClass = $this->makeClass($classId);

        $provider = $this->createMockReflectionProviderWithClasses([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$classId]);
        $this->assertStringContainsString('Class', $result->getFailures()[$classId]);
    }

    public function testClassNotFoundInStubsFails(): void
    {
        $classId = '\\DateTime';
        $reflClass = $this->makeClass($classId);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$classId]);
    }

    // ── Matching values ───────────────────────────────────────────────────────

    public function testMatchingValuesPasses(): void
    {
        $classId = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', 'Y-m-d\\TH:i:sP')]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', 'Y-m-d\\TH:i:sP')]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testNoConstantsPasses(): void
    {
        $classId = '\\stdClass';
        $reflClass = $this->makeClass($classId);
        $stubClass = $this->makeClass($classId);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Value mismatch ────────────────────────────────────────────────────────

    public function testValueMismatchFailsOnLatestPhp(): void
    {
        $classId = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 42)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 0)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($classId . '::VERSION', $failures);
        $this->assertStringContainsString('value mismatch', $failures[$classId . '::VERSION']);
        $this->assertStringContainsString("reflection='42'", $failures[$classId . '::VERSION']);
        $this->assertStringContainsString("stub='0'", $failures[$classId . '::VERSION']);
    }

    public function testValueMismatchSkippedOnNonLatestPhp(): void
    {
        // Value comparison is intentionally skipped on non-latest PHP versions
        $classId = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 42)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 0)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::PHP_8_0->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testNullStubValueSkipsValueCheck(): void
    {
        // Stub has null value (complex expression) — value check is skipped
        $classId = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 42)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', null)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testNullReflectionValueSkipsValueCheck(): void
    {
        // Reflection has null value — value check is skipped
        $classId = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', null)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 99)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Constant not in reflection is skipped ─────────────────────────────────

    public function testConstantNotInReflectionIsSkipped(): void
    {
        // Existence is ClassConstantsCheck's responsibility; value check silently skips
        $classId = '\\DateTime';
        $reflClass = $this->makeClass($classId); // no constants in reflection
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('GHOST', 42)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsEntireCheck(): void
    {
        $classId = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('FOO', 1)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('FOO', 99)]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $classId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Value skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider, $registry))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Value skip reason', $successes[0]);
    }

    public function testConstantLevelKnownProblemSkipsSpecificConstant(): void
    {
        $classId = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('STABLE', 10),
            $this->makeClassConstant('ICU_DEPENDENT', 1),
        ]);
        $stubClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('STABLE', 10),
            $this->makeClassConstant('ICU_DEPENDENT', 99), // value differs → known problem
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: $classId . '::ICU_DEPENDENT',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'ICU-version-dependent value'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsValueCheck($provider, $registry))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
        $foundSkip = false;
        foreach ($result->getSuccesses() as $success) {
            if (str_contains($success, 'ICU-version-dependent value')) {
                $foundSkip = true;
                break;
            }
        }
        $this->assertTrue($foundSkip, 'Expected a success entry explaining the constant skip');
    }
}
