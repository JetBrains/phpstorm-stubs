<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicAttributeNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicDocCommentNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicTypeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Nodes\PropertyNode;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Adapter for nikic/php-parser PropertyProperty nodes.
 * Implements complete PropertyNode interface.
 * Requires both PropertyProperty (for name) and Property statement (for modifiers/type).
 */
class NikicPropertyNode implements PropertyNode
{
    private PropertyProperty $property;
    private Property $propertyStmt;

    public function __construct(PropertyProperty $property, Property $propertyStmt)
    {
        $this->property = $property;
        $this->propertyStmt = $propertyStmt;
    }

    public function getName(): string
    {
        return $this->property->name->toString();
    }

    public function isPublic(): bool
    {
        return $this->propertyStmt->isPublic();
    }

    public function isProtected(): bool
    {
        return $this->propertyStmt->isProtected();
    }

    public function isPrivate(): bool
    {
        return $this->propertyStmt->isPrivate();
    }

    public function isStatic(): bool
    {
        return $this->propertyStmt->isStatic();
    }

    public function isReadonly(): bool
    {
        return $this->propertyStmt->isReadonly();
    }

    public function getType(): ?TypeNode
    {
        if ($this->propertyStmt->type === null) {
            return null;
        }
        return new NikicTypeNode($this->propertyStmt->type);
    }

    public function getDocComment(): ?DocCommentNode
    {
        $docComment = $this->propertyStmt->getDocComment();
        if ($docComment === null) {
            return null;
        }
        return new NikicDocCommentNode($docComment);
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->propertyStmt->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }
}
