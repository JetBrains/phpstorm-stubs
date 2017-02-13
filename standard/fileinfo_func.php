<?php
/**
 * PHPStorm stub file for File Information functions.
 *
 * @link http://php.net/manual/en/book.fileinfo.php
 */

/**
 * Return information about a string buffer.
 *
 * @link http://php.net/manual/en/function.finfo-buffer.php
 *
 * @param resource $finfo   <p>
 *                          Fileinfo resource returned by finfo_open.
 *                          </p>
 * @param string   $string  <p>
 *                          Content of a file to be checked.
 *                          </p>
 * @param int      $options [optional] <p>
 *                          One or disjunction of more Fileinfo
 *                          constants.
 *                          </p>
 * @param resource $context [optional] <p>
 *                          </p>
 * @param string   $string
 * @param int      $options [optional] One or disjunction of more
 *                          <a href="http://hu.php.net/manual/en/fileinfo.constants.php">Fileinfo</a> constants.
 * @param resource $context [optional]
 *
 * @return string|false a textual description of the <i>string</i> argument, or <b>FALSE</b> if an error occurred.
 * @since 5.3.0
 */
function finfo_buffer($finfo, $string, $options = FILEINFO_NONE, $context = null) { }

/**
 * Close fileinfo resource
 *
 * @link http://php.net/manual/en/function.finfo-close.php
 *
 * @param resource $finfo <p>
 *                        Fileinfo resource returned by finfo_open.
 *                        </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.3.0
 */
function finfo_close($finfo) { }

/**
 * Return information about a file.
 *
 * @link http://php.net/manual/en/function.finfo-file.php
 *
 * @param resource $finfo     <p>
 *                            Fileinfo resource returned by finfo_open.
 *                            </p>
 * @param string   $file_name <p>
 *                            Name of a file to be checked.
 *                            </p>
 * @param int      $options   [optional] <p>
 *                            One or disjunction of more Fileinfo
 *                            constants.
 *                            </p>
 * @param resource $context   [optional] <p>
 *                            For a description of contexts, refer to .
 *                            </p>
 *
 * @return string|false a textual description of the contents of the <i>filename</i> argument, or <b>FALSE</b> if an error occurred.
 * @since 5.3.0
 */
function finfo_file($finfo, $file_name, $options = null, $context = null) { }

/**
 * Create a new fileinfo resource
 *
 * @link http://php.net/manual/en/function.finfo-open.php
 *
 * @param int    $options    [optional] <p>
 *                           One or disjunction of more Fileinfo
 *                           constants.
 *                           </p>
 * @param string $magic_file [optional] <p>
 *                           Name of a magic database file, usually something like
 *                           /path/to/magic.mime. If not specified,
 *                           the MAGIC environment variable is used. If this variable
 *                           is not set either, /usr/share/misc/magic is used by default.
 *                           A .mime and/or .mgc suffix is added if
 *                           needed.
 *                           </p>
 *
 * @return resource|false a magic database resource on success or <b>FALSE</b> on failure.
 * @since 5.3.0
 */
function finfo_open($options = null, $magic_file = null) { }

/**
 * Set libmagic configuration options
 *
 * @link http://php.net/manual/en/function.finfo-set-flags.php
 *
 * @param resource $finfo   <p>
 *                          Fileinfo resource returned by finfo_open.
 *                          </p>
 * @param int      $options <p>
 *                          One or disjunction of more Fileinfo
 *                          constants.
 *                          </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.3.0
 */
function finfo_set_flags($finfo, $options) { }

/**
 * Detect MIME Content-type for a file.
 *
 * @link  http://php.net/manual/en/function.mime-content-type.php
 *
 * @param string $filename <p>
 *                         Path to the tested file.
 *                         </p>
 *
 * @return string the content type in MIME format, like text/plain or application/octet-stream.
 * @since 4.3.0
 * @since 5.0
 * @since 7.0
 */
function mime_content_type($filename) { }

