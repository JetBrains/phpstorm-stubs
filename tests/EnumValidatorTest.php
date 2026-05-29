<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Enums\EnumCasesCheck;
use StubTests\Framework\Validator\Enums\EnumInterfacesCheck;
use StubTests\Framework\Validator\EntityExistsCheck;
use StubTests\Framework\Validator\EntityNamespaceCheck;
use StubTests\Framework\Validator\Classes\ClassFinalCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassStaticMethodsCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassFinalMethodsCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsVisibilityCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsExistCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParametersCountCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterNamesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDefaultValueCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsOptionalParametersCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterTypesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsReturnTypesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsTentativeReturnTypeCheck;
use StubTests\Framework\Validator\Classes\Methods\MethodDeprecationCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDeprecationCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsValueCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsVisibilityCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsPhpDocConformsSignatureCheck;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;
use StubTests\ValidatorTestBase;

/**
 * Validates that enums from reflection exist in stubs and their methods are correct.
 *
 * Enums were introduced in PHP 8.1, so most checks use PHP_8_1 as the lower bound.
 *
 * Each enum is tested individually as a separate test case,
 * making it easy to identify failures and re-run specific tests.
 */
class EnumValidatorTest extends ValidatorTestBase
{
    private static function enumConfig(): EntityTypeConfig
    {
        return EntityTypeConfig::forEnum();
    }

    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    protected static function getEntitiesForMethod(string $methodName, StubDataQueryInterface $reflection): iterable
    {
        return $reflection->getEnums();
    }

    protected static function getCheckDescriptors(): array
    {
        $e = self::enumConfig();
        return [
            // Non-trivial checks (kept as dedicated enum classes)
            'checkEnumCases' => new CheckDescriptor(EnumCasesCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} cases check failed in PHP {phpVersion}'),
            'checkEnumExists' => new CheckDescriptor(EntityExistsCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} exists in PHP {phpVersion} but not in stubs', $e),
            'checkEnumNamespace' => new CheckDescriptor(EntityNamespaceCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} namespace validation failed in PHP {phpVersion}', $e),
            'checkEnumInterfaces' => new CheckDescriptor(EnumInterfacesCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} interfaces check failed in PHP {phpVersion}'),

            // Config-driven checks (using Class checks with EntityTypeConfig::forEnum())
            'checkEnumMethodsExist' => new CheckDescriptor(ClassMethodsExistCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods check failed in PHP {phpVersion}', $e),
            'checkEnumStaticMethods' => new CheckDescriptor(ClassStaticMethodsCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} static methods check failed in PHP {phpVersion}', $e),
            'checkEnumFinal' => new CheckDescriptor(ClassFinalCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} final validation failed in PHP {phpVersion}', $e),
            'checkEnumFinalMethods' => new CheckDescriptor(ClassFinalMethodsCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} final methods check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsVisibility' => new CheckDescriptor(ClassMethodsVisibilityCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods visibility check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsDeprecation' => new CheckDescriptor(MethodDeprecationCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods deprecation check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsParameterDeprecation' => new CheckDescriptor(ClassMethodsParameterDeprecationCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods parameter deprecation check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsParametersCount' => new CheckDescriptor(ClassMethodsParametersCountCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods parameters count check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsReturnTypes' => new CheckDescriptor(ClassMethodsReturnTypesCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods return type check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsParameterTypes' => new CheckDescriptor(ClassMethodsParameterTypesCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods parameter types check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsOptionalParameters' => new CheckDescriptor(ClassMethodsOptionalParametersCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods optional parameters check failed in PHP {phpVersion}', $e),
            'checkEnumConstants' => new CheckDescriptor(ClassConstantsCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} constants check failed in PHP {phpVersion}', $e),
            'checkEnumConstantsVisibility' => new CheckDescriptor(ClassConstantsVisibilityCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} constants visibility check failed in PHP {phpVersion}', $e),
            'checkEnumConstantsValue' => new CheckDescriptor(ClassConstantsValueCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} constants value check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsParameterNames' => new CheckDescriptor(ClassMethodsParameterNamesCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods parameter names check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsTentativeReturnType' => new CheckDescriptor(ClassMethodsTentativeReturnTypeCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} methods tentative return type check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsParameterDefaultValue' => new CheckDescriptor(ClassMethodsParameterDefaultValueCheck::class, PhpVersions::LATEST, PhpVersions::LATEST, 'Enum {entityId} methods parameter default value check failed in PHP {phpVersion}', $e),
            'checkEnumMethodsPhpDocConformsSignature' => new CheckDescriptor(ClassMethodsPhpDocConformsSignatureCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Enum {entityId} PhpDoc/signature type mismatch in PHP {phpVersion}', $e)
        ];
    }
}
