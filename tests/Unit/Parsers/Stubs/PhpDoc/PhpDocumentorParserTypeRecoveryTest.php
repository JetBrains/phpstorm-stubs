<?php

namespace StubTests\Unit\Parsers\Stubs\PhpDoc;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;

/**
 * Regression tests for {@see PhpDocumentorParser} faithfully preserving types that phpDocumentor
 * renders lossily.
 *
 * Historically the loss was structural: phpDocumentor modelled a collection as `Base<value>` or
 * `Base<key, value>` only, so generics with more than two type arguments were truncated and
 * reordered — `\Generator<int, list<string>, void, void>` came out as `\Generator<void,void>`.
 * reflection-docblock 6 / type-resolver 2 replaced that value object with a real generic type, so
 * argument counts now survive.
 *
 * What remains is rendering loss, and the parser detects it generically by checking whether
 * phpDocumentor's output is a fixed point — see {@see PhpDocumentorParser::preferFaithfulType()}.
 * Types it renders correctly are left untouched so the parsed cache does not churn.
 */
class PhpDocumentorParserTypeRecoveryTest extends TestCase
{
    private PhpDocumentorParser $parser;

    protected function setUp(): void
    {
        $this->parser = new PhpDocumentorParser();
    }

    private function returnTypeOf(string $type): ?string
    {
        return $this->parser->parseDocComment("/**\n * @return $type\n */")->returnType;
    }

    /**
     * The motivating case: a four-argument Generator must not lose its key/value/send types.
     */
    public function testGeneratorWithFourArgumentsIsRecoveredVerbatim(): void
    {
        self::assertSame(
            '\Generator<int, list<string>, void, void>',
            $this->returnTypeOf('\Generator<int, list<string>, void, void>')
        );
    }

    /**
     * @return list<array{0: string}>
     */
    public static function recoveredMultiArgGenerics(): array
    {
        return [
            ['\Generator<int, list<string>, void, void>'],
            ['\Generator<int, string, mixed, void>'],
        ];
    }

    #[DataProvider('recoveredMultiArgGenerics')]
    public function testMultiArgumentGenericsArePreservedVerbatim(string $type): void
    {
        self::assertSame($type, $this->returnTypeOf($type));
    }

    /**
     * A bare identifier is a class name as far as phpDocumentor is concerned, so it renders
     * FQN-prefixed. This parser deliberately does not undo that: only the stub parsers know which
     * names are `@template` parameters, and they delegate the unqualification to
     * {@see \StubTests\Framework\PhpDoc\TemplateTypeNormalizer}.
     *
     * `\Iterator<int, TNode, mixed>` used to be recovered verbatim here, hiding the prefix, because
     * phpDocumentor truncated three-argument generics; it no longer does.
     */
    public function testBareIdentifiersKeepPhpDocumentorsFqnPrefix(): void
    {
        self::assertSame('\Iterator<int, \TNode, mixed>', $this->returnTypeOf('\Iterator<int, TNode, mixed>'));
    }

    /**
     * Types phpDocumentor renders correctly must be left as-is so the parsed cache does not churn.
     *
     * @return list<array{0: string, 1: string}>
     */
    public static function nonLossyTypes(): array
    {
        return [
            'two-arg generator' => ['\Generator<int, string>', '\Generator<int, string>'],
            'array key+value' => ['array<int, string>', 'array<int, string>'],
            'single-arg list' => ['list<string>', 'list<string>'],
            'int range' => ['int<0, max>', 'int<0, max>'],
            'plain union' => ['string|int', 'string|int'],
            'scalar' => ['bool', 'bool'],
            // phpDocumentor drops parentheses it considers redundant; the union structure is
            // unchanged, so its rendering is kept.
            'parenthesised callable in union' => [
                '(callable(TValue, TValue): int)|null',
                'callable(\TValue, \TValue): int|null',
            ],
        ];
    }

    #[DataProvider('nonLossyTypes')]
    public function testNonLossyTypesAreNotRewritten(string $type, string $expected): void
    {
        self::assertSame($expected, $this->returnTypeOf($type));
    }

    /**
     * The recovery applies to @param as well, not only @return.
     */
    public function testMultiArgumentGenericParamIsRecoveredVerbatim(): void
    {
        $doc = "/**\n * @param \Generator<int, list<string>, void, void> \$gen\n */";
        $parsed = $this->parser->parseDocComment($doc);

        self::assertSame('\Generator<int, list<string>, void, void>', $parsed->paramTypes['gen'] ?? null);
    }

    /**
     * The live rendering-loss case, from `getopt()` in standard/standard_3.php.
     *
     * phpDocumentor's `Array_::__toString()` only reaches its `array<…>` branch when the rendered
     * element type does not already end in `[]`. A compound element type that does — here
     * `string|false|string[]|false[]` — takes the `$element . '[]'` branch instead, producing
     * `string|false|string[]|false[][]`: the outer array binds to the last union member only, and
     * re-parsing that string drops the trailing `|false` entirely. The raw docblock must win.
     *
     * @return list<array{0: string}>
     */
    public static function lossyArrayRenderings(): array
    {
        return [
            ['(string|false|string[]|false[])[]|false'],
            ['(int|string[])[]'],
        ];
    }

    #[DataProvider('lossyArrayRenderings')]
    public function testCompoundArrayElementTypesAreRecoveredVerbatim(string $type): void
    {
        self::assertSame($type, $this->returnTypeOf($type));
    }

    /**
     * The compound-element check over-approximates on purpose, so a form phpDocumentor *would* have
     * rendered correctly — `(string|false)[]` becomes `array<string|false>`, its element string not
     * ending in `[]` — keeps the author's text instead. Both spellings are unambiguous, and avoiding
     * the false positive would mean re-deriving which branch `Array_::__toString()` took.
     *
     * Locked so the choice is visible rather than incidental: no stub currently writes this form, so
     * nothing else would notice it changing.
     */
    public function testCorrectlyRenderableCompoundArraysAlsoKeepTheRawText(): void
    {
        self::assertSame('(string|false)[]', $this->returnTypeOf('(string|false)[]'));
    }
}
