<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\DataProvider\StubsDataProvider;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Stubs\StubInterfaceParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class StubsInterfaceParserTest extends TestCase
{
    private StubsDataProvider $filesProvider;
    private StubInterfaceParser $parser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Interfaces';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->parser = new StubInterfaceParser();
    }

    public function testItReturnsCorrectInstance()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $basePHPElement = $this->parser->parse($stubCode);
        self::assertInstanceOf(PHPInterface::class, $basePHPElement);
    }

    public function testItCanParseSimpleInterfaceName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('Throwable', $class->getName());
    }

    public function testItSetsRootNamespaceForInterfaceWithoutNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\', $class->getNamespace());
    }

    public function testItCanParseNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace', $class->getNamespace());
    }

    public function testItCanParseInterfaceName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('CompleteInterface', $class->getName());
    }

    public function testItCanParseId()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\MyNamespace\\SubNamespace\\CompleteInterface', $class->getId());
    }

    public function testItCanParseIdWithRootNamespace()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals('\\Throwable', $class->getId());
    }

    public function testItSetsEmptyArrayIfNoMethodsInInterface()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertIsArray($class->getMethods());
        self::assertEmpty($class->getMethods());
    }

    public function testItCanParseInterfaceWithMethods()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getMethods());
        self::assertNotEmpty($class->getMethods());
        self::assertEquals(2, sizeof($class->getMethods()));
    }

    public function testItReturnsCorrectInstanceForMethod()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $methods = $class->getMethods();
        self::assertInstanceOf(PHPMethod::class, $methods[0]);
    }

    public function testItReturnsActuallyParsedMethods()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $methods = $class->getMethods();
        self::assertEquals("method1", $methods[0]->getName());
        self::assertEquals("method2", $methods[1]->getName());
    }

    public function testItSetsEmptyArrayIfNoConstantsInInterface()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertIsArray($class->getConstants());
        self::assertEmpty($class->getConstants());
    }

    public function testItCanParseInterfaceConstants()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getConstants());
        self::assertIsArray($class->getConstants());
        self::assertNotEmpty($class->getConstants());
        self::assertEquals(2, sizeof($class->getConstants()));
    }

    public function testItReturnsCorrectInstanceForConstant()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $constant = $class->getConstants()[0];
        self::assertInstanceOf(PHPClassConstant::class, $constant);
    }

    public function testItReturnsActuallyParsedConstants()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        $constants = $class->getConstants();
        self::assertEquals("CONST_ONE", $constants[0]->getName());
        self::assertEquals("CONST_TWO", $constants[1]->getName());
    }

    public function testItSetsEmptyArraysForParentInterfacesIfNoAny()
    {
        $stubCode = $this->filesProvider->getStubFileContent('Throwable.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getParentInterfaces());
        self::assertIsArray($class->getParentInterfaces());
        self::assertEmpty($class->getParentInterfaces());
    }

    public function testItCanParseParentInterfaces()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertNotNull($class->getParentInterfaces());
        self::assertNotEmpty($class->getParentInterfaces());
        self::assertEquals(2, sizeof($class->getParentInterfaces()));
    }

    public function testItReturnsCorrectInstanceForParentInterface()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertInstanceOf(PHPInterface::class, $class->getParentInterfaces()[0]);
    }

    public function testItReturnsParentInterfacesWithCorrectName()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals("Throwable", $class->getParentInterfaces()[0]->getName());
        self::assertEquals("Runnable", $class->getParentInterfaces()[1]->getName());
    }

    public function testItReturnsAllActuallyParsedParentInterfaces()
    {
        $stubCode = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $class = $this->parser->parse($stubCode);
        self::assertEquals(2, sizeof($class->getParentInterfaces()));
        self::assertEquals("Throwable", $class->getParentInterfaces()[0]->getName());
        self::assertEquals("Runnable", $class->getParentInterfaces()[1]->getName());
    }

    public function testItParsesConstantsCorrectly()
    {
        // Test class with constants
        $stubCodeWithConstants = $this->filesProvider->getStubFileContent('CompleteInterface.txt');
        $classWithConstants = $this->parser->parse($stubCodeWithConstants);

        self::assertNotEmpty($classWithConstants->getConstants());
        self::assertCount(2, $classWithConstants->getConstants());
        self::assertEquals('CONST_ONE', $classWithConstants->getConstants()[0]->getName());
        self::assertEquals('CONST_TWO', $classWithConstants->getConstants()[1]->getName());

        // Test class without constants
        $stubCodeWithoutConstants = $this->filesProvider->getStubFileContent('Throwable.txt');
        $classWithoutConstants = $this->parser->parse($stubCodeWithoutConstants);

        self::assertEmpty($classWithoutConstants->getConstants());
    }

    // ── Parent interface id resolution ───────────────────────────────────────

    private function parseSource(?string $namespace, string $declaration): PHPInterface
    {
        $header = $namespace === null ? '' : "namespace {$namespace};\n";
        return $this->parser->parse("<?php\n{$header}{$declaration}");
    }

    /**
     * @return array<string, string|null> parent short name => resolved id
     */
    private function parentIds(PHPInterface $interface): array
    {
        $ids = [];
        foreach ($interface->getParentInterfaces() as $parent) {
            $ids[$parent->getName()] = $parent->getId();
        }
        return $ids;
    }

    /**
     * An unqualified parent resolves within the declaring namespace, per PHP's rule for
     * class-like names. Storing only the short name let ClassHierarchyResolver match
     * `MongoDB\BSON\Persistable extends Serializable` against the *global* \Serializable.
     */
    public function testUnqualifiedParentResolvesWithinTheDeclaringNamespace()
    {
        $interface = $this->parseSource('MongoDB\\BSON', 'interface Persistable extends Unserializable, Serializable {}');

        self::assertSame(
            [
                'Unserializable' => '\\MongoDB\\BSON\\Unserializable',
                'Serializable' => '\\MongoDB\\BSON\\Serializable',
            ],
            $this->parentIds($interface)
        );
    }

    public function testParentInRootNamespaceKeepsASingleLeadingSeparator()
    {
        $interface = $this->parseSource(null, 'interface Foo extends Countable {}');

        self::assertSame(['Countable' => '\\Countable'], $this->parentIds($interface));
    }

    /**
     * The stored name stays short even when the source writes a qualified parent, so the
     * resolver's short-name fallback still works for stubs whose qualified id does not exist.
     */
    public function testQualifiedParentKeepsShortNameAndQualifiedId()
    {
        $interface = $this->parseSource('Some\\Ns', 'interface Foo extends Other\\Bar {}');

        self::assertSame(['Bar' => '\\Other\\Bar'], $this->parentIds($interface));
    }

    public function testMultipleParentsAreEachResolved()
    {
        $interface = $this->parseSource('Ds', 'interface Collection extends Countable, IteratorAggregate {}');

        self::assertSame(
            ['Countable' => '\\Ds\\Countable', 'IteratorAggregate' => '\\Ds\\IteratorAggregate'],
            $this->parentIds($interface)
        );
    }

    // ── Imported parents ─────────────────────────────────────────────────────

    /**
     * Parses through extractAndParseAll(), the path AllStubsParser uses, because it supplies
     * the `use` statements. parse() deliberately does not — see the note on those tests below.
     */
    private function parseSourceWithImports(string $source): PHPInterface
    {
        $interfaces = $this->parser->extractAndParseAll($source);
        self::assertNotEmpty($interfaces, 'Expected the source to contain an interface.');
        return $interfaces[0];
    }

    /**
     * A `use` statement must win over the declaring namespace, otherwise an imported parent
     * is silently rewritten to a same-namespace name that does not exist.
     */
    public function testImportedParentResolvesToTheImportedNamespace()
    {
        $interface = $this->parseSourceWithImports(<<<'SRC'
<?php
namespace App;
use SomeNamespace\Unserializable;
interface Persistable extends Unserializable {}
SRC);

        self::assertSame(['Unserializable' => '\\SomeNamespace\\Unserializable'], $this->parentIds($interface));
    }

    public function testAliasedImportResolvesToTheTargetAndKeepsTheTargetShortName()
    {
        $interface = $this->parseSourceWithImports(<<<'SRC'
<?php
namespace App;
use SomeNamespace\Unserializable as U;
interface Persistable extends U {}
SRC);

        self::assertSame(['\\SomeNamespace\\Unserializable'], array_values($this->parentIds($interface)));
    }

    /**
     * Importing a global interface is how a stub says "the root-namespace one" — the case
     * `namespace Ds; interface Collection extends Countable` cannot express.
     */
    public function testImportOfAGlobalInterfaceResolvesToTheRootNamespace()
    {
        $interface = $this->parseSourceWithImports(<<<'SRC'
<?php
namespace Ds;
use Countable;
interface Collection extends Countable {}
SRC);

        self::assertSame(['Countable' => '\\Countable'], $this->parentIds($interface));
    }

    /**
     * Guards the trap that makes the tests above necessary: parse() is a convenience wrapper
     * that calls parseNode() with no imports, so it resolves an imported parent against the
     * declaring namespace instead. Production always goes through extractAndParseAll().
     * Asserted so the discrepancy is visible rather than quietly misleading a test author.
     */
    public function testParseWithoutImportsResolvesAgainstTheNamespaceInstead()
    {
        $source = <<<'SRC'
<?php
namespace App;
use SomeNamespace\Unserializable;
interface Persistable extends Unserializable {}
SRC;

        self::assertSame(['Unserializable' => '\\App\\Unserializable'], $this->parentIds($this->parser->parse($source)));
        self::assertSame(['Unserializable' => '\\SomeNamespace\\Unserializable'], $this->parentIds($this->parseSourceWithImports($source)));
    }
}
