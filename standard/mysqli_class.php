<?php
/**
 * PHPStorm stub file for MySQL Improved Extension(MySQLi) classes.
 *
 * @link http://php.net/manual/en/book.mysqli.php
 */

/**
 * Represents a connection between PHP and a MySQL database.
 *
 * @link http://php.net/manual/en/class.mysqli.php
 */
class mysqli
{
    /**
     * @var int
     */
    public $affected_rows;
    /**
     * @var string
     */
    public $client_info;
    /**
     * @var int
     */
    public $client_version;
    /**
     * @var string
     */
    public $connect_errno;
    /**
     * @var string
     */
    public $connect_error;
    /**
     * @var int
     */
    public $errno;
    /**
     * @var string
     */
    public $error;
    /**
     * @var array A list of errors, each as an associative array containing the errno, error, and sqlstate.
     * @link http://www.php.net/manual/en/mysqli.error-list.php
     */
    public $error_list;
    /**
     * @var int
     */
    public $field_count;
    /**
     * @var string
     */
    public $host_info;
    /**
     * @var string
     */
    public $info;
    /**
     * @var mixed
     */
    public $insert_id;
    /**
     * @var string
     */
    public $protocol_version;
    /**
     * @var string
     */
    public $server_info;
    /**
     * @var int
     */
    public $server_version;
    /**
     * @var string
     */
    public $sqlstate;
    /**
     * @var int
     */
    public $thread_id;
    /**
     * @var int
     */
    public $warning_count;

    /**
     * Open a new connection to the MySQL server
     * </p>
     *
     * @param string $host     [optional] Can be either a host name or an IP address. Passing the NULL value or the
     *                         string "localhost" to this parameter, the local host is assumed. When possible, pipes
     *                         will be used instead of the TCP/IP protocol. Prepending host by p: opens a persistent
     *                         connection. mysqli_change_user() is automatically called on connections opened from the
     *                         connection pool. Defaults to ini_get("mysqli.default_host")
     * @param string $username [optional] The MySQL user name. Defaults to ini_get("mysqli.default_user")
     * @param string $passwd   [optional] If not provided or NULL, the MySQL server will attempt to authenticate the
     *                         user against those user records which have no password only. This allows one username to
     *                         be used with different permissions (depending on if a password as provided or not).
     *                         Defaults to ini_get("mysqli.default_pw")
     * @param string $dbname   [optional] If provided will specify the default database to be used when performing
     *                         queries. Defaults to ""
     * @param int    $port     [optional] Specifies the port number to attempt to connect to the MySQL server. Defaults
     *                         to ini_get("mysqli.default_port")
     * @param string $socket   [optional] Specifies the socket or named pipe that should be used. Defaults to
     *                         ini_get("mysqli.default_socket")
     *
     * @since 5.0
     */
    public function __construct(
        $host,
        $username,
        $passwd,
        $dbname,
        $port,
        $socket
    ) {
    }

    /**
     * Turns on or off auto-commiting database modifications
     *
     * @link  http://php.net/manual/en/mysqli.autocommit.php
     *
     * @param bool $mode <p>
     *                   Whether to turn on auto-commit or not.
     *                   </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function autocommit($mode) { }

    /**
     * Starts a transaction
     *
     * @link  http://www.php.net/manual/en/mysqli.begin-transaction.php
     *
     * @param int    $flags [optional]
     * @param string $name  [optional]
     *
     * @return bool true on success or false on failure.
     * @since 5.5.0
     */
    public function begin_transaction($flags = 0, $name = null) { }

    /**
     * Changes the user of the specified database connection
     *
     * @link  http://php.net/manual/en/mysqli.change-user.php
     *
     * @param string $user     <p>
     *                         The MySQL user name.
     *                         </p>
     * @param string $password <p>
     *                         The MySQL password.
     *                         </p>
     * @param string $database <p>
     *                         The database to change to.
     *                         </p>
     *                         <p>
     *                         If desired, the null value may be passed resulting in only changing
     *                         the user and not selecting a database. To select a database in this
     *                         case use the <b>mysqli_select_db</b> function.
     *                         </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function change_user($user, $password, $database) { }

    /**
     * Returns the default character set for the database connection
     *
     * @link  http://php.net/manual/en/mysqli.character-set-name.php
     * @return string The default character set for the current connection
     * @since 5.0
     */
    public function character_set_name() { }

    /**
     * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
     */
    public function client_encoding() { }

    /**
     * Closes a previously opened database connection
     *
     * @link  http://php.net/manual/en/mysqli.close.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function close() { }

    /**
     * Commits the current transaction
     *
     * @link  http://php.net/manual/en/mysqli.commit.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function commit() { }

    /**
     * @param $host     [optional]
     * @param $user     [optional]
     * @param $password [optional]
     * @param $database [optional]
     * @param $port     [optional]
     * @param $socket   [optional]
     */
    public function connect($host, $user, $password, $database, $port, $socket) { }

    /**
     * Performs debugging operations
     *
     * @link  http://php.net/manual/en/mysqli.debug.php
     *
     * @param string $message <p>
     *                        A string representing the debugging operation to perform
     *                        </p>
     *
     * @return bool true.
     * @since 5.0
     */
    public function debug($message) { }

    /**
     * Dump debugging information into the log
     *
     * @link  http://php.net/manual/en/mysqli.dump-debug-info.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function dump_debug_info() { }

    /**
     * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of
     * the connection
     *
     * @param string $escapestr The string to be escaped.
     *                          Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.
     *
     * @return string
     * @link http://www.php.net/manual/en/mysqli.real-escape-string.php
     */
    public function escape_string($escapestr) { }

