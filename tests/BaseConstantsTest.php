<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Exception;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPInterface;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class BaseConstantsTest extends BaseStubsTest
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::constantProvider
     * @throws Exception
     */
    public function testConstants(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getConstants();
        static::assertArrayHasKey(
            $constantName,
            $stubConstants,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::classConstantProvider
     * @throws Exception|RuntimeException
     */
    public function testClassConstants(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        if ($class instanceof PHPClass) {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->constants;
        } else {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->constants;
        }
        static::assertArrayHasKey(
            $constantName,
            $stubConstants,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::classConstantProvider
     * @throws RuntimeException
     */
    public function testClassConstantsVisibility(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantVisibility = $constant->visibility;
        if ($class instanceof PHPClass) {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->constants;
        } else {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->constants;
        }
        static::assertEquals(
            $constantVisibility,
            $stubConstants[$constantName]->visibility,
            "Constant visibility mismatch: const $constantName \n
            Expected visibility: $constantVisibility but was {$stubConstants[$constantName]->visibility}"
        );
    }
}
