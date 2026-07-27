<?php

namespace StubTests\Framework\Parsers\Serializers\Stubs;

use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Storage\PhpDocStorage;
use StubTests\Framework\Parsers\Serializers\EntityTypeSerializerInterface;

/**
 * Serializer for PHPInterface entities.
 */
class PHPInterfaceSerializer implements EntityTypeSerializerInterface
{
    use SerializerHelperTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPInterface;
    }

    public function serialize($entity, ?PhpDocStorage $phpDocStorage = null): array
    {
        if (!$entity instanceof PHPInterface) {
            throw new \InvalidArgumentException('Expected PHPInterface entity');
        }

        $data = [
            '_type' => 'PHPInterface',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
            'sourcePath' => $this->toJsonSafe($entity->getStubsMetadata()?->getSourcePath()),
            'duplicates' => $this->toJsonSafe($entity->getStubsMetadata()?->getDuplicates() ?? []),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        // Stub-specific metadata
        $data['phpDoc'] = $this->serializePhpDoc($entity->getId(), $entity->getStubsMetadata()?->getPhpDoc(), $phpDocStorage);
        $data['sinceVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getSinceVersion());
        $data['removedVersion'] = $this->toJsonSafe($entity->getStubsMetadata()?->getRemovedVersion());

        // Serialize methods
        $data['methods'] = [];
        foreach ($entity->getMethods() as $method) {
            $data['methods'][] = $this->serializeMethod($method, $entity->getId(), $phpDocStorage);
        }

        // Serialize constants
        $data['constants'] = [];
        foreach ($entity->getConstants() as $constant) {
            $data['constants'][] = $this->serializeClassConstant($constant);
        }

        // Persist the fully qualified name, matching PHPClassSerializer's handling of
        // implemented interfaces. Storing only the short name made the cached form
        // ambiguous: `MongoDB\BSON\Persistable extends Serializable` round-tripped to the
        // bare name "Serializable", which ClassHierarchyResolver then matched against the
        // global \Serializable instead of \MongoDB\BSON\Serializable.
        $data['parentInterfaces'] = [];
        foreach ($entity->getParentInterfaces() as $parentInterface) {
            $data['parentInterfaces'][] = $parentInterface->getId() ?? $parentInterface->getName();
        }

        return $data;
    }

    /**
     * Short name of a possibly qualified interface name (`\Foo\Bar` => `Bar`).
     */
    private function shortInterfaceName(string $name): string
    {
        $pos = strrpos($name, '\\');
        return $pos === false ? $name : substr($name, $pos + 1);
    }

    public function deserialize(array $data, ?PhpDocStorage $phpDocStorage = null)
    {
        $interface = new PHPInterface();
        $interface->setName($data['name'] ?? null);
        $interface->setNamespace($data['namespace'] ?? null);
        $interface->setId($data['id'] ?? null);
        $interface->initStubsMetadata()->setSourcePath($data['sourcePath'] ?? null);
        $interface->initStubsMetadata()->setDuplicates($data['duplicates'] ?? []);

        // Stub-specific metadata
        $interfaceId = $data['id'] ?? null;
        $interface->initStubsMetadata()->setPhpDoc($this->deserializePhpDoc($interfaceId, $data['phpDoc'] ?? null, $phpDocStorage));
        $interface->initStubsMetadata()->setSinceVersion($data['sinceVersion'] ?? null);
        $interface->initStubsMetadata()->setRemovedVersion($data['removedVersion'] ?? null);

        // Deserialize methods
        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $interface->addMethod($this->deserializeMethod($methodData, $interfaceId, $phpDocStorage));
            }
        }

        // Deserialize constants
        if (isset($data['constants']) && is_array($data['constants'])) {
            foreach ($data['constants'] as $constantData) {
                $interface->addConstant($this->deserializeClassConstant($constantData));
            }
        }

        // Restore parent interfaces. Both the id and the short name are set: the id lets
        // ClassHierarchyResolver resolve cross-namespace references exactly, while the short
        // name keeps its fallback working for stubs whose qualified id does not exist (e.g.
        // `namespace Ds; interface Collection extends Countable`, which means the global
        // \Countable in practice even though PHP would read it as \Ds\Countable).
        if (isset($data['parentInterfaces']) && is_array($data['parentInterfaces'])) {
            foreach ($data['parentInterfaces'] as $parentInterfaceName) {
                if (!empty($parentInterfaceName)) {
                    $parentInterface = new PHPInterface();
                    $parentInterface->setName($this->shortInterfaceName($parentInterfaceName));
                    $parentInterface->setId($parentInterfaceName);
                    $interface->addParentInterface($parentInterface);
                }
            }
        }

        return $interface;
    }
}
