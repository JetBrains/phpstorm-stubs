<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\PHPNamespacedElement;

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
