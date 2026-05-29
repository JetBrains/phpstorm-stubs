<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityExistsCheck;
use StubTests\Framework\Validator\EntityNamespaceCheck;
use StubTests\Framework\Validator\Interfaces\InterfaceParentInterfacesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsExistCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassStaticMethodsCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParametersCountCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsReturnTypesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterTypesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDefaultValueCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterNamesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsOptionalParametersCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsTentativeReturnTypeCheck;
use StubTests\Framework\Validator\Classes\Methods\MethodDeprecationCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDeprecationCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsValueCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsVisibilityCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsNullableTypeForbiddenCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsPhpDocConformsSignatureCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsReturnTypeForbiddenCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsScalarTypeForbiddenCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsUnionTypeForbiddenCheck;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;
use StubTests\ValidatorTestBase;

/**
 * Validates that interfaces from reflection exist in stubs and their methods are correct.
 *
 * Each interface is tested individually as a separate test case,
 * making it easy to identify failures and re-run specific tests.
 */
class InterfaceValidatorTest extends ValidatorTestBase
{
    private static function interfaceConfig(): EntityTypeConfig
    {
        return EntityTypeConfig::forInterface();
    }

    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    protected static function getEntitiesForMethod(string $methodName, StubDataQueryInterface $reflection): iterable
    {
        return $reflection->getInterfaces();
    }

    protected static function getCheckDescriptors(): array
    {
        $i = self::interfaceConfig();
        return [
            // Non-trivial checks (kept as dedicated interface classes)
            'checkInterfaceExists' => new CheckDescriptor(EntityExistsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} exists in PHP {phpVersion} but not in stubs', $i),
            'checkInterfaceNamespace' => new CheckDescriptor(EntityNamespaceCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} namespace validation failed in PHP {phpVersion}', $i),
            'checkInterfaceParent' => new CheckDescriptor(InterfaceParentInterfacesCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} parent interfaces check failed in PHP {phpVersion}'),

            // Config-driven checks (using Class checks with EntityTypeConfig::forInterface())
            'checkInterfaceMethodsExist' => new CheckDescriptor(ClassMethodsExistCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} methods check failed in PHP {phpVersion}', $i),
            'checkInterfaceStaticMethods' => new CheckDescriptor(ClassStaticMethodsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} static methods check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsParametersCount' => new CheckDescriptor(ClassMethodsParametersCountCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} methods parameters count check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsReturnTypes' => new CheckDescriptor(ClassMethodsReturnTypesCheck::class, PhpVersions::PHP_7_0, PhpVersions::LATEST, 'Interface {entityId} methods return type check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsDeprecation' => new CheckDescriptor(MethodDeprecationCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} methods deprecation check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsParameterDeprecation' => new CheckDescriptor(ClassMethodsParameterDeprecationCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} methods parameter deprecation check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsParameterTypes' => new CheckDescriptor(ClassMethodsParameterTypesCheck::class, PhpVersions::PHP_7_0, PhpVersions::LATEST, 'Interface {entityId} methods parameter types check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsOptionalParameters' => new CheckDescriptor(ClassMethodsOptionalParametersCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} methods optional parameters check failed in PHP {phpVersion}', $i),
            'checkInterfaceConstants' => new CheckDescriptor(ClassConstantsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} constants check failed in PHP {phpVersion}', $i),
            'checkInterfaceConstantsVisibility' => new CheckDescriptor(ClassConstantsVisibilityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} constants visibility check failed in PHP {phpVersion}', $i),
            'checkInterfaceConstantsValue' => new CheckDescriptor(ClassConstantsValueCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} constants value check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsParameterNames' => new CheckDescriptor(ClassMethodsParameterNamesCheck::class, PhpVersions::PHP_8_0, PhpVersions::LATEST, 'Interface {entityId} methods parameter names check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsTentativeReturnType' => new CheckDescriptor(ClassMethodsTentativeReturnTypeCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Interface {entityId} methods tentative return type check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsParameterDefaultValue' => new CheckDescriptor(ClassMethodsParameterDefaultValueCheck::class, PhpVersions::LATEST, PhpVersions::LATEST, 'Interface {entityId} methods parameter default value check failed in PHP {phpVersion}', $i),
            'checkInterfaceMethodsPhpDocConformsSignature' => new CheckDescriptor(ClassMethodsPhpDocConformsSignatureCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} PhpDoc/signature type mismatch in PHP {phpVersion}', $i),
            'checkMethodDoesNotHaveReturnTypeHint' => new CheckDescriptor(ClassMethodsReturnTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::EARLIEST, 'Interface {entityId} has method with return type hint available before PHP 7.0 in PHP {phpVersion}', $i),
            'checkMethodDoesNotHaveScalarParamTypeHint' => new CheckDescriptor(ClassMethodsScalarTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::EARLIEST, 'Interface {entityId} has method with scalar parameter type hint available before PHP 7.0 in PHP {phpVersion}', $i),
            'checkMethodDoesNotHaveNullableTypeHint' => new CheckDescriptor(ClassMethodsNullableTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::PHP_7_0, 'Interface {entityId} has method with nullable type hint available before PHP 7.1 in PHP {phpVersion}', $i),
            'checkMethodDoesNotHaveUnionTypeHint' => new CheckDescriptor(ClassMethodsUnionTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::PHP_7_4, 'Interface {entityId} has method with union type hint available before PHP 8.0 in PHP {phpVersion}', $i),
        ];
    }
}
