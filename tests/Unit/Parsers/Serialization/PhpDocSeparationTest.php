<?php

namespace StubTests\Unit\Parsers\Serialization;

use StubTests\Framework\Serialization\Stubs\StubsEntitySerializer;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\Storage\InMemoryPhpDocRepository;
use StubTests\Framework\Storage\PhpDocStorage;

/**
 * What the serializers do with a PhpDoc: hoist it out of the entity array and into the repository
 * under the entity's id, and put it back on the way in.
 *
 * Most of these are pure array transforms and use the in-memory repository — no temp file, no lazy
 * loading, no save() to forget. Only testDeserializationLoadsPhpDocFromStorage goes through a real
 * file, because the thing it verifies *is* the round trip through one; it owns its own path.
 * PhpDocStorageTest::testEveryPhpDocRepositoryAgreesOnBlankDocSemantics pins the two implementations
 * to the same semantics so the cheap double can't drift from the real writer.
 */
class PhpDocSeparationTest extends TestCase
{
    private InMemoryPhpDocRepository $phpDocStorage;
    private StubsEntitySerializer $serializer;

    protected function setUp(): void
    {
        $this->phpDocStorage = new InMemoryPhpDocRepository();
        $this->serializer = new StubsEntitySerializer($this->phpDocStorage);
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

    /**
     * The only test here that needs a real file: it asserts a doc survives serialize → save() → a
     * fresh process's lazy load → deserialize, which is exactly what the cache does and what an
     * in-memory double cannot show.
     */
    public function testDeserializationLoadsPhpDocFromStorage(): void
    {
        $path = sys_get_temp_dir() . '/phpstorm-stubs-test-phpdoc-' . uniqid() . '.json';

        try {
            // A writer must not pre-load, per PhpDocStorage's invariant.
            $writeStorage = new PhpDocStorage($path, false);
            $writeSerializer = new StubsEntitySerializer($writeStorage);

            $class = new PHPClass();
            $class->setName('TestClass');
            $class->setId('\\TestClass');
            $class->initStubsMetadata()->setPhpDoc('/** @since 8.0 */');

            $serialized = $writeSerializer->serialize($class);
            self::assertNull($serialized['phpDoc'], 'the doc must be hoisted out, not inlined');
            $writeStorage->save();

            // A second storage over the same file stands in for a later run reading the cache.
            $deserialized = (new StubsEntitySerializer(new PhpDocStorage($path)))->deserialize($serialized);

            self::assertEquals('/** @since 8.0 */', $deserialized->getStubsMetadata()?->getPhpDoc());
        } finally {
            if (file_exists($path)) {
                unlink($path);
            }
        }
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
