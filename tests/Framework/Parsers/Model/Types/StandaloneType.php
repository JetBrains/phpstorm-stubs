<?php

namespace StubTests\Framework\Parsers\Model\Types;

class StandaloneType
{
    private string $typeName;

    public function __construct(string $typeName)
    {
        $this->typeName = $typeName;
    }

    public function toString(): string
    {
        return $this->typeName;
    }
}
