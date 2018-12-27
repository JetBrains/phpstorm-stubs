<?php

// Start of sqlite3 v.0.7-dev

/**
 * A class that interfaces SQLite 3 databases.
 * @link https://php.net/manual/en/class.sqlite3.php
 */
class SQLite3  {

	/**
	 * Opens an SQLite database
	 * @link https://php.net/manual/en/sqlite3.open.php
	 * @param string $filename <p>
	 * Path to the SQLite database, or :memory: to use in-memory database.
	 * </p>
	 * @param int $flags [optional] <p>
	 * Optional flags used to determine how to open the SQLite database. By
	 * default, open uses SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE.
	 * <p>
	 * SQLITE3_OPEN_READONLY: Open the database for
	 * reading only.
	 * </p>
	 * @param string $encryption_key [optional] <p>
	 * An optional encryption key used when encrypting and decrypting an
	 * SQLite database.
	 * </p>
	 * @return void No value is returned.
	 * @since 5.3.0
	 */
	public function open ($filename, $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryption_key = null) {}

	/**
	 * Closes the database connection
	 * @link https://php.net/manual/en/sqlite3.close.php
	 * @return bool <b>TRUE</b> on success, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function close () {}

	/**
	 * Executes a result-less query against a given database
	 * @link https://php.net/manual/en/sqlite3.exec.php
	 * @param string $query <p>
	 * The SQL query to execute (typically an INSERT, UPDATE, or DELETE
	 * query).
	 * </p>
	 * @return bool <b>TRUE</b> if the query succeeded, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function exec ($query) {}

	/**
	 * Returns the SQLite3 library version as a string constant and as a number
	 * @link https://php.net/manual/en/sqlite3.version.php
	 * @return array an associative array with the keys "versionString" and
	 * "versionNumber".
	 * @since 5.3.0
	 */
	public static function version () {}

	/**
	 * Returns the row ID of the most recent INSERT into the database
	 * @link https://php.net/manual/en/sqlite3.lastinsertrowid.php
	 * @return int the row ID of the most recent INSERT into the database
	 * @since 5.3.0
	 */
	public function lastInsertRowID () {}

	/**
	 * Returns the numeric result code of the most recent failed SQLite request
	 * @link https://php.net/manual/en/sqlite3.lasterrorcode.php
	 * @return int an integer value representing the numeric result code of the most
	 * recent failed SQLite request.
	 * @since 5.3.0
	 */
	public function lastErrorCode () {}

	/**
	 * Returns English text describing the most recent failed SQLite request
	 * @link https://php.net/manual/en/sqlite3.lasterrormsg.php
	 * @return string an English string describing the most recent failed SQLite request.
	 * @since 5.3.0
	 */
	public function lastErrorMsg () {}

	/**
	 * Sets the busy connection handler
	 * @link https://php.net/manual/en/sqlite3.busytimeout.php
	 * @param int $msecs <p>
	 * The milliseconds to sleep. Setting this value to a value less than
	 * or equal to zero, will turn off an already set timeout handler.
	 * </p>
	 * @return bool <b>TRUE</b> on success, <b>FALSE</b> on failure.
	 * @since 5.3.3
	 */
	public function busyTimeout ($msecs) {}

	/**
	 * Attempts to load an SQLite extension library
	 * @link https://php.net/manual/en/sqlite3.loadextension.php
	 * @param string $shared_library <p>
	 * The name of the library to load. The library must be located in the
	 * directory specified in the configure option sqlite3.extension_dir.
	 * </p>
	 * @return bool <b>TRUE</b> if the extension is successfully loaded, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function loadExtension ($shared_library) {}

	/**
	 * Returns the number of database rows that were changed (or inserted or
	 * deleted) by the most recent SQL statement
	 * @since 5.3.0
	 * @link https://php.net/manual/en/sqlite3.changes.php
	 * @return int an integer value corresponding to the number of
	 * database rows changed (or inserted or deleted) by the most recent SQL
	 * statement.
	 */
	public function changes () {}

	/**
	 * Returns a string that has been properly escaped
	 * @link https://php.net/manual/en/sqlite3.escapestring.php
	 * @param string $value <p>
	 * The string to be escaped.
	 * </p>
	 * @return string a properly escaped string that may be used safely in an SQL
	 * statement.
	 * @since 5.3.0
	 */
	public static function escapeString ($value) {}

