<?php

// Start of SQLite v.2.0-dev

/**
 * @link http://php.net/manual/en/ref.sqlite.php
 */
class SQLiteDatabase  {

	/**
	 * @param $filename
	 * @param $mode [optional]
	 * @param $error_message [optional]
	 */
	final public function __construct ($filename, $mode, &$error_message) {}

	/**
	 * @param $query
	 * @param $result_type [optional]
	 * @param $error_message [optional]
	 */
	public function query ($query, $result_type, &$error_message) {}

	/**
	 * @param $query
	 * @param $error_message [optional]
	 */
	public function queryExec ($query, &$error_message) {}

	/**
	 * @param $query
	 * @param $result_type [optional]
	 * @param $decode_binary [optional]
	 */
	public function arrayQuery ($query, $result_type, $decode_binary) {}

	/**
	 * @param $query
	 * @param $first_row_only [optional]
	 * @param $decode_binary [optional]
	 */
	public function singleQuery ($query, $first_row_only, $decode_binary) {}

	/**
	 * @param $query
	 * @param $result_type [optional]
	 * @param $error_message [optional]
	 */
	public function unbufferedQuery ($query, $result_type, &$error_message) {}

	public function lastInsertRowid () {}

	public function changes () {}

	/**
	 * @param $funcname
	 * @param $step_func
	 * @param $finalize_func
	 * @param $num_args [optional]
	 */
	public function createAggregate ($funcname, $step_func, $finalize_func, $num_args) {}

	/**
	 * @param $funcname
	 * @param $callback
	 * @param $num_args [optional]
	 */
	public function createFunction ($funcname, $callback, $num_args) {}

	/**
	 * @param $ms
	 */
	public function busyTimeout ($ms) {}

	public function lastError () {}

	/**
	 * @param $table_name
	 * @param $result_type [optional]
	 */
	public function fetchColumnTypes ($table_name, $result_type) {}

}

/**
 * @link http://php.net/manual/en/ref.sqlite.php
 */
final class SQLiteResult implements Iterator, Traversable, Countable {

	/**
	 * @param $result_type [optional]
	 * @param $decode_binary [optional]
	 */
	public function fetch ($result_type, $decode_binary) {}

	/**
	 * @param $class_name [optional]
	 * @param $ctor_params [optional]
	 * @param $decode_binary [optional]
	 */
	public function fetchObject ($class_name, $ctor_params, $decode_binary) {}

	/**
	 * @param $decode_binary [optional]
	 */
	public function fetchSingle ($decode_binary) {}

	/**
	 * @param $result_type [optional]
	 * @param $decode_binary [optional]
	 */
	public function fetchAll ($result_type, $decode_binary) {}

	/**
	 * @param $index_or_name
	 * @param $decode_binary [optional]
	 */
	public function column ($index_or_name, $decode_binary) {}

	public function numFields () {}

	/**
	 * @param $field_index
	 */
	public function fieldName ($field_index) {}

	/**
	 * @param $result_type [optional]
	 * @param $decode_binary [optional]
	 */
	public function current ($result_type, $decode_binary) {}

	public function key () {}

	public function next () {}

	public function valid () {}

	public function rewind () {}

	public function count () {}

	public function prev () {}

	public function hasPrev () {}

	public function numRows () {}

	/**
	 * @param $row
	 */
	public function seek ($row) {}

}

/**
 * Represents an unbuffered SQLite result set. Unbuffered results sets are sequential, forward-seeking only.
 * @link http://php.net/manual/en/ref.sqlite.php
 */
final class SQLiteUnbuffered  {

	/**
	 * @param $result_type [optional]
	 * @param $decode_binary [optional]
	 */
	public function fetch ($result_type, $decode_binary) {}

	/**
	 * @param $class_name [optional]
	 * @param $ctor_params [optional]
	 * @param $decode_binary [optional]
	 */
	public function fetchObject ($class_name, $ctor_params, $decode_binary) {}

	/**
	 * @param $decode_binary [optional]
	 */
	public function fetchSingle ($decode_binary) {}

	/**
	 * @param $result_type [optional]
	 * @param $decode_binary [optional]
	 */
	public function fetchAll ($result_type, $decode_binary) {}

	/**
	 * @param $index_or_name
	 * @param $decode_binary [optional]
	 */
	public function column ($index_or_name, $decode_binary) {}

