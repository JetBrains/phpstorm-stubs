<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Stubs\StubDefineConstantParser;
use StubTests\Framework\Parsers\Stubs\StubModernConstantParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

/**
 * Tests for parsing global constants (both modern const and define() syntax).
 * Tests modern const declarations (const A = 1, B = 2) and define() declarations.
 */
class StubGlobalConstantParserTest extends BaseTestCase
{
    private FixtureStubsDataProvider $filesProvider;
    private StubModernConstantParser $modernParser;
    private StubDefineConstantParser $defineParser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Constants';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->modernParser = new StubModernConstantParser();
        $this->defineParser = new StubDefineConstantParser();
    }

    private function getModernConstants(string $fixtureFile): array
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        return $this->modernParser->parse($stubCode);
    }

    private function getDefineConstants(string $fixtureFile): array
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        return $this->defineParser->parse($stubCode);
    }

    // Modern const syntax tests
    public function testModernItReturnsCorrectInstance()
    {
        $constants = $this->getModernConstants('global_constants.txt');
        self::assertNotEmpty($constants);
        self::assertInstanceOf(PHPConstant::class, $constants[0]);
    }

    public function testModernItCanParseSingleConstant()
    {
        $constants = $this->getModernConstants('global_constants.txt');

        // Should find const ANOTHER_CONSTANT = 2
        $found = array_filter($constants, fn($c) => $c->getName() === 'ANOTHER_CONSTANT');
        self::assertCount(1, $found);

        $constant = array_values($found)[0];
        self::assertEquals('ANOTHER_CONSTANT', $constant->getName());
        self::assertEquals(2, $constant->getValue());
    }

    public function testModernItCanParseMultipleConstants()
    {
        $stubCode = '<?php const A = 1, B = 2, C = 3;';
        $constants = $this->modernParser->parse($stubCode);

        self::assertCount(3, $constants);
        self::assertEquals('A', $constants[0]->getName());
        self::assertEquals(1, $constants[0]->getValue());
        self::assertEquals('B', $constants[1]->getName());
        self::assertEquals(2, $constants[1]->getValue());
        self::assertEquals('C', $constants[2]->getName());
        self::assertEquals(3, $constants[2]->getValue());
    }

    public function testModernItSetsNamespaceCorrectly()
    {
        $stubCode = '<?php const GLOBAL_CONST = 1;';
        $constants = $this->modernParser->parse($stubCode);

        self::assertEquals('\\', $constants[0]->getNamespace());
    }

    public function testModernItSetsIdCorrectly()
    {
        $stubCode = '<?php const TEST_CONST = 1;';
        $constants = $this->modernParser->parse($stubCode);

        self::assertEquals('\\TEST_CONST', $constants[0]->getId());
    }

    public function testModernItParsesWithNamespace()
    {
        $stubCode = '<?php namespace Foo; const A = 1;';
        $constants = $this->modernParser->parse($stubCode);

        self::assertCount(1, $constants);
        self::assertEquals('A', $constants[0]->getName());
        self::assertEquals('\\Foo', $constants[0]->getNamespace());
        self::assertEquals('\\Foo\\A', $constants[0]->getId());
    }

    public function testModernItParsesStringValue()
    {
        $stubCode = '<?php const STRING_CONST = "hello";';
        $constants = $this->modernParser->parse($stubCode);

        self::assertEquals('hello', $constants[0]->getValue());
    }

    public function testModernItParsesFloatValue()
    {
        $stubCode = '<?php const FLOAT_CONST = 3.14;';
        $constants = $this->modernParser->parse($stubCode);

        self::assertEquals(3.14, $constants[0]->getValue());
    }

    public function testModernItIgnoresDefineConstants()
    {
        $stubCode = '<?php define("OLD_CONST", 1); const NEW_CONST = 2;';
        $constants = $this->modernParser->parse($stubCode);

        // Should only parse const, not define()
        self::assertCount(1, $constants);
        self::assertEquals('NEW_CONST', $constants[0]->getName());
    }

    public function testModernItParsesMultipleSeparateConstStatements()
    {
        $stubCode = '<?php const A = 1; const B = 2; const C = 3, D = 4;';
        $constants = $this->modernParser->parse($stubCode);

        self::assertCount(4, $constants);
        self::assertEquals('A', $constants[0]->getName());
        self::assertEquals('B', $constants[1]->getName());
        self::assertEquals('C', $constants[2]->getName());
        self::assertEquals('D', $constants[3]->getName());
    }

    // define() syntax tests
    public function testDefineItReturnsCorrectInstance()
    {
        $constants = $this->getDefineConstants('define_constants.txt');
        self::assertNotEmpty($constants);
        self::assertInstanceOf(PHPConstant::class, $constants[0]);
    }

    public function testDefineItCanParseSingleConstant()
    {
        $stubCode = '<?php define("MY_CONSTANT", 42);';
        $constants = $this->defineParser->parse($stubCode);

        self::assertCount(1, $constants);
        self::assertEquals('MY_CONSTANT', $constants[0]->getName());
        self::assertEquals(42, $constants[0]->getValue());
    }

    public function testDefineItSetsNamespaceToRoot()
    {
        $stubCode = '<?php define("GLOBAL_DEFINE", 1);';
        $constants = $this->defineParser->parse($stubCode);

        self::assertEquals('\\', $constants[0]->getNamespace());
    }

    public function testDefineItSetsIdCorrectly()
    {
        $stubCode = '<?php define("TEST_DEFINE", 1);';
        $constants = $this->defineParser->parse($stubCode);

        self::assertEquals('\\TEST_DEFINE', $constants[0]->getId());
    }

    public function testDefineItParsesStringValue()
    {
        $stubCode = '<?php define("STRING_DEFINE", "hello");';
        $constants = $this->defineParser->parse($stubCode);

        self::assertEquals('hello', $constants[0]->getValue());
    }

    public function testDefineItParsesFloatValue()
    {
        $stubCode = '<?php define("FLOAT_DEFINE", 3.14);';
        $constants = $this->defineParser->parse($stubCode);

        self::assertEquals(3.14, $constants[0]->getValue());
    }

    public function testDefineItIgnoresModernConstants()
    {
        $stubCode = '<?php const NEW_CONST = 1; define("OLD_DEFINE", 2);';
        $constants = $this->defineParser->parse($stubCode);

        // Should only parse define(), not const
        self::assertCount(1, $constants);
        self::assertEquals('OLD_DEFINE', $constants[0]->getName());
    }

    public function testDefineItParsesMultipleDefines()
    {
        $stubCode = '<?php define("A", 1); define("B", 2); define("C", 3);';
        $constants = $this->defineParser->parse($stubCode);

        self::assertCount(3, $constants);
        self::assertEquals('A', $constants[0]->getName());
        self::assertEquals('B', $constants[1]->getName());
        self::assertEquals('C', $constants[2]->getName());
    }

    public function testDefineItParsesAllFromFixture()
    {
        $constants = $this->getDefineConstants('define_constants.txt');
        self::assertCount(3, $constants);

        self::assertEquals('DEFINE_CONST_1', $constants[0]->getName());
        self::assertEquals(100, $constants[0]->getValue());
        self::assertEquals('DEFINE_CONST_2', $constants[1]->getName());
        self::assertEquals('defined', $constants[1]->getValue());
        self::assertEquals('DEFINE_CONST_3', $constants[2]->getName());
        self::assertEquals(3.14, $constants[2]->getValue());
    }

    // Integration test
    public function testItParsesGlobalConstantsFile()
    {
        $modernConstants = $this->getModernConstants('global_constants.txt');
        $defineConstants = $this->getDefineConstants('global_constants.txt');

        // global_constants.txt contains both modern const and define()
        self::assertGreaterThan(0, count($modernConstants));
        self::assertGreaterThan(0, count($defineConstants));

        // Verify each parser only gets its own syntax
        foreach ($modernConstants as $const) {
            self::assertInstanceOf(PHPConstant::class, $const);
        }
        foreach ($defineConstants as $const) {
            self::assertInstanceOf(PHPConstant::class, $const);
        }
    }
}
