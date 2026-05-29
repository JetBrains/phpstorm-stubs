<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\PHPClassLikeObject;
use StubTests\Framework\Parsers\Model\PHPProperty;

class PHPClass extends PHPClassLikeObject
{
    /** @var PHPProperty[] */
    private array $properties = [];
    private ?PHPClass $parentClass = null;

    /** @return PHPProperty[] */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    public function addProperty(PHPProperty $property): void
    {
        $this->properties[] = $property;
    }

    public function getParentClass(): ?PHPClass
    {
        return $this->parentClass;
    }

    public function setParentClass(?PHPClass $parentClass): void
    {
        $this->parentClass = $parentClass;
    }
}
