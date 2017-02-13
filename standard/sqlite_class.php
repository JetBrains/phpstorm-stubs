<?php
/**
 * PHPStorm stub file for SQLite classes.
 *
 * @deprecated 5.4.0 This extension is no long included by default starting with PHP 5.4.0.
 * @see        http://php.net/manual/en/book.sqlite3.php
 */

/**
 * @link       http://php.net/manual/en/ref.sqlite.php
 * @since      5.0.0
 * @deprecated 5.4.0 This extension is no long included by default starting with PHP 5.4.0.
 * @see        http://php.net/manual/en/book.sqlite3.php
 */
class SQLiteDatabase
{
    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     *
     * @link http://php.net/manual/en/function.sqlite-open.php
     *
     * @param $filename      <p>The filename of the SQLite database. If the file does not exist, SQLite will attempt to
     *                       create it. PHP must have write permissions to the file if data is inserted, the database
     *                       schema is modified or to create the database if it does not exist.</p>
     * @param $mode          [optional] <p>The mode of the file. Intended to be used to open the database in read-only
     *                       mode. Presently, this parameter is ignored by the sqlite library. The default value for
     *                       mode is the octal value 0666 and this is the recommended value.</p>
     * @param $error_message [optional] <p>Passed by reference and is set to hold a descriptive error message
     *                       explaining why the database could not be opened if there was an error.</p>
     */
    final public function __construct($filename, $mode = 0666, &$error_message) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Execute a query against a given database and returns an array
     *
     * @link http://php.net/manual/en/function.sqlite-array-query.php
     *
     * @param $query         <p>
     *                       The query to be executed.
     *                       </p>
     *                       <p>
     *                       Data inside the query should be {@link
     *                       http://php.net/manual/en/function.sqlite-escape-string.php properly escaped}.
     *                       </p>
     * @param $result_type   [optional] <p>The optional <i>result_type</i>
     *                       parameter accepts a constant and determines how the returned array will be
     *                       indexed. Using <b>SQLITE_ASSOC</b> will return only associative
     *                       indices (named fields) while <b>SQLITE_NUM</b> will return
     *                       only numerical indices (ordinal field numbers). <b>SQLITE_BOTH</b>
     *                       will return both associative and numerical indices.
     *                       <b>SQLITE_BOTH</b> is the default for this function.</p>
     * @param $decode_binary [optional] <p>When the <i>decode_binary</i>
     *                       parameter is set to <b>TRUE</b> (the default), PHP will decode the binary encoding
     *                       it applied to the data if it was encoded using the
     *                       {@see sqlite_escape_string()}.  You should normally leave this
     *                       value at its default, unless you are interoperating with databases created by
     *                       other sqlite capable applications.</p>
     *                       <p>
     *                       Returns an array of the entire result set; <b>FALSE</b> otherwise.
     *                       </p>
     *                       <p>The column names returned by
     *                       <b>SQLITE_ASSOC</b> and <b>SQLITE_BOTH</b> will be
     *                       case-folded according to the value of the
     *                       {@link http://php.net/manual/en/sqlite.configuration.php#ini.sqlite.assoc-case
     *                       sqlite.assoc_case} configuration option.</p>
     */
    public function arrayQuery($query, $result_type, $decode_binary) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Set busy timeout duration, or disable busy handlers
     *
     * @link http://php.net/manual/en/function.sqlite-busy-timeout.php
     *
     * @param $milliseconds <p> The number of milliseconds. When set to 0, busy handlers will be disabled and SQLite
     *                      will return immediately with a <b>SQLITE_BUSY</b> status code if another process/thread has
     *                      the database locked for an update. PHP sets the default busy timeout to be 60 seconds when
     *                      the database is opened.</p>
     *
     * @return int <p>Returns an error code, or 0 if no error occurred.</p>
     */
    public function busyTimeout($milliseconds) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Returns the number of rows that were changed by the most recent SQL statement
     *
     * @link http://php.net/manual/en/function.sqlite-changes.php
     * @return int Returns the number of changed rows.
     */
    public function changes() { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Register an aggregating UDF for use in SQL statements
     *
     * @link http://php.net/manual/en/function.sqlite-create-aggregate.php
     *
     * @param $function_name <p>The name of the function used in SQL statements.</p>
     * @param $step_func     <p>Callback function called for each row of the result set. Function parameters are
     *                       &$context, $value, ....</p>
     * @param $finalize_func <p>Callback function to aggregate the "stepped" data from each row. Function parameter is
     *                       &$context and the function should return the final result of aggregation.</p>
     * @param $num_args      [optional] <p>Hint to the SQLite parser if the callback function accepts a predetermined
     *                       number of arguments.</p>
     */
    public function createAggregate($function_name, $step_func, $finalize_func, $num_args = -1) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Registers a "regular" User Defined Function for use in SQL statements
     *
     * @link http://php.net/manual/en/function.sqlite-create-function.php
     *
     * @param $function_name <p>The name of the function used in SQL statements.</p>
     * @param $callback      <p>
     *                       Callback function to handle the defined SQL function.
     *                       </p>
     *                       <blockquote><p><b>Note</b>:
     *                       Callback functions should return a type understood by SQLite (i.e.
     *                       {@link http://php.net/manual/en/language.types.intro.php scalar type}).
     *                       </p></blockquote>
     * @param $num_args      [optional]   <blockquote><p><b>Note</b>: Two alternative syntaxes are
     *                       supported for compatibility with other database extensions (such as MySQL).
     *                       The preferred form is the first, where the <i>dbhandle</i>
     *                       parameter is the first parameter to the function.</p></blockquote>
     */
    public function createFunction($function_name, $callback, $num_args = -1) { }

    /**
     * (PHP 5 &lt; 5.4.0)
     * Return an array of column types from a particular table
     *
     * @link http://php.net/manual/en/function.sqlite-fetch-column-types.php
     *
     * @param $table_name  <p>The table name to query.</p>
     * @param $result_type [optional] <p>
     *                     The optional <i>result_type</i> parameter accepts a
     *                     constant and determines how the returned array will be indexed. Using
     *                     <b>SQLITE_ASSOC</b> will return only associative indices
     *                     (named fields) while <b>SQLITE_NUM</b> will return only
     *                     numerical indices (ordinal field numbers).
     *                     <b>SQLITE_ASSOC</b> is the default for
     *                     this function.
     *                     </p>
     *
     * @return array <p>
     * Returns an array of column data types; <b>FALSE</b> on error.
     * </p>
     * <p>The column names returned by
     * <b>SQLITE_ASSOC</b> and <b>SQLITE_BOTH</b> will be
     * case-folded according to the value of the
     * {@link http://php.net/manual/en/sqlite.configuration.php#ini.sqlite.assoc-case sqlite.assoc_case} configuration
     * option.</p>
     */
    public function fetchColumnTypes($table_name, $result_type = SQLITE_ASSOC) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Returns the error code of the last error for a database
     *
     * @link http://php.net/manual/en/function.sqlite-last-error.php
     * @return int Returns an error code, or 0 if no error occurred.
     */
    public function lastError() { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Returns the rowid of the most recently inserted row
     *
     * @link http://php.net/manual/en/function.sqlite-last-insert-rowid.php
     * @return int Returns the row id, as an integer.
     */
    public function lastInsertRowid() { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     *
     * @link http://php.net/manual/en/function.sqlite-query.php
     *
     * @param $query         <p>
     *                       The query to be executed.
     *                       </p>
     *                       <p>
     *                       Data inside the query should be {@link
     *                       http://php.net/manual/en/function.sqlite-escape-string.php properly escaped}.
     *                       </p>
     * @param $result_type   [optional]
     *                       <p>The optional <i>result_type</i> parameter accepts a constant and determines how the
     *                       returned array will be indexed. Using <b>SQLITE_ASSOC</b> will return only associative
     *                       indices (named fields) while <b>SQLITE_NUM</b> will return only numerical indices (ordinal
     *                       field numbers). <b>SQLITE_BOTH</b> will return both associative and numerical indices.
     *                       <b>SQLITE_BOTH</b> is the default for this function.</p>
     * @param $error_message [optional] <p>The specified variable will be filled if an error occurs. This is specially
     *                       important because SQL syntax errors can't be fetched using the {@see sqlite_last_error()}
     *                       function.</p>
     *
     * @return resource|bool <p>
     * This function will return a result handle or <b>FALSE</b> on failure.
     * For queries that return rows, the result handle can then be used with
     * functions such as {@see sqlite_fetch_array()} and
     * {@see sqlite_seek()}.
     * </p>
     * <p>
     * Regardless of the query type, this function will return <b>FALSE</b> if the
     * query failed.
     * </p>
     * <p>
     * {@see sqlite_query()} returns a buffered, seekable result
     * handle.  This is useful for reasonably small queries where you need to
     * be able to randomly access the rows.  Buffered result handles will
     * allocate memory to hold the entire result and will not return until it
     * has been fetched.  If you only need sequential access to the data, it is
     * recommended that you use the much higher performance
     * {@see sqlite_unbuffered_query()} instead.
     * </p>
     */
    public function query($query, $result_type, &$error_message) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     *
     * @link http://php.net/manual/en/function.sqlite-exec.php
     *
     * @param string $query         <p>
     *                              The query to be executed.
     *                              </p>
     *                              <p>
     *                              Data inside the query should be {@link
     *                              http://php.net/manual/en/function.sqlite-escape-string.php properly escaped}.
     *                              </p>
     * @param string $error_message [optional] <p>The specified variable will be filled if an error occurs. This is
     *                              specially important because SQL syntax errors can't be fetched using the
     *                              {@see sqlite_last_error()} function.</p>
     *
     * @return boolean <p>
     * This function will return a boolean result; <b>TRUE</b> for success or <b>FALSE</b> for failure.
     * If you need to run a query that returns rows, see {@see sqlite_query()}.
     * </p>
     * <p>The column names returned by
     * <b>SQLITE_ASSOC</b> and <b>SQLITE_BOTH</b> will be
     * case-folded according to the value of the
     * {@see sqlite.assoc_case} configuration
     * option.</p>
     */
    public function queryExec($query, &$error_message) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.1)
     * Executes a query and returns either an array for one single column or the value of the first row
     *
     * @link http://php.net/manual/en/function.sqlite-single-query.php
     *
     * @param string $query
     * @param bool   $first_row_only [optional]
     * @param bool   $decode_binary  [optional]
     *
     * @return array
     */
    public function singleQuery($query, $first_row_only, $decode_binary) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Execute a query that does not prefetch and buffer all data
     *
     * @link http://php.net/manual/en/function.sqlite-unbuffered-query.php
     *
     * @param $query         <p>
     *                       The query to be executed.
     *                       </p>
     *                       <p>
     *                       Data inside the query should be {@link
     *                       http://php.net/manual/en/function.sqlite-escape-string.php properly escaped}.
     *                       </p>
     * @param $result_type   [optional] <p>The optional <i>result_type</i> parameter accepts a constant and determines
     *                       how the returned array will be indexed. Using <b>SQLITE_ASSOC</b> will return only
     *                       associative indices (named fields) while <b>SQLITE_NUM</b> will return only numerical
     *                       indices (ordinal field numbers).
     *                       <b>SQLITE_BOTH</b> will return both associative and numerical indices. <b>SQLITE_BOTH</b>
     *                       is the default for this function.
     * @param $error_message [optional]
     *
     * @return resource Returns a result handle or <b>FALSE</b> on failure.
     * {@see sqlite_unbuffered_query()} returns a sequential forward-only result set that can only be used to read each
     * row, one after the other.
     */
    public function unbufferedQuery($query, $result_type = SQLITE_BOTH, &$error_message) { }
}

/**
 * @link       http://php.net/manual/en/ref.sqlite.php
 * @since      5.0.0
 * @deprecated 5.4.0 This extension is no long included by default starting with PHP 5.4.0.
 * @see        http://php.net/manual/en/book.sqlite3.php
 */
final class SQLiteException extends RuntimeException
{
}

/**
 * @link       http://php.net/manual/en/ref.sqlite.php
 * @since      5.0.0
 * @deprecated 5.4.0 This extension is no long included by default starting with PHP 5.4.0.
 * @see        http://php.net/manual/en/book.sqlite3.php
 */
final class SQLiteResult implements Iterator, Countable
{
    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Fetches a column from the current row of a result set
     *
     * @link http://php.net/manual/en/function.sqlite-column.php
     *
     * @param $index_or_name
     * @param $decode_binary [optional] <p>When the <i>decode_binary</i>
     *                       parameter is set to <b>TRUE</b> (the default), PHP will decode the binary encoding
     *                       it applied to the data if it was encoded using the
     *                       {@see sqlite_escape_string()}.  You should normally leave this
     *                       value at its default, unless you are interoperating with databases created by
     *                       other sqlite capable applications.</p>
     *
     * @return mixed <p>Returns the column value</p>
     */
    public function column($index_or_name, $decode_binary = true) { }

    /**
     * Count elements of an object
     *
     * @link  http://php.net/manual/en/countable.count.php
     * @return int <p>The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * </p>
     * @since 5.1.0
     */
    public function count() { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Fetches the current row from a result set as an array
     *
     * @link http://php.net/manual/en/function.sqlite-current.php
     *
     * @param $result_type   [optional] <p>The optional <i>result_type</i>
     *                       parameter accepts a constant and determines how the returned array will be
     *                       indexed. Using <b>SQLITE_ASSOC</b> will return only associative
     *                       indices (named fields) while <b>SQLITE_NUM</b> will return
     *                       only numerical indices (ordinal field numbers). <b>SQLITE_BOTH</b>
     *                       will return both associative and numerical indices.
     *                       <b>SQLITE_BOTH</b> is the default for this function.</p>
     * @param $decode_binary [optional] <p>When the <i>decode_binary</i>
     *                       parameter is set to <b>TRUE</b> (the default), PHP will decode the binary encoding
     *                       it applied to the data if it was encoded using the
     *                       {@see sqlite_escape_string()}.  You should normally leave this
     *                       value at its default, unless you are interoperating with databases created by
     *                       other sqlite capable applications.</p>
     *
     * @return array <p>
     * Returns an array of the current row from a result set; <b>FALSE</b> if the
     * current position is beyond the final row.
     * </p>
     * <p>The column names returned by
     * <b>SQLITE_ASSOC</b> and <b>SQLITE_BOTH</b> will be
     * case-folded according to the value of the
     * {@link http://php.net/manual/en/sqlite.configuration.php#ini.sqlite.assoc-case sqlite.assoc_case} configuration
     * option.</p>
     */
    public function current($result_type = SQLITE_BOTH, $decode_binary = true) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Fetches the next row from a result set as an array
     *
     * @link http://php.net/manual/en/function.sqlite-fetch-array.php
     *
     * @param $result_type   [optional]
     *                       <p>
     *                       The optional <i>result_type</i>
     *                       parameter accepts a constant and determines how the returned array will be
     *                       indexed. Using <b>SQLITE_ASSOC</b> will return only associative
     *                       indices (named fields) while <b>SQLITE_NUM</b> will return
     *                       only numerical indices (ordinal field numbers). <b>SQLITE_BOTH</b>
     *                       will return both associative and numerical indices.
     *                       <b>SQLITE_BOTH</b> is the default for this function.
     * @param $decode_binary [optional] <p>When the <i>decode_binary</i>
     *                       parameter is set to <b>TRUE</b> (the default), PHP will decode the binary encoding
     *                       it applied to the data if it was encoded using the
     *                       {@link http://php.net/manual/en/sqlite.configuration.php#ini.sqlite.assoc-case
     *                       sqlite.assoc_case}. You should normally leave this value at its default, unless you are
     *                       interoperating with databases created by other sqlite capable applications.</p>
     *
     * @return array <p>
     * Returns an array of the next row from a result set; <b>FALSE</b> if the
     * next position is beyond the final row.
     * </p>
     * <p>The column names returned by
     * <b>SQLITE_ASSOC</b> and <b>SQLITE_BOTH</b> will be
     * case-folded according to the value of the
     * {@link http://php.net/manual/en/sqlite.configuration.php#ini.sqlite.assoc-case sqlite.assoc_case}  configuration
     * option.</p>
     */
    public function fetch($result_type = SQLITE_BOTH, $decode_binary = true) { }

    /**
     * (PHP 5 &lt; 5.4.0)
     * Fetches the next row from a result set as an object
     *
     * @link http://php.net/manual/en/function.sqlite-fetch-object.php
     *
     * @param resource $result_type   [optional]
     * @param array    $ctor_params   [optional]
     * @param bool     $decode_binary [optional]
     *
     * @return object
     */
    public function fetchAll($result_type, array $ctor_params, $decode_binary = true) { }

    /**
     * (PHP 5 &lt; 5.4.0)
     * Fetches the next row from a result set as an object
     *
     * @link http://php.net/manual/en/function.sqlite-fetch-object.php
     *
     * @param string $class_name    [optional]
     * @param array  $ctor_params   [optional]
     * @param bool   $decode_binary [optional]
     *
     * @return object
     */
    public function fetchObject($class_name, $ctor_params, $decode_binary = true) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.1)
     * Fetches the first column of a result set as a string
     *
     * @link http://php.net/manual/en/function.sqlite-fetch-single.php
     *
     * @param bool $decode_binary [optional]
     *
     * @return string <p>Returns the first column value, as a string.</p>
     */
    public function fetchSingle($decode_binary = true) { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Returns the name of a particular field
     *
     * @link http://php.net/manual/en/function.sqlite-field-name.php
     *
     * @param $field_index <p>The ordinal column number in the result set.</p>
     *
     * @return string <p>
     * Returns the name of a field in an SQLite result set, given the ordinal
     * column number; <b>FALSE</b> on error.
     * </p>
     * <p>The column names returned by
     * <b>SQLITE_ASSOC</b> and <b>SQLITE_BOTH</b> will be
     * case-folded according to the value of the
     * {@link http://php.net/manual/en/sqlite.configuration.php#ini.sqlite.assoc-case sqlite.assoc_case}configuration
     * option.</p>
     *
     */
    public function fieldName($field_index) { }

    /**
     * @since 5.4.0
     *        Returns whether or not a previous row is available
     * @link  http://php.net/manual/en/function.sqlite-has-prev.php
     * @return bool <p>
     *        Returns <b>TRUE</b> if there are more previous rows available from the
     *        <i>result</i> handle, or <b>FALSE</b> otherwise.
     *        </p>
     */
    public function hasPrev() { }

    /**
     * Return the key of the current element
     *
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key() { }

    /**
     * Seek to the next row number
     *
     * @link  http://php.net/manual/en/function.sqlite-next.php
     * @return bool Returns <b>TRUE</b> on success, or <b>FALSE</b> if there are no more rows.
     * @since 5.0.0
     */
    public function next() { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Returns the number of fields in a result set
     *
     * @link http://php.net/manual/en/function.sqlite-num-fields.php
     * @return int <p>Returns the number of fields, as an integer.</p>
     */
    public function numFields() { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Returns the number of rows in a buffered result set
     *
     * @link http://php.net/manual/en/function.sqlite-num-rows.php
     * @return int Returns the number of rows, as an integer.
     */
    public function numRows() { }

    /**
     * Seek to the previous row number of a result set
     *
     * @link  http://php.net/manual/en/function.sqlite-prev.php
     * @return boolean <p> Returns <b>TRUE</b> on success, or <b>FALSE</b> if there are no more previous rows.
     * </p>
     * @since 5.4.0
     */
    public function prev() { }

    /**
     * Rewind the Iterator to the first element
     *
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind() { }

    /**
     * (PHP 5 &lt; 5.4.0, PECL sqlite &gt;= 1.0.0)
     * Seek to a particular row number of a buffered result set
     *
     * @link http://php.net/manual/en/function.sqlite-seek.php
     *
     * @param $row
     * <p>
     * The ordinal row number to seek to.  The row number is zero-based (0 is
     * the first row).
     * </p>
     * <blockquote><p><b>Note</b>: </p><p>This function cannot be used with
     * unbuffered result handles.</p></blockquote>
     */
    public function seek($row) { }

    /**
     * Checks if current position is valid
     *
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean <p>
     * Returns <b>TRUE</b> if there are more rows available from the
     * <i>result</i> handle, or <b>FALSE</b> otherwise.
     * </p>
     * @since 5.0.0
     */
    public function valid() { }
}

/**
 * Represents an unbuffered SQLite result set. Unbuffered results sets are sequential, forward-seeking only.
 *
 * @link       http://php.net/manual/en/ref.sqlite.php
 * @since      5.0.0
 * @deprecated 5.4.0 This extension is no long included by default starting with PHP 5.4.0.
 * @see        http://php.net/manual/en/book.sqlite3.php
 */
final class SQLiteUnbuffered
{
    /**
     * @param $index_or_name
     * @param $decode_binary [optional]
     */
    public function column($index_or_name, $decode_binary) { }

    /**
     * @param $result_type   [optional]
     * @param $decode_binary [optional]
     */
    public function current($result_type, $decode_binary) { }

    /**
     * @param $result_type   [optional]
     * @param $decode_binary [optional]
     */
    public function fetch($result_type, $decode_binary) { }

    /**
     * @param $result_type   [optional]
     * @param $decode_binary [optional]
     */
    public function fetchAll($result_type, $decode_binary) { }

    /**
     * @param $class_name    [optional]
     * @param $ctor_params   [optional]
     * @param $decode_binary [optional]
     */
    public function fetchObject($class_name, $ctor_params, $decode_binary) { }

    /**
     * @param $decode_binary [optional]
     */
    public function fetchSingle($decode_binary) { }

    /**
     * @param $field_index
     */
    public function fieldName($field_index) { }

    public function next() { }

    public function numFields() { }

    public function valid() { }
}
