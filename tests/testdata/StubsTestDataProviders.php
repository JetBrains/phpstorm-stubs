<?php

namespace TestData\Providers;

use Model\PHPClass;
use Model\PHPConst;
use Model\PHPFunction;
use Model\PHPInterface;
use Parsers\StubParser;

class StubsTestDataProviders
{

    public static function stubClassConstantProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPClass::class] as $class) {
            if ($class->constants != null) {
                foreach ($class->constants as $constant) {
                    yield "Constant {$class->name}::{$constant->name}" => [$class->name, $constant];
                }
            }

        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPInterface::class] as $interfaceName => $interface) {
            foreach ($interface->constants as $constantName => $constant) {
                yield "Constant {$interfaceName}::{$constantName}" => [$interfaceName, $constant];
            }
        }
    }

    public static function stubConstantProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPConst::class] as $constantName => $constant) {
            yield "constant {$constantName}" => [$constant];
        }
    }

    public static function stubFunctionProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPFunction::class] as $functionName => $function) {
            yield "function {$functionName}" => [$function];
        }
    }

    public static function stubClassProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPClass::class] as $class) {
            yield "class {$class->name}" => [$class];
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPInterface::class] as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }

    public static function stubMethodProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPClass::class] as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "Method {$className}::{$methodName}" => [$methodName, $method];
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()[PHPInterface::class] as $interfaceName => $interface) {
            foreach ($interface->methods as $methodName => $method) {
                yield "Method {$interfaceName}::{$methodName}" => [$methodName, $method];
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