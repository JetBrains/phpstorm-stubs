<?php
/**
 * PHPStorm stub file for Error Handling and Logging functions.
 *
 * @link http://php.net/manual/en/errorfunc.constants.php
 */

/**
 * Generates a backtrace
 *
 * @link  http://php.net/manual/en/function.debug-backtrace.php
 *
 * @param int $options [optional] <p>
 *                     As of 5.3.6, this parameter is a bitmask for the following options:
 *                     <table>
 *                     <b>debug_backtrace</b> options
 *                     <tr valign="top">
 *                     <td>DEBUG_BACKTRACE_PROVIDE_OBJECT</td>
 *                     <td>
 *                     Whether or not to populate the "object" index.
 *                     </td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>DEBUG_BACKTRACE_IGNORE_ARGS</td>
 *                     <td>
 *                     Whether or not to omit the "args" index, and thus all the function/method arguments,
 *                     to save memory.
 *                     </td>
 *                     </tr>
 *                     </table>
 *                     Before 5.3.6, the only values recognized are true or false, which are the same as
 *                     setting or not setting the <b>DEBUG_BACKTRACE_PROVIDE_OBJECT</b> option respectively.
 *                     </p>
 * @param int $limit   [optional] <p>
 *                     As of 5.4.0, this parameter can be used to limit the number of stack frames returned.
 *                     By default (<i>limit</i>=0) it returns all stack frames.
 *                     </p>
 *
 * @return array an array of associative arrays. The possible returned elements
 * are as follows:
 * </p>
 * <p>
 * <table>
 * Possible returned elements from <b>debug_backtrace</b>
 * <tr valign="top">
 * <td>&Name;</td>
 * <td>&Type;</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>function</td>
 * <td>string</td>
 * <td>
 * The current function name. See also
 * __FUNCTION__.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>line</td>
 * <td>integer</td>
 * <td>
 * The current line number. See also
 * __LINE__.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>file</td>
 * <td>string</td>
 * <td>
 * The current file name. See also
 * __FILE__.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>class</td>
 * <td>string</td>
 * <td>
 * The current class name. See also
 * __CLASS__
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>object</td>
 * <td>object</td>
 * <td>
 * The current object.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>type</td>
 * <td>string</td>
 * <td>
 * The current call type. If a method call, "->" is returned. If a static
 * method call, "::" is returned. If a function call, nothing is returned.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>args</td>
 * <td>array</td>
 * <td>
 * If inside a function, this lists the functions arguments. If
 * inside an included file, this lists the included file name(s).
 * </td>
 * </tr>
 * </table>
 * @since 4.3.0
 * @since 5.0
 */
function debug_backtrace($options = DEBUG_BACKTRACE_PROVIDE_OBJECT, $limit = 0) { }

/**
 * Prints a backtrace
 *
 * @link  http://php.net/manual/en/function.debug-print-backtrace.php
 *
 * @param int $options [optional] <p>
 *                     As of 5.3.6, this parameter is a bitmask for the following options:
 *                     <table>
 *                     <b>debug_print_backtrace</b> options
 *                     <tr valign="top">
 *                     <td>DEBUG_BACKTRACE_IGNORE_ARGS</td>
 *                     <td>
 *                     Whether or not to omit the "args" index, and thus all the function/method arguments,
 *                     to save memory.
 *                     </td>
 *                     </tr>
 *                     </table>
 *                     </p>
 * @param int $limit   [optional] <p>
 *                     As of 5.4.0, this parameter can be used to limit the number of stack frames printed.
 *                     By default (<i>limit</i>=0) it prints all stack frames.
 *                     </p>
 *
 * @return void
 * @since 5.0
 */
function debug_print_backtrace($options = 0, $limit = 0) { }

/**
 * Clear the most recent error
 *
 * @link  http://php.net/manual/en/function.error-clear-last.php
 * @since 7.0
 */
function error_clear_last() { }

/**
 * Get the last occurred error
 *
 * @link  http://php.net/manual/en/function.error-get-last.php
 * @return array an associative array describing the last error with keys "type",
 * "message", "file" and "line". Returns &null; if there hasn't been an error
 * yet.
 * @since 5.2.0
 */
