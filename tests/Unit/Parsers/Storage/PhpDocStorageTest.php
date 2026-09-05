<?php

namespace StubTests\Unit\Parsers\Storage;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Serialization\PhpDocRepository;
use StubTests\Framework\Storage\InMemoryPhpDocRepository;
use StubTests\Framework\Storage\PhpDocStorage;

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

    /**
     * The in-memory double stands in for this class in serializer tests, so its blank-doc semantics
     * must match. Run the same script against both: a fake that stored '' where the real writer
     * removes the id would let a serializer bug pass its unit test and fail only in a cache rebuild.
     *
     * @param callable(string): PhpDocRepository $makeRepository
     */
    #[DataProvider('phpDocRepositories')]
    public function testEveryPhpDocRepositoryAgreesOnBlankDocSemantics(callable $makeRepository): void
    {
        $repository = $makeRepository($this->testFilePath);

        $repository->setPhpDoc('\\TestClass', '/** @deprecated */');
        self::assertSame('/** @deprecated */', $repository->getPhpDoc('\\TestClass'));

        $repository->setPhpDoc('\\TestClass', null);
        self::assertNull($repository->getPhpDoc('\\TestClass'), 'a null doc must remove the id');

        $repository->setPhpDoc('\\TestClass', '/** @deprecated */');
        $repository->setPhpDoc('\\TestClass', "  \n\t ");
        self::assertNull($repository->getPhpDoc('\\TestClass'), 'a blank doc must remove the id');

        self::assertNull($repository->getPhpDoc('\\NeverSet'));
    }

    public static function phpDocRepositories(): array
    {
        return [
            'file-backed' => [static fn (string $path): PhpDocRepository => new PhpDocStorage($path, false)],
            'in-memory' => [static fn (string $path): PhpDocRepository => new InMemoryPhpDocRepository()],
        ];
    }
}
