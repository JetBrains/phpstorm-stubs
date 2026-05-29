<?php

namespace StubTests\Unit\Validator\PhpDoc;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Unit\Validator\CheckTestCase;

/**
 * Base test case for PhpDoc validator tests, providing shared entity factories.
 */
abstract class PhpDocCheckTestCase extends CheckTestCase
{
    protected function makeMethodWithPhpDoc(string $name, ?string $phpDoc = null): PHPMethod
    {
        $method = new PHPMethod();
        $method->setName($name);
        if ($phpDoc !== null) {
            $method->initStubsMetadata()->setPhpDoc($phpDoc);
        }
        return $method;
    }

    protected function makePhpDocFunction(string $id, ?string $phpDoc = null): PHPFunction
    {
        $function = new PHPFunction();
        $function->setId($id);
        $function->setName(ltrim($id, '\\'));
        if ($phpDoc !== null) {
            $function->initStubsMetadata()->setPhpDoc($phpDoc);
        }
        return $function;
    }

    protected function makeStubsWithClass(PHPClass $class): StubDataQueryInterface
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$class]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);
        $stubs->method('getFunctions')->willReturn([]);
        return $stubs;
    }

    protected function makeStubsWithFunction(PHPFunction $function): StubDataQueryInterface
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);
        $stubs->method('getFunctions')->willReturn([$function]);
        return $stubs;
    }
}
