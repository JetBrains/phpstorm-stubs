<?php

namespace StubTests\Framework\Model;

use StubTests\Framework\Model\Types\IntersectionType;
use StubTests\Framework\Model\Types\NoType;
use StubTests\Framework\Model\Types\NullableType;
use StubTests\Framework\Model\Types\StandaloneType;
use StubTests\Framework\Model\Types\UnionType;

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

    /**
     * Resolves a deferred default value on first read, then caches it.
     *
     * This is the one getter here that is not a plain field read, which reads as a violation
     * of the "models are pure data holders" rule — so, why it has to be deferred:
     *
     * A default value may reference a constant (`PHP_INT_MAX`, `SOME\Ext::FLAG`) that is not
     * resolvable at the moment the parameter is parsed, because the constant may be declared
     * in a stub file that has not been parsed yet. Evaluating eagerly in StubParameterParser
     * would therefore resolve some defaults to null purely because of file ordering; the
     * evaluator exists so resolution happens after StubConstantRegistry is fully populated.
     *
     * The mutation is memoisation of a deterministic computation, so the value observed is
     * the same on every call — but it is genuinely deferred work, not a field read. Moving it
     * out would mean a post-parse resolution pass over every parameter before serialization.
     *
     * A failure to evaluate yields null rather than propagating: the evaluator normalises
     * everything it cannot compute (including DivisionByZeroError, see
     * NikicConstExprEvaluatorTrait) to \RuntimeException, which is absorbed here.
     */
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
