<?php

namespace StubTests\Unit\Validator\Classes;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\ClassFinalCheck;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Unit\Validator\CheckTestCase;

class ClassFinalCheckTest extends CheckTestCase
{
    private function makeReflection(array $classes): ReflectionProviderInterface
    {
        $provider = $this->createMock(ReflectionProviderInterface::class);
        $manager = $this->createMockStorageManager();
        $manager->method('getClasses')->willReturn($classes);
        $provider->method('getReflection')->willReturn($manager);
        return $provider;
    }

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassFinalCheck();
        $this->assertTrue($check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testFinalClassWithBooleanTrue(): void
    {
        $className = 'MyFinalClass';

        $stubClass = $this->createMockClassWithProperties($className, null, true, null);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $reflClass = $this->createMockClassWithProperties($className, null, true, null);

        $result = (new ClassFinalCheck($this->makeReflection([$reflClass])))->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNonFinalClassWithBooleanFalse(): void
    {
        $className = 'RegularClass';

        $stubClass = $this->createMockClassWithProperties($className, null, false, null);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $reflClass = $this->createMockClassWithProperties($className, null, false, null);

        $result = (new ClassFinalCheck($this->makeReflection([$reflClass])))->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassWithoutFinalProperty(): void
    {
        $className = 'ClassWithoutFinal';

        // Don't set isFinal property (null) — treated as false in both reflection and stubs
        $stubClass = $this->createMockClassWithProperties($className, null, null, null);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $reflClass = $this->createMockClassWithProperties($className, null, null, null);

        $result = (new ClassFinalCheck($this->makeReflection([$reflClass])))->run($stubsManager, $className, '8.0');

        // Should succeed because null/unset is treated as false on both sides
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassNotFoundInStubs(): void
    {
        $className = 'MissingClass';

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([]);

        $reflClass = $this->createMockClassWithProperties($className, null, true, null);

        $result = (new ClassFinalCheck($this->makeReflection([$reflClass])))->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in stubs', $failures[$className]);
    }

    public function testFinalMismatchFails(): void
    {
        $className = 'SomeFinalClass';

        // Reflection says final, stubs say non-final
        $stubClass = $this->createMockClassWithProperties($className, null, false, null);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $reflClass = $this->createMockClassWithProperties($className, null, true, null);

        $result = (new ClassFinalCheck($this->makeReflection([$reflClass])))->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('final', $failures[$className]);
        $this->assertStringContainsString('non-final', $failures[$className]);
    }

    public function testFinalClassInNamespace(): void
    {
        $className = 'Foo\\Bar\\FinalClass';

        $stubClass = $this->createMockClassWithProperties($className, 'Foo\\Bar', true, null);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $reflClass = $this->createMockClassWithProperties($className, 'Foo\\Bar', true, null);

        $result = (new ClassFinalCheck($this->makeReflection([$reflClass])))->run($stubsManager, $className, '7.4');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }
}
