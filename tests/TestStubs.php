<?php

use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use PHPUnit\Framework\TestCase;

include __DIR__ . '/StubParser.php';
include __DIR__ . '/../vendor/autoload.php';

class ReflectionStubsSingleton
{
    private static $reflectionStubs;

    public static function getReflectionStubs(): stdClass
    {
        if (self::$reflectionStubs === null) {
            $json = file_get_contents(__DIR__ . '/stub.json');
            self::$reflectionStubs = json_decode($json);
        }
        return self::$reflectionStubs;
    }
}

class PhpStormStubsSingleton
{
    private static $phpstormStubs;

    public static function getPhpStormStubs(): stdClass
    {
        if (self::$phpstormStubs === null) {
            self::$phpstormStubs = getPhpStormStubs();
        }
        return self::$phpstormStubs;
    }
}

class MutedProblems
{
    /** @var stdClass */
    private $mutedProblems;

    public function __construct()
    {
        $json = file_get_contents(__DIR__ . '/mutedProblems.json');
        $this->mutedProblems = json_decode($json);
    }

    public function getMutedProblemsForConstant(string $constantName): array
    {
        foreach ($this->mutedProblems->constants as $constant) {
            if ($constant->name === $constantName) {
                return $constant->problems;
            }
        }
        return [];
    }

    public function getMutedProblemsForFunction(string $functionName): array
    {
        foreach ($this->mutedProblems->functions as $function) {
            if ($function->name === $functionName) {
                return $function->problems;
            }
        }
        return [];
    }

    public function getMutedProblemsForClass(string $className): array
    {
        foreach ($this->mutedProblems->classes as $class) {
            if ($class->name === $className && !empty($class->problems)) {
                return $class->problems;
            }
        }
        return [];
    }

    public function getMutedProblemsForMethod(string $className, $methodName): array
    {
        foreach ($this->mutedProblems->classes as $class) {
            if ($class->name === $className && !empty($class->methods)) {
                foreach ($class->methods as $method) {
                    if ($method->name === $methodName) {
                        return $method->problems;
                    }
                }
            }
        }
        return [];
    }

    public function getMutedProblemsForClassConstants($className, $constantName)
    {
        foreach ($this->mutedProblems->classes as $class) {
            if ($class->name === $className && !empty($class->constants)) {
                foreach ($class->constants as $constant) {
                    if ($constant->name === $constantName) {
                        return $constant->problems;
                    }
                }
            }
        }
        return [];
    }

    public function getMutedProblemsForInterface($interfaceName)
    {
        foreach ($this->mutedProblems->interfaces as $interface) {
            if ($interface->name === $interfaceName && !empty($interface->problems)) {
                return $interface->problems;
            }
        }
        return [];
    }
}

class TestStubs extends TestCase
{
    /** @var MutedProblems */
    private static $mutedProblems;

    public static function setUpBeforeClass()/* The :void return type declaration that should be here would cause a BC issue */
    {
        self::$mutedProblems = new MutedProblems();
    }