	public function numFields () {}

	/**
	 * @param $field_index
	 */
	public function fieldName ($field_index) {}

	/**
	 * @param $result_type [optional]
	 * @param $decode_binary [optional]
	 */
	public function current ($result_type, $decode_binary) {}

	public function next () {}

	public function valid () {}

}

final class SQLiteException extends RuntimeException  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Clone the exception
	 * @link http://php.net/manual/en/exception.clone.php
	 * @return void 
	 */
	final private function __clone () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param $message [optional]
	 * @param $code [optional]
	 * @param $previous [optional]
	 */
	public function __construct ($message, $code, $previous) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception message
	 * @link http://php.net/manual/en/exception.getmessage.php
	 * @return string the Exception message as a string.
	 */
	final public function getMessage () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception code
	 * @link http://php.net/manual/en/exception.getcode.php
	 * @return int the Exception code as a integer.
	 */
	final public function getCode () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the file in which the exception occurred
	 * @link http://php.net/manual/en/exception.getfile.php
	 * @return string the filename in which the exception was thrown.
	 */
	final public function getFile () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the line in which the exception occurred
	 * @link http://php.net/manual/en/exception.getline.php
	 * @return int the line number where the exception was thrown.
	 */
	final public function getLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace
	 * @link http://php.net/manual/en/exception.gettrace.php
	 * @return array the Exception stack trace as an array.
	 */
	final public function getTrace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns previous Exception
	 * @link http://php.net/manual/en/exception.getprevious.php
	 * @return Exception the previous Exception if available 
	 * or &null; otherwise.
	 */
	final public function getPrevious () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace as a string
	 * @link http://php.net/manual/en/exception.gettraceasstring.php
	 * @return string the Exception stack trace as a string.
	 */
	final public function getTraceAsString () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString () {}

}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Opens a SQLite database and create the database if it does not exist
 * @link http://php.net/manual/en/function.sqlite-open.php
 * @param string $filename <p>
 * The filename of the SQLite database. If the file does not exist, SQLite
 * will attempt to create it. PHP must have write permissions to the file
 * if data is inserted, the database schema is modified or to create the
 * database if it does not exist.
 * </p>
 * @param int $mode [optional] <p>
 * The mode of the file. Intended to be used to open the database in
 * read-only mode. Presently, this parameter is ignored by the sqlite
 * library. The default value for mode is the octal value
 * 0666 and this is the recommended value.
 * </p>
 * @param string $error_message [optional] <p>
 * Passed by reference and is set to hold a descriptive error message
 * explaining why the database could not be opened if there was an error.
 * </p>
 * @return resource a resource (database handle) on success, false on error.
 */
