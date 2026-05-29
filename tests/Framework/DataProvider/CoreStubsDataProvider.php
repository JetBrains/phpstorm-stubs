<?php

namespace StubTests\Framework\DataProvider;

use StubTests\Framework\DataProvider\AllStubsDataProvider;
use StubTests\Framework\DataProvider\StubCategory;
use StubTests\Framework\DataProvider\StubsDataProvider;

/**
 * Data provider that filters stub files by category (Core, Bundled, External, PECL).
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
        $this->categories    = is_array($categories) ? $categories : [$categories];
        $this->innerProvider = $innerProvider ?? new AllStubsDataProvider();
    }

    public function getAllStubFiles(): array
    {
        if ($this->cachedStubFiles !== null) {
            return $this->cachedStubFiles;
        }

        $allowedDirectories    = $this->getAllowedDirectories();
        $this->cachedStubFiles = array_values(array_filter(
            $this->innerProvider->getAllStubFiles(),
            fn(string $path) => $this->isPathAllowed($path, $allowedDirectories)
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
        $stubsRootPath = $this->getStubsRootPath();
        $relative      = ltrim(substr($absolutePath, strlen($stubsRootPath)), '/');
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
        // PECL: any directory that is not claimed by CORE, BUNDLED, or EXTERNAL
        if (in_array(StubCategory::PECL, $this->categories, true)) {
            $isPecl = true;
            foreach ([StubCategory::CORE, StubCategory::BUNDLED, StubCategory::EXTERNAL] as $category) {
                if ($category->containsDirectory($directoryName)) {
                    $isPecl = false;
                    break;
                }
            }
            if ($isPecl) {
                return true;
            }
        }

        return isset($allowedDirectories[$directoryName]);
    }
}
