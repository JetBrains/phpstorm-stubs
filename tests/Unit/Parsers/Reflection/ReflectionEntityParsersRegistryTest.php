<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use ReflectionConstant;
use stdClass;
use StubTests\Framework\Parsers\Reflection\ReflectionClassParser;
use StubTests\Framework\Parsers\Reflection\ReflectionEnumParser;
use StubTests\Framework\Parsers\Reflection\ReflectionFunctionParser;
use StubTests\Framework\Parsers\Reflection\ReflectionInterfaceParser;
use StubTests\Framework\Parsers\Reflection\ReflectionModernConstantParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionFunction;
use StubTests\Framework\Parsers\Registries\EntityReflectionObjectParsersRegistry;

class ReflectionEntityParsersRegistryTest extends TestCase
{
    public function testItFindsParserForClassObject()
    {
        $mock = $this->createMock(AdaptedReflectionClass::class);
        $mock->method('isInternal')->willReturn(true);
        $mock->method('isInterface')->willReturn(false);
        $mock->method('isEnum')->willReturn(false);

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($mock);

        self::assertInstanceOf(ReflectionClassParser::class, $parser);
    }

    public function testItFindsParserForInterfaceObject()
    {
        $mock = $this->createMock(AdaptedReflectionClass::class);
        $mock->method('isInternal')->willReturn(true);
        $mock->method('isInterface')->willReturn(true);

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($mock);

        self::assertInstanceOf(ReflectionInterfaceParser::class, $parser);
    }

    public function testItFindsParserForEnumObject()
    {
        $mock = $this->createMock(AdaptedReflectionClass::class);
        $mock->method('isInternal')->willReturn(true);
        $mock->method('isEnum')->willReturn(true);

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($mock);

        self::assertInstanceOf(ReflectionEnumParser::class, $parser);
    }

    public function testItFindsParserForFunctionObject()
    {
        $mock = $this->createMock(AdaptedReflectionFunction::class);

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($mock);

        self::assertInstanceOf(ReflectionFunctionParser::class, $parser);
    }

    public function testItFindsParserForReflectionConstantObject()
    {
        if (!class_exists('\ReflectionConstant')) {
            self::markTestSkipped('ReflectionConstant is not available in PHP < 8.1');
        }

        // Define a test constant if it doesn't exist
        if (!defined('TEST_CONSTANT_FOR_PARSER_REGISTRY')) {
            define('TEST_CONSTANT_FOR_PARSER_REGISTRY', 'test_value');
        }

        $reflectionConstant = new ReflectionConstant('TEST_CONSTANT_FOR_PARSER_REGISTRY');

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($reflectionConstant);

        self::assertInstanceOf(ReflectionModernConstantParser::class, $parser);
    }

    public function testItFindsParserForArrayConstant()
    {
        $constantArray = ['SOME_CONSTANT' => 'value'];

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($constantArray);

        self::assertInstanceOf(ReflectionModernConstantParser::class, $parser);
    }

    public function testItReturnsNullForUnknownObject()
    {
        $unknownObject = new stdClass();

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($unknownObject);

        self::assertNull($parser);
    }

    public function testItPrioritizesEnumParserOverClassParser()
    {
        // Ensure enum parser is selected when object is both internal and enum
        $mock = $this->createMock(AdaptedReflectionClass::class);
        $mock->method('isInternal')->willReturn(true);
        $mock->method('isEnum')->willReturn(true);
        $mock->method('isInterface')->willReturn(false);

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($mock);

        self::assertInstanceOf(ReflectionEnumParser::class, $parser);
        self::assertNotInstanceOf(ReflectionClassParser::class, $parser);
    }

    public function testItPrioritizesInterfaceParserOverClassParser()
    {
        // Ensure interface parser is selected when object is interface
        $mock = $this->createMock(AdaptedReflectionClass::class);
        $mock->method('isInternal')->willReturn(true);
        $mock->method('isInterface')->willReturn(true);
        $mock->method('isEnum')->willReturn(false);

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($mock);

        self::assertInstanceOf(ReflectionInterfaceParser::class, $parser);
        self::assertNotInstanceOf(ReflectionClassParser::class, $parser);
    }

    public function testItReturnsNullForNonInternalClass()
    {
        // Non-internal classes should not be parsed
        $mock = $this->createMock(AdaptedReflectionClass::class);
        $mock->method('isInternal')->willReturn(false);
        $mock->method('isInterface')->willReturn(false);
        $mock->method('isEnum')->willReturn(false);

        $parser = (new EntityReflectionObjectParsersRegistry())->findParserForObject($mock);

        self::assertNull($parser);
    }
}
