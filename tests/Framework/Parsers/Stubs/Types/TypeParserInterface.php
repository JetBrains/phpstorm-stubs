<?php

namespace StubTests\Framework\Parsers\Stubs\Types;

use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Interface for parsing type information from multiple sources.
 * Implementations extract and consolidate type data from:
 * - Native PHP type hints (signature)
 * - PhpDoc annotations
 * - PHP attributes (e.g., LanguageLevelTypeAware)
 */
interface TypeParserInterface
{
    /**
     * Parse type information from all available sources.
     *
     * @param TypeNode|null $signatureType The type from PHP signature/declaration
     * @param string|null $phpDocType The type from PhpDoc (@var, @param, @return)
     * @param array $attributes Array of AttributeNode objects to extract type attributes
     * @param array $imports Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g., '\Dom' or '\\' for global)
     * @return ParsedType Consolidated type information
     */
    public function parseType(
        ?TypeNode $signatureType,
        ?string $phpDocType,
        array $attributes,
        array $imports = [],
        string $namespace = '\\'
    ): ParsedType;
}
