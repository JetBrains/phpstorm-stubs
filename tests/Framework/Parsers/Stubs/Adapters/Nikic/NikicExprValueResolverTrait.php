<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

/**
 * Resolves PhpParser expression nodes to plain PHP scalar values.
 * Shared by all Nikic adapter classes that need to extract constant values.
 */
trait NikicExprValueResolverTrait
{
    /**
     * Resolves a PhpParser expression node to a plain PHP value.
     * Returns null for complex expressions (arrays, operations, etc.) that cannot be statically evaluated.
     */
    private static function resolveExprValue(\PhpParser\Node\Expr $expr): mixed
    {
        if ($expr instanceof \PhpParser\Node\Scalar\String_) {
            return $expr->value;
        }
        if ($expr instanceof \PhpParser\Node\Scalar\LNumber) {
            return $expr->value;
        }
        if ($expr instanceof \PhpParser\Node\Scalar\DNumber) {
            return $expr->value;
        }
        if ($expr instanceof \PhpParser\Node\Expr\UnaryMinus) {
            if ($expr->expr instanceof \PhpParser\Node\Scalar\LNumber) {
                return -$expr->expr->value;
            }
            if ($expr->expr instanceof \PhpParser\Node\Scalar\DNumber) {
                $negated = -$expr->expr->value;
                // PHP parses literals like 9223372036854775808 as DNumber (float) because
                // they overflow int, but -9223372036854775808 is exactly PHP_INT_MIN.
                // Return as int when the negated float value is a whole number in int range.
                if ($negated == (int)$negated) {
                    return (int)$negated;
                }
                return $negated;
            }
            return null;
        }
        if ($expr instanceof \PhpParser\Node\Expr\UnaryPlus) {
            if ($expr->expr instanceof \PhpParser\Node\Scalar\LNumber
                || $expr->expr instanceof \PhpParser\Node\Scalar\DNumber) {
                return $expr->expr->value;
            }
            return null;
        }
        return null;
    }
}
