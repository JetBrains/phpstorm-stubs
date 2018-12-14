<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use StubTests\Model\StubsContainer;
use StubTests\Parsers\PHPReflectionParser;

class ReflectionTestDataProviders
{

    public static function constantProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getConstants() as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    public static function functionProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getFunctions() as $function) {
            yield "function {$function->name}" => [$function];
        }
    }

    public static function classProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    public static function interfaceProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getInterfaces() as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }
}

class ReflectionStubsSingleton
{
    private static $reflectionStubs;

    public static function getReflectionStubs(): StubsContainer
    {
        if (self::$reflectionStubs === null) {
            self::$reflectionStubs = PHPReflectionParser::getStubs();
        }
        return self::$reflectionStubs;
    }
}
