<?php

namespace StubTests\Framework\Validator\Services;

/**
 * Compares parameter count between reflection and stubs.
 *
 * Handles version-filtered stub parameters with name-based deduplication
 * (e.g. placeholder + variadic sharing the same name count as one).
 */
final class ParameterCountComparator
{
    /**
     * @param array $reflParams Reflection parameters
     * @param array $stubParams Stub parameters (unfiltered)
     * @param string $phpVersion PHP version for availability filtering
     * @return string|null Mismatch description, or null if counts match
     */
    public static function compare(array $reflParams, array $stubParams, string $phpVersion): ?string
    {
        $reflCount = count($reflParams);

        $availableParamNames = [];
        foreach ($stubParams as $param) {
            if ($param->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true) {
                $availableParamNames[$param->getName()] = true;
            }
        }
        $stubCount = count($availableParamNames);

        if ($reflCount !== $stubCount) {
            return "reflection has {$reflCount} parameters, stubs have {$stubCount}";
        }

        return null;
    }
}
