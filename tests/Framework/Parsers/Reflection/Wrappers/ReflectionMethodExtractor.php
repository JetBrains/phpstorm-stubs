<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

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
    public static function extractData($reflectionObject, array $config = [])
    {
        $data = [];
        $reflectionClass = new \ReflectionClass($reflectionObject);

        // Default configuration
        $defaultConfig = [
            'methodPrefixes' => ['is', 'has', 'get'],
            'includeNameMethod' => true,
            'skipMethods' => [],
            'customHandlers' => [],
            'maxDepth' => 3
        ];

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
}
