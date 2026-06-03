<?php

namespace StubTests\Framework\Validator\Meta;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use StubTests\Framework\Parsers\Meta\MetaFileWalkerTrait;

final class ReferencesAreFullyQualifiedCheck
{
    use MetaFileWalkerTrait;
    private const SKIP_CONST_NAMES = ['true', 'false', 'null', 'TRUE', 'FALSE', 'NULL'];

    /** Meta-internal function names that should not be checked */
    private const META_FUNCTIONS = [
        'expectedarguments', 'expectedreturnvalues', 'registerargumentsset',
        'override', 'exitpoint', 'argumentsset', 'type', 'map',
        'elementtype', 'sql_injection_subst',
    ];

    /**
     * @return string[] violation messages
     */
    public function check(string $rootDir): array
    {
        $violations = [];
        foreach ($this->getMetaNamespaceBlocks($rootDir) as [$file, $stmts]) {
            $this->walkStatements($stmts, $file, $violations);
        }
        return $violations;
    }

    /**
     * @param Stmt[] $stmts
     * @param string[] $violations
     */
    private function walkStatements(array $stmts, string $file, array &$violations): void
    {
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

            $funcName = $expr->name->toLowerString();
            $args = $expr->getArgs();

            match ($funcName) {
                'expectedarguments' => $this->checkExpectedArguments($args, $file, $violations),
                'expectedreturnvalues' => $this->checkExpectedReturnValues($args, $file, $violations),
                'registerargumentsset' => $this->checkRegisterArgumentsSet($args, $file, $violations),
                'override' => $this->checkOverride($args, $file, $violations),
                'exitpoint' => $this->checkExitPoint($args, $file, $violations),
                default => null,
            };
        }
    }

    /**
     * @param Node\Arg[] $args
     * @param string[] $violations
     */
    private function checkExpectedArguments(array $args, string $file, array &$violations): void
    {
        if (count($args) < 2) {
            return;
        }
        $this->checkCallableRef($args[0]->value, $file, $violations);
        for ($i = 2, $count = count($args); $i < $count; $i++) {
            $this->checkValueRef($args[$i]->value, $file, $violations);
        }
    }

    /**
     * @param Node\Arg[] $args
     * @param string[] $violations
     */
    private function checkExpectedReturnValues(array $args, string $file, array &$violations): void
    {
        if (count($args) < 1) {
            return;
        }
        $this->checkCallableOrConstRef($args[0]->value, $file, $violations);
        for ($i = 1, $count = count($args); $i < $count; $i++) {
            $this->checkValueRef($args[$i]->value, $file, $violations);
        }
    }

    /**
     * @param Node\Arg[] $args
     * @param string[] $violations
     */
    private function checkRegisterArgumentsSet(array $args, string $file, array &$violations): void
    {
        for ($i = 1, $count = count($args); $i < $count; $i++) {
            $this->checkValueRef($args[$i]->value, $file, $violations);
        }
    }

    /**
     * @param Node\Arg[] $args
     * @param string[] $violations
     */
    private function checkOverride(array $args, string $file, array &$violations): void
    {
        if (count($args) < 1) {
            return;
        }
        $this->checkCallableRef($args[0]->value, $file, $violations);
    }

    /**
     * @param Node\Arg[] $args
     * @param string[] $violations
     */
    private function checkExitPoint(array $args, string $file, array &$violations): void
    {
        if (count($args) < 1) {
            return;
        }
        $inner = $args[0]->value;
        $this->checkCallableRef($inner, $file, $violations);
        if ($inner instanceof FuncCall || $inner instanceof StaticCall) {
            foreach ($inner->getArgs() as $arg) {
                $this->checkValueRef($arg->value, $file, $violations);
            }
        }
    }

    /**
     * @param string[] $violations
     */
    private function checkCallableRef(Expr $expr, string $file, array &$violations): void
    {
        if ($expr instanceof FuncCall && $expr->name instanceof Name) {
            if (!$expr->name instanceof Name\FullyQualified) {
                $name = $expr->name->toString();
                if (!in_array(strtolower($name), self::META_FUNCTIONS, true)) {
                    $line = $expr->getStartLine();
                    $violations[] = "{$file}:{$line} — function reference '{$name}' is not fully qualified (should be '\\{$name}')";
                }
            }
            return;
        }

        if ($expr instanceof StaticCall && $expr->class instanceof Name) {
            if (!$expr->class instanceof Name\FullyQualified) {
                $name = $expr->class->toString();
                $line = $expr->getStartLine();
                $violations[] = "{$file}:{$line} — class reference '{$name}' in static call is not fully qualified (should be '\\{$name}')";
            }
        }
    }

    /**
     * @param string[] $violations
     */
    private function checkCallableOrConstRef(Expr $expr, string $file, array &$violations): void
    {
        if ($expr instanceof FuncCall || $expr instanceof StaticCall) {
            $this->checkCallableRef($expr, $file, $violations);
            return;
        }
        if ($expr instanceof ConstFetch && $expr->name instanceof Name) {
            if (!$expr->name instanceof Name\FullyQualified) {
                $name = $expr->name->toString();
                if (!in_array($name, self::SKIP_CONST_NAMES, true)) {
                    $line = $expr->getStartLine();
                    $violations[] = "{$file}:{$line} — constant reference '{$name}' is not fully qualified (should be '\\{$name}')";
                }
            }
        }
    }

    /**
     * @param string[] $violations
     */
    private function checkValueRef(Expr $expr, string $file, array &$violations): void
    {
        if ($expr instanceof ClassConstFetch && $expr->class instanceof Name) {
            if (!$expr->class instanceof Name\FullyQualified) {
                $name = $expr->class->toString();
                $line = $expr->getStartLine();
                $violations[] = "{$file}:{$line} — class reference '{$name}' in constant fetch is not fully qualified (should be '\\{$name}')";
            }
            return;
        }

        if ($expr instanceof ConstFetch && $expr->name instanceof Name) {
            if (!$expr->name instanceof Name\FullyQualified) {
                $name = $expr->name->toString();
                if (!in_array($name, self::SKIP_CONST_NAMES, true)) {
                    $line = $expr->getStartLine();
                    $violations[] = "{$file}:{$line} — constant reference '{$name}' is not fully qualified (should be '\\{$name}')";
                }
            }
            return;
        }

        if ($expr instanceof BitwiseOr) {
            $this->checkValueRef($expr->left, $file, $violations);
            $this->checkValueRef($expr->right, $file, $violations);
            return;
        }

        // argumentsSet() call in value position — skip (meta-internal)
        // String/int literals — skip
    }
}
