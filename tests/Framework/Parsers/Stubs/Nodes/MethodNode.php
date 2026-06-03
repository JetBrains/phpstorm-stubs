<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

/**
 * Parser-agnostic interface for method AST nodes.
 * Exposes all method properties needed for complete parsing.
 */
interface MethodNode
{
    /**
     * Get the method name.
     */
    public function getName(): string;

    /**
     * Check if the method is public.
     */
    public function isPublic(): bool;

    /**
     * Check if the method is protected.
     */
    public function isProtected(): bool;

    /**
     * Check if the method is private.
     */
    public function isPrivate(): bool;

    /**
     * Check if the method is static.
     */
    public function isStatic(): bool;

    /**
     * Check if the method is final.
     */
    public function isFinal(): bool;

    /**
     * Check if the method is abstract.
     */
    public function isAbstract(): bool;

    /**
     * Get the method parameters.
     *
     * @return ParameterNode[]
     */
    public function getParameters(): array;

    /**
     * Get the return type, or null if no return type.
     */
    public function getReturnType(): ?TypeNode;

    /**
     * Get the doc comment, or null if no doc comment.
     */
    public function getDocComment(): ?DocCommentNode;

    /**
     * Get the method attributes (PHP 8.0+).
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;
}
