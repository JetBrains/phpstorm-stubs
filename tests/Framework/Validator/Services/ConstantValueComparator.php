<?php

namespace StubTests\Framework\Validator\Services;

/**
 * Compares a stub constant's value with reflection's, for ConstantValueCheck and
 * ClassConstantsValueCheck.
 *
 * Values used to be compared by their string form only, which let a value of the wrong type pass
 * whenever it printed the same: `define('PKCS7_NOSMIMECAP', '512')` for an int, and `1` for the
 * bools `PCRE_JIT_SUPPORT` and `PHP_CLI_PROCESS_TITLE`. PhpStorm infers the constant's type from the
 * stub value, so the type has to match as well.
 */
final class ConstantValueComparator
{
    /**
     * Describe how the two values differ, or return null when they match.
     */
    public static function describeMismatch(mixed $reflectionValue, mixed $stubValue): ?string
    {
        if ((string)$reflectionValue !== (string)$stubValue) {
            return "reflection='{$reflectionValue}', stub='{$stubValue}'";
        }

        $reflectionType = get_debug_type($reflectionValue);
        $stubType = get_debug_type($stubValue);
        if ($reflectionType !== $stubType) {
            return "reflection is {$reflectionType} " . var_export($reflectionValue, true)
                . ", stub is {$stubType} " . var_export($stubValue, true);
        }

        return null;
    }
}
