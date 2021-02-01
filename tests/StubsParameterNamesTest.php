<?php
declare(strict_types=1);

namespace StubTests;

use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class StubsParameterNamesTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionParametersProvider
     */
    public function testFunctionsParameterNames(PHPFunction $function, PHPParameter $parameter)
    {
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions()[$function->name];
        self::assertNotEmpty(array_filter($phpstormFunction->parameters,
            fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name),
            "Function {$function->name} has signature {$function->name}(" . self::printParameters($function->parameters) . ')' .
            " but stub function has signature {$phpstormFunction->name}(" . self::printParameters($phpstormFunction->parameters) . ')');
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodParametersProvider
     */
    public function testMethodsParameterNames(PHPClass|PHPInterface $reflectionClass, PHPMethod $reflectionMethod, PHPParameter $reflectionParameter)
    {
        $className = $reflectionClass->name;
        $methodName = $reflectionMethod->name;
        if ($reflectionClass instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClasses()[$className]->methods[$methodName];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces()[$className]->methods[$methodName];
        }
        self::assertNotEmpty(array_filter($stubMethod->parameters,
            fn(PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name),
            "Method $className::$methodName has signature $methodName(" . self::printParameters($reflectionMethod->parameters) . ')' .
            " but stub function has signature $methodName(" . self::printParameters($stubMethod->parameters) . ')');
    }

    /**
     * @param PHPParameter[] $params
     * @return string
     */
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
