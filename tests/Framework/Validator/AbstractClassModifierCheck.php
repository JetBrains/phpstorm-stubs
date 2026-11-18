<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Base for checks that compare one class-level modifier (final, readonly, abstract) of an
 * entity in stubs against its reflection counterpart and report a failure on any mismatch.
 *
 * Pass an EntityTypeConfig to target a different entity type (e.g. enums);
 * the defaults work for classes.
 */
abstract class AbstractClassModifierCheck extends AbstractClassCheck
{
    /**
     * The modifier keyword, used in failure messages.
     */
    abstract protected function modifier(): string;

    abstract protected function hasModifier(PHPClassLikeObject $entity): bool;

    /**
     * Check name for known-problem lookups.
     */
    abstract protected function getCheckName(): CheckType;

    public function supports(string $phpVersion): bool
    {
        return true;
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

        $reflHasModifier = $this->hasModifier($reflEntity);
        $stubHasModifier = $this->hasModifier($stubEntity);

        if ($reflHasModifier === $stubHasModifier) {
            $results->addSuccess($entityId);
        } else {
            $modifier = $this->modifier();
            $expected = $reflHasModifier ? $modifier : "non-{$modifier}";
            $actual = $stubHasModifier ? $modifier : "non-{$modifier}";
            $results->addFailure(
                $entityId,
                "{$label} {$entityId} is {$expected} in PHP {$phpVersion} but {$actual} in stubs"
            );
        }

        return $results;
    }
}
