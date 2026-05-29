#!/usr/bin/env php
<?php

/**
 * Modern PHP processor for adapted reflection data
 *
 * This script processes serialized adapted reflection objects created by adapt-legacy-reflection.php
 * and uses existing reflection parsers to convert them to the final JSON format.
 *
 * Usage:
 *   php tests/run-reflection-processor.php [input-file] [output-file]
 *
 * Example:
 *   php tests/run-reflection-processor.php /tmp/reflection-5.6.dat tests/cache/Reflection5.6.json
 */

// Suppress deprecation warnings
error_reporting(E_ALL & ~E_DEPRECATED);

// Parse CLI arguments
$inputFile = $argv[1] ?? null;
$outputFile = $argv[2] ?? null;

if (!$inputFile || !$outputFile) {
    echo "Error: Missing required arguments\n";
    echo "Usage: php run-reflection-processor.php <input-file> <output-file>\n";
    exit(1);
}

if (!file_exists($inputFile)) {
    echo "Error: Input file not found: {$inputFile}\n";
    exit(1);
}

echo "========================================\n";
echo "PHP Reflection Processor\n";
echo "========================================\n";
echo "Input File:  {$inputFile}\n";
echo "Output File: {$outputFile}\n";
echo "Start Time: " . date('Y-m-d H:i:s') . "\n";
echo "========================================\n\n";

require_once __DIR__ . '/../vendor/autoload.php';

use StubTests\Framework\Parsers\Serializers\Reflection\ReflectionEntitySerializer;
use StubTests\Framework\Parsers\Processors\EntityProcessingPipeline;
use StubTests\Framework\Parsers\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Parsers\Reflection\ReflectionClassParser;
use StubTests\Framework\Parsers\Reflection\ReflectionDefineConstantParser;
use StubTests\Framework\Parsers\Reflection\ReflectionEnumParser;
use StubTests\Framework\Parsers\Reflection\ReflectionFunctionParser;
use StubTests\Framework\Parsers\Reflection\ReflectionInterfaceParser;
use StubTests\Framework\Parsers\Reflection\ReflectionModernConstantParser;
use StubTests\Framework\Parsers\Storage\JsonParsedDataStorage;
use StubTests\Framework\Parsers\Processors\ReflectionDeduplicationProcessor;

