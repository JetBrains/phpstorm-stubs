<?php

namespace StubTests\Framework\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Validator\AbstractPropertyFlagCheck;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Validates that the declared type of properties in stubs matches reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all properties reported by reflection for the class.
 * 2. Looks up each property in the version-filtered stub hierarchy (parent classes),
 *    collecting a name → PHPProperty map with child-wins-over-parent priority.
 * 3. If the stub property is not found it is silently skipped — existence is
 *    ClassPropertiesExistCheck's responsibility.
 * 4. When both sides are found, their types are resolved and compared. For stub
 *    properties, LanguageLevelTypeAware version-specific types take effect when no
 *    explicit signature type is present.
 *
 * Type resolution priority (stubs side):
 *   1. Signature type from getType() — if non-empty, used as-is.
 *   2. LanguageLevelTypeAware — highest version <= $phpVersion wins; default type fallback.
 *
 * Special cases:
 *   - Reflection has no type but stub documents one → skip (stubs are more informative).
 *   - Both sides have no type → treated as a match.
 *   - Reflection has a type but stub declares none → reported as a failure.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ClassPropertiesTypeCheck'
 *   → skips all type checks for the class.
 * - property-level: EntityType::PROPERTY + '\ClassName::$propertyName' + 'ClassPropertiesTypeCheck'
 *   → skips only that specific mismatch.
 */
class ClassPropertiesTypeCheck extends AbstractPropertyFlagCheck
{
    public function supports(string $phpVersion): bool
    {
        // Typed properties were introduced in PHP 7.4
        return version_compare($phpVersion, '7.4', '>=');
    }

    protected function getCheckName(): string
    {
        return 'ClassPropertiesTypeCheck';
    }

    protected function describeMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string {
        $reflType = $this->getPropertyTypeString($reflProperty, $phpVersion);
        $stubType = $this->getPropertyTypeString($stubProperty, $phpVersion);

        // Reflection has no type but stub documents one — stub is more informative, skip
        if ($reflType === null && $stubType !== null) {
            return null;
        }

        // Both have no type — agreement, no mismatch
        if ($reflType === null && $stubType === null) {
            return null;
        }

        // Normalize both sides for semantic comparison (union order, FQN prefixes, typed arrays)
        $normalizedRefl = TypeResolver::normalizeType($reflType);
        $normalizedStub = TypeResolver::normalizeType($stubType);

        if ($normalizedRefl === $normalizedStub) {
            return null;
        }

        $stubDisplay = $stubType ?? 'undefined';
        return "Property {$propertyEntityId} type is '{$reflType}' in PHP {$phpVersion} but '{$stubDisplay}' in stubs";
    }

    /**
     * Resolve the effective type string for a property at the given PHP version.
     *
     * Priority:
     * 1. Signature type from getType() — if non-empty (not NoType), returned directly.
     * 2. LanguageLevelTypeAware — highest version entry <= $phpVersion, or defaultType.
     */
    private function getPropertyTypeString(PHPProperty $property, string $phpVersion): ?string
    {
        $sigType = $property->getType();
        if ($sigType !== null) {
            $typeString = $this->typeObjectToString($sigType);
            if ($typeString !== null && $typeString !== '') {
                return $typeString;
            }
        }

        return TypeResolver::resolveVersionAwareType($property, $phpVersion);
    }

    /**
     * Convert a type object to its string representation.
     * Returns null for NoType (whose toString() returns '').
     */
    private function typeObjectToString(StandaloneType|UnionType|NullableType|NoType|IntersectionType $type): ?string
    {
        $s = $type->toString();
        return $s !== '' ? $s : null;
    }
}
