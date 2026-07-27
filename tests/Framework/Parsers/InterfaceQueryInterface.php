<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Model\PHPInterface;

interface InterfaceQueryInterface
{
    /** @return PHPInterface[] */
    public function getInterfaces(): array;

    public function hasInterface(string $id): bool;
}
