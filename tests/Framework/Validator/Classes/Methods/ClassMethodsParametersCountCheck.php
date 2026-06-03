<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;
use StubTests\Framework\Validator\Services\ParameterCountComparator;

/**
 * Validates that the number of parameters in stub methods matches reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, the stub parameter list is filtered by version
 *    (PhpStormStubsElementAvailable `from`/`to` → sinceVersion/removedVersion)
 *    and the resulting count is compared with the reflection count.
 *
 * Parameter version filtering uses inclusive boundaries for removedVersion (`<=`),
 * consistent with how PhpStormStubsElementAvailable `to` is interpreted elsewhere
 * (e.g. `to: '7.1'` means the parameter is still available in PHP 7.1).
 *
 * Parameters are deduplicated by name after version filtering. When a version-bounded
 * placeholder and a variadic share the same name (e.g. a `to: '7.4'` placeholder $vars
 * followed by `...$vars`), they represent a single mandatory variadic parameter and are
 * counted once.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ParametersCountCheck'
 *   → skips all parameter-count checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ParametersCountCheck'
 *   → skips only that specific mismatch.
 */
class ClassMethodsParametersCountCheck extends AbstractMethodFlagCheck
{
    protected function getCheckName(): string
    {
        return 'ParametersCountCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $mismatch = ParameterCountComparator::compare(
            $reflMethod->getParameters(),
            $stubMethod->getParameters(),
            $phpVersion
        );

        if ($mismatch === null) {
            return null;
        }

        return "Method {$methodEntityId} parameter count mismatch in PHP {$phpVersion}: {$mismatch}";
    }
}
