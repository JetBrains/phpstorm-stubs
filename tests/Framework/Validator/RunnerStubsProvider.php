<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Runner\RunnerScope;
use StubTests\Framework\Validator\Contracts\StubsProviderInterface;

/**
 * Default implementation of StubsProviderInterface that uses Runner.
 *
 * Wraps RunnerScope::get()->getStubs() to allow dependency injection
 * in validator infrastructure while maintaining the existing production behavior.
 */
class RunnerStubsProvider implements StubsProviderInterface
{
    public function getStubs(): StubDataQueryInterface
    {
        return RunnerScope::get()->getStubs();
    }
}
