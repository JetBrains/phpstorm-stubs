<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Const_;
use PhpParser\Node\Stmt\ClassConst;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;

/**
 * Adapter for nikic/php-parser Const_ nodes.
 * Implements complete ConstantNode interface.
 * Requires both Const_ (for name) and ClassConst statement (for visibility/final).
 */
class NikicConstantNode implements ConstantNode
{
    use NikicExprValueResolverTrait;
    private Const_ $constant;
    private ClassConst $classConst;

    public function __construct(Const_ $constant, ClassConst $classConst)
    {
        $this->constant = $constant;
        $this->classConst = $classConst;
    }

    public function getName(): string
    {
        return $this->constant->name->toString();
    }

    public function getValue(): mixed
    {
        return self::resolveExprValue($this->constant->value);
    }

    public function isPublic(): bool
    {
        return $this->classConst->isPublic();
    }

    public function isProtected(): bool
    {
        return $this->classConst->isProtected();
    }

    public function isPrivate(): bool
    {
        return $this->classConst->isPrivate();
    }

    public function isFinal(): bool
    {
        return $this->classConst->isFinal();
    }

    public function getDocComment(): ?DocCommentNode
    {
        $docComment = $this->classConst->getDocComment();
        if ($docComment === null) {
            return null;
        }
        return new NikicDocCommentNode($docComment);
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->classConst->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }
}
