<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Validates that the `abstract` modifier on a class in stubs matches reflection.
 */
class ClassAbstractCheck extends AbstractClassCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, CheckType::CLASS_ABSTRACT, $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label = $this->getEntityLabel();

        $reflClass = $this->lookupEntityById($reflection, $entityId);
        if ($reflClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubClass = $this->lookupEntityById($stubs, $entityId);
        if ($stubClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        $reflIsAbstract = $reflClass->isAbstract();
        $stubIsAbstract = $stubClass->isAbstract();

        if ($reflIsAbstract === $stubIsAbstract) {
            $results->addSuccess($entityId);
        } else {
            $expected = $reflIsAbstract ? 'abstract' : 'non-abstract';
            $actual = $stubIsAbstract ? 'abstract' : 'non-abstract';
            $results->addFailure(
                $entityId,
                "{$label} {$entityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs"
            );
        }

        return $results;
    }
}
