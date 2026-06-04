<?php

namespace StubTests\Unit\DataProviders;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use StubTests\Framework\DataProvider\AllStubsDataProvider;

class AllStubsDataProviderTest extends TestCase
{
    public function testItReturnsArrayOfStubFiles()
    {
        $provider = new AllStubsDataProvider();
        self::assertIsArray($provider->getAllStubFiles());
    }

    public function testItReturnsNotEmptyArrayOfStubFiles()
    {
        $provider = new AllStubsDataProvider();
        self::assertNotEmpty($provider->getAllStubFiles());
    }

    public function testItReturnsOnlyPhpFiles()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        foreach ($stubFiles as $file) {
            self::assertStringEndsWith('.php', $file);
        }
    }

    public function testItReturnsValidFilePaths()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        self::assertGreaterThan(0, count($stubFiles));

        // Check first few files to ensure they exist
        $filesToCheck = array_slice($stubFiles, 0, min(10, count($stubFiles)));
        foreach ($filesToCheck as $file) {
            self::assertFileExists($file);
        }
    }

    public function testItExcludesVendorDirectory()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('/vendor/', $file);
        }
    }

    public function testItExcludesTestsDirectory()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('/tests/', $file);
        }
    }

    public function testItExcludesGitDirectory()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('/.git/', $file);
        }
    }

    public function testItExcludesIdeaDirectory()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('/.idea/', $file);
        }
    }

    public function testItExcludesPhpStormStubsMapFile()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('PhpStormStubsMap.php', $file);
        }
    }

    public function testItExcludesPhpStormMetaFiles()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        foreach ($stubFiles as $file) {
            self::assertStringNotContainsString('.phpstorm.meta.php', $file);
        }
    }

    public function testGetStubFileContentReturnsStringForValidFile()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        self::assertNotEmpty($stubFiles);

        // Test with first stub file found
        $firstFile = $stubFiles[0];
        $content = $provider->getStubFileContent($firstFile);

        self::assertIsString($content);
        self::assertNotEmpty($content);
    }

    public function testGetStubFileContentWorksWithRelativePath()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        self::assertNotEmpty($stubFiles);

        // Get a relative path from one of the stub files
        $firstFile = $stubFiles[0];
        $rootPath = $provider->getStubsRootPath();
        $relativePath = str_replace($rootPath . '/', '', $firstFile);

        $content = $provider->getStubFileContent($relativePath);

        self::assertIsString($content);
        self::assertNotEmpty($content);
    }

    public function testGetStubFileContentThrowsExceptionForNonExistentFile()
    {
        $provider = new AllStubsDataProvider();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Stub file not found');

        $provider->getStubFileContent('/path/to/nonexistent/file.php');
    }

    public function testGetStubFileContentThrowsExceptionForRelativeNonExistentFile()
    {
        $provider = new AllStubsDataProvider();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Stub file not found');

        $provider->getStubFileContent('nonexistent/file.php');
    }

    public function testGetStubsRootPathReturnsString()
    {
        $provider = new AllStubsDataProvider();
        $rootPath = $provider->getStubsRootPath();

        self::assertIsString($rootPath);
        self::assertNotEmpty($rootPath);
    }

    public function testConstructorWithCustomPath()
    {
        $customPath = '/tmp/custom-stubs';
        $provider = new AllStubsDataProvider($customPath);

        self::assertEquals($customPath, $provider->getStubsRootPath());
    }

    public function testConstructorWithoutPathSetsDefaultPath()
    {
        $provider = new AllStubsDataProvider();
        $rootPath = $provider->getStubsRootPath();

        // Root path should be an absolute path (POSIX "/..." or Windows "C:\...").
        $isAbsolute = new \ReflectionMethod(AllStubsDataProvider::class, 'isAbsolutePath');
        self::assertTrue($isAbsolute->invoke(null, $rootPath), "Root path '{$rootPath}' should be absolute");

        // Root path should exist
        self::assertDirectoryExists($rootPath);
    }

    public function testGetAllStubFilesReturnsAtLeastOneStubPerExtension()
    {
        $provider = new AllStubsDataProvider();
        $stubFiles = $provider->getAllStubFiles();

        // PhpStorm stubs should have many files for different PHP extensions
        self::assertGreaterThan(100, count($stubFiles));
    }

    #[DataProvider('absolutePathProvider')]
    public function testIsAbsolutePathRecognizesAbsolutePaths(string $path, bool $expected)
    {
        $method = new \ReflectionMethod(AllStubsDataProvider::class, 'isAbsolutePath');

        self::assertSame($expected, $method->invoke(null, $path));
    }

    public static function absolutePathProvider(): array
    {
        return [
            'posix root' => ['/usr/local/stubs/dom.php', true],
            'windows backslash drive' => ['C:\\stubs\\dom\\dom_n.php', true],
            'windows forward-slash drive' => ['C:/stubs/dom/dom_n.php', true],
            'lowercase drive letter' => ['d:\\projects\\stubs.php', true],
            'windows UNC path' => ['\\\\server\\share\\stubs.php', true],
            'relative forward slash' => ['dom/dom_n.php', false],
            'relative backslash' => ['dom\\dom_n.php', false],
            'bare filename' => ['dom_n.php', false],
        ];
    }

    public function testShouldExcludeNormalizesWindowsSeparators()
    {
        // On Windows the directory iterator yields backslash paths. Exclusion must still
        // match, otherwise vendor/tests/.git get parsed as if they were stubs.
        $provider = new AllStubsDataProvider();
        $method = new \ReflectionMethod(AllStubsDataProvider::class, 'shouldExclude');

        self::assertTrue($method->invoke($provider, 'C:\\proj\\vendor\\nikic\\file.php'), 'backslash /vendor/');
        self::assertTrue($method->invoke($provider, 'C:\\proj\\tests\\Foo.php'), 'backslash /tests/');
        self::assertTrue($method->invoke($provider, '/proj/vendor/nikic/file.php'), 'forward-slash /vendor/');
        self::assertFalse($method->invoke($provider, 'C:\\proj\\dom\\dom_n.php'), 'real stub must not be excluded');
        self::assertFalse($method->invoke($provider, '/proj/dom/dom_n.php'), 'real stub must not be excluded');
    }

    public function testItRecursivelyDiscoversNestedStubsAndPrunesExcludedDirectories()
    {
        // Builds a small tree to verify the scandir-based traversal: it must find files in
        // nested subdirectories and skip excluded directories / generated files. (The traversal
        // replaced RecursiveDirectoryIterator, which truncated listings over the Docker Desktop
        // Windows bind mount and silently dropped whole extensions from the generated cache.)
        $root = sys_get_temp_dir() . '/phpstorm-stubs-scan-' . uniqid();
        $layout = [
            'ext1/a.php' => "<?php\n",
            'ext2/sub/deep/b.php' => "<?php\n",   // deeply nested — must still be found
            'ext3/c.txt' => 'not php',            // non-php — must be ignored
            'vendor/nikic/d.php' => "<?php\n",    // excluded directory
            'tests/e.php' => "<?php\n",           // excluded directory
            '.git/f.php' => "<?php\n",            // excluded directory
            'PhpStormStubsMap.php' => "<?php\n",  // generated — must be skipped
            '.phpstorm.meta.php' => "<?php\n",    // IDE metadata — must be skipped
        ];
        foreach ($layout as $relative => $contents) {
            $full = $root . '/' . $relative;
            @mkdir(dirname($full), 0777, true);
            file_put_contents($full, $contents);
        }

        try {
            $found = (new AllStubsDataProvider($root))->getAllStubFiles();
            $relative = array_map(
                fn ($p) => ltrim(str_replace('\\', '/', substr($p, strlen($root))), '/'),
                $found
            );
            sort($relative);

            self::assertSame(['ext1/a.php', 'ext2/sub/deep/b.php'], $relative);
        } finally {
            // Best-effort cleanup of the temporary tree.
            $it = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );
            foreach ($it as $entry) {
                $entry->isDir() ? @rmdir($entry->getPathname()) : @unlink($entry->getPathname());
            }
            @rmdir($root);
        }
    }

    public function testGetStubFileContentDoesNotPrependRootToWindowsAbsolutePaths()
    {
        // Regression: a Windows absolute path used to be treated as relative and mangled
        // into "<root>/C:\...", producing a spurious "file not found". It must be used as-is.
        $provider = new AllStubsDataProvider('/stubs/root');
        $windowsPath = 'C:\\does\\not\\exist.php';

        try {
            $provider->getStubFileContent($windowsPath);
            self::fail('Expected RuntimeException for a non-existent file');
        } catch (RuntimeException $e) {
            self::assertStringContainsString($windowsPath, $e->getMessage());
            self::assertStringNotContainsString('/stubs/root/' . $windowsPath, $e->getMessage());
        }
    }
}
