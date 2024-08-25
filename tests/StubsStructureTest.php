<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Stubs\PhpCoreStubsProvider;
use StubTests\TestData\Providers\Stubs\StubsTestDataProviders;

class StubsStructureTest extends AbstractBaseStubsTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
    }

    #[DataProviderExternal(StubsTestDataProviders::class, 'stubsDirectoriesProvider')]
    public function testStubsDirectoryExistInMap($directory)
    {
        self::assertContains(
            $directory,
            iterator_to_array(new RecursiveIteratorIterator(
                new RecursiveArrayIterator(PhpCoreStubsProvider::$StubDirectoryMap)
            ), false),
            "Stubs directories provider doesn't contain '$directory'. Please add '$directory' to 'PhpCoreStubsProvider::StubDirectoryMap'"
        );
    }
}
