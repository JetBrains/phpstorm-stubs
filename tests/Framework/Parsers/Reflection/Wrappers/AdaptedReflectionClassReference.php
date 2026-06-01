<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Minimal reference to a class (just the name)
 * Used to avoid infinite recursion when serializing class relationships
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionClassReference extends AbstractReflectionAdapter
{
    private $name;

    public function __construct($className)
    {
        $this->name = $className;
        // Don't call parent constructor - we don't have a native Reflection object
    }

    public function getName()
    {
        return $this->name;
    }

    public function getShortName()
    {
        $parts = explode('\\', $this->name);
        return array_pop($parts);
    }

    public function getNamespaceName()
    {
        $parts = explode('\\', $this->name);
        if (count($parts) === 1) {
            return ''; // No namespace (global namespace)
        }
        array_pop($parts); // Remove class name
        return implode('\\', $parts);
    }

    protected function getAdditionalSkipMethods()
    {
        return [];
    }
}
