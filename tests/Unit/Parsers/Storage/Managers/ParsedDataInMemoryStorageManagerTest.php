<?php

namespace StubTests\Unit\Parsers\Storage\Managers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Storage\InMemoryParsedDataStorage;
use StubTests\Framework\Storage\ParsedDataStorageProvider;

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

    /**
     * The getters document `@return PHPClass[]` etc., but array_filter preserves the keys of
     * the unfiltered entity list, so with mixed entity types they came back sparse — e.g.
     * keys [0, 2, 4] for three classes among five entities. That JSON-encodes as an object
     * rather than an array and breaks any caller that assumes 0..n-1.
     */
    public function testTypedGettersReturnListsNotSparseArrays()
    {
        $storage = new InMemoryParsedDataStorage();
        $manager = new DefaultParsedDataStorageManager($storage);

        // interleave types so the surviving keys of each filter are non-contiguous
        $manager->addClass($this->namedClass('A'));
        $manager->addInterface($this->namedInterface('I'));
        $manager->addClass($this->namedClass('B'));
        $manager->addInterface($this->namedInterface('J'));
        $manager->addClass($this->namedClass('C'));

        self::assertSame([0, 1, 2], array_keys($manager->getClasses()));
        self::assertSame([0, 1], array_keys($manager->getInterfaces()));
        self::assertTrue(array_is_list($manager->getClasses()));
        self::assertTrue(array_is_list($manager->getInterfaces()));
    }

    /**
     * hasX() is backed by a lazily built id index rather than a linear scan. The index must
     * be dropped by invalidateCache(), or an entity added after an earlier hasX()/getX()
     * call would be reported missing.
     */
    public function testIdIndexIsInvalidatedWhenEntitiesAreAddedLater()
    {
        $storage = new InMemoryParsedDataStorage();
        $manager = new DefaultParsedDataStorageManager($storage);

        $manager->addClass($this->namedClass('First'));
        self::assertTrue($manager->hasClass('\\First'), 'sanity: the first class is found');
        self::assertFalse($manager->hasClass('\\Second'), 'this call builds the index');

        // added *after* the index was built
        $manager->addClass($this->namedClass('Second'));

        self::assertTrue($manager->hasClass('\\Second'), 'index must have been invalidated');
        self::assertTrue($manager->hasClass('\\First'), 'and the earlier entity still found');
    }

    public function testHasXDistinguishesKindsWithTheSameId()
    {
        $storage = new InMemoryParsedDataStorage();
        $manager = new DefaultParsedDataStorageManager($storage);
        $manager->addInterface($this->namedInterface('Shape'));

        self::assertTrue($manager->hasInterface('\\Shape'));
        self::assertFalse($manager->hasClass('\\Shape'), 'an interface must not answer hasClass()');
        self::assertFalse($manager->hasEnum('\\Shape'));
    }

    private function namedClass(string $name): PHPClass
    {
        $class = new PHPClass();
        $class->setName($name);
        $class->setId('\\' . $name);
        return $class;
    }

    private function namedInterface(string $name): PHPInterface
    {
        $interface = new PHPInterface();
        $interface->setName($name);
        $interface->setId('\\' . $name);
        return $interface;
    }
}
