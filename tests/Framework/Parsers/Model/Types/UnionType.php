<?php

namespace StubTests\Framework\Parsers\Model\Types;

class UnionType
{
    /** @var array<StandaloneType|IntersectionType> */
    private array $types = [];

    public function addType(StandaloneType|IntersectionType $type): void
    {
        $this->types[] = $type;
    }

    public function toString(): string
    {
        return implode('|', array_map(
            fn (StandaloneType|IntersectionType $type) => $type instanceof IntersectionType
                ? '(' . $type->toString() . ')'
                : $type->toString(),
            $this->types
        ));
    }

    public function containsTypes(string ...$types): bool
    {
        $standaloneNames = array_filter(
            array_map(
                fn ($t) => $t instanceof StandaloneType ? $t->toString() : null,
                $this->types
            )
        );
        foreach ($types as $type) {
            if (!in_array($type, $standaloneNames, true)) {
                return false;
            }
        }
        return true;
    }
}
