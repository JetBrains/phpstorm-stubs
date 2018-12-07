<?php

namespace TestData\Providers;

use Model\PHPClass;
use Model\PHPConst;
use Model\PHPFunction;
use Model\PHPInterface;
use Parsers\PHPReflectionParser;

class ReflectionTestDataProviders
{

    public static function constantProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()[PHPConst::class] as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    public static function functionProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()[PHPFunction::class] as $function) {
            yield "function {$function->name}" => [$function];
        }
    }

    public static function classProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()[PHPClass::class] as $class) {
            //exclude classes from PHPReflectionParser
            if (0 !== strncmp($class->name, 'PHP', 3)) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    public static function interfaceProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()[PHPInterface::class] as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }

}

class ReflectionStubsSingleton
{
    private static $reflectionStubs;

    /**
     * @return array
     */
    public static function getReflectionStubs(): array
    {
        if (self::$reflectionStubs === null) {

            self::$reflectionStubs = PHPReflectionParser::getStubs();
        }
        return self::$reflectionStubs;
    }
}