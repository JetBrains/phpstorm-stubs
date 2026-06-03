<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Parsers\Model\PHPConstant;

interface ConstantQueryInterface
{
    /** @return PHPConstant[] */
    public function getConstants(): array;
}
