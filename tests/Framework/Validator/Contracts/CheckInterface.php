<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Parsers\StubDataQueryInterface;

interface CheckInterface
{
    public function supports(string $phpVersion): bool;

    /**
     * @param StubDataQueryInterface $stubs Parsed stubs data
     * @param string $entityId Entity identifier to validate
     * @param string $phpVersion PHP version string
     * @return CheckResultSet
     */
    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet;
}
