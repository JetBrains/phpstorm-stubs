#!/usr/bin/env php
<?php

/**
 * Standalone CLI script to parse all PHP stubs and write to JSON cache.
 *
 * Usage:
 *   php tests/run-stubs-parser.php
 *
 * Note: Stubs are version-agnostic and represent a unified view across all PHP versions.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use StubTests\Framework\Parsers\Serializers\Stubs\StubsEntitySerializer;
use StubTests\Framework\Parsers\Processors\EntityProcessingPipeline;
use StubTests\Framework\DataProvider\AllStubsDataProvider;
use StubTests\Framework\Parsers\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Parsers\Stubs\AllStubsParser;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubDefineConstantParser;
use StubTests\Framework\Parsers\Stubs\StubEnumParser;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Framework\Parsers\Stubs\StubInterfaceParser;
use StubTests\Framework\Parsers\Stubs\StubModernConstantParser;
use StubTests\Framework\Parsers\Storage\MultiFileJsonStorage;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Processors\StubsDeduplicationProcessor;

echo "========================================\n";
echo "PHP Stubs Parser Runner\n";
echo "========================================\n";
echo "Start Time: " . date('Y-m-d H:i:s') . "\n";
echo "========================================\n\n";

// Setup paths
$stubsRootPath = dirname(__DIR__);
$cacheFilePath = __DIR__ . "/cache/Stubs.json";
$phpDocCacheFilePath = __DIR__ . "/cache/StubsPhpDoc.json";

echo "Stubs Root: {$stubsRootPath}\n";
echo "Output File: {$cacheFilePath}\n";
echo "PhpDoc File: {$phpDocCacheFilePath}\n\n";

try {
    // Create data provider
    echo "[1/5] Creating data provider...\n";
    $dataProvider = new AllStubsDataProvider($stubsRootPath);
    echo "      ✓ Data provider created\n\n";

    // Create storage manager with multi-file JSON storage and deduplication pipeline
    echo "[2/5] Creating storage manager with multi-file storage and deduplication pipeline...\n";
    $phpDocStorage = new PhpDocStorage($phpDocCacheFilePath, false); // Start fresh
    $serializer = new StubsEntitySerializer($phpDocStorage);
    $storage = new MultiFileJsonStorage($cacheFilePath, $serializer, false, $phpDocStorage); // Multi-file storage
    $pipeline = new EntityProcessingPipeline();
    $pipeline->addProcessor(new StubsDeduplicationProcessor());
    $storageManager = new DefaultParsedDataStorageManager($storage, $pipeline);
    echo "      ✓ Storage manager created with multi-file storage and deduplication enabled\n\n";

    // Create parsers
    echo "[3/5] Creating parsers...\n";
    $parsers = [
        new StubClassParser(),
        new StubFunctionParser(),
        new StubInterfaceParser(),
        new StubEnumParser(),
        new StubDefineConstantParser(),
        new StubModernConstantParser(),
    ];
    echo "      ✓ " . count($parsers) . " parsers ready (Classes, Functions, Interfaces, Enums, Constants)\n\n";

    // Create and run parser
    echo "[4/5] Parsing all stub files...\n";
    $parser = new AllStubsParser($dataProvider, $storageManager, $parsers);

    $startTime = microtime(true);
    $parser->parseAll();
    $parseTime = microtime(true) - $startTime;

    echo "      ✓ Parsing completed in " . number_format($parseTime, 2) . " seconds\n\n";

    // Save to JSON
    echo "[5/5] Saving to JSON file...\n";
    $startTime = microtime(true);
    $storageManager->save();
    $saveTime = microtime(true) - $startTime;

    echo "      ✓ Saved in " . number_format($saveTime, 2) . " seconds\n\n";

    // Display statistics
    $allEntities = $storageManager->getAllEntities();
    $classes = $storageManager->getClasses();
    $functions = $storageManager->getFunctions();
    $interfaces = $storageManager->getInterfaces();
    $enums = $storageManager->getEnums();
    $constants = $storageManager->getConstants();

    echo "========================================\n";
    echo "Statistics:\n";
    echo "========================================\n";
    echo "Total Entities: " . count($allEntities) . "\n";
    echo "  - Classes:    " . count($classes) . "\n";
    echo "  - Functions:  " . count($functions) . "\n";
    echo "  - Interfaces: " . count($interfaces) . "\n";
    echo "  - Enums:      " . count($enums) . "\n";
    echo "  - Constants:  " . count($constants) . "\n";
    echo "========================================\n";

    // Calculate file sizes for all output files
    $dir = dirname($cacheFilePath);
    $basename = basename($cacheFilePath, '.json');
    $fileTypes = ['Classes', 'Functions', 'Interfaces', 'Enums', 'Constants'];
    $totalSize = 0;

    echo "File Sizes:\n";
    foreach ($fileTypes as $type) {
        $filePath = $dir . '/' . $basename . $type . '.json';
        if (file_exists($filePath)) {
            $size = filesize($filePath);
            $totalSize += $size;
            echo "  - {$type}:       " . str_pad(number_format($size / 1024 / 1024, 2) . " MB", 10) . "\n";
        }
    }

    if (file_exists($phpDocCacheFilePath)) {
        $phpDocFileSize = filesize($phpDocCacheFilePath);
        $totalSize += $phpDocFileSize;
        echo "  - PhpDoc:      " . number_format($phpDocFileSize / 1024 / 1024, 2) . " MB\n";
    }

    echo "  ---\n";
    echo "  Total:         " . number_format($totalSize / 1024 / 1024, 2) . " MB\n";
    echo "========================================\n\n";

    echo "✓ SUCCESS: Parsing completed successfully!\n";
    echo "          Stubs output saved to multiple files in: {$dir}/\n";
    echo "          PhpDoc output saved to: {$phpDocCacheFilePath}\n\n";

    exit(0);
} catch (Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "  Trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
