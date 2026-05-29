<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Unit\Parsers\AST\fixtures\FixtureStubsDataProvider;

class StubPropertyParserTest extends BaseTestCase
{
    private FixtureStubsDataProvider $filesProvider;
    private StubClassParser $classParser;

    protected function setUp(): void
    {
        $fixturesPath = __DIR__ . '/fixtures/Properties';
        $this->filesProvider = new FixtureStubsDataProvider($fixturesPath);
        $this->classParser = new StubClassParser();
    }

    private function getPropertiesFromClass(string $fixtureFile): array
    {
        $stubCode = $this->filesProvider->getStubFileContent($fixtureFile);
        $class = $this->classParser->parse($stubCode);
        return $class->getProperties();
    }

    public function testItReturnsCorrectInstance()
    {
        $properties = $this->getPropertiesFromClass('simple_property.txt');
        self::assertInstanceOf(PHPProperty::class, $properties[0]);
    }

    public function testItCanParsePropertyName()
    {
        $properties = $this->getPropertiesFromClass('simple_property.txt');
        self::assertEquals('simpleProperty', $properties[0]->getName());
    }

    public function testItCanParsePublicVisibility()
    {
        $properties = $this->getPropertiesFromClass('visibility_properties.txt');
        $publicProperty = $properties[0];
        self::assertEquals('public', $publicProperty->getAccess()->value);
    }

    public function testItCanParseProtectedVisibility()
    {
        $properties = $this->getPropertiesFromClass('visibility_properties.txt');
        $protectedProperty = $properties[1];
        self::assertEquals('protected', $protectedProperty->getAccess()->value);
    }

    public function testItCanParsePrivateVisibility()
    {
        $properties = $this->getPropertiesFromClass('visibility_properties.txt');
        $privateProperty = $properties[2];
        self::assertEquals('private', $privateProperty->getAccess()->value);
    }

    public function testItCanParseStaticModifier()
    {
        $properties = $this->getPropertiesFromClass('complete_property.txt');
        $staticProperty = $properties[1]; // protectedStaticProperty
        self::assertTrue($staticProperty->isStatic());
    }

    public function testItParsesNonStaticByDefault()
    {
        $properties = $this->getPropertiesFromClass('simple_property.txt');
        self::assertFalse($properties[0]->isStatic());
    }

    public function testItCanParseReadonlyModifier()
    {
        $properties = $this->getPropertiesFromClass('complete_property.txt');
        $readonlyProperty = $properties[2]; // privateReadonlyProperty
        self::assertTrue($readonlyProperty->isReadonly());
    }

    public function testItParsesNonReadonlyByDefault()
    {
        $properties = $this->getPropertiesFromClass('simple_property.txt');
        self::assertFalse($properties[0]->isReadonly());
    }

    public function testItCanParseTypeHint()
    {
        $properties = $this->getPropertiesFromClass('complete_property.txt');

        $stringTypedProperty = $properties[0];
        self::assertEquals('string', $stringTypedProperty->getType()->toString());

        $intTypedProperty = $properties[1];
        self::assertEquals('int', $intTypedProperty->getType()->toString());

        $boolTypedProperty = $properties[2];
        self::assertEquals('bool', $boolTypedProperty->getType()->toString());

        $arrayTypedProperty = $properties[3];
        self::assertEquals('array', $arrayTypedProperty->getType()->toString());
    }

    public function testItParsesPropertyWithoutType()
    {
        $properties = $this->getPropertiesFromClass('simple_property.txt');
        // Properties without type have NoType which returns empty string
        self::assertEquals('', $properties[0]->getType()->toString());
    }

    public function testItCanParseStaticReadonlyProperty()
    {
        $properties = $this->getPropertiesFromClass('complete_property.txt');
        $staticReadonlyProperty = $properties[3]; // publicStaticReadonly

        self::assertEquals('public', $staticReadonlyProperty->getAccess()->value);
        self::assertTrue($staticReadonlyProperty->isStatic());
        self::assertTrue($staticReadonlyProperty->isReadonly());
        self::assertEquals('array', $staticReadonlyProperty->getType()->toString());
    }

    public function testItParsesAllPropertiesFromClass()
    {
        $properties = $this->getPropertiesFromClass('complete_property.txt');
        self::assertCount(4, $properties);

        self::assertEquals('publicTypedProperty', $properties[0]->getName());
        self::assertEquals('protectedStaticProperty', $properties[1]->getName());
        self::assertEquals('privateReadonlyProperty', $properties[2]->getName());
        self::assertEquals('publicStaticReadonly', $properties[3]->getName());
    }

    public function testItParsesVisibilityCorrectly()
    {
        $properties = $this->getPropertiesFromClass('visibility_properties.txt');
        self::assertCount(3, $properties);

        self::assertEquals('publicProperty', $properties[0]->getName());
        self::assertEquals('public', $properties[0]->getAccess()->value);

        self::assertEquals('protectedProperty', $properties[1]->getName());
        self::assertEquals('protected', $properties[1]->getAccess()->value);

        self::assertEquals('privateProperty', $properties[2]->getName());
        self::assertEquals('private', $properties[2]->getAccess()->value);
    }

    public function testItCanParseLanguageLevelTypeAware()
    {
        $properties = $this->getPropertiesFromClass('language_level_type_aware.txt');
        self::assertCount(1, $properties);

        $property = $properties[0];
        self::assertEquals('name', $property->getName());
        self::assertNotNull($property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals(['8.1' => 'string'], $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('', $property->getStubsMetadata()->getDefaultType());
    }

    public function testPropertyWithoutLanguageLevelTypeAware()
    {
        $properties = $this->getPropertiesFromClass('simple_property.txt');
        self::assertNull($properties[0]->getStubsMetadata()->getLanguageLevelTypes());
        self::assertNull($properties[0]->getStubsMetadata()->getDefaultType());
    }

    public function testLanguageLevelTypeAwareWithMultipleVersions()
    {
        $properties = $this->getPropertiesFromClass('multiple_versions.txt');
        self::assertCount(1, $properties);

        $property = $properties[0];
        $expectedTypes = ['8.0' => 'string|null', '8.1' => 'string'];
        self::assertEquals($expectedTypes, $property->getStubsMetadata()->getLanguageLevelTypes());
        self::assertEquals('', $property->getStubsMetadata()->getDefaultType());
    }
}
