<?php

namespace StubTests\Framework\Validator\Classes\Constants;

use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Validator\AbstractConstantFlagCheck;

/**
 * Validates that the visibility (public/protected/private) of constants in class stubs
 * matches reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all version-available constants declared directly in the stub.
 * 2. Looks up each constant by name in the reflection constant map (which includes all
 *    inherited constants).
 * 3. If the constant is not found in reflection it is silently skipped — existence is
 *    ClassConstantsCheck's responsibility.
 * 4. When both sides are found, their visibility strings are compared and any mismatch
 *    is reported as a failure.
 *
 * Known problems are supported at two granularities:
 * - entity-level: EntityType::CLASS_TYPE + classId + 'ClassConstantsVisibilityCheck'
 *   → skips all visibility checks for the class.
 * - constant-level: EntityType::CLASS_CONSTANT + '\ClassName::CONST_NAME' + 'ClassConstantsVisibilityCheck'
 *   → skips only that specific mismatch.
 */
class ClassConstantsVisibilityCheck extends AbstractConstantFlagCheck
{
    protected function getCheckName(): string
    {
        return 'ClassConstantsVisibilityCheck';
    }

    protected function describeMismatch(
        string $constantEntityId,
        PHPClassConstant $reflConstant,
        PHPClassConstant $stubConstant,
        string $phpVersion
    ): ?string {
        if ($reflConstant->getAccess() === $stubConstant->getAccess()) {
            return null;
        }

        return "Constant {$constantEntityId} has visibility '{$reflConstant->getAccess()->value}' in reflection "
            . "but '{$stubConstant->getAccess()->value}' in stubs";
    }
}
