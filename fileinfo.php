<?php

// Start of fileinfo v.1.0.5-dev

class finfo  {

	/**
	 * @param $options [optional]
	 * @param $arg [optional]
	 */
	public function finfo ($options, $arg) {}

	/**
	 * @param $options
	 */
	public function set_flags ($options) {}

    /**
     * Return information about a file
     * @link http://docs.php.net/finfo_file
     * @param string $filename Fileinfo Name of a file to be checked.
     * @param int $options [optional] One or disjunction of more Fileinfo constants.
     * @param resource $context [optional] For a description of contexts, refer to Stream Functions.
     * @return string textual description of the contents of the filename argument, or FALSE if an error occurred
     */
	public function file ($filename = NULL, $options = FILEINFO_NONE, $context = NULL) {}

    /**
     * (PHP 5 &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
     * Return information about a string buffer
     * @link http://php.net/manual/en/function.finfo-buffer.php
     * @param string $string <p>
     * Content of a file to be checked.
     * </p>
     * @param int $options [optional] <p>
     * One or disjunction of more Fileinfo
     * constants.
     * </p>
     * @param resource $context [optional] <p>
     * </p>
     * @param string $string Content of a file to be checked.
     * @param int $options [optional] One or disjunction of more
     * <a href="http://hu.php.net/manual/en/fileinfo.constants.php">Fileinfo</a> constants.
     * @param resource $context [optional]
     * @return string a textual description of the string
     * argument, or false if an error occurred.
     */
    public function buffer ($string, $options = FILEINFO_NONE, $context = NULL) {}

}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Create a new fileinfo resource
 * @link http://php.net/manual/en/function.finfo-open.php
 * @param int $options [optional] <p>
 * One or disjunction of more Fileinfo
 * constants.
 * </p>
 * @param string $magic_file [optional] <p>
 * Name of a magic database file, usually something like
 * /path/to/magic.mime. If not specified,
 * the MAGIC environment variable is used. If this variable
 * is not set either, /usr/share/misc/magic is used by default.
 * A .mime and/or .mgc suffix is added if
 * needed.
 * </p>
 * @return resource a magic database resource on success or false on failure.
 */
function finfo_open ($options = null, $magic_file = null) {}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Close fileinfo resource
 * @link http://php.net/manual/en/function.finfo-close.php
 * @param resource $finfo <p>
 * Fileinfo resource returned by finfo_open.
 * </p>
 * @return bool true on success or false on failure.
 */
function finfo_close ($finfo) {}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Set libmagic configuration options
 * @link http://php.net/manual/en/function.finfo-set-flags.php
 * @param resource $finfo <p>
 * Fileinfo resource returned by finfo_open.
 * </p>
 * @param int $options <p>
 * One or disjunction of more Fileinfo
 * constants.
 * </p>
 * @return bool true on success or false on failure.
 */
function finfo_set_flags ($finfo, $options) {}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Return information about a file
 * @link http://php.net/manual/en/function.finfo-file.php
 * @param resource $finfo <p>
 * Fileinfo resource returned by finfo_open.
 * </p>
 * @param string $file_name <p>
 * Name of a file to be checked.
 * </p>
 * @param int $options [optional] <p>
 * One or disjunction of more Fileinfo
 * constants.
 * </p>
 * @param resource $context [optional] <p>
 * For a description of contexts, refer to .
 * </p>
 * @return string a textual description of the contents of the
 * filename argument, or false if an error occurred.
 */
function finfo_file ($finfo, $file_name, $options = null, $context = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Return information about a string buffer
 * @link http://php.net/manual/en/function.finfo-buffer.php
 * @param resource $finfo <p>
 * Fileinfo resource returned by finfo_open.
 * </p>
 * @param string $string <p>
 * Content of a file to be checked.
 * </p>
 * @param int $options [optional] <p>
 * One or disjunction of more Fileinfo
 * constants.
 * </p>
 * @param resource $context [optional] <p>
 * </p>
 * @param string $string 
 * @param int $options [optional] One or disjunction of more
 * <a href="http://hu.php.net/manual/en/fileinfo.constants.php">Fileinfo</a> constants.
 * @param resource $context [optional] 
 * @return string a textual description of the string
 * argument, or false if an error occurred.
 */
function finfo_buffer ($finfo ,$string, $options = FILEINFO_NONE, $context = NULL) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Detect MIME Content-type for a file (deprecated)
 * @link http://php.net/manual/en/function.mime-content-type.php
 * @param string $filename <p>
 * Path to the tested file.
 * </p>
 * @return string the content type in MIME format, like 
 * text/plain or application/octet-stream.
 */
function mime_content_type ($filename) {}


/**
 * No special handling.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_NONE', 0);

/**
 * Follow symlinks.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_SYMLINK', 2);

/**
 * Return the mime type and mime encoding as defined by RFC 2045.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_MIME', 1040);

/**
 * Return the mime type.
 * Available since PHP 5.3.0.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_MIME_TYPE', 16);

/**
 * Return the mime encoding of the file.
 * Available since PHP 5.3.0.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_MIME_ENCODING', 1024);

/**
 * Look at the contents of blocks or character special devices.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_DEVICES', 8);

/**
 * Return all matches, not just the first.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_CONTINUE', 32);

/**
 * If possible preserve the original access time.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_PRESERVE_ATIME', 128);

/**
 * Don't translate unprintable characters to a \ooo octal
 * representation.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_RAW', 256);

// End of fileinfo v.1.0.5-dev
?>
