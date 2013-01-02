<?php

// Start of oci8 v.1.3.4

class OCI_Lob  {

	/**
	 * Returns large object's contents
	 * @link http://php.net/manual/en/function.oci-lob-load.php
	 * @return string the contents of the object, or false on errors.
	 */
	public function load () {}

	/**
	 * Returns current position of internal pointer of large object
	 * @link http://php.net/manual/en/function.oci-lob-tell.php
	 * @return int current position of a LOB's internal pointer or false if an
	 * error occurred.
	 */
	public function tell () {}

	/**
	 * Truncates large object
	 * @link http://php.net/manual/en/function.oci-lob-truncate.php
	 * @param length int[optional] <p>
	 * If provided, this method will truncate the LOB to
	 * length bytes. Otherwise, it will completrely
	 * purge the LOB.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function truncate ($length = null) {}

	/**
	 * Erases a specified portion of the internal LOB data
	 * @link http://php.net/manual/en/function.oci-lob-erase.php
	 * @param offset int[optional] <p>
	 * </p>
	 * @param length int[optional] <p>
	 * </p>
	 * @return int the actual number of characters/bytes erased or false in case of
	 * error.
	 */
	public function erase ($offset = null, $length = null) {}

	/**
	 * Flushes/writes buffer of the LOB to the server
	 * @link http://php.net/manual/en/function.oci-lob-flush.php
	 * @param flag int[optional] <p>
	 * By default, resources are not freed, but using flag 
	 * OCI_LOB_BUFFER_FREE you can do it explicitly.
	 * Be sure you know what you're doing - next read/write operation to the
	 * same part of LOB will involve a round-trip to the server and initialize
	 * new buffer resources. It is recommended to use 
	 * OCI_LOB_BUFFER_FREE flag only when you are not
	 * going to work with the LOB anymore.
	 * </p>
	 * @return bool true on success or false on failure.
	 * </p>
	 * <p>
	 * Returns false if buffering was not enabled or an error occurred.
	 */
	public function flush ($flag = null) {}

	/**
	 * Changes current state of buffering for the large object
	 * @link http://php.net/manual/en/function.oci-lob-setbuffering.php
	 * @param on_off bool <p>
	 * true for on and false for off.
	 * </p>
	 * @return bool true on success or false on failure. Repeated calls to this method with the same flag will
	 * return true.
	 */
	public function setbuffering ($on_off) {}

	/**
	 * Returns current state of buffering for the large object
	 * @link http://php.net/manual/en/function.oci-lob-getbuffering.php
	 * @return bool false if buffering for the large object is off and true if
	 * buffering is used.
	 */
	public function getbuffering () {}

	/**
	 * Moves the internal pointer to the beginning of the large object
	 * @link http://php.net/manual/en/function.oci-lob-rewind.php
	 * @return bool true on success or false on failure.
	 */
	public function rewind () {}

	/**
	 * Reads part of the large object
	 * @link http://php.net/manual/en/function.oci-lob-read.php
	 * @param length int <p>
	 * The length of data to read, in bytes.
	 * </p>
	 * @return string the contents as a string, or false in case of error.
	 */
	public function read ($length) {}

	/**
	 * Tests for end-of-file on a large object's descriptor
	 * @link http://php.net/manual/en/function.oci-lob-eof.php
	 * @return bool true if internal pointer of large object is at the end of LOB.
	 * Otherwise returns false.
	 */
	public function eof () {}

	/**
	 * Sets the internal pointer of the large object
	 * @link http://php.net/manual/en/function.oci-lob-seek.php
	 * @param offset int <p>
	 * Indicates the amount of bytes, on which internal pointer should be
	 * moved from the position, pointed by whence.
	 * </p>
	 * @param whence int[optional] <p>
	 * May be one of:
	 * OCI_SEEK_SET - sets the position equal to 
	 * offset
	 * OCI_SEEK_CUR - adds offset 
	 * bytes to the current position 
	 * OCI_SEEK_END - adds offset
	 * bytes to the end of large object (use negative value to move to a position
	 * before the end of large object)
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function seek ($offset, $whence = null) {}

	/**
	 * Writes data to the large object
	 * @link http://php.net/manual/en/function.oci-lob-write.php
	 * @param data string <p>
	 * The data to write in the LOB.
	 * </p>
	 * @param length int[optional] <p>
	 * If this parameter is given, writing will stop after 
	 * length bytes have been written or the end of
	 * data is reached, whichever comes first.
	 * </p>
	 * @return int the number of bytes written or false in case of error.
	 */
	public function write ($data, $length = null) {}

	/**
	 * Appends data from the large object to another large object
	 * @link http://php.net/manual/en/function.oci-lob-append.php
	 * @param lob_from OCI_Lob <p>
	 * The copied LOB.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function append (OCI_Lob $lob_from) {}

	/**
	 * Returns size of large object
	 * @link http://php.net/manual/en/function.oci-lob-size.php
	 * @return int length of large object value or false in case of error.
	 * Empty objects have zero length.
	 */
	public function size () {}

	/**
	 * &Alias; <function>oci_lob_export</function>
	 * @link http://php.net/manual/en/function.oci-lob-writetofile.php
	 * @param filename
	 * @param start[optional]
	 * @param length[optional]
	 */
	public function writetofile ($filename, $start, $length) {}

	/**
	 * Exports LOB's contents to a file
	 * @link http://php.net/manual/en/function.oci-lob-export.php
	 * @param filename string <p>
	 * Path to the file.
	 * </p>
	 * @param start int[optional] <p>
	 * Indicates from where to start exporting.
	 * </p>
	 * @param length int[optional] <p>
	 * Indicates the length of data to be exported. 
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function export ($filename, $start = null, $length = null) {}

	/**
	 * Imports file data to the LOB
	 * @link http://php.net/manual/en/function.oci-lob-import.php
	 * @param filename string <p>
	 * Path to the file.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function import ($filename) {}

	/**
	 * Writes temporary large object
	 * @link http://php.net/manual/en/function.oci-lob-writetemporary.php
	 * @param data string <p>
	 * The data to write.
	 * </p>
	 * @param lob_type int[optional] <p>
	 * Can be one of the following:
	 * OCI_TEMP_BLOB is used to create temporary BLOBs 
	 * OCI_TEMP_CLOB (default value) is used to create
	 * temporary CLOBs
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function writetemporary ($data, $lob_type = null) {}

	/**
	 * Closes LOB descriptor
	 * @link http://php.net/manual/en/function.oci-lob-close.php
	 * @return bool true on success or false on failure.
	 */
	public function close () {}

