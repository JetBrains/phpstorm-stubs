<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Nodes\MethodNode;
use StubTests\Framework\Parsers\Stubs\Nodes\PropertyNode;

/**
 * Parser-agnostic interface for class AST nodes.
 * Implementations wrap specific parser library nodes (e.g., nikic/php-parser).
 */
interface ClassNode
{
    /**
     * Get the class name.
     */
    public function getName(): string;

    /**
     * Check if the class is final.
     */
    public function isFinal(): bool;

    /**
     * Check if the class is readonly.
     */
    public function isReadonly(): bool;

    /**
     * Get the parent class name, or null if no parent.
     */
    public function getParentClassName(): ?string;

    /**
     * Get the names of implemented interfaces.
     *
     * @return string[]
     */
    public function getInterfaceNames(): array;

    /**
     * Get the class methods.
     *
     * @return MethodNode[]
     */
    public function getMethods(): array;

    /**
     * Get the class properties.
     *
     * @return PropertyNode[]
     */
    public function getProperties(): array;

    /**
     * Get the class constants.
     *
     * @return ConstantNode[]
     */
    public function getConstants(): array;

    /**
     * Set the namespace for this class.
     */
    public function setNamespace(string $namespace): void;

    /**
     * Get the namespace for this class.
     */
    public function getNamespace(): string;

    /**
     * Get the DocComment for this class.
     *
     * @return DocCommentNode|null
     */
    public function getDocComment(): ?DocCommentNode;

    /**
     * Get the attributes for this class.
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;
}
