<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterNamesCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassMethodsParameterNamesCheckTest extends CheckTestCase
{
    private ClassMethodsParameterNamesCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsParameterNamesCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsPhp80AndAbove(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_5_6->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_4->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_1->value));
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

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

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

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$className]);
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testMatchingParameterNamesSucceed(): void
    {
        $className = '\MyClass';
        $reflParams = [$this->makeParam('callback'), $this->makeParam('array')];
        $stubParams = [$this->makeParam('callback'), $this->makeParam('array')];

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMethodMissingFromStubsIsSkipped(): void
    {
        $className = '\MyClass';
        $reflParams = [$this->makeParam('x')];

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('onlyInRefl', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Name mismatch detection ───────────────────────────────────────────────

    public function testParameterNameMismatchIsFailure(): void
    {
        $className = '\MyClass';
        $reflParams = [$this->makeParam('callback')];
        $stubParams = [$this->makeParam('fn')]; // wrong name

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('invoke', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('invoke', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $methodId = $className . '::invoke';
        $this->assertArrayHasKey($methodId, $result->getFailures());
        $message = $result->getFailures()[$methodId];
        $this->assertStringContainsString('$callback', $message);
        $this->assertStringContainsString('$fn', $message);
    }

    public function testMultipleNameMismatchesReportedTogether(): void
    {
        $className = '\MyClass';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b')];
        $stubParams = [$this->makeParam('x'), $this->makeParam('y')]; // both wrong

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('compute', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('compute', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$className . '::compute'];
        $this->assertStringContainsString('$a', $message);
        $this->assertStringContainsString('$b', $message);
    }

    // ── Count mismatch → silently skip ────────────────────────────────────────

    public function testCountMismatchDoesNotProduceNameError(): void
    {
        // When count mismatches, ParametersCountCheck's responsibility; names check is skipped
        $className = '\MyClass';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b')];
        $stubParams = [$this->makeParam('x')]; // count differs AND name wrong

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testVersionFilteredParamIsExcluded(): void
    {
        // Stub param 'extra' only since 8.1; checking PHP 8.0 → excluded → count matches, name ok
        $className = '\MyClass';
        $reflParams = [$this->makeParam('value')];
        $stubParams = [
            $this->makeParam('value'),
            $this->makeParam('extra', sinceVersion: '8.1'), // not present in PHP 8.0
        ];

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Variadic deduplication ────────────────────────────────────────────────

    public function testSameNamedVariadicDeduplication(): void
    {
        // Stub: placeholder removed in PHP 8.0 + variadic of same name
        $className = '\MyClass';
        $reflParams = [$this->makeParam('values')]; // single param in reflection
        $stubParams = [
            $this->makeParam('values', removedVersion: '7.4'), // removed after 7.4
            $this->makeParam('values', variadic: true), // variadic
        ];

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('collect', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('collect', $stubParams)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        // PHP 8.0: placeholder removed → only variadic 'values' remains → names match
        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Hierarchy: inherited method from parent class ─────────────────────────

    public function testNameMismatchInheritedFromParentIsChecked(): void
    {
        $className = '\Child';
        $parentClassName = '\Parent';

        $reflParams = [$this->makeParam('value')];
        $stubParams = [$this->makeParam('wrongName')]; // wrong name in parent stub

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('inherited', $reflParams)]
        );

        $parentStub = new PHPClass();
        $parentStub->setId($parentClassName);
        $parentStub->setMethods([$this->createMockMethod('inherited', $stubParams)]);

        $childStub = $this->createMockClassWithProperties($className);
        $childStub->setParentClass($parentStub);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$childStub]);

        $result = (new ClassMethodsParameterNamesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::inherited', $result->getFailures());
    }

    // ── Known problems — class level ──────────────────────────────────────────

    public function testClassLevelKnownProblemSkipsAllMethods(): void
    {
        $className = '\SpecialClass';
        $reflParams = [$this->makeParam('correct')];
        $stubParams = [$this->makeParam('wrong')]; // mismatch

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $reflParams)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->createMockMethod('doWork', $stubParams)]
        );

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'Class-level param names skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Class-level param names skip', array_values($skipped)[0]);
    }

    // ── Known problems — method level ─────────────────────────────────────────

    public function testMethodLevelKnownProblemSkipsSpecificMismatch(): void
    {
        $className = '\MyClass';
        $mismatchedId = $className . '::badMethod';

        $reflParams = [$this->makeParam('correct')];
        $stubParams = [$this->makeParam('wrong')]; // mismatch

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [
                $this->createMockMethod('badMethod', $reflParams),
                $this->createMockMethod('goodMethod', []),
            ]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
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
                affectedChecks: [CheckType::PARAMETER_NAMES],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'Method-level param names skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsParameterNamesCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level param names skip', array_values($skipped)[0]);
    }
}
