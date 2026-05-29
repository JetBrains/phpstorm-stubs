<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDefaultValueCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumMethodsParameterDefaultValueCheckTest extends CheckTestCase
{
    private ClassMethodsParameterDefaultValueCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new ClassMethodsParameterDefaultValueCheck(entityTypeConfig: EntityTypeConfig::forEnum());
    }

    public function testSupportsOnlyLatestPhpVersion(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testEnumNotFoundInReflectionIsFailure(): void
    {
        $enumId   = '\MyEnum';
        $stubEnum = $this->getMockBuilder(PHPEnum::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getMethods', 'getImplementedInterfaces'])
            ->getMock();
        $stubEnum->method('getId')->willReturn($enumId);
        $stubEnum->method('getMethods')->willReturn([]);
        $stubEnum->method('getImplementedInterfaces')->willReturn([]);

        $provider = $this->createMockReflectionProviderWithEnums([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Enum', $result->getFailures()[$enumId]);
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$enumId]);
    }

    public function testMatchingDefaultsSucceed(): void
    {
        $enumId     = '\MyEnum';
        $reflParams = [$this->makeParam('flags', optional: true, hasDefaultValue: true, defaultValue: 0)];
        $stubParams = [$this->makeParam('flags', optional: true, hasDefaultValue: true, defaultValue: 0)];

        $reflMethod = $this->createMockMethod('process', $reflParams);
        $stubMethod = $this->createMockMethod('process', $stubParams);

        $reflEnum = $this->getMockBuilder(PHPEnum::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getMethods', 'getImplementedInterfaces'])
            ->getMock();
        $reflEnum->method('getId')->willReturn($enumId);
        $reflEnum->method('getMethods')->willReturn([$reflMethod]);
        $reflEnum->method('getImplementedInterfaces')->willReturn([]);

        $stubEnum = $this->getMockBuilder(PHPEnum::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getMethods', 'getImplementedInterfaces'])
            ->getMock();
        $stubEnum->method('getId')->willReturn($enumId);
        $stubEnum->method('getMethods')->willReturn([$stubMethod]);
        $stubEnum->method('getImplementedInterfaces')->willReturn([]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testMismatchedDefaultIsFailure(): void
    {
        $enumId     = '\MyEnum';
        $reflParams = [$this->makeParam('flags', optional: true, hasDefaultValue: true, defaultValue: 0)];
        $stubParams = [$this->makeParam('flags', optional: true, hasDefaultValue: true, defaultValue: 5)]; // wrong

        $reflMethod = $this->createMockMethod('process', $reflParams);
        $stubMethod = $this->createMockMethod('process', $stubParams);

        $reflEnum = $this->getMockBuilder(PHPEnum::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getMethods', 'getImplementedInterfaces'])
            ->getMock();
        $reflEnum->method('getId')->willReturn($enumId);
        $reflEnum->method('getMethods')->willReturn([$reflMethod]);
        $reflEnum->method('getImplementedInterfaces')->willReturn([]);

        $stubEnum = $this->getMockBuilder(PHPEnum::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getMethods', 'getImplementedInterfaces'])
            ->getMock();
        $stubEnum->method('getId')->willReturn($enumId);
        $stubEnum->method('getMethods')->willReturn([$stubMethod]);
        $stubEnum->method('getImplementedInterfaces')->willReturn([]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($enumId . '::process', $result->getFailures());
        $this->assertStringContainsString('Enum', $result->getFailures()[$enumId . '::process']);
    }

    public function testEntityTypeIsEnum(): void
    {
        // Verify that the entity type label says "Enum" not "Class"
        $enumId = '\NoSuchEnum';

        $provider = $this->createMockReflectionProviderWithEnums([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        // Both not found → reflection failure
        $this->assertTrue($result->hasFailures());
        // The error message for "not found in reflection" uses "Enum" label
        $this->assertStringContainsString('Enum ' . $enumId, $result->getFailures()[$enumId]);
    }
}
