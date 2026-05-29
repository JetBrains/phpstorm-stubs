<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

// Use statements for all adapter classes - enables ::class references
use StubTests\Framework\Parsers\Reflection\Wrappers\AbstractReflectionAdapter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionMethod;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionFunction;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionProperty;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

/**
 * Centralized registry for Reflection type to Adapter class mappings
 *
 * This registry eliminates scattered type mapping logic and provides a single
 * source of truth for Reflection object wrapping. When new PHP versions add
 * new Reflection types, only this file needs to be updated.
 *
 * Uses ::class constants instead of hardcoded strings for better IDE support,
 * refactoring safety, and static analysis.
 *
 * PHP 5.6+ compatible (::class was introduced in PHP 5.5)
 */
class ReflectionTypeRegistry
{
    /**
     * Mapping of Reflection class names to their Adapter classes
     *
     * Uses ::class constants for type safety and IDE support.
     *
     * @var array
     */
    private static $typeMapping = array(
        'ReflectionClass' => AdaptedReflectionClass::class,
        'ReflectionMethod' => AdaptedReflectionMethod::class,
        'ReflectionFunction' => AdaptedReflectionFunction::class,
        'ReflectionParameter' => AdaptedReflectionParameter::class,
        'ReflectionProperty' => AdaptedReflectionProperty::class,
        'ReflectionClassConstant' => AdaptedReflectionClassConstant::class,
        'ReflectionType' => AdaptedReflectionType::class,
    );

    /**
     * Global method patterns that should be skipped during automatic extraction
     * These apply to ALL reflection adapters unless overridden
     *
     * @var array
     */
    private static $globalSkipPatterns = array(
        // Methods that return closures or invoke functionality
        'getClosure',
        'getClosureThis',
        'getClosureScopeClass',
        'getClosureCalledClass',
        'invoke',
        'invokeArgs',

        // Methods that require special serialization handling
        'getExtension',
        'getExtensionName',
        'getFileName',
        'getStartLine',
        'getEndLine',
        'getDocComment',
        'getStaticVariables',

        // Methods that return complex nested structures (handled in postExtract)
        'getDeclaringClass',
        'getDeclaringFunction',
        'getParentClass',
        'getInterfaces',
        'getTraits',

        // Methods returning collections of Reflection objects
        'getMethods',
        'getProperties',
        'getParameters',
        'getReflectionConstants',
        'getConstants',
        'getAttributes',

        // Type-related methods (require custom handling)
        'getType',
        'getReturnType',
        'getTypes',

        // Value getters that may require object instances (property-specific)
        'setValue',
        'getDefaultValue',
        'getDefaultValueConstantName',
        'getStaticProperties',

        // Constructor
        'getConstructor',
    );

    /**
     * Get the adapter class for a given Reflection object
     *
     * @param object $reflectionObject
     * @return string|null Fully qualified adapter class name, or null if not found
     */
    public static function getAdapterClass($reflectionObject)
    {
        if (!is_object($reflectionObject)) {
            return null;
        }

        $className = get_class($reflectionObject);

        // Direct lookup
        if (isset(self::$typeMapping[$className])) {
            return self::$typeMapping[$className];
        }

        // Check if it's a ReflectionType subclass (catches future type variants)
        if ($reflectionObject instanceof \ReflectionType) {
            return self::$typeMapping['ReflectionType'];
        }

        return null;
    }

    /**
     * Create an adapter instance for a Reflection object
     *
     * @param object $reflectionObject
     * @return AbstractReflectionAdapter|null
     */
    public static function createAdapter($reflectionObject)
    {
        $adapterClass = self::getAdapterClass($reflectionObject);

        if ($adapterClass === null) {
            return null;
        }

        // Since we use ::class constants, class always exists and is fully qualified
        if (!class_exists($adapterClass)) {
            return null;
        }

        return new $adapterClass($reflectionObject);
    }

    /**
     * Get global skip patterns that apply to all adapters
     *
     * @return array
     */
    public static function getGlobalSkipPatterns()
    {
        return self::$globalSkipPatterns;
    }
}
