<?php

namespace parallel;

use Closure;
use parallel\Runtime\Bootstrap;
use parallel\Runtime\Error;

final class Runtime
{
    /**
     * When passed a bootstrap file: Shall construct a bootstrapped runtime.
     * Without a passed bootstrap file: Shall construct a new runtime without bootstrapping.
     *
     * @param string|null $bootstrap The location of a bootstrap file, generally an autoloader.
     *
     * @throws Error if thread could not be created.
     * @throws Bootstrap if bootstrapping failed.
     */
    public function __construct($bootstrap = null) {}

    /**
     * Shall schedule task for execution in parallel, passing argv at execution time when available.
     *
     * @param Closure    $task A Closure with specific characteristics.
     * @param array|null $argv
     *
     * Task Characteristics:
     * Closures scheduled for parallel execution must not:
     *
     * accept or return by reference
     * accept or return objects (that are not closures)
     * execute a limited set of instructions
     * Instructions prohibited in Closures intended for parallel execution are:
     *
     * yield
     * use by-reference
     * declare class
     * declare named function
     *
     * Note:Nested closures may yield or use by-reference, but must not contain class or named function declarations.
     * Note:No instructions are prohibited in the files which the task may include.
     *
     * Arguments Characteristics
     * Arguments must not:
     *
     * contain references
     * contain objects (that are not closures)
     * contain resources
     *
     * Note: In the case of file stream resources, the resource will be cast to the file descriptor and passed as int
     * where possible, this is unsupported on Windows.
     *
     * @return Future|null Returns a Future when the passed $task containers a return or throw statement, otherwise null.
     * Warning: The return \parallel\Future must not be ignored when the task contains a return or throw statement.
     *
     * @throws Error\Closed if Runtime was closed.
     * @throws Error\IllegalFunction if task is a closure created from an internal function.
     * @throws Error\IllegalInstruction if task contains illegal instructions.
     * @throws Error\IllegalParameter if task accepts or argv contains illegal variables.
     * @throws Error\IllegalReturn if task returns illegally.
     */
    public function run(Closure $task , array $argv = null) : Future {}

    /**
     * Shall request that the runtime shutsdown.
     *
     * Note: Tasks scheduled for execution will be executed before the shutdown occurs.
     *
     * @throws Error\Closed if Runtime was closed.
     */
    public function close(): void {}

    /**
     * Shall attempt to force the runtime to shutdown.
     *
     * Note: Tasks scheduled for execution will not be executed, the currently running task shall be interrupted.
     * Warning: Internal function calls in progress cannot be interrupted.
     *
     * @throws Error\Closed if Runtime was closed.
     */
    public function kill(): void {}
}
