<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Framework\Parsers\Stubs\Versions\DeprecationParser;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

/**
 * Covers extraction of the deprecation version — `#[Deprecated(since:)]` and
 * `@_deprecated <version>` — into StubsMetadata::getDeprecatedSinceVersion().
 *
 * Parsing goes through extractAndParseAll() rather than the single-entity parse() convenience
 * method, because only the former supplies the import map. Resolving `Deprecated` through
 * imports is what distinguishes the JetBrains attribute from the built-in one, and the two
 * order their positional arguments differently.
 */
class DeprecationParserTest extends BaseTestCase
{
    private StubFunctionParser $functionParser;
    private StubClassParser $classParser;
    private FixtureStubsDataProvider $filesProvider;

    protected function setUp(): void
    {
        $this->functionParser = new StubFunctionParser();
        $this->classParser = new StubClassParser();
        $this->filesProvider = new FixtureStubsDataProvider(__DIR__ . '/fixtures/Deprecation');
    }

    /**
     * Attribute forms are single-line variants of one construct, so the code stays next to the
     * version it is expected to yield. The PhpDoc forms need a docblock and live in fixtures —
     * see {@see phpDocDeprecationProvider}.
     */
    public static function attributeDeprecationProvider(): array
    {
        return [
            'not deprecated' => [
                '<?php function f(): void {}',
                false,
                null,
            ],
            'JetBrains attribute, named since' => [
                '<?php use JetBrains\PhpStorm\Deprecated; #[Deprecated("reason", since: "8.4")] function f(): void {}',
                true,
                '8.4',
            ],
            'JetBrains attribute, no since' => [
                '<?php use JetBrains\PhpStorm\Deprecated; #[Deprecated("reason")] function f(): void {}',
                true,
                null,
            ],
            'JetBrains attribute, bare' => [
                '<?php use JetBrains\PhpStorm\Deprecated; #[Deprecated] function f(): void {}',
                true,
                null,
            ],
            // JetBrains signature is ($reason, $replacement, $since) — since is argument 2.
            'JetBrains attribute, positional since' => [
                '<?php use JetBrains\PhpStorm\Deprecated; #[Deprecated("reason", "replacement", "8.4")] function f(): void {}',
                true,
                '8.4',
            ],
            'JetBrains attribute, fully qualified' => [
                '<?php #[\JetBrains\PhpStorm\Deprecated(since: "7.3")] function f(): void {}',
                true,
                '7.3',
            ],
            'built-in attribute, bare' => [
                '<?php #[Deprecated] function f(): void {}',
                true,
                null,
            ],
            'built-in attribute, named since' => [
                '<?php #[Deprecated(message: "msg", since: "8.5")] function f(): void {}',
                true,
                '8.5',
            ],
            // Built-in signature is ($message, $since) — since is argument 1, not 2.
            'built-in attribute, positional since' => [
                '<?php #[Deprecated("msg", "8.4")] function f(): void {}',
                true,
                '8.4',
            ],
        ];
    }

    #[DataProvider('attributeDeprecationProvider')]
    public function testItParsesDeprecationFromAttributes(string $stubCode, bool $expectedDeprecated, ?string $expectedSince)
    {
        $function = $this->functionParser->extractAndParseAll($stubCode)[0];

        self::assertSame($expectedDeprecated, $function->isDeprecated());
        self::assertSame($expectedSince, $function->getStubsMetadata()?->getDeprecatedSinceVersion());
    }

    public static function phpDocDeprecationProvider(): array
    {
        return [
            'PhpDoc tag with PHP version' => ['phpdoc_php_version.txt', '7.1'],
            'PhpDoc tag with patch version narrows to the minor' => ['phpdoc_patch_version.txt', '7.0'],
            // A library version in that slot must not be read as a language level.
            'PhpDoc tag with library version' => ['phpdoc_library_version.txt', null],
            'PhpDoc tag without version' => ['phpdoc_without_version.txt', null],
            'attribute overrides PhpDoc tag' => ['attribute_overrides_phpdoc.txt', '8.0'],
            'attribute without since does not clear the PhpDoc version' => ['attribute_without_since_keeps_phpdoc.txt', '7.1'],
        ];
    }

