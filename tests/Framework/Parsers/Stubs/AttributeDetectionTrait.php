<?php

namespace StubTests\Framework\Parsers\Stubs;

/**
 * Shared attribute detection logic for stub parsers.
 *
 * Provides methods to check if an attribute list contains specific
 * JetBrains PhpStorm or built-in PHP attributes.
 *
 * Deprecation is not detected here: it carries a version alongside the flag, so it is read by
 * {@see \StubTests\Framework\Parsers\Stubs\Versions\DeprecationParser} instead.
 *
 * Used by StubFunctionParser and StubMethodParser.
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
            $name = $attribute->getName();
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
}
