<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper around ReflectionParameter
 *
 * Uses automatic extraction to get all parameter data
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionParameter extends AbstractReflectionAdapter
{
    public function __construct($reflectionParameter)
    {
        // Use generic extraction for all properties
        $this->extractFromReflection($reflectionParameter);

        // Custom handling if needed
        $this->postExtract($reflectionParameter);
    }

    /**
     * Get additional skip methods specific to ReflectionParameter
     * Most common patterns are now in ReflectionTypeRegistry::getGlobalSkipPatterns()
     */
    protected function getAdditionalSkipMethods()
    {
        // Only list methods specific to ReflectionParameter
        return [
            'getClass'  // Deprecated in PHP 8.0, but needs special handling in older versions
        ];
    }

    /**
     * Handle complex properties after basic extraction
     */
    protected function postExtract($reflectionObject)
    {
        // Extract type if present (PHP 7.0+)
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

        // Extract default value if available
        if (method_exists($reflectionObject, 'isDefaultValueAvailable') && $reflectionObject->isDefaultValueAvailable()) {
            try {
                $this->setData('getDefaultValue', $reflectionObject->getDefaultValue());
            } catch (\Exception $e) {
                $this->setData('getDefaultValue', null);
            }
        } else {
            $this->setData('getDefaultValue', null);
        }

        // Extract default value constant name (PHP 5.4.6+)
        // IMPORTANT: Must check isDefaultValueAvailable() first, otherwise isDefaultValueConstant()
        // throws "Internal error: Failed to retrieve the default value" on internal class parameters
        if (method_exists($reflectionObject, 'isDefaultValueAvailable') &&
            $reflectionObject->isDefaultValueAvailable() &&
            method_exists($reflectionObject, 'isDefaultValueConstant')) {
            try {
                if ($reflectionObject->isDefaultValueConstant()) {
                    $this->setData('getDefaultValueConstantName', $reflectionObject->getDefaultValueConstantName());
                } else {
                    $this->setData('getDefaultValueConstantName', null);
                }
            } catch (\Exception $e) {
                $this->setData('getDefaultValueConstantName', null);
            }
        } else {
            $this->setData('getDefaultValueConstantName', null);
        }

        // Extract declaring class name (store only name to avoid recursion)
        if (method_exists($reflectionObject, 'getDeclaringClass')) {
            try {
                $declaringClass = $reflectionObject->getDeclaringClass();
                $this->setData('declaringClassName', $declaringClass ? $declaringClass->getName() : null);
            } catch (\Exception $e) {
                $this->setData('declaringClassName', null);
            }
        } else {
            $this->setData('declaringClassName', null);
        }

        // Extract declaring function name (store only name to avoid recursion)
        if (method_exists($reflectionObject, 'getDeclaringFunction')) {
            try {
                $declaringFunction = $reflectionObject->getDeclaringFunction();
                $this->setData('declaringFunctionName', $declaringFunction ? $declaringFunction->getName() : null);
            } catch (\Exception $e) {
                $this->setData('declaringFunctionName', null);
            }
        } else {
            $this->setData('declaringFunctionName', null);
        }

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

    // Implement ReflectionParameter interface methods explicitly for IDE support
    public function getName()
    {
        return $this->getData('getName');
    }

    public function isOptional()
    {
        return $this->getData('isOptional', false);
    }

    public function isDefaultValueAvailable()
    {
        return $this->getData('isDefaultValueAvailable', false);
    }

    public function isVariadic()
    {
        return $this->getData('isVariadic', false);
    }

    public function isPassedByReference()
    {
        return $this->getData('isPassedByReference', false);
    }

    public function canBePassedByValue()
    {
        return $this->getData('canBePassedByValue', true);
    }

    public function allowsNull()
    {
        return $this->getData('allowsNull', true);
    }

    public function getPosition()
    {
        return $this->getData('getPosition', 0);
    }

    public function hasType()
    {
        return $this->getData('hasType', false);
    }

    public function getType()
    {
        return $this->getData('getType');
    }

    public function getDefaultValue()
    {
        return $this->getData('getDefaultValue');
    }

    public function isDefaultValueConstant()
    {
        return $this->getData('isDefaultValueConstant', false);
    }

    public function getDefaultValueConstantName()
    {
        return $this->getData('getDefaultValueConstantName');
    }

    public function getAttributes()
    {
        return $this->getData('getAttributes', []);
    }

    public function getDeclaringClassName()
    {
        return $this->getData('declaringClassName');
    }

    public function getDeclaringFunctionName()
    {
        return $this->getData('declaringFunctionName');
    }
}
