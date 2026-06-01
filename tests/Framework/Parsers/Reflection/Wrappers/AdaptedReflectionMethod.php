<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper around ReflectionMethod
 *
 * Uses automatic extraction with custom handling for declaring class
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionMethod extends AbstractReflectionAdapter
{
    public function __construct($reflectionMethod)
    {
        // Use generic extraction for basic properties
        $this->extractFromReflection($reflectionMethod);

        // Custom handling for special cases
        $this->postExtract($reflectionMethod);
    }

    /**
     * Get additional skip methods specific to ReflectionMethod
     * Most common patterns are now in ReflectionTypeRegistry::getGlobalSkipPatterns()
     */
    protected function getAdditionalSkipMethods()
    {
        // Only list methods specific to ReflectionMethod that aren't in global patterns
        return [
            'getPrototype'  // Specific to ReflectionMethod
        ];
    }

    /**
     * Handle complex properties after basic extraction
     */
    protected function postExtract($reflectionObject)
    {
        // Store declaring class as a minimal reference to avoid recursion
        $declaringClass = $reflectionObject->getDeclaringClass();
        $this->setData('declaringClassName', $declaringClass->getName());

        // Extract parameters
        $parameters = [];
        foreach ($reflectionObject->getParameters() as $parameter) {
            $parameters[] = new AdaptedReflectionParameter($parameter);
        }
        $this->setData('getParameters', $parameters);

        // Extract return type if exists (PHP 7.0+)
        if (method_exists($reflectionObject, 'hasReturnType') && $reflectionObject->hasReturnType()) {
            $returnType = $reflectionObject->getReturnType();
            if ($returnType) {
                $this->setData('getReturnType', new AdaptedReflectionType($returnType));
            } else {
                $this->setData('getReturnType', null);
            }
        } else {
            $this->setData('getReturnType', null);
        }

        // Extract doc comment
        $docComment = $reflectionObject->getDocComment();
        $this->setData('getDocComment', $docComment !== false ? $docComment : false);

        // Extract attributes (PHP 8.0+)
        if (method_exists($reflectionObject, 'getAttributes')) {
            try {
                $attributes = [];
                foreach ($reflectionObject->getAttributes() as $attribute) {
                    $attributes[] = [
                        'name' => $attribute->getName(),
                        'arguments' => $attribute->getArguments()
                    ];
                }
                $this->setData('getAttributes', $attributes);
            } catch (\Exception $e) {
                $this->setData('getAttributes', []);
            }
        } else {
            $this->setData('getAttributes', []);
        }
    }

    // Implement ReflectionMethod interface methods explicitly for IDE support
    public function getName()
    {
        return $this->getData('getName');
    }

    public function getDeclaringClass()
    {
        // Return a minimal wrapper with just the name
        return new AdaptedReflectionClassReference($this->getData('declaringClassName'));
    }

    public function isPublic()
    {
        return $this->getData('isPublic', false);
    }

    public function isProtected()
    {
        return $this->getData('isProtected', false);
    }

    public function isPrivate()
    {
        return $this->getData('isPrivate', false);
    }

    public function isStatic()
    {
        return $this->getData('isStatic', false);
    }

    public function isFinal()
    {
        return $this->getData('isFinal', false);
    }

    public function isAbstract()
    {
        return $this->getData('isAbstract', false);
    }

    public function isDeprecated()
    {
        return $this->getData('isDeprecated', false);
    }

    public function getParameters()
    {
        return $this->getData('getParameters', []);
    }

    public function hasReturnType()
    {
        return $this->getData('hasReturnType', false);
    }

    public function getReturnType()
    {
        return $this->getData('getReturnType');
    }

    public function getDocComment()
    {
        return $this->getData('getDocComment', false);
    }

    public function getAttributes()
    {
        return $this->getData('getAttributes', []);
    }

    public function hasTentativeReturnType()
    {
        return $this->getData('hasTentativeReturnType', false);
    }

    public function getTentativeReturnType()
    {
        return $this->getData('getTentativeReturnType');
    }
}
