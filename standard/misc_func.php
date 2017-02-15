<?php
/**
 * PHPStorm stub file for Miscellaneous functions.
 *
 * @link http://php.net/manual/en/book.misc.php
 */

/**
 * Check whether client disconnected.
 *
 * @link  http://php.net/manual/en/function.connection-aborted.php
 *
 * @return int 1 if client disconnected, 0 otherwise.
 * @since 5.0.0
 */
function connection_aborted() { }

/**
 * Returns connection status bitfield
 *
 * @link  http://php.net/manual/en/function.connection-status.php
 * @return int the connection status bitfield, which can be used against the
 * CONNECTION_XXX constants to determine the connection
 * status.
 * @since 4.0
 * @since 5.0
 */
function connection_status() { }

/**
 * Returns the value of a constant
 *
 * @link  http://php.net/manual/en/function.constant.php
 *
 * @param string $name <p>
 *                     The constant name.
 *                     </p>
 *
 * @return mixed the value of the constant, or &null; if the constant is not
 * defined.
 * @since 4.0.4
 * @since 5.0
 */
function constant($name) { }

/**
 * Defines a named constant
 *
 * @link  http://php.net/manual/en/function.define.php
 *
 * @param string $name             <p>
 *                                 The name of the constant.
 *                                 </p>
 * @param mixed  $value            <p>
 *                                 The value of the constant; only scalar and null values are allowed.
 *                                 Scalar values are integer,
 *                                 float, string or boolean values. It is
 *                                 possible to define resource constants, however it is not recommended
 *                                 and may cause unpredictable behavior.
 *                                 </p>
 * @param bool   $case_insensitive [optional] <p>
 *                                 If set to true, the constant will be defined case-insensitive.
 *                                 The default behavior is case-sensitive; i.e.
 *                                 CONSTANT and Constant represent
 *                                 different values.
 *                                 </p>
 *                                 <p>
 *                                 Case-insensitive constants are stored as lower-case.
 *                                 </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function define($name, $value, $case_insensitive = false) { }

/**
 * Checks whether a given named constant exists
 *
 * @link  http://php.net/manual/en/function.defined.php
 *
 * @param string $name <p>
 *                     The constant name.
 *                     </p>
 *
 * @return bool true if the named constant given by <i>name</i>
 * has been defined, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function defined($name) { }

/**
 * <p>Terminates execution of the script. Shutdown functions and object destructors will always be executed even if
 * exit is called.</p>
 * <p>die is a language construct and it can be called without parentheses if no status is passed.</p>
 *
 * @link http://php.net/manual/en/function.die.php
 *
 * @param int|string $status [optional] <p>
 *                           If status is a string, this function prints the status just before exiting.
 *                           </p>
 *                           <p>
 *                           If status is an integer, that value will be used as the exit status and not printed.
 *                           Exit statuses should be in the range 0 to 254, the exit status 255 is reserved by PHP
 *                           and shall not be used. The status 0 is used to terminate the program successfully.
 *                           </p>
 *                           <p>
 *                           Note: PHP >= 4.2.0 does NOT print the status if it is an integer.
 *                           </p>
 *
 * @return void
 */
function PS_UNRESERVE_PREFIX_die($status = '') { }

