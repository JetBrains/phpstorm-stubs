<?php

namespace StubTests\Framework\Parsers\Stubs\Types;

use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Default implementation of TypeParserInterface.
 * Extracts type information from signature, PhpDoc, and LanguageLevelTypeAware attributes.
 */
class DefaultTypeParser implements TypeParserInterface
{
    public function __construct() {}

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
    ): ParsedType {
        $parsed = new ParsedType();

        // Create converter with imports and namespace to resolve type names
        $converter = new TypeNodeConverter($imports, $namespace);

        // Convert type from signature to type object (with resolved names)
        $parsed->typeFromSignature = $converter->convert($signatureType);

        // Store type from PhpDoc
        $parsed->typeFromPhpDoc = $phpDocType;

        // Extract LanguageLevelTypeAware attribute
        $this->parseLanguageLevelTypeAware($attributes, $parsed, $imports);

        return $parsed;
    }

    /**
     * Extracts LanguageLevelTypeAware attribute data and stores it in ParsedType.
     *
     * @param array $attributes Array of AttributeNode objects
     * @param ParsedType $parsed The ParsedType to populate
     * @param array $imports Map of import aliases to fully qualified names
     */
    private function parseLanguageLevelTypeAware(array $attributes, ParsedType $parsed, array $imports): void
    {
        foreach ($attributes as $attribute) {
            $name = $attribute->getName();

            // Resolve the attribute name through imports if it's an alias
            $fullName = $this->resolveAttributeName($name, $imports);

            if ($this->isLanguageLevelTypeAware($fullName)) {
                $args = $attribute->getArguments();

                // First argument is the language level type map (array)
                if (isset($args[0]) && is_array($args[0])) {
                    $parsed->languageLevelTypes = $args[0];
                }

                // Named 'default' argument is the default type
                if (isset($args['default'])) {
                    $parsed->defaultType = $args['default'];
                }

                break; // Only process the first LanguageLevelTypeAware attribute
            }
        }
    }

    /**
     * Resolve an attribute name through imports.
     * If the name is an alias, returns the fully qualified name.
     * Otherwise, returns the name as-is.
     *
     * @param string $name Attribute name (may be alias or FQN)
     * @param array $imports Map of import aliases to fully qualified names
     * @return string Fully qualified attribute name or original name
     */
    private function resolveAttributeName(string $name, array $imports): string
    {
        // If it's an alias in the imports map, resolve it
        if (isset($imports[$name])) {
            return $imports[$name];
        }

        // Already fully qualified or not aliased
        return $name;
    }

    /**
     * Check if a fully qualified name represents LanguageLevelTypeAware.
     *
     * @param string $fullName Fully qualified attribute name
     * @return bool True if this is the LanguageLevelTypeAware attribute
     */
    private function isLanguageLevelTypeAware(string $fullName): bool
    {
        // Check for exact matches with various forms of the attribute name
        return $fullName === 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware' ||
               $fullName === 'LanguageLevelTypeAware' ||
               // Handle cases where the name might end with the class name
               str_ends_with($fullName, '\\LanguageLevelTypeAware');
    }
}
