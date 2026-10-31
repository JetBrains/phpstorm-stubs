<?php

namespace StubTests\Framework\Validator\KnownProblems;

/**
 * One case of a validator suite: a ValidatorTestBase test method with one data set from its
 * data provider, which names the check, the entity and the PHP version.
 */
final readonly class ValidatorSuiteCase
{
    /**
     * @param string $testClass The ValidatorTestBase subclass
     * @param string $testMethod The PHPUnit test method, e.g. testEntity
     * @param string $checkName The check the data set selects (a descriptor key or check method)
     * @param string $entityId The entity the check validates, e.g. '\PDO' or '\strlen'
     * @param string $phpVersion The PHP version it is validated against
     */
    public function __construct(
        public string $testClass,
        public string $testMethod,
        public string $checkName,
        public string $entityId,
        public string $phpVersion,
    ) {}

    public function getName(): string
    {
        $shortClass = substr(strrchr('\\' . $this->testClass, '\\'), 1);

        return "{$shortClass} {$this->checkName} {$this->entityId} PHP {$this->phpVersion}";
    }
}
