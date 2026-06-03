<?php

namespace StubTests\Unit\Parsers\Storage;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;

class PhpDocStorageTest extends TestCase
{
    private string $testFilePath;

    protected function setUp(): void
    {
        $this->testFilePath = sys_get_temp_dir() . '/phpstorm-stubs-test-phpdoc-' . uniqid() . '.json';
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }

    public function testStoreAndRetrievePhpDoc(): void
    {
        $storage = new PhpDocStorage($this->testFilePath, false);

        $storage->setPhpDoc('\\TestClass', '/** @deprecated */');
        $storage->setPhpDoc('\\TestClass::testMethod', '/** @return void */');
        $storage->save();

        // Load in new instance
        $newStorage = new PhpDocStorage($this->testFilePath);

        self::assertEquals('/** @deprecated */', $newStorage->getPhpDoc('\\TestClass'));
        self::assertEquals('/** @return void */', $newStorage->getPhpDoc('\\TestClass::testMethod'));
    }

    public function testHasPhpDoc(): void
    {
        $storage = new PhpDocStorage($this->testFilePath, false);

        $storage->setPhpDoc('\\TestClass', '/** @deprecated */');

        self::assertTrue($storage->hasPhpDoc('\\TestClass'));
        self::assertFalse($storage->hasPhpDoc('\\NonExistent'));
    }

    public function testNullPhpDocRemovesEntry(): void
    {
        $storage = new PhpDocStorage($this->testFilePath, false);

        $storage->setPhpDoc('\\TestClass', '/** @deprecated */');
        self::assertTrue($storage->hasPhpDoc('\\TestClass'));

        $storage->setPhpDoc('\\TestClass', null);
        self::assertFalse($storage->hasPhpDoc('\\TestClass'));
    }

    public function testEmptyPhpDocRemovesEntry(): void
    {
        $storage = new PhpDocStorage($this->testFilePath, false);

        $storage->setPhpDoc('\\TestClass', '/** @deprecated */');
        self::assertTrue($storage->hasPhpDoc('\\TestClass'));

        $storage->setPhpDoc('\\TestClass', '   ');
        self::assertFalse($storage->hasPhpDoc('\\TestClass'));
    }

    public function testGetAllPhpDocs(): void
    {
        $storage = new PhpDocStorage($this->testFilePath, false);

        $storage->setPhpDoc('\\TestClass', '/** @deprecated */');
        $storage->setPhpDoc('\\TestClass::testMethod', '/** @return void */');

        $all = $storage->getAllPhpDocs();

        self::assertCount(2, $all);
        self::assertEquals('/** @deprecated */', $all['\\TestClass']);
        self::assertEquals('/** @return void */', $all['\\TestClass::testMethod']);
    }

    public function testClear(): void
    {
        $storage = new PhpDocStorage($this->testFilePath, false);

        $storage->setPhpDoc('\\TestClass', '/** @deprecated */');
        $storage->setPhpDoc('\\TestClass::testMethod', '/** @return void */');

        $storage->clear();

        self::assertEmpty($storage->getAllPhpDocs());
    }

    public function testLoadNonExistentFile(): void
    {
        $storage = new PhpDocStorage('/non/existent/file.json');

        self::assertNull($storage->getPhpDoc('\\TestClass'));
        self::assertEmpty($storage->getAllPhpDocs());
    }
}
