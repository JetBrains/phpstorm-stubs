<?php
/**
 * PHPStorm stub file for CUBRID Constants.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */

/**
 * Columns are returned into the array having the fieldname as the array
 * index.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_ASSOC = 2;
/**
 * Execute the query in asynchronous mode.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_ASYNC = 2;
/**
 * Disable the auto-commit mode.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_AUTOCOMMIT_FALSE = 0;
/**
 * Enable the auto-commit mode.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_AUTOCOMMIT_TRUE = 1;
/**
 * Columns are returned into the array having both a numerical index
 * and the fieldname as the array index.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_BOTH = 3;
/**
 * Move current cursor as a default value if the origin is
 * not specified.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_CURSOR_CURRENT = 1;
/**
 * Returned value of cubrid_move_cursor() function in case
 * of failure.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_CURSOR_ERROR = -1;
/**
 * Move current cursor to the first position in the result.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_CURSOR_FIRST = 0;
/**
 * Move current cursor to the last position in the result.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_CURSOR_LAST = 2;
/**
 * Returned value of cubrid_move_cursor() function
 * in case of success.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_CURSOR_SUCCESS = 1;
/**
 * Execute the query in synchronous mode.
 * This flag must be set when executing multiple SQL statements.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_EXEC_QUERY_ALL = 4;
/**
 * Determine whether to get OID during query execution.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_INCLUDE_OID = 1;
/**
 * Returned value of cubrid_move_cursor() function in case
 * of failure.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_NO_MORE_DATA = 0;
/**
 * Columns are returned into the array having a numerical index to the
 * fields. This index starts with 0, the first field in the result.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_NUM = 1;
/**
 * Get query result as an object.
 *
 * @link http://php.net/manual/en/cubrid.constants.php
 */
const CUBRID_OBJECT = 4;
