<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Validates that the `final` modifier on methods in stubs matches reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, their isFinal flags are compared and any
 *    mismatch is reported as a failure.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ClassFinalMethodsCheck'
 *   → skips all final-method checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ClassFinalMethodsCheck'
 *   → skips only that specific mismatch.
 */
class ClassFinalMethodsCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_FINAL_METHODS;
    }

    public function describeMethodMismatch(string $methodEntityId, PHPMethod $reflMethod, PHPMethod $stubMethod, string $phpVersion): ?string
    {
        $reflIsFinal = $reflMethod->isFinal();
        $stubIsFinal = $stubMethod->isFinal();

        if ($reflIsFinal === $stubIsFinal) {
            return null;
        }

        $expected = $reflIsFinal ? 'final' : 'non-final';
        $actual = $stubIsFinal ? 'final' : 'non-final';

        return "Method {$methodEntityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs";
    }
}
