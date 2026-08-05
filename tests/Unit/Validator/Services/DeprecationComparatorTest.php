<?php

namespace StubTests\Unit\Validator\Services;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPParameter;
use StubTests\Framework\Validator\Services\DeprecationComparator;

class DeprecationComparatorTest extends TestCase
{
    private static function makeFunction(bool $isDeprecated, ?string $deprecatedSince): PHPFunction
    {
        $function = new PHPFunction();
        $function->setName('f');
        $function->setDeprecated($isDeprecated);
        $function->initStubsMetadata()->setDeprecatedSinceVersion($deprecatedSince);

        return $function;
    }

    public static function deprecatedInProvider(): array
    {
        return [
            'not deprecated at all' => [false, null, '8.4', false],
            'deprecated without a version applies everywhere' => [true, null, '5.6', true],
            'version under test is below since' => [true, '8.4', '8.3', false],
            'version under test equals since' => [true, '8.4', '8.4', true],
            'version under test is above since' => [true, '8.4', '8.5', true],
            // Some stubs declare a since older than the earliest version validated here.
            'since older than the suite covers' => [true, '5.3', '5.6', true],
        ];
    }

    #[DataProvider('deprecatedInProvider')]
    public function testItResolvesDeprecationAtAVersion(
        bool $isDeprecated,
        ?string $deprecatedSince,
        string $phpVersion,
        bool $expected
    ): void {
        self::assertSame($expected, DeprecationComparator::isDeprecatedIn(self::makeFunction($isDeprecated, $deprecatedSince), $phpVersion));
    }

    /**
     * Reflection-side elements carry no stub metadata, so their flag has to be taken verbatim.
     */
    public function testItTreatsAnElementWithoutStubMetadataAsDeprecatedEverywhere(): void
    {
        $function = new PHPFunction();
        $function->setName('f');
        $function->setDeprecated(true);

        self::assertNull($function->getStubsMetadata());
        self::assertTrue(DeprecationComparator::isDeprecatedIn($function, '5.6'));
    }

    public function testItResolvesParameterDeprecation(): void
    {
        $parameter = new PHPParameter('p');
        $parameter->setDeprecated(true);
        $parameter->initStubsMetadata()->setDeprecatedSinceVersion('8.1');

        self::assertFalse(DeprecationComparator::isDeprecatedIn($parameter, '8.0'));
        self::assertTrue(DeprecationComparator::isDeprecatedIn($parameter, '8.1'));
    }

    public function testItReportsAMismatchWhenTheStubDeprecationStartsLater(): void
    {
        $reflection = self::makeFunction(true, null);
        $stub = self::makeFunction(true, '8.5');

        self::assertTrue(DeprecationComparator::isMismatch($reflection, $stub, '8.4'));
        self::assertFalse(DeprecationComparator::isMismatch($reflection, $stub, '8.5'));
    }

    public function testItReportsNoMismatchWhenOnlyTheStubIsDeprecated(): void
    {
        // isMismatch stays one-directional: a stub-only deprecation is not its concern.
        $reflection = self::makeFunction(false, null);
        $stub = self::makeFunction(true, null);

        self::assertFalse(DeprecationComparator::isMismatch($reflection, $stub, '8.4'));
    }
}
