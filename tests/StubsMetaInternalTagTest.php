<?php

namespace StubTests;

use PHPUnit\Framework\TestCase;
use StubTests\Parsers\Visitors\MetaOverrideFunctionsParser;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsMetaInternalTagTest extends TestCase
{
    /**
     * @var array
     */
    private static array $overridenFunctionsInMeta;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$overridenFunctionsInMeta = (new MetaOverrideFunctionsParser())->overridenFunctions;
    }

    public function testFunctionInternalMetaTag(): void
    {
        $functions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        foreach ($functions as $function) {
            if ($function->hasInternalMetaTag) {
                $this->checkInternalMetaInOverride($function->name);
            }
        }
    }

    public function testMethodsInternalMetaTag(): void
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getClasses() as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                if ($method->hasInternalMetaTag) {
                    $this->checkInternalMetaInOverride($className . "::" . $methodName);
                } else {
                    $this->expectNotToPerformAssertions();
                }
            }
        }
    }

    /**
     * @param string $elementName
     */
    private function checkInternalMetaInOverride(string $elementName): void
    {
        self::assertContains($elementName, self::$overridenFunctionsInMeta,
            "$elementName contains @meta in phpdoc but isn't added to 'override()' functions in meta file");
    }
}