    /**
     * Returns a character set object
     *
     * @link  http://php.net/manual/en/mysqli.get-charset.php
     * @return object The function returns a character set object with the following properties:
     * <i>charset</i>
     * <p>Character set name</p>
     * <i>collation</i>
     * <p>Collation name</p>
     * <i>dir</i>
     * <p>Directory the charset description was fetched from (?) or "" for built-in character sets</p>
     * <i>min_length</i>
     * <p>Minimum character length in bytes</p>
     * <i>max_length</i>
     * <p>Maximum character length in bytes</p>
     * <i>number</i>
     * <p>Internal character set number</p>
     * <i>state</i>
     * <p>Character set status (?)</p>
     * @since 5.1.0
     */
    public function get_charset() { }

    /**
     * Returns the MySQL client version as a string
     *
     * @link  http://php.net/manual/en/mysqli.get-client-info.php
     * @return string A string that represents the MySQL client library version
     * @since 5.0
     */
    public function get_client_info() { }

    /**
     * Returns statistics about the client connection
     *
     * @link  http://php.net/manual/en/mysqli.get-connection-stats.php
     * @return bool an array with connection stats if success, false otherwise.
     * @since 5.3.0
     */
    public function get_connection_stats() { }

    /**
     * An undocumented function equivalent to the $server_info property
     *
     * @link http://php.net/manual/en/mysqli.get-server-info.php
     * @return string A character string representing the server version.
     */
    public function get_server_info() { }

    /**
     * Get result of SHOW WARNINGS
     *
     * @link  http://php.net/manual/en/mysqli.get-warnings.php
     * @return mysqli_warning
     * @since 5.1.0
     */
    public function get_warnings() { }

    /**
     * Initializes MySQLi and returns a resource for use with mysqli_real_connect()
     *
     * @link  http://php.net/manual/en/mysqli.init.php
     * @return mysqli an object.
     * @since 5.0
     */
    public function init() { }

    /**
     * Asks the server to kill a MySQL thread
     *
     * @link  http://php.net/manual/en/mysqli.kill.php
     *
     * @param int $processid
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function kill($processid) { }

    /**
     * Check if there are any more query results from a multi query
     *
     * @link  http://php.net/manual/en/mysqli.more-results.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function more_results() { }

    /**
     * Performs a query on the database
     *
     * @link  http://php.net/manual/en/mysqli.multi-query.php
     *
     * @param string $query <p>
     *                      The query, as a string.
     *                      </p>
     *                      <p>
     *                      Data inside the query should be properly escaped.
     *                      </p>
     *
     * @return bool false if the first statement failed.
     * To retrieve subsequent errors from other statements you have to call
     * <b>mysqli_next_result</b> first.
     * @since 5.0
     */
    public function multi_query($query) { }

    /**
     * @param $host     [optional]
     * @param $user     [optional]
     * @param $password [optional]
     * @param $database [optional]
     * @param $port     [optional]
     * @param $socket   [optional]
     */
    public function mysqli($host, $user, $password, $database, $port, $socket) { }

    /**
     * Prepare next result from multi_query
     *
     * @link  http://php.net/manual/en/mysqli.next-result.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function next_result() { }

    /**
     * Set options
     *
     * @link  http://php.net/manual/en/mysqli.options.php
     *
     * @param int   $option <p>
     *                      The option that you want to set. It can be one of the following values:
     *                      <table>
     *                      Valid options
     *                      <tr valign="top">
     *                      <td>Name</td>
     *                      <td>Description</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td><b>MYSQLI_OPT_CONNECT_TIMEOUT</b></td>
     *                      <td>connection timeout in seconds (supported on Windows with TCP/IP since PHP 5.3.1)</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td><b>MYSQLI_OPT_LOCAL_INFILE</b></td>
     *                      <td>enable/disable use of LOAD LOCAL INFILE</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td><b>MYSQLI_INIT_COMMAND</b></td>
     *                      <td>command to execute after when connecting to MySQL server</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td><b>MYSQLI_READ_DEFAULT_FILE</b></td>
     *                      <td>
     *                      Read options from named option file instead of my.cnf
     *                      </td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td><b>MYSQLI_READ_DEFAULT_GROUP</b></td>
     *                      <td>
     *                      Read options from the named group from my.cnf
     *                      or the file specified with <b>MYSQL_READ_DEFAULT_FILE</b>
     *                      </td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td><b>MYSQLI_SERVER_PUBLIC_KEY</b></td>
     *                      <td>
     *                      RSA public key file used with the SHA-256 based authentication.
     *                      </td>
     *                      </tr>
     *                      </table>
     *                      </p>
     * @param mixed $value  <p>
     *                      The value for the option.
     *                      </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function options($option, $value) { }

    /**
     * Pings a server connection, or tries to reconnect if the connection has gone down
     *
     * @link  http://php.net/manual/en/mysqli.ping.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function ping() { }

    /**
     * Poll connections
     *
     * @link  http://php.net/manual/en/mysqli.poll.php
     *
     * @param array $read   <p>
     *                      </p>
     * @param array $error  <p>
     *                      </p>
     * @param array $reject <p>
     *                      </p>
     * @param int   $sec    <p>
     *                      Number of seconds to wait, must be non-negative.
     *                      </p>
     * @param int   $usec   [optional] <p>
     *                      Number of microseconds to wait, must be non-negative.
     *                      </p>
     *
     * @return int number of ready connections in success, false otherwise.
     * @since 5.3.0
     */
    public function poll(array &$read, array &$error, array &$reject, $sec, $usec = null) { }

