<?php

// Start of sysvshm v.

/**
 * (PHP 4, PHP 5)<br/>
 * Creates or open a shared memory segment
 * @link http://php.net/manual/en/function.shm-attach.php
 * @param int $key <p>
 * A numeric shared memory segment ID
 * </p>
 * @param int $memsize [optional] <p>
 * The memory size. If not provided, default to the
 * sysvshm.init_mem in the &php.ini;, otherwise 10000
 * bytes.
 * </p>
 * @param int $perm [optional] <p>
 * The optional permission bits. Default to 0666.
 * </p>
 * @return resource a shared memory segment identifier.
 */
function shm_attach ($key, $memsize = null, $perm = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Removes shared memory from Unix systems
 * @link http://php.net/manual/en/function.shm-remove.php
 * @param resource $shm_identifier <p>
 * The shared memory identifier as returned by
 * shm_attach
 * </p>
 * @return bool true on success or false on failure.
 */
function shm_remove ($shm_identifier) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Disconnects from shared memory segment
 * @link http://php.net/manual/en/function.shm-detach.php
 * @param resource $shm_identifier <p>
 * A shared memory resource handle as returned by
 * shm_attach
 * </p>
 * @return bool shm_detach always returns true.
 */
function shm_detach ($shm_identifier) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Inserts or updates a variable in shared memory
 * @link http://php.net/manual/en/function.shm-put-var.php
 * @param resource $shm_identifier <p>
 * A shared memory resource handle as returned by
 * shm_attach
 * </p>
 * @param int $variable_key <p>
 * The variable key.
 * </p>
 * @param mixed $variable <p>
 * The variable. All variable-types
 * are supported.
 * </p>
 * @return bool true on success or false on failure.
 */
function shm_put_var ($shm_identifier, $variable_key, $variable) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Check whether a specific entry exists
 * @link http://php.net/manual/en/function.shm-has-var.php
 * @param resource $shm_identifier <p>
 * Shared memory segment, obtained from shm_attach.
 * </p>
 * @param int $variable_key <p>
 * The variable key.
 * </p>
 * @return bool true if the entry exists, otherwise false
 */
function shm_has_var ($shm_identifier, $variable_key) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Returns a variable from shared memory
 * @link http://php.net/manual/en/function.shm-get-var.php
 * @param resource $shm_identifier <p>
 * Shared memory segment, obtained from shm_attach.
 * </p>
 * @param int $variable_key <p>
 * The variable key.
 * </p>
 * @return mixed the variable with the given key.
 */
function shm_get_var ($shm_identifier, $variable_key) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Removes a variable from shared memory
 * @link http://php.net/manual/en/function.shm-remove-var.php
 * @param resource $shm_identifier <p>
 * The shared memory identifier as returned by
 * shm_attach
 * </p>
 * @param int $variable_key <p>
 * The variable key.
 * </p>
 * @return bool true on success or false on failure.
 */
function shm_remove_var ($shm_identifier, $variable_key) {}

// End of sysvshm v.
?>
