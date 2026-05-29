<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Validates that parameter types in stub methods match those in reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, for each parameter present in both reflection
 *    and stubs (matched by name), types are resolved and compared.
 *
 * Type resolution priority (stub side):
 *   1. Signature type from getDeclaredType() — if non-empty (not NoType), used as-is.
 *   2. LanguageLevelTypeAware — highest version <= $phpVersion wins; default type fallback.
 *
 * Special cases:
 *   - Reflection has no type but stub documents one → skip (stubs are more informative).
 *   - Both sides have no type → treated as a match.
 *   - Reflection has a type but stub declares none → reported as a failure.
 *   - Parameter absent from stubs by name → silently skipped (ParametersCountCheck's
 *     responsibility).
 *
 * Known problems are supported at two granularities:
 * - class-level:  EntityType::CLASS_TYPE + classId + 'ParameterTypesCheck'
 *   → skips all parameter-type checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ParameterTypesCheck'
 *   → skips only that specific method.
 */
class ClassMethodsParameterTypesCheck extends AbstractMethodFlagCheck
{

    public function supports(string $phpVersion): bool
    {
        // Scalar type hints were introduced in PHP 7.0
        return version_compare($phpVersion, '7.0', '>=');
    }

    protected function getCheckName(): string
    {
        return 'ParameterTypesCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        // Build version-filtered stub param map by name, deduplicating variadic workarounds
        $stubParamsByName = [];
        foreach ($this->methodCollection->filterAndDeduplicateParams($stubMethod->getParameters(), $phpVersion) as $param) {
            $stubParamsByName[$param->getName()] = $param;
        }

        $mismatches = [];
        foreach ($reflMethod->getParameters() as $reflParam) {
            $name = $reflParam->getName();

            if (!isset($stubParamsByName[$name])) {
                // Parameter absent from stubs — ParametersCountCheck's responsibility
                continue;
            }

            $reflType = TypeResolver::getParamTypeString($reflParam, $phpVersion);

            // Reflection has no type — stubs may document one; skip this param
            if ($reflType === null) {
                continue;
            }

            $stubType = TypeResolver::getParamTypeString($stubParamsByName[$name], $phpVersion);

            $normalizedRefl = TypeResolver::normalizeType($reflType);
            $normalizedStub = TypeResolver::normalizeType($stubType);

            if ($normalizedRefl !== $normalizedStub) {
                $display = $stubType ?? 'none';
                $mismatches[] = "\${$name}: reflection '{$reflType}', stubs '{$display}'";
            }
        }

        if (empty($mismatches)) {
            return null;
        }

        return "Method {$methodEntityId}: parameter type mismatch(es) in PHP {$phpVersion}: "
            . implode('; ', $mismatches);
    }
}
