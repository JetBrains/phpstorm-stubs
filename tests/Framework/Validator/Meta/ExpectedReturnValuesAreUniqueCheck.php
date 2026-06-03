<?php

namespace StubTests\Framework\Validator\Meta;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use StubTests\Framework\Parsers\Meta\MetaFileWalkerTrait;

final class ExpectedReturnValuesAreUniqueCheck
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
                if ($expr->name->toLowerString() !== 'expectedreturnvalues') {
                    continue;
                }

                $args = $expr->getArgs();
                if (count($args) < 1) {
                    continue;
                }

                $key = $this->extractSubjectFqn($args[0]->value);
                if ($key === null) {
                    continue;
                }

                $location = $file . ':' . $expr->getStartLine();

                if (isset($seen[$key])) {
                    $violations[] = "Duplicate expectedReturnValues for {$key}: {$location} (first seen at {$seen[$key]})";
                } else {
                    $seen[$key] = $location;
                }
            }
        }

        return $violations;
    }

    private function extractSubjectFqn(Expr $expr): ?string
    {
        if ($expr instanceof FuncCall && $expr->name instanceof Name) {
            return '\\' . $expr->name->toString();
        }
        if ($expr instanceof StaticCall && $expr->class instanceof Name && $expr->name instanceof Node\Identifier) {
            return '\\' . $expr->class->toString() . '::' . $expr->name->toString();
        }
        if ($expr instanceof ConstFetch && $expr->name instanceof Name) {
            return '\\' . $expr->name->toString();
        }
        return null;
    }
}
