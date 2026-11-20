<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\PHPParameter;

/**
 * Compares how parameters are passed: by reference and variadic.
 *
 * Both comparisons are bidirectional (a stray `&` or `...` in the stubs is as wrong as a missing
 * one) and match parameters by position, not by name: parameter names are only checked from
 * PHP 8.0 (ParameterNamesCheck), and before that reflection names often differ from the stubs'.
 *
 * Stub parameters are version-filtered and deduplicated first (ParameterFilterHelper), so a
 * parameter declared twice for different versions counts once, in the form valid at $phpVersion.
 */
final class ParameterPassingComparator
{
    /**
     * Finds parameters passed by reference on one side and by value on the other.
     *
     * A stub parameter past the last reflection parameter is compared with the reflection
     * variadic, if there is one: a variadic absorbs every remaining argument, so a stub that
     * spells the variadic out (e.g. `mysqli_stmt::bind_param(string $types, &$var1, &...$vars)`
     * against reflection's `(string $types, &...$vars)`) must pass those arguments the same way.
     * Without a reflection variadic, extra stub parameters are ParametersCountCheck's concern.
     *
     * A prefer-ref reflection parameter (PHPParameter::isPreferRef()) accepts both a reference
     * and a value, so either form in the stubs is correct for it.
     *
     * @param PHPParameter[] $reflParams Reflection parameters
     * @param PHPParameter[] $stubParams Stub parameters (unfiltered)
     * @return string[] One description per mismatching stub parameter, empty if all match
     */
    public static function findByReferenceMismatches(array $reflParams, array $stubParams, string $phpVersion): array
    {
        $reflParams = array_values($reflParams);
        $stubParams = ParameterFilterHelper::filterAndDeduplicate($stubParams, $phpVersion);
        $reflVariadic = self::findVariadic($reflParams);

        $mismatches = [];
        foreach ($stubParams as $position => $stubParam) {
            $reflParam = $reflParams[$position] ?? $reflVariadic;
            if ($reflParam === null || $reflParam->isPreferRef()) {
                continue;
            }

            if ($reflParam->isPassedByReference() !== $stubParam->isPassedByReference()) {
                $mismatches[] = sprintf(
                    '$%s (reflection: %s, stubs: %s)',
                    $stubParam->getName(),
                    self::describePassing($reflParam),
                    self::describePassing($stubParam)
                );
            }
        }

        return $mismatches;
    }

    /**
     * Describes a mismatch in whether the callable takes a variadic parameter, or null if both
     * sides agree.
     *
     * Compares only *whether* there is a variadic, not where: a stub may spell out leading
     * arguments of the variadic as separate parameters (see findByReferenceMismatches()), so the
     * variadic's position legitimately differs. Its position relative to the other parameters is
     * covered by ParametersCountCheck.
     *
     * @param PHPParameter[] $reflParams Reflection parameters
     * @param PHPParameter[] $stubParams Stub parameters (unfiltered)
     */
    public static function describeVariadicMismatch(array $reflParams, array $stubParams, string $phpVersion): ?string
    {
        $reflVariadic = self::findVariadic(array_values($reflParams));
        $stubVariadic = self::findVariadic(ParameterFilterHelper::filterAndDeduplicate($stubParams, $phpVersion));

        if ($reflVariadic === null && $stubVariadic !== null) {
            return "stubs declare variadic \${$stubVariadic->getName()}, reflection has no variadic parameter";
        }
        if ($reflVariadic !== null && $stubVariadic === null) {
            return "reflection declares variadic \${$reflVariadic->getName()}, stubs have no variadic parameter";
        }

        return null;
    }

    /**
     * @param PHPParameter[] $params
     */
    private static function findVariadic(array $params): ?PHPParameter
    {
        foreach ($params as $param) {
            if ($param->isVariadic()) {
                return $param;
            }
        }

        return null;
    }

    private static function describePassing(PHPParameter $param): string
    {
        return $param->isPassedByReference() ? 'by reference' : 'by value';
    }
}
