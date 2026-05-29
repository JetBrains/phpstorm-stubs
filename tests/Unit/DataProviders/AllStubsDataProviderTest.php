<?php

namespace StubTests\Unit\DataProviders;

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

        // Root path should be an absolute path
        self::assertStringStartsWith('/', $rootPath);

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
}
