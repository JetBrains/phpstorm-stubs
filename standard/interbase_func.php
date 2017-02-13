<?php
/**
 * PHPStorm stub file for Firebird/InterBase functions.
 *
 * __NOTE:__
 * If you are using FireBird just replace the 'ibase_' part with 'fbird_' instead.
 *
 * @link http://php.net/manual/en/book.ibase.php
 */

/**
 * Add a user to a security database (only for IB6 or later)
 *
 * @link  http://php.net/manual/en/function.ibase-add-user.php
 *
 * @param resource $service_handle
 * @param string   $user_name
 * @param string   $password
 * @param string   $first_name  [optional]
 * @param string   $middle_name [optional]
 * @param string   $last_name   [optional]
 *
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function ibase_add_user(
    $service_handle,
    $user_name,
    $password,
    $first_name = null,
    $middle_name = null,
    $last_name = null
) {
}

/**
 * Return the number of rows that were affected by the previous query
 *
 * @link  http://php.net/manual/en/function.ibase-affected-rows.php
 *
 * @param resource $link_identifier [optional] <p>
 *                                  A transaction context. If link_identifier is a
 *                                  connection resource, its default transaction is used.
 *                                  </p>
 *
 * @return int the number of rows as an integer.
 * @since 5.0
 */
function ibase_affected_rows($link_identifier = null) { }

/**
 * Initiates a backup task in the service manager and returns immediately
 *
 * @link  http://php.net/manual/en/function.ibase-backup.php
 *
 * @param resource $service_handle
 * @param string   $source_db
 * @param string   $dest_file
 * @param int      $options [optional]
 * @param bool     $verbose [optional]
 *
 * @return mixed
 * @since 5.0
 */
function ibase_backup($service_handle, $source_db, $dest_file, $options = null, $verbose = null) { }

