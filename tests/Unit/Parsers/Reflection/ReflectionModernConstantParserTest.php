<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use ReflectionConstant;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Parsers\Reflection\ReflectionModernConstantParser;

class ReflectionModernConstantParserTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        eval('const DUMMY_CONSTANT = "TestValue";');
        eval('namespace TestNamespace; const DUMMY_CONSTANT = "TestValue";');
    }

    /**
     * Replaces an `assertNotNull` guaranteed by the non-nullable PHPConstant return type.
     * The eval'd constant's name and value are what the parser must actually read.
     */
    public function testItParsesNameAndValueFromTheReflectionConstant()
    {
        $parsedObject = new ReflectionModernConstantParser()->parse(new ReflectionConstant('DUMMY_CONSTANT'));

        self::assertSame('DUMMY_CONSTANT', $parsedObject->getName());
        self::assertSame('TestValue', $parsedObject->getValue());
    }

    /**
     * Replaces an `instanceof` assertion the return type already guaranteed.
     */
    public function testItDerivesTheIdFromTheConstantName()
    {
        $parsedObject = new ReflectionModernConstantParser()->parse(new ReflectionConstant('DUMMY_CONSTANT'));

        self::assertSame('\\DUMMY_CONSTANT', $parsedObject->getId());
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
