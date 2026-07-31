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
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/ReflectionValueNormalizer.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/ReflectionTypeRegistry.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AbstractReflectionAdapter.php';

// Include wrapper classes
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionClass.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedReflectionClassReference.php';
require_once __DIR__ . '/Framework/Parsers/Reflection/Wrappers/AdaptedEnumCaseReference.php';
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

/**
 * Per-kind wrap failures, keyed by kind: array('classes' => array(array('name', 'error'), ...)).
 *
 * Swallowing these silently let a systematic regression (e.g. every enum throwing inside
 * AdaptedReflectionClass::__construct) produce `✓ Wrapped 0 enums` and exit 0. Stage 2 then found
 * nothing of that kind to parse, so its own failure counter stayed at 0 and it also reported
 * success — committing a cache with an entire entity kind missing, against which every validator
 * has nothing to compare and stays green. Stage 2 was hardened for this; Stage 1 was not, which
 * made the hardening bypassable one stage earlier.
 *
 * @var array<string, array<int, array>>
 */
$skipped = [];

/**
 * Deliberately typed loosely and PHP 5.6-compatible (no scalar hints, no Throwable): this file runs
 * on every runtime down to 5.6.
 *
 * @param array $skipped
 * @param string $kind
 * @param string $name
 * @param Exception $e
 * @return void
 */
function recordSkipped(array &$skipped, $kind, $name, Exception $e)
{
    $skipped[$kind][] = ['name' => $name, 'error' => $e->getMessage()];
}

/**
 * @param array $skipped
 * @return int total number of skipped entities across all kinds
 */
function countSkipped(array $skipped)
{
    $total = 0;
    foreach ($skipped as $failures) {
        $total += count($failures);
    }
    return $total;
}

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
            // Recorded, not swallowed — see $skipped above.
            recordSkipped($skipped, 'classes', $className, $e);
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
            recordSkipped($skipped, 'interfaces', $interfaceName, $e);
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
            recordSkipped($skipped, 'enums', $enumName, $e);
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
            recordSkipped($skipped, 'functions', $functionName, $e);
        }
    }
    echo "      ✓ Wrapped " . count($wrappedFunctions) . " functions\n\n";

    // Extract constants (keep as simple array since they don't have Reflection objects)
    echo "[6/7] Extracting constants...\n";
    $constants = $dataProvider->getReflectionConstants();
    echo "      ✓ Extracted " . count($constants) . " constants\n\n";

    $totalSkipped = countSkipped($skipped);
    if ($totalSkipped > 0) {
        echo "      ⚠ {$totalSkipped} entities could not be wrapped and are ABSENT from the output:\n";
        foreach ($skipped as $kind => $failures) {
            echo "        - " . str_pad($kind . ':', 12) . count($failures) . "\n";
            // Cap the per-kind listing; the counts above are the complete picture.
            foreach (array_slice($failures, 0, 5) as $failure) {
                echo "            {$failure['name']}: {$failure['error']}\n";
            }
            if (count($failures) > 5) {
                echo "            ... and " . (count($failures) - 5) . " more\n";
            }
        }
        echo "\n";
    }

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
    echo "Skipped:          " . $totalSkipped . "\n";
    echo "========================================\n\n";

    if ($totalSkipped > 0) {
        // The .dat is still written so the failures can be inspected downstream, but the exit code
        // must stop run-all-reflection-parsers.sh from proceeding to Stage 2 as if this succeeded.
        echo "✗ FAILED: {$totalSkipped} entities could not be wrapped.\n";
        echo "          The data at {$outputFile} was written but is INCOMPLETE.\n";
        echo "          Fix the errors above and re-run; do not commit a cache built from it.\n\n";
        exit(1);
    }

    echo "✓ SUCCESS: Reflection data extracted and wrapped successfully!\n";
    echo "          Output saved to: {$outputFile}\n\n";

    exit(0);
} catch (Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "  Trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
