<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Nodes\MethodNode;

/**
 * Parser-agnostic interface for interface AST nodes.
 * Exposes all interface properties needed for complete parsing.
 */
interface InterfaceNode
{
    /**
     * Get the interface name.
     */
    public function getName(): string;

    /**
     * Get the interface namespace.
     */
    public function getNamespace(): string;

    /**
     * Set the namespace for this interface.
     */
    public function setNamespace(string $namespace): void;

    /**
     * Get parent interface names (interfaces this interface extends).
     *
     * @return string[]
     */
    public function getParentInterfaceNames(): array;

    /**
     * Get the interface methods.
     *
     * @return MethodNode[]
     */
    public function getMethods(): array;

    /**
     * Get the interface constants.
     *
     * @return ConstantNode[]
     */
    public function getConstants(): array;

    /**
     * Get the doc comment, or null if no doc comment.
     */
    public function getDocComment(): ?DocCommentNode;

    /**
     * Get the attributes for this interface.
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;
}
