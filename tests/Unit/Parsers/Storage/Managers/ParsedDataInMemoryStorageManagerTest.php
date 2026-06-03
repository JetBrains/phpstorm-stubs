<?php

namespace StubTests\Unit\Parsers\Storage\Managers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Parsers\Storage\InMemoryParsedDataStorage;
use StubTests\Framework\Parsers\Storage\ParsedDataStorageProvider;

class ParsedDataInMemoryStorageManagerTest extends TestCase
{
    public function testManagerReturnsAnEmptyArrayForEmptyCollection()
    {
        $parsedDataCollection = new InMemoryParsedDataStorage();
        $parsedDataManager = new DefaultParsedDataStorageManager($parsedDataCollection);
        self::assertNotNull($parsedDataManager->getAllEntities());
        self::assertIsArray($parsedDataManager->getAllEntities());
        self::assertEmpty($parsedDataManager->getAllEntities());
    }

    public function testManagerCanAddClass()
    {
        $parsedDataCollection = new InMemoryParsedDataStorage();
        $parsedDataManager = new DefaultParsedDataStorageManager($parsedDataCollection);
        $entity = new PHPClass();
        $entity->setName("MyClass");
        $entity->setNamespace("MyNamespace");
        $parsedDataManager->addClass($entity);
        self::assertNotEmpty($parsedDataManager->getAllEntities());
    }

    public function testManagerCanFetchClasses() {
        $parsedDataCollectionMock = $this->getMockBuilder(ParsedDataStorageProvider::class)->disableOriginalConstructor()->getMock();
        $mockClassToReturn = $this->getMockBuilder(PHPClass::class)->disableOriginalConstructor()->getMock();
        $mockClassToReturn->method('getName')->willReturn("MyClass");
        $mockClassToReturn->method('getNamespace')->willReturn("MyNamespace");
        $parsedDataCollectionMock->method('getEntities')->willReturn([$mockClassToReturn]);
        $parsedDataManager = new DefaultParsedDataStorageManager($parsedDataCollectionMock);
        self::assertNotEmpty($parsedDataManager->getClasses());
        self::assertIsArray($parsedDataManager->getClasses());
        self::assertEquals(1, sizeof($parsedDataManager->getClasses()));
    }
}
