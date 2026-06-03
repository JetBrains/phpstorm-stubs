<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;
use StubTests\Framework\Validator\Services\EntityLookupService;

/**
 * Parameterized check that validates entity namespace in stubs matches
 * the namespace implied by its entity ID.
 *
 * Accepts either an EntityTypeConfig or raw LookupKind + label.
 * When used via CheckDescriptor, EntityTypeConfig is passed as a named argument.
 */
class EntityNamespaceCheck implements CheckInterface
{
    private readonly LookupKind $lookupKind;
    private readonly string $label;
    private EntityLookupService $entityLookup;

    public function __construct(
        ?LookupKind $lookupKind = null,
        ?string $label = null,
        ?EntityLookupService $entityLookup = null,
        ?EntityTypeConfig $entityTypeConfig = null,
    ) {
        if ($entityTypeConfig !== null) {
            $this->lookupKind = $entityTypeConfig->lookupKind;
            $this->label = $entityTypeConfig->label;
        } else {
            $this->lookupKind = $lookupKind ?? LookupKind::CLASS_TYPE;
            $this->label = $label ?? 'Class';
        }
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $entity = match ($this->lookupKind) {
            LookupKind::CLASS_TYPE => $this->entityLookup->findClassById($stubs, $entityId),
            LookupKind::ENUM_TYPE => $this->entityLookup->findEnumById($stubs, $entityId),
            LookupKind::INTERFACE_TYPE => $this->entityLookup->findInterfaceById($stubs, $entityId),
        };

        if ($entity === null) {
            $results->addFailure($entityId, "{$this->label} {$entityId} not found in stubs");
            return $results;
        }

        $stubNamespace = $entity->getNamespace();
        $expectedNamespace = $this->extractExpectedNamespace($entityId);

        if ($stubNamespace !== $expectedNamespace) {
            $label = strtolower($this->label);
            $results->addFailure(
                $entityId,
                "Namespace mismatch for {$label} {$entityId}: expected '" .
                ($expectedNamespace ?? '(no namespace)') .
                "', found '" .
                ($stubNamespace ?? '(no namespace)') .
                "' in stubs"
            );
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }

    private function extractExpectedNamespace(string $entityId): ?string
    {
        $lastBackslashPos = strrpos($entityId, '\\');
        if ($lastBackslashPos === false) {
            return null;
        }
        if ($lastBackslashPos === 0) {
            return '\\';
        }
        return substr($entityId, 0, $lastBackslashPos);
    }
}
