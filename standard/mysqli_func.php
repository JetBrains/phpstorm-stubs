<?php
/**
 * PHPStorm stub file for MySQL Improved Extension(MySQLi) functions.
 *
 * @link http://php.net/manual/en/book.mysqli.php
 */

/**
 * (PHP 5)<p>
 * Gets the number of affected rows in a previous MySQL operation
 *
 * @link http://www.php.net/manual/en/mysqli.affected-rows.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return int An integer greater than zero indicates the number of rows affected or retrieved.
 * Zero indicates that no records where updated for an UPDATE statement,
 * no rows matched the WHERE clause in the query or that no query has yet been executed. -1 indicates that the
 * query returned an error.
 */
function mysqli_affected_rows($link) { }

/**
 * Turns on or off auto-committing database modifications
 *
 * @link http://www.php.net/manual/en/mysqli.autocommit.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param bool   $mode Whether to turn on auto-commit or not.
 *
 * @return bool
 */
function mysqli_autocommit($link, $mode) { }

/**
 * Starts a transaction
 *
 * @link  http://www.php.net/manual/en/mysqli.begin-transaction.php
 *
 * @param mysqli $link  A link identifier returned by mysqli_connect() or mysqli_init()
 * @param int    $flags [optional]
 * @param string $name  [optional]
 *
 * @return bool true on success or false on failure.
 * @since 5.5.0
 */
function mysqli_begin_transaction($link, $flags = 0, $name = null) { }

/**
 * Alias for <b>mysqli_stmt_bind_param</b>
 *
 * @link       http://php.net/manual/en/function.mysqli-bind-param.php
 *
 * @param mysqli_stmt $stmt
 * @param             $types
 *
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      5.0
 */
function mysqli_bind_param($stmt, $types) { }

/**
 * Alias for <b>mysqli_stmt_bind_result</b>
 *
 * @link       http://php.net/manual/en/function.mysqli-bind-result.php
 *
 * @param mysqli_stmt $stmt
 * @param string      $types
 * @param mixed       $var1
 *
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      5.0
 */
function mysqli_bind_result($stmt, $types, &$var1) { }

/**
 * Changes the user of the specified database connection
 *
 * @link http://php.net/manual/en/mysqli.change-user.php
 *
 * @param mysqli      $link     A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string      $user     The MySQL user name.
 * @param string      $password The MySQL password.
 * @param string|null $database The database to change to. If desired, the NULL value may be passed resulting in
 *                              only changing the user and not selecting a database.
 *
 * @return bool
 */
function mysqli_change_user($link, $user, $password, $database) { }

/**
 * Returns the default character set for the database connection
 *
 * @link http://php.net/manual/en/mysqli.character-set-name.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string The default character set for the current connection
 */
function mysqli_character_set_name($link) { }

/**
 * Alias of <b>mysqli_character_set_name</b>
 *
 * @link       http://php.net/manual/en/function.mysqli-client-encoding.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      5.0
 */
function mysqli_client_encoding($link) { }

/**
 * Closes a previously opened database connection
 *
 * @link http://php.net/manual/en/mysqli.close.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return bool
 */
function mysqli_close($link) { }

/**
 * Commits the current transaction
 *
 * @link http://php.net/manual/en/mysqli.commit.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return bool
 */
function mysqli_commit($link) { }

/**
 * Open a new connection to the MySQL server
 * Alias of <b>mysqli::__construct</b>
 *
 * @link http://php.net/manual/en/mysqli.construct.php
 *
 * @param string $host     Can be either a host name or an IP address. Passing the NULL value or the string
 *                         "localhost" to this parameter, the local host is assumed. When possible, pipes will be
 *                         used instead of the TCP/IP protocol.
 * @param string $user     The MySQL user name.
 * @param string $password If not provided or NULL, the MySQL server will attempt to authenticate the user against
 *                         those user records which have no password only.
 * @param string $database If provided will specify the default database to be used when performing queries.
 * @param string $port     Specifies the port number to attempt to connect to the MySQL server.
 * @param string $socket   Specifies the socket or named pipe that should be used.
 *
 * @return mysqli object which represents the connection to a MySQL Server.
 */
