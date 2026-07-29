<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Validates that the visibility (public/protected/private) of methods in stubs matches reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, their visibility is compared and any mismatch
 *    is reported as a failure.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ClassMethodsVisibilityCheck'
 *   → skips all visibility checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ClassMethodsVisibilityCheck'
 *   → skips only that specific mismatch.
 */
class ClassMethodsVisibilityCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_METHODS_VISIBILITY;
    }

    public function describeMethodMismatch(string $methodEntityId, mixed $reflMethod, PHPMethod $stubMethod, string $phpVersion): ?string
    {
        $reflVisibility = $reflMethod->getAccess()?->value ?? 'public';
        $stubVisibility = $stubMethod->getAccess()?->value ?? 'public';

        if ($reflVisibility === $stubVisibility) {
            return null;
        }

        return "Method {$methodEntityId} is {$reflVisibility} in PHP {$phpVersion} but {$stubVisibility} in stubs";
    }
}
