<?php
declare(strict_types=1);

namespace StubTests;

use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsParameterNamesTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::functionParametersForNameCheckingProvider
     */
    public function testFunctionsParameterNames(PHPFunction $function, PHPParameter $parameter)
    {
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions()[$function->name];
        if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH)) {
            self::assertNotEmpty(array_filter($phpstormFunction->parameters,
                fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name),
                "Function {$function->name} has signature {$function->name}(" . self::printParameters($function->parameters) . ')' .
                " but stub function has signature {$phpstormFunction->name}(" . self::printParameters($phpstormFunction->parameters) . ')');
        } else {
            self::markTestSkipped('Parameter ignored');
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::methodParametersForNamesCheckingProvider
     */
    public function testMethodsParameterNames(PHPClass $reflectionClass, PHPMethod $reflectionMethod, PHPParameter $reflectionParameter)
    {
        $className = $reflectionClass->name;
        $methodName = $reflectionMethod->name;
        $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClasses()[$className]->methods[$methodName];
        self::assertNotEmpty(array_filter($stubMethod->parameters,
            fn(PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name),
            "Method $className::$methodName has signature $methodName(" . self::printParameters($reflectionMethod->parameters) . ')' .
            " but stub function has signature $methodName(" . self::printParameters($stubMethod->parameters) . ')');
    }

    #[Pure]
    public static function printParameters(array $params): string
    {
        $signature = '';
        foreach ($params as $param) {
            $signature .= '$' . $param->name . ', ';
        }
        return trim($signature, ', ');
    }
}