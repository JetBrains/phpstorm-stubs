<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicAttributeNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicConstantNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicDocCommentNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicMethodNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicPropertyNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ClassNode;

/**
 * Adapter for nikic/php-parser Class_ nodes.
 */
class NikicClassNode implements ClassNode
{
    private Class_ $class;
    private string $namespace = '\\';

    public function __construct(Class_ $class)
    {
        $this->class = $class;
    }

    public function getName(): string
    {
        return $this->class->name->toString();
    }

    public function isFinal(): bool
    {
        return $this->class->isFinal();
    }

    public function isReadonly(): bool
    {
        return $this->class->isReadonly();
    }

    public function getParentClassName(): ?string
    {
        if ($this->class->extends === null) {
            return null;
        }

        return $this->class->extends->toString();
    }

    public function getInterfaceNames(): array
    {
        $interfaces = [];
        foreach ($this->class->implements as $interface) {
            $interfaces[] = $interface->toString();
        }
        return $interfaces;
    }

    public function getMethods(): array
    {
        $methods = [];
        foreach ($this->class->stmts as $stmt) {
            if ($stmt instanceof ClassMethod) {
                $methods[] = new NikicMethodNode($stmt);
            }
        }
        return $methods;
    }

    public function getProperties(): array
    {
        $properties = [];
        foreach ($this->class->stmts as $stmt) {
            if ($stmt instanceof Property) {
                foreach ($stmt->props as $prop) {
                    // Pass both PropertyProperty and parent Property statement
                    $properties[] = new NikicPropertyNode($prop, $stmt);
                }
            }
        }
        return $properties;
    }

    public function getConstants(): array
    {
        $constants = [];
        foreach ($this->class->stmts as $stmt) {
            if ($stmt instanceof ClassConst) {
                foreach ($stmt->consts as $const) {
                    // Pass both Const_ and parent ClassConst statement
                    $constants[] = new NikicConstantNode($const, $stmt);
                }
            }
        }
        return $constants;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getDocComment(): ?NikicDocCommentNode
    {
        $docComment = $this->class->getDocComment();
        return $docComment ? new NikicDocCommentNode($docComment) : null;
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->class->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }
}
