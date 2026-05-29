<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Base class for checks that compare a boolean method flag (e.g. isFinal, isStatic)
 * between reflection and stubs.
 *
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - describeMismatch(): returns a failure message when the flags differ, or null when they match
 */
abstract class AbstractMethodFlagCheck extends AbstractClassCheck
{
    abstract protected function getCheckName(): string;

    /**
     * Compare a flag on the reflection and stub method.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     *
     * @param mixed $reflMethod reflection method object
     */
    abstract protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string;

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

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label      = $this->getEntityLabel();

        $reflectionClass = $this->lookupEntityById($reflection, $entityId);
        if ($reflectionClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubClass = $this->lookupEntityById($stubs, $entityId);
        if ($stubClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        $stubMethodMap = $this->collectEntityMethodsByConfig($stubClass, $phpVersion);

        $hasMismatch = false;
        foreach ($reflectionClass->getMethods() as $reflMethod) {
            $name = $reflMethod->getName();
            if ($name === null || !isset($stubMethodMap[$name])) {
                // Null name or method absent from stubs — ClassMethodsExistCheck's responsibility
                continue;
            }

            $methodEntityId = $entityId . '::' . $name;
            $mismatchMessage = $this->describeMismatch($methodEntityId, $reflMethod, $stubMethodMap[$name], $phpVersion);

            if ($mismatchMessage === null) {
                continue;
            }

            $hasMismatch = true;
            if (!$this->skipWithKnownProblem($results, EntityType::METHOD->value, $methodEntityId, $this->getCheckName(), $phpVersion)) {
                $results->addFailure($methodEntityId, $mismatchMessage);
            }
        }

        if (!$hasMismatch) {
            $results->addSuccess($entityId);
        }

        return $results;
    }

}
