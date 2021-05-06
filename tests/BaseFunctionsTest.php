<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Exception;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\PhpVersions;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class BaseFunctionsTest extends BaseStubsTest
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::allFunctionsProvider
     * @throws Exception
     */
    public function testFunctionsExist(PHPFunction $function): void
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $params = BaseStubsTest::getParameterRepresentation($function);
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
        $filteredStubParameters = array_filter(
            $phpstormFunction->parameters,
            function ($parameter) {
                if (!empty($parameter->availableVersionsRangeFromAttribute)) {
                    return $parameter->availableVersionsRangeFromAttribute['from'] <= (doubleval(getenv('PHP_VERSION')) ?? PhpVersions::getFirst())
                        && $parameter->availableVersionsRangeFromAttribute['to'] >= (doubleval(getenv('PHP_VERSION')) ?? PhpVersions::getLatest());
                } else {
                    return true;
                }
            }
        );
        static::assertSameSize(
            $function->parameters,
            $filteredStubParameters,
            "Parameter number mismatch for function $functionName. 
                Expected: " . BaseStubsTest::getParameterRepresentation($function) . "\n" .
            'Actual: ' . BaseStubsTest::getParameterRepresentation($phpstormFunction)
        );
    }

    /**
     * @throws Exception|RuntimeException
     */
    public function testFunctionsDuplicates()
    {
        $filtered = EntitiesFilter::getFiltered(
            PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            problemTypes: StubProblemType::HAS_DUPLICATION
        );
        $duplicates = self::getDuplicatedFunctions($filtered);
        self::assertCount(
            0,
            $duplicates,
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
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $parameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        self::assertEquals(
            $parameter->isOptional,
            $stubOptionalParameter->isOptional,
            sprintf(
                'Reflection function %s has optional parameter %s with index %d 
            but stubs parameter %s with index %d is not',
                $function->name,
                $parameter->name,
                $parameter->indexInSignature,
                $stubOptionalParameter->name,
                $stubOptionalParameter->indexInSignature
            )
        );
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
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $parameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        self::assertEquals(
            $parameter->isOptional,
            $stubOptionalParameter->isOptional,
            sprintf(
                'Reflection method %s::%s has optional parameter %s with index %d but stub parameter %s with index %d is not optional',
                $class->name,
                $method->name,
                $parameter->name,
                $parameter->indexInSignature,
                $stubOptionalParameter->name,
                $stubOptionalParameter->indexInSignature
            )
        );
    }

    /**
     * @throws Exception
     */
    public function testImplodeFunctionIsCorrect()
    {
        $implodeFunctions = array_filter(
            PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            fn (PHPFunction $function) => $function->name === 'implode'
        );
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

    private static function getAllDuplicatesOfFunction(?string $name): array
    {
        return array_filter(
            PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            fn ($duplicateValue, $duplicateKey) => $duplicateValue->name === $name && str_contains($duplicateKey, 'duplicated'),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * @param array $filtered
     * @return array
     * @throws RuntimeException
     */
    private static function getDuplicatedFunctions(array $filtered): array
    {
        $duplicatedFunctions = array_filter($filtered, function (PHPFunction $value, int|string $key) {
            $duplicatesOfFunction = self::getAllDuplicatesOfFunction($value->name);
            $functionVersions[] = Utils::getAvailableInVersions(
                PhpStormStubsSingleton::getPhpStormStubs()->getFunction($value->name)
            );
            array_push($functionVersions, ...array_values(array_map(
                fn (PHPFunction $function) => Utils::getAvailableInVersions($function),
                $duplicatesOfFunction
            )));
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
        }, ARRAY_FILTER_USE_BOTH);
        return array_unique(array_map(fn (PHPFunction $function) => $function->name, $duplicatedFunctions));
    }
}