/**
 * <p>Evaluates the given code as PHP.</p>
 * <p>Caution: The <b>eval()</b> language construct is very dangerous because it allows execution of arbitrary PHP
 * code. Its use thus is discouraged. If you have carefully verified that there is no other option than to use this
 * construct, pay special attention not to pass any user provided data into it without properly validating it
 * beforehand.</p>
 *
 * @link http://php.net/manual/en/function.eval.php
 *
 * @param string $code <p>
 *                     Valid PHP code to be evaluated.
 *                     </p>
 *                     <p>
 *                     The code must not be wrapped in opening and closing PHP tags, i.e. 'echo "Hi!";' must be
 *                     passed instead of '<?php echo "Hi!"; ?>'. It is still possible to leave and re-enter PHP
 *                     mode though using the appropriate PHP tags, e.g.
 *                     'echo "In PHP mode!"; ?>In HTML mode!<?php echo "Back in PHP mode!";'.
 *                     </p>
 *                     <p>
 *                     Apart from that the passed code must be valid PHP. This includes that all statements must be
 *                     properly terminated using a semicolon.
 *                     'echo "Hi!"' for example will cause a parse error, whereas 'echo "Hi!";' will work.
 *                     </p>
 *                     <p>
 *                     A return statement will immediately terminate the evaluation of the code.
 *                     </p>
 *                     <p>
 *                     The code will be executed in the scope of the code calling <b>eval()</b>. Thus any variables
 *                     defined or changed in the <b>eval()</b> call will remain visible after it terminates.
 *                     </p>
 *
 * @return mixed <b>NULL</b> unless return is called in the evaluated code, in which case the value passed to
 *               return is returned. As of PHP 7, if there is a parse error in the evaluated code, <b>eval()</b>
 *               throws a ParseError exception. Before PHP 7, in this case <b>eval()</b> returned <b>FALSE</b> and
 *               execution of the following code continued normally. It is not possible to catch a parse error in
 *               <b>eval()</b> using set_error_handler().
 */
function PS_UNRESERVE_PREFIX_eval($code) { }

/**
 * <p>Terminates execution of the script. Shutdown functions and object destructors will always be executed even if
 * exit is called.</p>
 * <p>exit is a language construct and it can be called without parentheses if no status is passed.</p>
 *
 * @link http://php.net/manual/en/function.exit.php
 *
 * @param int|string $status [optional] <p>
 *                           If status is a string, this function prints the status just before exiting.
 *                           </p>
 *                           <p>
 *                           If status is an integer, that value will be used as the exit status and not printed.
 *                           Exit statuses should be in the range 0 to 254, the exit status 255 is reserved by PHP
 *                           and shall not be used. The status 0 is used to terminate the program successfully.
 *                           </p>
 *                           <p>
 *                           Note: PHP >= 4.2.0 does NOT print the status if it is an integer.
 *                           </p>
 *
 * @return void
 */
function PS_UNRESERVE_PREFIX_exit($status = '') { }

/**
 * Tells what the user's browser is capable of
 *
 * @link  http://php.net/manual/en/function.get-browser.php
 *
 * @param string $user_agent   [optional] <p>
 *                             The User Agent to be analyzed. By default, the value of HTTP
 *                             User-Agent header is used; however, you can alter this (i.e., look up
 *                             another browser's info) by passing this parameter.
 *                             </p>
 *                             <p>
 *                             You can bypass this parameter with a &null; value.
 *                             </p>
 * @param bool   $return_array [optional] <p>
 *                             If set to true, this function will return an array
 *                             instead of an object.
 *                             </p>
 *
 * @return mixed The information is returned in an object or an array which will contain
 * various data elements representing, for instance, the browser's major and
 * minor version numbers and ID string; true/false values for features
 * such as frames, JavaScript, and cookies; and so forth.
 * </p>
 * <p>
 * The cookies value simply means that the browser
 * itself is capable of accepting cookies and does not mean the user has
 * enabled the browser to accept cookies or not. The only way to test if
 * cookies are accepted is to set one with setcookie,
 * reload, and check for the value.
 * @since 4.0
 * @since 5.0
 */
function get_browser($user_agent = null, $return_array = null) { }

/**
 * Halts the execution of the compiler.
 *
 * This can be useful to embed data in PHP scripts, like the installation files. Byte position of the data start can be
 * determined by the __COMPILER_HALT_OFFSET__ constant which is defined only if there is a __halt_compiler() presented
 * in the file.
 *
 * __Note:__ __halt_compiler() can only be used from the outermost scope.
 *
 * @link  http://php.net/manual/en/function.halt-compiler.php
 *
 * @return void
 * @since 5.1.0
 */
function __halt_compiler() { }

/**
 * Syntax highlighting of a file
 *
 * @link  http://php.net/manual/en/function.highlight-file.php
 *
 * @param string $filename <p>
 *                         Path to the PHP file to be highlighted.
 *                         </p>
 * @param bool   $return   [optional] <p>
 *                         Set this parameter to true to make this function return the
 *                         highlighted code.
 *                         </p>
 *
 * @return string|bool If return is set to true, returns the highlighted code as a string instead of printing it out.
 *     Otherwise, it will return true on success, false on failure.
 * @since 4.0
 * @since 5.0
 */
