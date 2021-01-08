<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * This attribute marks a function that may throw an Exception
 *
 * @since 8.0
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD)]
class Throws {
    /**
     * @param ...string $exceptionClass A FQN of a class name that may be thrown like "\Exception"
     */
    public function __construct(...string $exceptionClass)
    {
    }
}
