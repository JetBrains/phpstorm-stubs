<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Abstract base class for Reflection adapter wrappers
 *
 * Provides automatic extraction of data from Reflection objects using introspection.
 * Adapts PHP's native Reflection API to a consistent interface that can be used across
 * different PHP versions and enables data extraction for further processing.
 * Subclasses can override configuration or add custom extraction logic.
 *
 * PHP 5.6+ compatible (no typed properties, no return types)
 */
abstract class AbstractReflectionAdapter
{
    /**
     * Extracted data from the reflection object
     * @var array
     */
    protected $data = [];

    /**
     * Extract configuration - override in subclasses if needed
     *
     * Subclasses should only override this to add ADDITIONAL skip methods
     * beyond the global patterns defined in ReflectionTypeRegistry.
     *
     * @return array Configuration for ReflectionMethodExtractor
     */
    protected function getExtractionConfig()
    {
        // Start with global skip patterns from the registry
        $globalSkipPatterns = ReflectionTypeRegistry::getGlobalSkipPatterns();

        return [
            'methodPrefixes' => ['allows', 'can', 'get', 'has', 'in', 'is', 'returns'],
            'includeNameMethod' => true,
            'skipMethods' => $globalSkipPatterns,
            'customHandlers' => []
        ];
    }

    /**
     * Get additional skip methods specific to this adapter
     * Override in subclasses to add class-specific skip patterns
     *
     * @return array Additional method names to skip
     */
    protected function getAdditionalSkipMethods()
    {
        return [];
    }

    /**
     * Perform generic extraction from reflection object
     *
     * @param object $reflectionObject
     */
    protected function extractFromReflection($reflectionObject)
    {
        $config = $this->getExtractionConfig();

        // Merge in additional skip methods from subclass
        $additionalSkip = $this->getAdditionalSkipMethods();
        if (!empty($additionalSkip)) {
            $config['skipMethods'] = array_merge($config['skipMethods'], $additionalSkip);
        }

        $rawData = ReflectionMethodExtractor::extractData($reflectionObject, $config);

        // Convert to adapted format
        $this->data = [];
        foreach ($rawData as $methodName => $value) {
            $this->data[$methodName] = ReflectionMethodExtractor::makeSerializable($value);
        }
    }

    /**
     * Post-extraction hook for custom processing
     * Override in subclasses if needed
     *
     * @param object $reflectionObject Original reflection object
     */
    protected function postExtract($reflectionObject) {}

    /**
     * Magic method to proxy method calls to stored data
     *
     * @param string $name Method name
     * @param array $arguments Method arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        // Check if we have this method's data stored
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        // Throw error for unknown methods
        throw new \BadMethodCallException("Method {$name} does not exist or was not extracted");
    }

    /**
     * Check if a method exists in the extracted data
     *
     * @param string $methodName
     * @return bool
     */
    public function hasMethod($methodName)
    {
        return array_key_exists($methodName, $this->data);
    }

    /**
     * Get all extracted data (for debugging)
     *
     * @return array
     */
    public function getExtractedData()
    {
        return $this->data;
    }

    /**
     * Get a specific value from extracted data
     *
     * @param string $key
     * @param mixed $default Default value if key doesn't exist
     * @return mixed
     */
    protected function getData($key, $default = null)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : $default;
    }

    /**
     * Set a value in extracted data
     *
     * @param string $key
     * @param mixed $value
     */
    protected function setData($key, $value)
    {
        $this->data[$key] = $value;
    }
}
