<?php

namespace StubTests\Framework\Validator\KnownProblems;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

/**
 * Default implementation of KnownProblemsProvider.
 *
 * Defines all known validation problems for PHP stubs.
 * Problems are defined as type-safe PHP objects with compile-time validation.
 */
class DefaultKnownProblemsProvider implements KnownProblemsProvider
{
    /** @var ProblemDefinition[]|null Cached problems */
    private ?array $problems = null;

    /**
     * @inheritDoc
     */
    public function getProblems(): array
    {
        if ($this->problems !== null) {
            return $this->problems;
        }

        $this->problems = [
            // DBA extension - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\dba_fetch',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'dba_fetch has 2 overloaded signatures: dba_fetch($key, $handle) (2 params) and dba_fetch($key, $skip, $dba) (3 params, deprecated in 8.3). Reflection only returns one signature.'
            ),
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\dba_open',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'dba_open has 2 overloaded signatures with different parameter counts'
            ),
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\dba_popen',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'dba_popen has 2 overloaded signatures with different parameter counts'
            ),

            // String functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\strtr',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'strtr has 2 overloaded signatures: strtr($string, $from, $to) (3 params) and strtr($str, $replace_pairs) (2 params with array). Reflection returns only one.'
            ),

            // Session functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\session_set_save_handler',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'session_set_save_handler has 2 overloaded signatures: one with 9 callable parameters, one with SessionHandlerInterface object (2 params)'
            ),
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\session_set_cookie_params',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'session_set_cookie_params has 2 overloaded signatures with different parameter structures'
            ),

            // Cookie functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\setcookie',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'setcookie has 2 overloaded signatures: multiple scalar params vs array options param'
            ),
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\setrawcookie',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'setrawcookie has 2 overloaded signatures: multiple scalar params vs array options param'
            ),

            // GD functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\imagefilledpolygon',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'imagefilledpolygon has 2 overloaded signatures with different parameter structures'
            ),

            // Stream functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\stream_context_set_option',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'stream_context_set_option has 2 overloaded signatures: array param vs individual scalar params'
            ),

            // Multibyte string functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\mb_parse_str',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'mb_parse_str has 2 overloaded signatures with different parameter structures'
            ),

            // CUBRID database functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\cubrid_execute',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'cubrid_execute has 2 overloaded signatures with different parameter structures'
            ),

            // Standard functions - overloaded signatures
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\crypt',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'crypt has 2 overloaded signatures with different parameter structures'
            ),

            // SimpleXMLElement - ArrayAccess implemented at C level, not visible to reflection
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\SimpleXMLElement',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'SimpleXMLElement implements ArrayAccess at the C level without declaring it via `implements`. PHP reflection never reports ArrayAccess, but the stub adds it explicitly so PhpStorm can perform array-offset type inference on SimpleXMLElement instances.'
            ),

            // SplFileInfo - Stringable added in PHP 8.0; stubs already declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\SplFileInfo',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'SplFileInfo gained Stringable in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare Stringable for all versions. Reflection for PHP 5.6–7.4 does not report Stringable.'
            ),

            // SplObjectStorage - SeekableIterator added in PHP 8.4; stubs already declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\SplObjectStorage',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_8_3),
                reason: 'SplObjectStorage gained SeekableIterator in PHP 8.4. PhpStorm cannot express per-version interface declarations, so stubs declare SeekableIterator for all versions. Reflection for PHP 5.6–8.3 does not report SeekableIterator.'
            ),

            // Exception - Throwable did not exist in PHP 5.6; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\Exception',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_5_6),
                reason: 'Throwable was introduced in PHP 7.0. Stubs declare Exception implements Throwable for all versions, but PHP 5.6 reflection does not report it.'
            ),

            // GMP - Serializable implemented internally, never visible to reflection
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\GMP',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'GMP implements Serializable at the C level. PHP reflection never reports Serializable for GMP across any version, but stubs declare it explicitly for serialization support in PhpStorm.'
            ),

            // ReflectionType - Stringable added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\ReflectionType',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::PHP_7_0, PhpVersions::PHP_7_4),
                reason: 'ReflectionType gained Stringable in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare Stringable for all versions. Reflection for PHP 7.0–7.4 does not report Stringable.'
            ),

            // ReflectionAttribute - Reflector added in PHP 8.1; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\ReflectionAttribute',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::PHP_8_0),
                reason: 'ReflectionAttribute gained Reflector in PHP 8.1. PhpStorm cannot express per-version interface declarations, so stubs declare Reflector for all versions. Reflection for PHP 8.0 does not report Reflector.'
            ),

            // DatePeriod - IteratorAggregate added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DatePeriod',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DatePeriod gained IteratorAggregate in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare IteratorAggregate for all versions. Reflection for PHP 5.6–7.4 does not report IteratorAggregate.'
            ),

            // IntlBreakIterator - IteratorAggregate added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\IntlBreakIterator',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'IntlBreakIterator gained IteratorAggregate in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare IteratorAggregate for all versions. Reflection for PHP 5.6–7.4 does not report IteratorAggregate.'
            ),

            // PDOStatement - IteratorAggregate added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\PDOStatement',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'PDOStatement gained IteratorAggregate in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare IteratorAggregate for all versions. Reflection for PHP 5.6–7.4 does not report IteratorAggregate.'
            ),

            // mysqli_result - IteratorAggregate added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\mysqli_result',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'mysqli_result gained IteratorAggregate in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare IteratorAggregate for all versions. Reflection for PHP 5.6–7.4 does not report IteratorAggregate.'
            ),

            // CachingIterator - Stringable added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\CachingIterator',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'CachingIterator gained Stringable in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare Stringable for all versions. Reflection for PHP 5.6–7.4 does not report Stringable.'
            ),

            // SimpleXMLIterator - Stringable added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\SimpleXMLIterator',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'SimpleXMLIterator gained Stringable in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare Stringable for all versions. Reflection for PHP 5.6–7.4 does not report Stringable.'
            ),

            // DOMCharacterData - DOMChildNode added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DOMCharacterData',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMCharacterData gained DOMChildNode in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare DOMChildNode for all versions. Reflection for PHP 5.6–7.4 does not report DOMChildNode.'
            ),

            // DOMDocumentFragment - DOMParentNode added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DOMDocumentFragment',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMDocumentFragment gained DOMParentNode in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare DOMParentNode for all versions. Reflection for PHP 5.6–7.4 does not report DOMParentNode.'
            ),

            // DOMDocument - DOMParentNode added in PHP 8.0; stubs declare it for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DOMDocument',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMDocument gained DOMParentNode in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare DOMParentNode for all versions. Reflection for PHP 5.6–7.4 does not report DOMParentNode.'
            ),

            // DOMElement - DOMChildNode and DOMParentNode added in PHP 8.0; stubs declare them for all versions
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DOMElement',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMElement gained DOMChildNode and DOMParentNode in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare both for all versions. Reflection for PHP 5.6–7.4 does not report them.'
            ),

            // DOMNamedNodeMap - Countable added in PHP 7.2, IteratorAggregate added in PHP 8.0
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DOMNamedNodeMap',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMNamedNodeMap gained Countable in PHP 7.2 and IteratorAggregate in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare both for all versions. Reflection for PHP 5.6–7.1 does not report Countable; reflection for PHP 5.6–7.4 does not report IteratorAggregate.'
            ),

            // DOMNodeList - Countable added in PHP 7.2, IteratorAggregate added in PHP 8.0
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DOMNodeList',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMNodeList gained Countable in PHP 7.2 and IteratorAggregate in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare both for all versions. Reflection for PHP 5.6–7.1 does not report Countable; reflection for PHP 5.6–7.4 does not report IteratorAggregate.'
            ),

            // ResourceBundle - Countable added in PHP 7.4, IteratorAggregate added in PHP 8.0
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\ResourceBundle',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'ResourceBundle gained Countable in PHP 7.4 and IteratorAggregate in PHP 8.0. PhpStorm cannot express per-version interface declarations, so stubs declare both for all versions. Reflection for PHP 5.6–7.3 does not report Countable; reflection for PHP 5.6–7.4 does not report IteratorAggregate.'
            ),

            // SimpleXMLElement::__construct - final at C level in PHP 5.6–7.4; changed in PHP 8.0
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\SimpleXMLElement::__construct',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'SimpleXMLElement::__construct was marked final at the C level in PHP 5.6–7.4. This was changed in PHP 8.0. The stub declares the constructor without final (matching PHP 8.0+ behaviour), but reflection for PHP 5.6–7.4 reports isFinal=true.'
            ),

            // SimpleXMLIterator::__construct - inherits SimpleXMLElement::__construct which was final at C level in PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\SimpleXMLIterator::__construct',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'SimpleXMLIterator extends SimpleXMLElement and inherits __construct. Since SimpleXMLElement::__construct was marked final at the C level in PHP 5.6–7.4, reflection reports isFinal=true for the inherited constructor on SimpleXMLIterator as well. This was changed in PHP 8.0. The stub declares the constructor without final (matching PHP 8.0+ behaviour).'
            ),

            // XMLReader::open - became truly static in PHP 8.0; stubs declare it static for all versions
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\XMLReader::open',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'XMLReader::open was a non-static instance method in PHP 5.6–7.4 (though callable statically with a deprecation notice). It was made officially static in PHP 8.0. The stub declares it static to match the PHP 8.0+ signature; reflection for PHP 5.6–7.4 reports isStatic=false.'
            ),

            // XMLReader::XML - became truly static in PHP 8.0; stubs declare it static for all versions
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\XMLReader::XML',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_STATIC_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'XMLReader::XML was a non-static instance method in PHP 5.6–7.4 (though callable statically with a deprecation notice). It was made officially static in PHP 8.0. The stub declares it static to match the PHP 8.0+ signature; reflection for PHP 5.6–7.4 reports isStatic=false.'
            ),

            // SplFixedArray - interfaces changed across PHP versions; stubs declare the union
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\SplFixedArray',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'SplFixedArray interface list changed across PHP versions: Iterator (5.6–7.4) was replaced by IteratorAggregate (8.0+), and JsonSerializable was added in 8.1. PhpStorm cannot express per-version interface declarations, so stubs declare the union of all interfaces. Each individual PHP version\'s reflection only reports the subset current for that version.'
            ),

            // SoapClient - internal C-level implementation properties not declared in stubs
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\SoapClient',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::LATEST),
                reason: 'SoapClient exposes numerous private C-level implementation properties (e.g. $sdl, $typemap, $_encoding, $httpsocket) that became visible via reflection in PHP 8.1 after an internal refactoring. These are undocumented implementation details not intended for user access and are not declared in stubs.'
            ),

            // SoapServer - internal C-level implementation properties not declared in stubs
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\SoapServer',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::LATEST),
                reason: 'SoapServer exposes internal C-level implementation properties ($service, $__soap_fault) that became visible via reflection in PHP 8.1 after an internal refactoring. These are undocumented implementation details not intended for user access and are not declared in stubs.'
            ),

            // ── ClassMethodsParametersCountCheck known problems ───────────────────────

            // Closure::__invoke - reflection reports the concrete closure signature (0 params for the generic stub)
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\Closure::__invoke',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::PHP_7_2, PhpVersions::LATEST),
                reason: 'Closure::__invoke reflects the actual closure signature. PHP reflection returns 0 parameters for a generic Closure, but the stub declares 1 placeholder parameter for IDE support.'
            ),

            // DateTime::__set_state - reflection reports 0 params in PHP 5.6–7.2; PHP 7.3+ fixed
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DateTime::__set_state',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_2),
                reason: 'DateTime::__set_state is documented with 1 parameter ($array), but reflection in PHP 5.6–7.2 reports 0 parameters. PHP 7.3 corrected the reflection metadata.'
            ),

            // DateTimeImmutable::__set_state - same issue
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DateTimeImmutable::__set_state',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_2),
                reason: 'DateTimeImmutable::__set_state is documented with 1 parameter ($array), but reflection in PHP 5.6–7.2 reports 0 parameters. PHP 7.3 corrected the reflection metadata.'
            ),

            // DateTimeZone::__set_state - same issue
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DateTimeZone::__set_state',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_2),
                reason: 'DateTimeZone::__set_state is documented with 1 parameter ($array), but reflection in PHP 5.6–7.2 reports 0 parameters. PHP 7.3 corrected the reflection metadata.'
            ),

            // DateInterval::__set_state - same issue
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DateInterval::__set_state',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_2),
                reason: 'DateInterval::__set_state is documented with 1 parameter ($array), but reflection in PHP 5.6–7.2 reports 0 parameters. PHP 7.3 corrected the reflection metadata.'
            ),

            // DatePeriod::__construct - overloaded signature (DatePeriod accepts multiple constructor forms)
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DatePeriod::__construct',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DatePeriod::__construct has multiple overloaded forms. Stubs document all parameters across all overloads (4 params), but reflection for PHP 5.6–7.4 returns only 3 parameters.'
            ),

            // DOMImplementation::hasFeature - deprecated no-op; reflection reports 0 params in older PHP
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DOMImplementation::hasFeature',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMImplementation::hasFeature is a deprecated no-op. Reflection in PHP 5.6–7.4 reports 0 parameters, but the stub correctly declares 2 parameters ($feature, $version) per the DOM specification.'
            ),

            // DOMDocument::save - optional $options parameter not reported by reflection in PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DOMDocument::save',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMDocument::save has an optional $options parameter that was not exposed by reflection in PHP 5.6–7.4. The stub declares both $filename and $options (2 params), but reflection reports only 1.'
            ),

            // DOMDocument::saveHTML - optional $node parameter not reported by reflection in PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DOMDocument::saveHTML',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMDocument::saveHTML has an optional $node parameter that was not exposed by reflection in PHP 5.6–7.4. The stub declares 1 parameter, but reflection reports 0.'
            ),

            // DOMDocument::schemaValidate - optional $flags parameter not in reflection for PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DOMDocument::schemaValidate',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMDocument::schemaValidate has an optional $flags parameter not reported by reflection in PHP 5.6–7.4. Stubs declare 2 params, reflection reports 1.'
            ),

            // DOMDocument::schemaValidateSource - optional $flags parameter not in reflection for PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DOMDocument::schemaValidateSource',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMDocument::schemaValidateSource has an optional $flags parameter not reported by reflection in PHP 5.6–7.4. Stubs declare 2 params, reflection reports 1.'
            ),

            // DOMXPath::registerPhpFunctions - optional $restrict parameter not in reflection for PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DOMXPath::registerPhpFunctions',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'DOMXPath::registerPhpFunctions has an optional $restrict parameter not reported by reflection in PHP 5.6–7.4. Stubs declare 1 parameter, reflection reports 0.'
            ),

            // ArrayObject::__construct - reflection in PHP 5.6 reports only 1 param; stub has 3
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\ArrayObject::__construct',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_5_6),
                reason: 'ArrayObject::__construct reflection in PHP 5.6 reports only 1 parameter, but the stub declares 3 ($array, $flags, $iteratorClass). PHP 7.0+ reflection correctly reports all 3.'
            ),

            // SplHeap::compare - abstract method; reflection in PHP 5.6–7.4 reports 0 params
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\SplHeap::compare',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'SplHeap::compare is an abstract method. Reflection in PHP 5.6–7.4 reports 0 parameters, but the stub declares 2 ($value1, $value2) matching the intended override contract.'
            ),

            // PDO::query - overloaded signature; reflection reports fewer params in PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\PDO::query',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'PDO::query has multiple overloaded forms with different parameter counts. Reflection in PHP 5.6–7.4 reports fewer parameters than the stub, which documents all forms.'
            ),

            // XMLWriter::writeDtdEntity - reflection reports 2 params in PHP 5.6–7.4; stub has 6
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\XMLWriter::writeDtdEntity',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'XMLWriter::writeDtdEntity reflection in PHP 5.6–7.4 reports only 2 parameters, but the stub declares 6 ($name, $content, $pe, $pubid, $sysid, $ndataid) per the XML spec. PHP 8.0+ reflection correctly reports all 6.'
            ),

            // mysqli_stmt::__construct - reflection reports 0 params in PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\mysqli_stmt::__construct',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'mysqli_stmt::__construct reflection in PHP 5.6–7.4 reports 0 parameters, but the stub declares 2 ($mysql, $query). PHP 8.0+ reflection correctly reports them.'
            ),

            // mysqli_stmt::bind_param - variadic; reflection reports 2 params, stub has 3 (types + vars + variadic)
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\mysqli_stmt::bind_param',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'mysqli_stmt::bind_param is variadic. Reflection reports 2 parameters ($types + variadic &$var), but the stub declares 3 ($types, $var1, &...$vars) to document the required first variable explicitly for IDE support.'
            ),

            // mysqli_stmt::bind_result - variadic; reflection reports 1 param, stub has 2
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\mysqli_stmt::bind_result',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'mysqli_stmt::bind_result is variadic. Reflection reports 1 parameter (variadic &$var), but the stub declares 2 ($var1, &...$vars) to document the required first variable explicitly for IDE support.'
            ),

            // SoapFault::__construct - reflection reports fewer params in PHP 5.6–7.4
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\SoapFault::__construct',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'SoapFault::__construct reflection in PHP 5.6–7.4 reports fewer parameters than the stub. The stub documents the full constructor signature including optional parameters not exposed by older reflection.'
            ),

            // ── FunctionParametersCountCheck known problems ───────────────────────

            // dba_fetch - overloaded signature; reflection returns 3-param form, stub selects 2-param form
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\dba_fetch',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'dba_fetch has 2 overloaded signatures: dba_fetch($key, $handle) (2 params) and dba_fetch($key, $skip, $dba) (3 params, deprecated in 8.3). Reflection returns the 3-param form, but the stub selects the 2-param form.'
            ),

            // session_set_cookie_params - PHP 7.3+ reflection returns 5-param legacy form
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\session_set_cookie_params',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::PHP_7_3, PhpVersions::LATEST),
                reason: 'session_set_cookie_params has two overloaded forms: a 1-param array form (PHP 7.3+) and a 5-param scalar form. PHP 7.3+ reflection returns 5 parameters (legacy form), but the stub selects the 1-param array variant.'
            ),

            // session_set_save_handler - 9-param stub form has 2 extra params not present in PHP 5.6
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\session_set_save_handler',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::PARAMETERS_COUNT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_5_6),
                reason: 'session_set_save_handler stub declares 9 callable parameters including validate_sid and update_timestamp added in PHP 7.0. Reflection in PHP 5.6 reports only 7 parameters.'
            ),

            // ── FunctionOptionalParametersCheck known problems ────────────────────────

            // strtr - overloaded signature; $to is optional in the 2-arg form strtr($str, $pairs)
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\strtr',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'strtr has 2 overloaded signatures. In the 2-arg form strtr($str, $pairs_map), $to is absent; reflection reports $to as optional. Stubs cannot mark $to optional in the 3-arg overload without incorrectly allowing strtr($str, $from).'
            ),

            // crypt - $salt was optional in PHP 5.6-7.4 (deprecated auto-generation)
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\crypt',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'In PHP 5.6-7.4, crypt() could be called without $salt (deprecated auto-generation). Reflection marks $salt as optional. The stub requires $salt to discourage the deprecated usage.'
            ),

            // dba_fetch - overloaded signature; reflection reports $handle/$dba as optional
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\dba_fetch',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'dba_fetch has 2 overloaded signatures. Reflection marks the handle/dba parameter as optional because the function can accept either 2 or 3 args. Stubs cannot express this without marking the handle optional in the 2-arg overload.'
            ),

            // session_set_save_handler - 9-param overload; reflection marks params 2-9 as optional
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\session_set_save_handler',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'session_set_save_handler has 2 overloaded signatures. Reflection reports most callable parameters as optional (since the 2-arg SessionHandlerInterface form omits them), but the 9-arg callable form requires them.'
            ),

            // imagefilledpolygon - PHP 8.0 changed parameter order; reflection marks $color as optional
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\imagefilledpolygon',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'imagefilledpolygon has 2 overloaded signatures in PHP 8.0+ (3-arg and 4-arg forms). Reflection marks $color as optional because the function can be called with 3 args. Stubs use separate version-specific definitions that cannot mark $color optional without breaking the 4-arg overload.'
            ),

            // stream_context_set_option - overloaded signature; reflection marks $option_name/$value as optional
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\stream_context_set_option',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_7_4, PhpVersions::LATEST),
                reason: 'stream_context_set_option has 2 overloaded signatures: array-options form and individual scalar params form. Reflection marks $option_name and $value as optional since the function can be called with 2 args (context + options array). Stubs cannot express this without marking them optional in the 4-arg overload.'
            ),

            // implode - PHP 8.0+ $array is optional in the 1-arg BC form implode($array)
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\implode',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'implode() accepts both implode($separator, $array) and the BC form implode($array). Reflection marks $array as optional. The stub uses array|string $separator to model both forms but cannot mark $array as truly optional without allowing a zero-argument call.'
            ),

            // join - alias of implode; same known problem
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\join',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'join() is an alias of implode(). Same known problem: $array is optional in the 1-arg BC form, but the stub cannot express this without allowing a zero-argument call.'
            ),

            // hash_update_file - PHP 5.6-7.0 named the 3rd param "context" (same as 1st stub param); false-positive
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\hash_update_file',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_0),
                reason: 'In PHP 5.6-7.0, the 3rd parameter of hash_update_file() was named "context" in reflection, colliding with the 1st stub param name "context" (HashContext). The optional-parameters check incorrectly matches the required 1st stub param against the optional 3rd reflection param.'
            ),

            // ── ClassMethodsOptionalParametersCheck known problems ───────────────────

            // SoapFault::__construct - PHP 5.6-7.4 reflection marks $code as optional (C-extension quirk)
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\SoapFault::__construct',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'SoapFault::__construct in PHP 5.6-7.4: reflection marks $code as optional due to C-extension implementation detail. The parameter is required in the public API.'
            ),

            // DOMNamedNodeMap::item - PHP 7.1-7.4 reflection marks $index as optional (C-extension keeps default = 0)
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DOMNamedNodeMap::item',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_7_1, PhpVersions::PHP_7_4),
                reason: 'DOMNamedNodeMap::item in PHP 7.1-7.4: reflection marks $index as optional (default = 0 retained in C implementation). The stub intentionally requires $index for PHP 7.1+ to enforce correct usage.'
            ),

            // DatePeriod::__construct - PHP 8.0+ reflection marks $interval and $end as optional (overloaded constructor)
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\\DatePeriod::__construct',
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::OPTIONAL_PARAMETERS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'DatePeriod::__construct has 3 overloaded forms: (start, interval, end, options), (start, interval, recurrences, options), and (isostr, options). Reflection marks $interval and $end as optional due to multi-arity overloading. Stubs express each overload separately.'
            ),

            // ── ClassFinalCheck known problems ──────────────────────────────────────
            // The `final` modifier cannot be expressed in a version-aware way in stubs,
            // so the stub must match the latest PHP version.  For classes that became
            // final after their introduction, the check reports a mismatch for the
            // older versions where reflection still says non-final.

            // DOMException - became final in PHP 7.0; stubs match PHP 7.0+
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\DOMException',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::PHP_5_6, PhpVersions::PHP_5_6),
                reason: 'DOMException was made final in PHP 7.0. Stubs declare it final to match PHP 7.0+ behaviour; PHP 5.6 reflection reports non-final.'
            ),

            // GMP - became final in PHP 8.4; stubs match PHP 8.4
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\GMP',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_8_3),
                reason: 'GMP was made final in PHP 8.4. Stubs declare it final to match the current PHP behaviour; PHP 5.6–8.3 reflection reports non-final.'
            ),

            // ReflectionGenerator - introduced in PHP 7.0, became final in PHP 8.0
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\ReflectionGenerator',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::PHP_7_0, PhpVersions::PHP_7_4),
                reason: 'ReflectionGenerator was made final in PHP 8.0. Stubs declare it final; PHP 7.0–7.4 reflection reports non-final.'
            ),

            // ReflectionReference - introduced in PHP 7.4, became final in PHP 8.0
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\ReflectionReference',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::PHP_7_4, PhpVersions::PHP_7_4),
                reason: 'ReflectionReference was introduced in PHP 7.4 and made final in PHP 8.0. Stubs declare it final; PHP 7.4 reflection reports non-final.'
            ),

            // __PHP_Incomplete_Class - became final in PHP 8.0; stubs match PHP 8.0+
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\__PHP_Incomplete_Class',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: '__PHP_Incomplete_Class was made final in PHP 8.0. Stubs declare it final; PHP 5.6–7.4 reflection reports non-final.'
            ),

            // mysqli_sql_exception - became final in PHP 7.0; stubs match PHP 7.0+
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\mysqli_sql_exception',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::PHP_5_6, PhpVersions::PHP_5_6),
                reason: 'mysqli_sql_exception was made final in PHP 7.0. Stubs declare it final to match PHP 7.0+ behaviour; PHP 5.6 reflection reports non-final.'
            ),

            // PDO - driver-specific constants not present in standard PHP builds
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\PDO',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'PDO stubs include driver-specific constants (PGSQL_*, SQLSRV_*, OCI_*, FB_*) that are only available when the corresponding database driver extension is installed. These constants are absent from reflection in standard PHP builds without those drivers.',
                entityIds: [
                    '\\PDO::PGSQL_ASSOC',
                    '\\PDO::PGSQL_ATTR_DISABLE_NATIVE_PREPARED_STATEMENT',
                    '\\PDO::PGSQL_ATTR_DISABLE_PREPARES',
                    '\\PDO::PGSQL_BAD_RESPONSE',
                    '\\PDO::PGSQL_BOTH',
                    '\\PDO::PGSQL_TRANSACTION_IDLE',
                    '\\PDO::PGSQL_TRANSACTION_ACTIVE',
                    '\\PDO::PGSQL_TRANSACTION_INTRANS',
                    '\\PDO::PGSQL_TRANSACTION_INERROR',
                    '\\PDO::PGSQL_TRANSACTION_UNKNOWN',
                    '\\PDO::PGSQL_CONNECT_ASYNC',
                    '\\PDO::PGSQL_CONNECT_FORCE_NEW',
                    '\\PDO::PGSQL_CONNECTION_AUTH_OK',
                    '\\PDO::PGSQL_CONNECTION_AWAITING_RESPONSE',
                    '\\PDO::PGSQL_CONNECTION_BAD',
                    '\\PDO::PGSQL_CONNECTION_OK',
                    '\\PDO::PGSQL_CONNECTION_MADE',
                    '\\PDO::PGSQL_CONNECTION_SETENV',
                    '\\PDO::PGSQL_CONNECTION_SSL_STARTUP',
                    '\\PDO::PGSQL_CONNECTION_STARTED',
                    '\\PDO::PGSQL_COMMAND_OK',
                    '\\PDO::PGSQL_CONV_FORCE_NULL',
                    '\\PDO::PGSQL_CONV_IGNORE_DEFAULT',
                    '\\PDO::PGSQL_CONV_IGNORE_NOT_NULL',
                    '\\PDO::PGSQL_COPY_IN',
                    '\\PDO::PGSQL_COPY_OUT',
                    '\\PDO::PGSQL_DIAG_CONTEXT',
                    '\\PDO::PGSQL_DIAG_INTERNAL_POSITION',
                    '\\PDO::PGSQL_DIAG_INTERNAL_QUERY',
                    '\\PDO::PGSQL_DIAG_MESSAGE_DETAIL',
                    '\\PDO::PGSQL_DIAG_MESSAGE_HINT',
                    '\\PDO::PGSQL_DIAG_MESSAGE_PRIMARY',
                    '\\PDO::PGSQL_DIAG_SEVERITY',
                    '\\PDO::PGSQL_DIAG_SOURCE_FILE',
                    '\\PDO::PGSQL_DIAG_SOURCE_FUNCTION',
                    '\\PDO::PGSQL_DIAG_SOURCE_LINE',
                    '\\PDO::PGSQL_DIAG_SQLSTATE',
                    '\\PDO::PGSQL_DIAG_STATEMENT_POSITION',
                    '\\PDO::PGSQL_DML_ASYNC',
                    '\\PDO::PGSQL_DML_EXEC',
                    '\\PDO::PGSQL_DML_NO_CONV',
                    '\\PDO::PGSQL_DML_STRING',
                    '\\PDO::PGSQL_DML_ESCAPE',
                    '\\PDO::PGSQL_EMPTY_QUERY',
                    '\\PDO::PGSQL_ERRORS_DEFAULT',
                    '\\PDO::PGSQL_ERRORS_TERSE',
                    '\\PDO::PGSQL_ERRORS_VERBOSE',
                    '\\PDO::PGSQL_FATAL_ERROR',
                    '\\PDO::PGSQL_NONFATAL_ERROR',
                    '\\PDO::PGSQL_NOTICE_ALL',
                    '\\PDO::PGSQL_NOTICE_CLEAR',
                    '\\PDO::PGSQL_NOTICE_LAST',
                    '\\PDO::PGSQL_NUM',
                    '\\PDO::PGSQL_POLLING_ACTIVE',
                    '\\PDO::PGSQL_POLLING_FAILED',
                    '\\PDO::PGSQL_POLLING_OK',
                    '\\PDO::PGSQL_POLLING_READING',
                    '\\PDO::PGSQL_POLLING_WRITING',
                    '\\PDO::PGSQL_SEEK_CUR',
                    '\\PDO::PGSQL_SEEK_END',
                    '\\PDO::PGSQL_SEEK_SET',
                    '\\PDO::PGSQL_STATUS_LONG',
                    '\\PDO::PGSQL_STATUS_STRING',
                    '\\PDO::PGSQL_TUPLES_OK',
                    '\\PDO::SQLSRV_TXN_READ_UNCOMMITTED',
                    '\\PDO::SQLSRV_TXN_READ_COMMITTED',
                    '\\PDO::SQLSRV_TXN_REPEATABLE_READ',
                    '\\PDO::SQLSRV_TXN_SNAPSHOT',
                    '\\PDO::SQLSRV_TXN_SERIALIZABLE',
                    '\\PDO::SQLSRV_ENCODING_BINARY',
                    '\\PDO::SQLSRV_ENCODING_SYSTEM',
                    '\\PDO::SQLSRV_ENCODING_UTF8',
                    '\\PDO::SQLSRV_ENCODING_DEFAULT',
                    '\\PDO::SQLSRV_ATTR_ENCODING',
                    '\\PDO::SQLSRV_ATTR_QUERY_TIMEOUT',
                    '\\PDO::SQLSRV_ATTR_DIRECT_QUERY',
                    '\\PDO::SQLSRV_ATTR_CURSOR_SCROLL_TYPE',
                    '\\PDO::SQLSRV_ATTR_CLIENT_BUFFER_MAX_KB_SIZE',
                    '\\PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE',
                    '\\PDO::SQLSRV_ATTR_FETCHES_DATETIME_TYPE',
                    '\\PDO::SQLSRV_ATTR_FORMAT_DECIMALS',
                    '\\PDO::SQLSRV_ATTR_DECIMAL_PLACES',
                    '\\PDO::SQLSRV_ATTR_DATA_CLASSIFICATION',
                    '\\PDO::SQLSRV_PARAM_OUT_DEFAULT_SIZE',
                    '\\PDO::SQLSRV_CURSOR_KEYSET',
                    '\\PDO::SQLSRV_CURSOR_DYNAMIC',
                    '\\PDO::SQLSRV_CURSOR_STATIC',
                    '\\PDO::SQLSRV_CURSOR_BUFFERED',
                    '\\PDO::OCI_ATTR_ACTION',
                    '\\PDO::OCI_ATTR_CLIENT_INFO',
                    '\\PDO::OCI_ATTR_CLIENT_IDENTIFIER',
                    '\\PDO::OCI_ATTR_MODULE',
                    '\\PDO::OCI_ATTR_CALL_TIMEOUT',
                    '\\PDO::FB_ATTR_DATE_FORMAT',
                    '\\PDO::FB_ATTR_TIME_FORMAT',
                    '\\PDO::FB_ATTR_TIMESTAMP_FORMAT',
                    '\\PDO::MYSQL_ATTR_MAX_BUFFER_SIZE',
                    '\\PDO::MYSQL_ATTR_READ_DEFAULT_FILE',
                    '\\PDO::MYSQL_ATTR_READ_DEFAULT_GROUP',
                ],
            ),

            // Normalizer - ICU-version-dependent constants (NFKC_CF, FORM_KC_CF, OPTION_DEFAULT)
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\Normalizer',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Normalizer::NFKC_CF, FORM_KC_CF, and OPTION_DEFAULT depend on the ICU library version bundled with PHP. These constants require ICU 60+ and are absent from reflection when an older ICU is used.',
                entityIds: [
                    '\\Normalizer::NFKC_CF',
                    '\\Normalizer::FORM_KC_CF',
                    '\\Normalizer::OPTION_DEFAULT',
                ],
            ),

            // Normalizer::NONE - absent from PHP 8.0 reflection (ICU build gap)
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\Normalizer::NONE',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::PHP_8_0),
                reason: 'Normalizer::NONE is absent from reflection in PHP 8.0 builds on this machine. This appears to be an ICU version gap specific to the PHP 8.0 build.',
            ),

            // NumberFormatter - CURRENCY_ACCOUNTING requires ICU 53+ (not present in PHP 5.6-7.3 builds)
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\NumberFormatter::CURRENCY_ACCOUNTING',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_3),
                reason: 'NumberFormatter::CURRENCY_ACCOUNTING requires ICU 53+. PHP 5.6-7.3 builds typically bundle an older ICU version that does not include this constant.',
            ),

            // IntlDateFormatter - RELATIVE_* constants require ICU 64+ (not present in PHP 5.6-8.3 builds)
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\IntlDateFormatter',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_8_3),
                reason: 'IntlDateFormatter::RELATIVE_FULL, RELATIVE_LONG, RELATIVE_MEDIUM, and RELATIVE_SHORT require ICU 64+. PHP builds before 8.4 typically bundle an older ICU version that does not include these constants.',
                entityIds: [
                    '\\IntlDateFormatter::RELATIVE_FULL',
                    '\\IntlDateFormatter::RELATIVE_LONG',
                    '\\IntlDateFormatter::RELATIVE_MEDIUM',
                    '\\IntlDateFormatter::RELATIVE_SHORT',
                    '\\IntlDateFormatter::PATTERN',
                ],
            ),

            // Spoofchecker - ICU-dependent constants absent from PHP 5.6-8.2 builds
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\Spoofchecker',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_8_2),
                reason: 'Spoofchecker::ASCII, HIGHLY_RESTRICTIVE, MODERATELY_RESTRICTIVE, MINIMALLY_RESTRICTIVE, UNRESTRICTIVE, and SINGLE_SCRIPT_RESTRICTIVE depend on the ICU library version. These constants are absent from reflection in PHP 5.6-8.2 builds that bundle older ICU versions.',
                entityIds: [
                    '\\Spoofchecker::ASCII',
                    '\\Spoofchecker::HIGHLY_RESTRICTIVE',
                    '\\Spoofchecker::MODERATELY_RESTRICTIVE',
                    '\\Spoofchecker::MINIMALLY_RESTRICTIVE',
                    '\\Spoofchecker::UNRESTRICTIVE',
                    '\\Spoofchecker::SINGLE_SCRIPT_RESTRICTIVE',
                    '\\Spoofchecker::MIXED_NUMBERS',
                    '\\Spoofchecker::HIDDEN_OVERLAY',
                ],
            ),

            // Spoofchecker - MIXED_NUMBERS and HIDDEN_OVERLAY have ICU-version-dependent values
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\Spoofchecker',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CLASS_CONSTANTS_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Spoofchecker::MIXED_NUMBERS and HIDDEN_OVERLAY map to ICU USpoofChecks flags whose values changed from 1/2 to 128/256 in ICU 75+, so they depend on the bundled ICU version and cannot be pinned in stubs.',
                entityIds: [
                    '\\Spoofchecker::MIXED_NUMBERS',
                    '\\Spoofchecker::HIDDEN_OVERLAY',
                ],
            ),

            // ZipArchive - libzip-version-dependent constants absent from PHP 8.0-8.2 builds
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\ZipArchive',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_CONSTANTS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::PHP_8_2),
                reason: 'Some ZipArchive constants depend on the libzip version bundled with PHP. Constants added in newer libzip releases are absent from reflection in PHP 8.0-8.2 builds that bundle older libzip versions.',
                entityIds: [
                    '\\ZipArchive::FL_OPEN_FILE_NOW',
                    '\\ZipArchive::CM_ZSTD',
                    '\\ZipArchive::ER_DATA_LENGTH',
                    '\\ZipArchive::ER_NOT_ALLOWED',
                    '\\ZipArchive::AFL_RDONLY',
                    '\\ZipArchive::AFL_IS_TORRENTZIP',
                    '\\ZipArchive::AFL_WANT_TORRENTZIP',
                    '\\ZipArchive::AFL_CREATE_OR_KEEP_FILE_FOR_EMPTY_ARCHIVE',
                    '\\ZipArchive::LENGTH_TO_END',
                    '\\ZipArchive::LENGTH_UNCHECKED',
                ],
            ),

            // IntlCalendar - FIELD_FIELD_COUNT value is ICU-version-dependent
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\IntlCalendar::FIELD_FIELD_COUNT',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CLASS_CONSTANTS_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'IntlCalendar::FIELD_FIELD_COUNT is the number of calendar fields, which grows as the bundled ICU library adds fields (e.g. 23 in older ICU, 24 in ICU 75+), so it depends on the ICU version and cannot be pinned in stubs.',
            ),

            // IntlChar - multiple constants have ICU-version-dependent values
            new ProblemDefinition(
                entityType: EntityType::CLASS_CONSTANT,
                entityId: '\\IntlChar',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CLASS_CONSTANTS_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'These IntlChar constants (UNICODE_VERSION, PROPERTY_BINARY_LIMIT, PROPERTY_INT_LIMIT, BLOCK_CODE_COUNT, ...) reflect the Unicode/ICU version and change with each ICU update, so their values cannot be pinned in stubs. Across the per-version images the bundled ICU reports different Unicode versions (e.g. 9.0, 12.1, 13.0, 14.0, 15.1, 16.0), so the value check is muted for all versions.',
                entityIds: [
                    '\\IntlChar::UNICODE_VERSION',
                    '\\IntlChar::PROPERTY_BINARY_LIMIT',
                    '\\IntlChar::PROPERTY_INT_LIMIT',
                    '\\IntlChar::BLOCK_CODE_COUNT',
                    '\\IntlChar::PROPERTY_OTHER_PROPERTY_LIMIT',
                    '\\IntlChar::JG_COUNT',
                    '\\IntlChar::LB_COUNT',
                ],
            ),

            // -----------------------------------------------------------------------
            // Runtime-value constants: values depend on the installed library version
            // or build/environment configuration and cannot be pinned in stubs.
            // -----------------------------------------------------------------------

            // ICU library version — reported by the intl extension
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'intl-icu-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'ICU library version constants depend on the ICU version bundled with the intl extension and differ per installation.',
                entityIds: [
                    '\\INTL_ICU_VERSION',
                    '\\INTL_ICU_DATA_VERSION',
                    '\\IDNA_DEFAULT',
                    '\\U_FMT_PARSE_ERROR_LIMIT',
                ],
            ),

            // libxml version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'libxml-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'libxml version/feature constants depend on the installed libxml2 library version.',
                entityIds: [
                    '\\LIBXML_VERSION',
                    '\\LIBXML_LOADED_VERSION',
                    '\\LIBXML_DOTTED_VERSION',
                    '\\LIBXML_BIGLINES',
                ],
            ),

            // OpenSSL version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'openssl-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'OpenSSL version constants depend on the installed OpenSSL library version.',
                entityIds: [
                    '\\OPENSSL_VERSION_NUMBER',
                    '\\OPENSSL_VERSION_TEXT',
                ],
            ),

            // PCRE version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'pcre-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'PCRE version constants depend on the PCRE2 library bundled with PHP.',
                entityIds: [
                    '\\PCRE_VERSION',
                    '\\PCRE_VERSION_MINOR',
                ],
            ),

            // cURL version/flags
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'curl-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'cURL constants (debug-callback type flags, CURLVERSION_NOW, CURLINFO_LASTONE) depend on the linked libcurl version.',
                entityIds: [
                    '\\CURLINFO_TEXT',
                    '\\CURLINFO_DATA_IN',
                    '\\CURLINFO_DATA_OUT',
                    '\\CURLINFO_SSL_DATA_IN',
                    '\\CURLINFO_SSL_DATA_OUT',
                    '\\CURLINFO_LASTONE',
                    '\\CURLOPT_DEBUGFUNCTION',
                    '\\CURLVERSION_NOW',
                ],
            ),

            // iconv version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\ICONV_VERSION',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'ICONV_VERSION depends on the iconv library version installed on the system.',
            ),

            // Oniguruma version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\MB_ONIGURUMA_VERSION',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'MB_ONIGURUMA_VERSION depends on the Oniguruma regex library bundled with the mbstring extension.',
            ),

            // libsodium version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'libsodium-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'libsodium version constants depend on the libsodium library linked with PHP.',
                entityIds: [
                    '\\SODIUM_LIBRARY_VERSION',
                    '\\SODIUM_LIBRARY_MINOR_VERSION',
                ],
            ),

            // libpq (PostgreSQL client) version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'pgsql-libpq-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'PGSQL_LIBPQ_VERSION constants depend on the libpq (PostgreSQL client library) version linked with PHP.',
                entityIds: [
                    '\\PGSQL_LIBPQ_VERSION',
                    '\\PGSQL_LIBPQ_VERSION_STR',
                ],
            ),

            // zlib version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'zlib-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'ZLIB_VERSION and ZLIB_VERNUM depend on the zlib library linked with PHP.',
                entityIds: [
                    '\\ZLIB_VERSION',
                    '\\ZLIB_VERNUM',
                ],
            ),

            // fileinfo/libmagic version
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\FILEINFO_EXTENSION',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'FILEINFO_EXTENSION flag value depends on the libmagic version; only available since libmagic 5.34 and the numeric value varies.',
            ),

            // MySQL/MariaDB driver constant
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\MYSQLI_IS_MARIADB',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'MYSQLI_IS_MARIADB is a boolean/truthy constant reported as an empty string by some MySQL builds and as 0 by others; its value depends on the MySQL/MariaDB driver.',
            ),

            // PHP version constants — always reflect the current runtime
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'php-version',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'PHP version constants reflect the current PHP runtime version and cannot be pinned to a static value in stubs.',
                entityIds: [
                    '\\PHP_VERSION',
                    '\\PHP_MAJOR_VERSION',
                    '\\PHP_MINOR_VERSION',
                    '\\PHP_RELEASE_VERSION',
                    '\\PHP_VERSION_ID',
                    '\\PHP_EXTRA_VERSION',
                ],
            ),

            // PHP build-configuration path constants
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'php-build-paths',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'PHP build-configuration path constants depend on where PHP was compiled and installed; they differ per system.',
                entityIds: [
                    '\\PHP_BINARY',
                    '\\PHP_BINDIR',
                    '\\PHP_CONFIG_FILE_PATH',
                    '\\PHP_CONFIG_FILE_SCAN_DIR',
                    '\\PHP_DATADIR',
                    '\\PHP_EXTENSION_DIR',
                    '\\PHP_LIBDIR',
                    '\\PHP_LOCALSTATEDIR',
                    '\\PHP_MANDIR',
                    '\\PHP_PREFIX',
                    '\\PHP_SYSCONFDIR',
                    '\\DEFAULT_INCLUDE_PATH',
                    '\\PEAR_INSTALL_DIR',
                    '\\PEAR_EXTENSION_DIR',
                ],
            ),

            // PHP build flags
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'php-build-flags',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'PHP_DEBUG and PHP_ZTS depend on whether PHP was compiled with debug mode or ZTS support; value is 0 in standard builds but may be reported as empty string by reflection.',
                entityIds: [
                    '\\PHP_DEBUG',
                    '\\PHP_ZTS',
                ],
            ),

            // POSIX resource-limit constants — values differ between Linux and macOS
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: 'posix-rlimit',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'POSIX resource-limit constants use OS-specific numeric values that differ between Linux and macOS.',
                entityIds: [
                    '\\POSIX_RLIMIT_AS',
                    '\\POSIX_RLIMIT_MEMLOCK',
                    '\\POSIX_RLIMIT_NOFILE',
                    '\\POSIX_RLIMIT_NPROC',
                    '\\POSIX_RLIMIT_INFINITY',
                ],
            ),

            // CHAR_MAX — system-dependent (signed vs unsigned char)
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\CHAR_MAX',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::CONSTANT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'CHAR_MAX is 127 on systems with signed char and 255 on systems with unsigned char.',
            ),

            // TRUE, FALSE, NULL - PHP language keywords reported as constants by runtime reflection
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\TRUE',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CONSTANT_EXISTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: '\\TRUE is a PHP language keyword reported as a constant by runtime reflection, but cannot be defined in stubs as a constant declaration.'
            ),
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\FALSE',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CONSTANT_EXISTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: '\\FALSE is a PHP language keyword reported as a constant by runtime reflection, but cannot be defined in stubs as a constant declaration.'
            ),
            new ProblemDefinition(
                entityType: EntityType::GLOBAL_CONSTANT,
                entityId: '\\NULL',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CONSTANT_EXISTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: '\\NULL is a PHP language keyword reported as a constant by runtime reflection, but cannot be defined in stubs as a constant declaration.'
            ),

            // Tentative return types that only exist from PHP 8.3+ (DOMDocument methods got tentative in 8.3)
            // Stubs mark them as tentative for all versions; skip the check for 8.1-8.2
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::TENTATIVE_RETURN_TYPE],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::PHP_8_2),
                reason: 'DOMDocument methods became tentative in PHP 8.3; stubs mark them for all versions',
                entityIds: [
                    '\\DOMDocument::adoptNode',
                    '\\DOMDocument::load',
                    '\\DOMDocument::loadHTML',
                    '\\DOMDocument::loadHTMLFile',
                    '\\DOMDocument::loadXML',
                ],
            ),

            // Tentative return types that only exist in PHP 8.4+
            // Stubs mark them as tentative for all versions; skip the check for 8.1-8.3
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::TENTATIVE_RETURN_TYPE],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_1, PhpVersions::PHP_8_3),
                reason: 'Method became tentative in PHP 8.4; stubs mark it for all 8.1+ versions',
                entityIds: [
                    '\\Collator::setStrength',
                    '\\DOMImplementation::createDocument',
                    '\\IntlCalendar::clear',
                    '\\IntlCalendar::set',
                    '\\IntlCalendar::setFirstDayOfWeek',
                    '\\IntlCalendar::setLenient',
                    '\\IntlCalendar::setMinimalDaysInFirstWeek',
                    '\\IntlCalendar::setRepeatedWallTimeOption',
                    '\\IntlCalendar::setSkippedWallTimeOption',
                    '\\IntlGregorianCalendar::clear',
                    '\\IntlGregorianCalendar::set',
                    '\\IntlGregorianCalendar::setFirstDayOfWeek',
                    '\\IntlGregorianCalendar::setLenient',
                    '\\IntlGregorianCalendar::setMinimalDaysInFirstWeek',
                    '\\IntlGregorianCalendar::setRepeatedWallTimeOption',
                    '\\IntlGregorianCalendar::setSkippedWallTimeOption',
                    '\\Locale::setDefault',
                    '\\PDOStatement::setFetchMode',
                    '\\Phar::copy',
                    '\\Phar::decompressFiles',
                    '\\Phar::delMetadata',
                    '\\Phar::delete',
                    '\\Phar::setStub',
                    '\\PharData::copy',
                    '\\PharData::decompressFiles',
                    '\\PharData::delMetadata',
                    '\\PharData::delete',
                    '\\PharFileInfo::compress',
                    '\\PharFileInfo::decompress',
                    '\\PharFileInfo::delMetadata',
                    '\\SQLite3::close',
                    '\\SQLite3Result::finalize',
                    '\\SplFixedArray::setSize',
                    '\\SplPriorityQueue::insert',
                    '\\SplPriorityQueue::recoverFromCorruption',
                    '\\XMLReader::close',
                    '\\finfo::set_flags',
                    '\\mysqli::close',
                    '\\mysqli::debug',
                    '\\mysqli::ssl_set',
                    '\\mysqli_stmt::close',
                ],
            ),

            // ── FunctionParameterDefaultValueCheck known problems ─────────────────

            // round() - PHP 8.4 changed $mode default from int PHP_ROUND_HALF_UP (0) to
            // the pure enum RoundingMode::HalfAwayFromZero. Stubs cannot represent enum
            // defaults in a version-aware way, so the stub keeps 0 for all versions.
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\round',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::PARAMETER_DEFAULT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::LATEST, PhpVersions::LATEST),
                reason: 'PHP 8.4 changed the $mode default from int 0 (PHP_ROUND_HALF_UP) to RoundingMode::HalfAwayFromZero (pure enum). Stubs have no version-aware default mechanism, so 0 is kept for all versions.'
            ),

            // ── PhpDocConformsSignatureCheck known problems ───────────────────────

            // get_headers() $associative: PHP 7.x sig=int, but PhpDoc says bool (modern type).
            // PHP 8.0 changed the type to bool; PhpDoc was written for PHP 8.0+ behaviour.
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\get_headers',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::PHPDOC_CONFORMS_SIGNATURE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'get_headers() $associative was int before PHP 8.0; PhpDoc documents the PHP 8.0+ bool type. The int→bool change is intentional; the PhpDoc is correct for current PHP.'
            ),

            // imap_sort() $reverse: PHP 7.x sig=int, but PhpDoc says bool (modern type).
            // PHP 8.0 changed the type to bool; PhpDoc was written for PHP 8.0+ behaviour.
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: '\\imap_sort',
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::PHPDOC_CONFORMS_SIGNATURE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::PHP_7_4),
                reason: 'imap_sort() $reverse was int before PHP 8.0; PhpDoc documents the PHP 8.0+ bool type. The int→bool change is intentional; the PhpDoc is correct for current PHP.'
            ),

            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\Directory',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_5, PhpVersions::LATEST),
                reason: 'Directory was marked final in PHP 8.5. The stub declares it without final (matching PHP <8.5 behaviour), but reflection for PHP 8.5 reports isFinal=true.'
            ),

            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\ReflectionConstant',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_4, PhpVersions::PHP_8_4),
                reason: 'ReflectionConstant was marked final in PHP 8.4. The stub declares it without final (matching other PHP versions), but reflection for PHP 8.4 reports isFinal=true.'
            ),
        ];

        return $this->problems;
    }

    /**
     * @inheritDoc
     */
    public function getProblemsForEntity(EntityType $entityType, string $entityId): array
    {
        $allProblems = $this->getProblems();

        return array_filter(
            $allProblems,
            fn (ProblemDefinition $problem) => $problem->entityType === $entityType
                && (
                    $problem->entityId === $entityId
                    || (!empty($problem->entityIds) && in_array($entityId, $problem->entityIds, true))
                )
        );
    }
}
