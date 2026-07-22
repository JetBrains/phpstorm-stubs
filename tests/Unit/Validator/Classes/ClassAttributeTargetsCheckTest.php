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
}
