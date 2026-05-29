<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Processors\EntityProcessingPipeline;
use StubTests\Framework\DataProvider\StubsDataProvider;
use StubTests\Framework\Parsers\Stubs\AllStubsParser;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Framework\Parsers\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Parsers\Storage\InMemoryParsedDataStorage;
use StubTests\Framework\Parsers\Processors\StubsDeduplicationProcessor;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class AllStubsParserTest extends BaseTestCase
{
    private StubsDataProvider $filesProvider;
    private AllStubsParser $parser;
    private DefaultParsedDataStorageManager $storageManager;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Classes';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);

        // Create storage manager
        $storage = new InMemoryParsedDataStorage();
        $this->storageManager = new DefaultParsedDataStorageManager($storage);

        // Create parsers array
        $parsers = [
            new StubClassParser(),
        ];

        // Create AllStubsParser
        $this->parser = new AllStubsParser($this->filesProvider, $this->storageManager, $parsers);
    }

    public function testItParsesMultipleClassesFromSingleFile()
    {
        // This test verifies that AllStubsParser can handle files with multiple classes
        $this->parser->parseAll();

        $classes = $this->storageManager->getClasses();
        $allClasses = array_values($classes);

        // Should have parsed all classes from all fixture files including MultipleClasses.txt
        self::assertGreaterThanOrEqual(3, count($allClasses));

        // Find the classes from MultipleClasses.txt by namespace
        $multipleClassesEntities = array_filter($allClasses, function ($class) {
            return $class->getNamespace() === '\\MyApp\\Models';
        });

        self::assertCount(3, $multipleClassesEntities);

        // Get them as indexed array
        $multipleClassesEntities = array_values($multipleClassesEntities);

        // Verify the three classes are User, Product, Order
        $classNames = array_map(fn($c) => $c->getName(), $multipleClassesEntities);
        self::assertContains('User', $classNames);
        self::assertContains('Product', $classNames);
        self::assertContains('Order', $classNames);
    }

    public function testItParsesPropertiesForEachClassInMultipleClassesFile()
    {
        $this->parser->parseAll();

        $classes = $this->storageManager->getClasses();
        $allClasses = array_values($classes);

        // Find the User class
        $userClass = null;
        foreach ($allClasses as $class) {
            if ($class->getName() === 'User' && $class->getNamespace() === '\\MyApp\\Models') {
                $userClass = $class;
                break;
            }
        }

        self::assertNotNull($userClass, 'User class should be parsed');
        self::assertCount(2, $userClass->getProperties());
        self::assertEquals('name', $userClass->getProperties()[0]->getName());
        self::assertEquals('email', $userClass->getProperties()[1]->getName());
    }

    public function testItParsesMethodsForEachClassInMultipleClassesFile()
    {
        $this->parser->parseAll();

        $classes = $this->storageManager->getClasses();
        $allClasses = array_values($classes);

        // Find the Product class
        $productClass = null;
        foreach ($allClasses as $class) {
            if ($class->getName() === 'Product' && $class->getNamespace() === '\\MyApp\\Models') {
                $productClass = $class;
                break;
            }
        }

        self::assertNotNull($productClass, 'Product class should be parsed');
        self::assertCount(1, $productClass->getMethods());
        self::assertEquals('getPrice', $productClass->getMethods()[0]->getName());
    }

    public function testItParsesConstantsForEachClassInMultipleClassesFile()
    {
        $this->parser->parseAll();

        $classes = $this->storageManager->getClasses();
        $allClasses = array_values($classes);

        // Find the Order class
        $orderClass = null;
        foreach ($allClasses as $class) {
            if ($class->getName() === 'Order' && $class->getNamespace() === '\\MyApp\\Models') {
                $orderClass = $class;
                break;
            }
        }

        self::assertNotNull($orderClass, 'Order class should be parsed');
        self::assertCount(2, $orderClass->getConstants());
        self::assertEquals('STATUS_PENDING', $orderClass->getConstants()[0]->getName());
        self::assertEquals('STATUS_COMPLETED', $orderClass->getConstants()[1]->getName());
    }

    public function testItParsesMultipleFunctionsFromSingleFile()
    {
        // Setup parser with function fixtures
        $functionsFixturesPath = __DIR__ . '/fixtures/Functions';
        $functionsProvider = new FixtureStubsDataProvider($functionsFixturesPath);

        $storage = new InMemoryParsedDataStorage();
        $storageManager = new DefaultParsedDataStorageManager($storage);

        $parsers = [
            new StubFunctionParser(),
        ];

        $parser = new AllStubsParser($functionsProvider, $storageManager, $parsers);
        $parser->parseAll();

        $functions = $storageManager->getFunctions();
        $allFunctions = array_values($functions);

        // Should have parsed all functions from all fixture files including MultipleFunctions.txt
        self::assertGreaterThanOrEqual(4, count($allFunctions));

        // Find the functions from MultipleFunctions.txt by namespace
        $multipleFunctionsEntities = array_filter($allFunctions, function ($func) {
            return $func->getNamespace() === '\\MyApp\\Helpers';
        });

        self::assertCount(4, $multipleFunctionsEntities);

        // Get them as indexed array
        $multipleFunctionsEntities = array_values($multipleFunctionsEntities);

        // Verify the four functions
        $functionNames = array_map(fn($f) => $f->getName(), $multipleFunctionsEntities);
        self::assertContains('calculateSum', $functionNames);
        self::assertContains('getUserName', $functionNames);
        self::assertContains('validateEmail', $functionNames);
        self::assertContains('processData', $functionNames);
    }

    public function testItParsesParametersForEachFunctionInMultipleFunctionsFile()
    {
        // Setup parser with function fixtures
        $functionsFixturesPath = __DIR__ . '/fixtures/Functions';
        $functionsProvider = new FixtureStubsDataProvider($functionsFixturesPath);

        $storage = new InMemoryParsedDataStorage();
        $storageManager = new DefaultParsedDataStorageManager($storage);

        $parsers = [
            new StubFunctionParser(),
        ];

        $parser = new AllStubsParser($functionsProvider, $storageManager, $parsers);
        $parser->parseAll();

        $functions = $storageManager->getFunctions();
        $allFunctions = array_values($functions);

        // Find the calculateSum function
        $calculateSumFunc = null;
        foreach ($allFunctions as $func) {
            if ($func->getName() === 'calculateSum' && $func->getNamespace() === '\\MyApp\\Helpers') {
                $calculateSumFunc = $func;
                break;
            }
        }

        self::assertNotNull($calculateSumFunc, 'calculateSum function should be parsed');
        self::assertCount(2, $calculateSumFunc->getParameters());
        self::assertEquals('a', $calculateSumFunc->getParameters()[0]->getName());
        self::assertEquals('b', $calculateSumFunc->getParameters()[1]->getName());

        // Find the getUserName function
        $getUserNameFunc = null;
        foreach ($allFunctions as $func) {
            if ($func->getName() === 'getUserName' && $func->getNamespace() === '\\MyApp\\Helpers') {
                $getUserNameFunc = $func;
                break;
            }
        }

        self::assertNotNull($getUserNameFunc, 'getUserName function should be parsed');
        self::assertCount(2, $getUserNameFunc->getParameters());
        self::assertEquals('firstName', $getUserNameFunc->getParameters()[0]->getName());
        self::assertEquals('lastName', $getUserNameFunc->getParameters()[1]->getName());
    }

    public function testItParsesReturnTypesForEachFunctionInMultipleFunctionsFile()
    {
        // Setup parser with function fixtures
        $functionsFixturesPath = __DIR__ . '/fixtures/Functions';
        $functionsProvider = new FixtureStubsDataProvider($functionsFixturesPath);

        $storage = new InMemoryParsedDataStorage();
        $storageManager = new DefaultParsedDataStorageManager($storage);

        $parsers = [
            new StubFunctionParser(),
        ];

        $parser = new AllStubsParser($functionsProvider, $storageManager, $parsers);
        $parser->parseAll();

        $functions = $storageManager->getFunctions();
        $allFunctions = array_values($functions);

        // Find the validateEmail function
        $validateEmailFunc = null;
        foreach ($allFunctions as $func) {
            if ($func->getName() === 'validateEmail' && $func->getNamespace() === '\\MyApp\\Helpers') {
                $validateEmailFunc = $func;
                break;
            }
        }

        self::assertNotNull($validateEmailFunc, 'validateEmail function should be parsed');
        self::assertEquals('bool', $validateEmailFunc->getReturnTypeFromSignature()->toString());

        // Find the processData function with union return type
        $processDataFunc = null;
        foreach ($allFunctions as $func) {
            if ($func->getName() === 'processData' && $func->getNamespace() === '\\MyApp\\Helpers') {
                $processDataFunc = $func;
                break;
            }
        }

        self::assertNotNull($processDataFunc, 'processData function should be parsed');
        self::assertEquals('array|string|null', $processDataFunc->getReturnTypeFromSignature()->toString());
    }

    public function testItParsesDeprecationForEachFunctionInMultipleFunctionsFile()
    {
        // Setup parser with function fixtures
        $functionsFixturesPath = __DIR__ . '/fixtures/Functions';
        $functionsProvider = new FixtureStubsDataProvider($functionsFixturesPath);

        $storage = new InMemoryParsedDataStorage();
        $storageManager = new DefaultParsedDataStorageManager($storage);

        $parsers = [
            new StubFunctionParser(),
        ];

        $parser = new AllStubsParser($functionsProvider, $storageManager, $parsers);
        $parser->parseAll();

        $functions = $storageManager->getFunctions();
        $allFunctions = array_values($functions);

        // Find the getUserName function (deprecated)
        $getUserNameFunc = null;
        foreach ($allFunctions as $func) {
            if ($func->getName() === 'getUserName' && $func->getNamespace() === '\\MyApp\\Helpers') {
                $getUserNameFunc = $func;
                break;
            }
        }

        self::assertNotNull($getUserNameFunc, 'getUserName function should be parsed');
        self::assertTrue($getUserNameFunc->isDeprecated(), 'getUserName should be marked as deprecated');

        // Find the calculateSum function (not deprecated)
        $calculateSumFunc = null;
        foreach ($allFunctions as $func) {
            if ($func->getName() === 'calculateSum' && $func->getNamespace() === '\\MyApp\\Helpers') {
                $calculateSumFunc = $func;
                break;
            }
        }

        self::assertNotNull($calculateSumFunc, 'calculateSum function should be parsed');
        self::assertFalse($calculateSumFunc->isDeprecated(), 'calculateSum should not be marked as deprecated');
    }

    public function testItDeduplicatesClassesFromMultipleDirectories()
    {
        // Setup parser with duplicate fixtures
        $duplicatesFixturesPath = __DIR__ . '/fixtures/Duplicates';
        $duplicatesProvider = new FixtureStubsDataProvider($duplicatesFixturesPath);

        $storage = new InMemoryParsedDataStorage();
        $pipeline = new EntityProcessingPipeline();
        $pipeline->addProcessor(new StubsDeduplicationProcessor());
        $storageManager = new DefaultParsedDataStorageManager($storage, $pipeline);

        $parsers = [
            new StubClassParser(),
        ];

        $parser = new AllStubsParser($duplicatesProvider, $storageManager, $parsers);
        $parser->parseAll();

        $classes = $storageManager->getClasses();
        $allClasses = array_values($classes);

        // Find classes in MyLibrary\Core namespace
        $coreClasses = array_filter($allClasses, function ($class) {
            return $class->getNamespace() === '\\MyLibrary\\Core';
        });

        // Should have 4 classes total: Database (v1), Database (v2), Cache (v1), Cache (v2)
        self::assertCount(4, $coreClasses);

        // Verify class names - should have 2 Database and 2 Cache
        $classNames = array_map(fn($c) => $c->getName(), $coreClasses);
        self::assertCount(2, array_filter($classNames, fn($n) => $n === 'Database'));
        self::assertCount(2, array_filter($classNames, fn($n) => $n === 'Cache'));

        // Verify that duplicates are tracked with source paths
        foreach ($coreClasses as $class) {
            self::assertNotNull($class->getStubsMetadata()?->getSourcePath(), 'Class should have a source path');
            self::assertIsArray($class->getStubsMetadata()?->getDuplicates(), 'Class should have duplicates array');
            // Each class appears in both v1 and v2, so should have 1 duplicate
            self::assertCount(1, $class->getStubsMetadata()?->getDuplicates(), 'Class should have 1 duplicate source path');
        }
    }

    public function testItDeduplicatesFunctionsFromMultipleDirectories()
    {
        // Setup parser with duplicate fixtures
        $duplicatesFixturesPath = __DIR__ . '/fixtures/Duplicates';
        $duplicatesProvider = new FixtureStubsDataProvider($duplicatesFixturesPath);

        $storage = new InMemoryParsedDataStorage();
        $pipeline = new EntityProcessingPipeline();
        $pipeline->addProcessor(new StubsDeduplicationProcessor());
        $storageManager = new DefaultParsedDataStorageManager($storage, $pipeline);

        $parsers = [
            new StubFunctionParser(),
        ];

        $parser = new AllStubsParser($duplicatesProvider, $storageManager, $parsers);
        $parser->parseAll();

        $functions = $storageManager->getFunctions();
        $allFunctions = array_values($functions);

        // Find functions in MyLibrary\Core namespace
        $coreFunctions = array_filter($allFunctions, function ($func) {
            return $func->getNamespace() === '\\MyLibrary\\Core';
        });

        // Should have 4 functions total: initialize (v1), initialize (v2), configure (v1), configure (v2)
        self::assertCount(4, $coreFunctions);

        // Verify function names - should have 2 initialize and 2 configure
        $functionNames = array_map(fn($f) => $f->getName(), $coreFunctions);
        self::assertCount(2, array_filter($functionNames, fn($n) => $n === 'initialize'));
        self::assertCount(2, array_filter($functionNames, fn($n) => $n === 'configure'));

        // Verify that duplicates are tracked with source paths
        foreach ($coreFunctions as $function) {
            self::assertNotNull($function->getStubsMetadata()?->getSourcePath(), 'Function should have a source path');
            self::assertIsArray($function->getStubsMetadata()?->getDuplicates(), 'Function should have duplicates array');
            // Each function appears in both v1 and v2, so should have 1 duplicate
            self::assertCount(1, $function->getStubsMetadata()?->getDuplicates(), 'Function should have 1 duplicate source path');
        }
    }

    public function testItKeepsBothVersionsWithCrossReferences()
    {
        // Setup parser with duplicate fixtures
        $duplicatesFixturesPath = __DIR__ . '/fixtures/Duplicates';
        $duplicatesProvider = new FixtureStubsDataProvider($duplicatesFixturesPath);

        $storage = new InMemoryParsedDataStorage();
        $pipeline = new EntityProcessingPipeline();
        $pipeline->addProcessor(new StubsDeduplicationProcessor());
        $storageManager = new DefaultParsedDataStorageManager($storage, $pipeline);

        $parsers = [
            new StubClassParser(),
        ];

        $parser = new AllStubsParser($duplicatesProvider, $storageManager, $parsers);
        $parser->parseAll();

        $classes = $storageManager->getClasses();
        $allClasses = array_values($classes);

        // Find BOTH Database classes (v1 and v2)
        $databaseClasses = array_filter($allClasses, function ($class) {
            return $class->getName() === 'Database' && $class->getNamespace() === '\\MyLibrary\\Core';
        });

        self::assertCount(2, $databaseClasses, 'Should have both v1 and v2 Database classes');

        // Separate v1 and v2 based on method count
        // v1 has 2 methods (connect, query), v2 has 3 methods (connect, query, disconnect)
        $v1Database = null;
        $v2Database = null;
        foreach ($databaseClasses as $class) {
            if (count($class->getMethods()) === 2) {
                $v1Database = $class;
            } elseif (count($class->getMethods()) === 3) {
                $v2Database = $class;
            }
        }

        self::assertNotNull($v1Database, 'v1 Database should be present');
        self::assertNotNull($v2Database, 'v2 Database should be present');

        // Verify v1 has correct methods
        $v1MethodNames = array_map(fn($m) => $m->getName(), $v1Database->getMethods());
        self::assertContains('connect', $v1MethodNames);
        self::assertContains('query', $v1MethodNames);
        self::assertNotContains('disconnect', $v1MethodNames);

        // Verify v2 has correct methods
        $v2MethodNames = array_map(fn($m) => $m->getName(), $v2Database->getMethods());
        self::assertContains('connect', $v2MethodNames);
        self::assertContains('query', $v2MethodNames);
        self::assertContains('disconnect', $v2MethodNames);

        // Verify cross-references exist
        self::assertCount(1, $v1Database->getStubsMetadata()?->getDuplicates(), 'v1 should have 1 duplicate reference');
        self::assertCount(1, $v2Database->getStubsMetadata()?->getDuplicates(), 'v2 should have 1 duplicate reference');

        // Verify the cross-references point to each other
        self::assertStringContainsString('v2', $v1Database->getStubsMetadata()?->getDuplicates()[0], 'v1 should reference v2');
        self::assertStringContainsString('v1', $v2Database->getStubsMetadata()?->getDuplicates()[0], 'v2 should reference v1');
    }
}
