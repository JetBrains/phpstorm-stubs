<?php

namespace StubTests\Framework\Parsers\Meta;

use PhpParser\Node\Stmt;
use PhpParser\ParserFactory;
use StubTests\Framework\DataProvider\StubFileScanner;

trait MetaFileWalkerTrait
{
    /**
     * Yields [filePath, Stmt[]] pairs for each PHPSTORM_META namespace found in meta files.
     *
     * @return iterable<array{string, Stmt[]}>
     */
    private function getMetaNamespaceBlocks(string $rootDir): iterable
    {
        foreach ($this->findMetaFiles($rootDir) as $file) {
            $stmts = $this->parseFile($file);
            if ($stmts === null) {
                continue;
            }
            foreach ($stmts as $stmt) {
                if ($stmt instanceof Stmt\Namespace_ && $this->isPhpStormMetaNamespace($stmt)) {
                    yield [$file, $stmt->stmts];
                }
            }
        }
    }

    /**
     * @return string[]
     */
    private function findMetaFiles(string $rootDir): array
    {
        // scandir-based traversal (see StubFileScanner) — RecursiveDirectoryIterator truncates
        // listings over the Docker Desktop Windows bind mount, dropping directories such as FFI/
        // and with them the meta references they declare (\FFI::new, ...).
        $files = StubFileScanner::collect(
            $rootDir,
            fn (string $path, string $name): bool => $name === '.phpstorm.meta.php',
            // Meta files under tests/ and vendor/ are not project stubs.
            fn (string $path, string $name): bool => $name !== 'tests' && $name !== 'vendor',
        );
        sort($files);
        return $files;
    }

    /**
     * @return Stmt[]|null
     */
    private function parseFile(string $filePath): ?array
    {
        $code = file_get_contents($filePath);
        if ($code === false) {
            return null;
        }
        $parser = (new ParserFactory())->createForNewestSupportedVersion();
        return $parser->parse($code);
    }

    private function isPhpStormMetaNamespace(Stmt\Namespace_ $ns): bool
    {
        return $ns->name !== null && $ns->name->toString() === 'PHPSTORM_META';
    }
}
