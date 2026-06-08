<?php

namespace StubTests\Framework\Validator\Meta;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use StubTests\Framework\Parsers\Meta\MetaFileWalkerTrait;

final class MetaInternalTagCheck
{
    use MetaFileWalkerTrait;

    /** Third-party namespaces whose override() entries should be ignored */
    private const SKIP_NAMESPACES = [
        'Psr\\Log\\',
        'GuzzleHttp\\',
        'Illuminate\\',
        'PHPUnit\\',
        'PHPUnit_',
        'Mockery',
        'Pest\\',
    ];

    /** Third-party functions whose override() entries should be ignored */
    private const SKIP_FUNCTIONS = [
        '\\mock',
        '\\spy',
        '\\namedMock',
        '\\expect',
    ];

    /**
     * Stubs that intentionally carry a @meta tag but have no active override() entry.
     *
     * The @meta tag is kept on the stub for documentation, but the matching override()
     * call is deliberately commented out in the meta file because the entity's return
     * type cannot be expressed as a simple type()/elementType() of one argument.
     */
    private const KNOWN_META_WITHOUT_OVERRIDE = [
        // array_map's return type depends on the callback's return value, not on the type
        // of any single argument, so override(\array_map(0), type(1)) would be incorrect
        // and is commented out in meta/.phpstorm.meta.php. The @meta tag is retained.
        '\\array_map',
    ];

    /**
     * @return string[] violation messages
     */
    public function check(string $rootDir): array
    {
        $metaTaggedFqns = $this->extractMetaTaggedFqns($rootDir);
        $overrideFqns = $this->extractOverrideTargets($rootDir);

        $violations = [];

        // Direction 1: @meta tag exists but no override() call
        foreach ($metaTaggedFqns as $fqn => $location) {
            if (in_array($fqn, self::KNOWN_META_WITHOUT_OVERRIDE, true)) {
                continue;
            }
            if (!isset($overrideFqns[$fqn])) {
                $violations[] = "{$location} — '{$fqn}' has @meta tag but no corresponding override() in any .phpstorm.meta.php file";
            }
        }

        // Direction 2: override() call exists but no @meta tag
        foreach ($overrideFqns as $fqn => $location) {
            if (!isset($metaTaggedFqns[$fqn])) {
                $violations[] = "{$location} — override() for '{$fqn}' exists but the stub has no @meta phpdoc tag";
            }
        }

        sort($violations);
        return $violations;
    }

    /**
     * Find all functions/methods with @meta phpdoc tag in stub files.
     *
     * @return array<string, string> FQN => source location
     */
    private function extractMetaTaggedFqns(string $rootDir): array
    {
        $result = [];
        $parser = (new ParserFactory())->createForNewestSupportedVersion();

        foreach ($this->findStubFiles($rootDir) as $file) {
            $code = file_get_contents($file);
            if ($code === false) {
                continue;
            }
            $stmts = $parser->parse($code);
            if ($stmts === null) {
                continue;
            }
            $this->walkStubStatements($stmts, '', $file, $result);
        }

        return $result;
    }

    /**
     * @param Stmt[] $stmts
     * @param array<string, string> $result
     */
    private function walkStubStatements(array $stmts, string $namespace, string $file, array &$result): void
    {
        foreach ($stmts as $stmt) {
            if ($stmt instanceof Stmt\Namespace_) {
                $ns = $stmt->name !== null ? $stmt->name->toString() : '';
                $this->walkStubStatements($stmt->stmts, $ns, $file, $result);
                continue;
            }

            if ($stmt instanceof Stmt\Function_) {
                if ($this->hasMetaTag($stmt)) {
                    $fqn = $this->buildFunctionFqn($stmt->name->toString(), $namespace);
                    $result[$fqn] = $file . ':' . $stmt->getStartLine();
                }
                continue;
            }

            if ($stmt instanceof Stmt\Class_ || $stmt instanceof Stmt\Interface_ || $stmt instanceof Stmt\Enum_) {
                $className = $stmt->name !== null ? $stmt->name->toString() : null;
                if ($className === null) {
                    continue;
                }
                $classFqn = $namespace !== '' ? $namespace . '\\' . $className : $className;

                foreach ($stmt->stmts as $member) {
                    if ($member instanceof Stmt\ClassMethod && $this->hasMetaTag($member)) {
                        $fqn = '\\' . $classFqn . '::' . $member->name->toString();
                        $result[$fqn] = $file . ':' . $member->getStartLine();
                    }
                }
            }
        }
    }

    private function hasMetaTag(Stmt\Function_|Stmt\ClassMethod $node): bool
    {
        $doc = $node->getDocComment();
        if ($doc === null) {
            return false;
        }
        // Match @meta as a standalone phpdoc tag on its own line: " * @meta"
        return (bool)preg_match('/^\s*\*\s*@meta\s*$/m', $doc->getText());
    }

    private function buildFunctionFqn(string $name, string $namespace): string
    {
        if ($namespace !== '') {
            return '\\' . $namespace . '\\' . $name;
        }
        return '\\' . $name;
    }

    /**
     * Find all override() targets in meta files, excluding third-party entries.
     *
     * @return array<string, string> FQN => source location
     */
    private function extractOverrideTargets(string $rootDir): array
    {
        $result = [];

        foreach ($this->getMetaNamespaceBlocks($rootDir) as [$file, $stmts]) {
            foreach ($stmts as $stmt) {
                if (!$stmt instanceof Stmt\Expression) {
                    continue;
                }
                $expr = $stmt->expr;
                if (!$expr instanceof FuncCall) {
                    continue;
                }
                if (!$expr->name instanceof Name) {
                    continue;
                }
                if ($expr->name->toLowerString() !== 'override') {
                    continue;
                }

                $args = $expr->getArgs();
                if (count($args) < 1) {
                    continue;
                }

                $fqn = $this->extractCallableFqn($args[0]->value);
                if ($fqn === null) {
                    continue;
                }

                if ($this->isThirdParty($fqn)) {
                    continue;
                }

                $result[$fqn] = $file . ':' . $expr->getStartLine();
            }
        }

        return $result;
    }

    private function extractCallableFqn(Node\Expr $expr): ?string
    {
        if ($expr instanceof FuncCall && $expr->name instanceof Name) {
            return '\\' . $expr->name->toString();
        }
        if ($expr instanceof StaticCall && $expr->class instanceof Name && $expr->name instanceof Node\Identifier) {
            return '\\' . $expr->class->toString() . '::' . $expr->name->toString();
        }
        return null;
    }

    private function isThirdParty(string $fqn): bool
    {
        if (in_array($fqn, self::SKIP_FUNCTIONS, true)) {
            return true;
        }

        $name = ltrim($fqn, '\\');
        foreach (self::SKIP_NAMESPACES as $prefix) {
            if (str_starts_with($name, $prefix)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string[]
     */
    private function findStubFiles(string $rootDir): array
    {
        $files = [];
        $skipDirs = ['/tests/', '/vendor/', '/meta/', '/.idea/', '/.git/', '/.claude/'];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }
            if ($file->getFilename() === '.phpstorm.meta.php') {
                continue;
            }
            $path = $file->getPathname();
            $skip = false;
            foreach ($skipDirs as $dir) {
                if (str_contains($path, $dir)) {
                    $skip = true;
                    break;
                }
            }
            if (!$skip) {
                $files[] = $path;
            }
        }
        sort($files);
        return $files;
    }
}
