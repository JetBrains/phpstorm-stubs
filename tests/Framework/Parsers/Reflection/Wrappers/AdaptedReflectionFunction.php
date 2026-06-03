<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper around ReflectionFunction
 *
 * Uses automatic extraction with custom handling for parameters and return type
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionFunction extends AbstractReflectionAdapter
{
    public function __construct($reflectionFunction)
    {
        // Use generic extraction for basic properties
        $this->extractFromReflection($reflectionFunction);

        // Custom handling for complex nested structures
        $this->postExtract($reflectionFunction);
    }

    /**
     * Get additional skip methods specific to ReflectionFunction
     * Most common patterns are now in ReflectionTypeRegistry::getGlobalSkipPatterns()
     */
    protected function getAdditionalSkipMethods()
    {
        // All methods are now covered by global patterns
        return [];
    }

    /**
     * Handle complex nested extraction after basic extraction
     */
    protected function postExtract($reflectionObject)
    {
        // Extract return type if exists (PHP 7.0+)
        if (method_exists($reflectionObject, 'hasReturnType') && $reflectionObject->hasReturnType()) {
            $returnType = $reflectionObject->getReturnType();
            if ($returnType) {
                $this->setData('getReturnType', new AdaptedReflectionType($returnType));
            }
        } else {
            $this->setData('getReturnType', null);
        }

        // Extract parameters
        $parameters = [];
        foreach ($reflectionObject->getParameters() as $parameter) {
            $parameters[] = new AdaptedReflectionParameter($parameter);
        }
        $this->setData('getParameters', $parameters);

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

    // Implement ReflectionFunction interface methods explicitly for IDE support
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

    public function isDeprecated()
    {
        return $this->getData('isDeprecated', false);
    }

    public function hasReturnType()
    {
        return $this->getData('hasReturnType', false);
    }

    public function getReturnType()
    {
        return $this->getData('getReturnType');
    }

    public function getParameters()
    {
        return $this->getData('getParameters', []);
    }

    public function getNumberOfParameters()
    {
        return $this->getData('getNumberOfParameters', 0);
    }

    public function getNumberOfRequiredParameters()
    {
        return $this->getData('getNumberOfRequiredParameters', 0);
    }

    public function isInternal()
    {
        return $this->getData('isInternal', false);
    }

    public function isUserDefined()
    {
        return $this->getData('isUserDefined', false);
    }

    public function isGenerator()
    {
        return $this->getData('isGenerator', false);
    }

    public function isVariadic()
    {
        return $this->getData('isVariadic', false);
    }

    public function getFileName()
    {
        return $this->getData('getFileName', false);
    }

    public function getStartLine()
    {
        return $this->getData('getStartLine', false);
    }

    public function getEndLine()
    {
        return $this->getData('getEndLine', false);
    }

    public function getDocComment()
    {
        return $this->getData('getDocComment', false);
    }

    public function getExtension()
    {
        return $this->getData('getExtension');
    }

    public function getExtensionName()
    {
        return $this->getData('getExtensionName', false);
    }

    public function getStaticVariables()
    {
        return $this->getData('getStaticVariables', []);
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
