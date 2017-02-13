<?php
/**
 * PHPStorm stub file for MySQL Improved Extension(MySQLi) constants.
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */

/**
 * <p>
 * Columns are returned into the array having the fieldname as the array index.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_ASSOC = 1;
const MYSQLI_ASYNC = 8;
/**
 * <p>
 * Field is defined as AUTO_INCREMENT
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_AUTO_INCREMENT_FLAG = 512;
const MYSQLI_BINARY_FLAG = 128;
/**
 * <p>
 * Field is defined as BLOB
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_BLOB_FLAG = 16;
/**
 * <p>
 * Columns are returned into the array having both a numerical index and the fieldname as the associative index.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_BOTH = 3;
/**
 * <p>
 * Use compression protocol
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CLIENT_COMPRESS = 32;
const MYSQLI_CLIENT_FOUND_ROWS = 2;
/**
 * <p>
 * Allow spaces after function names. Makes all functions names reserved words.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CLIENT_IGNORE_SPACE = 256;
/**
 * <p>
 * Allow interactive_timeout seconds
 * (instead of wait_timeout seconds) of inactivity before
 * closing the connection. The client's session
 * wait_timeout variable will be set to
 * the value of the session interactive_timeout variable.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CLIENT_INTERACTIVE = 1024;
/**
 * <p>
 * Don't allow the db_name.tbl_name.col_name syntax.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CLIENT_NO_SCHEMA = 16;
/**
 * <p>
 * Use SSL (encrypted protocol). This option should not be set by application programs;
 * it is set internally in the MySQL client library
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CLIENT_SSL = 2048;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CURSOR_TYPE_FOR_UPDATE = 2;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CURSOR_TYPE_NO_CURSOR = 0;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CURSOR_TYPE_READ_ONLY = 1;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_CURSOR_TYPE_SCROLLABLE = 4;
/**
 * <p>
 * Data truncation occurred. Available since PHP 5.1.0 and MySQL 5.0.5.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_DATA_TRUNCATED = 101;
/**
 * <p>
 * Is set to 1 if <b>mysqli_debug</b> functionality is enabled.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_DEBUG_TRACE_ENABLED = 1;
/**
 * <p>
 * Field is defined as ENUM. Available since PHP 5.3.0.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_ENUM_FLAG = 256;
/**
 * <p>
 * Field is part of GROUP BY
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_GROUP_FLAG = 32768;
/**
 * <p>
 * Command to execute when connecting to MySQL server. Will automatically be re-executed when reconnecting.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_INIT_COMMAND = 3;
/**
 * <p>
 * Field is part of an index.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_MULTIPLE_KEY_FLAG = 8;
/**
 * <p>
 * Indicates that a field is defined as NOT NULL
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_NOT_NULL_FLAG = 1;
/**
 * <p>
 * No more data available for bind variable
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_NO_DATA = 100;
const MYSQLI_NO_DEFAULT_VALUE_FLAG = 4096;
/**
 * <p>
 * Columns are returned into the array having an enumerated index.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_NUM = 2;
/**
 * <p>
 * Field is defined as NUMERIC
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_NUM_FLAG = 32768;
const MYSQLI_ON_UPDATE_NOW_FLAG = 8192;
/**
 * <p>
 * Connect timeout in seconds
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_OPT_CONNECT_TIMEOUT = 0;
const MYSQLI_OPT_INT_AND_FLOAT_NATIVE = 201;
/**
 * <p>
 * Enables command LOAD LOCAL INFILE
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_OPT_LOCAL_INFILE = 8;
const MYSQLI_OPT_NET_CMD_BUFFER_SIZE = 202;
const MYSQLI_OPT_NET_READ_BUFFER_SIZE = 203;
/** @link http://php.net/manual/en/mysqli.constants.php */
const MYSQLI_OPT_SSL_VERIFY_SERVER_CERT = 21;
/**
 * <p>
 * Field is part of an multi-index
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_PART_KEY_FLAG = 16384;
/**
 * <p>
 * Field is part of a primary index
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_PRI_KEY_FLAG = 2;
/**
 * <p>
 * Read options from the named option file instead of from my.cnf
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_READ_DEFAULT_FILE = 4;
/**
 * <p>
 * Read options from the named group from my.cnf
 * or the file specified with <b>MYSQLI_READ_DEFAULT_FILE</b>
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_READ_DEFAULT_GROUP = 5;
const MYSQLI_REFRESH_BACKUP_LOG = 2097152;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_GRANT = 1;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_HOSTS = 8;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_LOG = 2;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_MASTER = 128;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_SLAVE = 64;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_STATUS = 16;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_TABLES = 4;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REFRESH_THREADS = 32;
/**
 * <p>
 * Set all options on (report all).
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REPORT_ALL = 255;
/**
 * <p>
 * Report errors from mysqli function calls.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REPORT_ERROR = 1;
/**
 * <p>
 * Report if no index or bad index was used in a query.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REPORT_INDEX = 4;
/**
 * <p>
 * Turns reporting off.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REPORT_OFF = 0;
/**
 * <p>
 * Throw a mysqli_sql_exception for errors instead of warnings.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_REPORT_STRICT = 2;
/** @link http://php.net/manual/en/mysqli.constants.php */
const MYSQLI_SERVER_PS_OUT_PARAMS = 4096;
/**
 * <p>
 * RSA public key file used with the SHA-256 based authentication.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_SERVER_PUBLIC_KEY = 27;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_SERVER_QUERY_NO_GOOD_INDEX_USED = 16;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_SERVER_QUERY_NO_INDEX_USED = 32;
const MYSQLI_SERVER_QUERY_WAS_SLOW = 1024;
/** @link http://php.net/manual/en/mysqli.constants.php */
const MYSQLI_SET_CHARSET_DIR = 6;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_SET_CHARSET_NAME = 7;
/**
 * <p>
 * Field is defined as SET
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_SET_FLAG = 2048;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_STMT_ATTR_CURSOR_TYPE = 1;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_STMT_ATTR_PREFETCH_ROWS = 2;
/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH = 0;
/**
 * <p>
 * For using buffered resultsets
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_STORE_RESULT = 0;
/**
 * <p>
 * Field is defined as TIMESTAMP
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TIMESTAMP_FLAG = 1024;
/**
 * <p>
 * Field is defined as BIT (MySQL 5.0.3 and up)
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_BIT = 16;
/**
 * <p>
 * Field is defined as BLOB
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_BLOB = 252;
/**
 * <p>
 * Field is defined as CHAR
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_CHAR = 1;
/**
 * <p>
 * Field is defined as DATE
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_DATE = 10;
/**
 * <p>
 * Field is defined as DATETIME
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_DATETIME = 12;
/**
 * <p>
 * Field is defined as DECIMAL
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_DECIMAL = 0;
/**
 * <p>
 * Field is defined as DOUBLE
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_DOUBLE = 5;
/**
 * <p>
 * Field is defined as ENUM
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_ENUM = 247;
/**
 * <p>
 * Field is defined as FLOAT
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_FLOAT = 4;
/**
 * <p>
 * Field is defined as GEOMETRY
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_GEOMETRY = 255;
/**
 * <p>
 * Field is defined as MEDIUMINT
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_INT24 = 9;
/**
 * <p>
 * Field is defined as INTERVAL
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_INTERVAL = 247;
/**
 * <p>
 * Field is defined as INT
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_LONG = 3;
/**
 * <p>
 * Field is defined as BIGINT
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_LONGLONG = 8;
/**
 * <p>
 * Field is defined as LONGBLOB
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_LONG_BLOB = 251;
/**
 * <p>
 * Field is defined as MEDIUMBLOB
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_MEDIUM_BLOB = 250;
/**
 * <p>
 * Field is defined as DATE
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_NEWDATE = 14;
/**
 * <p>
 * Precision math DECIMAL or NUMERIC field (MySQL 5.0.3 and up)
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_NEWDECIMAL = 246;
/**
 * <p>
 * Field is defined as DEFAULT NULL
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_NULL = 6;
/**
 * <p>
 * Field is defined as SET
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_SET = 248;
/**
 * <p>
 * Field is defined as SMALLINT
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_SHORT = 2;
/**
 * <p>
 * Field is defined as STRING
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_STRING = 254;
/**
 * <p>
 * Field is defined as TIME
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_TIME = 11;
/**
 * <p>
 * Field is defined as TIMESTAMP
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_TIMESTAMP = 7;
/**
 * <p>
 * Field is defined as TINYINT
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_TINY = 1;
/**
 * <p>
 * Field is defined as TINYBLOB
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_TINY_BLOB = 249;
/**
 * <p>
 * Field is defined as VARCHAR
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_VAR_STRING = 253;
/**
 * <p>
 * Field is defined as YEAR
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_TYPE_YEAR = 13;
/**
 * <p>
 * Field is part of a unique index.
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_UNIQUE_KEY_FLAG = 4;
/**
 * <p>
 * Field is defined as UNSIGNED
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_UNSIGNED_FLAG = 32;
/**
 * <p>
 * For using unbuffered resultsets
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_USE_RESULT = 1;
/**
 * <p>
 * Field is defined as ZEROFILL
 * </p>
 *
 * @link http://php.net/manual/en/mysqli.constants.php
 */
const MYSQLI_ZEROFILL_FLAG = 64;
