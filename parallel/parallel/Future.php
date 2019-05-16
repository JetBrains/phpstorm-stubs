<?php

namespace parallel;

use parallel\Future\Error;
use Throwable;

final class Future
{
    /**
     * Shall return (and if necessary wait for) return from task.
     *
     * @throws Error if waiting failed (internal error).
     * @throws Error\Killed if the Runtime executing task was killed.
     * @throws Error\Cancelled if task was already cancelled.
     * @throws Error\Foreign if task raised an unrecognized uncaught exception.
     * @throws Throwable Shall rethrow \Throwable uncaught in task
     *
     * @return mixed
     */
    public function value() {}

    /**
     * Shall indicate if the task was cancelled.
     *
     * @return bool
     */
    public function cancelled(): bool {}

    /**
     * Shall indicate if the task is completed.
     *
     * @return bool
     */
    public function done(): bool {}

    /**
     * Shall try to cancel the task
     *
     * @throws Error\Killed if the Runtime executing task was killed.
     * @throws Error\Cancelled if task was already cancelled.
     *
     * @return bool
     */
    public function cancel(): bool {}
}
