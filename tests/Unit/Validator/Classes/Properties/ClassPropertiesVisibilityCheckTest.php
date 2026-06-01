<?php

namespace StubTests\Unit\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertiesVisibilityCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassPropertiesVisibilityCheckTest extends CheckTestCase
{
    private ClassPropertiesVisibilityCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassPropertiesVisibilityCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    private function makeProperty(
        string $name,
        string $visibility = 'public',
        ?string $sinceVersion = null,
        ?string $removedVersion = null
    ): PHPProperty {
        $property = new PHPProperty();
        $property->setName($name);
        $property->setAccess(match ($visibility) {
            'protected' => AccessModifier::PROTECTED,
            'private' => AccessModifier::PRIVATE,
            default => AccessModifier::PUBLIC,
        });
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

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothPublicIsSuccess(): void
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
            [$this->makeProperty('name', 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', 'public')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothProtectedIsSuccess(): void
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
            [$this->makeProperty('data', 'protected')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', 'protected')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothPrivateIsSuccess(): void
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
            [$this->makeProperty('secret', 'private')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('secret', 'private')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testReflectionPublicStubProtectedIsFailure(): void
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
            [$this->makeProperty('name', 'public')]      // reflection: public
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', 'protected')]   // stub: protected
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::$name', $failures);
        $this->assertStringContainsString('public', $failures[$className . '::$name']);
        $this->assertStringContainsString('protected', $failures[$className . '::$name']);
    }

    public function testReflectionProtectedStubPublicIsFailure(): void
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
            [$this->makeProperty('data', 'protected')]  // reflection: protected
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', 'public')]     // stub: public
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$data', $result->getFailures());
    }

    public function testReflectionPrivateStubPublicIsFailure(): void
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
            [$this->makeProperty('secret', 'private')]  // reflection: private
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('secret', 'public')]   // stub: public
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$secret', $result->getFailures());
    }

    public function testFailureMessageContainsReflectionAndStubVisibility(): void
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
            [$this->makeProperty('name', 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', 'protected')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');
        $failures = $result->getFailures();
        $msg = $failures[$className . '::$name'];

        $this->assertStringContainsString('public', $msg);
        $this->assertStringContainsString('protected', $msg);
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
                $this->makeProperty('name', 'public'),    // matches
                $this->makeProperty('data', 'protected'), // mismatch: refl=protected, stub=public
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
                $this->makeProperty('name', 'public'),
                $this->makeProperty('data', 'public'),    // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$data', $result->getFailures());
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
                $this->makeProperty('propA', 'public'),
                $this->makeProperty('propB', 'protected'),
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
                $this->makeProperty('propA', 'protected'), // wrong
                $this->makeProperty('propB', 'public'),    // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(2, $result->getFailures());
        $this->assertArrayHasKey($className . '::$propA', $result->getFailures());
        $this->assertArrayHasKey($className . '::$propB', $result->getFailures());
    }

    // ── Missing stub property is not our concern ──────────────────────────────

    public function testPropertyMissingInStubsIsNotReportedAsVisibilityMismatch(): void
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
            [$this->makeProperty('onlyInReflection', 'public')]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no properties

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

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
            [$this->makeProperty('name', 'public')]     // mismatch
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', 'protected')]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_VISIBILITY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider, $registry))->run($stubs, $className, '8.0');

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
                $this->makeProperty('data', 'protected'), // matches
                $this->makeProperty('name', 'public'),    // mismatch — covered by known problem
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
                $this->makeProperty('data', 'protected'),
                $this->makeProperty('name', 'protected'), // wrong, but known problem
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_VISIBILITY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Property-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider, $registry))->run($stubs, $className, '8.0');

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
                $this->makeProperty('name', 'public'),   // mismatch — known problem
                $this->makeProperty('data', 'public'),   // mismatch — NOT a known problem
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
                $this->makeProperty('name', 'protected'),
                $this->makeProperty('data', 'protected'),
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $className . '::$name',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_VISIBILITY],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Only name is known'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$data', $result->getFailures());
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
            [$this->makeProperty('newProp', 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('newProp', 'protected', '8.1')] // not available in 8.0
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

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
            [$this->makeProperty('oldProp', 'public')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('oldProp', 'protected', '5.6', '7.4')] // removed before 8.0
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

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
            [$this->makeProperty('data', 'public')]               // reflection: public
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', 'protected', '7.0', '8.4')] // available in 8.0, but wrong
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$data', $result->getFailures());
    }

    // ── Hierarchy traversal — parent class ───────────────────────────────────

    public function testVisibilityInheritedFromParentMismatchIsReported(): void
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
            [$this->makeProperty('data', 'public')] // reflection sees public on child
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('data', 'protected')]); // parent: protected

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$data', $result->getFailures());
    }

    public function testVisibilityInheritedFromParentMatchIsSuccess(): void
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
            [$this->makeProperty('data', 'protected')]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('data', 'protected')]); // matches

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testChildPropertyOverridesParentForVisibilityCheck(): void
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
            [$this->makeProperty('data', 'public')] // child override: public
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('data', 'protected')]); // parent: protected (must not win)

        $childStub = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', 'public')] // child: public → matches reflection
        );
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassPropertiesVisibilityCheck($provider))->run($stubs, $className, '8.0');
        $this->assertFalse($result->hasFailures());
    }
}
