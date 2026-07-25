<?php

namespace StubTests\Framework\Parsers\Types;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;

/**
 * Parses a type string into the model type objects (StandaloneType, UnionType,
 * NullableType, IntersectionType, NoType).
 *
 * The leaf-name handling is delegated to a caller-supplied resolver so the same
 * structural parser serves two use cases:
 *  - stub parsing, which resolves each leaf name against imports/namespace
 *    (see {@see \StubTests\Framework\Parsers\Stubs\Types\TypeNodeConverter});
 *  - serializer deserialization, which reads already fully-qualified names and
 *    resolves each leaf to itself (identity).
 *
 * Grammar handled:
 *   ""              -> NoType
 *   "(A&B)"         -> IntersectionType (parenthesised pure intersection)
 *   "A&B"           -> IntersectionType
 *   "A|null"        -> NullableType (exactly 2 parts, one is "null", other not a group)
 *   "int|(A&B)|..."  -> UnionType with IntersectionType members (DNF)
 *   "A|B|..."       -> UnionType
 *   "?A"            -> NullableType
 *   "A"             -> StandaloneType
 */
class TypeStringParser
{
    /**
     * @param string   $typeString  The type string to parse
     * @param callable $resolveName  fn(string $leafName): string — resolves a single leaf name
     */
    public function parse(string $typeString, callable $resolveName): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        if ($typeString === '') {
            return new NoType();
        }

        // Parenthesised pure intersection group: (Foo&Bar) — no union wrapper.
        // The "no |" guard keeps DNF strings like (A&B)|(C&D) out of this branch.
        if (str_starts_with($typeString, '(') && str_ends_with($typeString, ')') && !str_contains($typeString, '|')) {
            return $this->parseIntersectionGroup(substr($typeString, 1, -1), $resolveName);
        }

        // Union type (may contain DNF groups like int|(Foo&Bar)): check | before &
        // so DNF strings aren't misrouted to intersection parsing.
        if (str_contains($typeString, '|')) {
            return $this->parseUnionType($typeString, $resolveName);
        }

        // Pure intersection type without parens: Foo&Bar
        if (str_contains($typeString, '&')) {
            return $this->parseIntersectionGroup($typeString, $resolveName);
        }

        // Nullable shorthand: ?Foo
        if (str_starts_with($typeString, '?')) {
            return new NullableType(new StandaloneType($resolveName(substr($typeString, 1))));
        }

        return new StandaloneType($resolveName($typeString));
    }

    private function parseUnionType(string $typeString, callable $resolveName): UnionType|NullableType
    {
        $parts = $this->splitUnionParts($typeString);

        // Nullable: exactly 2 parts, one is "null" and the other is not a group.
        if (count($parts) === 2 && in_array('null', $parts, true)) {
            $nonNullPart = $parts[0] === 'null' ? $parts[1] : $parts[0];
            if (!str_starts_with($nonNullPart, '(')) {
                return new NullableType(new StandaloneType($resolveName($nonNullPart)));
            }
        }

        $unionType = new UnionType();
        foreach ($parts as $part) {
            if (str_starts_with($part, '(') && str_ends_with($part, ')')) {
                $unionType->addType($this->parseIntersectionGroup(substr($part, 1, -1), $resolveName));
            } else {
                $unionType->addType(new StandaloneType($resolveName($part)));
            }
        }

        return $unionType;
    }

    private function parseIntersectionGroup(string $inner, callable $resolveName): IntersectionType
    {
        $intersectionType = new IntersectionType();
        foreach (explode('&', $inner) as $part) {
            $intersectionType->addType(new StandaloneType($resolveName(trim($part))));
        }
        return $intersectionType;
    }

    /**
     * Split a union type string on '|' while respecting parenthesised groups.
     * e.g. "int|(Foo&Bar)|null" -> ["int", "(Foo&Bar)", "null"]
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
}
