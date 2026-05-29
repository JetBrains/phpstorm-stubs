<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\Nodes\EnumNode;

/**
 * Extracts enum AST nodes from PHP stub code.
 */
interface EnumNodeExtractorInterface
{
    /**
     * @return EnumNode[] Array of enum nodes with namespace set
     */
    public function extractAllEnums(string $stubCode): array;

    /**
     * Extract all enum nodes with their import context.
     *
     * @return array Array of ['node' => EnumNode, 'imports' => array]
     */
    public function extractAllEnumsWithImports(string $stubCode): array;
}
