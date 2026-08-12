<?php

/**
 * Inserts a breakpoint at the next opcode
 *
 * Insert a breakpoint at the next opcode.
 *
 * @link https://php.net/manual/en/function.phpdbg-break-next.php
 * @return void No value is returned.
 */
function phpdbg_break_next(): void {}

/**
 * Inserts a breakpoint at a line in a file
 *
 * Insert a breakpoint at the given line in the given file.
 *
 * @link https://php.net/manual/en/function.phpdbg-break-file.php
 * @param string $file The name of the file.
 * @param int $line The line number.
 * @return void No value is returned.
 */
function phpdbg_break_file(string $file, int $line): void {}

/**
 * Inserts a breakpoint at entry to a method
 *
 * Insert a breakpoint at the entry to the given method of the given class.
 *
 * @link https://php.net/manual/en/function.phpdbg-break-method.php
 * @param string $class The name of the class.
 * @param string $method The name of the method.
 * @return void No value is returned.
 */
function phpdbg_break_method(string $class, string $method): void {}

/**
 * Inserts a breakpoint at entry to a function
 *
 * Insert a breakpoint at the entry to the given function.
 *
 * @link https://php.net/manual/en/function.phpdbg-break-function.php
 * @param string $function The name of the function.
 * @return void No value is returned.
 */
function phpdbg_break_function(string $function): void {}

/**
 * Sets the color of certain elements
 *
 * Set the color of the given element.
 *
 * @link https://php.net/manual/en/function.phpdbg-color.php
 * @param int $element One of the PHPDBG_COLOR_* constants.
 * @param string $color The name of the color. One of white, red, green, yellow, blue, purple, cyan
 * or black, optionally with either a trailing -bold or -underline, for instance, white-bold or
 * green-underline.
 * @return void No value is returned.
 */
function phpdbg_color(int $element, string $color): void {}

/**
 * Sets the command prompt
 *
 * Set the command prompt to the given string.
 *
 * @link https://php.net/manual/en/function.phpdbg-prompt.php
 * @param string $string The string to use as command prompt.
 * @return void No value is returned.
 */
function phpdbg_prompt(string $string): void {}

/**
 * @link https://php.net/manual/en/function.phpdbg-exec.php
 * @return string|bool
 */
function phpdbg_exec(string $context) {}

/**
 * Clears all breakpoints
 *
 * Clear all breakpoints that have been set, either via one of the phpdbg_break_* functions or
 * interactively in the console.
 *
 * @link https://php.net/manual/en/function.phpdbg-clear.php
 * @return void No value is returned.
 */
function phpdbg_clear(): void {}

/**
 * Starts an oplog
 * @link https://php.net/manual/en/function.phpdbg-start-oplog.php
 * @return void No value is returned.
 */
function phpdbg_start_oplog(): void {}

/**
 * Ends an oplog
 * @link https://php.net/manual/en/function.phpdbg-end-oplog.php
 * @param array $options
 * @return array|null
 */
function phpdbg_end_oplog(array $options = []): ?array {}

/**
 * Gets executable
 * @link https://php.net/manual/en/function.phpdbg-get-executable.php
 * @param array $options
 * @return array
 */
function phpdbg_get_executable(array $options = []): array {}
