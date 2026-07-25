<?php

namespace StubTests\Unit\Runner;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\Runner;

/**
 * Unit tests for Runner's stub-cache completeness guard.
 *
 * Uses a self-contained temporary cache directory so the test never touches the real
 * committed cache (per the unit-test isolation rule).
 */
class RunnerTest extends TestCase
{
    private const REQUIRED_FILES = [
        'StubsClasses.json',
        'StubsFunctions.json',
        'StubsInterfaces.json',
        'StubsEnums.json',
        'StubsConstants.json',
        'StubsPhpDoc.json',
    ];

    private string $cacheDir;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cacheDir = sys_get_temp_dir() . '/runner_cache_test_' . uniqid('', true);
        mkdir($this->cacheDir, 0777, true);
    }

    protected function tearDown(): void
    {
        if (is_dir($this->cacheDir)) {
            foreach (glob($this->cacheDir . '/*') ?: [] as $file) {
                @unlink($file);
            }
            @rmdir($this->cacheDir);
        }
        parent::tearDown();
    }

    public function testCompleteCacheIsRecognised(): void
    {
        $this->writeFiles(self::REQUIRED_FILES);

        $runner = new Runner(cacheDir: $this->cacheDir);

        $this->assertTrue($runner->isStubsCacheComplete());
    }

    public function testEmptyCacheDirIsIncomplete(): void
    {
        $runner = new Runner(cacheDir: $this->cacheDir);

        $this->assertFalse($runner->isStubsCacheComplete());
    }

    /**
     * The W12 regression: the five per-type files present but StubsPhpDoc.json missing must NOT
     * be treated as a usable cache — otherwise entities load with all PhpDoc metadata dropped.
     */
    public function testMissingPhpDocFileIsIncomplete(): void
    {
        $this->writeFiles(array_diff(self::REQUIRED_FILES, ['StubsPhpDoc.json']));

        $runner = new Runner(cacheDir: $this->cacheDir);

        $this->assertFalse(
            $runner->isStubsCacheComplete(),
            'A cache missing StubsPhpDoc.json must be considered incomplete.'
        );
    }

    public function testMissingAnySingleRequiredFileIsIncomplete(): void
    {
        foreach (self::REQUIRED_FILES as $missing) {
            $this->clearCacheDir();
            $this->writeFiles(array_diff(self::REQUIRED_FILES, [$missing]));

            $runner = new Runner(cacheDir: $this->cacheDir);

            $this->assertFalse(
                $runner->isStubsCacheComplete(),
                "Cache missing {$missing} must be considered incomplete."
            );
        }
    }

    /**
     * @param string[] $files
     */
    private function writeFiles(array $files): void
    {
        foreach ($files as $file) {
            file_put_contents($this->cacheDir . '/' . $file, '[]');
        }
    }

    private function clearCacheDir(): void
    {
        foreach (glob($this->cacheDir . '/*') ?: [] as $file) {
            @unlink($file);
        }
    }
}
