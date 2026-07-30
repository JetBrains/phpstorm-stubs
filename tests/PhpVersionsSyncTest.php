<?php

namespace StubTests;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersions;

/**
 * Guards against drift between PhpVersions.php and everything keyed off it: the reflection
 * cache files, the pinned-patch manifest, the per-version Docker images, and the
 * EARLIEST/LATEST boundary constants.
 *
 * When a new PHP version is added to PhpVersions.php, the corresponding
 * Reflection{X.Y}.json cache file must also be generated. These tests catch
 * that omission in CI before validators silently skip the new version.
 */
class PhpVersionsSyncTest extends TestCase
{
    private string $cacheDir;

    protected function setUp(): void
    {
        $this->cacheDir = __DIR__ . '/cache';
    }

    public function testEachPhpVersionHasReflectionCacheFile(): void
    {
        foreach (PhpVersions::cases() as $version) {
            self::assertFileExists(
                $this->cacheDir . '/Reflection' . $version->value . '.json',
                "Reflection cache missing for PHP {$version->value}. " .
                "Run tests/run-all-reflection-parsers.sh to regenerate, " .
                "then commit the new cache file."
            );
        }
    }

    /**
     * EARLIEST/LATEST are hand-maintained, and ~456 CheckDescriptors are ranged against LATEST.
     * Adding a case without bumping LATEST silently yields zero test cases for the new version
     * (PhpVersionRange::includes() returns false) while every other test still passes.
     */
    public function testEarliestAndLatestPointAtTheBoundaryCases(): void
    {
        $cases = PhpVersions::cases();

        self::assertSame(
            $cases[0],
            PhpVersions::EARLIEST,
            'PhpVersions::EARLIEST must be the first enum case, otherwise every ' .
            'CheckDescriptor ranged from EARLIEST skips the versions before it.'
        );
        self::assertSame(
            $cases[count($cases) - 1],
            PhpVersions::LATEST,
            'PhpVersions::LATEST must be the last enum case, otherwise every ' .
            'CheckDescriptor ranged to LATEST silently skips the newest version.'
        );
    }

    public function testEachPhpVersionHasAPinnedPatchInTheManifest(): void
    {
        $manifestPath = $this->cacheDir . '/php-versions.json';
        self::assertFileExists($manifestPath);

        $manifest = json_decode(file_get_contents($manifestPath), true, 512, JSON_THROW_ON_ERROR);

        foreach (PhpVersions::cases() as $version) {
            self::assertArrayHasKey(
                $version->value,
                $manifest,
                "tests/cache/php-versions.json has no pinned patch for PHP {$version->value}. " .
                "run-all-reflection-parsers.sh reads it to pin the base image, so an unpinned " .
                "version regenerates its cache from a floating patch release."
            );
        }

        foreach (array_keys($manifest) as $minor) {
            self::assertNotNull(
                PhpVersions::tryFrom((string)$minor),
                "tests/cache/php-versions.json pins PHP {$minor}, which has no PhpVersions case. " .
                "Either add the case or drop the manifest entry."
            );
        }
    }

    public function testEachPhpVersionHasADockerImage(): void
    {
        foreach (PhpVersions::cases() as $version) {
            self::assertFileExists(
                __DIR__ . '/DockerImages/' . $version->value . '/Dockerfile',
                "tests/DockerImages/{$version->value}/Dockerfile is missing, so the reflection " .
                "cache for PHP {$version->value} cannot be regenerated."
            );
        }
    }

    public function testNoOrphanedReflectionCacheFiles(): void
    {
        $enumVersions = array_map(fn (PhpVersions $v) => $v->value, PhpVersions::cases());
        $cacheFiles = glob($this->cacheDir . '/Reflection*.json') ?: [];

        foreach ($cacheFiles as $file) {
            $version = substr(basename($file, '.json'), strlen('Reflection'));
            self::assertContains(
                $version,
                $enumVersions,
                "Orphaned cache file Reflection{$version}.json has no matching PhpVersions case. " .
                "Either add the case to PhpVersions.php or delete the stale cache file."
            );
        }
    }
}
