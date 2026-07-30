<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassConstant;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Model\PHPParameter;
use StubTests\Framework\Model\PHPProperty;

/**
 * Pins the declared parse() return type of every reflection parser.
 *
 * Commit acf8d343 removed nine `instanceof` / `assertNotNull` assertions from the reflection
 * parser tests on the grounds that "the declared return type already guarantees the model class,
 * so asserting instanceof could never fail". That is true only while the declaration exists — it
 * is an incidental guarantee, not an enforced one. The replacement assertions it added cover
 * something else entirely (that each call returns its own model rather than a memoised one), so
 * after that commit nothing stated the return-type contract at all.
 *
 * `assertInstanceOf` would not have restored it either: it keeps passing when `: PHPClass` is
 * dropped, as long as the body still happens to return the right object. This asserts the
 * declaration itself, which is the part that can actually change.
 *
 * One data-driven test rather than nine near-identical ones — acf8d343 copy-pasted the same
 * four-line docblock across five files, and a new parser only has to be added to the map below.
 */
class ReflectionParserReturnTypeContractTest extends TestCase
{
    private const PARSER_NAMESPACE = 'StubTests\\Framework\\Parsers\\Reflection\\';

    /**
     * Parser short name => the model class its parse() must return, non-nullable.
     *
     * ReflectionTypeParser is deliberately absent: its parse() returns a type *string* and has no
     * declared return type, so it has no model contract to pin. testEveryReflectionParserIsCovered()
     * enforces that it is the only exemption.
     */
    private const EXPECTED_RETURN_TYPES = [
        'ReflectionClassConstantParser' => PHPClassConstant::class,
        'ReflectionClassParser' => PHPClass::class,
        'ReflectionDefineConstantParser' => PHPConstant::class,
        'ReflectionEnumParser' => PHPEnum::class,
        'ReflectionFunctionParser' => PHPFunction::class,
        'ReflectionImplementedInterfaceParser' => PHPInterface::class,
        'ReflectionInterfaceParser' => PHPInterface::class,
        'ReflectionMethodParser' => PHPMethod::class,
        'ReflectionModernConstantParser' => PHPConstant::class,
        'ReflectionParameterParser' => PHPParameter::class,
        'ReflectionParentClassParser' => PHPClass::class,
        'ReflectionPropertyParser' => PHPProperty::class,
    ];
    private const UNTYPED_BY_DESIGN = ['ReflectionTypeParser'];

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function parserProvider(): iterable
    {
        foreach (self::EXPECTED_RETURN_TYPES as $parser => $model) {
            yield $parser => [$parser, $model];
        }
    }

    #[DataProvider('parserProvider')]
    public function testParseDeclaresItsModelReturnTypeNonNullable(string $parser, string $expectedModel): void
    {
        $returnType = (new \ReflectionMethod(self::PARSER_NAMESPACE . $parser, 'parse'))->getReturnType();

        self::assertInstanceOf(
            \ReflectionNamedType::class,
            $returnType,
            "{$parser}::parse() must keep a single named return type"
        );
        self::assertSame(
            $expectedModel,
            $returnType->getName(),
            "{$parser}::parse() must keep returning {$expectedModel}"
        );
        self::assertFalse(
            $returnType->allowsNull(),
            "{$parser}::parse() must stay non-nullable — callers dereference the result directly"
        );
    }

    /**
     * Keeps the map above from going stale: a parser added without an entry would otherwise be
     * silently unpinned, which is the exact gap this test class exists to close.
     */
    public function testEveryReflectionParserIsCovered(): void
    {
        $files = glob(dirname(__DIR__, 3) . '/Framework/Parsers/Reflection/Reflection*Parser.php') ?: [];
        self::assertNotEmpty($files, 'Found no reflection parsers — the discovery glob is stale.');

        $discovered = array_map(fn (string $f) => basename($f, '.php'), $files);
        $accountedFor = array_merge(array_keys(self::EXPECTED_RETURN_TYPES), self::UNTYPED_BY_DESIGN);

        sort($discovered);
        sort($accountedFor);

        self::assertSame(
            $accountedFor,
            $discovered,
            'Every Reflection*Parser must be listed in EXPECTED_RETURN_TYPES (or UNTYPED_BY_DESIGN).'
        );
    }
}