function sqlite_open ($filename, $mode = null, &$error_message = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Opens a persistent handle to an SQLite database and create the database if it does not exist
 * @link http://php.net/manual/en/function.sqlite-popen.php
 * @param string $filename <p>
 * The filename of the SQLite database. If the file does not exist, SQLite
 * will attempt to create it. PHP must have write permissions to the file
 * if data is inserted, the database schema is modified or to create the
 * database if it does not exist.
 * </p>
 * @param int $mode [optional] <p>
 * The mode of the file. Intended to be used to open the database in
 * read-only mode. Presently, this parameter is ignored by the sqlite
 * library. The default value for mode is the octal value
 * 0666 and this is the recommended value.
 * </p>
 * @param string $error_message [optional] <p>
 * Passed by reference and is set to hold a descriptive error message
 * explaining why the database could not be opened if there was an error.
 * </p>
 * @return resource a resource (database handle) on success, false on error.
 */
function sqlite_popen ($filename, $mode = null, &$error_message = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Closes an open SQLite database
 * @link http://php.net/manual/en/function.sqlite-close.php
 * @param resource $dbhandle <p>
 * The SQLite Database resource; returned from sqlite_open
 * when used procedurally.
 * </p>
 * @return void
 */
function sqlite_close ($dbhandle) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Executes a query against a given database and returns a result handle
 * @link http://php.net/manual/en/function.sqlite-query.php
 * @param string $query <p>
 * The query to be executed.
 * </p>
 * <p>
 * Data inside the query should be properly escaped.
 * </p>
 * @param int $result_type [optional] &sqlite.result-type;
 * @param string $error_msg [optional] <p>
 * The specified variable will be filled if an error occurs. This is
 * specially important because SQL syntax errors can't be fetched using
 * the sqlite_last_error function.
 * </p>
 * @return SQLiteResult This function will return a result handle or false on failure.
 * For queries that return rows, the result handle can then be used with
 * functions such as sqlite_fetch_array and
 * sqlite_seek.
 * </p>
 * <p>
 * Regardless of the query type, this function will return false if the
 * query failed.
 * </p>
 * <p>
 * sqlite_query returns a buffered, seekable result
 * handle. This is useful for reasonably small queries where you need to
 * be able to randomly access the rows. Buffered result handles will
 * allocate memory to hold the entire result and will not return until it
 * has been fetched. If you only need sequential access to the data, it is
 * recommended that you use the much higher performance
 * sqlite_unbuffered_query instead.
 */
function sqlite_query ($query, $result_type = null, &$error_msg = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.3)<br/>
 * Executes a result-less query against a given database
 * @link http://php.net/manual/en/function.sqlite-exec.php
 * @param string $query <p>
 * The query to be executed.
 * </p>
 * <p>
 * Data inside the query should be properly escaped.
 * </p>
 * @param string $error_msg [optional] <p>
 * The specified variable will be filled if an error occurs. This is
 * specially important because SQL syntax errors can't be fetched using
 * the sqlite_last_error function.
 * </p>
 * @return bool This function will return a boolean result; true for success or false for failure.
 * If you need to run a query that returns rows, see sqlite_query.
 */
function sqlite_exec ($query, &$error_msg = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Execute a query against a given database and returns an array
 * @link http://php.net/manual/en/function.sqlite-array-query.php
 * @param string $query <p>
 * The query to be executed.
 * </p>
 * <p>
 * Data inside the query should be properly escaped.
 * </p>
 * @param int $result_type [optional] &sqlite.result-type;
 * @param bool $decode_binary [optional] &sqlite.decode-bin;
 * @return array an array of the entire result set; false otherwise.
 */
function sqlite_array_query ($query, $result_type = null, $decode_binary = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.1)<br/>
 * Executes a query and returns either an array for one single column or the value of the first row
 * @link http://php.net/manual/en/function.sqlite-single-query.php
 * @param string $query 
 * @param bool $first_row_only [optional] 
 * @param bool $decode_binary [optional] 
 * @return array
 */
function sqlite_single_query ($query, $first_row_only = null, $decode_binary = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Fetches the next row from a result set as an array
 * @link http://php.net/manual/en/function.sqlite-fetch-array.php
 * @param result_type int[optional] &sqlite.result-type;
 * @param decode_binary bool[optional] &sqlite.decode-bin;
 * @return array an array of the next row from a result set; false if the
 * next position is beyond the final row.
 */
function sqlite_fetch_array ($result_type = null, $decode_binary = null) {}

/**
 * (PHP 5)<br/>
 * Fetches the next row from a result set as an object
 * @link http://php.net/manual/en/function.sqlite-fetch-object.php
 * @param string $class_name [optional] 
 * @param array $ctor_params [optional] 
 * @param bool $decode_binary [optional] 
 * @return object
 */
function sqlite_fetch_object ($class_name = null, array $ctor_params = null, $decode_binary = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.1)<br/>
 * Fetches the first column of a result set as a string
 * @link http://php.net/manual/en/function.sqlite-fetch-single.php
 * @param bool $decode_binary [optional] &sqlite.decode-bin;
 * @return string the first column value, as a string.
 */
function sqlite_fetch_single ($decode_binary = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * &Alias; <function>sqlite_fetch_single</function>
 * @link http://php.net/manual/en/function.sqlite-fetch-string.php
 * @param $result
 * @param $decode_binary [optional]
 */
function sqlite_fetch_string ($result, $decode_binary) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Fetches all rows from a result set as an array of arrays
 * @link http://php.net/manual/en/function.sqlite-fetch-all.php
 * @param int $result_type [optional] &sqlite.result-type;
 * @param bool $decode_binary [optional] &sqlite.decode-bin;
 * @return array an array of the remaining rows in a result set. If called right
 * after sqlite_query, it returns all rows. If called
 * after sqlite_fetch_array, it returns the rest. If
 * there are no rows in a result set, it returns an empty array.
 */
function sqlite_fetch_all ($result_type = null, $decode_binary = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Fetches the current row from a result set as an array
 * @link http://php.net/manual/en/function.sqlite-current.php
 * @param int $result_type [optional] &sqlite.result-type;
 * @param bool $decode_binary [optional] &sqlite.decode-bin;
 * @return array an array of the current row from a result set; false if the
 * current position is beyond the final row.
 */
function sqlite_current ($result_type = null, $decode_binary = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Fetches a column from the current row of a result set
 * @link http://php.net/manual/en/function.sqlite-column.php
 * @param mixed $index_or_name <p>
 * The column index or name to fetch.
 * </p>
 * @param bool $decode_binary [optional] &sqlite.decode-bin;
 * @return mixed the column value.
 */
function sqlite_column ($index_or_name, $decode_binary = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the version of the linked SQLite library
 * @link http://php.net/manual/en/function.sqlite-libversion.php
 * @return string the librart version, as a string.
 */
function sqlite_libversion () {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the encoding of the linked SQLite library
 * @link http://php.net/manual/en/function.sqlite-libencoding.php
 * @return string the library encoding.
 */
function sqlite_libencoding () {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the number of rows that were changed by the most
   recent SQL statement
 * @link http://php.net/manual/en/function.sqlite-changes.php
 * @param $db
 * @return int the number of changed rows.
 */
function sqlite_changes ($db) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the rowid of the most recently inserted row
 * @link http://php.net/manual/en/function.sqlite-last-insert-rowid.php
 * @param $db
 * @return int the row id, as an integer.
 */
function sqlite_last_insert_rowid ($db) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the number of rows in a buffered result set
 * @link http://php.net/manual/en/function.sqlite-num-rows.php
 * @param $result
 * @return int the number of rows, as an integer.
 */
function sqlite_num_rows ($result) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the number of fields in a result set
 * @link http://php.net/manual/en/function.sqlite-num-fields.php
 * @param $result
 * @return int the number of fields, as an integer.
 */
function sqlite_num_fields ($result) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the name of a particular field
 * @link http://php.net/manual/en/function.sqlite-field-name.php
 * @param int $field_index <p>
 * The ordinal column number in the result set.
 * </p>
 * @return string the name of a field in an SQLite result set, given the ordinal
 * column number; false on error.
 */
function sqlite_field_name ($field_index) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Seek to a particular row number of a buffered result set
 * @link http://php.net/manual/en/function.sqlite-seek.php
 * @param int $rownum <p>
 * The ordinal row number to seek to. The row number is zero-based (0 is
 * the first row).
 * </p>
 * &sqlite.no-unbuffered;
 * @return bool false if the row does not exist, true otherwise.
 */
function sqlite_seek ($rownum) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Seek to the first row number
 * @link http://php.net/manual/en/function.sqlite-rewind.php
 * @param $result
 * @return bool false if there are no rows in the result set, true otherwise.
 */
function sqlite_rewind ($result) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Seek to the next row number
 * @link http://php.net/manual/en/function.sqlite-next.php
 * @param $result
 * @return bool true on success, or false if there are no more rows.
 */
function sqlite_next ($result) {}

/**
 * (PHP 5)<br/>
 * Seek to the previous row number of a result set
 * @link http://php.net/manual/en/function.sqlite-prev.php
 * @param $result
 * @return bool true on success, or false if there are no more previous rows.
 */
function sqlite_prev ($result) {}

/**
 * (PHP 5)<br/>
 * Returns whether more rows are available
 * @link http://php.net/manual/en/function.sqlite-valid.php
 * @param $result
 * @return bool true if there are more rows available from the
 * result handle, or false otherwise.
 */
function sqlite_valid ($result) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Finds whether or not more rows are available
 * @link http://php.net/manual/en/function.sqlite-has-more.php
 * @param resource $result <p>
 * The SQLite result resource.
 * </p>
 * @return bool true if there are more rows available from the
 * result handle, or false otherwise.
 */
function sqlite_has_more ($result) {}

/**
 * (PHP 5)<br/>
 * Returns whether or not a previous row is available
 * @link http://php.net/manual/en/function.sqlite-has-prev.php
 * @param $result
 * @return bool true if there are more previous rows available from the
 * result handle, or false otherwise.
 */
function sqlite_has_prev ($result) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Escapes a string for use as a query parameter
 * @link http://php.net/manual/en/function.sqlite-escape-string.php
 * @param string $item <p>
 * The string being quoted.
 * </p>
 * <p>
 * If the item contains a NUL
 * character, or if it begins with a character whose ordinal value is
 * 0x01, PHP will apply a binary encoding scheme so that
 * you can safely store and retrieve binary data.
 * </p>
 * @return string an escaped string for use in an SQLite SQL statement.
 */
function sqlite_escape_string ($item) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Set busy timeout duration, or disable busy handlers
 * @link http://php.net/manual/en/function.sqlite-busy-timeout.php
 * @param int $milliseconds <p>
 * The number of milliseconds. When set to
 * 0, busy handlers will be disabled and SQLite will
 * return immediately with a SQLITE_BUSY status code
 * if another process/thread has the database locked for an update.
 * </p>
 * <p>
 * PHP sets the default busy timeout to be 60 seconds when the database is
 * opened.
 * </p>
 * <p>
 * There are one thousand (1000) milliseconds in one second.
 * </p>
 * @return void
 */
function sqlite_busy_timeout ($milliseconds) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the error code of the last error for a database
 * @link http://php.net/manual/en/function.sqlite-last-error.php
 * @param $db
 * @return int an error code, or 0 if no error occurred.
 */
function sqlite_last_error ($db) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Returns the textual description of an error code
 * @link http://php.net/manual/en/function.sqlite-error-string.php
 * @param int $error_code <p>
 * The error code being used, which might be passed in from
 * sqlite_last_error.
 * </p>
 * @return string a human readable description of the error_code,
 * as a string.
 */
function sqlite_error_string ($error_code) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Execute a query that does not prefetch and buffer all data
 * @link http://php.net/manual/en/function.sqlite-unbuffered-query.php
 * @param string $query <p>
 * The query to be executed.
 * </p>
 * <p>
 * Data inside the query should be properly escaped.
 * </p>
 * @param int $result_type [optional] &sqlite.result-type;
 * @param string $error_msg [optional] <p>
 * The specified variable will be filled if an error occurs. This is
 * specially important because SQL syntax errors can't be fetched using
 * the sqlite_last_error function.
 * </p>
 * @return SQLiteUnbuffered a result handle or false on failure.
 * </p>
 * <p>
 * sqlite_unbuffered_query returns a sequential
 * forward-only result set that can only be used to read each row, one after
 * the other.
 */
function sqlite_unbuffered_query ($query, $result_type = null, &$error_msg = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Register an aggregating UDF for use in SQL statements
 * @link http://php.net/manual/en/function.sqlite-create-aggregate.php
 * @param string $function_name <p>
 * The name of the function used in SQL statements.
 * </p>
 * @param callback $step_func <p>
 * Callback function called for each row of the result set.
 * </p>
 * @param callback $finalize_func <p>
 * Callback function to aggregate the "stepped" data from each row.
 * </p>
 * @param int $num_args [optional] <p>
 * Hint to the SQLite parser if the callback function accepts a
 * predetermined number of arguments.
 * </p>
 * @return void
 */
function sqlite_create_aggregate ($function_name, $step_func, $finalize_func, $num_args = null) {}

/**
 * (PHP 5, sqlite &gt;= 1.0.0)<br/>
 * Registers a "regular" User Defined Function for use in SQL statements
 * @link http://php.net/manual/en/function.sqlite-create-function.php
 * @param string $function_name <p>
 * The name of the function used in SQL statements.
 * </p>
 * @param callback $callback <p>
 * Callback function to handle the defined SQL function.
 * </p>
 * Callback functions should return a type understood by SQLite (i.e.
 * scalar type).
 * @param int $num_args [optional] <p>
 * Hint to the SQLite parser if the callback function accepts a
 * predetermined number of arguments.
 * </p>
 * @return void
 */
function sqlite_create_function ($function_name, $callback, $num_args = null) {}

/**
 * (PHP 5)<br/>
 * Opens a SQLite database and returns a SQLiteDatabase object
 * @link http://php.net/manual/en/function.sqlite-factory.php
 * @param string $filename <p>
 * The filename of the SQLite database.
 * </p>
 * @param int $mode [optional] <p>
 * The mode of the file. Intended to be used to open the database in
 * read-only mode. Presently, this parameter is ignored by the sqlite
 * library. The default value for mode is the octal value
 * 0666 and this is the recommended value.
 * </p>
 * @param string $error_message [optional] <p>
 * Passed by reference and is set to hold a descriptive error message
 * explaining why the database could not be opened if there was an error.
 * </p>
 * @return SQLiteDatabase a SQLiteDatabase object on success, &null; on error.
 */
function sqlite_factory ($filename, $mode = null, &$error_message = null) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Encode binary data before returning it from an UDF
 * @link http://php.net/manual/en/function.sqlite-udf-encode-binary.php
 * @param string $data <p>
 * The string being encoded.
 * </p>
 * @return string The encoded string.
 */
function sqlite_udf_encode_binary ($data) {}

/**
 * (PHP 5, PECL sqlite &gt;= 1.0.0)<br/>
 * Decode binary data passed as parameters to an <acronym>UDF</acronym>
 * @link http://php.net/manual/en/function.sqlite-udf-decode-binary.php
 * @param string $data <p>
 * The encoded data that will be decoded, data that was applied by either
 * sqlite_udf_encode_binary or
 * sqlite_escape_string. 
 * </p>
 * @return string The decoded string.
 */
function sqlite_udf_decode_binary ($data) {}

/**
 * (PHP 5)<br/>
 * Return an array of column types from a particular table
 * @link http://php.net/manual/en/function.sqlite-fetch-column-types.php
 * @param string $table_name <p>
 * The table name to query.
 * </p>
 * @param int $result_type [optional] <p>
 * The optional result_type parameter accepts a
 * constant and determines how the returned array will be indexed. Using
 * SQLITE_ASSOC will return only associative indices
 * (named fields) while SQLITE_NUM will return only
 * numerical indices (ordinal field numbers).
 * SQLITE_BOTH will return both associative and
 * numerical indices. SQLITE_ASSOC is the default for
 * this function.
 * </p>
 * @return array an array of column data types; false on error.
 */
function sqlite_fetch_column_types ($table_name, $result_type = null) {}


/**
 * Columns are returned into the array having both a numerical index
 * and the field name as the array index.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_BOTH', 3);

/**
 * Columns are returned into the array having a numerical index to the
 * fields. This index starts with 0, the first field in the result.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_NUM', 2);

/**
 * Columns are returned into the array having the field name as the array
 * index.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_ASSOC', 1);

/**
 * Successful result.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_OK', 0);

/**
 * SQL error or missing database.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_ERROR', 1);

/**
 * An internal logic error in SQLite.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_INTERNAL', 2);

/**
 * Access permission denied.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_PERM', 3);

/**
 * Callback routine requested an abort.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_ABORT', 4);

/**
 * The database file is locked.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_BUSY', 5);

/**
 * A table in the database is locked.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_LOCKED', 6);

/**
 * Memory allocation failed.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_NOMEM', 7);

/**
 * Attempt to write a readonly database.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_READONLY', 8);

/**
 * Operation terminated internally.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_INTERRUPT', 9);

/**
 * Disk I/O error occurred.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_IOERR', 10);

/**
 * The database disk image is malformed.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_CORRUPT', 11);

/**
 * (Internal) Table or record not found.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_NOTFOUND', 12);

/**
 * Insertion failed because database is full.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_FULL', 13);

/**
 * Unable to open the database file.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_CANTOPEN', 14);

/**
 * Database lock protocol error.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_PROTOCOL', 15);

/**
 * (Internal) Database table is empty.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_EMPTY', 16);

/**
 * The database schema changed.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_SCHEMA', 17);

/**
 * Too much data for one row of a table.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_TOOBIG', 18);

/**
 * Abort due to constraint violation.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_CONSTRAINT', 19);

/**
 * Data type mismatch.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_MISMATCH', 20);

/**
 * Library used incorrectly.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_MISUSE', 21);

/**
 * Uses of OS features not supported on host.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_NOLFS', 22);

/**
 * Authorized failed.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_AUTH', 23);

/**
 * File opened that is not a database file.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_NOTADB', 26);

/**
 * Auxiliary database format error.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_FORMAT', 24);

/**
 * Internal process has another row ready.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_ROW', 100);

/**
 * Internal process has finished executing.
 * @link http://php.net/manual/en/sqlite.constants.php
 */
define ('SQLITE_DONE', 101);

// End of SQLite v.2.0-dev
?>
