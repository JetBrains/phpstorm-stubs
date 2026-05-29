<?php

namespace StubTests;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersions;

/**
 * Guards against drift between PhpVersions.php and the reflection cache directory.
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

    public function testNoOrphanedReflectionCacheFiles(): void
    {
        $enumVersions = array_map(fn(PhpVersions $v) => $v->value, PhpVersions::cases());
        $cacheFiles   = glob($this->cacheDir . '/Reflection*.json') ?: [];

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
