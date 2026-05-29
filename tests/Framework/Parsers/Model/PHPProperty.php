<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\BasePHPElement;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;

class PHPProperty extends BasePHPElement
{
    private ?AccessModifier $accessModifier = null;
    private bool $isStatic = false;
    private bool $isReadonly = false;
    private StandaloneType|UnionType|NullableType|NoType|IntersectionType|null $type = null;
    private mixed $defaultValue = null;
    private bool $hasDefaultValue = false;

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

    public function isReadonly(): bool
    {
        return $this->isReadonly;
    }

    public function setIsReadonly(bool $isReadonly): void
    {
        $this->isReadonly = $isReadonly;
    }

    public function setTypeFromSignature(StandaloneType|UnionType|NullableType|NoType|IntersectionType $type): void
    {
        $this->type = $type;
    }

    public function getType(): StandaloneType|UnionType|NullableType|NoType|IntersectionType|null
    {
        return $this->type;
    }

    public function getDefaultValue(): mixed
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(mixed $defaultValue): void
    {
        $this->defaultValue = $defaultValue;
        $this->hasDefaultValue = true;
    }

    public function hasDefaultValue(): bool
    {
        return $this->hasDefaultValue;
    }

    public function setHasDefaultValue(bool $hasDefaultValue): void
    {
        $this->hasDefaultValue = $hasDefaultValue;
    }

}