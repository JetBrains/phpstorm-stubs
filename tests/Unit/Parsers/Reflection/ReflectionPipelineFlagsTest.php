<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\Attributes\IgnoreDeprecations;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\DataProvider\CurrentRuntimeReflectionRawDataProvider;
use StubTests\Framework\Parsers\Reflection\ReflectionClassParser;
use StubTests\Framework\Parsers\Reflection\ReflectionModernConstantParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Unit\Parsers\Reflection\fixtures\DeprecatedConstantFixture;

/**
 * Runs real reflection through the Stage 1 adapters and the Stage 2 parsers, for the flags the
 * validators compare: class abstract and constant deprecation.
 * Deprecations are ignored because Stage 1 calls every getter, deprecated ones included, with E_DEPRECATED off.
 */
#[IgnoreDeprecations]
class ReflectionPipelineFlagsTest extends TestCase
{
    public function testAbstractClassIsParsedAsAbstract(): void
    {
        $class = (new ReflectionClassParser())->parse(new AdaptedReflectionClass(new \ReflectionClass(\ReflectionFunctionAbstract::class)));

        self::assertTrue($class->isAbstract());
    }

    public function testConcreteClassIsParsedAsNonAbstract(): void
    {
        $class = (new ReflectionClassParser())->parse(new AdaptedReflectionClass(new \ReflectionClass(\ArrayObject::class)));

        self::assertFalse($class->isAbstract());
    }

    #[RequiresPhp('>= 8.4.0')]
    public function testClassConstantDeprecationIsParsed(): void
    {
        $class = (new ReflectionClassParser())->parse(new AdaptedReflectionClass(new \ReflectionClass(DeprecatedConstantFixture::class)));
        $deprecation = [];
        foreach ($class->getConstants() as $constant) {
            $deprecation[$constant->getName()] = $constant->isDeprecated();
        }

        self::assertSame(['OLD' => true, 'CURRENT' => false], $deprecation);
    }

    #[RequiresPhp('>= 8.4.0')]
    public function testRuntimeReportsDeprecatedGlobalConstants(): void
    {
        $deprecated = (new CurrentRuntimeReflectionRawDataProvider())->getDeprecatedConstantNames();

        self::assertContains('E_STRICT', $deprecated);
        self::assertNotContains('E_ALL', $deprecated);
    }

    #[RequiresPhp('>= 8.4.0')]
    public function testModernConstantParserReadsDeprecation(): void
    {
        $parser = new ReflectionModernConstantParser();

        self::assertTrue($parser->parse(new \ReflectionConstant('E_STRICT'))->isDeprecated());
        self::assertFalse($parser->parse(new \ReflectionConstant('E_ALL'))->isDeprecated());
    }
}
