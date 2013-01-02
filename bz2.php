<?php

// Start of bz2 v.

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Opens a bzip2 compressed file
 * @link http://php.net/manual/en/function.bzopen.php
 * @param string $filename <p>
 * The name of the file to open.
 * </p>
 * @param string $mode <p>
 * Similar to the fopen function, only 'r' (read)
 * and 'w' (write) are supported. Everything else will cause bzopen
 * to return false.
 * </p>
 * @return resource If the open fails, bzopen returns false, otherwise
 * it returns a pointer to the newly opened file.
 */
function bzopen ($filename, $mode) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Binary safe bzip2 file read
 * @link http://php.net/manual/en/function.bzread.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file 
 * successfully opened by bzopen.
 * </p>
 * @param int $length [optional] <p>
 * If not specified, bzread will read 1024 
 * (uncompressed) bytes at a time.
 * </p>
 * @return string the uncompressed data, or false on error.
 */
function bzread ($bz, $length = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Binary safe bzip2 file write
 * @link http://php.net/manual/en/function.bzwrite.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file 
 * successfully opened by bzopen.
 * </p>
 * @param string $data <p>
 * The written data.
 * </p>
 * @param int $length [optional] <p>
 * If supplied, writing will stop after length 
 * (uncompressed) bytes have been written or the end of 
 * data is reached, whichever comes first.
 * </p>
 * @return int the number of bytes written, or false on error.
 */
function bzwrite ($bz, $data, $length = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Force a write of all buffered data
 * @link http://php.net/manual/en/function.bzflush.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file 
 * successfully opened by bzopen.
 * </p>
 * @return int true on success or false on failure.
 */
function bzflush ($bz) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Close a bzip2 file
 * @link http://php.net/manual/en/function.bzclose.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file 
 * successfully opened by bzopen.
 * </p>
 * @return int true on success or false on failure.
 */
function bzclose ($bz) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Returns a bzip2 error number
 * @link http://php.net/manual/en/function.bzerrno.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file 
 * successfully opened by bzopen.
 * </p>
 * @return int the error number as an integer.
 */
function bzerrno ($bz) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Returns a bzip2 error string
 * @link http://php.net/manual/en/function.bzerrstr.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file 
 * successfully opened by bzopen.
 * </p>
 * @return string a string containing the error message.
 */
function bzerrstr ($bz) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Returns the bzip2 error number and error string in an array
 * @link http://php.net/manual/en/function.bzerror.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file 
 * successfully opened by bzopen.
 * </p>
 * @return array an associative array, with the error code in the 
 * errno entry, and the error message in the
 * errstr entry.
 */
function bzerror ($bz) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Compress a string into bzip2 encoded data
 * @link http://php.net/manual/en/function.bzcompress.php
 * @param string $source <p>
 * The string to compress.
 * </p>
 * @param int $blocksize [optional] <p>
 * Specifies the blocksize used during compression and should be a number 
 * from 1 to 9 with 9 giving the best compression, but using more 
 * resources to do so.
 * </p>
 * @param int $workfactor [optional] <p>
 * Controls how the compression phase behaves when presented with worst
 * case, highly repetitive, input data. The value can be between 0 and
 * 250 with 0 being a special case. 
 * </p>
 * <p>
 * Regardless of the workfactor, the generated 
 * output is the same.
 * </p>
 * @return mixed The compressed string or number of error in case of error.
 */
function bzcompress ($source, $blocksize = null, $workfactor = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Decompresses bzip2 encoded data
 * @link http://php.net/manual/en/function.bzdecompress.php
 * @param string $source <p>
 * The string to decompress.
 * </p>
 * @param int $small [optional] <p>
 * If true, an alternative decompression algorithm will be used which
 * uses less memory (the maximum memory requirement drops to around 2300K) 
 * but works at roughly half the speed.
 * </p>
 * <p>
 * See the bzip2 documentation for more 
 * information about this feature.
 * </p>
 * @return mixed The decompressed string or number of error in case of error.
 */
function bzdecompress ($source, $small = null) {}

// End of bz2 v.
?>
