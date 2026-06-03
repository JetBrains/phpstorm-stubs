<?php

namespace StubTests\Unit\Parsers\AST\fixtures;

use StubTests\Framework\DataProvider\StubsDataProvider;

class FixtureStubsDataProvider implements StubsDataProvider
{
    public function __construct(
        private readonly string $fixturesBasePath
    ) {}

    public function getAllStubFiles(): array
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->fixturesBasePath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'txt') {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }

    public function getStubsRootPath(): string
    {
        return $this->fixturesBasePath;
    }

    public function getStubFileContent(string $path): string
    {
        // If path is already absolute, use it directly
        if (file_exists($path)) {
            return file_get_contents($path);
        }

        // Otherwise treat it as relative to fixtures base path
        $fullPath = $this->fixturesBasePath . '/' . $path;

        if (!file_exists($fullPath)) {
            throw new \RuntimeException("Fixture file not found: {$fullPath}");
        }

        return file_get_contents($fullPath);
    }
}