function error_get_last() { }

/**
 * Send an error message somewhere
 *
 * @link  http://php.net/manual/en/function.error-log.php
 *
 * @param string $message       <p>
 *                              The error message that should be logged.
 *                              </p>
 * @param int    $message_type  [optional] <p>
 *                              Says where the error should go. The possible message types are as
 *                              follows:
 *                              </p>
 *                              <p>
 *                              <table>
 *                              error_log log types
 *                              <tr valign="top">
 *                              <td>0</td>
 *                              <td>
 *                              message is sent to PHP's system logger, using
 *                              the Operating System's system logging mechanism or a file, depending
 *                              on what the error_log
 *                              configuration directive is set to. This is the default option.
 *                              </td>
 *                              </tr>
 *                              <tr valign="top">
 *                              <td>1</td>
 *                              <td>
 *                              message is sent by email to the address in
 *                              the destination parameter. This is the only
 *                              message type where the fourth parameter,
 *                              extra_headers is used.
 *                              </td>
 *                              </tr>
 *                              <tr valign="top">
 *                              <td>2</td>
 *                              <td>
 *                              No longer an option.
 *                              </td>
 *                              </tr>
 *                              <tr valign="top">
 *                              <td>3</td>
 *                              <td>
 *                              message is appended to the file
 *                              destination. A newline is not automatically
 *                              added to the end of the message string.
 *                              </td>
 *                              </tr>
 *                              <tr valign="top">
 *                              <td>4</td>
 *                              <td>
 *                              message is sent directly to the SAPI logging
 *                              handler.
 *                              </td>
 *                              </tr>
 *                              </table>
 *                              </p>
 * @param string $destination   [optional] <p>
 *                              The destination. Its meaning depends on the
 *                              message_type parameter as described above.
 *                              </p>
 * @param string $extra_headers [optional] <p>
 *                              The extra headers. It's used when the message_type
 *                              parameter is set to 1.
 *                              This message type uses the same internal function as
 *                              mail does.
 *                              </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function error_log($message, $message_type = null, $destination = null, $extra_headers = null) { }

/**
 * Sets which PHP errors are reported
 *
 * @link  http://php.net/manual/en/function.error-reporting.php
 *
 * @param int $level [optional] <p>
 *                   The new error_reporting
 *                   level. It takes on either a bitmask, or named constants. Using named
 *                   constants is strongly encouraged to ensure compatibility for future
 *                   versions. As error levels are added, the range of integers increases,
 *                   so older integer-based error levels will not always behave as expected.
 *                   </p>
 *                   <p>
 *                   The available error level constants and the actual
 *                   meanings of these error levels are described in the
 *                   predefined constants.
 *                   <table>
 *                   error_reporting level constants and bit values
 *                   <tr valign="top">
 *                   <td>value</td>
 *                   <td>constant</td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>1</td>
 *                   <td>
 *                   E_ERROR
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>2</td>
 *                   <td>
 *                   E_WARNING
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>4</td>
 *                   <td>
 *                   E_PARSE
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>8</td>
 *                   <td>
 *                   E_NOTICE
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>16</td>
 *                   <td>
 *                   E_CORE_ERROR
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>32</td>
 *                   <td>
 *                   E_CORE_WARNING
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>64</td>
 *                   <td>
 *                   E_COMPILE_ERROR
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>128</td>
 *                   <td>
 *                   E_COMPILE_WARNING
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>256</td>
 *                   <td>
 *                   E_USER_ERROR
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>512</td>
 *                   <td>
 *                   E_USER_WARNING
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>1024</td>
 *                   <td>
 *                   E_USER_NOTICE
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>6143</td>
 *                   <td>
 *                   E_ALL
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>2048</td>
 *                   <td>
 *                   E_STRICT
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>4096</td>
 *                   <td>
 *                   E_RECOVERABLE_ERROR
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>8192</td>
 *                   <td>
 *                   E_DEPRECATED
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td>16384</td>
 *                   <td>
 *                   E_USER_DEPRECATED
 *                   </td>
 *                   </tr>
 *                   </table>
 *                   </p>
 *
 * @return int the old error_reporting
 * level or the current level if no <i>level</i> parameter is
 * given.
 * @since 4.0
 * @since 5.0
 */
