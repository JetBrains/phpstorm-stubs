<?php

namespace StubTests\Framework\DataProvider;

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

        // scandir-based traversal (see StubFileScanner) — RecursiveDirectoryIterator truncates
        // listings over the Docker Desktop Windows bind mount and drops whole extensions.
        $stubFiles = StubFileScanner::collect(
            $this->stubsRootPath,
            // Accept .php stub files, excluding the generated map, IDE metadata, and anything
            // under an excluded directory (defensive — descend() already prunes those).
            fn (string $path, string $name): bool => substr($name, -4) === '.php'
                && $name !== 'PhpStormStubsMap.php'
                && $name !== '.phpstorm.meta.php'
                && !$this->shouldExclude($path),
            // Prune excluded directories (vendor, tests, .git, .idea) before descending.
            fn (string $path, string $name): bool => !in_array($name, $this->excludedPaths, true),
        );

        // Traversal order is filesystem-native, which differs across machines/filesystems.
        // Sort to make parsing deterministic so the generated Stubs*.json caches (and nested
        // "duplicates" ordering) are reproducible in VCS.
        sort($stubFiles, SORT_STRING);

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
        // If path is relative, make it absolute from stubs root. Absolute paths can be
        // POSIX ("/foo"), Windows drive ("C:\foo" or "C:/foo") or UNC ("\\\\host\\share").
        // The previous "/"-only check treated every Windows absolute path as relative and
        // produced bogus lookups like "C:\stubs/C:\stubs\dom_n.php" (file not found).
        if (!self::isAbsolutePath($path)) {
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
        // Normalize separators first: on Windows the iterator yields backslash paths, so a
        // hard-coded "/vendor/" needle never matched and vendor/tests/.git were parsed too
        // (pulling in thousands of non-stub files).
        $normalizedPath = str_replace('\\', '/', $filePath);
        $normalizedRoot = rtrim(str_replace('\\', '/', $this->stubsRootPath), '/');

        // Only the portion *below the stubs root* may trigger exclusion. Matching the absolute
        // path meant that if any ancestor directory of the checkout happened to be named
        // vendor/tests/.git/.idea, every discovered file was excluded and the whole stub set came
        // back empty — a green run that validated nothing. The realistic triggers are a clone
        // whose path contains such a segment (e.g. ~/work/tests/phpstorm-stubs) and a git
        // worktree, which is conventionally created under .git/worktrees/<name>.
        //
        // A path that is not under the root cannot be classified against it, and there is no
        // safe absolute-path fallback: falling back to matching $normalizedPath is precisely the
        // bug above. Callers only ever pass paths produced by StubFileScanner::collect() from
        // this root, and its descend() callback already prunes these directories during
        // traversal, so anything outside the root is simply not excluded here.
        if (!str_starts_with($normalizedPath, $normalizedRoot . '/')) {
            return false;
        }

        $relativePath = substr($normalizedPath, strlen($normalizedRoot));

        foreach ($this->excludedPaths as $excludedPath) {
            if (str_contains($relativePath, '/' . $excludedPath . '/')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Whether the given path is absolute on any supported platform.
     *
     * Recognizes POSIX paths ("/foo"), Windows drive-letter paths ("C:\foo", "C:/foo")
     * and Windows UNC paths ("\\\\host\\share").
     */
    private static function isAbsolutePath(string $path): bool
    {
        return str_starts_with($path, '/')
            || str_starts_with($path, '\\')
            || (bool)preg_match('#^[A-Za-z]:[\\\\/]#', $path);
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
