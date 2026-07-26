<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\DefaultKnownProblemsProvider;

/**
 * Guards the join between known problems and the checks that consume them.
 *
 * Known-problem suppression is keyed by CheckType: a check passes its CheckType to
 * KnownProblemsRegistry (via getCheckName() or directly to skipWithKnownProblem()),
 * and the registry matches it against the CheckType stored in each ProblemDefinition.
 *
 * Since both sides are now the same enum, a *misspelled* name is a compile error and
 * can no longer break the join silently. What remains possible — and still silent — is
 * a provider referencing a CheckType that no check ever emits: the skip never fires and
 * the entity is validated anyway, so the suppression looks configured but does nothing.
 * That is what this test guards.
 *
 * This is exactly how ENUM_CONSTANTS / INTERFACE_CONSTANTS / ENUM_FINAL etc.
 * became latent traps: the constant/final checks were unified into
 * entity-agnostic classes that always report the Class* name, leaving those
 * enum/interface CheckType values unemittable. Those cases were removed; this
 * test stops equivalent orphans from being reintroduced.
 */
class CheckTypeEmissionTest extends TestCase
{
    /**
     * Every CheckType referenced by the default provider must be emitted by at
     * least one check, otherwise the known-problem skip can never match.
     */
    public function testEveryReferencedCheckTypeIsEmittedBySomeCheck(): void
    {
        $emitted = $this->collectEmittedCheckNames();

        $referenced = [];
        foreach ((new DefaultKnownProblemsProvider())->getProblems() as $problem) {
            foreach ($problem->affectedChecks as $check) {
                $referenced[$check->name] = $check->value;
            }
        }

        $this->assertNotEmpty($referenced, 'Expected the default provider to reference at least one CheckType.');

        foreach ($referenced as $name => $value) {
            $this->assertContains(
                $value,
                $emitted,
                "CheckType::{$name} ('{$value}') is referenced by a known-problem definition but no check emits that name, "
                . 'so the suppression would silently never fire. Either point the definition at the name the check '
                . 'actually reports, or make a check emit this name.'
            );
        }
    }

    /**
     * Scans the validator source tree for every CheckType a check can report — the
     * return of getCheckName() and any case passed as the check argument of
     * skipWithKnownProblem(). The KnownProblems directory is excluded because it
     * defines the cases, it does not emit them.
     *
     * Source scanning rather than reflection: getCheckName() is protected, and the
     * checks that pass a CheckType directly to skipWithKnownProblem() do not declare
     * getCheckName() at all, so there is no single API to interrogate.
     *
     * @return string[] distinct emitted CheckType values
     */
    private function collectEmittedCheckNames(): array
    {
        $validatorDir = dirname(__DIR__, 2) . '/Framework/Validator';
        $this->assertDirectoryExists($validatorDir);

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($validatorDir, \FilesystemIterator::SKIP_DOTS)
        );

        $names = [];
        foreach ($iterator as $file) {
            /** @var \SplFileInfo $file */
            if ($file->getExtension() !== 'php') {
                continue;
            }
            if (str_contains($file->getPathname(), DIRECTORY_SEPARATOR . 'KnownProblems' . DIRECTORY_SEPARATOR)) {
                continue;
            }

            $source = file_get_contents($file->getPathname());

            // getCheckName(): CheckType { return CheckType::CASE; }
            if (preg_match_all('/function\s+getCheckName\s*\(\s*\)\s*:\s*CheckType\s*\{\s*return\s+CheckType::([A-Z_]+)/s', $source, $m)) {
                foreach ($m[1] as $case) {
                    $names[$case] = true;
                }
            }

            // skipWithKnownProblem(..., CheckType::CASE, $phpVersion)
            if (preg_match_all('/skipWithKnownProblem\s*\([^;]*?,\s*CheckType::([A-Z_]+)\s*,\s*\$phpVersion/s', $source, $m)) {
                foreach ($m[1] as $case) {
                    $names[$case] = true;
                }
            }
        }

        $this->assertNotEmpty($names, 'Scanner found no emitted CheckType at all - the patterns are stale.');

        // Map case names to their backed values, which is what ProblemDefinition stores.
        return array_map(
            static fn (string $case): string => constant(CheckType::class . '::' . $case)->value,
            array_keys($names)
        );
    }
}
