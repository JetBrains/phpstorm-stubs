<?php

/**
 * (PHP 7.2 >= 7.2.14, PHP 8, PHP 7 >= 7.3.1, PHP 8, PECL OCI8 >= 2.2.0)<br/>
 * Sets a millisecond timeout for database calls
 * @link https://php.net/manual/en/function.oci-set-call-timout.php
 * @param resource $connection <p>An Oracle connection identifier,
 * returned by {@see oci_connect}, {@see oci_pconnect},
 * or {@see oci_new_connect}.</p>
 * @param int $time_out <p>The maximum time in milliseconds that any
 * single round-trip between PHP and Oracle Database may take.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 7.2
 */
function oci_set_call_timeout($connection, int $time_out) {}

/**
 * (PHP 7 >== 7.2.14, PHP 8, PHP 7 >= 7.3.1, PHP 8, PECL OCI8 >= 2.2.0)
 * Sets the database operation
 * @link https://www.php.net/manual/en/function.oci-set-db-operation.php
 * @param resource $connection <p>An Oracle connection identifier,
 * returned by {@see oci_connect}, {@see oci_pconnect},
 * or {@see oci_new_connect}.</p>
 * @param string $dbop <p>User chosen string.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 7.2
 */
function oci_set_db_operation($connection, string $dbop) {}
