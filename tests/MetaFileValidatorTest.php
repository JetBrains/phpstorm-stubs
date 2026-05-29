<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Meta\MetaFileReferenceExtractor;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Runner\RunnerScope;
use StubTests\Framework\Validator\Meta\ConstantsReferenceExistsCheck;
use StubTests\Framework\Validator\Meta\ExpectedArgumentsAreUniqueCheck;
use StubTests\Framework\Validator\Meta\ExpectedReturnValuesAreUniqueCheck;
use StubTests\Framework\Validator\Meta\FunctionReferencesExistsCheck;
use StubTests\Framework\Validator\Meta\ReferencesAreFullyQualifiedCheck;
use StubTests\Framework\Validator\Meta\RegisteredArgumentsSetAreUniqueCheck;
use StubTests\Framework\Validator\Meta\RegisteredArgumentsSetExistsCheck;
use StubTests\Framework\Validator\Meta\MetaInternalTagCheck;
use StubTests\Framework\Validator\Meta\StringLiteralsSingleQuotedCheck;

class MetaFileValidatorTest extends TestCase
{
    private static function getRootDir(): string
    {
        return dirname(__DIR__);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function functionReferenceProvider(): iterable
    {
        $rootDir = self::getRootDir();
        $refs = (new MetaFileReferenceExtractor())->extractCallableRefs($rootDir);
        foreach ($refs as $ref) {
            yield $ref->type->value . ':' . $ref->fqn => [$ref->toEntityId()];
        }
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function constantReferenceProvider(): iterable
    {
        $rootDir = self::getRootDir();
        $refs = (new MetaFileReferenceExtractor())->extractConstantRefs($rootDir);
        foreach ($refs as $ref) {
            yield $ref->type->value . ':' . $ref->fqn => [$ref->toEntityId()];
        }
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function argumentsSetUsageProvider(): iterable
    {
        $rootDir = self::getRootDir();
        $usages = (new MetaFileReferenceExtractor())->extractArgumentsSetUsages($rootDir);
        foreach ($usages as $name) {
            yield $name => [$name];
        }
    }

    #[DataProvider('functionReferenceProvider')]
    public function testFunctionReferenceExistsInStubs(string $entityId): void
    {
        $stubs = RunnerScope::get()->getStubs();
        $check = new FunctionReferencesExistsCheck();
        $results = $check->run($stubs, $entityId, PhpVersions::LATEST->value);

        $failures = $results->getFailures();
        $this->assertEmpty(
            $failures,
            "Meta function/method reference not found in stubs:\n" . implode("\n", $failures)
        );
    }

    #[DataProvider('constantReferenceProvider')]
    public function testConstantReferenceExistsInStubs(string $entityId): void
    {
        $stubs = RunnerScope::get()->getStubs();
        $check = new ConstantsReferenceExistsCheck();
        $results = $check->run($stubs, $entityId, PhpVersions::LATEST->value);

        $failures = $results->getFailures();
        $this->assertEmpty(
            $failures,
            "Meta constant reference not found in stubs:\n" . implode("\n", $failures)
        );
    }

    #[DataProvider('argumentsSetUsageProvider')]
    public function testRegisteredArgumentsSetExists(string $setName): void
    {
        $rootDir = self::getRootDir();
        $extractor = new MetaFileReferenceExtractor();
        $definitions = $extractor->extractArgumentsSetDefinitions($rootDir);

        $stubs = RunnerScope::get()->getStubs();
        $check = new RegisteredArgumentsSetExistsCheck($definitions);
        $results = $check->run($stubs, $setName, PhpVersions::LATEST->value);

        $failures = $results->getFailures();
        $this->assertEmpty(
            $failures,
            "argumentsSet reference not found:\n" . implode("\n", $failures)
        );
    }

    public function testStringLiteralsUseSingleQuotes(): void
    {
        $check = new StringLiteralsSingleQuotedCheck();
        $violations = $check->check(self::getRootDir());

        $this->assertEmpty(
            $violations,
            "Double-quoted strings found in meta files:\n" . implode("\n", $violations)
        );
    }

    public function testExpectedArgumentsAreUnique(): void
    {
        $check = new ExpectedArgumentsAreUniqueCheck();
        $violations = $check->check(self::getRootDir());

        $this->assertEmpty(
            $violations,
            "Duplicate expectedArguments registrations found:\n" . implode("\n", $violations)
        );
    }

    public function testExpectedReturnValuesAreUnique(): void
    {
        $check = new ExpectedReturnValuesAreUniqueCheck();
        $violations = $check->check(self::getRootDir());

        $this->assertEmpty(
            $violations,
            "Duplicate expectedReturnValues registrations found:\n" . implode("\n", $violations)
        );
    }

    public function testRegisteredArgumentsSetAreUnique(): void
    {
        $check = new RegisteredArgumentsSetAreUniqueCheck();
        $violations = $check->check(self::getRootDir());

        $this->assertEmpty(
            $violations,
            "Duplicate registerArgumentsSet definitions found:\n" . implode("\n", $violations)
        );
    }

    public function testReferencesAreFullyQualified(): void
    {
        $check = new ReferencesAreFullyQualifiedCheck();
        $violations = $check->check(self::getRootDir());

        $this->assertEmpty(
            $violations,
            "Non-fully-qualified references found in meta files:\n" . implode("\n", $violations)
        );
    }

    public function testMetaInternalTagConsistency(): void
    {
        $check = new MetaInternalTagCheck();
        $violations = $check->check(self::getRootDir());

        $this->assertEmpty(
            $violations,
            "Inconsistency between @meta phpdoc tags and override() entries:\n" . implode("\n", $violations)
        );
    }
}
