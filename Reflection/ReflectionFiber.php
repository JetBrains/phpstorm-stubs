<?php

/**
 * @since 8.1
 */
final class ReflectionFiber
{
    public function __construct(Fiber $fiber) {}

    /**
     * @return Fiber
     */
    public function getFiber() {}

    /**
     * @return string
     */
    public function getExecutingFile() {}

    /**
     * @return int
     */
    public function getExecutingLine() {}

    /**
     * @return callable
     */
    public function getCallable() {}

    /**
     * @param int $options
     * @return array
     */
    public function getTrace(int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT) {}
}
