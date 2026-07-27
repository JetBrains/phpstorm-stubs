<?php

namespace StubTests\Unit\Parsers\Stubs;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicNodeExtractor;

/**
 * Covers the shared AST cache in NikicNodeExtractor.
 *
 * AllStubsParser hands each stub file to every registered parser in turn, and each parser
 * owns its own extractor, so every file used to be lexed and parsed once per parser —
 * measured at 6 parses per file. The cache is therefore shared across instances rather
 * than held per instance, which is what these tests pin down: correctness must not depend
 * on which instance does the parsing, and a content change must not be served stale.
 */
class NikicNodeExtractorCacheTest extends TestCase
{
    protected function setUp(): void
    {
        NikicNodeExtractor::clearAstCache();
    }

    protected function tearDown(): void
    {
        NikicNodeExtractor::clearAstCache();
    }
    private const CLASS_SOURCE = <<<'SRC'
<?php
namespace Demo;
class Alpha { public function a(): void {} }
SRC;

    public function testSecondInstanceSeesTheSameContentIdentically(): void
    {
        $first = (new NikicNodeExtractor())->extractAllClasses(self::CLASS_SOURCE);
        $second = (new NikicNodeExtractor())->extractAllClasses(self::CLASS_SOURCE);

        self::assertCount(1, $first);
        self::assertCount(1, $second);
        self::assertSame($first[0]->getName(), $second[0]->getName());
        self::assertSame('\Demo', $second[0]->getNamespace());
    }

    /**
     * Different extract* methods read different node kinds out of the same parse. Sharing
     * one AST between them must not let one kind's traversal hide another's.
     */
    public function testDifferentExtractorsReadTheSameCachedAst(): void
    {
        $source = <<<'SRC'
<?php
namespace Demo;
class Alpha {}
interface Beta {}
enum Gamma { case One; }
function delta(): void {}
SRC;

        $extractor = new NikicNodeExtractor();

        self::assertCount(1, $extractor->extractAllClasses($source));
        self::assertCount(1, $extractor->extractAllInterfaces($source));
        self::assertCount(1, $extractor->extractAllEnums($source));
        self::assertCount(1, $extractor->extractAllFunctions($source));
        // Re-reading a kind after the others must still work off the same cached AST.
        self::assertCount(1, $extractor->extractAllClasses($source));
    }

    /**
     * The cache holds a single entry, so alternating between two sources must re-parse
     * rather than return the other one's nodes.
     */
    public function testAlternatingBetweenTwoSourcesNeverReturnsStaleNodes(): void
    {
        $a = "<?php\nclass OnlyA {}";
        $b = "<?php\nclass OnlyB {}";
        $extractor = new NikicNodeExtractor();

        for ($i = 0; $i < 3; $i++) {
            self::assertSame('OnlyA', $extractor->extractAllClasses($a)[0]->getName());
            self::assertSame('OnlyB', $extractor->extractAllClasses($b)[0]->getName());
        }
    }

    /**
     * Keyed by content, not by identity: an equal string built separately must hit, and a
     * changed string must miss.
     */
    public function testCacheIsKeyedByContentNotIdentity(): void
    {
        $extractor = new NikicNodeExtractor();
        $original = "<?php\nclass Same {}";
        $equal = "<?php\n" . 'class Same {}';
        $changed = "<?php\nclass Different {}";

        self::assertSame('Same', $extractor->extractAllClasses($original)[0]->getName());
        self::assertSame('Same', $extractor->extractAllClasses($equal)[0]->getName());
        self::assertSame('Different', $extractor->extractAllClasses($changed)[0]->getName());
        self::assertSame('Same', $extractor->extractAllClasses($original)[0]->getName());
    }

    public function testClearAstCacheDoesNotChangeResults(): void
    {
        $extractor = new NikicNodeExtractor();

        $before = $extractor->extractAllClasses(self::CLASS_SOURCE)[0]->getName();
        NikicNodeExtractor::clearAstCache();
        $after = $extractor->extractAllClasses(self::CLASS_SOURCE)[0]->getName();

        self::assertSame($before, $after);
    }

    /**
     * Imports come from the same parse as the nodes, so they must survive caching too.
     */
    public function testImportsAreStillResolvedFromACachedParse(): void
    {
        $source = <<<'SRC'
<?php
namespace Demo;
use Other\Marker;
class Alpha implements Marker {}
SRC;

        $extractor = new NikicNodeExtractor();
        $extractor->extractAllClasses($source);
        $withImports = $extractor->extractAllClassesWithImports($source);

        self::assertCount(1, $withImports);
        self::assertArrayHasKey('Marker', $withImports[0]['imports']);
        self::assertSame('Other\Marker', ltrim($withImports[0]['imports']['Marker'], '\\'));
    }
}
