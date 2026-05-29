<?php

namespace StubTests\Unit\Parsers\Serialization;

use StubTests\Framework\Parsers\Serializers\Stubs\StubsEntitySerializer;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;

class PhpDocSeparationTest extends TestCase
{
    private string $testFilePath;
    private PhpDocStorage $phpDocStorage;
    private StubsEntitySerializer $serializer;

    protected function setUp(): void
    {
        $this->testFilePath = sys_get_temp_dir() . '/phpstorm-stubs-test-phpdoc-' . uniqid() . '.json';
        $this->phpDocStorage = new PhpDocStorage($this->testFilePath, false);
        $this->serializer = new StubsEntitySerializer($this->phpDocStorage);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }

    public function testClassPhpDocIsSeparated(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');
        $class->initStubsMetadata()->setPhpDoc('/** @deprecated This is a test class */');

        $serialized = $this->serializer->serialize($class);

        // PhpDoc should be null in serialized data (stored externally)
        self::assertNull($serialized['phpDoc']);

        // PhpDoc should be in external storage
        self::assertEquals('/** @deprecated This is a test class */', $this->phpDocStorage->getPhpDoc('\\TestClass'));
    }

    public function testFunctionPhpDocIsSeparated(): void
    {
        $function = new PHPFunction();
        $function->setName('testFunction');
        $function->setId('\\testFunction');
        $function->initStubsMetadata()->setPhpDoc('/** @return bool */');

        $serialized = $this->serializer->serialize($function);

        // PhpDoc should be null in serialized data
        self::assertNull($serialized['phpDoc']);

        // PhpDoc should be in external storage
        self::assertEquals('/** @return bool */', $this->phpDocStorage->getPhpDoc('\\testFunction'));
    }

    public function testMethodPhpDocIsSeparated(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');

        $method = new PHPMethod();
        $method->setName('testMethod');
        $method->setIsStatic(false);
        $method->setIsFinal(false);
        $method->setIsAbstract(false);
        $method->setDeprecated(false);
        $method->setParameters([]);
        $method->initStubsMetadata()->setPhpDoc('/** @return string */');

        $class->addMethod($method);

        $serialized = $this->serializer->serialize($class);

        // Method PhpDoc should be null in serialized data
        self::assertNull($serialized['methods'][0]['phpDoc']);

        // Method PhpDoc should be in external storage with class::method key
        self::assertEquals('/** @return string */', $this->phpDocStorage->getPhpDoc('\\TestClass::testMethod'));
    }

    public function testPropertyPhpDocIsSeparated(): void
    {
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');

        $property = new PHPProperty();
        $property->setName('testProperty');
        $property->initStubsMetadata()->setPhpDoc('/** @var int */');

        $class->addProperty($property);

        $serialized = $this->serializer->serialize($class);

        // Property PhpDoc should be null in serialized data
        self::assertNull($serialized['properties'][0]['phpDoc']);

        // Property PhpDoc should be in external storage with class::$property key
        self::assertEquals('/** @var int */', $this->phpDocStorage->getPhpDoc('\\TestClass::$testProperty'));
    }

    public function testDeserializationLoadsPhpDocFromStorage(): void
    {
        // Serialize a class with PhpDoc
        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');
        $class->initStubsMetadata()->setPhpDoc('/** @since 8.0 */');

        $serialized = $this->serializer->serialize($class);
        $this->phpDocStorage->save();

        // Create new storage and serializer to simulate loading
        $newPhpDocStorage = new PhpDocStorage($this->testFilePath);
        $newSerializer = new StubsEntitySerializer($newPhpDocStorage);

        // Deserialize
        $deserialized = $newSerializer->deserialize($serialized);

        // PhpDoc should be loaded from external storage
        self::assertEquals('/** @since 8.0 */', $deserialized->getStubsMetadata()?->getPhpDoc());
    }

    public function testWithoutPhpDocStoragePhpDocIsInline(): void
    {
        // Create serializer without PhpDocStorage
        $inlineSerializer = new StubsEntitySerializer(null);

        $class = new PHPClass();
        $class->setName('TestClass');
        $class->setId('\\TestClass');
        $class->initStubsMetadata()->setPhpDoc('/** @deprecated */');

        $serialized = $inlineSerializer->serialize($class);

        // PhpDoc should be inline (not null)
        self::assertEquals('/** @deprecated */', $serialized['phpDoc']);

        // Deserialize should work
        $deserialized = $inlineSerializer->deserialize($serialized);
        self::assertEquals('/** @deprecated */', $deserialized->getStubsMetadata()?->getPhpDoc());
    }
}