    #[DataProvider('phpDocDeprecationProvider')]
    public function testItParsesDeprecationFromPhpDoc(string $fixtureFile, ?string $expectedSince)
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        $function = $this->functionParser->extractAndParseAll($stubCode)[0];

        self::assertTrue($function->isDeprecated());
        self::assertSame($expectedSince, $function->getStubsMetadata()?->getDeprecatedSinceVersion());
    }

    public function testItParsesMethodDeprecationVersion()
    {
        $stubCode = '<?php use JetBrains\PhpStorm\Deprecated; class C { #[Deprecated("reason", since: "8.4")] public function m(): void {} }';
        $method = $this->classParser->extractAndParseAll($stubCode)[0]->getMethods()[0];

        self::assertTrue($method->isDeprecated());
        self::assertSame('8.4', $method->getStubsMetadata()?->getDeprecatedSinceVersion());
    }

    public function testItParsesParameterDeprecationVersion()
    {
        $stubCode = '<?php use JetBrains\PhpStorm\Deprecated; class C { public function m(#[Deprecated(since: "8.2")] $p, $q): void {} }';
        $parameters = $this->classParser->extractAndParseAll($stubCode)[0]->getMethods()[0]->getParameters();

        self::assertTrue($parameters[0]->isDeprecated());
        self::assertSame('8.2', $parameters[0]->getStubsMetadata()?->getDeprecatedSinceVersion());

        self::assertFalse($parameters[1]->isDeprecated());
        self::assertNull($parameters[1]->getStubsMetadata()?->getDeprecatedSinceVersion());
    }

    /**
     * A version is only carried when the element is actually deprecated, so a stale `@_deprecated`
     * version can never leak onto a non-deprecated element.
     */
    public function testItLeavesTheVersionNullWhenNotDeprecated()
    {
        $function = $this->functionParser->extractAndParseAll('<?php /** @since 7.0 */ function f(): void {}')[0];

        self::assertFalse($function->isDeprecated());
        self::assertNull($function->getStubsMetadata()?->getDeprecatedSinceVersion());
    }

    public static function phpVersionNormalizationProvider(): array
    {
        return [
            'known minor' => ['8.4', '8.4'],
            'earliest supported' => ['5.6', '5.6'],
            'patch narrows to minor' => ['7.0.7', '7.0'],
            'PHP version older than the suite covers' => ['5.3', null],
            'library version' => ['2.3.0', null],
            // Deliberately a version that can never be added to PhpVersions. Using a plausible
            // next release (9.0) would turn this case into a false failure the day it ships.
            'unrecognised version' => ['99.0', null],
            'not a version' => ['use g() instead', null],
            'empty' => ['', null],
        ];
    }

    #[DataProvider('phpVersionNormalizationProvider')]
    public function testItAcceptsOnlyKnownPhpVersionsFromPhpDoc(string $version, ?string $expected)
    {
        self::assertSame($expected, DeprecationParser::normalizePhpVersion($version));
    }

    /**
     * Guards the boundary the filter silently depends on. If the newest supported version ever
     * stopped being recognised, every `@_deprecated <newest>` would collapse to null — i.e. to
     * "deprecated in every version" — which is the widest possible claim and the opposite of
     * what the tag says. The failure would otherwise be silent.
     */
    public function testItAcceptsTheNewestAndOldestSupportedPhpVersions()
    {
        $latest = PhpVersions::LATEST->value;
        $earliest = PhpVersions::EARLIEST->value;

        self::assertSame($latest, DeprecationParser::normalizePhpVersion($latest));
        self::assertSame($earliest, DeprecationParser::normalizePhpVersion($earliest));
    }
}
