<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

/**
 * Parser-agnostic interface for attribute AST nodes.
 * Represents PHP 8.0+ attributes (e.g., #[AttributeName(...)])
 */
interface AttributeNode
{
    /**
     * Get the attribute name (e.g., "LanguageLevelTypeAware").
     */
    public function getName(): string;

    /**
     * Get the attribute arguments.
     * Returns an associative array where keys are argument names (or numeric for positional args).
     *
     * @return array Array of arguments, e.g., [0 => ['8.1' => 'string'], 'default' => '']
     */
    public function getArguments(): array;
}
