<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Stmt\Function_;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Nodes\FunctionNode;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Adapter for nikic/php-parser Function_ nodes.
 */
class NikicFunctionNode implements FunctionNode
{
    private Function_ $function;
    private string $namespace = '\\';
    private array $imports = [];

    public function __construct(Function_ $function)
    {
        $this->function = $function;
    }

    public function getName(): string
    {
        return $this->function->name->toString();
    }

    public function getParameters(): array
    {
        $parameters = [];
        foreach ($this->function->params as $param) {
            $parameters[] = new NikicParameterNode($param);
        }
        return $parameters;
    }

    public function getReturnType(): ?TypeNode
    {
        if ($this->function->returnType === null) {
            return null;
        }

        return new NikicTypeNode($this->function->returnType);
    }

    public function getDocComment(): ?DocCommentNode
    {
        $docComment = $this->function->getDocComment();
        if ($docComment === null) {
            return null;
        }

        return new NikicDocCommentNode($docComment);
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->function->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }

    public function setImports(array $imports): void
    {
        $this->imports = $imports;
    }

    public function getImports(): array
    {
        return $this->imports;
    }
}
