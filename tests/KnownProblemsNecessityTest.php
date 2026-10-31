<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\KnownProblems\DefaultKnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\KnownProblemNecessity;
use StubTests\Framework\Validator\KnownProblems\KnownProblemNecessityAnalyzer;
use StubTests\Framework\Validator\KnownProblems\ValidatorSuiteCase;
use StubTests\Framework\Validator\KnownProblemsRegistry;

/**
 * Fails when an entry in `DefaultKnownProblemsProvider` no longer suppresses anything.
 *
 * A suppressed check records a success, so an entry whose mismatch is gone (the stubs were
 * fixed, or the reflection caches changed) keeps every suite green while hiding any new
 * mismatch of the same kind. `KnownProblemsIntegrityTest` only asserts that the entry's entity
 * still exists; this asserts the entry is still needed.
 *
 * For each entry, the validator suite cases that run one of its affected checks on its entity
 * at the PHP versions it covers are run with every entry in place and again without that entry
 * (see KnownProblemNecessityAnalyzer). The entry is needed if some case passes only with it, and
 * stale if every case passes either way. An entry no case exercises, such as one for an extension
 * no reflection cache was built with, or whose cases already fail, cannot be judged and is
 * reported as skipped rather than stale.
 */
class KnownProblemsNecessityTest extends TestCase
{
    private static ?KnownProblemNecessityAnalyzer $analyzer = null;

    public static function tearDownAfterClass(): void
    {
        self::$analyzer = null;
        KnownProblemsRegistry::reset();
        parent::tearDownAfterClass();
    }

    /**
     * @return iterable<string, array{int}>
     */
    public static function problemIndexProvider(): iterable
    {
        foreach ((new DefaultKnownProblemsProvider())->getProblems() as $index => $problem) {
            yield sprintf('%s %s (entry %d)', $problem->entityType->value, $problem->entityId, $index) => [$index];
        }
    }

    #[DataProvider('problemIndexProvider')]
    public function testKnownProblemStillSuppressesAFailure(int $index): void
    {
        $problem = (new DefaultKnownProblemsProvider())->getProblems()[$index];
        $verdict = self::analyzer()->analyze($index);

        $entry = sprintf(
            "Known problem for %s '%s' [%s], PHP %s-%s",
            $problem->entityType->value,
            implode("', '", $problem->entityIds ?: [$problem->entityId]),
            implode(', ', array_map(static fn ($check) => $check->value, $problem->affectedChecks)),
            $problem->versionRange->from,
            $problem->versionRange->to
        );

        if ($verdict->necessity === KnownProblemNecessity::UNTESTED) {
            self::markTestSkipped("{$entry} cannot be judged. {$verdict->explanation}");
        }

        self::assertTrue(
            $verdict->necessity === KnownProblemNecessity::NEEDED,
            "{$entry} suppresses nothing. {$verdict->explanation}\n"
            . "The mismatch it was added for is gone, so the entry now only hides new ones. Remove it.\n"
            . "Reason recorded on the entry: {$problem->reason}"
        );
    }

    private static function analyzer(): KnownProblemNecessityAnalyzer
    {
        return self::$analyzer ??= new KnownProblemNecessityAnalyzer(
            new DefaultKnownProblemsProvider(),
            self::validatorSuiteCases(),
            self::runValidatorSuiteCase(...)
        );
    }

    /**
     * Every data set of every ValidatorTestBase test, as the suites run them.
     *
     * @return iterable<ValidatorSuiteCase>
     */
    private static function validatorSuiteCases(): iterable
    {
        foreach (glob(__DIR__ . '/*ValidatorTest.php') ?: [] as $file) {
            $class = __NAMESPACE__ . '\\' . basename($file, '.php');
            if (!is_subclass_of($class, ValidatorTestBase::class)) {
                continue;
            }

            foreach ((new \ReflectionClass($class))->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                foreach ($method->getAttributes(DataProvider::class) as $attribute) {
                    $provider = $attribute->newInstance()->methodName();
                    foreach ($class::$provider() as [$checkName, $entityId, $phpVersion]) {
                        yield new ValidatorSuiteCase($class, $method->getName(), $checkName, $entityId, $phpVersion);
                    }
                }
            }
        }
    }

    /**
     * Runs one validator case the way PHPUnit would, and reports whether it passed. A failed
     * assertion, a skip and an error all count as not passing.
     */
    private static function runValidatorSuiteCase(ValidatorSuiteCase $case): bool
    {
        $test = new ($case->testClass)($case->testMethod);

        try {
            // setUp() is protected; reflection reaches it without setAccessible(), a no-op since PHP 8.1.
            (new \ReflectionMethod($test, 'setUp'))->invoke($test);
            $test->{$case->testMethod}($case->checkName, $case->entityId, $case->phpVersion);
        } catch (\Throwable) {
            return false;
        }

        return true;
    }
}
