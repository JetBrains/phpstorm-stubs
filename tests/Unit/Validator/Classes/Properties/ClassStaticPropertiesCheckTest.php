<?php

namespace StubTests\Unit\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Validator\Classes\Properties\ClassStaticPropertiesCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassStaticPropertiesCheckTest extends CheckTestCase
{
    private ClassStaticPropertiesCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassStaticPropertiesCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    private function makeProperty(
        string $name,
        bool $isStatic = false,
        ?string $sinceVersion = null,
        ?string $removedVersion = null
    ): PHPProperty {
        $property = new PHPProperty();
        $property->setName($name);
        $property->setIsStatic($isStatic);
        if ($sinceVersion !== null) {
            $property->initStubsMetadata()->setSinceVersion($sinceVersion);
        }
        if ($removedVersion !== null) {
            $property->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        return $property;
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
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothNonStaticIsSuccess(): void
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
            [$this->makeProperty('count', false)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('count', false)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothStaticIsSuccess(): void
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
            [$this->makeProperty('instance', true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('instance', true)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testReflectionStaticStubNonStaticIsFailure(): void
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
            [$this->makeProperty('instance', true)]   // reflection: static
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('instance', false)]  // stub: non-static
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::$instance', $failures);
        $this->assertStringContainsString('static', $failures[$className . '::$instance']);
        $this->assertStringContainsString('non-static', $failures[$className . '::$instance']);
    }

    public function testReflectionNonStaticStubStaticIsFailure(): void
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
            [$this->makeProperty('count', false)]  // reflection: non-static
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('count', true)]   // stub: static
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$count', $result->getFailures());
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
            [$this->makeProperty('instance', true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('instance', false)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');
        $failures = $result->getFailures();
        $msg = $failures[$className . '::$instance'];

        $this->assertStringContainsString('static', $msg);
        $this->assertStringContainsString('non-static', $msg);
        $this->assertStringContainsString('8.0', $msg);
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
                $this->makeProperty('count', false), // matches
                $this->makeProperty('instance', true),  // mismatch: refl=static, stub=non-static
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
                $this->makeProperty('count', false),
                $this->makeProperty('instance', false), // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$instance', $result->getFailures());
    }

    public function testAllPropertiesMismatchedReportsAll(): void
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
                $this->makeProperty('propA', true),
                $this->makeProperty('propB', false),
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
                $this->makeProperty('propA', false), // wrong
                $this->makeProperty('propB', true),  // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(2, $result->getFailures());
        $this->assertArrayHasKey($className . '::$propA', $result->getFailures());
        $this->assertArrayHasKey($className . '::$propB', $result->getFailures());
    }

    // ── Missing stub property is not our concern ──────────────────────────────

    public function testPropertyMissingInStubsIsNotReportedAsStaticMismatch(): void
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
            [$this->makeProperty('onlyInReflection', true)]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no properties

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

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
            [$this->makeProperty('instance', true)]  // mismatch
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('instance', false)]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_PROPERTIES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider, $registry))->run($stubs, $className, '8.0');

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
        $mismatchedId = $className . '::$instance';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('count', false), // matches
                $this->makeProperty('instance', true),  // mismatch — covered by known problem
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
                $this->makeProperty('count', false),
                $this->makeProperty('instance', false), // wrong, but known problem
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_PROPERTIES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Property-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider, $registry))->run($stubs, $className, '8.0');

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
                $this->makeProperty('instance', true),  // mismatch — known problem
                $this->makeProperty('count', true),  // mismatch — NOT a known problem
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
                $this->makeProperty('instance', false),
                $this->makeProperty('count', false),
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $className . '::$instance',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_PROPERTIES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Only instance is known'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$count', $result->getFailures());
        $this->assertArrayNotHasKey($className . '::$instance', $result->getFailures());
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
            [$this->makeProperty('newProp', true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('newProp', false, '8.1')] // not available in 8.0
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testStubPropertyAfterRemovedVersionIsExcluded(): void
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
            [$this->makeProperty('oldProp', true)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('oldProp', false, '5.6', '7.4')] // removed before 8.0
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

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
            [$this->makeProperty('instance', true)]   // reflection: static
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('instance', false, '7.0', '8.4')] // available in 8.0, but wrong
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$instance', $result->getFailures());
    }

    // ── Hierarchy traversal — parent class ───────────────────────────────────

    public function testStaticPropertyInheritedFromParentMismatchIsReported(): void
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
            [$this->makeProperty('instance', true)] // reflection sees static on child
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('instance', false)]); // parent: non-static

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$instance', $result->getFailures());
    }

    public function testStaticPropertyInheritedFromParentMatchIsSuccess(): void
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
            [$this->makeProperty('instance', true)]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('instance', true)]); // matches

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testChildPropertyOverridesParentForStaticCheck(): void
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
            [$this->makeProperty('instance', false)] // child override: non-static
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('instance', true)]); // parent: static (must not win)

        $childStub = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('instance', false)] // child: non-static → matches reflection
        );
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Cycle guard ───────────────────────────────────────────────────────────

    public function testCyclicParentChainDoesNotInfiniteLoop(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties($className);

        $stubClass = $this->createMockClassWithProperties($className);
        $parent = new PHPClass();
        $parent->setId('\ParentClass');
        $parent->setProperties([]);
        $stubClass->setParentClass($parent);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaticPropertiesCheck($provider))->run($stubs, $className, '8.0');
        $this->assertFalse($result->hasFailures());
    }
}
