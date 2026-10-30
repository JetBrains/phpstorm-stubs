<?php

namespace StubTests\Unit\Parsers\Stubs;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubConstantRegistry;

/**
 * Covers how stub default values find the constants their names refer to: `self::`, names
 * relative to the file's namespace and imported names resolve as they would in PHP.
 *
 * Parses through StubClassParser, whose extractor resolves the names before the defaults are
 * evaluated.
 */
class StubDefaultNameResolutionTest extends TestCase
{
    protected function setUp(): void
    {
        StubConstantRegistry::clear();
    }

    protected function tearDown(): void
    {
        StubConstantRegistry::clear();
    }

    public function testSelfAndNamesRelativeToTheNamespaceResolveAsInPhp(): void
    {
        $walker = $this->parseClass(<<<'PHP'
            <?php
            namespace NotLoaded\Ext;

            use NotLoaded\Other\Remote;

            class Options
            {
                public const DEFAULT_MODE = 2;
            }

            class Walker
            {
                public const LEAVES_ONLY = 1;

                public $mode = self::LEAVES_ONLY;

                public function __construct(
                    $mode = self::LEAVES_ONLY,
                    $options = Options::DEFAULT_MODE,
                    $remote = Remote::VALUE,
                    $flag = NAMESPACED_FLAG,
                    $global = PHP_INT_SIZE,
                    $class = Options::class,
                ) {}
            }
            PHP, 'Walker');
        StubConstantRegistry::register('\\NotLoaded\\Other\\Remote::VALUE', 3);
        StubConstantRegistry::register('\\NotLoaded\\Ext\\NAMESPACED_FLAG', 4);

        $defaults = [];
        foreach ($walker->getMethods()[0]->getParameters() as $parameter) {
            $defaults[$parameter->getName()] = $parameter->getDefaultValue();
        }
        self::assertSame(
            ['mode' => 1, 'options' => 2, 'remote' => 3, 'flag' => 4, 'global' => PHP_INT_SIZE, 'class' => 'NotLoaded\\Ext\\Options'],
            $defaults
        );
        self::assertSame(1, $walker->getProperties()[0]->getDefaultValue());
    }

    public function testNamespacedConstantWinsOverAGlobalOneOfTheSameName(): void
    {
        $walker = $this->parseClass(<<<'PHP'
            <?php
            namespace NotLoaded\Ext;

            class Walker
            {
                public function __construct($level = E_ERROR) {}
            }
            PHP, 'Walker');
        StubConstantRegistry::register('\\NotLoaded\\Ext\\E_ERROR', 99);

        self::assertSame(99, $walker->getMethods()[0]->getParameters()[0]->getDefaultValue());
    }

    public function testDuplicateImportsDoNotStopTheParse(): void
    {
        // PHP would reject the second import, but stubs are never compiled
        $walker = $this->parseClass(<<<'PHP'
            <?php
            namespace NotLoaded\Ext;

            use NotLoaded\Other\Remote;
            use NotLoaded\Other\Remote;

            class Walker
            {
                public function __construct($remote = Remote::VALUE) {}
            }
            PHP, 'Walker');
        StubConstantRegistry::register('\\NotLoaded\\Other\\Remote::VALUE', 3);

        self::assertSame(3, $walker->getMethods()[0]->getParameters()[0]->getDefaultValue());
    }

    private function parseClass(string $code, string $name): PHPClass
    {
        foreach ((new StubClassParser())->extractAndParseAll($code) as $class) {
            if ($class->getName() === $name) {
                return $class;
            }
        }
        self::fail("Class {$name} not found");
    }
}
