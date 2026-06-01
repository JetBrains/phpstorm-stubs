<?php

namespace StubTests\Framework\Parsers\Meta;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;

final class MetaFileReferenceExtractor
{
    use MetaFileWalkerTrait;
    private const SKIP_NAMESPACES = [
        'Psr\\Log\\',
        'GuzzleHttp\\',
        'Illuminate\\',
        'PHPUnit\\',
        'PHPUnit_',
        'Mockery',
        'Pest\\',
    ];
    private const SKIP_FUNCTIONS = [
        '\\mock',
        '\\spy',
        '\\namedMock',
        '\\expect',
        '\\jexit',
        '\\wp_die',
        '\\dd',
    ];

    /** Constants defined inside PHPSTORM_META namespace, not real PHP symbols */
    private const SKIP_CONSTANTS = [
        '\\ANY_ARGUMENT',
    ];

    /**
     * Extract all symbol references from .phpstorm.meta.php files under the given root.
     *
     * @return MetaReference[]
     */
    public function extractAll(string $rootDir): array
    {
        $files = $this->findMetaFiles($rootDir);
        $refs = [];
        foreach ($files as $file) {
            $refs = array_merge($refs, $this->extractFromFile($file));
        }
        return $this->deduplicate($refs);
    }

    /**
     * Extract only callable references (functions + methods) from meta files.
     *
     * @return MetaReference[]
     */
    public function extractCallableRefs(string $rootDir): array
    {
        return array_values(array_filter(
            $this->extractAll($rootDir),
            static fn (MetaReference $ref) => $ref->role === MetaReferenceRole::CALLABLE
        ));
    }

    /**
     * Extract only value references (class constants + global constants) from meta files.
     *
     * @return MetaReference[]
     */
    public function extractConstantRefs(string $rootDir): array
    {
        return array_values(array_filter(
            $this->extractAll($rootDir),
            static fn (MetaReference $ref) => $ref->role === MetaReferenceRole::VALUE
        ));
    }

    /**
     * Extract argumentsSet usage names from meta files.
     *
     * @return string[]
     */
    public function extractArgumentsSetUsages(string $rootDir): array
    {
        $files = $this->findMetaFiles($rootDir);
        $usages = [];
        $definitions = [];
        foreach ($files as $file) {
            $this->extractSetsFromFile($file, $usages, $definitions);
        }
        return array_values(array_unique($usages));
    }

    /**
     * Extract registerArgumentsSet definition names from meta files.
     *
     * @return string[]
     */
    public function extractArgumentsSetDefinitions(string $rootDir): array
    {
        $files = $this->findMetaFiles($rootDir);
        $usages = [];
        $definitions = [];
        foreach ($files as $file) {
            $this->extractSetsFromFile($file, $usages, $definitions);
        }
        return array_values(array_unique($definitions));
    }

    /**
     * Extract references from a single meta file.
     *
     * @return MetaReference[]
     */
    public function extractFromFile(string $filePath): array
    {
        $stmts = $this->parseFile($filePath);
        if ($stmts === null) {
            return [];
        }

        $refs = [];
        $setUsages = [];
        $setDefinitions = [];
        foreach ($stmts as $stmt) {
            if ($stmt instanceof Stmt\Namespace_ && $this->isPhpStormMetaNamespace($stmt)) {
                $this->walkNamespaceBody($stmt->stmts, $filePath, $refs, $setUsages, $setDefinitions);
            }
        }

        return $this->filterSkipped($refs);
    }

    /**
     * Extract set usages and definitions from a single meta file.
     *
     * @param string[] $usages
     * @param string[] $definitions
     */
    private function extractSetsFromFile(string $filePath, array &$usages, array &$definitions): void
    {
        $stmts = $this->parseFile($filePath);
        if ($stmts === null) {
            return;
        }

        $refs = [];
        foreach ($stmts as $stmt) {
            if ($stmt instanceof Stmt\Namespace_ && $this->isPhpStormMetaNamespace($stmt)) {
                $this->walkNamespaceBody($stmt->stmts, $filePath, $refs, $usages, $definitions);
            }
        }
    }

    /**
     * @param Stmt[] $stmts
     * @param MetaReference[] $refs
     * @param string[] $setUsages
     * @param string[] $setDefinitions
     */
    private function walkNamespaceBody(array $stmts, string $file, array &$refs, array &$setUsages, array &$setDefinitions): void
    {
        foreach ($stmts as $stmt) {
            if (!$stmt instanceof Stmt\Expression) {
                continue;
            }
            $expr = $stmt->expr;
            if (!$expr instanceof FuncCall) {
                continue;
            }

            $funcName = $this->getFuncCallName($expr);
            if ($funcName === null) {
                continue;
            }

            match ($funcName) {
                'expectedarguments' => $this->handleExpectedArguments($expr, $file, $refs, $setUsages),
                'expectedreturnvalues' => $this->handleExpectedReturnValues($expr, $file, $refs, $setUsages),
                'registerargumentsset' => $this->handleRegisterArgumentsSet($expr, $file, $refs, $setDefinitions),
                'override' => $this->handleOverride($expr, $file, $refs),
                'exitpoint' => $this->handleExitPoint($expr, $file, $refs, $setUsages),
                default => null,
            };
        }
    }

