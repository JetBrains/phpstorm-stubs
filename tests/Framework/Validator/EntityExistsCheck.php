<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\EntityLookupService;

/**
 * Validates that a top-level entity present in reflection also exists in stubs.
 *
 * Config-driven across function / class / enum / interface via EntityTypeConfig: it always
 * reports the check name 'EntityExistsCheck', and the entity variant is distinguished by the
 * EntityType passed to the known-problem lookup. (Global constants use ConstantExistsCheck;
 * member existence is handled by the *MethodsExist / *PropertiesExist / EnumCases checks.)
 */
class EntityExistsCheck extends AbstractReflectionCheck
{
    private LookupKind $lookupKind;
    private string $label;
    private EntityType $entityType;
    private EntityLookupService $entityLookup;

    public function __construct(
        ?EntityTypeConfig $entityTypeConfig = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?EntityLookupService $entityLookup = null,
    ) {
        parent::__construct(null, $knownProblemsRegistry);
        $config = $entityTypeConfig ?? EntityTypeConfig::forClass();
        $this->lookupKind = $config->lookupKind;
        $this->label = $config->label;
        $this->entityType = $config->entityType;
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->entityType->value, $entityId, 'EntityExistsCheck', $phpVersion)) {
            return $results;
        }

        $exists = match ($this->lookupKind) {
            LookupKind::CLASS_TYPE => $stubs->hasClass($entityId),
            LookupKind::ENUM_TYPE => $stubs->hasEnum($entityId),
            LookupKind::INTERFACE_TYPE => $stubs->hasInterface($entityId),
            LookupKind::FUNCTION => $this->entityLookup->findFunctionById($stubs, $entityId) !== null,
        };

        if (!$exists) {
            $results->addFailure($entityId, "{$this->label} {$entityId} exists in PHP {$phpVersion} but not in stubs");
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