/**
 * Add data into a newly created blob
 *
 * @link  http://php.net/manual/en/function.ibase-blob-add.php
 *
 * @param resource $blob_handle <p>
 *                              A blob handle opened with ibase_blob_create.
 *                              </p>
 * @param string   $data        <p>
 *                              The data to be added.
 *                              </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_add($blob_handle, $data) { }

/**
 * Cancel creating blob
 *
 * @link  http://php.net/manual/en/function.ibase-blob-cancel.php
 *
 * @param resource $blob_handle <p>
 *                              A BLOB handle opened with ibase_blob_create.
 *                              </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_cancel($blob_handle) { }

/**
 * Close blob
 *
 * @link  http://php.net/manual/en/function.ibase-blob-close.php
 *
 * @param resource $blob_handle <p>
 *                              A BLOB handle opened with ibase_blob_create or
 *                              ibase_blob_open.
 *                              </p>
 *
 * @return mixed If the BLOB was being read, this function returns true on success, if
 * the BLOB was being written to, this function returns a string containing
 * the BLOB id that has been assigned to it by the database. On failure, this
 * function returns false.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_close($blob_handle) { }

/**
 * Create a new blob for adding data
 *
 * @link  http://php.net/manual/en/function.ibase-blob-create.php
 *
 * @param resource $link_identifier [optional] <p>
 *                                  An InterBase link identifier. If omitted, the last opened link is
 *                                  assumed.
 *                                  </p>
 *
 * @return resource a BLOB handle for later use with
 * ibase_blob_add or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_create($link_identifier = null) { }

/**
 * Output blob contents to browser
 *
 * @link  http://php.net/manual/en/function.ibase-blob-echo.php
 *
 * @param string $blob_id <p>
 *                        </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_echo($blob_id) { }

/**
 * Get len bytes data from open blob
 *
 * @link  http://php.net/manual/en/function.ibase-blob-get.php
 *
 * @param resource $blob_handle <p>
 *                              A BLOB handle opened with ibase_blob_open.
 *                              </p>
 * @param int      $len         <p>
 *                              Size of returned data.
 *                              </p>
 *
 * @return string at most len bytes from the BLOB, or false
 * on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_get($blob_handle, $len) { }

/**
 * Create blob, copy file in it, and close it
 *
 * @link  http://php.net/manual/en/function.ibase-blob-import.php
 *
 * @param resource $link_identifier <p>
 *                                  An InterBase link identifier. If omitted, the last opened link is
 *                                  assumed.
 *                                  </p>
 * @param resource $file_handle     <p>
 *                                  The file handle is a handle returned by fopen.
 *                                  </p>
 *
 * @return string the BLOB id on success, or false on error.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_import($link_identifier, $file_handle) { }

/**
 * Return blob length and other useful info
 *
 * @link  http://php.net/manual/en/function.ibase-blob-info.php
 *
 * @param resource $link_identifier <p>
 *                                  An InterBase link identifier. If omitted, the last opened link is
 *                                  assumed.
 *                                  </p>
 * @param string   $blob_id         <p>
 *                                  A BLOB id.
 *                                  </p>
 *
 * @return array an array containing information about a BLOB. The information returned
 * consists of the length of the BLOB, the number of segments it contains, the size
 * of the largest segment, and whether it is a stream BLOB or a segmented BLOB.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_info($link_identifier, $blob_id) { }

/**
 * Open blob for retrieving data parts
 *
 * @link  http://php.net/manual/en/function.ibase-blob-open.php
 *
 * @param resource $link_identifier <p>
 *                                  An InterBase link identifier. If omitted, the last opened link is
 *                                  assumed.
 *                                  </p>
 * @param string   $blob_id         <p>
 *                                  A BLOB id.
 *                                  </p>
 *
 * @return resource a BLOB handle for later use with
 * ibase_blob_get or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_blob_open($link_identifier, $blob_id) { }

/**
 * Close a connection to an InterBase database
 *
 * @link  http://php.net/manual/en/function.ibase-close.php
 *
 * @param resource $connection_id [optional] <p>
 *                                An InterBase link identifier returned from
 *                                ibase_connect. If omitted, the last opened link
 *                                is assumed.
 *                                </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_close($connection_id = null) { }

/**
 * Commit a transaction
 *
 * @link  http://php.net/manual/en/function.ibase-commit.php
 *
 * @param resource $link_or_trans_identifier [optional] <p>
 *                                           If called without an argument, this function commits the default
 *                                           transaction of the default link. If the argument is a connection
 *                                           identifier, the default transaction of the corresponding connection
 *                                           will be committed. If the argument is a transaction identifier, the
 *                                           corresponding transaction will be committed.
 *                                           </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_commit($link_or_trans_identifier = null) { }

/**
 * Commit a transaction without closing it
 *
 * @link  http://php.net/manual/en/function.ibase-commit-ret.php
 *
 * @param resource $link_or_trans_identifier [optional] <p>
 *                                           If called without an argument, this function commits the default
 *                                           transaction of the default link. If the argument is a connection
 *                                           identifier, the default transaction of the corresponding connection
 *                                           will be committed. If the argument is a transaction identifier, the
 *                                           corresponding transaction will be committed. The transaction context
 *                                           will be retained, so statements executed from within this transaction
 *                                           will not be invalidated.
 *                                           </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function ibase_commit_ret($link_or_trans_identifier = null) { }

/**
 * Open a connection to an InterBase database
 *
 * @link  http://php.net/manual/en/function.ibase-connect.php
 *
 * @param string $database [optional] <p>
 *                         The database argument has to be a valid path to
 *                         database file on the server it resides on. If the server is not local,
 *                         it must be prefixed with either 'hostname:' (TCP/IP), '//hostname/'
 *                         (NetBEUI) or 'hostname@' (IPX/SPX), depending on the connection
 *                         protocol used.
 *                         </p>
 * @param string $username [optional] <p>
 *                         The user name. Can be set with the
 *                         ibase.default_user &php.ini; directive.
 *                         </p>
 * @param string $password [optional] <p>
 *                         The password for username. Can be set with the
 *                         ibase.default_password &php.ini; directive.
 *                         </p>
 * @param string $charset  [optional] <p>
 *                         charset is the default character set for a
 *                         database.
 *                         </p>
 * @param int    $buffers  [optional] <p>
 *                         buffers is the number of database buffers to
 *                         allocate for the server-side cache. If 0 or omitted, server chooses
 *                         its own default.
 *                         </p>
 * @param int    $dialect  [optional] <p>
 *                         dialect selects the default SQL dialect for any
 *                         statement executed within a connection, and it defaults to the highest
 *                         one supported by client libraries. Functional only with InterBase 6
 *                         and up.
 *                         </p>
 * @param string $role     [optional] <p>
 *                         Functional only with InterBase 5 and up.
 *                         </p>
 * @param int    $sync     [optional] <p>
 *                         </p>
 *
 * @return resource an InterBase link identifier on success, or false on error.
 * @since 4.0
 * @since 5.0
 */
