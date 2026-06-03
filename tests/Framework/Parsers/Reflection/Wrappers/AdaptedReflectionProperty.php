<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper around ReflectionProperty
 *
 * Uses automatic extraction to get all property data
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionProperty extends AbstractReflectionAdapter
{
    public function __construct($reflectionProperty)
    {
        // Use generic extraction for all properties
        $this->extractFromReflection($reflectionProperty);

        // Custom handling if needed
        $this->postExtract($reflectionProperty);
    }

    /**
     * Get additional skip methods specific to ReflectionProperty
     * Most common patterns are now in ReflectionTypeRegistry::getGlobalSkipPatterns()
     */
    protected function getAdditionalSkipMethods()
    {
        // getValue/setValue/isInitialized require object instance, so handle separately
        return [
            'getValue',
            'setValue',
            'isInitialized'
        ];
    }

    /**
     * Handle complex properties after basic extraction
     */
    protected function postExtract($reflectionObject)
    {
        // Store declaring class name if needed to avoid recursion
        $declaringClass = $reflectionObject->getDeclaringClass();
        $this->setData('declaringClassName', $declaringClass->getName());

        // Handle type if present (PHP 7.4+)
        if (method_exists($reflectionObject, 'hasType') && $reflectionObject->hasType()) {
            $type = $reflectionObject->getType();
            if ($type) {
                $this->setData('getType', new AdaptedReflectionType($type));
            } else {
                $this->setData('getType', null);
            }
        } else {
            $this->setData('getType', null);
        }

        // Extract default value (PHP 8.0+)
        if (method_exists($reflectionObject, 'hasDefaultValue') && $reflectionObject->hasDefaultValue()) {
            try {
                $this->setData('getDefaultValue', $reflectionObject->getDefaultValue());
            } catch (\Exception $e) {
                // Can't access default value
                $this->setData('getDefaultValue', null);
            }
        } else {
            $this->setData('getDefaultValue', null);
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

    // Implement ReflectionProperty interface methods explicitly for IDE support
    public function getName()
    {
        return $this->getData('getName');
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

    public function isDefault()
    {
        return $this->getData('isDefault', false);
    }

    public function isReadonly()
    {
        // PHP's ReflectionProperty method is isReadOnly() (capital O), stored under that key
        return $this->getData('isReadOnly', false);
    }

    public function getDeclaringClass()
    {
        // Return a minimal wrapper with just the name
        return new AdaptedReflectionClassReference($this->getData('declaringClassName'));
    }

    public function hasType()
    {
        return $this->getData('hasType', false);
    }

    public function getType()
    {
        return $this->getData('getType');
    }

    public function hasDefaultValue()
    {
        return $this->getData('hasDefaultValue', false);
    }

    public function getDefaultValue()
    {
        return $this->getData('getDefaultValue');
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
