<?php
/**
 * Stubs for sasql extension
 * Taken from official SAP documenation
 * @link     http://dcx.sap.com/index.html#sa160/en/dbprogramming/php-api.html
 * @link     http://dcx.sap.com/sa160/en/pdf/dbprogramming16.pdf
 * @author   Michael Moravec
 */

const SASQL_NUM = 1;
const SASQL_ASSOC = 2;
const SASQL_BOTH = 3;

const SASQL_D_INPUT = 1;
const SASQL_D_OUTPUT = 2;
const SASQL_INPUT_OUTPUT = 3;

const SASQL_USE_RESULT = 0;
const SASQL_STORE_RESULT = 1;

/**
 * Returns the number of rows affected by the last SQL statement. This function is typically used for
 * INSERT, UPDATE, or DELETE statements. For SELECT statements, use the sasql_num_rows function.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return int The number of rows affected
 */
function sasql_affected_rows($conn) {}

/**
 * Ends a transaction on the SQL Anywhere database and makes any changes made during the transaction
 * permanent. Useful only when the auto_commit option is Off.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_commit($conn) {}

/**
 * Closes a previously opened database connection.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_close($conn) {}

/**
 * Establishes a connection to a SQL Anywhere database.
 *
 * @param string $conn_str A connection string as recognized by SQL Anywhere.
 *
 * @return resource A positive SQL Anywhere connection resource on success, or an error and 0 on failure.
 */
function sasql_connect($conn_str) {}

/**
 * Positions the cursor on row row_num on the $result that was opened using sasql_query.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 * @param int $row_num An integer that represents the new position of the cursor within the result resource. For
 *                     example, specify 0 to move the cursor to the first row of the result set or 5 to move it
 *                     to the sixth row. Negative numbers represent rows relative to the end of the result set.
 *                     For example, -1 moves the cursor to the last row in the result set and -2 moves it to
 *                     the second-last row.
 *
 * @return bool TRUE on success or FALSE on error.
 */
function sasql_data_seek($result, $row_num) {}

/**
 * Closes a connection that has been opened with sasql_connect or sasql_pconnect.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return bool TRUE on success or FALSE on error.
 */
function sasql_disconnect($conn) {}

/**
 * Returns the error text of the most recently executed SQL Anywhere PHP function. Error messages are
 * stored per connection. If no $conn is specified, then sasql_error returns the last error message where no
 * connection was available. For example, if you call sasql_connect and the connection fails, then call
 * sasql_error with no parameter for $conn to get the error message. To obtain the corresponding SQL
 * Anywhere error code value, use the sasql_errorcode function.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return int A string describing the error.
 */
function sasql_error($conn) {}

/**
 * Returns the error code of the most-recently executed SQL Anywhere PHP function. Error codes are stored
 * per connection. If no $conn is specified, then sasql_errorcode returns the last error code where no
 * connection was available. For example, if you are calling sasql_connect and the connection fails, then call
 * sasql_errorcode with no parameter for the $conn to get the error code. To get the corresponding error
 * message use the sasql_error function.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return int An integer representing a SQL Anywhere error code. An error code of 0 means success.
 *             A positive error code indicates success with warnings. A negative error code indicates failure.
 */
function sasql_errorcode($conn) {}

/**
 * Escapes all special characters in the supplied string. The special characters that are escaped are \r, \n, ',
 * ", ;, \, and the NULL character. This function is an alias of sasql_real_escape_string.
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $str The string to be escaped.
 *
 * @return string The escaped string.
 */
function sasql_escape_string($conn, $str) {}

/**
 * @param resource $result The result resource returned by the sasql_query function.
 * @param int $result_type This optional parameter is a constant indicating what type of array should be produced
 *                         from the current row data. The possible values for this parameter are the constants
 *                         SASQL_ASSOC, SASQL_NUM, or SASQL_BOTH. It defaults to SASQL_BOTH.
 *                         By using the SASQL_ASSOC constant this function will behave identically to
 *                         the sasql_fetch_assoc function, while SASQL_NUM will behave identically to
 *                         the sasql_fetch_row function. The final option SASQL_BOTH will create a single array
 *                         with the attributes of both.
 *
 * @return array|false An array that represents a row from the result set, or FALSE when no rows are available.
 */
