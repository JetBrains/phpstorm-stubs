<?php

namespace StubTests\Framework\Parsers\Model;

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
