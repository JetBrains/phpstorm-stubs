<?php

namespace StubTests\Framework\Parsers\Hierarchy;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPInterface;

/**
 * Resolves parent class and interface references after all entities are loaded.
 *
 * During deserialization, parent class and interface objects are created as stubs
 * containing only the short class name. This resolver replaces those stubs with
 * the actual objects from the loaded collection, enabling full hierarchy traversal
 * via PHPClass::getAncestorClassNames() and PHPClass::getImplementedInterfaceNames().
 */
class ClassHierarchyResolver
{
    /**
     * Link parentClass and interfaces on every PHPClass to the actual objects in the collection.
     * Also links interfaces on every PHPEnum.
     *
     * @param iterable $classes     All PHPClass instances from the storage
     * @param iterable $interfaces  All PHPInterface instances from the storage
     * @param iterable $enums       All PHPEnum instances from the storage
     */
    public function resolve(iterable $classes, iterable $interfaces = [], iterable $enums = []): void
    {
        // Build FQN → object lookup tables (keyed by getId() stripped of the leading \).
        // Using FQN keys eliminates collisions when multiple classes share the same short
        // name in different namespaces (e.g. 16 classes named "Exception" in the stubs).
        $classMap = [];
        foreach ($classes as $class) {
            $id = $class->getId();
            if ($id !== null && $id !== '') {
                $classMap[ltrim($id, '\\')] = $class;
            }
        }

        $interfaceMap = [];
        foreach ($interfaces as $iface) {
            $id = $iface->getId();
            if ($id !== null && $id !== '') {
                $interfaceMap[ltrim($id, '\\')] = $iface;
            }
        }

        // Link each class's parent and interfaces to actual objects
        foreach ($classMap as $class) {
            $this->resolveClass($class, $classMap, $interfaceMap);
        }

        // Link each interface's parent interfaces to actual objects
        foreach ($interfaceMap as $iface) {
            $this->resolveInterface($iface, $interfaceMap);
        }

        // Link each enum's interfaces to actual objects
        foreach ($enums as $enum) {
            $this->resolveEnum($enum, $interfaceMap);
        }
    }

    private function resolveClass(PHPClass $class, array $classMap, array $interfaceMap): void
    {
        // Replace parentClass stub with the actual PHPClass from the collection.
        if ($class->getParentClass() !== null) {
            $class->setParentClass(
                $this->lookupInMap($class->getParentClass()->getName(), $class->getNamespace(), $classMap)
                ?? $class->getParentClass()
            );
        }

        // Replace interface stubs with actual PHPInterface objects from the collection.
        $interfaces = $class->getImplementedInterfaces();
        foreach ($interfaces as $idx => $iface) {
            $resolved = $this->lookupInMap($iface->getName(), $class->getNamespace(), $interfaceMap);
            if ($resolved !== null) {
                $interfaces[$idx] = $resolved;
            }
        }
        $class->setImplementedInterfaces($interfaces);
    }

    /**
     * Resolve parent interface references for a PHPInterface to actual PHPInterface objects.
     */
    private function resolveInterface(PHPInterface $iface, array $interfaceMap): void
    {
        $parentInterfaces = $iface->getParentInterfaces();
        foreach ($parentInterfaces as $idx => $parent) {
            $resolved = $this->lookupInMap($parent->getName(), $iface->getNamespace(), $interfaceMap);
            if ($resolved !== null) {
                $parentInterfaces[$idx] = $resolved;
            }
        }
        $iface->setParentInterfaces($parentInterfaces);
    }

    private function resolveEnum(PHPEnum $enum, array $interfaceMap): void
    {
        $interfaces = $enum->getImplementedInterfaces();
        foreach ($interfaces as $idx => $iface) {
            $resolved = $this->lookupInMap($iface->getName(), $enum->getNamespace(), $interfaceMap);
            if ($resolved !== null) {
                $interfaces[$idx] = $resolved;
            }
        }
        $enum->setImplementedInterfaces($interfaces);
    }

    /**
     * Look up an entity by name in a FQN-keyed map.
     *
     * Strategy:
     * 1. Direct match against the FQN-keyed map (handles reflection FQNs and root-namespace
     *    entities whose short name equals their FQN, e.g. "Exception").
     * 2. Namespace-qualified fallback: prepend the owner's namespace to the short name
     *    and try again (handles stubs where the entity is in the same namespace).
     */
    private function lookupInMap(?string $name, ?string $ownerNamespace, array $map): mixed
    {
        if ($name === null || $name === '') {
            return null;
        }

        if (isset($map[$name])) {
            return $map[$name];
        }

        $ns = ltrim($ownerNamespace ?? '', '\\');
        if ($ns !== '') {
            $qualified = $ns . '\\' . $name;
            if (isset($map[$qualified])) {
                return $map[$qualified];
            }
        }

        return null;
    }
}
