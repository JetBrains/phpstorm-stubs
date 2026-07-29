<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Converts a value read from the Reflection API into something that survives serialization.
 *
 * Stage 1 of the reflection pipeline serializes its extracted data so Stage 2 can rebuild it in a
 * different container. Anything reachable from a reflected value therefore has to be representable
 * without depending on classes that may not exist on the other side.
 *
 * This used to live on {@see ReflectionMethodExtractor} as a second static, which was a poor fit:
 * that class is about *calling getter methods* on a reflection object, while this is about
 * normalising arbitrary values. The mismatch became obvious once property, parameter and constant
 * adapters needed it — `ReflectionMethodExtractor::makeSerializable()` on a property default reads as
 * though a method extractor were involved in property handling, which it is not.
 *
 * PHP 5.6+ compatible (no typed properties, no return types) — Stage 1 runs on every reflected
 * version, down to 5.6.
 */
class ReflectionValueNormalizer
{
    /**
     * Recursively convert a reflected value into a serializable form.
     *
     * @param mixed $value
     * @param int   $depth    Current recursion depth
     * @param int   $maxDepth Depth at which to give up and return null
     * @return mixed
     */
    public static function makeSerializable($value, $depth = 0, $maxDepth = 3)
    {
        // Prevent infinite recursion
        if ($depth >= $maxDepth) {
            return null;
        }

        // Handle null
        if ($value === null || $value === false) {
            return $value;
        }

        // Handle arrays
        if (is_array($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $result[$key] = self::makeSerializable($item, $depth + 1, $maxDepth);
            }
            return $result;
        }

        // Handle Reflection objects - wrap them using the registry
        if (is_object($value)) {
            // For already adapted wrappers, return as-is
            // Use instanceof for type-safe checking instead of string matching
            if ($value instanceof AbstractReflectionAdapter) {
                return $value;
            }

            // Try to create an adapter using the registry
            $adapter = ReflectionTypeRegistry::createAdapter($value);
            if ($adapter !== null) {
                return $adapter;
            }

            // For other objects, convert to string representation to avoid serialization issues
            // This prevents problems with built-in classes (like Uri\UriComparisonMode in PHP 8.4+)
            // that may not exist when deserializing in a different PHP environment
            $className = get_class($value);

            // Try __toString first for better representation
            if (method_exists($value, '__toString')) {
                return (string)$value;
            }

            // Enum cases: replace with a portable reference. `name` is a *property* on an enum
            // case, not a method, so an earlier method_exists($value, 'name') check never matched
            // and enums fell through to the class-name fallback below — which is how a live enum
            // instance could reach the serialized payload. See AdaptedEnumCaseReference.
            //
            // instanceof \UnitEnum is safe on every supported runtime: on PHP < 8.1 the interface
            // does not exist and the check is simply false.
            if ($value instanceof \UnitEnum) {
                return new AdaptedEnumCaseReference($className, $value->name);
            }

            // Return just the class name as a safe fallback
            return $className;
        }

        // Return primitives as-is
        return $value;
    }
}
