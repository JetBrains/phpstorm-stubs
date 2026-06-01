<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDeprecationCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassMethodsParameterDeprecationCheckTest extends CheckTestCase
{
    private ClassMethodsParameterDeprecationCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsParameterDeprecationCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Class not found ───────────────────────────────────────────────────────

    public function testClassNotFoundInReflectionIsFailure(): void
    {
        $className = '\MissingClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], []);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$className]);
    }

    public function testClassNotFoundInStubsIsFailure(): void
    {
        $className = '\MissingClass';
        $reflClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$className]);
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testClassWithNoMethodsSucceeds(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothParamsNotDeprecatedIsSuccess(): void
    {
        $className = '\MyClass';

        $reflMethod = $this->createMockMethod('doWork', [$this->makeParam('value')]);
        $stubMethod = $this->createMockMethod('doWork', [$this->makeParam('value')]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothParamsDeprecatedIsSuccess(): void
    {
        $className = '\MyClass';

        $reflMethod = $this->createMockMethod('doWork', [$this->makeParam('oldParam', deprecated: true)]);
        $stubMethod = $this->createMockMethod('doWork', [$this->makeParam('oldParam', deprecated: true)]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testDeprecatedInReflectionButNotInStubsIsFailure(): void
    {
        $className = '\MyClass';

        $reflMethod = $this->createMockMethod('define', [$this->makeParam('case_insensitive', deprecated: true)]);
        $stubMethod = $this->createMockMethod('define', [$this->makeParam('case_insensitive')]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failureKey = $className . '::define';
        $this->assertArrayHasKey($failureKey, $result->getFailures());
        $this->assertStringContainsString('$case_insensitive', $result->getFailures()[$failureKey]);
        $this->assertStringContainsString('deprecated in PHP 8.0', $result->getFailures()[$failureKey]);
    }

    public function testDeprecatedInStubsButNotInReflectionIsSuccess(): void
    {
        // One-way check: stubs can be more conservative
        $className = '\MyClass';

        $reflMethod = $this->createMockMethod('doWork', [$this->makeParam('oldParam')]);
        $stubMethod = $this->createMockMethod('doWork', [$this->makeParam('oldParam', deprecated: true)]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMultipleParamsMismatchReportsAll(): void
    {
        $className = '\MyClass';

        $reflMethod = $this->createMockMethod('doWork', [
            $this->makeParam('a', deprecated: true),
            $this->makeParam('b'),
            $this->makeParam('c', deprecated: true),
        ]);
        $stubMethod = $this->createMockMethod('doWork', [
            $this->makeParam('a'),
            $this->makeParam('b'),
            $this->makeParam('c'),
        ]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failureKey = $className . '::doWork';
        $this->assertStringContainsString('$a', $result->getFailures()[$failureKey]);
        $this->assertStringContainsString('$c', $result->getFailures()[$failureKey]);
        $this->assertStringNotContainsString('$b', $result->getFailures()[$failureKey]);
    }

    public function testMethodMissingFromStubsIsNotReported(): void
    {
        $className = '\MyClass';

        $reflMethod = $this->createMockMethod('onlyInRefl', [$this->makeParam('p', deprecated: true)]);
        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testParamMissingFromStubsIsNotReported(): void
    {
        $className = '\MyClass';

        $reflMethod = $this->createMockMethod('doWork', [
            $this->makeParam('kept'),
            $this->makeParam('removed', deprecated: true),
        ]);
        // Stub only has 'kept' — 'removed' is absent
        $stubMethod = $this->createMockMethod('doWork', [
            $this->makeParam('kept'),
        ]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems — class level ──────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllMethods(): void
    {
        $className = '\SpecialClass';

        $reflMethod = $this->createMockMethod('doWork', [$this->makeParam('p', deprecated: true)]);
        $stubMethod = $this->createMockMethod('doWork', [$this->makeParam('p')]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETER_DEPRECATION],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Class-level skip reason', array_values($skipped)[0]);
    }

    // ── Known problems — method level ─────────────────────────────────────────

    public function testMethodLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className = '\MyClass';
        $mismatchedId = $className . '::doWork';

        $reflMethod = $this->createMockMethod('doWork', [$this->makeParam('p', deprecated: true)]);
        $stubMethod = $this->createMockMethod('doWork', [$this->makeParam('p')]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null, [$reflMethod]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$stubMethod]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETER_DEPRECATION],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDeprecationCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level skip reason', array_values($skipped)[0]);
    }
}
