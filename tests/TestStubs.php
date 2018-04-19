<?php

use PHPUnit\Framework\TestCase;

include "StubParser.php";
include "./vendor/autoload.php";

class ReflectionStubsSingleton
{
    private static $reflectionStubs = null;

    public static function getReflectionStubs(): stdClass
    {
        if (self::$reflectionStubs == null) {
            $json = file_get_contents("./stub.json");
            self::$reflectionStubs = json_decode($json);
        }
        return self::$reflectionStubs;
    }
}

class PhpStormStubsSingleton
{
    private static $phpstormStubs = null;

    public static function getPhpStormStubs(): array
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
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()['constants'];
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
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()['functions'];
        $params = $this->getParameterRepresentation($function);
        $this->assertArrayHasKey($functionName, $stubFunctions, "Missing function: function $functionName($params){}");
        $phpstormFunction = $stubFunctions[$functionName];
        $this->assertEquals($function->is_deprecated, $phpstormFunction['is_deprecated']);
        $this->assertSameSize($function->parameters, $phpstormFunction['parameters']);
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
        $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()['classes'];
        $this->assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
        $stubClass = $stubClasses[$className];
        foreach ($class->constants as $constant) {
            $this->assertArrayHasKey($constant->name, $stubClass['constants'], "Missing constant $className::{$constant->name}");
        }
        foreach ($class->methods as $method) {
            $params = $this->getParameterRepresentation($method);
            $this->assertArrayHasKey($method->name, $stubClass['methods'], "Missing method $className::{$method->name}($params){}");
            $stubMethod = $stubClass['methods'][$method->name];
            $this->assertEquals($method->is_final,$stubMethod['is_final']);
            $this->assertEquals($method->is_static,$stubMethod['is_static']);
            $this->assertEquals($method->access,$stubMethod['access']);
            $this->assertSameSize($method->parameters,$stubMethod['parameters']);
        }
    }


    private function getParameterRepresentation($function)
    {
        $result = "";
        foreach ($function->parameters as $parameter) {
            if ($parameter->type != "") {
                $result .= $parameter->type . " ";
            }
            if ($parameter->is_passed_by_ref) {
                $result .= "&";
            }
            if ($parameter->is_vararg) {
                $result .= "...";
            }
            $result .= $parameter->name . ", ";
        }
        $result = rtrim($result, ", ");
        return $result;
    }
}