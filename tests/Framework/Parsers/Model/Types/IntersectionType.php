<?php

namespace StubTests\Framework\Parsers\Model\Types;

use StubTests\Framework\Parsers\Model\Types\StandaloneType;

class IntersectionType
{
    /** @var StandaloneType[] */
    private array $types = [];

    public function addType(StandaloneType $type): void
    {
        $this->types[] = $type;
    }

    public function toString(): string
    {
        return implode('&', array_map(fn(StandaloneType $type) => $type->toString(), $this->types));
    }

    public function containsTypes(string ...$types): bool
    {
        $typeNames = array_map(fn(StandaloneType $t) => $t->toString(), $this->types);
        foreach ($types as $type) {
            if (!in_array($type, $typeNames, true)) {
                return false;
            }
        }
        return true;
    }
}
