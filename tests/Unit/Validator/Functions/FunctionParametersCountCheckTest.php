<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionParametersCountCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionParametersCountCheckTest extends CheckTestCase
{
    private FunctionParametersCountCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new FunctionParametersCountCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    /**
     * Build a PHPFunction with the given id and optional parameters.
     */
    private function makeFunction(string $id, array $parameters = []): PHPFunction
    {
        $fn = new PHPFunction();
        $fn->setId($id);
        $fn->setName(ltrim($id, '\\'));
        $fn->setParameters($parameters);
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

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$id]);
    }

    public function testFunctionNotFoundInStubsIsSuccess(): void
    {
        // Existence is FunctionExistsCheck's responsibility — silently skip
        $id = '\\missing_func';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testMatchingParameterCountIsSuccess(): void
    {
        $id = '\\my_func';
        $params = [$this->makeParam('a'), $this->makeParam('b')];

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $params)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $params)]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testFunctionWithNoParametersSucceeds(): void
    {
        $id = '\\no_params_func';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id)]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testParameterCountMismatchIsFailure(): void
    {
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('a'), $this->makeParam('b')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [$this->makeParam('a')]), // one param fewer
        ]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($id, $result->getFailures());
        $this->assertStringContainsString('2', $result->getFailures()[$id]);
        $this->assertStringContainsString('1', $result->getFailures()[$id]);
    }

    // ── PhpStormStubsElementAvailable (sinceVersion / removedVersion) ─────────

    public function testParamNotYetAddedIsExcludedFromCount(): void
    {
        // Stub has an extra param with sinceVersion=8.1; we check PHP 8.0 → not counted
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('a')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('a'),
                $this->makeParam('b', sinceVersion: '8.1'), // not yet available in 8.0
            ]),
        ]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testParamAddedAtExactSinceVersionIsIncluded(): void
    {
        // sinceVersion=8.0, phpVersion=8.0 → included (>= boundary)
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('a'), $this->makeParam('b')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('a'),
                $this->makeParam('b', sinceVersion: '8.0'), // exactly 8.0 → included
            ]),
        ]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testParamAtExactRemovedVersionIsStillIncluded(): void
    {
        // removedVersion is the EXCLUSIVE upper bound (first version where param is gone).
        // removedVersion='7.2' means "available up to and including PHP 7.1".
        // version_compare('7.1','7.2','<') is true → param IS counted for PHP 7.1.
        $id = '\\legacy_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('a'), $this->makeParam('b')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('a'),
                $this->makeParam('b', removedVersion: '7.2'), // excluded from 7.2+, available in 7.1
            ]),
        ]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '7.1');

        $this->assertFalse($result->hasFailures(), 'Param included when phpVersion < removedVersion (exclusive boundary)');
    }

    public function testParamAfterRemovedVersionIsExcluded(): void
    {
        // removedVersion=7.1, phpVersion=7.2 → 7.2 > 7.1 → excluded
        $id = '\\legacy_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('a')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('a'),
                $this->makeParam('b', removedVersion: '7.1'), // gone in 7.2+
            ]),
        ]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '7.2');

        $this->assertFalse($result->hasFailures(), 'Param excluded after removedVersion');
    }

    // ── Same-name deduplication (placeholder + variadic) ─────────────────────

    public function testPlaceholderAndVariadicWithSameNameCountAsOne(): void
    {
        // Stub: f($x, $vals[removedVersion:'7.5'], ...$vals)
        // removedVersion='7.5' means excluded from 7.5+, so placeholder IS available in PHP 7.4.
        // In PHP 7.4: placeholder+variadic both available → deduplicated to unique names {'x','vals'} = 2
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('x'), $this->makeParam('vals')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('x'),
                $this->makeParam('vals', removedVersion: '7.5'), // placeholder: excluded from 7.5+, available in 7.4
                $this->makeParam('vals'),              // variadic: always available
            ]),
        ]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '7.4');

        $this->assertFalse($result->hasFailures(), 'Placeholder+variadic with same name counted as one');
    }

    public function testVariadicAloneCountsNormallyWhenPlaceholderExcluded(): void
    {
        // In PHP 8.0: placeholder excluded (removedVersion='7.5' means excluded from 7.5+),
        // only variadic 'vals' counts → unique names {'x','vals'} = 2
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('x'), $this->makeParam('vals')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('x'),
                $this->makeParam('vals', removedVersion: '7.5'), // excluded from 7.5+ (including PHP 8.0)
                $this->makeParam('vals'),              // only this counts in PHP 8.0
            ]),
        ]);

        $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures(), 'Variadic alone (placeholder excluded) counts normally');
    }

    public function testVersionWindowParamCountedOnlyWithinRange(): void
    {
        // Param available from=7.0, removedVersion=7.2 (exclusive boundary, meaning last included = 7.1):
        //   PHP 7.0 → included (stub=2, refl=2 → ok)
        //   PHP 7.1 → included (stub=2, refl=2 → ok)
        //   PHP 7.2 → excluded (stub=1, refl=1 → ok)
        $id = '\\range_func';
        $stubParam = $this->makeParam('b', sinceVersion: '7.0', removedVersion: '7.2');  // removedVersion='7.2': excluded from 7.2+

        foreach (['7.0', '7.1', '7.2'] as $version) {
            $expected = $version === '7.2' ? 1 : 2;

            $provider = $this->createMockReflectionProvider([
                $this->makeFunction($id, array_fill(0, $expected, $this->makeParam('_'))),
            ]);
            $stubs = $this->createMockStorageManager();
            $stubs->method('getFunctions')->willReturn([
                $this->makeFunction($id, [$this->makeParam('a'), $stubParam]),
            ]);

            $result = (new FunctionParametersCountCheck($provider))->run($stubs, $id, $version);
            $this->assertFalse($result->hasFailures(), "PHP {$version} should match (expected {$expected} params)");
        }
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
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        // Mismatch: refl has 2 params, stubs has 1 — would normally fail
        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('a'), $this->makeParam('b')]),
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [$this->makeParam('a')]),
        ]);

        $result = (new FunctionParametersCountCheck($provider, $registry))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('Test skip reason', $successes[0]);
    }
}
