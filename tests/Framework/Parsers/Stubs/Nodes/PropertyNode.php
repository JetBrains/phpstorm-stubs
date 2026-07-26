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

    /**
     * Whether the property has a default value, matching ReflectionProperty::hasDefaultValue().
     *
     * Note the asymmetry between typed and untyped properties, which is why this is
     * NOT simply "an initializer is present in the source":
     *   - `public $a;`          untyped, no initializer  => true  (implicit null default)
     *   - `public $b = 5;`      untyped, initializer     => true
     *   - `public int $c;`      typed, no initializer    => false (uninitialized)
     *   - `public int $d = 7;`  typed, initializer       => true
     *
     * Reflection reports no untyped property as lacking a default, so an implementation
     * that only checked for an initializer would disagree with reflection on every
     * untyped property.
     */
    public function hasDefaultValue(): bool;

    /**
     * Evaluate and return the property's default value.
     *
     * Returns null for an untyped property with no initializer — that is its genuine
     * PHP default, even though the runtime may report a different value for an internal
     * class whose C declaration specifies one (e.g. `\Exception::$message` is `protected
     * $message;` in the stubs but `""` at runtime). Such a difference is a real
     * stub/runtime discrepancy, not an artifact of this method.
     *
     * @return mixed The evaluated PHP default value
     * @throws \RuntimeException if there is no default or the expression cannot be evaluated
     */
    public function getDefaultValue(): mixed;
}
