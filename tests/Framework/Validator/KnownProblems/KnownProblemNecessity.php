<?php

namespace StubTests\Framework\Validator\KnownProblems;

/**
 * Whether a known problem still suppresses a failure, as KnownProblemNecessityAnalyzer finds it.
 */
enum KnownProblemNecessity
{
    /**
     * Some validator case passes with the entry and fails without it.
     */
    case NEEDED;

    /**
     * Every validator case that runs one of the entry's checks on its entity passes with and
     * without it, so the entry suppresses nothing.
     */
    case STALE;

    /**
     * The entry cannot be judged: no validator case runs one of its checks on its entity at a
     * version it covers (for example no reflection cache has the extension), or some of those
     * cases already fail or are skipped with every entry in place.
     */
    case UNTESTED;
}
