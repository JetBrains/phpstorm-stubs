<?php
declare(strict_types=1);

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use PHPUnit\Framework\TestCase;
use StubTests\Model\BasePHPClass;
use StubTests\Model\BasePHPElement;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPDocElement;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPMethod;
use StubTests\Model\Tags\RemovedTag;
use StubTests\Parsers\Utils;
use function trim;

class StubsPhpDocTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubConstantsProvider::classConstantProvider
     */
    public function testClassConstantsPHPDocs(string $className, PHPConst $constant): void
    {
        self::assertNull($constant->parseError, $constant->parseError ?: '');
        self::checkPHPDocCorrectness($constant, "constant $className::$constant->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubConstantsProvider::globalConstantProvider
     */
    public function testConstantsPHPDocs(PHPConst $constant): void
    {
        self::assertNull($constant->parseError, $constant->parseError ?: '');
        self::checkPHPDocCorrectness($constant, "constant $constant->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsTestDataProviders::allFunctionsProvider
     */
    public function testFunctionPHPDocs(PHPFunction $function): void
    {
        self::assertNull($function->parseError, $function->parseError ?: '');
        self::checkPHPDocCorrectness($function, "function $function->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsTestDataProviders::allClassesProvider
     */
    public function testClassesPHPDocs(BasePHPClass $class): void
    {
        self::assertNull($class->parseError, $class->parseError ?: '');
        self::checkPHPDocCorrectness($class, "class $class->name");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::allMethodsProvider
     */
    public function testMethodsPHPDocs(string $methodName, PHPMethod $method): void
    {
        if ($methodName === '__construct') {
            self::assertNull($method->returnTag, '@return tag for __construct should be omitted');
        }
        self::assertNull($method->parseError, $method->parseError ?: '');
        self::checkPHPDocCorrectness($method, "method $methodName");
    }

    private static function checkDeprecatedRemovedSinceVersionsMajor(BasePHPElement $element, string $elementName): void
    {
        /** @var PHPDocElement $element */
        foreach ($element->sinceTags as $sinceTag) {
            if ($sinceTag instanceof Since) {
                $version = $sinceTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::tagDoesNotHaveZeroPatchVersion($sinceTag), "$elementName has 
                    'since' version $version.'Since' version for PHP Core functionality for style consistency 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
        foreach ($element->deprecatedTags as $deprecatedTag) {
            if ($deprecatedTag instanceof Deprecated) {
                $version = $deprecatedTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::tagDoesNotHaveZeroPatchVersion($deprecatedTag), "$elementName has 
                    'deprecated' version $version.'Deprecated' version for PHP Core functionality for style consistency 
                    should have X.X format for the case when patch version is '0'.");
                }
            }
        }
        foreach ($element->removedTags as $removedTag) {
            if ($removedTag instanceof RemovedTag) {
                $version = $removedTag->getVersion();
                if ($version !== null) {
                    self::assertTrue(Utils::tagDoesNotHaveZeroPatchVersion($removedTag), "$elementName has 
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
                '#<br ?/>#',
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
                '#@author.*<.*>#U'
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
            self::assertContains($tagName, $VALID_TAGS, "Element $elementName has invalid tag: @$tagName");
        }
    }

    private static function checkPHPDocCorrectness(BasePHPElement $element, string $elementName): void
    {
        self::checkLinks($element, $elementName);
        self::checkHtmlTags($element, $elementName);
        if ($element->stubBelongsToCore) {
            self::checkDeprecatedRemovedSinceVersionsMajor($element, $elementName);
        }
        self::checkContainsOnlyValidTags($element, $elementName);
    }
}
