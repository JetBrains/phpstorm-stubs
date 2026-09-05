<?php

namespace StubTests\Unit\Validator\Classes;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\ClassAttributeTargetsCheck;
use StubTests\Unit\Validator\CheckTestCase;

class ClassAttributeTargetsCheckTest extends CheckTestCase
{
    private const TARGET_METHOD = 4;
    private const TARGET_PROPERTY = 8;
    private const TARGET_CLASS_CONSTANT = 16;

    private function attribute(int $flags): array
    {
        return [['name' => 'Attribute', 'arguments' => [0 => $flags]]];
    }

    private function runCheck(array $reflAttributes, array $stubAttributes, string $id = 'Override'): \StubTests\Framework\Validator\Contracts\CheckResultSet
    {
        $reflClass = $this->makeClass($id);
        $reflClass->setAttributes($reflAttributes);
        $stubClass = $this->makeClass($id);
        $stubClass->setAttributes($stubAttributes);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        return (new ClassAttributeTargetsCheck($provider))->run($stubs, $id, PhpVersions::LATEST->value);
    }

    public function testSupportsPhp80AndAbove(): void
    {
        $check = new ClassAttributeTargetsCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testDoesNotSupportOlderPhpVersions(): void
    {
        $check = new ClassAttributeTargetsCheck();
        $this->assertFalse($check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_7_4->value));
    }

