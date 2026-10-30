<?php

namespace StubTests\Framework\Validator\Classes\Properties;

use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesPropertyMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\ParameterDefaultValueComparator;

/**
 * Validates that the default values of properties in stubs match reflection.
 *
 * Only properties that have a default in reflection are compared, and the stub must declare the
 * same one. An untyped property's implicit null default counts on both sides. A stub default where
 * reflection has none is not reported: stubs give some properties that PHP declares without a
 * default (DOM's virtual properties, say) the value they have at runtime.
 *
 * Defaults that could not be evaluated on either side are skipped, and only the latest PHP version
 * is checked, as for parameter defaults: stubs have no version-aware way to declare a default.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ClassPropertiesDefaultValueCheck'
 * - property-level: EntityType::PROPERTY + '\ClassName::$propertyName' + 'ClassPropertiesDefaultValueCheck'
 */
class ClassPropertiesDefaultValueCheck extends AbstractMemberFlagCheck implements DescribesPropertyMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::PROPERTY;
    }

    public function supports(string $phpVersion): bool
    {
        return $phpVersion === PhpVersions::LATEST->value;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_PROPERTIES_DEFAULT_VALUE;
    }

    public function describePropertyMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string {
        if (!$reflProperty->hasDefaultValue()) {
            return null;
        }

        $reflValue = ParameterDefaultValueComparator::formatValue($reflProperty->getDefaultValue());
        if (!$stubProperty->hasDefaultValue()) {
            return "Property {$propertyEntityId} defaults to {$reflValue} in PHP {$phpVersion} but has no default in stubs";
        }

        if (!$reflProperty->isDefaultValueResolved() || !$stubProperty->isDefaultValueResolved()) {
            return null;
        }

        if ($reflProperty->getDefaultValue() === $stubProperty->getDefaultValue()) {
            return null;
        }

        $stubValue = ParameterDefaultValueComparator::formatValue($stubProperty->getDefaultValue());
        return "Property {$propertyEntityId} defaults to {$reflValue} in PHP {$phpVersion} but to {$stubValue} in stubs";
    }
}
