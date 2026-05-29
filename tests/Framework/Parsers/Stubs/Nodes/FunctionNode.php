<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ParameterNode;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Parser-agnostic interface for function AST nodes.
 * Implementations wrap specific parser library nodes (e.g., nikic/php-parser).
 */
interface FunctionNode
{
    /**
     * Get the function name.
     */
    public function getName(): string;

    /**
     * Get the function parameters.
     *
     * @return ParameterNode[]
     */
    public function getParameters(): array;

    /**
     * Get the return type node, or null if no return type.
     */
    public function getReturnType(): ?TypeNode;

    /**
     * Get the doc comment node, or null if no doc comment.
     */
    public function getDocComment(): ?DocCommentNode;

    /**
     * Set the namespace for this function.
     */
    public function setNamespace(string $namespace): void;

    /**
     * Get the namespace for this function.
     */
    public function getNamespace(): string;

    /**
     * Get the function attributes (PHP 8.0+).
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;

    /**
     * Set the imports (use statements) for this function's file context.
     * Maps alias names to fully qualified class names.
     *
     * @param array $imports Map of ['Alias' => 'Fully\\Qualified\\Name']
     */
    public function setImports(array $imports): void;

    /**
     * Get the imports (use statements) for this function's file context.
     *
     * @return array Map of ['Alias' => 'Fully\\Qualified\\Name']
     */
    public function getImports(): array;
}