    public function constantProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->constants as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    /**
     * @dataProvider constantProvider
     */
    public function testConstants(stdClass $constant)
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->constants;
        if (in_array('missing constant', self::$mutedProblems->getMutedProblemsForConstant($constantName), true)) {
            $this->markTestSkipped('constant is excluded');
        }
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
    public function testFunctions(stdClass $function)
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->functions;
        $params = $this->getParameterRepresentation($function);
        if (in_array('missing function', self::$mutedProblems->getMutedProblemsForFunction($functionName), true)) {
            $this->markTestSkipped('function is excluded');
        }
        $this->assertArrayHasKey($functionName, $stubFunctions, "Missing function: function $functionName($params){}");
        $phpstormFunction = $stubFunctions[$functionName];
        if (!in_array('deprecated function', self::$mutedProblems->getMutedProblemsForFunction($functionName), true)) {
            $this->assertFalse($function->is_deprecated && $phpstormFunction->is_deprecated !== true, "Function $functionName is not deprecated in stubs");
        }
        if (!in_array('parameter mismatch', self::$mutedProblems->getMutedProblemsForFunction($functionName), true)) {
            $this->assertSameSize($function->parameters, $phpstormFunction->parameters,
                "Parameter number mismatch for function $functionName. Expected: " . $this->getParameterRepresentation($function));
        }

    }


    public function classProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->classes as $class) {
            //exclude classes from PHPReflectionParser
            if (0 !== strncmp($class->name, 'PHP', 3)) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    /**
     * @dataProvider classProvider
     */
    public function testClasses(stdClass $class)
    {
        $className = $class->name;
        $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->classes;
        if (in_array('missing class', self::$mutedProblems->getMutedProblemsForClass($className), true)) {
            $this->markTestSkipped('class is skipped');
        }
        $this->assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
        $stubClass = $stubClasses[$className];
        if (!in_array('wrong parent', self::$mutedProblems->getMutedProblemsForClass($className), true)) {
            $this->assertEquals($class->parentClass, $stubClass->parentClass, "Class $className should extend {$class->parentClass}");
        }
        foreach ($class->constants as $constant) {
            if (!in_array('missing constant', self::$mutedProblems->getMutedProblemsForClassConstants($className, $constant->name), true)) {
                $this->assertArrayHasKey($constant->name, $stubClass->constants, "Missing constant $className::{$constant->name}");
            }
        }

        foreach ($class->methods as $method) {
            $params = $this->getParameterRepresentation($method);
            $methodName = $method->name;
            if (!in_array('missing method', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                $this->assertArrayHasKey($methodName, $stubClass->methods, "Missing method $className::$methodName($params){}");
                $stubMethod = $stubClass->methods[$methodName];
                if (!in_array('not final', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    $this->assertEquals($method->is_final, $stubMethod->is_final, "Method $className::$methodName final modifier is incorrect");
                }
                if (!in_array('not static', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    $this->assertEquals($method->is_static, $stubMethod->is_static, "Method $className::$methodName static modifier is incorrect");
                }
                if (!in_array('access modifiers', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    $this->assertEquals($method->access, $stubMethod->access, "Method $className::$methodName access modifier is incorrect");
                }
                if (!in_array('parameter mismatch', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    $this->assertSameSize($method->parameters, $stubMethod->parameters, "Parameter number mismatch for method $className::$methodName. Expected: " . $this->getParameterRepresentation($method));
                }
            }
        }

    }

    public function interfaceProvider()
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->interfaces as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }

    /**
     * @dataProvider interfaceProvider
     */
    public function testInterfaces(stdClass $interface)
    {
        $interfaceName = $interface->name;
        $stubInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->interfaces;
        if (in_array('missing interface', self::$mutedProblems->getMutedProblemsForInterface($interfaceName), true)) {
            $this->markTestSkipped('interface is skipped');
        }
        $this->assertArrayHasKey($interfaceName, $stubInterfaces, "Missing interface $interfaceName: interface $interfaceName {}");
        $stubInterface = $stubInterfaces[$interfaceName];
        if (!in_array('wrong parent', self::$mutedProblems->getMutedProblemsForInterface($interfaceName), true)) {
            $this->assertEquals($stubInterface->parentInterfaces, $interface->parentInterfaces);
        }
        foreach ($interface->constants as $constant) {
            if (!in_array('missing constant', self::$mutedProblems->getMutedProblemsForClassConstants($interfaceName, $constant->name), true)) {
                $this->assertArrayHasKey($constant->name, $stubInterface->constants, "Missing constant $interfaceName::{$constant->name}");
            }
        }
        foreach ($interface->methods as $method) {
            $params = $this->getParameterRepresentation($method);
            $methodName = $method->name;
            if (!in_array('missing method', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                $this->assertArrayHasKey($methodName, $stubInterface->methods, "Missing method $interfaceName::$methodName($params){}");
                $stubMethod = $stubInterface->methods[$methodName];
                if (!in_array('not final', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    $this->assertEquals($method->is_final, $stubMethod->is_final, "Method $interfaceName::$methodName final modifier is incorrect");
                }
                if (!in_array('not static', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    $this->assertEquals($method->is_static, $stubMethod->is_static, "Method $interfaceName::$methodName static modifier is incorrect");
                }
                if (!in_array('access modifiers', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    $this->assertEquals($method->access, $stubMethod->access, "Method $interfaceName::$methodName access modifier is incorrect");
                }
                if (!in_array('parameter mismatch', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    $this->assertSameSize($method->parameters, $stubMethod->parameters, "Parameter number mismatch for method $interfaceName::$methodName. Expected: " . $this->getParameterRepresentation($method));
                }
            }
        }
    }


    public function stubClassConstantProvider(){
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->classes as $className => $class) {
            foreach ($class->constants as $constantName => $constant) {
                yield "Constant {$className}::{$constantName}" => [$className, $constant];
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->interfaces as $interfaceName => $interface) {
            foreach ($interface->constants as $constantName => $constant) {
                yield "Constant {$interfaceName}::{$constantName}" => [$interfaceName, $constant];
            }
        }
    }

    /**
     * @dataProvider stubClassConstantProvider
     */
    public function testClassConstantsPHPDocs(string $className, stdClass $constant)
    {
        $this->assertNull($constant->parseError, $constant->parseError ?: "");
        $this->checkLinks($constant, "constant $className::$constant->name");
    }

    public function stubConstantProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->constants as $constantName => $constant) {
            yield "constant {$constantName}" => [$constant];
        }
    }

    /**
     * @dataProvider stubConstantProvider
     */
    public function testConstantsPHPDocs(stdClass $constant)
    {
        $this->assertNull($constant->parseError, $constant->parseError ?: "");
        $this->checkLinks($constant, "function $constant->name");
    }

    public function stubFunctionProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->functions as $functionName => $function) {
            yield "function {$functionName}" => [$function];
        }
    }

    /**
     * @dataProvider stubFunctionProvider
     */
    public function testFunctionPHPDocs(stdClass $function)
    {
        $this->assertNull($function->parseError, $function->parseError ?: "");
        $this->checkLinks($function, "function $function->name");
    }

    public function stubClassProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->classes as $className => $class) {
            yield "class {$className}" => [$class];
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->interfaces as $interfaceName => $interface) {
            yield "interface {$interfaceName}" => [$interface];
        }
    }

    /**
     * @dataProvider stubClassProvider
     */
    public function testClassesPHPDocs(stdClass $class)
    {
        $this->assertNull($class->parseError, $class->parseError ?: "");
        $this->checkLinks($class, "class $class->name");
    }

    public function stubMethodProvider()
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->classes as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "Method {$className}::{$methodName}" => [$methodName, $method];
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->interfaces as $interfaceName => $interface) {
            foreach ($interface->methods as $methodName => $method) {
                yield "Method {$interfaceName}::{$methodName}" => [$methodName, $method];
            }
        }
    }

    /**
     * @dataProvider stubMethodProvider
     */
    public function testMethodsPHPDocs(string $methodName, stdClass $method)
    {
        if ($methodName === "__construct") {
            $this->assertNull($method->returnTag, "@return tag for __construct should be omitted");
        }
        $this->assertNull($method->parseError, $method->parseError ?: "");
        $this->checkLinks($method, "method $methodName");
    }

    private function getParameterRepresentation(stdClass $function): string
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

    private function checkLinks($element, $elementName): void
    {
        foreach ($element->links as $link) {
            if ($link instanceof Link) {
                $this->assertStringStartsWith('https', $link->getLink(), "In $elementName @link doesn't start with https");
            }
        }
        foreach ($element->see as $see) {
            if ($see instanceof See && $see->getReference() instanceof Url) {
                if (strpos($see, 'http') === 0) {
                    $this->assertStringStartsWith('https', $see, "In $elementName @see doesn't start with https");
                }
            }
        }
    }
}