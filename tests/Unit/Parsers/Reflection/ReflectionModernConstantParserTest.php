<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use ReflectionConstant;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Reflection\ReflectionModernConstantParser;

class ReflectionModernConstantParserTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        eval('const DUMMY_CONSTANT = "TestValue";');
        eval('namespace TestNamespace; const DUMMY_CONSTANT = "TestValue";');
    }

    public function testItCanParseConstants()
    {
        self::assertNotNull(new ReflectionModernConstantParser()->parse(new ReflectionConstant('DUMMY_CONSTANT')));
    }

    public function testItReturnsCorrectInstanceOfConstants()
    {
        $parsedObject = new ReflectionModernConstantParser()->parse(new ReflectionConstant('DUMMY_CONSTANT'));
        self::assertTrue($parsedObject instanceof PHPConstant);
    }

    public function testItCanParseConstantNameForModernConstant()
    {
        $parsedObject = new ReflectionModernConstantParser()->parse(new ReflectionConstant('DUMMY_CONSTANT'));
        self::assertEquals("DUMMY_CONSTANT", $parsedObject->getName());
    }

    public function testItCanParseConstantValueForModernConstant()
    {
        $parsedObject = new ReflectionModernConstantParser()->parse(new ReflectionConstant('DUMMY_CONSTANT'));
        self::assertEquals("TestValue", $parsedObject->getValue());
    }

    public function testItCanParseConstantIdWithRootNamespaceForModernConstant()
    {
        $parsedObject = new ReflectionModernConstantParser()->parse(new ReflectionConstant('DUMMY_CONSTANT'));
        self::assertEquals("\DUMMY_CONSTANT", $parsedObject->getId());
    }

    public function testItCanParseConstantIdForModernConstantUnderNamespace()
    {
        $parsedObject = new ReflectionModernConstantParser()->parse(new ReflectionConstant('\TestNamespace\DUMMY_CONSTANT'));
        self::assertEquals("\TestNamespace\DUMMY_CONSTANT", $parsedObject->getId());
    }
}
