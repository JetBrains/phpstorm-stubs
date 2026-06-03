<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\Nodes\ClassNode;

/**
 * Extracts class AST nodes from PHP stub code.
 */
interface ClassNodeExtractorInterface
{
    /**
     * @return ClassNode Class node with namespace set
     * @throws \RuntimeException If no class is found
     */
    public function extractClass(string $stubCode): ClassNode;

    /**
     * @return ClassNode[] Array of class nodes with namespace set
     */
    public function extractAllClasses(string $stubCode): array;

    /**
     * Extract all class nodes with their import context.
     *
     * @return array Array of ['node' => ClassNode, 'imports' => array]
     */
    public function extractAllClassesWithImports(string $stubCode): array;
}
