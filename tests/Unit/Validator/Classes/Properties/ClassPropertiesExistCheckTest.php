<?php

namespace StubTests\Unit\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertiesExistCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassPropertiesExistCheckTest extends CheckTestCase
{
    private ClassPropertiesExistCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassPropertiesExistCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    /**
     * Build a real PHPProperty with the given name and optional version bounds.
     */
    private function makeProperty(
        string $name,
        ?string $sinceVersion = null,
        ?string $removedVersion = null
    ): PHPProperty {
        $property = new PHPProperty();
        $property->setName($name);
        if ($sinceVersion !== null) {
            $property->initStubsMetadata()->setSinceVersion($sinceVersion);
        }
        if ($removedVersion !== null) {
            $property->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        return $property;
    }

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testClassWithNoProperties(): void
    {
        $className = '\MyClass';

        $reflectionClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testAllReflectionPropertiesPresentInStubs(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [
            $this->createMockProperty('prop1'),
            $this->createMockProperty('prop2'),
            $this->createMockProperty('staticProp'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubProperties = [
            $this->makeProperty('prop1'),
            $this->makeProperty('prop2'),
            $this->makeProperty('staticProp'),
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMissingPropertyInStubsIsReported(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [
            $this->createMockProperty('existingProp'),
            $this->createMockProperty('missingProp'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubProperties = [
            $this->makeProperty('existingProp'),
            // 'missingProp' is absent
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::$missingProp', $failures);
        $this->assertStringContainsString('missingProp', $failures[$className . '::$missingProp']);
    }

    public function testPropertyNotYetAvailableIsNotCountedInStubs(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [
            $this->createMockProperty('oldProp'),
            // 'newProp' does NOT appear in PHP 8.0 reflection (not yet added)
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubProperties = [
            $this->makeProperty('oldProp'),
            $this->makeProperty('newProp', '8.1'),  // since 8.1, not available in 8.0
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        // 'oldProp' in reflection is found in stubs → no failures
        $this->assertFalse($result->hasFailures());
    }

    public function testRemovedPropertyIsNotCountedInStubs(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [
            $this->createMockProperty('currentProp'),
            // 'legacyProp' does NOT appear in PHP 8.0 reflection (removed)
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubProperties = [
            $this->makeProperty('currentProp'),
            $this->makeProperty('legacyProp', null, '7.4'),  // removed in 7.4, gone in 8.0
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testVersionBoundarySinceVersionEqualsPhpVersion(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [$this->createMockProperty('justAddedProp')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubProperties = [$this->makeProperty('justAddedProp', '8.0')];  // since exactly 8.0
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures(), 'Property with sinceVersion==phpVersion should be included in stubs');
    }

    public function testVersionBoundaryRemovedVersionEqualsPhpVersion(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [$this->createMockProperty('lastVersionProp')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubProperties = [$this->makeProperty('lastVersionProp', null, '7.4')];  // removed at exactly 7.4
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '7.4');

        $this->assertTrue($result->hasFailures(), 'Property with removedVersion==phpVersion should NOT be included (exclusive boundary)');
    }

    public function testClassNotFoundInReflection(): void
    {
        $className = '\MissingClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], []);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
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

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in stubs', $failures[$className]);
    }

    public function testClassLevelKnownProblemSkipsAllPropertyChecks(): void
    {
        $className = '\SpecialClass';

        $reflectionProperties = [$this->createMockProperty('missingProp')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);
        $stubClass = $this->createMockClassWithProperties($className);  // no properties, but class-level skip

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider, $registry);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Class-level skip reason', $successes[0]);
    }

    public function testPropertyLevelKnownProblemSkipsSpecificProperty(): void
    {
        $className = '\MyClass';
        $missingPropertyId = $className . '::$missingProp';

        $reflectionProperties = [
            $this->createMockProperty('presentProp'),
            $this->createMockProperty('missingProp'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubProperties = [
            $this->makeProperty('presentProp'),
            // 'missingProp' absent from stubs, but covered by known problem
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $missingPropertyId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Property-level skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider, $registry);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $skippedEntry = array_filter($successes, fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skippedEntry);
        $this->assertStringContainsString('Property-level skip reason', array_values($skippedEntry)[0]);
    }

    public function testMultipleMissingPropertiesAreReportedInSortedOrder(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [
            $this->createMockProperty('gammaProp'),
            $this->createMockProperty('alphaProp'),
            $this->createMockProperty('betaProp'),
        ];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $stubClass = $this->createMockClassWithProperties($className);  // no properties

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(3, $result->getFailures());

        // Failures must be emitted in alphabetical order
        $keys = array_keys($result->getFailures());
        $this->assertEquals($className . '::$alphaProp', $keys[0]);
        $this->assertEquals($className . '::$betaProp', $keys[1]);
        $this->assertEquals($className . '::$gammaProp', $keys[2]);
    }

    public function testPropertyWithNullNameIsSkippedGracefully(): void
    {
        $className = '\MyClass';

        $reflectionProperties = [$this->createMockProperty('realProp')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);

        $propertyWithNullName = new PHPProperty();  // name never set → getName() returns null

        $stubProperties = [$this->makeProperty('realProp'), $propertyWithNullName];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $stubProperties);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testKnownProblemVersionRangeOutsideBoundaryStillReportsFailure(): void
    {
        $className = '\MyClass';
        $missingPropertyId = $className . '::$missingProp';

        $reflectionProperties = [$this->createMockProperty('missingProp')];
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [], $reflectionProperties);
        $stubClass = $this->createMockClassWithProperties($className);  // no properties

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $missingPropertyId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::PHP_8_2),
                reason: 'Partial version skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassPropertiesExistCheck($reflectionProvider, $registry);

        $resultIn = $check->run($stubsManager, $className, '8.1');
        $this->assertFalse($resultIn->hasFailures(), 'PHP 8.1 is within range: should be skipped');

        $resultOut = $check->run($stubsManager, $className, '8.3');
        $this->assertTrue($resultOut->hasFailures(), 'PHP 8.3 is outside range: should report failure');
        $this->assertArrayHasKey($missingPropertyId, $resultOut->getFailures());
    }
}
