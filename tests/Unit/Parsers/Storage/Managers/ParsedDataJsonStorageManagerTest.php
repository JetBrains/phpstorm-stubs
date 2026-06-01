<?php

namespace StubTests\Unit\Parsers\Storage\Managers;

use StubTests\Framework\Parsers\Serializers\Stubs\StubsEntitySerializer;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Parsers\Storage\JsonParsedDataStorage;

class ParsedDataJsonStorageManagerTest extends TestCase
{
    private string $tempDir;
    private array $tempFiles = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->tempDir = __DIR__ . '/../test_cache/test_json_storage';
        if (!file_exists($this->tempDir)) {
            mkdir($this->tempDir, 0777, true);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        // Clean up all temporary files
        foreach ($this->tempFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        // Remove temp directory if empty
        if (file_exists($this->tempDir) && count(scandir($this->tempDir)) === 2) {
            rmdir($this->tempDir);
        }
    }

    private function getTempFilePath(string $name): string
    {
        $path = $this->tempDir . '/' . $name . '.json';
        $this->tempFiles[] = $path;
        return $path;
    }

    public function testManagerCanWriteAndReadReflectionDataToJson()
    {
        $jsonFilePath = $this->getTempFilePath('reflection_test');

        // Create manager with JSON storage
        $jsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer(), false);
        $manager = new DefaultParsedDataStorageManager($jsonStorage);

        // Add a class entity
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setNamespace('Test\\Namespace');
        $class->setId('test_class_id');
        $manager->addClass($class);

        // Save to JSON file
        $manager->save();

        // Verify file was created
        self::assertFileExists($jsonFilePath);

        // Create a new manager/storage to read from the file
        $newJsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer());
        $newManager = new DefaultParsedDataStorageManager($newJsonStorage);

        // Verify entities were loaded
        $entities = $newManager->getAllEntities();
        self::assertNotEmpty($entities);
        self::assertCount(1, $entities);

