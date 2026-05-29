<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Parsers\Model\BasePHPElement;
use StubTests\Framework\Parsers\Model\PHPParameter;

/**
 * Provides type-resolution and normalisation helpers for validators
 * that compare type information between reflection data and stubs.
 */
final class TypeResolver
{
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
        $defaultType        = $entity->getStubsMetadata()?->getDefaultType();

        if ($languageLevelTypes === null && $defaultType === null) {
            return null;
        }

        $applicableType           = null;
        $highestApplicableVersion = null;

        if (is_array($languageLevelTypes)) {
            foreach ($languageLevelTypes as $version => $type) {
                if (version_compare($phpVersion, (string) $version, '>=')) {
                    if ($highestApplicableVersion === null || version_compare((string) $version, $highestApplicableVersion, '>')) {
                        $highestApplicableVersion = (string) $version;
                        $applicableType           = $type;
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

        $type = preg_replace('/\b(\w+)\[\]/', 'array', $type);

        if (str_contains($type, '|')) {
            $parts = explode('|', $type);
            $parts = array_map(fn($part) => ltrim(trim($part), '\\'), $parts);
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
