<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionReturnTypesCheck;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionReturnTypesCheckTest extends CheckTestCase
{
    public function testSupportsPhp70AndAbove(): void
    {
        $check = new FunctionReturnTypesCheck();

        $this->assertFalse($check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_4->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testMatchingReturnTypes(): void
    {
        // Arrange
        $functionName = 'test_function';
        $stringType = $this->createType('string');

        $reflectionFunction = $this->createMockFunction($functionName, [], $stringType);
        $stubFunction = $this->createMockFunction($functionName, [], $stringType);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testReturnTypeMismatch(): void
    {
        // Arrange
        $functionName = 'test_function';
        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('string'));
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('int'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($functionName, $failures);
        $this->assertStringContainsString('Return type mismatch', $failures[$functionName]);
        $this->assertStringContainsString('string', $failures[$functionName]);
        $this->assertStringContainsString('int', $failures[$functionName]);
    }

    public function testFunctionNotFoundInReflection(): void
    {
        // Arrange
        $functionName = 'missing_function';
        $stubFunction = $this->createMockFunction($functionName);

        $reflectionProvider = $this->createMockReflectionProvider([]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertStringContainsString('not found in reflection data', $failures[$functionName]);
    }

    public function testFunctionNotFoundInStubs(): void
    {
        // Existence is FunctionExistsCheck's responsibility — silently succeed
        $functionName = 'missing_function';
        $reflectionFunction = $this->createMockFunction($functionName);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testHandlesMixedReturnType(): void
    {
        // Arrange - functions with no return type default to 'mixed'
        $functionName = 'test_function';
        // createMockFunction with null return type should default to 'mixed' in getReturnTypeString
        $reflectionFunction = $this->createMockFunction($functionName, [], null);
        $stubFunction = $this->createMockFunction($functionName, [], null);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testHandlesVoidReturnType(): void
    {
        // Arrange
        $functionName = 'test_function';
        $voidType = $this->createType('void');

        $reflectionFunction = $this->createMockFunction($functionName, [], $voidType);
        $stubFunction = $this->createMockFunction($functionName, [], $voidType);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.1');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testHandlesUnionReturnTypes(): void
    {
        // Arrange
        $functionName = 'test_function';
        $unionType = $this->createUnionType('string', 'int');

        $reflectionFunction = $this->createMockFunction($functionName, [], $unionType);
        $stubFunction = $this->createMockFunction($functionName, [], $unionType);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testHandlesNullableReturnTypes(): void
    {
        // Arrange
        $functionName = 'test_function';
        $nullableType = $this->createNullableType('string');

        $reflectionFunction = $this->createMockFunction($functionName, [], $nullableType);
        $stubFunction = $this->createMockFunction($functionName, [], $nullableType);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.1');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testPhp7xReturnTypeNotAvailableInReflection(): void
    {
        // Arrange - PHP 7.x special case
        // In PHP 7.x, return types for internal functions weren't available via Reflection API
        // Reflection returns null/mixed, stub has any return type - should succeed with special message
        $functionName = 'test_function';

        // Reflection has no type (null -> mixed)
        $reflectionFunction = $this->createMockFunction($functionName, [], null);
        // Stub has return type (string)
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('string'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Test for various PHP 7.x versions
        foreach (['7.0', '7.1', '7.2', '7.3', '7.4'] as $phpVersion) {
            // Act
            $result = $check->run($stubsManager, $functionName, $phpVersion);

            // Assert
            $this->assertFalse($result->hasFailures(), "Failed for PHP {$phpVersion}");
            $this->assertEquals(1, $result->getSuccessCount());

            // Verify success message indicates PHP 7.x special handling
            $successes = $result->getSuccesses();
            $this->assertCount(1, $successes);
            $this->assertStringContainsString('PHP 7.x', $successes[0]);
            $this->assertStringContainsString('return type not available in Reflection API', $successes[0]);
        }
    }

    public function testPhp7xReturnTypeWorksForVariousTypes(): void
    {
        // Test various return types: scalar types, array, callable
        $returnTypes = ['string', 'int', 'float', 'bool', 'array', 'callable'];

        foreach ($returnTypes as $returnType) {
            // Arrange
            $functionName = 'test_function_' . $returnType;

            // Reflection has no type (null -> mixed)
            $reflectionFunction = $this->createMockFunction($functionName, [], null);
            // Stub has return type
            $stubFunction = $this->createMockFunction($functionName, [], $this->createType($returnType));

            $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
            $stubsManager = $this->createMockStorageManager();
            $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

            $check = new FunctionReturnTypesCheck($reflectionProvider);

            // Act - test with PHP 7.4 as representative of PHP 7.x
            $result = $check->run($stubsManager, $functionName, '7.4');

            // Assert
            $this->assertFalse(
                $result->hasFailures(),
                "Failed for return type: {$returnType}"
            );
            $this->assertEquals(1, $result->getSuccessCount());
        }
    }

    public function testPhp7xMixedReturnTypeBothSidesMatches(): void
    {
        // Arrange - PHP 7.x when both reflection and stub have no type (mixed)
        $functionName = 'test_function';

        // Both reflection and stub have no type (null -> mixed)
        $reflectionFunction = $this->createMockFunction($functionName, [], null);
        $stubFunction = $this->createMockFunction($functionName, [], null);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '7.4');

        // Assert - should succeed because both are mixed
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testPhp80ReturnTypeValidatedNormally(): void
    {
        // Arrange - PHP 8.0 should skip validation when reflection has no type info
        // Note: PHP 8.0 has 59 functions without return type declarations (e.g., finfo_open, fopen, etc.)
        // This is NOT a failure - it's expected behavior when reflection lacks type information
        $functionName = 'test_function';

        // Reflection has no type (null - no type information available)
        $reflectionFunction = $this->createMockFunction($functionName, [], null);
        // Stub has return type (string) - correctly documents the type
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('string'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - should succeed with note that type info is not available in reflection
        // This matches the reality that many PHP 8.0 functions don't have return types
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());

        // Verify message indicates PHP 8.0 special handling
        $successes = $result->getSuccesses();
        $this->assertCount(1, $successes);
        $this->assertStringContainsString('PHP 8.0', $successes[0]);
        $this->assertStringContainsString('return type not available in Reflection API', $successes[0]);
    }

    public function testLanguageLevelTypeAwareWithDefaultType(): void
    {
        // Arrange - function with LanguageLevelTypeAware: ['8.4' => 'true'], default: 'bool'
        // For PHP 8.0, should use default 'bool'
        $functionName = 'test_function';

        // Create stub function with LanguageLevelTypeAware data
        $stubFunction = $this->createMockFunctionWithVersionAwareType(
            $functionName,
            null, // no signature type
            ['8.4' => 'true'],
            'bool'
        );

        // Reflection returns 'bool'
        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('bool'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act - test with PHP 8.0 (should use default 'bool')
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - should succeed because both are 'bool'
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testLanguageLevelTypeAwareWithVersionSpecificType(): void
    {
        // Arrange - function with LanguageLevelTypeAware: ['8.4' => 'true'], default: 'bool'
        // For PHP 8.4, should use version-specific 'true'
        $functionName = 'test_function';

        // Create stub function with LanguageLevelTypeAware data
        $stubFunction = $this->createMockFunctionWithVersionAwareType(
            $functionName,
            null, // no signature type
            ['8.4' => 'true'],
            'bool'
        );

        // Reflection returns 'true' (literal true type in PHP 8.4+)
        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('true'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act - test with PHP 8.4 (should use version-specific 'true')
        $result = $check->run($stubsManager, $functionName, '8.4');

        // Assert - should succeed because both are 'true'
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testLanguageLevelTypeAwareWithMultipleVersions(): void
    {
        // Arrange - function with multiple version-specific types
        // ['7.4' => 'int', '8.0' => 'bool'], default: 'mixed'
        $functionName = 'test_function';

        // Create stub function with LanguageLevelTypeAware data
        $stubFunction = $this->createMockFunctionWithVersionAwareType(
            $functionName,
            null,
            ['7.4' => 'int', '8.0' => 'bool'],
            'mixed'
        );

        $reflectionProvider = $this->createMockReflectionProvider([]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Test PHP 7.3: should use default 'mixed'
        $reflectionFunction73 = $this->createMockFunction($functionName, [], null); // null = mixed
        $reflectionProvider73 = $this->createMockReflectionProvider([$reflectionFunction73]);
        $check73 = new FunctionReturnTypesCheck($reflectionProvider73);
        $result73 = $check73->run($stubsManager, $functionName, '7.3');
        $this->assertFalse($result73->hasFailures());

        // Test PHP 7.4: should use 'int'
        $reflectionFunction74 = $this->createMockFunction($functionName, [], $this->createType('int'));
        $reflectionProvider74 = $this->createMockReflectionProvider([$reflectionFunction74]);
        $check74 = new FunctionReturnTypesCheck($reflectionProvider74);
        $result74 = $check74->run($stubsManager, $functionName, '7.4');
        $this->assertFalse($result74->hasFailures());

        // Test PHP 7.5: should still use 'int' (highest version <= 7.5 is 7.4)
        $reflectionFunction75 = $this->createMockFunction($functionName, [], $this->createType('int'));
        $reflectionProvider75 = $this->createMockReflectionProvider([$reflectionFunction75]);
        $check75 = new FunctionReturnTypesCheck($reflectionProvider75);
        $result75 = $check75->run($stubsManager, $functionName, '7.5');
        $this->assertFalse($result75->hasFailures());

        // Test PHP 8.0: should use 'bool' (highest version <= 8.0 is 8.0)
        $reflectionFunction80 = $this->createMockFunction($functionName, [], $this->createType('bool'));
        $reflectionProvider80 = $this->createMockReflectionProvider([$reflectionFunction80]);
        $check80 = new FunctionReturnTypesCheck($reflectionProvider80);
        $result80 = $check80->run($stubsManager, $functionName, '8.0');
        $this->assertFalse($result80->hasFailures());

        // Test PHP 8.1: should still use 'bool' (highest version <= 8.1 is 8.0)
        $reflectionFunction81 = $this->createMockFunction($functionName, [], $this->createType('bool'));
        $reflectionProvider81 = $this->createMockReflectionProvider([$reflectionFunction81]);
        $check81 = new FunctionReturnTypesCheck($reflectionProvider81);
        $result81 = $check81->run($stubsManager, $functionName, '8.1');
        $this->assertFalse($result81->hasFailures());
    }

    public function testSignatureTypeTakesPrecedenceOverLanguageLevelTypeAware(): void
    {
        // Arrange - function with BOTH signature type AND LanguageLevelTypeAware
        // Signature type should take precedence
        $functionName = 'test_function';

        // Create stub function with signature type 'string' AND version-aware data
        $stubFunction = $this->createMockFunctionWithVersionAwareType(
            $functionName,
            $this->createType('string'), // explicit signature type
            ['8.4' => 'bool'],
            'int'
        );

        // Reflection returns 'string'
        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('string'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act - signature type 'string' should be used, not version-aware 'bool'
        $result = $check->run($stubsManager, $functionName, '8.4');

        // Assert - should succeed because both use signature type 'string'
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ========================================
    // COMPREHENSIVE TESTS FOR FRAMEWORK CHANGES
    // ========================================

    // ------------------------------------
    // Category 1: Null Return Type Handling
    // ------------------------------------

    public function testReflectionNullStubHasType_Php7x(): void
    {
        $functionName = 'legacy_function';

        // Test all PHP 7.x versions
        foreach (['7.0', '7.1', '7.2', '7.3', '7.4'] as $phpVersion) {
            // Reflection has no type (null - no type info available)
            $reflectionFunction = $this->createMockFunction($functionName, [], null);
            // Stub documents the type (string)
            $stubFunction = $this->createMockFunction($functionName, [], $this->createType('string'));

            $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
            $stubsManager = $this->createMockStorageManager();
            $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

            $check = new FunctionReturnTypesCheck($reflectionProvider);

            // Act
            $result = $check->run($stubsManager, $functionName, $phpVersion);

            // Assert
            $this->assertFalse($result->hasFailures(), "PHP {$phpVersion} should not fail");
            $this->assertEquals(1, $result->getSuccessCount());

            // Verify message uses "PHP 7.x" consistently
            $successes = $result->getSuccesses();
            $this->assertCount(1, $successes);
            $this->assertStringContainsString('PHP 7.x', $successes[0], "PHP {$phpVersion} message should say 'PHP 7.x'");
            $this->assertStringContainsString('return type not available', $successes[0]);
        }
    }

    public function testReflectionNullStubHasType_Php80(): void
    {
        // Arrange - simulates finfo_open in PHP 8.0
        $functionName = 'finfo_open';

        // Reflection has no type (null - common in PHP 8.0, 59 functions affected)
        $reflectionFunction = $this->createMockFunction($functionName, [], null);
        // Stub correctly documents the type
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('resource|false'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());

        // Verify message specifies PHP 8.0
        $successes = $result->getSuccesses();
        $this->assertCount(1, $successes);
        $this->assertStringContainsString('PHP 8.0', $successes[0]);
        $this->assertStringContainsString('return type not available', $successes[0]);
    }

    public function testReflectionNullStubHasType_Php81Plus(): void
    {
        $functionName = 'some_function';

        // Test PHP 8.1+
        foreach (['8.1', '8.2', '8.3', '8.4'] as $phpVersion) {
            // Reflection has no type
            $reflectionFunction = $this->createMockFunction($functionName, [], null);
            // Stub has type
            $stubFunction = $this->createMockFunction($functionName, [], $this->createType('string'));

            $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
            $stubsManager = $this->createMockStorageManager();
            $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

            $check = new FunctionReturnTypesCheck($reflectionProvider);

            // Act
            $result = $check->run($stubsManager, $functionName, $phpVersion);

            // Assert
            $this->assertFalse($result->hasFailures(), "PHP {$phpVersion} should not fail");
            $this->assertEquals(1, $result->getSuccessCount());

            // Verify message specifies exact PHP version
            $successes = $result->getSuccesses();
            $this->assertStringContainsString("PHP {$phpVersion}", $successes[0]);
        }
    }

    public function testBothReflectionAndStubNull(): void
    {
        // Arrange - both have no type information (agreement)
        $functionName = 'test_function';

        $reflectionFunction = $this->createMockFunction($functionName, [], null);
        $stubFunction = $this->createMockFunction($functionName, [], null);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - should succeed (both agree there's no type)
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());

        // Should NOT have special message (just normal success)
        $successes = $result->getSuccesses();
        $this->assertStringNotContainsString('return type not available', $successes[0]);
    }

    public function testStubNullReflectionHasType(): void
    {
        // Arrange - reflection has type but stub doesn't document it (bad)
        $functionName = 'test_function';

        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('string'));
        $stubFunction = $this->createMockFunction($functionName, [], null);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - should fail (stub should document the type)
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertStringContainsString('Return type mismatch', $failures[$functionName]);
    }

    // ------------------------------------
    // Category 2: Explicit Mixed Type Handling
    // ------------------------------------

    public function testExplicitMixedInBoth(): void
    {
        // Arrange
        $functionName = 'test_function';

        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('mixed'));
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('mixed'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - explicit 'mixed' should match
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMixedInReflectionStringInStub(): void
    {
        // Arrange
        $functionName = 'test_function';

        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('mixed'));
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('string'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - 'mixed' ≠ 'string'
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());
    }

    public function testMixedDoesNotEqualNull(): void
    {
        // Arrange - explicit 'mixed' is different from no type info (null)
        $functionName = 'test_function';

        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('mixed'));
        $stubFunction = $this->createMockFunction($functionName, [], null);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - should fail (explicit 'mixed' ≠ no type)
        $this->assertTrue($result->hasFailures());
    }

    // ------------------------------------
    // Category 3: Regression Tests
    // ------------------------------------

    public function testMatchingTypesStillWork(): void
    {
        // Arrange
        $functionName = 'test_function';

        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('string'));
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('string'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - basic matching still works
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMismatchStillDetected(): void
    {
        // Arrange
        $functionName = 'test_function';

        $reflectionFunction = $this->createMockFunction($functionName, [], $this->createType('string'));
        $stubFunction = $this->createMockFunction($functionName, [], $this->createType('int'));

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.0');

        // Assert - mismatches still detected
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertStringContainsString('string', $failures[$functionName]);
        $this->assertStringContainsString('int', $failures[$functionName]);
    }

    public function testComplexUnionTypeMatching(): void
    {
        // Arrange - complex union types should match after normalization
        $functionName = 'test_function';

        // Order and leading backslashes should not matter
        $reflectionFunction = $this->createMockFunction(
            $functionName,
            [],
            $this->createType('false|Dom\Element|\Dom\Attr')
        );
        $stubFunction = $this->createMockFunction(
            $functionName,
            [],
            $this->createType('\Dom\Attr|\Dom\Element|false')
        );

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new FunctionReturnTypesCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $functionName, '8.4');

        // Assert - should match after normalization (sorting + FQN stripping)
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    /**
     * Create a real PHPFunction with LanguageLevelTypeAware data set via StubsMetadata.
     */
    private function createMockFunctionWithVersionAwareType(
        string $name,
        $signatureType = null,
        ?array $languageLevelTypes = null,
        ?string $defaultType = null
    ): \StubTests\Framework\Parsers\Model\PHPFunction {
        $function = new \StubTests\Framework\Parsers\Model\PHPFunction();
        $function->setId($name);
        $function->setName($name);
        $function->setParameters([]);

        if ($signatureType !== null) {
            $function->setReturnTypeFromSignature($signatureType);
        }

        $function->initStubsMetadata()->setLanguageLevelTypes($languageLevelTypes);
        $function->initStubsMetadata()->setDefaultType($defaultType);

        return $function;
    }
}
