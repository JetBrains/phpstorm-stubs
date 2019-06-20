<?php

namespace parallel;

use parallel\Sync\Error\IllegalValue;

/**
 * The parallel\Sync class provides access to low level syncrhonization primites, mutex, condition variables, and
 * allows the implementation of semaphores.
 *
 * Synchronization for most applications is much better implemented using channels, however, in some cases authors of
 * low level code may find it useful to be able to access these lower level mechanisms.
 */
final class Sync
{
    /**
     * Shall construct a new synchronization object containing the given scalar value. When not given a scalar value it
     * shall construct a new synchronization object with no value.
     *
     * @param string|int|float|bool|null $value
     *
     * @throws IllegalValue if value is non-scalar.
     */
    public function __construct($value = null) {}

    /**
     * Shall atomically return the syncrhonization objects value.
     *
     * @return string|int|float|bool
     */
    public function get() {}

    /**
     * Shall atomically set the value of the synchronization object.
     *
     * @param string|int|float|bool $value
     *
     * @throws IllegalValue if value is non-scalar.
     */
    public function set($value) {}

    /**
     * Shall wait for notification on this synchronization object.
     */
    public function wait() {}

    /**
     * Shall notify one (by default) or all threads waiting on the synchronization object.
     *
     * @param bool $all
     */
    public function notify(bool $all = null) {}

    /**
     * Shall exclusively enter into the critical code.
     *
     * @param callable $critical
     */
    public function __invoke(callable $critical) {}
}