	/**
	 * Saves data to the large object
	 * @link http://php.net/manual/en/function.oci-lob-save.php
	 * @param data string <p>
	 * The data to be saved.
	 * </p>
	 * @param offset int[optional] <p>
	 * Can be used to indicate offset from the beginning of the large object.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function save ($data, $offset = null) {}

	/**
	 * &Alias; <function>oci_lob_import</function>
	 * @link http://php.net/manual/en/function.oci-lob-savefile.php
	 * @param filename
	 */
	public function savefile ($filename) {}

	/**
	 * Frees resources associated with the LOB descriptor
	 * @link http://php.net/manual/en/function.oci-lob-free.php
	 * @return bool true on success or false on failure.
	 */
	public function free () {}

}

class OCI_Collection  {

	/**
	 * Appends element to the collection
	 * @link http://php.net/manual/en/function.oci-collection-append.php
	 * @param value mixed <p>
	 * The value to be added to the collection. Can be a string or a number.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function append ($value) {}

	/**
	 * Returns value of the element
	 * @link http://php.net/manual/en/function.oci-collection-element-get.php
	 * @param index int <p>
	 * The element index. First index is 1.
	 * </p>
	 * @return mixed false if such element doesn't exist; &null; if element is &null;;
	 * string if element is column of a string datatype or number if element is
	 * numeric field.
	 */
	public function getelem ($index) {}

	/**
	 * Assigns a value to the element of the collection
	 * @link http://php.net/manual/en/function.oci-collection-element-assign.php
	 * @param index int <p>
	 * The element index. First index is 1.
	 * </p>
	 * @param value mixed <p>
	 * Can be a string or a number.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function assignelem ($index, $value) {}

	/**
	 * Assigns a value to the collection from another existing collection
	 * @link http://php.net/manual/en/function.oci-collection-assign.php
	 * @param from OCI-Collection <p>
	 * An instance of OCI-Collection.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function assign (OCI_Collection $from) {}

	/**
	 * Returns size of the collection
	 * @link http://php.net/manual/en/function.oci-collection-size.php
	 * @return int the number of elements in the collection or false on error.
	 */
	public function size () {}

	/**
	 * Returns the maximum number of elements in the collection
	 * @link http://php.net/manual/en/function.oci-collection-max.php
	 * @return int the maximum number as an integer, or false on errors.
	 * </p>
	 * <p>
	 * If the returned value is 0, then the number of elements is not limited.
	 */
	public function max () {}

	/**
	 * Trims elements from the end of the collection
	 * @link http://php.net/manual/en/function.oci-collection-trim.php
	 * @param num int <p>
	 * The number of elements to be trimmed.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function trim ($num) {}

	/**
	 * Frees the resources associated with the collection object
	 * @link http://php.net/manual/en/function.oci-collection-free.php
	 * @return bool true on success or false on failure.
	 */
	public function free () {}

}

/**
 * Uses a PHP variable for the define-step during a SELECT
 * @link http://php.net/manual/en/function.oci-define-by-name.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param column_name string <p>
 * The column name. Must be uppercased.
 * </p>
 * <p>
 * Take into consideration that Oracle uses ALL-UPPERCASE column names, 
 * whereby in your select you can also use lowercase.
 * If you define a variable that doesn't exists in your select statement,
 * no error will be issued.
 * </p>
 * @param variable mixed <p>
 * The PHP variable.
 * </p>
 * @param type int[optional] <p>
 * </p>
 * <p>
 * If you need to define an abstract datatype (LOB/ROWID/BFILE) you must
 * allocate it first using oci_new_descriptor. See 
 * also the oci_bind_by_name function.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_define_by_name ($statement, $column_name, &$variable, $type = null) {}

/**
 * Binds the PHP variable to the Oracle placeholder
 * @link http://php.net/manual/en/function.oci-bind-by-name.php
 * @param statement resource <p>
 * An OCI statement.
 * </p>
 * @param ph_name string <p>
 * The placeholder.
 * </p>
 * @param variable mixed <p>
 * The PHP variable.
 * </p>
 * @param maxlength int[optional] <p>
 * Sets the maximum length for the bind. If you set it to -1, this
 * function will use the current length of variable
 * to set the maximum length.
 * </p>
 * @param type int[optional] <p>
 * If you need to bind an abstract datatype (LOB/ROWID/BFILE) you
 * need to allocate it first using the
 * oci_new_descriptor function. The
 * length is not used for abstract datatypes
 * and should be set to -1. The type parameter
 * tells Oracle which descriptor is used. Default to SQLT_CHR.
 * Possible values are:
 * <p>
 * SQLT_FILE - for BFILEs;
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_bind_by_name ($statement, $ph_name, &$variable, $maxlength = null, $type = null) {}

/**
 * Binds PHP array to Oracle PL/SQL array by name
 * @link http://php.net/manual/en/function.oci-bind-array-by-name.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param name string <p>
 * The Oracle placeholder.
 * </p>
 * @param var_array array <p>
 * An array.
 * </p>
 * @param max_table_length int <p>
 * Sets the maximum length both for incoming and result arrays.
 * </p>
 * @param max_item_length int[optional] <p>
 * Sets maximum length for array items. If not specified or equals to -1,
 * oci_bind_array_by_name will use find the longest
 * element in the incoming array and will use it as maximum length for
 * array items.
 * </p>
 * @param type int[optional] <p>
 * Should be used to set the type of PL/SQL array items. See list of
 * available types below:
 * </p>
 * <p>
 * <p>
 * SQLT_NUM - for arrays of NUMBER.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_bind_array_by_name ($statement, $name, array &$var_array, $max_table_length, $max_item_length = null, $type = null) {}

/**
 * Checks if the field is &null;
 * @link http://php.net/manual/en/function.oci-field-is-null.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param field mixed <p>
 * Can be a field's index or a field's name (uppercased).
 * </p>
 * @return bool true if field is &null;, false otherwise.
 */