function ibase_connect(
    $database = null,
    $username = null,
    $password = null,
    $charset = null,
    $buffers = null,
    $dialect = null,
    $role = null,
    $sync = null
) {
}

/**
 * Request statistics about a database
 *
 * @link  http://php.net/manual/en/function.ibase-db-info.php
 *
 * @param resource $service_handle
 * @param string   $db
 * @param int      $action
 * @param int      $argument [optional]
 *
 * @return string
 * @since 5.0
 */
function ibase_db_info($service_handle, $db, $action, $argument = null) { }

/**
 * Delete a user from a security database (only for IB6 or later)
 *
 * @link  http://php.net/manual/en/function.ibase-delete-user.php
 *
 * @param resource $service_handle
 * @param string   $user_name
 *
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function ibase_delete_user($service_handle, $user_name) { }

/**
 * Drops a database
 *
 * @link  http://php.net/manual/en/function.ibase-drop-db.php
 *
 * @param resource $connection [optional] <p>
 *                             An InterBase link identifier. If omitted, the last opened link is
 *                             assumed.
 *                             </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function ibase_drop_db($connection = null) { }

/**
 * Return an error code
 *
 * @link  http://php.net/manual/en/function.ibase-errcode.php
 * @return int the error code as an integer, or false if no error occurred.
 * @since 5.0
 */
function ibase_errcode() { }

/**
 * Return error messages
 *
 * @link  http://php.net/manual/en/function.ibase-errmsg.php
 * @return string the error message as a string, or false if no error occurred.
 * @since 4.0
 * @since 5.0
 */
function ibase_errmsg() { }

/**
 * Execute a previously prepared query
 *
 * @link  http://php.net/manual/en/function.ibase-execute.php
 *
 * @param resource $query    <p>
 *                           An InterBase query prepared by ibase_prepare.
 *                           </p>
 * @param mixed    $bind_arg [optional] <p>
 *                           </p>
 * @param mixed    $_        [optional]
 *
 * @return resource If the query raises an error, returns false. If it is successful and
 * there is a (possibly empty) result set (such as with a SELECT query),
 * returns a result identifier. If the query was successful and there were
 * no results, returns true.
 * </p>
 * <p>
 * In PHP 5.0.0 and up, this function returns the number of rows affected by
 * the query (if > 0 and applicable to the statement type). A query that
 * succeeded, but did not affect any rows (e.g. an UPDATE of a non-existent
 * record) will return true.
 * @since 4.0
 * @since 5.0
 */
function ibase_execute($query, $bind_arg = null, $_ = null) { }

/**
 * Fetch a result row from a query as an associative array
 *
 * @link  http://php.net/manual/en/function.ibase-fetch-assoc.php
 *
 * @param resource $result     <p>
 *                             The result handle.
 *                             </p>
 * @param int      $fetch_flag [optional] <p>
 *                             fetch_flag is a combination of the constants
 *                             IBASE_TEXT and IBASE_UNIXTIME
 *                             ORed together. Passing IBASE_TEXT will cause this
 *                             function to return BLOB contents instead of BLOB ids. Passing
 *                             IBASE_UNIXTIME will cause this function to return
 *                             date/time values as Unix timestamps instead of as formatted strings.
 *                             </p>
 *
 * @return array an associative array that corresponds to the fetched row.
 * Subsequent calls will return the next row in the result set, or false if
 * there are no more rows.
 * @since 4.3.0
 * @since 5.0
 */
function ibase_fetch_assoc($result, $fetch_flag = null) { }

/**
 * Get an object from a InterBase database
 *
 * @link  http://php.net/manual/en/function.ibase-fetch-object.php
 *
 * @param resource $result_id  <p>
 *                             An InterBase result identifier obtained either by
 *                             ibase_query or ibase_execute.
 *                             </p>
 * @param int      $fetch_flag [optional] <p>
 *                             fetch_flag is a combination of the constants
 *                             IBASE_TEXT and IBASE_UNIXTIME
 *                             ORed together. Passing IBASE_TEXT will cause this
 *                             function to return BLOB contents instead of BLOB ids. Passing
 *                             IBASE_UNIXTIME will cause this function to return
 *                             date/time values as Unix timestamps instead of as formatted strings.
 *                             </p>
 *
 * @return object an object with the next row information, or false if there are
 * no more rows.
 * @since 4.0
 * @since 5.0
 */
function ibase_fetch_object($result_id, $fetch_flag = null) { }

