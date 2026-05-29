<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDefaultValueCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassMethodsParameterDefaultValueCheckTest extends CheckTestCase
{
    private ClassMethodsParameterDefaultValueCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsParameterDefaultValueCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsOnlyLatestPhpVersion(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_3->value));
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

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

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

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$className]);
    }

    // ── No methods / no defaults ──────────────────────────────────────────────

    public function testClassWithNoMethodsSucceeds(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testParameterWithNoDefaultIsSkipped(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x')]; // no default
        $stubParams = [$this->makeParam('x')];

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

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Matching defaults ─────────────────────────────────────────────────────

    public function testMatchingIntegerDefaultSucceeds(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('sort', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('sort', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testMatchingStringDefaultSucceeds(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('sep', hasDefaultValue: true, defaultValue: ',', optional: true)];
        $stubParams = [$this->makeParam('sep', hasDefaultValue: true, defaultValue: ',', optional: true)];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('join', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('join', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testMatchingBoolDefaultSucceeds(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('strict', hasDefaultValue: true, defaultValue: false, optional: true)];
        $stubParams = [$this->makeParam('strict', hasDefaultValue: true, defaultValue: false, optional: true)];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('search', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('search', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testMismatchedIntegerDefaultIsFailure(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];   // reflection: 0
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 1, optional: true)];   // stub: 1 — wrong

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('sort', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('sort', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $failureKey = $className . '::sort';
        $this->assertArrayHasKey($failureKey, $result->getFailures());
        $message = $result->getFailures()[$failureKey];
        $this->assertStringContainsString('$flags', $message);
        $this->assertStringContainsString("reflection '0'", $message);
        $this->assertStringContainsString("stubs '1'", $message);
    }

    public function testMismatchedStringDefaultIsFailure(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('sep', hasDefaultValue: true, defaultValue: ',', optional: true)];
        $stubParams = [$this->makeParam('sep', hasDefaultValue: true, defaultValue: ';', optional: true)]; // wrong separator

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('join', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('join', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('$sep', $result->getFailures()[$className . '::join']);
    }

    public function testMismatchedBoolDefaultIsFailure(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('strict', hasDefaultValue: true, defaultValue: true, optional: true)];
        $stubParams = [$this->makeParam('strict', hasDefaultValue: true, defaultValue: false, optional: true)]; // wrong bool

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('search', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('search', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$className . '::search'];
        $this->assertStringContainsString("reflection 'true'", $message);
        $this->assertStringContainsString("stubs 'false'", $message);
    }

    public function testMultipleMismatchesReportedTogether(): void
    {
        $className  = '\MyClass';
        $reflParams = [
            $this->makeParam('a', hasDefaultValue: true, defaultValue: 1, optional: true),
            $this->makeParam('b', hasDefaultValue: true, defaultValue: 'hello', optional: true),
        ];
        $stubParams = [
            $this->makeParam('a', hasDefaultValue: true, defaultValue: 2, optional: true),   // wrong
            $this->makeParam('b', hasDefaultValue: true, defaultValue: 'bye', optional: true), // wrong
        ];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('run', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('run', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$className . '::run'];
        $this->assertStringContainsString('$a', $message);
        $this->assertStringContainsString('$b', $message);
    }

    // ── Null-skip behaviour ───────────────────────────────────────────────────

    public function testNullReflectionDefaultIsSkipped(): void
    {
        // When reflection default is null (actual null OR unavailable), skip comparison
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: null, optional: true)]; // reflection: null
        $stubParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: 42, optional: true)];   // stub: 42

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

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testNullStubDefaultIsSkipped(): void
    {
        // Stub default is null: either actual null or failed constant evaluation — skip
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: 42, optional: true)];   // reflection: 42
        $stubParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: null, optional: true)]; // stub: null (unevaluable or actual null)

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

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Stub has no default ───────────────────────────────────────────────────

    public function testStubHasNoDefaultIsSkipped(): void
    {
        // Stub parameter without default: OptionalParametersCheck handles this, not us
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: 42, optional: true)];  // reflection has default
        $stubParams = [$this->makeParam('x')];     // stub has no default

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

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Missing stub parameter ────────────────────────────────────────────────

    public function testMissingStubParameterIsSkipped(): void
    {
        // ParametersCountCheck is responsible for missing params
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: 42, optional: true)];
        $stubParams = []; // empty

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

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Type-strict comparison ────────────────────────────────────────────────

    public function testIntegerZeroVsFalseIsMismatch(): void
    {
        // 0 !== false — uses strict comparison
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('mode', hasDefaultValue: true, defaultValue: 0, optional: true)];
        $stubParams = [$this->makeParam('mode', hasDefaultValue: true, defaultValue: false, optional: true)]; // wrong type

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('run', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('run', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$className . '::run'];
        $this->assertStringContainsString("reflection '0'", $message);
        $this->assertStringContainsString("stubs 'false'", $message);
    }

    // ── Inherited method from parent ──────────────────────────────────────────

    public function testMismatchInheritedFromParentIsChecked(): void
    {
        $className       = '\Child';
        $parentClassName = '\Base';

        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 1, optional: true)]; // wrong value in parent stub

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('sort', $reflParams)]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->createMockMethod('sort', $stubParams)]);

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::sort', $result->getFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAll(): void
    {
        $className  = '\SpecialClass';
        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 99, optional: true)]; // mismatch

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('run', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('run', $stubParams)]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::PARAMETER_DEFAULT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::LATEST, PhpVersions::LATEST),
                reason: 'Runtime-dependent default'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider, $registry))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Runtime-dependent default', array_values($skipped)[0]);
    }

    public function testMethodLevelKnownProblemSkipsSpecificMethod(): void
    {
        $className    = '\MyClass';
        $mismatchedId = $className . '::badMethod';

        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 99, optional: true)]; // mismatch

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
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::PARAMETER_DEFAULT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::LATEST, PhpVersions::LATEST),
                reason: 'Platform-specific default'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterDefaultValueCheck($provider, $registry))->run($stubs, $className, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Platform-specific default', array_values($skipped)[0]);
    }
}
