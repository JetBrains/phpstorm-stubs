<?php
/**
 * PHPStorm stub file for Microsoft SQL Server functions.
 *
 * @link http://php.net/manual/en/book.mssql.php
 */

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Adds a parameter to a stored procedure or a remote stored procedure
 *
 * @link http://php.net/manual/en/function.mssql-bind.php
 *
 * @param resource $stmt       <p>
 *                             Statement resource, obtained with mssql_init.
 *                             </p>
 * @param string   $param_name <p>
 *                             The parameter name, as a string.
 *                             </p>
 *                             <p>
 *                             You have to include the @ character, like in the
 *                             T-SQL syntax. See the explanation included in
 *                             mssql_execute.
 *                             </p>
 * @param mixed    $var        <p>
 *                             The PHP variable you'll bind the MSSQL parameter to. It is passed by
 *                             reference, to retrieve OUTPUT and RETVAL values after
 *                             the procedure execution.
 *                             </p>
 * @param int      $type       <p>
 *                             One of: SQLTEXT,
 *                             SQLVARCHAR, SQLCHAR,
 *                             SQLINT1, SQLINT2,
 *                             SQLINT4, SQLBIT,
 *                             SQLFLT4, SQLFLT8,
 *                             SQLFLTN.
 *                             </p>
 * @param bool     $is_output  [optional] <p>
 *                             Whether the value is an OUTPUT parameter or not. If it's an OUTPUT
 *                             parameter and you don't mention it, it will be treated as a normal
 *                             input parameter and no error will be thrown.
 *                             </p>
 * @param bool     $is_null    [optional] <p>
 *                             Whether the parameter is null or not. Passing the null value as
 *                             var will not do the job.
 *                             </p>
 * @param int      $maxlen     [optional] <p>
 *                             Used with char/varchar values. You have to indicate the length of the
 *                             data so if the parameter is a varchar(50), the type must be
 *                             SQLVARCHAR and this value 50.
 *                             </p>
 *
 * @return bool true on success or false on failure.
 */
function mssql_bind($stmt, $param_name, &$var, $type, $is_output = false, $is_null = false, $maxlen = -1) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Close MS SQL Server connection
 *
 * @link http://php.net/manual/en/function.mssql-close.php
 *
 * @param resource $link_identifier [optional] <p>
 *                                  A MS SQL link identifier, returned by
 *                                  mssql_connect.
 *                                  </p>
 *                                  <p>
 *                                  This function will not close persistent links generated by
 *                                  mssql_pconnect.
 *                                  </p>
 *
 * @return bool true on success or false on failure.
 */
function mssql_close($link_identifier = null) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Open MS SQL server connection
 *
 * @link http://php.net/manual/en/function.mssql-connect.php
 *
 * @param string $servername [optional] <p>
 *                           The MS SQL server. It can also include a port number, e.g.
 *                           hostname:port (Linux), or
 *                           hostname,port (Windows).
 *                           </p>
 * @param string $username   [optional] <p>
 *                           The username.
 *                           </p>
 * @param string $password   [optional] <p>
 *                           The password.
 *                           </p>
 * @param bool   $new_link   [optional] <p>
 *                           If a second call is made to mssql_connect with the
 *                           same arguments, no new link will be established, but instead, the link
 *                           identifier of the already opened link will be returned. This parameter
 *                           modifies this behavior and makes mssql_connect
 *                           always open a new link, even if mssql_connect was
 *                           called before with the same parameters.
 *                           </p>
 *
 * @return resource a MS SQL link identifier on success, or false on error.
 */
function mssql_connect($servername = null, $username = null, $password = null, $new_link = false) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Moves internal row pointer
 *
 * @link http://php.net/manual/en/function.mssql-data-seek.php
 *
 * @param resource $result_identifier <p>
 *                                    The result resource that is being evaluated.
 *                                    </p>
 * @param int      $row_number        <p>
 *                                    The desired row number of the new result pointer.
 *                                    </p>
 *
 * @return bool true on success or false on failure.
 */
