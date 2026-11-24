<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

/**
 * Parser-agnostic interface for global constant definition AST nodes.
 * Represents define() function calls that define global constants.
 */
interface ConstantDefinitionNode
{
    /**
     * Get the constant name.
     */
    public function getName(): string;

    /**
     * Get the constant value as a plain PHP scalar.
     * Returns null for complex expressions that cannot be statically evaluated.
     */
    public function getValue(): mixed;

    /**
     * Get the doc comment node attached to this constant definition, or null if none.
     */
    public function getDocComment(): ?DocCommentNode;

    /**
     * Get the namespace where this constant is defined.
     */
    public function getNamespace(): string;

    /**
     * Set the namespace for this constant.
     */
    public function setNamespace(string $namespace): void;

    /**
     * Get the attributes on the declaration (PHP 8.5+). A define() call has none.
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;

    /**
     * Get the imports (use statements) the attribute names resolve against.
     *
     * @return array Map of ['Alias' => 'Fully\\Qualified\\Name']
     */
    public function getImports(): array;
}
