<?php

namespace StubTests\Unit\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertiesTypeCheck;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Runner\PhpVersionRange;

class ClassPropertiesTypeCheckTest extends CheckTestCase
{
    private ClassPropertiesTypeCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassPropertiesTypeCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    /**
     * Create a PHPProperty with the given signature type and optional version data.
     *
     * @param string      $name              Property name
     * @param mixed       $type              Type object (StandaloneType, NoType, UnionType, etc.) or null for no type
     * @param string|null $sinceVersion      Version this property was added
     * @param string|null $removedVersion    Version this property was removed
     * @param array|null  $languageLevelTypes  LanguageLevelTypeAware map, e.g. ['8.0' => 'CurlHandle']
     * @param string|null $defaultType       Default type for LanguageLevelTypeAware
     */
    private function makeProperty(
        string $name,
        mixed $type = null,
        ?string $sinceVersion = null,
        ?string $removedVersion = null,
        ?array $languageLevelTypes = null,
        ?string $defaultType = null
    ): PHPProperty {
        $property = new PHPProperty();
        $property->setName($name);
        if ($type !== null) {
            $property->setTypeFromSignature($type);
        }
        if ($sinceVersion !== null) {
            $property->initStubsMetadata()->setSinceVersion($sinceVersion);
        }
        if ($removedVersion !== null) {
            $property->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        if ($languageLevelTypes !== null) {
            $property->initStubsMetadata()->setLanguageLevelTypes($languageLevelTypes);
        }
        if ($defaultType !== null) {
            $property->initStubsMetadata()->setDefaultType($defaultType);
        }
        return $property;
    }

    // ── supports() ───────────────────────────────────────────────────────────

    public function testSupportsPhp74AndAbove(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::PHP_5_6->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_3->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_4->value));
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

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMatchingSignatureTypesIsSuccess(): void
    {
        $className = '\MyClass';
        $stringType = $this->createType('string');

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', $stringType)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('name', $stringType)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testTypeMismatchIsFailure(): void
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
            [$this->makeProperty('count', $this->createType('int'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('count', $this->createType('string'))]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className . '::$count', $failures);
        $this->assertStringContainsString('int', $failures[$className . '::$count']);
        $this->assertStringContainsString('string', $failures[$className . '::$count']);
        $this->assertStringContainsString('8.0', $failures[$className . '::$count']);
    }

    public function testMultiplePropertiesMismatchesAreAllReported(): void
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
                $this->makeProperty('name', $this->createType('string')), // matches
                $this->makeProperty('count', $this->createType('int')),    // mismatch
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
                $this->makeProperty('name', $this->createType('string')),
                $this->makeProperty('count', $this->createType('string')), // wrong
            ]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$count', $result->getFailures());
    }

    // ── Null / NoType handling ─────────────────────────────────────────────────

    public function testReflectionNoTypeStubHasTypeIsSuccess(): void
    {
        // Reflection has no type (NoType) but stub documents it — stubs are more informative
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', new NoType())]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', $this->createType('string'))]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBothHaveNoTypeIsSuccess(): void
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
            [$this->makeProperty('data', new NoType())]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', new NoType())]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testReflectionHasTypeStubHasNoTypeIsFailure(): void
    {
        // Reflection declares a type but stub doesn't — stub is missing the declaration
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', $this->createType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', new NoType())]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$data', $result->getFailures());
    }

    // ── LanguageLevelTypeAware ────────────────────────────────────────────────

    public function testLanguageLevelDefaultTypeUsedWhenVersionNotReached(): void
    {
        // Stub: #[LanguageLevelTypeAware(['8.1' => 'string'], default: '')]
        // PHP 8.0 → default '' → treated as no type → refl also NoType → match
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', new NoType())]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', null, null, null, ['8.1' => 'string'], '')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testLanguageLevelVersionSpecificTypeUsedWhenVersionReached(): void
    {
        // Stub: #[LanguageLevelTypeAware(['8.1' => 'string'], default: '')]
        // PHP 8.1 → version-specific 'string' → must match reflection
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', $this->createType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', null, null, null, ['8.1' => 'string'], '')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testLanguageLevelVersionSpecificTypeMismatchIsFailure(): void
    {
        // Stub resolves to 'string' for PHP 8.1 but reflection says 'int'
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', $this->createType('int'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', null, null, null, ['8.1' => 'string'], '')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$handle', $result->getFailures());
    }

    public function testLanguageLevelHighestApplicableVersionWins(): void
    {
        // ['7.4' => 'resource', '8.0' => 'CurlHandle'], default: ''
        // PHP 8.0 → 'CurlHandle'
        // PHP 7.4 → 'resource'
        // PHP 7.3 → '' → treated as no type
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', null, null, null, ['7.4' => 'resource', '8.0' => 'CurlHandle'], '')]
        );

        // PHP 8.0: reflection has 'CurlHandle'
        $reflClass80 = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', $this->createType('CurlHandle'))]
        );
        $provider80 = $this->createMockReflectionProvider([], [$reflClass80]);
        $stubs80 = $this->createMockStorageManager();
        $stubs80->method('getClasses')->willReturn([$stubClass]);
        $result80 = (new ClassPropertiesTypeCheck($provider80))->run($stubs80, $className, '8.0');
        $this->assertFalse($result80->hasFailures(), 'PHP 8.0 should match CurlHandle');

        // PHP 7.4: reflection has 'resource'
        $reflClass74 = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', $this->createType('resource'))]
        );
        $provider74 = $this->createMockReflectionProvider([], [$reflClass74]);
        $stubs74 = $this->createMockStorageManager();
        $stubs74->method('getClasses')->willReturn([$stubClass]);
        $result74 = (new ClassPropertiesTypeCheck($provider74))->run($stubs74, $className, '7.4');
        $this->assertFalse($result74->hasFailures(), 'PHP 7.4 should match resource');

        // PHP 7.3: stub resolves to '' (default) → no type → skip when refl also no type
        $reflClass73 = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('handle', new NoType())]
        );
        $provider73 = $this->createMockReflectionProvider([], [$reflClass73]);
        $stubs73 = $this->createMockStorageManager();
        $stubs73->method('getClasses')->willReturn([$stubClass]);
        $result73 = (new ClassPropertiesTypeCheck($provider73))->run($stubs73, $className, '7.4');
        $this->assertFalse($result73->hasFailures(), 'PHP 7.3 should match (both untyped)');
    }

    public function testSignatureTypeTakesPrecedenceOverLanguageLevelTypeAware(): void
    {
        // Stub has BOTH a signature type AND LanguageLevelTypeAware — signature wins
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', $this->createType('string'))]
        );
        // Signature type 'string', but LanguageLevelTypeAware says 'int' for 8.0
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', $this->createType('string'), null, null, ['8.0' => 'int'], 'bool')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Type normalization ────────────────────────────────────────────────────

    public function testUnionTypesMatchRegardlessOfOrder(): void
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
            [$this->makeProperty('value', $this->createType('string|int'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('value', $this->createType('int|string'))]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testFqnLeadingBackslashIsStripped(): void
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
            [$this->makeProperty('obj', $this->createType('DateTimeImmutable'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('obj', $this->createType('\DateTimeImmutable'))]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Missing stub property is not our concern ──────────────────────────────

    public function testPropertyMissingFromStubsIsNotReportedAsTypeMismatch(): void
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
            [$this->makeProperty('onlyInReflection', $this->createType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no properties

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
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
            [$this->makeProperty('newProp', $this->createType('int'))]
        );
        // Stub property not yet available in 8.0 — existence check's responsibility;
        // type check should silently skip it
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('newProp', $this->createType('string'), '8.1')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Hierarchy traversal ───────────────────────────────────────────────────

    public function testTypeInheritedFromParentMismatchIsReported(): void
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
            [$this->makeProperty('data', $this->createType('int'))]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('data', $this->createType('string'))]); // wrong type

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::$data', $result->getFailures());
    }

    public function testTypeInheritedFromParentMatchIsSuccess(): void
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
            [$this->makeProperty('data', $this->createType('int'))]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('data', $this->createType('int'))]); // correct

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testChildPropertyOverridesParentForTypeCheck(): void
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
            [$this->makeProperty('data', $this->createType('int'))]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setProperties([$this->makeProperty('data', $this->createType('string'))]); // parent: wrong

        $childStub = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', $this->createType('int'))] // child overrides correctly
        );
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassPropertiesTypeCheck($provider))->run($stubs, $className, '8.0');

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
            [$this->makeProperty('data', $this->createType('int'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [$this->makeProperty('data', $this->createType('string'))]  // wrong type
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_TYPE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider, $registry))->run($stubs, $className, '8.0');

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
        $mismatchedId = $className . '::$data';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [],
            null,
            [],
            [
                $this->makeProperty('name', $this->createType('string')), // matches
                $this->makeProperty('data', $this->createType('int')),    // mismatch — known problem
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
                $this->makeProperty('name', $this->createType('string')),
                $this->makeProperty('data', $this->createType('string')), // wrong, but known problem
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $mismatchedId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_TYPE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Property-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider, $registry))->run($stubs, $className, '8.0');

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
                $this->makeProperty('data', $this->createType('int')),  // mismatch — known problem
                $this->makeProperty('count', $this->createType('int')),  // mismatch — NOT a known problem
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
                $this->makeProperty('data', $this->createType('string')),
                $this->makeProperty('count', $this->createType('string')),
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: $className . '::$data',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_TYPE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Only data is known'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassPropertiesTypeCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(1, $result->getFailures());
        $this->assertArrayHasKey($className . '::$count', $result->getFailures());
        $this->assertArrayNotHasKey($className . '::$data', $result->getFailures());
    }
}
