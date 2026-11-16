<?php

namespace StubTests\Framework\Validator\Classes\Constants;

use StubTests\Framework\Model\PHPClassConstant;
use StubTests\Framework\Validator\AbstractConstantFlagCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\DeprecationComparator;

/**
 * Validates class constant deprecation against reflection. Runs from PHP 8.4, the first
 * version that can deprecate a class constant (ReflectionClassConstant::isDeprecated()).
 */
class ClassConstantsDeprecationCheck extends AbstractConstantFlagCheck
{
    public function supports(string $phpVersion): bool
    {
        return version_compare($phpVersion, '8.4', '>=');
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_CONSTANTS_DEPRECATION;
    }

    protected function describeMismatch(
        string $constantEntityId,
        PHPClassConstant $reflConstant,
        PHPClassConstant $stubConstant,
        string $phpVersion
    ): ?string {
        return DeprecationComparator::describeConstantMismatch($reflConstant, $stubConstant, $constantEntityId, $phpVersion);
    }
}
