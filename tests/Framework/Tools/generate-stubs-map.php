#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace StubTests\Framework\Tools;

use Exception;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use RuntimeException;
use StubTests\Framework\DataProvider\StubFileScanner;
use function array_map;
use function count;
use function file_get_contents;
use function file_put_contents;
use function in_array;
use function is_dir;
use function ksort;
use function preg_match;
use function scandir;
use function sprintf;
use function str_replace;
use function strlen;
use function strpos;
use function strtolower;
use function substr;
use function var_export;
use const PHP_EOL;

(function (): void {
    require __DIR__ . '/../../../vendor/autoload.php';

    $mapFile = $GLOBALS['argv'][1] ?? __DIR__ . '/../../../PhpStormStubsMap.php';

    class InvalidConstantNode extends RuntimeException
    {
        public static function create(Node $node): self
        {
            return new self(sprintf(
                'Invalid constant node (first 50 characters: %s)',
                substr((new Standard())->prettyPrint([$node]), 0, 50)
            ));
        }
    }

    class InvalidFileLocation extends RuntimeException {}

    /**
     * @throws InvalidFileLocation
     */
    function assertReadableFile(string $filename): void
    {
        if (empty($filename)) {
            throw new InvalidFileLocation('Filename was empty');
        }
        if (!file_exists($filename)) {
            throw new InvalidFileLocation(sprintf('File "%s" does not exist', $filename));
        }
        if (!is_readable($filename)) {
            throw new InvalidFileLocation(sprintf('File "%s" is not readable', $filename));
        }
        if (!is_file($filename)) {
            throw new InvalidFileLocation(sprintf('"%s" is not a file', $filename));
        }
    }

    /**
     * @throws InvalidConstantNode
     */
    function assertValidDefineFunctionCall(Node\Expr\FuncCall $node): void
    {
        if (!($node->name instanceof Node\Name)) {
            throw InvalidConstantNode::create($node);
        }
        if ($node->name->toLowerString() !== 'define') {
            throw InvalidConstantNode::create($node);
        }
        if (!in_array(count($node->args), [2, 3], true)) {
            throw InvalidConstantNode::create($node);
        }
        if (!($node->args[0]->value instanceof Node\Scalar\String_)) {
            throw InvalidConstantNode::create($node);
        }
        $valueNode = $node->args[1]->value;
        if ($valueNode instanceof Node\Expr\Variable) {
            throw InvalidConstantNode::create($node);
        }
    }

    $phpStormStubsDirectory = __DIR__ . '/../../../';

    $fileVisitor = new class() extends NodeVisitorAbstract {
        /** @var string[] */
        private $classNames = [];

        /** @var string[] */
        private $functionNames = [];

        /** @var string[] */
        private $constantNames = [];

        /**
         * {@inheritdoc}
         */
        public function enterNode(Node $node): ?int
        {
            if ($node instanceof Node\Stmt\ClassLike) {
                if ($node->getDocComment() !== null && strpos($node->getDocComment()->getText(), '@internal') !== false) {
                    return NodeVisitor::DONT_TRAVERSE_CHILDREN;
                }

                $this->classNames[] = $node->namespacedName->toString();

                return NodeVisitor::DONT_TRAVERSE_CHILDREN;
            }

            if ($node instanceof Node\Stmt\Function_) {
                $this->functionNames[] = $node->namespacedName->toString();

                return NodeVisitor::DONT_TRAVERSE_CHILDREN;
            }

            if ($node instanceof Node\Const_) {
                $this->constantNames[] = $node->namespacedName->toString();

                return NodeVisitor::DONT_TRAVERSE_CHILDREN;
            }

            if ($node instanceof Node\Expr\FuncCall) {
                try {
                    assertValidDefineFunctionCall($node);
                } catch (InvalidConstantNode $e) {
                    return null;
                }

                /** @var Node\Scalar\String_ $nameNode */
                $nameNode = $node->args[0]->value;

                if (count($node->args) === 3
                    && $node->args[2]->value instanceof Node\Expr\ConstFetch
                    && $node->args[2]->value->name->toLowerString() === 'true'
                ) {
                    $this->constantNames[] = strtolower($nameNode->value);
                }

                $this->constantNames[] = $nameNode->value;

                return NodeVisitor::DONT_TRAVERSE_CHILDREN;
            }

            return null;
        }

        /**
         * @return string[]
         */
        public function getClassNames(): array
        {
            return $this->classNames;
        }

        /**
         * @return string[]
         */
        public function getFunctionNames(): array
        {
            return $this->functionNames;
        }

        /**
         * @return string[]
         */
        public function getConstantNames(): array
        {
            return $this->constantNames;
        }

        public function clear(): void
        {
            $this->classNames = [];
            $this->functionNames = [];
            $this->constantNames = [];
        }
    };

    $phpParser = (new ParserFactory())->createForNewestSupportedVersion();

    $nodeTraverser = new NodeTraverser();
    $nodeTraverser->addVisitor(new NameResolver());
    $nodeTraverser->addVisitor($fileVisitor);

    $map = ['classes' => [], 'functions' => [], 'constants' => []];
    $versionedMaps = [];
    $versionedExtensionNames = [];

    foreach (scandir($phpStormStubsDirectory) as $topEntry) {
        if ($topEntry === '.' || $topEntry === '..' || !is_dir($phpStormStubsDirectory . $topEntry)) {
            continue;
        }

        if (preg_match('/^(.+)_v(\d+)$/', $topEntry, $matches)) {
            $versionedExtensionNames[$matches[1]] = true;
        }
    }

    // $phpStormStubsDirectory ends with a separator, so top-level entries are appended directly
    // (no extra separator) to keep the relative paths in the map identical to before.
    foreach (scandir($phpStormStubsDirectory) as $topEntry) {
        if ($topEntry === '.' || $topEntry === '..') {
            continue;
        }

        $topPath = $phpStormStubsDirectory . $topEntry;

        if (!is_dir($topPath)) {
            continue;
        }

        if (in_array($topEntry, ['tests', 'meta', 'vendor'], true)) {
            continue;
        }

        $directoryMap = ['classes' => [], 'functions' => [], 'constants' => []];

        // scandir-based traversal (see StubFileScanner) — the SPL iterators truncate listings
        // over the Docker Desktop Windows bind mount, dropping whole extensions from the map.
        $phpFiles = StubFileScanner::collect(
            $topPath,
            static fn (string $path, string $name): bool => preg_match('/\.php$/', $name) === 1,
            static fn (): bool => true,
        );

        foreach ($phpFiles as $filePath) {
            assertReadableFile($filePath);

            echo sprintf('Parsing "%s"', $filePath) . PHP_EOL;

            $ast = $phpParser->parse(file_get_contents($filePath));

            $nodeTraverser->traverse($ast);

            foreach ($fileVisitor->getClassNames() as $className) {
                $directoryMap['classes'][$className] = $filePath;
            }

            foreach ($fileVisitor->getFunctionNames() as $functionName) {
                $directoryMap['functions'][$functionName] = $filePath;
            }

            foreach ($fileVisitor->getConstantNames() as $constantName) {
                $directoryMap['constants'][$constantName] = $filePath;
            }

            $fileVisitor->clear();
        }

        if (preg_match('/^(.+)_v(\d+)$/', $topEntry, $matches)) {
            $versionedMaps[$matches[1]][$matches[2]] = $directoryMap;

            continue;
        }

        foreach ($directoryMap as $symbolType => $files) {
            foreach ($files as $symbolName => $filePath) {
                $map[$symbolType][$symbolName] = $filePath;
            }
        }

        if (isset($versionedExtensionNames[$topEntry])) {
            $versionedMaps[$topEntry]['default'] = $directoryMap;
        }
    }

    $mapWithRelativeFilePaths = array_map(static function (array $files) use ($phpStormStubsDirectory): array {
        ksort($files);

        return array_map(static function (string $filePath) use ($phpStormStubsDirectory): string {
            return str_replace('\\', '/', substr($filePath, strlen($phpStormStubsDirectory)));
        }, $files);
    }, $map);

    $versionedMapsWithRelativeFilePaths = array_map(static function (array $versions) use ($phpStormStubsDirectory): array {
        ksort($versions);

        return array_map(static function (array $map) use ($phpStormStubsDirectory): array {
            return array_map(static function (array $files) use ($phpStormStubsDirectory): array {
                ksort($files);

                return array_map(static function (string $filePath) use ($phpStormStubsDirectory): string {
                    return str_replace('\\', '/', substr($filePath, strlen($phpStormStubsDirectory)));
                }, $files);
            }, $map);
        }, $versions);
    }, $versionedMaps);

    ksort($versionedMapsWithRelativeFilePaths);

    $exportedClasses = var_export($mapWithRelativeFilePaths['classes'], true);
    $exportedFunctions = var_export($mapWithRelativeFilePaths['functions'], true);
    $exportedConstants = var_export($mapWithRelativeFilePaths['constants'], true);
    $exportedExtensionVersions = var_export($versionedMapsWithRelativeFilePaths, true);

    $output = <<<"PHP"
<?php

declare(strict_types=1);

namespace JetBrains\PHPStormStub;

/**
 * This is a generated file, do not modify it directly!
 */
final class PhpStormStubsMap
{
const DIR = __DIR__;

const CLASSES = {$exportedClasses};

const FUNCTIONS = {$exportedFunctions};

const CONSTANTS = {$exportedConstants};

const EXTENSION_VERSIONS = {$exportedExtensionVersions};
}
PHP;

    $bytesWritten = @file_put_contents($mapFile, $output, LOCK_EX);

    if ($bytesWritten === false) {
        throw new Exception(sprintf('File "%s" is not writeable.', $mapFile));
    }

    exit('Done' . PHP_EOL);
})();
