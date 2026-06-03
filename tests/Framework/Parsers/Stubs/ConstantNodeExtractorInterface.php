<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\Nodes\ConstantDefinitionNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantNode;

/**
 * Extracts constant AST nodes from PHP stub code.
 */
interface ConstantNodeExtractorInterface
{
    /**
     * Extract all define() constant nodes.
     *
     * @return ConstantDefinitionNode[] Array of constant nodes with namespace set
     */
    public function extractAllDefineConstants(string $stubCode): array;

    /**
     * Extract all const declarations (const A = 1;).
     *
     * @return ConstantNode[] Array of constant nodes with namespace set
     */
    public function extractAllModernConstants(string $stubCode): array;
}
