<?php

namespace StubTests\Framework\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Validator\AbstractPropertyFlagCheck;

/**
 * Validates that the `static` modifier on properties in stubs matches reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all properties reported by reflection for the class.
 * 2. Looks up each property in the version-filtered stub hierarchy (parent classes),
 *    collecting a name → PHPProperty map with child-wins-over-parent priority.
 * 3. If the stub property is not found it is silently skipped — existence is
 *    ClassPropertiesExistCheck's responsibility.
 * 4. When both sides are found, their isStatic flags are compared and any mismatch
 *    is reported as a failure.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ClassStaticPropertiesCheck'
 *   → skips all static-property checks for the class.
 * - property-level: EntityType::PROPERTY + '\ClassName::$propertyName' + 'ClassStaticPropertiesCheck'
 *   → skips only that specific mismatch.
 */
class ClassStaticPropertiesCheck extends AbstractPropertyFlagCheck
{
    protected function getCheckName(): string
    {
        return 'ClassStaticPropertiesCheck';
    }

    protected function describeMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string {
        $reflIsStatic = $reflProperty->isStatic();
        $stubIsStatic = $stubProperty->isStatic();

        if ($reflIsStatic === $stubIsStatic) {
            return null;
        }

        $expected = $reflIsStatic ? 'static' : 'non-static';
        $actual   = $stubIsStatic ? 'static' : 'non-static';

        return "Property {$propertyEntityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs";
    }
}
