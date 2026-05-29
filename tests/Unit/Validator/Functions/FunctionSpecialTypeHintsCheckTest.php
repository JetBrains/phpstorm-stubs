<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionSpecialTypeHintsCheck;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionSpecialTypeHintsCheckTest extends CheckTestCase
{
    private FunctionSpecialTypeHintsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new FunctionSpecialTypeHintsCheck();
    }

    // ── Helper ───────────────────────────────────────────────────────────────

    private function makeFunction(string $id, ?string $phpDocReturnType = null): PHPFunction
    {
        $fn = new PHPFunction();
        $fn->setId($id);
        $fn->setName(ltrim($id, '\\'));
        if ($phpDocReturnType !== null) {
            $fn->initStubsMetadata()->setTypeFromPhpDoc($phpDocReturnType);
        }
        return $fn;
    }

    private function runCheck(array $functions, string $entityId, string $phpVersion = '8.0'): \StubTests\Framework\Validator\Contracts\CheckResultSet
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn($functions);

        return $this->check->run($stubs, $entityId, $phpVersion);
    }

    // ── supports() ───────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Non-special function → success ───────────────────────────────────────

    public function testNonSpecialFunctionIsSuccess(): void
    {
        $fn = $this->makeFunction('\\strlen');

        $result = $this->runCheck([$fn], '\\strlen');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── \end — mixed|false group ─────────────────────────────────────────────

    public function testEndWithCorrectPhpDocIsSuccess(): void
    {
        $fn = $this->makeFunction('\\end', 'mixed|false');

        $result = $this->runCheck([$fn], '\\end');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testEndWithMissingReturnTagIsFailure(): void
    {
        // No PhpDoc type set — getTypeFromPhpDoc() returns null
        $fn = $this->makeFunction('\\end');

        $result = $this->runCheck([$fn], '\\end');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\\end', $failures);
        $this->assertStringContainsString('mixed|false', $failures['\\end']);
        $this->assertStringContainsString('@return tag is missing', $failures['\\end']);
    }

    public function testEndWithMixedOnlyIsMissingFalse(): void
    {
        $fn = $this->makeFunction('\\end', 'mixed');

        $result = $this->runCheck([$fn], '\\end');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\\end', $failures);
        $this->assertStringContainsString('false', $failures['\\end']);
    }

    // ── \array_pop — mixed|null group ────────────────────────────────────────

    public function testArrayPopWithCorrectPhpDocIsSuccess(): void
    {
        $fn = $this->makeFunction('\\array_pop', 'mixed|null');

        $result = $this->runCheck([$fn], '\\array_pop');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testArrayPopWithMixedOnlyIsMissingNull(): void
    {
        $fn = $this->makeFunction('\\array_pop', 'mixed');

        $result = $this->runCheck([$fn], '\\array_pop');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\\array_pop', $failures);
        $this->assertStringContainsString('null', $failures['\\array_pop']);
    }

    // ── Function not found in stubs → success (silently skipped) ─────────────

    public function testFunctionNotFoundInStubsIsSuccess(): void
    {
        // Empty function list — \end is not found
        $result = $this->runCheck([], '\\end');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Other mixed|false functions ──────────────────────────────────────────

    public function testPrevWithCorrectPhpDocIsSuccess(): void
    {
        $fn = $this->makeFunction('\\prev', 'mixed|false');

        $result = $this->runCheck([$fn], '\\prev');

        $this->assertFalse($result->hasFailures());
    }

    public function testNextWithMissingPhpDocIsFailure(): void
    {
        $fn = $this->makeFunction('\\next');

        $result = $this->runCheck([$fn], '\\next');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('mixed|false', $result->getFailures()['\\next']);
    }

    public function testResetWithCorrectPhpDocIsSuccess(): void
    {
        $fn = $this->makeFunction('\\reset', 'mixed|false');

        $result = $this->runCheck([$fn], '\\reset');

        $this->assertFalse($result->hasFailures());
    }

    public function testCurrentWithCorrectPhpDocIsSuccess(): void
    {
        $fn = $this->makeFunction('\\current', 'mixed|false');

        $result = $this->runCheck([$fn], '\\current');

        $this->assertFalse($result->hasFailures());
    }

    // ── \array_shift — mixed|null group ──────────────────────────────────────

    public function testArrayShiftWithCorrectPhpDocIsSuccess(): void
    {
        $fn = $this->makeFunction('\\array_shift', 'mixed|null');

        $result = $this->runCheck([$fn], '\\array_shift');

        $this->assertFalse($result->hasFailures());
    }

    public function testArrayShiftWithWrongPhpDocIsFailure(): void
    {
        $fn = $this->makeFunction('\\array_shift', 'mixed');

        $result = $this->runCheck([$fn], '\\array_shift');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('null', $result->getFailures()['\\array_shift']);
    }

    // ── PhpDoc with extra types but still containing required parts ──────────

    public function testEndWithExtraTypeStillPassesIfContainsMixedAndFalse(): void
    {
        $fn = $this->makeFunction('\\end', 'mixed|false|int');

        $result = $this->runCheck([$fn], '\\end');

        $this->assertFalse($result->hasFailures());
    }

    public function testArrayPopWithExtraTypeStillPassesIfContainsMixedAndNull(): void
    {
        $fn = $this->makeFunction('\\array_pop', 'mixed|null|string');

        $result = $this->runCheck([$fn], '\\array_pop');

        $this->assertFalse($result->hasFailures());
    }
}