function sasql_fetch_array($result, $result_type = SASQL_BOTH) {}

/**
 * Fetches one row from the result set as an associative array.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 *
 * @return array|false An associative array of strings representing the fetched row in the result set,
 *                     where each key in the array represents the name of one of the result set's columns
 *                     or FALSE if there are no more rows in resultset.
 */
function sasql_fetch_assoc($result) {}

/**
 * Returns an object that contains information about a specific column.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 * @param int $field_offset An integer representing the column/field on which you want to retrieve information.
 *                          Columns are zero based; to get the first column, specify the value 0. If this parameter
 *                          is omitted, then the next field object is returned.
 *
 * @return object An object that has the following properties:
 *                id: contains the field's number.
 *                name: contains the field's name.
 *                numeric: indicates whether the field is a numeric value.
 *                length: returns the field's native storage size.
 *                type: returns the field's type.
 *                native_type: returns the field's native type. These are values like DT_FIXCHAR, DT_DECIMAL
 *                             or DT_DATE. See “Embedded SQL data types” on page 465.
 *                precision: returns the field's numeric precision. This property is only set for fields
 *                           with native_type equal to DT_DECIMAL.
 *                scale: returns the field's numeric scale. This property is only set for fields with
 *                       native_type equal to DT_DECIMAL.
 */
function sasql_fetch_field($result, $field_offset) {}

/**
 * Fetches one row from the result set as an object.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 *
 * @return object|false An object representing the fetched row in the result set where each property name matches
 *                      one of the result set column names, or FALSE if there are no more rows in result set.
 */
function sasql_fetch_object($result) {}

/**
 * Fetches one row from the result set. This row is returned as an array that can be indexed by the column indexes only.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 *
 * @return array|false An array that represents a row from the result set, or FALSE when no rows are available.
 */
function sasql_fetch_row($result) {}

/**
 * Returns the number of columns (fields) the last result contains.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return int|false A positive number of columns, or FALSE if $conn is not valid.
 */
function sasql_field_count($conn) {}

/**
 * Sets the field cursor to the given offset. The next call to sasql_fetch_field will retrieve the field definition
 * of the column associated with that offset.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 * @param int $field_offset An integer representing the column/field on which you want to retrieve information.
 *                          Columns are zero based; to get the first column, specify the value 0. If this parameter
 *                          is omitted, then the next field object is returned.
 *
 * @return bool TRUE on success or FALSE on error.
 */
function sasql_field_seek($result, $field_offset) {}

/**
 * Frees database resources associated with a result resource returned from sasql_query.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 *
 * @return bool TRUE on success or FALSE on error.
 */
function sasql_free_result($result) {}

/**
 * Returns the version information of the client.
 *
 * @return string A string that represents the SQL Anywhere client software version. The returned string is of the form
 *                X.Y.Z.W where X is the major version number, Y is the minor version number, Z is the patch number,
 *                and W is the build number (for example, 10.0.1.3616).
 */
function sasql_get_client_info() {}

/**
 * Returns the last value inserted into an IDENTITY column or a DEFAULT AUTOINCREMENT column,
 * or zero if the most recent insert was into a table that did not contain an IDENTITY or DEFAULT
 * AUTOINCREMENT column.
 *
 * The sasql_insert_id function is provided for compatibility with MySQL databases.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return int The ID generated for an AUTOINCREMENT column by a previous INSERT statement or zero if last insert
 *             did not affect an AUTOINCREMENT column. The function can return FALSE if the $conn is not valid.
 */
function sasql_insert_id($conn) {}

