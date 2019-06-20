<?php

namespace parallel\Events;

use parallel\Events\Input\Error\Existence;
use parallel\Events\Input\Error\IllegalValue;

final class Input
{
    /**
     * Shall set input for the given target
     *
     * @param string $target
     * @param mixed  $value
     *
     * @return void
     *
     * @throws Existence if input for target already exists.
     * @throws IllegalValue if value is illegal (object, null).
     */
    public function add(string $target, $value): void {}

    /**
     * Shall remove input for the given target.
     *
     * @param string $target
     *
     * @throws Existence if input for target does not exist.
     */
    public function remove(string $target): void {}

    /**
     * Shall remove input for all targets.
     *
     * @return void
     */
    public function clear(): void {}
}
