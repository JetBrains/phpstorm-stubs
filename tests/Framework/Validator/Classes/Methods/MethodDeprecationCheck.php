<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;

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
class MethodDeprecationCheck extends AbstractMethodFlagCheck
{
    protected function getCheckName(): string
    {
        return 'DeprecationCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $reflDeprecated = method_exists($reflMethod, 'isDeprecated') && (bool) $reflMethod->isDeprecated();
        $stubDeprecated = $stubMethod->isDeprecated();

        if ($reflDeprecated && !$stubDeprecated) {
            return "Method {$methodEntityId} is deprecated in PHP {$phpVersion} but not marked as deprecated in stubs";
        }

        return null;
    }
}
