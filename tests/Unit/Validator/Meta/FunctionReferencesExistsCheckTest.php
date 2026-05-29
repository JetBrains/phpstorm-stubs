<?php

namespace StubTests\Unit\Validator\Meta;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Meta\FunctionReferencesExistsCheck;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionReferencesExistsCheckTest extends CheckTestCase
{
    public function testFunctionReferenceFound(): void
    {
        $func = $this->makeFunction('\\array_map');
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$func]);

        $check = new FunctionReferencesExistsCheck();
        $result = $check->run($stubs, 'function|\\array_map', '8.0');
        $this->assertFalse($result->hasFailures());
    }

    public function testFunctionReferenceNotFound(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $check = new FunctionReferencesExistsCheck();
        $result = $check->run($stubs, 'function|\\nonexistent', '8.0');
        $this->assertTrue($result->hasFailures());
    }

    public function testMethodReferenceFound(): void
    {
        $method = new PHPMethod();
        $method->setName('format');
        $class = $this->makeClass('\\DateTime', methods: [$method]);

        $entityLookup = new EntityLookupService();
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$class]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);

        $check = new FunctionReferencesExistsCheck($entityLookup);
        $result = $check->run($stubs, 'method|\\DateTime::format', '8.0');
        $this->assertFalse($result->hasFailures());
    }

    public function testMethodReferenceClassNotFound(): void
    {
        $entityLookup = new EntityLookupService();
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);

        $check = new FunctionReferencesExistsCheck($entityLookup);
        $result = $check->run($stubs, 'method|\\DateTime::format', '8.0');
        $this->assertTrue($result->hasFailures());
    }

    public function testGlobalConstantReferenceFound(): void
    {
        $constant = $this->makeGlobalConstant('\\PHP_INT_MAX', 9223372036854775807);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$constant]);

        $check = new FunctionReferencesExistsCheck();
        $result = $check->run($stubs, 'global_const|\\PHP_INT_MAX', '8.0');
        $this->assertFalse($result->hasFailures());
    }

    public function testSupportsAllVersions(): void
    {
        $check = new FunctionReferencesExistsCheck();
        $this->assertTrue($check->supports('5.6'));
        $this->assertTrue($check->supports('8.4'));
    }

    private function makeFunction(string $id): PHPFunction
    {
        $func = $this->getMockBuilder(PHPFunction::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getName'])
            ->getMock();
        $func->method('getId')->willReturn($id);
        $func->method('getName')->willReturn(ltrim($id, '\\'));
        return $func;
    }
}
