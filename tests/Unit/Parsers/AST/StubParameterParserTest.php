<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Model\PHPParameter;
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

    /**
     * `&$param` used to be dropped on the stub side entirely: parseNode() never called
     * setIsPassedByReference() and ParameterNode had no accessor for nikic's Param::$byRef, so all
     * 10,697 cached stub parameters read `false` while reflection reported `true` for 169 of them.
     * Asserting per-parameter (not just "at least one is true") is what distinguishes reading the
     * flag from hardcoding it.
     */
    public function testItParsesTheByReferenceFlagPerParameter()
    {
        $stubCode = '<?php function byRefMix($plain, &$out, ...$rest) {}';
        $parameters = $this->functionParser->parse($stubCode)->getParameters();

        self::assertSame(
            ['plain' => false, 'out' => true, 'rest' => false],
            array_combine(
                array_map(fn (PHPParameter $p) => $p->getName(), $parameters),
                array_map(fn (PHPParameter $p) => $p->isPassedByReference(), $parameters)
            )
        );
    }

    public function testItParsesByReferenceOnAVariadicParameter()
    {
        $stubCode = '<?php function byRefVariadic(&...$refs) {}';
        $parameters = $this->functionParser->parse($stubCode)->getParameters();

        self::assertTrue($parameters[0]->isPassedByReference());
        self::assertTrue($parameters[0]->isVariadic(), 'The two flags are independent');
    }

    /**
     * setPosition() was never called, so every stub parameter kept PHPParameter's constructor
     * default of 0 while the reflection side recorded real indices. Only the second parameter
     * onwards can tell a real position from that default, hence the three-parameter fixture.
     */
    public function testItAssignsTheSignatureIndexAsThePosition()
    {
        $parameters = $this->getParametersFromFunction('complete_function.txt');

        self::assertSame(
            ['param1' => 0, 'param2' => 1, 'param3' => 2],
            array_combine(
                array_map(fn (PHPParameter $p) => $p->getName(), $parameters),
                array_map(fn (PHPParameter $p) => $p->getPosition(), $parameters)
            )
        );
    }
}
