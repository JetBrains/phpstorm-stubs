<?php
/**
 * PHPStorm stub file for Zip functions.
 *
 * @link http://php.net/manual/en/book.zip.php
 */

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Close a ZIP file archive
 *
 * @link http://php.net/manual/en/function.zip-close.php
 *
 * @param resource $zip <p>
 *                      A ZIP file previously opened with <b>zip_open</b>.
 *                      </p>
 *
 * @return void No value is returned.
 */
function zip_close($zip) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Close a directory entry
 *
 * @link http://php.net/manual/en/function.zip-entry-close.php
 *
 * @param resource $zip_entry <p>
 *                            A directory entry previously opened <b>zip_entry_open</b>.
 *                            </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function zip_entry_close($zip_entry) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the compressed size of a directory entry
 *
 * @link http://php.net/manual/en/function.zip-entry-compressedsize.php
 *
 * @param resource $zip_entry <p>
 *                            A directory entry returned by <b>zip_read</b>.
 *                            </p>
 *
 * @return int The compressed size.
 */
function zip_entry_compressedsize($zip_entry) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the compression method of a directory entry
 *
 * @link http://php.net/manual/en/function.zip-entry-compressionmethod.php
 *
 * @param resource $zip_entry <p>
 *                            A directory entry returned by <b>zip_read</b>.
 *                            </p>
 *
 * @return string The compression method.
 */
function zip_entry_compressionmethod($zip_entry) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the actual file size of a directory entry
 *
 * @link http://php.net/manual/en/function.zip-entry-filesize.php
 *
 * @param resource $zip_entry <p>
 *                            A directory entry returned by <b>zip_read</b>.
 *                            </p>
 *
 * @return int The size of the directory entry.
 */
function zip_entry_filesize($zip_entry) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the name of a directory entry
 *
 * @link http://php.net/manual/en/function.zip-entry-name.php
 *
 * @param resource $zip_entry <p>
 *                            A directory entry returned by <b>zip_read</b>.
 *                            </p>
 *
 * @return string The name of the directory entry.
 */
function zip_entry_name($zip_entry) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Open a directory entry for reading
 *
 * @link http://php.net/manual/en/function.zip-entry-open.php
 *
 * @param resource $zip       <p>
 *                            A valid resource handle returned by <b>zip_open</b>.
 *                            </p>
 * @param resource $zip_entry <p>
 *                            A directory entry returned by <b>zip_read</b>.
 *                            </p>
 * @param string   $mode      [optional] <p>
 *                            Any of the modes specified in the documentation of
 *                            <b>fopen</b>.
 *                            </p>
 *                            <p>
 *                            Currently, <i>mode</i> is ignored and is always
 *                            "rb". This is due to the fact that zip support
 *                            in PHP is read only access.
 *                            </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Unlike <b>fopen</b> and other similar functions,
 * the return value of <b>zip_entry_open</b> only
 * indicates the result of the operation and is not needed for
 * reading or closing the directory entry.
 */
function zip_entry_open($zip, $zip_entry, $mode = null) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Read from an open directory entry
 *
 * @link http://php.net/manual/en/function.zip-entry-read.php
 *
 * @param resource $zip_entry <p>
 *                            A directory entry returned by <b>zip_read</b>.
 *                            </p>
 * @param int      $length    [optional] <p>
 *                            The number of bytes to return.
 *                            </p>
 *                            <p>
 *                            This should be the uncompressed length you wish to read.
 *                            </p>
 *
 * @return string the data read, empty string on end of a file, or <b>FALSE</b> on error.
 */
function zip_entry_read($zip_entry, $length = 1024) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Open a ZIP file archive
 *
 * @link http://php.net/manual/en/function.zip-open.php
 *
 * @param string $filename <p>
 *                         The file name of the ZIP archive to open.
 *                         </p>
 *
 * @return resource a resource handle for later use with
 * <b>zip_read</b> and <b>zip_close</b>
 * or returns the number of error if <i>filename</i> does not
 * exist or in case of other error.
 */
function zip_open($filename) { }

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Read next entry in a ZIP file archive
 *
 * @link http://php.net/manual/en/function.zip-read.php
 *
 * @param resource $zip <p>
 *                      A ZIP file previously opened with <b>zip_open</b>.
 *                      </p>
 *
 * @return resource a directory entry resource for later use with the
 * zip_entry_... functions, or <b>FALSE</b> if
 * there are no more entries to read, or an error code if an error
 * occurred.
 */
function zip_read($zip) { }
