<?php

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use phpDocumentor\Reflection\Types\Compound;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Comment\Doc;
use PHPUnit\Framework\TestCase;
use SQLite3;
use StubTests\Model\BasePHPClass;
use StubTests\Model\BasePHPElement;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPDocElement;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\Model\Tags\RemovedTag;
use StubTests\Parsers\DocFactoryProvider;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use function array_filter;
use function preg_replace;

class StubsTest extends TestCase
{
    const ID_PATTERN = "[A-Za-z0-9_]+";
    private static SQLite3 $SQLite3;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$SQLite3 = new SQLite3(__DIR__ . "/ide-sqlite.sqlite");
        echo "current dir:" .dirname(__FILE__);
    }
    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::constantProvider
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
            if ($phpstormFunction->stubBelongsToCore) {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH)){
                        self::assertNotEmpty(array_filter($phpstormFunction->parameters,
                            fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name),
                            "Function ${functionName} has signature $functionName(" . $this->printParameters($function->parameters) . ')' .
                            "but stub function has signature $functionName(" . $this->printParameters($phpstormFunction->parameters) . ")");
                    }
                }
            }
        }
    }

    private function printParameters(array $params): string
    {
        $signature = '';
        foreach ($params as $param) {
            $signature .= '$' . $param->name . ', ';
        }
        return trim($signature, ", ");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::classProvider
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
        foreach ($class->properties as $property) {
            $propertyName = $property->name;
            if ($property->access === "private") {
                continue;
            }
            if (!$property->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $propertyName,
                    $stubClass->properties,
                    "Missing property $className::$property->access $property->type $$propertyName"
                );
                $stubProperty = $stubClass->properties[$propertyName];
                if (!$property->hasMutedProblem(StubProblemType::PROPERTY_IS_STATIC)) {
                    static::assertEquals(
                        $property->is_static,
                        $stubProperty->is_static,
                        "Property $className::$propertyName static modifier is incorrect"
                    );
                }
                if (!$property->hasMutedProblem(StubProblemType::PROPERTY_ACCESS)) {
                    static::assertEquals(
                        $property->access,
                        $stubProperty->access,
                        "Property $className::$propertyName access modifier is incorrect"
                    );
                }
                if (!$property->hasMutedProblem(StubProblemType::PROPERTY_TYPE)
                    && !empty($property->type)) {
                    static::assertEquals(
                        $property->type,
                        $stubProperty->type,
                        "Property type doesn't match for property $className::$propertyName"
                    );
                }
            }
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::interfaceProvider
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
     */
    public function testClassConstantsPHPDocs(string $className, PHPConst $constant): void
    {
        static::assertNull($constant->parseError, $constant->parseError ?: '');
        $this->checkPHPDocCorrectness($constant, "constant $className::$constant->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::coreStubMethodProvider
     */
    public function testCoreMethodsTypeHints(string $methodName, PHPMethod $stubFunction): void
    {
        $firstSinceVersion = 5;
        if (!empty($stubFunction->sinceTags)) {
            $sinceVersions = array_map(fn(Since $tag) => (int)$tag->getVersion(), $stubFunction->sinceTags);
            sort($sinceVersions, SORT_DESC);
            $firstSinceVersion = array_pop($sinceVersions);
        } elseif ($stubFunction->hasInheritDocTag) {
            self::markTestSkipped("Function '$methodName' contains inheritdoc.");
        } elseif ($stubFunction->parentName === "___PHPSTORM_HELPERS\object") {
            self::markTestSkipped("Function '$methodName' is declared in ___PHPSTORM_HELPERS\object.");
        } elseif ($stubFunction->name === "__construct") {
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($stubFunction->parentName);
            if (!empty($parentClass->sinceTags)) {
                $sinceVersions = array_map(fn(Since $tag) => (int)$tag->getVersion(), $parentClass->sinceTags);
                sort($sinceVersions, SORT_DESC);
                $firstSinceVersion = array_pop($sinceVersions);
            }
        }
        self::checkFunctionDoesNotHaveScalarTypeHints($firstSinceVersion, $stubFunction);
        self::checkFunctionDoesNotHaveReturnTypeHints($firstSinceVersion, $stubFunction);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubConstantProvider
     */
    public function testConstantsPHPDocs(PHPConst $constant): void
    {
        static::assertNull($constant->parseError, $constant->parseError ?: '');
        $this->checkPHPDocCorrectness($constant, "constant $constant->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubFunctionProvider
     */
    public function testFunctionPHPDocs(PHPFunction $function): void
    {
        static::assertNull($function->parseError, $function->parseError ?: '');
        $this->compareWithOfficialDocs($function);
        $this->checkPHPDocCorrectness($function, "function $function->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubClassProvider
     */
    public function testClassesPHPDocs(BasePHPClass $class): void
    {
        static::assertNull($class->parseError, $class->parseError ?: '');
        $this->checkPHPDocCorrectness($class, "class $class->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubMethodProvider
     */
    public function testMethodsPHPDocs(string $methodName, PHPMethod $method): void
    {
        if ($methodName === '__construct') {
            static::assertNull($method->returnTag, '@return tag for __construct should be omitted');
        }
        static::assertNull($method->parseError, $method->parseError ?: '');
        $this->compareWithOfficialDocs($method);
        $this->checkPHPDocCorrectness($method, "method $methodName");
    }

    private function checkPHPDocCorrectness(BasePHPElement $element, string $elementName): void
    {
        $this->checkLinks($element, $elementName);
        if ($element->stubBelongsToCore) {
            $this->checkDeprecatedRemovedSinceVersionsMajor($element, $elementName);
        }
        $this->checkContainsOnlyValidTags($element, $elementName);
    }

    private function checkContainsOnlyValidTags(BasePHPElement $element, string $elementName): void
    {
        $VALID_TAGS = [
            'author',
            'copyright',
            'deprecated',
            'example', //temporary addition due to the number of existing cases
            'inheritdoc',
            'internal',
            'link',
            'meta',
            'method',
            'mixin',
            'package',
            'param',
            'property',
            'property-read',
            'removed',
            'return',
            'see',
            'since',
            'throws',
            'uses',
            'var',
            'version',
        ];
        /** @var PHPDocElement $element */
        foreach ($element->tagNames as $tagName) {
            static::assertContains($tagName, $VALID_TAGS, "Element $elementName has invalid tag: @$tagName");
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

    private function checkLinks(BasePHPElement $element, string $elementName): void
    {
        /** @var PHPDocElement $element */
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

    private function checkDeprecatedRemovedSinceVersionsMajor(BasePHPElement $element, $elementName): void
    {
        /** @var PHPDocElement $element */
        foreach ($element->sinceTags as $sinceTag) {
            if ($sinceTag instanceof Since) {
                $version = $sinceTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::tagDoesNotHaveZeroPatchVersion($sinceTag), "$elementName has 
                    'since' version $version.'Since' version for PHP Core functionallity for style consistensy 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
        foreach ($element->deprecatedTags as $deprecatedTag) {
            if ($deprecatedTag instanceof Deprecated) {
                $version = $deprecatedTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::tagDoesNotHaveZeroPatchVersion($deprecatedTag), "$elementName has 
                    'deprecated' version $version.'Deprecated' version for PHP Core functionallity for style consistensy 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
        foreach ($element->removedTags as $removedTag) {
            if ($removedTag instanceof RemovedTag) {
                $version = $removedTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::tagDoesNotHaveZeroPatchVersion($removedTag), "$elementName has 
                    'removed' version $version.'Removed' version for PHP Core functionallity for style consistensy 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
    }

    private static function checkFunctionDoesNotHaveScalarTypeHints(int $sinceVersion, PHPFunction $function)
    {
        if ($sinceVersion < 7) {
            if (empty($function->parameters)) {
                self::assertTrue(true, 'Parameters list empty');
            } else {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT)) {
                        self::assertFalse($parameter->type === 'int' || $parameter->type === 'float' ||
                            $parameter->type === 'string' || $parameter->type === 'bool',
                            "Function '{$function->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with typehint '{$parameter->type}' but typehints available only since php 7");
                    } else {
                        self::markTestSkipped("Skipped");
                    }
                }
            }
        } else {
            self::assertTrue(true, "Function '{$function->name}' has since version > 7");
        }
    }

    private static function checkFunctionDoesNotHaveReturnTypeHints(int $sinceVersion, PHPFunction $function)
    {
        $returnTypeHint = $function->returnType === null ? $function->returnType : $function->returnType->getType();
        if ($sinceVersion < 7) {
            if (!$function->hasMutedProblem(StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT)) {
                self::assertNull($returnTypeHint, "Function '$function->name' has since version '$sinceVersion'
            but has return typehint '$returnTypeHint' that supported only since PHP 7. Please declare return type via PhpDoc");
            } else {
                self::markTestSkipped("Skipped");
            }
        } else {
            self::assertTrue(true, "Function '{$function->name}' has since version > 7");
        }
    }

    private function compareWithOfficialDocs(PHPFunction $function)
    {
        $doc = $function->doc;
        $function_name = $function instanceof PHPMethod ? $function->parentName . "." . $function->name : $function->name;
        if ($doc !== null) {
            $this->validateParameters($function, $doc, $function_name);
        }
        //$this->validateReturnType($function_name, $function);
        //$docBlockSummary = $doc != null ? DocFactoryProvider::getDocFactory()->create($doc->getText())->getSummary() : "";
        //$this->checkSummary($functionsData, $docBlockSummary, $function_name);
    }

    private function normalizeSummary(string $summary)
    {
        $summary = preg_replace('/\s+/', ' ', $summary);
        $summary = preg_replace('/\\n/', '', $summary);

        // $summary = preg_replace("/\&Alias;/", "alias", $summary);
        $summary = preg_replace("/{@see (" . self::ID_PATTERN . ")}/", "$1", $summary);
        $summary = str_replace(".", '', $summary);
        $summary = preg_replace('/<b>/', '', $summary);
        $summary = preg_replace('/<\/b>/', '', $summary);
        $summary = preg_replace('/<i>/', '', $summary);
        $summary = preg_replace('/<\/i>/', '', $summary);

        //TODO REWRITE THIS
        if (strpos($summary, "(PECL") !== false || strpos($summary, "(PHP ") !== false) {
            $strpos = max(strpos($summary, "\n"), strpos($summary, "<br>") + 4, strpos($summary, "</br>") + 5, strpos($summary, "<br/>") + 5);
            $summary = substr($summary, $strpos);
        }
        return strtolower(trim($summary));
    }

    /**
     * @param Doc|null $doc
     * @param string $function_name
     */
    private function validateParameters(PHPFunction $function, ?Doc $doc, string $function_name): void
    {
        if ($function_name === "parallel\Sync.__construct") {

            var_dump($function->mutedProblems);
        }
        if ($function->hasMutedProblem(StubProblemType::PARAMETER_TYPE_IS_WRONG_IN_OFICIAL_DOCS)) {
            static::markTestSkipped('function is excluded');
        }
        $docBlock = DocFactoryProvider::getDocFactory()->create($doc->getText());
        $tags = $docBlock->getTagsByName("param");
        foreach ($tags as $parameter) {
            $paramsDataFromDocs = self::$SQLite3->query("select * from params where function_name = '$function_name' and name = '{$parameter->getVariableName()}' ")->fetchArray();
            if ($paramsDataFromDocs !== false) {
                $normalizedDocType = $this->normalizeType($paramsDataFromDocs["type"]);
                if ($normalizedDocType === "mixed") {
                    self::markTestSkipped("Skipped for function '$function_name' parameter name '\${$parameter->getVariableName()}'");
                } else {
                    $noramlizedTypeFromStubs = $this->normalizeType($this->filterNull($parameter) . "");
                    foreach (explode("|", $normalizedDocType) as $docType) {
                        if ($docType === 'array') {
                            self::assertTrue(str_contains($noramlizedTypeFromStubs, "[]") || str_contains($noramlizedTypeFromStubs, "array"), "no $docType found in type: '$noramlizedTypeFromStubs' parameterName: \${$parameter->getVariableName()}");
                        } else {
                            self::assertTrue($this->hasType($docType, $noramlizedTypeFromStubs), "parameter: $" . $parameter->getVariableName() . "\nfunction name: $function_name doctype:$docType stubstype: $noramlizedTypeFromStubs");
                        }
                    }
                }
            }
        }
    }

    /**
     * @param Tag $parameter
     * @return mixed
     */
    private function filterNull(Tag $parameter)
    {
        $types = $parameter->getType();
        if ($types instanceof Compound) {
            $types = new Compound(array_filter($types->getIterator()->getArrayCopy(), function ($a) {
                return !$a instanceof Null_;
            }));
        }
        return $types;
    }

    /**
     * @param string $parameterType
     * @return string
     */
    private function normalizeType(string $parameterType): string
    {
        $strtolower = strtolower(trim($parameterType));
        $types = explode("|", $strtolower);
        $types = $this->trunkNamespaces($types);
        return implode("|", $types);;
    }

    /**
     * @param mixed $functionsData
     * @param string $docBlockSummary
     * @param string|null $function_name
     */
    private function checkSummary(mixed $functionsData, string $docBlockSummary, ?string $function_name): void
    {
        $summaryFromOfficialDocs = $functionsData === false ? "" : $functionsData["purpose"];
        $stubs = $this->normalizeSummary($docBlockSummary);
        if ($summaryFromOfficialDocs !== '') {
            $officialSummary = $this->normalizeSummary($summaryFromOfficialDocs);
            if ($officialSummary !== "description") {

                self::assertEquals($officialSummary, $stubs, "function $function_name");
            }
        }
    }

    /**
     * @param mixed $type
     */
    private function trunkNameSpace(mixed $type): string
    {
        $explode = explode("\\", $type);
        return $explode[sizeof($explode) - 1];
    }

    /**
     * @param array|bool $types
     */
    private function trunkNamespaces(array|bool $types): array
    {
        $newTypes = [];
        foreach ($types as $type) {
            $newTypes[] = $this->trunkNameSpace($type);
        }
        return $newTypes;
    }

    /**
     * @param string|null $function_name
     * @param PHPFunction $function
     */
    private function validateReturnType(?string $function_name, PHPFunction $function): void
    {
        $functionsData = self::$SQLite3->query("select * from functions where name = '$function_name'")->fetchArray();
        if ($functionsData !== false) {
            if ($function->hasMutedProblem(StubProblemType::RETURN_TYPE_IS_WRONG_IN_OFICIAL_DOCS)) {
                static::markTestSkipped('function is excluded');
            }
            if ($functionsData !== null) {
                // echo "return type for " . $function_name . " is not found in official docs";
                self::assertEquals($functionsData["return_type"], $function->returnTag . "", "return type mismatch '$function_name'");
            }
        }
    }

    /**
     * @param mixed $docType
     * @param string $noramlizedTypeFromStubs
     * @return bool
     */
    private function hasType(mixed $docType, string $noramlizedTypeFromStubs): bool
    {
        $types = explode("|", $noramlizedTypeFromStubs);
        foreach ($types as $type) {
            if ($this->typesAreEqual($type, $docType)) {
                return true;
            }
        }
        return false;

    }

    /**
     * @param mixed $type
     * @param mixed $docType
     * @return bool
     */
    private function typesAreEqual(mixed $type, mixed $docType): bool
    {
        if ($this->isInteger($docType) && $this->isInteger($type)) {
            return true;
        }
        if ($this->isBoolean($docType) && $this->isBoolean($type)) {
            return true;
        }
        if( $this->isFloat($docType) && $this->isFloat($type)) {
            return true;
        }
        if( $this->isCallable($docType) && $type == "callable") {
            return true;
        }
        return $type === $docType;
    }

    /**
     * @param mixed $docType
     * @return bool
     */
    private function isBoolean(mixed $docType): bool
    {
        return ($docType === "bool" || $docType === "boolean");
    }

    /**
     * @param mixed $docType
     * @return bool
     */
    private function isFloat(mixed $docType): bool
    {
        return ($docType === "float" || $docType === "double");
    }

    private function isInteger(mixed $docType)
    {
        return ($docType === "int" || $docType === "integer");
    }

    private function isCallable(mixed $docType)
    {
        return ($docType === "call" || $docType === "callable" || $docType === "callback");
    }

}
