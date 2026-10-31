<?php

namespace StubTests\Framework\Validator\KnownProblems;

/**
 * The outcome of KnownProblemNecessityAnalyzer::analyze() for one entry.
 */
final readonly class KnownProblemVerdict
{
    /**
     * @param KnownProblemNecessity $necessity Whether the entry is needed, stale or untested
     * @param string $explanation What the cases showed, in a sentence
     * @param string[] $failingWithout Names of the cases that pass with the entry and fail without it
     */
    public function __construct(
        public KnownProblemNecessity $necessity,
        public string $explanation,
        public array $failingWithout = [],
    ) {}
}
