<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Model\PHPParameter;
use StubTests\Framework\Model\PHPProperty;

/**
 * Service for collecting methods and properties from entity hierarchies.
 *
 * Extracted from AbstractClassCheck to enable reuse without inheritance.
 */
class MethodCollectionService
{
    /**
     * Collect version-filtered stub properties from the full parent class chain.
     * Returns a map of property name -> PHPProperty. Child definitions win over parent.
     *
     * @return array<string, PHPProperty>
     */
    public function collectPropertiesForClass(PHPClass $class, string $phpVersion): array
    {
        $propertyMap = [];
        $visited = [];

        $current = $class;
        while ($current !== null) {
            $id = $current->getId();
            if ($id !== null && in_array($id, $visited, true)) {
                break; // cycle guard
            }
            if ($id !== null) {
                $visited[] = $id;
            }

            foreach ($current->getProperties() as $property) {
                $name = $property->getName();
                if ($name === null || isset($propertyMap[$name])) {
                    continue;
                }

                if ($property->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true) {
                    $propertyMap[$name] = $property;
                }
            }

            $current = $current->getParentClass();
        }

        return $propertyMap;
    }

    /**
     * Collect version-filtered stub methods from the full class hierarchy.
     * Child class definitions win over parent class definitions for the same effective name.
     *
     * Traversal includes:
     * - The class itself and its full parentClass chain
     * - All implemented interfaces (and their parent interface chains) for each class in the hierarchy
     *
     * @return array<string, PHPMethod>
     */
    public function collectForClass(PHPClass $class, string $phpVersion): array
    {
        $methodMap = [];
        $visited = [];

        $current = $class;
        while ($current !== null) {
            $id = $current->getId();
            if ($id !== null && in_array($id, $visited, true)) {
                break; // cycle guard
            }
            if ($id !== null) {
                $visited[] = $id;
            }

            $this->collectMethodsFromClassLike($current, $phpVersion, $methodMap);

            foreach ($current->getImplementedInterfaces() as $interface) {
                $this->collectMethodsFromInterfaceHierarchy($interface, $phpVersion, $methodMap, $visited);
            }

            $current = $current->getParentClass();
        }

        return $methodMap;
    }

    /**
     * Collect version-filtered stub methods from an enum and its implemented interface chain.
     *
     * @return array<string, PHPMethod>
     */
    public function collectForEnum(PHPEnum $enum, string $phpVersion): array
    {
        $methodMap = [];
        $visited = [];

        $this->collectMethodsFromClassLike($enum, $phpVersion, $methodMap);

        foreach ($enum->getImplementedInterfaces() as $interface) {
            $this->collectMethodsFromInterfaceHierarchy($interface, $phpVersion, $methodMap, $visited);
        }

        return $methodMap;
    }

    /**
     * Collect version-filtered stub methods from an interface and its full parent interface chain.
     *
     * @return array<string, PHPMethod>
     */
    public function collectForInterface(PHPInterface $interface, string $phpVersion): array
    {
        $methodMap = [];
        $visited = [];
        $this->collectMethodsFromInterfaceHierarchy($interface, $phpVersion, $methodMap, $visited);
        return $methodMap;
    }

    /**
     * Add version-available methods from a single class-like entity to the map.
     * Only inserts a name if not already present (first/child definition wins).
     *
     * Strips PS_UNRESERVE_PREFIX_ from method names so that e.g. PS_UNRESERVE_PREFIX_throw
     * matches the reflection name "throw".
     *
     * @param array<string, PHPMethod> $methodMap
     */
    public function collectMethodsFromClassLike(PHPClassLikeObject $entity, string $phpVersion, array &$methodMap): void
    {
        foreach ($entity->getMethods() as $method) {
            $name = $method->getName();
            if ($name === null) {
                continue;
            }

            if (!($method->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true)) {
                continue;
            }

            $effectiveName = str_starts_with($name, 'PS_UNRESERVE_PREFIX_')
                ? substr($name, strlen('PS_UNRESERVE_PREFIX_'))
                : $name;

            if (!isset($methodMap[$effectiveName])) {
                $methodMap[$effectiveName] = $method;
            }
        }
    }

    /**
     * Collect the names of version-available stub constants declared on an entity or anywhere
     * in its hierarchy (parent classes, implemented and parent interfaces). Enum case names are
     * included because reflection reports enum cases as constants.
     *
     * @return array<string, true>
     */
    public function collectConstantNames(PHPClassLikeObject $entity, string $phpVersion): array
    {
        $names = [];
        $visited = [];
        $this->collectConstantNamesFromHierarchy($entity, $phpVersion, $names, $visited);
        return $names;
    }

    /**
     * Filter parameters by version availability, then deduplicate consecutive same-named
     * parameters where the second is variadic (the stub workaround for non-optional variadics).
     *
     * @param  PHPParameter[] $params
     * @return PHPParameter[]
     */
    public function filterAndDeduplicateParams(array $params, string $phpVersion): array
    {
        return ParameterFilterHelper::filterAndDeduplicate($params, $phpVersion);
    }

    /**
     * Recursively collect methods from an interface and its parent interface chain.
     *
     * @param array<string, PHPMethod> $methodMap
     * @param array<string>            $visited
     */
    public function collectMethodsFromInterfaceHierarchy(
        PHPInterface $interface,
        string $phpVersion,
        array &$methodMap,
        array &$visited
    ): void {
        $id = $interface->getId();
        if ($id !== null && in_array($id, $visited, true)) {
            return;
        }
        if ($id !== null) {
            $visited[] = $id;
        }

        $this->collectMethodsFromClassLike($interface, $phpVersion, $methodMap);

        foreach ($interface->getParentInterfaces() as $parent) {
            $this->collectMethodsFromInterfaceHierarchy($parent, $phpVersion, $methodMap, $visited);
        }
    }

    /**
     * @param array<string, true> $names
     * @param array<string>       $visited
     */
    private function collectConstantNamesFromHierarchy(
        PHPClassLikeObject $entity,
        string $phpVersion,
        array &$names,
        array &$visited
    ): void {
        $id = $entity->getId();
        if ($id !== null && in_array($id, $visited, true)) {
            return; // cycle guard
        }
        if ($id !== null) {
            $visited[] = $id;
        }

        foreach ($entity->getConstants() as $constant) {
            $name = $constant->getName();
            if ($name !== null && ($constant->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true)) {
                $names[$name] = true;
            }
        }
        if ($entity instanceof PHPEnum) {
            foreach ($entity->getCaseNames() as $caseName) {
                $names[$caseName] = true;
            }
        }

        $ancestors = $entity->getImplementedInterfaces();
        if ($entity instanceof PHPClass && $entity->getParentClass() !== null) {
            $ancestors[] = $entity->getParentClass();
        }
        if ($entity instanceof PHPInterface) {
            $ancestors = array_merge($ancestors, $entity->getParentInterfaces());
        }
        foreach ($ancestors as $ancestor) {
            $this->collectConstantNamesFromHierarchy($ancestor, $phpVersion, $names, $visited);
        }
    }
}
