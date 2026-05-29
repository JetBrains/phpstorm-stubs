<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterTypesCheck;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;

class ClassMethodsParameterTypesCheckTest extends CheckTestCase
{
    private ClassMethodsParameterTypesCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsParameterTypesCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsPhp70AndAbove(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_5_6->value));
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

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

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
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMethodWithNoParametersSucceeds(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork')]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork')]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMatchingTypesSucceed(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('a', $this->createType('string')), $this->makeParam('b', $this->createType('int'))];
        $stubParams = [$this->makeParam('a', $this->createType('string')), $this->makeParam('b', $this->createType('int'))];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('compute', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('compute', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Type mismatch detection ───────────────────────────────────────────────

    public function testTypeMismatchIsFailure(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x', $this->createType('string'))];
        $stubParams = [$this->makeParam('x', $this->createType('int'))]; // wrong type

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failureKey = $className . '::doIt';
        $this->assertArrayHasKey($failureKey, $result->getFailures());
        $message = $result->getFailures()[$failureKey];
        $this->assertStringContainsString('$x', $message);
        $this->assertStringContainsString("reflection 'string'", $message);
        $this->assertStringContainsString("stubs 'int'", $message);
    }

    public function testMultipleMismatchesReportedTogether(): void
    {
        $className  = '\MyClass';
        $reflParams = [
            $this->makeParam('a', $this->createType('string')),
            $this->makeParam('b', $this->createType('int')),
        ];
        $stubParams = [
            $this->makeParam('a', $this->createType('int')),   // wrong
            $this->makeParam('b', $this->createType('bool')),  // wrong
        ];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('compute', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('compute', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$className . '::compute'];
        $this->assertStringContainsString('$a', $message);
        $this->assertStringContainsString('$b', $message);
    }

    // ── No-type special cases ─────────────────────────────────────────────────

    public function testReflectionHasNoTypeButStubHasTypeIsSuccess(): void
    {
        // Stubs are allowed to be more informative
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x')];                               // no type
        $stubParams = [$this->makeParam('x', $this->createType('string'))];  // typed

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothHaveNoTypeIsSuccess(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x')]; // no type
        $stubParams = [$this->makeParam('x')]; // no type

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testReflectionHasTypeButStubHasNoneIsFailure(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x', $this->createType('string'))]; // typed
        $stubParams = [$this->makeParam('x')];                               // no type

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$className . '::doIt'];
        $this->assertStringContainsString('$x', $message);
        $this->assertStringContainsString("reflection 'string'", $message);
        $this->assertStringContainsString("stubs 'none'", $message);
    }

    // ── Type normalisation ────────────────────────────────────────────────────

    public function testUnionTypeOrderIsIgnored(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x', $this->createUnionType('string', 'int'))];
        $stubParams = [$this->makeParam('x', $this->createUnionType('int', 'string'))]; // different order

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testLeadingBackslashIsStripped(): void
    {
        $className  = '\MyClass';
        // Reflection might return '\DateTime' while stub has 'DateTime'
        $reflParams = [$this->makeParam('d', $this->createType('\DateTime'))];
        $stubParams = [$this->makeParam('d', $this->createType('DateTime'))];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doIt', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Parameter missing from stubs ──────────────────────────────────────────

    public function testParamMissingFromStubMethodIsNotReportedAsTypeMismatch(): void
    {
        // Missing params are ParametersCountCheck's responsibility
        $className  = '\MyClass';
        $reflParams = [
            $this->makeParam('a', $this->createType('string')),
            $this->makeParam('b', $this->createType('int')),
        ];
        $stubParams = [$this->makeParam('a', $this->createType('string'))]; // 'b' absent

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMethodMissingFromStubsIsSkipped(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('a', $this->createType('string'))];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('onlyInRefl', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no methods

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testVersionExcludedStubParamIsIgnored(): void
    {
        // Stub param 'b' only since 8.1; checking PHP 8.0 → not available → skip mismatch
        $className  = '\MyClass';
        $reflParams = [
            $this->makeParam('a', $this->createType('string')),
            $this->makeParam('b', $this->createType('int')),
        ];
        $stubParams = [
            $this->makeParam('a', $this->createType('string')),
            $this->makeParam('b', $this->createType('bool'), sinceVersion: '8.1'), // not in PHP 8.0
        ];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        // 'b' excluded from version-filtered stub map → treated as missing → no failure
        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testVersionRemovedStubParamIsIgnored(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('a', $this->createType('string')), $this->makeParam('b', $this->createType('int'))];
        $stubParams = [
            $this->makeParam('a', $this->createType('string')),
            $this->makeParam('b', $this->createType('int'), removedVersion: '7.4'), // removed in 8.0
        ];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── LanguageLevelTypeAware ────────────────────────────────────────────────

    public function testLanguageLevelTypeAwareResolvesForVersion(): void
    {
        $className  = '\MyClass';
        // Reflection: 'CurlHandle' in PHP 8.0
        $reflParams = [$this->makeParam('handle', $this->createType('CurlHandle'))];
        // Stub: LanguageLevelTypeAware(['8.0' => 'CurlHandle'], default: '')
        $stubParams = [$this->makeParam('handle', languageLevelTypes: ['8.0' => 'CurlHandle'], defaultType: '')];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('exec', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('exec', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testLanguageLevelTypeAwareBeforeVersionHasNoType(): void
    {
        $className  = '\MyClass';
        // Reflection: resource in PHP 7.4 (no type in reflection)
        $reflParams = [$this->makeParam('handle')]; // no type in reflection for PHP 7.4
        // Stub: LanguageLevelTypeAware(['8.0' => 'CurlHandle'], default: '') — empty default
        $stubParams = [$this->makeParam('handle', languageLevelTypes: ['8.0' => 'CurlHandle'], defaultType: '')];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('exec', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('exec', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        // PHP 7.4: reflection has no type → skip; stub resolves to '' (no type for 7.4) → ok
        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '7.4');

        $this->assertFalse($result->hasFailures());
    }

    // ── Deduplication of same-named params (variadic workaround) ─────────────

    public function testSameNamedVariadicParamDeduplicationSucceeds(): void
    {
        $className  = '\MyClass';
        // Reflection: single 'values' param with type string
        $reflParams = [$this->makeParam('values', $this->createType('string'))];
        // Stub: placeholder removed in PHP 8.0 + variadic — after dedup one 'values' param remains
        $stubParams = [
            $this->makeParam('values', $this->createType('int'), removedVersion: '7.4'),
            $this->makeParam('values', $this->createType('string'), variadic: true), // variadic
        ];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('collect', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('collect', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        // PHP 8.0: placeholder removed → only variadic 'values' remains → matches reflection
        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Hierarchy: inherited method from parent class ─────────────────────────

    public function testTypeMismatchInheritedFromParentIsChecked(): void
    {
        $className       = '\Child';
        $parentClassName = '\Parent';

        $reflParams = [$this->makeParam('x', $this->createType('string'))];
        $stubParams = [$this->makeParam('x', $this->createType('int'))]; // wrong type in parent stub

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('inherited', $reflParams)]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->createMockMethod('inherited', $stubParams)]);

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsParameterTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::inherited', $result->getFailures());
    }

    // ── Known problems — class level ──────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllMethods(): void
    {
        $className  = '\SpecialClass';
        $reflParams = [$this->makeParam('x', $this->createType('string'))];
        $stubParams = [$this->makeParam('x', $this->createType('int'))]; // mismatch

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level param types skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Class-level param types skip', array_values($skipped)[0]);
    }

    // ── Known problems — method level ─────────────────────────────────────────

    public function testMethodLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className    = '\MyClass';
        $mismatchedId = $className . '::badMethod';

        $reflParams = [$this->makeParam('x', $this->createType('string'))];
        $stubParams = [$this->makeParam('x', $this->createType('int'))]; // mismatch

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->createMockMethod('badMethod', $reflParams),
                $this->createMockMethod('goodMethod', []),
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [
                $this->createMockMethod('badMethod', $stubParams),
                $this->createMockMethod('goodMethod', []),
            ]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $mismatchedId,
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level param types skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterTypesCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level param types skip', array_values($skipped)[0]);
    }
}
