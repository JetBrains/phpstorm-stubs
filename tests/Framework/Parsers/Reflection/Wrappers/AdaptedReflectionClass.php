<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper around ReflectionClass
 *
 * This adapter uses automatic extraction to get all data from a ReflectionClass
 * with custom handling for complex nested structures (methods, properties, etc.)
 *
 * PHP 5.6+ compatible (no typed properties, no return types)
 */
class AdaptedReflectionClass extends AbstractReflectionAdapter
{
    public function __construct($reflectionClass)
    {
        // Use generic extraction for basic properties
        $this->extractFromReflection($reflectionClass);

        // Custom handling for complex nested structures
        $this->postExtract($reflectionClass);
    }

    /**
     * Get additional skip methods specific to ReflectionClass
     * Most common patterns are now in ReflectionTypeRegistry::getGlobalSkipPatterns()
     */
    protected function getAdditionalSkipMethods()
    {
        // Only list methods specific to ReflectionClass that aren't in global patterns
        return [
            'getTraitAliases',
            'getTraitNames',
            'getInterfaceNames'
        ];
    }

    /**
     * Handle complex nested extraction after basic extraction
     */
    protected function postExtract($reflectionObject)
    {
        // Extract methods
        $methods = [];
        foreach ($reflectionObject->getMethods() as $method) {
            $methods[] = new AdaptedReflectionMethod($method);
        }
        $this->setData('getMethods', $methods);

        // Extract properties
        $properties = [];
        foreach ($reflectionObject->getProperties() as $property) {
            $properties[] = new AdaptedReflectionProperty($property);
        }
        $this->setData('getProperties', $properties);

        // Extract constants (modern or legacy way)
        $hasReflectionConstantsMethod = method_exists($reflectionObject, 'getReflectionConstants');

        if ($hasReflectionConstantsMethod) {
            $reflectionConstants = [];
            foreach ($reflectionObject->getReflectionConstants() as $constant) {
                $reflectionConstants[] = new AdaptedReflectionClassConstant($constant);
            }
            $this->setData('getReflectionConstants', $reflectionConstants);
            $this->setData('getConstants', []);
        } else {
            $this->setData('getReflectionConstants', []);
            $this->setData('getConstants', $reflectionObject->getConstants());
        }

        // Extract parent class (avoid infinite recursion)
        $parentClass = $reflectionObject->getParentClass();
        $this->setData('getParentClass', $parentClass !== false ? new AdaptedReflectionClassReference($parentClass->getName()) : false);

        // Extract interfaces
        $interfaces = [];
        foreach ($reflectionObject->getInterfaces() as $interface) {
            $interfaces[] = new AdaptedReflectionClassReference($interface->getName());
        }
        $this->setData('getInterfaces', $interfaces);

        // Extract constructor (returns ReflectionMethod or null)
        $constructor = $reflectionObject->getConstructor();
        $this->setData('getConstructor', $constructor !== null ? new AdaptedReflectionMethod($constructor) : null);

        // Extract doc comment
        $docComment = $reflectionObject->getDocComment();
        $this->setData('getDocComment', $docComment !== false ? $docComment : false);

        // Extract static properties
        try {
            $staticProperties = $reflectionObject->getStaticProperties();
            $this->setData('getStaticProperties', $staticProperties);
        } catch (\Exception $e) {
            $this->setData('getStaticProperties', []);
        }

        // Extract traits (PHP 5.4+)
        if (method_exists($reflectionObject, 'getTraits')) {
            $traits = [];
            foreach ($reflectionObject->getTraits() as $trait) {
                $traits[] = new AdaptedReflectionClassReference($trait->getName());
            }
            $this->setData('getTraits', $traits);
        } else {
            $this->setData('getTraits', []);
        }

        // Extract trait aliases (PHP 5.4+)
        if (method_exists($reflectionObject, 'getTraitAliases')) {
            $this->setData('getTraitAliases', $reflectionObject->getTraitAliases());
        } else {
            $this->setData('getTraitAliases', []);
        }

        // Extract trait names (PHP 5.4+)
        if (method_exists($reflectionObject, 'getTraitNames')) {
            $this->setData('getTraitNames', $reflectionObject->getTraitNames());
        } else {
            $this->setData('getTraitNames', []);
        }

        // Extract interface names
        $this->setData('getInterfaceNames', $reflectionObject->getInterfaceNames());

        // Extract attributes (PHP 8.0+)
        if (method_exists($reflectionObject, 'getAttributes')) {
            try {
                // Store attributes as serializable array (name + arguments)
                // since ReflectionAttribute objects can't be easily serialized
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

    // Implement ReflectionClass interface methods explicitly for IDE support
    public function getName()
    {
        return $this->getData('getName');
    }

    public function getShortName()
    {
        return $this->getData('getShortName');
    }

    public function getNamespaceName()
    {
        return $this->getData('getNamespaceName');
    }

    public function isFinal()
    {
        return $this->getData('isFinal', false);
    }

    public function isReadOnly()
    {
        return $this->getData('isReadOnly', false);
    }

    public function isInternal()
    {
        return $this->getData('isInternal', false);
    }

    public function isInterface()
    {
        return $this->getData('isInterface', false);
    }

    public function isEnum()
    {
        return $this->getData('isEnum', false);
    }

    public function isAbstract()
    {
        return $this->getData('isAbstract', false);
    }

    public function getMethods()
    {
        return $this->getData('getMethods', []);
    }

    public function getProperties()
    {
        return $this->getData('getProperties', []);
    }

    public function hasReflectionConstants()
    {
        $constants = $this->getData('getReflectionConstants', []);
        return !empty($constants);
    }

    public function getReflectionConstants()
    {
        return $this->getData('getReflectionConstants', []);
    }

    public function getConstants()
    {
        return $this->getData('getConstants', []);
    }

    public function getParentClass()
    {
        return $this->getData('getParentClass', false);
    }

    public function getInterfaces()
    {
        return $this->getData('getInterfaces', []);
    }

    public function getConstructor()
    {
        return $this->getData('getConstructor');
    }

    public function getDocComment()
    {
        return $this->getData('getDocComment', false);
    }

    public function getStaticProperties()
    {
        return $this->getData('getStaticProperties', []);
    }

    public function getTraits()
    {
        return $this->getData('getTraits', []);
    }

    public function getTraitAliases()
    {
        return $this->getData('getTraitAliases', []);
    }

    public function getTraitNames()
    {
        return $this->getData('getTraitNames', []);
    }

    public function getInterfaceNames()
    {
        return $this->getData('getInterfaceNames', []);
    }

    public function getAttributes()
    {
        return $this->getData('getAttributes', []);
    }
}
