<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Validator\Services\ClassAncestorNamesExtractor;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

class ClassParentClassCheck extends AbstractClassCheck
{
    private ClassAncestorNamesExtractor $ancestorExtractor;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?ClassAncestorNamesExtractor $ancestorExtractor = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->ancestorExtractor = $ancestorExtractor ?? new ClassAncestorNamesExtractor();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, 'ClassParentClassCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label = $this->getEntityLabel();

        $reflectionClass = $this->lookupEntityById($reflection, $entityId);
        if (!$reflectionClass instanceof PHPClass) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubClass = $this->lookupEntityById($stubs, $entityId);
        if (!$stubClass instanceof PHPClass) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        // Get parent class FQN reported by reflection.
        // After ClassHierarchyResolver links the parent stub to the actual PHPClass object,
        // getName() returns only the short name (e.g. "RandomError"), while getId() carries
        // the full namespace (e.g. "\Random\RandomError"). We strip the leading \ to match
        // the format that getAncestorClassNames() returns for the stubs side.
        // If the parent stub is unlinked (getId() is null), we fall back to getName() which
        // holds the original stored name from the cache (already FQN for reflection data).
        $reflectionParentObj = $reflectionClass->getParentClass();
        if ($reflectionParentObj === null) {
            $reflectionParentName = null;
        } else {
            $id = $reflectionParentObj->getId();
            $reflectionParentName = $id !== null ? ltrim($id, '\\') : $reflectionParentObj->getName();
        }

        // Both have no parent — valid
        if ($reflectionParentName === null && $stubClass->getParentClass() === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        // Reflection has no parent but stubs declare one — mismatch
        if ($reflectionParentName === null) {
            $stubDirectParentName = $stubClass->getParentClass()->getName();
            $results->addFailure(
                $entityId,
                "Parent class mismatch for {$entityId}: reflection has no parent, stubs have '{$stubDirectParentName}'"
            );
            return $results;
        }

        // Check whether the reflection parent appears anywhere in the stubs' full ancestor chain.
        // ClassHierarchyResolver ensures that parentClass references are linked to the actual
        // PHPClass objects, so the extractor can traverse the complete hierarchy
        // (e.g. ParseError → CompileError → Error) without any additional lookups here.
        $stubAncestors = $this->ancestorExtractor->extract($stubClass);
        if (in_array($reflectionParentName, $stubAncestors, true)) {
            $results->addSuccess($entityId);
            return $results;
        }

        $stubDirectParentName = $stubClass->getParentClass() !== null
            ? $stubClass->getParentClass()->getName()
            : '(none)';

        $results->addFailure(
            $entityId,
            "Parent class mismatch for {$entityId}: reflection has '{$reflectionParentName}', " .
            "stubs have '{$stubDirectParentName}'"
        );

        return $results;
    }
}
