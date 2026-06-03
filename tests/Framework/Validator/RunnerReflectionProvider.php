<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Runner\RunnerScope;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

/**
 * Default implementation of ReflectionProviderInterface that uses Runner.
 *
 * This wraps RunnerScope::get()->getReflection() to allow dependency injection
 * in validator checks while maintaining the existing production behavior.
 */
class RunnerReflectionProvider implements ReflectionProviderInterface
{
    /**
     * Get reflection data for a specific PHP version using Runner.
     *
     * @param string $phpVersion The PHP version (e.g., '8.0', '8.1')
     * @return StubDataQueryInterface The reflection data storage
     */
    public function getReflection(string $phpVersion): StubDataQueryInterface
    {
        return RunnerScope::get()->getReflection($phpVersion);
    }
}
