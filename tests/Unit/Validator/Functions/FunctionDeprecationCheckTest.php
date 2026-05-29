<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionDeprecationCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionDeprecationCheckTest extends CheckTestCase
{
    private FunctionDeprecationCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new FunctionDeprecationCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    /**
     * Build a real PHPFunction with the given id and deprecation flag.
     */
    private function makeFunction(string $id, bool $deprecated = false): PHPFunction
    {
        $fn = new PHPFunction();
        $fn->setId($id);
        $fn->setName(ltrim($id, '\\'));
        $fn->setDeprecated($deprecated);
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
        $id      = '\\missing_func';
        $stubFn  = $this->makeFunction($id);

        $provider = $this->createMockReflectionProvider([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFn]);

        $result = (new FunctionDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$id]);
    }

    public function testFunctionNotFoundInStubsIsFailure(): void
    {
        $id     = '\\missing_func';
        $reflFn = $this->makeFunction($id);

        $provider = $this->createMockReflectionProvider([$reflFn]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = (new FunctionDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$id]);
    }

    // ── Matching states ───────────────────────────────────────────────────────

    public function testBothNotDeprecatedIsSuccess(): void
    {
        $id = '\\active_func';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, false)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, false)]);

        $result = (new FunctionDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testBothDeprecatedIsSuccess(): void
    {
        $id = '\\old_func';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, true)]);

        $result = (new FunctionDeprecationCheck($provider))->run($stubs, $id, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Mismatch ──────────────────────────────────────────────────────────────

    public function testDeprecatedInReflectionButNotInStubsIsFailure(): void
    {
        $id = '\\strftime';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, false)]);

        $result = (new FunctionDeprecationCheck($provider))->run($stubs, $id, '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($id, $result->getFailures());
        $this->assertStringContainsString('deprecated in PHP 8.1', $result->getFailures()[$id]);
        $this->assertStringContainsString('not marked as deprecated in stubs', $result->getFailures()[$id]);
    }

    public function testDeprecatedInStubsButNotInReflectionIsSuccess(): void
    {
        // One-way check: stubs can be more conservative
        $id = '\\legacy_func';

        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, false)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, true)]);

        $result = (new FunctionDeprecationCheck($provider))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
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
                affectedChecks: [CheckType::DEPRECATION],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test skip reason'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        // Mismatch: deprecated in reflection but not in stubs — would normally fail
        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, false)]);

        $result = (new FunctionDeprecationCheck($provider, $registry))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('Test skip reason', $successes[0]);
    }
}
