<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsExistCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassMethodsExistCheckTest extends CheckTestCase
{
    private ClassMethodsExistCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsExistCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testClassWithNoMethods(): void
    {
        $className = '\MyClass';

        $reflectionClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testAllReflectionMethodsPresentInStubs(): void
    {
        $className = '\MyClass';

        $reflectionMethods = [
            $this->createMockMethod('method1'),
            $this->createMockMethod('method2'),
            $this->createMockMethod('__construct'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [
            $this->makeMethod('method1'),
            $this->makeMethod('method2'),
            $this->makeMethod('__construct'),
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMissingMethodInStubsIsReported(): void
    {
        $className = '\MyClass';

        $reflectionMethods = [
            $this->createMockMethod('existingMethod'),
            $this->createMockMethod('missingMethod'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [
            $this->makeMethod('existingMethod'),
            // 'missingMethod' is absent
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::missingMethod', $failures);
        $this->assertStringContainsString('missingMethod', $failures[$className . '::missingMethod']);
    }

    public function testMethodNotYetAvailableIsNotCountedInStubs(): void
    {
        // sinceVersion = '8.1', testing with '8.0' → method should be excluded from stubs
        $className = '\MyClass';

        $reflectionMethods = [
            $this->createMockMethod('oldMethod'),
            // 'newMethod' does NOT appear in PHP 8.0 reflection (not yet added)
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [
            $this->makeMethod('oldMethod'),
            $this->makeMethod('newMethod', sinceVersion: '8.1'),  // since 8.1, not available in 8.0
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        // 'oldMethod' in reflection is found in stubs → no failures
        $this->assertFalse($result->hasFailures());
    }

    public function testRemovedMethodIsNotCountedInStubs(): void
    {
        // removedVersion = '8.0', testing with '8.0' → method should be EXCLUDED from stubs
        // because version_compare('8.0', '8.0', '<=') is true, so it IS included.
        // Let's test with a truly removed case: removedVersion = '7.4', phpVersion = '8.0'
        $className = '\MyClass';

        $reflectionMethods = [
            $this->createMockMethod('currentMethod'),
            // 'legacyMethod' does NOT appear in PHP 8.0 reflection (removed)
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [
            $this->makeMethod('currentMethod'),
            $this->makeMethod('legacyMethod', removedVersion: '7.4'),  // removed in 7.4, gone in 8.0
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        // 'currentMethod' is in reflection and in stubs → passes
        // 'legacyMethod' is in stubs but excluded by version → NOT reported as extra
        $this->assertFalse($result->hasFailures());
    }

    public function testMethodInheritedFromParentClassIsCounted(): void
    {
        // Reflection reports inherited methods. The stub hierarchy traversal should find them.
        $className = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflectionMethods = [
            $this->createMockMethod('childMethod'),
            $this->createMockMethod('parentMethod'),  // inherited, reported by reflection
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        // Stub: child only has childMethod; parent has parentMethod
        $parentStubMethods = [$this->makeMethod('parentMethod')];
        $parentStubClass = $this->getMockBuilder(PHPClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getNamespace', 'getMethods'])
            ->getMock();
        $parentStubClass->method('getId')->willReturn($parentClassName);
        $parentStubClass->method('getName')->willReturn($parentClassName);
        $parentStubClass->method('getMethods')->willReturn($parentStubMethods);

        $childStubMethods = [$this->makeMethod('childMethod')];
        $childStubClass = $this->getMockBuilder(PHPClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getNamespace', 'getMethods'])
            ->getMock();
        $childStubClass->method('getId')->willReturn($className);
        $childStubClass->method('getName')->willReturn($className);
        $childStubClass->method('getMethods')->willReturn($childStubMethods);
        $childStubClass->setParentClass($parentStubClass);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$childStubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        // parentMethod is found via parent traversal → no failures
        $this->assertFalse($result->hasFailures());
    }

    public function testPsUnreservePrefixMethodMatchesRealName(): void
    {
        // Generator::throw() in stubs is PS_UNRESERVE_PREFIX_throw.
        // Reflection reports it as 'throw'. The check strips the prefix.
        $className = '\Generator';

        $reflectionMethods = [
            $this->createMockMethod('throw'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [
            $this->makeMethod('PS_UNRESERVE_PREFIX_throw'),
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testClassNotFoundInReflection(): void
    {
        $className = '\MissingClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], []);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in reflection data', $failures[$className]);
    }

    public function testClassNotFoundInStubs(): void
    {
        $className = '\MissingClass';
        $reflectionClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in stubs', $failures[$className]);
    }

    public function testClassLevelKnownProblemSkipsAllMethodChecks(): void
    {
        $className = '\SpecialClass';

        $reflectionMethods = [
            $this->createMockMethod('missingMethod'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);
        $stubClass = $this->createMockClassWithProperties($className); // no methods, but class-level skip

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider, $registry);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Class-level skip reason', $successes[0]);
    }

    public function testMethodLevelKnownProblemSkipsSpecificMethod(): void
    {
        $className = '\MyClass';
        $missingMethodId = $className . '::missingMethod';

        $reflectionMethods = [
            $this->createMockMethod('presentMethod'),
            $this->createMockMethod('missingMethod'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [
            $this->makeMethod('presentMethod'),
            // 'missingMethod' absent from stubs, but covered by known problem
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $missingMethodId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider, $registry);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        // Only the skipped missingMethod entry is recorded; presentMethod (found in stubs) produces no result entry.
        $this->assertEquals(1, $result->getSuccessCount());
        $skippedEntry = array_filter($successes, fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skippedEntry);
        $this->assertStringContainsString('Method-level skip reason', array_values($skippedEntry)[0]);
    }

    // ── Version boundary cases ────────────────────────────────────────────────

    public function testVersionBoundarySinceVersionEqualsPhpVersion(): void
    {
        // sinceVersion == phpVersion → version_compare('8.0','8.0','>=') is true → method IS included
        $className = '\MyClass';

        $reflectionMethods = [$this->createMockMethod('justAddedMethod')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [$this->makeMethod('justAddedMethod', sinceVersion: '8.0')];  // since exactly 8.0
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures(), 'Method with sinceVersion==phpVersion should be included in stubs');
    }

    public function testVersionBoundaryRemovedVersionEqualsPhpVersion(): void
    {
        // removedVersion is the EXCLUSIVE upper bound (first version where element is gone).
        // removedVersion='7.5' means "available up to and including PHP 7.4".
        // version_compare('7.4','7.5','<') is true → method IS included for PHP 7.4.
        $className = '\MyClass';

        $reflectionMethods = [$this->createMockMethod('lastVersionMethod')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubMethods = [$this->makeMethod('lastVersionMethod', removedVersion: '7.5')];  // excluded from 7.5+, so available in 7.4
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, $stubMethods);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '7.4');

        $this->assertFalse($result->hasFailures(), 'Method with removedVersion as exclusive boundary should be included at phpVersion < removedVersion');
    }

    // ── Interface method traversal ────────────────────────────────────────────

    public function testMethodInheritedFromInterfaceIsCounted(): void
    {
        // Reflection reports a method declared on an interface the class implements.
        // The validator must traverse the class's interfaces to find it.
        $className = '\MyClass';

        $reflectionMethods = [
            $this->createMockMethod('classMethod'),
            $this->createMockMethod('interfaceMethod'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $interface = $this->makeInterface('\MyInterface', [$this->makeMethod('interfaceMethod')]);

        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('classMethod')],
            null,
            [$interface]
        );

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testPsUnreservePrefixInInterfaceMethodMatchesRealName(): void
    {
        // Interface declares PS_UNRESERVE_PREFIX_isSet; reflection reports the real name 'isSet'.
        $className = '\MyCalendar';

        $reflectionMethods = [$this->createMockMethod('isSet')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $interface = $this->makeInterface('\CalendarInterface', [
            $this->makeMethod('PS_UNRESERVE_PREFIX_isSet'),
        ]);

        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [$interface]
        );

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMethodInheritedFromParentInterfaceChainIsCounted(): void
    {
        // Class → InterfaceA → InterfaceB (has the method).
        // Validator must traverse the parent interface chain.
        $className = '\MyClass';

        $reflectionMethods = [$this->createMockMethod('deepInterfaceMethod')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $parentIface = $this->makeInterface('\InterfaceB', [$this->makeMethod('deepInterfaceMethod')]);
        $childIface = $this->makeInterface('\InterfaceA');
        $childIface->addParentInterface($parentIface);

        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [$childIface]
        );

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Deep class hierarchy ──────────────────────────────────────────────────

    public function testDeepThreeLevelClassHierarchyGrandparentMethodIsCounted(): void
    {
        // Grandparent → Parent → Child. Reflection reports the grandparent method.
        $className = '\ChildClass';

        $reflectionMethods = [
            $this->createMockMethod('childMethod'),
            $this->createMockMethod('parentMethod'),
            $this->createMockMethod('grandparentMethod'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $grandparent = new PHPClass();
        $grandparent->setId('\GrandparentClass');
        $grandparent->setMethods([$this->makeMethod('grandparentMethod')]);

        $parent = new PHPClass();
        $parent->setId('\ParentClass');
        $parent->setMethods([$this->makeMethod('parentMethod')]);
        $parent->setParentClass($grandparent);

        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('childMethod')]
        );
        $stubClass->setParentClass($parent);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Cycle detection ───────────────────────────────────────────────────────

    public function testCycleInClassHierarchyDoesNotCauseInfiniteLoop(): void
    {
        // ClassA.parentClass = ClassB; ClassB.parentClass = ClassA → cycle.
        // The cycle guard must break before infinite recursion.
        $className = '\ClassA';

        $reflectionMethods = [
            $this->createMockMethod('methodA'),
            $this->createMockMethod('methodB'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $classA = new PHPClass();
        $classA->setId('\ClassA');
        $classA->setMethods([$this->makeMethod('methodA')]);

        $classB = new PHPClass();
        $classB->setId('\ClassB');
        $classB->setMethods([$this->makeMethod('methodB')]);

        $classA->setParentClass($classB);
        $classB->setParentClass($classA);  // cycle!

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$classA]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        // Must complete without infinite loop; both methods are collected before cycle guard fires.
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testCycleInInterfaceHierarchyDoesNotCauseInfiniteLoop(): void
    {
        // Iface1.parents = [Iface2]; Iface2.parents = [Iface1] → cycle.
        $className = '\MyClass';

        $reflectionMethods = [
            $this->createMockMethod('method1'),
            $this->createMockMethod('method2'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $iface1 = $this->makeInterface('\CyclicIface1', [$this->makeMethod('method1')]);
        $iface2 = $this->makeInterface('\CyclicIface2', [$this->makeMethod('method2')]);
        $iface1->addParentInterface($iface2);
        $iface2->addParentInterface($iface1);  // cycle!

        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [$iface1]
        );

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        // Both methods collected before cycle guard fires → no failures.
        $this->assertFalse($result->hasFailures());
    }

    // ── Multiple missing methods ──────────────────────────────────────────────

    public function testMultipleMissingMethodsAreReportedInSortedOrder(): void
    {
        $className = '\MyClass';

        $reflectionMethods = [
            $this->createMockMethod('gammaMethod'),
            $this->createMockMethod('alphaMethod'),
            $this->createMockMethod('betaMethod'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $stubClass = $this->createMockClassWithProperties($className);  // no methods

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(3, $result->getFailures());

        // Failures must be emitted in alphabetical order (sort() is applied before iteration)
        $keys = array_keys($result->getFailures());
        $this->assertEquals($className . '::alphaMethod', $keys[0]);
        $this->assertEquals($className . '::betaMethod', $keys[1]);
        $this->assertEquals($className . '::gammaMethod', $keys[2]);
    }

    // ── Edge cases ────────────────────────────────────────────────────────────

    public function testMethodWithNullNameIsSkippedGracefully(): void
    {
        // A PHPMethod with no name set (getName() returns null) must not crash or emit a result.
        $className = '\MyClass';

        $reflectionMethods = [$this->createMockMethod('realMethod')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $methodWithNullName = new PHPMethod();  // name never set → getName() returns null

        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('realMethod'), $methodWithNullName]
        );

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMethodPresentInBothParentClassAndInterfaceIsDeduplicatedAndStillFound(): void
    {
        // The same method name appears in both the parent class stub and an interface stub.
        // array_unique ensures it counts as present only once; no failure is reported.
        $className = '\MyClass';

        $reflectionMethods = [$this->createMockMethod('sharedMethod')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);

        $parentClass = new PHPClass();
        $parentClass->setId('\ParentClass');
        $parentClass->setMethods([$this->makeMethod('sharedMethod')]);

        $interface = $this->makeInterface('\SharedInterface', [$this->makeMethod('sharedMethod')]);

        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [$interface]
        );
        $stubClass->setParentClass($parentClass);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known-problem version-range boundary ─────────────────────────────────

    public function testKnownProblemVersionRangeOutsideBoundaryStillReportsFailure(): void
    {
        // A method-level known problem covers PHP 8.0–8.2.
        // - PHP 8.1 (inside range) → skipped, no failure.
        // - PHP 8.3 (outside range) → NOT skipped, failure reported.
        $className = '\MyClass';
        $missingMethodId = $className . '::missingMethod';

        $reflectionMethods = [$this->createMockMethod('missingMethod')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, $reflectionMethods);
        $stubClass = $this->createMockClassWithProperties($className);  // no methods

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $missingMethodId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::PHP_8_2),
                reason: 'Partial version skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassMethodsExistCheck($reflectionProvider, $registry);

        $resultIn = $check->run($stubsManager, $className, '8.1');
        $this->assertFalse($resultIn->hasFailures(), 'PHP 8.1 is within range: should be skipped');

        $resultOut = $check->run($stubsManager, $className, '8.3');
        $this->assertTrue($resultOut->hasFailures(), 'PHP 8.3 is outside range: should report failure');
        $this->assertArrayHasKey($missingMethodId, $resultOut->getFailures());
    }
}
