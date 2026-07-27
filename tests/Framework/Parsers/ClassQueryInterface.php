<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Model\PHPClass;

interface ClassQueryInterface
{
    /** @return PHPClass[] */
    public function getClasses(): array;

    public function hasClass(string $id): bool;
}
