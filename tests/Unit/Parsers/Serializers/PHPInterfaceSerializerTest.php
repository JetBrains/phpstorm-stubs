<?php

namespace StubTests\Unit\Parsers\Serializers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Serializers\Stubs\PHPInterfaceSerializer;

class PHPInterfaceSerializerTest extends TestCase
{
    private PHPInterfaceSerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new PHPInterfaceSerializer();
    }

    private function makeInterface(string $id, ?string $namespace = null, array $parentInterfaces = []): PHPInterface
    {
        $iface = new PHPInterface();
        $iface->setId($id);
        $iface->setName(ltrim($id, '\\'));
        $iface->setNamespace($namespace ?? '\\');
        foreach ($parentInterfaces as $parent) {
            $iface->addParentInterface($parent);
        }
        return $iface;
    }

    private function makeParentStub(string $name): PHPInterface
    {
        $parent = new PHPInterface();
        $parent->setName($name);
        return $parent;
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsOnlyPHPInterfaceEntities(): void
    {
        $this->assertTrue($this->serializer->supports(new PHPInterface()));
        $this->assertFalse($this->serializer->supports(new \stdClass()));
        $this->assertFalse($this->serializer->supports('string'));
    }

    // ── parentInterfaces serialization ────────────────────────────────────────

    public function testSerializeInterfaceWithNoParentInterfaces(): void
    {
        $iface = $this->makeInterface('\Iterator');
        $data  = $this->serializer->serialize($iface);

        $this->assertArrayHasKey('parentInterfaces', $data);
        $this->assertSame([], $data['parentInterfaces']);
    }

    public function testSerializeInterfaceWithOneParentInterface(): void
    {
        $iface = $this->makeInterface('\OuterIterator', '\\', [
            $this->makeParentStub('Iterator'),
        ]);

        $data = $this->serializer->serialize($iface);

        $this->assertSame(['Iterator'], $data['parentInterfaces']);
    }

    public function testSerializeInterfaceWithMultipleParentInterfaces(): void
    {
        $iface = $this->makeInterface('\BackedEnum', '\\', [
            $this->makeParentStub('UnitEnum'),
            $this->makeParentStub('Stringable'),
        ]);

        $data = $this->serializer->serialize($iface);

        $this->assertSame(['UnitEnum', 'Stringable'], $data['parentInterfaces']);
    }

    public function testSerializePreservesParentInterfaceOrder(): void
    {
        $iface = $this->makeInterface('\CombinedInterface', '\\', [
            $this->makeParentStub('Alpha'),
            $this->makeParentStub('Beta'),
            $this->makeParentStub('Gamma'),
        ]);

        $data = $this->serializer->serialize($iface);

        $this->assertSame(['Alpha', 'Beta', 'Gamma'], $data['parentInterfaces']);
    }

    // ── parentInterfaces deserialization ──────────────────────────────────────

    public function testDeserializeInterfaceWithNoParentInterfacesKey(): void
    {
        $data = [
            '_type'     => 'PHPInterface',
            'name'      => 'Iterator',
            'id'        => '\Iterator',
            'namespace' => '\\',
        ];

        $iface = $this->serializer->deserialize($data);

        $this->assertEmpty($iface->getParentInterfaces());
    }

    public function testDeserializeInterfaceWithEmptyParentInterfacesArray(): void
    {
        $data = [
            'name'             => 'Iterator',
            'id'               => '\Iterator',
            'namespace'        => '\\',
            'parentInterfaces' => [],
        ];

        $iface = $this->serializer->deserialize($data);

        $this->assertEmpty($iface->getParentInterfaces());
    }

    public function testDeserializeInterfaceRestoresParentInterfaceObjects(): void
    {
        $data = [
            'name'             => 'OuterIterator',
            'id'               => '\OuterIterator',
            'namespace'        => '\\',
            'parentInterfaces' => ['Iterator'],
        ];

        $iface   = $this->serializer->deserialize($data);
        $parents = $iface->getParentInterfaces();

        $this->assertCount(1, $parents);
        $this->assertInstanceOf(PHPInterface::class, $parents[0]);
        $this->assertSame('Iterator', $parents[0]->getName());
    }

    public function testDeserializeInterfaceRestoresMultipleParentInterfaces(): void
    {
        $data = [
            'name'             => 'BackedEnum',
            'id'               => '\BackedEnum',
            'namespace'        => '\\',
            'parentInterfaces' => ['UnitEnum', 'Stringable'],
        ];

        $iface   = $this->serializer->deserialize($data);
        $parents = $iface->getParentInterfaces();

        $this->assertCount(2, $parents);
        $this->assertSame('UnitEnum', $parents[0]->getName());
        $this->assertSame('Stringable', $parents[1]->getName());
    }

    public function testDeserializeSkipsEmptyParentInterfaceName(): void
    {
        $data = [
            'name'             => 'SomeInterface',
            'id'               => '\SomeInterface',
            'namespace'        => '\\',
            'parentInterfaces' => ['', 'ValidParent', ''],
        ];

        $iface   = $this->serializer->deserialize($data);
        $parents = $iface->getParentInterfaces();

        $this->assertCount(1, $parents);
        $this->assertSame('ValidParent', $parents[0]->getName());
    }

    // ── round-trip ────────────────────────────────────────────────────────────

    public function testRoundTripPreservesParentInterfaceNames(): void
    {
        $original = $this->makeInterface('\SeekableIterator', '\\', [
            $this->makeParentStub('Iterator'),
        ]);

        $data     = $this->serializer->serialize($original);
        $restored = $this->serializer->deserialize($data);

        $parents = $restored->getParentInterfaces();
        $this->assertCount(1, $parents);
        $this->assertSame('Iterator', $parents[0]->getName());
    }

    public function testRoundTripWithNoParentInterfaces(): void
    {
        $original = $this->makeInterface('\Countable');

        $data     = $this->serializer->serialize($original);
        $restored = $this->serializer->deserialize($data);

        $this->assertEmpty($restored->getParentInterfaces());
    }

    public function testRoundTripPreservesBasicFields(): void
    {
        $original = $this->makeInterface('\MyInterface', '\\');
        $original->initStubsMetadata()->setSinceVersion('8.0');
        $original->initStubsMetadata()->setRemovedVersion(null);

        $data     = $this->serializer->serialize($original);
        $restored = $this->serializer->deserialize($data);

        $this->assertSame('\MyInterface', $restored->getId());
        $this->assertSame('MyInterface', $restored->getName());
        $this->assertSame('8.0', $restored->getStubsMetadata()?->getSinceVersion());
    }
}
