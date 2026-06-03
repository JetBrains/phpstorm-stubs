<?php

namespace StubTests\Framework\Validator\Services;

/**
 * Compares parameter names positionally between reflection and stubs.
 *
 * Returns empty array when counts differ (that's ParametersCountCheck's responsibility).
 */
final class ParameterNamesComparator
{
    /**
     * @param array $reflParams Reflection parameters
     * @param array $stubParams Version-filtered and deduplicated stub parameters
     * @return string[] Mismatch descriptions, empty if all match
     */
    public static function findMismatches(array $reflParams, array $stubParams): array
    {
        if (count($reflParams) !== count($stubParams)) {
            return [];
        }

        $mismatches = [];
        foreach ($reflParams as $index => $reflParam) {
            if (!isset($stubParams[$index])) {
                continue;
            }
            $reflName = $reflParam->getName();
            $stubName = $stubParams[$index]->getName();

            if ($reflName !== null && $stubName !== null && $reflName !== $stubName) {
                $mismatches[] = "#{$index}: reflection '\${$reflName}', stubs '\${$stubName}'";
            }
        }

        return $mismatches;
    }
}
