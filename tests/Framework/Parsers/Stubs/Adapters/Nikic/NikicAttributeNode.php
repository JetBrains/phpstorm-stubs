<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
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
     * Handles arrays, strings, and other scalar values.
     */
    private function extractValue($expr)
    {
        if ($expr instanceof Array_) {
            return $this->extractArrayValue($expr);
        }

        if ($expr instanceof String_) {
            return $expr->value;
        }

        // For other scalar types (Int, Float, etc.)
        if (isset($expr->value)) {
            return $expr->value;
        }

        // Fallback: try to convert to string
        return (string) $expr;
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
