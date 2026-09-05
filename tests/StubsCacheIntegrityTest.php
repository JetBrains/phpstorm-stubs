<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Runner\RunnerScope;

/**
 * Asserts the caches the validators read actually contain data.
 *
 * `Runner::isStubsCacheComplete()` only checks that the six cache files exist — not that any of
 * them holds anything. `JsonParsedDataStorage::load()` now throws on a file it cannot parse, so
 * the specific failure that motivated this test (a truncated `StubsClasses.json` decoding to
 * zero classes) can no longer pass silently. This test is the second line: it fails if a cache
 * ever loads *successfully* but comes back empty or absurdly small.
 *
 * That distinction matters because an empty cache does not make the suite red. Every check
 * iterates the entities it is given; given none, it reports success. A green `General` run is
 * therefore consistent with validating nothing at all, and only an explicit assertion on the
 * size of the loaded data can tell the two apart.
 *
 * The floors below are deliberately far under the real counts. They are a "did this load at
 * all" tripwire, not an inventory — tightening them to the current numbers would turn every
 * legitimate stub addition or removal into a failure.
 */
class StubsCacheIntegrityTest extends TestCase
{
    /**
     * Entity type => minimum plausible count. Real counts as of PHP 8.6 support are given for
     * context; the floors sit roughly an order of magnitude below them.
     *
     * @var array<string, array{0: int, 1: int}> [floor, count when written]
     */
    private const STUB_FLOORS = [
        'classes' => [500, 1416],
        'functions' => [1000, 5177],
        'interfaces' => [50, 151],
        'enums' => [5, 18],
        'constants' => [1000, 8255],
    ];

    /**
     * @return array<string, array{string, int, int}>
     */
    public static function stubEntityTypeProvider(): array
    {
        $cases = [];
        foreach (self::STUB_FLOORS as $type => [$floor, $observed]) {
            $cases[$type] = [$type, $floor, $observed];
        }

        return $cases;
    }

    #[DataProvider('stubEntityTypeProvider')]
    public function testStubsCacheHoldsAPlausibleNumberOf(string $type, int $floor, int $observed): void
    {
        $stubs = RunnerScope::get()->getStubs();

        $count = match ($type) {
            'classes' => count($stubs->getClasses()),
            'functions' => count($stubs->getFunctions()),
            'interfaces' => count($stubs->getInterfaces()),
            'enums' => count($stubs->getEnums()),
            'constants' => count($stubs->getConstants()),
        };

        self::assertGreaterThanOrEqual(
            $floor,
            $count,
            sprintf(
                "The stubs cache loaded only %d %s (expected at least %d; there were %d when this "
                . "floor was set).\nAn undersized cache does not fail any validator — the checks "
                . "simply iterate nothing and pass — so this is very likely a truncated or "
                . "partially written tests/cache/Stubs*.json.\nRegenerate with: docker compose -f "
                . "docker-compose.yml run --rm test_runner php tests/run-stubs-parser.php",
                $count,
                $type,
                $floor,
                $observed
            )
        );
    }

    /**
     * @return array<string, array{string}>
     */
    public static function phpVersionProvider(): array
    {
        $cases = [];
        foreach (PhpVersions::cases() as $version) {
            $cases[$version->value] = [$version->value];
        }

        return $cases;
    }

    /**
     * The reflection caches are the other half of every comparison. An empty one makes the
     * checks for that version vacuous in exactly the same way.
     *
     * The floors are much lower than the stub ones and that is expected, not a smell: the
     * per-version Docker images load a fraction of the extensions the stubs describe. Measured
     * across all 13 caches the minimum is PHP 5.6 with 156 classes and 1641 functions (the
     * newest, 8.6, has 313 and 2183), so the floors sit just under the smallest real cache.
     */
    #[DataProvider('phpVersionProvider')]
    public function testReflectionCacheHoldsAPlausibleNumberOfEntities(string $phpVersion): void
    {
        $reflection = RunnerScope::get()->getReflection($phpVersion);

        self::assertGreaterThanOrEqual(
            100,
            count($reflection->getClasses()),
            sprintf(
                'Reflection cache for PHP %s loaded implausibly few classes (smallest real cache '
                . 'is 5.6 with 156). Regenerate with tests/run-all-reflection-parsers.sh',
                $phpVersion
            )
        );
        self::assertGreaterThanOrEqual(
            1000,
            count($reflection->getFunctions()),
            sprintf(
                'Reflection cache for PHP %s loaded implausibly few functions (smallest real '
                . 'cache is 5.6 with 1641).',
                $phpVersion
            )
        );
    }
}
