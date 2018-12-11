<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Parsers\StubParser;

class StubsTestDataProviders
{

    public static function stubClassConstantProvider()
    {
        /**@var PHPClass $class */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPClass::class] as $class) {
            foreach ($class->constants as $constant) {
                yield "constant {$class->name}::{$constant->name}" => [$class->name, $constant];
            }
        }

        /**@var PHPInterface $interface */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPInterface::class] as $interfaceName => $interface) {
            foreach ($interface->constants as $constantName => $constant) {
                yield "constant {$interfaceName}::{$constantName}" => [$interfaceName, $constant];
            }
        }
    }

    public static function stubConstantProvider()
    {
        /**@var PHPConst $constant */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPConst::class] as $constantName => $constant) {
            yield "constant {$constantName}" => [$constant];
        }
    }

    public static function stubFunctionProvider()
    {
        /**@var PHPFunction $function */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPFunction::class] as $functionName => $function) {
            yield "function {$functionName}" => [$function];
        }
    }

    public static function stubClassProvider()
    {
        /**@var PHPClass $class */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPClass::class] as $class) {
            yield "class {$class->name}" => [$class];
        }

        /**@var PHPInterface $interface */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPInterface::class] as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }

    public static function stubMethodProvider()
    {
        /**@var PHPClass $class */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPClass::class] as $className => $class) {
            /**@var PHPMethod $method */
            foreach ($class->methods as $methodName => $method) {
                yield "method {$className}::{$methodName}" => [$methodName, $method];
            }
        }

        /**@var PHPInterface $interface */
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPInterface::class] as $interfaceName => $interface) {
            /**@var PHPMethod $method */
            foreach ($interface->methods as $methodName => $method) {
                yield "interface {$interfaceName}::{$methodName}" => [$methodName, $method];
            }
        }
    }
}

class PhpStormStubsSingleton
{
    private static $phpstormStubs;

    public static function getPhpStormStubs(): array
    {
        if (self::$phpstormStubs === null) {
            self::$phpstormStubs = StubParser::getPhpStormStubs();
        }
        return self::$phpstormStubs;
    }
}
