<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Const_;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantDefinitionNode;

/**
 * Adapter for nikic/php-parser Const_ nodes representing global const declarations.
 * Wraps individual constants from const statements (e.g., const A = 1, B = 2).
 * Provides parser-agnostic access to constant properties.
 */
class NikicGlobalConstantNode implements ConstantDefinitionNode
{
    use NikicExprValueResolverTrait;
    private Const_ $const;
    private string $namespace = '\\';

    public function __construct(Const_ $const)
    {
        $this->const = $const;
    }

    public function getName(): string
    {
        return $this->const->name->toString();
    }

    public function getValue(): mixed
    {
        return self::resolveExprValue($this->const->value);
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }
}
