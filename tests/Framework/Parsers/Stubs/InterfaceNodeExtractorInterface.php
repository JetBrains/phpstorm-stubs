<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\Nodes\InterfaceNode;

/**
 * Extracts interface AST nodes from PHP stub code.
 */
interface InterfaceNodeExtractorInterface
{
    /**
     * @return InterfaceNode[] Array of interface nodes with namespace set
     */
    public function extractAllInterfaces(string $stubCode): array;

    /**
     * Extract all interface nodes with their import context.
     *
     * @return array Array of ['node' => InterfaceNode, 'imports' => array]
     */
    public function extractAllInterfacesWithImports(string $stubCode): array;
}
