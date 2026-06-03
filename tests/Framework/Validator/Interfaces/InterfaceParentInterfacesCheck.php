<?php

namespace StubTests\Framework\Validator\Interfaces;

use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Validates that every parent interface in a stub interface's full ancestry chain
 * is itself declared in the stubs.
 *
 * This is a stubs self-consistency check — it does not compare against reflection.
 * After ClassHierarchyResolver links parent interface references to actual objects,
 * a resolved parent is replaced with the actual PHPInterface from the stubs collection.
 * An unresolved parent retains its tentative Id (constructed from the owning interface's
 * namespace + the short name) and is NOT present in the stubs collection.
 *
 * The check traverses the complete ancestry tree (not just direct parents) to catch
 * missing ancestors at any depth.
 *
 * If the interface itself is not found in the stubs the check fails, consistent with
 * all other interface checks (InterfaceExistsCheck is the canonical reporter, but
 * redundant failures are acceptable).
 *
 * Known problems are supported at interface level:
 * - EntityType::INTERFACE_TYPE + interfaceId + 'InterfaceParentInterfacesCheck'
 *   → skips the check entirely for the named interface.
 */
class InterfaceParentInterfacesCheck extends AbstractClassCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::INTERFACE_TYPE->value, $entityId, 'InterfaceParentInterfacesCheck', $phpVersion)) {
            return $results;
        }

        $stubInterface = $this->findInterfaceById($stubs, $entityId);
        if ($stubInterface === null) {
            $results->addFailure($entityId, "Interface {$entityId} not found in stubs");
            return $results;
        }

        $missing = [];
        $visited = [];
        $this->collectMissingParents($stubInterface, $stubs, $missing, $visited);

        if (empty($missing)) {
            $results->addSuccess($entityId);
        } else {
            foreach ($missing as $parentName) {
                $results->addFailure(
                    $entityId . ':parent:' . $parentName,
                    "Interface {$entityId}: parent interface '{$parentName}' is declared in stubs hierarchy but not found in stubs"
                );
            }
        }

        return $results;
    }

    /**
     * Recursively walk the parent interface tree of $interface and collect the names
     * of any ancestors that are not present in the stubs collection.
     *
     * After ClassHierarchyResolver, a resolved parent is one of the actual PHPInterface
     * objects from the stubs (findInterfaceById returns it). An unresolved parent retains
     * its tentative Id and is absent from the stubs collection.
     *
     * @param array<string> $missing  Accumulated missing parent names (de-duplicated)
     * @param array<string> $visited  Visited node IDs/names (cycle guard)
     */
    private function collectMissingParents(PHPInterface $interface, StubDataQueryInterface $stubs, array &$missing, array &$visited): void
    {
        $nodeKey = $interface->getId() ?? $interface->getName();
        if ($nodeKey === null || in_array($nodeKey, $visited, true)) {
            return;
        }
        $visited[] = $nodeKey;

        foreach ($interface->getParentInterfaces() as $parent) {
            $parentId = $parent->getId();
            if ($parentId === null || $this->findInterfaceById($stubs, $parentId) === null) {
                // Unresolved: ClassHierarchyResolver could not find this parent in stubs.
                $parentName = $parent->getName() ?? ltrim((string)$parentId, '\\');
                if ($parentName !== '' && !in_array($parentName, $missing, true)) {
                    $missing[] = $parentName;
                }
            } else {
                // Resolved: recurse to check its own parents.
                $this->collectMissingParents($parent, $stubs, $missing, $visited);
            }
        }
    }
}
