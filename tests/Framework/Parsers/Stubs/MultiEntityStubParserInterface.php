<?php

namespace StubTests\Framework\Parsers\Stubs;

/**
 * Interface for parsers that extract and parse multiple entities from stub content.
 *
 * Unlike single-entity parsers, these parsers process entire file content and
 * extract all entities of their type (e.g., all classes, all functions, etc.).
 */
interface MultiEntityStubParserInterface
{
    /**
     * Extract and parse all entities of this type from stub content.
     *
     * @param string $stubContent The PHP stub file content to parse
     * @return array Array of parsed entities (PHPClass, PHPFunction, etc.).
     *               Returns empty array if no entities found.
     */
    public function extractAndParseAll(string $stubContent): array;
}
