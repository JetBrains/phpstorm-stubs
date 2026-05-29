<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsOptionalParametersCheck;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;

class ClassMethodsOptionalParametersCheckTest extends CheckTestCase
{
    private ClassMethodsOptionalParametersCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsOptionalParametersCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMethodWithNoOptionalParamsSucceeds(): void
    {
        $className  = '\MyClass';
        $params     = [$this->makeParam('a'), $this->makeParam('b')];

        $reflClass  = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $params)]
        );
        $stubClass  = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('doWork', $params)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testOptionalParamInReflectionAndStubsIsSuccess(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testOptionalParamInReflectionButNotStubsIsFailure(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [$this->makeParam('a'), $this->makeParam('b')]; // not optional

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failureKey = $className . '::compute';
        $this->assertArrayHasKey($failureKey, $result->getFailures());
        $message = $result->getFailures()[$failureKey];
        $this->assertStringContainsString('$b', $message);
        $this->assertStringContainsString('optional in PHP 8.0', $message);
        $this->assertStringContainsString('not in stubs', $message);
    }

    public function testOptionalInStubsButNotReflectionIsSuccess(): void
    {
        // One-directional: stubs can be more permissive
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('x')];
        $stubParams = [$this->makeParam('x', optional: true)]; // optional in stubs only

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testParamMissingFromStubMethodIsNotReportedAsOptionalMismatch(): void
    {
        // Missing params are ParametersCountCheck's responsibility
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [$this->makeParam('a')]; // 'b' absent

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMethodMissingFromStubsIsNotReportedAsOptionalMismatch(): void
    {
        // Missing methods are ClassMethodsExistCheck's responsibility
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('b', optional: true)];

        $reflClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->createMockMethod('onlyInRefl', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no methods

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testVersionExcludedStubParamIsIgnored(): void
    {
        $className  = '\MyClass';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [
            $this->makeParam('a'),
            $this->makeParam('b', sinceVersion: '8.1'), // not available in PHP 8.0
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

        // 'b' excluded → not in stub map → skipped
        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Hierarchy: method from parent class ───────────────────────────────────

    public function testOptionalParamMismatchInheritedFromParentIsChecked(): void
    {
        $className       = '\Child';
        $parentClassName = '\Parent';

        $reflParams = [$this->makeParam('x', optional: true)]; // optional in reflection
        $stubParams = [$this->makeParam('x')]; // not optional in stubs

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

        $result = (new ClassMethodsOptionalParametersCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::inherited', $result->getFailures());
    }

    // ── Known problems — class level ──────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllMethods(): void
    {
        $className  = '\SpecialClass';
        $reflParams = [$this->makeParam('x', optional: true)];
        $stubParams = [$this->makeParam('x')]; // mismatch

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
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Class-level optional params skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsOptionalParametersCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Class-level optional params skip', array_values($skipped)[0]);
    }

    // ── Known problems — method level ─────────────────────────────────────────

    public function testMethodLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className    = '\MyClass';
        $mismatchedId = $className . '::badMethod';

        $reflParams = [$this->makeParam('x', optional: true)];
        $stubParams = [$this->makeParam('x')]; // mismatch

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
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level optional params skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsOptionalParametersCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level optional params skip', array_values($skipped)[0]);
    }
}
