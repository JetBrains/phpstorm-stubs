<?php

namespace StubTests\Framework\Parsers\Stubs;

/**
 * Shared attribute detection logic for stub parsers.
 *
 * Provides methods to check if an attribute list contains specific
 * JetBrains PhpStorm or built-in PHP attributes (TentativeType, Deprecated).
 *
 * Used by StubFunctionParser, StubMethodParser, and StubParameterParser.
 */
trait AttributeDetectionTrait
{
    /**
     * Check whether any attribute resolves to the TentativeType marker.
     *
     * @param array $attributes Array of AttributeNode objects
     * @param array $imports    Map of import aliases to fully qualified names
     */
    private function hasTentativeTypeAttribute(array $attributes, array $imports): bool
    {
        foreach ($attributes as $attribute) {
            $name     = $attribute->getName();
            $fullName = $imports[$name] ?? $name;
            if ($fullName === 'JetBrains\\PhpStorm\\Internal\\TentativeType'
                || $fullName === 'TentativeType'
                || str_ends_with($fullName, '\\Internal\\TentativeType')
            ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check whether any attribute resolves to a deprecation marker.
     * Handles both JetBrains `#[JetBrains\PhpStorm\Deprecated]` and the built-in PHP `#[Deprecated]`.
     *
     * @param array $attributes Array of AttributeNode objects
     * @param array $imports    Map of import aliases to fully qualified names
     */
    private function hasDeprecatedAttribute(array $attributes, array $imports): bool
    {
        foreach ($attributes as $attribute) {
            $name     = $attribute->getName();
            $fullName = $imports[$name] ?? $name;
            if ($fullName === 'JetBrains\\PhpStorm\\Deprecated'
                || str_ends_with($fullName, '\\PhpStorm\\Deprecated')
                || $fullName === 'Deprecated'
            ) {
                return true;
            }
        }
        return false;
    }
}
