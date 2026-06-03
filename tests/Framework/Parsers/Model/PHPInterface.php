<?php

namespace StubTests\Framework\Parsers\Model;

class PHPInterface extends PHPClassLikeObject
{
    /** @var PHPInterface[] */
    private array $parentInterfaces = [];

    /** @return PHPInterface[] */
    public function getParentInterfaces(): array
    {
        return $this->parentInterfaces;
    }

    public function setParentInterfaces(array $parentInterfaces): void
    {
        $this->parentInterfaces = $parentInterfaces;
    }

    public function addParentInterface(PHPInterface $interface): void
    {
        $this->parentInterfaces[] = $interface;
    }
}
