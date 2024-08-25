<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\ReflectionStubsSingleton;
use StubTests\TestData\Providers\Stubs\StubsCompositeMixedProvider;

class StubsCompositeMixedReturnTypeTest extends AbstractBaseStubsTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    #[DataProviderExternal(StubsCompositeMixedProvider::class, 'expectedFunctionsMixedFalseReturnProvider')]
    public function testPhpDocContainsMixedFalseReturnType(string $functionId)
    {
        $function = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId);
        $returnTypesFromPhpDoc = $function->returnTypesFromPhpDoc;
        static::assertContains('false', $returnTypesFromPhpDoc, "Return type of " . $function->name .
            " should contain 'false' in PhpDoc. See https://youtrack.jetbrains.com/issue/WI-57991 for details");
        static::assertContains('mixed', $returnTypesFromPhpDoc, "Return type of " . $function->name .
            " should contain 'mixed' in PhpDoc. See https://youtrack.jetbrains.com/issue/WI-57991 for details");
    }

    #[DataProviderExternal(StubsCompositeMixedProvider::class, 'expectedFunctionsMixedNullReturnProvider')]
    public function testPhpDocContainsMixedNullReturnType(string $functionId)
    {
        $function = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId);
        $returnTypesFromPhpDoc = $function->returnTypesFromPhpDoc;
        static::assertContains('mixed', $returnTypesFromPhpDoc, "Return type of " . $function->name .
            " should contain 'mixed' in PhpDoc. See https://youtrack.jetbrains.com/issue/WI-57991 for details");
        static::assertContains('null', $returnTypesFromPhpDoc, "Return type of " . $function->name .
            " should contain 'null' in PhpDoc. See https://youtrack.jetbrains.com/issue/WI-57991 for details");
    }
}
