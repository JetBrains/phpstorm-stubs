<?php

namespace StubTests\Unit\Validator\Services;

use StubTests\Framework\Validator\Services\ParameterPassingComparator;
use StubTests\Unit\Validator\CheckTestCase;

class ParameterPassingComparatorTest extends CheckTestCase
{
    // ── By reference ──────────────────────────────────────────────────────────

    public function testMatchingPassingHasNoMismatch(): void
    {
        $refl = [$this->makeParam('array', byRef: true), $this->makeParam('flags')];
        $stub = [$this->makeParam('array', byRef: true), $this->makeParam('flags')];

        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0'));
    }

    public function testReferenceInReflectionButValueInStubsIsReported(): void
    {
        $refl = [$this->makeParam('array', byRef: true)];
        $stub = [$this->makeParam('array')];

        $this->assertSame(
            ['$array (reflection: by reference, stubs: by value)'],
            ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0')
        );
    }

    public function testReferenceInStubsButValueInReflectionIsReported(): void
    {
        // The sodium_crypto_xof_*_squeeze() case: the state became an object in 8.6.
        $refl = [$this->makeParam('state'), $this->makeParam('length')];
        $stub = [$this->makeParam('state', byRef: true), $this->makeParam('length')];

        $this->assertSame(
            ['$state (reflection: by value, stubs: by reference)'],
            ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.6')
        );
    }

    public function testParametersAreMatchedByPositionNotName(): void
    {
        // Before 8.0 reflection names often differ from the stubs' — the flag must still be compared.
        $refl = [$this->makeParam('arg', byRef: true)];
        $stub = [$this->makeParam('array')];

        $this->assertSame(
            ['$array (reflection: by reference, stubs: by value)'],
            ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '5.6')
        );
    }

    public function testAllMismatchesAreReported(): void
    {
        $refl = [$this->makeParam('a', byRef: true), $this->makeParam('b'), $this->makeParam('c')];
        $stub = [$this->makeParam('a'), $this->makeParam('b'), $this->makeParam('c', byRef: true)];

        $this->assertCount(2, ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0'));
    }

    public function testPreferRefParameterAcceptsReferenceInStubs(): void
    {
        $refl = [$this->makeParam('ptr', preferRef: true)];
        $stub = [$this->makeParam('ptr', byRef: true)];

        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0'));
    }

    public function testPreferRefParameterAcceptsValueInStubs(): void
    {
        $refl = [$this->makeParam('ptr', preferRef: true)];
        $stub = [$this->makeParam('ptr')];

        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0'));
    }

    public function testPreferRefDoesNotExemptOtherParameters(): void
    {
        $refl = [$this->makeParam('to', preferRef: true), $this->makeParam('size')];
        $stub = [$this->makeParam('to'), $this->makeParam('size', byRef: true)];

        $this->assertSame(
            ['$size (reflection: by value, stubs: by reference)'],
            ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0')
        );
    }

    public function testStubParametersBeyondReflectionAreComparedWithReflectionVariadic(): void
    {
        // mysqli_stmt::bind_param: reflection (string $types, &...$vars),
        // stubs ($types, &$var1, &...$_). Both of the stub's trailing params must be by reference.
        $refl = [$this->makeParam('types'), $this->makeParam('vars', variadic: true, byRef: true)];
        $okStub = [
            $this->makeParam('types'),
            $this->makeParam('var1', byRef: true),
            $this->makeParam('_', variadic: true, byRef: true),
        ];
        $badStub = [
            $this->makeParam('types'),
            $this->makeParam('var1', byRef: true),
            $this->makeParam('_', variadic: true),
        ];

        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($refl, $okStub, '8.0'));
        $this->assertSame(
            ['$_ (reflection: by reference, stubs: by value)'],
            ParameterPassingComparator::findByReferenceMismatches($refl, $badStub, '8.0')
        );
    }

    public function testStubParametersBeyondReflectionWithoutVariadicAreIgnored(): void
    {
        // An extra parameter is ParametersCountCheck's concern.
        $refl = [$this->makeParam('a')];
        $stub = [$this->makeParam('a'), $this->makeParam('extra', byRef: true)];

        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0'));
    }

    public function testReflectionParametersMissingFromStubsAreIgnored(): void
    {
        $refl = [$this->makeParam('a'), $this->makeParam('b', byRef: true)];
        $stub = [$this->makeParam('a')];

        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($refl, $stub, '8.0'));
    }

    public function testStubParametersAreVersionFiltered(): void
    {
        // xml_set_object(): $obj by reference until 7.0, by value from 7.1, declared twice.
        $stub = [
            $this->makeParam('parser'),
            $this->makeParam('object', removedVersion: '7.1', byRef: true),
            $this->makeParam('object', sinceVersion: '7.1'),
        ];
        $reflOld = [$this->makeParam('parser'), $this->makeParam('obj', byRef: true)];
        $reflNew = [$this->makeParam('parser'), $this->makeParam('object')];

        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($reflOld, $stub, '7.0'));
        $this->assertSame([], ParameterPassingComparator::findByReferenceMismatches($reflNew, $stub, '7.1'));
        $this->assertCount(1, ParameterPassingComparator::findByReferenceMismatches($reflOld, $stub, '7.1'));
    }

    // ── Variadic ──────────────────────────────────────────────────────────────

    public function testNoVariadicOnEitherSideHasNoMismatch(): void
    {
        $params = [$this->makeParam('a'), $this->makeParam('b')];

        $this->assertNull(ParameterPassingComparator::describeVariadicMismatch($params, $params, '8.0'));
    }

    public function testVariadicOnBothSidesHasNoMismatch(): void
    {
        $refl = [$this->makeParam('values', variadic: true)];
        $stub = [$this->makeParam('values', variadic: true)];

        $this->assertNull(ParameterPassingComparator::describeVariadicMismatch($refl, $stub, '8.0'));
    }

    public function testVariadicAtDifferentPositionHasNoMismatch(): void
    {
        // The stub spells out a required leading argument of the variadic.
        $refl = [$this->makeParam('vars', variadic: true, byRef: true)];
        $stub = [$this->makeParam('var1', byRef: true), $this->makeParam('_', variadic: true, byRef: true)];

        $this->assertNull(ParameterPassingComparator::describeVariadicMismatch($refl, $stub, '8.0'));
    }

    public function testVariadicOnlyInReflectionIsReported(): void
    {
        $refl = [$this->makeParam('format'), $this->makeParam('values', variadic: true)];
        $stub = [$this->makeParam('format'), $this->makeParam('values')];

        $this->assertSame(
            'reflection declares variadic $values, stubs have no variadic parameter',
            ParameterPassingComparator::describeVariadicMismatch($refl, $stub, '8.0')
        );
    }

    public function testVariadicOnlyInStubsIsReported(): void
    {
        $refl = [$this->makeParam('args')];
        $stub = [$this->makeParam('args', variadic: true)];

        $this->assertSame(
            'stubs declare variadic $args, reflection has no variadic parameter',
            ParameterPassingComparator::describeVariadicMismatch($refl, $stub, '8.0')
        );
    }

    public function testStubVariadicIsVersionFiltered(): void
    {
        $refl = [$this->makeParam('args')];
        $stub = [$this->makeParam('args', sinceVersion: '8.0', variadic: true)];

        $this->assertNull(ParameterPassingComparator::describeVariadicMismatch($refl, $stub, '7.4'));
        $this->assertNotNull(ParameterPassingComparator::describeVariadicMismatch($refl, $stub, '8.0'));
    }
}
