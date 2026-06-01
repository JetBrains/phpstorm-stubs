<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;

class PHPParameter extends BasePHPElement
{
    private StandaloneType|UnionType|NullableType|NoType|IntersectionType $type;
    private int $position;
    private bool $isOptional;
    private bool $isVariadic;
    private bool $isPassedByReference;
    private bool $isDeprecated;
    private mixed $defaultValue;
    private bool $hasDefaultValue;
    private ?\Closure $defaultValueEvaluator = null;

    public function __construct(?string $name)
    {
        parent::setName($name ?? '');
        $this->type = new NoType();
        $this->position = 0;
        $this->isOptional = false;
        $this->isVariadic = false;
        $this->isPassedByReference = false;
        $this->isDeprecated = false;
        $this->defaultValue = null;
        $this->hasDefaultValue = false;
    }

    public function getName(): string
    {
        return parent::getName() ?? '';
    }

    public function getDeclaredType(): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        return $this->type;
    }

    public function setType(StandaloneType|UnionType|NullableType|NoType|IntersectionType $type): void
    {
        $this->type = $type;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function isOptional(): bool
    {
        return $this->isOptional;
    }

    public function setIsOptional(bool $isOptional): void
    {
        $this->isOptional = $isOptional;
    }

    public function isVariadic(): bool
    {
        return $this->isVariadic;
    }

    public function setIsVariadic(bool $isVariadic): void
    {
        $this->isVariadic = $isVariadic;
    }

    public function isPassedByReference(): bool
    {
        return $this->isPassedByReference;
    }

    public function setIsPassedByReference(bool $isPassedByReference): void
    {
        $this->isPassedByReference = $isPassedByReference;
    }

    public function isDeprecated(): bool
    {
        return $this->isDeprecated;
    }

    public function setDeprecated(bool $isDeprecated): void
    {
        $this->isDeprecated = $isDeprecated;
    }

    public function getDefaultValue(): mixed
    {
        if ($this->defaultValueEvaluator !== null) {
            try {
                $this->defaultValue = ($this->defaultValueEvaluator)();
            } catch (\RuntimeException) {
                $this->defaultValue = null;
            }
            $this->defaultValueEvaluator = null;
        }
        return $this->defaultValue;
    }

    public function setDefaultValue(mixed $defaultValue): void
    {
        $this->defaultValue = $defaultValue;
        $this->defaultValueEvaluator = null;
    }

    public function setDefaultValueEvaluator(\Closure $evaluator): void
    {
        $this->defaultValueEvaluator = $evaluator;
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
