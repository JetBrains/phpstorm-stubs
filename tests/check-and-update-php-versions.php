#!/usr/bin/env php
<?php

/**
 * Detect new PHP *patch* releases for the PHP versions this project already tracks
 * (PhpVersions enum, currently 5.6 - 8.5) and decide whether the reflection caches need
 * to be regenerated.
 *
 * It does NOT add new minor versions (e.g. 8.6) — adding a new minor line requires a
 * hand-authored Dockerfile and is a deliberate, reviewed change. This script only watches the
 * lines we already build, so that a new patch (e.g. 8.5.0 -> 8.5.1) triggers a cache refresh.
 *
 * How "the patch we last built from" is known: the reflection cache JSON does not record it, so
 * this script keeps a small manifest at tests/cache/php-versions.json mapping each tracked minor
 * to the patch version its cache was last generated from. On each run it:
 *   1. reads the tracked minors from tests/Framework/Runner/PhpVersions.php,
 *   2. looks up the latest available `php:<minor>.<patch>-alpine` image on Docker Hub
 *      (we build from those images, so a patch is only actionable once its image exists),
 *   3. compares that to the manifest, and
 *   4. rewrites the manifest with the newest patches.
 *
 * When at least one tracked line has a newer patch than recorded, the script reports the affected
 * versions (so the caller can regenerate just those caches) via $GITHUB_OUTPUT:
 *   updated_versions=8.4,8.5
 *   has_changes=true
 *
 * First run (no manifest yet) establishes the baseline and reports has_changes=false.
 * Network failures are non-fatal: affected minors keep their recorded patch and exit code stays 0.
 *
 * Usage:
 *   php tests/check-and-update-php-versions.php
 */

const DOCKER_TAGS_ENDPOINT = 'https://hub.docker.com/v2/repositories/library/php/tags';
const MAX_TAG_PAGES_PER_MINOR = 3;

$root = dirname(__DIR__);
$enumFile = $root . '/tests/Framework/Runner/PhpVersions.php';
$manifestFile = $root . '/tests/cache/php-versions.json';

if (!is_file($enumFile)) {
    fwrite(STDERR, "PhpVersions enum not found at $enumFile\n");
    exit(1);
}

// --- Versions we currently track -----------------------------------------------------------------
$enumSource = file_get_contents($enumFile);
if (!preg_match_all("/case\s+PHP_\d+_\d+\s*=\s*'(\d+\.\d+)'\s*;/", $enumSource, $m)) {
    fwrite(STDERR, "Could not parse any PHP versions from the enum\n");
    exit(1);
}
$tracked = $m[1];
usort($tracked, 'version_compare');
echo 'Tracked PHP versions: ' . implode(', ', $tracked) . "\n";

// --- Previously recorded patches -----------------------------------------------------------------
$manifest = [];
if (is_file($manifestFile)) {
    $decoded = json_decode((string) file_get_contents($manifestFile), true);
    if (is_array($decoded)) {
        $manifest = $decoded;
    }
}
$isBaseline = empty($manifest);
if ($isBaseline) {
    echo "No manifest found at tests/cache/php-versions.json — establishing baseline.\n";
}

// --- Compare each tracked line's recorded patch with the latest available image ------------------
$newManifest = $manifest;
$updated = [];
foreach ($tracked as $minor) {
    $latest = fetchLatestPatch($minor);
    if ($latest === null) {
        // Could not determine (EOL line with no alpine image, or a transient network error).
        // Keep whatever we already recorded and move on.
        echo sprintf("  %-4s : no `<minor>.<patch>-alpine` image found, skipping\n", $minor);
        continue;
    }

    $previous = $manifest[$minor] ?? null;
    $newManifest[$minor] = $latest;

    if ($previous === null) {
        echo sprintf("  %-4s : %s (baseline)\n", $minor, $latest);
        continue;
    }
    if (version_compare($latest, $previous, '>')) {
        echo sprintf("  %-4s : %s -> %s (UPDATE)\n", $minor, $previous, $latest);
        $updated[] = $minor;
    } else {
        echo sprintf("  %-4s : %s (up to date)\n", $minor, $previous);
    }
}

// --- Persist the manifest if it changed ----------------------------------------------------------
ksortByVersion($newManifest);
if ($newManifest !== $manifest) {
    file_put_contents(
        $manifestFile,
        json_encode($newManifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n"
    );
    echo "Updated tests/cache/php-versions.json\n";
}

$hasUpdates = !empty($updated);
if ($hasUpdates) {
    echo 'PHP patch update(s) detected for: ' . implode(', ', $updated) . "\n";
    echo "Reflection caches for these versions should be regenerated.\n";
} elseif ($isBaseline) {
    echo "Baseline recorded. No reflection cache regeneration needed.\n";
} else {
    echo "All tracked PHP versions are up to date. Nothing to regenerate.\n";
}

writeOutputs($updated, $hasUpdates);
exit(0);

// =================================================================================================

/**
 * Find the highest `<minor>.<patch>-alpine` tag in the official php Docker repository for the
 * given minor (e.g. "8.5" -> "8.5.1"). Returns null when none can be found.
 */
function fetchLatestPatch(string $minor): ?string
{
    $best = null;
    $url = DOCKER_TAGS_ENDPOINT
        . '?page_size=100&ordering=last_updated&name=' . rawurlencode($minor . '.');
    $pages = 0;

    while ($url !== null && $pages < MAX_TAG_PAGES_PER_MINOR) {
        $json = httpGet($url);
        if ($json === null) {
            break;
        }
        $data = json_decode($json, true);
        if (!is_array($data) || empty($data['results']) || !is_array($data['results'])) {
            break;
        }
        foreach ($data['results'] as $tag) {
            $name = $tag['name'] ?? '';
            if (preg_match('/^' . preg_quote($minor, '/') . '\.(\d+)-alpine$/', (string) $name, $mm)) {
                $candidate = $minor . '.' . $mm[1];
                if ($best === null || version_compare($candidate, $best, '>')) {
                    $best = $candidate;
                }
            }
        }
        $url = (isset($data['next']) && is_string($data['next'])) ? $data['next'] : null;
        $pages++;
    }

    return $best;
}

function httpGet(string $url): ?string
{
    $headers = "User-Agent: phpstorm-stubs-version-check\r\nAccept: application/json\r\n";
    $context = stream_context_create([
        'http' => ['method' => 'GET', 'header' => $headers, 'timeout' => 30],
        'https' => ['method' => 'GET', 'header' => $headers, 'timeout' => 30],
    ]);

    $body = @file_get_contents($url, false, $context);
    if ($body === false) {
        fwrite(STDERR, "Warning: failed to fetch $url\n");
        return null;
    }
    return $body;
}

/** Sort an associative "minor => patch" map by the minor version key, ascending. */
function ksortByVersion(array &$map): void
{
    uksort($map, 'version_compare');
}

/**
 * Expose results to the GitHub Actions step via $GITHUB_OUTPUT when available.
 *
 * @param list<string> $updatedVersions
 */
function writeOutputs(array $updatedVersions, bool $hasChanges): void
{
    $out = getenv('GITHUB_OUTPUT');
    if ($out === false || $out === '') {
        return;
    }
    @file_put_contents(
        $out,
        'updated_versions=' . implode(',', $updatedVersions) . "\n"
        . 'has_changes=' . ($hasChanges ? 'true' : 'false') . "\n",
        FILE_APPEND
    );
}
