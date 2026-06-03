#!/usr/bin/env php
<?php

/**
 * Legacy PHP Reflection Adapter (PHP 5.6+ compatible)
 *
 * This script extracts reflection data from legacy PHP runtimes and adapts it
 * by wrapping Reflection objects in AdaptedReflection* classes. The adapted objects
 * can then be serialized and processed by modern PHP parsers.
 *
 * Usage:
 *   php tests/adapt-legacy-reflection.php [php-version] [output-file]
 *
 * Example:
 *   php tests/adapt-legacy-reflection.php 5.6 /tmp/reflection-5.6.dat
 */

// Suppress deprecation warnings but show other errors
error_reporting(E_ALL & ~E_DEPRECATED);

// Manually include only PHP 5.6-compatible files
require_once __DIR__ . '/Framework/DataProvider/ReflectionDataProvider.php';
require_once __DIR__ . '/Framework/DataProvider/CurrentRuntimeReflectionRawDataProvider.php';

// Include base wrapper classes first
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/ReflectionMethodExtractor.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/ReflectionTypeRegistry.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AbstractReflectionAdapter.php';

// Include wrapper classes
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionClass.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionClassReference.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionMethod.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionProperty.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionClassConstant.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionFunction.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionParameter.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionType.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionNamedType.php';

use StubTests\Framework\DataProvider\CurrentRuntimeReflectionRawDataProvider;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionFunction;

// Parse CLI arguments
$phpVersion = isset($argv[1]) ? $argv[1] : PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;
$outputFile = isset($argv[2]) ? $argv[2] : '/tmp/reflection-' . $phpVersion . '.dat';

echo "========================================\n";
echo "Legacy PHP Reflection Adapter\n";
echo "========================================\n";
echo "PHP Version: {$phpVersion}\n";
echo "Runtime Version: " . PHP_VERSION . "\n";
echo "Output File: {$outputFile}\n";
echo "Start Time: " . date('Y-m-d H:i:s') . "\n";
echo "========================================\n\n";

try {
    // Create data provider
    echo "[1/7] Creating reflection data provider...\n";
    $dataProvider = new CurrentRuntimeReflectionRawDataProvider();
    echo "      ✓ Data provider created\n\n";

    // Extract and wrap classes
    echo "[2/7] Extracting and wrapping classes...\n";
    $classNames = $dataProvider->getReflectionClasses();
    $wrappedClasses = [];
    foreach ($classNames as $className) {
        try {
            $reflection = new ReflectionClass($className);
            $wrappedClasses[] = new AdaptedReflectionClass($reflection);
        } catch (Exception $e) {
            // Skip classes that can't be reflected
            continue;
        }
    }
    echo "      ✓ Wrapped " . count($wrappedClasses) . " classes\n\n";

    // Extract and wrap interfaces
    echo "[3/7] Extracting and wrapping interfaces...\n";
    $interfaceNames = $dataProvider->getReflectionInterfaces();
    $wrappedInterfaces = [];
    foreach ($interfaceNames as $interfaceName) {
        try {
            $reflection = new ReflectionClass($interfaceName);
            $wrappedInterfaces[] = new AdaptedReflectionClass($reflection);
        } catch (Exception $e) {
            continue;
        }
    }
    echo "      ✓ Wrapped " . count($wrappedInterfaces) . " interfaces\n\n";

    // Extract and wrap enums
    echo "[4/7] Extracting and wrapping enums...\n";
    $enumNames = $dataProvider->getReflectionEnums();
    $wrappedEnums = [];
    foreach ($enumNames as $enumName) {
        try {
            $reflection = new ReflectionClass($enumName);
            $wrappedEnums[] = new AdaptedReflectionClass($reflection);
        } catch (Exception $e) {
            continue;
        }
    }
    echo "      ✓ Wrapped " . count($wrappedEnums) . " enums\n\n";

    // Extract and wrap functions
    echo "[5/7] Extracting and wrapping functions...\n";
    $functionNames = $dataProvider->getReflectionFunctions();
    $wrappedFunctions = [];
    foreach ($functionNames as $functionName) {
        try {
            $reflection = new ReflectionFunction($functionName);
            $wrappedFunctions[] = new AdaptedReflectionFunction($reflection);
        } catch (Exception $e) {
            continue;
        }
    }
    echo "      ✓ Wrapped " . count($wrappedFunctions) . " functions\n\n";

    // Extract constants (keep as simple array since they don't have Reflection objects)
    echo "[6/7] Extracting constants...\n";
    $constants = $dataProvider->getReflectionConstants();
    echo "      ✓ Extracted " . count($constants) . " constants\n\n";

    // Package all data
    $extractedData = [
        'phpVersion' => $phpVersion,
        'runtimeVersion' => PHP_VERSION,
        'classes' => $wrappedClasses,
        'interfaces' => $wrappedInterfaces,
        'enums' => $wrappedEnums,
        'functions' => $wrappedFunctions,
        'constants' => $constants
    ];

    // Save extracted data
    echo "[7/7] Saving wrapped reflection data...\n";

    // Ensure directory exists
    $outputDir = dirname($outputFile);
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Serialize data
    $serialized = serialize($extractedData);

    // Write to file
    $bytes = file_put_contents($outputFile, $serialized);

    if ($bytes === false) {
        throw new Exception('Failed to write to file: ' . $outputFile);
    }

    $fileSizeFormatted = number_format($bytes / 1024, 2);
    echo "      ✓ Saved {$fileSizeFormatted} KB to {$outputFile}\n\n";

    // Summary
    echo "========================================\n";
    echo "Summary:\n";
    echo "========================================\n";
    echo "Total Classes:    " . count($wrappedClasses) . "\n";
    echo "Total Interfaces: " . count($wrappedInterfaces) . "\n";
    echo "Total Enums:      " . count($wrappedEnums) . "\n";
    echo "Total Functions:  " . count($wrappedFunctions) . "\n";
    echo "Total Constants:  " . count($constants) . "\n";
    echo "========================================\n\n";

    echo "✓ SUCCESS: Reflection data extracted and wrapped successfully!\n";
    echo "          Output saved to: {$outputFile}\n\n";

    exit(0);
} catch (Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "  Trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
