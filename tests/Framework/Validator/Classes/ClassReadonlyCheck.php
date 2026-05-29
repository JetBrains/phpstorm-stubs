<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
/**
 * Validates that the `readonly` modifier on a class in stubs matches reflection.
 */
class ClassReadonlyCheck extends AbstractClassCheck
{
    public function supports(string $phpVersion): bool
    {
        // Readonly classes were introduced in PHP 8.2
        return version_compare($phpVersion, '8.2', '>=');
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, 'ClassReadonlyCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label      = $this->getEntityLabel();

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

        $reflIsReadonly = $reflClass->isReadonly();
        $stubIsReadonly = $stubClass->isReadonly();

        if ($reflIsReadonly === $stubIsReadonly) {
            $results->addSuccess($entityId);
        } else {
            $expected = $reflIsReadonly ? 'readonly' : 'non-readonly';
            $actual   = $stubIsReadonly ? 'readonly' : 'non-readonly';
            $results->addFailure(
                $entityId,
                "{$label} {$entityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs"
            );
        }

        return $results;
    }
}