/**
 * Writes a message to the server messages window.
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $message A message to be written to the server messages window.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_message($conn, $message) {}

/**
 * Prepares and executes one or more SQL queries specified by $sql_str using the supplied connection
 * resource. Each query is separated from the other using semicolons.
 *
 * The first query result can be retrieved or stored using sasql_use_result or sasql_store_result.
 * sasql_field_count can be used to check if the query returns a result set or not.
 *
 * All subsequent query results can be processed using sasql_next_result and sasql_use_result/
 * sasql_store_result.
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $sql_str One or more SQL statements separated by semicolons.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_multi_query($conn, $sql_str) {}

/**
 * Prepares the next result set from the last query that executed on $conn.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return bool FALSE if there is no other result set to be retrieved. TRUE if there is another result to be retrieved.
 *              Call sasql_use_result or sasql_store_result to retrieve the next result set.
 */
function sasql_next_result($conn) {}

/**
 * Returns the number of fields that a row in the $result contains.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 *
 * @return int Returns the number of fields in the specified result set.
 */
function sasql_num_fields($result) {}

/**
 * Returns the number of rows that the $result contains.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 *
 * @return int A positive number if the number of rows is exact, or a negative number if it is an estimate. To get the
 *             exact number of rows, the database option row_counts must be set permanently on the database, or
 *             temporarily on the connection. See “sasql_set_option” on page 673.
 */
function sasql_num_rows($result) {}

/**
 * Establishes a persistent connection to a SQL Anywhere database. Because of the way Apache creates
 * child processes, you may observe a performance gain when using sasql_pconnect instead of
 * sasql_connect. Persistent connections may provide improved performance in a similar fashion to
 * connection pooling. If your database server has a limited number of connections (for example, the
 * personal database server is limited to 10 concurrent connections), caution should be exercised when using
 * persistent connections. Persistent connections could be attached to each of the child processes, and if you
 * have more child processes in Apache than there are available connections, you will receive connection errors.
 *
 * @param string $con_str A connection string as recognized by SQL Anywhere.
 *
 * @return resource A positive SQL Anywhere persistent connection resource on success, or an error and 0 on failure.
 */
function sasql_pconnect($con_str) {}

/**
 * Prepares the supplied SQL string.
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $sql_str The SQL statement to be prepared. The string can include parameter markers by embedding
 *                        question marks at the appropriate positions.
 *
 * @return resource|false A statement object or FALSE on failure.
 */
function sasql_prepare($conn, $sql_str) {}

/**
 * Prepares and executes the SQL query $sql_str on the connection identified by $conn that has already been
 * opened using sasql_connect or sasql_pconnect.
 *
 * The sasql_query function is equivalent to calling two functions, sasql_real_query and one of
 * sasql_store_result or sasql_use_result.
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $sql_str A SQL statement supported by SQL Anywhere.
 * @param int $result_mode Either SASQL_USE_RESULT, or SASQL_STORE_RESULT (the default).
 *
 * @return resource|bool FALSE on failure; TRUE on success for INSERT, UPDATE, DELETE, CREATE; sasql_result for SELECT.
 */
function sasql_query($conn, $sql_str, $result_mode = SASQL_STORE_RESULT) {}

/**
 * Escapes all special characters in the supplied string. The special characters that are escaped are \r, \n, ',
 * ", ;, \, and the NULL character.
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $str The string to be escaped.
 *
 * @return string|false The escaped string or FALSE on error.
 */
function sasql_real_escape_string($conn, $str) {}