function mysqli_connect($host = '', $user = '', $password = '', $database = '', $port = '', $socket = '') { }

/**
 * Returns the error code from last connect call
 *
 * @link http://php.net/manual/en/mysqli.connect-errno.php
 * @return int Last error code number from the last call to mysqli_connect(). Zero means no error occurred.
 */
function mysqli_connect_errno() { }

/**
 * Returns a string description of the last connect error
 *
 * @link http://php.net/manual/en/mysqli.connect-error.php
 * @return string Last error message string from the last call to mysqli_connect().
 */
function mysqli_connect_error() { }

/**
 * Adjusts the result pointer to an arbitrary row in the result
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 * @param int           $offset
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function mysqli_data_seek($result, $offset) { }

/**
 * Performs debugging operations using the Fred Fish debugging library.
 *
 * @link http://php.net/manual/en/mysqli.debug.php
 *
 * @param string $message
 *
 * @return bool
 */
function mysqli_debug($message) { }

/**
 * Dump debugging information into the log
 *
 * @link http://php.net/manual/en/mysqli.dump-debug-info.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return bool
 */
function mysqli_dump_debug_info($link) { }

/**
 * Returns the error code for the most recent function call
 *
 * @link http://php.net/manual/en/mysqli.errno.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return int An error code value for the last call, if it failed. zero means no error occurred.
 */
function mysqli_errno($link) { }

/**
 * Returns a string description of the last error
 *
 * @link http://docs.php.net/manual/da/mysqli.error.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string
 */
function mysqli_error($link) { }

/**
 * Returns a list of errors from the last command executed
 * PHP > 5.4.0 </br>
 *
 * @link http://php.net/manual/en/mysqli.error-list.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return array A list of errors, each as an associative array containing the errno, error, and sqlstate.
 */
function mysqli_error_list($link) { }

/**
 * Alias of <b>mysqli_real_escape_string</b>
 *
 * @link  http://php.net/manual/en/function.mysqli-escape-string.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $query
 *
 * @return string
 * @since 5.0
 */
function mysqli_escape_string($link, $query) { }

/**
 * Executes a prepared Query
 *
 * @since 5.0
 * Alias for <b>mysqli_stmt_execute</b>
 * @link  http://php.net/manual/en/function.mysqli-execute.php
 *
 * @param mysqli_stmt $stmt
 *
 * @deprecated
 */
function mysqli_execute($stmt) { }

/**
 * Alias for <b>mysqli_stmt_fetch</b>
 *
 * @link       http://php.net/manual/en/function.mysqli-fetch.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      5.0
 */
function mysqli_fetch($stmt) { }

/**
 * Fetches all result rows as an associative array, a numeric array, or both.
 * Available only with mysqlnd.
 *
 * @link http://php.net/manual/en/mysqli-result.fetch-all.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 * @param int           $resulttype
 *
 * @return array|null Returns an array of associative or numeric arrays holding result rows.
 */
function mysqli_fetch_all($result, $resulttype = MYSQLI_NUM) { }

/**
 * Fetch a result row as an associative, a numeric array, or both.
 *
 * @link http://php.net/manual/en/mysqli-result.fetch-array.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 * @param int           $resulttype
 *
 * @return array|null
 */
function mysqli_fetch_array($result, $resulttype = MYSQLI_BOTH) { }

/**
 * Fetch a result row as an associative array
 *
 * @link http://php.net/manual/en/mysqli-result.fetch-assoc.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return array|null Returns an associative array of strings representing the fetched row in the result set,
 * where each key in the array represents the name of one of the result set's columns or NULL if there are no more
 * rows in resultset. If two or more columns of the result have the same field names, the last column will take
 * precedence. To access the other column(s) of the same name, you either need to access the result with numeric
 * indices by using mysqli_fetch_row() or add alias names.
 */
function mysqli_fetch_assoc($result) { }

/**
 * Returns the next field in the result set
 *
 * @link http://fr2.php.net/manual/en/mysqli-result.fetch-field.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return object|bool Returns an object which contains field definition information or FALSE if no field
 *                     information is available.
 */
