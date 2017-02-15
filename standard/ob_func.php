<?php
/**
 * Flush the output buffer
 *
 * @link  http://php.net/manual/en/function.flush.php
 * @return void
 * @since 4.0
 * @since 5.0
 */
function flush() { }

/**
 * Clean (erase) the output buffer
 *
 * @link  http://php.net/manual/en/function.ob-clean.php
 * @return void
 * @since 4.2.0
 * @since 5.0
 */
function ob_clean() { }

/**
 * Clean (erase) the output buffer and turn off output buffering
 *
 * @link  http://php.net/manual/en/function.ob-end-clean.php
 * @return bool true on success or false on failure. Reasons for failure are first that you called the
 * function without an active buffer or that for some reason a buffer could
 * not be deleted (possible for special buffer).
 * @since 4.0
 * @since 5.0
 */
function ob_end_clean() { }

/**
 * Flush (send) the output buffer and turn off output buffering
 *
 * @link  http://php.net/manual/en/function.ob-end-flush.php
 * @return bool true on success or false on failure. Reasons for failure are first that you called the
 * function without an active buffer or that for some reason a buffer could
 * not be deleted (possible for special buffer).
 * @since 4.0
 * @since 5.0
 */
function ob_end_flush() { }

/**
 * Flush (send) the output buffer
 *
 * @link  http://php.net/manual/en/function.ob-flush.php
 * @return void
 * @since 4.2.0
 * @since 5.0
 */
function ob_flush() { }

/**
 * Get current buffer contents and delete current output buffer
 *
 * @link  http://php.net/manual/en/function.ob-get-clean.php
 * @return string the contents of the output buffer and end output buffering.
 * If output buffering isn't active then false is returned.
 * @since 4.3.0
 * @since 5.0
 */
function ob_get_clean() { }

/**
 * Return the contents of the output buffer
 *
 * @link  http://php.net/manual/en/function.ob-get-contents.php
 * @return string This will return the contents of the output buffer or false, if output
 * buffering isn't active.
 * @since 4.0
 * @since 5.0
 */
function ob_get_contents() { }

/**
 * Flush the output buffer, return it as a string and turn off output buffering
 *
 * @link  http://php.net/manual/en/function.ob-get-flush.php
 * @return string the output buffer or false if no buffering is active.
 * @since 4.3.0
 * @since 5.0
 */
function ob_get_flush() { }

/**
 * Return the length of the output buffer
 *
 * @link  http://php.net/manual/en/function.ob-get-length.php
 * @return int the length of the output buffer contents or false if no
 * buffering is active.
 * @since 4.0.2
 * @since 5.0
 */
function ob_get_length() { }

/**
 * Return the nesting level of the output buffering mechanism
 *
 * @link  http://php.net/manual/en/function.ob-get-level.php
 * @return int the level of nested output buffering handlers or zero if output
 * buffering is not active.
 * @since 4.2.0
 * @since 5.0
 */
function ob_get_level() { }

/**
 * Get status of output buffers
 *
 * @link  http://php.net/manual/en/function.ob-get-status.php
 *
 * @param bool $full_status [optional] <p>
 *                          true to return all active output buffer levels. If false or not
 *                          set, only the top level output buffer is returned.
 *                          </p>
 *
 * @return array If called without the full_status parameter
 * or with full_status = false a simple array
 * with the following elements is returned:
 * 2
 * [type] => 0
 * [status] => 0
 * [name] => URL-Rewriter
 * [del] => 1
 * )
 * ]]>
 * Simple ob_get_status results
 * KeyValue
 * levelOutput nesting level
 * typePHP_OUTPUT_HANDLER_INTERNAL (0) or PHP_OUTPUT_HANDLER_USER (1)
 * statusOne of PHP_OUTPUT_HANDLER_START (0), PHP_OUTPUT_HANDLER_CONT (1) or PHP_OUTPUT_HANDLER_END (2)
 * nameName of active output handler or ' default output handler' if none is set
 * delErase-flag as set by ob_start
 * </p>
 * <p>
 * If called with full_status = true an array
 * with one element for each active output buffer level is returned.
 * The output level is used as key of the top level array and each array
 * element itself is another array holding status information
 * on one active output level.
 * Array
 * (
 * [chunk_size] => 0
 * [size] => 40960
 * [block_size] => 10240
 * [type] => 1
 * [status] => 0
 * [name] => default output handler
 * [del] => 1
 * )
 * [1] => Array
 * (
 * [chunk_size] => 0
 * [size] => 40960
 * [block_size] => 10240
 * [type] => 0
 * [buffer_size] => 0
 * [status] => 0
 * [name] => URL-Rewriter
 * [del] => 1
 * )
 * )
 * ]]>
 * </p>
 * <p>
 * The full output contains these additional elements:
 * Full ob_get_status results
 * KeyValue
 * chunk_sizeChunk size as set by ob_start
 * size...
 * blocksize...
 * @since 4.2.0
 * @since 5.0
 */
