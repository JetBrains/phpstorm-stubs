<?php

// Start of uopz v5.0.2

/**
 * Allows control over disabled exit opcode
 * @link http://php.net/manual/en/function.uopz-allow-exit.php
 * @param bool $allow Whether to allow the execution of exit opcodes or not.
 * @return void
 * @since 5.4
 */
function uopz_allow_exit (bool $allow): void {}

/**
 * Extend a class at runtime
 * @link http://php.net/manual/en/function.uopz-extend.php
 * @param string $class The name of the class to extend
 * @param string $parent The name of the class to inherit
 * @return bool
 * @since 5.4
 */
function uopz_extend (string $class, string $parent): bool {}

/**
 * Get or set flags on function or class
 * @link http://php.net/manual/en/function.uopz-flags.php
 * @param string $class The name of a class
 * @param string $function The name of the function
 * @param int $flags A valid set of ZEND_ACC_ flags, ZEND_ACC_FETCH to read flags
 * @return int
 * @since 5.4
 */
function uopz_flags (string $class, string $function, int $flats): bool {}

/**
 * Retrieve the last set exit status
 * @link http://php.net/manual/en/function.uopz-get-exit-status.php
 * @return int|null
 * @since 5.4
 */
function uopz_get_exit_status (): ?int {}

/**
 * Get the current mock for a class
 * @link http://php.net/manual/en/function.uopz-get-mock.php
 * @param string $class The name of the mocked class
 * @return mixed
 * @since 5.4
 */
function uopz_get_mock (string $class) {}

/**
 * Gets a previous set return value for a function
 * @link http://php.net/manual/en/function.uopz-get-return.php
 * @param string $class The name of the class containing the function
 * @param string $function The name of the function
 * @return mixed
 * @since 5.4
 */
function uopz_get_return (string $class, string $function) {}

/**
 * Implements an interface at runtime
 * @link http://php.net/manual/en/function.uopz-implement.php
 * @param string $class The name of the class
 * @param string $interface The name of the interface
 * @return bool
 * @since 5.4
 */
function uopz_implement (string $class, string $interface): bool {}

/**
 * Redefine a constant
 * @link http://php.net/manual/en/function.uopz-redefine.php
 * @param string $class The name of the class containing the constant
 * @param string $constant The name of the constant
 * @param mixed $value The new value for the constant, must be a valid type for a constant variable
 * @return bool
 * @since 5.4
 */
function uopz_redefine (string $class, string $constant, $value): bool {}

/**
 * Use mock instead of class for new objects
 * @link http://php.net/manual/en/function.uopz-set-mock.php
 * @param string $class The name of the class to be mocked
 * @param mixed $mock The mock to use in the form of a string containing the name of the class to use or an object
 * @return void
 * @since 7.0
 */
function uopz_set_mock (string $class, $mock): void {}

/**
 * Provide a return value for an existing function
 * @link http://php.net/manual/en/function.uopz-set-return.php
 * @param string $class The name of the class containing the function
 * @param string $function The name of an existing function
 * @param mixed $value The value the function should return. If a Closure is provided and the execute flag is set, the Closure will be executed in place of the original function
 * @param bool $execute If true, and a Closure was provided as the value, the Closure will be executed in place of the original function.
 * @return bool
 * @since 7.0
 */
function uopz_set_return (string $class = "", string $function, $value, $execute = false): bool {}

/**
 * Undefine a constant
 * @link http://php.net/manual/en/function.uopz-undefine.php
 * @param string $class The name of the class containing the constant
 * @param string $constant The name of the constant
 * @return bool
 * @since 5.4
 */
function uopz_undefine (string $class, string $constant): bool {}

/**
 * Unset previously set mock
 * @link http://php.net/manual/en/function.uopz-unset-mock.php
 * @param string $class The name of the mocked class
 * @return void
 * @since 7.0
 */
function uopz_unset_mock (string $class): void {}

/**
 * Unsets a previously set return value for a function
 * @link http://php.net/manual/en/function.uopz-unset-return.php
 * @param string $class The name of the class containing the function
 * @param string $function The name of an existing function
 * @return bool
 * @since 7.0
 */
function uopz_unset_return (string $class = "", string $function): bool {}

// End of uopz v5.0.2
?>
