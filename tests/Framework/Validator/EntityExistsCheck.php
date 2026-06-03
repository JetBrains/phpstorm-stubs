<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;

/**
 * Parameterized check that validates an entity from reflection exists in stubs.
 *
 * Accepts either an EntityTypeConfig or raw LookupKind + label.
 * When used via CheckDescriptor, EntityTypeConfig is passed as a named argument.
 */
class EntityExistsCheck implements CheckInterface
{
    private readonly LookupKind $lookupKind;
    private readonly string $label;

    public function __construct(
        ?LookupKind $lookupKind = null,
        ?string $label = null,
        ?EntityTypeConfig $entityTypeConfig = null,
    ) {
        if ($entityTypeConfig !== null) {
            $this->lookupKind = $entityTypeConfig->lookupKind;
            $this->label = $entityTypeConfig->label;
        } else {
            $this->lookupKind = $lookupKind ?? LookupKind::CLASS_TYPE;
            $this->label = $label ?? 'Class';
        }
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $exists = match ($this->lookupKind) {
            LookupKind::CLASS_TYPE => $stubs->hasClass($entityId),
            LookupKind::ENUM_TYPE => $stubs->hasEnum($entityId),
            LookupKind::INTERFACE_TYPE => $stubs->hasInterface($entityId),
        };

        if (!$exists) {
            $results->addFailure($entityId, "{$this->label} {$entityId} exists in PHP {$phpVersion} but not in stubs");
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
