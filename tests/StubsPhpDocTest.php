<?php
declare(strict_types=1);

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use StubTests\Model\BasePHPElement;
use StubTests\Model\PHPDocElement;
use StubTests\Model\Tags\RemovedTag;
use StubTests\Parsers\ParserUtils;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Stubs\StubConstantsProvider;
use StubTests\TestData\Providers\Stubs\StubMethodsProvider;
use StubTests\TestData\Providers\Stubs\StubsTestDataProviders;
use function trim;

class StubsPhpDocTest extends AbstractBaseStubsTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
    }

    #[DataProviderExternal(StubConstantsProvider::class, 'classConstantProvider')]
    public function testClassConstantsPHPDocs(?string $classHash, ?string $constantName): void
    {
        if (!$classHash && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getClassByHash($classHash);
        $constant = $class->getConstant($constantName, false);
        self::assertNull($constant->parseError, $constant->parseError ?: '');
        self::checkPHPDocCorrectness($constant, "constant $class->id::$constant->name");
    }

    #[DataProviderExternal(StubConstantsProvider::class, 'interfaceConstantProvider')]
    public function testInterfaceConstantsPHPDocs(string $classId, string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId, shouldSuitCurrentPhpVersion: false);
        $constant = $class->getConstant($constantName, false);
        self::assertNull($constant->parseError, $constant->parseError ?: '');
        self::checkPHPDocCorrectness($constant, "constant $classId::$constant->name");
    }

    #[DataProviderExternal(StubConstantsProvider::class, 'enumConstantProvider')]
    public function testEnumConstantsPHPDocs(?string $classId, ?string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId, shouldSuitCurrentPhpVersion: false);
        $constant = $class->getConstant($constantName, false);
        self::assertNull($constant->parseError, $constant->parseError ?: '');
        self::checkPHPDocCorrectness($constant, "constant $classId::$constant->name");
    }

    #[DataProviderExternal(StubConstantsProvider::class, 'globalConstantProvider')]
    public static function testConstantsPHPDocs(string $constantId): void
    {
        $constant = PhpStormStubsSingleton::getPhpStormStubs()->getConstant($constantId, shouldSuitCurrentPhpVersion: false);
        self::assertNull($constant->parseError, $constant->parseError ?: '');
        self::checkPHPDocCorrectness($constant, "constant $constant->name");
    }

    #[DataProviderExternal(StubsTestDataProviders::class, 'allFunctionsProvider')]
    public static function testFunctionPHPDocs(string $functionId): void
    {
        $function = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId, shouldSuitCurrentPhpVersion: false);
        self::assertNull($function->parseError, $function->parseError?->getMessage() ?: '');
        self::checkPHPDocCorrectness($function, "function $function->name");
    }

    #[DataProviderExternal(StubsTestDataProviders::class, 'allClassesProvider')]
    public static function testClassesPHPDocs(string $classId, string $sourceFilePath): void
    {
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId, sourceFilePath: $sourceFilePath, shouldSuitCurrentPhpVersion: false);
        self::assertNull($class->parseError, $class->parseError?->getMessage() ?: '');
        self::checkPHPDocCorrectness($class, "class $class->name");
    }

    #[DataProviderExternal(StubsTestDataProviders::class, 'allInterfacesProvider')]
    public static function testInterfacesPHPDocs(string $classId, string $sourceFilePath): void
    {
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId, sourceFilePath: $sourceFilePath, shouldSuitCurrentPhpVersion: false);
        self::assertNull($class->parseError, $class->parseError?->getMessage() ?: '');
        self::checkPHPDocCorrectness($class, "class $class->name");
    }

    #[DataProviderExternal(StubsTestDataProviders::class, 'allEnumsProvider')]
    public static function testEumsPHPDocs(string $classId, string $sourceFilePath): void
    {
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId, sourceFilePath: $sourceFilePath, shouldSuitCurrentPhpVersion: false);
        self::assertNull($class->parseError, $class->parseError?->getMessage() ?: '');
        self::checkPHPDocCorrectness($class, "class $class->name");
    }

    #[DataProviderExternal(StubMethodsProvider::class, 'allClassMethodsProvider')]
    public static function testClassMethodsPHPDocs(string $classHash, string $methodName): void
    {
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getClassByHash($classHash);
        $method = $class->getMethod($methodName, shouldSuitCurrentPhpVersion: false);
        if ($method->name === '__construct') {
            self::assertEmpty($method->returnTypesFromPhpDoc, '@return tag for __construct should be omitted');
        }
        self::assertNull($method->parseError, $method->parseError ?: '');
        self::checkPHPDocCorrectness($method, "method $method->name");
    }

    #[DataProviderExternal(StubMethodsProvider::class, 'allInterfaceMethodsProvider')]
    public static function testInterfaceMethodsPHPDocs(string $classId, string $methodName): void
    {
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId, shouldSuitCurrentPhpVersion: false);
        $method = $class->getMethod($methodName, shouldSuitCurrentPhpVersion: false);
        if ($method->name === '__construct') {
            self::assertEmpty($method->returnTypesFromPhpDoc, '@return tag for __construct should be omitted');
        }
        self::assertNull($method->parseError, $method->parseError ?: '');
        self::checkPHPDocCorrectness($method, "method $method->name");
    }

    #[DataProviderExternal(StubMethodsProvider::class, 'allEnumsMethodsProvider')]
    public static function testEnumMethodsPHPDocs(string $classId, string $methodName): void
    {
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId, shouldSuitCurrentPhpVersion: false);
        $method = $class->getMethod($methodName, shouldSuitCurrentPhpVersion: false);
        if ($method->name === '__construct') {
            self::assertEmpty($method->returnTypesFromPhpDoc, '@return tag for __construct should be omitted');
        }
        self::assertNull($method->parseError, $method->parseError ?: '');
        self::checkPHPDocCorrectness($method, "method $method->name");
    }

    //TODO IF: Add test to check that phpdocs contain only resource, object etc typehints or if contains type like Resource then Resource should be declared in stubs

    private static function checkDeprecatedRemovedSinceVersionsMajor(BasePHPElement $element, string $elementName): void
    {
        /** @var PHPDocElement $element */
        foreach ($element->sinceTags as $sinceTag) {
            if ($sinceTag instanceof Since) {
                $version = $sinceTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(ParserUtils::tagDoesNotHaveZeroPatchVersion($sinceTag), "$elementName has 
                    'since' version $version.'Since' version for PHP Core functionality for style consistency 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
        foreach ($element->deprecatedTags as $deprecatedTag) {
            if ($deprecatedTag instanceof Deprecated) {
                $version = $deprecatedTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(ParserUtils::tagDoesNotHaveZeroPatchVersion($deprecatedTag), "$elementName has 
                    'deprecated' version $version.'Deprecated' version for PHP Core functionality for style consistency 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
        foreach ($element->removedTags as $removedTag) {
            if ($removedTag instanceof RemovedTag) {
                $version = $removedTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(ParserUtils::tagDoesNotHaveZeroPatchVersion($removedTag), "$elementName has 
                    'removed' version $version.'Removed' version for PHP Core functionality for style consistency 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
    }

    private static function checkHtmlTags(BasePHPElement $element, string $elementName): void
    {
        /** @var PHPDocElement $element */
        $phpdoc = trim($element->phpdoc);

        $phpdoc = preg_replace(
            [
                '#<br\s*/>#',
                '#<br>#i',
                '#->#',
                '#=>#',
                '#"->"#',
                '# >= #',
                '#\(>=#',
                '#\'>\'#',
                '# > #',
                '#\?>#',
                '#`<.*>`#U',
                '#`.*<.*>`#U',
                '#<pre>.*</pre>#sU',
                '#<code>.*</code>#sU',
                '#@author.*<.*>#U',
                '#(\s[\w]+[-][\w]+<[a-zA-Z,\s]+>[\s|]+)|([\w]+<[a-zA-Z,|\s]+>[\s|\W]+)#'
            ],
            '',
            $phpdoc
        );

        $countTags = substr_count($phpdoc, '>');
        self::assertSame(
            0,
            $countTags % 2,
            "In $elementName phpdoc has a html error and the phpdoc maybe not displayed correctly in PhpStorm: " . print_r($phpdoc, true)
        );
    }

    private static function checkLinks(BasePHPElement $element, string $elementName): void
    {
        /** @var PHPDocElement $element */
        foreach ($element->links as $link) {
            if ($link instanceof Link) {
                self::assertStringStartsWith(
                    'https',
                    $link->getLink(),
                    "In $elementName @link doesn't start with https"
                );
                if (getenv('CHECK_LINKS') === 'true') {
                    if ($element->stubBelongsToCore) {
                        $request = curl_init($link->getLink());
                        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
                        curl_exec($request);
                        $response = curl_getinfo($request, CURLINFO_RESPONSE_CODE);
                        curl_close($request);
                        self::assertTrue($response < 400);
                    }
                }
            }
        }
        foreach ($element->see as $see) {
            if ($see instanceof See && $see->getReference() instanceof Url) {
                $uri = (string)$see->getReference();
                self::assertStringStartsWith('https', $uri, "In $elementName @see doesn't start with https");
            }
        }
    }

    private static function checkContainsOnlyValidTags(BasePHPElement $element, string $elementName): void
    {
        $VALID_TAGS = [
            'api',
            'author',
            'category',
            'copyright',
            'deprecated',
            'example',
            'extends',
            'filesource',
            'final',
            'global',
            'ignore',
            'internal',
            'inheritdoc',
            'inheritDoc',
            'implements',
            'license',
            'link',
            'meta',
            'method',
            'mixin',
            'package',
            'param',
            'property',
            'property-read',
            'property-write',
            'removed',
            'return',
            'see',
            'since',
            'source',
            'subpackage',
            'throws',
            'template',
            'template-implements', // https://github.com/JetBrains/phpstorm-stubs/pull/1212#issuecomment-907263735
            'template-extends',
            'template-covariant',
            'todo',
            'uses',
            'var',
            'version',
        ];
        /** @var PHPDocElement $element */
        foreach ($element->tagNames as $tagName) {
            self::assertContains($tagName, $VALID_TAGS, "Element $elementName has invalid tag: @$tagName");
        }
    }

    private static function checkPHPDocCorrectness(BasePHPElement $element, string $elementName): void
    {
        self::checkLinks($element, $elementName);
        //TODO: Fix tests and uncomment
        //self::checkHtmlTags($element, $elementName);
        if ($element->stubBelongsToCore) {
            self::checkDeprecatedRemovedSinceVersionsMajor($element, $elementName);
        }
        self::checkContainsOnlyValidTags($element, $elementName);
    }
}
