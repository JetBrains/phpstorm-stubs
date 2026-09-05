<?php

namespace StubTests\Unit\Parsers\Reflection;

use StubTests\Framework\Model\Access\AccessModifier;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPClassConstant;
use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Parsers\Reflection\ReflectionClassConstantParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassReference;
use function PHPUnit\Framework\assertEquals;

class ReflectionClassConstantParserTest extends TestCase
{
    /**
     * Replaces two assertions that could not fail: parse() declares a non-nullable
     * PHPClassConstant return type, so both `assertNotNull` and `instanceof` were
     * guaranteed by the signature. Asserts the value actually reaches the model instead.
     */
    public function testItCopiesNameAndValueFromTheReflectionConstant()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $classConstantMock->method('getName')->willReturn('MY_CONST');
        $classConstantMock->method('getValue')->willReturn(42);

        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);

        self::assertSame('MY_CONST', $parsedConstant->getName());
        self::assertSame(42, $parsedConstant->getValue());
    }

    /**
     * Not type-guaranteed: each call must yield its own model, not a memoised one.
     */
    public function testEachParseReturnsItsOwnClassConstantModel()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();

        $parser = new ReflectionClassConstantParser();
        $first = $parser->parse($classConstantMock);
        $second = $parser->parse($classConstantMock);

        self::assertNotSame($first, $second);
        $first->setName('mutated');
        self::assertNotSame('mutated', $second->getName());
    }

    public function testItSetsDevautNameNullForClassConstants()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getName());
    }

    public function testItCanParseClassConstantName()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $classConstantMock->method('getName')->willReturn('foo');
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertEquals('foo', $parsedConstant->getName());
    }

    public function testItSetsDevautValueNullForClassConstants()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getValue());
    }

    public function testItCanParseClassConstantValue()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getValue'])
            ->getMock();
        $classConstantMock->method('getValue')->willReturn('foo');
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertEquals('foo', $parsedConstant->getValue());
    }

    public function testParsedConstantDoesnNotHaveId()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $classConstantMock->method('getName')->willReturn('foo');
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getId());
    }

    public function testItSetsNullAsParentClassIfNoParentClass()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getParentId());
    }

    public function testItCanParseParentClassIdRootNamespace()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDeclaringClass'])
            ->getMock();
        $declaringClassMock = new AdaptedReflectionClassReference('ParentClass');
        $classConstantMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        assertEquals('\ParentClass', $parsedConstant->getParentId());
    }

    public function testItCanParseParentClassIdCustomNamespace()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDeclaringClass'])
            ->getMock();
        $declaringClassMock = new AdaptedReflectionClassReference('DummyNamespace\ParentClass');
        $classConstantMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        assertEquals('\DummyNamespace\ParentClass', $parsedConstant->getParentId());
    }

    public function testItCanParseConstantPrivateVisibility()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPrivate'])
            ->getMock();
        $classConstantMock->method('isPrivate')->willReturn(true);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PRIVATE, $parsedConstant->getAccess());
    }

    public function testItCanParseConstantProtectedVisibility()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isProtected'])
            ->getMock();
        $classConstantMock->method('isProtected')->willReturn(true);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PROTECTED, $parsedConstant->getAccess());
    }

    public function testItCanParseConstantPublicVisibility()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic'])
            ->getMock();
        $classConstantMock->method('isPublic')->willReturn(true);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PUBLIC, $parsedConstant->getAccess());
    }

    public function testItParseVisibilityPublicIfNoVisibilityIsPresent()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic', 'isProtected', 'isPrivate'])
            ->getMock();
        $classConstantMock->method('isPublic')->willReturn(false);
        $classConstantMock->method('isProtected')->willReturn(false);
        $classConstantMock->method('isPrivate')->willReturn(false);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PUBLIC, $parsedConstant->getAccess());
    }

    /**
     * isFinal() was exposed by the wrapper but never read, so a final internal constant
     * cached as non-final. Latent today — nothing in core or in the stubs declares a final
     * class constant (final constants are PHP 8.1+) — so only a test can pin it.
     */
    #[DataProvider('finalityProvider')]
    public function testItPropagatesFinalityFromTheReflectionConstant($reflectionSaysFinal, $expected)
    {
        // createStub, not getMockBuilder()->onlyMethods(): the latter is what emits the repo's
        // ~839 PHPUnit notices, and nothing here constrains arguments or call counts. It doubles
        // every method though, so getDeclaringClass() must be stubbed too — the parser
        // dereferences it unconditionally.
        $declaringClass = $this->createStub(AdaptedReflectionClass::class);
        $declaringClass->method('getName')->willReturn('SomeClass');

        $classConstantMock = $this->createStub(AdaptedReflectionClassConstant::class);
        $classConstantMock->method('getName')->willReturn('SOME_CONST');
        $classConstantMock->method('getValue')->willReturn(1);
        $classConstantMock->method('isFinal')->willReturn($reflectionSaysFinal);
        $classConstantMock->method('getDeclaringClass')->willReturn($declaringClass);

        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);

        self::assertSame($expected, $parsedConstant->isFinal());
    }

    public static function finalityProvider()
    {
        return [
            'final constant stays final' => [true, true],
            'non-final stays non-final' => [false, false],
        ];
    }

    /**
     * The name => value fallback is reached only on runtimes without
     * getReflectionConstants(), i.e. before PHP 7.1 — where class-constant visibility (7.1)
     * and final constants (8.1) do not exist yet. Its public/non-final defaults are correct
     * by construction, and this pins that so the defaults are not "fixed" into something else.
     */
    public function testArrayFallbackDefaultsToPublicAndNonFinal()
    {
        $parsedConstant = new ReflectionClassConstantParser()->parse(['LEGACY_CONST' => 'v']);

        self::assertSame('LEGACY_CONST', $parsedConstant->getName());
        self::assertSame('v', $parsedConstant->getValue());
        self::assertFalse($parsedConstant->isFinal());
    }
}
