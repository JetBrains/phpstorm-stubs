<?php

namespace StubTests\Framework\Validator\Services;

/**
 * Compares parameter types between reflection and stubs, matching by parameter name.
 *
 * Parameter names, count, optionality and default values already had extracted comparators in
 * this namespace; types were the one gap, and the function and method variants of the check each
 * carried their own copy of the same loop — Functions/ParameterTypesCheck even documented the
 * fact, with a comment reading "matching ClassMethodsParameterTypesCheck approach".
 *
 * Returns the mismatches as data rather than as messages, because the two checks word their
 * failures differently and those strings are part of their observable output.
 */
final class ParameterTypeComparator
{
    /**
     * Parameters absent from the stubs are skipped — existence and count are
     * ParametersCountCheck's responsibility. Parameters where reflection exposes no type are
     * skipped too: the stub may legitimately document a type reflection does not report.
     *
     * @param iterable $reflParams Reflection parameters
     * @param array    $stubParams Stub parameters, still unfiltered by version
     * @param string   $phpVersion PHP version, for availability filtering and type resolution
     *
     * @return list<array{name: string, reflType: string, stubType: string|null}> in reflection order
     */
    public static function compare(iterable $reflParams, array $stubParams, string $phpVersion): array
    {
        $stubParamsByName = [];
        foreach (ParameterFilterHelper::filterAndDeduplicate($stubParams, $phpVersion) as $param) {
            $stubParamsByName[$param->getName()] = $param;
        }

        $mismatches = [];
        foreach ($reflParams as $reflParam) {
            $name = $reflParam->getName();

            if (!isset($stubParamsByName[$name])) {
                continue;
            }

            $reflType = TypeResolver::getParamTypeString($reflParam, $phpVersion);
            if ($reflType === null) {
                continue;
            }

            $stubType = TypeResolver::getParamTypeString($stubParamsByName[$name], $phpVersion);

            if (TypeResolver::normalizeType($reflType) !== TypeResolver::normalizeType($stubType)) {
                $mismatches[] = ['name' => $name, 'reflType' => $reflType, 'stubType' => $stubType];
            }
        }

        return $mismatches;
    }
}
