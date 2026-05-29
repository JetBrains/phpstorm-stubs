<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Parsers\Model\PHPClass;

interface ClassQueryInterface
{
    /** @return PHPClass[] */
    public function getClasses(): array;
    public function hasClass(string $id): bool;
}