    private function getFuncCallName(FuncCall $call): ?string
    {
        if ($call->name instanceof Name) {
            return $call->name->toLowerString();
        }
        return null;
    }

    /**
     * expectedArguments(callable, argIndex, ...values)
     * - arg[0]: function/method reference
     * - arg[2..N]: constant values
     *
     * @param string[] $setUsages
     */
    private function handleExpectedArguments(FuncCall $call, string $file, array &$refs, array &$setUsages): void
    {
        $args = $call->getArgs();
        if (count($args) < 2) {
            return;
        }

        // Extract callable reference from arg[0]
        $this->extractCallableRef($args[0]->value, $file, $refs);

        // Extract constant values from arg[2..N]
        for ($i = 2, $count = count($args); $i < $count; $i++) {
            $this->extractValueRefs($args[$i]->value, $file, $refs, $setUsages);
        }
    }

    /**
     * expectedReturnValues(callable_or_const, ...values)
     * - arg[0]: function/method/constant reference
     * - arg[1..N]: constant values
     *
     * @param string[] $setUsages
     */
    private function handleExpectedReturnValues(FuncCall $call, string $file, array &$refs, array &$setUsages): void
    {
        $args = $call->getArgs();
        if (count($args) < 1) {
            return;
        }

        // arg[0] can be a callable OR a global constant (e.g. \PHP_OS_FAMILY)
        $this->extractCallableOrConstRef($args[0]->value, $file, $refs);

        // Extract constant values from arg[1..N]
        for ($i = 1, $count = count($args); $i < $count; $i++) {
            $this->extractValueRefs($args[$i]->value, $file, $refs, $setUsages);
        }
    }

    /**
     * registerArgumentsSet(name, ...values)
     * - arg[0]: string name (collect as definition)
     * - arg[1..N]: constant values
     *
     * @param string[] $setDefinitions
     */
    private function handleRegisterArgumentsSet(FuncCall $call, string $file, array &$refs, array &$setDefinitions): void
    {
        $args = $call->getArgs();
        if (count($args) < 1) {
            return;
        }

        // Collect set definition name from arg[0]
        $nameArg = $args[0]->value;
        if ($nameArg instanceof Node\Scalar\String_) {
            $setDefinitions[] = $nameArg->value;
        }

        // Extract constant values from arg[1..N]
        $setUsages = []; // not collected in register context
        for ($i = 1, $count = count($args); $i < $count; $i++) {
            $this->extractValueRefs($args[$i]->value, $file, $refs, $setUsages);
        }
    }

    /**
     * override(callable, metaInstruction)
     * - arg[0]: function/method reference only
     * - arg[1]: skip (map/type/elementType instruction)
     */
    private function handleOverride(FuncCall $call, string $file, array &$refs): void
    {
        $args = $call->getArgs();
        if (count($args) < 1) {
            return;
        }
        $this->extractCallableRef($args[0]->value, $file, $refs);
    }

    /**
     * exitPoint(funcCall(...args))
     * - Extract function/method ref from the nested call
     * - Extract constant values from nested args
     *
     * @param string[] $setUsages
     */
    private function handleExitPoint(FuncCall $call, string $file, array &$refs, array &$setUsages): void
    {
        $args = $call->getArgs();
        if (count($args) < 1) {
            return;
        }

        $inner = $args[0]->value;
        // The inner expression is typically a FuncCall or StaticCall
        $this->extractCallableRef($inner, $file, $refs);

        // Extract constant args from the inner call
        if ($inner instanceof FuncCall || $inner instanceof StaticCall) {
            foreach ($inner->getArgs() as $arg) {
                $this->extractValueRefs($arg->value, $file, $refs, $setUsages);
            }
        }
    }

