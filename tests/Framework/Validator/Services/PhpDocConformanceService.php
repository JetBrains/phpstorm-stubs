<?php

namespace StubTests\Framework\Validator\Services;

use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\DocBlock\Tags\Template;
use phpDocumentor\Reflection\DocBlock\Tags\TemplateCovariant;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Validator\Services\ParameterFilterHelper;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Service for PhpDoc-vs-signature conformance checks.
 *
 * Provides the compatibility algorithm and helper methods used by
 * FunctionPhpDocConformsSignatureCheck, ClassMethodsPhpDocConformsSignatureCheck,
 * and their Enum/Interface variants.
 *
 * Extracted from PhpDocConformanceTrait for independent testability.
 */
final class PhpDocConformanceService
{

    /**
     * PHP primitive types — used to distinguish class names from scalar/pseudo types.
     */
    public const PRIMITIVES = [
        'array', 'bool', 'callable', 'false', 'float', 'int', 'iterable',
        'mixed', 'never', 'null', 'object', 'resource', 'self', 'parent',
        'static', 'string', 'true', 'void',
    ];

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
     * @return string[] Template variable names (without any leading backslash)
     */
    public function extractTemplateNames(?string $rawPhpDoc): array
    {
        if ($rawPhpDoc === null || trim($rawPhpDoc) === '') {
            return [];
        }

        try {
            $factory = DocBlockFactory::createInstance();
            $docBlock = $factory->create($rawPhpDoc);
        } catch (\Exception $e) {
            return [];
        }

        $names = [];
        foreach ($docBlock->getTagsByName('template') as $tag) {
            if ($tag instanceof Template) {
                $names[] = $tag->getTemplateName();
            }
        }

        foreach ($docBlock->getTagsByName('template-covariant') as $tag) {
            if ($tag instanceof TemplateCovariant) {
                $typeName = ltrim((string) $tag->getType(), '\\');
                if ($typeName !== '') {
                    $names[] = $typeName;
                }
            }
        }

        return $names;
    }

