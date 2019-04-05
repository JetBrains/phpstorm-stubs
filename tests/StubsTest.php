<?php

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpDocumentor\Reflection\DocBlock\Tags\See;
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
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsTest extends TestCase
{
    protected static $call_map_vimeo_psalm = [];

    public static function setUpBeforeClass()
    {
        self::$call_map_vimeo_psalm = include __DIR__ . '/../vendor/vimeo/psalm/src/Psalm/Internal/CallMap.php';

        $call_map_vimeo_psalm_7_1 = include __DIR__ . '/../vendor/vimeo/psalm/src/Psalm/Internal/CallMap_71_delta.php';
        self::$call_map_vimeo_psalm += $call_map_vimeo_psalm_7_1['new'];

        $call_map_vimeo_psalm_7_2 = include __DIR__ . '/../vendor/vimeo/psalm/src/Psalm/Internal/CallMap_72_delta.php';
        self::$call_map_vimeo_psalm += $call_map_vimeo_psalm_7_2['new'];

        $call_map_vimeo_psalm_7_3 = include __DIR__ . '/../vendor/vimeo/psalm/src/Psalm/Internal/CallMap_73_delta.php';
        self::$call_map_vimeo_psalm += $call_map_vimeo_psalm_7_3['new'];

        $call_map_vimeo_psalm_7_4 = include __DIR__ . '/../vendor/vimeo/psalm/src/Psalm/Internal/CallMap_74_delta.php';
        self::$call_map_vimeo_psalm += $call_map_vimeo_psalm_7_4['new'];
    }

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
            static::assertEquals($stubInterface->parentInterfaces, $interface->parentInterfaces);
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
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubConstantProvider
     * @param PHPConst $constant
     * @throws InvalidArgumentException
     */
    public function testConstantsPHPDocs(PHPConst $constant): void
    {
        static::assertNull($constant->parseError, $constant->parseError ?: '');
        $this->checkLinks($constant, "function $constant->name");
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
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubMethodProvider
     * @param string $methodName
     * @param PHPMethod $method
     * @throws InvalidArgumentException
     */
    public function testMethodsReturnPHPDocs(string $methodName, PHPMethod $method): void
    {
        if ($methodName === '__construct') {
            return;
        }

        // init
        $methodNameWithClass = $method->parentName . '::' . $methodName;

        // TODO ...
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubFunctionProvider
     * @param PHPFunction $function
     * @throws InvalidArgumentException
     */
    public function testFunctionReturnPHPDocs(PHPFunction $function): void
    {
        // init
        $functionName = $function->name;

        $ignoreErrors = [
            'abs', // return type depends on parameter usage
            'ceil', // "ceil() is still of type float as the value range of float is usually bigger than that of integer"?
            'version_compare', // return type depends on parameter usage
            'microtime', // return type depends on parameter usage
            'getenv', // return type depends on parameter usage
            'fscanf', // return type depends on parameter usage
            'print_r', // return type depends on parameter usage
            'hrtime', // return type depends on parameter usage
            'gettimeofday', // return type depends on parameter usage
            'apc_store', // return type depends on parameter usage
            'apc_delete', // return type depends on parameter usage
            'apc_add', // return type depends on parameter usage
            'apc_exists', // return type depends on parameter usage
            'apcu_store', // return type depends on parameter usage
            'apcu_delete', // return type depends on parameter usage
            'apcu_add', // return type depends on parameter usage
            'apcu_exists', // return type depends on parameter usage
        ];
        if (in_array($functionName, $ignoreErrors, true)) {
            static::assertTrue(true);

            return;
        }

        if (!$function->returnType) {
            static::markTestSkipped('TODO: no return data found in phpdoc: ' . $functionName . ' | ' . print_r($function, true));

            return;
        }

        if (isset(self::$call_map_vimeo_psalm[$functionName])) {
            $returnTypeFromPsalm = $this->getTypeFromPsalm($functionName);
            $returnTypeFromPhpDoc = $this->getTypeFromPhpFunction($function);

            if ($returnTypeFromPhpDoc) {
                static::assertEquals(
                    $returnTypeFromPsalm,
                    $returnTypeFromPhpDoc,
                    $functionName . ': Failed asserting that (psalm-data) "' . print_r($returnTypeFromPsalm, true) . '" == (phpdoc-data) "' . print_r($returnTypeFromPhpDoc, true) . '"'
                );

                return;
            }

            static::markTestSkipped('TODO: ' . $functionName . ': return type is missing? | psalm-data: ' . print_r(self::$call_map_vimeo_psalm[$functionName], true) . ' | phpdoc-data: ' . print_r($function));

            return;
        }

        static::markTestSkipped('TODO: no return data found in psalm: ' . $functionName);
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
     * @param string $returnTypeFromPsalm
     *
     * @return string
     */
    private function convertPsalmTypeHelper(string $returnTypeFromPsalm): string
    {
        // hack for "OCI-Lob" != "OCI_Lob"
        $returnTypeFromPsalm = str_replace('OCI-', 'OCI_', $returnTypeFromPsalm);

        if ($returnTypeFromPsalm === '') {
            return 'mixed';
        }

        if ($returnTypeFromPsalm === 'class-string') {
            return 'string';
        }

        if (preg_match('/array{.*}/', $returnTypeFromPsalm)) {
            return 'array';
        }

        preg_match('/array<.*?,(?<type>.*)>/', $returnTypeFromPsalm, $outputTmp);
        if ($outputTmp && count($outputTmp) > 0) {
            if (strpos($outputTmp['type'], 'array') !== false) {
                return 'array';
            }

            $returnTmp = $outputTmp['type'] . '[]';
            if ($returnTmp === 'mixed[]') {
                return 'array';
            }

            return $returnTmp;
        }

        preg_match('/\?(?<type>.*)/', $returnTypeFromPsalm, $outputTmp);
        if ($outputTmp && count($outputTmp) > 0) {
            return $outputTmp['type'] . '|null';
        }

        return $returnTypeFromPsalm;
    }

    private function getTypeFromPsalm(string $functionName): array
    {
        $returnTypeFromPsalmInput = ltrim(self::$call_map_vimeo_psalm[$functionName][0], '\\');

        preg_match_all('/(?:[^<|]|<[^>]*>)+/', $returnTypeFromPsalmInput, $returnTypeFromPsalm);
        $returnTypeFromPsalm = $returnTypeFromPsalm[0];
        foreach ($returnTypeFromPsalm as &$retrunTmp) {
            $retrunTmp = $this->convertPsalmTypeHelper($retrunTmp);
        }
        unset($retrunTmp);
        /* the inner empty array covers cases when no loops were made */
        $returnTypeFromPsalmInner = [];
        foreach ($returnTypeFromPsalm as $key => &$retrunTmp) {
            if (strpos($retrunTmp, '|') !== false) {
                unset($returnTypeFromPsalm[$key]);
                $returnTypeFromPsalmInner[] = explode('|', $retrunTmp);
            }
        }
        unset($retrunTmp);

        $returnTypeFromPsalm = array_unique(array_merge($returnTypeFromPsalm, ...$returnTypeFromPsalmInner));
        sort($returnTypeFromPsalm);

        return $returnTypeFromPsalm;
    }

    /**
     * @param \StubTests\Model\PHPFunction $function
     *
     * @return array
     */
    private function getTypeFromPhpFunction(PHPFunction $function): array
    {
        $returnTypeFromPhpDoc = explode('|', ltrim($function->returnType, '\\'));
        foreach ($returnTypeFromPhpDoc as &$returnTypeFromPhpDocTmp) {
            $returnTypeFromPhpDocTmp = ltrim($returnTypeFromPhpDocTmp, '\\');
        }
        unset($returnTypeFromPhpDocTmp);

        sort($returnTypeFromPhpDoc);

        return $returnTypeFromPhpDoc;
    }
}
