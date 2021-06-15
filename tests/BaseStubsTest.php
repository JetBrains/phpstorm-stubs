<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\TestCase;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

abstract class BaseStubsTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    public static function ifReflectionTypesExistInSignature(array $reflectionTypes, array $typesFromSignature): bool
    {
        return count(array_intersect($reflectionTypes, $typesFromSignature)) === count($reflectionTypes);
    }

    public static function ifReflectionTypesExistInAttributes(array $reflectionTypes, array $typesFromAttribute): bool
    {
        return !empty(array_filter(
            $typesFromAttribute,
            fn (array $types) => count(array_intersect($reflectionTypes, $types)) == count($reflectionTypes)
        ));
    }

    public static function getStringRepresentationOfTypeHintsFromAttributes(array $typesFromAttribute): string
    {
        $resultString = '';
        foreach ($typesFromAttribute as $types) {
            $resultString .= '[' . implode('|', $types) . ']';
        }
        return $resultString;
    }
}
