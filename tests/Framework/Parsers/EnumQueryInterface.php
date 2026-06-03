<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Parsers\Model\PHPEnum;

interface EnumQueryInterface
{
    /** @return PHPEnum[] */
    public function getEnums(): array;

    public function hasEnum(string $id): bool;
}