function oci_field_is_null ($statement, $field) {}

/**
 * Returns the name of a field from the statement
 * @link http://php.net/manual/en/function.oci-field-name.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param field int <p>
 * Can be the field's index (1-based) or name.
 * </p>
 * @return string the name as a string, or false on errors.
 */
function oci_field_name ($statement, $field) {}

/**
 * Returns field's size
 * @link http://php.net/manual/en/function.oci-field-size.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param field mixed <p>
 * Can be the field's index (1-based) or name.
 * </p>
 * @return int the size of a field in bytes, or false on
 * errors.
 */
function oci_field_size ($statement, $field) {}

/**
 * Tell the scale of the field
 * @link http://php.net/manual/en/function.oci-field-scale.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param field int <p>
 * Can be the field's index (1-based) or name.
 * </p>
 * @return int the scale as an integer, or false on errors.
 */
function oci_field_scale ($statement, $field) {}

/**
 * Tell the precision of a field
 * @link http://php.net/manual/en/function.oci-field-precision.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param field int <p>
 * Can be the field's index (1-based) or name.
 * </p>
 * @return int the precision as an integer, or false on errors.
 */
function oci_field_precision ($statement, $field) {}

/**
 * Returns field's data type
 * @link http://php.net/manual/en/function.oci-field-type.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param field int <p>
 * Can be the field's index (1-based) or name.
 * </p>
 * @return mixed the field data type as a string, or false on errors.
 */
function oci_field_type ($statement, $field) {}

/**
 * Tell the raw Oracle data type of the field
 * @link http://php.net/manual/en/function.oci-field-type-raw.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param field int <p>
 * Can be the field's index (1-based) or name.
 * </p>
 * @return int Oracle's raw data type as a string, or false on errors.
 */
function oci_field_type_raw ($statement, $field) {}

/**
 * Executes a statement
 * @link http://php.net/manual/en/function.oci-execute.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param mode int[optional] <p>
 * Allows you to specify the execution mode (default is 
 * OCI_COMMIT_ON_SUCCESS).
 * </p>
 * <p>
 * If you don't want statements to be committed automatically, you should
 * specify OCI_DEFAULT as your
 * mode.
 * </p>
 * <p>
 * When using OCI_DEFAULT mode, you're creating a
 * transaction. Transactions are automatically rolled back when you close
 * the connection, or when the script ends, whichever is soonest. You
 * need to explicitly call oci_commit to commit
 * the transaction, or oci_rollback to abort it.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_execute ($statement, $mode = null) {}

/**
 * Cancels reading from cursor
 * @link http://php.net/manual/en/function.oci-cancel.php
 * @param statement resource <p>
 * An OCI statement.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_cancel ($statement) {}

/**
 * Fetches the next row into result-buffer
 * @link http://php.net/manual/en/function.oci-fetch.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_fetch ($statement) {}

/**
 * Returns the next row from the result data as an object
 * @link http://php.net/manual/en/function.oci-fetch-object.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return object an object, which attributes correspond to fields in statement, or
 * false if there are no more rows in the statement.
 */
function oci_fetch_object ($statement) {}

/**
 * Returns the next row from the result data as a numeric array
 * @link http://php.net/manual/en/function.oci-fetch-row.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return array an indexed array with the field information, or false if there
 * are no more rows in the statement.
 */
function oci_fetch_row ($statement) {}

/**
 * Returns the next row from the result data as an associative array
 * @link http://php.net/manual/en/function.oci-fetch-assoc.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return array an associative array, or false if there are no more rows in the
 * statement.
 */
function oci_fetch_assoc ($statement) {}

/**
 * Returns the next row from the result data as an associative or
   numeric array, or both
 * @link http://php.net/manual/en/function.oci-fetch-array.php
 * @param statement resource <p>
 * An optional second parameter can be any combination of the following
 * constants:
 * OCI_BOTH - return an array with both associative
 * and numeric indices (the same as OCI_ASSOC
 * + OCI_NUM). This is the default behavior.
 * OCI_ASSOC - return an associative array
 * (as oci_fetch_assoc works).
 * OCI_NUM - return a numeric array,
 * (as oci_fetch_row works).
 * OCI_RETURN_NULLS - create empty elements
 * for the &null; fields.
 * OCI_RETURN_LOBS - return the value of a LOB
 * of the descriptor.
 * Default mode is OCI_BOTH.
 * </p>
 * @param mode int[optional] 
 * @return array an array with both associative and numeric indices, or false if
 * there are no more rows in the statement.
 */
function oci_fetch_array ($statement, $mode = null) {}

/**
 * Fetches the next row into an array (deprecated)
 * @link http://php.net/manual/en/function.ocifetchinto.php
 * @param statement resource 
 * @param result array 
 * @param mode int[optional] 
 * @return int 
 */
function ocifetchinto ($statement, array &$result, $mode = null) {}

/**
 * Fetches all rows of result data into an array
 * @link http://php.net/manual/en/function.oci-fetch-all.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @param output array &database.fetch-null;
 * @param skip int[optional] <p>
 * The number of initial rows to ignore when fetching the result (default
 * value of 0, to start at the first line).
 * </p>
 * @param maxrows int[optional] <p>
 * The number of rows to read, starting at the skipth
 * row (default to -1, meaning all the rows).
 * </p>
 * @param flags int[optional] <p>
 * Parameter flags can be any combination of
 * the following:
 * OCI_FETCHSTATEMENT_BY_ROW
 * OCI_FETCHSTATEMENT_BY_COLUMN (default value)
 * OCI_NUM
 * OCI_ASSOC
 * </p>
 * @return int the number of rows fetched or false in case of an error.
 */
function oci_fetch_all ($statement, array &$output, $skip = null, $maxrows = null, $flags = null) {}

/**
 * Frees all resources associated with statement or cursor
 * @link http://php.net/manual/en/function.oci-free-statement.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_free_statement ($statement) {}

/**
 * Enables or disables internal debug output
 * @link http://php.net/manual/en/function.oci-internal-debug.php
 * @param onoff bool <p>
 * Set this to false to turn debug output off or true to turn it on.
 * </p>
 * @return void 
 */
