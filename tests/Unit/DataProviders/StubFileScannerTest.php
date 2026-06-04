<?php

namespace StubTests\Unit\DataProviders;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\DataProvider\StubFileScanner;

class StubFileScannerTest extends TestCase
{
    private string $root;

    protected function setUp(): void
    {
        // A small tree exercising nested discovery and directory pruning.
        $this->root = sys_get_temp_dir() . '/stub-file-scanner-' . uniqid();
        $layout = [
            'ext1/a.php' => "<?php\n",
            'ext1/notes.txt' => 'text',
            'ext2/sub/deep/b.php' => "<?php\n",   // deeply nested
            'vendor/dep/c.php' => "<?php\n",       // should be pruned
            'meta/.phpstorm.meta.php' => "<?php\n",
        ];
        foreach ($layout as $relative => $contents) {
            $full = $this->root . '/' . $relative;
            @mkdir(dirname($full), 0777, true);
            file_put_contents($full, $contents);
        }
    }

    protected function tearDown(): void
    {
        if (!is_dir($this->root)) {
            return;
        }
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->root, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($it as $entry) {
            $entry->isDir() ? @rmdir($entry->getPathname()) : @unlink($entry->getPathname());
        }
        @rmdir($this->root);
    }

    public function testItRecursivelyCollectsAcceptedFiles(): void
    {
        $found = StubFileScanner::collect(
            $this->root,
            fn (string $path, string $name): bool => str_ends_with($name, '.php'),
            fn (string $path, string $name): bool => true,
        );

        self::assertSame(
            ['ext1/a.php', 'ext2/sub/deep/b.php', 'meta/.phpstorm.meta.php', 'vendor/dep/c.php'],
            $this->relative($found)
        );
    }

    public function testDescendPredicatePrunesDirectories(): void
    {
        $found = StubFileScanner::collect(
            $this->root,
            fn (string $path, string $name): bool => str_ends_with($name, '.php'),
            // Prune vendor/ — its files must not appear even though they match accept().
            fn (string $path, string $name): bool => $name !== 'vendor',
        );

        $relative = $this->relative($found);
        self::assertContains('ext1/a.php', $relative);
        self::assertContains('ext2/sub/deep/b.php', $relative);
        self::assertNotContains('vendor/dep/c.php', $relative);
    }

    public function testAcceptPredicateFiltersByName(): void
    {
        $found = StubFileScanner::collect(
            $this->root,
            fn (string $path, string $name): bool => $name === '.phpstorm.meta.php',
            fn (string $path, string $name): bool => true,
        );

        self::assertSame(['meta/.phpstorm.meta.php'], $this->relative($found));
    }

    public function testMissingDirectoryYieldsNoFiles(): void
    {
        $found = StubFileScanner::collect(
            $this->root . '/does-not-exist',
            fn (string $path, string $name): bool => true,
            fn (string $path, string $name): bool => true,
        );

        self::assertSame([], $found);
    }

    /**
     * @param string[] $paths
     * @return string[] root-relative, forward-slash, sorted
     */
    private function relative(array $paths): array
    {
        $normalizedRoot = str_replace('\\', '/', $this->root);
        $relative = array_map(
            fn (string $p) => ltrim(str_replace($normalizedRoot, '', str_replace('\\', '/', $p)), '/'),
            $paths
        );
        sort($relative);
        return $relative;
    }
}
