<?php

namespace StubTests\Unit\DataProviders;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\DataProvider\CoreStubsDataProvider;
use StubTests\Framework\DataProvider\StubCategory;
use StubTests\Framework\DataProvider\StubsDataProvider;

class CoreStubsDataProviderTest extends TestCase
{
    public function testItReturnsOnlyCoreStubs()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);
        $stubFiles = $provider->getAllStubFiles();

        self::assertIsArray($stubFiles);
        self::assertNotEmpty($stubFiles);

        // Verify all files are from core directories
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);

            self::assertTrue(
                StubCategory::CORE->containsDirectory($topLevelDir),
                "File {$relativePath} is not from a CORE directory"
            );
        }
    }

    public function testItReturnsOnlyBundledStubs()
    {
        $provider = new CoreStubsDataProvider(StubCategory::BUNDLED);
        $stubFiles = $provider->getAllStubFiles();

        self::assertIsArray($stubFiles);
        self::assertNotEmpty($stubFiles);

        // Verify all files are from bundled directories
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);

            self::assertTrue(
                StubCategory::BUNDLED->containsDirectory($topLevelDir),
                "File {$relativePath} is not from a BUNDLED directory"
            );
        }
    }

    public function testItReturnsOnlyExternalStubs()
    {
        $provider = new CoreStubsDataProvider(StubCategory::EXTERNAL);
        $stubFiles = $provider->getAllStubFiles();

        self::assertIsArray($stubFiles);
        self::assertNotEmpty($stubFiles);

        // Verify all files are from external directories
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);

            self::assertTrue(
                StubCategory::EXTERNAL->containsDirectory($topLevelDir),
                "File {$relativePath} is not from an EXTERNAL directory"
            );
        }
    }

    public function testItReturnsOnlyPeclStubs()
    {
        $provider = new CoreStubsDataProvider(StubCategory::PECL);
        $stubFiles = $provider->getAllStubFiles();

        self::assertIsArray($stubFiles);
        self::assertNotEmpty($stubFiles);

        // Verify all files are from PECL directories (not in other categories)
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);

            self::assertFalse(
                StubCategory::CORE->containsDirectory($topLevelDir),
                "File {$relativePath} is from CORE, not PECL"
            );
            self::assertFalse(
                StubCategory::BUNDLED->containsDirectory($topLevelDir),
                "File {$relativePath} is from BUNDLED, not PECL"
            );
            self::assertFalse(
                StubCategory::EXTERNAL->containsDirectory($topLevelDir),
                "File {$relativePath} is from EXTERNAL, not PECL"
            );
        }
    }

    public function testItReturnsMultipleCategories()
    {
        $provider = new CoreStubsDataProvider([StubCategory::CORE, StubCategory::BUNDLED]);
        $stubFiles = $provider->getAllStubFiles();

        self::assertIsArray($stubFiles);
        self::assertNotEmpty($stubFiles);

        // Verify all files are from core or bundled directories
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);

            $isValid = StubCategory::CORE->containsDirectory($topLevelDir) ||
                       StubCategory::BUNDLED->containsDirectory($topLevelDir);

            self::assertTrue(
                $isValid,
                "File {$relativePath} is not from CORE or BUNDLED directory"
            );
        }
    }

    public function testItExcludesVendorAndTestDirectories()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);
        $stubFiles = $provider->getAllStubFiles();

        // Verify no files are from excluded directories
        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('/vendor/', $file);
            self::assertStringNotContainsString('/tests/', $file);
            self::assertStringNotContainsString('/.git/', $file);
            self::assertStringNotContainsString('/.idea/', $file);
        }
    }

    public function testItExcludesPhpStormStubsMap()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);
        $stubFiles = $provider->getAllStubFiles();

        // Verify PhpStormStubsMap.php is not included
        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('PhpStormStubsMap.php', $file);
        }
    }

    public function testItExcludesPhpStormMetaFiles()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);
        $stubFiles = $provider->getAllStubFiles();

        // Verify .phpstorm.meta.php files are not included
        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('.phpstorm.meta.php', $file);
        }
    }

    public function testItCanReadStubFileContent()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);
        $stubFiles = $provider->getAllStubFiles();

        self::assertNotEmpty($stubFiles);

        // Test reading first file
        $firstFile = $stubFiles[0];
        $content = $provider->getStubFileContent($firstFile);

        self::assertIsString($content);
        self::assertNotEmpty($content);
        self::assertStringContainsString('<?php', $content);
    }

    public function testItThrowsExceptionForNonexistentFile()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Stub file not found');

        $provider->getStubFileContent('/nonexistent/file.php');
    }

    public function testItCachesStubFilesForPerformance()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);

        $files1 = $provider->getAllStubFiles();
        $files2 = $provider->getAllStubFiles();

        // Should return the same array instance (cached)
        self::assertSame($files1, $files2);
    }

    public function testItReturnsConfiguredCategories()
    {
        $categories = [StubCategory::CORE, StubCategory::BUNDLED];
        $provider = new CoreStubsDataProvider($categories);

        $returnedCategories = $provider->getCategories();

        self::assertCount(2, $returnedCategories);
        self::assertContains(StubCategory::CORE, $returnedCategories);
        self::assertContains(StubCategory::BUNDLED, $returnedCategories);
    }

    public function testCoreAndBundledHaveMoreFilesThanCoreAlone()
    {
        $coreProvider = new CoreStubsDataProvider(StubCategory::CORE);
        $coreFiles = $coreProvider->getAllStubFiles();

        $coreAndBundledProvider = new CoreStubsDataProvider([StubCategory::CORE, StubCategory::BUNDLED]);
        $coreAndBundledFiles = $coreAndBundledProvider->getAllStubFiles();

        self::assertGreaterThan(
            count($coreFiles),
            count($coreAndBundledFiles),
            'Core + Bundled should have more files than Core alone'
        );
    }

    public function testItIncludesExpectedCoreDirectories()
    {
        $provider = new CoreStubsDataProvider(StubCategory::CORE);
        $stubFiles = $provider->getAllStubFiles();

        $foundDirectories = [];
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);
            $foundDirectories[$topLevelDir] = true;
        }

        // Check for some expected core directories
        $expectedDirs = ['Core', 'Reflection', 'SPL', 'standard'];
        foreach ($expectedDirs as $dir) {
            self::assertArrayHasKey(
                $dir,
                $foundDirectories,
                "Expected core directory '{$dir}' not found in stub files"
            );
        }
    }

    public function testItIncludesExpectedBundledDirectories()
    {
        $provider = new CoreStubsDataProvider(StubCategory::BUNDLED);
        $stubFiles = $provider->getAllStubFiles();

        $foundDirectories = [];
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);
            $foundDirectories[$topLevelDir] = true;
        }

        // Check for some expected bundled directories
        $expectedDirs = ['json', 'PDO', 'mbstring', 'curl'];
        foreach ($expectedDirs as $dir) {
            self::assertArrayHasKey(
                $dir,
                $foundDirectories,
                "Expected bundled directory '{$dir}' not found in stub files"
            );
        }
    }

    public function testItIncludesExpectedExternalDirectories()
    {
        $provider = new CoreStubsDataProvider(StubCategory::EXTERNAL);
        $stubFiles = $provider->getAllStubFiles();

        $foundDirectories = [];
        foreach ($stubFiles as $file) {
            $relativePath = $this->getRelativePath($file, $provider->getStubsRootPath());
            $topLevelDir = $this->getTopLevelDirectory($relativePath);
            $foundDirectories[$topLevelDir] = true;
        }

        // Check for some expected external directories
        $expectedDirs = ['mysqli', 'gd', 'gmp'];
        foreach ($expectedDirs as $dir) {
            self::assertArrayHasKey(
                $dir,
                $foundDirectories,
                "Expected external directory '{$dir}' not found in stub files"
            );
        }
    }

    /**
     * @return array{0: string, 1: string[]} [root, files] for a fake inner provider.
     */
    public static function separatorStyleProvider(): array
    {
        return [
            'windows backslash paths' => [
                'C:\\proj\\stubs',
                [
                    'C:\\proj\\stubs\\Core\\Core_c.php',
                    'C:\\proj\\stubs\\curl\\curl.php',
                ],
            ],
            'posix forward-slash paths' => [
                '/proj/stubs',
                [
                    '/proj/stubs/Core/Core_c.php',
                    '/proj/stubs/curl/curl.php',
                ],
            ],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('separatorStyleProvider')]
    public function testItDerivesTopLevelDirectoryRegardlessOfSeparatorStyle(string $root, array $files)
    {
        // Inject a fake inner provider so the test is independent of the host OS and the real
        // stub tree: it exercises only CoreStubsDataProvider's category filtering / path math.
        $inner = $this->fakeInnerProvider($root, $files);
        $provider = new CoreStubsDataProvider(StubCategory::CORE, $inner);

        $result = $provider->getAllStubFiles();

        // Only the "Core/..." file belongs to CORE; the "curl/..." one (BUNDLED) is filtered.
        self::assertCount(1, $result);
        self::assertStringContainsString('Core', $result[0]);
        self::assertStringNotContainsString('curl', $result[0]);
    }

    private function fakeInnerProvider(string $root, array $files): StubsDataProvider
    {
        return new class($root, $files) implements StubsDataProvider {
            public function __construct(private string $root, private array $files) {}

            public function getAllStubFiles(): array
            {
                return $this->files;
            }

            public function getStubFileContent(string $path): string
            {
                return '<?php';
            }

            public function getStubsRootPath(): string
            {
                return $this->root;
            }
        };
    }

    /**
     * Get relative path from the stubs root. Normalizes separators so the assertions hold on
     * Windows, where both the scanned path and the root use backslashes.
     */
    private function getRelativePath(string $fullPath, string $rootPath): string
    {
        $normalizedPath = str_replace('\\', '/', $fullPath);
        $normalizedRoot = rtrim(str_replace('\\', '/', $rootPath), '/');

        return ltrim(str_replace($normalizedRoot . '/', '', $normalizedPath), '/');
    }

    /**
     * Get the top-level directory from a relative path.
     */
    private function getTopLevelDirectory(string $relativePath): string
    {
        $parts = explode('/', $relativePath);
        return $parts[0];
    }
}
