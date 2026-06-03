<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\DataProvider\StubsDataProvider;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class StubsClassParserTest extends BaseTestCase
{
    private StubsDataProvider $filesProvider;
    private StubClassParser $parser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Classes';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->parser = new StubClassParser();
    }

    public function testItReturnsCorrectInstance()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $basePHPElement = $this->parser->parse($stubCode);
        self::assertInstanceOf(PHPClass::class, $basePHPElement);
    }

    public function testItCanParseSimpleClassName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('stdClass', $class->getName());
    }

    public function testItSetsRootNamespaceForClassWithoutNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\', $class->getNamespace());
    }

    public function testItCanParseNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace', $class->getNamespace());
    }

    public function testItCanParseClassName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('CompleteClass', $class->getName());
    }

    public function testItCanParseId()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace\\CompleteClass', $class->getId());
    }

    public function testItCanParseIdWithRootNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\stdClass', $class->getId());
    }

    public function testItCanParseFinalClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertTrue($class->isFinal());
    }

    public function testItCanParseNonFinalClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertFalse($class->isFinal());
    }

    public function testItSetsEmptyArrayIfNoMethodsInClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertIsArray($class->getMethods());
        self::assertEmpty($class->getMethods());
    }

    public function testItCanParseClassWithMethods()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getMethods());
        self::assertNotEmpty($class->getMethods());
        self::assertEquals(3, sizeof($class->getMethods()));
    }

    public function testItReturnsCorrectInstanceForMethod()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        $methods = $class->getMethods();
        self::assertInstanceOf(PHPMethod::class, $methods[0]);
    }

    public function testItReturnsActuallyParsedMethods()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        $methods = $class->getMethods();
        self::assertEquals("publicMethod", $methods[0]->getName());
        self::assertEquals("protectedMethod", $methods[1]->getName());
        self::assertEquals("privateMethod", $methods[2]->getName());
    }

    public function testItSetsEmptyArrayIfNoPropertiesInClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertIsArray($class->getProperties());
        self::assertEmpty($class->getProperties());
    }

    public function testItCanParseProperties()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getProperties());
        self::assertNotEmpty($class->getProperties());
        self::assertEquals(3, sizeof($class->getProperties()));
    }

    public function testItReturnsCorrectInstanceForProperty()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        $property = $class->getProperties()[0];
        self::assertInstanceOf(PHPProperty::class, $property);
    }

    public function testItReturnsActuallyParsedProperties()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        $properties = $class->getProperties();
        self::assertEquals("publicProperty", $properties[0]->getName());
        self::assertEquals("protectedProperty", $properties[1]->getName());
        self::assertEquals("privateProperty", $properties[2]->getName());
    }

    public function testItSetsEmptyArrayIfNoConstantsInClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertIsArray($class->getConstants());
        self::assertEmpty($class->getConstants());
    }

    public function testItCanParseClassConstants()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getConstants());
        self::assertIsArray($class->getConstants());
        self::assertNotEmpty($class->getConstants());
        self::assertEquals(2, sizeof($class->getConstants()));
    }

    public function testItReturnsCorrectInstanceForConstant()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        $constant = $class->getConstants()[0];
        self::assertInstanceOf(PHPClassConstant::class, $constant);
    }

    public function testItReturnsActuallyParsedConstants()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        $constants = $class->getConstants();
        self::assertEquals("CONST_ONE", $constants[0]->getName());
        self::assertEquals("CONST_TWO", $constants[1]->getName());
    }

    public function testItSetsNullAsDefaultParentClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNull($class->getParentClass());
    }

    public function testItCanParseParentClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getParentClass());
    }

    public function testItReturnsCorrectInstanceForParentClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        $parentClass = $class->getParentClass();
        self::assertInstanceOf(PHPClass::class, $parentClass);
    }

    public function testItReturnsActuallyParsedParentClass()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals("ParentClass", $class->getParentClass()->getName());
    }

    public function testItSetsEmptyArraysForImplementedInterfacesIfNoAny()
    {
        $stubCode = $this->filesProvider->getStubFileContent('stdClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getImplementedInterfaces());
        self::assertIsArray($class->getImplementedInterfaces());
        self::assertEmpty($class->getImplementedInterfaces());
    }

    public function testItCanParseImplementedInterfaces()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getImplementedInterfaces());
        self::assertNotEmpty($class->getImplementedInterfaces());
        self::assertEquals(2, sizeof($class->getImplementedInterfaces()));
    }

    public function testItReturnsCorrectInstanceForImplementedInterface()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertInstanceOf(PHPInterface::class, $class->getImplementedInterfaces()[0]);
    }

    public function testItReturnsImplementedInterfacesWithCorrectName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals("InterfaceOne", $class->getImplementedInterfaces()[0]->getName());
        self::assertEquals("InterfaceTwo", $class->getImplementedInterfaces()[1]->getName());
    }

    public function testItReturnsAllActuallyParsedImplementedInterfaces()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals(2, sizeof($class->getImplementedInterfaces()));
        self::assertEquals("InterfaceOne", $class->getImplementedInterfaces()[0]->getName());
        self::assertEquals("InterfaceTwo", $class->getImplementedInterfaces()[1]->getName());
    }

    public function testItParsesConstantsCorrectly()
    {
        // Test class with constants
        $stubCodeWithConstants = $this->filesProvider->getStubFileContent('CompleteClass.txt');
        $classWithConstants = $this->parser->parse($stubCodeWithConstants);

        self::assertNotEmpty($classWithConstants->getConstants());
        self::assertCount(2, $classWithConstants->getConstants());
        self::assertEquals('CONST_ONE', $classWithConstants->getConstants()[0]->getName());
        self::assertEquals('CONST_TWO', $classWithConstants->getConstants()[1]->getName());

        // Test class without constants
        $stubCodeWithoutConstants = $this->filesProvider->getStubFileContent('stdClass.txt');
        $classWithoutConstants = $this->parser->parse($stubCodeWithoutConstants);

        self::assertEmpty($classWithoutConstants->getConstants());
    }
}
