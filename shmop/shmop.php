<?php

// Start of shmop v.
use JetBrains\PhpStorm\Deprecated;
use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;

#[PhpStormStubsElementAvailable('8.0')]
/**
 * Create or open shared memory block
 * @link https://php.net/manual/en/function.shmop-open.php
 * @param int $key <p>
 * System's id for the shared memory block.
 * Can be passed as a decimal or hex.
 * </p>
 * @param int $mode <p>
 * The flags that you can use:
 * "a" for access (sets SHM_RDONLY for shmat)
 * use this flag when you need to open an existing shared memory
 * segment for read only
 * @param int $permissions <p>
 * The permissions that you wish to assign to your memory segment, those
 * are the same as permission for a file. Permissions need to be passed
 * in octal form, like for example 0644
 * </p>
 * @param int $size <p>
 * The size of the shared memory block you wish to create in bytes
 * </p>
 * @return false|Shmop On success <b>shmop_open</b> will return an id that you can
 * use to access the shared memory segment you've created. <b>FALSE</b> is
 * returned on failure.
 */
function shmop_open ($key, $mode, $permissions, $size) {}

#[PhpStormStubsElementAvailable(to: '7.4')]
/**
 * Create or open shared memory block
 * @link https://php.net/manual/en/function.shmop-open.php
 * @param int $key <p>
 * System's id for the shared memory block.
 * Can be passed as a decimal or hex.
 * </p>
 * @param int $mode <p>
 * The flags that you can use:
 * "a" for access (sets SHM_RDONLY for shmat)
 * use this flag when you need to open an existing shared memory
 * segment for read only
 * @param int $permissions <p>
 * The permissions that you wish to assign to your memory segment, those
 * are the same as permission for a file. Permissions need to be passed
 * in octal form, like for example 0644
 * </p>
 * @param int $size <p>
 * The size of the shared memory block you wish to create in bytes
 * </p>
 * @return resource|false On success <b>shmop_open</b> will return an id that you can
 * use to access the shared memory segment you've created. <b>FALSE</b> is
 * returned on failure.
 */
function shmop_open ($key, $mode, $permissions, $size) {}

/**
 * Read data from shared memory block
 * @link https://php.net/manual/en/function.shmop-read.php
 * @param resource $shmop <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @param int $offset <p>
 * Offset from which to start reading
 * </p>
 * @param int $size <p>
 * The number of bytes to read
 * </p>
 * @return string|false the data or <b>FALSE</b> on failure.
 */
function shmop_read ($shmop, $offset, $size) {}

/**
 * Close shared memory block
 * @link https://php.net/manual/en/function.shmop-close.php
 * @param resource $shmop <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @return void No value is returned.
 */
#[Deprecated(since: '8.0')]
function shmop_close ($shmop) {}

/**
 * Get size of shared memory block
 * @link https://php.net/manual/en/function.shmop-size.php
 * @param resource $shmop <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @return int an int, which represents the number of bytes the shared memory
 * block occupies.
 */
function shmop_size ($shmop) {}

/**
 * Write data into shared memory block
 * @link https://php.net/manual/en/function.shmop-write.php
 * @param resource $shmop <p>
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
 */
function shmop_write ($shmop, $data, $offset) {}

/**
 * Delete shared memory block
 * @link https://php.net/manual/en/function.shmop-delete.php
 * @param resource $shmop <p>
 * The shared memory block identifier created by
 * <b>shmop_open</b>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function shmop_delete ($shmop) {}

/**
 * @since 8.0
 */
final class Shmop{}

// End of shmop v.
?>
