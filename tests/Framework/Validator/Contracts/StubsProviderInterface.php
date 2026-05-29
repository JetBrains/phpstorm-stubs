<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Parsers\StubDataQueryInterface;

/**
 * Abstracts access to parsed stubs data.
 *
 * Mirrors ReflectionProviderInterface for the stubs side, allowing
 * validators and test infrastructure to be decoupled from RunnerScope.
 */
interface StubsProviderInterface
{
    public function getStubs(): StubDataQueryInterface;
}
