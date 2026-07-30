<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Validates that methods marked as deprecated in reflection are also deprecated in stubs.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, their deprecation status is compared: if reflection
 *    reports the method as deprecated but the stub does not, a failure is reported.
 *
 * The check is one-directional: reflection-deprecated → stub must be deprecated.
 * The reverse is not enforced.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'MethodDeprecationCheck'
 *   → skips all method deprecation checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'MethodDeprecationCheck'
 *   → skips only that specific mismatch.
 */
class MethodDeprecationCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::DEPRECATION;
    }

    public function describeMethodMismatch(
        string $methodEntityId,
        PHPMethod $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        // No method_exists() guard: $reflMethod is declared PHPMethod, which always has
        // isDeprecated(). The guard could never be false, and if a non-PHPMethod were ever
        // passed it silently reported "not deprecated" for every method in the suite — a green
        // run that validated nothing. The parameter type now raises a TypeError instead.
        $reflDeprecated = $reflMethod->isDeprecated();
        $stubDeprecated = $stubMethod->isDeprecated();

        if ($reflDeprecated && !$stubDeprecated) {
            return "Method {$methodEntityId} is deprecated in PHP {$phpVersion} but not marked as deprecated in stubs";
        }

        return null;
    }
}
