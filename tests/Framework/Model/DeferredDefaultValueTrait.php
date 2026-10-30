<?php

namespace StubTests\Framework\Model;

/**
 * A default value that can be evaluated on first read rather than when it is parsed, shared by
 * PHPParameter and PHPProperty. Each keeps its own setDefaultValue(), which must clear
 * $defaultValueEvaluator, and its own hasDefaultValue state.
 */
trait DeferredDefaultValueTrait
{
    private mixed $defaultValue = null;
    private bool $defaultValueResolved = true;
    private ?\Closure $defaultValueEvaluator = null;

    /**
     * Resolves a deferred default value on first read, then caches it.
     *
     * This is the one getter in these models that is not a plain field read, which reads as a
     * violation of the "models are pure data holders" rule — so, why it has to be deferred:
     *
     * A default value may reference a constant (`PHP_INT_MAX`, `SOME\Ext::FLAG`) that is not
     * resolvable at the moment the parameter or property is parsed, because the constant may be
     * declared in a stub file that has not been parsed yet. Evaluating eagerly in the stub parsers
     * would therefore resolve some defaults to null purely because of file ordering; the
     * evaluator exists so resolution happens after StubConstantRegistry is fully populated.
     *
     * The mutation is memoisation of a deterministic computation, so the value observed is
     * the same on every call — but it is genuinely deferred work, not a field read. Moving it
     * out would mean a post-parse resolution pass over every parameter and property before
     * serialization.
     *
     * A failure to evaluate yields null rather than propagating: the evaluator normalises
     * everything it cannot compute (including DivisionByZeroError, see
     * NikicConstExprEvaluatorTrait) to \RuntimeException, which is absorbed here and
     * recorded in isDefaultValueResolved().
     */
    public function getDefaultValue(): mixed
    {
        if ($this->defaultValueEvaluator !== null) {
            try {
                $this->defaultValue = ($this->defaultValueEvaluator)();
            } catch (\RuntimeException) {
                $this->defaultValue = null;
                $this->defaultValueResolved = false;
            }
            $this->defaultValueEvaluator = null;
        }
        return $this->defaultValue;
    }

    /**
     * False when there is a default that could not be evaluated, so the null
     * getDefaultValue() returns does not mean the default is null.
     */
    public function isDefaultValueResolved(): bool
    {
        $this->getDefaultValue();
        return $this->defaultValueResolved;
    }

    public function setDefaultValueResolved(bool $defaultValueResolved): void
    {
        $this->defaultValueResolved = $defaultValueResolved;
    }

    public function setDefaultValueEvaluator(\Closure $evaluator): void
    {
        $this->defaultValueEvaluator = $evaluator;
    }
}
