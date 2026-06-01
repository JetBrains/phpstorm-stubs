<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper around ReflectionType (ReflectionNamedType, ReflectionUnionType, etc.)
 *
 * Uses automatic extraction with custom handling for union/intersection types
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionType extends AbstractReflectionAdapter
{
    public function __construct($reflectionType)
    {
        // Use generic extraction for basic properties
        $this->extractFromReflection($reflectionType);

        // Custom handling for complex type structures
        $this->postExtract($reflectionType);
    }

    /**
     * Get additional skip methods specific to ReflectionType
     * Most common patterns are now in ReflectionTypeRegistry::getGlobalSkipPatterns()
     */
    protected function getAdditionalSkipMethods()
    {
        // Skip methods that need special handling based on type variant
        return [
            'getName',      // Handle specially based on union/intersection/named
            '__toString'    // Should not be auto-extracted
        ];
    }

    /**
     * Handle complex type structures after basic extraction
     */
    protected function postExtract($reflectionObject)
    {
        // Detect type kind
        $isUnion = $reflectionObject instanceof \ReflectionUnionType;
        $isIntersection = class_exists('\ReflectionIntersectionType') && $reflectionObject instanceof \ReflectionIntersectionType;
        $isComposite = $isUnion || $isIntersection;

        $this->setData('isUnionType', $isUnion);
        $this->setData('isIntersectionType', $isIntersection);

        // Handle composite types (union/intersection) - both have getTypes() method
        if ($isComposite) {
            $types = [];
            foreach ($reflectionObject->getTypes() as $type) {
                // PHP 8.2+ DNF types: a union can contain intersection sub-groups
                // e.g. int|(Foo&Bar) → getTypes() yields [ReflectionNamedType, ReflectionIntersectionType]
                if (class_exists('\ReflectionIntersectionType') && $type instanceof \ReflectionIntersectionType) {
                    $parts = [];
                    foreach ($type->getTypes() as $innerType) {
                        $parts[] = $innerType->getName();
                    }
                    $types[] = implode('&', $parts);
                } else {
                    $types[] = $type->getName();
                }
            }
            $this->setData('getTypes', $types);
            $this->setData('getName', null);
        }
        // Handle named types and fallback - use getName() if available
        elseif (method_exists($reflectionObject, 'getName')) {
            $this->setData('getName', $reflectionObject->getName());
            $this->setData('getTypes', []);
        }
        // Fallback for unknown types
        else {
            $this->setData('getName', null);
            $this->setData('getTypes', []);
        }
    }

    // Implement ReflectionType interface methods explicitly for IDE support
    public function allowsNull()
    {
        return $this->getData('allowsNull', false);
    }

    public function getName()
    {
        return $this->getData('getName');
    }

    public function getTypes()
    {
        // Return array of pseudo-ReflectionNamedType objects
        $types = $this->getData('getTypes', []);
        $result = [];
        foreach ($types as $typeName) {
            $result[] = new AdaptedReflectionNamedType($typeName);
        }
        return $result;
    }

    public function isUnionType()
    {
        return $this->getData('isUnionType', false);
    }

    public function isIntersectionType()
    {
        return $this->getData('isIntersectionType', false);
    }

    public function isBuiltin()
    {
        return $this->getData('isBuiltin', false);
    }
}
