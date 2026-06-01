<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;

/**
 * Base for entity-level final-flag checks.
 *
 * Compares the `isFinal` property of an entity in stubs against its reflection
 * counterpart and reports a failure on any mismatch.
 *
 * Pass an EntityTypeConfig to target a different entity type (e.g. enums);
 * the defaults work for classes.
 */
abstract class AbstractFinalCheck extends AbstractClassCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    /**
     * Template method: check name for known-problem lookups.
     */
    protected function getCheckName(): string
    {
        return 'ClassFinalCheck';
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, $this->getCheckName(), $phpVersion)) {
            return $results;
        }

        $label = $this->getEntityLabel();
        $reflection = $this->reflectionProvider->getReflection($phpVersion);

        $reflEntity = $this->lookupEntityById($reflection, $entityId);
        if ($reflEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubEntity = $this->lookupEntityById($stubs, $entityId);
        if ($stubEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        $reflIsFinal = $reflEntity->isFinal();
        $stubIsFinal = $stubEntity->isFinal();

        if ($reflIsFinal === $stubIsFinal) {
            $results->addSuccess($entityId);
        } else {
            $expected = $reflIsFinal ? 'final' : 'non-final';
            $actual = $stubIsFinal ? 'final' : 'non-final';
            $results->addFailure(
                $entityId,
                "{$label} {$entityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs"
            );
        }

        return $results;
    }
}
