<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\ParameterTypesCheck;
use StubTests\Unit\Validator\CheckTestCase;

class ParameterTypesCheckTest extends CheckTestCase
{
    public function testSupportsPhp70AndAbove(): void
    {
        $check = new ParameterTypesCheck();

        $this->assertFalse($check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_4->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testMatchingParameterTypes(): void
    {
        // Arrange
        $functionName = 'test_function';
        $stringType = $this->createType('string');
        $param = $this->createMockParameter('value', $stringType);

        $reflectionFunction = $this->createMockFunction($functionName, [$param]);
        $stubFunction = $this->createMockFunction($functionName, [$param]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParameterTypeMismatch(): void
    {
        // Arrange
        $functionName = 'test_function';
        $reflectionParam = $this->createMockParameter('value', $this->createType('string'));
        $stubParam = $this->createMockParameter('value', $this->createType('int'));

        $reflectionFunction = $this->createMockFunction($functionName, [$reflectionParam]);
        $stubFunction = $this->createMockFunction($functionName, [$stubParam]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($functionName, $failures);
        $this->assertStringContainsString('type mismatch', $failures[$functionName]);
        $this->assertStringContainsString('string', $failures[$functionName]);
        $this->assertStringContainsString('int', $failures[$functionName]);
    }

    public function testParameterCountMismatchSkipsAbsentParams(): void
    {
        // Arrange — reflection has 2 params, stubs have 1. The missing param is silently
        // skipped because ParametersCountCheck is responsible for count mismatches.
        $functionName = 'test_function';
        $param1 = $this->createMockParameter('param1', $this->createType('string'));
        $param2 = $this->createMockParameter('param2', $this->createType('int'));

        $reflectionFunction = $this->createMockFunction($functionName, [$param1, $param2]);
        $stubFunction = $this->createMockFunction($functionName, [$param1]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert — name-based matching: param1 types match, param2 absent → no failure
        $this->assertFalse($result->hasFailures());
    }

    public function testFunctionNotFoundInReflectionSucceedsSilently(): void
    {
        // Arrange — FunctionExistsCheck is responsible for existence
        $functionName = 'missing_function';
        $stubFunction = $this->createMockFunction($functionName);

        $reflectionProvider = $this->createMockReflectionProvider([]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert — silently succeeds; existence is not this check's responsibility
        $this->assertFalse($result->hasFailures());
    }

    public function testFunctionNotFoundInStubsSucceedsSilently(): void
    {
        // Arrange — FunctionExistsCheck is responsible for existence
        $functionName = 'missing_function';
        $reflectionFunction = $this->createMockFunction($functionName);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert — silently succeeds; existence is not this check's responsibility
        $this->assertFalse($result->hasFailures());
    }

    public function testHandlesMixedTypes(): void
    {
        // Arrange - parameters with no type information default to 'mixed'
        $functionName = 'test_function';
        // createMockParameter with null type returns NoType, which should be treated as 'mixed'
        $param = $this->createMockParameter('value', null);

        $reflectionFunction = $this->createMockFunction($functionName, [$param]);
        $stubFunction = $this->createMockFunction($functionName, [$param]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testHandlesUnionTypes(): void
    {
        // Arrange
        $functionName = 'test_function';
        $unionType = $this->createUnionType('string', 'int');
        $param = $this->createMockParameter('value', $unionType);

        $reflectionFunction = $this->createMockFunction($functionName, [$param]);
        $stubFunction = $this->createMockFunction($functionName, [$param]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMatchingParameterTypesForMethod(): void
    {
        // Arrange
        $methodId = 'MyClass::myMethod';
        $param = $this->createMockParameter('value', $this->createType('string'));

        $reflectionMethod = $this->createMockMethod('myMethod', [$param]);
        $reflectionClass = $this->createMockClass('MyClass', [$reflectionMethod]);

        $stubMethod = $this->createMockMethod('myMethod', [$param]);
        $stubClass = $this->createMockClass('MyClass', [$stubMethod]);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $methodId, '7.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParameterIncludedAtBoundaryVersion(): void
    {
        // removedVersion is the EXCLUSIVE upper bound (first version where param is gone).
        // removedVersion='8.3' means "available up to and including PHP 8.2".
        // version_compare('8.2','8.3','<') is true → param IS included for PHP 8.2.
        $functionName = 'imagerotate';

        // Reflection for PHP 8.2 has 4 parameters (including $ignore_transparent)
        $reflectionParam1 = $this->createMockParameter('image', $this->createType('GdImage'));
        $reflectionParam2 = $this->createMockParameter('angle', $this->createType('float'));
        $reflectionParam3 = $this->createMockParameter('background_color', $this->createType('int'));
        $reflectionParam4 = $this->createMockParameter('ignore_transparent', $this->createType('bool'));
        $reflectionFunction = $this->createMockFunction($functionName, [
            $reflectionParam1, $reflectionParam2, $reflectionParam3, $reflectionParam4
        ]);

        // Stubs have same 4 parameters; last one has removedVersion='8.3' (excluded from 8.3+, available in 8.2)
        $stubParam1 = $this->createMockParameter('image', $this->createType('GdImage'));
        $stubParam2 = $this->createMockParameter('angle', $this->createType('float'));
        $stubParam3 = $this->createMockParameter('background_color', $this->createType('int'));
        $stubParam4 = $this->createMockParameter('ignore_transparent', $this->createType('bool'), null, '8.3');

        $stubFunction = $this->createMockFunction($functionName, [
            $stubParam1, $stubParam2, $stubParam3, $stubParam4
        ]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act - Test with PHP 8.2 (phpVersion < removedVersion → parameter is included)
        $result = $check->run($stubsManager, $functionName, '8.2');

        // Assert - Should succeed because parameter with removedVersion='8.3' is included in PHP 8.2
        $this->assertFalse($result->hasFailures(), 'Expected no failures when phpVersion < removedVersion (exclusive boundary)');
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParameterExcludedAfterBoundaryVersion(): void
    {
        // Arrange - Parameter with 'to: 8.2' should be excluded in PHP 8.3
        $functionName = 'imagerotate';

        // Reflection for PHP 8.3 has 3 parameters (no $ignore_transparent)
        $reflectionParam1 = $this->createMockParameter('image', $this->createType('GdImage'));
        $reflectionParam2 = $this->createMockParameter('angle', $this->createType('float'));
        $reflectionParam3 = $this->createMockParameter('background_color', $this->createType('int'));
        $reflectionFunction = $this->createMockFunction($functionName, [
            $reflectionParam1, $reflectionParam2, $reflectionParam3
        ]);

        // Stubs have 4 parameters, with last one having removedVersion='8.2'
        $stubParam1 = $this->createMockParameter('image', $this->createType('GdImage'));
        $stubParam2 = $this->createMockParameter('angle', $this->createType('float'));
        $stubParam3 = $this->createMockParameter('background_color', $this->createType('int'));
        // Parameter available up to and including PHP 8.2 (removed in 8.3)
        $stubParam4 = $this->createMockParameter('ignore_transparent', $this->createType('bool'), null, '8.2');

        $stubFunction = $this->createMockFunction($functionName, [
            $stubParam1, $stubParam2, $stubParam3, $stubParam4
        ]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterTypesCheck($reflectionProvider);

        // Act - Test with PHP 8.3 (after boundary version)
        $result = $check->run($stubsManager, $functionName, '8.3');

        // Assert - Should succeed because parameter with 'to: 8.2' is excluded in PHP 8.3
        $this->assertFalse($result->hasFailures(), 'Expected no failures when parameter is excluded after boundary');
        $this->assertEquals(1, $result->getSuccessCount());
    }
}
