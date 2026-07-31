<?php

namespace StubTests\Unit\Validator\Services;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Services\PhpStanTypeNormalizer;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * The lexical half of the PhpDoc conformance check: turning a phpstan/psalm annotation into the plain
 * PHP type it refines.
 *
 * The leaf table here grows every time a stub picks up a new psalm annotation, so the tests that
 * matter most are the ones that constrain *future* entries rather than re-state today's:
 * testEveryLeafMapsToATypeThatSurvivesNormalisation walks the table itself, so a new row with a
 * typo'd or still-phpstan-flavoured target fails without anyone remembering to add a case.
 */
class PhpStanTypeNormalizerTest extends TestCase
{
    /**
     * Every mapped leaf must resolve to something that is *already* plain PHP — feeding the target
     * back through strip() has to be a no-op. A row like `'even-int' => 'positive-int'`, whose target
     * is itself still a phpstan leaf, is caught here rather than as a puzzling conformance failure in
     * one stub.
     *
     * Note what this cannot catch on its own: a *typo'd* target such as `'list' => 'aray'` is stable
     * under strip() (nothing maps it, so it survives untouched) and so passes both assertions below.
     * That case is testEveryLeafTargetIsAPlainPhpType's job.
     */
    #[DataProvider('leafTokens')]
    public function testEveryLeafMapsToATypeThatSurvivesNormalisation(string $leaf): void
    {
        $mapped = PhpStanTypeNormalizer::strip($leaf);

        self::assertNotSame($leaf, $mapped, "leaf '{$leaf}' is in the table but was left unmapped");
        self::assertSame($mapped, PhpStanTypeNormalizer::strip($mapped), "'{$leaf}' maps to '{$mapped}', which is not itself plain PHP");
    }

    /**
     * A leaf's target must name a type PHP actually has: a primitive, or a class that exists.
     *
     * This is the assertion that catches a misspelled target. `'list' => 'aray'` looks harmless —
     * every other test still passes, because an unrecognised token is left alone by every rule in
     * strip(). It would then reach the compatibility relation as a *class name*, so `array` in the
     * signature versus `list<Foo>` in the doc would be reported as a mismatch on every stub using it.
     *
     * @param string $target the union the leaf maps to, e.g. 'int|string'
     */
    #[DataProvider('leafMappings')]
    public function testEveryLeafTargetIsAPlainPhpType(string $leaf, string $target): void
    {
        foreach (explode('|', $target) as $component) {
            $isPrimitive = in_array($component, TypeResolver::PRIMITIVES, true);
            // A class target is written FQN ('\Closure'); class_exists wants it without the root slash.
            $isRealClass = str_starts_with($component, '\\') && class_exists(ltrim($component, '\\'));

            self::assertTrue(
                $isPrimitive || $isRealClass,
                "leaf '{$leaf}' maps to '{$target}', whose component '{$component}' is neither a PHP primitive nor an existing class"
            );
        }
    }

    public static function leafMappings(): array
    {
        $cases = [];
        foreach (self::leafMap() as $leaf => $target) {
            $cases[$leaf] = [$leaf, $target];
        }

        return $cases;
    }

    /** A mapped leaf must still be mapped when it appears inside a generic or an array suffix. */
    #[DataProvider('leafTokens')]
    public function testEveryLeafIsMappedInsideWrappers(string $leaf): void
    {
        // `array<T>` keeps only the outer token; `T[]` collapses to array. Neither may leak the leaf.
        self::assertStringNotContainsString($leaf, PhpStanTypeNormalizer::normalize("array<{$leaf}>"));
        self::assertSame('array', PhpStanTypeNormalizer::normalize("{$leaf}[]"));
    }

    /**
     * The table itself, read rather than restated, so a new row is covered the moment it is added.
     *
     * Raised as an exception, not an assertion: a data provider must not assert. A rename that
     * silently yielded an empty provider would otherwise report as a passing run with zero cases.
     *
     * @return array<string, string>
     */
    private static function leafMap(): array
    {
        $map = (new \ReflectionClass(PhpStanTypeNormalizer::class))->getConstant('LEAF_MAP');
        if (!is_array($map) || $map === []) {
            throw new \LogicException('LEAF_MAP disappeared or was renamed');
        }

        return $map;
    }

