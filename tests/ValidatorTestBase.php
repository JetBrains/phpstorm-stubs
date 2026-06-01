<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Runner\RunnerScope;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;
use StubTests\Framework\Validator\Contracts\CheckInterface;
use StubTests\Framework\Validator\Contracts\StubsProviderInterface;
use StubTests\Framework\Validator\RunnerStubsProvider;

/**
 * Abstract base class for validator tests.
 *
 * Provides common functionality for:
 * - Building data providers from PHP version ranges
 * - Loading reflection and stub data
 * - Running validation checks
 * - Asserting results
 *
 * Subclasses can register checks in one of two ways:
 *
 * 1. **Declarative (preferred):** Override getCheckDescriptors() to return
 *    an array mapping check names to [checkClass, fromVersion, toVersion, messageTemplate].
 *    The base entityProvider() and testEntity() handle everything automatically.
 *
 * 2. **Attribute-based (legacy):** Define individual methods annotated with
 *    #[PhpVersionRange] that call executeCheck(). Used when custom entityProvider
 *    or non-standard dispatch logic is needed (e.g. PhpDocValidatorTest).
 */
abstract class ValidatorTestBase extends TestCase
{
    private StubsProviderInterface $stubsProvider;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stubsProvider = new RunnerStubsProvider();
    }

    /**
     * Return check descriptors for declarative test registration.
     *
     * Each entry maps a logical check name to a CheckDescriptor.
     *
     * @return array<string, CheckDescriptor>
     */
    protected static function getCheckDescriptors(): array
    {
        return [];
    }

    /**
     * Generic data provider that yields [checkName, entityId, phpVersion] for each entity.
     *
     * When getCheckDescriptors() returns entries, iterates those descriptors.
     * Otherwise falls back to scanning methods for PhpVersionRange attributes.
     *
     * @return iterable<string, array{string, string, string}>
     */
    public static function entityProvider(): iterable
    {
        $descriptors = static::getCheckDescriptors();

        if (!empty($descriptors)) {
            yield from static::yieldFromDescriptors($descriptors);
            return;
        }

        yield from static::yieldFromAttributes();
    }

    /**
     * Yield test cases from declarative check descriptors.
     */
    private static function yieldFromDescriptors(array $descriptors): iterable
    {
        foreach ($descriptors as $checkName => $descriptor) {
            $range = new PhpVersionRange($descriptor->fromVersion, $descriptor->toVersion);

            foreach (PhpVersions::cases() as $phpVersion) {
                $version = $phpVersion->value;
                if (!$range->includes($version)) {
                    continue;
                }

                $reflection = RunnerScope::get()->getReflection($version);
                foreach (static::getEntitiesForMethod($checkName, $reflection) as $entity) {
                    $entityId = static::getEntityId($entity);
                    $testName = static::buildTestName($checkName, $entityId, $version);
                    yield $testName => [$checkName, $entityId, $version];
                }
            }
        }
    }

    /**
     * Yield test cases by scanning methods for PhpVersionRange attributes (legacy mode).
     */
    private static function yieldFromAttributes(): iterable
    {
        $reflector = new ReflectionClass(static::class);

        foreach ($reflector->getMethods() as $method) {
            $attrs = $method->getAttributes(PhpVersionRange::class);
            if (empty($attrs)) {
                continue;
            }

            foreach ($attrs as $attr) {
                /** @var PhpVersionRange $range */
                $range = $attr->newInstance();

                foreach (PhpVersions::cases() as $phpVersion) {
                    $version = $phpVersion->value;
                    if (!$range->includes($version)) {
                        continue;
                    }

                    $reflection = RunnerScope::get()->getReflection($version);
                    $entities = static::getEntitiesForMethod($method->getName(), $reflection);

                    foreach ($entities as $entity) {
                        $entityId = static::getEntityId($entity);
                        $testName = static::buildTestName($method->getName(), $entityId, $version);
                        yield $testName => [$method->getName(), $entityId, $version];
                    }
                }
            }
        }
    }

    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        // Declarative mode: look up check from descriptors
        $descriptors = static::getCheckDescriptors();
        if (isset($descriptors[$methodName])) {
            $descriptor = $descriptors[$methodName];
            $checkClass = $descriptor->checkClass;
            $check = $descriptor->entityTypeConfig !== null
                ? new $checkClass(entityTypeConfig: $descriptor->entityTypeConfig)
                : new $checkClass();
            $message = str_replace(
                ['{entityId}', '{phpVersion}'],
                [$entityId, $phpVersion],
                $descriptor->messageTemplate
            );
            $this->executeCheck($check, $entityId, $phpVersion, $message);
            return;
        }

        // Attribute-based mode: direct method dispatch
        if (!method_exists($this, $methodName)) {
            $this->fail("Method {$methodName} does not exist in " . static::class);
        }

        $this->$methodName($entityId, $phpVersion);
    }

    /**
     * Get entities to test based on the method name.
     * Subclasses should override to return specific entity types.
     *
     * @param string $methodName
     * @param \StubTests\Framework\Parsers\StubDataQueryInterface $reflection
     * @return iterable
     */
    protected static function getEntitiesForMethod(string $methodName, StubDataQueryInterface $reflection): iterable
    {
        return [];
    }

    /**
     * Get the unique identifier for an entity.
     *
     * @param mixed $entity
     * @return string
     */
    protected static function getEntityId($entity): string
    {
        if (method_exists($entity, 'getId')) {
            return $entity->getId();
        }

        if (method_exists($entity, 'getName')) {
            return $entity->getName();
        }

        return (string)$entity;
    }

    /**
     * Build a unique test name from method, entity, and version.
     *
     * @param string $methodName
     * @param string $entityId
     * @param string $phpVersion
     * @return string
     */
    protected static function buildTestName(string $methodName, string $entityId, string $phpVersion): string
    {
        $sanitizedId = str_replace(['/', ':', ' '], '_', str_replace('\\', '.', $entityId));
        return "{$methodName}_{$sanitizedId}_{$phpVersion}";
    }

    /**
     * Execute a validation check and assert results.
     *
     * @param CheckInterface $check The validation check to run
     * @param string $entityId The entity identifier
     * @param string $phpVersion The PHP version
     * @param string|null $customMessage Optional custom assertion message
     */
    protected function executeCheck(
        CheckInterface $check,
        string $entityId,
        string $phpVersion,
        ?string $customMessage = null
    ): void {
        // Skip if check doesn't support this PHP version
        if (!$check->supports($phpVersion)) {
            $this->markTestSkipped(
                get_class($check) . " does not support PHP {$phpVersion}"
            );
        }

        $stubs = $this->stubsProvider->getStubs();
        $results = $check->run($stubs, $entityId, $phpVersion);

        $failures = $results->getFailures();
        $message = $customMessage ?? "PHP {$phpVersion}: Validation failed for {$entityId}";

        $this->assertEmpty(
            $failures,
            $message . "\n" . implode("\n", $failures)
        );
    }
}
