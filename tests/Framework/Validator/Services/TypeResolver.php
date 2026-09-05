<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\BasePHPElement;
use StubTests\Framework\Model\PHPParameter;

/**
 * Provides type-resolution and normalisation helpers for validators
 * that compare type information between reflection data and stubs.
 */
final class TypeResolver
{
    /**
     * PHP primitive and pseudo types — anything *not* in this list is a class name.
     *
     * That "is it a class name" question is general type vocabulary, not a PhpDoc question. It lived
     * on PhpDocConformanceService, which meant ReturnTypeComparator — which has nothing to do with
     * PhpDoc — had to reach into the conformance service to answer it. Both now read it from here.
     *
     * `self`, `parent` and `static` are listed because they are *relative* names: they denote a class
     * but say nothing about which one, so a comparison that treats them as class names would be
     * comparing a placeholder against a resolved FQN. Callers that care about late static binding
     * handle them explicitly before consulting this list.
     */
    public const PRIMITIVES = [
        'array', 'bool', 'callable', 'false', 'float', 'int', 'iterable',
        'mixed', 'never', 'null', 'object', 'resource', 'self', 'parent',
        'static', 'string', 'true', 'void',
    ];

    /**
     * Resolve version-aware type from LanguageLevelTypeAware attribute data.
     *
     * Finds the highest version key in languageLevelTypes that is <= $phpVersion.
     * Falls back to defaultType when no version entry applies.
     * Returns null when neither languageLevelTypes nor defaultType is set.
     */
    public static function resolveVersionAwareType(BasePHPElement $entity, string $phpVersion): ?string
    {
        $languageLevelTypes = $entity->getStubsMetadata()?->getLanguageLevelTypes();
        $defaultType = $entity->getStubsMetadata()?->getDefaultType();

        if ($languageLevelTypes === null && $defaultType === null) {
            return null;
        }

        $applicableType = null;
        $highestApplicableVersion = null;

        if (is_array($languageLevelTypes)) {
            foreach ($languageLevelTypes as $version => $type) {
                if (version_compare($phpVersion, (string)$version, '>=')) {
                    if ($highestApplicableVersion === null || version_compare((string)$version, $highestApplicableVersion, '>')) {
                        $highestApplicableVersion = (string)$version;
                        $applicableType = $type;
                    }
                }
            }
        }

        return $applicableType ?? $defaultType;
    }

    /**
     * Normalize a type string for semantic comparison.
     *
     * Handles:
     * - Typed array notation (string[], int[], etc.) -> array
     * - Union type ordering (sort components alphabetically)
     * - Leading backslashes on class names (for FQN consistency)
     */
    public static function normalizeType(?string $type): ?string
    {
        if ($type === null) {
            return null;
        }

        $type = preg_replace('/\b(\w+)\[]/', 'array', $type);

        if (str_contains($type, '|')) {
            $parts = explode('|', $type);
            $parts = array_map(fn ($part) => ltrim(trim($part), '\\'), $parts);
            $parts = array_unique($parts);
            sort($parts);
            $type = implode('|', $parts);
        } else {
            $type = ltrim($type, '\\');
        }

        return $type;
    }

    /**
     * Get the type string for a parameter, checking declared type first then version-aware.
     */
    public static function getParamTypeString(PHPParameter $param, string $phpVersion): ?string
    {
        $typeString = $param->getDeclaredType()->toString();
        if ($typeString !== '') {
            return $typeString;
        }

        $versionAwareType = self::resolveVersionAwareType($param, $phpVersion);
        if ($versionAwareType !== null && $versionAwareType !== '') {
            return $versionAwareType;
        }

        return null;
    }
}
