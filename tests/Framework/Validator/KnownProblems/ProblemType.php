<?php

namespace StubTests\Framework\Validator\KnownProblems;

/**
 * Enumeration of known problem types in stubs validation.
 *
 * Each problem type represents a category of validation issues where
 * stubs cannot perfectly match reflection data for legitimate reasons.
 */
enum ProblemType: string
{
    /**
     * Function or method has multiple valid signatures (overloads).
     *
     * PHP supports function overloading where the same function name can
     * accept different parameter signatures. However, PHP's reflection API
     * only returns one "canonical" signature (typically the most recent or
     * most parameter-rich version).
     *
     * Stubs must document all valid signatures for proper IDE support,
     * even though reflection only shows one.
     *
     * Example: dba_fetch($key, $handle) vs dba_fetch($key, $skip, $dba)
     */
    case OVERLOADED_SIGNATURE = 'overloaded_signature';

    /**
     * Stubs intentionally declare an interface, modifier or behaviour that PHP's reflection
     * API does not report for the version under test.
     *
     * This is the general-purpose category for a stub/reflection divergence that is correct
     * on the stub side. It covers three recurring shapes:
     *
     * 1. Implemented at the C level, never exposed. Some internal classes implement
     *    interfaces through the C API without listing them in the declaration reflection
     *    sees. Stubs add the explicit declaration so IDEs can type-check against it.
     *    Example: SimpleXMLElement implements ArrayAccess at the C level; reflection never
     *    reports it, but PhpStorm needs it for array-offset type inference.
     *
     * 2. A modifier that changed across versions. A stub carries one `final`/`static`
     *    declaration for all versions, so it necessarily disagrees with reflection for the
     *    versions before (or after) the change.
     *    Example: GMP became final in 8.4, so the stub disagrees with reflection on 5.6-8.3.
     *
     * 3. A deprecation reflection does not expose. PHP raises some deprecations as a
     *    call-time E_DEPRECATED, or documents them only, without setting the flag
     *    ReflectionMethod::isDeprecated() reads. The stub keeps the marker so the IDE warns.
     *    Example: fgetss() was deprecated in 7.3, but isDeprecated() is false for 7.3-7.4.
     *
     * Shape 3 also absorbs the case where the deprecation window has an upper bound, which
     * StubsMetadata cannot express: it stores only a lower bound (deprecatedSinceVersion).
     */
    case INTERNAL_IMPLEMENTATION = 'internal_implementation';

    /**
     * Stubs cannot use the exact method name because it conflicts with a PHP
     * reserved keyword or language construct.
     *
     * The stub declares the method under a mangled name (PS_UNRESERVE_PREFIX_<name>)
     * so that PhpStorm can still provide IDE support while PHP itself parses the stub
     * file without a syntax error.
     *
     * Examples:
     * - Generator::throw()  → Generator::PS_UNRESERVE_PREFIX_throw()
     * - IntlCalendar::isSet() → IntlCalendar::PS_UNRESERVE_PREFIX_isSet()
     */
    case RESERVED_KEYWORD_CONFLICT = 'reserved_keyword_conflict';

    /**
     * The constant value depends on the runtime environment and therefore
     * cannot be pinned to a single value in the stubs.
     *
     * Examples include:
     * - Library version strings (OpenSSL, libxml, ICU, zlib, libsodium …)
     * - OS-specific numeric constants (POSIX resource limits)
     * - PHP build-configuration paths (PHP_BINARY, PHP_PREFIX, …)
     * - PHP version itself (PHP_VERSION, PHP_MAJOR_VERSION, …)
     *
     * The stub holds a representative / historically-correct value that is
     * likely to differ from the value produced by the current runtime.
     */
    case RUNTIME_VALUE = 'runtime_value';
}
