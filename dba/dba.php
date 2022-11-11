<?php

/** @since 8.2 */
define('DBA_LMDB_USE_SUB_DIR', 0);

/** @since 8.2 */
define('DBA_LMDB_NO_SUB_DIR', 0);

function dba_open(string $path, string $mode, ?string $handler = null, int $permission = 420, int $map_size = 0, ?int $flags = null) {}

function dba_popen(string $path, string $mode, ?string $handler = null, int $permission = 420, int $map_size = 0, ?int $flags = null) {}

/**
 * Close a DBA database
 * @link https://php.net/manual/en/function.dba-close.php
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return void No value is returned.
 */
function dba_close($dba): void {}

/**
 * Delete DBA entry specified by key
 * @link https://php.net/manual/en/function.dba-delete.php
 * @param string $key <p>
 * The key of the entry which is deleted.
 * </p>
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function dba_delete(array|string $key, $dba): bool {}

/**
 * Check whether key exists
 * @link https://php.net/manual/en/function.dba-exists.php
 * @param string $key <p>
 * The key the check is performed for.
 * </p>
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> if the key exists, <b>FALSE</b> otherwise.
 */
function dba_exists(array|string $key, $dba): bool {}

/**
 * Fetch data specified by key
 * @link https://php.net/manual/en/function.dba-fetch.php
 * @param string $key <p>
 * The key the data is specified by.
 * </p>
 * <p>
 * When working with inifiles this function accepts arrays as keys
 * where index 0 is the group and index 1 is the value name. See:
 * <b>dba_key_split</b>.
 * </p>
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return string|false the associated string if the key/data pair is found, <b>FALSE</b>
 * otherwise.
 */
function dba_fetch($key, $handle): string|false {}

/**
 * Fetch data specified by key
 * @link https://php.net/manual/en/function.dba-fetch.php
 * @param string $key <p>
 * The key the data is specified by.
 * </p>
 * <p>
 * When working with inifiles this function accepts arrays as keys
 * where index 0 is the group and index 1 is the value name. See:
 * <b>dba_key_split</b>.
 * </p>
 * @param int $skip The number of key-value pairs to ignore when using cdb databases. This value is ignored for all other databases which do not support multiple keys with the same name.
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return string|false the associated string if the key/data pair is found, <b>FALSE</b>
 * otherwise.
 */
function dba_fetch($key, $skip, $dba): string|false {}

/**
 * Insert entry
 * @link https://php.net/manual/en/function.dba-insert.php
 * @param string $key <p>
 * The key of the entry to be inserted. If this key already exist in the
 * database, this function will fail. Use <b>dba_replace</b>
 * if you need to replace an existent key.
 * </p>
 * @param string $value <p>
 * The value to be inserted.
 * </p>
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function dba_insert(array|string $key, string $value, $dba): bool {}

/**
 * Replace or insert entry
 * @link https://php.net/manual/en/function.dba-replace.php
 * @param string $key <p>
 * The key of the entry to be replaced.
 * </p>
 * @param string $value <p>
 * The value to be replaced.
 * </p>
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function dba_replace(array|string $key, string $value, $dba): bool {}

/**
 * Fetch first key
 * @link https://php.net/manual/en/function.dba-firstkey.php
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return string|false the key on success or <b>FALSE</b> on failure.
 */
function dba_firstkey($dba): string|false {}

/**
 * Fetch next key
 * @link https://php.net/manual/en/function.dba-nextkey.php
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return string|false the key on success or <b>FALSE</b> on failure.
 */
function dba_nextkey($dba): string|false {}

/**
 * Optimize database
 * @link https://php.net/manual/en/function.dba-optimize.php
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function dba_optimize($dba): bool {}

/**
 * Synchronize database
 * @link https://php.net/manual/en/function.dba-sync.php
 * @param resource $dba <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function dba_sync($dba): bool {}

/**
 * List all the handlers available
 * @link https://php.net/manual/en/function.dba-handlers.php
 * @param bool $full_info [optional] <p>
 * Turns on/off full information display in the result.
 * </p>
 * @return array an array of database handlers. If <i>full_info</i>
 * is set to <b>TRUE</b>, the array will be associative with the handlers names as
 * keys, and their version information as value. Otherwise, the result will be
 * an indexed array of handlers names.
 * </p>
 * <p>
 * When the internal cdb library is used you will see
 * cdb and cdb_make.
 */
function dba_handlers(bool $full_info = false): array {}

/**
 * List all open database files
 * @link https://php.net/manual/en/function.dba-list.php
 * @return array An associative array, in the form resourceid =&gt; filename.
 */
function dba_list(): array {}

/**
 * Splits a key in string representation into array representation
 * @link https://php.net/manual/en/function.dba-key-split.php
 * @param string|false|null $key <p>
 * The key in string representation.
 * </p>
 * @return array|false an array of the form array(0 =&gt; group, 1 =&gt;
 * value_name). This function will return <b>FALSE</b> if
 * <i>key</i> is <b>NULL</b> or <b>FALSE</b>.
 */
function dba_key_split(string|false|null $key): array|false {}
