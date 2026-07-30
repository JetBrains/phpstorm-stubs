<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\ReturnTypeComparator;
use StubTests\Framework\Validator\Services\ReturnTypeResolver;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Validates that return types in stub methods match those in reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, return types are compared using version-aware
 *    resolution (LanguageLevelTypeAware attribute) and semantic normalisation.
 *
 * When reflection has no return type information (null), the check passes
 * — the stub may correctly document a type that the Reflection API does not expose.
 *
 * Known problems are supported at two granularities:
 * - class-level:  EntityType::CLASS_TYPE + classId + 'ReturnTypesCheck'
 *   → skips all return-type checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ReturnTypesCheck'
 *   → skips only that specific mismatch.
 */
class ClassMethodsReturnTypesCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    public function supports(string $phpVersion): bool
    {
        // Return type declarations were introduced in PHP 7.0
        return version_compare($phpVersion, '7.0', '>=');
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::RETURN_TYPES;
    }

    public function describeMethodMismatch(
        string $methodEntityId,
        PHPMethod $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $reflType = ReturnTypeResolver::getReturnTypeString($reflMethod, $phpVersion);
        $stubType = ReturnTypeResolver::getReturnTypeString($stubMethod, $phpVersion);

        // When reflection has no type info, skip validation (Reflection API limitation).
        // The stub may legitimately document a type that reflection does not expose.
        if ($reflType === null) {
            return null;
        }

        $normalizedRefl = TypeResolver::normalizeType($reflType);
        $normalizedStub = TypeResolver::normalizeType($stubType);

        if (!ReturnTypeComparator::areEquivalent($normalizedRefl, $normalizedStub)) {
            return "Return type mismatch for {$methodEntityId}: reflection has '{$reflType}', stubs have '{$stubType}'";
        }

        return null;
    }
}
