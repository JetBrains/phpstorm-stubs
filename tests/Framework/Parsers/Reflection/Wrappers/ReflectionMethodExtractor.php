<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

use StubTests\Framework\Parsers\Reflection\Wrappers\AbstractReflectionAdapter;
use StubTests\Framework\Parsers\Reflection\Wrappers\ReflectionTypeRegistry;

/**
 * Automatic method extraction logic for Reflection objects
 *
 * This class automatically discovers and calls getter methods on Reflection objects,
 * extracting all available data dynamically. This ensures forward compatibility when
 * new methods are added to PHP's Reflection API.
 *
 * PHP 5.6+ compatible
 */
class ReflectionMethodExtractor
{
    /**
     * Extract data from a reflection object by automatically calling all getter methods
     *
     * @param object $reflectionObject The reflection object to extract data from
     * @param array $config Configuration for extraction behavior
     * @return array Extracted data as associative array
     */
    public static function extractData($reflectionObject, array $config = array())
    {
        $data = array();
        $reflectionClass = new \ReflectionClass($reflectionObject);

        // Default configuration
        $defaultConfig = array(
            'methodPrefixes' => array('is', 'has', 'get'),
            'includeNameMethod' => true,
            'skipMethods' => array(),
            'customHandlers' => array(),
            'maxDepth' => 3
        );

        $config = array_merge($defaultConfig, $config);

        // Get all public methods
        $methods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $methodName = $method->getName();

            // Skip if method is in skip list
            if (in_array($methodName, $config['skipMethods'])) {
                continue;
            }

            // Skip methods that require parameters
            if ($method->getNumberOfRequiredParameters() > 0) {
                continue;
            }

            // Skip magic methods and internal methods
            if (strpos($methodName, '__') === 0) {
                continue;
            }

            // Check if method matches expected prefixes or is getName()
            $shouldExtract = false;
            foreach ($config['methodPrefixes'] as $prefix) {
                if (strpos($methodName, $prefix) === 0) {
                    $shouldExtract = true;
                    break;
                }
            }

            if (!$shouldExtract) {
                continue;
            }

            // Check if method exists on the object (for version compatibility)
            if (!method_exists($reflectionObject, $methodName)) {
                continue;
            }

            // Check for custom handler
            if (isset($config['customHandlers'][$methodName])) {
                $handler = $config['customHandlers'][$methodName];
                $data[$methodName] = $handler($reflectionObject, $methodName);
                continue;
            }

            // Extract the value
            try {
                $value = $reflectionObject->$methodName();

                // Store the raw value or mark for later processing
                $data[$methodName] = $value;

            } catch (\Exception $e) {
                // If method call fails, skip it (don't store)
                continue;
            } catch (\Throwable $e) {
                // Catch all errors including TypeError for PHP 7+
                continue;
            }
        }

        return $data;
    }

    /**
     * Convert extracted data to serializable format
     * Handles Reflection objects, arrays, and primitives
     *
     * Uses ReflectionTypeRegistry for centralized type-to-adapter mapping.
     * This eliminates hardcoded type checks and makes it easier to support
     * new Reflection types added in future PHP versions.
     *
     * @param mixed $value The value to convert
     * @param int $depth Current recursion depth
     * @param int $maxDepth Maximum recursion depth
     * @return mixed Serializable value
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
            $result = array();
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

            // For enum instances, return the enum case name
            if (method_exists($value, 'name')) {
                try {
                    return $className . '::' . $value->name;
                } catch (\Throwable $e) {
                    // Fall through to class name
                }
            }

            // Return just the class name as a safe fallback
            return $className;
        }

        // Return primitives as-is
        return $value;
    }


}
