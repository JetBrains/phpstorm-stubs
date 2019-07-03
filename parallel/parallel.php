<?php

namespace parallel;

use Closure;
use parallel\Runtime\Error\Bootstrap;

/**
 * Shall use the provided file to bootstrap all runtimes created for automatic scheduling via parallel\run().
 *
 * @param string $file
 *
 * @return void
 *
 * @throws Bootstrap if previously called for this process.
 * @throws Bootstrap if called after parallel\run().
 */
function bootstrap(string $file) {}

/**
 * @see Runtime::run for run details and schematics
 *
 * @param Closure $task A Closure with specific characteristics.
 * @param array|null $argv An array of arguments with specific characteristics to be passed to task at execution time.
 *
 * @return Future
 * Warning: The return \parallel\Future must not be ignored when the task contains a return or throw statement.
 *
 * @throws Runtime\Error\Closed if Runtime was closed.
 * @throws Runtime\Error\IllegalFunction if task is a closure created from an internal function.
 * @throws Runtime\Error\IllegalInstruction if task contains illegal instructions.
 * @throws Runtime\Error\IllegalParameter if task accepts or argv contains illegal variables.
 * @throws Runtime\Error\IllegalReturn if task returns illegally.
 */
function run(Closure $task, array $argv = null) : Future {}
