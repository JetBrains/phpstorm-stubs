<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Base class for checks that compare a boolean property flag (e.g. isStatic, visibility)
 * between reflection and stubs.
 *
 * Currently supports PHPClass entities only. Properties are class-specific
 * in the model (PHPEnum/PHPInterface do not have getProperties()).
 *
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - describeMismatch(): returns a failure message when the flags differ, or null when they match
 */
abstract class AbstractPropertyFlagCheck extends AbstractClassCheck
{
    abstract protected function getCheckName(): string;

    /**
     * Compare a flag on the reflection and stub property.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     */
    abstract protected function describeMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string;

    protected function findEntity(StubDataQueryInterface $storage, string $entityId): ?PHPClass
    {
        return $this->findClassById($storage, $entityId);
    }

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

        $reflectionClass = $this->findEntity($reflection, $entityId);
        if ($reflectionClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubClass = $this->findEntity($stubs, $entityId);
        if ($stubClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        $stubPropertyMap = $this->methodCollection->collectPropertiesForClass($stubClass, $phpVersion);

        $hasMismatch = false;
        foreach ($reflectionClass->getProperties() as $reflProperty) {
            $name = $reflProperty->getName();
            if ($name === null || !isset($stubPropertyMap[$name])) {
                // Null name or property absent from stubs — ClassPropertiesExistCheck's responsibility
                continue;
            }

            $propertyEntityId = $entityId . '::$' . $name;
            $mismatchMessage = $this->describeMismatch($propertyEntityId, $reflProperty, $stubPropertyMap[$name], $phpVersion);

            if ($mismatchMessage === null) {
                continue;
            }

            $hasMismatch = true;
            if (!$this->skipWithKnownProblem($results, EntityType::PROPERTY->value, $propertyEntityId, $this->getCheckName(), $phpVersion)) {
                $results->addFailure($propertyEntityId, $mismatchMessage);
            }
        }

        if (!$hasMismatch) {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
