<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

/**
 * Parser-agnostic interface for property AST nodes.
 * Exposes all property attributes needed for complete parsing.
 */
interface PropertyNode
{
    /**
     * Get the property name.
     */
    public function getName(): string;

    /**
     * Check if the property is public.
     */
    public function isPublic(): bool;

    /**
     * Check if the property is protected.
     */
    public function isProtected(): bool;

    /**
     * Check if the property is private.
     */
    public function isPrivate(): bool;

    /**
     * Check if the property is static.
     */
    public function isStatic(): bool;

    /**
     * Check if the property is readonly (PHP 8.1+).
     */
    public function isReadonly(): bool;

    /**
     * Get the property type, or null if no type hint.
     */
    public function getType(): ?TypeNode;

    /**
     * Get the doc comment, or null if no doc comment.
     */
    public function getDocComment(): ?DocCommentNode;

    /**
     * Get the property attributes (PHP 8.0+).
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;
}
