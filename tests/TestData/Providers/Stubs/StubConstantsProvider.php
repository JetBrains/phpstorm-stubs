<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Generator;
use StubTests\Model\PHPEnum;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubConstantsProvider
{
    public static function classConstantProvider(): ?Generator
    {
        $classes = PhpStormStubsSingleton::getPhpStormStubs()->getClasses();
        if (empty($classes)) {
            yield [null, null];
        }else {
            foreach ($classes as $class) {
                foreach ($class->constants as $constant) {
                    yield "constant $class->id::$constant->name [$class->stubObjectHash]" => [$class->stubObjectHash, $constant->name];
                }
            }
        }
    }

    public static function interfaceConstantProvider(): ?Generator
    {
        $interfaces = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        if (empty($interfaces)) {
            yield [null, null];
        }else {
            foreach ($interfaces as $class) {
                foreach ($class->constants as $constant) {
                    yield "constant $class->id::$constant->name" => [$class->id, $constant->name];
                }
            }
        }
    }

    public static function enumConstantProvider(): ?Generator
    {
        $enums = PhpStormStubsSingleton::getPhpStormStubs()->getEnums();
        $constants = array_filter(array_map(fn (PHPEnum $enum) => $enum->constants, $enums), fn ($constants) => !empty($constants));
        if (empty($constants)) {
            yield [null, null];
        }else {
            foreach ($enums as $class) {
                foreach ($class->constants as $constant) {
                    yield "constant $class->id::$constant->name" => [$class->id, $constant->name];
                }
            }
        }
    }

    public static function globalConstantProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getConstants() as $constantId => $constant) {
            yield "constant $constantId" => [$constantId];
        }
    }
}
