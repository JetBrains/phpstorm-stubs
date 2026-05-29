<?php

namespace StubTests\Framework\Validator\Services;

/**
 * Finds parameters that are optional in reflection but required in stubs.
 *
 * One-directional: if reflection reports a parameter as optional, the stub must also
 * declare it optional. The reverse is not enforced.
 */
final class OptionalParametersComparator
{
    /**
     * @param array $reflParams Reflection parameters
     * @param array $stubParams Stub parameters (unfiltered)
     * @param string $phpVersion PHP version for availability filtering
     * @return string[] Mismatch descriptions (e.g. ["$mode", "$flags"]), empty if all match
     */
    public static function findMismatches(array $reflParams, array $stubParams, string $phpVersion): array
    {
        $stubParamsByName = [];
        foreach ($stubParams as $param) {
            if ($param->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true) {
                $stubParamsByName[$param->getName()] = $param;
            }
        }

        $mismatches = [];
        foreach ($reflParams as $reflParam) {
            if (!$reflParam->isOptional()) {
                continue;
            }

            $name = $reflParam->getName();

            if (!isset($stubParamsByName[$name])) {
                continue;
            }

            if (!$stubParamsByName[$name]->isOptional()) {
                $mismatches[] = "\${$name}";
            }
        }

        return $mismatches;
    }
}
