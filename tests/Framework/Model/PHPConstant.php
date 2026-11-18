<?php

namespace StubTests\Framework\Model;

class PHPConstant extends PHPNamespacedElement
{
    private mixed $value = null;
    private bool $isDeprecated = false;

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    public function isDeprecated(): bool
    {
        return $this->isDeprecated;
    }

    public function setDeprecated(bool $isDeprecated): void
    {
        $this->isDeprecated = $isDeprecated;
    }
}