function mssql_data_seek($result_identifier, $row_number) { }

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Executes a stored procedure on a MS SQL server database
 *
 * @link http://php.net/manual/en/function.mssql-execute.php
 *
 * @param resource $stmt         <p>
 *                               Statement handle obtained with mssql_init.
 *                               </p>
 * @param bool     $skip_results [optional] <p>
 *                               Whenever to skip the results or not.
 *                               </p>
 *
 * @return mixed
 */
function mssql_execute($stmt, $skip_results = false) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Fetch a result row as an associative array, a numeric array, or both
 *
 * @link http://php.net/manual/en/function.mssql-fetch-array.php
 *
 * @param resource $result      <p>
 *                              The result resource that is being evaluated. This result comes from a
 *                              call to mssql_query.
 *                              </p>
 * @param int      $result_type [optional] <p>
 *                              The type of array that is to be fetched. It's a constant and can take
 *                              the following values: MSSQL_ASSOC,
 *                              MSSQL_NUM, and
 *                              MSSQL_BOTH.
 *                              </p>
 *
 * @return array an array that corresponds to the fetched row, or false if there
 * are no more rows.
 */
function mssql_fetch_array($result, $result_type = MSSQL_BOTH) { }

/**
 * (PHP 4 &gt;= 4.2.0, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Returns an associative array of the current row in the result
 *
 * @link http://php.net/manual/en/function.mssql-fetch-assoc.php
 *
 * @param resource $result_id <p>
 *                            The result resource that is being evaluated. This result comes from a
 *                            call to mssql_query.
 *                            </p>
 *
 * @return array an associative array that corresponds to the fetched row, or
 * false if there are no more rows.
 */
function mssql_fetch_assoc($result_id) { }

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Returns the next batch of records
 *
 * @link http://php.net/manual/en/function.mssql-fetch-batch.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 *
 * @return int the batch number as an integer.
 */
function mssql_fetch_batch($result) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Get field information
 *
 * @link http://php.net/manual/en/function.mssql-fetch-field.php
 *
 * @param resource $result       <p>
 *                               The result resource that is being evaluated. This result comes from a
 *                               call to mssql_query.
 *                               </p>
 * @param int      $field_offset [optional] <p>
 *                               The numerical field offset. If the field offset is not specified, the
 *                               next field that was not yet retrieved by this function is retrieved. The
 *                               field_offset starts at 0.
 *                               </p>
 *
 * @return object an object containing field information.
 * </p>
 * <p>
 * The properties of the object are:
 */
function mssql_fetch_field($result, $field_offset = -1) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Fetch row as object
 *
 * @link http://php.net/manual/en/function.mssql-fetch-object.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 *
 * @return object an object with properties that correspond to the fetched row, or
 * false if there are no more rows.
 */
function mssql_fetch_object($result) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Get row as enumerated array
 *
 * @link http://php.net/manual/en/function.mssql-fetch-row.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 *
 * @return array an array that corresponds to the fetched row, or false if there
 * are no more rows.
 */
function mssql_fetch_row($result) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Get the length of a field
 *
 * @link http://php.net/manual/en/function.mssql-field-length.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 * @param int      $offset [optional] <p>
 *                         The field offset, starts at 0. If omitted, the current field is used.
 *                         </p>
 *
 * @return int The length of the specified field index on success or false on failure.
 */
function mssql_field_length($result, $offset = null) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Get the name of a field
 *
 * @link http://php.net/manual/en/function.mssql-field-name.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 * @param int      $offset [optional] <p>
 *                         The field offset, starts at 0. If omitted, the current field is used.
 *                         </p>
 *
 * @return string The name of the specified field index on success or false on failure.
 */
function mssql_field_name($result, $offset = -1) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Seeks to the specified field offset
 *
 * @link http://php.net/manual/en/function.mssql-field-seek.php
 *
 * @param resource $result       <p>
 *                               The result resource that is being evaluated. This result comes from a
 *                               call to mssql_query.
 *                               </p>
 * @param int      $field_offset <p>
 *                               The field offset, starts at 0.
 *                               </p>
 *
 * @return bool true on success or false on failure.
 */