/**
 * Fetch a row from an InterBase database
 *
 * @link  http://php.net/manual/en/function.ibase-fetch-row.php
 *
 * @param resource $result_identifier <p>
 *                                    An InterBase result identifier.
 *                                    </p>
 * @param int      $fetch_flag        [optional] <p>
 *                                    fetch_flag is a combination of the constants
 *                                    IBASE_TEXT and IBASE_UNIXTIME
 *                                    ORed together. Passing IBASE_TEXT will cause this
 *                                    function to return BLOB contents instead of BLOB ids. Passing
 *                                    IBASE_UNIXTIME will cause this function to return
 *                                    date/time values as Unix timestamps instead of as formatted strings.
 *                                    </p>
 *
 * @return array an array that corresponds to the fetched row, or false if there
 * are no more rows. Each result column is stored in an array offset,
 * starting at offset 0.
 * @since 4.0
 * @since 5.0
 */
function ibase_fetch_row($result_identifier, $fetch_flag = null) { }

/**
 * Get information about a field
 *
 * @link  http://php.net/manual/en/function.ibase-field-info.php
 *
 * @param resource $result       <p>
 *                               An InterBase result identifier.
 *                               </p>
 * @param int      $field_number <p>
 *                               Field offset.
 *                               </p>
 *
 * @return array an array with the following keys: name,
 * alias, relation,
 * length and type.
 * @since 4.0
 * @since 5.0
 */
function ibase_field_info($result, $field_number) { }

/**
 * Cancels a registered event handler
 *
 * @link  http://php.net/manual/en/function.ibase-free-event-handler.php
 *
 * @param resource $event <p>
 *                        An event resource, created by
 *                        ibase_set_event_handler.
 *                        </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function ibase_free_event_handler($event) { }

/**
 * Free memory allocated by a prepared query
 *
 * @link  http://php.net/manual/en/function.ibase-free-query.php
 *
 * @param resource $query <p>
 *                        A query prepared with ibase_prepare.
 *                        </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_free_query($query) { }

/**
 * Free a result set
 *
 * @link  http://php.net/manual/en/function.ibase-free-result.php
 *
 * @param resource $result_identifier <p>
 *                                    A result set created by ibase_query or
 *                                    ibase_execute.
 *                                    </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_free_result($result_identifier) { }

/**
 * Increments the named generator and returns its new value
 *
 * @link  http://php.net/manual/en/function.ibase-gen-id.php
 *
 * @param string   $generator
 * @param int      $increment       [optional]
 * @param resource $link_identifier [optional]
 *
 * @return mixed new generator value as integer, or as string if the value is too big.
 * @since 5.0
 */
function ibase_gen_id($generator, $increment = null, $link_identifier = null) { }

/**
 * Execute a maintenance command on the database server
 *
 * @link  http://php.net/manual/en/function.ibase-maintain-db.php
 *
 * @param resource $service_handle
 * @param string   $db
 * @param int      $action
 * @param int      $argument [optional]
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function ibase_maintain_db($service_handle, $db, $action, $argument = null) { }

/**
 * Modify a user to a security database (only for IB6 or later)
 *
 * @link  http://php.net/manual/en/function.ibase-modify-user.php
 *
 * @param resource $service_handle
 * @param string   $user_name
 * @param string   $password
 * @param string   $first_name  [optional]
 * @param string   $middle_name [optional]
 * @param string   $last_name   [optional]
 *
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function ibase_modify_user(
    $service_handle,
    $user_name,
    $password,
    $first_name = null,
    $middle_name = null,
    $last_name = null
) {
}

/**
 * Assigns a name to a result set
 *
 * @link  http://php.net/manual/en/function.ibase-name-result.php
 *
 * @param resource $result <p>
 *                         An InterBase result set.
 *                         </p>
 * @param string   $name   <p>
 *                         The name to be assigned.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function ibase_name_result($result, $name) { }

/**
 * Get the number of fields in a result set
 *
 * @link  http://php.net/manual/en/function.ibase-num-fields.php
 *
 * @param resource $result_id <p>
 *                            An InterBase result identifier.
 *                            </p>
 *
 * @return int the number of fields as an integer.
 * @since 4.0
 * @since 5.0
 */
function ibase_num_fields($result_id) { }

/**
 * Return the number of parameters in a prepared query
 *
 * @link  http://php.net/manual/en/function.ibase-num-params.php
 *
 * @param resource $query <p>
 *                        The prepared query handle.
 *                        </p>
 *
 * @return int the number of parameters as an integer.
 * @since 5.0
 */
