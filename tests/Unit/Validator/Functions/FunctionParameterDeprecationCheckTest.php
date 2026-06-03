<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionParameterDeprecationCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionParameterDeprecationCheckTest extends CheckTestCase
{
    private FunctionParameterDeprecationCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new FunctionParameterDeprecationCheck();
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
        $stubFn = $this->makeFunction($id);

        $provider = $this->createMockReflectionProvider([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFn]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$id]);
    }

    public function testFunctionNotFoundInStubsIsSuccess(): void
    {
        $id = '\\missing_func';
        $reflFn = $this->makeFunction($id, [$this->makeParam('p', deprecated: true)]);

        $provider = $this->createMockReflectionProvider([$reflFn]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Matching states ───────────────────────────────────────────────────────

    public function testBothParamsNotDeprecatedIsSuccess(): void
    {
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('value')])
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [$this->makeParam('value')])
        ]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothParamsDeprecatedIsSuccess(): void
    {
        $id = '\\define';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('case_insensitive', deprecated: true)])
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [$this->makeParam('case_insensitive', deprecated: true)])
        ]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Mismatch ──────────────────────────────────────────────────────────────

    public function testDeprecatedInReflectionButNotInStubsIsFailure(): void
    {
        $id = '\\define';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [
                $this->makeParam('constant_name'),
                $this->makeParam('value'),
                $this->makeParam('case_insensitive', deprecated: true),
            ])
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('constant_name'),
                $this->makeParam('value'),
                $this->makeParam('case_insensitive'),
            ])
        ]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($id, $result->getFailures());
        $this->assertStringContainsString('$case_insensitive', $result->getFailures()[$id]);
        $this->assertStringContainsString('deprecated in PHP 8.0', $result->getFailures()[$id]);
    }

    public function testDeprecatedInStubsButNotInReflectionIsSuccess(): void
    {
        // One-way check: stubs can be more conservative
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('p')])
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [$this->makeParam('p', deprecated: true)])
        ]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMultipleParamsMismatchReportsAll(): void
    {
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [
                $this->makeParam('a', deprecated: true),
                $this->makeParam('b'),
                $this->makeParam('c', deprecated: true),
            ])
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('a'),
                $this->makeParam('b'),
                $this->makeParam('c'),
            ])
        ]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('$a', $result->getFailures()[$id]);
        $this->assertStringContainsString('$c', $result->getFailures()[$id]);
        $this->assertStringNotContainsString('$b', $result->getFailures()[$id]);
    }

    public function testParamMissingFromStubsIsNotReported(): void
    {
        $id = '\\my_func';

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [
                $this->makeParam('kept'),
                $this->makeParam('removed', deprecated: true),
            ])
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [
                $this->makeParam('kept'),
            ])
        ]);

        $result = (new FunctionParameterDeprecationCheck($provider))->run($stubs, $id, '8.0');

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
                affectedChecks: [CheckType::PARAMETER_DEPRECATION],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([
            $this->makeFunction($id, [$this->makeParam('p', deprecated: true)])
        ]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([
            $this->makeFunction($id, [$this->makeParam('p')])
        ]);

        $result = (new FunctionParameterDeprecationCheck($provider, $registry))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('Test skip reason', $successes[0]);
    }
}
