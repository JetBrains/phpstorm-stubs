<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\BasePHPElement;

class PHPNamespacedElement extends BasePHPElement
{
    private ?string $namespace = null;

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function setNamespace(?string $namespace): void
    {
        $this->namespace = $namespace;
    }
}