function mysqli_fetch_field($result) { }

/**
 * Fetch meta-data for a single field
 *
 * @link http://fr2.php.net/manual/en/mysqli-result.fetch-field-direct.php
 *
 * @param mysqli_result $result  A result set identifier returned by mysqli_query(),
 *                               mysqli_store_result() or mysqli_use_result().
 * @param int           $fieldnr The field number. This value must be in the range from 0 to number of fields - 1.
 *
 * @return object|bool Returns an object which contains field definition information or FALSE if no field
 *                     information for specified fieldnr is available.
 */
function mysqli_fetch_field_direct($result, $fieldnr) { }

/**
 * Returns an array of objects representing the fields in a result set
 *
 * @link http://fr2.php.net/manual/en/mysqli-result.fetch-fields.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return array|bool Returns an array of objects which contains field definition information or FALSE if no field
 *                    information is available.
 */
function mysqli_fetch_fields($result) { }

/**
 * Returns the lengths of the columns of the current row in the result set
 *
 * @link http://php.net/manual/en/mysqli-result.lengths.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return array|bool An array of integers representing the size of each column (not including any terminating null
 *                    characters). FALSE if an error occurred.
 */
function mysqli_fetch_lengths($result) { }

/**
 * Returns the current row of a result set as an object.
 *
 * @link http://php.net/manual/en/mysqli-result.fetch-object.php
 *
 * @param mysqli_result $result     A result set identifier returned by mysqli_query(),
 *                                  mysqli_store_result() or mysqli_use_result().
 * @param string        $class_name The name of the class to instantiate, set the properties of and return. If not
 *                                  specified, a stdClass object is returned.
 * @param array|null    $params     An optional array of parameters to pass to the constructor for class_name
 *                                  objects.
 *
 * @return object|null Returns an object with string properties that corresponds to the fetched row or NULL if
 *                     there are no more rows in resultset. If two or more columns of the result have the same
 *                     field names, the last column will take precedence. To access the other column(s) of the same
 *                     name, you either need to access the result with numeric indices by using mysqli_fetch_row()
 *                     or add alias names.
 */
function mysqli_fetch_object($result, $class_name = '', $params = null) { }

/**
 * Get a result row as an enumerated array
 *
 * @link http://php.net/manual/en/mysqli-result.fetch-row.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @link http://php.net/manual/en/mysqli-result.fetch-row.php
 * @return array|null mysqli_fetch_row returns an array of strings that corresponds to the fetched row
 * or &null; if there are no more rows in result set.
 */
function mysqli_fetch_row($result) { }

/**
 * Returns the number of columns for the most recent query
 *
 * @link http://php.net/manual/en/mysqli.field-count.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return int An integer representing the number of fields in a result set.
 */
function mysqli_field_count($link) { }

/**
 * Set result pointer to a specified field offset
 *
 * @link http://php.net/manual/en/mysqli-result.field-seek.php
 *
 * @param mysqli_result $result  A result set identifier returned by mysqli_query(),
 *                               mysqli_store_result() or mysqli_use_result().
 * @param int           $fieldnr The field number. This value must be in the range from 0 to number of fields - 1.
 *
 * @return bool
 */
function mysqli_field_seek($result, $fieldnr) { }

/**
 * Get current field offset of a result pointer
 *
 * @link http://php.net/manual/en/mysqli-result.current-field.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return int
 */
function mysqli_field_tell($result) { }

/**
 * Frees the memory associated with a result
 *
 * @link http://php.net/manual/en/mysqli-result.free.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return void
 */
function mysqli_free_result($result) { }

/**
 * Returns client Zval cache statistics
 *
 * @since 5.3.0
 * Available only with mysqlnd.
 * @link  http://php.net/manual/en/mysqli.get-cache-stats.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return array|bool an array with client Zval cache stats if success, false otherwise.
 */
function mysqli_get_cache_stats($link) { }

/**
 * Returns a character set object
 *
 * @link http://php.net/manual/en/mysqli.get-charset.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return object
 */
function mysqli_get_charset($link) { }