/**
 * Executes a query against the database using the supplied connection resource. The query result can be
 * retrieved or stored using sasql_store_result or sasql_use_result. The sasql_field_count function can be
 * used to check if the query returns a result set or not.
 *
 * The sasql_query function is equivalent to calling this function and one of sasql_store_result or
 * sasql_use_result.
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $sql_str A SQL statement supported by SQL Anywhere.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_real_query($conn, $sql_str) {}

/**
 * Fetches all results of the $result and generates an HTML output table with an optional formatting string.
 *
 * @param resource $result The result resource returned by the sasql_query function.
 * @param string|null $html_table_format_string A format string that applies to HTML tables. For example,
 *                                              "Border=1; Cellpadding=5". The special value none does not create
 *                                              an HTML table. This is useful to customize your column names or scripts.
 *                                              To avoid specifying an explicit value for this parameter, use NULL for
 *                                              the parameter value.
 * @param string|null $html_table_header_format_string A format string that applies to column headings for HTML tables.
 *                                                     For example, "bgcolor=#FF9533". The special value none does not
 *                                                     create an HTML table. This is useful to customize your column
 *                                                     names or scripts. To avoid specifying an explicit value for this
 *                                                     parameter, use NULL for the parameter value.
 * @param string|null $html_table_row_format_string A format string that applies to rows within HTML tables. For
 *                                                  example, "onclick='alert('this')'". If you would like different
 *                                                  formats that alternate, use the special token ><. The left side of
 *                                                  the token indicates which format to use on odd rows and the right
 *                                                  side of the token is used to format even rows. If you do not place
 *                                                  this token in your format string, all rows have the same format. If
 *                                                  you do not want to specify an explicit value for this parameter,
 *                                                  use NULL for the parameter value.
 * @param string|null $html_table_cell_format_string A format string that applies to cells within HTML table rows. For
 *                                                   example, "onclick='alert('this')'". If you do not want to specify
 *                                                   an explicit value for this parameter, use NULL for the parameter
 *                                                   value.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_result_all(
    $result,
    $html_table_format_string = null,
    $html_table_header_format_string = null,
    $html_table_row_format_string = null,
    $html_table_cell_format_string = null
) {}

/**
 * Ends a transaction on the SQL Anywhere database and discards any changes made during the transaction.
 * This function is only useful when the auto_commit option is Off.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_rollback($conn) {}

/**
 * Sets the value of the specified option on the specified connection. You can set the value for the following options:
 * |----------------|------------------------------------------------------------------------------------|---------|
 * |      Name      |                                 Description                                        | Default |
 * |----------------|------------------------------------------------------------------------------------|---------|
 * | auto_commit    | When this option is set to on, the database server commits after executing         | on      |
 * |                | each statement.                                                                    |         |
 * |----------------|------------------------------------------------------------------------------------|---------|
 * | row_counts     | When this option is set to FALSE, the sasql_num_rows function returns an estimate  | FALSE   |
 * |                | of the number of rows affected. To obtain an exact count, set this option to TRUE. |         |
 * |----------------|------------------------------------------------------------------------------------|---------|
 * | verbose_errors | When this option is set to TRUE, the PHP driver returns verbose errors. When       |         |
 * |                | this option is set to FALSE, you must call the sasql_error or sasql_errorcode      | TRUE    |
 * |                | functions to get further error information.                                        |         |
 * |----------------|------------------------------------------------------------------------------------|---------|
 *
 * You can change the default value for an option by including the following line in the php.ini file. In this
 * example, the default value is set for the auto_commit option:
 *
 *   sqlanywhere.auto_commit=0
 *
 * @param resource $conn The connection resource returned by a connect function.
 * @param string $option The name of the option you want to set.
 * @param mixed $value The new option value.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_set_option($conn, $option, $value) {}

/**
 * Returns the number of rows affected by executing the statement.
 *
 * @param resource $stmt A statement resource that was executed by sasql_stmt_execute.
 *
 * @return int The number of rows affected or FALSE on failure.
 */
function sasql_stmt_affected_rows($stmt) {}

/**
 * Binds PHP variables to statement parameters.
 *
 * @param resource $stmt A prepared statement resource that was returned by the sasql_prepare function.
 * @param string $types A string that contains one or more characters specifying the types of the corresponding bind.
 *                      This can be any of: s for string, i for integer, d for double, b for blobs. The length of
 *                      the $types string must match the number of parameters that follow the $types parameter
 *                      ($var_1, $var_2, ...). The number of characters should also match the number of parameter
 *                      markers (question marks) in the prepared statement.
 * @param mixed ...$vars The variable references.
 *
 * @return bool TRUE if binding the variables was successful or FALSE otherwise.
 */
