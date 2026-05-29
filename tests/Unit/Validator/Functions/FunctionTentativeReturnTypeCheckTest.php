<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionTentativeReturnTypeCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionTentativeReturnTypeCheckTest extends CheckTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    private function makeFunction(string $id, bool $tentative): PHPFunction
    {
        $fn = new PHPFunction();
        $fn->setId($id);
        $fn->setName(ltrim($id, '\\'));
        $fn->setHasTentativeReturnType($tentative);
        return $fn;
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsOnlyPhp81AndAbove(): void
    {
        $check = new FunctionTentativeReturnTypeCheck();
        $this->assertFalse($check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Function not found ────────────────────────────────────────────────────

    public function testFunctionNotFoundInReflectionIsFailure(): void
    {
        $id = '\\missing_func';

        $provider = $this->createMockReflectionProvider([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, false)]);

        $result = (new FunctionTentativeReturnTypeCheck($provider))->run($stubs, $id, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$id]);
    }

    public function testFunctionNotFoundInStubsIsSuccess(): void
    {
        $id = '\\missing_func';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = (new FunctionTentativeReturnTypeCheck($provider))->run($stubs, $id, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Matching states ───────────────────────────────────────────────────────

    public function testBothNonTentativeIsSuccess(): void
    {
        $id = '\\strlen';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, false)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, false)]);

        $result = (new FunctionTentativeReturnTypeCheck($provider))->run($stubs, $id, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothTentativeIsSuccess(): void
    {
        $id = '\\iterator_to_array';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, true)]);

        $result = (new FunctionTentativeReturnTypeCheck($provider))->run($stubs, $id, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Mismatch ──────────────────────────────────────────────────────────────

    public function testReflectionTentativeStubNotTentativeIsFailure(): void
    {
        $id = '\\iterator_to_array';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, false)]);

        $result = (new FunctionTentativeReturnTypeCheck($provider))->run($stubs, $id, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($id, $result->getFailures());
        $this->assertStringContainsString('tentative return type', $result->getFailures()[$id]);
        $this->assertStringContainsString('#[TentativeType]', $result->getFailures()[$id]);
    }

    public function testStubTentativeReflectionNotTentativeIsFailure(): void
    {
        $id = '\\some_func';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, false)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, true)]);

        $result = (new FunctionTentativeReturnTypeCheck($provider))->run($stubs, $id, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($id, $result->getFailures());
        $this->assertStringContainsString('#[TentativeType]', $result->getFailures()[$id]);
        $this->assertStringContainsString('does not have a tentative return type', $result->getFailures()[$id]);
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
                affectedChecks: [CheckType::TENTATIVE_RETURN_TYPE],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::LATEST),
                reason: 'Known tentative mismatch'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        // Would fail: reflection tentative, stub not tentative
        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, false)]);

        $result = (new FunctionTentativeReturnTypeCheck($provider, $registry))->run($stubs, $id, '8.1');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('Known tentative mismatch', $successes[0]);
    }
}
