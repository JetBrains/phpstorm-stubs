<?php

namespace StubTests\Unit\Validator\Classes\Properties;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertyReadonlyCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassPropertyReadonlyCheckTest extends CheckTestCase
{
    private ClassPropertyReadonlyCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassPropertyReadonlyCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ───────────────────────────────────────────────────────────

    public function testSupportsPhp81AndLater(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testDoesNotSupportBeforePhp81(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_0->value));
    }

    // ── Class not found ───────────────────────────────────────────────────────

    public function testClassNotFoundInReflectionIsFailure(): void
    {
        $className = '\MissingClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], []);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

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

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$className]);
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testClassWithNoPropertiesSucceeds(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothNonReadonlyIsSuccess(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothReadonlyIsSuccess(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testReflectionReadonlyStubNonReadonlyIsFailure(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]   // reflection: readonly
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)]  // stub: non-readonly
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::$name', $failures);
        $this->assertStringContainsString('readonly', $failures[$className . '::$name']);
        $this->assertStringContainsString('non-readonly', $failures[$className . '::$name']);
    }

    public function testReflectionNonReadonlyStubReadonlyIsFailure(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)]  // reflection: non-readonly
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]   // stub: readonly
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$name', $result->getFailures());
    }

    public function testFailureMessageContainsExpectedAndActualModifiers(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');
        $failures = $result->getFailures();
        $msg = $failures[$className . '::$name'];

        $this->assertStringContainsString('readonly', $msg);
        $this->assertStringContainsString('non-readonly', $msg);
        $this->assertStringContainsString('8.1', $msg);
    }

    public function testMultiplePropertiesMixedResultsAreAllReported(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('name', isReadonly: false), // matches
                $this->makeProperty('value', isReadonly: true),  // mismatch: refl=readonly, stub=non-readonly
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('name', isReadonly: false),
                $this->makeProperty('value', isReadonly: false), // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$value', $result->getFailures());
    }

    // ── Missing stub property is not our concern ──────────────────────────────

    public function testPropertyMissingInStubsIsNotReportedAsReadonlyMismatch(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('onlyInReflection', isReadonly: true)]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no properties

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems — class level ──────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllProperties(): void
    {
        $className = '\SpecialClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]  // mismatch
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)]
        );

        $knownProblemsProvider = $this->createStub(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_READONLY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider, $registry))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Class-level skip', $successes[0]);
    }

    // ── Known problems — property level ──────────────────────────────────────

    public function testPropertyLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className = '\MyClass';
        $mismatchedId = $className . '::$name';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('value', isReadonly: false), // matches
                $this->makeProperty('name', isReadonly: true),  // mismatch — covered by known problem
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('value', isReadonly: false),
                $this->makeProperty('name', isReadonly: false), // wrong, but known problem
            ]
        );

        $knownProblemsProvider = $this->createStub(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_READONLY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Property-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider, $registry))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Property-level skip', array_values($skipped)[0]);
    }

    public function testPropertyLevelKnownProblemDoesNotSuppressOtherMismatches(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('name', isReadonly: true),  // mismatch — known problem
                $this->makeProperty('value', isReadonly: true),  // mismatch — NOT a known problem
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('name', isReadonly: false),
                $this->makeProperty('value', isReadonly: false),
            ]
        );

        $knownProblemsProvider = $this->createStub(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $className . '::$name',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_READONLY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Only name is known'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider, $registry))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$value', $result->getFailures());
        $this->assertArrayNotHasKey($className . '::$name', $result->getFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testStubPropertyBelowSinceVersionIsExcluded(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false, sinceVersion: '8.2')] // not available in 8.1
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testStubPropertyWithinVersionRangeIsIncluded(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]   // reflection: readonly
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false, sinceVersion: '8.1', removedVersion: '8.4')] // available in 8.1, but wrong
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$name', $result->getFailures());
    }

    // ── Hierarchy traversal — parent class ───────────────────────────────────

    public function testReadonlyPropertyInheritedFromParentMismatchIsReported(): void
    {
        $className = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)] // reflection sees readonly on child
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('name', isReadonly: false)]); // parent: non-readonly

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$name', $result->getFailures());
    }

    public function testReadonlyPropertyInheritedFromParentMatchIsSuccess(): void
    {
        $className = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: true)]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('name', isReadonly: true)]); // matches

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testChildPropertyOverridesParentForReadonlyCheck(): void
    {
        $className = '\ChildClass';
        $parentClassName = '\ParentClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)] // child override: non-readonly
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('name', isReadonly: true)]); // parent: readonly (must not win)

        $childStub = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', isReadonly: false)] // child: non-readonly → matches reflection
        );
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Cycle guard ───────────────────────────────────────────────────────────

    /**
     * \MyClass.parentClass = \ParentClass; \ParentClass.parentClass = \MyClass → a real cycle.
     * Without the visited-set guard in MethodCollectionService::collectPropertiesForClass() the
     * while-loop never reaches null and $visited grows until the process dies.
     *
     * The parent carries the *mismatching* declaration on purpose: asserting the resulting failure
     * proves the walk actually entered the parent before breaking. A guard that bailed out one step
     * too early would terminate just as happily and report nothing, which `assertFalse(hasFailures())`
     * cannot tell apart from a correct traversal.
     */
    public function testCyclicParentChainTerminatesAndStillCollectsFromTheParent(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            properties: [$this->makeProperty('id', isReadonly: true)]
        );

        // The child declares nothing itself, so `id` can only come from the parent.
        $stubClass = $this->createMockClassWithProperties($className);
        $parent = $this->createMockClassWithProperties(
            '\ParentClass',
            properties: [$this->makeProperty('id', isReadonly: false)]
        );
        $stubClass->setParentClass($parent);
        $parent->setParentClass($stubClass);  // cycle!

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertyReadonlyCheck($provider))->run($stubs, $className, '8.1');

        $this->assertSame(
            ['\MyClass::$id' => 'Property \MyClass::$id is readonly in PHP 8.1 but non-readonly in stubs'],
            $result->getFailures(),
            'The cyclic walk must terminate having visited the parent exactly once'
        );
    }
}
