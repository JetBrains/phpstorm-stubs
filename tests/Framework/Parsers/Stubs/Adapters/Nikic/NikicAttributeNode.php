<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;

/**
 * Adapter for nikic/php-parser Attribute nodes.
 * Converts PHP AST attribute nodes to parser-agnostic AttributeNode interface.
 */
class NikicAttributeNode implements AttributeNode
{
    private Attribute $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public function getName(): string
    {
        return $this->attribute->name->toString();
    }

    public function getArguments(): array
    {
        $arguments = [];

        foreach ($this->attribute->args as $index => $arg) {
            /** @var Arg $arg */
            $key = $arg->name !== null ? $arg->name->toString() : $index;
            $arguments[$key] = $this->extractValue($arg->value);
        }

        return $arguments;
    }

    /**
     * Extract value from an expression node.
     * Handles arrays, strings, constant references, bitwise-or flag combinations
     * and other scalar values.
     */
    private function extractValue($expr)
    {
        if ($expr instanceof Array_) {
            return $this->extractArrayValue($expr);
        }

        if ($expr instanceof String_) {
            return $expr->value;
        }

        // Bitwise-or combinations such as `Attribute::TARGET_METHOD|Attribute::TARGET_PROPERTY`.
        // When both operands resolve to integers we combine them, matching the evaluated
        // bitmask that Reflection reports for attribute flags; otherwise we keep a readable
        // symbolic form so nothing is silently lost.
        if ($expr instanceof BitwiseOr) {
            $left = $this->extractValue($expr->left);
            $right = $this->extractValue($expr->right);
            if (is_int($left) && is_int($right)) {
                return $left|$right;
            }
            return $left . '|' . $right;
        }

        // Class constant references such as `Attribute::TARGET_METHOD`. These resolve to a
        // real value on any runtime where the class exists (the parser always runs on a
        // modern PHP), so `constant()` yields the same int Reflection evaluates to. When the
        // constant is unknown we fall back to the symbolic `Class::CONST` string.
        if ($expr instanceof ClassConstFetch
            && $expr->class instanceof Name
            && $expr->name instanceof Identifier
        ) {
            $constName = ltrim($expr->class->toString(), '\\') . '::' . $expr->name->toString();
            return defined($constName) ? constant($constName) : $constName;
        }

        // Global constant references (e.g. `PHP_INT_MAX`, `true`, `null`).
        if ($expr instanceof ConstFetch) {
            $name = $expr->name->toString();
            return defined($name) ? constant($name) : $name;
        }

        // For other scalar types (Int, Float, etc.)
        if (isset($expr->value)) {
            return $expr->value;
        }

        // Fallback: try to convert to string
        return (string)$expr;
    }

    /**
     * Extract array values from Array_ expression.
     */
    private function extractArrayValue(Array_ $arrayExpr): array
    {
        $result = [];

        foreach ($arrayExpr->items as $item) {
            /** @var ArrayItem $item */
            if ($item === null) {
                continue;
            }

            if ($item->key !== null) {
                // Associative array
                $key = $this->extractValue($item->key);
                $result[$key] = $this->extractValue($item->value);
            } else {
                // Indexed array
                $result[] = $this->extractValue($item->value);
            }
        }

        return $result;
    }
}
