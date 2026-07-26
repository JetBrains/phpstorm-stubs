<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\CheckDescriptor;

/**
 * Guards the two places PHP-version applicability is expressed against each other.
 *
 * Version gating is stated twice: declaratively by each `CheckDescriptor`'s
 * from/to range, and imperatively by the check's own `supports()`. Nothing in the
 * type system ties them together, so a registration can ask for a version its
 * check refuses. Before ValidatorTestBase was changed to fail on that, the
 * mismatch surfaced as a *skipped* test — invisible in a green run.
 *
 * These tests catch the disagreement in the unit suite, in milliseconds, instead
 * of leaving it to a 20-plus-minute integration run. They deliberately do not
 * assert the two are identical: a descriptor narrower than its check's gate is
 * legitimate (a check may be meaningful from 8.0 while only being scheduled for
 * the latest version). Only the reverse — a descriptor reaching beyond what the
 * check supports — is a defect.
 *
 * Scope limit: only declarative CheckDescriptor registrations are covered. The
 * attribute-based mode (#[PhpVersionRange] on a check* method) instantiates its
 * check inline in the method body, so its registrations cannot be enumerated
 * without parsing those bodies. That mode is currently limited to three call
 * sites in PhpDocValidatorTest, all on checks whose supports() is
 * unconditionally true, so it cannot drift today — and if it ever does,
 * ValidatorTestBase::executeCheck() fails rather than skipping, so the mismatch
 * is still loud. It is just not caught as early as it is here.
 */
class CheckVersionGatingConsistencyTest extends TestCase
{
    /**
     * @return iterable<string, array{string, string, CheckDescriptor}>
     */
    public static function descriptorProvider(): iterable
    {
        foreach (self::validatorTestClasses() as $class) {
            // getCheckDescriptors() is protected; reflection reaches it without
            // setAccessible(), which has been a deprecated no-op since PHP 8.1.
            /** @var array<string, CheckDescriptor> $descriptors */
            $descriptors = (new \ReflectionMethod($class, 'getCheckDescriptors'))->invoke(null);

            foreach ($descriptors as $key => $descriptor) {
                yield sprintf('%s::%s', (new \ReflectionClass($class))->getShortName(), $key) => [$class, $key, $descriptor];
            }
        }
    }

    /**
     * @return class-string[]
     */
    private static function validatorTestClasses(): array
    {
        $classes = [];
        foreach (glob(dirname(__DIR__, 2) . '/*ValidatorTest.php') ?: [] as $file) {
            $fqn = 'StubTests\\' . basename($file, '.php');
            if (class_exists($fqn) && (new \ReflectionClass($fqn))->hasMethod('getCheckDescriptors')) {
                $classes[] = $fqn;
            }
        }
        return $classes;
    }

    public function testAtLeastOneDescriptorWasDiscovered(): void
    {
        self::assertNotEmpty(
            iterator_to_array($this->descriptorProvider()),
            'Discovered no CheckDescriptors — the discovery logic is stale and these tests would pass vacuously.'
        );
    }

    /**
     * Every version a descriptor schedules must be one its check actually supports.
     */
    #[DataProvider('descriptorProvider')]
    public function testDescriptorRangeIsFullySupportedByItsCheck(string $testClass, string $key, CheckDescriptor $descriptor): void
    {
        $check = $descriptor->entityTypeConfig !== null
            ? new ($descriptor->checkClass)(entityTypeConfig: $descriptor->entityTypeConfig)
            : new ($descriptor->checkClass)();

        $unsupported = [];
        foreach (self::versionsInRange($descriptor->fromVersion, $descriptor->toVersion) as $version) {
            if (!$check->supports($version)) {
                $unsupported[] = $version;
            }
        }

        self::assertSame(
            [],
            $unsupported,
            sprintf(
                "%s registers %s for %s..%s, but %s::supports() rejects: %s.\n"
                . 'Those versions would fail in the validator suites. Narrow the descriptor range or widen supports().',
                $testClass,
                $key,
                $descriptor->fromVersion->value,
                $descriptor->toVersion->value,
                $descriptor->checkClass,
                implode(', ', $unsupported)
            )
        );
    }

    /**
     * A descriptor whose range contains no known PHP version can never emit a test case,
     * so the check it registers would silently never run.
     */
    #[DataProvider('descriptorProvider')]
    public function testDescriptorRangeContainsAtLeastOneKnownVersion(string $testClass, string $key, CheckDescriptor $descriptor): void
    {
        self::assertNotEmpty(
            self::versionsInRange($descriptor->fromVersion, $descriptor->toVersion),
            sprintf(
                '%s registers %s for %s..%s, which matches no PhpVersions case, so the check never runs.',
                $testClass,
                $key,
                $descriptor->fromVersion->value,
                $descriptor->toVersion->value
            )
        );
    }

    /**
     * @return string[]
     */
    private static function versionsInRange(PhpVersions $from, PhpVersions $to): array
    {
        $versions = [];
        foreach (PhpVersions::cases() as $case) {
            if (version_compare($case->value, $from->value, '>=')
                && version_compare($case->value, $to->value, '<=')
            ) {
                $versions[] = $case->value;
            }
        }
        return $versions;
    }
}
