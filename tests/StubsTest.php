<?php
declare(strict_types=1);

namespace StubTests;

use JetBrains\PhpStorm\Pure;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\UnaryMinus;
use PhpParser\Node\Scalar\DNumber;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Scalar\String_;
use PHPUnit\Framework\Exception;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\PHPProperty;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsTest extends BaseStubsTest
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::constantProvider
     * @throws Exception
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
     * @throws Exception|RuntimeException
     */
    public function testClassConstants(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        if ($class instanceof PHPClass) {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->constants;
        } else {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->constants;
        }
        static::assertArrayHasKey(
            $constantName,
            $stubConstants,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::classConstantValuesProvider
     * @throws RuntimeException
     */
    public function testClassConstantsValues(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        if ($class instanceof PHPClass) {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->constants;
        } else {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->constants;
        }
        static::assertEquals(
            $constantValue,
            $stubConstants[$constantName]->value,
            "Constant value mismatch: const $class->name::$constantName \n
            Expected value: $constantValue but was {$stubConstants[$constantName]->value}"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider::classConstantProvider
     * @throws RuntimeException
     */
    public function testClassConstantsVisibility(PHPClass|PHPInterface $class, PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantVisibility = $constant->visibility;
        if ($class instanceof PHPClass) {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->constants;
        } else {
            $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->constants;
        }
        static::assertEquals(
            $constantVisibility,
            $stubConstants[$constantName]->visibility,
            "Constant visibility mismatch: const $constantName \n
            Expected visibility: $constantVisibility but was {$stubConstants[$constantName]->visibility}"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::allFunctionsProvider
     * @throws Exception
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
     * @throws Exception
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

    /**
     * @throws Exception|RuntimeException
     */
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
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionOptionalParametersProvider
     * @throws RuntimeException
     */
    public function testFunctionsOptionalParameters(PHPFunction $function, PHPParameter $parameter)
    {
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function->name);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->name === $parameter->name);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        self::assertEquals($parameter->isOptional, $stubOptionalParameter->isOptional,
            sprintf('Reflection function %s has optional parameter %s', $function->name, $parameter->name));
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionOptionalParametersWithDefaultValueProvider
     * @param PHPFunction $function
     * @param PHPParameter $parameter
     * @throws Exception|RuntimeException
     */
    public function testFunctionsDefaultParametersValue(PHPFunction $function, PHPParameter $parameter)
    {
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function->name);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->name === $parameter->name);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        $reflectionValue = self::getStringRepresentationOfDefaultParameterValue($parameter->defaultValue);
        $stubValue = self::getStringRepresentationOfDefaultParameterValue($stubOptionalParameter->defaultValue);
        self::assertEquals($reflectionValue, $stubValue,
            sprintf('Reflection function %s has optional parameter %s with default value %s but stub parameter has value %s',
                $function->name, $parameter->name, $reflectionValue, $stubValue));
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodOptionalParametersWithDefaultValueProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @param PHPParameter $parameter
     * @throws Exception|RuntimeException
     */
    public function testMethodsDefaultParametersValue(PHPClass|PHPInterface $class, PHPMethod $method, PHPParameter $parameter)
    {
        if ($class instanceof PHPClass) {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->methods[$method->name];
        } else {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->methods[$method->name];
        }
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->name === $parameter->name);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        $reflectionValue = self::getStringRepresentationOfDefaultParameterValue($parameter->defaultValue);
        $stubValue = self::getStringRepresentationOfDefaultParameterValue($stubOptionalParameter->defaultValue, $class);
        self::assertEquals($reflectionValue, $stubValue,
            sprintf('Reflection method %s::%s has optional parameter %s with default value %s but stub parameter has value %s',
                $class->name, $method->name, $parameter->name, $reflectionValue, $stubValue));
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodOptionalParametersProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @param PHPParameter $parameter
     * @throws RuntimeException
     */
    public function testMethodsOptionalParameters(PHPClass|PHPInterface $class, PHPMethod $method, PHPParameter $parameter)
    {
        if ($class instanceof PHPClass) {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->methods[$method->name];
        } else {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->methods[$method->name];
        }
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->name === $parameter->name);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        self::assertEquals($parameter->isOptional, $stubOptionalParameter->isOptional,
            sprintf('Reflection method %s::%s has optional parameter %s but stub parameter is not optional',
                $class->name, $method->name, $parameter->name));
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionClassesTestDataProviders::classWithParentProvider
     * @param PHPClass|PHPInterface $class
     * @throws Exception|RuntimeException
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
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws Exception|RuntimeException
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
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws RuntimeException
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
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws RuntimeException
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
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws RuntimeException
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
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws Exception|RuntimeException
     */
    public function testClassMethodsParametersCount(PHPClass|PHPInterface $class, PHPMethod $method)
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
     * @param PHPClass $class
     * @throws Exception|RuntimeException
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
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws Exception|RuntimeException
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
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws RuntimeException
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
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws RuntimeException
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
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws RuntimeException
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
     * @throws Exception
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

    /**
     * @throws Exception
     */
    public function testImplodeFunctionIsCorrect()
    {
        $implodeFunctions = array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            fn (PHPFunction $function) => $function->name === 'implode');
        self::assertCount(1, $implodeFunctions);
        /** @var PHPFunction $implodeFunction */
        $implodeFunction = array_pop($implodeFunctions);
        $implodeParameters = $implodeFunction->parameters;
        $separatorParameters = array_filter($implodeParameters, fn (PHPParameter $parameter) => $parameter->name === 'separator');
        $arrayParameters = array_filter($implodeParameters, fn (PHPParameter $parameter) => $parameter->name === 'array');
        /** @var PHPParameter $separatorParameter */
        $separatorParameter = array_pop($separatorParameters);
        /** @var PHPParameter $arrayParameter */
        $arrayParameter = array_pop($arrayParameters);
        self::assertCount(2, $implodeParameters);
        self::assertEquals(['array', 'string'], $separatorParameter->typesFromSignature);
        if (property_exists($separatorParameter->defaultValue, 'value')) {
            self::assertEquals('', $separatorParameter->defaultValue->value);
        } else {
            self::fail("Couldn't read default value");
        }
        self::assertEquals(['?array'], $arrayParameter->typesFromSignature);
        self::assertEquals(['string'], $implodeFunction->returnTypesFromSignature);
        self::assertEquals(['string'], $implodeFunction->returnTypesFromPhpDoc);
    }

    #[Pure]
    private static function getParameterRepresentation(PHPFunction $function): string
    {
        $result = '';
        foreach ($function->parameters as $parameter) {
            if (!empty($parameter->types)) {
                $result .= implode('|', $parameter->types);
            }
            if ($parameter->is_passed_by_ref) {
                $result .= '&';
            }
            if ($parameter->is_vararg) {
                $result .= '...';
            }
            $result .= '$' . $parameter->name . ', ';
        }
        return rtrim($result, ', ');
    }

    private static function getAllDuplicatesOfFunction(?string $name): array
    {
        return array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            fn ($duplicateValue, $duplicateKey) => str_contains($duplicateValue->name, $name) && str_contains($duplicateKey, 'duplicated'), ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @param array $filtered
     * @return array
     * @throws RuntimeException
     */
    private static function getDuplicatedFunctions(array $filtered): array
    {
        $duplicatedFunctions = array_filter($filtered, function (PHPFunction $value, int|string $key) {
            if (str_contains($key, 'duplicated')) {
                $duplicatesOfFunction = self::getAllDuplicatesOfFunction($value->name);
                $functionVersions[] = Utils::getAvailableInVersions(
                    PhpStormStubsSingleton::getPhpStormStubs()->getFunction($value->name));
                array_push($functionVersions, ...array_values(array_map(fn (PHPFunction $function) => Utils::getAvailableInVersions($function), $duplicatesOfFunction)));
                $hasDuplicates = false;
                $current = array_pop($functionVersions);
                $next = array_pop($functionVersions);
                while ($next !== null) {
                    if (!empty(array_intersect($current, $next))) {
                        $hasDuplicates = true;
                    }
                    $current = array_merge($current, $next);
                    $next = array_pop($functionVersions);
                }
                return $hasDuplicates;
            }
            return false;
        }, ARRAY_FILTER_USE_BOTH);
        return array_unique(array_map(fn (PHPFunction $function) => $function->name, $duplicatedFunctions));
    }

    /**
     * @param mixed $defaultValue
     * @param PHPClass|PHPInterface|null $contextClass
     * @return bool|float|int|string|null
     * @throws Exception|RuntimeException
     */
    private static function getStringRepresentationOfDefaultParameterValue(mixed $defaultValue, PHPClass|PHPInterface $contextClass = null): float|bool|int|string|null
    {
        if ($defaultValue instanceof ConstFetch) {
            $defaultValueName = (string)$defaultValue->name;
            if ($defaultValueName !== 'false' && $defaultValueName !== 'true' && $defaultValueName !== 'null') {
                $constants = array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getConstants(),
                    function (PHPConst $const) use ($defaultValue) {
                        return $const->name === (string)$defaultValue->name;
                    });
                /** @var PHPConst $constant */
                $constant = array_pop($constants);
                $value = $constant->value;
            } else {
                $value = $defaultValueName;
            }
        } elseif ($defaultValue instanceof String_ || $defaultValue instanceof LNumber || $defaultValue instanceof DNumber) {
            $value = strval($defaultValue->value);
        } elseif ($defaultValue instanceof BitwiseOr) {
            if ($defaultValue->left instanceof ConstFetch && $defaultValue->right instanceof ConstFetch) {
                $constants = array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getConstants(),
                    fn (PHPConst $const) => property_exists($defaultValue->left, 'name') &&
                        $const->name === (string)$defaultValue->left->name);
                /** @var PHPConst $leftConstant */
                $leftConstant = array_pop($constants);
                $constants = array_filter(PhpStormStubsSingleton::getPhpStormStubs()->getConstants(),
                    fn (PHPConst $const) => property_exists($defaultValue->right, 'name') &&
                        $const->name === (string)$defaultValue->right->name);
                /** @var PHPConst $rightConstant */
                $rightConstant = array_pop($constants);
                $value = $leftConstant->value|$rightConstant->value;
            }
        } elseif ($defaultValue instanceof UnaryMinus && property_exists($defaultValue->expr, 'value')) {
            $value = '-' . strval($defaultValue->expr->value);
        } elseif ($defaultValue instanceof ClassConstFetch) {
            $class = (string)$defaultValue->class;
            if ($class === 'self' && $contextClass !== null) {
                $class = $contextClass->name;
            }
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class) ??
                PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class);
            if ($parentClass === null) {
                throw new Exception("Class $class not found in stubs");
            }
            if ((string)$defaultValue->name === 'class') {
                $value = (string)$defaultValue->class;
            } else {
                $constants = array_filter($parentClass->constants, fn (PHPConst $const) => $const->name === (string)$defaultValue->name);
                /** @var PHPConst $constant */
                $constant = array_pop($constants);
                $value = $constant->value;
            }
        } else {
            $value = strval($defaultValue);
        }
        return $value;
    }
}
