<?php

namespace StubTests\Framework\Parsers\Model;

class PHPConstant extends PHPNamespacedElement
{
    private mixed $value = null;

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }
}
