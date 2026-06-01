<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\ClassInterfacesCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityExistsCheck;
use StubTests\Framework\Validator\EntityNamespaceCheck;
use StubTests\Framework\Validator\Classes\ClassParentClassCheck;
use StubTests\Framework\Validator\Classes\ClassReadonlyCheck;
use StubTests\Framework\Validator\Classes\ClassFinalCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassFinalMethodsCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsExistCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsVisibilityCheck;
use StubTests\Framework\Validator\Classes\Properties\ClassStaticPropertiesCheck;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertiesExistCheck;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertiesVisibilityCheck;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertiesTypeCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParametersCountCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsReturnTypesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsOptionalParametersCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterTypesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDefaultValueCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterNamesCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsTentativeReturnTypeCheck;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertyReadonlyCheck;
use StubTests\Framework\Validator\Classes\Methods\MethodDeprecationCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterDeprecationCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassStaticMethodsCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsValueCheck;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsVisibilityCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsNullableTypeForbiddenCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsReturnTypeForbiddenCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsScalarTypeForbiddenCheck;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsUnionTypeForbiddenCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsPhpDocConformsSignatureCheck;
use StubTests\Framework\Validator\Classes\Methods\ReflectionMethodSpecialTypeHintsCheck;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;
use StubTests\ValidatorTestBase;

/**
 * Validates that classes from reflection exist in stubs.
 *
 * Each class is tested individually as a separate test case,
 * making it easy to identify failures and re-run specific tests.
 */
class ClassValidatorTest extends ValidatorTestBase
{
    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    protected static function getEntitiesForMethod(string $methodName, StubDataQueryInterface $reflection): iterable
    {
        return $reflection->getClasses();
    }

