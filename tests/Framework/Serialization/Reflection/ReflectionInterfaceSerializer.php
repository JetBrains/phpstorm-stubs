<?php

namespace StubTests\Framework\Serialization\Reflection;

use StubTests\Framework\Serialization\EntityTypeSerializerInterface;
use StubTests\Framework\Serialization\SubEntitySerializerTrait;
use StubTests\Framework\Serialization\PhpDocRepository;
use StubTests\Framework\Model\PHPInterface;

/**
 * Reflection serializer for PHPInterface entities.
 * Only includes data available via PHP Reflection API.
 */
class ReflectionInterfaceSerializer implements EntityTypeSerializerInterface
{
    use SubEntitySerializerTrait;

    public function supports($entity): bool
    {
        return $entity instanceof PHPInterface;
    }

    public function serialize($entity, ?PhpDocRepository $phpDocStorage = null): array
    {
        $data = [
            '_type' => 'PHPInterface',
            'name' => $this->toJsonSafe($entity->getName()),
            'id' => $this->toJsonSafe($entity->getId()),
        ];

        $data['namespace'] = $this->toJsonSafe($entity->getNamespace());

        $data['methods'] = [];
        foreach ($entity->getMethods() as $method) {
            $data['methods'][] = $this->serializeMethod($method);
        }

        $data['constants'] = [];
        foreach ($entity->getConstants() as $constant) {
            $data['constants'][] = $this->serializeClassConstant($constant);
        }

        // Persisted as fully qualified ids, like PHPInterfaceSerializer does, so the FQN survives
        // the round trip and ClassHierarchyResolver can match `\MongoDB\BSON\Serializable` rather
        // than falling back to the global `\Serializable`.
        //
        // This is the transitive ancestor set, not just the direct parents — see the note in
        // ReflectionInterfaceParser::parse().
        $data['parentInterfaces'] = [];
        foreach ($entity->getParentInterfaces() as $parentInterface) {
            $data['parentInterfaces'][] = $this->toJsonSafe(
                $parentInterface->getId() ?? $parentInterface->getName()
            );
        }

        return $data;
    }

    public function deserialize(array $data, ?PhpDocRepository $phpDocStorage = null): PHPInterface
    {
        $interface = new PHPInterface();
        $interface->setName($data['name'] ?? null);
        $interface->setNamespace($data['namespace'] ?? null);
        $interface->setId($data['id'] ?? null);

        if (isset($data['methods']) && is_array($data['methods'])) {
            foreach ($data['methods'] as $methodData) {
                $interface->addMethod($this->deserializeMethod($methodData));
            }
        }

        if (isset($data['constants']) && is_array($data['constants'])) {
            foreach ($data['constants'] as $constantData) {
                $interface->addConstant($this->deserializeClassConstant($constantData));
            }
        }

        if (isset($data['parentInterfaces']) && is_array($data['parentInterfaces'])) {
            foreach ($data['parentInterfaces'] as $parentInterfaceId) {
                if (empty($parentInterfaceId)) {
                    continue;
                }
                $parentInterface = new PHPInterface();
                // Reflection ids are always fully qualified, so no short-name fallback is needed
                // here (unlike the stubs serializer, which has to cope with `extends Countable`
                // inside a namespace meaning the global \Countable).
                $parentInterface->setName(ltrim($parentInterfaceId, '\\'));
                $parentInterface->setId($parentInterfaceId);
                $interface->addParentInterface($parentInterface);
            }
        }

        return $interface;
    }
}