function oci_internal_debug ($onoff) {}

/**
 * Returns the number of result columns in a statement
 * @link http://php.net/manual/en/function.oci-num-fields.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return int the number of columns as an integer, or false on errors.
 */
function oci_num_fields ($statement) {}

/**
 * Prepares Oracle statement for execution
 * @link http://php.net/manual/en/function.oci-parse.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect or oci_pconnect.
 * </p>
 * @param query string <p>
 * The SQL query.
 * </p>
 * @return resource a statement handler on success, or false on error.
 */
function oci_parse ($connection, $query) {}

/**
 * Allocates and returns a new cursor (statement handle)
 * @link http://php.net/manual/en/function.oci-new-cursor.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect or oci_pconnect.
 * </p>
 * @return resource a new statement handle, or false on error.
 */
function oci_new_cursor ($connection) {}

/**
 * Returns field's value from the fetched row
 * @link http://php.net/manual/en/function.oci-result.php
 * @param statement resource <p>
 * </p>
 * @param field mixed <p>
 * Can be either use the column number (1-based) or the column name (in
 * uppercase).
 * </p>
 * @return mixed everything as strings except for abstract types (ROWIDs, LOBs and
 * FILEs). Returns false on error.
 */
function oci_result ($statement, $field) {}

/**
 * Returns server version
 * @link http://php.net/manual/en/function.oci-server-version.php
 * @param connection resource <p>
 * </p>
 * @return string the version information as a string or false on error.
 */
function oci_server_version ($connection) {}

/**
 * Returns the type of an OCI statement
 * @link http://php.net/manual/en/function.oci-statement-type.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return string the query type ofstatement as one of the
 * following values:
 * SELECT
 * UPDATE
 * DELETE
 * INSERT
 * CREATE
 * DROP
 * ALTER
 * BEGIN
 * DECLARE
 * CALL (since PHP 5.2.1 and OCI8
 * 1.2.3)
 * UNKNOWN
 * Returns false on error.
 */
function oci_statement_type ($statement) {}

/**
 * Returns number of rows affected during statement execution
 * @link http://php.net/manual/en/function.oci-num-rows.php
 * @param statement resource <p>
 * A valid OCI statement identifier.
 * </p>
 * @return int the number of rows affected as an integer, or false on errors.
 */
function oci_num_rows ($statement) {}

/**
 * Closes Oracle connection
 * @link http://php.net/manual/en/function.oci-close.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_close ($connection) {}

/**
 * Establishes a connection to the Oracle server
 * @link http://php.net/manual/en/function.oci-connect.php
 * @param username string <p>
 * The Oracle user name.
 * </p>
 * @param password string <p>
 * The password for username.
 * </p>
 * @param db string[optional] <p>
 * This optional parameter can either contain the name of the local
 * Oracle instance or the name of the entry in
 * tnsnames.ora.
 * </p>
 * <p>
 * If the not specified, PHP uses environment variables
 * ORACLE_SID and TWO_TASK to
 * determine the name of local Oracle instance and location of 
 * tnsnames.ora accordingly.
 * </p>
 * @param charset string[optional] &oci.charset;
 * @param session_mode int[optional] <p>
 * This parameter is available since version 1.1 and accepts the
 * following values: OCI_DEFAULT,
 * OCI_SYSOPER and OCI_SYSDBA.
 * If either OCI_SYSOPER or
 * OCI_SYSDBA were specified, this function will try
 * to establish privileged connection using external credentials. 
 * Privileged connections are disabled by default. To enable them you
 * need to set oci8.privileged_connect
 * to On.
 * </p>
 * @return resource a connection identifier or false on error.
 */
function oci_connect ($username, $password, $db = null, $charset = null, $session_mode = null) {}

/**
 * Establishes a new connection to the Oracle server
 * @link http://php.net/manual/en/function.oci-new-connect.php
 * @param username string <p>
 * The Oracle user name.
 * </p>
 * @param password string <p>
 * The password for username.
 * </p>
 * @param db string[optional] <p>
 * This optional parameter can either contain the name of the local
 * Oracle instance or the name of the entry in
 * tnsnames.ora.
 * </p>
 * <p>
 * If the not specified, PHP uses environment variables
 * ORACLE_SID and TWO_TASK to
 * determine the name of local Oracle instance and location of 
 * tnsnames.ora accordingly.
 * </p>
 * @param charset string[optional] &oci.charset;
 * @param session_mode int[optional] <p>
 * This parameter is available since version 1.1 and accepts the
 * following values: OCI_DEFAULT,
 * OCI_SYSOPER and OCI_SYSDBA.
 * If either OCI_SYSOPER or
 * OCI_SYSDBA were specified, this function will try
 * to establish privileged connection using external credentials. 
 * Privileged connections are disabled by default. To enable them you
 * need to set oci8.privileged_connect
 * to On.
 * </p>
 * @return resource a connection identifier or false on error.
 */
function oci_new_connect ($username, $password, $db = null, $charset = null, $session_mode = null) {}

/**
 * Connect to an Oracle database using a persistent connection
 * @link http://php.net/manual/en/function.oci-pconnect.php
 * @param username string <p>
 * The Oracle user name.
 * </p>
 * @param password string <p>
 * The password for username.
 * </p>
 * @param db string[optional] <p>
 * This optional parameter can either contain the name of the local
 * Oracle instance or the name of the entry in
 * tnsnames.ora.
 * </p>
 * <p>
 * If the not specified, PHP uses environment variables
 * ORACLE_SID and TWO_TASK to
 * determine the name of local Oracle instance and location of 
 * tnsnames.ora accordingly.
 * </p>
 * @param charset string[optional] &oci.charset;
 * @param session_mode int[optional] <p>
 * This parameter is available since version 1.1 and accepts the
 * following values: OCI_DEFAULT,
 * OCI_SYSOPER and OCI_SYSDBA.
 * If either OCI_SYSOPER or
 * OCI_SYSDBA were specified, this function will try
 * to establish privileged connection using external credentials. 
 * Privileged connections are disabled by default. To enable them you
 * need to set oci8.privileged_connect
 * to On.
 * </p>
 * @return resource a connection identifier or false on error.
 */
