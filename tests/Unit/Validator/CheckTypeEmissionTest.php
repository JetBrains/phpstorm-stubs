<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\DefaultKnownProblemsProvider;

/**
 * Guards the join between known problems and the checks that consume them.
 *
 * Known-problem suppression is keyed by check name: a check calls
 * KnownProblemsRegistry with the string it reports (either getCheckName() or a
 * literal passed to skipWithKnownProblem()), and the registry matches that
 * string against the CheckType value stored in each ProblemDefinition. If a
 * provider references a CheckType whose value is never emitted by any check,
 * the skip silently never fires and the entity is validated anyway — a
 * suppression that looks configured but does nothing.
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
     * Scans the validator source tree for every check-name string literal a
     * check can report — the return of getCheckName() and any literal passed as
     * the check-name argument of skipWithKnownProblem(). The KnownProblems
     * directory is excluded because it defines names, it does not emit them.
     *
     * @return string[] distinct emitted check names
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

            // getCheckName(): string { return 'Name'; }
            if (preg_match_all('/function\s+getCheckName\s*\(\s*\)\s*:\s*string\s*\{\s*return\s*\'([^\']+)\'/s', $source, $m)) {
                foreach ($m[1] as $name) {
                    $names[$name] = true;
                }
            }

            // skipWithKnownProblem(..., 'Name', $phpVersion)
            if (preg_match_all('/skipWithKnownProblem\s*\([^;]*?,\s*\'([^\']+)\'\s*,\s*\$phpVersion/s', $source, $m)) {
                foreach ($m[1] as $name) {
                    $names[$name] = true;
                }
            }
        }

        return array_keys($names);
    }
}
