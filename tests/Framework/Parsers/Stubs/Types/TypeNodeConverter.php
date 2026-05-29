<?php

namespace StubTests\Framework\Parsers\Stubs\Types;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Converts TypeNode (from stub AST) to type objects (StandaloneType, UnionType, NullableType, NoType).
 * This provides a unified type representation between stubs and reflection parsers.
 * Resolves imported class names to fully qualified names.
 */
class TypeNodeConverter
{
    private array $imports;
    private string $namespace;

    /**
     * @param array $imports Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g., '\Dom' or '\\' for global)
     */
    public function __construct(array $imports = [], string $namespace = '\\')
    {
        $this->imports = $imports;
        $this->namespace = $namespace;
    }

    /**
     * Convert a TypeNode to a type object.
     *
     * @param TypeNode|null $typeNode The type node from stub AST
     * @return StandaloneType|UnionType|NullableType|NoType|IntersectionType The corresponding type object
     */
    public function convert(?TypeNode $typeNode): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        if ($typeNode === null) {
            return new NoType();
        }

        $typeString = $typeNode->toString();

        if ($typeString === '') {
            return new NoType();
        }

        return $this->parseTypeString($typeString);
    }

    /**
     * Parse a type string into type objects.
     * Handles:
     * - union types (string|int), including DNF (int|(Foo&Bar))
     * - nullable types (string|null or ?string rendered as string|null)
     * - intersection types ((Foo&Bar) or Foo&Bar)
     * - standalone types (string)
     *
     * @param string $typeString The type string to parse
     * @return StandaloneType|UnionType|NullableType|NoType|IntersectionType
     */
    private function parseTypeString(string $typeString): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        // Parenthesised intersection group: (Foo&Bar) — pure intersection type, no union wrapper
        if (str_starts_with($typeString, '(') && str_ends_with($typeString, ')')) {
            return $this->parseIntersectionGroup(substr($typeString, 1, -1));
        }

        // Union type (may contain DNF groups like int|(Foo&Bar)): check | before &
        // so DNF strings aren't misrouted to intersection parsing
        if (str_contains($typeString, '|')) {
            return $this->parseUnionType($typeString);
        }

        // Pure intersection type without parens: Foo&Bar
        if (str_contains($typeString, '&')) {
            return $this->parseIntersectionGroup($typeString);
        }

        // Standalone type - resolve it using imports
        $resolvedType = $this->resolveTypeName($typeString);
        return new StandaloneType($resolvedType);
    }

    /**
     * Parse a union type string into UnionType or NullableType.
     * Splits on '|' only outside parenthesised groups, so DNF types like
     * int|(Foo&Bar) are handled correctly.
     */
    private function parseUnionType(string $typeString): UnionType|NullableType
    {
        $parts = $this->splitUnionParts($typeString);

        // Nullable type: exactly 2 parts, one is 'null', the other is not a group
        if (count($parts) === 2 && in_array('null', $parts, true)) {
            $nonNullPart = $parts[0] === 'null' ? $parts[1] : $parts[0];
            if (!str_starts_with($nonNullPart, '(')) {
                $resolvedType = $this->resolveTypeName($nonNullPart);
                return new NullableType(new StandaloneType($resolvedType));
            }
        }

        // General union type — each part is either a standalone type or a (Foo&Bar) group
        $unionType = new UnionType();
        foreach ($parts as $part) {
            if (str_starts_with($part, '(') && str_ends_with($part, ')')) {
                $unionType->addType($this->parseIntersectionGroup(substr($part, 1, -1)));
            } else {
                $resolvedType = $this->resolveTypeName($part);
                $unionType->addType(new StandaloneType($resolvedType));
            }
        }

        return $unionType;
    }

    /**
     * Parse an intersection type string like "Foo&Bar" (without outer parentheses).
     */
    private function parseIntersectionGroup(string $inner): IntersectionType
    {
        $intersectionType = new IntersectionType();
        foreach (explode('&', $inner) as $part) {
            $resolvedType = $this->resolveTypeName(trim($part));
            $intersectionType->addType(new StandaloneType($resolvedType));
        }
        return $intersectionType;
    }

    /**
     * Split a union type string on '|' while respecting parenthesised groups.
     * e.g. "int|(Foo&Bar)|null" → ["int", "(Foo&Bar)", "null"]
     *
     * @return string[]
     */
    private function splitUnionParts(string $typeString): array
    {
        $parts = [];
        $depth = 0;
        $current = '';
        for ($i = 0, $len = strlen($typeString); $i < $len; $i++) {
            $c = $typeString[$i];
            if ($c === '(') {
                $depth++;
                $current .= $c;
            } elseif ($c === ')') {
                $depth--;
                $current .= $c;
            } elseif ($c === '|' && $depth === 0) {
                $parts[] = trim($current);
                $current = '';
            } else {
                $current .= $c;
            }
        }
        if ($current !== '') {
            $parts[] = trim($current);
        }
        return $parts;
    }

    /**
     * Resolve a type name using imports and namespace context to get the fully qualified name.
     *
     * @param string $typeName The type name to resolve (e.g., "Result", "int", "LDAP\Result", "Attr")
     * @return string The resolved type name with leading backslash (e.g., "\LDAP\Result", "int", "\Dom\Attr")
     */
    private function resolveTypeName(string $typeName): string
    {
        // Skip built-in types (they don't need resolution)
        $builtInTypes = [
            'int', 'string', 'bool', 'float', 'array', 'object', 'mixed',
            'void', 'never', 'null', 'false', 'true', 'callable', 'iterable',
            'resource', 'self', 'parent', 'static'
        ];

        if (in_array(strtolower($typeName), $builtInTypes, true)) {
            return $typeName;
        }

        // If it starts with backslash, it's already fully qualified
        if (str_starts_with($typeName, '\\')) {
            return $typeName;
        }

        // Check if it's an alias in imports
        if (isset($this->imports[$typeName])) {
            $resolved = $this->imports[$typeName];
            // Ensure it starts with backslash for FQN
            return str_starts_with($resolved, '\\') ? $resolved : '\\' . $resolved;
        }

        // If the type contains a namespace separator, it's a qualified name (not fully qualified)
        // e.g., "Dom\Attr" - prepend leading backslash
        if (str_contains($typeName, '\\')) {
            return '\\' . $typeName;
        }

        // Unqualified name - resolve relative to current namespace
        // e.g., in "namespace Dom;", "Attr" becomes "\Dom\Attr"
        if ($this->namespace === '\\') {
            // Global namespace
            return '\\' . $typeName;
        } else {
            // Prepend current namespace
            return $this->namespace . '\\' . $typeName;
        }
    }
}