    /**
     * Normalise a PhpDoc type string.
     *
     * Strips phpstan/psalm annotations first, then applies standard
     * normalizeType() (union ordering, FQN backslash, T[] → array).
     */
    public function normalizeDocType(string $type): string
    {
        $type = $this->stripPhpStanGenerics($type);
        return TypeResolver::normalizeType($type) ?? '';
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
     * Filter parameters by version availability and deduplicate same-named variadic pairs.
     *
     * @param PHPParameter[] $params
     * @return PHPParameter[]
     */
    public function filterAndDeduplicateParamsPhpDoc(array $params, string $phpVersion): array
    {
        return ParameterFilterHelper::filterAndDeduplicate($params, $phpVersion);
    }

    /**
     * Maps phpstan/psalm pseudo-type leaves to the closest built-in PHP type.
     *
     * Keys are lowercased leaf tokens (after generics/shapes/`[]` have been stripped).
     * A value may itself be a union (e.g. 'array-key' → 'int|string'); it is substituted
     * verbatim and later flattened/sorted by TypeResolver::normalizeType().
     */
    private const PHPSTAN_LEAF_MAP = [
        // array-like
        'array' => 'array',
        'non-empty-array' => 'array',
        'list' => 'array',
        'non-empty-list' => 'array',
        // iterable
        'iterable' => 'iterable',
        // string family
        'numeric-string' => 'string',
        'non-empty-string' => 'string',
        'non-falsy-string' => 'string',
        'truthy-string' => 'string',
        'literal-string' => 'string',
        'lowercase-string' => 'string',
        'class-string' => 'string',
        'callable-string' => 'string',
        'trait-string' => 'string',
        'interned-string' => 'string',
        'html-escaped-string' => 'string',
        'enum-string' => 'string',
        // int family
        'positive-int' => 'int',
        'negative-int' => 'int',
        'non-positive-int' => 'int',
        'non-negative-int' => 'int',
        'int-mask' => 'int',
        'int-mask-of' => 'int',
        // key/value helpers
        'array-key' => 'int|string',
        'key-of' => 'int|string',
        'value-of' => 'mixed',
        'scalar' => 'mixed',
        // callables
        'pure-callable' => 'callable',
        'pure-closure' => '\\Closure',
    ];

    /**
     * Narrow phpstan/psalm-specific type annotations down to the closest built-in PHP type.
     *
     * Handles, in order: conditional return types, callable/Closure signatures, the `?T`
     * nullable shorthand, generic brackets `<…>`, array shapes `{…}`, typed-array suffix `[]`,
     * and finally an explicit leaf-mapping table (see {@see self::PHPSTAN_LEAF_MAP}). If any
     * resulting component is `mixed`, the whole type collapses to `mixed`.
     */
    private function stripPhpStanGenerics(string $type): string
    {
        $type = trim($type);

        // Conditional return type: ($x is Y ? A : B) → mixed
        if (preg_match('/^\(.*\bis\b.*\?.*:.*\)$/s', $type)) {
            return 'mixed';
        }

        // callable(...): T / Closure(...): T signatures → base keyword (before generic stripping).
        // Tolerates one level of nested parentheses and an optional ": ReturnType".
        $type = preg_replace('/\bcallable\s*\((?:[^()]*|\([^()]*\))*\)(\s*:\s*[^|&,\s]+)?/i', 'callable', $type);
        $type = preg_replace('/\\\\?\bClosure\s*\((?:[^()]*|\([^()]*\))*\)(\s*:\s*[^|&,\s]+)?/', 'Closure', $type);

        // ?T → T|null (PHP nullable shorthand sometimes used in PhpDoc)
        if (str_starts_with($type, '?') && !str_contains($type, '|')) {
            $type = substr($type, 1) . '|null';
        }

        // Strip generics <...> iteratively to handle nesting
        $prev = null;
        while ($prev !== $type) {
            $prev = $type;
            $type = preg_replace('/<[^<>]*>/', '', $type);
        }

        // Strip array shapes {...} iteratively to handle nesting
        $prev = null;
        while ($prev !== $type) {
            $prev = $type;
            $type = preg_replace('/\{[^{}]*\}/', '', $type);
        }

        // Typed-array suffix: string[], int[][], \Foo[] → array
        $type = preg_replace('/[\w\\\\]+(?:\[\])+/', 'array', $type);

        // Map remaining phpstan/psalm leaf tokens to the closest built-in type
        $type = preg_replace_callback(
            '/[A-Za-z_\\\\][\w\-\\\\]*/',
            fn(array $m): string => self::PHPSTAN_LEAF_MAP[strtolower($m[0])] ?? $m[0],
            $type
        );

        // mixed absorbs everything else
        foreach (preg_split('/[|&]/', $type) as $component) {
            if (trim($component) === 'mixed') {
                return 'mixed';
            }
        }

        return trim($type);
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

        $hasNonPrimitiveInSig = !empty(array_diff($sigParts, self::PRIMITIVES));
        $hasNonPrimitiveInDoc = !empty(array_diff($docParts, self::PRIMITIVES));

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
            $sigClasses = array_diff($sigParts, self::PRIMITIVES);
            $docClasses = array_diff($docParts, self::PRIMITIVES);
            if (!empty($sigClasses) && empty($docClasses)) {
                return true;
            }
        }

        if (in_array('resource', $sigParts)) {
            $docClasses = array_diff($docParts, self::PRIMITIVES);
            $sigClasses = array_diff($sigParts, self::PRIMITIVES);
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

        if ($docHasStatic && !empty(array_diff($sigParts, self::PRIMITIVES))) {
            return true;
        }

        if ($sigHasStatic && !empty(array_diff($docParts, self::PRIMITIVES))) {
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
        return !empty(array_diff($sigParts, self::PRIMITIVES))
            && !empty(array_diff($docParts, self::PRIMITIVES));
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
