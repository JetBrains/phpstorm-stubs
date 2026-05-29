<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Scalar\String_;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantDefinitionNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicExprValueResolverTrait;

/**
 * Adapter for nikic/php-parser FuncCall nodes representing define() calls.
 * Wraps define() function calls and provides parser-agnostic access to constant properties.
 */
class NikicConstantDefinitionNode implements ConstantDefinitionNode
{
    use NikicExprValueResolverTrait;

    private FuncCall $funcCall;
    private string $namespace = '\\';

    public function __construct(FuncCall $funcCall)
    {
        $this->funcCall = $funcCall;
    }

    public function getName(): string
    {
        // First argument of define() is the constant name
        if (!isset($this->funcCall->args[0])) {
            throw new \RuntimeException('define() call missing constant name argument');
        }

        $arg = $this->funcCall->args[0];
        if (!$arg instanceof Arg) {
            throw new \RuntimeException('Invalid argument structure in define() call');
        }

        // The name should be a string literal
        if ($arg->value instanceof String_) {
            return $arg->value->value;
        }

        // If it's not a string literal, try to convert it to string
        throw new \RuntimeException('define() constant name must be a string literal');
    }

    public function getValue(): mixed
    {
        // Second argument of define() is the constant value
        if (!isset($this->funcCall->args[1])) {
            throw new \RuntimeException('define() call missing constant value argument');
        }

        $arg = $this->funcCall->args[1];
        if (!$arg instanceof Arg) {
            throw new \RuntimeException('Invalid argument structure in define() call');
        }

        return self::resolveExprValue($arg->value);
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