    /**
     * Prepare an SQL statement for execution
     *
     * @link  http://php.net/manual/en/mysqli.prepare.php
     *
     * @param string $query <p>
     *                      The query, as a string.
     *                      </p>
     *                      <p>
     *                      You should not add a terminating semicolon or \g
     *                      to the statement.
     *                      </p>
     *                      <p>
     *                      This parameter can include one or more parameter markers in the SQL
     *                      statement by embedding question mark (?) characters
     *                      at the appropriate positions.
     *                      </p>
     *                      <p>
     *                      The markers are legal only in certain places in SQL statements.
     *                      For example, they are allowed in the VALUES()
     *                      list of an INSERT statement (to specify column
     *                      values for a row), or in a comparison with a column in a
     *                      WHERE clause to specify a comparison value.
     *                      </p>
     *                      <p>
     *                      However, they are not allowed for identifiers (such as table or
     *                      column names), in the select list that names the columns to be
     *                      returned by a SELECT statement, or to specify both
     *                      operands of a binary operator such as the = equal
     *                      sign. The latter restriction is necessary because it would be
     *                      impossible to determine the parameter type. It's not allowed to
     *                      compare marker with NULL by
     *                      ? IS NULL too. In general, parameters are legal
     *                      only in Data Manipulation Language (DML) statements, and not in Data
     *                      Definition Language (DDL) statements.
     *                      </p>
     *
     * @return mysqli_stmt <b>mysqli_prepare</b> returns a statement object or false if an error occurred.
     * @since 5.0
     */
    public function prepare($query) { }

    /**
     * Performs a query on the database
     *
     * @link  http://php.net/manual/en/mysqli.query.php
     *
     * @param string $query      <p>
     *                           The query string.
     *                           </p>
     *                           <p>
     *                           Data inside the query should be properly escaped.
     *                           </p>
     * @param int    $resultmode [optional] <p>
     *                           Either the constant <b>MYSQLI_USE_RESULT</b> or
     *                           <b>MYSQLI_STORE_RESULT</b> depending on the desired
     *                           behavior. By default, <b>MYSQLI_STORE_RESULT</b> is used.
     *                           </p>
     *                           <p>
     *                           If you use <b>MYSQLI_USE_RESULT</b> all subsequent calls
     *                           will return error Commands out of sync unless you
     *                           call <b>mysqli_free_result</b>
     *                           </p>
     *                           <p>
     *                           With <b>MYSQLI_ASYNC</b> (available with mysqlnd), it is
     *                           possible to perform query asynchronously.
     *                           <b>mysqli_poll</b> is then used to get results from such
     *                           queries.
     *                           </p>
     *
     * @return mysqli_result|boolean For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object.For other successful queries <b>mysqli_query</b> will
     * return true and false on failure.
     * @since 5.0
     */
    public function query($query, $resultmode = MYSQLI_STORE_RESULT) { }

    /**
     * Opens a connection to a mysql server
     *
     * @link  http://php.net/manual/en/mysqli.real-connect.php
     *
     * @param string $host     [optional] <p>
     *                         Can be either a host name or an IP address. Passing the null value
     *                         or the string "localhost" to this parameter, the local host is
     *                         assumed. When possible, pipes will be used instead of the TCP/IP
     *                         protocol.
     *                         </p>
     * @param string $username [optional] <p>
     *                         The MySQL user name.
     *                         </p>
     * @param string $passwd   [optional] <p>
     *                         If provided or null, the MySQL server will attempt to authenticate
     *                         the user against those user records which have no password only. This
     *                         allows one username to be used with different permissions (depending
     *                         on if a password as provided or not).
     *                         </p>
     * @param string $dbname   [optional] <p>
     *                         If provided will specify the default database to be used when
     *                         performing queries.
     *                         </p>
     * @param int    $port     [optional] <p>
     *                         Specifies the port number to attempt to connect to the MySQL server.
     *                         </p>
     * @param string $socket   [optional] <p>
     *                         Specifies the socket or named pipe that should be used.
     *                         </p>
     *                         <p>
     *                         Specifying the <i>socket</i> parameter will not
     *                         explicitly determine the type of connection to be used when
     *                         connecting to the MySQL server. How the connection is made to the
     *                         MySQL database is determined by the <i>host</i>
     *                         parameter.
     *                         </p>
     * @param int    $flags    [optional] <p>
     *                         With the parameter <i>flags</i> you can set different
     *                         connection options:
     *                         </p>
     *                         <table>
     *                         Supported flags
     *                         <tr valign="top">
     *                         <td>Name</td>
     *                         <td>Description</td>
     *                         </tr>
     *                         <tr valign="top">
     *                         <td><b>MYSQLI_CLIENT_COMPRESS</b></td>
     *                         <td>Use compression protocol</td>
     *                         </tr>
     *                         <tr valign="top">
     *                         <td><b>MYSQLI_CLIENT_FOUND_ROWS</b></td>
     *                         <td>return number of matched rows, not the number of affected rows</td>
     *                         </tr>
     *                         <tr valign="top">
     *                         <td><b>MYSQLI_CLIENT_IGNORE_SPACE</b></td>
     *                         <td>Allow spaces after function names. Makes all function names reserved words.</td>
     *                         </tr>
     *                         <tr valign="top">
     *                         <td><b>MYSQLI_CLIENT_INTERACTIVE</b></td>
     *                         <td>
     *                         Allow interactive_timeout seconds (instead of
     *                         wait_timeout seconds) of inactivity before closing the connection
     *                         </td>
     *                         </tr>
     *                         <tr valign="top">
     *                         <td><b>MYSQLI_CLIENT_SSL</b></td>
     *                         <td>Use SSL (encryption)</td>
     *                         </tr>
     *                         </table>
     *                         <p>
     *                         For security reasons the <b>MULTI_STATEMENT</b> flag is
     *                         not supported in PHP. If you want to execute multiple queries use the
     *                         <b>mysqli_multi_query</b> function.
     *                         </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function real_connect(
        $host = null,
        $username = null,
        $passwd = null,
        $dbname = null,
        $port = null,
        $socket = null,
        $flags = null
    ) {
    }

    /**
     * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of
     * the connection
     *
     * @link  http://php.net/manual/en/mysqli.real-escape-string.php
     *
     * @param string $escapestr <p>
     *                          The string to be escaped.
     *                          </p>
     *                          <p>
     *                          Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and
     *                          Control-Z.
     *                          </p>
     *
     * @return string an escaped string.
     * @since 5.0
     */
    public function real_escape_string($escapestr) { }

