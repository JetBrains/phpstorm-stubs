<?php

// Start of readline v.5.5.3-1ubuntu2.1

/**
 * (PHP 4, PHP 5)<br/>
 * Reads a line
 * @link http://php.net/manual/en/function.readline.php
 * @param string $prompt [optional] <p>
 * You may specify a string with which to prompt the user.
 * </p>
 * @return string a single string from the user. The line returned has the ending
 * newline removed.
 */
function readline ($prompt = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Gets/sets various internal readline variables
 * @link http://php.net/manual/en/function.readline-info.php
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
 */
function readline_info ($varname = null, $newvalue = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Adds a line to the history
 * @link http://php.net/manual/en/function.readline-add-history.php
 * @param string $line <p>
 * The line to be added in the history.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function readline_add_history ($line) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Clears the history
 * @link http://php.net/manual/en/function.readline-clear-history.php
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function readline_clear_history () {}

/**
 * (PHP 4, PHP 5)<br/>
 * Lists the history
 * @link http://php.net/manual/en/function.readline-list-history.php
 * @return array an array of the entire command line history. The elements are
 * indexed by integers starting at zero.
 */
function readline_list_history () {}

/**
 * (PHP 4, PHP 5)<br/>
 * Reads the history
 * @link http://php.net/manual/en/function.readline-read-history.php
 * @param string $filename [optional] <p>
 * Path to the filename containing the command history.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function readline_read_history ($filename = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Writes the history
 * @link http://php.net/manual/en/function.readline-write-history.php
 * @param string $filename [optional] <p>
 * Path to the saved file.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function readline_write_history ($filename = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Registers a completion function
 * @link http://php.net/manual/en/function.readline-completion-function.php
 * @param callable $function <p>
 * You must supply the name of an existing function which accepts a
 * partial command line and returns an array of possible matches.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function readline_completion_function (callable $function) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Initializes the readline callback interface and terminal, prints the prompt and returns immediately
 * @link http://php.net/manual/en/function.readline-callback-handler-install.php
 * @param string $prompt <p>
 * The prompt message.
 * </p>
 * @param callable $callback <p>
 * The <i>callback</i> function takes one parameter; the
 * user input returned.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function readline_callback_handler_install ($prompt, callable $callback) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Reads a character and informs the readline callback interface when a line is received
 * @link http://php.net/manual/en/function.readline-callback-read-char.php
 * @return void No value is returned.
 */
function readline_callback_read_char () {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Removes a previously installed callback handler and restores terminal settings
 * @link http://php.net/manual/en/function.readline-callback-handler-remove.php
 * @return bool <b>TRUE</b> if a previously installed callback handler was removed, or
 * <b>FALSE</b> if one could not be found.
 */
function readline_callback_handler_remove () {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Redraws the display
 * @link http://php.net/manual/en/function.readline-redisplay.php
 * @return void No value is returned.
 */
function readline_redisplay () {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Inform readline that the cursor has moved to a new line
 * @link http://php.net/manual/en/function.readline-on-new-line.php
 * @return void No value is returned.
 */
function readline_on_new_line () {}

define ('READLINE_LIB', "libedit");

// End of readline v.5.5.3-1ubuntu2.1
?>
