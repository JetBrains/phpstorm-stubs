<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;

/**
 * Validates that the tentative-return-type flag on methods in stubs matches reflection.
 *
 * Tentative return types were introduced in PHP 8.1. A tentative return type means
 * PHP added a return-type declaration to an internal method but does not yet enforce
 * it (to avoid breaking existing code). The stub must reflect this by declaring
 * #[JetBrains\PhpStorm\Internal\TentativeType] so that IDEs can correctly handle
 * implementing code without emitting spurious type warnings.
 *
 * The check is bidirectional:
 * - reflection tentative, stub not tentative → failure (stub is missing the attribute)
 * - stub tentative, reflection not tentative → failure (stub incorrectly marks the method)
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy.
 * 3. If the stub method is not found it is silently skipped.
 * 4. When both sides are found, their hasTentativeReturnType flags are compared.
 *
 * Known problems are supported at two granularities:
 * - class-level:  EntityType::CLASS_TYPE + classId + 'TentativeReturnTypeCheck'
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'TentativeReturnTypeCheck'
 */
class ClassMethodsTentativeReturnTypeCheck extends AbstractMethodFlagCheck
{
    public function supports(string $phpVersion): bool
    {
        // Tentative return types were introduced in PHP 8.1
        return version_compare($phpVersion, '8.1', '>=');
    }

    protected function getCheckName(): string
    {
        return 'TentativeReturnTypeCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $reflTentative = method_exists($reflMethod, 'hasTentativeReturnType')
            && (bool) $reflMethod->hasTentativeReturnType();
        $stubTentative = $stubMethod->hasTentativeReturnType();

        if ($reflTentative === $stubTentative) {
            return null;
        }

        if ($reflTentative && !$stubTentative) {
            return "Method {$methodEntityId} has a tentative return type in PHP {$phpVersion}"
                . " but is not marked with #[TentativeType] in stubs";
        }

        return "Method {$methodEntityId} is marked with #[TentativeType] in stubs"
            . " but does not have a tentative return type in PHP {$phpVersion}";
    }
}
