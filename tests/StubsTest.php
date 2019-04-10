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
    /**
     * @var array
     */
    protected static $call_map_vimeo_psalm = [];

    public static function setUpBeforeClass()
    {
        self::$call_map_vimeo_psalm = include __DIR__ . '/TestData/psalm/CallMap.php';

        $call_map_vimeo_psalm_7_1 = include __DIR__ . '/TestData/psalm/CallMap_71_delta.php';
        self::$call_map_vimeo_psalm += $call_map_vimeo_psalm_7_1['new'];

        $call_map_vimeo_psalm_7_2 = include __DIR__ . '/TestData/psalm/CallMap_72_delta.php';
        self::$call_map_vimeo_psalm += $call_map_vimeo_psalm_7_2['new'];

        $call_map_vimeo_psalm_7_3 = include __DIR__ . '/TestData/psalm/CallMap_73_delta.php';
        self::$call_map_vimeo_psalm += $call_map_vimeo_psalm_7_3['new'];

        $call_map_vimeo_psalm_7_4 = include __DIR__ . '/TestData/psalm/CallMap_74_delta.php';
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

        if ($className === 'LibXMLError') {
            $className = 'libXMLError';
        }

        if ($className === 'APCuIterator') {
            $className = 'APCUIterator';
        }

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
    public function testMethodsParameterViaPsalm(string $methodName, PHPMethod $method): void
    {
        if ($methodName === '__construct') {
            static::assertTrue(true);

            return;
        }

        if (!$method->parentName) {
            static::markTestSkipped('TODO: no class found: ' . $method->parentName . ' | ' . print_r($method, true));

            return;
        }

        if (count($method->parameters) === 0) {
            static::assertTrue(true);

            return;
        }

        $methodNameWithClass = $method->parentName . '::' . $methodName;

        if (in_array($methodNameWithClass, $this->getIgnoredCalls(), true)) {
            static::assertTrue(true);

            return;
        }

        if (isset(self::$call_map_vimeo_psalm[$methodNameWithClass])) {

            foreach ($method->parameters as $count => $parameter) {

                if (!$parameter->type_from_php_doc) {
                    static::markTestSkipped('TODO: parameter error in phpdoc: ' . $methodNameWithClass . ' | parameter: ' . $parameter->name . ' | psalm: ' . print_r($parameter, true));

                    return;
                }

                if (!isset(self::$call_map_vimeo_psalm[$methodNameWithClass][trim($parameter->name, '&=.')])) {
                    static::markTestSkipped('TODO: parameter error in psalm: ' . $methodNameWithClass . ' | parameter: ' . $parameter->name . ' | psalm: ' . print_r(self::$call_map_vimeo_psalm[$methodNameWithClass], true));

                    return;
                }

                $parameterTypeFromStaticAnalyseTool = ltrim(self::$call_map_vimeo_psalm[$methodNameWithClass][trim($parameter->name, '&=.')], '\\');
                $parameterTypeFromStaticAnalyseTool = $this->getTypeFromStaticAnalyse($parameterTypeFromStaticAnalyseTool);

                $parameterTypeFromPhpDoc = $this->getTypeFromPhpElement($parameter->type_from_php_doc);

                if ($parameterTypeFromPhpDoc) {
                    static::assertEquals(
                        $parameterTypeFromStaticAnalyseTool,
                        $parameterTypeFromPhpDoc,
                        $methodNameWithClass . ' - parameter -->' . $parameter->name . '<--: Failed asserting that (psalm-data) "' . print_r($parameterTypeFromStaticAnalyseTool, true) . '" == (phpdoc-data) "' . print_r($parameterTypeFromPhpDoc, true) . '" | ' . print_r($method->parameters, true)
                    );
                }
            }

            return;
        }

        static::markTestSkipped('TODO: no parameter data found in psalm: ' . $methodNameWithClass);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubMethodProvider
     * @param string $methodName
     * @param PHPMethod $method
     * @throws InvalidArgumentException
     */
    public function testMethodsReturnViaPsalm(string $methodName, PHPMethod $method): void
    {
        if ($methodName === '__construct') {
            static::assertTrue(true);

            return;
        }

        if (!$method->parentName) {
            static::markTestSkipped('TODO: no class found: ' . $method->parentName . ' | ' . print_r($method, true));

            return;
        }

        $methodNameWithClass = $method->parentName . '::' . $methodName;

        if (in_array($methodNameWithClass, $this->getIgnoredCalls(), true)) {
            static::assertTrue(true);

            return;
        }

        if (!$method->type_from_php_doc) {
            static::markTestSkipped('TODO: no return type found for: ' . $methodNameWithClass);

            return;
        }

        if (isset(self::$call_map_vimeo_psalm[$methodNameWithClass])) {

            $returnTypeFromPsalm = ltrim(self::$call_map_vimeo_psalm[$methodNameWithClass][0], '\\');
            $returnTypeFromPsalm = $this->getTypeFromStaticAnalyse($returnTypeFromPsalm);

            $returnTypeFromPhpDoc = $this->getTypeFromPhpElement($method->type_from_php_doc);

            if ($returnTypeFromPhpDoc) {
                static::assertEquals(
                    $returnTypeFromPsalm,
                    $returnTypeFromPhpDoc,
                    $methodNameWithClass . ': Failed asserting that (psalm-data) "' . print_r($returnTypeFromPsalm, true) . '" == (phpdoc-data) "' . print_r($returnTypeFromPhpDoc, true) . '"'
                );

                return;
            }

            static::markTestSkipped('TODO: ' . $methodNameWithClass . ': return type is missing? | psalm-data: ' . print_r(self::$call_map_vimeo_psalm[$methodNameWithClass], true) . ' | phpdoc-data: ' . print_r($method, true));

            return;
        }

        static::markTestSkipped('TODO: no return data found in psalm: ' . $methodNameWithClass);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubFunctionProvider
     * @param PHPFunction $function
     * @throws InvalidArgumentException
     */
    public function testFunctionParameterViaPsalm(PHPFunction $function): void
    {
        $functionName = $function->name;

        if (in_array($functionName, $this->getIgnoredCalls(), true)) {
            static::assertTrue(true);

            return;
        }

        if (count($function->parameters) === 0) {
            static::assertTrue(true);

            return;
        }

        if (isset(self::$call_map_vimeo_psalm[$functionName])) {

            foreach ($function->parameters as $count => $parameter) {

                if (!$parameter->type_from_php_doc) {
                    static::markTestSkipped('TODO: parameter error in phpdoc: ' . $functionName . ' | parameter: ' . $parameter->name . ' | psalm: ' . print_r($parameter, true));

                    return;
                }

                if (!isset(self::$call_map_vimeo_psalm[$functionName][trim($parameter->name, '&=.')])) {
                    static::markTestSkipped('TODO: parameter error in psalm: ' . $functionName . ' | parameter: ' . $parameter->name . ' | psalm: ' . print_r(self::$call_map_vimeo_psalm[$functionName], true));

                    return;
                }

                $parameterTypeFromStaticAnalyseTool = ltrim(self::$call_map_vimeo_psalm[$functionName][trim($parameter->name, '&=.')], '\\');
                $parameterTypeFromStaticAnalyseTool = $this->getTypeFromStaticAnalyse($parameterTypeFromStaticAnalyseTool);

                $parameterTypeFromPhpDoc = $this->getTypeFromPhpElement($parameter->type_from_php_doc);

                if ($parameterTypeFromPhpDoc) {
                    static::assertEquals(
                        $parameterTypeFromStaticAnalyseTool,
                        $parameterTypeFromPhpDoc,
                        $functionName . ' - parameter -->' . $parameter->name . '<--: Failed asserting that (psalm-data) "' . print_r($parameterTypeFromStaticAnalyseTool, true) . '" == (phpdoc-data) "' . print_r($parameterTypeFromPhpDoc, true) . '" | ' . print_r($function->parameters, true)
                    );
                }

            }

            return;
        }

        static::markTestSkipped('TODO: no parameter data found in psalm: ' . $functionName);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubFunctionProvider
     * @param PHPFunction $function
     * @throws InvalidArgumentException
     */
    public function testFunctionReturnViaPsalm(PHPFunction $function): void
    {
        $functionName = $function->name;

        if (in_array($functionName, $this->getIgnoredCalls(), true)) {
            static::assertTrue(true);

            return;
        }

        if (!$function->type_from_php_doc) {
            static::markTestSkipped('TODO: no return data found in phpdoc: ' . $functionName . ' | ' . print_r($function, true));

            return;
        }

        if (isset(self::$call_map_vimeo_psalm[$functionName])) {

            $returnTypeFromPsalm = ltrim(self::$call_map_vimeo_psalm[$functionName][0], '\\');
            $returnTypeFromPsalm = $this->getTypeFromStaticAnalyse($returnTypeFromPsalm);

            $returnTypeFromPhpDoc = $this->getTypeFromPhpElement($function->type_from_php_doc);

            if ($returnTypeFromPhpDoc) {
                static::assertEquals(
                    $returnTypeFromPsalm,
                    $returnTypeFromPhpDoc,
                    $functionName . ': Failed asserting that (psalm-data) "' . print_r($returnTypeFromPsalm, true) . '" == (phpdoc-data) "' . print_r($returnTypeFromPhpDoc, true) . '"'
                );

                return;
            }

            static::markTestSkipped('TODO: ' . $functionName . ': return type is missing? | psalm-data: ' . print_r(self::$call_map_vimeo_psalm[$functionName], true) . ' | phpdoc-data: ' . print_r($function, true));

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

    private function convertPsalmTypeHelper(string $typeFromPsalm): string
    {
        // hack for "OCI-Lob" != "OCI_Lob"
        $typeFromPsalm = str_replace('OCI-', 'OCI_', $typeFromPsalm);

        // hack to convert e.g. "callable(Foo):void" into "callable"
        $typeFromPsalm = preg_replace('/\(.*\):.*/', '', $typeFromPsalm);

        if ($typeFromPsalm === '') {
            return 'mixed';
        }

        if ($typeFromPsalm === 'long') {
            return 'int';
        }

        if (
            $typeFromPsalm === 'class-string'
            ||
            $typeFromPsalm === 'callable-string'
            ||
            $typeFromPsalm === 'numeric-string'
            ||
            $typeFromPsalm === 'html-escaped-string'
        ) {
            return 'string';
        }

        if (preg_match('/array{.*}/', $typeFromPsalm)) {
            return 'array';
        }

        preg_match('/array<.*?,(?<type>.*)>/', $typeFromPsalm, $outputTmp);
        if ($outputTmp && count($outputTmp) > 0) {
            if (strpos($outputTmp['type'], 'array') !== false) {
                return 'array';
            }

            $typeTmp = trim($outputTmp['type']) . '[]';
            if ($typeTmp === 'mixed[]') {
                return 'array';
            }

            if (
                $typeTmp === 'class-string[]'
                ||
                $typeTmp === 'callable-string[]'
                ||
                $typeTmp === 'numeric-string[]'
                ||
                $typeTmp === 'html-escaped-string[]'
            ) {
                return 'string[]';
            }

            return $typeTmp;
        }

        preg_match('/\?(?<type>.*)/', $typeFromPsalm, $outputTmp);
        if ($outputTmp && count($outputTmp) > 0) {
            return $outputTmp['type'] . '|null';
        }

        return $typeFromPsalm;
    }

    private function getTypeFromStaticAnalyse(string $typeFromPsalmInput): array
    {
        preg_match_all('/(?:[^<|]|<[^>]*>)+/', $typeFromPsalmInput, $typeFromPsalm);
        $typeFromPsalm = $typeFromPsalm[0];
        foreach ($typeFromPsalm as &$typeTmp) {
            $typeTmp = $this->convertPsalmTypeHelper($typeTmp);
        }
        unset($typeTmp);
        /* the inner empty array covers cases when no loops were made */
        $typeFromPsalmInner = [];
        foreach ($typeFromPsalm as $key => &$typeTmp) {
            if (strpos($typeTmp, '|') !== false) {
                unset($typeFromPsalm[$key]);
                $typeFromPsalmInner[] = explode('|', $typeTmp);
            }
        }
        unset($typeTmp);

        /** @noinspection KeysFragmentationWithArrayFunctionsInspection */
        $typeFromPsalm = array_unique(array_merge($typeFromPsalm, ...$typeFromPsalmInner));
        sort($typeFromPsalm);

        return $typeFromPsalm;
    }

    private function getTypeFromPhpElement(string $typeFromPhpDoc): array
    {
        $typeFromPhpDoc = explode('|', ltrim($typeFromPhpDoc, '\\'));
        foreach ($typeFromPhpDoc as $key => &$typeFromPhpDocTmp) {
            $typeFromPhpDocTmp = ltrim($typeFromPhpDocTmp, '\\');

            if ($typeFromPhpDocTmp === '') {
                unset($typeFromPhpDoc[$key]);
            }
        }
        unset($typeFromPhpDocTmp);

        sort($typeFromPhpDoc);

        return $typeFromPhpDoc;
    }

    /**
     * @return array
     */
    private function getIgnoredCalls(): array
    {
        $ignoreErrors = [
            'SimpleXMLElement::asXML', // return type depends on parameter usage
            'abs', // return type depends on parameter usage
            'ceil', // "ceil() is still of type float as the value range of float is usually bigger than that of integer"?
            'setlocale', // return type depends on parameter usage
            'version_compare', // return type depends on parameter usage
            'microtime', // return type depends on parameter usage
            'getenv', // return type depends on parameter usage
            'fscanf', // return type depends on parameter usage
            'print_r', // return type depends on parameter usage
            'hrtime', // return type depends on parameter usage
            'gettimeofday', // return type depends on parameter usage
            'apc_store', // return type depends on parameter usage
            'apc_fetch', // return type depends on parameter usage
            'apc_delete', // return type depends on parameter usage
            'apc_add', // return type depends on parameter usage
            'apc_exists', // return type depends on parameter usage
            'apcu_store', // return type depends on parameter usage
            'apcu_fetch', // return type depends on parameter usage
            'apcu_delete', // return type depends on parameter usage
            'apcu_add', // return type depends on parameter usage
            'apcu_exists', // return type depends on parameter usage
            'wincache_ucache_add', // return type depends on parameter usage
            'wincache_ucache_set', // return type depends on parameter usage
        ];
        return $ignoreErrors;
    }
}
