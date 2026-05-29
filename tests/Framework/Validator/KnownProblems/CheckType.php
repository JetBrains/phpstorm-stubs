<?php

namespace StubTests\Framework\Validator\KnownProblems;

/**
 * Enumeration of validator check types.
 *
 * Each case represents a specific validation check that can be affected
 * by known problems. The enum value is the actual class name of the check.
 */
enum CheckType: string
{
    /**
     * Validates that parameter names in stubs match reflection.
     * Relevant for PHP 8.0+ where named parameters were introduced.
     */
    case PARAMETER_NAMES = 'ParameterNamesCheck';

    /**
     * Validates that methods with tentative return types in reflection
     * are marked with #[TentativeType] in stubs.
     * Relevant for PHP 8.1+ where tentative return types were introduced.
     */
    case TENTATIVE_RETURN_TYPE = 'TentativeReturnTypeCheck';

    /**
     * Validates that parameter types in stubs match reflection.
     * Checks type hints for all parameters.
     */
    case PARAMETER_TYPES = 'ParameterTypesCheck';

    /**
     * Validates that return types in stubs match reflection.
     * Checks return type declarations.
     */
    case RETURN_TYPES = 'ReturnTypesCheck';

    /**
     * Validates that functions exist in reflection.
     * Checks basic existence of entities.
     */
    case FUNCTION_EXISTS = 'FunctionExistsCheck';

    /**
     * Validates that methods exist in reflection.
     */
    case METHOD_EXISTS = 'MethodExistsCheck';

    /**
     * Validates that classes exist in reflection.
     */
    case CLASS_EXISTS = 'ClassExistsCheck';

    /**
     * Validates that parent class in stubs matches parent class in reflection.
     */
    case CLASS_PARENT = 'ClassParentClassCheck';

    /**
     * Validates that directly implemented interfaces in stubs match reflection.
     */
    case CLASS_INTERFACES = 'ClassInterfacesCheck';

    /**
     * Validates that all methods present in reflection also exist in stubs.
     */
    case CLASS_METHODS_EXIST = 'ClassMethodsExistCheck';

    /**
     * Validates that the `final` attribute on methods in stubs matches reflection.
     */
    case CLASS_FINAL_METHODS = 'ClassFinalMethodsCheck';

    /**
     * Validates that the `static` attribute on methods in stubs matches reflection.
     */
    case CLASS_STATIC_METHODS = 'ClassStaticMethodsCheck';

    /**
     * Validates that all properties present in reflection also exist in stubs.
     */
    case CLASS_PROPERTIES_EXIST = 'ClassPropertiesExistCheck';

    /**
     * Validates that the visibility (public/protected/private) of methods in stubs matches reflection.
     */
    case CLASS_METHODS_VISIBILITY = 'ClassMethodsVisibilityCheck';

    /**
     * Validates that the `static` attribute on properties in stubs matches reflection.
     */
    case CLASS_STATIC_PROPERTIES = 'ClassStaticPropertiesCheck';

    /**
     * Validates that the visibility (public/protected/private) of properties in stubs matches reflection.
     */
    case CLASS_PROPERTIES_VISIBILITY = 'ClassPropertiesVisibilityCheck';

    /**
     * Validates that the declared type of properties in stubs matches reflection.
     * Supports LanguageLevelTypeAware version-specific types.
     */
    case CLASS_PROPERTIES_TYPE = 'ClassPropertiesTypeCheck';

    /**
     * Validates that the number of parameters in stub methods/functions matches reflection.
     * Accounts for PhpStormStubsElementAvailable version-filtered parameters.
     * Used by both ClassMethodsParametersCountCheck and FunctionParametersCountCheck.
     */
    case PARAMETERS_COUNT = 'ParametersCountCheck';

    /**
     * Validates that functions/methods deprecated in reflection are also marked deprecated in stubs.
     * Used by both FunctionDeprecationCheck and MethodDeprecationCheck.
     */
    case DEPRECATION = 'DeprecationCheck';

    /**
     * Validates that parameters optional in reflection are also optional in stubs.
     * Used by both FunctionOptionalParametersCheck and ClassMethodsOptionalParametersCheck.
     */
    case OPTIONAL_PARAMETERS = 'OptionalParametersCheck';

    /**
     * Validates that all parent interfaces declared in the stubs hierarchy for an interface
     * are themselves declared in the stubs (stubs self-consistency check).
     */
    case INTERFACE_PARENT_INTERFACES = 'InterfaceParentInterfacesCheck';

    /**
     * Validates that directly implemented interfaces in enum stubs match reflection.
     */
    case ENUM_INTERFACES = 'EnumInterfacesCheck';