function highlight_file($filename, $return = null) { }

/**
 * Syntax highlighting of a string
 *
 * @link  http://php.net/manual/en/function.highlight-string.php
 *
 * @param string $str    <p>
 *                       The PHP code to be highlighted. This should include the opening tag.
 *                       </p>
 * @param bool   $return [optional] <p>
 *                       Set this parameter to true to make this function return the
 *                       highlighted code.
 *                       </p>
 *
 * @return string|bool If return is set to true, returns the highlighted code as a string instead of printing it out.
 *     Otherwise, it will return true on success, false on failure.
 * @since 4.0
 * @since 5.0
 */
function highlight_string($str, $return = null) { }

/**
 * Set whether a client disconnect should abort script execution
 *
 * @link  http://php.net/manual/en/function.ignore-user-abort.php
 *
 * @param string $value [optional] <p>
 *                      If set, this function will set the ignore_user_abort ini setting
 *                      to the given value. If not, this function will
 *                      only return the previous setting without changing it.
 *                      </p>
 *
 * @return int the previous setting, as an integer.
 * @since 4.0
 * @since 5.0
 */
function ignore_user_abort($value = null) { }

/**
 * Pack data into binary string
 *
 * @link  http://php.net/manual/en/function.pack.php
 *
 * @param string $format <p>
 *                       The format string consists of format codes
 *                       followed by an optional repeater argument. The repeater argument can
 *                       be either an integer value or * for repeating to
 *                       the end of the input data. For a, A, h, H the repeat count specifies
 *                       how many characters of one data argument are taken, for @ it is the
 *                       absolute position where to put the next data, for everything else the
 *                       repeat count specifies how many data arguments are consumed and packed
 *                       into the resulting binary string.
 *                       </p>
 *                       <p>
 *                       Currently implemented formats are:
 *                       <table>
 *                       pack format characters
 *                       <tr valign="top">
 *                       <td>Code</td>
 *                       <td>Description</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>a</td>
 *                       <td>NUL-padded string</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>A</td>
 *                       <td>SPACE-padded string</td></tr>
 *                       <tr valign="top">
 *                       <td>h</td>
 *                       <td>Hex string, low nibble first</td></tr>
 *                       <tr valign="top">
 *                       <td>H</td>
 *                       <td>Hex string, high nibble first</td></tr>
 *                       <tr valign="top"><td>c</td><td>signed char</td></tr>
 *                       <tr valign="top">
 *                       <td>C</td>
 *                       <td>unsigned char</td></tr>
 *                       <tr valign="top">
 *                       <td>s</td>
 *                       <td>signed short (always 16 bit, machine byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>S</td>
 *                       <td>unsigned short (always 16 bit, machine byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>n</td>
 *                       <td>unsigned short (always 16 bit, big endian byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>v</td>
 *                       <td>unsigned short (always 16 bit, little endian byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>i</td>
 *                       <td>signed integer (machine dependent size and byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>I</td>
 *                       <td>unsigned integer (machine dependent size and byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>l</td>
 *                       <td>signed long (always 32 bit, machine byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>L</td>
 *                       <td>unsigned long (always 32 bit, machine byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>N</td>
 *                       <td>unsigned long (always 32 bit, big endian byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>V</td>
 *                       <td>unsigned long (always 32 bit, little endian byte order)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>f</td>
 *                       <td>float (machine dependent size and representation)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>d</td>
 *                       <td>double (machine dependent size and representation)</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>x</td>
 *                       <td>NUL byte</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>X</td>
 *                       <td>Back up one byte</td>
 *                       </tr>
 *                       <tr valign="top">
 *                       <td>@</td>
 *                       <td>NUL-fill to absolute position</td>
 *                       </tr>
 *                       </table>
 *                       </p>
 * @param mixed  $args   [optional] <p>
 *                       </p>
 * @param mixed  $_      [optional]
 *
 * @return string a binary string containing data.
 * @since 4.0
 * @since 5.0
 */
function pack($format, $args = null, $_ = null) { }

