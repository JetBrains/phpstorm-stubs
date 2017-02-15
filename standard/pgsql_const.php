<?php
/**
 * PHPStorm stub file for PostgreSQL constants.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */

/**
 * Passed to <b>pg_fetch_array</b>. Return an associative array of field
 * names and values.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_ASSOC = 1;
/**
 * Returned by <b>pg_result_status</b>. The server's response
 * was not understood.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_BAD_RESPONSE = 5;
/**
 * Passed to <b>pg_fetch_array</b>. Return an array of field values
 * that is both numerically indexed (by field number) and associated (by field name).
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_BOTH = 3;
/**
 * Returned by <b>pg_result_status</b>. Successful completion of a
 * command returning no data.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_COMMAND_OK = 1;
const PGSQL_CONNECTION_AUTH_OK = 5;
const PGSQL_CONNECTION_AWAITING_RESPONSE = 4;
/**
 * Returned by <b>pg_connection_status</b> indicating that the database
 * connection is in an invalid state.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_CONNECTION_BAD = 1;
const PGSQL_CONNECTION_MADE = 3;
/**
 * Returned by <b>pg_connection_status</b> indicating that the database
 * connection is in a valid state.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_CONNECTION_OK = 0;
const PGSQL_CONNECTION_SETENV = 6;
const PGSQL_CONNECTION_STARTED = 2;
const PGSQL_CONNECT_ASYNC = 4;
/**
 * Passed to <b>pg_connect</b> to force the creation of a new connection,
 * rather than re-using an existing identical connection.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_CONNECT_FORCE_NEW = 2;
/**
 * Passed to <b>pg_convert</b>.
 * Use SQL NULL in place of an empty string.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_CONV_FORCE_NULL = 4;
/**
 * Passed to <b>pg_convert</b>.
 * Ignore default values in the table during conversion.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_CONV_IGNORE_DEFAULT = 2;
/**
 * Passed to <b>pg_convert</b>.
 * Ignore conversion of <b>NULL</b> into SQL NOT NULL columns.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_CONV_IGNORE_NOT_NULL = 8;
/**
 * Returned by <b>pg_result_status</b>. Copy In (to server) data
 * transfer started.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_COPY_IN = 4;
/**
 * Returned by <b>pg_result_status</b>. Copy Out (from server) data
 * transfer started.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_COPY_OUT = 3;
/**
 * Passed to <b>pg_result_error_field</b>.
 * An indication of the context in which the error occurred. Presently
 * this includes a call stack traceback of active procedural language
 * functions and internally-generated queries. The trace is one entry
 * per line, most recent first.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_CONTEXT = 87;
/**
 * Passed to <b>pg_result_error_field</b>.
 * This is defined the same as the <b>PG_DIAG_STATEMENT_POSITION</b> field, but
 * it is used when the cursor position refers to an internally generated
 * command rather than the one submitted by the client. The
 * <b>PG_DIAG_INTERNAL_QUERY</b> field will always appear when this
 * field appears.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_INTERNAL_POSITION = 112;
/**
 * Passed to <b>pg_result_error_field</b>.
 * The text of a failed internally-generated command. This could be, for example, a
 * SQL query issued by a PL/pgSQL function.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_INTERNAL_QUERY = 113;
/**
 * Passed to <b>pg_result_error_field</b>.
 * Detail: an optional secondary error message carrying more detail about the problem. May run to multiple lines.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_MESSAGE_DETAIL = 68;
/**
 * Passed to <b>pg_result_error_field</b>.
 * Hint: an optional suggestion what to do about the problem. This is intended to differ from detail in that it
 * offers advice (potentially inappropriate) rather than hard facts. May run to multiple lines.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_MESSAGE_HINT = 72;
/**
 * Passed to <b>pg_result_error_field</b>.
 * The primary human-readable error message (typically one line). Always present.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_MESSAGE_PRIMARY = 77;
/**
 * Passed to <b>pg_result_error_field</b>.
 * The severity; the field contents are ERROR,
 * FATAL, or PANIC (in an error message), or
 * WARNING, NOTICE, DEBUG,
 * INFO, or LOG (in a notice message), or a localized
 * translation of one of these. Always present.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_SEVERITY = 83;
/**
 * Passed to <b>pg_result_error_field</b>.
 * The file name of the PostgreSQL source-code location where the error
 * was reported.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_SOURCE_FILE = 70;
/**
 * Passed to <b>pg_result_error_field</b>.
 * The name of the PostgreSQL source-code function reporting the error.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_SOURCE_FUNCTION = 82;
/**
 * Passed to <b>pg_result_error_field</b>.
 * The line number of the PostgreSQL source-code location where the
 * error was reported.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_SOURCE_LINE = 76;
/**
 * Passed to <b>pg_result_error_field</b>.
 * The SQLSTATE code for the error. The SQLSTATE code identifies the type of error
 * that has occurred; it can be used by front-end applications to perform specific
 * operations (such as error handling) in response to a particular database error.
 * This field is not localizable, and is always present.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_SQLSTATE = 67;
/**
 * Passed to <b>pg_result_error_field</b>.
 * A string containing a decimal integer indicating an error cursor position as an index into the original
 * statement string. The first character has index 1, and positions are measured in characters not bytes.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_DIAG_STATEMENT_POSITION = 80;
const PGSQL_DML_ASYNC = 1024;
const PGSQL_DML_ESCAPE = 4096;
const PGSQL_DML_EXEC = 512;
const PGSQL_DML_NO_CONV = 256;
const PGSQL_DML_STRING = 2048;
/**
 * Returned by <b>pg_result_status</b>. The string sent to the server
 * was empty.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_EMPTY_QUERY = 0;
/**
 * Passed to <b>pg_set_error_verbosity</b>.
 * The default mode produces messages that include the above
 * plus any detail, hint, or context fields (these may span
 * multiple lines).
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_ERRORS_DEFAULT = 1;
/**
 * Passed to <b>pg_set_error_verbosity</b>.
 * Specified that returned messages include severity, primary text,
 * and position only; this will normally fit on a single line.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_ERRORS_TERSE = 0;
/**
 * Passed to <b>pg_set_error_verbosity</b>.
 * The verbose mode includes all available fields.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_ERRORS_VERBOSE = 2;
/**
 * Returned by <b>pg_result_status</b>. A fatal error
 * occurred.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_FATAL_ERROR = 7;
const PGSQL_LIBPQ_VERSION = '9.1.10';
const PGSQL_LIBPQ_VERSION_STR = 'PostgreSQL 9.1.10 on x86_64-unknown-linux-gnu, compiled by gcc (Ubuntu/Linaro 4.8.1-10ubuntu7) 4.8.1, 64-bit';
/**
 * Returned by <b>pg_result_status</b>. A nonfatal error
 * (a notice or warning) occurred.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_NONFATAL_ERROR = 6;
/**
 * @link  http://php.net/manual/en/function.pg-last-notice.php
 * @since 7.1
 */
