<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Exception;
use Generator;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPEnum;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\ParserUtils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use function in_array;

class StubMethodsProvider
{
    public static function allClassMethodsProvider(): ?Generator
    {
        $classes = PhpStormStubsSingleton::getPhpStormStubs()->getClasses();
        foreach ($classes as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "method $className::$methodName [$class->stubObjectHash]" => [$class->stubObjectHash, $method->name];
            }
        }
    }

    public static function allInterfaceMethodsProvider(): ?Generator
    {
        $interfaces = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        foreach ($interfaces as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "method $className::$methodName" => [$class->id, $method->name];
            }
        }
    }

    public static function allEnumsMethodsProvider(): ?Generator
    {
        $enums = PhpStormStubsSingleton::getPhpStormStubs()->getEnums();
        foreach ($enums as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "method $className::$methodName" => [$class->id, $method->name];
            }
        }
    }

    public static function allFunctionWithReturnTypeHintsProvider(): ?Generator
    {
        $allFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $filteredFunctions = EntitiesFilter::getFiltered(
            $allFunctions,
            fn (PHPFunction $function) => empty($function->returnTypesFromSignature) || empty($function->returnTypesFromPhpDoc)
                || $function->hasTentativeReturnType || in_array('mixed', $function->returnTypesFromSignature),
            StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE
        );
        foreach ($filteredFunctions as $functionId => $function) {
            yield "function $functionId" => [$function->id];
        }
    }

    public static function allClassesMethodsWithReturnTypeHintsProvider(): ?Generator
    {
        $coreClasses = PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses();
        foreach (EntitiesFilter::getFiltered($coreClasses) as $class) {
            $filteredMethods = EntitiesFilter::getFiltered(
                $class->methods,
                fn (PHPMethod $method) => empty($method->returnTypesFromSignature) || empty($method->returnTypesFromPhpDoc)
                    || $method->parentId === '\___PHPSTORM_HELPERS\object' || $method->hasTentativeReturnType
                    || in_array('mixed', $method->returnTypesFromSignature),
                StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE
            );
            foreach ($filteredMethods as $methodName => $method) {
                yield "method $class->id::$methodName" => [$class->id, $method->name];
            }
        }
    }

    public static function allInterfacesMethodsWithReturnTypeHintsProvider(): ?Generator
    {
        $coreInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces();
        foreach (EntitiesFilter::getFiltered($coreInterfaces) as $class) {
            $filteredMethods = EntitiesFilter::getFiltered(
                $class->methods,
                fn (PHPMethod $method) => empty($method->returnTypesFromSignature) || empty($method->returnTypesFromPhpDoc)
                    || $method->hasTentativeReturnType
                    || in_array('mixed', $method->returnTypesFromSignature),
                StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE
            );
            foreach ($filteredMethods as $methodName => $method) {
                yield "method $class->id::$methodName" => [$class->id, $method->name];
            }
        }
    }

    public static function allEnumsMethodsWithReturnTypeHintsProvider(): ?Generator
    {
        $coreEnums = PhpStormStubsSingleton::getPhpStormStubs()->getCoreEnums();
        $array = array_filter(array_map(function (PHPEnum $enum) {
            return EntitiesFilter::getFiltered(
                $enum->methods,
                fn (PHPMethod $method) => empty($method->returnTypesFromSignature) || empty($method->returnTypesFromPhpDoc)
                    || $method->hasTentativeReturnType
                    || in_array('mixed', $method->returnTypesFromSignature),
                StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE
            );
        }, $coreEnums), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null];
        }else {
            foreach (EntitiesFilter::getFiltered($coreEnums) as $class) {
                $filteredMethods = EntitiesFilter::getFiltered(
                    $class->methods,
                    fn (PHPMethod $method) => empty($method->returnTypesFromSignature) || empty($method->returnTypesFromPhpDoc)
                        || $method->hasTentativeReturnType
                        || in_array('mixed', $method->returnTypesFromSignature),
                    StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE
                );
                foreach ($filteredMethods as $methodName => $method) {
                    yield "method $class->id::$methodName" => [$class->id, $method->name];
                }
            }
        }
    }

    public static function classMethodsForReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPClass::class, 7);
        return self::yieldFilteredMethods(
            PHPClass::class,
            $filterFunction,
            StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function interfaceMethodsForReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPInterface::class, 7);
        return self::yieldFilteredMethods(
            PHPInterface::class,
            $filterFunction,
            StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function enumMethodsForReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPEnum::class, 7);
        return self::yieldFilteredMethods(
            PHPEnum::class,
            $filterFunction,
            StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function classMethodsForNullableReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPClass::class, 7.1);
        return self::yieldFilteredMethods(
            PHPClass::class,
            $filterFunction,
            StubProblemType::HAS_NULLABLE_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function interfaceMethodsForNullableReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPInterface::class, 7.1);
        return self::yieldFilteredMethods(
            PHPInterface::class,
            $filterFunction,
            StubProblemType::HAS_NULLABLE_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function enumMethodsForNullableReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPEnum::class, 7.1);
        return self::yieldFilteredMethods(
            PHPEnum::class,
            $filterFunction,
            StubProblemType::HAS_NULLABLE_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function classMethodsForUnionReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPClass::class, 8);
        return self::yieldFilteredMethods(
            PHPClass::class,
            $filterFunction,
            StubProblemType::HAS_UNION_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function interfaceMethodsForUnionReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPInterface::class, 8);
        return self::yieldFilteredMethods(
            PHPInterface::class,
            $filterFunction,
            StubProblemType::HAS_UNION_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function enumMethodsForUnionReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPEnum::class, 8);
        return self::yieldFilteredMethods(
            PHPEnum::class,
            $filterFunction,
            StubProblemType::HAS_UNION_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    private static function getFilterFunctionForLanguageLevel(string $classType, float $languageVersion): callable
    {
        return match ($classType) {
            PHPClass::class => fn (PHPClass $class, PHPMethod $method, ?float $firstSinceVersion) => !$method->isFinal &&
                !$class->isFinal && $firstSinceVersion !== null && $firstSinceVersion < $languageVersion && !$method->isReturnTypeTentative,
            PHPInterface::class => fn (PHPInterface $class, PHPMethod $method, ?float $firstSinceVersion) => !$method->isFinal &&
                !$class->isFinal && $firstSinceVersion !== null && $firstSinceVersion < $languageVersion && !$method->isReturnTypeTentative,
            PHPEnum::class => fn (PHPEnum $class, PHPMethod $method, ?float $firstSinceVersion) => !$method->isFinal &&
                !$class->isFinal && $firstSinceVersion !== null && $firstSinceVersion < $languageVersion && !$method->isReturnTypeTentative,
            default => throw new Exception("Unknown class type"),
        };
    }

    /**
     * @throws RuntimeException
     */
    private static function yieldFilteredMethods(string $classType, callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $classes = match ($classType) {
            PHPClass::class => PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses(),
            PHPInterface::class => PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces(),
            PHPEnum::class => PhpStormStubsSingleton::getPhpStormStubs()->getCoreEnums(),
            default => throw new Exception("Unknown class type")
        };
        $filtered = EntitiesFilter::getFiltered($classes);
        $array = array_filter(array_map(function ($class) use ($problemTypes, $filterFunction) {
            return array_filter(EntitiesFilter::getFiltered(
                $class->methods,
                fn (PHPMethod $method) => $method->parentId === '\___PHPSTORM_HELPERS\object',
                ...$problemTypes
            ), function ($method) use ($filterFunction, $class) {
                $firstSinceVersion = ParserUtils::getDeclaredSinceVersion($method);
                return $filterFunction($class, $method, $firstSinceVersion) === true;
            });
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null];
        } else {
            foreach ($array as $classId => $methods) {
                $class = $classes[$classId];
                foreach ($methods as $methodName => $method) {
                    yield "method $classId::$methodName" => [$class->stubObjectHash, $method->stubObjectHash];
                }
            }
        }
    }
}
