<?php

// Start of dba v.

/**
 * Open database
 * @link https://php.net/manual/en/function.dba-open.php
 * @param string $path <p>
 * Commonly a regular path in your filesystem.
 * </p>
 * @param string $mode <p>
 * It is r for read access, w for
 * read/write access to an already existing database, c
 * for read/write access and database creation if it doesn't currently exist,
 * and n for create, truncate and read/write access.
 * The database is created in BTree mode, other modes (like Hash or Queue)
 * are not supported.
 * </p>
 * <p>
 * Additionally you can set the database lock method with the next char.
 * Use l to lock the database with a .lck
 * file or d to lock the databasefile itself. It is
 * important that all of your applications do this consistently.
 * </p>
 * <p>
 * If you want to test the access and do not want to wait for the lock
 * you can add t as third character. When you are
 * absolutely sure that you do not require database locking you can do
 * so by using - instead of l or
 * d. When none of d,
 * l or - is used, dba will lock
 * on the database file as it would with d.
 * </p>
 * <p>
 * There can only be one writer for one database file. When you use dba on
 * a web server and more than one request requires write operations they can
 * only be done one after another. Also read during write is not allowed.
 * The dba extension uses locks to prevent this. See the following table:
 * <table>
 * DBA locking
 * <tr valign="top">
 * <td>already open</td>
 * <td><i>mode</i> = "rl"</td>
 * <td><i>mode</i> = "rlt"</td>
 * <td><i>mode</i> = "wl"</td>
 * <td><i>mode</i> = "wlt"</td>
 * <td><i>mode</i> = "rd"</td>
 * <td><i>mode</i> = "rdt"</td>
 * <td><i>mode</i> = "wd"</td>
 * <td><i>mode</i> = "wdt"</td>
 * </tr>
 * <tr valign="top">
 * <td>not open</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>ok</td>
 * </tr>
 * <tr valign="top">
 * <td><i>mode</i> = "rl"</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>wait</td>
 * <td>false</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * </tr>
 * <tr valign="top">
 * <td><i>mode</i> = "wl"</td>
 * <td>wait</td>
 * <td>false</td>
 * <td>wait</td>
 * <td>false</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * </tr>
 * <tr valign="top">
 * <td><i>mode</i> = "rd"</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>ok</td>
 * <td>ok</td>
 * <td>wait</td>
 * <td>false</td>
 * </tr>
 * <tr valign="top">
 * <td><i>mode</i> = "wd"</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>illegal</td>
 * <td>wait</td>
 * <td>false</td>
 * <td>wait</td>
 * <td>false</td>
 * </tr>
 * </table>
 * ok: the second call will be successfull.
 * wait: the second call waits until <b>dba_close</b> is called for the first.
 * false: the second call returns false.
 * illegal: you must not mix "l" and "d" modifiers for <i>mode</i> parameter.
 * </p>
 * @param string $handler [optional] <p>
 * The name of the handler which
 * shall be used for accessing <i>path</i>. It is passed
 * all optional parameters given to <b>dba_open</b> and
 * can act on behalf of them.
 * </p>
 * @param mixed $_ [optional]
 * @return resource a positive handle on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_open ($path, $mode, $handler = null, $_ = null) {}

/**
 * Open database persistently
 * @link https://php.net/manual/en/function.dba-popen.php
 * @param string $path <p>
 * Commonly a regular path in your filesystem.
 * </p>
 * @param string $mode <p>
 * It is r for read access, w for
 * read/write access to an already existing database, c
 * for read/write access and database creation if it doesn't currently exist,
 * and n for create, truncate and read/write access.
 * </p>
 * @param string $handler [optional] <p>
 * The name of the handler which
 * shall be used for accessing <i>path</i>. It is passed
 * all optional parameters given to <b>dba_popen</b> and
 * can act on behalf of them.
 * </p>
 * @param mixed $_ [optional]
 * @return resource a positive handle on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_popen ($path, $mode, $handler = null, $_ = null) {}

/**
 * Close a DBA database
 * @link https://php.net/manual/en/function.dba-close.php
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return void No value is returned.
 * @since 4.0
 * @since 5.0
 */
function dba_close ($handle) {}

/**
 * Delete DBA entry specified by key
 * @link https://php.net/manual/en/function.dba-delete.php
 * @param string $key <p>
 * The key of the entry which is deleted.
 * </p>
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_delete ($key, $handle) {}

/**
 * Check whether key exists
 * @link https://php.net/manual/en/function.dba-exists.php
 * @param string $key <p>
 * The key the check is performed for.
 * </p>
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> if the key exists, <b>FALSE</b> otherwise.
 * @since 4.0
 * @since 5.0
 */
function dba_exists ($key, $handle) {}

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
 * @return string the associated string if the key/data pair is found, <b>FALSE</b>
 * otherwise.
 * @since 4.0
 * @since 5.0
 */
function dba_fetch ($key, $handle) {}

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
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_insert ($key, $value, $handle) {}

/**
 * Replace or insert entry
 * @link https://php.net/manual/en/function.dba-replace.php
 * @param string $key <p>
 * The key of the entry to be replaced.
 * </p>
 * @param string $value <p>
 * The value to be replaced.
 * </p>
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_replace ($key, $value, $handle) {}

/**
 * Fetch first key
 * @link https://php.net/manual/en/function.dba-firstkey.php
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return string the key on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_firstkey ($handle) {}

/**
 * Fetch next key
 * @link https://php.net/manual/en/function.dba-nextkey.php
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return string the key on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_nextkey ($handle) {}

/**
 * Optimize database
 * @link https://php.net/manual/en/function.dba-optimize.php
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_optimize ($handle) {}

/**
 * Synchronize database
 * @link https://php.net/manual/en/function.dba-sync.php
 * @param resource $handle <p>
 * The database handler, returned by <b>dba_open</b> or
 * <b>dba_popen</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function dba_sync ($handle) {}

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
 * @since 4.3.0
 * @since 5.0
 */
function dba_handlers ($full_info = false) {}

/**
 * List all open database files
 * @link https://php.net/manual/en/function.dba-list.php
 * @return array An associative array, in the form resourceid =&gt; filename.
 * @since 4.3.0
 * @since 5.0
 */
function dba_list () {}

/**
 * Splits a key in string representation into array representation
 * @link https://php.net/manual/en/function.dba-key-split.php
 * @param mixed $key <p>
 * The key in string representation.
 * </p>
 * @return mixed an array of the form array(0 =&gt; group, 1 =&gt;
 * value_name). This function will return <b>FALSE</b> if
 * <i>key</i> is <b>NULL</b> or <b>FALSE</b>.
 * @since 5.0
 */
function dba_key_split ($key) {}

// End of dba v.
