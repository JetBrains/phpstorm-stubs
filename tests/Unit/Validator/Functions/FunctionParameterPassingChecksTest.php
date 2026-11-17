<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionParameterByReferenceCheck;
use StubTests\Framework\Validator\Functions\FunctionParameterVariadicCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

/**
 * FunctionParameterByReferenceCheck and FunctionParameterVariadicCheck share their shape; the
 * comparison rules themselves are covered by ParameterPassingComparatorTest.
 */
class FunctionParameterPassingChecksTest extends CheckTestCase
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

    public function testSupportsAllPhpVersions(): void
    {
        foreach ([new FunctionParameterByReferenceCheck(), new FunctionParameterVariadicCheck()] as $check) {
            $this->assertTrue($check->supports(PhpVersions::EARLIEST->value));
            $this->assertTrue($check->supports(PhpVersions::LATEST->value));
        }
    }

    // ── By reference ──────────────────────────────────────────────────────────

    public function testByReferenceMatchIsSuccess(): void
    {
        $id = '\\sort';
        $result = $this->runByRef($id, [$this->makeParam('array', byRef: true)], [$this->makeParam('array', byRef: true)]);

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testStrayReferenceInStubsIsFailure(): void
    {
        $id = '\\sodium_crypto_xof_shake128_squeeze';
        $result = $this->runByRef(
            $id,
            [$this->makeParam('state'), $this->makeParam('length')],
            [$this->makeParam('state', byRef: true), $this->makeParam('length')],
            '8.6'
        );

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString(
            '$state (reflection: by value, stubs: by reference)',
            $result->getFailures()[$id]
        );
        $this->assertStringContainsString('PHP 8.6', $result->getFailures()[$id]);
    }

    public function testMissingReferenceInStubsIsFailure(): void
    {
        $id = '\\sort';
        $result = $this->runByRef($id, [$this->makeParam('array', byRef: true)], [$this->makeParam('array')]);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('$array (reflection: by reference, stubs: by value)', $result->getFailures()[$id]);
    }

    public function testPreferRefIsSuccessEitherWay(): void
    {
        $id = '\\array_multisort';
        $this->assertFalse($this->runByRef($id, [$this->makeParam('array', preferRef: true)], [$this->makeParam('array')])->hasFailures());
        $this->assertFalse($this->runByRef($id, [$this->makeParam('array', preferRef: true)], [$this->makeParam('array', byRef: true)])->hasFailures());
    }

    public function testByReferenceFunctionNotFoundInReflectionIsFailure(): void
    {
        $id = '\\missing_func';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id)]);

        $result = (new FunctionParameterByReferenceCheck($this->createMockReflectionProvider([]), $this->emptyRegistry()))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$id]);
    }

    public function testByReferenceFunctionNotFoundInStubsIsSuccess(): void
    {
        $id = '\\missing_func';
        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, [$this->makeParam('a', byRef: true)])]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = (new FunctionParameterByReferenceCheck($provider, $this->emptyRegistry()))->run($stubs, $id, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testByReferenceKnownProblemSkipsValidation(): void
    {
        $id = '\\special_func';
        $registry = $this->registryWith(EntityType::FUNCTION, $id, CheckType::PARAMETER_BY_REFERENCE);

        $result = $this->runByRef($id, [$this->makeParam('a', byRef: true)], [$this->makeParam('a')], '8.0', $registry);

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('Test skip reason', $result->getSuccesses()[0]);
    }

    public function testByReferenceKnownProblemForOtherCheckDoesNotSkip(): void
    {
        $id = '\\special_func';
        $registry = $this->registryWith(EntityType::FUNCTION, $id, CheckType::PARAMETER_VARIADIC);

        $result = $this->runByRef($id, [$this->makeParam('a', byRef: true)], [$this->makeParam('a')], '8.0', $registry);

        $this->assertTrue($result->hasFailures());
    }

    // ── Variadic ──────────────────────────────────────────────────────────────

    public function testVariadicMatchIsSuccess(): void
    {
        $id = '\\sprintf';
        $result = $this->runVariadic(
            $id,
            [$this->makeParam('format'), $this->makeParam('values', variadic: true)],
            [$this->makeParam('format'), $this->makeParam('values', variadic: true)]
        );

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testVariadicOnlyInStubsIsFailure(): void
    {
        $id = '\\my_func';
        $result = $this->runVariadic($id, [$this->makeParam('args')], [$this->makeParam('args', variadic: true)], '7.4');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('stubs declare variadic $args', $result->getFailures()[$id]);
        $this->assertStringContainsString('PHP 7.4', $result->getFailures()[$id]);
    }

    public function testVariadicOnlyInReflectionIsFailure(): void
    {
        $id = '\\my_func';
        $result = $this->runVariadic($id, [$this->makeParam('args', variadic: true)], [$this->makeParam('args')]);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('reflection declares variadic $args', $result->getFailures()[$id]);
    }

    public function testVariadicFunctionNotFoundInReflectionIsFailure(): void
    {
        $id = '\\missing_func';
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id)]);

        $result = (new FunctionParameterVariadicCheck($this->createMockReflectionProvider([]), $this->emptyRegistry()))->run($stubs, $id, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$id]);
    }

    public function testVariadicKnownProblemSkipsValidation(): void
    {
        $id = '\\special_func';
        $registry = $this->registryWith(EntityType::FUNCTION, $id, CheckType::PARAMETER_VARIADIC);

        $result = $this->runVariadic($id, [$this->makeParam('a')], [$this->makeParam('a', variadic: true)], '8.0', $registry);

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('Test skip reason', $result->getSuccesses()[0]);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function runByRef(string $id, array $reflParams, array $stubParams, string $version = '8.0', ?KnownProblemsRegistry $registry = null)
    {
        [$provider, $stubs] = $this->fixture($id, $reflParams, $stubParams);
        return (new FunctionParameterByReferenceCheck($provider, $registry ?? $this->emptyRegistry()))->run($stubs, $id, $version);
    }

    private function runVariadic(string $id, array $reflParams, array $stubParams, string $version = '8.0', ?KnownProblemsRegistry $registry = null)
    {
        [$provider, $stubs] = $this->fixture($id, $reflParams, $stubParams);
        return (new FunctionParameterVariadicCheck($provider, $registry ?? $this->emptyRegistry()))->run($stubs, $id, $version);
    }

    private function fixture(string $id, array $reflParams, array $stubParams): array
    {
        $provider = $this->createMockReflectionProvider([$this->makeFunction($id, $reflParams)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$this->makeFunction($id, $stubParams)]);
        return [$provider, $stubs];
    }

    /**
     * No known problems: the default registry would apply the real DefaultKnownProblemsProvider,
     * so a future entry for an id used here could make a test pass by skipping the check.
     */
    private function emptyRegistry(): KnownProblemsRegistry
    {
        $knownProblemsProvider = $this->createStub(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([]);
        KnownProblemsRegistry::reset();
        return KnownProblemsRegistry::getInstance($knownProblemsProvider);
    }

    private function registryWith(EntityType $entityType, string $id, CheckType $checkType): KnownProblemsRegistry
    {
        $knownProblemsProvider = $this->createStub(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: $entityType,
                entityId: $id,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [$checkType],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test skip reason'
            ),
        ]);
        KnownProblemsRegistry::reset();
        return KnownProblemsRegistry::getInstance($knownProblemsProvider);
    }
}
