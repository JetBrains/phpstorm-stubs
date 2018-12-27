<?php

/**
 * Opens a bzip2 compressed file
 * @link https://php.net/manual/en/function.bzopen.php
 * @param string $filename <p>
 * The name of the file to open, or an existing stream resource.
 * </p>
 * @param string $mode <p>
 * Similar to the <b>fopen</b> function, only 'r' (read)
 * and 'w' (write) are supported. Everything else will cause bzopen
 * to return <b>FALSE</b>.
 * </p>
 * @return resource If the open fails, <b>bzopen</b> returns <b>FALSE</b>, otherwise
 * it returns a pointer to the newly opened file.
 * @since 4.0.4
 * @since 5.0
 */
function bzopen ($filename, $mode) {}

/**
 * Binary safe bzip2 file read
 * @link https://php.net/manual/en/function.bzread.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file
 * successfully opened by <b>bzopen</b>.
 * </p>
 * @param int $length [optional] <p>
 * If not specified, <b>bzread</b> will read 1024
 * (uncompressed) bytes at a time. A maximum of 8192
 * uncompressed bytes will be read at a time.
 * </p>
 * @return string the uncompressed data, or <b>FALSE</b> on error.
 * @since 4.0.4
 * @since 5.0
 */
function bzread ($bz, $length = 1024) {}

/**
 * Binary safe bzip2 file write
 * @link https://php.net/manual/en/function.bzwrite.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file
 * successfully opened by <b>bzopen</b>.
 * </p>
 * @param string $data <p>
 * The written data.
 * </p>
 * @param int $length [optional] <p>
 * If supplied, writing will stop after <i>length</i>
 * (uncompressed) bytes have been written or the end of
 * <i>data</i> is reached, whichever comes first.
 * </p>
 * @return int the number of bytes written, or <b>FALSE</b> on error.
 * @since 4.0.4
 * @since 5.0
 */
function bzwrite ($bz, $data, $length = null) {}

/**
 * Force a write of all buffered data
 * @link https://php.net/manual/en/function.bzflush.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file
 * successfully opened by <b>bzopen</b>.
 * </p>
 * @return int <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.4
 * @since 5.0
 */
function bzflush ($bz) {}

/**
 * Close a bzip2 file
 * @link https://php.net/manual/en/function.bzclose.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file
 * successfully opened by <b>bzopen</b>.
 * </p>
 * @return int <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.4
 * @since 5.0
 */
function bzclose ($bz) {}

/**
 * Returns a bzip2 error number
 * @link https://php.net/manual/en/function.bzerrno.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file
 * successfully opened by <b>bzopen</b>.
 * </p>
 * @return int the error number as an integer.
 * @since 4.0.4
 * @since 5.0
 */
function bzerrno ($bz) {}

/**
 * Returns a bzip2 error string
 * @link https://php.net/manual/en/function.bzerrstr.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file
 * successfully opened by <b>bzopen</b>.
 * </p>
 * @return string a string containing the error message.
 * @since 4.0.4
 * @since 5.0
 */
function bzerrstr ($bz) {}

/**
 * Returns the bzip2 error number and error string in an array
 * @link https://php.net/manual/en/function.bzerror.php
 * @param resource $bz <p>
 * The file pointer. It must be valid and must point to a file
 * successfully opened by <b>bzopen</b>.
 * </p>
 * @return array an associative array, with the error code in the
 * errno entry, and the error message in the
 * errstr entry.
 * @since 4.0.4
 * @since 5.0
 */
function bzerror ($bz) {}

/**
 * Compress a string into bzip2 encoded data
 * @link https://php.net/manual/en/function.bzcompress.php
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
 * Regardless of the <i>workfactor</i>, the generated
 * output is the same.
 * </p>
 * @return mixed The compressed string, or an error number if an error occurred.
 * @since 4.0.4
 * @since 5.0
 */
function bzcompress ($source, $blocksize = 4, $workfactor = 0) {}

/**
 * Decompresses bzip2 encoded data
 * @link https://php.net/manual/en/function.bzdecompress.php
 * @param string $source <p>
 * The string to decompress.
 * </p>
 * @param int $small [optional] <p>
 * If <b>TRUE</b>, an alternative decompression algorithm will be used which
 * uses less memory (the maximum memory requirement drops to around 2300K)
 * but works at roughly half the speed.
 * </p>
 * <p>
 * See the bzip2 documentation for more
 * information about this feature.
 * </p>
 * @return mixed The decompressed string, or an error number if an error occurred.
 * @since 4.0.4
 * @since 5.0
 */
function bzdecompress ($source, $small = 0) {}