    /**
     * Execute an SQL query
     *
     * @link  http://php.net/manual/en/mysqli.real-query.php
     *
     * @param string $query <p>
     *                      The query, as a string.
     *                      </p>
     *                      <p>
     *                      Data inside the query should be properly escaped.
     *                      </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function real_query($query) { }

    /**
     * Get result from async query
     *
     * @link  http://php.net/manual/en/mysqli.reap-async-query.php
     * @return mysqli_result mysqli_result in success, false otherwise.
     * @since 5.3.0
     */
    public function reap_async_query() { }

    /**
     * @param $options
     */
    public function refresh($options) { }

    /**
     * Execute an SQL query
     *
     * @link  http://php.net/manual/en/mysqli.release-savepoint.php
     *
     * @param string $name
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     * @since 5.5.0
     */
    public function release_savepoint($name) { }

    /**
     * Rolls back current transaction
     *
     * @link  http://php.net/manual/en/mysqli.rollback.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function rollback() { }

    /**
     * Set a named transaction savepoint
     *
     * @link  http://www.php.net/manual/en/mysqli.savepoint.php
     *
     * @param string $name
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     * @since 5.5.0
     */
    public function savepoint($name) { }

    /**
     * Selects the default database for database queries
     *
     * @link  http://php.net/manual/en/mysqli.select-db.php
     *
     * @param string $dbname <p>
     *                       The database name.
     *                       </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function select_db($dbname) { }

    /**
     * Sets the default client character set
     *
     * @link  http://php.net/manual/en/mysqli.set-charset.php
     *
     * @param string $charset <p>
     *                        The charset to be set as default.
     *                        </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0.5
     */
    public function set_charset($charset) { }

    /**
     * @param $option
     * @param $value
     */
    public function set_opt($option, $value) { }

    /**
     * Used for establishing secure connections using SSL
     *
     * @link  http://www.php.net/manual/en/mysqli.ssl-set.php
     *
     * @param $key    <p>
     *                The path name to the key file.
     *                </p>
     * @param $cert   <p>
     *                The path name to the certificate file.
     *                </p>
     * @param $ca     <p>
     *                The path name to the certificate authority file.
     *                </p>
     * @param $capath <p>
     *                The pathname to a directory that contains trusted SSL CA certificates in PEM format.
     *                </p>
     * @param $cipher <p>
     *                A list of allowable ciphers to use for SSL encryption.
     *                </p>
     *
     * @return bool This function always returns TRUE value.
     * @since 5.0
     */
    public function ssl_set($key, $cert, $ca, $capath, $cipher) { }

    /**
     * Gets the current system status
     *
     * @link  http://php.net/manual/en/mysqli.stat.php
     * @return string A string describing the server status. false if an error occurred.
     * @since 5.0
     */
    public function stat() { }

    /**
     * Initializes a statement and returns an object for use with mysqli_stmt_prepare
     *
     * @link  http://php.net/manual/en/mysqli.stmt-init.php
     * @return mysqli_stmt an object.
     * @since 5.0
     */
    public function stmt_init() { }

    /**
     * Transfers a result set from the last query
     *
     * @link  http://php.net/manual/en/mysqli.store-result.php
     * @return mysqli_result a buffered result object or false if an error occurred.
     * </p>
     * <p>
     * <b>mysqli_store_result</b> returns false in case the query
     * didn't return a result set (if the query was, for example an INSERT
     * statement). This function also returns false if the reading of the
     * result set failed. You can check if you have got an error by checking
     * if <b>mysqli_error</b> doesn't return an empty string, if
     * <b>mysqli_errno</b> returns a non zero value, or if
     * <b>mysqli_field_count</b> returns a non zero value.
     * Also possible reason for this function returning false after
     * successful call to <b>mysqli_query</b> can be too large
     * result set (memory for it cannot be allocated). If
     * <b>mysqli_field_count</b> returns a non-zero value, the
     * statement should have produced a non-empty result set.
     * @since 5.0
     */
    public function store_result() { }

    /**
     * Returns whether thread safety is given or not
     *
     * @link  http://php.net/manual/en/mysqli.thread-safe.php
     * @return bool true if the client library is thread-safe, otherwise false.
     * @since 5.0
     */
    public function thread_safe() { }