function mssql_field_seek($result, $field_offset) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Gets the type of a field
 *
 * @link http://php.net/manual/en/function.mssql-field-type.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 * @param int      $offset [optional] <p>
 *                         The field offset, starts at 0. If omitted, the current field is used.
 *                         </p>
 *
 * @return string The type of the specified field index on success or false on failure.
 */
function mssql_field_type($result, $offset = -1) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Free result memory
 *
 * @link http://php.net/manual/en/function.mssql-free-result.php
 *
 * @param resource $result <p>
 *                         The result resource that is being freed. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 */
function mssql_free_result($result) { }

/**
 * (PHP 4 &gt;= 4.3.2, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Free statement memory
 *
 * @link http://php.net/manual/en/function.mssql-free-statement.php
 *
 * @param resource $stmt <p>
 *                       Statement resource, obtained with mssql_init.
 *                       </p>
 *
 * @return bool true on success or false on failure.
 */
function mssql_free_statement($stmt) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Returns the last message from the server
 *
 * @link http://php.net/manual/en/function.mssql-get-last-message.php
 * @return string last error message from server, or an empty string if
 * no error messages are returned from MSSQL.
 */
function mssql_get_last_message() { }

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Converts a 16 byte binary GUID to a string
 *
 * @link http://php.net/manual/en/function.mssql-guid-string.php
 *
 * @param string $binary       <p>
 *                             A 16 byte binary GUID.
 *                             </p>
 * @param bool   $short_format [optional] <p>
 *                             Whenever to use short format.
 *                             </p>
 *
 * @return string the converted string on success.
 */
function mssql_guid_string($binary, $short_format = null) { }

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Initializes a stored procedure or a remote stored procedure
 *
 * @link http://php.net/manual/en/function.mssql-init.php
 *
 * @param string   $sp_name         <p>
 *                                  Stored procedure name, like ownew.sp_name or
 *                                  otherdb.owner.sp_name.
 *                                  </p>
 * @param resource $link_identifier [optional] <p>
 *                                  A MS SQL link identifier, returned by
 *                                  mssql_connect.
 *                                  </p>
 *
 * @return resource a resource identifier "statement", used in subsequent calls to
 * mssql_bind and mssql_execute,
 * or false on errors.
 */
function mssql_init($sp_name, $link_identifier = null) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Sets the minimum error severity
 *
 * @link http://php.net/manual/en/function.mssql-min-error-severity.php
 *
 * @param int $severity <p>
 *                      The new error severity.
 *                      </p>
 *
 * @return void
 */
function mssql_min_error_severity($severity) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Sets the minimum message severity
 *
 * @link http://php.net/manual/en/function.mssql-min-message-severity.php
 *
 * @param int $severity <p>
 *                      The new message severity.
 *                      </p>
 *
 * @return void
 */
function mssql_min_message_severity($severity) { }

/**
 * (PHP 4 &gt;= 4.0.5, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Move the internal result pointer to the next result
 *
 * @link http://php.net/manual/en/function.mssql-next-result.php
 *
 * @param resource $result_id <p>
 *                            The result resource that is being evaluated. This result comes from a
 *                            call to mssql_query.
 *                            </p>
 *
 * @return bool true if an additional result set was available or false
 * otherwise.
 */
function mssql_next_result($result_id) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Gets the number of fields in result
 *
 * @link http://php.net/manual/en/function.mssql-num-fields.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 *
 * @return int the number of fields, as an integer.
 */
function mssql_num_fields($result) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Gets the number of rows in result
 *
 * @link http://php.net/manual/en/function.mssql-num-rows.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 *
 * @return int the number of rows, as an integer.
 */
