<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Validator\Services\ClassInterfaceFqnsExtractor;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

class ClassInterfacesCheck extends AbstractClassCheck
{
    private ClassInterfaceFqnsExtractor $fqnsExtractor;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?ClassInterfaceFqnsExtractor $fqnsExtractor = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->fqnsExtractor = $fqnsExtractor ?? new ClassInterfaceFqnsExtractor();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, 'ClassInterfacesCheck', $phpVersion)) {
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

        // PHP reflection reports ALL interfaces (including transitively inherited ones via both
        // parent classes and interface inheritance). Stubs only declare the interfaces that
        // a class introduces directly in its `implements` clause.
        //
        // We only check that stub-declared interfaces actually appear in reflection's full list.
        // The reverse (checking that every reflection interface appears in stubs) is not done
        // here because PHP reflection includes transitively inherited interfaces (e.g. Traversable
        // via Iterator) that stubs correctly omit from the `implements` clause.
        $reflectionAllIfaces = $this->fqnsExtractor->extract($reflectionClass);
        $stubIfaces = $this->fqnsExtractor->extract($stubClass);

        // Stubs should not declare interfaces absent from reflection's full list
        $spurious = array_diff($stubIfaces, $reflectionAllIfaces);
        if (!empty($spurious)) {
            sort($spurious);
            $results->addFailure(
                $entityId,
                "Interface mismatch for {$entityId}: stubs declare interface(s) not in reflection: " .
                implode(', ', $spurious)
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
