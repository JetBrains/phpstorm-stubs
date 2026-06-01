<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Interface_;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Nodes\InterfaceNode;

/**
 * Adapter for nikic/php-parser Interface_ nodes.
 * Wraps Interface_ and provides parser-agnostic access to interface properties.
 */
class NikicInterfaceNode implements InterfaceNode
{
    private Interface_ $interface;
    private string $namespace = '\\';

    public function __construct(Interface_ $interface)
    {
        $this->interface = $interface;
    }

    public function getName(): string
    {
        return $this->interface->name->toString();
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getParentInterfaceNames(): array
    {
        $names = [];
        foreach ($this->interface->extends as $parent) {
            $names[] = $parent->toString();
        }
        return $names;
    }

    public function getMethods(): array
    {
        $methods = [];
        foreach ($this->interface->stmts as $stmt) {
            if ($stmt instanceof ClassMethod) {
                $methods[] = new NikicMethodNode($stmt);
            }
        }
        return $methods;
    }

    public function getConstants(): array
    {
        $constants = [];
        foreach ($this->interface->stmts as $stmt) {
            if ($stmt instanceof ClassConst) {
                foreach ($stmt->consts as $const) {
                    $constants[] = new NikicConstantNode($const, $stmt);
                }
            }
        }
        return $constants;
    }

    public function getDocComment(): ?DocCommentNode
    {
        $docComment = $this->interface->getDocComment();
        if ($docComment === null) {
            return null;
        }
        return new NikicDocCommentNode($docComment);
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->interface->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }
}