	/**
	 * Prepares an SQL statement for execution
	 * @link https://php.net/manual/en/sqlite3.prepare.php
	 * @param string $query <p>
	 * The SQL query to prepare.
	 * </p>
	 * @return SQLite3Stmt an <b>SQLite3Stmt</b> object on success or <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function prepare ($query) {}

	/**
	 * Executes an SQL query
	 * @link https://php.net/manual/en/sqlite3.query.php
	 * @param string $query <p>
	 * The SQL query to execute.
	 * </p>
	 * @return SQLite3Result an <b>SQLite3Result</b> object if the query returns results. Otherwise,
	 * returns <b>TRUE</b> if the query succeeded, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function query ($query) {}

	/**
	 * Executes a query and returns a single result
	 * @link https://php.net/manual/en/sqlite3.querysingle.php
	 * @param string $query <p>
	 * The SQL query to execute.
	 * </p>
	 * @param bool $entire_row [optional] <p>
	 * By default, <b>querySingle</b> returns the value of the
	 * first column returned by the query. If
	 * <i>entire_row</i> is <b>TRUE</b>, then it returns an array
	 * of the entire first row.
	 * </p>
	 * @return mixed the value of the first column of results or an array of the entire
	 * first row (if <i>entire_row</i> is <b>TRUE</b>).
	 * </p>
	 * <p>
	 * If the query is valid but no results are returned, then <b>NULL</b> will be
	 * returned if <i>entire_row</i> is <b>FALSE</b>, otherwise an
	 * empty array is returned.
	 * </p>
	 * <p>
	 * Invalid or failing queries will return <b>FALSE</b>.
	 * @since 5.3.0
	 */
	public function querySingle ($query, $entire_row = false) {}

	/**
	 * Registers a PHP function for use as an SQL scalar function
	 * @link https://php.net/manual/en/sqlite3.createfunction.php
	 * @param string $name <p>
	 * Name of the SQL function to be created or redefined.
	 * </p>
	 * @param mixed $callback <p>
	 * The name of a PHP function or user-defined function to apply as a
	 * callback, defining the behavior of the SQL function.
	 * </p>
	 * @param int $argument_count [optional] <p>
	 * The number of arguments that the SQL function takes. If
	 * this parameter is negative, then the SQL function may take
	 * any number of arguments.
	 * </p>
	 * @param int $flags [optional]
	 * <p>A bitwise conjunction of flags.
	 * Currently, only <b>SQLITE3_DETERMINISTIC</b> is supported, which specifies that the function always returns
	 * the same result given the same inputs within a single SQL statement.</p>
	 * @return bool <b>TRUE</b> upon successful creation of the function, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function createFunction ($name, $callback, $argument_count = -1, int $flags = 0) {}

	/**
	 * Registers a PHP function for use as an SQL aggregate function
	 * @link https://php.net/manual/en/sqlite3.createaggregate.php
	 * @param string $name <p>
	 * Name of the SQL aggregate to be created or redefined.
	 * </p>
	 * @param mixed $step_callback <p>
	 * The name of a PHP function or user-defined function to apply as a
	 * callback for every item in the aggregate.
	 * </p>
	 * @param mixed $final_callback <p>
	 * The name of a PHP function or user-defined function to apply as a
	 * callback at the end of the aggregate data.
	 * </p>
	 * @param int $argument_count [optional] <p>
	 * The number of arguments that the SQL aggregate takes. If
	 * this parameter is negative, then the SQL aggregate may take
	 * any number of arguments.
	 * </p>
	 * @return bool <b>TRUE</b> upon successful creation of the aggregate, <b>FALSE</b> on
	 * failure.
	 * @since 5.3.0
	 */
	public function createAggregate ($name, $step_callback, $final_callback, $argument_count = -1) {}

	/**
	 * Registers a PHP function for use as an SQL collating function
	 * @link https://php.net/manual/en/sqlite3.createcollation.php
	 * @param string $name <p>
	 * Name of the SQL collating function to be created or redefined
	 * </p>
	 * @param callable $callback <p>
	 * The name of a PHP function or user-defined function to apply as a
	 * callback, defining the behavior of the collation. It should accept two
	 * strings and return as <b>strcmp</b> does, i.e. it should
	 * return -1, 1, or 0 if the first string sorts before, sorts after, or is
	 * equal to the second.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.3.11
	 */
	public function createCollation ($name, callable $callback) {}

