<?php
/**
 * PHPStorm stub file for Oracle OCI8 constants.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */

/**
 * Used with {@see oci_fetch_all} and
 * {@see oci_fetch_array} to get results as an associative
 * array.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_ASSOC = 1;
/**
 * Used with {@see oci_fetch_all} and
 * {@see oci_fetch_array} to get results as an
 * array with both associative and number indices.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_BOTH = 3;
/**
 * Used with {@see oci_bind_by_name} when binding
 * BFILEs.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_BFILE = 114;
/**
 * Used with {@see oci_bind_by_name} to bind RAW values.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_BIN = 23;
/**
 * Used with {@see oci_bind_by_name} when
 * binding BLOBs.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_BLOB = 113;
/**
 * (PECL OCI8 &gt;= 2.0.7)<br/>
 * Used with {@see oci_bind_by_name} when
 * binding PL/SQL BOOLEAN.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_BOL = 252;
/**
 * Used with {@see oci_bind_by_name} when binding
 * CFILEs.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_CFILEE = 115;
/**
 * Used with {@see oci_bind_by_name} when binding
 * CLOBs.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_CLOB = 112;
/**
 * Used with {@see oci_bind_by_name} when binding
 * cursors, previously allocated
 * with {@see oci_new_descriptor}.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_CURSOR = 116;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * INTEGER.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_INT = 3;
/**
 * Used with {@see oci_bind_by_name} when binding
 * named data types. Note: in PHP &lt; 5.0 it was called
 * <b>OCI_B_SQLT_NTY</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_NTY = 108;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * NUMBER.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_NUM = 2;
/**
 * Used with {@see oci_bind_by_name} when binding
 * ROWIDs.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_B_ROWID = 104;
/**
 * Statement execution mode for {@see oci_execute}
 * call. Automatically commit changes when the statement has
 * succeeded.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_COMMIT_ON_SUCCESS = 32;
/**
 * Used with {@see oci_connect} for using
 * Oracles' External or OS authentication. Introduced in PHP
 * 5.3 and PECL OCI8 1.3.4.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_CRED_EXT = -2147483648;
/**
 * See <b>OCI_NO_AUTO_COMMIT</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_DEFAULT = 0;
/**
 * Statement execution mode
 * for {@see oci_execute}. Use this mode if you
 * want meta data such as the column names but don't want to
 * fetch rows from the query.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_DESCRIBE_ONLY = 16;
/**
 * This flag tells {@see oci_new_descriptor} to
 * initialize a new FILE descriptor.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_DTYPE_FILE = 56;
/**
 * This flag tells {@see oci_new_descriptor} to
 * initialize a new LOB descriptor.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_DTYPE_LOB = 50;
/**
 * This flag tells {@see oci_new_descriptor} to
 * initialize a new ROWID descriptor.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_DTYPE_ROWID = 54;
/**
 * The same as <b>OCI_DTYPE_FILE</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_D_FILE = 56;
/**
 * The same as <b>OCI_DTYPE_LOB</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_D_LOB = 50;
/**
 * The same as <b>OCI_DTYPE_ROWID</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_D_ROWID = 54;
/**
 * Obsolete. Statement fetch mode. Used when the application
 * knows in advance exactly how many rows it will be fetching.
 * This mode turns prefetching off for Oracle release 8 or
 * later mode. The cursor is canceled after the desired rows
 * are fetched which may result in reduced server-side
 * resource usage.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_EXACT_FETCH = 2;
/**
 * Default mode of {@see oci_fetch_all}.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_FETCHSTATEMENT_BY_COLUMN = 16;
/**
 * Alternative mode of {@see oci_fetch_all}.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_FETCHSTATEMENT_BY_ROW = 32;
/**
 * Used with to free
 * buffers used.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_LOB_BUFFER_FREE = 1;
/**
 * Statement execution mode
 * for {@see oci_execute}. The transaction is not
 * automatically committed when using this mode. For
 * readability in new code, use this value instead of the
 * older, equivalent <b>OCI_DEFAULT</b> constant.
 * Introduced in PHP 5.3.2 (PECL OCI8 1.4).
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_NO_AUTO_COMMIT = 0;
/**
 * Used with {@see oci_fetch_all} and
 * {@see oci_fetch_array} to get results as an
 * enumerated array.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_NUM = 2;
/**
 * Used with {@see oci_fetch_array} to get the
 * data value of the LOB instead of the descriptor.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_RETURN_LOBS = 8;
/**
 * Used with {@see oci_fetch_array} to get empty
 * array elements if the row items value is <b>NULL</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_RETURN_NULLS = 4;
/**
 * Used with to set the seek position.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_SEEK_CUR = 1;
/**
 * Used with to set the seek position.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_SEEK_END = 2;
/**
 * Used with to set the seek position.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_SEEK_SET = 0;
/**
 * Obsolete.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_SYSDATE = 'SYSDATE';
/**
 * Used with {@see oci_connect} to connect with
 * the SYSDBA privilege. The <i>php.ini</i> setting
 * oci8.privileged_connect
 * should be enabled to use this.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_SYSDBA = 2;
/**
 * Used with {@see oci_connect} to connect with
 * the SYSOPER privilege. The <i>php.ini</i> setting
 * oci8.privileged_connect
 * should be enabled to use this.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_SYSOPER = 4;
/**
 * Used with
 * to indicate that a temporary BLOB should be created.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_TEMP_BLOB = 1;
/**
 * Used with
 * to indicate that a temporary CLOB should be created.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const OCI_TEMP_CLOB = 2;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * CHAR.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_AFC = 96;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * VARCHAR2.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_AVC = 97;
/**
 * Not supported.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_BDOUBLE = 22;
/**
 * The same as <b>OCI_B_BFILE</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_BFILEE = 114;
/**
 * Not supported.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_BFLOAT = 21;
/**
 * The same as <b>OCI_B_BIN</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_BIN = 23;
/**
 * The same as <b>OCI_B_BLOB</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_BLOB = 113;
/**
 * (PECL OCI8 &gt;= 2.0.7)<br/>
 * The same as <b>OCI_B_BOL</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_BOL = 252;
/**
 * The same as <b>OCI_B_CFILEE</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_CFILEE = 115;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * VARCHAR2.
 * Also used with {@see oci_bind_by_name}.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_CHR = 1;
/**
 * The same as <b>OCI_B_CLOB</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_CLOB = 112;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * FLOAT.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_FLT = 4;
/**
 * The same as <b>OCI_B_INT</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_INT = 3;
/**
 * Used with {@see oci_bind_by_name} to bind LONG RAW values.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_LBI = 24;
/**
 * Used with {@see oci_bind_by_name} to bind LONG values.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_LNG = 8;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * LONG VARCHAR.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_LVC = 94;
/**
 * The same as <b>OCI_B_NTY</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_NTY = 108;
/**
 * The same as <b>OCI_B_NUM</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_NUM = 2;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * LONG.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_ODT = 156;
/**
 * The same as <b>OCI_B_ROWID</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_RDD = 104;
/**
 * The same as <b>OCI_B_CURSOR</b>.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_RSET = 116;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * STRING.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_STR = 5;
/**
 * Not supported.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_UIN = 68;
/**
 * Used with {@see oci_bind_array_by_name} to bind arrays of
 * VARCHAR.
 *
 * @link http://php.net/manual/en/oci8.constants.php
 */
const SQLT_VCS = 9;
