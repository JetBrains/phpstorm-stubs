<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Parsers\StubDataQueryInterface;

/**
 * Interface for providing reflection data to validator checks.
 *
 * This abstraction allows validator checks to be testable by accepting
 * mock reflection data, while still using real reflection data in production.
 */
interface ReflectionProviderInterface
{
    /**
     * Get reflection data for a specific PHP version.
     *
     * @param string $phpVersion The PHP version (e.g., '8.0', '8.1')
     * @return StubDataQueryInterface The reflection data storage
     */
    public function getReflection(string $phpVersion): StubDataQueryInterface;
}
