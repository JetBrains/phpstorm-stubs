<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

class PHPMethod extends PHPFunction
{
    private ?AccessModifier $accessModifier = null;
    private bool $isStatic = false;
    private bool $isFinal = false;
    private bool $isAbstract = false;

    public function getAccess(): ?AccessModifier
    {
        return $this->accessModifier;
    }

    public function setAccess(AccessModifier $accessModifier): void
    {
        $this->accessModifier = $accessModifier;
    }

    public function isStatic(): bool
    {
        return $this->isStatic;
    }

    public function setIsStatic(bool $isStatic): void
    {
        $this->isStatic = $isStatic;
    }

    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    public function setIsFinal(bool $isFinal): void
    {
        $this->isFinal = $isFinal;
    }

    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    public function setIsAbstract(bool $isAbstract): void
    {
        $this->isAbstract = $isAbstract;
    }
}
