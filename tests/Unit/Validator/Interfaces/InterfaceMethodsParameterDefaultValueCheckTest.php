<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDefaultValueCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceMethodsParameterDefaultValueCheckTest extends CheckTestCase
{
    private ClassMethodsParameterDefaultValueCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new ClassMethodsParameterDefaultValueCheck(entityTypeConfig: EntityTypeConfig::forInterface());
    }

    private function createMockInterface(string $id, array $methods = []): PHPInterface
    {
        $iface = $this->getMockBuilder(PHPInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName', 'getMethods', 'getParentInterfaces'])
            ->getMock();
        $iface->method('getId')->willReturn($id);
        $iface->method('getName')->willReturn(ltrim($id, '\\'));
        $iface->method('getMethods')->willReturn($methods);
        $iface->method('getParentInterfaces')->willReturn([]);
        return $iface;
    }

    public function testSupportsOnlyLatestPhpVersion(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_3->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testInterfaceNotFoundInReflectionIsFailure(): void
    {
        $ifaceId = '\MyInterface';
        $stubIface = $this->createMockInterface($ifaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Interface', $result->getFailures()[$ifaceId]);
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$ifaceId]);
    }

    public function testMatchingDefaultsSucceed(): void
    {
        $ifaceId = '\MyInterface';
        $reflParams = [$this->makeParam('mode', hasDefaultValue: true, defaultValue: 1, optional: true)];
        $stubParams = [$this->makeParam('mode', hasDefaultValue: true, defaultValue: 1, optional: true)];

        $reflIface = $this->createMockInterface($ifaceId, [$this->createMockMethod('execute', $reflParams)]);
        $stubIface = $this->createMockInterface($ifaceId, [$this->createMockMethod('execute', $stubParams)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testMismatchedDefaultIsFailure(): void
    {
        $ifaceId = '\MyInterface';
        $reflParams = [$this->makeParam('mode', hasDefaultValue: true, defaultValue: 1, optional: true)];
        $stubParams = [$this->makeParam('mode', hasDefaultValue: true, defaultValue: 2, optional: true)]; // wrong

        $reflIface = $this->createMockInterface($ifaceId, [$this->createMockMethod('execute', $reflParams)]);
        $stubIface = $this->createMockInterface($ifaceId, [$this->createMockMethod('execute', $stubParams)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($ifaceId . '::execute', $result->getFailures());
        $this->assertStringContainsString('Interface', $result->getFailures()[$ifaceId . '::execute']);
    }

    public function testEntityTypeIsInterface(): void
    {
        $ifaceId = '\NoSuchInterface';

        $provider = $this->createMockReflectionProviderWithInterfaces([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = (new ClassMethodsParameterDefaultValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Interface ' . $ifaceId, $result->getFailures()[$ifaceId]);
    }
}
