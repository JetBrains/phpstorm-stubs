<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Reflection\ReflectionDefineConstantParser;

class ReflectionDefineConstantParserTest extends TestCase
{
    public function testItCanParseDefineConstant()
    {
        self::assertNotNull(new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', '7.4.0']));
    }

    public function testItCanReturnsCorrectInstanceOfConstant()
    {
        $parsedConstant = new ReflectionDefineConstantParser()->parse(['MY_DUMMY_CONSTANT', '7.4.0']);
        self::assertTrue($parsedConstant instanceof PHPConstant);
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
