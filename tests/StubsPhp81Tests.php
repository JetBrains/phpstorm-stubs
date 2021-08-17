<?php

namespace StubTests;

use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPProperty;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsPhp81Tests extends BaseStubsTest
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classReadonlyPropertiesProvider
     * @throws RuntimeException
     */
    public function testPropertyReadonly(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->getProperty($property->name);
        static::assertEquals(
            $property->isReadonly,
            $stubProperty->isReadonly,
            "Property $className::$property->name readonly modifier is incorrect"
        );
    }
}
