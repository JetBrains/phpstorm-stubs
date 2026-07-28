<?php

namespace StubTests\Unit\Validator\Services;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Services\ReturnTypeComparator;

/**
 * The return-type equivalence rules, extracted from ClassMethodsReturnTypesCheck so the
 * function variant cannot drift from it again.
 *
 * @see ReturnTypeComparator
 */
class ReturnTypeComparatorTest extends TestCase
{
    #[DataProvider('equivalentTypes')]
    public function testEquivalentTypesAreAccepted(?string $refl, ?string $stub, string $why)
    {
        self::assertTrue(ReturnTypeComparator::areEquivalent($refl, $stub), $why);
    }

    public static function equivalentTypes(): array
    {
        return [
            'identical' => ['string', 'string', 'identical types match'],
            'both null' => [null, null, 'two absent types match'],
            // stub `static` vs a concrete reflection class name
            'static vs class name' => ['DateTime', 'static', 'covariant static matches a class name'],
            'static|null vs Class|null' => ['SimpleXMLElement|null', 'static|null', 'inherited static in a union'],
            'static on both sides' => ['static', 'static', 'directly equivalent'],
            'static with extra union part' => ['DateTime|false', 'static|false', 'non-static parts match exactly'],
            // stub narrowing bool (the TentativeType pattern)
            'true narrows bool' => ['bool', 'true', 'stub is intentionally more specific'],
            'false narrows bool' => ['bool', 'false', 'stub is intentionally more specific'],
        ];
    }

    #[DataProvider('divergentTypes')]
    public function testGenuineMismatchesAreStillReported(?string $refl, ?string $stub, string $why)
    {
        self::assertFalse(ReturnTypeComparator::areEquivalent($refl, $stub), $why);
    }

    public static function divergentTypes(): array
    {
        return [
            'plain mismatch' => ['string', 'int', 'unrelated scalars'],
            'null vs type' => [null, 'string', 'absent on one side only'],
            'type vs null' => ['string', null, 'absent on one side only'],
            // narrowing is allowed only from bool
            'true does not narrow int' => ['int', 'true', 'only bool may be narrowed'],
            'true does not narrow string|bool' => ['string|bool', 'true', 'the wider type is not plain bool'],
            'bool does not widen to true' => ['true', 'bool', 'the allowance is one-directional'],
            // static must still leave the remaining union matching
            'static with mismatched extra part' => ['DateTime|false', 'static|null', 'null vs false differ'],
            'static but reflection is primitive only' => ['int', 'static', 'no class-name component to consume'],
        ];
    }

    /**
     * Guards the direction of the bool allowance specifically: reflection reports the wider
     * `bool` and the stub may be narrower, never the reverse.
     */
    public function testBoolNarrowingIsOneDirectional()
    {
        self::assertTrue(ReturnTypeComparator::areEquivalent('bool', 'true'));
        self::assertFalse(ReturnTypeComparator::areEquivalent('true', 'bool'));
    }
}