const PGSQL_NOTICE_ALL = 2;
/**
 * @link  http://php.net/manual/en/function.pg-last-notice.php
 * @since 7.1
 */
const PGSQL_NOTICE_CLEAR = 3;
/**
 * @link  http://php.net/manual/en/function.pg-last-notice.php
 * @since 7.1
 */
const PGSQL_NOTICE_LAST = 1;
/**
 * Passed to <b>pg_fetch_array</b>. Return a numerically indexed array of field
 * numbers and values.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_NUM = 2;
const PGSQL_POLLING_ACTIVE = 4;
const PGSQL_POLLING_FAILED = 0;
const PGSQL_POLLING_OK = 3;
const PGSQL_POLLING_READING = 1;
const PGSQL_POLLING_WRITING = 2;
/**
 * Passed to <b>pg_lo_seek</b>. Seek operation is to begin
 * from the current position.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_SEEK_CUR = 1;
/**
 * Passed to <b>pg_lo_seek</b>. Seek operation is to begin
 * from the end of the object.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_SEEK_END = 2;
/**
 * Passed to <b>pg_lo_seek</b>. Seek operation is to begin
 * from the start of the object.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_SEEK_SET = 0;
/**
 * Passed to <b>pg_result_status</b>. Indicates that
 * numerical result code is desired.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_STATUS_LONG = 1;
/**
 * Passed to <b>pg_result_status</b>. Indicates that
 * textual result command tag is desired.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_STATUS_STRING = 2;
/**
 * Returned by <b>pg_transaction_status</b>. A command
 * is in progress on the connection. A query has been sent via the connection
 * and not yet completed.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_TRANSACTION_ACTIVE = 1;
/**
 * Returned by <b>pg_transaction_status</b>. Connection is
 * currently idle, not in a transaction.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_TRANSACTION_IDLE = 0;
/**
 * Returned by <b>pg_transaction_status</b>. The connection
 * is idle, in a failed transaction block.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_TRANSACTION_INERROR = 3;
/**
 * Returned by <b>pg_transaction_status</b>. The connection
 * is idle, in a transaction block.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_TRANSACTION_INTRANS = 2;
/**
 * Returned by <b>pg_transaction_status</b>. The connection
 * is bad.
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_TRANSACTION_UNKNOWN = 4;
/**
 * Returned by <b>pg_result_status</b>. Successful completion of a command
 * returning data (such as a SELECT or SHOW).
 *
 * @link http://php.net/manual/en/pgsql.constants.php
 */
const PGSQL_TUPLES_OK = 2;
