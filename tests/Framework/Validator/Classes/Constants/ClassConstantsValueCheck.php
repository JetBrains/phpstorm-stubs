<?php

namespace StubTests\Framework\Validator\Classes\Constants;

use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\AbstractConstantFlagCheck;

/**
 * Validates that the values of constants in class stubs match reflection.
 *
 * Value comparison is intentionally limited to the latest PHP version to avoid
 * false positives from historical value changes across PHP releases.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all version-available constants declared directly in the stub.
 * 2. Looks up each constant by name in the reflection constant map (which includes all
 *    inherited constants).
 * 3. If the constant is not found in reflection it is silently skipped — existence is
 *    ClassConstantsCheck's responsibility.
 * 4. When both sides are found and the PHP version is LATEST, their values are compared
 *    and any mismatch is reported as a failure. Either side having a null value skips
 *    the check (complex/dynamic expressions cannot be compared).
 *
 * Known problems are supported at two granularities:
 * - entity-level: EntityType::CLASS_TYPE + classId + 'ClassConstantsValueCheck'
 *   → skips all value checks for the class.
 * - constant-level: EntityType::CLASS_CONSTANT + '\ClassName::CONST_NAME' + 'ClassConstantsValueCheck'
 *   → skips only that specific constant.
 */
class ClassConstantsValueCheck extends AbstractConstantFlagCheck
{
    protected function getCheckName(): string
    {
        return 'ClassConstantsValueCheck';
    }

    protected function describeMismatch(
        string $constantEntityId,
        PHPClassConstant $reflConstant,
        PHPClassConstant $stubConstant,
        string $phpVersion
    ): ?string {
        if ($phpVersion !== PhpVersions::LATEST->value) {
            return null;
        }

        if ($reflConstant->getValue() === null || $stubConstant->getValue() === null) {
            return null;
        }

        if ((string)$reflConstant->getValue() !== (string)$stubConstant->getValue()) {
            return "Constant {$constantEntityId} value mismatch: "
                . "reflection='{$reflConstant->getValue()}', stub='{$stubConstant->getValue()}'";
        }

        return null;
    }
}
