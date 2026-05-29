<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\DataProvider\StubsDataProvider;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Stubs\StubInterfaceParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class StubsInterfaceParserTest extends TestCase
{
    private StubsDataProvider $filesProvider;
    private StubInterfaceParser $parser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Interfaces';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->parser = new StubInterfaceParser();
    }

    public function testItReturnsCorrectInstance()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $basePHPElement = $this->parser->parse($stubCode);
        self::assertInstanceOf(PHPInterface::class, $basePHPElement);
    }

    public function testItCanParseSimpleInterfaceName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('Throwable', $class->getName());
    }

    public function testItSetsRootNamespaceForInterfaceWithoutNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\', $class->getNamespace());
    }

    public function testItCanParseNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace', $class->getNamespace());
    }

    public function testItCanParseInterfaceName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('CompleteInterface', $class->getName());
    }

    public function testItCanParseId()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace\\CompleteInterface', $class->getId());
    }

    public function testItCanParseIdWithRootNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\Throwable', $class->getId());
    }

    public function testItSetsEmptyArrayIfNoMethodsInInterface()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertIsArray($class->getMethods());
        self::assertEmpty($class->getMethods());
    }

    public function testItCanParseInterfaceWithMethods()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getMethods());
        self::assertNotEmpty($class->getMethods());
        self::assertEquals(2, sizeof($class->getMethods()));
    }

    public function testItReturnsCorrectInstanceForMethod()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $methods = $class->getMethods();
        self::assertInstanceOf(PHPMethod::class, $methods[0]);
    }

    public function testItReturnsActuallyParsedMethods()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $methods = $class->getMethods();
        self::assertEquals("method1", $methods[0]->getName());
        self::assertEquals("method2", $methods[1]->getName());
    }

    public function testItSetsEmptyArrayIfNoConstantsInInterface()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertIsArray($class->getConstants());
        self::assertEmpty($class->getConstants());
    }

    public function testItCanParseInterfaceConstants()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getConstants());
        self::assertIsArray($class->getConstants());
        self::assertNotEmpty($class->getConstants());
        self::assertEquals(2, sizeof($class->getConstants()));
    }

    public function testItReturnsCorrectInstanceForConstant()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $constant = $class->getConstants()[0];
        self::assertInstanceOf(PHPClassConstant::class, $constant);
    }

    public function testItReturnsActuallyParsedConstants()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $constants = $class->getConstants();
        self::assertEquals("CONST_ONE", $constants[0]->getName());
        self::assertEquals("CONST_TWO", $constants[1]->getName());
    }

    public function testItSetsEmptyArraysForParentInterfacesIfNoAny()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getParentInterfaces());
        self::assertIsArray($class->getParentInterfaces());
        self::assertEmpty($class->getParentInterfaces());
    }

    public function testItCanParseParentInterfaces()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getParentInterfaces());
        self::assertNotEmpty($class->getParentInterfaces());
        self::assertEquals(2, sizeof($class->getParentInterfaces()));
    }

    public function testItReturnsCorrectInstanceForParentInterface()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertInstanceOf(PHPInterface::class, $class->getParentInterfaces()[0]);
    }

    public function testItReturnsParentInterfacesWithCorrectName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals("Throwable", $class->getParentInterfaces()[0]->getName());
        self::assertEquals("Runnable", $class->getParentInterfaces()[1]->getName());
    }

    public function testItReturnsAllActuallyParsedParentInterfaces()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals(2, sizeof($class->getParentInterfaces()));
        self::assertEquals("Throwable", $class->getParentInterfaces()[0]->getName());
        self::assertEquals("Runnable", $class->getParentInterfaces()[1]->getName());
    }

    public function testItParsesConstantsCorrectly()
    {
        // Test class with constants
        $stubCodeWithConstants = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $classWithConstants = $this->parser->parse($stubCodeWithConstants);

        self::assertNotEmpty($classWithConstants->getConstants());
        self::assertCount(2, $classWithConstants->getConstants());
        self::assertEquals('CONST_ONE', $classWithConstants->getConstants()[0]->getName());
        self::assertEquals('CONST_TWO', $classWithConstants->getConstants()[1]->getName());

        // Test class without constants
        $stubCodeWithoutConstants = $this->filesProvider->getStubFileContent('Throwable.txt');
        $classWithoutConstants = $this->parser->parse($stubCodeWithoutConstants);

        self::assertEmpty($classWithoutConstants->getConstants());
    }
}