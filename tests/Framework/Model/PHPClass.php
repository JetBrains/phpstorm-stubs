<?php

namespace StubTests\Framework\Model;

class PHPClass extends PHPClassLikeObject
{
    /** @var PHPProperty[] */
    private array $properties = [];
    private ?PHPClass $parentClass = null;
    private bool $isAbstract = false;

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

    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    public function setIsAbstract(bool $isAbstract): void
    {
        $this->isAbstract = $isAbstract;
    }
}
