<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper around ReflectionClassConstant (PHP 7.1+)
 *
 * Uses automatic extraction with custom handling for declaring class
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionClassConstant extends AbstractReflectionAdapter
{
    public function __construct($reflectionConstant)
    {
        // Use generic extraction for basic properties
        $this->extractFromReflection($reflectionConstant);

        // Custom handling for special cases
        $this->postExtract($reflectionConstant);
    }

    /**
     * Get additional skip methods specific to ReflectionClassConstant
     * Most common patterns are now in ReflectionTypeRegistry::getGlobalSkipPatterns()
     */
    protected function getAdditionalSkipMethods()
    {
        // All methods are now covered by global patterns
        return [];
    }

    /**
     * Handle complex properties after basic extraction
     */
    protected function postExtract($reflectionObject)
    {
        // Store declaring class as a minimal reference to avoid recursion
        $declaringClass = $reflectionObject->getDeclaringClass();
        $this->setData('declaringClassName', $declaringClass->getName());

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

    // Implement ReflectionClassConstant interface methods explicitly for IDE support
    public function getName()
    {
        return $this->getData('getName');
    }

    public function getValue()
    {
        return $this->getData('getValue');
    }

    public function getDeclaringClass()
    {
        // Return a minimal reference to avoid recursion
        return new AdaptedReflectionClassReference($this->getData('declaringClassName'));
    }

    public function isPrivate()
    {
        return $this->getData('isPrivate', false);
    }

    public function isProtected()
    {
        return $this->getData('isProtected', false);
    }

    public function isPublic()
    {
        return $this->getData('isPublic', true);
    }

    public function isFinal()
    {
        return $this->getData('isFinal', false);
    }

    public function isEnumCase()
    {
        return $this->getData('isEnumCase', false);
    }

    public function getDocComment()
    {
        return $this->getData('getDocComment', false);
    }

    public function getAttributes()
    {
        return $this->getData('getAttributes', []);
    }
}
