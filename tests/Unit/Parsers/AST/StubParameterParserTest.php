<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class StubParameterParserTest extends BaseTestCase
{
    private FixtureStubsDataProvider $filesProvider;
    private StubFunctionParser $functionParser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Functions';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->functionParser = new StubFunctionParser();
    }

    private function getParametersFromFunction(string $fixtureFile): array
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        $function = $this->functionParser->parse($stubCode);
        return $function->getParameters();
    }

    public function testItReturnsCorrectInstance()
    {
        $parameters = $this->getParametersFromFunction('simple_function.txt');
        self::assertInstanceOf(PHPParameter::class, $parameters[0]);
    }

    public function testItCanParseParameterName()
    {
        $parameters = $this->getParametersFromFunction('simple_function.txt');
        self::assertEquals('string', $parameters[0]->getName());
    }

    public function testItCanParseMultipleParameters()
    {
        $parameters = $this->getParametersFromFunction('complete_function.txt');
        self::assertCount(3, $parameters);

        self::assertEquals('param1', $parameters[0]->getName());
        self::assertEquals('param2', $parameters[1]->getName());
        self::assertEquals('param3', $parameters[2]->getName());
    }

    public function testItReturnsEmptyArrayForFunctionWithNoParameters()
    {
        $stubCode = '<?php function noParams(): void {}';
        $function = $this->functionParser->parse($stubCode);
        $parameters = $function->getParameters();

        self::assertIsArray($parameters);
        self::assertEmpty($parameters);
    }

    public function testItParsesParametersFromFunctionWithSingleParameter()
    {
        $parameters = $this->getParametersFromFunction('simple_function.txt');
        self::assertCount(1, $parameters);
        self::assertInstanceOf(PHPParameter::class, $parameters[0]);
    }
}
