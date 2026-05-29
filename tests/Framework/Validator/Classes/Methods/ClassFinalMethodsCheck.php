<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;

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
class ClassFinalMethodsCheck extends AbstractMethodFlagCheck
{
    protected function getCheckName(): string
    {
        return 'ClassFinalMethodsCheck';
    }

    protected function describeMismatch(string $methodEntityId, mixed $reflMethod, PHPMethod $stubMethod, string $phpVersion): ?string
    {
        $reflIsFinal = $reflMethod->isFinal();
        $stubIsFinal = $stubMethod->isFinal();

        if ($reflIsFinal === $stubIsFinal) {
            return null;
        }

        $expected = $reflIsFinal ? 'final' : 'non-final';
        $actual   = $stubIsFinal ? 'final' : 'non-final';

        return "Method {$methodEntityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs";
    }
}