function ibase_num_params($query) { }

/**
 * Return information about a parameter in a prepared query
 *
 * @link  http://php.net/manual/en/function.ibase-param-info.php
 *
 * @param resource $query        <p>
 *                               An InterBase prepared query handle.
 *                               </p>
 * @param int      $param_number <p>
 *                               Parameter offset.
 *                               </p>
 *
 * @return array an array with the following keys: name,
 * alias, relation,
 * length and type.
 * @since 5.0
 */
function ibase_param_info($query, $param_number) { }

/**
 * Open a persistent connection to an InterBase database
 *
 * @link  http://php.net/manual/en/function.ibase-pconnect.php
 *
 * @param string $database [optional] <p>
 *                         The database argument has to be a valid path to
 *                         database file on the server it resides on. If the server is not local,
 *                         it must be prefixed with either 'hostname:' (TCP/IP), '//hostname/'
 *                         (NetBEUI) or 'hostname@' (IPX/SPX), depending on the connection
 *                         protocol used.
 *                         </p>
 * @param string $username [optional] <p>
 *                         The user name. Can be set with the
 *                         ibase.default_user &php.ini; directive.
 *                         </p>
 * @param string $password [optional] <p>
 *                         The password for username. Can be set with the
 *                         ibase.default_password &php.ini; directive.
 *                         </p>
 * @param string $charset  [optional] <p>
 *                         charset is the default character set for a
 *                         database.
 *                         </p>
 * @param int    $buffers  [optional] <p>
 *                         buffers is the number of database buffers to
 *                         allocate for the server-side cache. If 0 or omitted, server chooses
 *                         its own default.
 *                         </p>
 * @param int    $dialect  [optional] <p>
 *                         dialect selects the default SQL dialect for any
 *                         statement executed within a connection, and it defaults to the highest
 *                         one supported by client libraries. Functional only with InterBase 6
 *                         and up.
 *                         </p>
 * @param string $role     [optional] <p>
 *                         Functional only with InterBase 5 and up.
 *                         </p>
 * @param int    $sync     [optional] <p>
 *                         </p>
 *
 * @return resource an InterBase link identifier on success, or false on error.
 * @since 4.0
 * @since 5.0
 */
function ibase_pconnect(
    $database = null,
    $username = null,
    $password = null,
    $charset = null,
    $buffers = null,
    $dialect = null,
    $role = null,
    $sync = null
) {
}

/**
 * Prepare a query for later binding of parameter placeholders and execution
 *
 * @link  http://php.net/manual/en/function.ibase-prepare.php
 *
 * @param string $query <p>
 *                      An InterBase query.
 *                      </p>
 *
 * @return resource a prepared query handle, or false on error.
 * @since 4.0
 * @since 5.0
 */
function ibase_prepare($query) { }

/**
 * Execute a query on an InterBase database
 *
 * @link  http://php.net/manual/en/function.ibase-query.php
 *
 * @param resource $link_identifier [optional] <p>
 *                                  An InterBase link identifier. If omitted, the last opened link is
 *                                  assumed.
 *                                  </p>
 * @param string   $query           <p>
 *                                  An InterBase query.
 *                                  </p>
 * @param int      $bind_args       [optional] <p>
 *                                  </p>
 *
 * @return resource If the query raises an error, returns false. If it is successful and
 * there is a (possibly empty) result set (such as with a SELECT query),
 * returns a result identifier. If the query was successful and there were
 * no results, returns true.
 * </p>
 * <p>
 * In PHP 5.0.0 and up, this function will return the number of rows
 * affected by the query for INSERT, UPDATE and DELETE statements. In order
 * to retain backward compatibility, it will return true for these
 * statements if the query succeeded without affecting any rows.
 * @since 4.0
 * @since 5.0
 */
function ibase_query($link_identifier = null, $query, $bind_args = null) { }

/**
 * Initiates a restore task in the service manager and returns immediately
 *
 * @link  http://php.net/manual/en/function.ibase-restore.php
 *
 * @param resource $service_handle
 * @param string   $source_file
 * @param string   $dest_db
 * @param int      $options [optional]
 * @param bool     $verbose [optional]
 *
 * @return mixed
 * @since 5.0
 */
function ibase_restore($service_handle, $source_file, $dest_db, $options = null, $verbose = null) { }

