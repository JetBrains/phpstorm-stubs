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
    public function testRuntimeSkipsConstantNamesReflectionCannotResolve(): void
    {
        $provider = new class() extends CurrentRuntimeReflectionRawDataProvider {
            public function getReflectionConstants()
            {
                return ['NOT_A_DEFINED_CONSTANT' => 1, 'E_STRICT' => E_STRICT];
            }
        };

        self::assertSame(['E_STRICT'], $provider->getDeprecatedConstantNames());
    }

    #[RequiresPhp('>= 8.4.0')]
    public function testProcessorMarksTheConstantsStageOneReportsDeprecated(): void
    {
        $dir = sys_get_temp_dir() . '/phpstorm-stubs-processor-' . bin2hex(random_bytes(6));
        mkdir($dir);
        $input = $dir . '/input.dat';
        $output = $dir . '/Reflection' . PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.json';
        file_put_contents($input, serialize([
            'phpVersion' => PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION,
            'runtimeVersion' => PHP_VERSION,
            'classes' => [],
            'interfaces' => [],
            'enums' => [],
            'functions' => [],
            'constants' => ['E_ALL' => E_ALL, 'E_STRICT' => E_STRICT],
            'deprecatedConstants' => ['E_STRICT'],
        ]));

        try {
            exec(sprintf(
                '%s %s %s %s 2>&1',
                escapeshellarg(PHP_BINARY),
                escapeshellarg(__DIR__ . '/../../../run-reflection-processor.php'),
                escapeshellarg($input),
                escapeshellarg($output)
            ), $lines, $exitCode);
            self::assertSame(0, $exitCode, implode("\n", $lines));

            $deprecation = [];
            foreach (json_decode(file_get_contents($output), true) as $entity) {
                $deprecation[$entity['name']] = $entity['isDeprecated'] ?? false;
            }
            self::assertSame(['E_ALL' => false, 'E_STRICT' => true], $deprecation);
        } finally {
            array_map('unlink', glob($dir . '/*'));
            rmdir($dir);
        }
    }

    #[RequiresPhp('>= 8.4.0')]
    public function testModernConstantParserReadsDeprecation(): void
    {
        $parser = new ReflectionModernConstantParser();

        self::assertTrue($parser->parse(new \ReflectionConstant('E_STRICT'))->isDeprecated());
        self::assertFalse($parser->parse(new \ReflectionConstant('E_ALL'))->isDeprecated());
    }
}