    protected static function getCheckDescriptors(): array
    {
        return [
            'checkClassExists' => new CheckDescriptor(EntityExistsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} exists in PHP {phpVersion} but not in stubs', EntityTypeConfig::forClass()),
            'checkClassNamespace' => new CheckDescriptor(EntityNamespaceCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} namespace validation failed in PHP {phpVersion}', EntityTypeConfig::forClass()),
            'checkClassReadonly' => new CheckDescriptor(ClassReadonlyCheck::class, PhpVersions::PHP_8_2, PhpVersions::LATEST, 'Class {entityId} readonly validation failed in PHP {phpVersion}'),
            'checkClassFinal' => new CheckDescriptor(ClassFinalCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} final validation failed in PHP {phpVersion}'),
            'checkParentClass' => new CheckDescriptor(ClassParentClassCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} parent class validation failed in PHP {phpVersion}'),
            'checkClassInterfaces' => new CheckDescriptor(ClassInterfacesCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} interfaces validation failed in PHP {phpVersion}'),
            'checkClassesMethodsExist' => new CheckDescriptor(ClassMethodsExistCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} methods check failed in PHP {phpVersion}'),
            'checkClassesFinalMethods' => new CheckDescriptor(ClassFinalMethodsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} final methods check failed in PHP {phpVersion}'),
            'checkClassesStaticMethods' => new CheckDescriptor(ClassStaticMethodsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} static methods check failed in PHP {phpVersion}'),
            'checkClassProperties' => new CheckDescriptor(ClassPropertiesExistCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} properties check failed in PHP {phpVersion}'),
            'checkClassesMethodsVisibility' => new CheckDescriptor(ClassMethodsVisibilityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} methods visibility check failed in PHP {phpVersion}'),
            'checkClassStaticProperties' => new CheckDescriptor(ClassStaticPropertiesCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} static properties check failed in PHP {phpVersion}'),
            'checkClassPropertiesVisibility' => new CheckDescriptor(ClassPropertiesVisibilityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} properties visibility check failed in PHP {phpVersion}'),
            'checkClassPropertiesType' => new CheckDescriptor(ClassPropertiesTypeCheck::class, PhpVersions::PHP_7_4, PhpVersions::LATEST, 'Class {entityId} properties type check failed in PHP {phpVersion}'),
            'checkClassMethodsParametersCount' => new CheckDescriptor(ClassMethodsParametersCountCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} methods parameters count check failed in PHP {phpVersion}'),
            'checkClassMethodsReturnTypes' => new CheckDescriptor(ClassMethodsReturnTypesCheck::class, PhpVersions::PHP_7_0, PhpVersions::LATEST, 'Class {entityId} methods return type check failed in PHP {phpVersion}'),
            'checkMethodsDeprecation' => new CheckDescriptor(MethodDeprecationCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} methods deprecation check failed in PHP {phpVersion}'),
            'checkClassMethodsParameterDeprecation' => new CheckDescriptor(ClassMethodsParameterDeprecationCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} methods parameter deprecation check failed in PHP {phpVersion}'),
            'checkClassMethodsParameterTypes' => new CheckDescriptor(ClassMethodsParameterTypesCheck::class, PhpVersions::PHP_7_0, PhpVersions::LATEST, 'Class {entityId} methods parameter types check failed in PHP {phpVersion}'),
            'checkClassMethodsOptionalParameters' => new CheckDescriptor(ClassMethodsOptionalParametersCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} methods optional parameters check failed in PHP {phpVersion}'),
            'checkClassConstants' => new CheckDescriptor(ClassConstantsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} constants check failed in PHP {phpVersion}'),
            'checkClassConstantsVisibility' => new CheckDescriptor(ClassConstantsVisibilityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} constants visibility check failed in PHP {phpVersion}'),
            'checkClassConstantsValue' => new CheckDescriptor(ClassConstantsValueCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} constants value check failed in PHP {phpVersion}'),
            'checkClassMethodsParameterNames' => new CheckDescriptor(ClassMethodsParameterNamesCheck::class, PhpVersions::PHP_8_0, PhpVersions::LATEST, 'Class {entityId} methods parameter names check failed in PHP {phpVersion}'),
            'checkClassMethodsTentativeReturnType' => new CheckDescriptor(ClassMethodsTentativeReturnTypeCheck::class, PhpVersions::LATEST, PhpVersions::LATEST, 'Class {entityId} methods tentative return type check failed in PHP {phpVersion}'),
            'checkClassPropertyReadonly' => new CheckDescriptor(ClassPropertyReadonlyCheck::class, PhpVersions::PHP_8_1, PhpVersions::LATEST, 'Class {entityId} property readonly check failed in PHP {phpVersion}'),
            'checkClassMethodsParameterDefaultValue' => new CheckDescriptor(ClassMethodsParameterDefaultValueCheck::class, PhpVersions::LATEST, PhpVersions::LATEST, 'Class {entityId} methods parameter default value check failed in PHP {phpVersion}'),
            'checkClassMethodsPhpDocConformsSignature' => new CheckDescriptor(ClassMethodsPhpDocConformsSignatureCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} PhpDoc/signature type mismatch in PHP {phpVersion}'),
            // Reflection API methods returning type information must include concrete subtypes
            // (ReflectionNamedType, ReflectionUnionType, ReflectionIntersectionType), not just ReflectionType.
            // See: https://youtrack.jetbrains.com/issue/WI-61052
            'checkClassMethodsReflectionTypeHints' => new CheckDescriptor(ReflectionMethodSpecialTypeHintsCheck::class, PhpVersions::LATEST, PhpVersions::LATEST, 'Class {entityId} Reflection method special type hints check failed in PHP {phpVersion}'),
            // Methods available before PHP 7.0 must not declare return type hints (introduced in 7.0).
            'checkMethodDoesNotHaveReturnTypeHint' => new CheckDescriptor(ClassMethodsReturnTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::EARLIEST, 'Class {entityId} has overridable method with return type hint available before PHP 7.0 in PHP {phpVersion}'),
            // Methods available before PHP 7.0 must not use scalar parameter type hints (int, float, string, bool).
            'checkMethodDoesNotHaveScalarParamTypeHint' => new CheckDescriptor(ClassMethodsScalarTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::EARLIEST, 'Class {entityId} has overridable method with scalar parameter type hint available before PHP 7.0 in PHP {phpVersion}'),
            // Methods available before PHP 7.1 must not use nullable type hints (?T syntax).
            'checkMethodDoesNotHaveNullableTypeHint' => new CheckDescriptor(ClassMethodsNullableTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::PHP_7_0, 'Class {entityId} has overridable method with nullable type hint available before PHP 7.1 in PHP {phpVersion}'),
            // Methods available before PHP 8.0 must not use union type hints (T1|T2 syntax).
            'checkMethodDoesNotHaveUnionTypeHint' => new CheckDescriptor(ClassMethodsUnionTypeForbiddenCheck::class, PhpVersions::EARLIEST, PhpVersions::PHP_7_4, 'Class {entityId} has overridable method with union type hint available before PHP 8.0 in PHP {phpVersion}'),
        ];
    }
}
