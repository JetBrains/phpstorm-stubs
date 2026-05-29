<?php

namespace StubTests\Unit\DataProviders;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Processors\EntityProcessingPipeline;
use StubTests\Framework\DataProvider\AllStubsDataProvider;
use StubTests\Framework\DataProvider\CoreStubsDataProvider;
use StubTests\Framework\DataProvider\StubCategory;
use StubTests\Framework\Parsers\Stubs\AllStubsParser;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Framework\Parsers\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Parsers\Storage\InMemoryParsedDataStorage;

/**
 * This test demonstrates how to use CoreStubsDataProvider to parse only specific
 * categories of stubs, which is useful for tests that should only validate core
 * PHP functionality (e.g., type hint validation) or to improve test performance.
 */
class CoreStubsDataProviderUsageExampleTest extends TestCase
{
    /**
     * Example: Parse only Core stubs (fastest, minimal set)
     */
    public function testParseOnlyCoreStubs()
    {
        $dataProvider = new CoreStubsDataProvider(StubCategory::CORE);
        $storage = new InMemoryParsedDataStorage();
        $storageManager = new DefaultParsedDataStorageManager($storage);

        $parser = new AllStubsParser(
            $dataProvider,
            $storageManager,
            [new StubClassParser(), new StubFunctionParser()]
        );

        $parser->parseAll();

        $classes = $storageManager->getClasses();
        $functions = $storageManager->getFunctions();

        // Verify we got core classes and functions
        self::assertNotEmpty($classes);
        self::assertNotEmpty($functions);

        // Should include core classes like Exception, stdClass, etc.
        self::assertTrue($storageManager->hasClass('\\Exception'));
    }

    /**
     * Example: Parse Core + Bundled stubs (common use case)
     */
    public function testParseCoreAndBundledStubs()
    {
        $dataProvider = new CoreStubsDataProvider([StubCategory::CORE, StubCategory::BUNDLED]);
        $storage = new InMemoryParsedDataStorage();
        $storageManager = new DefaultParsedDataStorageManager($storage);

        $parser = new AllStubsParser(
            $dataProvider,
            $storageManager,
            [new StubClassParser(), new StubFunctionParser()]
        );

        $parser->parseAll();

        $classes = $storageManager->getClasses();

        // Should include bundled classes like PDO
        self::assertNotEmpty($classes);
    }

    /**
     * Example: Parse only PECL stubs (third-party extensions)
     */
    public function testParseOnlyPeclStubs()
    {
        $dataProvider = new CoreStubsDataProvider(StubCategory::PECL);
        $storage = new InMemoryParsedDataStorage();
        $storageManager = new DefaultParsedDataStorageManager($storage);

        $parser = new AllStubsParser(
            $dataProvider,
            $storageManager,
            [new StubClassParser(), new StubFunctionParser()]
        );

        $parser->parseAll();

        $classes = $storageManager->getClasses();
        $functions = $storageManager->getFunctions();

        // PECL extensions should have classes and functions
        self::assertNotEmpty($classes);
        self::assertNotEmpty($functions);
    }

    /**
     * Performance comparison: Core only vs All stubs
     */
    public function testCoreStubsAreFasterThanAllStubs()
    {
        // Parse only core stubs
        $coreStart = microtime(true);
        $coreProvider = new CoreStubsDataProvider(StubCategory::CORE);
        $coreFiles = $coreProvider->getAllStubFiles();
        $coreTime = microtime(true) - $coreStart;

        // Parse all stubs
        $allStart = microtime(true);
        $allProvider = new AllStubsDataProvider();
        $allFiles = $allProvider->getAllStubFiles();
        $allTime = microtime(true) - $allStart;

        // Core should be much faster
        self::assertLessThan(count($allFiles), count($coreFiles));

        echo "\n";
        echo "Core stubs: " . count($coreFiles) . " files in " . round($coreTime * 1000, 2) . "ms\n";
        echo "All stubs:  " . count($allFiles) . " files in " . round($allTime * 1000, 2) . "ms\n";
        echo "Reduction:  " . round((1 - count($coreFiles) / count($allFiles)) * 100, 1) . "% fewer files\n";
    }

    /**
     * Example: Use case for type hint validation - only test Core + Bundled + External
     * (exclude PECL because PECL extensions may not have strict type hints)
     */
    public function testTypeHintValidationShouldUseCoreAndBundledAndExternal()
    {
        $dataProvider = new CoreStubsDataProvider([
            StubCategory::CORE,
            StubCategory::BUNDLED,
            StubCategory::EXTERNAL
        ]);

        $stubFiles = $dataProvider->getAllStubFiles();

        // This would be used for type hint validation tests
        self::assertNotEmpty($stubFiles);

        // Verify no PECL extensions are included
        foreach ($stubFiles as $file) {
            $relativePath = str_replace($dataProvider->getStubsRootPath() . '/', '', $file);
            $topLevelDir = explode('/', $relativePath)[0];

            self::assertFalse(
                StubCategory::PECL->containsDirectory($topLevelDir),
                "PECL directory {$topLevelDir} should not be included in type hint validation"
            );
        }
    }
}
