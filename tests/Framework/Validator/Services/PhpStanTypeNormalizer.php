<?php

namespace StubTests\Framework\Validator\Services;

/**
 * Narrows phpstan/psalm type annotations down to the closest built-in PHP type.
 *
 * This is pure lexical rewriting of a type *string* — it knows nothing about entities, signatures,
 * versions or compatibility. It was the largest concern inside PhpDocConformanceService and shares
 * no state with the compatibility relation there: that relation asks "do these two normalised type
 * sets intersect", this asks "what does `non-empty-list<Foo>` mean in plain PHP". Splitting them lets
 * the leaf table grow — and it grows every time a stub picks up a new psalm annotation — without
 * reopening the compatibility algorithm.
 *
 * Every rule here is deliberately *widening*: a phpstan annotation refines a PHP type, it never
 * contradicts one, so collapsing `positive-int` to `int` can only cost a true positive, while
 * collapsing it to something narrower would manufacture false ones.
 */
final class PhpStanTypeNormalizer
{
    /**
     * Maps phpstan/psalm pseudo-type leaves to the closest built-in PHP type.
     *
     * Keys are lowercased leaf tokens (after generics/shapes/`[]` have been stripped).
     * A value may itself be a union (e.g. 'array-key' → 'int|string'); it is substituted
     * verbatim and later flattened/sorted by TypeResolver::normalizeType().
     */
    private const LEAF_MAP = [
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
     * Strip phpstan/psalm-specific syntax, leaving a plain PHP type string.
     *
     * Handles, in order: conditional return types, callable/Closure signatures, the `?T`
     * nullable shorthand, generic brackets `<…>`, array shapes `{…}`, parenthesised element types
     * `(…)[]`, typed-array suffix `[]`, class-constant value types, and finally the leaf-mapping
     * table ({@see self::LEAF_MAP}). If any resulting component is `mixed`, the whole type
     * collapses to `mixed`.
     */
    public static function strip(string $type): string
    {
        $type = trim($type);

        // Conditional return type: ($x is Y ? A : B) → mixed
        if (preg_match('/^\(.*\bis\b.*\?.*:.*\)$/s', $type)) {
            return 'mixed';
        }

        // callable(...): T / Closure(...): T signatures → base keyword (before generic stripping).
        // Tolerates one level of nested parentheses in the parameter list and an optional
        // ": ReturnType". The return type is matched either as a balanced parenthesised group with
        // optional `[]` suffixes or as a plain token: the plain token alone stops at the first `|`,
        // so a grouped return type such as `callable(int): (string|false)[]` left `|false)[]`
        // dangling after the replacement and the stray brace reached the leaf mapper.
        $returnType = '(?:\s*:\s*(?:\([^()]*\)(?:\[])*|[^|&,\s]+))?';
        $type = preg_replace('/\bcallable\s*\((?:[^()]*|\([^()]*\))*\)' . $returnType . '/i', 'callable', $type);
        $type = preg_replace('/\\\\?\bClosure\s*\((?:[^()]*|\([^()]*\))*\)' . $returnType . '/', 'Closure', $type);

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
            $type = preg_replace('/\{[^{}]*}/', '', $type);
        }

        // Parenthesised element type: (string|false)[] → array. Must run before the word-based
        // suffix rule below, which requires word characters immediately before the `[]` and so
        // cannot see a `)` as the array's element type — leaving the parentheses in the output,
        // where the leaf mapper then reads their contents as class names. Iterated so nested
        // forms such as ((int|string)[])[] collapse too. Callable/Closure signatures are already
        // reduced to a bare keyword above, and their parentheses are never `[]`-suffixed anyway,
        // so they cannot be caught here.
        $prev = null;
        while ($prev !== $type) {
            $prev = $type;
            $type = preg_replace('/\([^()]*\)(?:\[])+/', 'array', $type);
        }

        // Typed-array suffix: string[], int[][], \Foo[] → array.
        // The hyphen is in the class so a psalm leaf carries into the match whole: without it
        // `positive-int[]` matched only the `int[]` tail and yielded `positive-array`, which no
        // leaf-map row can then repair and which reads downstream as a class name.
        $type = preg_replace('/[\w\-\\\\]+(?:\[])+/', 'array', $type);

        // Class-constant value types (psalm/phpstan): Foo::BAR, Foo::BAR_*, \Foo\Bar::BAZ_*.
        // These enumerate the values of one or more class constants — a value-level refinement
        // the conformance check cannot evaluate. They refine, never contradict, the declared
        // scalar signature, so collapse them to `mixed` (as value-of/scalar already do).
        $type = preg_replace('/[\w\\\\]+::[A-Za-z_]\w*\*?/', 'mixed', $type);

        // Map remaining phpstan/psalm leaf tokens to the closest built-in type
        $type = preg_replace_callback(
            '/[A-Za-z_\\\\][\w\-\\\\]*/',
            fn (array $m): string => self::LEAF_MAP[strtolower($m[0])] ?? $m[0],
            $type
        );

        // mixed absorbs everything else (tolerate wrapping parens, e.g. psalm's `(mixed)`)
        foreach (preg_split('/[|&]/', $type) as $component) {
            if (trim($component, " \t()") === 'mixed') {
                return 'mixed';
            }
        }

        return trim($type);
    }

    /**
     * Strip phpstan/psalm syntax, then apply the standard type normalisation
     * (union ordering, FQN backslash, `T[]` → array).
     */
    public static function normalize(string $type): string
    {
        return TypeResolver::normalizeType(self::strip($type)) ?? '';
    }
}