    public static function leafTokens(): array
    {
        $cases = [];
        foreach (array_keys(self::leafMap()) as $leaf) {
            // 'array' and 'iterable' map to themselves — they are plain PHP already and are listed
            // only so the callback leaves them alone. They cannot satisfy the "must change" assertion.
            if (in_array($leaf, ['array', 'iterable'], true)) {
                continue;
            }
            $cases[$leaf] = [$leaf];
        }

        return $cases;
    }

    #[DataProvider('strippedForms')]
    public function testStripsPhpStanSyntaxDownToPlainPhp(string $input, string $expected): void
    {
        self::assertSame($expected, PhpStanTypeNormalizer::strip($input));
    }

    public static function strippedForms(): array
    {
        return [
            // A conditional return type cannot be evaluated statically, so it widens to mixed.
            'conditional return' => ['($x is Y ? A : B)', 'mixed'],
            'conditional, real' => ['($value is string ? int : never)', 'mixed'],

            // Callable/Closure signatures reduce to the bare keyword.
            'callable signature' => ['callable(string): bool', 'callable'],
            'callable, two args' => ['callable(int, string): void', 'callable'],
            'callable, nested' => ['callable(callable(int): bool): bool', 'callable'],
            'closure signature' => ['Closure(int): string', 'Closure'],
            'closure, leading slash' => ['\\Closure(array $a): \\Generator', 'Closure'],

            // PhpDoc sometimes borrows the signature's nullable shorthand.
            'nullable shorthand' => ['?string', 'string|null'],

            // Generics and array shapes are stripped iteratively, so nesting is handled.
            'generic' => ['array<string, int>', 'array'],
            'generic, nested' => ['array<int, array<string, bool>>', 'array'],
            'shape' => ['array{foo: int, bar: string}', 'array'],
            'shape, nested' => ['array{0: int, 1: array{a: bool}}', 'array'],

            // Typed-array suffix, at any depth.
            'typed array' => ['string[]', 'array'],
            'typed array, 2d' => ['int[][]', 'array'],
            'typed array, class' => ['\\Foo[]', 'array'],

            // Class-constant value types are a value-level refinement the check cannot evaluate.
            'class constant' => ['\\Foo\\Bar::BAZ', 'mixed'],
            'class constant family' => ['Foo::BAR_*', 'mixed'],

            // mixed absorbs the whole union, however it arrives.
            'mixed in union' => ['string|mixed', 'mixed'],
            'mixed via value-of' => ['value-of<Foo::CASES>', 'mixed'],
            'mixed in parens' => ['(mixed)', 'mixed'],

            // Plain PHP passes through untouched, including whitespace trimming.
            'plain scalar' => ['string', 'string'],
            'plain union' => ['int|string', 'int|string'],
            'padded' => ['  string  ', 'string'],
            'class name' => ['\\DateTimeInterface', '\\DateTimeInterface'],
            'empty' => ['', ''],

            // A template variable is not a phpstan leaf and must survive for the caller to recognise.
            'template variable' => ['T', 'T'],
            'template, qualified' => ['\\T', '\\T'],
        ];
    }

    /**
     * normalize() is strip() plus the shared type normalisation, so union ordering and the FQN
     * backslash are applied on top. Kept separate from strip() so a change to either is attributable.
     */
    #[DataProvider('normalizedForms')]
    public function testNormalizeAppliesSharedTypeNormalisationOnTop(string $input, string $expected): void
    {
        self::assertSame($expected, PhpStanTypeNormalizer::normalize($input));
    }

    public static function normalizedForms(): array
    {
        return [
            'sorts a union' => ['string|int', 'int|string'],
            'nullable shorthand sorts too' => ['?string', 'null|string'],
            'generic then sort' => ['array<string, int>', 'array'],
            'leaf then sort' => ['numeric-string|positive-int', 'int|string'],
            'array-key expands to a union' => ['array-key', 'int|string'],
        ];
    }
}
