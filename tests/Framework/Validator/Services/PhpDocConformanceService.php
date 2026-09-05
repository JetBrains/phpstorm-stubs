<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\PHPParameter;
use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\PhpDoc\TemplateTypeNormalizer;

/**
 * Whether a PhpDoc type and a signature type describe the same thing.
 *
 * Used by FunctionPhpDocConformsSignatureCheck, ClassMethodsPhpDocConformsSignatureCheck, and their
 * Enum/Interface variants.
 *
 * Three concerns that used to live here have moved out, leaving this class to hold the compatibility
 * relation and nothing else:
 * - phpstan/psalm annotation narrowing → {@see PhpStanTypeNormalizer}, which is pure string
 *   rewriting and whose leaf table grows on a different schedule than the algorithm below;
 * - "which type names are primitives" → {@see TypeResolver::PRIMITIVES}, general type vocabulary
 *   that ReturnTypeComparator also needs and was reaching across for;
 * - `@template` name extraction → {@see TemplateTypeNormalizer}, which the stub parsers already had
 *   a better implementation of.
 */
final class PhpDocConformanceService
{
    /**
     * Check if a PhpDoc type is compatible with a signature type.
     *
     * Permissive algorithm — avoids false positives from intentional patterns:
     * - Typed-array narrowing:     sig `array`, doc `string[]` → pass (string[] normalises to array)
     * - phpstan generics:          sig `array`, doc `array<K,V>` → pass (generics stripped)
     * - resource widening:         sig `GMP`,   doc `resource|GMP` → pass (intersection non-empty)
     * - bool/false split:          sig `bool`,  doc `false` → pass (bool expands to {false, true})
     * - union reordering:          sig `string|false`, doc `false|string` → pass (normalised)
     * - mixed sig or doc:          sig `mixed`, doc `string` → pass (mixed encompasses all)
     * - object sig with class doc: sig `object`, doc `SomeClass` → pass
     * - class sig with object doc: sig `SomeClass`, doc `object` → pass
     * - resource→class migration:  sig `SomeClass`, doc `resource` → pass (PHP8 object migration)
     * - @template variable in doc: sig `\SplFileInfo`, doc `\T` (T declared via @template) → pass
     * - static ↔ class name:       sig `\DateTime`, doc `static` → pass
     * - class-to-class narrowing:  sig `\Iterator`, doc `\ArrayIterator` → pass
     *
     * Catches: sig `string`, doc `int` → fail (no shared component)
     *
     * @param string $sig Signature type string (always a real PHP type — no template variables)
     * @param string $doc PhpDoc type string (may contain @template variable names)
     * @param string[] $templateNames @template variable names declared on the enclosing entity
     * @return bool true = compatible, false = mismatch detected
     */
    public function isPhpDocCompatibleWithSignature(string $sig, string $doc, array $templateNames = []): bool
    {
        $normalizedSig = TypeResolver::normalizeType($sig) ?? '';
        $normalizedDoc = $this->normalizeDocType($doc);

        if ($normalizedSig === $normalizedDoc) {
            return true;
        }

        // 'mixed' is universally compatible with any type on either side
        if ($normalizedSig === 'mixed' || $normalizedDoc === 'mixed') {
            return true;
        }

        $sigParts = $this->splitUnionComponents($normalizedSig);
        $docParts = $this->splitUnionComponents($normalizedDoc);

        // 'mixed' as a union component → compatible
        if (in_array('mixed', $sigParts) || in_array('mixed', $docParts)) {
            return true;
        }

        if ($this->isObjectCompatible($sigParts, $docParts)) {
            return true;
        }

        if ($this->isResourceToClassMigration($sigParts, $docParts)) {
            return true;
        }

        if ($this->isShortNameAliasCompatible($sigParts, $docParts)) {
            return true;
        }

        if ($this->hasTemplateType($docParts, $templateNames)) {
            return true;
        }

        if ($this->isStaticClassCompatible($sigParts, $docParts)) {
            return true;
        }

        if ($this->isBothSidesClassTypes($sigParts, $docParts)) {
            return true;
        }

        // Expand bool ↔ {false, true} in both sets so that
        // sig: bool is compatible with doc: false (and vice versa)
        $sigExpanded = $this->expandBool($sigParts);
        $docExpanded = $this->expandBool($docParts);

        return !empty(array_intersect($sigExpanded, $docExpanded));
    }

    /**
     * Extract @template variable names from a raw PhpDoc comment.
     *
     * Delegates to the one implementation the stub parsers also use. This class used to carry a
     * second, DocBlockFactory-based one that silently dropped `@template-contravariant`.
     *
     * @return string[] Template variable names (without any leading backslash)
     */
    public function extractTemplateNames(?string $rawPhpDoc): array
    {
        return TemplateTypeNormalizer::extractTemplateNames($rawPhpDoc);
    }

    /**
     * Normalise a PhpDoc type string: strip phpstan/psalm annotations, then apply the shared
     * normalizeType() (union ordering, FQN backslash, T[] → array).
     */
    public function normalizeDocType(string $type): string
    {
        return PhpStanTypeNormalizer::normalize($type);
    }

    /**
     * Split a union type string into individual components.
     *
     * @return string[]
     */
    public function splitUnionComponents(string $type): array
    {
        if (!str_contains($type, '|')) {
            return [$type];
        }
        return array_map('trim', explode('|', $type));
    }