try {
    // Load extracted data
    echo "[1/4] Loading wrapped reflection data...\n";
    $serialized = file_get_contents($inputFile);
    if ($serialized === false) {
        throw new Exception('Failed to read input file: ' . $inputFile);
    }

    $extractedData = unserialize($serialized);
    if ($extractedData === false) {
        throw new Exception('Failed to unserialize data from: ' . $inputFile);
    }

    $phpVersion = $extractedData['phpVersion'] ?? 'unknown';
    $runtimeVersion = $extractedData['runtimeVersion'] ?? 'unknown';

    echo "      ✓ Loaded data for PHP {$phpVersion} (runtime: {$runtimeVersion})\n";
    echo "      - Classes:    " . count($extractedData['classes'] ?? []) . "\n";
    echo "      - Interfaces: " . count($extractedData['interfaces'] ?? []) . "\n";
    echo "      - Enums:      " . count($extractedData['enums'] ?? []) . "\n";
    echo "      - Functions:  " . count($extractedData['functions'] ?? []) . "\n";
    echo "      - Constants:  " . count($extractedData['constants'] ?? []) . "\n\n";

    // Create storage manager with deduplication pipeline
    echo "[2/4] Creating storage manager with deduplication pipeline...\n";
    $storage = new JsonParsedDataStorage($outputFile, new ReflectionEntitySerializer(), false);
    $pipeline = new EntityProcessingPipeline();
    $pipeline->addProcessor(new ReflectionDeduplicationProcessor());
    $storageManager = new DefaultParsedDataStorageManager($storage, $pipeline);
    echo "      ✓ Storage manager created with deduplication enabled\n\n";

    // Create parsers
    $classParser = new ReflectionClassParser();
    $interfaceParser = new ReflectionInterfaceParser();
    $enumParser = new ReflectionEnumParser();
    $functionParser = new ReflectionFunctionParser();
    $constantParser = class_exists('\ReflectionConstant')
        ? new ReflectionModernConstantParser()
        : new ReflectionDefineConstantParser();

    // Parse wrapped entities
    echo "[3/4] Parsing wrapped entities...\n";

    // Parse classes
    echo "      - Parsing classes...\n";
    foreach ($extractedData['classes'] ?? [] as $wrappedClass) {
        try {
            if ($classParser->canParse($wrappedClass)) {
                $phpClass = $classParser->parse($wrappedClass);
                $storageManager->addEntity($phpClass);
            }
        } catch (\Exception $e) {
            // Skip classes that cannot be parsed
            continue;
        }
    }

    // Parse interfaces
    echo "      - Parsing interfaces...\n";
    foreach ($extractedData['interfaces'] ?? [] as $wrappedInterface) {
        try {
            if ($interfaceParser->canParse($wrappedInterface)) {
                $phpInterface = $interfaceParser->parse($wrappedInterface);
                $storageManager->addEntity($phpInterface);
            }
        } catch (\Exception $e) {
            continue;
        }
    }

    // Parse enums
    echo "      - Parsing enums...\n";
    foreach ($extractedData['enums'] ?? [] as $wrappedEnum) {
        try {
            if ($enumParser->canParse($wrappedEnum)) {
                $phpEnum = $enumParser->parse($wrappedEnum);
                $storageManager->addEntity($phpEnum);
            }
        } catch (\Exception $e) {
            continue;
        }
    }

    // Parse functions
    echo "      - Parsing functions...\n";
    foreach ($extractedData['functions'] ?? [] as $wrappedFunction) {
        try {
            $phpFunction = $functionParser->parse($wrappedFunction);
            $storageManager->addEntity($phpFunction);
        } catch (\Exception $e) {
            continue;
        }
    }

    // Parse constants
    echo "      - Parsing constants...\n";
    foreach ($extractedData['constants'] ?? [] as $constantName => $constantValue) {
        try {
            // Pass indexed array [name, value] for ReflectionDefineConstantParser compatibility
            $phpConstant = $constantParser->parse([$constantName, $constantValue]);
            $storageManager->addEntity($phpConstant);
        } catch (\Exception $e) {
            continue;
        }
    }

    echo "      ✓ Parsing completed\n\n";

    // Save to JSON
    echo "[4/4] Saving to JSON file...\n";
    $startTime = microtime(true);
    $storageManager->save();
    $saveTime = microtime(true) - $startTime;

    echo "      ✓ Saved in " . number_format($saveTime, 2) . " seconds\n";

    // Verify file was written
    if (file_exists($outputFile)) {
        $fileSize = filesize($outputFile);
        $fileSizeFormatted = number_format($fileSize / 1024 / 1024, 2);
        echo "      ✓ File created with size: {$fileSizeFormatted} MB\n";
    } else {
        echo "      ✗ File was not created!\n";
        exit(1);
    }
    echo "\n";

    // Display final statistics
    $allEntities = $storageManager->getAllEntities();
    $classes = $storageManager->getClasses();
    $functions = $storageManager->getFunctions();
    $interfaces = $storageManager->getInterfaces();
    $enums = $storageManager->getEnums();
    $constants = $storageManager->getConstants();

    echo "========================================\n";
    echo "Final Statistics:\n";
    echo "========================================\n";
    echo "Total Entities: " . count($allEntities) . "\n";
    echo "  - Classes:    " . count($classes) . "\n";
    echo "  - Functions:  " . count($functions) . "\n";
    echo "  - Interfaces: " . count($interfaces) . "\n";
    echo "  - Enums:      " . count($enums) . "\n";
    echo "  - Constants:  " . count($constants) . "\n";
    echo "========================================\n";

    $fileSize = filesize($outputFile);
    $fileSizeFormatted = number_format($fileSize / 1024 / 1024, 2);
    echo "Output File Size: {$fileSizeFormatted} MB\n";
    echo "========================================\n\n";

    echo "✓ SUCCESS: Reflection processing completed successfully!\n";
    echo "          Output saved to: {$outputFile}\n\n";

    exit(0);

} catch (Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "  Trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
