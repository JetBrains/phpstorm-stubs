<?php

namespace StubTests\Framework\Runner;

/**
 * The single decision made when refreshing tests/cache/php-versions.json: given the patch a minor
 * line's reflection cache was last generated from and the newest patch image currently visible on
 * Docker Hub, what should the manifest record?
 *
 * Extracted from tests/check-and-update-php-versions.php so the rule can be asserted without a
 * network round trip — the script itself is procedural CI tooling with no seam for a test.
 *
 * @see \StubTests\PhpVersionsSyncTest for the enum <-> cache pairing this manifest sits alongside.
 */
final class PhpVersionManifest
{
    /**
     * The recorded patch must never move backwards. run-all-reflection-parsers.sh pins
     * `php:${PHP_PATCH}-alpine` from this manifest, so a regressed entry silently rebuilds a cache
     * from a *different* PHP patch than the committed one was generated from — surfacing as a large
     * unexplained Reflection<x.y>.json diff that reads like a legitimate refresh.
     *
     * @param string|null $recorded the patch currently in the manifest, null on the first run
     * @param string $latest the newest `<minor>.<patch>-alpine` tag found
     * @return string the patch to write back
     */
    public static function resolveRecordedPatch(?string $recorded, string $latest): string
    {
        if ($recorded === null || version_compare($latest, $recorded, '>')) {
            return $latest;
        }

        return $recorded;
    }

    /**
     * True when Docker Hub reported a patch *older* than the recorded one, which is a condition to
     * warn about rather than treat as "up to date": it routinely happens when older patch tags are
     * rebuilt (their last_updated jumps above the newest tag's, pushing that tag out of the paged
     * search window), but it can equally mean the tag search itself broke.
     */
    public static function isRegression(?string $recorded, string $latest): bool
    {
        return $recorded !== null && version_compare($latest, $recorded, '<');
    }
}