/**
 * Get MySQL client info
 *
 * @link http://php.net/manual/en/mysqli.get-client-info.php
 * @return string A string that represents the MySQL client library version
 */
function mysqli_get_client_info() { }

/**
 * Returns client per-process statistics
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/mysqli.get-client-stats.php
 * @return array|bool an array with client stats if success, false otherwise.
 */
function mysqli_get_client_stats() { }

/**
 * Returns the MySQL client version as a string
 *
 * @link http://php.net/manual/en/mysqli.get-client-version.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string
 */
function mysqli_get_client_version($link) { }

/**
 * Returns statistics about the client connection
 *
 * @link http://php.net/manual/en/mysqli.get-connection-stats.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return array|bool Returns an array with connection stats if successful, FALSE otherwise.
 */
function mysqli_get_connection_stats($link) { }

/**
 * Returns a string representing the type of connection used
 *
 * @link http://php.net/manual/en/mysqli.get-host-info.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string A character string representing the server hostname and the connection type.
 */
function mysqli_get_host_info($link) { }

/**
 * Alias for <b>mysqli_stmt_result_metadata</b>
 *
 * @link       http://php.net/manual/en/function.mysqli-get-metadata.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return mysqli_result|bool Returns a result object or FALSE if an error occurred
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      5.0
 */
function mysqli_get_metadata($stmt) { }

/**
 * Returns the version of the MySQL protocol used
 *
 * @link http://php.net/manual/en/mysqli.get-proto-info.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return int Returns an integer representing the protocol version
 */
function mysqli_get_proto_info($link) { }

/**
 * Returns the version of the MySQL server
 *
 * @link http://php.net/manual/en/mysqli.get-server-info.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string A character string representing the server version.
 */
function mysqli_get_server_info($link) { }

/**
 * Returns the version of the MySQL server as an integer
 *
 * @link http://php.net/manual/en/mysqli.get-server-version.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string An integer representing the server version.
 * The form of this version number is main_version * 10000 + minor_version * 100 + sub_version (i.e. version 4.1.0
 * is 40100).
 */
function mysqli_get_server_version($link) { }

/**
 * Get result of SHOW WARNINGS
 *
 * @link http://php.net/manual/en/mysqli.get-warnings.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return mysqli_warning
 */
function mysqli_get_warnings($link) { }

/**
 * Retrieves information about the most recently executed query
 *
 * @link http://php.net/manual/en/mysqli.info.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string A character string representing additional information about the most recently executed query.
 */
function mysqli_info($link) { }

/**
 * Initializes MySQLi and returns a resource for use with mysqli_real_connect()
 *
 * @link http://php.net/manual/en/mysqli.init.php
 * @return mysqli
 * @see  mysqli_real_connect()
 */
function mysqli_init() { }

/**
 * Returns the auto generated id used in the last query
 *
 * @link http://php.net/manual/en/mysqli.insert-id.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return int|string The value of the AUTO_INCREMENT field that was updated by the previous query. Returns zero if
 *                    there was no previous query on the connection or if the query did not update an
 *                    AUTO_INCREMENT value. If the number is greater than maximal int value, mysqli_insert_id()
 *                    will return a string.
 */
function mysqli_insert_id($link) { }

/**
 * Asks the server to kill a MySQL thread
 *
 * @link http://php.net/manual/en/mysqli.kill.php
 * @see  mysqli_thread_id()
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param int    $processid
 *
 * @return bool
 */
function mysqli_kill($link, $processid) { }

/**
 * Check if there are any more query results from a multi query
 *
 * @link http://php.net/manual/en/mysqli.more-results.php
 * @see  mysqli_multi_query()
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return bool
 */
function mysqli_more_results($link) { }

/**
 * Performs a query on the database
 *
 * @link http://php.net/manual/en/mysqli.multi-query.php
 *
 * @param mysqli $link  A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $query One or more queries which are separated by semicolons.
 *
 * @return bool Returns FALSE if the first statement failed. To retrieve subsequent errors from other statements
 *              you have to call mysqli_next_result() first.
 */
function mysqli_multi_query($link, $query) { }

