<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Reflection\ReflectionClassConstantParser;
use StubTests\Framework\Parsers\Reflection\ReflectionClassParser;
use StubTests\Framework\Parsers\Reflection\ReflectionDefineConstantParser;
use StubTests\Framework\Parsers\Reflection\ReflectionEnumParser;
use StubTests\Framework\Parsers\Reflection\ReflectionFunctionParser;
use StubTests\Framework\Parsers\Reflection\ReflectionImplementedInterfaceParser;
use StubTests\Framework\Parsers\Reflection\ReflectionInterfaceParser;
use StubTests\Framework\Parsers\Reflection\ReflectionMethodParser;
use StubTests\Framework\Parsers\Reflection\ReflectionParameterParser;
use StubTests\Framework\Parsers\Reflection\ReflectionParentClassParser;
use StubTests\Framework\Parsers\Reflection\ReflectionPropertyParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionFunction;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;

/**
 * Dispatch contract for the reflection parsers' canParse().
 *
 * canParse() was covered only for ReflectionEnumParser and ReflectionInterfaceParser, even though
 * EntityReflectionObjectParsersRegistry routes every reflected object purely on its result. The
 * three class-like parsers form a partition of AdaptedReflectionClass on (isInterface, isEnum), so
 * the property that matters is not just "the right one accepts" but "**exactly one** accepts" —
 * an overlap would make dispatch order-dependent and a gap would silently drop entities.
 *
 * The remaining parsers are sub-parsers invoked directly by their owners, and return false
 * unconditionally so they can never claim a dispatch slot. That is pinned too, because a
 * well-meaning "implement this properly" would introduce an overlap.
 */
class ReflectionParserDispatchTest extends TestCase
{
    /** @return list<object> the three parsers that participate in class-like dispatch */
    private function classLikeParsers(): array
    {
        return [new ReflectionClassParser(), new ReflectionEnumParser(), new ReflectionInterfaceParser()];
    }

    private function adaptedClass(bool $internal, bool $interface, bool $enum): AdaptedReflectionClass
    {
        $stub = $this->createStub(AdaptedReflectionClass::class);
        $stub->method('isInternal')->willReturn($internal);
        $stub->method('isInterface')->willReturn($interface);
        $stub->method('isEnum')->willReturn($enum);
        return $stub;
    }

    /** @return list<string> short names of the parsers accepting $object */
    private function acceptedBy(mixed $object): array
    {
        $accepting = [];
        foreach ($this->classLikeParsers() as $parser) {
            if ($parser->canParse($object)) {
                $accepting[] = (new \ReflectionClass($parser))->getShortName();
            }
        }
        return $accepting;
    }

    #[DataProvider('classLikeShapes')]
    public function testExactlyTheExpectedParserClaimsEachClassLikeShape(
        bool $internal,
        bool $interface,
        bool $enum,
        array $expected
    ) {
        $accepted = $this->acceptedBy($this->adaptedClass($internal, $interface, $enum));

        self::assertSame($expected, $accepted);
    }

    public static function classLikeShapes(): array
    {
        return [
            'internal plain class' => [true, false, false, ['ReflectionClassParser']],
            'internal interface' => [true, true, false, ['ReflectionInterfaceParser']],
            'internal enum' => [true, false, true, ['ReflectionEnumParser']],
            // userland entities are not reflected into the caches at all
            'userland class' => [false, false, false, []],
            'userland interface' => [false, true, false, []],
            'userland enum' => [false, false, true, []],
        ];
    }

    /**
     * No overlap for any shape PHP can actually produce.
     *
     * The contradictory interface-and-enum shape is excluded deliberately — see
     * testInterfaceAndEnumIsTheOnePairThatOverlaps() for why it is left out rather than asserted.
     */
    #[DataProvider('allFlagCombinations')]
    public function testAtMostOneParserClaimsAnyShape(bool $internal, bool $interface, bool $enum)
    {
        $accepted = $this->acceptedBy($this->adaptedClass($internal, $interface, $enum));

        self::assertLessThanOrEqual(
            1,
            count($accepted),
            sprintf(
                'ambiguous dispatch for internal=%s interface=%s enum=%s: %s',
                var_export($internal, true),
                var_export($interface, true),
                var_export($enum, true),
                implode(', ', $accepted)
            )
        );
    }