function oci_pconnect ($username, $password, $db = null, $charset = null, $session_mode = null) {}

/**
 * Returns the last error found
 * @link http://php.net/manual/en/function.oci-error.php
 * @param source resource[optional] <p>
 * For most errors, the parameter is the most appropriate resource
 * handle. For connection errors with oci_connect,
 * oci_new_connect or 
 * oci_pconnect do not pass a parameter.
 * </p>
 * @return array If no error is found, oci_error
 * returns false. oci_error returns the error as an
 * associative array. In this array, code
 * consists the oracle error code and message
 * the oracle error string.
 */
function oci_error ($source = null) {}

/**
 * @param lob_descriptor
 */
function oci_free_descriptor ($lob_descriptor) {}

/**
 * @param lob_descriptor
 * @param data
 * @param offset[optional]
 */
function oci_lob_save ($lob_descriptor, $data, $offset) {}

/**
 * @param lob_descriptor
 * @param filename
 */
function oci_lob_import ($lob_descriptor, $filename) {}

/**
 * @param lob_descriptor
 */
function oci_lob_size ($lob_descriptor) {}

/**
 * @param lob_descriptor
 */
function oci_lob_load ($lob_descriptor) {}

/**
 * @param lob_descriptor
 * @param length
 */
function oci_lob_read ($lob_descriptor, $length) {}

/**
 * @param lob_descriptor
 */
function oci_lob_eof ($lob_descriptor) {}

/**
 * @param lob_descriptor
 */
function oci_lob_tell ($lob_descriptor) {}

/**
 * @param lob_descriptor
 * @param length[optional]
 */
function oci_lob_truncate ($lob_descriptor, $length) {}

/**
 * @param lob_descriptor
 * @param offset[optional]
 * @param length[optional]
 */
function oci_lob_erase ($lob_descriptor, $offset, $length) {}

/**
 * @param lob_descriptor
 * @param flag[optional]
 */
function oci_lob_flush ($lob_descriptor, $flag) {}

/**
 * @param lob_descriptor
 * @param mode
 */
function ocisetbufferinglob ($lob_descriptor, $mode) {}

/**
 * @param lob_descriptor
 */
function ocigetbufferinglob ($lob_descriptor) {}

/**
 * Compares two LOB/FILE locators for equality
 * @link http://php.net/manual/en/function.oci-lob-is-equal.php
 * @param lob1 OCI_Lob <p>
 * A LOB identifier.
 * </p>
 * @param lob2 OCI_Lob <p>
 * A LOB identifier.
 * </p>
 * @return bool true if these objects are equal, false otherwise.
 */
function oci_lob_is_equal (OCI_Lob $lob1, OCI_Lob $lob2) {}

/**
 * @param lob_descriptor
 */
function oci_lob_rewind ($lob_descriptor) {}

/**
 * @param lob_descriptor
 * @param string
 * @param length[optional]
 */
function oci_lob_write ($lob_descriptor, $string, $length) {}

/**
 * @param lob_descriptor_to
 * @param lob_descriptor_from
 */
function oci_lob_append ($lob_descriptor_to, $lob_descriptor_from) {}

/**
 * Copies large object
 * @link http://php.net/manual/en/function.oci-lob-copy.php
 * @param lob_to OCI_Lob <p>
 * The destination LOB.
 * </p>
 * @param lob_from OCI_Lob <p>
 * The copied LOB.
 * </p>
 * @param length int[optional] <p>
 * Indicates the length of data to be copied.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_lob_copy (OCI_Lob $lob_to, OCI_Lob $lob_from, $length = null) {}

/**
 * @param lob_descriptor
 * @param filename
 * @param start[optional]
 * @param length[optional]
 */
function oci_lob_export ($lob_descriptor, $filename, $start, $length) {}

/**
 * @param lob_descriptor
 * @param offset
 * @param whence[optional]
 */
function oci_lob_seek ($lob_descriptor, $offset, $whence) {}

/**
 * Commits outstanding statements
 * @link http://php.net/manual/en/function.oci-commit.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect or oci_pconnect.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_commit ($connection) {}

/**
 * Rolls back outstanding transaction
 * @link http://php.net/manual/en/function.oci-rollback.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect or oci_pconnect.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_rollback ($connection) {}

/**
 * Initializes a new empty LOB or FILE descriptor
 * @link http://php.net/manual/en/function.oci-new-descriptor.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect or oci_pconnect.
 * </p>
 * @param type int[optional] <p>
 * Valid values for type are: 
 * OCI_D_FILE, OCI_D_LOB and
 * OCI_D_ROWID.
 * </p>
 * @return OCI_Lob a new LOB or FILE descriptor on success, false on error.
 */
function oci_new_descriptor ($connection, $type = null) {}

/**
 * Sets number of rows to be prefetched
 * @link http://php.net/manual/en/function.oci-set-prefetch.php
 * @param statement resource <p>
 * </p>
 * @param rows int <p>
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_set_prefetch ($statement, $rows) {}

/**
 * Changes password of Oracle's user
 * @link http://php.net/manual/en/function.oci-password-change.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect or oci_pconnect.
 * </p>
 * @param username string <p>
 * The Oracle user name.
 * </p>
 * @param old_password string <p>
 * The old password.
 * </p>
 * @param new_password string <p>
 * The new password to be set.
 * </p>
 * @return bool true on success or false on failure.
 */
function oci_password_change ($connection, $username, $old_password, $new_password) {}

/**
 * @param collection
 */
function oci_free_collection ($collection) {}

/**
 * @param collection
 * @param value
 */
function oci_collection_append ($collection, $value) {}

/**
 * @param collection
 * @param index
 */
function oci_collection_element_get ($collection, $index) {}

/**
 * @param collection
 * @param index
 * @param value
 */
function oci_collection_element_assign ($collection, $index, $value) {}

/**
 * @param collection_to
 * @param collection_from
 */
function oci_collection_assign ($collection_to, $collection_from) {}

/**
 * @param collection
 */
function oci_collection_size ($collection) {}

/**
 * @param collection
 */
function oci_collection_max ($collection) {}