    public function testMatchingTargetsPasses(): void
    {
        $flags = self::TARGET_METHOD|self::TARGET_PROPERTY;
        $result = $this->runCheck($this->attribute($flags), $this->attribute($flags));

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNonAttributeClassPasses(): void
    {
        // Neither side marks the class as an attribute.
        $result = $this->runCheck([], [], 'SomeRegularClass');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testOtherAttributesAreIgnored(): void
    {
        $flags = self::TARGET_METHOD;
        $reflAttrs = [
            ['name' => 'SomeMarker', 'arguments' => []],
            ['name' => 'Attribute', 'arguments' => [0 => $flags]],
        ];
        $stubAttrs = [['name' => 'Attribute', 'arguments' => [0 => $flags]]];

        $result = $this->runCheck($reflAttrs, $stubAttrs);

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMissingTargetFails(): void
    {
        // Reflection gained TARGET_CLASS_CONSTANT (as \Override does in 8.6); stubs lag behind.
        $reflFlags = self::TARGET_METHOD|self::TARGET_PROPERTY|self::TARGET_CLASS_CONSTANT;
        $stubFlags = self::TARGET_METHOD|self::TARGET_PROPERTY;

        $result = $this->runCheck($this->attribute($reflFlags), $this->attribute($stubFlags));

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()['Override'];
        $this->assertStringContainsString('missing target(s) in stubs', $message);
        $this->assertStringContainsString('TARGET_CLASS_CONSTANT', $message);
    }

    public function testUnexpectedTargetFails(): void
    {
        $reflFlags = self::TARGET_METHOD|self::TARGET_PROPERTY;
        $stubFlags = self::TARGET_METHOD|self::TARGET_PROPERTY|self::TARGET_CLASS_CONSTANT;

        $result = $this->runCheck($this->attribute($reflFlags), $this->attribute($stubFlags));

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()['Override'];
        $this->assertStringContainsString('unexpected target(s) in stubs', $message);
        $this->assertStringContainsString('TARGET_CLASS_CONSTANT', $message);
    }

    public function testAttributeInReflectionButNotInStubsFails(): void
    {
        $result = $this->runCheck($this->attribute(self::TARGET_METHOD), []);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not marked #[Attribute] in stubs', $result->getFailures()['Override']);
    }

    public function testAttributeInStubsButNotInReflectionFails(): void
    {
        $result = $this->runCheck([], $this->attribute(self::TARGET_METHOD));

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not an attribute in PHP', $result->getFailures()['Override']);
    }

    public function testDefaultFlagsTreatedAsTargetAll(): void
    {
        // Explicit TARGET_ALL on one side, bare #[Attribute] (no args) on the other.
        $reflAttrs = $this->attribute(\Attribute::TARGET_ALL);
        $stubAttrs = [['name' => 'Attribute', 'arguments' => []]];

        $result = $this->runCheck($reflAttrs, $stubAttrs);

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNamedFlagsArgumentSupported(): void
    {
        $flags = self::TARGET_METHOD|self::TARGET_PROPERTY;
        $reflAttrs = $this->attribute($flags);
        $stubAttrs = [['name' => 'Attribute', 'arguments' => ['flags' => $flags]]];

        $result = $this->runCheck($reflAttrs, $stubAttrs);

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassNotFoundInReflection(): void
    {
        $provider = $this->createMockReflectionProviderWithClasses([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassAttributeTargetsCheck($provider))->run($stubs, 'Missing', PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection', $result->getFailures()['Missing']);
    }

    public function testClassNotFoundInStubs(): void
    {
        $reflClass = $this->makeClass('MissingInStubs');
        $reflClass->setAttributes($this->attribute(self::TARGET_METHOD));

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassAttributeTargetsCheck($provider))->run($stubs, 'MissingInStubs', PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()['MissingInStubs']);
    }

    // ── Symbolic flag resolution ─────────────────────────────────────────────

    /**
     * Builds a reflection \Attribute class carrying the target constants of a given PHP
     * version, so flag resolution is driven by that version rather than by the runtime
     * running this suite.
     */
    private function attributeClassFor(string $version): \StubTests\Framework\Model\PHPClass
    {
        $constants = [
            $this->makeClassConstant('TARGET_CLASS', 1),
            $this->makeClassConstant('TARGET_FUNCTION', 2),
            $this->makeClassConstant('TARGET_METHOD', 4),
            $this->makeClassConstant('TARGET_PROPERTY', 8),
            $this->makeClassConstant('TARGET_CLASS_CONSTANT', 16),
            $this->makeClassConstant('TARGET_PARAMETER', 32),
        ];
        // TARGET_CONSTANT (and the widened TARGET_ALL) only exist from PHP 8.5.
        if (version_compare($version, '8.5', '>=')) {
            $constants[] = $this->makeClassConstant('TARGET_CONSTANT', 64);
            $constants[] = $this->makeClassConstant('TARGET_ALL', 127);
        } else {
            $constants[] = $this->makeClassConstant('TARGET_ALL', 63);
        }

        return $this->makeClass('\\Attribute', constants: $constants);
    }

    private function runCheckWithVersionMap(
        array $reflAttributes,
        array $stubAttributes,
        string $version,
        string $id = 'Override'
    ): \StubTests\Framework\Validator\Contracts\CheckResultSet {
        $reflClass = $this->makeClass($id);
        $reflClass->setAttributes($reflAttributes);
        $stubClass = $this->makeClass($id);
        $stubClass->setAttributes($stubAttributes);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass, $this->attributeClassFor($version)]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        return (new ClassAttributeTargetsCheck($provider))->run($stubs, $id, $version);
    }

    private function symbolicAttribute(string $expression): array
    {
        return [['name' => 'Attribute', 'arguments' => [0 => $expression]]];
    }

    /**
     * The stub parser falls back to a symbolic name when the constant is not defined on the
     * runtime that parsed the stubs. Casting that with (int) yields 0, so a stub declaring
     * exactly the right target was reported as declaring none.
     */
    public function testSingleSymbolicFlagIsResolvedNotCastToZero(): void
    {
        $result = $this->runCheckWithVersionMap(
            $this->attribute(64),
            $this->symbolicAttribute('Attribute::TARGET_CONSTANT'),
            '8.6'
        );

        $this->assertFalse($result->hasFailures(), implode('; ', $result->getFailures()));
    }

    /**
     * The worst case: "1|Attribute::TARGET_CONSTANT" casts to 1, which is a *valid-looking*
     * bitmask, so the check reported a confident, wrong "missing target(s)" result.
     */
    public function testMixedSymbolicBitwiseOrIsResolvedNotTruncated(): void
    {
        $result = $this->runCheckWithVersionMap(
            $this->attribute(1|64),
            $this->symbolicAttribute('1|Attribute::TARGET_CONSTANT'),
            '8.6'
        );

        $this->assertFalse($result->hasFailures(), implode('; ', $result->getFailures()));
    }

    public function testFullySymbolicBitwiseOrIsResolved(): void
    {
        $result = $this->runCheckWithVersionMap(
            $this->attribute(4|8|64),
            $this->symbolicAttribute('Attribute::TARGET_METHOD|Attribute::TARGET_PROPERTY|Attribute::TARGET_CONSTANT'),
            '8.6'
        );

        $this->assertFalse($result->hasFailures(), implode('; ', $result->getFailures()));
    }

    /**
     * A genuine mismatch must still be reported — the resolution must not mask real defects.
     */
    public function testSymbolicResolutionStillDetectsARealMismatch(): void
    {
        $result = $this->runCheckWithVersionMap(
            $this->attribute(1|64),
            $this->symbolicAttribute('Attribute::TARGET_CLASS'),
            '8.6'
        );

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('TARGET_CONSTANT', $result->getFailures()['Override']);
    }

    /**
     * An unresolvable value must fail loudly with the raw text rather than being cast to a
     * plausible-looking number and compared.
     */
    public function testUnresolvableFlagsFailWithTheRawValue(): void
    {
        $result = $this->runCheckWithVersionMap(
            $this->attribute(4),
            $this->symbolicAttribute('Attribute::TARGET_NOT_A_REAL_CONSTANT'),
            '8.6'
        );

        $this->assertTrue($result->hasFailures());
        $failure = $result->getFailures()['Override'];
        $this->assertStringContainsString('could not resolve', $failure);
        $this->assertStringContainsString('TARGET_NOT_A_REAL_CONSTANT', $failure);
    }

    // ── Version-correct TARGET_ALL ───────────────────────────────────────────

    /**
     * `#[Attribute]` with no flags means TARGET_ALL, which widened from 63 to 127 in PHP 8.5
     * when TARGET_CONSTANT was added. The old code hardcoded 63 as its fallback.
     */
    public function testBareAttributeUsesTheVersionsTargetAllOn85AndLater(): void
    {
        $bare = [['name' => 'Attribute', 'arguments' => []]];

        $result = $this->runCheckWithVersionMap($this->attribute(127), $bare, '8.6');

        $this->assertFalse($result->hasFailures(), implode('; ', $result->getFailures()));
    }

    public function testBareAttributeUsesTheNarrowerTargetAllBefore85(): void
    {
        $bare = [['name' => 'Attribute', 'arguments' => []]];

        $result = $this->runCheckWithVersionMap($this->attribute(63), $bare, '8.4');

        $this->assertFalse($result->hasFailures(), implode('; ', $result->getFailures()));
    }

    /**
     * The same bare stub declaration must not satisfy both 63 and 127 — otherwise the
     * version map is being ignored.
     */
    public function testBareAttributeIsVersionSensitive(): void
    {
        $bare = [['name' => 'Attribute', 'arguments' => []]];

        $result = $this->runCheckWithVersionMap($this->attribute(63), $bare, '8.6');

        $this->assertTrue($result->hasFailures(), 'TARGET_ALL=63 must not match PHP 8.6, where it is 127.');
    }
}
