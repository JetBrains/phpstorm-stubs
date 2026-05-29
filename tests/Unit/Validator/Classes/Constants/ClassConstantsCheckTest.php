<?php

namespace StubTests\Unit\Validator\Classes\Constants;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Unit\Validator\CheckTestCase;

class ClassConstantsCheckTest extends CheckTestCase
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
        $check = new ClassConstantsCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_5_6->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testClassNotFoundInReflectionFails(): void
    {
        $classId  = '\\DateTime';
        $stubClass = $this->makeClass($classId);

        $provider = $this->createMockReflectionProviderWithClasses([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$classId]);
    }

    public function testClassNotFoundInStubsFails(): void
    {
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$classId]);
    }

    // ── Matching constants ────────────────────────────────────────────────────

    public function testMatchingConstantPasses(): void
    {
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', 'Y-m-d\\TH:i:sP')]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', 'Y-m-d\\TH:i:sP')]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testNoConstantsPasses(): void
    {
        $classId   = '\\stdClass';
        $reflClass = $this->makeClass($classId);
        $stubClass = $this->makeClass($classId);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Spurious constant in stubs ────────────────────────────────────────────

    public function testSpuriousConstantInStubsFails(): void
    {
        // Stub declares a constant that doesn't exist anywhere in reflection
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId); // no constants in reflection
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('GHOST')]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($classId . '::GHOST', $failures);
        $this->assertStringContainsString('not found in reflection', $failures[$classId . '::GHOST']);
    }

    public function testConstantInReflectionOnlyPasses(): void
    {
        // Constant exists in reflection but not in stub → passes (might be inherited in stubs)
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', 'Y-m-d\\TH:i:sP')]);
        $stubClass = $this->makeClass($classId); // stub doesn't re-declare inherited constant

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Visibility is not checked here ───────────────────────────────────────

    public function testVisibilityMismatchNotCheckedByThisCheck(): void
    {
        // Visibility is validated by ClassConstantsVisibilityCheck, not here.
        // A visibility mismatch alone must not cause ClassConstantsCheck to fail.
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', null, AccessModifier::PUBLIC)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', null, AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Value is not checked here ─────────────────────────────────────────────

    public function testValueMismatchNotCheckedByThisCheck(): void
    {
        // Value comparison is handled by ClassConstantsValueCheck, not here.
        // A value mismatch alone must not cause ClassConstantsCheck to fail.
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 42)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VERSION', 0)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider))->run($stubs, $classId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsEntireCheck(): void
    {
        // Class-level known problem (EntityType::CLASS_TYPE) skips the whole class validation
        $classId   = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('SECRET', 'wrong')]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('SECRET', 'correct')]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $classId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider, $registry))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Test skip reason', $successes[0]);
    }

    public function testConstantLevelKnownProblemSkipsSpecificConstant(): void
    {
        // Constant-level known problem skips only the named constant; other constants are still validated
        $classId   = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('GOOD', 42)]);
        $stubClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('SKIPPED', 'wrong'),  // not in reflection, but has known problem
            $this->makeClassConstant('GOOD', 42),           // matches reflection → passes
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: $classId . '::SKIPPED',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Constant skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider, $registry))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
        // Skipped constant produces a success entry with the reason
        $foundSkip = false;
        foreach ($result->getSuccesses() as $success) {
            if (str_contains($success, 'Constant skip reason')) {
                $foundSkip = true;
                break;
            }
        }
        $this->assertTrue($foundSkip, 'Expected a success entry explaining the constant skip');
    }

    public function testConstantLevelKnownProblemViaEntityIdsList(): void
    {
        // entityIds list: two constants listed; third constant is validated normally
        $classId   = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('GOOD', 42)]);
        $stubClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('DRIVER_A', 1),  // not in reflection → known problem via entityIds
            $this->makeClassConstant('DRIVER_B', 2),  // not in reflection → known problem via entityIds
            $this->makeClassConstant('GOOD', 42),     // matches reflection → passes
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: $classId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Driver constants skip',
                entityIds: [
                    $classId . '::DRIVER_A',
                    $classId . '::DRIVER_B',
                ],
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider, $registry))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testNonSkippedConstantStillFailsWhenOthersAreSkipped(): void
    {
        // Only DRIVER_A is listed in the known problem; SPURIOUS is not → should still fail
        $classId   = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: []);
        $stubClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('DRIVER_A', 1),  // skipped via known problem
            $this->makeClassConstant('SPURIOUS', 99), // not in reflection, NOT in known problem → fails
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: $classId . '::DRIVER_A',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Driver constant',
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsCheck($provider, $registry))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($classId . '::SPURIOUS', $result->getFailures());
    }
}
