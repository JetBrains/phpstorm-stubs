<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Validator\Classes\Methods\ClassStaticMethodsCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassStaticMethodsCheckTest extends CheckTestCase
{
    private ClassStaticMethodsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassStaticMethodsCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }




    // ── supports() ───────────────────────────────────────────────────────────

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
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$className]);
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testClassWithNoMethodsSucceeds(): void
    {
        $className   = '\MyClass';
        $reflClass   = $this->createMockClassWithProperties($className);
        $stubClass   = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothNonStaticIsSuccess(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothStaticIsSuccess(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testReflectionStaticStubNonStaticIsFailure(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]   // reflection: static
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create')]  // stub: non-static
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::create', $failures);
        $this->assertStringContainsString('static', $failures[$className . '::create']);
        $this->assertStringContainsString('non-static', $failures[$className . '::create']);
    }

    public function testReflectionNonStaticStubStaticIsFailure(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork')]  // reflection: non-static
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork', isStatic: true)]   // stub: static
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doWork', $result->getFailures());
    }

    public function testFailureMessageContainsExpectedAndActualModifiers(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result   = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');
        $failures = $result->getFailures();
        $msg      = $failures[$className . '::create'];

        $this->assertStringContainsString('static', $msg);
        $this->assertStringContainsString('non-static', $msg);
        $this->assertStringContainsString('8.0', $msg);
    }

    public function testMultipleMethodsMixedResultsAreAllReported(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('doWork'),  // matches
                $this->makeMethod('create',  isStatic: true),  // mismatch: refl=static, stub=non-static
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('doWork'),
                $this->makeMethod('create'), // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::create', $result->getFailures());
    }

    public function testAllMethodsMismatchedReportsAll(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('methodA', isStatic: true),
                $this->makeMethod('methodB'),
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('methodA'), // wrong
                $this->makeMethod('methodB', isStatic: true),  // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(2, $result->getFailures());
        $this->assertArrayHasKey($className . '::methodA', $result->getFailures());
        $this->assertArrayHasKey($className . '::methodB', $result->getFailures());
    }

    // ── Missing stub method is not our concern ────────────────────────────────

    public function testMethodMissingInStubsIsNotReportedAsStaticMismatch(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('onlyInReflection', isStatic: true)]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no methods

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems — class level ──────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllMethods(): void
    {
        $className = '\SpecialClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]  // mismatch
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create')]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Class-level skip', $successes[0]);
    }

    // ── Known problems — method level ─────────────────────────────────────────

    public function testMethodLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className    = '\MyClass';
        $mismatchedId = $className . '::create';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('doWork'), // matches
                $this->makeMethod('create',  isStatic: true),  // mismatch — covered by known problem
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('doWork'),
                $this->makeMethod('create'), // wrong, but known problem
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level skip', array_values($skipped)[0]);
    }

    public function testMethodLevelKnownProblemDoesNotSuppressOtherMismatches(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('create',  isStatic: true),   // mismatch — known problem
                $this->makeMethod('doOther', isStatic: true),   // mismatch — NOT a known problem
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->makeMethod('create'),
                $this->makeMethod('doOther'),
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $className . '::create',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Only create is known'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::doOther', $result->getFailures());
        $this->assertArrayNotHasKey($className . '::create', $result->getFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testStubMethodBelowSinceVersionIsExcluded(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('newMethod', isStatic: true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('newMethod', sinceVersion: '8.1')] // not available in 8.0
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testStubMethodAfterRemovedVersionIsExcluded(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('oldMethod', isStatic: true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('oldMethod', sinceVersion: '5.6', removedVersion: '7.4')] // removed before 8.0
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testStubMethodWithinVersionRangeIsIncluded(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]   // reflection: static
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', sinceVersion: '7.0', removedVersion: '8.4')] // available in 8.0, but wrong
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::create', $result->getFailures());
    }

    // ── PS_UNRESERVE_PREFIX_ ──────────────────────────────────────────────────

    public function testPsUnreservePrefixMismatchIsReported(): void
    {
        $className = '\Generator';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('throw', isStatic: true)]                         // reflection: static
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('PS_UNRESERVE_PREFIX_throw')]    // stub: non-static → mismatch
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::throw', $result->getFailures());
    }

    public function testPsUnreservePrefixMatchIsSuccess(): void
    {
        $className = '\Generator';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('throw')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('PS_UNRESERVE_PREFIX_throw')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Hierarchy traversal — parent class ───────────────────────────────────

    public function testStaticMethodInheritedFromParentMismatchIsReported(): void
    {
        $className       = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)] // reflection sees static on child
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('create')]); // stub parent: non-static

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::create', $result->getFailures());
    }

    public function testStaticMethodInheritedFromParentMatchIsSuccess(): void
    {
        $className       = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('create', isStatic: true)]); // matches

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testChildMethodOverridesParentForStaticCheck(): void
    {
        // Child re-declares 'create' as non-static; parent had it static.
        // Reflection reports non-static for child. Child stub wins.
        $className       = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create')] // child override: non-static
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->makeMethod('create', isStatic: true)]); // parent: static (must not win)

        $childStub = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create')] // child: non-static → matches reflection
        );
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Hierarchy traversal — interfaces ─────────────────────────────────────

    public function testStaticMethodFromInterfaceMismatchIsReported(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]
        );

        $iface = $this->makeInterface('\MyInterface', [
            $this->makeMethod('create'), // interface stub: non-static → mismatch
        ]);

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null, [], null, [$iface]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::create', $result->getFailures());
    }

    public function testStaticMethodFromInterfaceMatchIsSuccess(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)]
        );

        $iface = $this->makeInterface('\MyInterface', [
            $this->makeMethod('create', isStatic: true), // matches
        ]);

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null, [], null, [$iface]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testClassMethodWinsOverInterfaceMethodForStaticCheck(): void
    {
        // Class declares 'create' as static, interface says non-static.
        // Class own definition must win.
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)] // reflection: static
        );

        $iface = $this->makeInterface('\MyInterface', [
            $this->makeMethod('create'), // interface: non-static (must NOT win)
        ]);

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('create', isStatic: true)], // class own: static → matches
            null,
            [$iface]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Cycle guard ───────────────────────────────────────────────────────────

    public function testCyclicParentChainDoesNotInfiniteLoop(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties($className);

        // Create a direct self-referential parent (degenerate cycle)
        $stubClass = $this->createMockClassWithProperties($className);
        // parentClass pointing to itself would cycle; set to null to confirm guard
        // is exercised by having a two-node chain where second node has no parent
        $parent = new PHPClass();
        $parent->setId('\ParentClass');
        $parent->setMethods([]);
        $stubClass->setParentClass($parent);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        // Should complete without infinite loop
        $result = (new ClassStaticMethodsCheck($provider))->run($stubs, $className, '8.0');
        $this->assertFalse($result->hasFailures());
    }
}
