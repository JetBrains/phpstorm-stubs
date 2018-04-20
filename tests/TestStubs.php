<?php

use PHPUnit\Framework\TestCase;

include "StubParser.php";
include __DIR__ . "/../vendor/autoload.php";

class ReflectionStubsSingleton
{
    private static $reflectionStubs = null;

    public static function getReflectionStubs(): stdClass
    {
        if (self::$reflectionStubs == null) {
            $json = file_get_contents(__DIR__ . "/stub.json");
            self::$reflectionStubs = json_decode($json);
        }
        return self::$reflectionStubs;
    }
}

class PhpStormStubsSingleton
{
    private static $phpstormStubs = null;

    public static function getPhpStormStubs(): stdClass
    {
        if (self::$phpstormStubs == null) {
            self::$phpstormStubs = getPhpStormStubs();
        }
        return self::$phpstormStubs;
    }
}

class TestStubs extends TestCase
{
    public function constantProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->constants as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    /**
     * @dataProvider constantProvider
     */
    public function testConstants($constant)
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->constants;
        $this->assertArrayHasKey($constantName, $stubConstants, "Missing constant: const $constantName = $constantValue\n");
    }


    public function functionProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->functions as $function) {
            yield "function {$function->name}" => [$function];
        }
    }

    /**
     * @dataProvider functionProvider
     */
    function testFunctions($function)
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->functions;
        $params = $this->getParameterRepresentation($function);
        $this->assertArrayHasKey($functionName, $stubFunctions, "Missing function: function $functionName($params){}");
        $phpstormFunction = $stubFunctions[$functionName];
        $this->assertFalse($function->is_deprecated && $phpstormFunction->is_deprecated != true, "Function $functionName is not deprecated in stubs");
        $this->assertSameSize($function->parameters, $phpstormFunction->parameters,
            "Parameter number mismatch for function $functionName. Expected: " . $this->getParameterRepresentation($function));
    }


    public function classProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->classes as $class) {
            yield "class {$class->name}" => [$class];
        }
    }

    /**
     * @dataProvider classProvider
     */
    function testClasses($class)
    {
        $className = $class->name;
        //exclude classes from PHPReflectionParser
        if(substr( $className, 0, 3 ) == "PHP"){
            $this->assertTrue(true);
        }
        $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->classes;
        $this->assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
        $stubClass = $stubClasses[$className];
        $this->assertEquals($class->parentClass, $stubClass->parentClass, "Class $className should extend {$class->parentClass}");
        foreach ($class->constants as $constant) {
            $this->assertArrayHasKey($constant->name, $stubClass->constants, "Missing constant $className::{$constant->name}");
        }
        // @todo check interfaces
        // @todo check traits
        foreach ($class->methods as $method) {
            $params = $this->getParameterRepresentation($method);
            $methodName = $method->name;
            $this->assertArrayHasKey($methodName, $stubClass->methods, "Missing method $className::$methodName($params){}");
            $stubMethod = $stubClass->methods[$methodName];
            $this->assertEquals($method->is_final, $stubMethod->is_final, "Method $className::$methodName final modifier is incorrect");
            $this->assertEquals($method->is_static, $stubMethod->is_static, "Method $className::$methodName static modifier is incorrect");
            $this->assertEquals($method->access, $stubMethod->access, "Method $className::$methodName access modifier is incorrect");
            $this->assertSameSize($method->parameters, $stubMethod->parameters, "Parameter number mismatch for method $className::$methodName. Expected: " . $this->getParameterRepresentation($method));
        }
    }


    private function getParameterRepresentation($function)
    {
        $result = "";
        foreach ($function->parameters as $parameter) {
            if (!empty($parameter->type)) {
                $result .= $parameter->type . " ";
            }
            if ($parameter->is_passed_by_ref) {
                $result .= "&";
            }
            if ($parameter->is_vararg) {
                $result .= "...";
            }
            $result .= "$". $parameter->name . ", ";
        }
        $result = rtrim($result, ", ");
        return $result;
    }
}