    /**
     * Validates that all enum cases present in reflection also exist in stubs.
     */
    case ENUM_CASES = 'EnumCasesCheck';

    /**
     * Validates that the `final` modifier on a class in stubs matches reflection.
     * Only meaningful against the latest PHP version, as stubs cannot express version-specific finality.
     */
    case CLASS_FINAL = 'ClassFinalCheck';

    /**
     * Validates that the `final` modifier on an enum in stubs matches reflection.
     */
    case ENUM_FINAL = 'EnumFinalCheck';

    /**
     * Validates that constants declared in class stubs exist in reflection.
     */
    case CLASS_CONSTANTS = 'ClassConstantsCheck';

    /**
     * Validates that constants declared in interface stubs exist in reflection.
     */
    case INTERFACE_CONSTANTS = 'InterfaceConstantsCheck';

    /**
     * Validates that constants declared in enum stubs exist in reflection.
     */
    case ENUM_CONSTANTS = 'EnumConstantsCheck';

    /**
     * Validates that the visibility (public/protected/private) of constants in class stubs matches reflection.
     */
    case CLASS_CONSTANTS_VISIBILITY = 'ClassConstantsVisibilityCheck';

    /**
     * Validates that the visibility of constants in enum stubs matches reflection.
     */
    case ENUM_CONSTANTS_VISIBILITY = 'EnumConstantsVisibilityCheck';

    /**
     * Validates that the visibility of constants in interface stubs matches reflection.
     */
    case INTERFACE_CONSTANTS_VISIBILITY = 'InterfaceConstantsVisibilityCheck';

    /**
     * Validates that the values of constants in class stubs match reflection.
     * Value comparison is limited to the latest PHP version to avoid false positives.
     */
    case CLASS_CONSTANTS_VALUE = 'ClassConstantsValueCheck';

    /**
     * Validates that the values of constants in interface stubs match reflection.
     * Value comparison is limited to the latest PHP version to avoid false positives.
     */
    case INTERFACE_CONSTANTS_VALUE = 'InterfaceConstantsValueCheck';

    /**
     * Validates that the values of constants in enum stubs match reflection.
     * Value comparison is limited to the latest PHP version to avoid false positives.
     */
    case ENUM_CONSTANTS_VALUE = 'EnumConstantsValueCheck';

    /**
     * Validates that the `readonly` modifier on properties in stubs matches reflection.
     * Relevant for PHP 8.1+ where readonly properties were introduced.
     */
    case CLASS_PROPERTIES_READONLY = 'ClassPropertyReadonlyCheck';

    /**
     * Validates that the `readonly` modifier on a class in stubs matches reflection.
     * Relevant for PHP 8.2+ where readonly classes were introduced.
     */
    case CLASS_READONLY = 'ClassReadonlyCheck';

    /**
     * Validates that global constants from reflection exist in stubs.
     */
    case CONSTANT_EXISTS = 'ConstantExistsCheck';

    /**
     * Validates that the values of global constants in stubs match reflection.
     * Value comparison is limited to the latest PHP version to avoid false positives.
     */
    case CONSTANT_VALUE = 'ConstantValueCheck';

    /**
     * Validates that default parameter values in stubs match reflection.
     * Only checked against the latest PHP version since stubs do not support
     * version-aware default values (no LanguageLevelTypeAware equivalent for defaults).
     * Comparison is skipped when either side's value is null to avoid false positives
     * from unevaluable constant expressions.
     */
    case PARAMETER_DEFAULT_VALUE = 'ParameterDefaultValueCheck';

    /**
     * Validates that PhpDoc types in stubs are compatible with their signature types.
     * Used by FunctionPhpDocConformsSignatureCheck, ClassMethodsPhpDocConformsSignatureCheck,
     * EnumMethodsPhpDocConformsSignatureCheck, and InterfaceMethodsPhpDocConformsSignatureCheck.
     * The check is permissive: typed-array narrowing, phpstan generics, resource widening,
     * and bool/false splitting are all accepted.
     */
    case PHPDOC_CONFORMS_SIGNATURE = 'PhpDocConformsSignatureCheck';

    /**
     * Validates that overridable methods available before PHP 7.0 do not declare any
     * return type hint. Return type hints were introduced in PHP 7.0; using them on
     * pre-7.0 methods prevents child classes targeting PHP 5.6 from providing a matching
     * override. Only return types are checked — parameter type hints for class names,
     * array, and callable were valid in PHP 5.x.
     * Used by ClassMethodsReturnTypeForbiddenCheck, InterfaceMethodsReturnTypeForbiddenCheck,
     * and EnumMethodsReturnTypeForbiddenCheck.
     */
    case RETURN_TYPE_FORBIDDEN = 'ReturnTypeForbiddenCheck';

