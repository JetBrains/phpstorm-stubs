<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

/**
 * Parser-agnostic interface for parameter AST nodes.
 */
interface ParameterNode
{
    /**
     * Get the parameter name.
     */
    public function getName(): string;

    /**
     * Get the parameter type hint from signature.
     */
    public function getType(): ?TypeNode;

    /**
     * Get the parameter attributes (PHP 8.0+).
     *
     * @return AttributeNode[]
     */
    public function getAttributes(): array;

    /**
     * Check if the parameter is variadic (uses ... operator).
     *
     * @return bool True if parameter is variadic, false otherwise
     */
    public function isVariadic(): bool;

    /**
     * Check if the parameter has a default value in the signature.
     *
     * @return bool True if the parameter has an explicit default value
     */
    public function hasDefaultValue(): bool;

    /**
     * Evaluate and return the default value of the parameter.
     *
     * Implementations should evaluate the default expression to a PHP value,
     * resolving named constants (e.g. SORT_REGULAR) via PHP's runtime.
     *
     * @return mixed The evaluated PHP default value
     * @throws \RuntimeException if there is no default or the expression cannot be evaluated
     */
    public function getDefaultValue(): mixed;
}