/**
 * Prepare next result from multi_query
 *
 * @link http://php.net/manual/en/mysqli.next-result.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return bool
 */
function mysqli_next_result($link) { }

/**
 * Get the number of fields in a result
 *
 * @link http://php.net/manual/en/mysqli-result.field-count.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return int
 */
function mysqli_num_fields($result) { }

/**
 * Gets the number of rows in a result
 *
 * @link http://php.net/manual/en/mysqli-result.num-rows.php
 *
 * @param mysqli_result $result A result set identifier returned by mysqli_query(),
 *                              mysqli_store_result() or mysqli_use_result().
 *
 * @return int Returns number of rows in the result set.
 */
function mysqli_num_rows($result) { }

/**
 * Set options
 *
 * @link http://php.net/manual/en/mysqli.options.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param int    $option
 * @param mixed  $value
 *
 * @return bool
 */
function mysqli_options($link, $option, $value) { }

/**
 * Alias for <b>mysqli_stmt_param_count</b>
 *
 * @link       http://php.net/manual/en/function.mysqli-param-count.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return int
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      5.0
 */
function mysqli_param_count($stmt) { }

/**
 * Pings a server connection, or tries to reconnect if the connection has gone down
 *
 * @link http://php.net/manual/en/mysqli.ping.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return bool
 */
function mysqli_ping($link) { }

/**
 * Poll connections
 *
 * @link http://php.net/manual/en/mysqli.poll.php
 *
 * @param array $read
 * @param array $write
 * @param array $error
 * @param int   $sec
 * @param int   $usec
 *
 * @return int|bool Returns number of ready connections upon success, FALSE otherwise.
 */
function mysqli_poll(array &$read = null, array &$write = null, &$error = null, $sec, $usec = 0) { }

/**
 * Prepare an SQL statement for execution
 *
 * @link http://php.net/manual/en/mysqli.prepare.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $query
 *
 * @return mysqli_stmt|bool A statement object or FALSE if an error occurred.
 */
function mysqli_prepare($link, $query) { }

/**
 * Performs a query on the database
 *
 * @link http://php.net/manual/en/mysqli.query.php
 *
 * @param mysqli $link  A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $query An SQL query
 * @param int    $resultmode
 *
 * @return mysqli_result|bool
 * For successful SELECT, SHOW, DESCRIBE or EXPLAIN queries, mysqli_query() will return a mysqli_result object.
 * For other successful queries mysqli_query() will return TRUE.
 * Returns FALSE on failure.
 */
function mysqli_query($link, $query, $resultmode = MYSQLI_STORE_RESULT) { }

/**
 * Opens a connection to a mysql server
 *
 * @link http://php.net/manual/en/mysqli.real-connect.php
 * @see  mysqli_connect()
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $host
 * @param string $user
 * @param string $password
 * @param string $database
 * @param string $port
 * @param string $socket
 * @param int    $flags
 *
 * @return bool
 */
function mysqli_real_connect(
    $link,
    $host = '',
    $user = '',
    $password = '',
    $database = '',
    $port = '',
    $socket = '',
    $flags = null
) {
}

/**
 * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of
 * the connection
 *
 * @link http://php.net/manual/en/mysqli.real-escape-string.php
 *
 * @param mysqli $link      A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $escapestr The string to be escaped. Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and
 *                          Control-Z.
 *
 * @return string
 */
function mysqli_real_escape_string($link, $escapestr) { }

/**
 * Execute an SQL query
 *
 * @link http://php.net/manual/en/mysqli.real-query.php
 * @see  mysqli_field_count()
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $query
 *
 * @return bool
 */
function mysqli_real_query($link, $query) { }

/**
 * Get result from async query
 * Available only with mysqlnd.
 *
 * @link http://php.net/manual/en/mysqli.reap-async-query.php
 * @see  mysqli_poll()
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return mysqli_result|bool Returns mysqli_result in success, FALSE otherwise.
 */
function mysqli_reap_async_query($link) { }

/**
 * Flushes tables or caches, or resets the replication server information
 *
 * @link http://php.net/manual/en/mysqli.refresh.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param int    $options
 *
 * @return bool
 */
