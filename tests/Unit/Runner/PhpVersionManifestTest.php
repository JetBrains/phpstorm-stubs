<?php

namespace StubTests\Unit\Runner;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersionManifest;

/**
 * Pins the rule that tests/cache/php-versions.json only ever moves forward.
 *
 * check-and-update-php-versions.php used to assign the fetched patch unconditionally and *then*
 * compare, so a fetch that came back older overwrote the manifest with the older patch while
 * printing the newer one labelled "(up to date)". The next regeneration then built from a
 * different PHP patch than the committed cache came from.
 */
final class PhpVersionManifestTest extends TestCase
{
    public function testItRecordsTheFetchedPatchOnTheFirstRun(): void
    {
        self::assertSame('8.4.23', PhpVersionManifest::resolveRecordedPatch(null, '8.4.23'));
        self::assertFalse(
            PhpVersionManifest::isRegression(null, '8.4.23'),
            'A baseline run has nothing to regress against'
        );
    }

    public function testItAdvancesToANewerPatch(): void
    {
        self::assertSame('8.4.24', PhpVersionManifest::resolveRecordedPatch('8.4.23', '8.4.24'));
        self::assertFalse(PhpVersionManifest::isRegression('8.4.23', '8.4.24'));
    }

    /**
     * The case the bug produced: Docker Hub rebuilds `8.4.22-*`, its last_updated jumps above
     * `8.4.23-alpine`'s, and `8.4.23-alpine` falls out of the paged tag window — so the fetch
     * legitimately returns a patch below the recorded one.
     */
    public function testItKeepsTheRecordedPatchWhenTheFetchedOneIsOlder(): void
    {
        self::assertSame('8.4.23', PhpVersionManifest::resolveRecordedPatch('8.4.23', '8.4.22'));
        self::assertTrue(
            PhpVersionManifest::isRegression('8.4.23', '8.4.22'),
            'An older fetch must be reported as a regression, not as "up to date"'
        );
    }

    public function testItIsAStableNoOpWhenNothingChanged(): void
    {
        self::assertSame('8.4.23', PhpVersionManifest::resolveRecordedPatch('8.4.23', '8.4.23'));
        self::assertFalse(
            PhpVersionManifest::isRegression('8.4.23', '8.4.23'),
            'An unchanged patch is up to date, not a regression'
        );
    }

    /**
     * Double-digit patches are where a string comparison diverges from a version comparison, and
     * the tracked lines have long since passed patch 9.
     */
    public function testItComparesNumericallyRatherThanLexicographically(): void
    {
        // Lexicographically '8.4.10' < '8.4.9', so a string comparison would refuse this advance.
        self::assertSame('8.4.10', PhpVersionManifest::resolveRecordedPatch('8.4.9', '8.4.10'));
        self::assertFalse(PhpVersionManifest::isRegression('8.4.9', '8.4.10'));

        // ...and would accept this one as an advance.
        self::assertSame('8.4.10', PhpVersionManifest::resolveRecordedPatch('8.4.10', '8.4.9'));
        self::assertTrue(PhpVersionManifest::isRegression('8.4.10', '8.4.9'));
    }
}
