<?php

namespace StubTests\Framework\Parsers;

/**
 * Parser interface for converting reflection/stub data into domain models
 *
 * @template T The type of object this parser accepts (typically extends AbstractReflectionAdapter)
 */
interface Parser
{
    /**
     * Check if this parser can handle the given object
     *
     * @param T $object The object to check
     * @return bool True if this parser can parse the object
     */
    public function canParse($object): bool;

    /**
     * Parse an object into a domain model
     *
     * @param T $object The object to parse
     * @return mixed The parsed domain model (PHPClass, PHPMethod, PHPFunction, etc.)
     */
    public function parse($object);
}
