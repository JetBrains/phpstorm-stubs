<?php

namespace StubTests\Framework\Serialization;

use StubTests\Framework\Model\Types\IntersectionType;
use StubTests\Framework\Model\Types\NoType;
use StubTests\Framework\Model\Types\NullableType;
use StubTests\Framework\Model\Types\StandaloneType;
use StubTests\Framework\Model\Types\UnionType;
use StubTests\Framework\Parsers\Types\TypeStringParser;

/**
 * Shared utility methods for serializers: type parsing and JSON-safe conversion.
 */
trait SerializerUtilsTrait
{
    private ?TypeStringParser $typeStringParser = null;

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

        // The reflection-side equivalent: an enum case captured in Stage 1 as a portable
        // reference, because a live instance cannot cross the two-stage container hop. Rendered
        // identically to a live instance so caches generated either way are byte-identical.
        if ($value instanceof \StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedEnumCaseReference) {
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
     * Parse a type string (already fully-qualified, as stored in the cache) back into
     * the correct type object. Leaf names are used verbatim — see {@see TypeStringParser}
     * for the grammar handled.
     */
    protected function parseType(?string $typeStr): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        $this->typeStringParser ??= new TypeStringParser();
        return $this->typeStringParser->parse($typeStr ?? '', static fn (string $name): string => $name);
    }
}