    public static function allFlagCombinations(): array
    {
        $cases = [];
        foreach ([true, false] as $internal) {
            foreach ([true, false] as $interface) {
                foreach ([true, false] as $enum) {
                    if ($interface && $enum) {
                        continue; // not producible by PHP; see the dedicated test below
                    }
                    $cases[sprintf('internal=%d interface=%d enum=%d', $internal, $interface, $enum)]
                        = [$internal, $interface, $enum];
                }
            }
        }
        return $cases;
    }

    /**
     * The one shape where the partition overlaps: an object reporting both isInterface() and
     * isEnum() is claimed by the enum *and* the interface parser, so which one wins would depend
     * on registration order in EntityReflectionObjectParsersRegistry.
     *
     * This is asserted as the current behaviour rather than fixed, because the shape is not
     * reachable: across 255 internal class-likes at PHP 8.6 (6 enums, 27 interfaces) there are
     * **0** where both flags are set, and an enum is not an interface in PHP's object model. The
     * mutual exclusion is therefore an invariant of the reflection API rather than of these three
     * canParse() implementations — which is worth knowing, since it means the partition is total
     * only for as long as that holds.
     */
    public function testInterfaceAndEnumIsTheOnePairThatOverlaps()
    {
        $contradictory = $this->adaptedClass(true, true, true);

        self::assertSame(
            ['ReflectionEnumParser', 'ReflectionInterfaceParser'],
            $this->acceptedBy($contradictory),
            'documented overlap; unreachable via the reflection API'
        );
    }

    /** Every internal class-like shape PHP can actually produce must be claimed by someone. */
    #[DataProvider('realisticInternalShapes')]
    public function testNoInternalClassLikeShapeIsDropped(bool $interface, bool $enum)
    {
        self::assertCount(1, $this->acceptedBy($this->adaptedClass(true, $interface, $enum)));
    }

    public static function realisticInternalShapes(): array
    {
        return [
            'plain class' => [false, false],
            'interface' => [true, false],
            'enum' => [false, true],
        ];
    }

    public function testFunctionParserClaimsOnlyAdaptedFunctions()
    {
        $parser = new ReflectionFunctionParser();

        self::assertTrue($parser->canParse($this->createStub(AdaptedReflectionFunction::class)));
        self::assertFalse($parser->canParse($this->createStub(AdaptedReflectionClass::class)));
        self::assertFalse($parser->canParse($this->createStub(AdaptedReflectionParameter::class)));
        self::assertFalse($parser->canParse([]));
        self::assertFalse($parser->canParse('not an object'));
    }

    public function testParameterParserClaimsOnlyAdaptedParameters()
    {
        $parser = new ReflectionParameterParser();

        self::assertTrue($parser->canParse($this->createStub(AdaptedReflectionParameter::class)));
        self::assertFalse($parser->canParse($this->createStub(AdaptedReflectionFunction::class)));
        self::assertFalse($parser->canParse([]));
    }

    /** A class-like object must never be claimed by the function or parameter parsers. */
    public function testClassLikeObjectsAreNotClaimedByCallableParsers()
    {
        $internalClass = $this->adaptedClass(true, false, false);

        self::assertFalse((new ReflectionFunctionParser())->canParse($internalClass));
        self::assertFalse((new ReflectionParameterParser())->canParse($internalClass));
    }

    /**
     * Sub-parsers are invoked directly by their owning parser, never through registry dispatch, and
     * declare canParse() === false unconditionally. Pinned so that "implementing it properly" is a
     * deliberate decision rather than an accident that creates an overlap.
     *
     * @param class-string $parserClass
     */
    #[DataProvider('subParsers')]
    public function testSubParsersNeverClaimAnything(string $parserClass)
    {
        $parser = new $parserClass();

        foreach ([
            $this->adaptedClass(true, false, false),
            $this->createStub(AdaptedReflectionFunction::class),
            $this->createStub(AdaptedReflectionParameter::class),
            ['SOME_CONST' => 1],
            'string',
            null,
        ] as $candidate) {
            self::assertFalse($parser->canParse($candidate), $parserClass . ' claimed something');
        }
    }

    public static function subParsers(): array
    {
        return [
            'class constants' => [ReflectionClassConstantParser::class],
            'methods' => [ReflectionMethodParser::class],
            'properties' => [ReflectionPropertyParser::class],
            'parent class' => [ReflectionParentClassParser::class],
            'implemented interfaces' => [ReflectionImplementedInterfaceParser::class],
            'define constants' => [ReflectionDefineConstantParser::class],
        ];
    }
}