    /**
     * Validates that overridable methods available before PHP 7.1 do not declare nullable
     * type hints (?T) — on either the return type or any parameter. Nullable type hints were
     * introduced in PHP 7.1; using them on pre-7.1 methods prevents child classes targeting
     * PHP 5.6/7.0 from providing a matching override.
     * Used by ClassMethodsNullableTypeForbiddenCheck, InterfaceMethodsNullableTypeForbiddenCheck,
     * and EnumMethodsNullableTypeForbiddenCheck.
     */
    case NULLABLE_TYPE_FORBIDDEN = 'NullableTypeForbiddenCheck';

    /**
     * Validates that overridable methods available before PHP 8.0 do not declare union
     * type hints (T1|T2) — on either the return type or any parameter. Union type hints
     * were introduced in PHP 8.0; using them on pre-8.0 methods prevents child classes
     * targeting PHP 5.6–7.4 from providing a matching override.
     * Note: nullable ?T syntax (serialised as T|null) is excluded — it is valid from PHP 7.1.
     * Used by ClassMethodsUnionTypeForbiddenCheck, InterfaceMethodsUnionTypeForbiddenCheck,
     * and EnumMethodsUnionTypeForbiddenCheck.
     */
    case UNION_TYPE_FORBIDDEN = 'UnionTypeForbiddenCheck';

    /**
     * Validates that overridable methods available before PHP 7.0 do not declare scalar
     * parameter type hints (int, float, string, bool). Scalar type hints were introduced
     * in PHP 7.0; using them on pre-7.0 method parameters prevents child classes targeting
     * PHP 5.6 from providing a matching override.
     * Note: return type hints are already fully covered by RETURN_TYPE_FORBIDDEN.
     * Used by ClassMethodsScalarTypeForbiddenCheck, InterfaceMethodsScalarTypeForbiddenCheck,
     * and EnumMethodsScalarTypeForbiddenCheck.
     */
    case SCALAR_TYPE_FORBIDDEN = 'ScalarTypeForbiddenCheck';

    /**
     * Validates that PhpDoc comments in stubs contain only recognized tag names.
     * Valid tags are phpDocumentor v3 standard tags, PHPStan non-prefixed tags,
     * and a small set of custom tags used in phpstorm-stubs (@removed, @xglobal, @meta).
     * Tags with phpstan-*, psalm-*, or phan-* prefixes are invalid.
     * Used by PhpDocTagsCheck for functions, classes, interfaces, and enums.
     */
    case PHPDOC_TAGS = 'PhpDocTagsCheck';

    /**
     * Validates that @since, @deprecated, and @removed phpDoc tags use
     * "major.minor" version format (e.g. "8.0") rather than "major.minor.patch"
     * (e.g. "8.0.1") for style consistency.
     * Only purely numeric three-or-more-component versions are flagged.
     * Used by PhpDocVersionFormatCheck for functions, classes, interfaces, and enums.
     */
    case PHPDOC_VERSION_FORMAT = 'PhpDocVersionFormatCheck';

    /**
     * Validates that every @link URL in phpDoc comments uses the https scheme
     * and, when CHECK_LINKS=true, that the URL is reachable (not a dead link).
     * Only entries starting with "http://" or "https://" are examined; plain
     * cross-references like "ClassName::method" are ignored.
     * Used by PhpDocLinksCheck for functions, classes, interfaces, and enums.
     */
    case PHPDOC_LINKS = 'PhpDocLinksCheck';

    /**
     * Validates that Reflection API methods which return type information
     * (e.g. getReturnType, getType) declare LanguageLevelTypeAware version
     * entries with concrete subtypes (ReflectionNamedType, ReflectionUnionType,
     * ReflectionIntersectionType) rather than only the abstract ReflectionType base.
     * This is a regression guard against inadvertent removal of version-specific
     * type narrowing that the IDE uses for precise type inference.
     * See: https://youtrack.jetbrains.com/issue/WI-61052
     */
    case REFLECTION_SPECIAL_TYPE_HINTS = 'ReflectionMethodSpecialTypeHintsCheck';

    /**
     * Validates that parameters deprecated in reflection are also marked deprecated in stubs.
     * Used by FunctionParameterDeprecationCheck and ClassMethodsParameterDeprecationCheck.
     */
    case PARAMETER_DEPRECATION = 'ParameterDeprecationCheck';
}
