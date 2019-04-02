<?php

// Start of shmop v.

/**
 * Create or open shared memory block
 * @link https://php.net/manual/en/function.shmop-open.php
 * @param int $key <p>
 * System's id for the shared memory block.
 * Can be passed as a decimal or hex.
 * </p>
 * @param string $flags <p>
 * The flags that you can use:
 * "a" for access (sets SHM_RDONLY for shmat)
 * use this flag when you need to open an existing shared memory
 * segment for read only
 * @param int $mode <p>
 * The permissions that you wish to assign to your memory segment, those
 * are the same as permission for a file. Permissions need to be passed
 * in octal form, like for example 0644
 * </p>
 * @param int $size <p>
 * The size of the shared memory block you wish to create in bytes
 * </p>
 * @return resource On success <b>shmop_open</b> will return an id that you can
 * use to access the shared memory segment you've created. <b>FALSE</b> is
 * returned on failure.
 * @since 4.0.4
 * @since 5.0
 */
function shmop_open ($key, $flags, $mode, $size) {}

/**
 * Read data from shared memory block
 * @link https://php.net/manual/en/function.shmop-read.php
 * @param resource $shmid <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @param int $start <p>
 * Offset from which to start reading
 * </p>
 * @param int $count <p>
 * The number of bytes to read
 * </p>
 * @return string|false the data or <b>FALSE</b> on failure.
 * @since 4.0.4
 * @since 5.0
 */
function shmop_read ($shmid, $start, $count) {}

/**
 * Close shared memory block
 * @link https://php.net/manual/en/function.shmop-close.php
 * @param resource $shmid <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @return void No value is returned.
 * @since 4.0.4
 * @since 5.0
 */
function shmop_close ($shmid) {}

/**
 * Get size of shared memory block
 * @link https://php.net/manual/en/function.shmop-size.php
 * @param resource $shmid <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @return int an int, which represents the number of bytes the shared memory
 * block occupies.
 * @since 4.0.4
 * @since 5.0
 */
function shmop_size ($shmid) {}

/**
 * Write data into shared memory block
 * @link https://php.net/manual/en/function.shmop-write.php
 * @param resource $shmid <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @param string $data <p>
 * A string to write into shared memory block
 * </p>
 * @param int $offset <p>
 * Specifies where to start writing data inside the shared memory
 * segment.
 * </p>
 * @return int|false The size of the written <i>data</i>, or <b>FALSE</b> on
 * failure.
 * @since 4.0.4
 * @since 5.0
 */
function shmop_write ($shmid, $data, $offset) {}

/**
 * Delete shared memory block
 * @link https://php.net/manual/en/function.shmop-delete.php
 * @param resource $shmid <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.4
 * @since 5.0
 */
function shmop_delete ($shmid) {}

// End of shmop v.
?>
