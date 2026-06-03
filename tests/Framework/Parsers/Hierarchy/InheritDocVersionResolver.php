<?php

namespace StubTests\Framework\Parsers\Hierarchy;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPClassLikeObject;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPInterface;

/**
 * Resolves sinceVersion for methods whose PhpDoc contains by
 * inheriting the version from the nearest parent interface or class that defines
 * the same method with an explicit @since tag.
 *
 * Must be called AFTER ClassHierarchyResolver has wired up the object references
 * in PHPClass::$interfaces, PHPClass::$parentClass, and PHPInterface::$parentInterfaces.
 */
class InheritDocVersionResolver
{
    /**
     * @param iterable $classes    All PHPClass instances from storage
     * @param iterable $interfaces All PHPInterface instances from storage
     * @param iterable $enums      All PHPEnum instances from storage
     */
    public function resolve(iterable $classes, iterable $interfaces = [], iterable $enums = []): void
    {
        foreach ($interfaces as $interface) {
            $this->resolveClassLike($interface);
        }

        foreach ($classes as $class) {
            $this->resolveClassLike($class);
        }

        foreach ($enums as $enum) {
            $this->resolveClassLike($enum);
        }
    }

    private function resolveClassLike(PHPClassLikeObject $classLike): void
    {
        foreach ($classLike->getMethods() as $method) {
            if ($method->getStubsMetadata()?->getSinceVersion() !== null) {
                continue;
            }

            $phpDoc = $method->getStubsMetadata()?->getPhpDoc();
            if ($phpDoc === null || !$this->hasInheritDoc($phpDoc)) {
                continue;
            }

            $sinceVersion = $this->findVersionInParents($method->getName(), $classLike, []);
            if ($sinceVersion !== null) {
                $method->initStubsMetadata()->setSinceVersion($sinceVersion);
            }
        }
    }

    private function hasInheritDoc(string $phpDoc): bool
    {
        return str_contains(strtolower($phpDoc), '@inheritdoc');
    }

    /**
     * Walk the parent entities of $classLike (interfaces, parent interfaces,
     * parent class) and search each one for a method with an explicit @since.
     */
    private function findVersionInParents(string $methodName, PHPClassLikeObject $classLike, array $visited): ?string
    {
        // Check implemented interfaces (available on PHPClass and PHPEnum)
        if ($classLike instanceof PHPClass || $classLike instanceof PHPEnum) {
            foreach ($classLike->getImplementedInterfaces() as $interface) {
                $version = $this->findVersionInClassLike($methodName, $interface, $visited);
                if ($version !== null) {
                    return $version;
                }
            }
        }

        // Check parent interfaces (available on PHPInterface)
        if ($classLike instanceof PHPInterface) {
            foreach ($classLike->getParentInterfaces() as $parentInterface) {
                $version = $this->findVersionInClassLike($methodName, $parentInterface, $visited);
                if ($version !== null) {
                    return $version;
                }
            }
        }

        // Check parent class chain (available on PHPClass)
        if ($classLike instanceof PHPClass && $classLike->getParentClass() !== null) {
            return $this->findVersionInClassLike($methodName, $classLike->getParentClass(), $visited);
        }

        return null;
    }

    /**
     * Search a class-like entity for a method with an explicit @since version,
     * then recurse into its parents. Handles both PHPClass and PHPInterface.
     *
     * Replaces the former type-specific findVersionInInterface() and
     * findVersionInClass() methods — the cycle-detection and method-search
     * logic is identical for both; only the parent-walking differs,
     * which findVersionInParents() already handles via type dispatch.
     */
    private function findVersionInClassLike(string $methodName, PHPClassLikeObject $classLike, array $visited): ?string
    {
        $id = $classLike->getId();
        if ($id !== null) {
            if (isset($visited[$id])) {
                return null;
            }
            $visited[$id] = true;
        }

        foreach ($classLike->getMethods() as $method) {
            if ($method->getName() === $methodName && $method->getStubsMetadata()?->getSinceVersion() !== null) {
                return $method->getStubsMetadata()->getSinceVersion();
            }
        }

        return $this->findVersionInParents($methodName, $classLike, $visited);
    }
}
