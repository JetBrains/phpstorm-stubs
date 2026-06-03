<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Parsers\Model\PHPClass;

/**
 * Extracts the list of ancestor class FQNs from a PHPClass by traversing the parentClass chain.
 *
 * When ClassHierarchyResolver has linked parentClass objects to their actual instances,
 * getId() carries the fully-qualified name (e.g. "\Random\RandomError"). The leading
 * backslash is stripped so the result matches the format PHP reflection returns
 * (e.g. "Random\RandomError"). For unresolved stubs (getId() is null) the stored
 * getName() value is used as a fallback.
 */
class ClassAncestorNamesExtractor
{
    /**
     * Returns FQNs (no leading \) of all ancestor classes, nearest-first.
     * Cycle-safe via a visited-set.
     *
     * @return string[] Ancestor FQNs from direct parent to most distant ancestor
     */
    public function extract(PHPClass $class): array
    {
        $ancestors = [];
        $current = $class->getParentClass();
        $visited = [];

        while ($current !== null) {
            $id = $current->getId();
            // Linked objects carry their full namespace in getId(); strip the leading \
            // to match reflection's format. Fall back to getName() for unresolved stubs.
            $name = $id !== null ? ltrim($id, '\\') : $current->getName();
            if ($name === null || $name === '' || isset($visited[$name])) {
                break;
            }
            $ancestors[] = $name;
            $visited[$name] = true;
            $current = $current->getParentClass();
        }

        return $ancestors;
    }
}
