<?php
/**
 * PHPStorm stub file for SQLSRV constants.
 */

/**
 * Lets you access rows in any order.
 *
 * <br />Creates a client-side cursor query.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the kind of cursor that you can use in a result
 * set. For information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_CURSOR_CLIENT_BUFFERED = 'buffered';
/**
 * Lets you access rows in any order and will reflect changes in the database.
 *
 * <br />{@link sqlsrv_num_rows() sqlsrv_num_rows} returns an error for result sets created with this cursor
 * type.<br
 * />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the kind of cursor that you can use in a result
 * set. For information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_CURSOR_DYNAMIC = 'dynamic';
/**
 * Lets you move one row at a time starting at the first row of the result set until you reach the end of
 * the result set.
 *
 * <br />This is the default cursor type.<br />
 *
 * {@link sqlsrv_num_rows() sqlsrv_num_rows} returns an error for result sets created with this cursor type.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the kind of cursor that you can use in a result
 * set. For information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_CURSOR_FORWARD = 'forward';
/**
 * Lets you access rows in any order.
 *
 * <br />However, a keyset cursor does not update the row count if a row is deleted from the table (a deleted row is
 * returned with no values).<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the kind of cursor that you can use in a result
 * set. For information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_CURSOR_KEYSET = 'keyset';
/**
 * Lets you access rows in any order but will not reflect changes in the database.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the kind of cursor that you can use in a result
 * set. For information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_CURSOR_STATIC = 'static';
/**
 * Binary Encoding
 *
 * <br />Data is returned as a raw byte stream from the server without performing encoding or translation.<br />
 *
 * Used with {@link sqlsrv_prepare() sqlsrv_prepare},
 * {@link sqlsrv_query() sqlsrv_query}
 * and {@link sqlsrv_get_field() sqlsrv_get_field} to request a field be return as a specific PHP type.<br />
 *
 * This is used with {@link SQLSRV_PHPTYPE_STREAM() SQLSRV_PHPTYPE_STREAM} and
 * {@link SQLSRV_PHPTYPE_STRING() SQLSRV_PHPTYPE_STRING} to specify the encoding of those PHP types types.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_ENC_BINARY = 'binary';
/**
 * Character Encoding
 *
 * <br />Data is returned in 8-bit characters as specified in the code page of the Windows locale that is set on the
 * system. Any multi-byte characters or characters that do not map into this code page are substituted with a single
 * byte question mark (?) character.<br />
 *
 * This is the default encoding.<br />
 *
 * Used with {@link sqlsrv_prepare() sqlsrv_prepare},
 * {@link sqlsrv_query() sqlsrv_query}
 * and {@link sqlsrv_get_field() sqlsrv_get_field} to request a field be return as a specific PHP type.<br />
 *
 * This is used with {@link SQLSRV_PHPTYPE_STREAM() SQLSRV_PHPTYPE_STREAM} and
 * {@link SQLSRV_PHPTYPE_STRING() SQLSRV_PHPTYPE_STRING} to specify the encoding of those PHP types types.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_ENC_CHAR = 'char';
/**
 * Errors and warnings generated on the last sqlsrv function call are returned.
 *
 * <br />This is the default value.<br />
 *
 * Used to specify if {@link sqlsrv_errors() sqlsrv_errors} returns errors, warnings, or both.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_ERR_ALL = 2;
/**
 * Errors generated on the last sqlsrv function call are returned.
 *
 * <br />Used to specify if {@link sqlsrv_errors() sqlsrv_errors} returns errors, warnings, or both.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_ERR_ERRORS = 0;
/**
 * Warnings generated on the last sqlsrv function call are returned.
 *
 * <br />Used to specify if {@link sqlsrv_errors() sqlsrv_errors} returns errors, warnings, or both.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_ERR_WARNINGS = 1;
/**
 * Returns an associative array.
 *
 * <br />{@link sqlsrv_fetch_array() sqlsrv_fetch_array} returns the next row of data as an associative array.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_FETCH_ASSOC = 2;
/**
 * Returns both a numeric and associative array.
 *
 * <br />{@link sqlsrv_fetch_array() sqlsrv_fetch_array} returns the next row of data as an array with both numeric
 * and associative keys.<br />
 *
 * This is the default value.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_FETCH_BOTH = 3;
/**
 * Returns numerically indexed array.
 *
 * <br />{@link sqlsrv_fetch_array() sqlsrv_fetch_array} returns the next row of data as a numerically indexed
 * array.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_FETCH_NUMERIC = 1;
/**
 * Specifies that errors, warnings, and notices will be logged.
 *
 * <br />Used as the value for the LogSeverity setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SEVERITY_ALL = -1;
/**
 * Specifies that errors will be logged.
 *
 * <br />Used as the value for the LogSeverity setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SEVERITY_ERROR = 1;
/**
 * Specifies that notices will be logged.
 *
 * <br />Used as the value for the LogSeverity setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SEVERITY_NOTICE = 4;
/**
 * Specifies that warnings will be logged.
 *
 * <br />Used as the value for the LogSeverity setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SEVERITY_WARNING = 2;
/**
 * Turns on logging of all subsystems.
 *
 * <br />Used as the value for the LogSubsystems setting with
 * {@link sqlsrv_configure() sqlsrv_configure}.<br />
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SYSTEM_ALL = -1;
/**
 * Turns on logging of connection activity.
 *
 * <br />Used as the value for the LogSubsystems setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SYSTEM_CONN = 2;
/**
 * Turns on logging of initialization activity.
 *
 * <br />Used as the value for the LogSubsystems setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SYSTEM_INIT = 1;
/**
 * Turns logging off.
 *
 * <br />Used as the value for the LogSubsystems setting with  {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SYSTEM_OFF = 0;
/**
 * Turns on logging of statement activity.
 *
 * <br />Used as the value for the LogSubsystems setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SYSTEM_STMT = 4;
/**
 * Turns on logging of error functions activity (such as handle_error and handle_warning).
 *
 * <br />Used as the value for the
 * LogSubsystems setting with {@link sqlsrv_configure() sqlsrv_configure}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_LOG_SYSTEM_UTIL = 8;
/**
 * The column is not nullable.
 *
 * <br />You can compare the value of the Nullable key that is returned by
 * {@link sqlsrv_field_metadata() sqlsrv_field_metadata} to determine the column's nullable status.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_NULLABLE_NO = 0;
/**
 * It is not known if the column is nullable.
 *
 * <br />You can compare the value of the Nullable key that is returned by
 * {@link sqlsrv_field_metadata() sqlsrv_field_metadata} to determine the column's nullable status.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_NULLABLE_UNKNOWN = 2;
/**
 * The column is nullable.
 *
 * <br />You can compare the value of the Nullable key that is returned by
 * {@link sqlsrv_field_metadata() sqlsrv_field_metadata} to determine the column's nullable status.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_NULLABLE_YES = 1;
/**
 * Indicates an input parameter.
 *
 * <br />Used for specifying parameter direction when you call {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_PARAM_IN = 1;
/**
 * Indicates a bidirectional parameter.
 *
 * <br />Used for specifying parameter direction when you call {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_PARAM_INOUT = 2;
/**
 * Indicates an output parameter.
 *
 * <br />Used for specifying parameter direction when you call {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_PARAM_OUT = 4;
/**
 * Datetime
 *
 * <br />Used with {@link sqlsrv_prepare() sqlsrv_prepare},
 * {@link sqlsrv_query() sqlsrv_query}
 * and {@link sqlsrv_get_field() sqlsrv_get_field} to request a field be return as a specific PHP type.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_PHPTYPE_DATETIME = 4;
/**
 * Float
 *
 * <br />Used with {@link sqlsrv_prepare() sqlsrv_prepare},
 * {@link sqlsrv_query() sqlsrv_query}
 * and {@link sqlsrv_get_field() sqlsrv_get_field} to request a field be return as a specific PHP type.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_PHPTYPE_FLOAT = 3;
/**
 * Integer
 *
 * <br />Used with {@link sqlsrv_prepare() sqlsrv_prepare},
 * {@link sqlsrv_query() sqlsrv_query}
 * and {@link sqlsrv_get_field() sqlsrv_get_field} to request a field be return as a specific PHP type.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_PHPTYPE_INT = 2;
/**
 * Null
 *
 * <br />Used with {@link sqlsrv_prepare() sqlsrv_prepare},
 * {@link sqlsrv_query() sqlsrv_query}
 * and {@link sqlsrv_get_field() sqlsrv_get_field} to request a field be return as a specific PHP type.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_PHPTYPE_NULL = 1;
/**
 * Specifies the row specified with the offset parameter.
 *
 * <br />Used with {@link sqlsrv_fetch() sqlsrv_fetch},
 * {@link sqlsrv_fetch_array() sqlsrv_fetch_array},
 * or {@link sqlsrv_fetch_object() sqlsrv_fetch_object} to specify a row.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify which row to select in the result set. For
 * information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SCROLL_ABSOLUTE = 5;
/**
 * Specifies the first row in the result set.
 *
 * <br />Used with {@link sqlsrv_fetch() sqlsrv_fetch},
 * {@link sqlsrv_fetch_array() sqlsrv_fetch_array},
 * or {@link sqlsrv_fetch_object() sqlsrv_fetch_object} to specify a row.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify which row to select in the result set. For
 * information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SCROLL_FIRST = 2;
/**
 * Specifies the last row in the result set.
 *
 * <br />Used with {@link sqlsrv_fetch() sqlsrv_fetch},
 * {@link sqlsrv_fetch_array() sqlsrv_fetch_array},
 * or {@link sqlsrv_fetch_object() sqlsrv_fetch_object} to specify a row.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify which row to select in the result set. For
 * information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SCROLL_LAST = 3;
/**
 * Specifies the next row.
 *
 * <br />This is the default value, if you do not specify the row parameter for a scrollable result set.<br />
 *
 * Used with {@link sqlsrv_fetch() sqlsrv_fetch},
 * {@link sqlsrv_fetch_array() sqlsrv_fetch_array},
 * or {@link sqlsrv_fetch_object() sqlsrv_fetch_object} to specify a row.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify which row to select in the result set. For
 * information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SCROLL_NEXT = 1;
/**
 * Specifies the row before the current row.
 *
 * <br />Used with {@link sqlsrv_fetch() sqlsrv_fetch},
 * {@link sqlsrv_fetch_array() sqlsrv_fetch_array},
 * or {@link sqlsrv_fetch_object() sqlsrv_fetch_object} to specify a row.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify which row to select in the result set. For
 * information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SCROLL_PRIOR = 4;
/**
 * Specifies the row specified with the offset parameter from the current row.
 *
 * <br />Used with {@link sqlsrv_fetch() sqlsrv_fetch},
 * {@link sqlsrv_fetch_array() sqlsrv_fetch_array},
 * or {@link sqlsrv_fetch_object() sqlsrv_fetch_object} to specify a row.<br />
 *
 * Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify which row to select in the result set. For
 * information on using these constants, see
 * {@link http://msdn.microsoft.com/en-us/library/ee376927.aspx Specifying a Cursor Type and Selecting Rows}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SCROLL_RELATIVE = 6;
/**
 * bigint.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_BIGINT = -5;
/**
 * bit.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_BIT = -7;
/**
 * date.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_DATE = 5211;
/**
 * datetime.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_DATETIME = 25177693;
/**
 * datetime2.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_DATETIME2 = 58734173;
/**
 * datetimeoffset.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_DATETIMEOFFSET = 58738021;
/**
 * float.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_FLOAT = 6;
/**
 * image.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_IMAGE = -4;
/**
 * int.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_INT = 4;
/**
 * money.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_MONEY = 33564163;
/**
 * ntext.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_NTEXT = -10;
/**
 * real.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_REAL = 7;
/**
 * smalldatetime.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_SMALLDATETIME = 8285;
/**
 * smallint.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_SMALLINT = 5;
/**
 * smallmoney.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_SMALLMONEY = 33559555;
/**
 * text.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_TEXT = -1;
/**
 * time.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_TIME = 58728806;
/**
 * timestamp.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_TIMESTAMP = 4606;
/**
 * tinyint.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_TINYINT = -6;
/**
 * udt.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_UDT = -151;
/**
 * uniqueidentifier.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_UNIQUEIDENTIFIER = -11;
/**
 * xml.
 *
 * <br />Used when calling {@link sqlsrv_query() sqlsrv_query} or
 *{@link sqlsrv_prepare() sqlsrv_prepare} to specify the SQL Server data type of a parameter.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_SQLTYPE_XML = -152;
/**
 * Read Committed.
 *
 * <br />Specifies that statements cannot read data that has been modified but not committed by other transactions.
 * This prevents dirty reads. Data can be changed by other transactions between individual statements within the
 * current
 * transaction, resulting in nonrepeatable reads or phantom data. This option is the SQL Server default.<br />
 *
 * The behavior of READ COMMITTED depends on the setting of the READ_COMMITTED_SNAPSHOT database option.<br />
 *
 * Used with the TransactionIsolation key when calling {@link sqlsrv_connect() sqlsrv_connect}. For information on
 * using
 * these constants, see {@link http://msdn.microsoft.com/en-us/library/ms173763(v=sql.110).aspx SET TRANSACTION
 * ISOLATION LEVEL (Transact-SQL)}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_TXN_READ_COMMITTED = 2;
/**
 * Read Uncommitted.
 *
 * <br />Specifies that statements can read rows that have been modified by other transactions but not yet
 * committed.<br />
 *
 * Transactions running at the READ UNCOMMITTED level do not issue shared locks to prevent other transactions from
 * modifying data read by the current transaction. READ UNCOMMITTED transactions are also not blocked by exclusive
 * locks
 * that would prevent the current transaction from reading rows that have been modified but not committed by other
 * transactions. When this option is set, it is possible to read uncommitted modifications, which are called dirty
 * reads. Values in the data can be changed and rows can appear or disappear in the data set before the end of the
 * transaction. This option has the same effect as setting NOLOCK on all tables in all SELECT statements in a
 * transaction. This is the least restrictive of the isolation levels.<br />
 *
 * Used with the TransactionIsolation key when calling {@link sqlsrv_connect() sqlsrv_connect}. For information on
 * using
 * these constants, see {@link http://msdn.microsoft.com/en-us/library/ms173763(v=sql.110).aspx SET TRANSACTION
 * ISOLATION LEVEL (Transact-SQL)}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_TXN_READ_UNCOMMITTED = 1;
/**
 * Repeatable Read.
 *
 * <br />Specifies that statements cannot read data that has been modified but not yet committed by other
 * transactions and that no other transactions can modify data that has been read by the current transaction until
 * the current transaction completes.<br />
 *
 * Shared locks are placed on all data read by each statement in the transaction and are held until the transaction
 * completes. This prevents other transactions from modifying any rows that have been read by the current
 * transaction. Other transactions can insert new rows that match the search conditions of statements issued by the
 * current transaction. If the current transaction then retries the statement it will retrieve the new rows, which
 * results in phantom reads. Because shared locks are held to the end of a transaction instead of being released at
 * the end of each statement, concurrency is lower than the default READ COMMITTED isolation level.<br />
 *
 * Use this option only when necessary.<br />
 *
 * Used with the TransactionIsolation key when calling {@link sqlsrv_connect() sqlsrv_connect}. For information on
 * using
 * these constants, see {@link http://msdn.microsoft.com/en-us/library/ms173763(v=sql.110).aspx SET TRANSACTION
 * ISOLATION LEVEL (Transact-SQL)}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_TXN_REPEATABLE_READ = 4;
/**
 * Serializable.
 *
 * <br />Specifies the following:
 * <ul><li>Statements cannot read data that has been modified but not yet committed by other transactions.</li>
 * <li>No other transactions can modify data that has been read by the current transaction until the current
 * transaction completes.</li>
 * <li>Other transactions cannot insert new rows with key values that would fall in the range of keys read by any
 * statements in the current transaction until the current transaction completes.</li></ul>
 *
 * Range locks are placed in the range of key values that match the search conditions of each statement executed in
 * a transaction. This blocks other transactions from updating or inserting any rows that would qualify for any of
 * the statements executed by the current transaction. This means that if any of the statements in a transaction
 * are executed a second time, they will read the same set of rows. The range locks are held until the transaction
 * completes. This is the most restrictive of the isolation levels because it locks entire ranges of keys and holds
 * the locks until the transaction completes. Because concurrency is lower, use this option only when necessary.
 * This option has the same effect as setting HOLDLOCK on all tables in all SELECT statements in a transaction.<br
 * />
 *
 * Used with the TransactionIsolation key when calling {@link sqlsrv_connect() sqlsrv_connect}. For information on
 * using
 * these constants, see {@link http://msdn.microsoft.com/en-us/library/ms173763(v=sql.110).aspx SET TRANSACTION
 * ISOLATION LEVEL (Transact-SQL)}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_TXN_SERIALIZABLE = 8;
/**
 * Snapshot.
 *
 * <br />Specifies that data read by any statement in a transaction will be the transactionally consistent version
 * of the data that existed at the start of the transaction. The transaction can only recognize data modifications
 * that were committed before the start of the transaction. Data modifications made by other transactions after the
 * start of the current transaction are not visible to statements executing in the current transaction. The effect
 * is as if the statements in a transaction get a snapshot of the committed data as it existed at the start of the
 * transaction.<br
 * />
 *
 * Except when a database is being recovered, SNAPSHOT transactions do not request locks when reading data.
 * SNAPSHOT
 * transactions reading data do not block other transactions from writing data. Transactions writing data do not
 * block SNAPSHOT transactions from reading data.<br />
 *
 * During the roll-back phase of a database recovery, SNAPSHOT transactions will request a lock if an attempt is
 * made to read data that is locked by another transaction that is being rolled back. The SNAPSHOT transaction is
 * blocked until that transaction has been rolled back. The lock is released immediately after it has been
 * granted.<br />
 *
 * The ALLOW_SNAPSHOT_ISOLATION database option must be set to ON before you can start a transaction that uses the
 * SNAPSHOT isolation level. If a transaction using the SNAPSHOT isolation level accesses data in multiple
 * databases, ALLOW_SNAPSHOT_ISOLATION must be set to ON in each database.<br />
 *
 * A transaction cannot be set to SNAPSHOT isolation level that started with another isolation level; doing so will
 * cause the transaction to abort. If a transaction starts in the SNAPSHOT isolation level, you can change it to
 * another
 * isolation level and then back to SNAPSHOT. A transaction starts the first time it accesses data.<br />
 *
 * A transaction running under SNAPSHOT isolation level can view changes made by that transaction. For example, if
 * the transaction performs an UPDATE on a table and then issues a SELECT statement against the same table, the
 * modified data will be included in the result set.<br />
 *
 * Used with the TransactionIsolation key when calling {@link sqlsrv_connect() sqlsrv_connect}. For information on
 * using
 * these constants, see {@link http://msdn.microsoft.com/en-us/library/ms173763(v=sql.110).aspx SET TRANSACTION
 * ISOLATION LEVEL (Transact-SQL)}.<br />
 *
 * Additional Information at {@link http://msdn.microsoft.com/en-us/library/cc296152.aspx SQLSRV Driver API
 * Reference}<br />
 *
 * @link http://msdn.microsoft.com/en-us/library/cc296183.aspx
 */
const SQLSRV_TXN_SNAPSHOT = 32;