/**
 * @param collection
 * @param number
 */
function oci_collection_trim ($collection, $number) {}

/**
 * Allocates new collection object
 * @link http://php.net/manual/en/function.oci-new-collection.php
 * @param connection resource <p>
 * An Oracle connection identifier, returned by 
 * oci_connect or oci_pconnect.
 * </p>
 * @param tdo string <p>
 * Should be a valid named type (uppercase).
 * </p>
 * @param schema string[optional] <p>
 * Should point to the scheme, where the named type was created. The name
 * of the current user is the default value.
 * </p>
 * @return OCI-Collection a new OCICollection object or false on
 * error.
 */
function oci_new_collection ($connection, $tdo, $schema = null) {}

/**
 * @param statement_resource
 */
function oci_free_cursor ($statement_resource) {}

/**
 * &Alias; <function>oci_free_statement</function>
 * @link http://php.net/manual/en/function.ocifreecursor.php
 * @param statement_resource
 */
function ocifreecursor ($statement_resource) {}

/**
 * &Alias; <function>oci_bind_by_name</function>
 * @link http://php.net/manual/en/function.ocibindbyname.php
 * @param statement_resource
 * @param column_name
 * @param variable
 * @param maximum_length[optional]
 * @param type[optional]
 */
function ocibindbyname ($statement_resource, $column_name, &$variable, $maximum_length, $type) {}

/**
 * &Alias; <function>oci_define_by_name</function>
 * @link http://php.net/manual/en/function.ocidefinebyname.php
 * @param statement_resource
 * @param column_name
 * @param variable
 * @param type[optional]
 */
function ocidefinebyname ($statement_resource, $column_name, &$variable, $type) {}

/**
 * &Alias; <function>oci_field_is_null</function>
 * @link http://php.net/manual/en/function.ocicolumnisnull.php
 * @param statement_resource
 * @param column_number_or_name
 */
function ocicolumnisnull ($statement_resource, $column_number_or_name) {}

/**
 * &Alias; <function>oci_field_name</function>
 * @link http://php.net/manual/en/function.ocicolumnname.php
 * @param statement_resource
 * @param column_number
 */
function ocicolumnname ($statement_resource, $column_number) {}

/**
 * &Alias; <function>oci_field_size</function>
 * @link http://php.net/manual/en/function.ocicolumnsize.php
 * @param statement_resource
 * @param column_number_or_name
 */
function ocicolumnsize ($statement_resource, $column_number_or_name) {}

/**
 * &Alias; <function>oci_field_scale</function>
 * @link http://php.net/manual/en/function.ocicolumnscale.php
 * @param statement_resource
 * @param column_number
 */
function ocicolumnscale ($statement_resource, $column_number) {}

/**
 * &Alias; <function>oci_field_precision</function>
 * @link http://php.net/manual/en/function.ocicolumnprecision.php
 * @param statement_resource
 * @param column_number
 */
function ocicolumnprecision ($statement_resource, $column_number) {}

/**
 * &Alias; <function>oci_field_type</function>
 * @link http://php.net/manual/en/function.ocicolumntype.php
 * @param statement_resource
 * @param column_number
 */
function ocicolumntype ($statement_resource, $column_number) {}

/**
 * &Alias; <function>oci_field_type_raw</function>
 * @link http://php.net/manual/en/function.ocicolumntyperaw.php
 * @param statement_resource
 * @param column_number
 */
function ocicolumntyperaw ($statement_resource, $column_number) {}

/**
 * &Alias; <function>oci_execute</function>
 * @link http://php.net/manual/en/function.ociexecute.php
 * @param statement_resource
 * @param mode[optional]
 */
function ociexecute ($statement_resource, $mode) {}

/**
 * &Alias; <function>oci_cancel</function>
 * @link http://php.net/manual/en/function.ocicancel.php
 * @param statement_resource
 */
function ocicancel ($statement_resource) {}

/**
 * &Alias; <function>oci_fetch</function>
 * @link http://php.net/manual/en/function.ocifetch.php
 * @param statement_resource
 */
function ocifetch ($statement_resource) {}

/**
 * &Alias; <function>oci_fetch_all</function>
 * @link http://php.net/manual/en/function.ocifetchstatement.php
 * @param statement_resource
 * @param output
 * @param skip[optional]
 * @param maximum_rows[optional]
 * @param flags[optional]
 */
function ocifetchstatement ($statement_resource, &$output, $skip, $maximum_rows, $flags) {}

/**
 * &Alias; <function>oci_free_statement</function>
 * @link http://php.net/manual/en/function.ocifreestatement.php
 * @param statement_resource
 */
function ocifreestatement ($statement_resource) {}

/**
 * &Alias; <function>oci_internal_debug</function>
 * @link http://php.net/manual/en/function.ociinternaldebug.php
 * @param mode
 */
function ociinternaldebug ($mode) {}

/**
 * &Alias; <function>oci_num_fields</function>
 * @link http://php.net/manual/en/function.ocinumcols.php
 * @param statement_resource
 */
function ocinumcols ($statement_resource) {}

/**
 * &Alias; <function>oci_parse</function>
 * @link http://php.net/manual/en/function.ociparse.php
 * @param connection_resource
 * @param sql_text
 */
function ociparse ($connection_resource, $sql_text) {}

/**
 * &Alias; <function>oci_new_cursor</function>
 * @link http://php.net/manual/en/function.ocinewcursor.php
 * @param connection_resource
 */
function ocinewcursor ($connection_resource) {}

/**
 * &Alias; <function>oci_result</function>
 * @link http://php.net/manual/en/function.ociresult.php
 * @param statement_resource
 * @param column_number_or_name
 */
function ociresult ($statement_resource, $column_number_or_name) {}

/**
 * &Alias; <function>oci_server_version</function>
 * @link http://php.net/manual/en/function.ociserverversion.php
 * @param connection_resource
 */
function ociserverversion ($connection_resource) {}

/**
 * &Alias; <function>oci_statement_type</function>
 * @link http://php.net/manual/en/function.ocistatementtype.php
 * @param statement_resource
 */
function ocistatementtype ($statement_resource) {}

