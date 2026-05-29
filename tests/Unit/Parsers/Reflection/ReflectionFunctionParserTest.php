<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Reflection\ReflectionFunctionParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionFunction;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class ReflectionFunctionParserTest extends TestCase
{
    public function testItReturnsCorrectInstanceOfFunction()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertTrue($basePHPElement instanceof PHPFunction);
    }

    public function testItSetsNullToNameIfNameNotAvailable()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNull($basePHPElement->getName());
    }

    public function testItCanParseName()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)->disableOriginalConstructor()
            ->onlyMethods(['getShortName'])
            ->getMock();
        $functionMock->method('getShortName')->willReturn('foo');
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('foo', $basePHPElement->getName());
    }

    public function testItSetsRootNamespaceIfNamespaceNotAvailable()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('\\', $basePHPElement->getNamespace());
    }

    public function testItCanParseNamespace()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getNamespaceName'])
            ->getMock();
        $functionMock->method('getNamespaceName')->willReturn('MyNameSpace\SubNameSpace');
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('\MyNameSpace\SubNameSpace', $basePHPElement->getNamespace());
    }

    public function testItCanParseRootNamespace()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getNamespaceName'])
            ->getMock();
        $functionMock->method('getNamespaceName')->willReturn('');
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('\\', $basePHPElement->getNamespace());
    }

    public function testItSetsNullAsDefaultId()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNull($basePHPElement->getId());
    }

    public function testItCanParseId()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getShortName', 'getNamespaceName'])
            ->getMock();
        $functionMock->method('getShortName')->willReturn('foo');
        $functionMock->method('getNamespaceName')->willReturn('SomeNamespace\SubNamespace');
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('\SomeNamespace\SubNamespace\foo', $basePHPElement->getId());
    }

    public function testItCanParseIdWithRootNamespace()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getShortName', 'getNamespaceName'])
            ->getMock();
        $functionMock->method('getShortName')->willReturn('foo');
        $functionMock->method('getNamespaceName')->willReturn('');
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('\foo', $basePHPElement->getId());
    }

    public function testItNoTypeInstanceIfCanNotParseReturnType()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNotNull($basePHPElement->getReturnTypeFromSignature());
        self::assertEquals('', $basePHPElement->getReturnTypeFromSignature()->toString());
    }

    public function testItReturnsNoTypeInstanceIfReflectionReturnsNullAsReturnType()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getReturnType'])
            ->getMock();
        $functionMock->method('getReturnType')->willReturn(null);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNotNull($basePHPElement->getReturnTypeFromSignature());
        self::assertEquals('', $basePHPElement->getReturnTypeFromSignature()->toString());
    }

    public function testItReturnsNoTypeIfNoReturnType()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['hasReturnType'])
            ->getMock();
        $functionMock->method('hasReturnType')->willReturn(false);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNotNull($basePHPElement->getReturnTypeFromSignature());
        self::assertEquals('', $basePHPElement->getReturnTypeFromSignature()->toString());
    }

    public function testItCanParseReturnType()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getReturnType', 'hasReturnType'])
            ->getMock();
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnTypeMock->method('getName')->willReturn('string');
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);
        $functionMock->method('hasReturnType')->willReturn(true);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('string', $basePHPElement->getReturnTypeFromSignature()->toString());
    }

    public function testItCanParseNullableReturnType()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getReturnType', 'hasReturnType'])
            ->getMock();
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'allowsNull'])
            ->getMock();
        $returnTypeMock->method('getName')->willReturn('string');
        $returnTypeMock->method('allowsNull')->willReturn(true);
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);
        $functionMock->method('hasReturnType')->willReturn(true);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('string|null', $basePHPElement->getReturnTypeFromSignature()->toString());
        self::assertTrue($basePHPElement->getReturnTypeFromSignature()->hasBasicType('string'));
    }

    public function testItCanParseNullableBoolReturnType()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getReturnType', 'hasReturnType'])
            ->getMock();
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'allowsNull'])
            ->getMock();
        $returnTypeMock->method('getName')->willReturn('false');
        $returnTypeMock->method('allowsNull')->willReturn(true);
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);
        $functionMock->method('hasReturnType')->willReturn(true);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('false|null', $basePHPElement->getReturnTypeFromSignature()->toString());
        self::assertTrue($basePHPElement->getReturnTypeFromSignature()->hasBasicType('false'));
    }

    public function testItCanParseReturnTypeWithUnion()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getReturnType', 'hasReturnType'])
            ->getMock();
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getTypes', 'isUnionType'])
            ->getMock();
        $returnSubTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnSubTypeMock->method('getName')->willReturn('string');
        $returnSubTypeMock2 = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnSubTypeMock2->method('getName')->willReturn('int');
        $returnTypeMock->method('getTypes')->willReturn([$returnSubTypeMock, $returnSubTypeMock2]);
        $returnTypeMock->method('isUnionType')->willReturn(true);
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);
        $functionMock->method('hasReturnType')->willReturn(true);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('string|int', $basePHPElement->getReturnTypeFromSignature()->toString());
    }

    public function testItProperlyParsesAllTypesFromUnionReturnType()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getReturnType', 'hasReturnType'])
            ->getMock();
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getTypes', 'isUnionType'])
            ->getMock();
        $returnSubTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnSubTypeMock->method('getName')->willReturn('stdClass');
        $returnSubTypeMock2 = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnSubTypeMock2->method('getName')->willReturn('int');
        $returnTypeMock->method('getTypes')->willReturn([$returnSubTypeMock, $returnSubTypeMock2]);
        $returnTypeMock->method('isUnionType')->willReturn(true);
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);
        $functionMock->method('hasReturnType')->willReturn(true);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('stdClass|int', $basePHPElement->getReturnTypeFromSignature()->toString());
        self::assertTrue($basePHPElement->getReturnTypeFromSignature()->containsTypes('stdClass', 'int'));
    }

    public function testItProperlyParsesAllTypesInUnionReturnTypeWithNullable()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getReturnType', 'hasReturnType'])
            ->getMock();
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getTypes', 'isUnionType'])
            ->getMock();
        $returnSubTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnSubTypeMock->method('getName')->willReturn('string');
        $returnSubTypeMock2 = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnSubTypeMock2->method('getName')->willReturn('int');
        $returnSubTypeMock3 = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $returnSubTypeMock3->method('getName')->willReturn('null');
        $returnTypeMock->method('getTypes')->willReturn([$returnSubTypeMock, $returnSubTypeMock2, $returnSubTypeMock3]);
        $returnTypeMock->method('isUnionType')->willReturn(true);
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);
        $functionMock->method('hasReturnType')->willReturn(true);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals('string|int|null', $basePHPElement->getReturnTypeFromSignature()->toString());
        self::assertTrue($basePHPElement->getReturnTypeFromSignature()->containsTypes('string', 'int', 'null'));
    }

    public function testItParsesFalseAsDefaultDeprecation()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertFalse($basePHPElement->isDeprecated());
    }

    public function testItCanParseNonDeprecation()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isDeprecated'])
            ->getMock();
        $functionMock->method('isDeprecated')->willReturn(false);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertFalse($basePHPElement->isDeprecated());
    }

    public function testItCanParseDeprecation()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isDeprecated'])
            ->getMock();
        $functionMock->method('isDeprecated')->willReturn(true);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertTrue($basePHPElement->isDeprecated());
    }

    public function testItReturnsEmptyArrayIfParametersCanNotBeRead()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNotNull($basePHPElement->getParameters());
        self::assertIsArray($basePHPElement->getParameters());
        self::assertEmpty($basePHPElement->getParameters());
    }

    public function testItReturnsEmptyArrayIfNoParameters()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParameters'])
            ->getMock();
        $functionMock->method('getParameters')->willReturn([]);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNotNull($basePHPElement->getParameters());
        self::assertIsArray($basePHPElement->getParameters());
        self::assertEmpty($basePHPElement->getParameters());
    }

    public function testItCanParseBasicParameter()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParameters'])
            ->getMock();
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'isOptional', 'isVariadic', 'isPassedByReference', 'hasType', 'isDefaultValueAvailable'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('param');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('isOptional')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);
        $functionMock->method('getParameters')->willReturn([$parameterMock]);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertInstanceOf(PHPParameter::class, $basePHPElement->getParameters()[0]);
        self::assertEquals('param', $basePHPElement->getParameters()[0]->getName());
    }

    public function testItCanParseParametersWithProperties()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParameters'])
            ->getMock();
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'hasType', 'getType', 'isOptional', 'getDefaultValue', 'isDefaultValueAvailable', 'isPassedByReference', 'isVariadic'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('foo');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('hasType')->willReturn(true);
        $parameterMock->method('getType')->willReturn(new class extends \ReflectionNamedType
        {
            public function getName()
            {
                return 'int';
            }

            public function allowsNull()
            {
                return false;
            }
        });
        $parameterMock->method('isOptional')->willReturn(true);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(true);
        $parameterMock->method('getDefaultValue')->willReturn(1);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(false);
        $functionMock->method('getParameters')->willReturn([$parameterMock]);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertNotNull($basePHPElement->getParameters()[0]);
        self::assertEquals('foo', $basePHPElement->getParameters()[0]->getName());
        self::assertEquals('int', $basePHPElement->getParameters()[0]->getDeclaredType()->toString());
    }

    public function testItReturnsCorrectAmountOfParameters()
    {
        $functionMock = $this->getMockBuilder(AdaptedReflectionFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParameters'])
            ->getMock();
        $parameterMock = $this->getMockBuilder(AdaptedReflectionParameter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getPosition', 'hasType', 'getType', 'isOptional', 'isDefaultValueAvailable', 'isPassedByReference', 'isVariadic'])
            ->getMock();
        $parameterMock->method('getName')->willReturn('foo');
        $parameterMock->method('getPosition')->willReturn(0);
        $parameterMock->method('hasType')->willReturn(false);
        $parameterMock->method('getType')->willReturn(null);
        $parameterMock->method('isOptional')->willReturn(false);
        $parameterMock->method('isDefaultValueAvailable')->willReturn(false);
        $parameterMock->method('isPassedByReference')->willReturn(false);
        $parameterMock->method('isVariadic')->willReturn(false);
        $functionMock->method('getParameters')->willReturn([$parameterMock]);
        $basePHPElement = new ReflectionFunctionParser()->parse($functionMock);
        self::assertEquals(1, sizeof($basePHPElement->getParameters()));
    }
}
