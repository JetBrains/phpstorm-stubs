<?php

namespace StubTests\Unit\Validator\Classes\Constants;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsVisibilityCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Unit\Validator\CheckTestCase;

class ClassConstantsVisibilityCheckTest extends CheckTestCase
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
        $check = new ClassConstantsVisibilityCheck();
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

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

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

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$classId]);
    }

    // ── Matching visibility ───────────────────────────────────────────────────

    public function testNoConstantsPasses(): void
    {
        $classId   = '\\stdClass';
        $reflClass = $this->makeClass($classId);
        $stubClass = $this->makeClass($classId);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMatchingPublicVisibilityPasses(): void
    {
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', visibility: AccessModifier::PUBLIC)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', visibility: AccessModifier::PUBLIC)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMatchingProtectedVisibilityPasses(): void
    {
        $classId   = '\\MyClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('SECRET', visibility: AccessModifier::PROTECTED)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('SECRET', visibility: AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMatchingPrivateVisibilityPasses(): void
    {
        $classId   = '\\MyClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('INTERNAL', visibility: AccessModifier::PRIVATE)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('INTERNAL', visibility: AccessModifier::PRIVATE)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Visibility mismatch ───────────────────────────────────────────────────

    public function testPublicInReflectionProtectedInStubFails(): void
    {
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', visibility: AccessModifier::PUBLIC)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('ATOM', visibility: AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($classId . '::ATOM', $failures);
        $this->assertStringContainsString("'public'", $failures[$classId . '::ATOM']);
        $this->assertStringContainsString("'protected'", $failures[$classId . '::ATOM']);
    }

    public function testProtectedInReflectionPublicInStubFails(): void
    {
        $classId   = '\\MyClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('SECRET', visibility: AccessModifier::PROTECTED)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('SECRET', visibility: AccessModifier::PUBLIC)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($classId . '::SECRET', $result->getFailures());
    }

    public function testPublicInReflectionPrivateInStubFails(): void
    {
        $classId   = '\\MyClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VALUE', visibility: AccessModifier::PUBLIC)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('VALUE', visibility: AccessModifier::PRIVATE)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($classId . '::VALUE', $result->getFailures());
    }

    public function testMultipleConstantsMixedResultsReportedSeparately(): void
    {
        $classId   = '\\MyClass';
        $reflClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('OK', visibility: AccessModifier::PUBLIC),
            $this->makeClassConstant('BAD', visibility: AccessModifier::PUBLIC),
        ]);
        $stubClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('OK', visibility: AccessModifier::PUBLIC),     // matches
            $this->makeClassConstant('BAD', visibility: AccessModifier::PROTECTED),  // mismatch
        ]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($classId . '::BAD', $result->getFailures());
        $this->assertArrayNotHasKey($classId . '::OK', $result->getFailures());
    }

    // ── Constant not in reflection is skipped ─────────────────────────────────

    public function testConstantNotInReflectionIsSkipped(): void
    {
        // Stub declares a constant absent from reflection — ClassConstantsCheck handles this.
        $classId   = '\\DateTime';
        $reflClass = $this->makeClass($classId); // no constants in reflection
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('GHOST', visibility: AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testVersionFilteredConstantIsSkipped(): void
    {
        $classId   = '\\MyClass';
        // Stub constant only available from 8.1 — checking at 8.0 should skip it
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('NEW_CONST', visibility: AccessModifier::PUBLIC)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('NEW_CONST', visibility: AccessModifier::PROTECTED, sinceVersion: '8.1')]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testVersionFilteredRemovedConstantIsSkipped(): void
    {
        $classId   = '\\MyClass';
        // Stub constant removed before current version — should be skipped
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('OLD_CONST', visibility: AccessModifier::PUBLIC)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('OLD_CONST', visibility: AccessModifier::PROTECTED, removedVersion: '8.0')]);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsEntireCheck(): void
    {
        $classId   = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: [$this->makeClassConstant('FLAG', visibility: AccessModifier::PUBLIC)]);
        $stubClass = $this->makeClass($classId, constants: [$this->makeClassConstant('FLAG', visibility: AccessModifier::PROTECTED)]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $classId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS_VISIBILITY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level visibility skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider, $registry))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Class-level visibility skip', $successes[0]);
    }

    public function testConstantLevelKnownProblemSkipsSpecificConstant(): void
    {
        $classId   = '\\SpecialClass';
        $reflClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('GOOD', visibility: AccessModifier::PUBLIC),
            $this->makeClassConstant('LEGACY', visibility: AccessModifier::PUBLIC),
        ]);
        $stubClass = $this->makeClass($classId, constants: [
            $this->makeClassConstant('GOOD',   visibility: AccessModifier::PUBLIC),     // matches → passes
            $this->makeClassConstant('LEGACY', visibility: AccessModifier::PROTECTED),  // mismatch, but has known problem
        ]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: $classId . '::LEGACY',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS_VISIBILITY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Constant-level visibility skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassConstantsVisibilityCheck($provider, $registry))->run($stubs, $classId, '8.0');

        $this->assertFalse($result->hasFailures());
        $foundSkip = false;
        foreach ($result->getSuccesses() as $success) {
            if (str_contains($success, 'Constant-level visibility skip')) {
                $foundSkip = true;
                break;
            }
        }
        $this->assertTrue($foundSkip, 'Expected a success entry explaining the constant skip');
    }
}
