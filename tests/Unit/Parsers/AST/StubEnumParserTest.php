<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Parsers\Stubs\StubEnumParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

/**
 * Covers StubEnumParser, with emphasis on the PhpDoc/version metadata it used to discard.
 *
 * parseNode() previously never invoked the PhpDoc or version parser, so enum-level
 * @since / @removed / #[PhpStormStubsElementAvailable] were silently dropped and every
 * stub enum was treated as existing in all PHP versions.
 */
class StubEnumParserTest extends BaseTestCase
{
    private FixtureStubsDataProvider $filesProvider;
    private StubEnumParser $enumParser;

    protected function setUp(): void
    {
        $this->filesProvider = new FixtureStubsDataProvider(__DIR__ . '/fixtures/Enums');
        $this->enumParser = new StubEnumParser();
    }

    private function parseFixture(string $fixtureFile): PHPEnum
    {
        return $this->enumParser->parse($this->filesProvider->getStubFileContent($fixtureFile));
    }

    public function testItReturnsCorrectInstance()
    {
        self::assertInstanceOf(PHPEnum::class, $this->parseFixture('versioned_enum.txt'));
    }

    public function testItParsesNameAndId()
    {
        $enum = $this->parseFixture('versioned_enum.txt');

        self::assertSame('SortDirection', $enum->getName());
        self::assertSame('\SortDirection', $enum->getId());
    }

    public function testItParsesSinceVersionFromPhpDoc()
    {
        self::assertSame('8.6', $this->parseFixture('versioned_enum.txt')->getStubsMetadata()->getSinceVersion());
    }

    public function testItParsesRemovedVersionFromPhpDoc()
    {
        $metadata = $this->parseFixture('removed_enum.txt')->getStubsMetadata();

        self::assertSame('8.1', $metadata->getSinceVersion());
        self::assertSame('8.4', $metadata->getRemovedVersion());
    }

    public function testItRetainsRawPhpDoc()
    {
        $phpDoc = $this->parseFixture('versioned_enum.txt')->getStubsMetadata()->getPhpDoc();

        self::assertNotNull($phpDoc);
        self::assertStringContainsString('@since 8.6', $phpDoc);
    }

    /**
     * The attribute's `to:` bound is inclusive while removedVersion is exclusive, so
     * to: '8.4' means the enum is absent from 8.5 onwards.
     */
    public function testItParsesVersionsFromElementAvailableAttribute()
    {
        $metadata = $this->parseFixture('attributed_enum.txt')->getStubsMetadata();

        self::assertSame('8.2', $metadata->getSinceVersion());
        self::assertSame('8.5', $metadata->getRemovedVersion());
    }

    public function testUndocumentedEnumHasNoVersionConstraints()
    {
        $metadata = $this->parseFixture('undocumented_enum.txt')->getStubsMetadata();

        self::assertNull($metadata->getSinceVersion());
        self::assertNull($metadata->getRemovedVersion());
    }

    public function testItParsesCases()
    {
        self::assertSame(['Ascending', 'Descending'], $this->parseFixture('versioned_enum.txt')->getCaseNames());
    }

    public function testItParsesConstantsAndMethods()
    {
        $enum = $this->parseFixture('versioned_enum.txt');

        self::assertCount(1, $enum->getConstants());
        self::assertSame('DEFAULT_DIRECTION', $enum->getConstants()[0]->getName());
        self::assertCount(1, $enum->getMethods());
        self::assertSame('label', $enum->getMethods()[0]->getName());
    }

    public function testItParsesImplementedInterfaces()
    {
        $names = array_map(
            static fn ($interface) => $interface->getName(),
            $this->parseFixture('versioned_enum.txt')->getImplementedInterfaces()
        );

        self::assertContains('UnitEnum', $names);
    }

    /**
     * PHP has no `final enum` syntax and ReflectionClass::isFinal() reports false for
     * enums, so stubs must report false too.
     */
    public function testEnumIsNotReportedFinal()
    {
        $enum = $this->parseFixture('versioned_enum.txt');

        self::assertFalse($enum->isFinal());
        self::assertFalse($enum->isReadonly());
    }

    public function testItParsesNamespacedEnumId()
    {
        self::assertSame('\Test\AttributedEnum', $this->parseFixture('attributed_enum.txt')->getId());
    }

    // ── Implemented interface ids ────────────────────────────────────────────

    /**
     * Parses via extractAndParseAll() because that is the path AllStubsParser uses and the
     * only one that supplies `use` statements.
     *
     * @return array<string, string|null> interface short name => resolved id
     */
    private function interfaceIds(string $source): array
    {
        $enums = $this->enumParser->extractAndParseAll($source);
        self::assertNotEmpty($enums, 'Expected the source to contain an enum.');

        $ids = [];
        foreach ($enums[0]->getImplementedInterfaces() as $i) {
            $ids[$i->getName()] = $i->getId();
        }
        return $ids;
    }

    /**
     * A fully qualified interface must keep its root-namespace id. Name::toString() drops the
     * leading separator, so without the adapters preserving it this became `\Dom\BackedEnum`
     * — a namespace-relative id for something the source wrote as global.
     */
    public function testFullyQualifiedInterfaceKeepsItsRootNamespaceId()
    {
        $source = "<?php\nnamespace Dom;\nenum AdjacentPosition: string implements \\BackedEnum, \\UnitEnum { case A = 'a'; }";

        self::assertSame(['BackedEnum' => '\BackedEnum', 'UnitEnum' => '\UnitEnum'], $this->interfaceIds($source));
    }

    /**
     * An unqualified interface still resolves within the declaring namespace, so a
     * same-namespace interface is not shadowed by a global one of the same name.
     */
    public function testUnqualifiedInterfaceResolvesWithinTheDeclaringNamespace()
    {
        $source = "<?php\nnamespace App\\Bson;\nenum Kind implements Serializable { case A; }";

        self::assertSame(['Serializable' => '\App\Bson\Serializable'], $this->interfaceIds($source));
    }

    public function testImportedInterfaceResolvesToTheImportedNamespace()
    {
        $source = "<?php\nnamespace App;\nuse Other\\Marker;\nenum Kind implements Marker { case A; }";

        self::assertSame(['Marker' => '\Other\Marker'], $this->interfaceIds($source));
    }

    public function testRootNamespaceEnumKeepsGlobalInterfaceIds()
    {
        $source = "<?php\nenum Kind implements \\UnitEnum { case A; }";

        self::assertSame(['UnitEnum' => '\UnitEnum'], $this->interfaceIds($source));
    }
}
