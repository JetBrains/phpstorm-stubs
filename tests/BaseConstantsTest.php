<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPInterface;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider;

class BaseConstantsTest extends AbstractBaseStubsTestCase
{
    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(ReflectionConstantsProvider::class, 'constantProvider')]
    public function testConstants(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getConstant($constantName);
        static::assertNotEmpty(
            $stubConstant,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(ReflectionConstantsProvider::class, 'classConstantProvider')]
    public function testClassConstants(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        if ($class instanceof PHPClass) {
            $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->getConstant($constantName);
        } else {
            $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->getConstant($constantName);
        }
        static::assertNotEmpty(
            $stubConstant,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(ReflectionConstantsProvider::class, 'classConstantProvider')]
    public function testClassConstantsVisibility(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantVisibility = $constant->visibility;
        if ($class instanceof PHPClass) {
            $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->getConstant($constantName);
        } else {
            $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->getConstant($constantName);
        }
        static::assertEquals(
            $constantVisibility,
            $stubConstant->visibility,
            "Constant visibility mismatch: const $constantName \n
            Expected visibility: $constantVisibility but was $stubConstant->visibility"
        );
    }
}
