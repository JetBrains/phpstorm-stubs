<?php
declare(strict_types=1);

namespace StubTests;

use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPProperty;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::constantProvider
     */
    public function testConstants(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getConstants();
        static::assertArrayHasKey(
            $constantName,
            $stubConstants,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::constantValuesProvider
     */
    public function testConstantsValues(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getConstants();
        static::assertEquals(
            $constantValue,
            $stubConstants[$constantName]->value,
            "Constant value mismatch: const $constantName \n
            Expected value: $constantValue but was {$stubConstants[$constantName]->value}"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::classConstantProvider
     */
    public function testClassConstants(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        if ($class instanceof PHPClass) {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getClasses()[$class->name]->constants;
        } else {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces()[$class->name]->constants;
        }
        static::assertArrayHasKey(
            $constantName,
            $stubConstants,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::classConstantValuesProvider
     */
    public function testClassConstantsValues(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        if ($class instanceof PHPClass) {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getClasses()[$class->name]->constants;
        } else {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces()[$class->name]->constants;
        }
        static::assertEquals(
            $constantValue,
            $stubConstants[$constantName]->value,
            "Constant value mismatch: const $constantName \n
            Expected value: $constantValue but was {$stubConstants[$constantName]->value}"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::allFunctionsProvider
     */
    public function testFunctionsExist(PHPFunction $function): void
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $params = self::getParameterRepresentation($function);
        static::assertArrayHasKey($functionName, $stubFunctions, "Missing function: function $functionName($params){}");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::functionsForDeprecationTestsProvider
     */
    public function testFunctionsDeprecation(PHPFunction $function)
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $phpstormFunction = $stubFunctions[$functionName];
        static::assertFalse(
            $function->is_deprecated && $phpstormFunction->is_deprecated !== true,
            "Function $functionName is not deprecated in stubs"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::functionsForParamsAmountTestsProvider
     */
    public function testFunctionsParametersAmount(PHPFunction $function)
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $phpstormFunction = $stubFunctions[$functionName];
        static::assertSameSize(
            $function->parameters,
            $phpstormFunction->parameters,
            "Parameter number mismatch for function $functionName. 
                Expected: " . self::getParameterRepresentation($function)
        );
    }

    public function testFunctionsDuplicates()
    {
        $filtered = EntitiesFilter::getFiltered(
            PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(), problemTypes: StubProblemType::HAS_DUPLICATION
        );
        $duplicates = self::getDuplicatedFunctions($filtered);
        self::assertCount(0, $duplicates,
            "Functions \"" . implode(', ', $duplicates) .
            "\" have duplicates in stubs.\nPlease use #[LanguageLevelTypeAware] or #[PhpStormStubsElementAvailable] if possible"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionClassesTestDataProviders::classWithParentProvider
     */
    public function testClassesParent(PHPClass|PHPInterface $class)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className);
            static::assertEquals(
                $class->parentClass,
                $stubClass->parentClass,
                empty($class->parentClass) ? "Class $className should not extend $stubClass->parentClass" :
                    "Class $className should extend $class->parentClass"
            );
        } else {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className);
            foreach ($class->parentInterfaces as $parentInterface) {
                static::assertContains(
                    $parentInterface,
                    $stubClass->parentInterfaces,
                    "Interface $className should extend $parentInterface"
                );
            }
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsProvider
     */
    public function testClassesMethodsExist(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className);
        } else {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className);
        }
        static::assertArrayHasKey(
            $method->name,
            $stubClass->methods,
            "Missing method $className::$method->name"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classFinalMethodsProvider
     */
    public function testClassesFinalMethods(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        static::assertEquals(
            $method->isFinal,
            $stubMethod->isFinal,
            "Method $className::$method->name final modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classStaticMethodsProvider
     */
    public function testClassesStaticMethods(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        static::assertEquals(
            $method->isStatic,
            $stubMethod->isStatic,
            "Method $className::$method->name static modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsWithAccessProvider
     */
    public function testClassesMethodsVisibility(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        static::assertEquals(
            $method->access,
            $stubMethod->access,
            "Method $className::$method->name access modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsWithParametersProvider
     */
    public function testClassesParametersCount(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        static::assertSameSize(
            $method->parameters,
            $stubMethod->parameters,
            "Parameter number mismatch for method $className::$method->name. 
                        Expected: " . self::getParameterRepresentation($method)
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionClassesTestDataProviders::classesWithInterfacesProvider
     */
    public function testClassInterfaces(PHPClass $class)
    {
        $className = $class->name;
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name);
        foreach ($class->interfaces as $interface) {
            static::assertContains(
                $interface,
                $stubClass->interfaces,
                "Class $className doesn't implement interface $interface"
            );
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classPropertiesProvider
     */
    public function testClassProperties(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name);
        static::assertArrayHasKey(
            $property->name,
            $stubClass->properties,
            "Missing property $className::$property->access $property->type $$property->name"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classStaticPropertiesProvider
     */
    public function testClassStaticProperties(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->properties[$property->name];
        static::assertEquals(
            $property->is_static,
            $stubProperty->is_static,
            "Property $className::$property->name static modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classPropertiesWithAccessProvider
     */
    public function testClassPropertiesVisibility(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->properties[$property->name];
        static::assertEquals(
            $property->access,
            $stubProperty->access,
            "Property $className::$property->name access modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classPropertiesWithTypeProvider
     */
    public function testClassPropertiesType(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->properties[$property->name];
        static::assertEquals(
            $property->type,
            $stubProperty->type,
            "Property type doesn't match for property $className::$property->name"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionClassesTestDataProviders::allClassesProvider
     */
    public function testClassesExist(PHPClass|PHPInterface $class): void
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->getClasses();
        } else {
            $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        }
        static::assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
    }


    #[Pure]
    private static function getParameterRepresentation(PHPFunction $function): string
    {
        $result = '';
        foreach ($function->parameters as $parameter) {
            if (!empty($parameter->type)) {
                $result .= $parameter->type . ' ';
            }
            if ($parameter->is_passed_by_ref) {
                $result .= '&';
            }
            if ($parameter->is_vararg) {
                $result .= '...';
            }
            $result .= '$' . $parameter->name . ', ';
        }
        $result = rtrim($result, ', ');

        return $result;
    }

    private static function getAllDuplicatesOfFunction(?string $name): array
    {
        return array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            function ($duplicateValue, $duplicateKey) use ($name) {
                return str_contains($duplicateValue->name, $name) && str_contains($duplicateKey, 'duplicated');
            }, ARRAY_FILTER_USE_BOTH);
    }

    private static function getDuplicatedFunctions(array $filtered): array
    {
        $duplicatedFunctions = array_filter($filtered, function (PHPFunction $value, int|string $key) {
            if (str_contains($key, 'duplicated')) {
                $duplicatesOfFunction = self::getAllDuplicatesOfFunction($value->name);
                $functionVersions[] = Utils::getAvailableInVersions(
                    PhpStormStubsSingleton::getPhpStormStubs()->getFunctions()[$value->name]);
                array_push($functionVersions, ...array_values(array_map(function (PHPFunction $function) {
                    return Utils::getAvailableInVersions($function);
                }, $duplicatesOfFunction)));
                $hasDuplicates = false;
                $current = array_pop($functionVersions);
                while (($next = array_pop($functionVersions))) {
                    if (!empty(array_intersect($current, $next))) {
                        $hasDuplicates = true;
                    }
                    $current = array_merge($current, $next);
                }
                return $hasDuplicates;
            }
            return false;
        }, ARRAY_FILTER_USE_BOTH);
        return array_unique(array_map(fn(PHPFunction $function) => $function->name, $duplicatedFunctions));
    }
}
