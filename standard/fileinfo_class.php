<?php
/**
 * PHPStorm stub file for File Information classes.
 *
 * @link http://php.net/manual/en/book.fileinfo.php
 */

/**
 * This class provides an object oriented interface into the fileinfo functions.
 *
 * @link http://php.net/manual/en/class.finfo.php
 * @since 5.3.0
 */
class finfo
{
    /**
     * Alias of finfo_open().
     *
     * @link http://php.net/manual/en/finfo.construct.php
     *
     * @param int    $options    [optional] One or disjunction of more Fileinfo constants.
     * @param string $magic_file [optional] Name of a magic database file, usually something like /path/to/magic.mime.
     *                           If not specified, the MAGIC environment variable is used. If the environment variable
     *                           isn't set, then PHP's bundled magic database will be used. Passing NULL or an empty
     *                           string will be equivalent to the default value.
     *
     * @since 5.3.0
     */
    public function __construct($options = FILEINFO_NONE, $magic_file = null) { }

    /**
     * Alias of finfo_buffer().
     *
     * Return information about a string buffer.
     *
     * @link http://php.net/manual/en/function.finfo-buffer.php
     *
     * @param string   $string  [optional] <p>
     *                          Content of a file to be checked.
     *                          </p>
     * @param int      $options [optional] <p>
     *                          One or disjunction of more Fileinfo
     *                          constants.
     *                          </p>
     * @param resource $context [optional]
     *
     * @return string a textual description of the <i>string</i> argument, or <b>FALSE</b> if an error occurred.
     * @since 5.3.0
     */
    public function buffer($string = null, $options = FILEINFO_NONE, $context = null) { }

    /**
     * Alias of finfo_file().
     *
     * Return information about a file.
     *
     * @link http://php.net/manual/en/function.finfo-file.php
     *
     * @param string   $file_name [optional] <p>
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
     * @return string a textual description of the contents of the <i>filename</i> argument, or <b>FALSE</b> if an error occurred.
     * @since 5.3.0
     */
    public function file($file_name = null, $options = FILEINFO_NONE, $context = null) { }

    /**
     * Alias of finfo_set_flags().
     *
     * Set libmagic configuration options.
     *
     * @link http://php.net/manual/en/function.finfo-set-flags.php
     *
     * @param int $options <p>
     *                     One or disjunction of more Fileinfo
     *                     constants.
     *                     </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.3.0
     */
    public function set_flags($options) { }
}
