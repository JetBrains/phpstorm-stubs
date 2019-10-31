<?php

// Start of readline v.5.5.3-1ubuntu2.1

/**
 * Reads a line
 * @link https://php.net/manual/en/function.readline.php
 * @param string $prompt [optional] <p>
 * You may specify a string with which to prompt the user.
 * </p>
 * @return string a single string from the user. The line returned has the ending
 * newline removed.
 * @since 4.0
 * @since 5.0
 */
function readline ($prompt = null) {}

/**
 * Gets/sets various internal readline variables
 * @link https://php.net/manual/en/function.readline-info.php
 * @param string $varname [optional] <p>
 * A variable name.
 * </p>
 * @param string $newvalue [optional] <p>
 * If provided, this will be the new value of the setting.
 * </p>
 * @return mixed If called with no parameters, this function returns an array of
 * values for all the setting readline uses. The elements will
 * be indexed by the following values: done, end, erase_empty_line,
 * library_version, line_buffer, mark, pending_input, point, prompt,
 * readline_name, and terminal_name.
 * </p>
 * <p>
 * If called with one or two parameters, the old value is returned.
 * @since 4.0
 * @since 5.0
 */
function readline_info ($varname = null, $newvalue = null) {}

/**
 * Adds a line to the history
 * @link https://php.net/manual/en/function.readline-add-history.php
 * @param string $line <p>
 * The line to be added in the history.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function readline_add_history ($line) {}

/**
 * Clears the history
 * @link https://php.net/manual/en/function.readline-clear-history.php
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function readline_clear_history () {}

/**
 * Lists the history
 * @link https://php.net/manual/en/function.readline-list-history.php
 * @return array an array of the entire command line history. The elements are
 * indexed by integers starting at zero.
 * @since 4.0
 * @since 5.0
 */
function readline_list_history () {}

/**
 * Reads the history
 * @link https://php.net/manual/en/function.readline-read-history.php
 * @param string $filename [optional] <p>
 * Path to the filename containing the command history.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function readline_read_history ($filename = null) {}

/**
 * Writes the history
 * @link https://php.net/manual/en/function.readline-write-history.php
 * @param string $filename [optional] <p>
 * Path to the saved file.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function readline_write_history ($filename = null) {}

/**
 * Registers a completion function
 * @link https://php.net/manual/en/function.readline-completion-function.php
 * @param callable $function <p>
 * You must supply the name of an existing function which accepts a
 * partial command line and returns an array of possible matches.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function readline_completion_function (callable $function) {}

/**
 * Initializes the readline callback interface and terminal, prints the prompt and returns immediately
 * @link https://php.net/manual/en/function.readline-callback-handler-install.php
 * @param string $prompt <p>
 * The prompt message.
 * </p>
 * @param callable $callback <p>
 * The <i>callback</i> function takes one parameter; the
 * user input returned.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.1
 */
function readline_callback_handler_install ($prompt, callable $callback) {}

/**
 * Reads a character and informs the readline callback interface when a line is received
 * @link https://php.net/manual/en/function.readline-callback-read-char.php
 * @return void No value is returned.
 * @since 5.1
 */
function readline_callback_read_char () {}

/**
 * Removes a previously installed callback handler and restores terminal settings
 * @link https://php.net/manual/en/function.readline-callback-handler-remove.php
 * @return bool <b>TRUE</b> if a previously installed callback handler was removed, or
 * <b>FALSE</b> if one could not be found.
 * @since 5.1
 */
function readline_callback_handler_remove () {}

/**
 * Redraws the display
 * @link https://php.net/manual/en/function.readline-redisplay.php
 * @return void No value is returned.
 * @since 5.1
 */
function readline_redisplay () {}

/**
 * Inform readline that the cursor has moved to a new line
 * @link https://php.net/manual/en/function.readline-on-new-line.php
 * @return void No value is returned.
 * @since 5.1
 */
function readline_on_new_line () {}

define ('READLINE_LIB', "libedit");

// End of readline v.5.5.3-1ubuntu2.1
?>
