<?php

namespace StubTests\Framework\Parsers\Meta;

use PhpParser\Node\Stmt;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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
        $files = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->getFilename() === '.phpstorm.meta.php') {
                $path = $file->getPathname();
                if (!str_contains($path, '/tests/') && !str_contains($path, '/vendor/')) {
                    $files[] = $path;
                }
            }
        }
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
