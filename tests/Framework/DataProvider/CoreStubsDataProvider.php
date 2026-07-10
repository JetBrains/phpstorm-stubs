<?php

namespace StubTests\Framework\DataProvider;

/**
 * Data provider that filters stub files by category (Core, Bundled, External, PECL, Others).
 *
 * Delegates file discovery to an inner StubsDataProvider (defaults to AllStubsDataProvider)
 * and applies a category filter on the returned paths. This keeps traversal logic in one
 * place and makes the category-filtering logic independently testable via injection.
 */
class CoreStubsDataProvider implements StubsDataProvider
{
    /** @var StubCategory[] */
    private array $categories;
    private StubsDataProvider $innerProvider;
    private ?array $cachedStubFiles = null;

    /**
     * @param StubCategory|StubCategory[] $categories Single category or array of categories to include
     * @param StubsDataProvider|null $innerProvider Provider to delegate file scanning to;
     *                                              defaults to AllStubsDataProvider
     */
    public function __construct(
        StubCategory|array $categories,
        ?StubsDataProvider $innerProvider = null,
    ) {
        $this->categories = is_array($categories) ? $categories : [$categories];
        $this->innerProvider = $innerProvider ?? new AllStubsDataProvider();
    }

    public function getAllStubFiles(): array
    {
        if ($this->cachedStubFiles !== null) {
            return $this->cachedStubFiles;
        }

        $allowedDirectories = $this->getAllowedDirectories();
        $this->cachedStubFiles = array_values(array_filter(
            $this->innerProvider->getAllStubFiles(),
            fn (string $path) => $this->isPathAllowed($path, $allowedDirectories)
        ));

        return $this->cachedStubFiles;
    }

    public function getStubFileContent(string $path): string
    {
        return $this->innerProvider->getStubFileContent($path);
    }

    public function getStubsRootPath(): string
    {
        return $this->innerProvider->getStubsRootPath();
    }

    /** @return StubCategory[] */
    public function getCategories(): array
    {
        return $this->categories;
    }

    private function isPathAllowed(string $absolutePath, array $allowedDirectories): bool
    {
        // Normalize separators before deriving the top-level directory. On Windows both the
        // scanned paths and the stubs root use backslashes, so the previous "/"-based ltrim
        // and explode() left the entire relative path in $topLevelDir and matched nothing,
        // filtering out every file. Mirrors AllStubsParser::relativizePath().
        $normalizedPath = str_replace('\\', '/', $absolutePath);
        $normalizedRoot = rtrim(str_replace('\\', '/', $this->getStubsRootPath()), '/');

        $relative = ltrim(substr($normalizedPath, strlen($normalizedRoot)), '/');
        $topLevelDir = explode('/', $relative)[0];
        return $this->isDirectoryAllowed($topLevelDir, $allowedDirectories);
    }

    /** @return array<string, true> */
    private function getAllowedDirectories(): array
    {
        $directories = [];
        foreach ($this->categories as $category) {
            foreach ($category->getDirectories() as $dir) {
                $directories[$dir] = true;
            }
        }
        return $directories;
    }

    private function isDirectoryAllowed(string $directoryName, array $allowedDirectories): bool
    {
        // Every category (including PECL and OTHERS) enumerates its directories
        // explicitly, so allow-listing is a plain membership test.
        return isset($allowedDirectories[$directoryName]);
    }
}
