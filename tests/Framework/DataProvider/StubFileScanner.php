<?php

namespace StubTests\Framework\DataProvider;

/**
 * Recursively finds files under a directory using scandir().
 *
 * Why not RecursiveDirectoryIterator? Over the Docker Desktop (Windows) bind mount —
 * gRPC-FUSE/virtiofs — the SPL directory iterators (RecursiveDirectoryIterator,
 * DirectoryIterator) return a TRUNCATED listing: the head of each directory stream is
 * silently dropped, so whole extension directories (Core, curl, dom, FFI, ...) vanish from
 * the scan. The affected files are never read, never parsed, and never make it into the
 * generated Stubs*.json / PhpStormStubsMap.php / meta references — with no error, because the
 * files are never even discovered. scandir() reads the whole directory in a single call and
 * is not affected, so it is the single source of truth for tree traversal in this codebase.
 */
final class StubFileScanner
{
    /**
     * Recursively collect file paths under $root.
     *
     * @param string $root Directory to scan.
     * @param callable(string $path, string $name): bool $accept  Return true to include a file.
     * @param callable(string $path, string $name): bool $descend Return true to recurse into a
     *                                                             subdirectory; use it to prune
     *                                                             directories (e.g. vendor, tests).
     * @return string[] Matching file paths in filesystem-native (unsorted) order; callers that
     *                  need determinism should sort the result.
     */
    public static function collect(string $root, callable $accept, callable $descend): array
    {
        $files = [];
        self::walk($root, $accept, $descend, $files);
        return $files;
    }

    /**
     * @param callable(string $path, string $name): bool $accept
     * @param callable(string $path, string $name): bool $descend
     * @param string[] $files
     */
    private static function walk(string $directory, callable $accept, callable $descend, array &$files): void
    {
        // Suppress the warning for an unreadable/missing directory; the false return is handled.
        $entries = @scandir($directory);
        if ($entries === false) {
            return;
        }

        foreach ($entries as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }

            $path = $directory . DIRECTORY_SEPARATOR . $entry;

            if (is_dir($path)) {
                if ($descend($path, $entry)) {
                    self::walk($path, $accept, $descend, $files);
                }
                continue;
            }

            if ($accept($path, $entry)) {
                $files[] = $path;
            }
        }
    }
}
