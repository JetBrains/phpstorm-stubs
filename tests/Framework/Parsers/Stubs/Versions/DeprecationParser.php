<?php

namespace StubTests\Framework\Parsers\Stubs\Versions;

use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\PhpDoc\ParsedPhpDoc;
use StubTests\Framework\Runner\PhpVersions;

/**
 * Extracts deprecation state — the flag and the PHP version it starts at — from a stub element.
 *
 * Two distinct attributes mark deprecation in the stubs, and their positional arguments differ:
 * - `JetBrains\PhpStorm\Deprecated($reason, $replacement, $since)` — `since` is argument 2.
 * - the built-in `\Deprecated(?string $message, ?string $since)` (PHP 8.4+) — `since` is argument 1.
 * The named `since:` form is what the stubs overwhelmingly use, but positional args are read too,
 * per flavour, so a positional `since` is never mistaken for a replacement or a message.
 *
 * Precedence mirrors {@see DefaultAvailableVersionParser}: an attribute overrides the PhpDoc tag.
 */
class DeprecationParser
{
    private const FLAVOUR_JETBRAINS = 'jetbrains';
    private const FLAVOUR_BUILTIN = 'builtin';

    /**
     * Position of the `since` argument when it is passed positionally, per attribute flavour.
     */
    private const SINCE_POSITION = [
        self::FLAVOUR_JETBRAINS => 2,
        self::FLAVOUR_BUILTIN => 1,
    ];

    /**
     * @param array $attributes Array of AttributeNode objects
     * @param array $imports Map of import aliases to fully qualified names
     * @param ParsedPhpDoc|null $phpDoc Already-parsed PhpDoc, contributing `@_deprecated [version]`
     */
    public function parseDeprecation(array $attributes, array $imports = [], ?ParsedPhpDoc $phpDoc = null): ParsedDeprecation
    {
        $isDeprecated = $phpDoc?->isDeprecated ?? false;
        $sinceVersion = $phpDoc?->deprecatedSinceVersion;

        foreach ($attributes as $attribute) {
            if (!$attribute instanceof AttributeNode) {
                continue;
            }

            $name = $attribute->getName();
            $flavour = $this->deprecationFlavour($imports[$name] ?? $name);
            if ($flavour === null) {
                continue;
            }

            $isDeprecated = true;

            $attributeSince = $this->extractSince($attribute->getArguments(), $flavour);
            if ($attributeSince !== null) {
                $sinceVersion = $attributeSince;
            }

            break; // Only the first deprecation attribute is meaningful
        }

        return new ParsedDeprecation($isDeprecated, $isDeprecated ? $sinceVersion : null);
    }

    /**
     * Classify a resolved attribute name as one of the two deprecation attributes, or null
     * when it is not a deprecation marker at all.
     */
    private function deprecationFlavour(string $fullName): ?string
    {
        if ($fullName === 'JetBrains\\PhpStorm\\Deprecated' || str_ends_with($fullName, '\\PhpStorm\\Deprecated')) {
            return self::FLAVOUR_JETBRAINS;
        }

        // No import mapped the name, so it resolves against the global namespace: the built-in
        // #[\Deprecated] introduced in PHP 8.4.
        if ($fullName === 'Deprecated' || $fullName === '\\Deprecated') {
            return self::FLAVOUR_BUILTIN;
        }

        return null;
    }

    /**
     * @param array $arguments Attribute arguments keyed by name, or by position when unnamed
     */
    private function extractSince(array $arguments, string $flavour): ?string
    {
        $since = $arguments['since'] ?? $arguments[self::SINCE_POSITION[$flavour]] ?? null;

        // Also rejects null, which is_scalar() reports as false.
        if (!is_scalar($since)) {
            return null;
        }

        $since = trim((string)$since);

        return $since === '' ? null : $since;
    }

    /**
     * Is `$version` one of the PHP versions this suite validates?
     *
     * Used to filter the `@_deprecated` PhpDoc tag, whose leading token is a PHP version on some
     * entries (`@_deprecated 7.1`) but a library version on others (`@_deprecated 2.3.0 use ...`,
     * for PECL extensions that version independently of PHP). Only recognised PHP versions are
     * accepted, so a library version is never read as a language level. A patch component is
     * tolerated — `@_deprecated 7.0.7` narrows to 7.0 — because deprecation is tracked per minor.
     */
    public static function normalizePhpVersion(string $version): ?string
    {
        if (!preg_match('/^(\d+\.\d+)(?:\.\d+)?$/', $version, $matches)) {
            return null;
        }

        return PhpVersions::tryFrom($matches[1])?->value;
    }
}