function mysqli_refresh($link, $options) { }

/**
 * Set a named transaction savepoint
 *
 * @link  http://www.php.net/manual/en/mysqli.release-savepoint.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $name
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 * @since 5.5.0
 */
function mysqli_release_savepoint($link, $name) { }

/**
 * Enables or disables internal report functions
 *
 * @since 5.0
 * @link  http://php.net/manual/en/function.mysqli-report.php
 *
 * @param int $flags <p>
 *                   <table>
 *                   Supported flags
 *                   <tr valign="top">
 *                   <td>Name</td>
 *                   <td>Description</td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td><b>MYSQLI_REPORT_OFF</b></td>
 *                   <td>Turns reporting off</td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td><b>MYSQLI_REPORT_ERROR</b></td>
 *                   <td>Report errors from mysqli function calls</td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td><b>MYSQLI_REPORT_STRICT</b></td>
 *                   <td>
 *                   Throw <b>mysqli_sql_exception</b> for errors
 *                   instead of warnings
 *                   </td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td><b>MYSQLI_REPORT_INDEX</b></td>
 *                   <td>Report if no index or bad index was used in a query</td>
 *                   </tr>
 *                   <tr valign="top">
 *                   <td><b>MYSQLI_REPORT_ALL</b></td>
 *                   <td>Set all options (report all)</td>
 *                   </tr>
 *                   </table>
 *                   </p>
 *
 * @return bool
 */
function mysqli_report($flags) { }

/**
 * Rolls back current transaction
 *
 * @link http://php.net/manual/en/mysqli.rollback.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return bool
 */
function mysqli_rollback($link) { }

/**
 * Set a named transaction savepoint
 *
 * @link  http://www.php.net/manual/en/mysqli.savepoint.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $name
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 * @since 5.5.0
 */
function mysqli_savepoint($link, $name) { }

/**
 * Selects the default database for database queries
 *
 * @link http://php.net/manual/en/mysqli.select-db.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $dbname
 *
 * @return bool
 */
function mysqli_select_db($link, $dbname) { }

/**
 * Alias for <b>mysqli_stmt_send_long_data</b>
 *
 * @link       http://php.net/manual/en/function.mysqli-send-long-data.php
 *
 * @param mysqli_stmt $stmt
 * @param int         $param_nr
 * @param string      $data
 *
 * @return bool
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      5.0
 */
function mysqli_send_long_data($stmt, $param_nr, $data) { }

/**
 * Sets the default client character set
 *
 * @link http://php.net/manual/en/mysqli.set-charset.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $charset
 *
 * @return bool
 */
function mysqli_set_charset($link, $charset) { }

/**
 * Unsets user defined handler for load local infile command
 *
 * @link http://php.net/manual/en/mysqli.set-local-infile-default.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return void
 */
function mysqli_set_local_infile_default($link) { }

/**
 * Set callback function for LOAD DATA LOCAL INFILE command
 *
 * @link http://php.net/manual/en/mysqli.set-local-infile-handler.php
 *
 * @param mysqli   $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param callable $read_func
 *
 * @return bool
 */
function mysqli_set_local_infile_handler($link, $read_func) { }

/**
 * Alias of <b>mysqli_options</b>
 *
 * @link  http://php.net/manual/en/function.mysqli-set-opt.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 * @param int    $option
 * @param mixed  $value
 *
 * @return bool
 * @since 5.0
 */
function mysqli_set_opt($link, $option, $value) { }

/**
 * Returns the SQLSTATE error from previous MySQL operation
 *
 * @link http://php.net/manual/en/mysqli.sqlstate.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string Returns a string containing the SQLSTATE error code for the last error. The error code consists
 *                of five characters. '00000' means no error.
 */
function mysqli_sqlstate($link) { }

/**
 * Used for establishing secure connections using SSL
 *
 * @link  http://www.php.net/manual/en/mysqli.ssl-set.php
 *
 * @param mysqli $link   A link identifier returned by mysqli_connect() or mysqli_init()
 * @param        $key    The path name to the key file
 * @param        $cert   The path name to the certificate file
 * @param        $ca     The path name to the certificate authority file
 * @param        $capath The pathname to a directory that contains trusted SSL CA certificates in PEM format
 * @param        $cipher A list of allowable ciphers to use for SSL encryption
 *
 * @return bool This function always returns TRUE value.
 * @since 5.0
 */
