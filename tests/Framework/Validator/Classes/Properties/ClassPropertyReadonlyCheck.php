<?php

namespace StubTests\Framework\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Validator\AbstractPropertyFlagCheck;

/**
 * Validates that the `readonly` modifier on properties in stubs matches reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all properties reported by reflection for the class.
 * 2. Looks up each property in the version-filtered stub hierarchy (parent classes),
 *    collecting a name → PHPProperty map with child-wins-over-parent priority.
 * 3. If the stub property is not found it is silently skipped — existence is
 *    ClassPropertiesExistCheck's responsibility.
 * 4. When both sides are found, their isReadonly flags are compared and any mismatch
 *    is reported as a failure.
 *
 * Readonly properties were introduced in PHP 8.1, so supports() returns true only
 * for PHP 8.1 and later.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ClassPropertyReadonlyCheck'
 *   → skips all readonly-property checks for the class.
 * - property-level: EntityType::PROPERTY + '\ClassName::$propertyName' + 'ClassPropertyReadonlyCheck'
 *   → skips only that specific mismatch.
 */
class ClassPropertyReadonlyCheck extends AbstractPropertyFlagCheck
{
    public function supports(string $phpVersion): bool
    {
        return version_compare($phpVersion, '8.1', '>=');
    }

    protected function getCheckName(): string
    {
        return 'ClassPropertyReadonlyCheck';
    }

    protected function describeMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string {
        $reflIsReadonly = $reflProperty->isReadonly();
        $stubIsReadonly = $stubProperty->isReadonly();

        if ($reflIsReadonly === $stubIsReadonly) {
            return null;
        }

        $expected = $reflIsReadonly ? 'readonly' : 'non-readonly';
        $actual = $stubIsReadonly ? 'readonly' : 'non-readonly';

        return "Property {$propertyEntityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs";
    }
}
