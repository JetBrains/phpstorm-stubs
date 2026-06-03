<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionOptionalParametersCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionOptionalParametersCheckTest extends CheckTestCase
{
    private FunctionOptionalParametersCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new FunctionOptionalParametersCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    private function makeFunction(string $id, array $params = []): PHPFunction
    {
        $fn = new PHPFunction();
        $fn->setId($id);
        $fn->setName(ltrim($id, '\\'));
        $fn->setParameters($params);
        return $fn;
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Function not found ────────────────────────────────────────────────────

    public function testFunctionNotFoundInReflectionIsFailure(): void
    {
        $id = '\\missing_func';
        $provider = $this->createMockReflectionProvider([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$id]);
    }

    public function testFunctionNotFoundInStubsIsSuccess(): void
    {
        // Absence from stubs is FunctionExistsCheck's responsibility — silently skip
        $id = '\\missing_func';
        $provider = $this->createMockReflectionProvider([$this->makeFunction($id)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testFunctionWithNoParametersSucceeds(): void
    {
        $id = '\\no_params';
        $provider = $this->createMockReflectionProvider([$this->makeFunction($id)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testAllParametersRequiredBothSidesSucceeds(): void
    {
        $id = '\\my_func';
        $params = [$this->makeParam('a'), $this->makeParam('b')];

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $params)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $params)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testOptionalInReflectionAndOptionalInStubsIsSuccess(): void
    {
        $id = '\\my_func';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testOptionalInReflectionButNotInStubsIsFailure(): void
    {
        $id = '\\my_func';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [$this->makeParam('a'), $this->makeParam('b')]; // not optional

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($id, $result->getFailures());
        $this->assertStringContainsString('$b', $result->getFailures()[$id]);
        $this->assertStringContainsString('optional in PHP 8.0', $result->getFailures()[$id]);
        $this->assertStringContainsString('not in stubs', $result->getFailures()[$id]);
    }

    public function testMultipleOptionalParamsMissingInStubsReportedTogether(): void
    {
        $id = '\\my_func';
        $reflParams = [
            $this->makeParam('a', optional: true),
            $this->makeParam('b', optional: true),
            $this->makeParam('c', optional: true),
        ];
        $stubParams = [
            $this->makeParam('a'),
            $this->makeParam('b'),
            $this->makeParam('c'),
        ];

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$id];
        $this->assertStringContainsString('$a', $message);
        $this->assertStringContainsString('$b', $message);
        $this->assertStringContainsString('$c', $message);
    }

    public function testOptionalInStubsButNotInReflectionIsSuccess(): void
    {
        // One-directional check: stubs can be more permissive
        $id = '\\my_func';
        $reflParams = [$this->makeParam('a')];   // required in reflection
        $stubParams = [$this->makeParam('a', optional: true)];    // optional in stubs

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParameterMissingFromStubsIsNotReported(): void
    {
        // Missing params are ParametersCountCheck's responsibility
        $id = '\\my_func';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [$this->makeParam('a')]; // 'b' absent from stubs

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Version filtering ─────────────────────────────────────────────────────

    public function testVersionExcludedStubParamIsIgnored(): void
    {
        // Stub has 'b' only since 8.1; checking PHP 8.0 → not available → skip mismatch
        $id = '\\my_func';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [
            $this->makeParam('a'),
            $this->makeParam('b', sinceVersion: '8.1'), // not available in PHP 8.0
        ];

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        // 'b' is excluded from the version-filtered stub map → treated as missing → no failure
        $this->assertFalse($result->hasFailures());
    }

    public function testVersionRemovedStubParamIsIgnored(): void
    {
        // Stub has 'b' only until 7.4; checking PHP 8.0 → removed → skip
        $id = '\\my_func';
        $reflParams = [$this->makeParam('a'), $this->makeParam('b', optional: true)];
        $stubParams = [
            $this->makeParam('a'),
            $this->makeParam('b', removedVersion: '7.4'), // removed in 8.0
        ];

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);

        $result = (new FunctionOptionalParametersCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testKnownProblemSkipsValidation(): void
    {
        $id = '\\special_func';

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: $id,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Optional params skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        // Mismatch: refl optional, stub not optional — would normally fail
        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('x', optional: true)]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [$this->makeParam('x')]),
        ]);

        $result = (new FunctionOptionalParametersCheck($provider, $registry))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('Optional params skip reason', $successes[0]);
    }
}
