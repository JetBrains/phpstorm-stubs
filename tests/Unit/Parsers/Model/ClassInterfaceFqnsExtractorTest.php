<?php

namespace StubTests\Unit\Parsers\Model;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Services\ClassInterfaceFqnsExtractor;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPInterface;

/**
 * Unit tests for ClassInterfaceFqnsExtractor.
 *
 * Verifies FQN extraction from linked interface objects, getId() → ltrim normalisation,
 * getName() fallback for unresolved stubs, and filtering of null/empty values.
 */
class ClassInterfaceFqnsExtractorTest extends TestCase
{
    private ClassInterfaceFqnsExtractor $extractor;

    protected function setUp(): void
    {
        $this->extractor = new ClassInterfaceFqnsExtractor();
    }

    private function makeInterface(string $id, ?string $shortName = null): PHPInterface
    {
        $iface = new PHPInterface();
        $iface->setId($id);
        $iface->setName($shortName ?? ltrim(basename(str_replace('\\', '/', $id)), '\\'));
        return $iface;
    }

    // ── No interfaces ─────────────────────────────────────────────────────────

    public function testReturnsEmptyArrayWhenNoInterfaces(): void
    {
        $class = new PHPClass();
        $this->assertSame([], $this->extractor->extract($class));
    }

    // ── getId() with leading \ stripped ──────────────────────────────────────

    public function testGlobalInterfaceIdStripsLeadingBackslash(): void
    {
        $class = new PHPClass();
        $class->setImplementedInterfaces([$this->makeInterface('\Throwable', 'Throwable')]);

        $this->assertSame(['Throwable'], $this->extractor->extract($class));
    }

    public function testNamespacedInterfaceIdReturnsFqn(): void
    {
        $class = new PHPClass();
        $class->setImplementedInterfaces([$this->makeInterface('\Random\Engine', 'Engine')]);

        // getId() = '\Random\Engine' → ltrim → 'Random\Engine' (NOT just 'Engine')
        $this->assertSame(['Random\Engine'], $this->extractor->extract($class));
    }

    public function testDeepNamespacedInterfaceId(): void
    {
        $class = new PHPClass();
        $class->setImplementedInterfaces([$this->makeInterface('\Foo\Bar\Baz\MyInterface', 'MyInterface')]);

        $this->assertSame(['Foo\Bar\Baz\MyInterface'], $this->extractor->extract($class));
    }

    public function testIdTakesPrecedenceOverName(): void
    {
        // When id is the FQN and name is the short name (as produced after linking),
        // the extractor must use the id, not the name.
        $iface = new PHPInterface();
        $iface->setId('\Random\CryptoSafeEngine');
        $iface->setName('CryptoSafeEngine'); // short name — must NOT be returned
        $class = new PHPClass();
        $class->setImplementedInterfaces([$iface]);

        $this->assertSame(['Random\CryptoSafeEngine'], $this->extractor->extract($class));
        $this->assertNotSame(['CryptoSafeEngine'], $this->extractor->extract($class));
    }

    // ── getName() fallback when getId() is null ───────────────────────────────

    public function testFallsBackToNameWhenIdIsNull(): void
    {
        $iface = new PHPInterface();
        // id not set (null)
        $iface->setName('Iterator');
        $class = new PHPClass();
        $class->setImplementedInterfaces([$iface]);

        $this->assertSame(['Iterator'], $this->extractor->extract($class));
    }

    // ── Null / empty filtering ────────────────────────────────────────────────

    public function testSkipsInterfaceWithNullIdAndNullName(): void
    {
        $iface1 = new PHPInterface(); // id=null, name=null
        $iface2 = $this->makeInterface('\Countable', 'Countable');
        $class = new PHPClass();
        $class->setImplementedInterfaces([$iface1, $iface2]);

        $this->assertSame(['Countable'], $this->extractor->extract($class));
    }

    public function testSkipsInterfaceWithEmptyNameFallback(): void
    {
        $iface1 = new PHPInterface();
        $iface1->setName(''); // empty name after fallback
        $iface2 = $this->makeInterface('\Iterator', 'Iterator');
        $class = new PHPClass();
        $class->setImplementedInterfaces([$iface1, $iface2]);

        $this->assertSame(['Iterator'], $this->extractor->extract($class));
    }

    // ── Multiple interfaces ───────────────────────────────────────────────────

    public function testReturnsMultipleInterfacesInOrder(): void
    {
        $class = new PHPClass();
        $class->setImplementedInterfaces([
            $this->makeInterface('\IteratorAggregate', 'IteratorAggregate'),
            $this->makeInterface('\Countable', 'Countable'),
            $this->makeInterface('\ArrayAccess', 'ArrayAccess'),
        ]);

        $this->assertSame(
            ['IteratorAggregate', 'Countable', 'ArrayAccess'],
            $this->extractor->extract($class)
        );
    }

    public function testMixedResolvedAndUnresolvedInterfaces(): void
    {
        $linked = $this->makeInterface('\Throwable', 'Throwable'); // id set
        $unlinked = new PHPInterface();
        $unlinked->setName('Serializable'); // id=null, name set
        $class = new PHPClass();
        $class->setImplementedInterfaces([$linked, $unlinked]);

        $this->assertSame(['Throwable', 'Serializable'], $this->extractor->extract($class));
    }
}
