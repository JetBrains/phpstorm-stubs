<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Stmt\ClassMethod;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicAttributeNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicDocCommentNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicParameterNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicTypeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Nodes\MethodNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ParameterNode;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Adapter for nikic/php-parser ClassMethod nodes.
 * Implements complete MethodNode interface.
 */
class NikicMethodNode implements MethodNode
{
    private ClassMethod $method;

    public function __construct(ClassMethod $method)
    {
        $this->method = $method;
    }

    public function getName(): string
    {
        return $this->method->name->toString();
    }

    public function isPublic(): bool
    {
        return $this->method->isPublic();
    }

    public function isProtected(): bool
    {
        return $this->method->isProtected();
    }

    public function isPrivate(): bool
    {
        return $this->method->isPrivate();
    }

    public function isStatic(): bool
    {
        return $this->method->isStatic();
    }

    public function isFinal(): bool
    {
        return $this->method->isFinal();
    }

    public function isAbstract(): bool
    {
        return $this->method->isAbstract();
    }

    /**
     * @return ParameterNode[]
     */
    public function getParameters(): array
    {
        $parameters = [];
        foreach ($this->method->getParams() as $param) {
            $parameters[] = new NikicParameterNode($param);
        }
        return $parameters;
    }

    public function getReturnType(): ?TypeNode
    {
        if ($this->method->returnType === null) {
            return null;
        }
        return new NikicTypeNode($this->method->returnType);
    }

    public function getDocComment(): ?DocCommentNode
    {
        $docComment = $this->method->getDocComment();
        if ($docComment === null) {
            return null;
        }
        return new NikicDocCommentNode($docComment);
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->method->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }
}
