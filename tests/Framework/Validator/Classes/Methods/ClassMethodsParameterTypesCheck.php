<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\ParameterTypeComparator;

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
class ClassMethodsParameterTypesCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    public function supports(string $phpVersion): bool
    {
        // Scalar type hints were introduced in PHP 7.0
        return version_compare($phpVersion, '7.0', '>=');
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::PARAMETER_TYPES;
    }

    public function describeMethodMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $mismatches = [];
        foreach (ParameterTypeComparator::compare($reflMethod->getParameters(), $stubMethod->getParameters(), $phpVersion) as $m) {
            $display = $m['stubType'] ?? 'none';
            $mismatches[] = "\${$m['name']}: reflection '{$m['reflType']}', stubs '{$display}'";
        }

        if (empty($mismatches)) {
            return null;
        }

        return "Method {$methodEntityId}: parameter type mismatch(es) in PHP {$phpVersion}: "
            . implode('; ', $mismatches);
    }
}
