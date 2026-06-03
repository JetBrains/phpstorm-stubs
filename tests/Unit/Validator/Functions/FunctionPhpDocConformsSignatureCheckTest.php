<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionPhpDocConformsSignatureCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionPhpDocConformsSignatureCheckTest extends CheckTestCase
{
    private FunctionPhpDocConformsSignatureCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new FunctionPhpDocConformsSignatureCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_5_6->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Function not in stubs → succeed silently ──────────────────────────────

    public function testFunctionAbsentFromStubsSucceedsSilently(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = $this->check->run($stubs, '\missingFunc', '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── No PhpDoc → skip ──────────────────────────────────────────────────────

    public function testNoPhpDocReturnTypeIsSkipped(): void
    {
        $func = $this->makeFunctionWithPhpDoc('\foo', 'array', null);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testNoSignatureReturnTypeIsSkipped(): void
    {
        $func = $this->makeFunctionWithPhpDoc('\foo', null, 'array');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Matching types pass ───────────────────────────────────────────────────

    public function testMatchingReturnTypesPasses(): void
    {
        $func = $this->makeFunctionWithPhpDoc('\foo', 'string', 'string');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Typed-array narrowing passes ──────────────────────────────────────────

    public function testTypedArrayNarrowingPasses(): void
    {
        // sig: array, doc: string[] → string[] normalises to array → compatible
        $func = $this->makeFunctionWithPhpDoc('\foo', 'array', 'string[]');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── phpstan generics pass ─────────────────────────────────────────────────

    public function testPhpStanGenericsPass(): void
    {
        // sig: array, doc: array<string, int> → stripped to array → compatible
        $func = $this->makeFunctionWithPhpDoc('\foo', 'array', 'array<string, int>');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testNonEmptyStringPass(): void
    {
        // sig: string, doc: non-empty-string → stripped to string → compatible
        $func = $this->makeFunctionWithPhpDoc('\foo', 'string', 'non-empty-string');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── bool/false split passes ───────────────────────────────────────────────

    public function testBoolFalseNarrowingPasses(): void
    {
        // sig: bool, doc: false → bool expands to {bool, false, true}; intersection with {false} → pass
        $func = $this->makeFunctionWithPhpDoc('\foo', 'bool', 'false');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testBoolTrueNarrowingPasses(): void
    {
        $func = $this->makeFunctionWithPhpDoc('\foo', 'bool', 'true');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Resource widening passes ──────────────────────────────────────────────

    public function testResourceWideningPasses(): void
    {
        // sig: GMP, doc: resource|GMP → shared component GMP → pass
        $func = $this->makeFunctionWithPhpDoc('\foo', 'GMP', 'resource|GMP');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Union reordering passes ───────────────────────────────────────────────

    public function testUnionReorderingPasses(): void
    {
        // sig: string|false, doc: false|string → normalised identically → pass
        $func = $this->makeFunctionWithPhpDoc('\foo', 'string|false', 'false|string');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\foo', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Incompatible types fail ───────────────────────────────────────────────

    public function testIncompatibleReturnTypeFails(): void
    {
        // sig: string, doc: int → no shared component → fail
        $func = $this->makeFunctionWithPhpDoc('\bar', 'string', 'int');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\bar', '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey('\bar', $result->getFailures());
        $message = $result->getFailures()['\bar'];
        $this->assertStringContainsString("sig 'string'", $message);
        $this->assertStringContainsString("phpdoc 'int'", $message);
    }

    // ── Parameter type mismatch fails ─────────────────────────────────────────

    public function testIncompatibleParamTypeFails(): void
    {
        $param = new PHPParameter('x');
        $param->setType($this->createType('string'));
        $param->initStubsMetadata()->setTypeFromPhpDoc('int');  // incompatible

        $func = $this->makeFunctionWithPhpDoc('\myFunc', null, null, [$param]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\myFunc', '8.0');

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()['\myFunc'];
        $this->assertStringContainsString('$x', $message);
        $this->assertStringContainsString("sig 'string'", $message);
        $this->assertStringContainsString("phpdoc 'int'", $message);
    }

    public function testCompatibleParamTypePasses(): void
    {
        $param = new PHPParameter('x');
        $param->setType($this->createType('string'));
        $param->initStubsMetadata()->setTypeFromPhpDoc('string');  // compatible

        $func = $this->makeFunctionWithPhpDoc('\myFunc', null, null, [$param]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $result = $this->check->run($stubs, '\myFunc', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problem skips ───────────────────────────────────────────────────

    public function testKnownProblemSkipsFunction(): void
    {
        $functionId = '\problematic';
        $func = $this->makeFunctionWithPhpDoc($functionId, 'string', 'int');  // mismatch
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: $functionId,
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::PHPDOC_CONFORMS_SIGNATURE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test: intentional PhpDoc/sig divergence'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $result = (new FunctionPhpDocConformsSignatureCheck(null, $registry))->run($stubs, $functionId, '8.0');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn ($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('intentional PhpDoc/sig divergence', array_values($skipped)[0]);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /**
     * Create a stub PHPFunction with configurable return types and parameters.
     *
     * @param PHPParameter[] $params
     */
    private function makeFunctionWithPhpDoc(
        string $name,
        ?string $sigReturnType,
        ?string $docReturnType,
        array $params = []
    ): PHPFunction {
        $func = new PHPFunction();
        $func->setId($name);
        $func->setName($name);
        $func->setParameters($params);

        if ($sigReturnType !== null) {
            $func->setReturnTypeFromSignature($this->createType($sigReturnType));
        }

        $func->initStubsMetadata()->setTypeFromPhpDoc($docReturnType);

        return $func;
    }
}