        // Verify the class data
        $loadedClass = $entities[0];
        self::assertInstanceOf(PHPClass::class, $loadedClass);
        self::assertEquals('TestClass', $loadedClass->getName());
        self::assertEquals('Test\\Namespace', $loadedClass->getNamespace());
        self::assertEquals('test_class_id', $loadedClass->getId());
    }

    public function testManagerCanWriteAndReadStubsDataToJson()
    {
        $jsonFilePath = $this->getTempFilePath('stubs_test');

        // Create manager with JSON storage (same manager works for both stubs and reflection)
        $jsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer(), false);
        $manager = new DefaultParsedDataStorageManager($jsonStorage);

        // Add multiple class entities
        $class1 = new PHPClass();
        $class1->setName('StubClass1');
        $class1->setNamespace('Stubs');
        $manager->addClass($class1);

        $class2 = new PHPClass();
        $class2->setName('StubClass2');
        $class2->setNamespace('Stubs');
        $manager->addClass($class2);

        // Save to JSON file
        $manager->save();

        // Read back and verify
        $newJsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer());
        $newManager = new DefaultParsedDataStorageManager($newJsonStorage);

        $classes = $newManager->getClasses();
        self::assertCount(2, $classes);

        $classNames = array_map(fn ($c) => $c->getName(), $classes);
        self::assertContains('StubClass1', $classNames);
        self::assertContains('StubClass2', $classNames);
    }

    public function testJsonRoundTripPreservesEntityData()
    {
        $jsonFilePath = $this->getTempFilePath('roundtrip_test');

        // Create a class with all properties set
        $originalClass = new PHPClass();
        $originalClass->setName('CompleteClass');
        $originalClass->setNamespace('Complete\\Namespace');
        $originalClass->setId('complete_id');
        $originalClass->setIsFinal(true);
        $originalClass->setIsReadonly(false);

        // Write to JSON
        $jsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer(), false);
        $manager = new DefaultParsedDataStorageManager($jsonStorage);
        $manager->addClass($originalClass);
        $manager->save();

        // Read back
        $newJsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer());
        $newManager = new DefaultParsedDataStorageManager($newJsonStorage);
        $entities = $newManager->getAllEntities();

        // Verify all data is preserved
        self::assertCount(1, $entities);
        $loadedClass = $entities[0];

        self::assertEquals($originalClass->getName(), $loadedClass->getName());
        self::assertEquals($originalClass->getNamespace(), $loadedClass->getNamespace());
        self::assertEquals($originalClass->getId(), $loadedClass->getId());
        self::assertEquals($originalClass->isFinal(), $loadedClass->isFinal());
        self::assertEquals($originalClass->isReadonly(), $loadedClass->isReadonly());
    }

    public function testEmptyJsonFileReturnsEmptyArray()
    {
        $jsonFilePath = $this->getTempFilePath('empty_test');

        // Create storage with non-existent file
        $jsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer());
        $manager = new DefaultParsedDataStorageManager($jsonStorage);

        // Verify empty array is returned
        self::assertIsArray($manager->getAllEntities());
        self::assertEmpty($manager->getAllEntities());
        self::assertCount(0, $manager->getClasses());
    }

    public function testHasClassMethodWorksWithJsonStorage()
    {
        $jsonFilePath = $this->getTempFilePath('hasclass_test');

        // Add a class
        $jsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer(), false);
        $manager = new DefaultParsedDataStorageManager($jsonStorage);

        $class = new PHPClass();
        $class->setName('SearchableClass');
        $class->setNamespace('Search');
        $class->setId('\\Search\\SearchableClass');
        $manager->addClass($class);
        $manager->save();

        // Load and test hasClass
        $newJsonStorage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer());
        $newManager = new DefaultParsedDataStorageManager($newJsonStorage);

        self::assertTrue($newManager->hasClass('\\Search\\SearchableClass'));
        self::assertFalse($newManager->hasClass('\\NonExistent\\NonExistentClass'));
    }

    public function testMultipleWritesAndReads()
    {
        $jsonFilePath = $this->getTempFilePath('multiple_test');

        // First write
        $jsonStorage1 = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer(), false);
        $manager1 = new DefaultParsedDataStorageManager($jsonStorage1);

        $class1 = new PHPClass();
        $class1->setName('FirstClass');
        $manager1->addClass($class1);
        $manager1->save();

        // Second write (should append to existing)
        $jsonStorage2 = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer());
        $manager2 = new DefaultParsedDataStorageManager($jsonStorage2);

        $class2 = new PHPClass();
        $class2->setName('SecondClass');
        $manager2->addClass($class2);
        $manager2->save();

        // Read back - should have both classes
        $jsonStorage3 = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer());
        $manager3 = new DefaultParsedDataStorageManager($jsonStorage3);

        $classes = $manager3->getClasses();
        self::assertCount(2, $classes);

        $classNames = array_map(fn ($c) => $c->getName(), $classes);
        self::assertContains('FirstClass', $classNames);
        self::assertContains('SecondClass', $classNames);
    }

    public function testAddEntityStoresDuplicatesWithSameId(): void
    {
        // Regression test: the old JsonParsedDataStorage silently dropped the second entity
        // when two entities shared the same getId() value (e.g. couchbase vs couchbase_v2
        // directories that contain identically-named classes). Deduplication belongs to the
        // pipeline (StubsDeduplicationProcessor), not to the storage layer.

        $jsonFilePath = $this->getTempFilePath('duplicate_id_test');
        $storage = new JsonParsedDataStorage($jsonFilePath, new StubsEntitySerializer(), false);

        $entity1 = new PHPClass();
        $entity1->setId('\Couchbase\SearchFacet');
        $entity1->setName('SearchFacet');

        $entity2 = new PHPClass();
        $entity2->setId('\Couchbase\SearchFacet'); // same ID, different object (from different directory)
        $entity2->setName('SearchFacet');

        $storage->addEntity($entity1);
        $storage->addEntity($entity2);

        // Both must be stored — no ID-based deduplication in the storage layer
        self::assertCount(2, $storage->getEntities());
    }
}