    /**
     * Initiate a result set retrieval
     *
     * @link  http://php.net/manual/en/mysqli.use-result.php
     * @return mysqli_result an unbuffered result object or false if an error occurred.
     * @since 5.0
     */
    public function use_result() { }
}

/**
 * MySQLi Driver.
 *
 * @link http://php.net/manual/en/class.mysqli-driver.php
 */
final class mysqli_driver
{
    /**
     * @var string
     */
    public $client_info;
    /**
     * @var string
     */
    public $client_version;
    /**
     * @var string
     */
    public $driver_version;
    /**
     * @var string
     */
    public $embedded;
    /**
     * @var bool
     */
    public $reconnect;
    /**
     * @var int
     */
    public $report_mode;
}

/**
 * Represents the result set obtained from a query against the database.
 * Implements Traversable since 5.4
 *
 * @link http://php.net/manual/en/class.mysqli-result.php
 */
class mysqli_result implements Traversable
{
    /**
     * @var int
     */
    public $current_field;
    /**
     * @var int
     */
    public $field_count;
    /**
     * @var array
     */
    public $lengths;
    /**
     * @var int
     */
    public $num_rows;
    /**
     * @var mixed
     */
    public $type;

    /**
     * Constructor (no docs available)
     */
    public function __construct() { }

    /**
     * Close (no docs available)
     */
    public function close() { }

    /**
     * Adjusts the result pointer to an arbitary row in the result
     *
     * @link  http://php.net/manual/en/mysqli-result.data-seek.php
     *
     * @param int $offset <p>
     *                    The field offset. Must be between zero and the total number of rows
     *                    minus one (0..<b>mysqli_num_rows</b> - 1).
     *                    </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function data_seek($offset) { }

    /**
     * Fetches all result rows as an associative array, a numeric array, or both
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-all.php
     *
     * @param int $resulttype [optional] <p>
     *                        This optional parameter is a constant indicating what type of array
     *                        should be produced from the current row data. The possible values for
     *                        this parameter are the constants MYSQLI_ASSOC,
     *                        MYSQLI_NUM, or MYSQLI_BOTH.
     *                        </p>
     *
     * @return mixed an array of associative or numeric arrays holding result rows.
     * @since 5.3.0
     */
    public function fetch_all($resulttype = null) { }

    /**
     * Fetch a result row as an associative, a numeric array, or both
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-array.php
     *
     * @param int $resulttype [optional] <p>
     *                        This optional parameter is a constant indicating what type of array
     *                        should be produced from the current row data. The possible values for
     *                        this parameter are the constants <b>MYSQLI_ASSOC</b>,
     *                        <b>MYSQLI_NUM</b>, or <b>MYSQLI_BOTH</b>.
     *                        </p>
     *                        <p>
     *                        By using the <b>MYSQLI_ASSOC</b> constant this function
     *                        will behave identically to the <b>mysqli_fetch_assoc</b>,
     *                        while <b>MYSQLI_NUM</b> will behave identically to the
     *                        <b>mysqli_fetch_row</b> function. The final option
     *                        <b>MYSQLI_BOTH</b> will create a single array with the
     *                        attributes of both.
     *                        </p>
     *
     * @return mixed an array of strings that corresponds to the fetched row or null if there
     * are no more rows in resultset.
     * @since 5.0
     */
    public function fetch_array($resulttype = MYSQLI_BOTH) { }

    /**
     * Fetch a result row as an associative array
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-assoc.php
     * @return array an associative array of strings representing the fetched row in the result
     * set, where each key in the array represents the name of one of the result
     * set's columns or null if there are no more rows in resultset.
     * </p>
     * <p>
     * If two or more columns of the result have the same field names, the last
     * column will take precedence. To access the other column(s) of the same
     * name, you either need to access the result with numeric indices by using
     * <b>mysqli_fetch_row</b> or add alias names.
     * @since 5.0
     */
    public function fetch_assoc() { }

    /**
     * Returns the next field in the result set
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-field.php
     * @return object an object which contains field definition information or false
     * if no field information is available.
     * </p>
     * <p>
     * <table>
     * Object properties
     * <tr valign="top">
     * <td>Property</td>
     * <td>Description</td>
     * </tr>
     * <tr valign="top">
     * <td>name</td>
     * <td>The name of the column</td>
     * </tr>
     * <tr valign="top">
     * <td>orgname</td>
     * <td>Original column name if an alias was specified</td>
     * </tr>
     * <tr valign="top">
     * <td>table</td>
     * <td>The name of the table this field belongs to (if not calculated)</td>
     * </tr>
     * <tr valign="top">
     * <td>orgtable</td>
     * <td>Original table name if an alias was specified</td>
     * </tr>
     * <tr valign="top">
     * <td>def</td>
     * <td>Reserved for default value, currently always ""</td>
     * </tr>
     * <tr valign="top">
     * <td>db</td>
     * <td>Database (since PHP 5.3.6)</td>
     * </tr>
     * <tr valign="top">
     * <td>catalog</td>
     * <td>The catalog name, always "def" (since PHP 5.3.6)</td>
     * </tr>
     * <tr valign="top">
     * <td>max_length</td>
     * <td>The maximum width of the field for the result set.</td>
     * </tr>
     * <tr valign="top">
     * <td>length</td>
     * <td>The width of the field, as specified in the table definition.</td>
     * </tr>
     * <tr valign="top">
     * <td>charsetnr</td>
     * <td>The character set number for the field.</td>
     * </tr>
     * <tr valign="top">
     * <td>flags</td>
     * <td>An integer representing the bit-flags for the field.</td>
     * </tr>
     * <tr valign="top">
     * <td>type</td>
     * <td>The data type used for this field</td>
     * </tr>
     * <tr valign="top">
     * <td>decimals</td>
     * <td>The number of decimals used (for integer fields)</td>
     * </tr>
     * </table>
     * @since 5.0
     */
    public function fetch_field() { }