/**
 * Return source with stripped comments and whitespace
 *
 * @link  http://php.net/manual/en/function.php-strip-whitespace.php
 *
 * @param string $filename <p>
 *                         Path to the PHP file.
 *                         </p>
 *
 * @return string The stripped source code will be returned on success, or an empty string
 * on failure.
 * </p>
 * <p>
 * This function works as described as of PHP 5.0.1. Before this it would
 * only return an empty string. For more information on this bug and its
 * prior behavior, see bug report
 * #29606.
 * @since 5.0
 */
function php_strip_whitespace($filename) { }

/**
 * &Alias; <function>highlight_file</function>
 *
 * @link  http://php.net/manual/en/function.show-source.php
 *
 * @param $file_name
 * @param $return [optional]
 *
 * @since 4.0
 * @since 5.0
 */
function show_source($file_name, $return) { }

/**
 * Delay execution
 *
 * @link  http://php.net/manual/en/function.sleep.php
 *
 * @param int $seconds <p>
 *                     Halt time in seconds.
 *                     </p>
 *
 * @return int zero on success, or false on errors. If the call was interrupted
 * by a signal, sleep returns the number of seconds left
 * to sleep.
 * @since 4.0
 * @since 5.0
 */
function sleep($seconds) { }

/**
 * Gets system load average
 *
 * @link  http://php.net/manual/en/function.sys-getloadavg.php
 * @return array an array with three samples (last 1, 5 and 15
 * minutes).
 * @since 5.1.3
 */
function sys_getloadavg() { }

/**
 * Delay for a number of seconds and nanoseconds
 *
 * @link  http://php.net/manual/en/function.time-nanosleep.php
 *
 * @param int $seconds     <p>
 *                         Must be a positive integer.
 *                         </p>
 * @param int $nanoseconds <p>
 *                         Must be a positive integer less than 1 billion.
 *                         </p>
 *
 * @return bool|array true on success or false on failure.
 * </p>
 * <p>
 * If the delay was interrupted by a signal, an associative array will be
 * returned with the components:
 * seconds - number of seconds remaining in
 * the delay
 * nanoseconds - number of nanoseconds
 * remaining in the delay
 * </p>
 * @since 5.0
 */
function time_nanosleep($seconds, $nanoseconds) { }

/**
 * Make the script sleep until the specified time
 *
 * @link  http://php.net/manual/en/function.time-sleep-until.php
 *
 * @param float $timestamp <p>
 *                         The timestamp when the script should wake.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.1.0
 */
function time_sleep_until($timestamp) { }

/**
 * Generate a unique ID
 *
 * @link  http://php.net/manual/en/function.uniqid.php
 *
 * @param string $prefix       [optional] <p>
 *                             Can be useful, for instance, if you generate identifiers
 *                             simultaneously on several hosts that might happen to generate the
 *                             identifier at the same microsecond.
 *                             </p>
 *                             <p>
 *                             With an empty prefix, the returned string will
 *                             be 13 characters long. If more_entropy is
 *                             true, it will be 23 characters.
 *                             </p>
 * @param bool   $more_entropy [optional] <p>
 *                             If set to true, uniqid will add additional
 *                             entropy (using the combined linear congruential generator) at the end
 *                             of the return value, which should make the results more unique.
 *                             </p>
 *
 * @return string the unique identifier, as a string.
 * @since 4.0
 * @since 5.0
 */
function uniqid($prefix = "", $more_entropy = false) { }

/**
 * Unpack data from binary string
 *
 * @link  http://php.net/manual/en/function.unpack.php
 *
 * @param string $format <p>
 *                       See pack for an explanation of the format codes.
 *                       </p>
 * @param string $data   <p>
 *                       The packed data.
 *                       </p>
 * @param int    $offset [optional]
 *
 * @return array an associative array containing unpacked elements of binary
 * string.
 * @since 4.0
 * @since 5.0
 */
function unpack($format, $data, $offset) { }

/**
 * Delay execution in microseconds
 *
 * @link  http://php.net/manual/en/function.usleep.php
 *
 * @param int $micro_seconds <p>
 *                           Halt time in micro seconds. A micro second is one millionth of a
 *                           second.
 *                           </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function usleep($micro_seconds) { }
