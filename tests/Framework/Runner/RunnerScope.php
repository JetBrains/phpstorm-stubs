<?php

namespace StubTests\Framework\Runner;

/**
 * Manages the shared Runner instance lifecycle.
 *
 * Production/integration tests use get() for lazy-init-once caching.
 * Unit tests can call reset() for isolation or set() to inject a test double.
 */
final class RunnerScope
{
    private static ?Runner $instance = null;

    public static function get(): Runner
    {
        return self::$instance ??= new Runner();
    }

    public static function reset(): void
    {
        self::$instance = null;
    }

    public static function set(Runner $runner): void
    {
        self::$instance = $runner;
    }
}
