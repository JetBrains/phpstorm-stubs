<?php

namespace StubTests\Framework\Validator\Meta;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt;
use StubTests\Framework\Parsers\Meta\MetaFileWalkerTrait;

final class StringLiteralsSingleQuotedCheck
{
    use MetaFileWalkerTrait;

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
            $this->walkNode($expr, $file, $violations);
        }
    }

    /**
     * @param string[] $violations
     */
    private function walkNode(Node $node, string $file, array &$violations): void
    {
        if ($node instanceof String_) {
            $kind = $node->getAttribute('kind');
            if ($kind === String_::KIND_DOUBLE_QUOTED) {
                $line = $node->getStartLine();
                $value = strlen($node->value) > 40
                    ? substr($node->value, 0, 40) . '...'
                    : $node->value;
                $violations[] = "{$file}:{$line} — double-quoted string \"{$value}\" should use single quotes";
            }
            return;
        }

        foreach ($node->getSubNodeNames() as $name) {
            $subNode = $node->$name;
            if ($subNode instanceof Node) {
                $this->walkNode($subNode, $file, $violations);
            } elseif (is_array($subNode)) {
                foreach ($subNode as $item) {
                    if ($item instanceof Node) {
                        $this->walkNode($item, $file, $violations);
                    }
                }
            }
        }
    }
}
