<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Constants\ConstantExistsCheck;
use StubTests\Framework\Validator\Constants\ConstantValueCheck;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;
use StubTests\ValidatorTestBase;

/**
 * Validates that global constants from reflection exist in stubs.
 *
 * Each constant is tested individually as a separate test case,
 * making it easy to identify failures and re-run specific tests.
 */
class ConstantValidatorTest extends ValidatorTestBase
{
    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    protected static function getEntitiesForMethod(string $methodName, StubDataQueryInterface $reflection): iterable
    {
        return $reflection->getConstants();
    }

    protected static function getCheckDescriptors(): array
    {
        return [
            'checkConstantExists' => new CheckDescriptor(ConstantExistsCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Constant {entityId} exists in PHP {phpVersion} but not in stubs'),
            'checkConstantValue' => new CheckDescriptor(ConstantValueCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Constant {entityId} value mismatch in PHP {phpVersion}'),
        ];
    }
}
