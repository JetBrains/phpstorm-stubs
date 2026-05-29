<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;

/**
 * Parser-agnostic interface for constant AST nodes.
 * Exposes all constant properties needed for complete parsing.
 */
interface ConstantNode
{
    /**
     * Get the constant name.
     */
    public function getName(): string;

    /**
     * Get the constant value as a plain PHP scalar, or null for complex expressions.
     */
    public function getValue(): mixed;

    /**
     * Check if the constant is public (PHP 7.1+).
     */
    public function isPublic(): bool;

    /**
     * Check if the constant is protected (PHP 7.1+).
     */
    public function isProtected(): bool;

    /**
     * Check if the constant is private (PHP 7.1+).
     */
    public function isPrivate(): bool;

    /**
     * Check if the constant is final (PHP 8.1+).
     */
    public function isFinal(): bool;

    /**
     * Get the doc comment, or null if no doc comment.
     */
    public function getDocComment(): ?DocCommentNode;

    /**
     * Get the constant attributes (PHP 8.0+).
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;
}
