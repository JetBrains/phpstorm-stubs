<?php

// Start of sysvshm v.
use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;

#[PhpStormStubsElementAvailable('8.0')]
/**
 * Creates or open a shared memory segment
 * @link https://php.net/manual/en/function.shm-attach.php
 * @param int $key <p>
 * A numeric shared memory segment ID
 * </p>
 * @param int $size [optional] <p>
 * The memory size. If not provided, default to the
 * sysvshm.init_mem in the <i>php.ini</i>, otherwise 10000
 * bytes.
 * </p>
 * @param int $permissions [optional] <p>
 * The optional permission bits. Default to 0666.
 * </p>
 * @return SysvSharedMemory a shared memory segment identifier.
 */
function shm_attach ($key, $size = null, $permissions = 0666) {}

#[PhpStormStubsElementAvailable('5.3','8.0')]
/**
 * Creates or open a shared memory segment
 * @link https://php.net/manual/en/function.shm-attach.php
 * @param int $key <p>
 * A numeric shared memory segment ID
 * </p>
 * @param int $size [optional] <p>
 * The memory size. If not provided, default to the
 * sysvshm.init_mem in the <i>php.ini</i>, otherwise 10000
 * bytes.
 * </p>
 * @param int $permissions [optional] <p>
 * The optional permission bits. Default to 0666.
 * </p>
 * @return resource a shared memory segment identifier.
 */
function shm_attach ($key, $size = null, $permissions = 0666) {}

/**
 * Removes shared memory from Unix systems
 * @link https://php.net/manual/en/function.shm-remove.php
 * @param resource $shm <p>
 * The shared memory identifier as returned by
 * <b>shm_attach</b>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function shm_remove ($shm) {}

/**
 * Disconnects from shared memory segment
 * @link https://php.net/manual/en/function.shm-detach.php
 * @param resource $shm <p>
 * A shared memory resource handle as returned by
 * <b>shm_attach</b>
 * </p>
 * @return bool <b>shm_detach</b> always returns <b>TRUE</b>.
 */
function shm_detach ($shm) {}

/**
 * Inserts or updates a variable in shared memory
 * @link https://php.net/manual/en/function.shm-put-var.php
 * @param resource $shm <p>
 * A shared memory resource handle as returned by
 * <b>shm_attach</b>
 * </p>
 * @param int $key <p>
 * The variable key.
 * </p>
 * @param mixed $value <p>
 * The variable. All variable types
 * that <b>serialize</b> supports may be used: generally
 * this means all types except for resources and some internal objects
 * that cannot be serialized.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function shm_put_var ($shm, $key, $value) {}

/**
 * Check whether a specific entry exists
 * @link https://php.net/manual/en/function.shm-has-var.php
 * @param resource $shm <p>
 * Shared memory segment, obtained from <b>shm_attach</b>.
 * </p>
 * @param int $key <p>
 * The variable key.
 * </p>
 * @return bool <b>TRUE</b> if the entry exists, otherwise <b>FALSE</b>
 */
function shm_has_var ($shm, $key) {}

/**
 * Returns a variable from shared memory
 * @link https://php.net/manual/en/function.shm-get-var.php
 * @param resource $shm <p>
 * Shared memory segment, obtained from <b>shm_attach</b>.
 * </p>
 * @param int $key <p>
 * The variable key.
 * </p>
 * @return mixed the variable with the given key.
 */
function shm_get_var ($shm, $key) {}

/**
 * Removes a variable from shared memory
 * @link https://php.net/manual/en/function.shm-remove-var.php
 * @param resource $shm <p>
 * The shared memory identifier as returned by
 * <b>shm_attach</b>
 * </p>
 * @param int $key <p>
 * The variable key.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function shm_remove_var ($shm, $key) {}

/**
 * @since 8.0
 */
final class SysvSharedMemory{
    /**
     * Cannot directly construct SysvSharedMemory, use shm_attach() instead
     * @see shm_attach()
     */
    private function __construct(){}
}


// End of sysvshm v.
?>
