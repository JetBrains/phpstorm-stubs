<?php

namespace StubTests\Framework\Validator\Enums;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Validates that all enum cases present in reflection also exist in stubs.
 *
 * Direction: reflection → stubs (missing stub cases are reported as failures).
 * Extra cases in stubs not present in reflection are not checked here.
 *
 * Known problems are supported at enum level:
 *  - EntityType::ENUM_TYPE + enumId + 'EnumCasesCheck' → skips the entire enum.
 */
class EnumCasesCheck extends AbstractClassCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::ENUM_TYPE->value, $entityId, 'EnumCasesCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);

        $reflEnum = $this->findEnumById($reflection, $entityId);
        if ($reflEnum === null) {
            $results->addFailure($entityId, "Enum {$entityId} not found in reflection data");
            return $results;
        }

        $stubEnum = $this->findEnumById($stubs, $entityId);
        if ($stubEnum === null) {
            $results->addFailure($entityId, "Enum {$entityId} not found in stubs");
            return $results;
        }

        $stubCases = array_flip($stubEnum->getCaseNames());

        $missing = [];
        foreach ($reflEnum->getCaseNames() as $caseName) {
            if (!isset($stubCases[$caseName])) {
                $missing[] = $caseName;
            }
        }

        if (!empty($missing)) {
            $results->addFailure(
                $entityId,
                "Enum {$entityId} is missing case(s) in stubs: " . implode(', ', $missing)
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
