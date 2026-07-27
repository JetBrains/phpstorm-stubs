<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Model\PHPFunction;

interface FunctionQueryInterface
{
    /** @return PHPFunction[] */
    public function getFunctions(): array;
}
