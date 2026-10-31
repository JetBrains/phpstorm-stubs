<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Runner\RunnerScope;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Services\ExtensionPresenceService;
use StubTests\Framework\Validator\StaleEntityCheck;

/**
 * Validates that top-level entities declared in stubs exist in reflection for every PHP version
 * their @since/@removed range claims.
 *
 * Unlike the other validator tests, this one iterates stubs entities rather than reflection data:
 * an entity that is only in the stubs is exactly what it looks for. Only entities from extensions
 * that ship with PHP are yielded, and only for the versions their declarations claim.
 */
class StaleEntityValidatorTest extends ValidatorTestBase
{
    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    /**
     * @return iterable<string, array{string, string, string}>
     */
    public static function entityProvider(): iterable
    {
        $stubs = RunnerScope::get()->getStubs();
        $presence = new ExtensionPresenceService();

        foreach (static::getCheckDescriptors() as $checkName => $descriptor) {
            // Group version-split declarations by id; the check judges them together.
            $declarationsById = [];
            foreach ($presence->entitiesOfKind($stubs, $descriptor->entityTypeConfig->lookupKind) as $entity) {
                $entityId = $entity->getId();
                if ($entityId !== null && $presence->shipsWithPhp($entity)) {
                    $declarationsById[$entityId][] = $entity;
                }
            }

            $range = new PhpVersionRange($descriptor->fromVersion, $descriptor->toVersion);
            foreach (PhpVersions::cases() as $phpVersion) {
                $version = $phpVersion->value;
                if (!$range->includes($version)) {
                    continue;
                }

                foreach ($declarationsById as $entityId => $declarations) {
                    foreach ($declarations as $declaration) {
                        if ($declaration->getStubsMetadata()?->isAvailableIn($version) ?? true) {
                            yield static::buildTestName($checkName, $entityId, $version) => [$checkName, $entityId, $version];
                            break;
                        }
                    }
                }
            }
        }
    }

    protected static function getCheckDescriptors(): array
    {
        return [
            'checkStaleFunction' => new CheckDescriptor(StaleEntityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Function {entityId} is declared in stubs but does not exist in PHP {phpVersion}', EntityTypeConfig::forFunction()),
            'checkStaleClass' => new CheckDescriptor(StaleEntityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Class {entityId} is declared in stubs but does not exist in PHP {phpVersion}', EntityTypeConfig::forClass()),
            'checkStaleInterface' => new CheckDescriptor(StaleEntityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Interface {entityId} is declared in stubs but does not exist in PHP {phpVersion}', EntityTypeConfig::forInterface()),
            'checkStaleEnum' => new CheckDescriptor(StaleEntityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Enum {entityId} is declared in stubs but does not exist in PHP {phpVersion}', EntityTypeConfig::forEnum()),
            'checkStaleConstant' => new CheckDescriptor(StaleEntityCheck::class, PhpVersions::EARLIEST, PhpVersions::LATEST, 'Constant {entityId} is declared in stubs but does not exist in PHP {phpVersion}', EntityTypeConfig::forConstant()),
        ];
    }
}
