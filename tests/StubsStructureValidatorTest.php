<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\DataProvider\AllStubsDataProvider;
use StubTests\Framework\DataProvider\StubCategory;

/**
 * Validates the structural integrity of the stubs directory layout.
 *
 * Ensures every top-level stubs directory is explicitly registered in
 * StubCategory::getDirectories() so that new extension folders are never
 * silently ignored by data providers and category-based filters.
 */
class StubsStructureValidatorTest extends TestCase
{
    /**
     * Provides each top-level stubs directory as a separate test case.
     *
     * Uses the active stubs provider so local reference material is not treated as stubs.
     *
     * @return iterable<string, array{string}>
     */
    public static function stubsDirectoryProvider(): iterable
    {
        $root = dirname(__DIR__);
        $directories = [];

        foreach ((new AllStubsDataProvider($root))->getAllStubFiles() as $file) {
            $relativePath = str_replace($root . '/', '', $file);
            if (!str_contains($relativePath, '/')) {
                continue;
            }

            $directory = explode('/', $relativePath, 2)[0];
            $directories[$directory] = true;
        }

        ksort($directories);

        foreach (array_keys($directories) as $directory) {
            yield $directory => [$directory];
        }
    }

    /**
     * Assert that every top-level stubs directory is present in StubCategory::getDirectories().
     *
     * When a new extension directory is added to the stubs root it must also be registered
     * in the appropriate StubCategory (CORE, BUNDLED, EXTERNAL, or PECL) so that
     * category-based data providers include it correctly.
     *
     * @param string $directoryName Top-level directory name (basename only, no path)
     */
    #[Test]
    #[DataProvider('stubsDirectoryProvider')]
    public function checkStubsDirectoriesExistsInMap(string $directoryName): void
    {
        $allCategoryDirs = [];
        foreach (StubCategory::cases() as $category) {
            foreach ($category->getDirectories() as $dir) {
                $allCategoryDirs[] = $dir;
            }
        }

        self::assertContains(
            $directoryName,
            $allCategoryDirs,
            "Directory '$directoryName' is not listed in any StubCategory::getDirectories(). " .
            "Add it to the appropriate category (CORE, BUNDLED, EXTERNAL, or PECL) in " .
            "tests/Framework/DataProvider/StubCategory.php."
        );
    }

    /**
     * Assert that tests/Framework/Tools/generate-stubs-map.php generates a valid PhpStormStubsMap
     * to the project root when called without arguments.
     *
     * Verifies:
     * 1. The generator script exists.
     * 2. PhpStormStubsMap.php exists in the project root.
     * 3. The default output path baked into the script resolves to the project root.
     * 4. Running the script exits cleanly (exit code 0).
     * 5. The generated output has the expected PHP structure (namespace, class, array constants).
     * 6. All paths in the map are relative — no absolute filesystem paths.
     */
    #[Test]
    public function checkGenerateStubsMapScript(): void
    {
        $projectRoot = dirname(__DIR__);
        $scriptPath = $projectRoot . '/tests/Framework/Tools/generate-stubs-map.php';
        $existingMap = $projectRoot . '/PhpStormStubsMap.php';
        $tempOutput = sys_get_temp_dir() . '/phpstorm-stubs-map-' . uniqid() . '.php';

        self::assertFileExists($scriptPath, 'Generator script missing: tests/Framework/Tools/generate-stubs-map.php');
        self::assertFileExists($existingMap, 'PhpStormStubsMap.php must exist in the project root');

        // The default output path baked into the script must resolve to the project root.
        // $mapFile = __DIR__ . '/../../../PhpStormStubsMap.php' (script is 3 levels deep in tests/)
        $scriptDefaultOutput = realpath(dirname($scriptPath) . '/../../../PhpStormStubsMap.php');
        self::assertSame(
            realpath($existingMap),
            $scriptDefaultOutput,
            'The default output path inside generate-stubs-map.php must resolve to PhpStormStubsMap.php in the project root.'
        );

        exec(
            sprintf('php %s %s 2>&1', escapeshellarg($scriptPath), escapeshellarg($tempOutput)),
            $execOutput,
            $exitCode
        );

        try {
            self::assertSame(
                0,
                $exitCode,
                "Generator script exited with code $exitCode:\n" . implode("\n", $execOutput)
            );

            self::assertFileExists($tempOutput, 'Generator must create the output file');

            $generated = file_get_contents($tempOutput);

            self::assertStringContainsString("namespace JetBrains\\PHPStormStub;", $generated);
            self::assertStringContainsString('final class PhpStormStubsMap', $generated);
            self::assertStringContainsString('const CLASSES', $generated);
            self::assertStringContainsString('const FUNCTIONS', $generated);
            self::assertStringContainsString('const CONSTANTS', $generated);

            self::assertStringNotContainsString(
                $projectRoot,
                $generated,
                'PhpStormStubsMap.php must store relative paths, not absolute ones.'
            );
        } finally {
            if (file_exists($tempOutput)) {
                unlink($tempOutput);
            }
        }
    }

    /**
     * Assert that PhpStormStubsMap.php in the project root is up to date with the current stubs.
     *
     * Generates a fresh map into a temporary file using generate-stubs-map.php and compares its
     * content byte-for-byte against the committed PhpStormStubsMap.php. Any discrepancy means a
     * stub file was added, removed, or renamed without regenerating the map.
     *
     * Fix: run php tests/Framework/Tools/generate-stubs-map.php from the project root.
     */
    #[Test]
    public function checkStubMapIsUpToDate(): void
    {
        $projectRoot = dirname(__DIR__);
        $scriptPath = $projectRoot . '/tests/Framework/Tools/generate-stubs-map.php';
        $existingMap = $projectRoot . '/PhpStormStubsMap.php';
        $tempOutput = sys_get_temp_dir() . '/phpstorm-stubs-map-' . uniqid() . '.php';

        exec(
            sprintf('php %s %s 2>&1', escapeshellarg($scriptPath), escapeshellarg($tempOutput)),
            $execOutput,
            $exitCode
        );

        try {
            self::assertSame(
                0,
                $exitCode,
                "Generator script failed with exit code $exitCode:\n" . implode("\n", $execOutput)
            );

            self::assertSame(
                file_get_contents($existingMap),
                file_get_contents($tempOutput),
                'PhpStormStubsMap.php is out of date. ' .
                'Regenerate it by running: php tests/Framework/Tools/generate-stubs-map.php'
            );
        } finally {
            if (file_exists($tempOutput)) {
                unlink($tempOutput);
            }
        }
    }
}
