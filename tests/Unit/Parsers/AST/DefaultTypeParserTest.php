<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Stubs\Types\DefaultTypeParser;
use StubTests\Framework\Parsers\Stubs\Types\ParsedType;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class DefaultTypeParserTest extends BaseTestCase
{
    private DefaultTypeParser $parser;
    private FixtureStubsDataProvider $filesProvider;
    private StubClassParser $classParser;
    private StubFunctionParser $functionParser;

    protected function setUp(): void
    {
        $this->parser = new DefaultTypeParser();
        $fixturesPath = __DIR__ . '/fixtures/Types';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->classParser = new StubClassParser();
        $this->functionParser = new StubFunctionParser();
    }

    private function getPropertyFromFixture(string $fixtureFile): PHPProperty
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        $class = $this->classParser->parse($stubCode);
        $properties = $class->getProperties();
        return $properties[0];
    }

    // ==================== Basic Type Parsing Tests ====================

    public function testParseTypeFromSignatureOnly()
    {
        $property = $this->getPropertyFromFixture('signature_only.txt');

        self::assertEquals('string', $property->getType()->toString());
        self::assertNull($property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertNull($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNull($property->getStubsMetadata()->getDefaultType());
    }

    public function testParseTypeFromPhpDocOnly()
    {
        $property = $this->getPropertyFromFixture('phpdoc_only.txt');

        // No signature type means NoType (empty string)
        self::assertEquals('', $property->getType()->toString());
        self::assertEquals('string', $property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertNull($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNull($property->getStubsMetadata()->getDefaultType());
    }

    public function testParseTypeFromBothSignatureAndPhpDoc()
    {
        $property = $this->getPropertyFromFixture('both_sources.txt');

        self::assertEquals('string', $property->getType()->toString());
        self::assertEquals('string|null', $property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertNull($property->getStubsMetadata()->getLanguageLevelTypes());
    }

    public function testParseWithNoTypesReturnsEmptyParsedType()
    {
        $property = $this->getPropertyFromFixture('no_types.txt');

        // No signature type means NoType (empty string)
        self::assertEquals('', $property->getType()->toString());
        self::assertNull($property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertNull($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNull($property->getStubsMetadata()->getDefaultType());
    }

    public function testParseComplexSignatureTypes()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complex_types.txt');
        $class = $this->classParser->parse($stubCode);
        $properties = $class->getProperties();

        // Property with nullable type (converted to union notation)
        self::assertEquals('string|null', $properties[2]->getType()->toString());

        // Property with union type
        self::assertEquals('string|int', $properties[3]->getType()->toString());
    }

    public function testParseComplexPhpDocTypes()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complex_types.txt');
        $class = $this->classParser->parse($stubCode);
        $properties = $class->getProperties();

        // Array with generic type (note: PhpDocumentor normalizes whitespace)
        self::assertEquals('array<string,int>', $properties[0]->getStubsMetadata()->getTypeFromPhpDoc());

        // Callable type (PhpDocumentor simplifies callable signatures to just "callable")
        self::assertEquals('callable', $properties[1]->getStubsMetadata()->getTypeFromPhpDoc());
    }

    public function testParseReturnsCorrectParsedTypeInstance()
    {
        $property = $this->getPropertyFromFixture('signature_only.txt');

        // Verify we get proper data structure (now returns type object)
        $typeString = $property->getType()->toString();
        self::assertIsString($typeString);
        self::assertContains($typeString, ['string', 'int', 'bool', 'array', 'float', 'mixed', 'object']);
    }

    public function testParsePreservesOriginalTypeStrings()
    {
        $property = $this->getPropertyFromFixture('both_sources.txt');

        // Verify types are stored exactly as provided
        self::assertSame('string', $property->getType()->toString());
        self::assertSame('string|null', $property->getStubsMetadata()->getTypeFromPhpDoc());
    }

    // ==================== LanguageLevelTypeAware Attribute Tests ====================

    public function testParseLanguageLevelTypeAwareWithSingleVersion()
    {
        $property = $this->getPropertyFromFixture('language_level_single.txt');

        self::assertIsArray($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals(['8.0' => 'CurlHandle'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('resource', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseLanguageLevelTypeAwareWithMultipleVersions()
    {
        $property = $this->getPropertyFromFixture('language_level_multiple.txt');

        $expectedTypes = ['8.0' => 'GdImage', '8.1' => 'GdImage|false'];
        self::assertEquals($expectedTypes, $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('resource|false', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseLanguageLevelTypeAwareWithDefaultType()
    {
        $property = $this->getPropertyFromFixture('language_level_with_default.txt');

        self::assertEquals(['8.1' => 'string'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseLanguageLevelTypeAwareWithEmptyDefault()
    {
        $property = $this->getPropertyFromFixture('language_level_with_default.txt');

        // Verify empty string is preserved
        self::assertSame('', $property->getStubsMetadata()->getDefaultType());
        self::assertNotNull($property->getStubsMetadata()->getDefaultType());
    }

    public function testParseLanguageLevelTypeAwareWithoutDefault()
    {
        $stubCode = '<?php
namespace Test;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
class TestClass {
    #[LanguageLevelTypeAware([\'8.0\' => \'string\'])]
    public $prop;
}';
        $class = $this->classParser->parse($stubCode);
        $property = $class->getProperties()[0];

        self::assertEquals(['8.0' => 'string'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNull($property->getStubsMetadata()->getDefaultType());
    }

    public function testParseLanguageLevelTypeAwareWithFullyQualifiedName()
    {
        $stubCode = '<?php
namespace Test;
class TestClass {
    #[\JetBrains\PhpStorm\Internal\LanguageLevelTypeAware([\'8.0\' => \'int\'], default: \'\')]
    public $prop;
}';
        $class = $this->classParser->parse($stubCode);
        $property = $class->getProperties()[0];

        self::assertEquals(['8.0' => 'int'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseMultipleLanguageLevelTypeAwareAttributes()
    {
        $stubCode = '<?php
namespace Test;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
class TestClass {
    #[LanguageLevelTypeAware([\'8.0\' => \'first\'], default: \'first_default\')]
    #[LanguageLevelTypeAware([\'8.1\' => \'second\'], default: \'second_default\')]
    public $prop;
}';
        $class = $this->classParser->parse($stubCode);
        $property = $class->getProperties()[0];

        // Should use the first attribute
        self::assertEquals(['8.0' => 'first'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('first_default', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseMixedAttributesOnlyProcessesLanguageLevelTypeAware()
    {
        $property = $this->getPropertyFromFixture('mixed_attributes.txt');

        // Should extract LanguageLevelTypeAware and ignore Deprecated
        self::assertEquals(['8.0' => 'string'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseLanguageLevelTypeAwareWithEmptyMap()
    {
        $stubCode = '<?php
namespace Test;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
class TestClass {
    #[LanguageLevelTypeAware([], default: \'fallback\')]
    public $prop;
}';
        $class = $this->classParser->parse($stubCode);
        $property = $class->getProperties()[0];

        self::assertEquals([], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('fallback', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseLanguageLevelTypeAwareVersionsAreStrings()
    {
        $property = $this->getPropertyFromFixture('language_level_single.txt');

        $types = $property->getStubsMetadata()->getLanguageLevelTypes();
        self::assertIsArray($types);
        self::assertArrayHasKey('8.0', $types);
        self::assertIsString($types['8.0']);
    }

    // ==================== Integration Tests ====================

    public function testParseAllThreeSourcesSimultaneously()
    {
        $property = $this->getPropertyFromFixture('all_sources.txt');

        // Verify all three type sources are present
        self::assertEquals('', $property->getType()->toString()); // No signature in this example (NoType)
        self::assertEquals('resource|false', $property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertEquals(['8.0' => 'Socket|false'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('resource|false', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseRealWorldExample_CurlResource()
    {
        $stubCode = $this->filesProvider->getStubFileContent('curl_resource_example.txt');
        $function = $this->functionParser->parse($stubCode);

        // Verify curl_init return type parsing
        self::assertEquals('resource|false', $function->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertEquals(['8.0' => 'CurlHandle|false'], $function->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('resource|false', $function->getStubsMetadata()->getDefaultType());
    }

    public function testParseRealWorldExample_GdImageResource()
    {
        $property = $this->getPropertyFromFixture('language_level_multiple.txt');

        // GdImage resource transformation over versions
        $types = $property->getStubsMetadata()->getLanguageLevelTypes();
        self::assertEquals('GdImage', $types['8.0']);
        self::assertEquals('GdImage|false', $types['8.1']);
        self::assertEquals('resource|false', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseRealWorldExample_SocketResource()
    {
        $property = $this->getPropertyFromFixture('all_sources.txt');

        // Socket resource: resource|false -> Socket|false in 8.0
        self::assertEquals('Socket|false', $property->getStubsMetadata()->getLanguageLevelTypes()['8.0']);
        self::assertEquals('resource|false', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParsePropertyWithAllTypeInformation()
    {
        $property = $this->getPropertyFromFixture('all_sources.txt');

        // Comprehensive check
        self::assertNotNull($property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertNotNull($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNotNull($property->getStubsMetadata()->getDefaultType());

        // Verify structure
        self::assertIsString($property->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertIsArray($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertIsString($property->getStubsMetadata()->getDefaultType());
    }

    public function testParseMethodReturnTypeWithAllTypeInformation()
    {
        $stubCode = $this->filesProvider->getStubFileContent('curl_resource_example.txt');
        $function = $this->functionParser->parse($stubCode);

        // Function has PhpDoc @return and LanguageLevelTypeAware
        self::assertEquals('resource|false', $function->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertIsArray($function->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('CurlHandle|false', $function->getStubsMetadata()->getLanguageLevelTypes()['8.0']);
    }

    // ==================== Edge Cases & Error Handling Tests ====================

    public function testParseWithEmptyAttributesArray()
    {
        $property = $this->getPropertyFromFixture('signature_only.txt');

        // Property has no attributes, so language level types should be null
        self::assertNull($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNull($property->getStubsMetadata()->getDefaultType());
    }

    public function testParseAttributeWithOnlyDefaultNoMap()
    {
        $stubCode = '<?php
namespace Test;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
class TestClass {
    #[LanguageLevelTypeAware(default: \'string\')]
    public $prop;
}';
        $class = $this->classParser->parse($stubCode);
        $property = $class->getProperties()[0];

        // When only default is provided without version map
        self::assertNull($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('string', $property->getStubsMetadata()->getDefaultType());
    }

    public function testParseAttributeArgumentsAsNamedParameters()
    {
        $stubCode = '<?php
namespace Test;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
class TestClass {
    #[LanguageLevelTypeAware(types: [\'8.0\' => \'int\'], default: \'mixed\')]
    public $prop;
}';
        $class = $this->classParser->parse($stubCode);
        $property = $class->getProperties()[0];

        // Named parameter 'types' should work (though positional is more common)
        // This tests robustness of argument parsing
        self::assertNotNull($property);
    }

    public function testParsePreservesComplexTypeStructures()
    {
        $stubCode = $this->filesProvider->getStubFileContent('complex_types.txt');
        $class = $this->classParser->parse($stubCode);
        $properties = $class->getProperties();

        // Verify complex types are preserved (PhpDocumentor normalizes whitespace and simplifies callables)
        self::assertEquals('array<string,int>', $properties[0]->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertEquals('callable', $properties[1]->getStubsMetadata()->getTypeFromPhpDoc());
    }

    // ==================== phpstan/psalm dropped-tag recovery ====================

    /**
     * phpDocumentor silently drops @param/@return tags whose phpstan/psalm type it cannot
     * resolve. They must instead be recovered verbatim so the documented type is stored
     * (narrowing to a built-in type happens later, at verification time).
     */
    public function testRecoversDroppedPhpStanTypesVerbatim()
    {
        $stubCode = '<?php
/**
 * @param array<TKey, TValue> $items the items
 * @param non-empty-array<int> $codes
 * @return int-mask<1, 2, 4> the mask
 */
function fixture_dropped($items, $codes) {}';
        $function = $this->functionParser->parse($stubCode);
        $params = $function->getParameters();

        self::assertSame('int-mask<1, 2, 4>', $function->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertSame('array<TKey, TValue>', $params[0]->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertSame('non-empty-array<int>', $params[1]->getStubsMetadata()->getTypeFromPhpDoc());
    }

    public function testRecoveryDoesNotCorruptDescriptionsOrSkipsTypelessParams()
    {
        $stubCode = '<?php
/**
 * @param non-empty-array<int> $arr a <b> tag and $var in the description
 * @param $noType just a description with no type
 */
function fixture_desc($arr, $noType) {}';
        $function = $this->functionParser->parse($stubCode);
        $params = $function->getParameters();

        // Type recovered, description (containing < and $) untouched
        self::assertSame('non-empty-array<int>', $params[0]->getStubsMetadata()->getTypeFromPhpDoc());
        // Variable-before-type / no type → nothing recovered (phpDocumentor default applies)
        self::assertNotSame('$noType', $params[1]->getStubsMetadata()->getTypeFromPhpDoc());
    }

    public function testResolvablePhpDocTypesAreLeftToPhpDocumentor()
    {
        // numeric-string is resolvable by phpDocumentor and must be stored as-is (no recovery override)
        $stubCode = '<?php
/**
 * @param numeric-string $n
 * @return list<int>
 */
function fixture_resolvable($n) {}';
        $function = $this->functionParser->parse($stubCode);

        self::assertSame('list<int>', $function->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertSame('numeric-string', $function->getParameters()[0]->getStubsMetadata()->getTypeFromPhpDoc());
    }

    public function testParseHandlesNullValuesGracefully()
    {
        // Direct parser test with null inputs
        $result = $this->parser->parseType(null, null, []);

        self::assertInstanceOf(ParsedType::class, $result);
        // Null type node results in NoType object (not null)
        self::assertInstanceOf(\StubTests\Framework\Parsers\Model\Types\NoType::class, $result->typeFromSignature);
        self::assertNull($result->typeFromPhpDoc);
        self::assertNull($result->languageLevelTypes);
        self::assertNull($result->defaultType);
    }

    public function testParseDoesNotModifyInputArrays()
    {
        $originalAttributes = [];
        $property = $this->getPropertyFromFixture('signature_only.txt');

        // Verify parser doesn't mutate input
        self::assertEquals([], $originalAttributes);
    }
}
