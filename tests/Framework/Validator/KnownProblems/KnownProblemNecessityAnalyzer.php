<?php

namespace StubTests\Framework\Validator\KnownProblems;

use StubTests\Framework\Validator\KnownProblemsRegistry;

/**
 * Finds out whether a known problem still suppresses a validator failure.
 *
 * An entry is judged by the validator suite cases that can exercise it: the cases for its
 * entity (the owning class, interface or enum for a member entry), at a PHP version in its
 * range, whose check is one of its affectedChecks. Which check a case runs is read from the
 * registry, because a check asks it about every entity and member it validates under its own
 * CheckType (see RecordingKnownProblemsRegistry). Grouping by entity alone would judge an entry
 * by cases that can never reach it, such as the PhpDoc cases of a function that no reflection
 * cache has.
 *
 * Each of those cases is run with every entry in place, and those that pass are run again
 * with the entry removed:
 *  - NEEDED when some case passes only with the entry;
 *  - STALE when every case passes either way;
 *  - UNTESTED when there is no such case, or some of them already fail or are skipped with
 *    every entry in place. A case that fails anyway cannot show whether the entry is needed
 *    there, so it is never taken as evidence that it is not.
 *
 * Checks take the registry from the singleton when they are constructed, so the case runner
 * must construct them after the swap, as the validator tests do. The singleton is reset when
 * analyze() returns, so the next getInstance() gets the default registry again.
 */
final class KnownProblemNecessityAnalyzer
{
    /** @var list<ProblemDefinition> */
    private readonly array $problems;

    /** @var list<ValidatorSuiteCase> */
    private array $cases = [];

    /** @var array<string, list<int>> Positions in the cases list, by entity id */
    private array $caseIndexesByEntity = [];

    /** @var array<int, array{bool, list<CheckType>}> Whether the case passed with every entry in place, and which checks it ran, by case index */
    private array $baselines = [];

    /**
     * @param KnownProblemsProvider $provider Every entry, as the validator suites see them
     * @param iterable<ValidatorSuiteCase> $cases The validator suite cases; only those for an entry's entity are kept
     * @param \Closure(ValidatorSuiteCase): bool $runCase Runs a case against the installed registry and returns whether it passed
     */
    public function __construct(
        KnownProblemsProvider $provider,
        iterable $cases,
        private readonly \Closure $runCase,
    ) {
        $this->problems = array_values($provider->getProblems());

        $owners = [];
        foreach ($this->problems as $problem) {
            foreach (self::ownerIds($problem) as $ownerId) {
                $owners[$ownerId] = true;
            }
        }

        foreach ($cases as $case) {
            if (isset($owners[$case->entityId])) {
                $this->caseIndexesByEntity[$case->entityId][] = count($this->cases);
                $this->cases[] = $case;
            }
        }
    }

    /**
     * @param int $problemIndex Position of the entry in the provider's getProblems()
     */
    public function analyze(int $problemIndex): KnownProblemVerdict
    {
        $problem = $this->problems[$problemIndex];
        $checks = implode(', ', array_map(static fn (CheckType $check): string => $check->value, $problem->affectedChecks));

        try {
            $cases = $this->casesExercising($problem);
            if ($cases === []) {
                return new KnownProblemVerdict(
                    KnownProblemNecessity::UNTESTED,
                    "No validator case runs {$checks} on it at PHP {$problem->versionRange->from}-{$problem->versionRange->to}."
                );
            }

            $passing = array_filter($cases, fn (int $index): bool => $this->baselines[$index][0]);

            $without = $this->problems;
            unset($without[$problemIndex]);
            $this->install(array_values($without));

            $failingWithout = [];
            foreach ($passing as $index) {
                if (!($this->runCase)($this->cases[$index])) {
                    $failingWithout[] = $this->cases[$index]->getName();
                }
            }

            if ($failingWithout !== []) {
                return new KnownProblemVerdict(
                    KnownProblemNecessity::NEEDED,
                    sprintf('%d of %d cases running %s on it fail without it.', count($failingWithout), count($cases), $checks),
                    $failingWithout
                );
            }

            if (count($passing) < count($cases)) {
                return new KnownProblemVerdict(
                    KnownProblemNecessity::UNTESTED,
                    sprintf(
                        '%d of %d cases running %s on it fail or are skipped even with every entry in place, so they cannot show whether it is needed.',
                        count($cases) - count($passing),
                        count($cases),
                        $checks
                    )
                );
            }

            return new KnownProblemVerdict(
                KnownProblemNecessity::STALE,
                count($cases) === 1
                    ? "The only case running {$checks} on it passes with and without it."
                    : sprintf('All %d cases running %s on it pass with and without it.', count($cases), $checks)
            );
        } finally {
            KnownProblemsRegistry::reset();
        }
    }

    /**
     * The cases for the entry's entities, at versions it covers, that run one of its checks.
     *
     * @return list<int> Indexes into $cases
     */
    private function casesExercising(ProblemDefinition $problem): array
    {
        $candidates = [];
        foreach (self::ownerIds($problem) as $ownerId) {
            foreach ($this->caseIndexesByEntity[$ownerId] ?? [] as $index) {
                if ($problem->appliesToVersion($this->cases[$index]->phpVersion)) {
                    $candidates[] = $index;
                }
            }
        }

        $this->runBaselines($candidates);

        return array_values(array_filter(
            $candidates,
            fn (int $index): bool => array_any(
                $this->baselines[$index][1],
                static fn (CheckType $check): bool => in_array($check, $problem->affectedChecks, true)
            )
        ));
    }

    /**
     * Runs the cases not run yet with every entry in place, recording the outcome and the
     * checks each one ran. The outcome is the same for every entry, so it is kept for reuse.
     *
     * @param list<int> $indexes Indexes into $cases
     */
    private function runBaselines(array $indexes): void
    {
        $pending = array_filter($indexes, fn (int $index): bool => !isset($this->baselines[$index]));
        if ($pending === []) {
            return;
        }

        $registry = $this->install($this->problems);
        foreach ($pending as $index) {
            $passed = ($this->runCase)($this->cases[$index]);
            $this->baselines[$index] = [$passed, $registry->takeAskedChecks()];
        }
    }

    /**
     * Makes these the problems every check sees from now on, through a registry that records
     * which checks ask it.
     *
     * @param ProblemDefinition[] $problems
     */
    private function install(array $problems): RecordingKnownProblemsRegistry
    {
        KnownProblemsRegistry::reset();
        $registry = RecordingKnownProblemsRegistry::getInstance(new InMemoryKnownProblemsProvider($problems));

        // getInstance() is declared on the base class; after reset() it creates the class it is called on.
        if (!$registry instanceof RecordingKnownProblemsRegistry) {
            throw new \LogicException('KnownProblemsRegistry::getInstance() did not create a RecordingKnownProblemsRegistry.');
        }

        return $registry;
    }

    /**
     * The entities a validator case runs on to reach the entry: the owning class, interface or
     * enum for a member, the entity itself otherwise.
     *
     * @return list<string>
     */
    private static function ownerIds(ProblemDefinition $problem): array
    {
        $owners = [];
        foreach ($problem->entityIds ?: [$problem->entityId] as $entityId) {
            $owner = match ($problem->entityType) {
                EntityType::METHOD,
                EntityType::PROPERTY,
                EntityType::CLASS_CONSTANT,
                EntityType::INTERFACE_CONSTANT,
                EntityType::ENUM_CONSTANT => explode('::', $entityId, 2)[0],
                default => $entityId,
            };
            $owners[$owner] = $owner;
        }

        return array_values($owners);
    }
}