function sasql_stmt_bind_param($stmt, $types, &...$vars) {}

/**
 * Binds a PHP variable to a statement parameter.
 *
 * @param resource $stmt A prepared statement resource that was returned by the sasql_prepare function.
 * @param int $param_number The parameter number. This should be a number between 0 and
 *                          (sasql_stmt_param_count($stmt) - 1).
 * @param mixed $var A PHP variable. Only references to PHP variables are allowed.
 * @param string $type Type of the variable. This can be one of: s for string, i for integer, d for double, b for blobs.
 * @param bool|null $is_null Whether the value of the variable is NULL or not.
 * @param int|null $direction Can be SASQL_D_INPUT, SASQL_D_OUTPUT, or SASQL_INPUT_OUTPUT.
 *
 * @return TRUE if binding the variable was successful or FALSE otherwise.
 */
function sasql_stmt_bind_param_ex($stmt, $param_number, &$var, $type, $is_null = null, $direction = null) {}

/**
 * Binds one or more PHP variables to result columns of a statement that was executed, and returns a result set.
 *
 * @param resource $stmt A statement resource that was executed by sasql_stmt_execute.
 * @param mixed ...$vars References to PHP variables that will be bound to result set columns returned by the
 *                       sasql_stmt_fetch.
 *
 * @return TRUE on success or FALSE on failure.
 */
function sasql_stmt_bind_result($stmt, &...$vars) {}

/**
 * Closes the supplied statement resource and frees any resources associated with it. This function will also
 * free any result objects that were returned by the sasql_stmt_result_metadata.
 *
 * @param resource $stmt A prepared statement resource that was returned by the sasql_prepare function.
 *
 * @return TRUE on success or FALSE on failure.
 */
function sasql_stmt_close($stmt) {}

/**
 * This function seeks to the specified offset in the result set.
 *
 * @param resource $stmt A statement resource.
 * @param int $offset The offset in the result set. This is a number between 0 and (sasql_stmt_num_rows($stmt) - 1).
 *
 * @return TRUE on success or FALSE on failure.
 */
function sasql_stmt_data_seek($stmt, $offset) {}

/**
 * Returns the error code for the most recently executed statement function using the specified statement resource.
 *
 * @param resource $stmt A prepared statement resource that was returned by the sasql_prepare function.
 *
 * @return int An integer error code. For a list of error codes.
 */
function sasql_stmt_errno($stmt) {}

/**
 * Returns the error text for the most recently executed statement function using the specified statement resource.
 *
 * @param resource $stmt A prepared statement resource that was returned by the sasql_prepare function.
 *
 * @return string A string describing the error.
 */
function sasql_stmt_error($stmt) {}

/**
 * Executes the prepared statement. The sasql_stmt_result_metadata can be used to check whether the
 * statement returns a result set.
 *
 * @param resource $stmt A prepared statement resource that was returned by the sasql_prepare function. Variables should
 *                       be bound before calling execute.
 *
 * @return bool TRUE for success or FALSE on failure.
 */
function sasql_stmt_execute($stmt) {}

/**
 * This function fetches one row out of the result for the statement and places the columns in the variables
 * that were bound using sasql_stmt_bind_result.
 *
 * @param resource $stmt A statement resource.
 *
 * @return bool TRUE for success or FALSE on failure.
 */
function sasql_stmt_fetch($stmt) {}

/**
 * This function returns the number of columns in the result set of the statement.
 *
 * @param resource $stmt A statement resource.
 *
 * @return  int The number of columns in the result of the statement. If the statement does not return a result,
 *              it returns 0.
 */
function sasql_stmt_field_count($stmt) {}

/**
 * This function frees cached result set of the statement.
 *
 * @param resource $stmt A statement resource that was executed using sasql_stmt_execute.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_stmt_free_result($stmt) {}

/**
 * Returns the last value inserted into an IDENTITY column or a DEFAULT AUTOINCREMENT column, or zero if the most
 * recent insert was into a table that did not contain an IDENTITY or DEFAULT AUTOINCREMENT column.
 *
 * @param resource $stmt A statement resource that was executed by sasql_stmt_execute.
 *
 * @return int The ID generated for an IDENTITY column or a DEFAULT AUTOINCREMENT column by a previous
 *             INSERT statement, or zero if the last insert did not affect an IDENTITY or DEFAULT
 *             AUTOINCREMENT column. The function can return FALSE (0) if $stmt is not valid.
 */
