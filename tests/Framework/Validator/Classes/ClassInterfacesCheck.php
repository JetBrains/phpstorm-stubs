<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\ClassInterfaceFqnsExtractor;

/**
 * Validates that directly implemented interfaces in stubs match reflection.
 *
 * Entity-agnostic: reused for classes and enums via EntityTypeConfig. The check
 * always reports the name 'ClassInterfacesCheck', so known problems for enums are
 * keyed by (ENUM_TYPE, ClassInterfacesCheck) — the entity variant is distinguished
 * by the EntityType of the known problem, not by a separate check name.
 */
class ClassInterfacesCheck extends AbstractClassCheck
{
    private ClassInterfaceFqnsExtractor $fqnsExtractor;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?ClassInterfaceFqnsExtractor $fqnsExtractor = null,
        ?EntityTypeConfig $entityTypeConfig = null
    ) {
        parent::__construct(
            reflectionProvider: $reflectionProvider,
            knownProblemsRegistry: $knownProblemsRegistry,
            entityTypeConfig: $entityTypeConfig
        );
        $this->fqnsExtractor = $fqnsExtractor ?? new ClassInterfaceFqnsExtractor();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, CheckType::CLASS_INTERFACES, $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label = $this->getEntityLabel();

        $reflectionEntity = $this->lookupEntityById($reflection, $entityId);
        if ($reflectionEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubEntity = $this->lookupEntityById($stubs, $entityId);
        if ($stubEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        // PHP reflection reports ALL interfaces (including transitively inherited ones via both
        // parent classes and interface inheritance). Stubs only declare the interfaces that
        // an entity introduces directly in its `implements` clause.
        //
        // We only check that stub-declared interfaces actually appear in reflection's full list.
        // The reverse (checking that every reflection interface appears in stubs) is not done
        // here because PHP reflection includes transitively inherited interfaces (e.g. Traversable
        // via Iterator) that stubs correctly omit from the `implements` clause.
        $reflectionAllIfaces = $this->fqnsExtractor->extract($reflectionEntity);
        $stubIfaces = $this->fqnsExtractor->extract($stubEntity);

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
