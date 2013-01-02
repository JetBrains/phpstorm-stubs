<?php

// Start of sysvsem v.

/**
 * (PHP 4, PHP 5)<br/>
 * Get a semaphore id
 * @link http://php.net/manual/en/function.sem-get.php
 * @param int $key <p>
 * </p>
 * @param int $max_acquire [optional] <p>
 * The number of processes that can acquire the semaphore simultaneously
 * is set to max_acquire.
 * </p>
 * @param int $perm [optional] <p>
 * The semaphore permissions. Actually this value is
 * set only if the process finds it is the only process currently
 * attached to the semaphore.
 * </p>
 * @param int $auto_release [optional] <p>
 * Specifies if the semaphore should be automatically released on request
 * shutdown.
 * </p>
 * @return resource a positive semaphore identifier on success, or false on
 * error.
 */
function sem_get ($key, $max_acquire = null, $perm = null, $auto_release = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Acquire a semaphore
 * @link http://php.net/manual/en/function.sem-acquire.php
 * @param resource $sem_identifier <p>
 * sem_identifier is a semaphore resource,
 * obtained from sem_get.
 * </p>
 * @return bool true on success or false on failure.
 */
function sem_acquire ($sem_identifier) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Release a semaphore
 * @link http://php.net/manual/en/function.sem-release.php
 * @param resource $sem_identifier <p>
 * A Semaphore resource handle as returned by
 * sem_get.
 * </p>
 * @return bool true on success or false on failure.
 */
function sem_release ($sem_identifier) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5)<br/>
 * Remove a semaphore
 * @link http://php.net/manual/en/function.sem-remove.php
 * @param resource $sem_identifier <p>
 * A semaphore resource identifier as returned
 * by sem_get.
 * </p>
 * @return bool true on success or false on failure.
 */
function sem_remove ($sem_identifier) {}

// End of sysvsem v.
?>
