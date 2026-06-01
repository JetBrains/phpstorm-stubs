<?php

namespace StubTests\Unit\Parsers\AST;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

/**
 * Tests for parsing class constants (not global constants).
 * Tests visibility modifiers (public/protected/private) and final flag.
 * Uses StubClassParser which internally uses StubConstantParser.
 */
class StubClassConstantParserTest extends BaseTestCase
{
    private FixtureStubsDataProvider $filesProvider;
    private StubClassParser $classParser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Constants';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->classParser = new StubClassParser();
    }

    private function getConstantsFromClass(string $fixtureFile): array
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        $class = $this->classParser->parse($stubCode);
        return $class->getConstants();
    }

    public function testItReturnsCorrectInstance()
    {
        $constants = $this->getConstantsFromClass('simple_constant.txt');
        self::assertInstanceOf(PHPClassConstant::class, $constants[0]);
    }

    public function testItCanParseConstantName()
    {
        $constants = $this->getConstantsFromClass('simple_constant.txt');
        self::assertEquals('SIMPLE_CONST', $constants[0]->getName());
    }

    public function testItCanParsePublicVisibility()
    {
        $constants = $this->getConstantsFromClass('complete_constant.txt');
        $publicConstant = $constants[0]; // PUBLIC_CONST
        self::assertSame(AccessModifier::PUBLIC, $publicConstant->getAccess());
    }

    public function testItCanParseProtectedVisibility()
    {
        $constants = $this->getConstantsFromClass('complete_constant.txt');
        $protectedConstant = $constants[1]; // PROTECTED_CONST
        self::assertSame(AccessModifier::PROTECTED, $protectedConstant->getAccess());
    }

    public function testItCanParsePrivateVisibility()
    {
        $constants = $this->getConstantsFromClass('complete_constant.txt');
        $privateConstant = $constants[2]; // PRIVATE_CONST
        self::assertSame(AccessModifier::PRIVATE, $privateConstant->getAccess());
    }

    public function testItCanParseFinalModifier()
    {
        $constants = $this->getConstantsFromClass('complete_constant.txt');
        $finalConstant = $constants[3]; // FINAL_CONST
        self::assertTrue($finalConstant->isFinal());
    }

    public function testItParsesNonFinalByDefault()
    {
        $constants = $this->getConstantsFromClass('simple_constant.txt');
        self::assertFalse($constants[0]->isFinal());
    }

    public function testItParsesPublicByDefaultForOldStyleConstants()
    {
        $constants = $this->getConstantsFromClass('simple_constant.txt');
        self::assertSame(AccessModifier::PUBLIC, $constants[0]->getAccess());
    }

    public function testItParsesAllConstantsFromClass()
    {
        $constants = $this->getConstantsFromClass('complete_constant.txt');
        self::assertCount(7, $constants);

        self::assertEquals('PUBLIC_CONST', $constants[0]->getName());
        self::assertEquals('PROTECTED_CONST', $constants[1]->getName());
        self::assertEquals('PRIVATE_CONST', $constants[2]->getName());
        self::assertEquals('FINAL_CONST', $constants[3]->getName());
        self::assertEquals('FIRST_CONST', $constants[4]->getName());
        self::assertEquals('SECOND_CONST', $constants[5]->getName());
        self::assertEquals('THIRD_CONST', $constants[6]->getName());
    }

    public function testItParsesAllConstantsValuesFromClass()
    {
        $constants = $this->getConstantsFromClass('complete_constant.txt');
        self::assertCount(7, $constants);

        self::assertEquals('public', array_find(
            $constants,
            fn (PHPClassConstant $constant) => $constant->getName() == 'PUBLIC_CONST'
        )->getValue());
        self::assertEquals('protected', array_find(
            $constants,
            fn (PHPClassConstant $constant) => $constant->getName() == 'PROTECTED_CONST'
        )->getValue());
        self::assertEquals('private', array_find(
            $constants,
            fn (PHPClassConstant $constant) => $constant->getName() == 'PRIVATE_CONST'
        )->getValue());
        self::assertEquals('final', array_find(
            $constants,
            fn (PHPClassConstant $constant) => $constant->getName() == 'FINAL_CONST'
        )->getValue());
        self::assertEquals('first', array_find(
            $constants,
            fn (PHPClassConstant $constant) => $constant->getName() == 'FIRST_CONST'
        )->getValue());
        self::assertEquals('second', array_find(
            $constants,
            fn (PHPClassConstant $constant) => $constant->getName() == 'SECOND_CONST'
        )->getValue());
        self::assertEquals('third', array_find(
            $constants,
            fn (PHPClassConstant $constant) => $constant->getName() == 'THIRD_CONST'
        )->getValue());
    }

    public function testItParsesVisibilityCorrectly()
    {
        $constants = $this->getConstantsFromClass('visibility_constants.txt');
        self::assertCount(3, $constants);

        self::assertEquals('PUBLIC', $constants[0]->getName());
        self::assertSame(AccessModifier::PUBLIC, $constants[0]->getAccess());

        self::assertEquals('PROTECTED', $constants[1]->getName());
        self::assertSame(AccessModifier::PROTECTED, $constants[1]->getAccess());

        self::assertEquals('PRIVATE', $constants[2]->getName());
        self::assertSame(AccessModifier::PRIVATE, $constants[2]->getAccess());
    }

    public function testItParsesCombinedModifiers()
    {
        $constants = $this->getConstantsFromClass('complete_constant.txt');
        $finalConstant = $constants[3]; // final public const

        self::assertEquals('FINAL_CONST', $finalConstant->getName());
        self::assertSame(AccessModifier::PUBLIC, $finalConstant->getAccess());
        self::assertTrue($finalConstant->isFinal());
    }

    public function testItParsesNumericConstantValues()
    {
        $constants = $this->getConstantsFromClass('numeric_constants.txt');
        self::assertCount(6, $constants);

        self::assertEquals('POSITIVE_INT', $constants[0]->getName());
        self::assertEquals(42, $constants[0]->getValue());

        self::assertEquals('NEGATIVE_INT', $constants[1]->getName());
        self::assertEquals(-42, $constants[1]->getValue());

        self::assertEquals('POSITIVE_FLOAT', $constants[2]->getName());
        self::assertEquals(3.14, $constants[2]->getValue());

        self::assertEquals('NEGATIVE_FLOAT', $constants[3]->getName());
        self::assertEquals(-3.14, $constants[3]->getValue());

        self::assertEquals('ZERO', $constants[4]->getName());
        self::assertEquals(0, $constants[4]->getValue());

        self::assertEquals('EXPLICIT_POSITIVE', $constants[5]->getName());
        self::assertEquals(123, $constants[5]->getValue());
    }
}
