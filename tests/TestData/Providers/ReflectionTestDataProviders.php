<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Parsers\PHPReflectionParser;

class ReflectionTestDataProviders
{

    public static function constantProvider()
    {
        /**@var PHPConst $constant */
        foreach (ReflectionStubsSingleton::getReflectionStubs()[PHPConst::class] as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    public static function functionProvider()
    {
        /**@var PHPFunction $function */
        foreach (ReflectionStubsSingleton::getReflectionStubs()[PHPFunction::class] as $function) {
            yield "function {$function->name}" => [$function];
        }
    }

    public static function classProvider()
    {
        /**@var PHPClass $class */
        foreach (ReflectionStubsSingleton::getReflectionStubs()[PHPClass::class] as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    public static function interfaceProvider()
    {
        /**@var PHPInterface $interface */
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
