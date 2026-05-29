<?php

namespace StubTests\Framework\Validator\Meta;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;

final class RegisteredArgumentsSetExistsCheck implements CheckInterface
{
    /** @var array<string, true> */
    private array $definedSets;

    /**
     * @param string[] $definedSetNames
     */
    public function __construct(array $definedSetNames)
    {
        $this->definedSets = array_fill_keys($definedSetNames, true);
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if (isset($this->definedSets[$entityId])) {
            $results->addSuccess($entityId);
        } else {
            $results->addFailure(
                $entityId,
                "argumentsSet('{$entityId}') references a set that was never registered via registerArgumentsSet()"
            );
        }

        return $results;
    }
}
