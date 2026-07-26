<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Param;
use StubTests\Framework\Parsers\Stubs\Nodes\ParameterNode;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Adapter for nikic/php-parser Param nodes.
 */
class NikicParameterNode implements ParameterNode
{
    use NikicConstExprEvaluatorTrait;
    private Param $param;

    public function __construct(Param $param)
    {
        $this->param = $param;
    }

    public function getName(): string
    {
        return $this->param->var->name;
    }

    public function getType(): ?TypeNode
    {
        if ($this->param->type === null) {
            return null;
        }

        return new NikicTypeNode($this->param->type);
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->param->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }

    public function isVariadic(): bool
    {
        return $this->param->variadic;
    }

    public function hasDefaultValue(): bool
    {
        return $this->param->default !== null;
    }

    public function getDefaultValue(): mixed
    {
        if ($this->param->default === null) {
            throw new \RuntimeException('Parameter has no default value');
        }

        return self::evaluateConstExpr($this->param->default);
    }
}
