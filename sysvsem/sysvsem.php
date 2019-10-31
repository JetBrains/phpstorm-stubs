<?php

// Start of sysvsem v.

/**
 * Get a semaphore id
 * @link https://php.net/manual/en/function.sem-get.php
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
 * @return resource|false a positive semaphore identifier on success, or <b>FALSE</b> on
 * error.
 * @since 4.0
 * @since 5.0
 */
function sem_get ($key, $max_acquire = 1, $perm = 0666, $auto_release = 1) {}

/**
 * Acquire a semaphore
 * @link https://php.net/manual/en/function.sem-acquire.php
 * @param resource $sem_identifier <p>
 * <i>sem_identifier</i> is a semaphore resource,
 * obtained from <b>sem_get</b>.
 * </p>
 * @param bool $nowait [optional] <p>
 * Specifies if the process shouldn't wait for the semaphore to be acquired.
 * If set to <i>true</i>, the call will return <i>false</i> immediately if a
 * semaphore cannot be immediately acquired.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function sem_acquire ($sem_identifier, $nowait = false) {}

/**
 * Release a semaphore
 * @link https://php.net/manual/en/function.sem-release.php
 * @param resource $sem_identifier <p>
 * A Semaphore resource handle as returned by
 * <b>sem_get</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function sem_release ($sem_identifier) {}

/**
 * Remove a semaphore
 * @link https://php.net/manual/en/function.sem-remove.php
 * @param resource $sem_identifier <p>
 * A semaphore resource identifier as returned
 * by <b>sem_get</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.1
 * @since 5.0
 */
function sem_remove ($sem_identifier) {}

// End of sysvsem v.
?>