    /**
     * Fetch meta-data for a single field
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-field-direct.php
     *
     * @param int $fieldnr <p>
     *                     The field number. This value must be in the range from
     *                     0 to number of fields - 1.
     *                     </p>
     *
     * @return object an object which contains field definition information or false
     * if no field information for specified fieldnr is
     * available.
     * </p>
     * <p>
     * <table>
     * Object attributes
     * <tr valign="top">
     * <td>Attribute</td>
     * <td>Description</td>
     * </tr>
     * <tr valign="top">
     * <td>name</td>
     * <td>The name of the column</td>
     * </tr>
     * <tr valign="top">
     * <td>orgname</td>
     * <td>Original column name if an alias was specified</td>
     * </tr>
     * <tr valign="top">
     * <td>table</td>
     * <td>The name of the table this field belongs to (if not calculated)</td>
     * </tr>
     * <tr valign="top">
     * <td>orgtable</td>
     * <td>Original table name if an alias was specified</td>
     * </tr>
     * <tr valign="top">
     * <td>def</td>
     * <td>The default value for this field, represented as a string</td>
     * </tr>
     * <tr valign="top">
     * <td>max_length</td>
     * <td>The maximum width of the field for the result set.</td>
     * </tr>
     * <tr valign="top">
     * <td>length</td>
     * <td>The width of the field, as specified in the table definition.</td>
     * </tr>
     * <tr valign="top">
     * <td>charsetnr</td>
     * <td>The character set number for the field.</td>
     * </tr>
     * <tr valign="top">
     * <td>flags</td>
     * <td>An integer representing the bit-flags for the field.</td>
     * </tr>
     * <tr valign="top">
     * <td>type</td>
     * <td>The data type used for this field</td>
     * </tr>
     * <tr valign="top">
     * <td>decimals</td>
     * <td>The number of decimals used (for integer fields)</td>
     * </tr>
     * </table>
     * @since 5.0
     */
    public function fetch_field_direct($fieldnr) { }

    /**
     * Returns an array of objects representing the fields in a result set
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-fields.php
     * @return array an array of objects which contains field definition information or
     * false if no field information is available.
     * </p>
     * <p>
     * <table>
     * Object properties
     * <tr valign="top">
     * <td>Property</td>
     * <td>Description</td>
     * </tr>
     * <tr valign="top">
     * <td>name</td>
     * <td>The name of the column</td>
     * </tr>
     * <tr valign="top">
     * <td>orgname</td>
     * <td>Original column name if an alias was specified</td>
     * </tr>
     * <tr valign="top">
     * <td>table</td>
     * <td>The name of the table this field belongs to (if not calculated)</td>
     * </tr>
     * <tr valign="top">
     * <td>orgtable</td>
     * <td>Original table name if an alias was specified</td>
     * </tr>
     * <tr valign="top">
     * <td>def</td>
     * <td>The default value for this field, represented as a string</td>
     * </tr>
     * <tr valign="top">
     * <td>max_length</td>
     * <td>The maximum width of the field for the result set.</td>
     * </tr>
     * <tr valign="top">
     * <td>length</td>
     * <td>The width of the field, as specified in the table definition.</td>
     * </tr>
     * <tr valign="top">
     * <td>charsetnr</td>
     * <td>The character set number for the field.</td>
     * </tr>
     * <tr valign="top">
     * <td>flags</td>
     * <td>An integer representing the bit-flags for the field.</td>
     * </tr>
     * <tr valign="top">
     * <td>type</td>
     * <td>The data type used for this field</td>
     * </tr>
     * <tr valign="top">
     * <td>decimals</td>
     * <td>The number of decimals used (for integer fields)</td>
     * </tr>
     * </table>
     * @since 5.0
     */
    public function fetch_fields() { }

    /**
     * Returns the current row of a result set as an object
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-object.php
     *
     * @param string $class_name [optional] <p>
     *                           The name of the class to instantiate, set the properties of and return.
     *                           If not specified, a <b>stdClass</b> object is returned.
     *                           </p>
     * @param array  $params     [optional] <p>
     *                           An optional array of parameters to pass to the constructor
     *                           for <i>class_name</i> objects.
     *                           </p>
     *
     * @return stdClass|object an object with string properties that corresponds to the fetched
     * row or null if there are no more rows in resultset.
     * @since 5.0
     */
    public function fetch_object($class_name = null, array $params = null) { }

    /**
     * Get a result row as an enumerated array
     *
     * @link  http://php.net/manual/en/mysqli-result.fetch-row.php
     * @return mixed mysqli_fetch_row returns an array of strings that corresponds to the fetched row
     * or &null; if there are no more rows in result set.
     * @since 5.0
     */
    public function fetch_row() { }

