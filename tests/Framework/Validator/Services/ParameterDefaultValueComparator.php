<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Parsers\Model\PHPParameter;

/**
 * Compares default parameter values between reflection and stubs.
 */
final class ParameterDefaultValueComparator
{
    /**
     * Compare default values for each reflection parameter against the stub param map.
     *
     * Skips parameters that:
     * - have no default in reflection
     * - are absent from the stub param map (ParametersCountCheck's responsibility)
     * - have no default in the stub (OptionalParametersCheck's responsibility)
     * - have null on either side (unevaluable constant expression or genuine null default)
     *
     * @param  iterable                     $reflParams       reflection parameters
     * @param  array<string, PHPParameter>  $stubParamsByName stub parameters indexed by name
     * @return string[]
     */
    public static function buildMismatches(iterable $reflParams, array $stubParamsByName): array
    {
        $mismatches = [];

        foreach ($reflParams as $reflParam) {
            $name = $reflParam->getName();

            if (!$reflParam->hasDefaultValue()) {
                continue;
            }

            if (!isset($stubParamsByName[$name])) {
                continue;
            }

            $stubParam = $stubParamsByName[$name];

            if (!$stubParam->hasDefaultValue()) {
                continue;
            }

            $reflValue = $reflParam->getDefaultValue();
            $stubValue = $stubParam->getDefaultValue();

            if ($reflValue === null || $stubValue === null) {
                continue;
            }

            if ($reflValue !== $stubValue) {
                $mismatches[] = sprintf(
                    '$%s: reflection \'%s\', stubs \'%s\'',
                    $name,
                    self::formatValue($reflValue),
                    self::formatValue($stubValue)
                );
            }
        }

        return $mismatches;
    }

    public static function formatValue(mixed $value): string
    {
        if ($value === true) {
            return 'true';
        }
        if ($value === false) {
            return 'false';
        }
        if (is_string($value)) {
            return "'{$value}'";
        }
        if (is_array($value)) {
            return '[]';
        }
        return (string)$value;
    }
}
