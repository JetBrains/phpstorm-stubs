<?php

namespace StubTests\Framework\Parsers\Serializers;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;

/**
 * Shared utility methods for serializers: type parsing and JSON-safe conversion.
 */
trait SerializerUtilsTrait
{
    /**
     * Return the short (unqualified) form of a possibly-qualified class name.
     * E.g. "\Foo\Bar" or "Foo\Bar" -> "Bar"; "Bar" -> "Bar".
     */
    protected function shortClassName(?string $name): ?string
    {
        if ($name === null || $name === '') {
            return $name;
        }
        $pos = strrpos($name, '\\');
        return $pos === false ? $name : substr($name, $pos + 1);
    }

    /**
     * Convert value to JSON-safe format, filtering out resources and closures
     */
    protected function toJsonSafe($value)
    {
        if (is_resource($value)) {
            return '[resource]';
        }

        if ($value instanceof \Closure) {
            return '[closure]';
        }

        // Enum-case default resolved from stub sources (declaring extension not
        // loaded). Render it exactly as a runtime-resolved enum instance would be.
        if ($value instanceof \StubTests\Framework\Parsers\Stubs\StubEnumCaseReference) {
            return '[object:' . $value->getEnumFqn() . ']';
        }

        if (is_object($value) && !($value instanceof \stdClass) && !($value instanceof \DateTimeInterface)) {
            // Check if object has toString() method (e.g., type objects)
            if (method_exists($value, 'toString')) {
                return $value->toString();
            }
            // Skip complex objects that aren't basic types
            return '[object:' . get_class($value) . ']';
        }

        if (is_array($value)) {
            return array_map([$this, 'toJsonSafe'], $value);
        }

        return $value;
    }

    /**
     * Parse a type string back into the correct type object.
     *
     * Rules:
     *   ""              -> NoType
     *   "A&B"           -> IntersectionType
     *   "(A&B)"         -> IntersectionType  (parenthesised pure intersection)
     *   "A|null"        -> NullableType  (exactly 2 parts, one is "null")
     *   "int|(A&B)|..."  -> UnionType with IntersectionType member (DNF)
     *   "A|B|..."       -> UnionType
     *   "?A"            -> NullableType
     *   "A"             -> StandaloneType
     */
    protected function parseType(?string $typeStr): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        if ($typeStr === null || $typeStr === '') {
            return new NoType();
        }

        // Pure intersection type (no union): "A&B" or "(A&B)"
        if (str_starts_with($typeStr, '(') && str_ends_with($typeStr, ')') && !str_contains($typeStr, '|')) {
            return $this->parseIntersectionGroup(substr($typeStr, 1, -1));
        }

        if (!str_contains($typeStr, '|') && str_contains($typeStr, '&')) {
            return $this->parseIntersectionGroup($typeStr);
        }

        if (str_contains($typeStr, '|')) {
            $parts = $this->splitUnionParts($typeStr);
            $nullIndex = array_search('null', $parts, true);
            // Nullable: exactly 2 parts where one is "null" and the other is not a group
            if (count($parts) === 2 && $nullIndex !== false) {
                $basicPart = $parts[$nullIndex === 0 ? 1 : 0];
                if (!str_starts_with($basicPart, '(')) {
                    return new NullableType(new StandaloneType($basicPart));
                }
            }
            $union = new UnionType();
            foreach ($parts as $part) {
                if (str_starts_with($part, '(') && str_ends_with($part, ')')) {
                    $union->addType($this->parseIntersectionGroup(substr($part, 1, -1)));
                } else {
                    $union->addType(new StandaloneType($part));
                }
            }
            return $union;
        }

        if (str_starts_with($typeStr, '?')) {
            return new NullableType(new StandaloneType(substr($typeStr, 1)));
        }

        return new StandaloneType($typeStr);
    }

    private function parseIntersectionGroup(string $inner): IntersectionType
    {
        $type = new IntersectionType();
        foreach (explode('&', $inner) as $part) {
            $type->addType(new StandaloneType(trim($part)));
        }
        return $type;
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
