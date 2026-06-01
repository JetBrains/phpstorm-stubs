<?php

namespace StubTests\Framework\Parsers\Stubs\PhpDoc;

/**
 * Normalizes generic template parameters in PhpDoc type strings.
 *
 * phpDocumentor resolves any bare identifier in a type as a class name and prepends the
 * namespace separator, so a template parameter such as `TValue` is stored as the fully
 * qualified `\TValue` — which is wrong: it is a template name, not a class. This helper
 * extracts the template names declared via `@template` (and its variance forms) and strips
 * that spurious leading backslash back off, leaving the bare template name.
 */
final class TemplateTypeNormalizer
{
    /**
     * Extract the names declared by `@template`, `@template-covariant` and
     * `@template-contravariant` tags in a raw docblock.
     *
     * @return string[] Template parameter names (e.g. ['TKey', 'TValue'])
     */
    public static function extractTemplateNames(?string $rawPhpDoc): array
    {
        if ($rawPhpDoc === null || $rawPhpDoc === '') {
            return [];
        }

        if (!preg_match_all('/@template(?:-covariant|-contravariant)?\s+([A-Za-z_]\w*)/', $rawPhpDoc, $matches)) {
            return [];
        }

        return array_values(array_unique($matches[1]));
    }

    /**
     * Strip the fully qualified leading backslash that phpDocumentor adds to template names,
     * e.g. `iterable<\TValue>` → `iterable<TValue>`, `\Map<\TKey, \TValue>` → `\Map<TKey, TValue>`.
     *
     * Only the listed template names are affected; real (possibly namespaced) class names such
     * as `\Map` or `\Foo\TValue` are left untouched thanks to the word-boundary guards.
     *
     * @param string[] $templateNames
     */
    public static function unqualify(?string $type, array $templateNames): ?string
    {
        if ($type === null || $type === '' || $templateNames === []) {
            return $type;
        }

        foreach ($templateNames as $name) {
            // (?<!\w) ensures we only strip a root backslash, never the separator inside a
            // namespaced name like \Foo\TValue; \b ensures TValue does not match inside TValue2.
            $type = preg_replace('/(?<!\w)\\\\' . preg_quote($name, '/') . '\b/', $name, $type);
        }

        return $type;
    }
}
