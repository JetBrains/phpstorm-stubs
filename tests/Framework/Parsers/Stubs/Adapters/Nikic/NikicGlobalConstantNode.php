<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Comment\Doc;
use PhpParser\Node\Const_;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantDefinitionNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;

/**
 * Adapter for nikic/php-parser Const_ nodes representing global const declarations.
 * Wraps individual constants from const statements (e.g., const A = 1, B = 2).
 * Provides parser-agnostic access to constant properties.
 */
class NikicGlobalConstantNode implements ConstantDefinitionNode
{
    use NikicExprValueResolverTrait;
    private Const_ $const;
    private ?Doc $docComment;
    private string $namespace = '\\';

    /**
     * @param Const_ $const The individual constant node.
     * @param Doc|null $docComment The doc comment, which nikic attaches to the wrapping
     *                             Const_ statement rather than to the individual constant.
     *                             A single doc comment is shared by all constants declared
     *                             together (e.g. const A = 1, B = 2).
     */
    public function __construct(Const_ $const, ?Doc $docComment = null)
    {
        $this->const = $const;
        $this->docComment = $docComment;
    }

    public function getName(): string
    {
        return $this->const->name->toString();
    }

    public function getValue(): mixed
    {
        return self::resolveExprValue($this->const->value);
    }

    public function getDocComment(): ?DocCommentNode
    {
        if ($this->docComment === null) {
            return null;
        }

        return new NikicDocCommentNode($this->docComment);
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
