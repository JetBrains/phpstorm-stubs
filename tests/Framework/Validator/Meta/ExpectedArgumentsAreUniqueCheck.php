<?php

namespace StubTests\Framework\Validator\Meta;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Stmt;
use StubTests\Framework\Parsers\Meta\MetaFileWalkerTrait;

final class ExpectedArgumentsAreUniqueCheck
{
    use MetaFileWalkerTrait;

    /**
     * @return string[] violation messages
     */
    public function check(string $rootDir): array
    {
        /** @var array<string, string> $seen key => first location */
        $seen = [];
        $violations = [];

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
                if ($expr->name->toLowerString() !== 'expectedarguments') {
                    continue;
                }

                $args = $expr->getArgs();
                if (count($args) < 2) {
                    continue;
                }

                $callableFqn = $this->extractCallableFqn($args[0]->value);
                if ($callableFqn === null) {
                    continue;
                }

                $argIndex = $this->extractArgIndex($args[1]->value);
                if ($argIndex === null) {
                    continue;
                }

                $key = $callableFqn . '|' . $argIndex;
                $location = $file . ':' . $expr->getStartLine();

                if (isset($seen[$key])) {
                    $violations[] = "Duplicate expectedArguments for {$callableFqn} arg {$argIndex}: {$location} (first seen at {$seen[$key]})";
                } else {
                    $seen[$key] = $location;
                }
            }
        }

        return $violations;
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

    private function extractArgIndex(Node\Expr $expr): ?int
    {
        if ($expr instanceof Int_) {
            return $expr->value;
        }
        return null;
    }
}
