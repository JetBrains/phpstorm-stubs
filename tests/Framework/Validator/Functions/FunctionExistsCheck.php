<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Services\EntityLookupService;

/**
 * Validates that functions from reflection exist in stubs.
 */
class FunctionExistsCheck implements CheckInterface
{
    private EntityLookupService $entityLookup;

    public function __construct(?EntityLookupService $entityLookup = null)
    {
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->entityLookup->findFunctionById($stubs, $entityId) !== null) {
            $results->addSuccess($entityId);
        } else {
            $results->addFailure(
                $entityId,
                "Function {$entityId} exists in PHP {$phpVersion} but not in stubs"
            );
        }

        return $results;
    }
}