    /**
     * Extract a callable reference (function or method) from an expression.
     */
    private function extractCallableRef(Expr $expr, string $file, array &$refs): void
    {
        $line = $expr->getStartLine();

        if ($expr instanceof FuncCall && $expr->name instanceof Name\FullyQualified) {
            $fqn = '\\' . $expr->name->toString();
            $refs[] = new MetaReference(MetaReferenceType::FUNCTION, $fqn, $file, $line, MetaReferenceRole::CALLABLE);
            return;
        }

        if ($expr instanceof StaticCall && $expr->class instanceof Name\FullyQualified) {
            $className = '\\' . $expr->class->toString();
            if ($expr->name instanceof Node\Identifier) {
                $methodName = $expr->name->toString();
                $fqn = $className . '::' . $methodName;
                $refs[] = new MetaReference(MetaReferenceType::METHOD, $fqn, $file, $line, MetaReferenceRole::CALLABLE);
            }
        }
    }

    /**
     * Extract a callable reference OR a global constant (for expectedReturnValues arg[0]).
     */
    private function extractCallableOrConstRef(Expr $expr, string $file, array &$refs): void
    {
        // Try as callable first
        if ($expr instanceof FuncCall || $expr instanceof StaticCall) {
            $this->extractCallableRef($expr, $file, $refs);
            return;
        }

        // Global constant (e.g. \PHP_OS_FAMILY) — in callable position of expectedReturnValues
        if ($expr instanceof ConstFetch && $expr->name instanceof Name) {
            $fqn = '\\' . $expr->name->toString();
            $refs[] = new MetaReference(MetaReferenceType::GLOBAL_CONST, $fqn, $file, $expr->getStartLine(), MetaReferenceRole::CALLABLE);
        }
    }

    /**
     * Recursively extract symbol references from value expressions.
     *
     * @param string[] $setUsages
     */
    private function extractValueRefs(Expr $expr, string $file, array &$refs, array &$setUsages): void
    {
        // Class constant: \ClassName::CONST_NAME or ClassName::CONST_NAME
        if ($expr instanceof ClassConstFetch && $expr->class instanceof Name) {
            $className = '\\' . $expr->class->toString();
            if ($expr->name instanceof Node\Identifier) {
                $constName = $expr->name->toString();
                // Skip ::class references
                if ($constName !== 'class') {
                    $fqn = $className . '::' . $constName;
                    $refs[] = new MetaReference(MetaReferenceType::CLASS_CONST, $fqn, $file, $expr->getStartLine(), MetaReferenceRole::VALUE);
                }
            }
            return;
        }

        // Global constant: \CONST_NAME or CONST_NAME (inside PHPSTORM_META namespace, treated as global)
        if ($expr instanceof ConstFetch && $expr->name instanceof Name) {
            $name = $expr->name->toString();
            // Skip PHP magic constants and special values
            if (in_array($name, ['true', 'false', 'null', 'TRUE', 'FALSE', 'NULL'], true)) {
                return;
            }
            $fqn = '\\' . $name;
            $refs[] = new MetaReference(MetaReferenceType::GLOBAL_CONST, $fqn, $file, $expr->getStartLine(), MetaReferenceRole::VALUE);
            return;
        }

        // BitwiseOr: recurse left and right
        if ($expr instanceof BitwiseOr) {
            $this->extractValueRefs($expr->left, $file, $refs, $setUsages);
            $this->extractValueRefs($expr->right, $file, $refs, $setUsages);
            return;
        }

        // FuncCall named argumentsSet() — collect as set usage
        if ($expr instanceof FuncCall) {
            $name = $this->getFuncCallName($expr);
            if ($name === 'argumentsset') {
                $args = $expr->getArgs();
                if (count($args) >= 1 && $args[0]->value instanceof Node\Scalar\String_) {
                    $setUsages[] = $args[0]->value->value;
                }
                return;
            }
        }

        // String/int literals, __DIR__, __FILE__, etc. — skip
    }

    /**
     * @param MetaReference[] $refs
     * @return MetaReference[]
     */
    private function filterSkipped(array $refs): array
    {
        return array_values(array_filter($refs, function (MetaReference $ref): bool {
            $fqn = $ref->fqn;

            // Skip known third-party functions
            if (in_array($fqn, self::SKIP_FUNCTIONS, true)) {
                return false;
            }

            // Skip PHPSTORM_META internal constants
            if (in_array($fqn, self::SKIP_CONSTANTS, true)) {
                return false;
            }

            // Strip leading backslash for namespace checking
            $name = ltrim($fqn, '\\');

            // Skip known third-party namespaces
            foreach (self::SKIP_NAMESPACES as $prefix) {
                if (str_starts_with($name, $prefix)) {
                    return false;
                }
            }

            return true;
        }));
    }

    /**
     * @param MetaReference[] $refs
     * @return MetaReference[]
     */
    private function deduplicate(array $refs): array
    {
        $seen = [];
        $result = [];
        foreach ($refs as $ref) {
            $key = $ref->type->value . '|' . $ref->fqn;
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $result[] = $ref;
            }
        }
        return $result;
    }
}