function ob_get_status($full_status = null) { }

/**
 * Turn implicit flush on/off
 *
 * @link  http://php.net/manual/en/function.ob-implicit-flush.php
 *
 * @param int $flag [optional] <p>
 *                  true to turn implicit flushing on, false otherwise.
 *                  </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function ob_implicit_flush($flag = null) { }

/**
 * List all output handlers in use
 *
 * @link  http://php.net/manual/en/function.ob-list-handlers.php
 * @return array This will return an array with the output handlers in use (if any). If
 * output_buffering is enabled or
 * an anonymous function was used with ob_start,
 * ob_list_handlers will return "default output
 * handler".
 * @since 4.3.0
 * @since 5.0
 */
function ob_list_handlers() { }

/**
 * Turn on output buffering
 *
 * @link  http://php.net/manual/en/function.ob-start.php
 *
 * @param callback $output_callback [optional] <p>
 *                                  An optional output_callback function may be
 *                                  specified. This function takes a string as a parameter and should
 *                                  return a string. The function will be called when
 *                                  the output buffer is flushed (sent) or cleaned (with
 *                                  ob_flush, ob_clean or similar
 *                                  function) or when the output buffer
 *                                  is flushed to the browser at the end of the request. When
 *                                  output_callback is called, it will receive the
 *                                  contents of the output buffer as its parameter and is expected to
 *                                  return a new output buffer as a result, which will be sent to the
 *                                  browser. If the output_callback is not a
 *                                  callable function, this function will return false.
 *                                  </p>
 *                                  <p>
 *                                  If the callback function has two parameters, the second parameter is
 *                                  filled with a bit-field consisting of
 *                                  PHP_OUTPUT_HANDLER_START,
 *                                  PHP_OUTPUT_HANDLER_CONT and
 *                                  PHP_OUTPUT_HANDLER_END.
 *                                  </p>
 *                                  <p>
 *                                  If output_callback returns false original
 *                                  input is sent to the browser.
 *                                  </p>
 *                                  <p>
 *                                  The output_callback parameter may be bypassed
 *                                  by passing a &null; value.
 *                                  </p>
 *                                  <p>
 *                                  ob_end_clean, ob_end_flush,
 *                                  ob_clean, ob_flush and
 *                                  ob_start may not be called from a callback
 *                                  function. If you call them from callback function, the behavior is
 *                                  undefined. If you would like to delete the contents of a buffer,
 *                                  return "" (a null string) from callback function.
 *                                  You can't even call functions using the output buffering functions like
 *                                  print_r($expression, true) or
 *                                  highlight_file($filename, true) from a callback
 *                                  function.
 *                                  </p>
 *                                  <p>
 *                                  In PHP 4.0.4, ob_gzhandler was introduced to
 *                                  facilitate sending gz-encoded data to web browsers that support
 *                                  compressed web pages. ob_gzhandler determines
 *                                  what type of content encoding the browser will accept and will return
 *                                  its output accordingly.
 *                                  </p>
 * @param int      $chunk_size      [optional] <p>
 *                                  If the optional parameter chunk_size is passed, the
 *                                  buffer will be flushed after any output call which causes the buffer's
 *                                  length to equal or exceed chunk_size.
 *                                  Default value 0 means that the function is called only in the end,
 *                                  other special value 1 sets chunk_size to 4096.
 *                                  </p>
 * @param bool     $erase           [optional] <p>
 *                                  If the optional parameter erase is set to false,
 *                                  the buffer will not be deleted until the script finishes.
 *                                  This causes that flushing and cleaning functions would issue a notice
 *                                  and return false if called.
 *                                  </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ob_start($output_callback = null, $chunk_size = null, $erase = null) { }

/**
 * Add URL rewriter values
 *
 * @link  http://php.net/manual/en/function.output-add-rewrite-var.php
 *
 * @param string $name  <p>
 *                      The variable name.
 *                      </p>
 * @param string $value <p>
 *                      The variable value.
 *                      </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function output_add_rewrite_var($name, $value) { }

/**
 * Reset URL rewriter values
 * <table>
 * <thead>
 * <tr>
 * <th>Version</th>
 * <th>Description</th>
 * </tr>
 *
 * </thead>
 *
 * <tbody>
 * <tr>
 * <td>7.1.0</td>
 * <td>
 * Before PHP 7.1.0, rewrite vars set by <span class="function"><a href="function.output-add-rewrite-var.php"
 * class="function">output_add_rewrite_var()</a></span> use the same Session module trans sid output buffer. Since
 * PHP 7.1.0, dedicated output buffer is used and {@see output_reset_rewrite_vars()} only removes rewrite vars
 * defined by {@see output_add_rewrite_var()}.
 * </td>
 * </tr>
 *
 * </tbody>
 *
 * </table>
 *
 * @link  http://php.net/manual/en/function.output-reset-rewrite-vars.php
 * @return bool true on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function output_reset_rewrite_vars() { }