    /**
     * Set result pointer to a specified field offset
     *
     * @link  http://php.net/manual/en/mysqli-result.field-seek.php
     *
     * @param int $fieldnr <p>
     *                     The field number. This value must be in the range from
     *                     0 to number of fields - 1.
     *                     </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function field_seek($fieldnr) { }

    /**
     * Frees the memory associated with a result
     *
     * @link  http://php.net/manual/en/mysqli-result.free.php
     * @return void
     * @since 5.0
     */
    public function free() { }

    /**
     * Free a result set (No docs available)
     */
    public function free_result() { }
}

/**
 * mysqli_sql_exception
 */
class mysqli_sql_exception extends RuntimeException
{
    /**
     * The sql state with the error.
     */
    protected $sqlstate;
}

/**
 * Represents a prepared statement.
 *
 * @link http://php.net/manual/en/class.mysqli-stmt.php
 */
class mysqli_stmt
{
    /**
     * @var int
     */
    public $affected_rows;
    /**
     * @var int
     */
    public $errno;
    /**
     * @var string
     */
    public $error;
    /**
     * @var array
     */
    public $error_list;
    /**
     * @var int
     */
    public $field_count;
    /**
     * @var string
     */
    public $id;
    /**
     * @var int
     */
    public $insert_id;
    /**
     * @var int
     */
    public $num_rows;
    /**
     * @var int
     */
    public $param_count;
    /**
     * @var string
     */
    public $sqlstate;

    /**
     * mysqli_stmt constructor
     *
     * @param mysqli $link
     * @param string $query
     */
    public function __construct($link, $query) { }

    /**
     * Used to get the current value of a statement attribute
     *
     * @link  http://php.net/manual/en/mysqli-stmt.attr-get.php
     *
     * @param int $attr <p>
     *                  The attribute that you want to get.
     *                  </p>
     *
     * @return int false if the attribute is not found, otherwise returns the value of the attribute.
     * @since 5.0
     */
    public function attr_get($attr) { }

    /**
     * Used to modify the behavior of a prepared statement
     *
     * @link  http://php.net/manual/en/mysqli-stmt.attr-set.php
     *
     * @param int $attr <p>
     *                  The attribute that you want to set. It can have one of the following values:
     *                  <table>
     *                  Attribute values
     *                  <tr valign="top">
     *                  <td>Character</td>
     *                  <td>Description</td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH</td>
     *                  <td>
     *                  If set to 1, causes <b>mysqli_stmt_store_result</b> to
     *                  update the metadata MYSQL_FIELD->max_length value.
     *                  </td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>MYSQLI_STMT_ATTR_CURSOR_TYPE</td>
     *                  <td>
     *                  Type of cursor to open for statement when <b>mysqli_stmt_execute</b>
     *                  is invoked. <i>mode</i> can be MYSQLI_CURSOR_TYPE_NO_CURSOR
     *                  (the default) or MYSQLI_CURSOR_TYPE_READ_ONLY.
     *                  </td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>MYSQLI_STMT_ATTR_PREFETCH_ROWS</td>
     *                  <td>
     *                  Number of rows to fetch from server at a time when using a cursor.
     *                  <i>mode</i> can be in the range from 1 to the maximum
     *                  value of unsigned long. The default is 1.
     *                  </td>
     *                  </tr>
     *                  </table>
     *                  </p>
     *                  <p>
     *                  If you use the MYSQLI_STMT_ATTR_CURSOR_TYPE option with
     *                  MYSQLI_CURSOR_TYPE_READ_ONLY, a cursor is opened for the
     *                  statement when you invoke <b>mysqli_stmt_execute</b>. If there
     *                  is already an open cursor from a previous <b>mysqli_stmt_execute</b> call,
     *                  it closes the cursor before opening a new one. <b>mysqli_stmt_reset</b>
     *                  also closes any open cursor before preparing the statement for re-execution.
     *                  <b>mysqli_stmt_free_result</b> closes any open cursor.
     *                  </p>
     *                  <p>
     *                  If you open a cursor for a prepared statement, <b>mysqli_stmt_store_result</b>
     *                  is unnecessary.
     *                  </p>
     * @param int $mode <p>The value to assign to the attribute.</p>
     *
     * @return bool
     * @since 5.0
     */
    public function attr_set($attr, $mode) { }

    /**
     * Binds variables to a prepared statement as parameters
     *
     * @link  http://php.net/manual/en/mysqli-stmt.bind-param.php
     *
     * @param string $types <p>
     *                      A string that contains one or more characters which specify the types
     *                      for the corresponding bind variables:
     *                      <table>
     *                      Type specification chars
     *                      <tr valign="top">
     *                      <td>Character</td>
     *                      <td>Description</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td>i</td>
     *                      <td>corresponding variable has type integer</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td>d</td>
     *                      <td>corresponding variable has type double</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td>s</td>
     *                      <td>corresponding variable has type string</td>
     *                      </tr>
     *                      <tr valign="top">
     *                      <td>b</td>
     *                      <td>corresponding variable is a blob and will be sent in packets</td>
     *                      </tr>
     *                      </table>
     *                      </p>
     * @param mixed  $var1  <p>
     *                      The number of variables and length of string
     *                      types must match the parameters in the statement.
     *                      </p>
     * @param mixed  $_     [optional]
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function bind_param($types, &$var1, &$_ = null) { }

    /**
     * Binds variables to a prepared statement for result storage
     *
     * @link  http://php.net/manual/en/mysqli-stmt.bind-result.php
     *
     * @param mixed $var1 The variable to be bound.
     * @param mixed ...$_ The variables to be bound.
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function bind_result(&$var1, &...$_) { }

    /**
     * Closes a prepared statement
     *
     * @link  http://php.net/manual/en/mysqli-stmt.close.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function close() { }

    /**
     * Seeks to an arbitrary row in statement result set
     *
     * @link  http://php.net/manual/en/mysqli-stmt.data-seek.php
     *
     * @param int $offset <p>
     *                    Must be between zero and the total number of rows minus one (0..
     *                    <b>mysqli_stmt_num_rows</b> - 1).
     *                    </p>
     *
     * @return void
     * @since 5.0
     */
    public function data_seek($offset) { }

