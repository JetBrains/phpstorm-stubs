<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Adapter for nikic/php-parser type nodes.
 */
class NikicTypeNode implements TypeNode
{
    private Node $typeNode;

    public function __construct(Node $typeNode)
    {
        $this->typeNode = $typeNode;
    }

    public function toString(): string
    {
        return $this->parseType($this->typeNode);
    }

    private function parseType(Node $typeNode): string
    {
        if ($typeNode instanceof \PhpParser\Node\Identifier) {
            return $typeNode->toString();
        } elseif ($typeNode instanceof \PhpParser\Node\Name\FullyQualified) {
            // Preserve the leading backslash so TypeNodeConverter knows it's already FQN
            return '\\' . $typeNode->toString();
        } elseif ($typeNode instanceof \PhpParser\Node\Name) {
            return $typeNode->toString();
        } elseif ($typeNode instanceof \PhpParser\Node\UnionType) {
            $types = [];
            foreach ($typeNode->types as $type) {
                $types[] = $this->parseType($type);
            }
            return implode('|', $types);
        } elseif ($typeNode instanceof \PhpParser\Node\NullableType) {
            return $this->parseType($typeNode->type) . '|null';
        } elseif ($typeNode instanceof \PhpParser\Node\IntersectionType) {
            $types = [];
            foreach ($typeNode->types as $type) {
                $types[] = $this->parseType($type);
            }
            return '(' . implode('&', $types) . ')';
        }

        return '';
    }
}
