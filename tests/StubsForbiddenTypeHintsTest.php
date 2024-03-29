<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Parsers\ParserUtils;
use StubTests\TestData\Providers\Stubs\StubMethodsProvider;
use StubTests\TestData\Providers\Stubs\StubsParametersProvider;

class StubsForbiddenTypeHintsTest extends AbstractBaseStubsTestCase
{
    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(StubMethodsProvider::class, 'methodsForNullableReturnTypeHintTestsProvider')]
    public static function testMethodDoesNotHaveNullableReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        $returnTypes = $stubMethod->returnTypesFromSignature;
        self::assertEmpty(
            array_filter($returnTypes, fn (string $type) => str_contains($type, '?')),
            "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has nullable return typehint '" . implode('|', $returnTypes) . "' that supported only since PHP 7.1. 
            Please declare return type via PhpDoc"
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(StubsParametersProvider::class, 'parametersForUnionTypeHintTestsProvider')]
    public static function testMethodDoesNotHaveUnionTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(
            2,
            count($parameter->typesFromSignature),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has parameter '$parameter->name' with union typehint '" . implode('|', $parameter->typesFromSignature) . "' 
                but union typehints available only since php 8.0"
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(StubsParametersProvider::class, 'parametersForNullableTypeHintTestsProvider')]
    public static function testMethodDoesNotHaveNullableTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(
            array_filter($parameter->typesFromSignature, fn (string $type) => str_contains($type, '?')),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has nullable parameter '$parameter->name' with typehint '" . implode('|', $parameter->typesFromSignature) . "' 
                but nullable typehints available only since php 7.1"
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(StubMethodsProvider::class, 'methodsForUnionReturnTypeHintTestsProvider')]
    public static function testMethodDoesNotHaveUnionReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(
            2,
            count($stubMethod->returnTypesFromSignature),
            "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has union return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 8.0. 
            Please declare return type via PhpDoc"
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(StubsParametersProvider::class, 'parametersForScalarTypeHintTestsProvider')]
    public static function testMethodDoesNotHaveScalarTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(
            array_intersect(['int', 'float', 'string', 'bool', 'mixed', 'object'], $parameter->typesFromSignature),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has parameter '$parameter->name' with typehint '" . implode('|', $parameter->typesFromSignature) .
            "' but typehints available only since php 7"
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(StubMethodsProvider::class, 'methodsForReturnTypeHintTestsProvider')]
    public static function testMethodDoesNotHaveReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty($stubMethod->returnTypesFromSignature, "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 7. Please declare return type via PhpDoc");
    }
}