/**
 * &Alias; <function>oci_num_rows</function>
 * @link http://php.net/manual/en/function.ocirowcount.php
 * @param statement_resource
 */
function ocirowcount ($statement_resource) {}

/**
 * &Alias; <function>oci_close</function>
 * @link http://php.net/manual/en/function.ocilogoff.php
 * @param connection_resource
 */
function ocilogoff ($connection_resource) {}

/**
 * &Alias; <function>oci_connect</function>
 * @link http://php.net/manual/en/function.ocilogon.php
 * @param username
 * @param password
 * @param connection_string[optional]
 * @param character_set[optional]
 * @param session_mode[optional]
 */
function ocilogon ($username, $password, $connection_string, $character_set, $session_mode) {}

/**
 * &Alias; <function>oci_new_connect</function>
 * @link http://php.net/manual/en/function.ocinlogon.php
 * @param username
 * @param password
 * @param connection_string[optional]
 * @param character_set[optional]
 * @param session_mode[optional]
 */
function ocinlogon ($username, $password, $connection_string, $character_set, $session_mode) {}

/**
 * &Alias; <function>oci_pconnect</function>
 * @link http://php.net/manual/en/function.ociplogon.php
 * @param username
 * @param password
 * @param connection_string[optional]
 * @param character_set[optional]
 * @param session_mode[optional]
 */
function ociplogon ($username, $password, $connection_string, $character_set, $session_mode) {}

/**
 * &Alias; <function>oci_error</function>
 * @link http://php.net/manual/en/function.ocierror.php
 * @param connection_or_statement_resource[optional]
 */
function ocierror ($connection_or_statement_resource) {}

/**
 * &Alias; <xref linkend="function.oci-lob-free" />
 * @link http://php.net/manual/en/function.ocifreedesc.php
 * @param lob_descriptor
 */
function ocifreedesc ($lob_descriptor) {}

/**
 * &Alias; <xref linkend="function.oci-lob-save" />
 * @link http://php.net/manual/en/function.ocisavelob.php
 * @param lob_descriptor
 * @param data
 * @param offset[optional]
 */
function ocisavelob ($lob_descriptor, $data, $offset) {}

/**
 * &Alias; <xref linkend="function.oci-lob-import" />
 * @link http://php.net/manual/en/function.ocisavelobfile.php
 * @param lob_descriptor
 * @param filename
 */
function ocisavelobfile ($lob_descriptor, $filename) {}

/**
 * &Alias; <xref linkend="function.oci-lob-export" />
 * @link http://php.net/manual/en/function.ociwritelobtofile.php
 * @param lob_descriptor
 * @param filename
 * @param start[optional]
 * @param length[optional]
 */
function ociwritelobtofile ($lob_descriptor, $filename, $start, $length) {}

/**
 * &Alias; <xref linkend="function.oci-lob-load" />
 * @link http://php.net/manual/en/function.ociloadlob.php
 * @param lob_descriptor
 */
function ociloadlob ($lob_descriptor) {}

/**
 * &Alias; <function>oci_commit</function>
 * @link http://php.net/manual/en/function.ocicommit.php
 * @param connection_resource
 */
function ocicommit ($connection_resource) {}

/**
 * &Alias; <function>oci_rollback</function>
 * @link http://php.net/manual/en/function.ocirollback.php
 * @param connection_resource
 */
function ocirollback ($connection_resource) {}

/**
 * &Alias; <function>oci_new_descriptor</function>
 * @link http://php.net/manual/en/function.ocinewdescriptor.php
 * @param connection_resource
 * @param type[optional]
 */
function ocinewdescriptor ($connection_resource, $type) {}

/**
 * &Alias; <function>oci_set_prefetch</function>
 * @link http://php.net/manual/en/function.ocisetprefetch.php
 * @param statement_resource
 * @param number_of_rows
 */
function ocisetprefetch ($statement_resource, $number_of_rows) {}

/**
 * @param connection_resource_or_connection_string
 * @param username
 * @param old_password
 * @param new_password
 */
function ocipasswordchange ($connection_resource_or_connection_string, $username, $old_password, $new_password) {}

/**
 * &Alias; <xref linkend="function.oci-collection-free" />
 * @link http://php.net/manual/en/function.ocifreecollection.php
 * @param collection
 */
function ocifreecollection ($collection) {}

/**
 * &Alias; <function>oci_new_collection</function>
 * @link http://php.net/manual/en/function.ocinewcollection.php
 * @param connection_resource
 * @param type_name
 * @param schema_name[optional]
 */
function ocinewcollection ($connection_resource, $type_name, $schema_name) {}

/**
 * &Alias; <xref linkend="function.oci-collection-append" />
 * @link http://php.net/manual/en/function.ocicollappend.php
 * @param collection
 * @param value
 */
function ocicollappend ($collection, $value) {}

/**
 * &Alias; <xref linkend="function.oci-collection-element-get" />
 * @link http://php.net/manual/en/function.ocicollgetelem.php
 * @param collection
 * @param index
 */
function ocicollgetelem ($collection, $index) {}

/**
 * &Alias; <xref linkend="function.oci-collection-element-assign" />
 * @link http://php.net/manual/en/function.ocicollassignelem.php
 * @param collection
 * @param index
 * @param value
 */
function ocicollassignelem ($collection, $index, $value) {}

/**
 * &Alias; <xref linkend="function.oci-collection-size" />
 * @link http://php.net/manual/en/function.ocicollsize.php
 * @param collection
 */
function ocicollsize ($collection) {}

/**
 * &Alias; <xref linkend="function.oci-collection-max" />
 * @link http://php.net/manual/en/function.ocicollmax.php
 * @param collection
 */
function ocicollmax ($collection) {}

/**
 * &Alias; <xref linkend="function.oci-collection-trim" />
 * @link http://php.net/manual/en/function.ocicolltrim.php
 * @param collection
 * @param number
 */
function ocicolltrim ($collection, $number) {}


