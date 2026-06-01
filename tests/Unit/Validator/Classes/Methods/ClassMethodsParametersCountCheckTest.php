<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParametersCountCheck;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;

class ClassMethodsParametersCountCheckTest extends CheckTestCase
{
    private ClassMethodsParametersCountCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsParametersCountCheck();
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

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMatchingParameterCountIsSuccess(): void
    {
        $className = '\MyClass';
        $params = [$this->makeParam('a'), $this->makeParam('b')];

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: $params)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: $params)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testParameterCountMismatchIsFailure(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: [$this->makeParam('a'), $this->makeParam('b')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: [$this->makeParam('a')])] // one param fewer
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doWork', $result->getFailures());
        $this->assertStringContainsString('2', $result->getFailures()[$className . '::doWork']);
        $this->assertStringContainsString('1', $result->getFailures()[$className . '::doWork']);
    }

    public function testMultipleMismatchedMethodsAllReported(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [
                $this->makeMethod('foo', parameters: [$this->makeParam('x'), $this->makeParam('y')]),
                $this->makeMethod('bar', parameters: [$this->makeParam('z')]),
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [
                $this->makeMethod('foo', parameters: [$this->makeParam('x')]),          // mismatch: stub has 1, refl has 2
                $this->makeMethod('bar', parameters: [$this->makeParam('z')]),          // match
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::foo', $result->getFailures());
    }

    // ── Method missing from stubs is not our concern ─────────────────────────

    public function testMethodMissingFromStubsIsNotReportedAsParameterMismatch(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('onlyInReflection', parameters: [$this->makeParam('x')])]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no methods

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── PhpStormStubsElementAvailable (sinceVersion / removedVersion) ─────────

    public function testParamNotYetAddedIsExcludedFromCount(): void
    {
        // Stub has an extra param with sinceVersion=8.1; we check PHP 8.0 → not counted
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('init', parameters: [$this->makeParam('a')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('init', parameters: [
                $this->makeParam('a'),
                $this->makeParam('b', sinceVersion: '8.1'),  // not yet available in 8.0
            ])]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testParamAddedAtExactSinceVersionIsIncluded(): void
    {
        // sinceVersion=8.0, phpVersion=8.0 → included (>= boundary)
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('init', parameters: [$this->makeParam('a'), $this->makeParam('b')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('init', parameters: [
                $this->makeParam('a'),
                $this->makeParam('b', sinceVersion: '8.0'),  // exactly 8.0 → included
            ])]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testParamAtExactRemovedVersionIsStillIncluded(): void
    {
        // removedVersion is the EXCLUSIVE upper bound (first version where param is gone).
        // removedVersion='7.2' means "available up to and including PHP 7.1".
        // version_compare('7.1','7.2','<') is true → param IS counted for PHP 7.1.
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('legacy', parameters: [$this->makeParam('a'), $this->makeParam('b')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('legacy', parameters: [
                $this->makeParam('a'),
                $this->makeParam('b', removedVersion: '7.2'),  // excluded from 7.2+, so available in 7.1
            ])]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '7.1');

        $this->assertFalse($result->hasFailures(), 'Param included when phpVersion < removedVersion (exclusive boundary)');
    }

    public function testParamAfterRemovedVersionIsExcluded(): void
    {
        // removedVersion=7.1, phpVersion=7.2 → 7.2 > 7.1 → excluded
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('legacy', parameters: [$this->makeParam('a')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('legacy', parameters: [
                $this->makeParam('a'),
                $this->makeParam('b', removedVersion: '7.1'),  // gone in 7.2+
            ])]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '7.2');

        $this->assertFalse($result->hasFailures(), 'Param excluded after removedVersion');
    }

    public function testVersionWindowParamCountedOnlyWithinRange(): void
    {
        // Param available from=7.0, removedVersion=7.2 (exclusive boundary, meaning last included = 7.1):
        //   PHP 7.0 → included (stub=2, refl=2 → ok)
        //   PHP 7.1 → included (stub=2, refl=2 → ok)
        //   PHP 7.2 → excluded (stub=1, refl=1 → ok)
        $className = '\MyClass';
        $stubMethod = $this->makeMethod('go', parameters: [
            $this->makeParam('x'),
            $this->makeParam('y', sinceVersion: '7.0', removedVersion: '7.2'),  // removedVersion='7.2': excluded from 7.2+
        ]);

        foreach (['7.0', '7.1', '7.2'] as $version) {
            $expected = $version === '7.2' ? 1 : 2;
            $reflClass = $this->createMockClassWithProperties(
                $className,
                null,
                null,
                null,
                [$this->makeMethod('go', parameters: array_fill(0, $expected, $this->makeParam('_')))]
            );
            $stubClass = $this->createMockClassWithProperties(
                $className,
                null,
                null,
                null,
                [$stubMethod]
            );

            $provider = $this->createMockReflectionProvider([], [$reflClass]);
            $stubs = $this->createMockStorageManager();
            $stubs->method('getClasses')->willReturn([$stubClass]);

            $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, $version);
            $this->assertFalse($result->hasFailures(), "PHP {$version} should match (expected {$expected} params)");
        }
    }

    // ── Same-name deduplication (placeholder + variadic) ─────────────────────

    public function testPlaceholderAndVariadicWithSameNameCountAsOne(): void
    {
        // Stub: process($x, $vals[removedVersion:'7.5'], ...$vals)
        // removedVersion='7.5' means excluded from 7.5+, so placeholder IS available in PHP 7.4.
        // In PHP 7.4: placeholder+variadic both available → deduplicated to unique names {'x','vals'} = 2
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('process', parameters: [$this->makeParam('x'), $this->makeParam('vals')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('process', parameters: [
                $this->makeParam('x'),
                $this->makeParam('vals', removedVersion: '7.5'), // placeholder: excluded from 7.5+, available in 7.4
                $this->makeParam('vals'),              // variadic: always available
            ])]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '7.4');

        $this->assertFalse($result->hasFailures(), 'Placeholder+variadic with same name counted as one');
    }

    public function testVariadicAloneCountsNormallyWhenPlaceholderExcluded(): void
    {
        // In PHP 8.0: placeholder excluded (removedVersion='7.5' means excluded from 7.5+),
        // only variadic 'vals' counts → unique names {'x','vals'} = 2
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('process', parameters: [$this->makeParam('x'), $this->makeParam('vals')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('process', parameters: [
                $this->makeParam('x'),
                $this->makeParam('vals', removedVersion: '7.5'), // excluded from 7.5+ (including PHP 8.0)
                $this->makeParam('vals'),              // only this counts in PHP 8.0
            ])]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures(), 'Variadic alone (placeholder excluded) counts normally');
    }

    // ── Hierarchy: method from parent class ───────────────────────────────────

    public function testMethodInheritedFromParentIsChecked(): void
    {
        $className = '\Child';
        $parentClassName = '\Parent';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: [$this->makeParam('a'), $this->makeParam('b')])]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('doWork', parameters: [$this->makeParam('a')])]); // wrong count

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doWork', $result->getFailures());
    }

    public function testChildMethodOverridesParentForParameterCountCheck(): void
    {
        $className = '\Child';
        $parentClassName = '\Parent';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: [$this->makeParam('a'), $this->makeParam('b')])]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('doWork', parameters: [$this->makeParam('a')])]); // wrong in parent

        $childStub = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: [$this->makeParam('a'), $this->makeParam('b')])] // correct in child
        );
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsParametersCountCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems — class level ──────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllMethods(): void
    {
        $className = '\SpecialClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: [$this->makeParam('a'), $this->makeParam('b')])]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doWork', parameters: [$this->makeParam('a')])] // mismatch
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Class-level skip', $successes[0]);
    }

    // ── Known problems — method level ─────────────────────────────────────────

    public function testMethodLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className = '\MyClass';
        $mismatchedId = $className . '::doWork';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [
                $this->makeMethod('doWork', parameters: [$this->makeParam('a'), $this->makeParam('b')]),
                $this->makeMethod('other', parameters: [$this->makeParam('x')]),
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [
                $this->makeMethod('doWork', parameters: [$this->makeParam('a')]),  // mismatch — known problem
                $this->makeMethod('other', parameters: [$this->makeParam('x')]),  // match
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level skip', array_values($skipped)[0]);
    }

    public function testMethodLevelKnownProblemDoesNotSuppressOtherMismatches(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [
                $this->makeMethod('doWork', parameters: [$this->makeParam('a'), $this->makeParam('b')]),
                $this->makeMethod('other', parameters: [$this->makeParam('x'), $this->makeParam('y')]),
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [
                $this->makeMethod('doWork', parameters: [$this->makeParam('a')]),  // mismatch — known problem
                $this->makeMethod('other', parameters: [$this->makeParam('x')]),  // mismatch — NOT a known problem
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $className . '::doWork',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Only doWork is known'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParametersCountCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::other', $result->getFailures());
        $this->assertArrayNotHasKey($className . '::doWork', $result->getFailures());
    }
}
