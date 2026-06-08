<?php

namespace StubTests\Framework\Parsers\Stubs;

/**
 * Process-wide registry of constant values defined in the stub sources.
 *
 * The stub parameter default-value evaluator (NikicParameterNode) resolves
 * ConstFetch / ClassConstFetch defaults against the running PHP runtime via
 * defined()/constant(). That only works when the extension defining the
 * constant happens to be loaded in the process that generates the cache;
 * otherwise the default silently degrades to null — e.g.
 * IntlBreakIterator::getPartsIterator()'s `$type = IntlPartsIterator::KEY_SEQUENTIAL`
 * is cached as null instead of 0 when ext-intl is absent.
 *
 * This registry is populated from the parsed stub constants themselves while
 * the stubs are parsed, so the evaluator can fall back to a deterministic,
 * environment-independent value when the runtime lookup fails. It is purely
 * additive: the runtime is always consulted first, and the registry is only
 * used when the runtime cannot resolve the constant.
 */
final class StubConstantRegistry
{
    /** @var array<string, mixed> normalized FQN ("\Class::CONST" or "\CONST") => value */
    private static array $values = [];

    /**
     * Register a constant value under its fully qualified name.
     *
     * null values are ignored: they carry no information the evaluator could
     * not already produce on its own, and storing them would mask the
     * "unresolved" state the caller relies on.
     */
    public static function register(string $fqn, mixed $value): void
    {
        if ($value === null) {
            return;
        }
        self::$values[self::normalize($fqn)] = $value;
    }

    public static function has(string $fqn): bool
    {
        return array_key_exists(self::normalize($fqn), self::$values);
    }

    public static function get(string $fqn): mixed
    {
        return self::$values[self::normalize($fqn)] ?? null;
    }

    /**
     * Reset the registry. Intended for test isolation.
     */
    public static function clear(): void
    {
        self::$values = [];
    }

    /**
     * Normalize a constant FQN to a single leading backslash so that the form
     * written in stubs ("IntlPartsIterator::KEY_SEQUENTIAL") and the form built
     * from a parsed entity id ("\IntlPartsIterator::KEY_SEQUENTIAL") collide.
     */
    private static function normalize(string $fqn): string
    {
        return '\\' . ltrim($fqn, '\\');
    }
}
