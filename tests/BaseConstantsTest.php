<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class BaseConstantsTest extends AbstractBaseStubsTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'constantProvider')]
    public function testConstants(?string $constantId): void
    {
        if (!$constantId) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getConstant($constantId, sourceFilePath: true, fromReflection: true);
        $constantValue = $reflectionConstant->value;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getConstant($constantId);
        static::assertNotEmpty(
            $stubConstant,
            "Missing constant: const $constantId = $constantValue\n"
        );
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'classConstantProvider')]
    public function testClassConstants(?string $classId, ?string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getConstant($constantName, fromReflection: true);
        $constantValue = $reflectionConstant->value;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId)->getConstant($constantName);
        static::assertNotEmpty(
            $stubConstant,
            "Missing constant: $classId::$constantName = $constantValue\n"
        );
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'interfaceConstantProvider')]
    public function testInterfaceConstants(?string $classId, ?string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getInterface($classId, fromReflection: true)->getConstant($constantName, fromReflection: true);
        $constantValue = $reflectionConstant->value;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId)->getConstant($constantName);
        static::assertNotEmpty(
            $stubConstant,
            "Missing constant: $classId::$constantName = $constantValue\n"
        );
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'classConstantProvider')]
    public function testClassConstantsVisibility(?string $classId, ?string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getConstant($constantName, fromReflection: true);
        $constantVisibility = $reflectionConstant->visibility;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId)->getConstant($constantName);
        static::assertEquals(
            $constantVisibility,
            $stubConstant->visibility,
            "Constant visibility mismatch: const $constantName \n
            Expected visibility: $constantVisibility but was $stubConstant->visibility"
        );
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'interfaceConstantProvider')]
    public function testInterfaceConstantsVisibility(?string $classId, ?string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getInterface($classId, fromReflection: true)->getConstant($constantName, fromReflection: true);
        $constantVisibility = $reflectionConstant->visibility;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId)->getConstant($constantName);
        static::assertEquals(
            $constantVisibility,
            $stubConstant->visibility,
            "Constant visibility mismatch: const $constantName \n
            Expected visibility: $constantVisibility but was $stubConstant->visibility"
        );
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'enumConstantProvider')]
    public function testEnumConstantsVisibility(?string $classId, ?string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getEnum($classId, fromReflection: true)->getConstant($constantName, fromReflection: true);
        $constantVisibility = $reflectionConstant->visibility;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId)->getConstant($constantName);
        static::assertEquals(
            $constantVisibility,
            $stubConstant->visibility,
            "Constant visibility mismatch: const $constantName \n
            Expected visibility: $constantVisibility but was $stubConstant->visibility"
        );
    }
}