	/**
	 * Opens a stream resource to read a BLOB
	 * @link https://php.net/manual/en/sqlite3.openblob.php
	 * @param $table <p>The table name.</p>
	 * @param $column <p>The column name.</p>
	 * @param $rowid <p>The row ID.</p>
	 * @param $dbname [optional] <p>The symbolic name of the DB</p>
	 * @param int $flags [optional]
	 * <p>Either <b>SQLITE3_OPEN_READONLY</b> or <b>SQLITE3_OPEN_READWRITE</b> to open the stream for reading only, or for reading and writing, respectively.</p?
	 * @return resource|bool Returns a stream resource, or FALSE on failure.
	 */
	public function openBlob ($table, $column, $rowid, $dbname, int $flags = SQLITE3_OPEN_READONLY) {}

	/**
	 * @param $enableExceptions
	 */
	public function enableExceptions ($enableExceptions) {}

	/**
	 * Instantiates an SQLite3 object and opens an SQLite 3 database
	 * @link https://php.net/manual/en/sqlite3.construct.php
	 * @param string $filename <p>
	 * Path to the SQLite database, or :memory: to use in-memory database.
	 * </p>
	 * @param int $flags [optional] <p>
	 * Optional flags used to determine how to open the SQLite database. By
	 * default, open uses SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE.
	 * <p>
	 * SQLITE3_OPEN_READONLY: Open the database for
	 * reading only.
	 * </p>
	 * @param string $encryption_key [optional] <p>
	 * An optional encryption key used when encrypting and decrypting an
	 * SQLite database.
	 * </p>
	 * @since 5.3.0
	 */
	public function __construct ($filename, $flags = null, $encryption_key = null) {}

}

/**
 * A class that handles prepared statements for the SQLite 3 extension.
 * @link https://php.net/manual/en/class.sqlite3stmt.php
 */
class SQLite3Stmt  {

	/**
	 * Returns the number of parameters within the prepared statement
	 * @link https://php.net/manual/en/sqlite3stmt.paramcount.php
	 * @return int the number of parameters within the prepared statement.
	 * @since 5.3.0
	 */
	public function paramCount () {}

	/**
	 * Closes the prepared statement
	 * @link https://php.net/manual/en/sqlite3stmt.close.php
	 * @return bool <b>TRUE</b>
	 * @since 5.3.0
	 */
	public function close () {}

	/**
	 * Resets the prepared statement
	 * @link https://php.net/manual/en/sqlite3stmt.reset.php
	 * @return bool <b>TRUE</b> if the statement is successfully reset, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function reset () {}

	/**
	 * Clears all current bound parameters
	 * @link https://php.net/manual/en/sqlite3stmt.clear.php
	 * @return bool <b>TRUE</b> on successful clearing of bound parameters, <b>FALSE</b> on
	 * failure.
	 * @since 5.3.0
	 */
	public function clear () {}

	/**
	 * Executes a prepared statement and returns a result set object
	 * @link https://php.net/manual/en/sqlite3stmt.execute.php
	 * @return SQLite3Result an <b>SQLite3Result</b> object on successful execution of the prepared
	 * statement, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function execute () {}

	/**
	 * Binds a parameter to a statement variable
	 * @link https://php.net/manual/en/sqlite3stmt.bindparam.php
	 * @param string $sql_param <p>
	 * An string identifying the statement variable to which the
	 * parameter should be bound.
	 * </p>
	 * @param mixed $param <p>
	 * The parameter to bind to a statement variable.
	 * </p>
	 * @param int $type [optional] <p>
	 * The data type of the parameter to bind.
	 * <p>
	 * SQLITE3_INTEGER: The value is a signed integer,
	 * stored in 1, 2, 3, 4, 6, or 8 bytes depending on the magnitude of
	 * the value.
	 * </p>
	 * @return bool <b>TRUE</b> if the parameter is bound to the statement variable, <b>FALSE</b>
	 * on failure.
	 * @since 5.3.0
	 */
	public function bindParam ($sql_param, &$param, $type = null) {}

	/**
	 * Binds the value of a parameter to a statement variable
	 * @link https://php.net/manual/en/sqlite3stmt.bindvalue.php
	 * @param string $sql_param <p>
	 * An string identifying the statement variable to which the
	 * value should be bound.
	 * </p>
	 * @param mixed $value <p>
	 * The value to bind to a statement variable.
	 * </p>
	 * @param int $type [optional] <p>
	 * The data type of the value to bind.
	 * <p>
	 * SQLITE3_INTEGER: The value is a signed integer,
	 * stored in 1, 2, 3, 4, 6, or 8 bytes depending on the magnitude of
	 * the value.
	 * </p>
	 * @return bool <b>TRUE</b> if the value is bound to the statement variable, <b>FALSE</b>
	 * on failure.
	 * @since 5.3.0
	 */
	public function bindValue ($sql_param, $value, $type = null) {}

