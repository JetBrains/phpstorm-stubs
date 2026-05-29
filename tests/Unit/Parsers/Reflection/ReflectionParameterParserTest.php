<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Reflection\ReflectionParameterParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class ReflectionParameterParserTest extends TestCase
{
    public function testItReturnsCorrectInstanceOfParameter()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        self::assertTrue($parsedParameter instanceof PHPParameter);
    }

    public function testItCanParseName()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'isDefaultValueAvailable'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('testParam');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('isOptional')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);

        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        self::assertEquals('testParam', $parsedParameter->getName());
    }

    public function testItCanParsePosition()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'isDefaultValueAvailable'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('param');
        $parameterMock->method('getPosition')->willReturn(2);
        $parameterMock->method('isOptional')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);

        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        self::assertEquals(2, $parsedParameter->getPosition());
    }

    public function testItCanParseOptional()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'isDefaultValueAvailable'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('param');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('isOptional')->willReturn(true);
        $parameterMock->method('isVariadic')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);

        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        self::assertTrue($parsedParameter->isOptional());
    }

    public function testItCanParseVariadic()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'isDefaultValueAvailable'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('param');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('isOptional')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(true);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);

        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        self::assertTrue($parsedParameter->isVariadic());
    }

    public function testItCanParsePassedByReference()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'isDefaultValueAvailable'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('param');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('isOptional')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(true);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);

        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        self::assertTrue($parsedParameter->isPassedByReference());
    }

    public function testItCanParseDefaultValue()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'isDefaultValueAvailable', 'getDefaultValue'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('param');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('isOptional')->willReturn(true);
        $parameterMock->method('isVariadic')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(true);
        $parameterMock->method('getDefaultValue')->willReturn('default_value');

        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        self::assertTrue($parsedParameter->hasDefaultValue());
        self::assertEquals('default_value', $parsedParameter->getDefaultValue());
    }

    public function testItCanParseType()
    {
        $typeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'allowsNull'])
            ->getMock();
        $typeMock->method('getName')->willReturn('string');
        $typeMock->method('allowsNull')->willReturn(false);

        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'getType', 'isDefaultValueAvailable'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('param');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('isOptional')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('hasType')->willReturn(true);
        $parameterMock->method('getType')->willReturn($typeMock);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);

        $parsedParameter = new ReflectionParameterParser()->parse($parameterMock);
        $type = $parsedParameter->getDeclaredType();
        self::assertNotNull($type);
    }

    public function testCanParseReturnsTrueForAdaptedReflectionParameter()
    {
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $parser = new ReflectionParameterParser();
        self::assertTrue($parser->canParse($parameterMock));
    }

    public function testCanParseReturnsFalseForOtherObjects()
    {
        $parser = new ReflectionParameterParser();
        self::assertFalse($parser->canParse(new \stdClass()));
        self::assertFalse($parser->canParse('string'));
        self::assertFalse($parser->canParse(null));
    }
}
