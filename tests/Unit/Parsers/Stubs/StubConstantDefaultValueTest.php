<?php

namespace StubTests\Unit\Parsers\Stubs;

use PhpParser\Node\Stmt\Function_;
use PhpParser\NodeFinder;
use PhpParser\ParserFactory;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicParameterNode;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubConstantRegistry;

/**
 * Covers the stub-sourced fallback used when a parameter default references a
 * constant that the host runtime cannot resolve (e.g. ext-intl not loaded).
 *
 * @see StubConstantRegistry
 * @see NikicParameterNode
 */
class StubConstantDefaultValueTest extends TestCase
{
    protected function setUp(): void
    {
        StubConstantRegistry::clear();
    }

    protected function tearDown(): void
    {
        StubConstantRegistry::clear();
    }

    public function testClassConstantDefaultResolvesFromRegistryWhenRuntimeCannot(): void
    {
        // A class constant whose declaring class is NOT loaded in this process.
        StubConstantRegistry::register('\\NotLoadedExtClass::KEY_SEQUENTIAL', 0);

        $value = $this->evaluateDefault('function f($type = NotLoadedExtClass::KEY_SEQUENTIAL) {}');

        self::assertSame(0, $value);
    }

    public function testGlobalConstantDefaultResolvesFromRegistryWhenRuntimeCannot(): void
    {
        StubConstantRegistry::register('\\NOT_LOADED_EXT_CONSTANT', 42);

        $value = $this->evaluateDefault('function f($type = NOT_LOADED_EXT_CONSTANT) {}');

        self::assertSame(42, $value);
    }

    public function testStaysNullWhenNeitherRuntimeNorRegistryKnowsTheConstant(): void
    {
        // No registration: the value must remain null rather than be fabricated.
        $value = $this->evaluateDefault('function f($type = NotLoadedExtClass::KEY_SEQUENTIAL) {}');

        self::assertNull($value);
    }

    public function testRuntimeResolutionStillWins(): void
    {
        // PHP_INT_MAX is always defined at runtime; no registry entry needed.
        $value = $this->evaluateDefault('function f($x = PHP_INT_MAX) {}');

        self::assertSame(PHP_INT_MAX, $value);
    }

    public function testIntlPartsIteratorDefaultIsResolvableAfterParsingIntlStub(): void
    {
        // End-to-end: parsing the real intl stub registers IntlPartsIterator::KEY_SEQUENTIAL,
        // so IntlBreakIterator::getPartsIterator()'s default resolves to 0 even without ext-intl.
        $intl = file_get_contents(dirname(__DIR__, 4) . '/intl/intl.php');
        self::assertNotFalse($intl);
        (new StubClassParser())->extractAndParseAll($intl);

        self::assertTrue(StubConstantRegistry::has('IntlPartsIterator::KEY_SEQUENTIAL'));
        self::assertSame(0, StubConstantRegistry::get('IntlPartsIterator::KEY_SEQUENTIAL'));
    }

    private function evaluateDefault(string $functionCode): mixed
    {
        $parser = (new ParserFactory())->createForNewestSupportedVersion();
        $stmts = $parser->parse('<?php ' . $functionCode);
        /** @var Function_ $fn */
        $fn = (new NodeFinder())->findInstanceOf($stmts, Function_::class)[0];

        $node = new NikicParameterNode($fn->params[0]);

        $parameter = new PHPParameter($node->getName());
        $parameter->setHasDefaultValue(true);
        $parameter->setDefaultValueEvaluator(fn () => $node->getDefaultValue());

        return $parameter->getDefaultValue();
    }
}