function mysqli_ssl_set($link, $key, $cert, $ca, $capath, $cipher) { }

/**
 * Gets the current system status
 *
 * @link http://php.net/manual/en/mysqli.stat.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return string|bool A string describing the server status. FALSE if an error occurred.
 */
function mysqli_stat($link) { }

/**
 * Returns the total number of rows changed, deleted, or inserted by the last executed statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.affected-rows.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return int|string If the number of affected rows is greater than maximal PHP int value, the number of affected
 *                    rows will be returned as a string value.
 */
function mysqli_stmt_affected_rows($stmt) { }

/**
 * Get the current value of a statement attribute
 *
 * @link http://php.net/manual/en/mysqli-stmt.attr-get.php
 *
 * @param mysqli_stmt $stmt
 * @param int         $attr
 *
 * @return int|bool Returns FALSE if the attribute is not found, otherwise returns the value of the attribute.
 */
function mysqli_stmt_attr_get($stmt, $attr) { }

/**
 * Modify the behavior of a prepared statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.attr-set.php
 *
 * @param mysqli_stmt $stmt
 * @param int         $attr
 * @param int         $mode
 *
 * @return bool
 */
function mysqli_stmt_attr_set($stmt, $attr, $mode) { }

/**
 * Binds variables to a prepared statement as parameters
 *
 * @link http://php.net/manual/en/mysqli-stmt.bind-param.php
 *
 * @param mysqli_stmt $stmt
 * @param string      $types
 * @param mixed       $var1
 *
 * @return bool
 */
function mysqli_stmt_bind_param($stmt, $types, &$var1) { }

/**
 * Binds variables to a prepared statement for result storage
 *
 * @link http://php.net/manual/en/mysqli-stmt.bind-result.php
 *
 * @param mysqli_stmt $stmt Statement
 * @param mixed       $var1 The variable to be bound.
 * @param mixed       ...$_ The variables to be bound.
 *
 * @return bool
 */
function mysqli_stmt_bind_result($stmt, &$var1, &...$_) { }

/**
 * Closes a prepared statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.close.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_close($stmt) { }

/**
 * Seeks to an arbitrary row in statement result set
 *
 * @link http://php.net/manual/en/mysqli-stmt.data-seek.php
 *
 * @param mysqli_stmt $stmt
 * @param int         $offset
 *
 * @return void
 */
function mysqli_stmt_data_seek($stmt, $offset) { }

/**
 * Returns the error code for the most recent statement call
 *
 * @link http://php.net/manual/en/mysqli-stmt.errno.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_errno($stmt) { }

/**
 * Returns a string description for last statement error
 *
 * @link http://php.net/manual/en/mysqli-stmt.error.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return string
 */
function mysqli_stmt_error($stmt) { }

/**
 * Returns a list of errors from the last statement executed
 * PHP > 5.4.0 </br>
 *
 * @link http://docs.php.net/manual/da/mysqli-stmt.error-list.php
 *
 * @param mysqli_stmt $stmt A statement identifier returned by mysqli_stmt_init().
 *
 * @return array A list of errors, each as an associative array containing the errno, error, and sqlstate.
 */
function mysqli_stmt_error_list($stmt) { }

/**
 * Executes a prepared Query
 *
 * @link http://php.net/manual/en/mysqli-stmt.execute.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_execute($stmt) { }

/**
 * Fetch results from a prepared statement into the bound variables
 *
 * @link http://php.net/manual/en/mysqli-stmt.fetch.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_fetch($stmt) { }

/**
 * Returns the number of fields in the given statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.field-count.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return int
 */
function mysqli_stmt_field_count($stmt) { }

/**
 * Frees stored result memory for the given statement handle
 *
 * @link http://php.net/manual/en/mysqli-stmt.free-result.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return void
 */
function mysqli_stmt_free_result($stmt) { }

