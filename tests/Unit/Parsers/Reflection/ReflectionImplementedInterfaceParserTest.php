<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Reflection\ReflectionImplementedInterfaceParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassReference;

/**
 * Unit tests for ReflectionImplementedInterfaceParser.
 *
 * Verifies the fix that stores the FULL qualified name in getName() rather than
 * just the short name, preventing FQN mismatches for namespaced interfaces
 * (e.g. 'Random\Engine' vs 'Engine').
 */
class ReflectionImplementedInterfaceParserTest extends TestCase
{
    private ReflectionImplementedInterfaceParser $parser;

    protected function setUp(): void
    {
        $this->parser = new ReflectionImplementedInterfaceParser();
    }

    // ── canParse ──────────────────────────────────────────────────────────────

    public function testCanParseAlwaysReturnsFalse(): void
    {
        // canParse() returns false unconditionally — this parser is invoked directly,
        // not through the registry dispatch.
        $this->assertFalse($this->parser->canParse(new \stdClass()));
        $this->assertFalse($this->parser->canParse(new AdaptedReflectionClassReference('Throwable')));
    }

    // ── Global (non-namespaced) interface ─────────────────────────────────────

    public function testSimpleGlobalInterfaceStoresNameAndId(): void
    {
        $ref = new AdaptedReflectionClassReference('Throwable');
        $result = $this->parser->parse($ref);

        $this->assertInstanceOf(PHPInterface::class, $result);
        $this->assertEquals('Throwable', $result->getName());
        $this->assertEquals('\Throwable', $result->getId());
    }

    public function testGlobalInterfaceIdHasLeadingBackslash(): void
    {
        $ref = new AdaptedReflectionClassReference('Iterator');
        $result = $this->parser->parse($ref);

        $this->assertStringStartsWith('\\', $result->getId());
        $this->assertEquals('\Iterator', $result->getId());
    }

    public function testGlobalInterfaceNamespaceIsEmpty(): void
    {
        $ref = new AdaptedReflectionClassReference('Countable');
        $result = $this->parser->parse($ref);

        // getNamespaceName() returns '' for global classes in AdaptedReflectionClassReference
        $this->assertEquals('', $result->getNamespace());
    }

    // ── Namespaced interface ──────────────────────────────────────────────────

    public function testNamespacedInterfaceStoresFullNameNotShortName(): void
    {
        // Regression: old parser stored getShortName() = 'Engine' instead of getName() = 'Random\Engine'
        $ref = new AdaptedReflectionClassReference('Random\Engine');
        $result = $this->parser->parse($ref);

        $this->assertEquals('Random\Engine', $result->getName());
        $this->assertNotEquals('Engine', $result->getName(), 'Short name must NOT be stored');
    }

    public function testNamespacedInterfaceIdIsLeadingBackslashPlusFullName(): void
    {
        $ref = new AdaptedReflectionClassReference('Random\Engine');
        $result = $this->parser->parse($ref);

        $this->assertEquals('\Random\Engine', $result->getId());
    }

    public function testNamespacedInterfaceNamespaceExtractedCorrectly(): void
    {
        $ref = new AdaptedReflectionClassReference('Random\Engine');
        $result = $this->parser->parse($ref);

        $this->assertEquals('Random', $result->getNamespace());
    }

    public function testCryptoSafeEngineStoresFullNameNotShortName(): void
    {
        // Concrete regression: was storing 'CryptoSafeEngine', must store 'Random\CryptoSafeEngine'
        $ref = new AdaptedReflectionClassReference('Random\CryptoSafeEngine');
        $result = $this->parser->parse($ref);

        $this->assertEquals('Random\CryptoSafeEngine', $result->getName());
        $this->assertEquals('\Random\CryptoSafeEngine', $result->getId());
    }

    // ── Deep namespace ────────────────────────────────────────────────────────

    public function testDeepNamespacedInterface(): void
    {
        $ref = new AdaptedReflectionClassReference('Foo\Bar\Baz\MyInterface');
        $result = $this->parser->parse($ref);

        $this->assertEquals('Foo\Bar\Baz\MyInterface', $result->getName());
        $this->assertEquals('\Foo\Bar\Baz\MyInterface', $result->getId());
        $this->assertEquals('Foo\Bar\Baz', $result->getNamespace());
    }

    // ── ID always starts with \ ───────────────────────────────────────────────

    public function testIdAlwaysStartsWithBackslash(): void
    {
        $cases = ['Throwable', 'Iterator', 'Random\Engine', 'Foo\Bar\MyInterface'];
        foreach ($cases as $name) {
            $ref = new AdaptedReflectionClassReference($name);
            $result = $this->parser->parse($ref);
            $this->assertStringStartsWith(
                '\\',
                $result->getId(),
                "getId() for '{$name}' must start with '\\'"
            );
        }
    }

    // ── getName() == getId() without leading \ ────────────────────────────────

    public function testNameEqualsIdWithoutLeadingBackslash(): void
    {
        $cases = ['Throwable', 'Random\Engine', 'Foo\Bar\Iface'];
        foreach ($cases as $name) {
            $ref = new AdaptedReflectionClassReference($name);
            $result = $this->parser->parse($ref);
            $this->assertEquals(
                ltrim($result->getId(), '\\'),
                $result->getName(),
                "getName() must equal getId() without leading \\ for '{$name}'"
            );
        }
    }
}
