<?php

// Start of sysvsem v.

/**
 * (PHP 4, PHP 5)<br/>
 * Get a semaphore id
 * @link http://php.net/manual/en/function.sem-get.php
 * @param int $key
 * @param int $max_acquire [optional] <p>
 * The number of processes that can acquire the semaphore simultaneously
 * is set to <i>max_acquire</i>.
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
 * @return resource a positive semaphore identifier on success, or <b>FALSE</b> on
 * error.
 */
function sem_get ($key, $max_acquire = 1, $perm = 0666, $auto_release = 1) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Acquire a semaphore
 * @link http://php.net/manual/en/function.sem-acquire.php
 * @param resource $sem_identifier <p>
 * <i>sem_identifier</i> is a semaphore resource,
 * obtained from <b>sem_get</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function sem_acquire ($sem_identifier) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Release a semaphore
 * @link http://php.net/manual/en/function.sem-release.php
 * @param resource $sem_identifier <p>
 * A Semaphore resource handle as returned by
 * <b>sem_get</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function sem_release ($sem_identifier) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5)<br/>
 * Remove a semaphore
 * @link http://php.net/manual/en/function.sem-remove.php
 * @param resource $sem_identifier <p>
 * A semaphore resource identifier as returned
 * by <b>sem_get</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function sem_remove ($sem_identifier) {}

// End of sysvsem v.
?>
