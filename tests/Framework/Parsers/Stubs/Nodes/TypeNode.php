<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

/**
 * Parser-agnostic interface for type AST nodes.
 */
interface TypeNode
{
    /**
     * Convert the type to a string representation.
     */
    public function toString(): string;
}
