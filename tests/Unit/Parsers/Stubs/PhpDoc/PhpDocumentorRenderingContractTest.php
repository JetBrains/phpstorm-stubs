<?php

namespace StubTests\Unit\Parsers\Stubs\PhpDoc;

use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\Context;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;

/**
 * Asserts the assumptions this repository makes about phpdocumentor/type-resolver, rather than
 * about our own output.
 *
 * The stub parsers store phpDocumentor's rendering of a type verbatim, so a change in how the
 * library stringifies types rewrites tests/cache/*.json wholesale. Without this file such a change
 * surfaces only as a scattering of opaque string diffs in unrelated parser tests — which is exactly
 * how the 5.6 → 6.0 bump presented: six failures that each looked like a local expectation being
 * stale, when in fact one upstream commit had changed the rendering of every generic.
 *
 * Two properties are pinned:
 *
 * 1. Idempotency — resolving a rendered type must reproduce that rendering exactly. This is the
 *    general test for lossless rendering and the one {@see PhpDocumentorParser::preferFaithfulType()}
 *    relies on, so a regression here silently changes which types get recovered from raw text.
 * 2. Spacing — type arguments are separated by `, `. Cosmetic, but it is baked into the parsed
 *    cache, so it should change deliberately and not as a surprise.
 */
class PhpDocumentorRenderingContractTest extends TestCase
{
    private TypeResolver $resolver;
    private Context $context;

    protected function setUp(): void
    {
        $this->resolver = new TypeResolver();
        // Matches the context DocBlockFactory::createInstance() resolves against.
        $this->context = new Context('');
    }

    /**
     * The type shapes the stub tree actually uses, one per construct.
     *
     * @return array<string, array{0: string}>
     */
    public static function typeShapes(): array
    {
        return [
            'scalar' => ['int'],
            'union' => ['string|int|null'],
            'intersection' => ['\Countable&\Traversable'],
            'nullable shorthand' => ['?string'],
            'simple array suffix' => ['string[]'],
            'nested array suffix' => ['int[][]'],
            'array value only' => ['array<string>'],
            'array key and value' => ['array<int, string>'],
            'nested generic' => ['array<string, list<int>>'],
            'three-arg generic' => ['\Iterator<int, string, mixed>'],
            'four-arg generic' => ['\Generator<int, list<string>, void, void>'],
            'iterable generic' => ['iterable<int, string>'],
            'list' => ['list<string>'],
            'non-empty-array' => ['non-empty-array<int, string>'],
            'array shape' => ['array{a: int, b?: string}'],
            'object shape' => ['object{a: int}'],
            'list shape' => ['list{int, string}'],
            'int range' => ['int<0, max>'],
            'int mask' => ['int-mask<1, 2, 4>'],
            'class-string generic' => ['class-string<\Throwable>'],
            'callable signature' => ['callable(int, string): void'],
            'closure signature' => ['\Closure(int): string'],
            'callable in union' => ['callable(int): int|null'],
            'key-of' => ['key-of<\Foo::BAR>'],
            'conditional' => ['($x is true ? int : string)'],
            'generic with class arg' => ['array<\ReflectionAttribute<\T>>'],
        ];
    }

    /**
     * A rendered type must survive being fed back to the resolver unchanged.
     *
     * Note this pins rendering stability, not round-tripping of the *input*: normalisation such as
     * FQN-prefixing a bare identifier or rewriting `T[]` as `array<T>` legitimately changes the
     * string on the first pass. Only the second pass must be a no-op.
     */
    #[DataProvider('typeShapes')]
    public function testRenderingIsIdempotent(string $type): void
    {
        $rendered = (string)$this->resolver->resolve($type, $this->context);
        $reRendered = (string)$this->resolver->resolve($rendered, $this->context);

        self::assertSame(
            $rendered,
            $reRendered,
            "Rendering of '$type' is not a fixed point, so it loses information."
        );
    }

    /**
     * Pins the one rendering defect this repository works around, so that its *fix* is noticed.
     *
     * `Array_::__toString()` appends `[]` to the rendered element type whenever that string already
     * ends in `[]`, instead of falling through to the unambiguous `array<…>` branch. For a compound
     * element that changes the type: `A|B[]` parses as `A|(B[])`, never as `(A|B)[]`. type-resolver
     * 1.x rendered these correctly via an explicit `instanceof Compound` branch, dropped in upstream
     * commit cbc0615 ("Move the logic of `AbstractList::__toString()` to `Array_::__toString()`").
     *
     * {@see PhpDocumentorParser::rendersCompoundArrayAmbiguously()} detects the shape from the
     * resolved object graph and keeps the raw docblock text instead. When this test starts failing,
     * upstream has fixed the rendering and that workaround — plus the corresponding cases in
     * {@see PhpDocumentorParserTypeRecoveryTest} — can be removed.
     */
    public function testCompoundArrayElementRenderingIsStillAmbiguousUpstream(): void
    {
        $rendered = (string)$this->resolver->resolve('(int|string[])[]', $this->context);

        self::assertSame(
            'int|string[][]',
            $rendered,
            'phpDocumentor appears to render compound array element types correctly now; '
            . 'PhpDocumentorParser::rendersCompoundArrayAmbiguously() can probably be dropped.'
        );
    }

    /**
     * @return array<string, array{0: string, 1: string}>
     */
    public static function argumentSpacing(): array
    {
        return [
            'array key+value' => ['array<int,string>', 'array<int, string>'],
            'iterable key+value' => ['iterable<int,string>', 'iterable<int, string>'],
            'generic class' => ['\Generator<int,string>', '\Generator<int, string>'],
            'three-arg generic' => ['\Iterator<int,string,mixed>', '\Iterator<int, string, mixed>'],
            'int range' => ['int<0,max>', 'int<0, max>'],
            'int mask' => ['int-mask<1,2,4>', 'int-mask<1, 2, 4>'],
            'array shape' => ['array{a: int,b: string}', 'array{a: int, b: string}'],
        ];
    }

    /**
     * Type arguments are rendered `, `-separated regardless of the input spacing.
     *
     * type-resolver 1.x emitted a bare `,` for arrays, iterables and collections while already
     * using `, ` for shapes, int ranges and int masks; 2.0 normalised everything to `, `
     * (upstream commit 492a638, "Improve the conversion of lists to strings"), matching
     * phpstan/phpdoc-parser's own stringification.
     */
    #[DataProvider('argumentSpacing')]
    public function testTypeArgumentsAreCommaSpaceSeparated(string $input, string $expected): void
    {
        self::assertSame($expected, (string)$this->resolver->resolve($input, $this->context));
    }
}
