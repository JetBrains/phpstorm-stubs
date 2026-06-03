<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;
use StubTests\Framework\Validator\Services\OptionalParametersComparator;

/**
 * Validates that parameters optional in reflection are also optional in stub methods.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, for each reflection parameter where isOptional()
 *    is true, the corresponding stub parameter (matched by name) must also be
 *    optional (has a default value, is variadic, or has [optional] in PhpDoc).
 *
 * The check is one-directional: reflection-optional → stub must be optional.
 * The reverse is not enforced.
 *
 * Known problems are supported at two granularities:
 * - class-level:  EntityType::CLASS_TYPE + classId + 'OptionalParametersCheck'
 *   → skips all optional-parameter checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'OptionalParametersCheck'
 *   → skips only that specific method.
 */
class ClassMethodsOptionalParametersCheck extends AbstractMethodFlagCheck
{
    protected function getCheckName(): string
    {
        return 'OptionalParametersCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $mismatches = OptionalParametersComparator::findMismatches(
            $reflMethod->getParameters(),
            $stubMethod->getParameters(),
            $phpVersion
        );

        if (empty($mismatches)) {
            return null;
        }

        $paramList = implode(', ', $mismatches);
        return "Method {$methodEntityId}: parameter(s) optional in PHP {$phpVersion} but not in stubs: {$paramList}";
    }
}
