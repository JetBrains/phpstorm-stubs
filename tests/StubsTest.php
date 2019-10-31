<?php

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use StubTests\Model\BasePHPClass;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPDocElement;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::constantProvider
     * @param PHPConst $constant
     * @throws InvalidArgumentException
     */
    public function testConstants(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getConstants();
        if ($constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
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
     * @throws InvalidArgumentException
     */
    public function testConstantsValues(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getConstants();
        if ($constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('constant is excluded');
        }
        if ($constant->hasMutedProblem(StubProblemType::WRONG_CONSTANT_VALUE)) {
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
     * @throws InvalidArgumentException
     */
    public function testFunctions(PHPFunction $function): void
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $params = self::getParameterRepresentation($function);
        if ($function->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('function is excluded');
        }
        static::assertArrayHasKey($functionName, $stubFunctions, "Missing function: function $functionName($params){}");
        $phpstormFunction = $stubFunctions[$functionName];
        if (!$function->hasMutedProblem(StubProblemType::FUNCTION_IS_DEPRECATED)) {
            static::assertFalse(
                $function->is_deprecated && $phpstormFunction->is_deprecated !== true,
                "Function $functionName is not deprecated in stubs"
            );
        }
        if (!$function->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
            static::assertSameSize(
                $function->parameters,
                $phpstormFunction->parameters,
                "Parameter number mismatch for function $functionName. 
                Expected: " . self::getParameterRepresentation($function)
            );
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::classProvider
     * @param PHPClass $class
     * @throws InvalidArgumentException
     */
    public function testClasses(PHPClass $class): void
    {
        $className = $class->name;
        $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->getClasses();
        if ($class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('class is skipped');
        }
        static::assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
        $stubClass = $stubClasses[$className];
        if (!$class->hasMutedProblem(StubProblemType::WRONG_PARENT)) {
            static::assertEquals(
                $class->parentClass,
                $stubClass->parentClass,
                "Class $className should extend {$class->parentClass}"
            );
        }
        foreach ($class->constants as $constant) {
            if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $constant->name,
                    $stubClass->constants,
                    "Missing constant $className::{$constant->name}"
                );
            }
        }
        foreach ($class->methods as $method) {
            $params = self::getParameterRepresentation($method);
            $methodName = $method->name;
            if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $methodName,
                    $stubClass->methods,
                    "Missing method $className::$methodName($params){}"
                );
                $stubMethod = $stubClass->methods[$methodName];
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_FINAL)) {
                    static::assertEquals(
                        $method->is_final,
                        $stubMethod->is_final,
                        "Method $className::$methodName final modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_STATIC)) {
                    static::assertEquals(
                        $method->is_static,
                        $stubMethod->is_static,
                        "Method $className::$methodName static modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_ACCESS)) {
                    static::assertEquals(
                        $method->access,
                        $stubMethod->access,
                        "Method $className::$methodName access modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                    static::assertSameSize(
                        $method->parameters,
                        $stubMethod->parameters,
                        "Parameter number mismatch for method $className::$methodName. 
                        Expected: " . self::getParameterRepresentation($method)
                    );
                }
            }
        }
        foreach ($class->interfaces as $interface) {
            if (!$class->hasMutedProblem(StubProblemType::WRONG_INTERFACE)) {
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
     * @throws InvalidArgumentException
     */
    public function testInterfaces(PHPInterface $interface): void
    {
        $interfaceName = $interface->name;
        $stubInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        if ($interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('interface is skipped');
        }
        static::assertArrayHasKey(
            $interfaceName,
            $stubInterfaces,
            "Missing interface $interfaceName: interface $interfaceName {}"
        );
        $stubInterface = $stubInterfaces[$interfaceName];
        if (!$interface->hasMutedProblem(StubProblemType::WRONG_PARENT)) {
            foreach ($interface->parentInterfaces as $parentInterface) {
                static::assertContains(
                    $parentInterface,
                    $stubInterface->parentInterfaces,
                    "Missing parent interface $parentInterface"
                );
            }
        }
        foreach ($interface->constants as $constant) {
            if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $constant->name,
                    $stubInterface->constants,
                    "Missing constant $interfaceName::{$constant->name}"
                );
            }
        }
        foreach ($interface->methods as $method) {
            $params = self::getParameterRepresentation($method);
            $methodName = $method->name;
            if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $methodName,
                    $stubInterface->methods,
                    "Missing method $interfaceName::$methodName($params){}"
                );
                $stubMethod = $stubInterface->methods[$methodName];
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_FINAL)) {
                    static::assertEquals(
                        $method->is_final,
                        $stubMethod->is_final,
                        "Method $interfaceName::$methodName final modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_STATIC)) {
                    static::assertEquals(
                        $method->is_static,
                        $stubMethod->is_static,
                        "Method $interfaceName::$methodName static modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_ACCESS)) {
                    static::assertEquals(
                        $method->access,
                        $stubMethod->access,
                        "Method $interfaceName::$methodName access modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                    static::assertSameSize(
                        $method->parameters,
                        $stubMethod->parameters,
                        "Parameter number mismatch for method $interfaceName::$methodName. 
                        Expected: " . self::getParameterRepresentation($method)
                    );
                }
            }
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubClassConstantProvider
     * @param string $className
     * @param PHPConst $constant
     * @throws InvalidArgumentException
     */
    public function testClassConstantsPHPDocs(string $className, PHPConst $constant): void
    {
        static::assertNull($constant->parseError, $constant->parseError ?: '');
        $this->checkLinks($constant, "constant $className::$constant->name");
        if ($constant->stubBelongsToCore) {
            $this->checkDeprecatedSinceVersionsMajor($constant, "constant $className::$constant->name");
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubConstantProvider
     * @param PHPConst $constant
     * @throws InvalidArgumentException
     */
    public function testConstantsPHPDocs(PHPConst $constant): void
    {
        static::assertNull($constant->parseError, $constant->parseError ?: '');
        $this->checkLinks($constant, "constant $constant->name");
        if ($constant->stubBelongsToCore) {
            $this->checkDeprecatedSinceVersionsMajor($constant, "constant $constant->name");
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubFunctionProvider
     * @param PHPFunction $function
     * @throws InvalidArgumentException
     */
    public function testFunctionPHPDocs(PHPFunction $function): void
    {
        static::assertNull($function->parseError, $function->parseError ?: '');
        $this->checkLinks($function, "function $function->name");
        if ($function->stubBelongsToCore) {
            $this->checkDeprecatedSinceVersionsMajor($function, "function $function->name");
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubClassProvider
     * @param BasePHPClass $class
     * @throws InvalidArgumentException
     */
    public function testClassesPHPDocs(BasePHPClass $class): void
    {
        static::assertNull($class->parseError, $class->parseError ?: '');
        $this->checkLinks($class, "class $class->name");
        if ($class->stubBelongsToCore) {
            $this->checkDeprecatedSinceVersionsMajor($class, "class $class->name");
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubMethodProvider
     * @param string $methodName
     * @param PHPMethod $method
     * @throws InvalidArgumentException
     */
    public function testMethodsPHPDocs(string $methodName, PHPMethod $method): void
    {
        if ($methodName === '__construct') {
            static::assertNull($method->returnTag, '@return tag for __construct should be omitted');
        }
        static::assertNull($method->parseError, $method->parseError ?: '');
        $this->checkLinks($method, "method $methodName");
        if ($method->stubBelongsToCore) {
            $this->checkDeprecatedSinceVersionsMajor($method, "method $methodName");
        }
    }

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

    /**
     * @param PHPDocElement $element
     * @param string $elementName
     * @throws InvalidArgumentException
     */
    private function checkLinks($element, $elementName): void
    {
        foreach ($element->links as $link) {
            if ($link instanceof Link) {
                static::assertStringStartsWith(
                    'https',
                    $link->getLink(),
                    "In $elementName @link doesn't start with https"
                );
            }
        }
        foreach ($element->see as $see) {
            if ($see instanceof See && $see->getReference() instanceof Url && strncmp($see, 'http', 4) === 0) {
                static::assertStringStartsWith('https', $see, "In $elementName @see doesn't start with https");
            }
        }
    }

    /**
     * @param PHPDocElement $element
     * @param string $elementName
     * @throws InvalidArgumentException
     */
    private function checkDeprecatedSinceVersionsMajor($element, $elementName): void
    {
        foreach ($element->sinceTags as $sinceTag) {
            if ($sinceTag instanceof Since) {
                $version = $sinceTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::versionIsMajor($sinceTag), "$elementName has 'since' version $version.
                    'Since' version for PHP Core functionallity should have X.X format due to functionallity usually 
                    isn't added in patch updates. If you believe this is not correct, please submit an issue about your case at
                    https://youtrack.jetbrains.com/issues/WI");
                }
            }
        }
        foreach ($element->deprecatedTags as $deprecatedTag) {
            if ($deprecatedTag instanceof Deprecated) {
                $version = $deprecatedTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::versionIsMajor($deprecatedTag), "$elementName has 'deprecated' version $version .
                    'Deprecated' version for PHP Core functionallity should have X.X format due to functionallity usually 
                    isn't deprecated in patch updates. If you believe this is not correct, please submit an issue about your case at
                    https://youtrack.jetbrains.com/issues/WI");
                }
            }
        }
    }
}
