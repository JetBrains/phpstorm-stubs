<?php

namespace StubTests\Framework\Parsers\Stubs\Nodes;

/**
 * Parser-agnostic interface for enum AST nodes.
 * Exposes all enum properties needed for complete parsing.
 */
interface EnumNode
{
    /**
     * Get the enum name.
     */
    public function getName(): string;

    /**
     * Get the enum namespace.
     */
    public function getNamespace(): string;

    /**
     * Set the namespace for this enum.
     */
    public function setNamespace(string $namespace): void;

    /**
     * Get the backing type for backed enums (string or int), or null for unit enums.
     */
    public function getBackingType(): ?TypeNode;

    /**
     * Get enum case names.
     *
     * @return string[]
     */
    public function getCaseNames(): array;

    /**
     * Get the enum methods.
     *
     * @return MethodNode[]
     */
    public function getMethods(): array;

    /**
     * Get implemented interface names.
     *
     * @return string[]
     */
    public function getImplementedInterfaceNames(): array;

    /**
     * Whether the enum is declared with the `final` keyword in the source.
     *
     * PHP does not support `final enum` syntax, so this returns false for stub
     * enum nodes. Reflection may report true (PHP 8.2+) due to implicit finality.
     * The validator compares this against reflection to detect mismatches.
     */
    public function isFinal(): bool;

    /**
     * Get the enum constants.
     *
     * @return ConstantNode[]
     */
    public function getConstants(): array;

    /**
     * Get the doc comment, or null if no doc comment.
     */
    public function getDocComment(): ?DocCommentNode;
}
