<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Parsers\Model\PHPFunction;

interface FunctionQueryInterface
{
    /** @return PHPFunction[] */
    public function getFunctions(): array;
}
