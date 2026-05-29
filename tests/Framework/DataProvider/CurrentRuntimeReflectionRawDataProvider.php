<?php

namespace StubTests\Framework\DataProvider;

use StubTests\Framework\DataProvider\ReflectionDataProvider;

class CurrentRuntimeReflectionRawDataProvider implements ReflectionDataProvider {

    public function getReflectionFunctions()
    {
        $definedFunctions = get_defined_functions();
        return isset($definedFunctions['internal']) ? $definedFunctions['internal'] : array();
    }

    public function getReflectionClasses()
    {
        // Deduplicate by canonical name to handle case-insensitive aliases
        // (e.g. PHP 8.4+ declares both `DOMException` and `dom\DomException` which
        // both resolve to the same ReflectionClass with getName() = 'DOMException').
        $seen = [];
        $result = [];
        foreach (get_declared_classes() as $class) {
            try {
                $reflection = new \ReflectionClass($class);
                if (!$reflection->isInternal()) {
                    continue;
                }
                // Check if it's an enum (PHP 8.1+) and exclude enums
                if (method_exists($reflection, 'isEnum') && $reflection->isEnum()) {
                    continue;
                }
                $canonicalName = $reflection->getName();
                if (!isset($seen[$canonicalName])) {
                    $seen[$canonicalName] = true;
                    $result[] = $canonicalName;
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        return $result;
    }

    public function getReflectionInterfaces()
    {
        return array_values(array_filter(get_declared_interfaces(), function($interface) {
            try {
                $reflection = new \ReflectionClass($interface);
                return $reflection->isInternal();
            } catch (\Exception $e) {
                return false;
            }
        }));
    }

    public function getReflectionEnums()
    {
        return array_values(array_filter(get_declared_classes(), function ($class) {
            try {
                $reflection = new \ReflectionClass($class);
                // Only available in PHP 8.1+
                if (method_exists($reflection, 'isEnum') && $reflection->isInternal()) {
                    return $reflection->isEnum();
                }
                return false;
            } catch (\Exception $e) {
                return false;
            }
        }));
    }

    public function getReflectionConstants()
    {
        $get_defined_constants = get_defined_constants(true);
        if (isset($get_defined_constants['user'])) {
            unset($get_defined_constants['user']);
        }

        // Flatten the array - PHP 5.6 compatible way
        $result = array();
        foreach ($get_defined_constants as $category => $constants) {
            foreach ($constants as $name => $value) {
                $result[$name] = $value;
            }
        }
        return $result;
    }
}