<?php

namespace StubTests\Framework\Parsers\Model\Types;

use StubTests\Framework\Parsers\Model\Types\StandaloneType;

class NullableType
{
    private StandaloneType $basicType;

    public function __construct(StandaloneType $basicType)
    {
        $this->basicType = $basicType;
    }

    public function toString(): string
    {
        // PHP 8.0+: 'mixed' type already includes null, so don't add '|null'
        return $this->basicType->toString() !== 'mixed' ? "{$this->basicType->toString()}|null" : $this->basicType->toString();
    }

    public function toArray(): array
    {
        return [$this->basicType->toString(), 'null'];
    }

	public function hasBasicType(string $type): bool
    {
        return $this->basicType->toString() === $type;
    }
}