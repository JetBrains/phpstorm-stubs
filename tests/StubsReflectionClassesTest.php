<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Exception;
use RuntimeException;
use StubTests\Model\PHPMethod;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

/**
 * Class to test typehints of some Reflection* classes as reflection for these classes returns null.
 */
class StubsReflectionClassesTest extends BaseStubsTest
{
    /**
     * @throws Exception|RuntimeException
     */
    public function testReflectionFunctionAbstractGetReturnTypeMethod()
    {
        $getReturnTypeMethods = array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getClass('ReflectionFunctionAbstract')
            ->methods, fn (PHPMethod $method) => $method->name === 'getReturnType');
        $getReturnTypeMethod = array_pop($getReturnTypeMethods);
        $allReturnTypes = array_unique(Utils::flattenArray($getReturnTypeMethod->returnTypesFromAttribute +
            $getReturnTypeMethod->returnTypesFromSignature + $getReturnTypeMethod->returnTypesFromPhpDoc, false));
        self::assertContains('ReflectionNamedType', $allReturnTypes,
            'method ReflectionFunctionAbstract::getReturnType should have ReflectionNamedType in return types for php 7.1+');
        self::assertContains('ReflectionUnionType', $allReturnTypes,
            'method ReflectionFunctionAbstract::getReturnType should have ReflectionUnionType in return types for php 8.0+');
        self::assertContains('ReflectionType', $allReturnTypes,
            'method ReflectionFunctionAbstract::getReturnType should have ReflectionType in return types for php 7.0');
    }

    /**
     * @throws Exception|RuntimeException
     */
    public function testReflectionPropertyGetTypeMethod()
    {
        $getTypeMethods = array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getClass('ReflectionProperty')
            ->methods, fn (PHPMethod $method) => $method->name === 'getType');
        $getTypeMethod = array_pop($getTypeMethods);
        $allReturnTypes = array_unique(Utils::flattenArray($getTypeMethod->returnTypesFromAttribute +
            $getTypeMethod->returnTypesFromSignature + $getTypeMethod->returnTypesFromPhpDoc, false));
        self::assertContains('ReflectionNamedType', $allReturnTypes,
            'method ReflectionProperty::getType should have ReflectionNamedType in return types for php 7.1+');
        self::assertContains('ReflectionUnionType', $allReturnTypes,
            'method ReflectionProperty::getType should have ReflectionUnionType in return types for php 8.0+');
    }

    /**
     * @throws Exception|RuntimeException
     */
    public function testReflectionParameterGetTypeMethod()
    {
        $getTypeMethods = array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getClass('ReflectionParameter')
            ->methods, fn (PHPMethod $method) => $method->name === 'getType');
        $getTypeMethod = array_pop($getTypeMethods);
        $allReturnTypes = array_unique(Utils::flattenArray($getTypeMethod->returnTypesFromAttribute +
            $getTypeMethod->returnTypesFromSignature + $getTypeMethod->returnTypesFromPhpDoc, false));
        self::assertContains('ReflectionNamedType', $allReturnTypes,
            'method ReflectionParameter::getType should have ReflectionNamedType in return types');
        self::assertContains('ReflectionUnionType', $allReturnTypes,
            'method ReflectionParameter::getType should have ReflectionUnionType in return types');
    }
}
