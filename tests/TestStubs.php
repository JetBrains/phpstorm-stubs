<?php

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use PHPUnit\Framework\TestCase;
use StubTests\Model\BasePHPClass;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\TestData\MutedProblems;
use StubTests\TestData\providers\PhpStormStubsSingleton;

class TestStubs extends TestCase
{

    /** @var MutedProblems */
    private static $mutedProblems;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$mutedProblems = new MutedProblems();
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::constantProvider
     * @param PHPConst $constant
     */
    public function testConstants(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()[PHPConst::class];
        if (in_array('missing constant', self::$mutedProblems->getMutedProblemsForConstant($constantName), true)) {
            static::markTestSkipped('constant is excluded');
        }
        static::assertArrayHasKey(
            $constantName,
            $stubConstants,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::constantProvider
     * @param PHPConst $constant
     */
    public function testConstantsValues(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        /**@var PHPConst[] $stubConstants */
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()[PHPConst::class];
        if (in_array('wrong value', self::$mutedProblems->getMutedProblemsForConstant($constantName), true)) {
            static::markTestSkipped('constant is excluded');
        }

        static::assertEquals(
            $constantValue,
            $stubConstants[$constantName]->value,
            "Constant value mismatch: const $constantName \n
            Expected value: $constantValue but was {$stubConstants[$constantName]->value}"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::functionProvider
     * @param PHPFunction $function
     */
    public function testFunctions(PHPFunction $function): void
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()[PHPFunction::class];
        $params = $this->getParameterRepresentation($function);
        if (in_array('missing function', self::$mutedProblems->getMutedProblemsForFunction($functionName), true)) {
            static::markTestSkipped('function is excluded');
        }
        static::assertArrayHasKey($functionName, $stubFunctions, "Missing function: function $functionName($params){}");
        /**@var PHPFunction $phpstormFunction */
        $phpstormFunction = $stubFunctions[$functionName];
        if (!in_array('deprecated function', self::$mutedProblems->getMutedProblemsForFunction($functionName), true)) {
            static::assertFalse(
                $function->is_deprecated && $phpstormFunction->is_deprecated !== true,
                "Function $functionName is not deprecated in stubs"
            );
        }
        if (!in_array('parameter mismatch', self::$mutedProblems->getMutedProblemsForFunction($functionName), true)) {
            static::assertSameSize(
                $function->parameters,
                $phpstormFunction->parameters,
                "Parameter number mismatch for function $functionName. 
                Expected: " . $this->getParameterRepresentation($function)
            );
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::classProvider
     * @param PHPClass $class
     */
    public function testClasses(PHPClass $class): void
    {
        $className = $class->name;
        $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()[PHPClass::class];
        if (in_array('missing class', self::$mutedProblems->getMutedProblemsForClass($className), true)) {
            static::markTestSkipped('class is skipped');
        }
        static::assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
        /**@var PHPClass $stubClass */
        $stubClass = $stubClasses[$className];
        if (!in_array('wrong parent', self::$mutedProblems->getMutedProblemsForClass($className), true)) {
            static::assertEquals(
                $class->parentClass,
                $stubClass->parentClass,
                "Class $className should extend {$class->parentClass}"
            );
        }
        foreach ($class->constants as $constant) {
            if (!in_array('missing constant', self::$mutedProblems->getMutedProblemsForClassConstants($className, $constant->name), true)) {
                static::assertArrayHasKey(
                    $constant->name,
                    $stubClass->constants,
                    "Missing constant $className::{$constant->name}"
                );
            }
        }
        foreach ($class->methods as $method) {
            $params = $this->getParameterRepresentation($method);
            $methodName = $method->name;
            if (!in_array('missing method', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                static::assertArrayHasKey(
                    $methodName,
                    $stubClass->methods,
                    "Missing method $className::$methodName($params){}"
                );
                $stubMethod = $stubClass->methods[$methodName];
                if (!in_array('not final', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    static::assertEquals(
                        $method->is_final,
                        $stubMethod->is_final,
                        "Method $className::$methodName final modifier is incorrect"
                    );
                }
                if (!in_array('not static', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    static::assertEquals(
                        $method->is_static,
                        $stubMethod->is_static,
                        "Method $className::$methodName static modifier is incorrect"
                    );
                }
                if (!in_array('access modifiers', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    static::assertEquals(
                        $method->access,
                        $stubMethod->access,
                        "Method $className::$methodName access modifier is incorrect"
                    );
                }
                if (!in_array('parameter mismatch', self::$mutedProblems->getMutedProblemsForMethod($className, $methodName), true)) {
                    static::assertSameSize(
                        $method->parameters,
                        $stubMethod->parameters,
                        "Parameter number mismatch for method $className::$methodName. 
                        Expected: " . $this->getParameterRepresentation($method)
                    );
                }
            }
        }
        foreach ($class->interfaces as $interface) {
            if (!in_array('wrong interface', self::$mutedProblems->getMutedProblemsForClass($className), true)) {
                static::assertContains(
                    $interface,
                    $stubClass->interfaces,
                    "Class $className doesn't implement interface $interface"
                );
            }
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::interfaceProvider
     * @param PHPInterface $interface
     */
    public function testInterfaces(PHPInterface $interface): void
    {
        $interfaceName = $interface->name;
        /**@var PHPInterface[] $stubInterfaces */
        $stubInterfaces = PhpStormStubsSingleton::getPhpStormStubs()[PHPInterface::class];
        if (in_array('missing interface', self::$mutedProblems->getMutedProblemsForInterface($interfaceName), true)) {
            static::markTestSkipped('interface is skipped');
        }
        static::assertArrayHasKey(
            $interfaceName,
            $stubInterfaces,
            "Missing interface $interfaceName: interface $interfaceName {}"
        );
        $stubInterface = $stubInterfaces[$interfaceName];
        if (!in_array('wrong parent', self::$mutedProblems->getMutedProblemsForInterface($interfaceName), true)) {
            static::assertEquals($stubInterface->parentInterfaces, $interface->parentInterfaces);
        }
        foreach ($interface->constants as $constant) {
            if (!in_array('missing constant', self::$mutedProblems->getMutedProblemsForClassConstants($interfaceName, $constant->name), true)) {
                static::assertArrayHasKey(
                    $constant->name,
                    $stubInterface->constants,
                    "Missing constant $interfaceName::{$constant->name}"
                );
            }
        }
        foreach ($interface->methods as $method) {
            $params = $this->getParameterRepresentation($method);
            $methodName = $method->name;
            if (!in_array('missing method', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                static::assertArrayHasKey(
                    $methodName,
                    $stubInterface->methods,
                    "Missing method $interfaceName::$methodName($params){}"
                );
                $stubMethod = $stubInterface->methods[$methodName];
                if (!in_array('not final', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    static::assertEquals(
                        $method->is_final,
                        $stubMethod->is_final,
                        "Method $interfaceName::$methodName final modifier is incorrect"
                    );
                }
                if (!in_array('not static', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    static::assertEquals(
                        $method->is_static,
                        $stubMethod->is_static,
                        "Method $interfaceName::$methodName static modifier is incorrect"
                    );
                }
                if (!in_array('access modifiers', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    static::assertEquals(
                        $method->access,
                        $stubMethod->access,
                        "Method $interfaceName::$methodName access modifier is incorrect"
                    );
                }
                if (!in_array('parameter mismatch', self::$mutedProblems->getMutedProblemsForMethod($interfaceName, $methodName), true)) {
                    static::assertSameSize(
                        $method->parameters,
                        $stubMethod->parameters,
                        "Parameter number mismatch for method $interfaceName::$methodName. 
                        Expected: " . $this->getParameterRepresentation($method)
                    );
                }
            }
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubClassConstantProvider
     * @param string $className
     * @param PHPConst $constant
     */
    public function testClassConstantsPHPDocs(string $className, PHPConst $constant): void
    {
        static::assertNull($constant->parseError, $constant->parseError ?: '');
        $this->checkLinks($constant, "constant $className::$constant->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubConstantProvider
     * @param PHPConst $constant
     */
    public function testConstantsPHPDocs(PHPConst $constant): void
    {
        static::assertNull($constant->parseError, $constant->parseError ?: '');
        $this->checkLinks($constant, "function $constant->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubFunctionProvider
     * @param PHPFunction $function
     */
    public function testFunctionPHPDocs(PHPFunction $function): void
    {
        static::assertNull($function->parseError, $function->parseError ?: '');
        $this->checkLinks($function, "function $function->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubClassProvider
     * @param BasePHPClass $class
     */
    public function testClassesPHPDocs(BasePHPClass $class): void
    {
        static::assertNull($class->parseError, $class->parseError ?: '');
        $this->checkLinks($class, "class $class->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubMethodProvider
     * @param string $methodName
     * @param PHPMethod $method
     */
    public function testMethodsPHPDocs(string $methodName, PHPMethod $method): void
    {
        if ($methodName === '__construct') {
            static::assertNull($method->returnTag, '@return tag for __construct should be omitted');
        }
        static::assertNull($method->parseError, $method->parseError ?: '');
        $this->checkLinks($method, "method $methodName");
    }

    private function getParameterRepresentation(PHPFunction $function): string
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
        /**@var Tag $link */
        foreach ($element->links as $link) {
            if ($link instanceof Link) {
                static::assertStringStartsWith(
                    'https',
                    $link->getLink(),
                    "In $elementName @link doesn't start with https"
                );
            }
        }
        /**@var Tag $see */
        foreach ($element->see as $see) {
            if ($see instanceof See && $see->getReference() instanceof Url && strncmp($see, 'http', 4) === 0) {
                static::assertStringStartsWith('https', $see, "In $elementName @see doesn't start with https");
            }
        }
    }
}
