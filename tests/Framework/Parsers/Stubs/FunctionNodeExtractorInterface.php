<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\Nodes\FunctionNode;

/**
 * Extracts function AST nodes from PHP stub code.
 */
interface FunctionNodeExtractorInterface
{
    /**
     * @return FunctionNode Function node with namespace set
     * @throws \RuntimeException If no function is found
     */
    public function extractFunction(string $stubCode): FunctionNode;

    /**
     * @return FunctionNode[] Array of function nodes with namespace set
     */
    public function extractAllFunctions(string $stubCode): array;
}
