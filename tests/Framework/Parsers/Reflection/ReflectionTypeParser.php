<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;

/**
 * Parser for ReflectionType objects
 *
 * Handles parsing of all PHP type declarations including:
 * - Standalone types (int, string, MyClass, etc.)
 * - Union types (string|int|null)
 * - Intersection types (Foo&Bar)
 * - Nullable types (?string / string|null)
 * - No type (missing type hint)
 */
class ReflectionTypeParser
{
    /**
     * Parse a ReflectionType (or AdaptedReflectionType) into our type model
     *
     * @param \ReflectionType|object|null $reflectionType The reflection type object to parse
     * @return StandaloneType|UnionType|NullableType|NoType|IntersectionType Returns our type model representation
     */
    public function parse($reflectionType)
    {
        if ($reflectionType === null) {
            return new NoType();
        }

        // Use duck typing to check for union types (supports both real Reflection and wrappers)
        $isUnion = ($reflectionType instanceof \ReflectionUnionType) ||
                   (method_exists($reflectionType, 'isUnionType') && $reflectionType->isUnionType());

        // Use duck typing to check for intersection types (supports both real Reflection and wrappers)
        $isIntersection = (class_exists('\ReflectionIntersectionType') &&
                          $reflectionType instanceof \ReflectionIntersectionType) ||
                         (method_exists($reflectionType, 'isIntersectionType') &&
                          $reflectionType->isIntersectionType());

        if ($isUnion) {
            return $this->parseUnionType($reflectionType);
        } elseif ($isIntersection) {
            return $this->parseIntersectionType($reflectionType);
        } elseif ($reflectionType->allowsNull()) {
            return $this->parseNullableType($reflectionType);
        } else {
            return $this->parseStandaloneType($reflectionType);
        }
    }

    /**
     * Parse a union type (e.g., string|int|null)
     *
     * @param \ReflectionUnionType|object $reflectionType
     * @return UnionType
     */
    private function parseUnionType($reflectionType): UnionType
    {
        $unionType = new UnionType();
        foreach ($reflectionType->getTypes() as $item) {
            $member = $this->parseUnionMember($item);
            if ($member !== null) {
                $unionType->addType($member);
            }
        }
        return $unionType;
    }

    /**
     * Parse one member of a union, which since PHP 8.2 may itself be an intersection
     * group (DNF, e.g. `null|(A&B)`).
     *
     * Two shapes reach this method and both must yield the same model, otherwise the
     * reflection side renders a DNF type differently from the stubs side and the
     * comparison fails on a type that is actually identical:
     *  - live reflection hands over a ReflectionIntersectionType, which has no getName();
     *    it was previously skipped outright, silently reducing `null|(A&B)` to `null`;
     *  - the wrapper (AdaptedReflectionType) pre-flattens the group into the single name
     *    "A&B", which rendered without parentheses as `A&B|null` rather than `(A&B)|null`.
     *
     * @param object $item
     * @return StandaloneType|IntersectionType|null Null when the member cannot be read
     */
    private function parseUnionMember($item)
    {
        $isIntersection = (class_exists('\ReflectionIntersectionType') && $item instanceof \ReflectionIntersectionType)
            || (method_exists($item, 'isIntersectionType') && $item->isIntersectionType());

        if ($isIntersection && method_exists($item, 'getTypes')) {
            return $this->parseIntersectionType($item);
        }

        if (!($item instanceof \ReflectionNamedType) && !method_exists($item, 'getName')) {
            return null;
        }

        $name = $item->getName();
        if ($name === null) {
            return null;
        }

        // Wrapper-flattened intersection group, e.g. "A&B".
        if (str_contains($name, '&')) {
            $intersection = new IntersectionType();
            foreach (explode('&', $name) as $part) {
                $part = trim($part);
                if ($part !== '') {
                    $intersection->addType(new StandaloneType($part));
                }
            }
            return $intersection;
        }

        return new StandaloneType($name);
    }

    /**
     * Parse an intersection type (e.g., Foo&Bar)
     *
     * @param \ReflectionIntersectionType|object $reflectionType
     * @return IntersectionType
     */
    private function parseIntersectionType($reflectionType): IntersectionType
    {
        $intersectionType = new IntersectionType();
        foreach ($reflectionType->getTypes() as $item) {
            if ($item instanceof \ReflectionNamedType || method_exists($item, 'getName')) {
                $intersectionType->addType(new StandaloneType($item->getName()));
            }
        }
        return $intersectionType;
    }

    /**
     * Parse a nullable type (e.g., ?string or string|null)
     *
     * @param \ReflectionNamedType|object $reflectionType
     * @return NullableType|NoType
     */
    private function parseNullableType($reflectionType)
    {
        $typeName = $reflectionType->getName();
        if ($typeName === null) {
            return new NoType();
        }
        return new NullableType(new StandaloneType($typeName));
    }

    /**
     * Parse a standalone type (e.g., int, string, MyClass)
     *
     * @param \ReflectionNamedType|object $reflectionType
     * @return StandaloneType|NoType
     */
    private function parseStandaloneType($reflectionType)
    {
        $typeName = $reflectionType->getName();
        if ($typeName === null) {
            return new NoType();
        }
        return new StandaloneType($typeName);
    }
}
