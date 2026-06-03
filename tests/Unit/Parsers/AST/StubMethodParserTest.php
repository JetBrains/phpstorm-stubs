<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class StubMethodParserTest extends BaseTestCase
{
    private FixtureStubsDataProvider $filesProvider;
    private StubClassParser $classParser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Methods';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->classParser = new StubClassParser();
    }

    private function getMethodsFromClass(string $fixtureFile): array
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        $class = $this->classParser->parse($stubCode);
        return $class->getMethods();
    }

    public function testItReturnsCorrectInstance()
    {
        $methods = $this->getMethodsFromClass('simple_method.txt');
        self::assertInstanceOf(PHPMethod::class, $methods[0]);
    }

    public function testItCanParseMethodName()
    {
        $methods = $this->getMethodsFromClass('simple_method.txt');
        self::assertEquals('simpleMethod', $methods[0]->getName());
    }

    public function testItCanParsePublicVisibility()
    {
        $methods = $this->getMethodsFromClass('modifiers_method.txt');
        $publicMethod = $methods[0]; // publicMethod
        self::assertEquals('public', $publicMethod->getAccess()->value);
    }

    public function testItCanParseProtectedVisibility()
    {
        $methods = $this->getMethodsFromClass('modifiers_method.txt');
        $protectedMethod = $methods[1]; // protectedMethod
        self::assertEquals('protected', $protectedMethod->getAccess()->value);
    }

    public function testItCanParsePrivateVisibility()
    {
        $methods = $this->getMethodsFromClass('modifiers_method.txt');
        $privateMethod = $methods[2]; // privateMethod
        self::assertEquals('private', $privateMethod->getAccess()->value);
    }

    public function testItCanParseStaticModifier()
    {
        $methods = $this->getMethodsFromClass('modifiers_method.txt');
        $staticMethod = $methods[3]; // staticMethod
        self::assertTrue($staticMethod->isStatic());
    }

    public function testItParsesNonStaticByDefault()
    {
        $methods = $this->getMethodsFromClass('simple_method.txt');
        self::assertFalse($methods[0]->isStatic());
    }

    public function testItCanParseFinalModifier()
    {
        $methods = $this->getMethodsFromClass('modifiers_method.txt');
        $finalMethod = $methods[4]; // finalMethod
        self::assertTrue($finalMethod->isFinal());
    }

    public function testItParsesNonFinalByDefault()
    {
        $methods = $this->getMethodsFromClass('simple_method.txt');
        self::assertFalse($methods[0]->isFinal());
    }

    public function testItCanParseAbstractModifier()
    {
        $methods = $this->getMethodsFromClass('modifiers_method.txt');
        $abstractMethod = $methods[5]; // abstractMethod
        self::assertTrue($abstractMethod->isAbstract());
    }

    public function testItParsesNonAbstractByDefault()
    {
        $methods = $this->getMethodsFromClass('simple_method.txt');
        self::assertFalse($methods[0]->isAbstract());
    }

    public function testItCanParseDeprecatedFromDocComment()
    {
        $methods = $this->getMethodsFromClass('complete_method.txt');
        $deprecatedMethod = $methods[0]; // completeMethod with @deprecated
        self::assertTrue($deprecatedMethod->isDeprecated());
    }

    public function testItParsesNonDeprecatedWhenNoDocComment()
    {
        $methods = $this->getMethodsFromClass('simple_method.txt');
        self::assertFalse($methods[0]->isDeprecated());
    }

    public function testItParsesNonDeprecatedWhenDocCommentHasNoDeprecatedTag()
    {
        $methods = $this->getMethodsFromClass('complete_method.txt');
        $privateMethod = $methods[2]; // privateMethod without @deprecated
        self::assertFalse($privateMethod->isDeprecated());
    }

    public function testItCanParseCombinedModifiers()
    {
        $methods = $this->getMethodsFromClass('complete_method.txt');
        $completeMethod = $methods[0]; // public static final

        self::assertEquals('public', $completeMethod->getAccess()->value);
        self::assertTrue($completeMethod->isStatic());
        self::assertTrue($completeMethod->isFinal());
        self::assertFalse($completeMethod->isAbstract());
        self::assertTrue($completeMethod->isDeprecated());
    }

    public function testItParsesAllMethodsFromClass()
    {
        $methods = $this->getMethodsFromClass('modifiers_method.txt');
        self::assertCount(6, $methods);

        self::assertEquals('publicMethod', $methods[0]->getName());
        self::assertEquals('protectedMethod', $methods[1]->getName());
        self::assertEquals('privateMethod', $methods[2]->getName());
        self::assertEquals('staticMethod', $methods[3]->getName());
        self::assertEquals('finalMethod', $methods[4]->getName());
        self::assertEquals('abstractMethod', $methods[5]->getName());
    }
}
