<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassReference;

class AdaptedReflectionClassReferenceTest extends TestCase
{
    // Constructor and getName() tests

    public function testItAcceptsAndStoresFullyQualifiedClassName()
    {
        $reference = new AdaptedReflectionClassReference('Foo\\Bar\\TestClass');
        self::assertEquals('Foo\\Bar\\TestClass', $reference->getName());
    }

    public function testItHandlesGlobalNamespaceClass()
    {
        $reference = new AdaptedReflectionClassReference('GlobalClass');
        self::assertEquals('GlobalClass', $reference->getName());
    }

    // getShortName() tests

    public function testGetShortNameExtractsClassNameFromFQN()
    {
        $reference = new AdaptedReflectionClassReference('Foo\\Bar\\TestClass');
        self::assertEquals('TestClass', $reference->getShortName());
    }

    public function testGetShortNameHandlesGlobalNamespace()
    {
        $reference = new AdaptedReflectionClassReference('GlobalClass');
        self::assertEquals('GlobalClass', $reference->getShortName());
    }

    public function testGetShortNameHandlesSingleLevelNamespace()
    {
        $reference = new AdaptedReflectionClassReference('Foo\\TestClass');
        self::assertEquals('TestClass', $reference->getShortName());
    }

    public function testGetShortNameHandlesDeepNamespace()
    {
        $reference = new AdaptedReflectionClassReference('Level1\\Level2\\Level3\\TestClass');
        self::assertEquals('TestClass', $reference->getShortName());
    }

    // getNamespaceName() tests

    public function testGetNamespaceNameExtractsNamespaceFromFQN()
    {
        $reference = new AdaptedReflectionClassReference('Foo\\Bar\\TestClass');
        self::assertEquals('Foo\\Bar', $reference->getNamespaceName());
    }

    public function testGetNamespaceNameReturnsEmptyStringForGlobalNamespace()
    {
        $reference = new AdaptedReflectionClassReference('GlobalClass');
        self::assertEquals('', $reference->getNamespaceName());
    }

    public function testGetNamespaceNameHandlesSingleLevelNamespace()
    {
        $reference = new AdaptedReflectionClassReference('Foo\\TestClass');
        self::assertEquals('Foo', $reference->getNamespaceName());
    }

    public function testGetNamespaceNameHandlesMultiLevelNamespace()
    {
        $reference = new AdaptedReflectionClassReference('Level1\\Level2\\Level3\\TestClass');
        self::assertEquals('Level1\\Level2\\Level3', $reference->getNamespaceName());
    }
}
