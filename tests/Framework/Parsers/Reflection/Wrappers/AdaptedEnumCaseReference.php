<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Portable stand-in for an enum-case value captured from reflection.
 *
 * The reflection pipeline runs in two stages: Stage 1 extracts reflection data inside the container
 * for the PHP version being reflected, serializes it, and Stage 2 unserializes it in the test_runner
 * container to build the JSON cache. A *live* enum instance cannot survive that hop unless the
 * declaring class exists on both sides — and enums, unlike ordinary objects, cannot degrade to
 * __PHP_Incomplete_Class. When they can't be resolved, unserialize() aborts the whole payload.
 *
 * That is not hypothetical: `Io\Poll\Context::__construct($backend = Io\Poll\Backend::Auto)` made
 * Reflection8.1.json ungeneratable, because the 8.1 image loads ext-io and test_runner does not, so
 * Stage 2 died with "Class 'Io\Poll\Backend' not found" and aborted the run. The version-based
 * routing in run-all-reflection-parsers.sh cannot help: it sends older-than-runner versions to
 * test_runner by design, and the framework needs PHP 8.3+ so it cannot self-process on 8.1.
 *
 * This carries the enum FQN and case name as plain strings instead, so the payload is independent of
 * which extensions the two containers happen to load. The reflection serializer renders it exactly as
 * a live instance was rendered, keeping existing caches byte-identical.
 *
 * The reflection-side counterpart to {@see \StubTests\Framework\Parsers\Stubs\StubEnumCaseReference},
 * which solves the same problem for stub-sourced enum defaults.
 *
 * PHP 5.6+ compatible (no typed properties, no return types) — Stage 1 runs on every reflected
 * version, down to 5.6.
 */
class AdaptedEnumCaseReference
{
    /**
     * Enum FQN without a leading backslash, matching get_class() of a real case.
     * @var string
     */
    private $enumFqn;

    /**
     * The case name, e.g. "Auto". Retained so the reference is not lossy, even though the current
     * serializer output does not include it.
     * @var string
     */
    private $caseName;

    /**
     * @param string $enumFqn
     * @param string $caseName
     */
    public function __construct($enumFqn, $caseName)
    {
        $this->enumFqn = ltrim($enumFqn, '\\');
        $this->caseName = $caseName;
    }

    /** @return string */
    public function getEnumFqn()
    {
        return $this->enumFqn;
    }

    /** @return string */
    public function getCaseName()
    {
        return $this->caseName;
    }
}
