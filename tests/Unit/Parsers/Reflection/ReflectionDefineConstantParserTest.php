<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Reflection\ReflectionDefineConstantParser;

class ReflectionDefineConstantParserTest extends TestCase
{
    /**
     * Replaces an `assertNotNull` that the non-nullable PHPConstant return type already
     * guaranteed — it would have passed even if nothing were parsed out of the input.
     */
    public function testItParsesNameAndValueFromTheDefinePair()
    {
        $parsedConstant = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', '7.4.0']);

        self::assertSame('MY_DUMMY_CONSTANT', $parsedConstant->getName());
        self::assertSame('7.4.0', $parsedConstant->getValue());
    }

    /**
     * Replaces an `instanceof` assertion the return type already guaranteed; the id is the
     * part that is actually derived and could regress.
     */
    public function testItDerivesTheIdFromTheConstantName()
    {
        $parsedConstant = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', '7.4.0']);

        self::assertSame('\\MY_DUMMY_CONSTANT', $parsedConstant->getId());
    }

    public function testItCanParseStringConstantNameForDefinedConstant()
    {
        $parsedObject = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', '7.4.0']);
        self::assertEquals("MY_DUMMY_CONSTANT", $parsedObject->getName());
    }

    public function testItCanParseIntConstantNameForDefinedConstant()
    {
        $parsedObject = new ReflectionDefineConstantParser()->parse([1, '7.4.0']);
        self::assertEquals("1", $parsedObject->getName());
    }

    public function testItCanParseStringConstantValueForDefinedConstant()
    {
        $parsedObject = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', '7.4.0']);
        self::assertEquals("7.4.0", $parsedObject->getValue());
    }

    public function testItCanParseIntConstantValueForDefinedConstant()
    {
        $parsedObject = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', 1]);
        self::assertEquals("1", $parsedObject->getValue());
    }

    public function testItCanParseFloatConstantValueForDefinedConstant()
    {
        $parsedObject = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', 7.4]);
        self::assertEquals("7.4", $parsedObject->getValue());
    }

    public function testItCanParseResourceConstantValueForDefinedConstant()
    {
        $resource = fopen('php://memory', 'r+');
        $parsedObject = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', $resource]);
        self::assertEquals("PHPSTORM_RESOURCE", $parsedObject->getValue());
        fclose($resource);
    }

    public function testItCanParseNullConstantValueForDefinedConstant()
    {
        $parsedObject = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', null]);
        self::assertNull($parsedObject->getValue());
    }

    public function testItCanParseConstantIdForDefinedConstant()
    {
        $parsedObject = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', '7.4.0']);
        self::assertEquals("\MY_DUMMY_CONSTANT", $parsedObject->getId());
    }
}
