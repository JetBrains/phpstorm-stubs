<?php

namespace StubTests\Unit\Validator\Classes;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\ClassReadonlyCheck;
use StubTests\Unit\Validator\CheckTestCase;

class ClassReadonlyCheckTest extends CheckTestCase
{
    public function testSupportsPhp82AndAbove(): void
    {
        $check = new ClassReadonlyCheck();
        $this->assertTrue($check->supports(PhpVersions::PHP_8_2->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_3->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testDoesNotSupportOlderPhpVersions(): void
    {
        $check = new ClassReadonlyCheck();
        $this->assertFalse($check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_7_4->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_8_1->value));
    }

    public function testReadonlyMatchPasses(): void
    {
        $classId = 'MyReadonlyClass';
        $reflClass = $this->createMockClassWithProperties($classId, null, null, true);
        $stubClass = $this->createMockClassWithProperties($classId, null, null, true);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassReadonlyCheck($provider))->run($stubs, $classId, '8.2');
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNonReadonlyMatchPasses(): void
    {
        $classId = 'RegularClass';
        $reflClass = $this->createMockClassWithProperties($classId, null, null, false);
        $stubClass = $this->createMockClassWithProperties($classId, null, null, false);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassReadonlyCheck($provider))->run($stubs, $classId, '8.2');
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMismatchReadonlyInReflectionButNotInStubs(): void
    {
        $classId = 'MismatchClass';
        $reflClass = $this->createMockClassWithProperties($classId, null, null, true);
        $stubClass = $this->createMockClassWithProperties($classId, null, null, false);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassReadonlyCheck($provider))->run($stubs, $classId, '8.2');
        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('readonly', $result->getFailures()[$classId]);
    }

    public function testMismatchReadonlyInStubsButNotInReflection(): void
    {
        $classId = 'MismatchClass2';
        $reflClass = $this->createMockClassWithProperties($classId, null, null, false);
        $stubClass = $this->createMockClassWithProperties($classId, null, null, true);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassReadonlyCheck($provider))->run($stubs, $classId, '8.2');
        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('non-readonly', $result->getFailures()[$classId]);
    }

    public function testClassNotFoundInReflection(): void
    {
        $classId = 'MissingClass';

        $provider = $this->createMockReflectionProviderWithClasses([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassReadonlyCheck($provider))->run($stubs, $classId, '8.2');
        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection', $result->getFailures()[$classId]);
    }

    public function testClassNotFoundInStubs(): void
    {
        $classId = 'MissingInStubs';
        $reflClass = $this->createMockClassWithProperties($classId, null, null, false);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassReadonlyCheck($provider))->run($stubs, $classId, '8.2');
        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$classId]);
    }

    public function testReadonlyClassInNamespace(): void
    {
        $classId = 'Foo\\Bar\\ReadonlyClass';
        $reflClass = $this->createMockClassWithProperties($classId, 'Foo\\Bar', null, true);
        $stubClass = $this->createMockClassWithProperties($classId, 'Foo\\Bar', null, true);

        $provider = $this->createMockReflectionProviderWithClasses([$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassReadonlyCheck($provider))->run($stubs, $classId, '8.3');
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }
}
