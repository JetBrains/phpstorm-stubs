<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsVisibilityCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassMethodsVisibilityCheckTest extends CheckTestCase
{
    private ClassMethodsVisibilityCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsVisibilityCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }




    // ── Supports ──────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testClassWithNoMethodsSucceeds(): void
    {
        $className    = '\MyClass';
        $reflClass    = $this->createMockClassWithProperties($className);
        $stubClass    = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothPublicIsSuccess(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothProtectedIsSuccess(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'protected')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'protected')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothPrivateIsSuccess(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'private')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'private')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testReflectionPublicStubProtectedIsFailure(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'protected')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::doWork', $failures);
        $this->assertStringContainsString('public', $failures[$className . '::doWork']);
        $this->assertStringContainsString('protected', $failures[$className . '::doWork']);
    }

    public function testReflectionProtectedStubPublicIsFailure(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'protected')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doWork', $result->getFailures());
    }

    public function testReflectionPublicStubPrivateIsFailure(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'private')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doWork', $result->getFailures());
    }

    public function testMultipleMethodsMixedResultsAreAllReported(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('okMethod',  access: 'public'),    // matches
                $this->makeMethod('badMethod', access: 'protected'), // mismatch: refl=protected, stub=public
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('okMethod',  access: 'public'),
                $this->makeMethod('badMethod', access: 'public'),    // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::badMethod', $result->getFailures());
    }

    // ── Missing stub method is not our concern ────────────────────────────────

    public function testMethodMissingInStubsIsNotReportedAsVisibilityMismatch(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('onlyInReflection', access: 'public')]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no methods

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Not found ─────────────────────────────────────────────────────────────

    public function testClassNotFoundInReflectionIsFailure(): void
    {
        $className = '\MissingClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$className]);
    }

    public function testClassNotFoundInStubsIsFailure(): void
    {
        $className = '\MissingClass';
        $reflClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$className]);
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllMethods(): void
    {
        $className = '\SpecialClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'protected')] // mismatch: stub is public
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_VISIBILITY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Class-level skip', $successes[0]);
    }

    public function testMethodLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className    = '\MyClass';
        $mismatchedId = $className . '::doWork';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('okMethod', access: 'public'),    // matches
                $this->makeMethod('doWork',   access: 'protected'), // mismatch — covered by known problem
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('okMethod', access: 'public'),
                $this->makeMethod('doWork',   access: 'public'), // wrong, but known problem
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_VISIBILITY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level skip', array_values($skipped)[0]);
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testStubMethodOutsideVersionRangeIsSkipped(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('newMethod', access: 'protected')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('newMethod', sinceVersion: '8.1', access: 'public')] // not available in 8.0
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── PS_UNRESERVE_PREFIX_ ──────────────────────────────────────────────────

    public function testPsUnreservePrefixMethodVisibilityMismatchIsReported(): void
    {
        $className = '\Generator';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('throw', access: 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('PS_UNRESERVE_PREFIX_throw', access: 'protected')] // mismatch
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::throw', $result->getFailures());
    }

    public function testPsUnreservePrefixMethodVisibilityMatchIsSuccess(): void
    {
        $className = '\Generator';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('throw', access: 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('PS_UNRESERVE_PREFIX_throw', access: 'public')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Hierarchy traversal ───────────────────────────────────────────────────

    public function testVisibilityFromParentClassMismatchIsReported(): void
    {
        $className       = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'protected')]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('doWork', access: 'public')]); // stub parent: public → mismatch

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doWork', $result->getFailures());
    }

    public function testVisibilityFromParentClassMatchIsSuccess(): void
    {
        $className       = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'protected')]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('doWork', access: 'protected')]); // matches

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testVisibilityFromInterfaceMismatchIsReported(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('interfaceMethod', access: 'public')]
        );

        $iface = $this->makeInterface('\MyInterface', [
            $this->makeMethod('interfaceMethod', access: 'protected'), // stub says protected → mismatch
        ]);

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [],
            null,
            [$iface]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::interfaceMethod', $result->getFailures());
    }

    public function testChildMethodOverridesParentVisibility(): void
    {
        // Child widens visibility from protected to public — child definition wins.
        $className       = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')] // reflection: public (child override)
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('doWork', access: 'protected')]); // parent: protected

        $childStub = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', access: 'public')] // child re-declares: public
        );
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }
}