	public function readOnly () {}

	/**
	 * @param $sqlite3
	 */
	private function __construct ($sqlite3) {}

}

/**
 * A class that handles result sets for the SQLite 3 extension.
 * @link https://php.net/manual/en/class.sqlite3result.php
 */
class SQLite3Result  {

	/**
	 * Returns the number of columns in the result set
	 * @link https://php.net/manual/en/sqlite3result.numcolumns.php
	 * @return int the number of columns in the result set.
	 * @since 5.3.0
	 */
	public function numColumns () {}

	/**
	 * Returns the name of the nth column
	 * @link https://php.net/manual/en/sqlite3result.columnname.php
	 * @param int $column_number <p>
	 * The numeric zero-based index of the column.
	 * </p>
	 * @return string the string name of the column identified by
	 * <i>column_number</i>.
	 * @since 5.3.0
	 */
	public function columnName ($column_number) {}

	/**
	 * Returns the type of the nth column
	 * @link https://php.net/manual/en/sqlite3result.columntype.php
	 * @param int $column_number <p>
	 * The numeric zero-based index of the column.
	 * </p>
	 * @return int the data type index of the column identified by
	 * <i>column_number</i> (one of
	 * <b>SQLITE3_INTEGER</b>, <b>SQLITE3_FLOAT</b>,
	 * <b>SQLITE3_TEXT</b>, <b>SQLITE3_BLOB</b>, or
	 * <b>SQLITE3_NULL</b>).
	 * @since 5.3.0
	 */
	public function columnType ($column_number) {}

	/**
	 * Fetches a result row as an associative or numerically indexed array or both
	 * @link https://php.net/manual/en/sqlite3result.fetcharray.php
	 * @param int $mode [optional] <p>
	 * Controls how the next row will be returned to the caller. This value
	 * must be one of either SQLITE3_ASSOC,
	 * SQLITE3_NUM, or SQLITE3_BOTH.
	 * <p>
	 * SQLITE3_ASSOC: returns an array indexed by column
	 * name as returned in the corresponding result set
	 * </p>
	 * @return array a result row as an associatively or numerically indexed array or
	 * both. Alternately will return <b>FALSE</b> if there are no more rows.
	 * @since 5.3.0
	 */
	public function fetchArray ($mode = SQLITE3_BOTH) {}

	/**
	 * Resets the result set back to the first row
	 * @link https://php.net/manual/en/sqlite3result.reset.php
	 * @return bool <b>TRUE</b> if the result set is successfully reset
	 * back to the first row, <b>FALSE</b> on failure.
	 * @since 5.3.0
	 */
	public function reset () {}

	/**
	 * Closes the result set
	 * @link https://php.net/manual/en/sqlite3result.finalize.php
	 * @return bool <b>TRUE</b>.
	 * @since 5.3.0
	 */
	public function finalize () {}

	private function __construct () {}

}

/**
 * Specifies that the <b>Sqlite3Result::fetchArray</b>
 * method shall return an array indexed by column name as returned in the
 * corresponding result set.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_ASSOC', 1);

/**
 * Specifies that the <b>Sqlite3Result::fetchArray</b>
 * method shall return an array indexed by column number as returned in the
 * corresponding result set, starting at column 0.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_NUM', 2);

/**
 * Specifies that the <b>Sqlite3Result::fetchArray</b>
 * method shall return an array indexed by both column name and number as
 * returned in the corresponding result set, starting at column 0.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_BOTH', 3);

/**
 * Represents the SQLite3 INTEGER storage class.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_INTEGER', 1);

/**
 * Represents the SQLite3 REAL (FLOAT) storage class.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_FLOAT', 2);

/**
 * Represents the SQLite3 TEXT storage class.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_TEXT', 3);

/**
 * Represents the SQLite3 BLOB storage class.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_BLOB', 4);

/**
 * Represents the SQLite3 NULL storage class.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_NULL', 5);

/**
 * Specifies that the SQLite3 database be opened for reading only.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_OPEN_READONLY', 1);

/**
 * Specifies that the SQLite3 database be opened for reading and writing.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_OPEN_READWRITE', 2);

/**
 * Specifies that the SQLite3 database be created if it does not already
 * exist.
 * @link https://php.net/manual/en/sqlite3.constants.php
 */
define ('SQLITE3_OPEN_CREATE', 4);

// End of sqlite3 v.0.7-dev
?>
