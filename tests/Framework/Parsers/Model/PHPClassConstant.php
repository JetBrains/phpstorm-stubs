<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Parsers\Model\BasePHPElement;

class PHPClassConstant extends BasePHPElement
{
    private mixed $value = null;
    private ?string $parentId = null;
    private AccessModifier $accessModifier = AccessModifier::PUBLIC;
    private bool $isFinal = false;

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function setParentId(?string $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getAccess(): AccessModifier
    {
        return $this->accessModifier;
    }

    public function setAccess(AccessModifier $accessModifier): void
    {
        $this->accessModifier = $accessModifier;
    }

    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    public function setIsFinal(bool $isFinal): void
    {
        $this->isFinal = $isFinal;
    }
}
