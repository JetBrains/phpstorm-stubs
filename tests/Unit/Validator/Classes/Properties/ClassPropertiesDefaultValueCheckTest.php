<?php

namespace StubTests\Unit\Validator\Classes\Properties;

use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Properties\ClassPropertiesDefaultValueCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassPropertiesDefaultValueCheckTest extends CheckTestCase
{
    private const CLASS_NAME = '\MyClass';

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    public function testSupportsOnlyLatestVersion(): void
    {
        $check = new ClassPropertiesDefaultValueCheck();

        $this->assertFalse($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testMatchingDefaultsPass(): void
    {
        $result = $this->runCheck($this->propertyWithDefault('code', 0), $this->propertyWithDefault('code', 0));

        $this->assertFalse($result->hasFailures());
    }

    public function testDifferentDefaultsAreFailure(): void
    {
        $result = $this->runCheck($this->propertyWithDefault('code', 0), $this->propertyWithDefault('code', null));

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[self::CLASS_NAME . '::$code'];
        $this->assertStringContainsString('defaults to 0', $message);
        $this->assertStringContainsString('to null in stubs', $message);
    }

    public function testMissingStubDefaultIsFailure(): void
    {
        $result = $this->runCheck($this->propertyWithDefault('value', null), $this->makeProperty('value'));

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('has no default in stubs', $result->getFailures()[self::CLASS_NAME . '::$value']);
    }

    public function testStubDefaultWithoutReflectionDefaultPasses(): void
    {
        // PHP declares some properties without a default that stubs document with their runtime value
        $result = $this->runCheck($this->makeProperty('preserveWhiteSpace'), $this->propertyWithDefault('preserveWhiteSpace', true));

        $this->assertFalse($result->hasFailures());
    }

    public function testUnresolvedStubDefaultIsSkipped(): void
    {
        $stubProperty = $this->propertyWithDefault('flags', null);
        $stubProperty->setDefaultValueResolved(false);

        $result = $this->runCheck($this->propertyWithDefault('flags', 4), $stubProperty);

        $this->assertFalse($result->hasFailures());
    }

    public function testKnownProblemSkipsProperty(): void
    {
        $knownProblemsProvider = $this->createStub(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::PROPERTY,
                entityId: self::CLASS_NAME . '::$code',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_PROPERTIES_DEFAULT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Property-level skip'
            ),
        ]);
        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $result = $this->runCheck($this->propertyWithDefault('code', 0), $this->propertyWithDefault('code', null), $registry);

        $this->assertFalse($result->hasFailures());
    }

    private function propertyWithDefault(string $name, mixed $default): PHPProperty
    {
        $property = $this->makeProperty($name);
        $property->setDefaultValue($default);
        return $property;
    }

    private function runCheck(PHPProperty $reflProperty, PHPProperty $stubProperty, ?KnownProblemsRegistry $registry = null): CheckResultSet
    {
        $reflClass = $this->createMockClassWithProperties(self::CLASS_NAME, null, null, null, [], null, [], [$reflProperty]);
        $stubClass = $this->createMockClassWithProperties(self::CLASS_NAME, null, null, null, [], null, [], [$stubProperty]);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        return (new ClassPropertiesDefaultValueCheck($provider, $registry))->run($stubs, self::CLASS_NAME, PhpVersions::LATEST->value);
    }
}