    /**
     * Executes a prepared Query
     *
     * @link  http://php.net/manual/en/mysqli-stmt.execute.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function execute() { }

    /**
     * Fetch results from a prepared statement into the bound variables
     *
     * @link  http://php.net/manual/en/mysqli-stmt.fetch.php
     * @return bool
     * @since 5.0
     */
    public function fetch() { }

    /**
     * Frees stored result memory for the given statement handle
     *
     * @link  http://php.net/manual/en/mysqli-stmt.free-result.php
     * @return void
     * @since 5.0
     */
    public function free_result() { }

    /**
     * Gets a result set from a prepared statement
     *
     * @link http://php.net/manual/en/mysqli-stmt.get-result.php
     * @return mysqli_result|bool Returns a resultset or FALSE on failure
     */
    public function get_result() { }

    /**
     * Get result of SHOW WARNINGS
     *
     * @link  http://php.net/manual/en/mysqli-stmt.get-warnings.php
     *
     * @param mysqli_stmt $stmt
     *
     * @return object
     * @since 5.1.0
     */
    public function get_warnings(mysqli_stmt $stmt) { }

    /**
     * Check if there are more query results from a multiple query
     *
     * @link http://php.net/manual/en/mysqli-stmt.more-results.php
     * @return bool
     */
    public function more_results() { }

    /**
     * Reads the next result from a multiple query
     *
     * @link http://php.net/manual/en/mysqli-stmt.next-result.php
     * @return bool
     */
    public function next_result() { }

    /**
     * Return the number of rows in statements result set
     *
     * @link  http://php.net/manual/en/mysqli-stmt.num-rows.php
     *
     * @param mysqli_stmt $stmt
     *
     * @return int An integer representing the number of rows in result set.
     * @since 5.0
     */
    public function num_rows(mysqli_stmt $stmt) { }

    /**
     * Prepare an SQL statement for execution
     *
     * @link  http://php.net/manual/en/mysqli-stmt.prepare.php
     *
     * @param string $query <p>
     *                      The query, as a string. It must consist of a single SQL statement.
     *                      </p>
     *                      <p>
     *                      You can include one or more parameter markers in the SQL statement by
     *                      embedding question mark (?) characters at the
     *                      appropriate positions.
     *                      </p>
     *                      <p>
     *                      You should not add a terminating semicolon or \g
     *                      to the statement.
     *                      </p>
     *                      <p>
     *                      The markers are legal only in certain places in SQL statements.
     *                      For example, they are allowed in the VALUES() list of an INSERT statement
     *                      (to specify column values for a row), or in a comparison with a column in
     *                      a WHERE clause to specify a comparison value.
     *                      </p>
     *                      <p>
     *                      However, they are not allowed for identifiers (such as table or column names),
     *                      in the select list that names the columns to be returned by a SELECT statement),
     *                      or to specify both operands of a binary operator such as the =
     *                      equal sign. The latter restriction is necessary because it would be impossible
     *                      to determine the parameter type. In general, parameters are legal only in Data
     *                      Manipulation Language (DML) statements, and not in Data Definition Language
     *                      (DDL) statements.
     *                      </p>
     *
     * @return mixed true on success or false on failure.
     * @since 5.0
     */
    public function prepare($query) { }

    /**
     * Resets a prepared statement
     *
     * @link  http://php.net/manual/en/mysqli-stmt.reset.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function reset() { }

    /**
     * Returns result set metadata from a prepared statement
     *
     * @link  http://php.net/manual/en/mysqli-stmt.result-metadata.php
     * @return mysqli_result a result object or false if an error occurred.
     * @since 5.0
     */
    public function result_metadata() { }

    /**
     * Send data in blocks
     *
     * @link  http://php.net/manual/en/mysqli-stmt.send-long-data.php
     *
     * @param int    $param_nr <p>
     *                         Indicates which parameter to associate the data with. Parameters are
     *                         numbered beginning with 0.
     *                         </p>
     * @param string $data     <p>
     *                         A string containing data to be sent.
     *                         </p>
     *
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function send_long_data($param_nr, $data) { }

    /**
     * No documentation available
     *
     * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
     */
    public function stmt() { }

    /**
     * Transfers a result set from a prepared statement
     *
     * @link  http://php.net/manual/en/mysqli-stmt.store-result.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function store_result() { }
}

/**
 * Represents one or more MySQL warnings.
 *
 * @link http://php.net/manual/en/class.mysqli-warning.php
 */
final class mysqli_warning
{
    /**
     * @var int
     */
    public $errno;
    /**
     * @var string
     */
    public $message;
    /**
     * @var string
     */
    public $sqlstate;

    /**
     * The __construct purpose
     *
     * @link http://php.net/manual/en/mysqli-warning.construct.php
     */
    public function __construct() { }

    /**
     * Move to the next warning
     *
     * @link http://php.net/manual/en/mysqli-warning.next.php
     * @return bool True if it successfully moved to the next warning
     */
    public function next() { }
}
