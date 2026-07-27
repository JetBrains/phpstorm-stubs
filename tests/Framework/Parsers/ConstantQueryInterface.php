<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Model\PHPConstant;

interface ConstantQueryInterface
{
    /** @return PHPConstant[] */
    public function getConstants(): array;
}