/**
 * Roll back a transaction
 *
 * @link  http://php.net/manual/en/function.ibase-rollback.php
 *
 * @param resource $link_or_trans_identifier [optional] <p>
 *                                           If called without an argument, this function rolls back the default
 *                                           transaction of the default link. If the argument is a connection
 *                                           identifier, the default transaction of the corresponding connection
 *                                           will be rolled back. If the argument is a transaction identifier, the
 *                                           corresponding transaction will be rolled back.
 *                                           </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ibase_rollback($link_or_trans_identifier = null) { }

/**
 * Roll back a transaction without closing it
 *
 * @link  http://php.net/manual/en/function.ibase-rollback-ret.php
 *
 * @param resource $link_or_trans_identifier [optional] <p>
 *                                           If called without an argument, this function rolls back the default
 *                                           transaction of the default link. If the argument is a connection
 *                                           identifier, the default transaction of the corresponding connection
 *                                           will be rolled back. If the argument is a transaction identifier, the
 *                                           corresponding transaction will be rolled back. The transaction context
 *                                           will be retained, so statements executed from within this transaction
 *                                           will not be invalidated.
 *                                           </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function ibase_rollback_ret($link_or_trans_identifier = null) { }

/**
 * Request information about a database server
 *
 * @link  http://php.net/manual/en/function.ibase-server-info.php
 *
 * @param resource $service_handle
 * @param int      $action
 *
 * @return string
 * @since 5.0
 */
function ibase_server_info($service_handle, $action) { }

/**
 * Connect to the service manager
 *
 * @link  http://php.net/manual/en/function.ibase-service-attach.php
 *
 * @param string $host
 * @param string $dba_username
 * @param string $dba_password
 *
 * @return resource
 * @since 5.0
 */
function ibase_service_attach($host, $dba_username, $dba_password) { }

/**
 * Disconnect from the service manager
 *
 * @link  http://php.net/manual/en/function.ibase-service-detach.php
 *
 * @param resource $service_handle
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function ibase_service_detach($service_handle) { }

/**
 * Register a callback function to be called when events are posted
 *
 * @link  http://php.net/manual/en/function.ibase-set-event-handler.php
 *
 * @param callback $event_handler <p>
 *                                The callback is called with the event name and the link resource as
 *                                arguments whenever one of the specified events is posted by the
 *                                database.
 *                                </p>
 *                                <p>
 *                                The callback must return false if the event handler should be
 *                                canceled. Any other return value is ignored. This function accepts up
 *                                to 15 event arguments.
 *                                </p>
 * @param string   $event_name1   <p>
 *                                An event name.
 *                                </p>
 * @param string   $event_name2   [optional] <p>
 *                                At most 15 events allowed.
 *                                </p>
 * @param string   $_             [optional]
 *
 * @return resource The return value is an event resource. This resource can be used to free
 * the event handler using ibase_free_event_handler.
 * @since 5.0
 */
function ibase_set_event_handler($event_handler, $event_name1, $event_name2 = null, $_ = null) { }

/**
 * Begin a transaction
 *
 * @link  http://php.net/manual/en/function.ibase-trans.php
 *
 * @param int      $trans_args      [optional] <p>
 *                                  trans_args can be a combination of
 *                                  IBASE_READ,
 *                                  IBASE_WRITE,
 *                                  IBASE_COMMITTED,
 *                                  IBASE_CONSISTENCY,
 *                                  IBASE_CONCURRENCY,
 *                                  IBASE_REC_VERSION,
 *                                  IBASE_REC_NO_VERSION,
 *                                  IBASE_WAIT and
 *                                  IBASE_NOWAIT.
 *                                  </p>
 * @param resource $link_identifier [optional] <p>
 *                                  An InterBase link identifier. If omitted, the last opened link is
 *                                  assumed.
 *                                  </p>
 *
 * @return resource a transaction handle, or false on error.
 * @since 4.0
 * @since 5.0
 */
function ibase_trans($trans_args = null, $link_identifier = null) { }

/**
 * Wait for an event to be posted by the database
 *
 * @link  http://php.net/manual/en/function.ibase-wait-event.php
 *
 * @param string $event_name1 <p>
 *                            The event name.
 *                            </p>
 * @param string $event_name2 [optional] <p>
 *                            </p>
 * @param string $_           [optional]
 *
 * @return string the name of the event that was posted.
 * @since 5.0
 */
function ibase_wait_event($event_name1, $event_name2 = null, $_ = null) { }
