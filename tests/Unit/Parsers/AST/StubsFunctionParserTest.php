<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\DataProvider\StubsDataProvider;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPParameter;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class StubsFunctionParserTest extends BaseTestCase
{
    private StubsDataProvider $filesProvider;
    private StubFunctionParser $parser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Functions';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->parser = new StubFunctionParser();
    }

    /**
     * Pins both halves of parse()'s type contract. assertInstanceOf alone is weak here: it keeps
     * passing if the `: PHPFunction` declaration is dropped or widened, as long as the body still
     * happens to return the right thing. Asserting the declared return type catches the loosening
     * itself, which is the change that would silently let a different entity type escape.
     */
    public function testItDeclaresAndReturnsPHPFunction()
    {
        $returnType = (new \ReflectionMethod(StubFunctionParser::class, 'parse'))->getReturnType();

        self::assertInstanceOf(\ReflectionNamedType::class, $returnType, 'parse() must keep a single named return type');
        self::assertSame(PHPFunction::class, $returnType->getName());
        self::assertFalse($returnType->allowsNull(), 'parse() must not become nullable');

        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        self::assertInstanceOf(PHPFunction::class, $this->parser->parse($stubCode));
    }

    public function testItCanParseSimpleFunctionName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertEquals('strlen', $function->getName());
    }

    public function testItSetsRootNamespaceForFunctionWithoutNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertEquals('\\', $function->getNamespace());
    }

    public function testItCanParseNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace', $function->getNamespace());
    }

    public function testItCanParseFunctionName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertEquals('complexFunction', $function->getName());
    }

    public function testItCanParseId()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace\\complexFunction', $function->getId());
    }

    public function testItCanParseIdWithRootNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertEquals('\\strlen', $function->getId());
    }

    public function testItCanParseNonDeprecatedFunction()
    {
        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertFalse($function->isDeprecated());
    }

    public function testItCanParseDeprecatedFunction()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertTrue($function->isDeprecated());
    }

    public function testItSetsEmptyArrayIfNoParametersInFunction()
    {
        $stubCode = '<?php function noParams(): void {}';
        $function = $this->parser->parse($stubCode);
        self::assertIsArray($function->getParameters());
        self::assertEmpty($function->getParameters());
    }

    public function testItCanParseParameters()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertNotNull($function->getParameters());
        self::assertNotEmpty($function->getParameters());
        self::assertEquals(3, sizeof($function->getParameters()));
    }

    public function testItReturnsCorrectInstanceForParameter()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        $parameters = $function->getParameters();
        self::assertInstanceOf(PHPParameter::class, $parameters[0]);
    }

    public function testItReturnsActuallyParsedParameters()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        $parameters = $function->getParameters();
        self::assertEquals('param1', $parameters[0]->getName());
        self::assertEquals('param2', $parameters[1]->getName());
        self::assertEquals('param3', $parameters[2]->getName());
    }

    public function testItCanParseSimpleReturnType()
    {
        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertNotNull($function->getReturnTypeFromSignature());
        self::assertEquals('int', $function->getReturnTypeFromSignature()->toString());
    }

    public function testItCanParseUnionReturnType()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complete_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertNotNull($function->getReturnTypeFromSignature());
        self::assertEquals('string|int|null', $function->getReturnTypeFromSignature()->toString());
    }

    public function testItCanParseFunctionWithSingleParameter()
    {
        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        $function = $this->parser->parse($stubCode);
        self::assertEquals(1, sizeof($function->getParameters()));
        self::assertEquals('string', $function->getParameters()[0]->getName());
    }

    public function testItCanParseLanguageLevelTypeAwareOnReturnType()
    {
        $stubCode = $this->filesProvider->getStubFileContent('language_level_function.txt');
        $function = $this->parser->parse($stubCode);

        self::assertNotNull($function->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals(['8.0' => 'CurlHandle|false'], $function->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('resource|false', $function->getStubsMetadata()->getDefaultType());
    }

    public function testFunctionWithoutLanguageLevelTypeAware()
    {
        $stubCode = $this->filesProvider->getStubFileContent('simple_function.txt');
        $function = $this->parser->parse($stubCode);

        self::assertNull($function->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNull($function->getStubsMetadata()->getDefaultType());
    }

    public function testItCanParseLanguageLevelTypeAwareOnParameter()
    {
        $stubCode = $this->filesProvider->getStubFileContent('language_level_parameter.txt');
        $function = $this->parser->parse($stubCode);

        $params = $function->getParameters();
        self::assertCount(1, $params);

        $param = $params[0];
        self::assertNotNull($param->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals(['8.0' => 'string'], $param->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('', $param->getStubsMetadata()->getDefaultType());
    }
}