/**
 * Statement execution mode for oci_execute().
 * The transaction is not automatically committed when using this mode.
 * From PHP 5.3.2 (PECL OCI8 1.4) onwards, OCI_NO_AUTO_COMMIT is preferred instead of OCI_DEFAULT.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_DEFAULT', 0);

/**
 * Used with oci_connect to connect as SYSOPER
 * using external credentials (oci8.privileged_connect
 * should be enabled for this).
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_SYSOPER', 4);

/**
 * Used with oci_connect to connect as SYSDBA
 * using external credentials (oci8.privileged_connect
 * should be enabled for this).
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_SYSDBA', 2);
define ('OCI_CRED_EXT', -2147483648);

/**
 * Statement execution mode. Use this mode if you don't want 
 * to execute the query, but get the select-list's description.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_DESCRIBE_ONLY', 16);

/**
 * Statement execution mode. Statement is automatically committed after
 * oci_execute call.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_COMMIT_ON_SUCCESS', 32);

/**
 * Statement execution mode for oci_execute().
 * The statement is not committed automatically when using this mode.
 * For readability in new code, use this value instead of the obsolete OCI_DEFAULT constant.
 * Introduced in PHP 5.3.2 (PECL OCI8 1.4).
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_NO_AUTO_COMMIT', 0);

/**
 * Statement fetch mode. Used when the application knows 
 * in advance exactly how many rows it will be fetching. 
 * This mode turns prefetching off for Oracle release 8 
 * or later mode. Cursor is cancelled after the desired 
 * rows are fetched and may result in reduced server-side 
 * resource usage.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_EXACT_FETCH', 2);

/**
 * Used with OCI_Lob->seek to set the seek position.
 */
define ('OCI_SEEK_SET', 0);

/**
 * Used with OCI_Lob->seek to set the seek position.
 */
define ('OCI_SEEK_CUR', 1);

/**
 * Used with OCI_Lob->seek to set the seek position.
 */
define ('OCI_SEEK_END', 2);

/**
 * Used with to free buffers used.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_LOB_BUFFER_FREE', 1);

/**
 * The same as OCI_B_BFILE.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_BFILEE', 114);

/**
 * The same as OCI_B_CFILEE.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_CFILEE', 115);

/**
 * The same as OCI_B_CLOB.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_CLOB', 112);

/**
 * The same as OCI_B_BLOB.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_BLOB', 113);

/**
 * The same as OCI_B_ROWID.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_RDD', 104);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * INTEGER.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_INT', 3);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * NUMBER.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_NUM', 2);

/**
 * The same as OCI_B_CURSOR.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_RSET', 116);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * CHAR.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_AFC', 96);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * VARCHAR2.
 * Also used with oci_bind_by_name.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_CHR', 1);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * VARCHAR.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_VCS', 9);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * CHARZ.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_AVC', 97);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * STRING.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_STR', 5);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * LONG VARCHAR.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_LVC', 94);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * FLOAT.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_FLT', 4);
define ('SQLT_UIN', 68);

/**
 * Used with oci_bind_by_name to bind LONG values.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_LNG', 8);

/**
 * Used with oci_bind_by_name to bind LONG RAW values.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_LBI', 24);

/**
 * Used with oci_bind_by_name to bind RAW values.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_BIN', 23);

/**
 * Used with oci_bind_array_by_name to bind arrays of
 * LONG.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_ODT', 156);
define ('SQLT_BDOUBLE', 22);
define ('SQLT_BFLOAT', 21);

/**
 * Used with oci_bind_by_name when 
 * binding named data types. Note: in PHP &lt; 5.0 it was called
 * OCI_B_SQLT_NTY.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_B_NTY', 108);

/**
 * The same as OCI_B_NTY.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('SQLT_NTY', 108);
define ('OCI_SYSDATE', "SYSDATE");

/**
 * Used with oci_bind_by_name when 
 * binding BFILEs.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_B_BFILE', 114);

/**
 * Used with oci_bind_by_name when 
 * binding CFILEs.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_B_CFILEE', 115);

/**
 * Used with oci_bind_by_name when 
 * binding CLOBs.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_B_CLOB', 112);

/**
 * Used with oci_bind_by_name when 
 * binding BLOBs.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_B_BLOB', 113);

/**
 * Used with oci_bind_by_name when 
 * binding ROWIDs.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_B_ROWID', 104);

/**
 * Used with oci_bind_by_name when 
 * binding cursors, previously allocated with oci_new_descriptor.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_B_CURSOR', 116);
define ('OCI_B_BIN', 23);
define ('OCI_B_INT', 3);
define ('OCI_B_NUM', 2);

/**
 * Default mode of oci_fetch_all.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_FETCHSTATEMENT_BY_COLUMN', 16);

/**
 * Alternative mode of oci_fetch_all.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_FETCHSTATEMENT_BY_ROW', 32);

/**
 * Used with oci_fetch_all and
 * oci_fetch_array to get an associative 
 * array as a result.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_ASSOC', 1);

/**
 * Used with oci_fetch_all and 
 * oci_fetch_array to get an enumerated 
 * array as a result.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_NUM', 2);

/**
 * Used with oci_fetch_all and 
 * oci_fetch_array to get an array with
 * both associative and number indices.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_BOTH', 3);

/**
 * Used with oci_fetch_array to get
 * empty array elements if field's value is &null;.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_RETURN_NULLS', 4);

/**
 * Used with oci_fetch_array to get
 * value of LOB instead of the descriptor.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_RETURN_LOBS', 8);

/**
 * This flag tells oci_new_descriptor to
 * initialize new FILE descriptor.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_DTYPE_FILE', 56);

/**
 * This flag tells oci_new_descriptor to
 * initialize new LOB descriptor.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_DTYPE_LOB', 50);

/**
 * This flag tells oci_new_descriptor to
 * initialize new ROWID descriptor.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_DTYPE_ROWID', 54);

/**
 * The same as OCI_DTYPE_FILE.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_D_FILE', 56);

/**
 * The same as OCI_DTYPE_LOB.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_D_LOB', 50);

/**
 * The same as OCI_DTYPE_ROWID.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_D_ROWID', 54);

/**
 * Used with to indicate
 * explicilty that temporary CLOB should be created.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_TEMP_CLOB', 2);

/**
 * Used with to indicate
 * explicilty that temporary BLOB should be created.
 * @link http://php.net/manual/en/oci8.constants.php
 */
define ('OCI_TEMP_BLOB', 1);

// End of oci8 v.1.3.4
?>