function mssql_num_rows($result) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Open persistent MS SQL connection
 *
 * @link http://php.net/manual/en/function.mssql-pconnect.php
 *
 * @param string $servername [optional] <p>
 *                           The MS SQL server. It can also include a port number. e.g.
 *                           hostname:port.
 *                           </p>
 * @param string $username   [optional] <p>
 *                           The username.
 *                           </p>
 * @param string $password   [optional] <p>
 *                           The password.
 *                           </p>
 * @param bool   $new_link   [optional] <p>
 *                           If a second call is made to mssql_pconnect with
 *                           the same arguments, no new link will be established, but instead, the
 *                           link identifier of the already opened link will be returned. This
 *                           parameter modifies this behavior and makes
 *                           mssql_pconnect always open a new link, even if
 *                           mssql_pconnect was called before with the same
 *                           parameters.
 *                           </p>
 *
 * @return resource a positive MS SQL persistent link identifier on success, or
 * false on error.
 */
function mssql_pconnect($servername = null, $username = null, $password = null, $new_link = false) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Send MS SQL query
 *
 * @link http://php.net/manual/en/function.mssql-query.php
 *
 * @param string   $query           <p>
 *                                  An SQL query.
 *                                  </p>
 * @param resource $link_identifier [optional] <p>
 *                                  A MS SQL link identifier, returned by
 *                                  mssql_connect or
 *                                  mssql_pconnect.
 *                                  </p>
 *                                  <p>
 *                                  If the link identifier isn't specified, the last opened link is
 *                                  assumed. If no link is open, the function tries to establish a link
 *                                  as if mssql_connect was called, and use it.
 *                                  </p>
 * @param int      $batch_size      [optional] <p>
 *                                  The number of records to batch in the buffer.
 *                                  </p>
 *
 * @return mixed a MS SQL result resource on success, true if no rows were
 * returned, or false on error.
 */
function mssql_query($query, $link_identifier = null, $batch_size = 0) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Get result data
 *
 * @link http://php.net/manual/en/function.mssql-result.php
 *
 * @param resource $result <p>
 *                         The result resource that is being evaluated. This result comes from a
 *                         call to mssql_query.
 *                         </p>
 * @param int      $row    <p>
 *                         The row number.
 *                         </p>
 * @param mixed    $field  <p>
 *                         Can be the field's offset, the field's name or the field's table dot
 *                         field's name (tablename.fieldname). If the column name has been
 *                         aliased ('select foo as bar from...'), it uses the alias instead of
 *                         the column name.
 *                         </p>
 *                         <p>
 *                         Specifying a numeric offset for the field
 *                         argument is much quicker than specifying a
 *                         fieldname or
 *                         tablename.fieldname argument.
 *                         </p>
 *
 * @return string the contents of the specified cell.
 */
function mssql_result($result, $row, $field) { }

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Returns the number of records affected by the query
 *
 * @link http://php.net/manual/en/function.mssql-rows-affected.php
 *
 * @param resource $link_identifier <p>
 *                                  A MS SQL link identifier, returned by
 *                                  mssql_connect or
 *                                  mssql_pconnect.
 *                                  </p>
 *
 * @return int the number of records affected by last operation.
 */
function mssql_rows_affected($link_identifier) { }

/**
 * (PHP 4, PHP 5, PECL odbtp &gt;= 1.1.1)<br/>
 * Select MS SQL database
 *
 * @link http://php.net/manual/en/function.mssql-select-db.php
 *
 * @param string   $database_name   <p>
 *                                  The database name.
 *                                  </p>
 *                                  <p>
 *                                  To escape the name of a database that contains spaces, hyphens ("-"),
 *                                  or any other exceptional characters, the database name must be
 *                                  enclosed in brackets, as is shown in the example, below. This
 *                                  technique must also be applied when selecting a database name that is
 *                                  also a reserved word (such as primary).
 *                                  </p>
 * @param resource $link_identifier [optional] <p>
 *                                  A MS SQL link identifier, returned by
 *                                  mssql_connect or
 *                                  mssql_pconnect.
 *                                  </p>
 *                                  <p>
 *                                  If no link identifier is specified, the last opened link is assumed.
 *                                  If no link is open, the function will try to establish a link as if
 *                                  mssql_connect was called, and use it.
 *                                  </p>
 *
 * @return bool true on success or false on failure.
 */
function mssql_select_db($database_name, $link_identifier = null) { }
