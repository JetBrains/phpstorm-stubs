<?php

namespace StubTests\Framework\Parsers\Stubs\Types;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;

/**
 * Value object representing parsed type information from multiple sources.
 * Consolidates type data from:
 * - Signature type hints (native PHP types)
 * - PhpDoc type annotations
 * - LanguageLevelTypeAware attributes (version-specific types)
 */
class ParsedType
{
    /**
     * Type object from the actual PHP signature/declaration
     */
    public StandaloneType|UnionType|NullableType|NoType|IntersectionType|null $typeFromSignature = null;

    /**
     * Type extracted from PhpDoc (@var, @param, @return)
     */
    public ?string $typeFromPhpDoc = null;

    /**
     * Version-specific type map from LanguageLevelTypeAware attribute
     * Format: ['8.0' => 'CurlHandle', '8.1' => 'CurlHandle|false']
     */
    public ?array $languageLevelTypes = null;

    /**
     * Default type from LanguageLevelTypeAware attribute
     * Used when no version-specific match is found
     */
    public ?string $defaultType = null;
}