function error_reporting($level = null) { }

/**
 * Restores the previous error handler function
 *
 * @link  http://php.net/manual/en/function.restore-error-handler.php
 * @return bool This function always returns true.
 * @since 4.0.4
 * @since 5.0
 */
function restore_error_handler() { }

/**
 * Restores the previously defined exception handler function
 *
 * @link  http://php.net/manual/en/function.restore-exception-handler.php
 * @return bool This function always returns true.
 * @since 5.0
 */
function restore_exception_handler() { }

/**
 * Sets a user-defined error handler function
 *
 * @link  http://php.net/manual/en/function.set-error-handler.php
 *
 * @param callback $error_handler <p>
 *                                The user function needs to accept two parameters: the error code, and a
 *                                string describing the error. Then there are three optional parameters
 *                                that may be supplied: the filename in which the error occurred, the
 *                                line number in which the error occurred, and the context in which the
 *                                error occurred (an array that points to the active symbol table at the
 *                                point the error occurred). The function can be shown as:
 *                                </p>
 *                                <p>
 *                                <b>handler</b>
 *                                <b>int<i>errno</i></b>
 *                                <b>string<i>errstr</i></b>
 *                                <b>string<i>errfile</i></b>
 *                                <b>int<i>errline</i></b>
 *                                <b>array<i>errcontext</i></b>
 *                                <i>errno</i>
 *                                The first parameter, <i>errno</i>, contains the
 *                                level of the error raised, as an integer.
 * @param int      $error_types   [optional] <p>
 *                                Can be used to mask the triggering of the
 *                                <i>error_handler</i> function just like the error_reporting ini setting
 *                                controls which errors are shown. Without this mask set the
 *                                <i>error_handler</i> will be called for every error
 *                                regardless to the setting of the error_reporting setting.
 *                                </p>
 *
 * @return mixed a string containing the previously defined error handler (if any). If
 * the built-in error handler is used null is returned. null is also returned
 * in case of an error such as an invalid callback. If the previous error handler
 * was a class method, this function will return an indexed array with the class
 * and the method name.
 * @since 4.0.4
 * @since 5.0
 */
function set_error_handler($error_handler, $error_types = E_ALL | E_STRICT) { }

/**
 * Sets a user-defined exception handler function
 *
 * @link  http://php.net/manual/en/function.set-exception-handler.php
 *
 * @param callback $exception_handler <p>
 *                                    Name of the function to be called when an uncaught exception occurs.
 *                                    This function must be defined before calling
 *                                    <b>set_exception_handler</b>. This handler function
 *                                    needs to accept one parameter, which will be the exception object that
 *                                    was thrown.
 *                                    </p>
 *
 * @return callback the name of the previously defined exception handler, or null on error. If
 * no previous handler was defined, null is also returned.
 * @since 5.0
 */
function set_exception_handler($exception_handler) { }

/**
 * Generates a user-level error/warning/notice message
 *
 * @link  http://php.net/manual/en/function.trigger-error.php
 *
 * @param string $error_msg  <p>
 *                           The designated error message for this error. It's limited to 1024
 *                           characters in length. Any additional characters beyond 1024 will be
 *                           truncated.
 *                           </p>
 * @param int    $error_type [optional] <p>
 *                           The designated error type for this error. It only works with the E_USER
 *                           family of constants, and will default to <b>E_USER_NOTICE</b>.
 *                           </p>
 *
 * @return bool This function returns false if wrong <i>error_type</i> is
 * specified, true otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function trigger_error($error_msg, $error_type = E_USER_NOTICE) { }

/**
 * Alias of <b>trigger_error</b>
 *
 * @link  http://php.net/manual/en/function.user-error.php
 *
 * @param $message
 * @param $error_type [optional]
 *
 * @since 4.0
 * @since 5.0
 */
function user_error($message, $error_type) { }
