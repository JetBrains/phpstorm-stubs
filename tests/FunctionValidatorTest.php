<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionDeprecationCheck;
use StubTests\Framework\Validator\Functions\FunctionExistsCheck;
use StubTests\Framework\Validator\Functions\FunctionOptionalParametersCheck;
use StubTests\Framework\Validator\Functions\FunctionParametersCountCheck;
use StubTests\Framework\Validator\Functions\FunctionTentativeReturnTypeCheck;
use StubTests\Framework\Validator\Functions\FunctionParameterDefaultValueCheck;
use StubTests\Framework\Validator\Functions\ParameterNamesCheck;
use StubTests\Framework\Validator\Functions\ParameterTypesCheck;
use StubTests\Framework\Validator\Functions\FunctionReturnTypesCheck;
use StubTests\Framework\Validator\Functions\FunctionParameterDeprecationCheck;
use StubTests\Framework\Validator\Functions\FunctionPhpDocConformsSignatureCheck;
use StubTests\Framework\Validator\Functions\FunctionSpecialTypeHintsCheck;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;

/**
 * Validates that functions from reflection match stubs.
 *
 * Each function is tested individually as a separate test case,
 * making it easy to identify failures and re-run specific tests.
 */
class FunctionValidatorTest extends ValidatorTestBase
{
    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    protected static function getEntitiesForMethod(string $methodName, StubDataQueryInterface $reflection): iterable
    {
        return $reflection->getFunctions();
    }

    protected static function getCheckDescriptors(): array
    {
        return [
            'checkFunctionExists' => new CheckDescriptor(FunctionExistsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} exists in PHP {phpVersion} but not in stubs'),
            'checkParameterNames' => new CheckDescriptor(ParameterNamesCheck::class, PhpVersions::PHP_8_0, PhpVersions::LATEST, 'Function {entityId} has mismatched parameter names in PHP {phpVersion}'),
            'checkParameterTypes' => new CheckDescriptor(ParameterTypesCheck::class, PhpVersions::PHP_7_0, PhpVersions::LATEST, 'Function {entityId} has mismatched parameter types in PHP {phpVersion}'),
            'checkReturnTypes' => new CheckDescriptor(FunctionReturnTypesCheck::class, PhpVersions::PHP_7_0, PhpVersions::LATEST, 'Function {entityId} has mismatched return type in PHP {phpVersion}'),
            'checkFunctionsDeprecation' => new CheckDescriptor(FunctionDeprecationCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} deprecation mismatch in PHP {phpVersion}'),
            'checkFunctionParameterDeprecation' => new CheckDescriptor(FunctionParameterDeprecationCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} parameter deprecation mismatch in PHP {phpVersion}'),
            'checkFunctionParametersCount' => new CheckDescriptor(FunctionParametersCountCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} has parameter count mismatch in PHP {phpVersion}'),
            'checkFunctionOptionalParameters' => new CheckDescriptor(FunctionOptionalParametersCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} optional parameters check failed in PHP {phpVersion}'),
            'checkFunctionTentativeReturnType' => new CheckDescriptor(FunctionTentativeReturnTypeCheck::class, PhpVersions::LATEST, PhpVersions::LATEST, 'Function {entityId} tentative return type check failed in PHP {phpVersion}'),
            'checkFunctionParameterDefaultValue' => new CheckDescriptor(FunctionParameterDefaultValueCheck::class, PhpVersions::LATEST, PhpVersions::LATEST, 'Function {entityId} parameter default value check failed in PHP {phpVersion}'),
            'checkFunctionPhpDocConformsSignature' => new CheckDescriptor(FunctionPhpDocConformsSignatureCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} PhpDoc/signature type mismatch in PHP {phpVersion}'),
            // Array-traversal functions (end, prev, next, reset, current) must declare
            // 'mixed|false' in PhpDoc @return — the broad 'mixed' erases the 'false' case.
            // See: https://youtrack.jetbrains.com/issue/WI-57991
            'checkSpecialTypeHints' => new CheckDescriptor(FunctionSpecialTypeHintsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} special type hints check failed in PHP {phpVersion}'),
        ];
    }
}
