<?php

namespace StubTests\Unit\Parsers\Storage;

use StubTests\Framework\Parsers\Serializers\Stubs\StubsEntitySerializer;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Storage\EntityTypeFileRouter;
use StubTests\Framework\Parsers\Storage\MultiFileJsonStorage;

class MultiFileJsonStorageTest extends TestCase
{
    private string $testBasePath;
    private array $testFiles = [];

    protected function setUp(): void
    {
        $this->testBasePath = sys_get_temp_dir() . '/phpstorm-stubs-test-multifile-' . uniqid() . '.json';
    }

    protected function tearDown(): void
    {
        // Clean up all test files
        $router = new EntityTypeFileRouter();
        foreach ($router->getAllFiles() as $fileId) {
            $filePath = $router->buildFilePath($this->testBasePath, $fileId);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    public function testSaveAndLoadMultipleEntityTypes(): void
    {
        $storage = new MultiFileJsonStorage($this->testBasePath, new StubsEntitySerializer(), false);

        // Add different entity types
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');
        $storage->addEntity($class);

        $function = new PHPFunction();
        $function->setName('testFunction');
        $function->setId('\\testFunction');
        $storage->addEntity($function);

        $constant = new PHPConstant();
        $constant->setName('TEST_CONSTANT');
        $constant->setId('TEST_CONSTANT');
        $storage->addEntity($constant);

        $storage->save();

        // Verify files were created
        $router = new EntityTypeFileRouter();
        $classesFile = $router->buildFilePath($this->testBasePath, EntityTypeFileRouter::FILE_CLASSES);
        $functionsFile = $router->buildFilePath($this->testBasePath, EntityTypeFileRouter::FILE_FUNCTIONS);
        $constantsFile = $router->buildFilePath($this->testBasePath, EntityTypeFileRouter::FILE_CONSTANTS);

        self::assertFileExists($classesFile);
        self::assertFileExists($functionsFile);
        self::assertFileExists($constantsFile);

        // Load from new storage instance
        $newStorage = new MultiFileJsonStorage($this->testBasePath, new StubsEntitySerializer(), true);
        $entities = $newStorage->getEntities();

        self::assertCount(3, $entities);
    }

    public function testGetEntitiesByType(): void
    {
        $storage = new MultiFileJsonStorage($this->testBasePath, new StubsEntitySerializer(), false);

        // Add multiple classes
        for ($i = 1; $i <= 3; $i++) {
            $class = new PHPClass();
            $class->setName("TestClass$i");
            $class->setId("\\TestClass$i");
            $storage->addEntity($class);
        }

        // Add multiple functions
        for ($i = 1; $i <= 2; $i++) {
            $function = new PHPFunction();
            $function->setName("testFunction$i");
            $function->setId("\\testFunction$i");
            $storage->addEntity($function);
        }

        $storage->save();

        // Create new storage and load only classes (need to pass true to load existing)
        $newStorage = new MultiFileJsonStorage($this->testBasePath, new StubsEntitySerializer(), true);
        $classes = $newStorage->getEntitiesByType(EntityTypeFileRouter::FILE_CLASSES);

        self::assertCount(3, $classes);
        foreach ($classes as $class) {
            self::assertInstanceOf(PHPClass::class, $class);
        }

        // Load only functions
        $functions = $newStorage->getEntitiesByType(EntityTypeFileRouter::FILE_FUNCTIONS);

        self::assertCount(2, $functions);
        foreach ($functions as $function) {
            self::assertInstanceOf(PHPFunction::class, $function);
        }
    }

    public function testEmptyEntityTypeCreatesEmptyFile(): void
    {
        $storage = new MultiFileJsonStorage($this->testBasePath, new StubsEntitySerializer(), false);

        // Add only a class
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');
        $storage->addEntity($class);

        $storage->save();

        // Verify classes file exists
        $router = new EntityTypeFileRouter();
        $classesFile = $router->buildFilePath($this->testBasePath, EntityTypeFileRouter::FILE_CLASSES);
        self::assertFileExists($classesFile);

        // Functions file should also exist but be empty array
        $functionsFile = $router->buildFilePath($this->testBasePath, EntityTypeFileRouter::FILE_FUNCTIONS);
        self::assertFileExists($functionsFile);

        $content = file_get_contents($functionsFile);
        $data = json_decode($content, true);
        self::assertIsArray($data);
        self::assertEmpty($data);
    }

    public function testAllEntityTypesSupported(): void
    {
        $storage = new MultiFileJsonStorage($this->testBasePath, new StubsEntitySerializer(), false);

        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');
        $storage->addEntity($class);

        $function = new PHPFunction();
        $function->setName('testFunction');
        $function->setId('\\testFunction');
        $storage->addEntity($function);

        $interface = new PHPInterface();
        $interface->setName('TestInterface');
        $interface->setId('\\TestInterface');
        $storage->addEntity($interface);

        $enum = new PHPEnum();
        $enum->setName('TestEnum');
        $enum->setId('\\TestEnum');
        $storage->addEntity($enum);

        $constant = new PHPConstant();
        $constant->setName('TEST_CONSTANT');
        $constant->setId('TEST_CONSTANT');
        $storage->addEntity($constant);

        $storage->save();

        // Verify all files exist
        $router = new EntityTypeFileRouter();
        foreach ($router->getAllFiles() as $fileId) {
            $filePath = $router->buildFilePath($this->testBasePath, $fileId);
            self::assertFileExists($filePath, "File for $fileId should exist");
        }
    }
}