function sasql_stmt_insert_id($stmt) {}

/**
 * This function advances to the next result from the statement. If there is another result set, the currently
 * cashed results are discarded and the associated result set object deleted (as returned by
 * sasql_stmt_result_metadata).
 *
 * @param resource $stmt A statement resource.
 *
 * @return TRUE on success or FALSE failure.
 */
function sasql_stmt_next_result($stmt) {}

/**
 * Returns the number of rows in the result set. The actual number of rows in the result set can only be
 * determined after the sasql_stmt_store_result function is called to buffer the entire result set. If the
 * sasql_stmt_store_result function has not been called, 0 is returned.
 *
 * @param resource $stmt A statement resource that was executed by sasql_stmt_execute and for which
 *                       sasql_stmt_store_result was called.
 *
 * @return int The number of rows available in the result or 0 on failure.
 */
function sasql_stmt_num_rows($stmt) {}

/**
 * Returns the number of parameters in the supplied prepared statement resource.
 *
 * @param resource $stmt A statement resource returned by the sasql_prepare function.
 *
 * @return int|false The number of parameters or FALSE on error.
 */
function sasql_stmt_param_count($stmt) {}

/**
 * This function resets the $stmt object to the state just after the describe. Any variables that were bound are
 * unbound and any data sent using sasql_stmt_send_long_data are dropped.
 *
 * @param resource $stmt A statement resource.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_stmt_reset($stmt) {}

/**
 * Returns a result set object for the supplied statement.
 *
 * @param resource $stmt A statement resource that was prepared and executed.
 *
 * @return resource|false sasql_result object or FALSE if the statement does not return any results.
 */
function sasql_stmt_result_metadata($stmt) {}

/**
 * Allows the user to send parameter data in chunks. The user must first call sasql_stmt_bind_param or
 * sasql_stmt_bind_param_ex before attempting to send any data. The bind parameter must be of type string
 * or blob. Repeatedly calling this function appends on to what was previously sent.
 *
 * @param resource $stmt A statement resource that was prepared using sasql_prepare.
 * @param int $param_number The parameter number. This must be a number between 0 and
 *                          (sasql_stmt_param_count($stmt) - 1).
 * @param string $data The data to be sent.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_stmt_send_long_data($stmt, $param_number, $data) {}

/**
 * This function allows the client to cache the whole result set of the statement. You can use the function
 * sasql_stmt_free_result to free the cached result.
 *
 * @param resource $stmt A statement resource that was executed using sasql_stmt_execute.
 *
 * @return bool TRUE on success or FALSE on failure.
 */
function sasql_stmt_store_result($stmt) {}

/**
 * Transfers the result set from the last query on the database connection $conn to be used with
 * the sql_data_seek function.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return resource|false FALSE if the query does not return a result object, or a result set object, that contains
 *                        all the rows of the result. The result is cached at the client.
 */
function sasql_store_result($conn) {}

/**
 * Returns the most recent SQLSTATE string. SQLSTATE indicates whether the most recently executed
 * SQL statement resulted in a success, error, or warning condition. SQLSTATE codes consists of five
 * characters with "00000" representing no error. The values are defined by the ISO/ANSI SQL standard.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return string Returns a string of five characters containing the current SQLSTATE code.
 *                The result "00000" means no error.
 */
function sasql_sqlstate($conn) {}

/**
 * Initiates a result set retrieval for the last query that executed on the connection.
 *
 * @param resource $conn The connection resource returned by a connect function.
 *
 * @return resource|false FALSE if the query does not return a result object or a result set object.
 *                        The result is not cached on the client.
 */
function sasql_use_result($conn) {}