    /**
     * Get the signature type string for a parameter.
     *
     * Priority:
     * 1. Declared type from getDeclaredType() — if non-empty (not NoType)
     * 2. LanguageLevelTypeAware — highest version <= $phpVersion, or defaultType
     */
    public function getParamSigTypeForPhpDoc(PHPParameter $param, string $phpVersion): ?string
    {
        $declaredType = $param->getDeclaredType();
        $typeString = $declaredType->toString();

        if ($typeString !== '') {
            return $typeString;
        }

        // No signature type → try LanguageLevelTypeAware
        $versionAwareType = TypeResolver::resolveVersionAwareType($param, $phpVersion);
        if ($versionAwareType !== null && $versionAwareType !== '') {
            return $versionAwareType;
        }

        return null;
    }

    /**
     * Get the signature type string for a property.
     *
     * Priority:
     * 1. Signature type from getType() — if non-empty (not NoType)
     * 2. LanguageLevelTypeAware — highest version <= $phpVersion, or defaultType
     */
    public function getPropertySigTypeForPhpDoc(PHPProperty $property, string $phpVersion): ?string
    {
        $type = $property->getType();

        if ($type !== null) {
            $typeString = $type->toString();
            if ($typeString !== '') {
                return $typeString;
            }
        }

        // No signature type → try LanguageLevelTypeAware
        $versionAwareType = TypeResolver::resolveVersionAwareType($property, $phpVersion);
        if ($versionAwareType !== null && $versionAwareType !== '') {
            return $versionAwareType;
        }

        return null;
    }

    /**
     * @param string[] $sigParts
     * @param string[] $docParts
     */
    private function isObjectCompatible(array $sigParts, array $docParts): bool
    {
        $hasObjectInSig = in_array('object', $sigParts);
        $hasObjectInDoc = in_array('object', $docParts);

        if (!$hasObjectInSig && !$hasObjectInDoc) {
            return false;
        }

        $hasNonPrimitiveInSig = !empty(array_diff($sigParts, TypeResolver::PRIMITIVES));
        $hasNonPrimitiveInDoc = !empty(array_diff($docParts, TypeResolver::PRIMITIVES));

        if ($hasObjectInSig && ($hasNonPrimitiveInDoc || $hasObjectInDoc)) {
            return true;
        }

        if ($hasObjectInDoc && ($hasNonPrimitiveInSig || $hasObjectInSig)) {
            return true;
        }

        return false;
    }

    /**
     * @param string[] $sigParts
     * @param string[] $docParts
     */
    private function isResourceToClassMigration(array $sigParts, array $docParts): bool
    {
        if (in_array('resource', $docParts)) {
            $sigClasses = array_diff($sigParts, TypeResolver::PRIMITIVES);
            $docClasses = array_diff($docParts, TypeResolver::PRIMITIVES);
            if (!empty($sigClasses) && empty($docClasses)) {
                return true;
            }
        }

        if (in_array('resource', $sigParts)) {
            $docClasses = array_diff($docParts, TypeResolver::PRIMITIVES);
            $sigClasses = array_diff($sigParts, TypeResolver::PRIMITIVES);
            if (!empty($docClasses) && empty($sigClasses)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string[] $sigParts
     * @param string[] $docParts
     */
    private function isShortNameAliasCompatible(array $sigParts, array $docParts): bool
    {
        foreach ($sigParts as $sig) {
            if (!str_contains($sig, '\\')) {
                continue;
            }
            $shortSig = substr($sig, strrpos($sig, '\\') + 1);
            foreach ($docParts as $doc) {
                if ($doc === $shortSig) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param string[] $docParts
     * @param string[] $templateNames
     */
    private function hasTemplateType(array $docParts, array $templateNames): bool
    {
        if (empty($templateNames)) {
            return false;
        }

        foreach ($docParts as $part) {
            $bare = ltrim($part, '\\');
            if (in_array($bare, $templateNames, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string[] $sigParts
     * @param string[] $docParts
     */
    private function isStaticClassCompatible(array $sigParts, array $docParts): bool
    {
        $sigHasStatic = in_array('static', $sigParts);
        $docHasStatic = in_array('static', $docParts);

        if (!$sigHasStatic && !$docHasStatic) {
            return false;
        }

        if ($docHasStatic && !empty(array_diff($sigParts, TypeResolver::PRIMITIVES))) {
            return true;
        }

        if ($sigHasStatic && !empty(array_diff($docParts, TypeResolver::PRIMITIVES))) {
            return true;
        }

        return false;
    }

    /**
     * @param string[] $sigParts
     * @param string[] $docParts
     */
    private function isBothSidesClassTypes(array $sigParts, array $docParts): bool
    {
        return !empty(array_diff($sigParts, TypeResolver::PRIMITIVES))
            && !empty(array_diff($docParts, TypeResolver::PRIMITIVES));
    }

    /**
     * @param string[] $parts
     * @return string[]
     */
    private function expandBool(array $parts): array
    {
        $expanded = [];
        foreach ($parts as $part) {
            $expanded[] = $part;
            if ($part === 'bool') {
                $expanded[] = 'false';
                $expanded[] = 'true';
            }
        }
        return $expanded;
    }
}
