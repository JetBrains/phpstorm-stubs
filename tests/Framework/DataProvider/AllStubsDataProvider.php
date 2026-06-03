<?php

namespace StubTests\Framework\DataProvider;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;

class AllStubsDataProvider implements StubsDataProvider
{
    private string $stubsRootPath;
    private array $excludedPaths = ['vendor', 'tests', '.git', '.idea'];
    private ?array $cachedStubFiles = null;

    public function __construct(?string $stubsRootPath = null)
    {
        // Default to project root (3 levels up from this file)
        $this->stubsRootPath = $stubsRootPath ?? dirname(__DIR__, 3);
    }

    /**
     * Get all PHP stub files from the stubs directory.
     * Excludes vendor, tests, and other non-stub directories.
     *
     * @return array Array of absolute file paths to stub files
     */
    public function getAllStubFiles(): array
    {
        if ($this->cachedStubFiles !== null) {
            return $this->cachedStubFiles;
        }

        $stubFiles = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $this->stubsRootPath,
                RecursiveDirectoryIterator::SKIP_DOTS
            )
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $filePath = $file->getPathname();

                // Skip excluded paths
                if ($this->shouldExclude($filePath)) {
                    continue;
                }

                // Skip PhpStormStubsMap.php as it's generated
                if (basename($filePath) === 'PhpStormStubsMap.php') {
                    continue;
                }

                // Skip .phpstorm.meta.php files as they're IDE metadata, not stubs
                if (basename($filePath) === '.phpstorm.meta.php') {
                    continue;
                }

                $stubFiles[] = $filePath;
            }
        }

        $this->cachedStubFiles = $stubFiles;
        return $stubFiles;
    }

    /**
     * Get the content of a stub file.
     *
     * @param string $path Absolute or relative path to the stub file
     * @return string The content of the file
     * @throws RuntimeException If the file cannot be read
     */
    public function getStubFileContent(string $path): string
    {
        // If path is relative, make it absolute from stubs root
        if (!str_starts_with($path, '/')) {
            $path = $this->stubsRootPath . '/' . $path;
        }

        if (!file_exists($path)) {
            throw new RuntimeException("Stub file not found: {$path}");
        }

        if (!is_readable($path)) {
            throw new RuntimeException("Stub file not readable: {$path}");
        }

        $content = file_get_contents($path);
        if ($content === false) {
            throw new RuntimeException("Failed to read stub file: {$path}");
        }

        return $content;
    }

    /**
     * Check if a file path should be excluded from stub parsing.
     *
     * @param string $filePath The file path to check
     * @return bool True if the file should be excluded
     */
    private function shouldExclude(string $filePath): bool
    {
        foreach ($this->excludedPaths as $excludedPath) {
            if (str_contains($filePath, '/' . $excludedPath . '/')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the stubs root path.
     *
     * @return string The absolute path to the stubs root directory
     */
    public function getStubsRootPath(): string
    {
        return $this->stubsRootPath;
    }
}
