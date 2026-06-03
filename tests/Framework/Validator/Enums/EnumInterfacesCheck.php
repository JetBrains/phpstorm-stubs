<?php

namespace StubTests\Framework\Validator\Enums;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Services\ClassInterfaceFqnsExtractor;

/**
 * Validates that interfaces declared on an enum in stubs match reflection.
 *
 * PHP reflection reports ALL interfaces (including transitively inherited ones via
 * interface inheritance). Stubs only declare the interfaces that an enum introduces
 * directly in its `implements` clause.
 *
 * We only check that stub-declared interfaces appear in reflection's full list.
 * The reverse is not enforced because PHP reflection includes transitively inherited
 * interfaces that stubs correctly omit.
 *
 * Known problems are supported at enum level:
 * - EntityType::ENUM_TYPE + enumId + 'EnumInterfacesCheck'
 *   → skips the check entirely for the named enum.
 */
class EnumInterfacesCheck extends AbstractClassCheck
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

        if ($this->skipWithKnownProblem($results, EntityType::ENUM_TYPE->value, $entityId, 'EnumInterfacesCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);

        $reflectionEnum = $this->findEnumById($reflection, $entityId);
        if ($reflectionEnum === null) {
            $results->addFailure($entityId, "Enum {$entityId} not found in reflection data");
            return $results;
        }

        $stubEnum = $this->findEnumById($stubs, $entityId);
        if ($stubEnum === null) {
            $results->addFailure($entityId, "Enum {$entityId} not found in stubs");
            return $results;
        }

        $reflectionAllIfaces = $this->fqnsExtractor->extract($reflectionEnum);
        $stubIfaces = $this->fqnsExtractor->extract($stubEnum);

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
