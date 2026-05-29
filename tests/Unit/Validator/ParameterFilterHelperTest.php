<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Services\ParameterFilterHelper;

class ParameterFilterHelperTest extends TestCase
{
    // ── Helper ───────────────────────────────────────────────────────────────

    private function makeParam(
        string $name,
        ?string $sinceVersion = null,
        ?string $removedVersion = null,
        bool $isVariadic = false
    ): PHPParameter {
        $param = new PHPParameter($name);
        if ($sinceVersion !== null || $removedVersion !== null) {
            $param->initStubsMetadata()->setSinceVersion($sinceVersion);
            $param->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        if ($isVariadic) {
            $param->setIsVariadic(true);
        }
        return $param;
    }

    // ── Empty input ──────────────────────────────────────────────────────────

    public function testEmptyInputReturnsEmptyOutput(): void
    {
        $result = ParameterFilterHelper::filterAndDeduplicate([], PhpVersions::LATEST->value);

        $this->assertSame([], $result);
    }

    // ── Single parameter passes through unchanged ────────────────────────────

    public function testSingleParameterPassesThroughUnchanged(): void
    {
        $param = $this->makeParam('value');

        $result = ParameterFilterHelper::filterAndDeduplicate([$param], PhpVersions::LATEST->value);

        $this->assertCount(1, $result);
        $this->assertSame($param, $result[0]);
    }

    // ── Version filtering ────────────────────────────────────────────────────

    public function testFiltersOutParameterNotAvailableInGivenVersion(): void
    {
        // $param is available since 8.0, so asking for 7.4 should exclude it
        $param = $this->makeParam('value', sinceVersion: '8.0');

        $result = ParameterFilterHelper::filterAndDeduplicate([$param], '7.4');

        $this->assertCount(0, $result);
    }

    public function testKeepsParameterAvailableInGivenVersion(): void
    {
        $param = $this->makeParam('value', sinceVersion: '8.0');

        $result = ParameterFilterHelper::filterAndDeduplicate([$param], '8.0');

        $this->assertCount(1, $result);
        $this->assertSame($param, $result[0]);
    }

    public function testFiltersOutParameterRemovedBeforeGivenVersion(): void
    {
        // $param is removed in 8.0, so asking for 8.0 should exclude it
        $param = $this->makeParam('legacy', removedVersion: '8.0');

        $result = ParameterFilterHelper::filterAndDeduplicate([$param], '8.0');

        $this->assertCount(0, $result);
    }

    public function testKeepsParameterRemovedAfterGivenVersion(): void
    {
        // $param is removed in 8.1, so 8.0 is still within range
        $param = $this->makeParam('legacy', removedVersion: '8.1');

        $result = ParameterFilterHelper::filterAndDeduplicate([$param], '8.0');

        $this->assertCount(1, $result);
        $this->assertSame($param, $result[0]);
    }

    public function testKeepsParameterWithNoVersionMetadata(): void
    {
        // No sinceVersion or removedVersion — always available
        $param = $this->makeParam('evergreen');

        $result = ParameterFilterHelper::filterAndDeduplicate([$param], '5.6');

        $this->assertCount(1, $result);
        $this->assertSame($param, $result[0]);
    }

    public function testMixedVersionFilteringKeepsOnlyAvailable(): void
    {
        $oldParam   = $this->makeParam('old', removedVersion: '7.4');
        $newParam   = $this->makeParam('new', sinceVersion: '8.0');
        $alwaysParam = $this->makeParam('always');

        $result = ParameterFilterHelper::filterAndDeduplicate(
            [$oldParam, $newParam, $alwaysParam],
            '8.0'
        );

        $this->assertCount(2, $result);
        $names = array_map(fn(PHPParameter $p) => $p->getName(), $result);
        $this->assertContains('new', $names);
        $this->assertContains('always', $names);
        $this->assertNotContains('old', $names);
    }

    // ── Deduplication: consecutive same-named variadic ───────────────────────

    public function testMergesConsecutiveSameNamedParamsWhereSecondIsVariadic(): void
    {
        // Simulates stubs like: f($a[to:'7.4'], ...$a)
        $plain   = $this->makeParam('values');
        $variadic = $this->makeParam('values', isVariadic: true);

        $result = ParameterFilterHelper::filterAndDeduplicate(
            [$plain, $variadic],
            PhpVersions::LATEST->value
        );

        // Should merge into a single entry (the variadic one wins)
        $this->assertCount(1, $result);
        $this->assertTrue($result[0]->isVariadic());
        $this->assertSame('values', $result[0]->getName());
    }

    public function testDoesNotMergeNonVariadicSameNamedParams(): void
    {
        $first  = $this->makeParam('dup');
        $second = $this->makeParam('dup'); // not variadic

        $result = ParameterFilterHelper::filterAndDeduplicate(
            [$first, $second],
            PhpVersions::LATEST->value
        );

        // Both kept — no deduplication when second is not variadic
        $this->assertCount(2, $result);
    }

    public function testDoesNotMergeVariadicWhenNamesAreDifferent(): void
    {
        $first    = $this->makeParam('alpha');
        $variadic = $this->makeParam('beta', isVariadic: true);

        $result = ParameterFilterHelper::filterAndDeduplicate(
            [$first, $variadic],
            PhpVersions::LATEST->value
        );

        $this->assertCount(2, $result);
        $this->assertSame('alpha', $result[0]->getName());
        $this->assertSame('beta', $result[1]->getName());
    }

    // ── Combined filter + dedup ──────────────────────────────────────────────

    public function testFilteringAndDeduplicationWorkTogether(): void
    {
        // $a is available until 7.4, ...$a is available from 8.0 onwards
        // In PHP 8.4: $a is filtered out, only ...$a remains — no merge needed (only one survives)
        $placeholder = $this->makeParam('data', removedVersion: '7.4');
        $variadic    = $this->makeParam('data', sinceVersion: '8.0', isVariadic: true);

        $result = ParameterFilterHelper::filterAndDeduplicate(
            [$placeholder, $variadic],
            '8.4'
        );

        $this->assertCount(1, $result);
        $this->assertTrue($result[0]->isVariadic());
    }

    public function testDeduplicationAfterFilteringMergesCorrectly(): void
    {
        // Both params available at 7.0 — should merge
        $plain   = $this->makeParam('args', sinceVersion: '5.6');
        $variadic = $this->makeParam('args', sinceVersion: '5.6', isVariadic: true);

        $result = ParameterFilterHelper::filterAndDeduplicate(
            [$plain, $variadic],
            '7.0'
        );

        $this->assertCount(1, $result);
        $this->assertTrue($result[0]->isVariadic());
    }
}
