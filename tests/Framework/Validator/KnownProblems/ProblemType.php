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
     * Stubs intentionally declare an interface or behaviour that is implemented
     * internally (at the C level) but not exposed by PHP's reflection API.
     *
     * Some internal classes implement interfaces through the C API without
     * listing them in the class declaration visible to reflection.  Stubs add
     * the explicit declaration so that IDEs (e.g. PhpStorm) can provide correct
     * type-checking and code-completion.
     *
     * Example: SimpleXMLElement implements ArrayAccess at the C level;
     * reflection never reports ArrayAccess, but PhpStorm requires the explicit
     * declaration to enable array-offset type inference.
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
