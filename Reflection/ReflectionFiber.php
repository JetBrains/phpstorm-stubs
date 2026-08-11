<?php

/**
 * @since 8.1
 */
final class ReflectionFiber
{
    /**
     * Constructs a ReflectionFiber object
     * @link https://php.net/manual/en/reflectionfiber.construct.php
     * @param Fiber $fiber The Fiber to reflect.
     */
    public function __construct(Fiber $fiber) {}

    /**
     * Get the reflected Fiber instance
     *
     * Returns the Fiber instance being reflected.
     *
     * @link https://php.net/manual/en/reflectionfiber.getfiber.php
     * @return Fiber The Fiber instance being reflected.
     */
    public function getFiber(): Fiber {}

    /**
     * Get the file name of the current execution point
     *
     * Returns the full path and file name of the current execution point in the reflected Fiber. If
     * the fiber has not been started or has terminated, an Error is thrown.
     *
     * @link https://php.net/manual/en/reflectionfiber.getexecutingfile.php
     * @return string|null The full path and file name of the reflected fiber. If the reflected
     * fiber is used outside a user-defined function, null is returned.
     */
    public function getExecutingFile(): ?string {}

    /**
     * Get the line number of the current execution point
     *
     * Returns the line number of the current execution point in the reflected Fiber. If the
     * reflected fiber is used outside a user-defined function, null is returned. If the fiber has
     * not been started or has terminated, an Error is thrown.
     *
     * @link https://php.net/manual/en/reflectionfiber.getexecutingline.php
     * @return int|null The line number of the current execution point in the fiber.
     */
    public function getExecutingLine(): ?int {}

    /**
     * Gets the callable used to create the Fiber
     *
     * Returns the callable used to construct the Fiber. If the fiber has terminated, an Error is
     * thrown.
     *
     * @link https://php.net/manual/en/reflectionfiber.getcallable.php
     * @return callable The callable used to create the Fiber.
     */
    public function getCallable(): callable {}

    /**
     * Get the backtrace of the current execution point
     *
     * Get the backtrace of the current execution point in the reflected Fiber.
     *
     * @link https://php.net/manual/en/reflectionfiber.gettrace.php
     * @param int $options The value of options can be any of the following flags. Available options
     * Option Description DEBUG_BACKTRACE_PROVIDE_OBJECT Default. DEBUG_BACKTRACE_IGNORE_ARGS Don't
     * include the argument information for functions in the stack trace.
     * @return array The backtrace of the current execution point in the fiber.
     */
    public function getTrace(int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT): array {}
}