/**
 * Gets a result set from a prepared statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.get-result.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return mysqli_result|bool Returns a resultset or FALSE on failure.
 */
function mysqli_stmt_get_result($stmt) { }

/**
 * Get result of SHOW WARNINGS
 *
 * @link http://php.net/manual/en/mysqli-stmt.get-warnings.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return object (not documented, but it's probably a mysqli_warning object)
 */
function mysqli_stmt_get_warnings($stmt) { }

/**
 * Initializes a statement and returns an object for use with mysqli_stmt_prepare
 *
 * @link http://fr2.php.net/manual/en/mysqli.stmt-init.php
 * @return mysqli_stmt
 */
function mysqli_stmt_init() { }

/**
 * Get the ID generated from the previous INSERT operation
 *
 * @link http://php.net/manual/en/mysqli-stmt.insert-id.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return mixed
 */
function mysqli_stmt_insert_id($stmt) { }

/**
 * Check if there are more query results from a multiple query
 *
 * @link http://php.net/manual/en/mysqli-stmt.more-results.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_more_results($stmt) { }

/**
 * Reads the next result from a multiple query
 *
 * @link http://php.net/manual/en/mysqli-stmt.next-result.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_next_result($stmt) { }

/**
 * Return the number of rows in statements result set
 *
 * @link http://php.net/manual/en/mysqli-stmt.num-rows.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return int
 */
function mysqli_stmt_num_rows($stmt) { }

/**
 * Returns the number of parameter for the given statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.param-count.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return int
 */
function mysqli_stmt_param_count($stmt) { }

/**
 * Prepare an SQL statement for execution
 *
 * @link http://php.net/manual/en/mysqli-stmt.prepare.php
 *
 * @param mysqli_stmt $stmt
 * @param string      $query
 *
 * @return bool
 */
function mysqli_stmt_prepare($stmt, $query) { }

/**
 * Resets a prepared statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.reset.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_reset($stmt) { }

/**
 * Returns result set metadata from a prepared statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.result-metadata.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return mysqli_result|bool Returns a result object or FALSE if an error occurred
 */
function mysqli_stmt_result_metadata($stmt) { }

/**
 * Send data in blocks
 *
 * @link http://php.net/manual/en/mysqli-stmt.send-long-data.php
 *
 * @param mysqli_stmt $stmt
 * @param int         $param_nr
 * @param string      $data
 *
 * @return bool
 */
function mysqli_stmt_send_long_data($stmt, $param_nr, $data) { }

/**
 * Returns SQLSTATE error from previous statement operation
 *
 * @link http://php.net/manual/en/mysqli-stmt.sqlstate.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return string Returns a string containing the SQLSTATE error code for the last error. The error code consists
 *                of five characters. '00000' means no error.
 */
function mysqli_stmt_sqlstate($stmt) { }

/**
 * Transfers a result set from a prepared statement
 *
 * @link http://php.net/manual/en/mysqli-stmt.store-result.php
 *
 * @param mysqli_stmt $stmt
 *
 * @return bool
 */
function mysqli_stmt_store_result($stmt) { }

/**
 * Transfers a result set from the last query
 *
 * @link http://php.net/manual/en/mysqli.store-result.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return mysqli_result|bool
 */
function mysqli_store_result($link) { }

/**
 * Returns the thread ID for the current connection
 *
 * @link http://php.net/manual/en/mysqli.thread-id.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return int Returns the Thread ID for the current connection.
 */
function mysqli_thread_id($link) { }

/**
 * Returns whether thread safety is given or not
 *
 * @link http://php.net/manual/en/mysqli.thread-safe.php
 * @return bool
 */
function mysqli_thread_safe() { }

/**
 * Initiate a result set retrieval
 *
 * @link http://php.net/manual/en/mysqli.use-result.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return mysqli_result|bool
 */
function mysqli_use_result($link) { }

/**
 * Returns the number of warnings from the last query for the given link
 *
 * @link http://php.net/manual/en/mysqli.warning-count.php
 *
 * @param mysqli $link A link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return int
 */
function mysqli_warning_count($link) { }

