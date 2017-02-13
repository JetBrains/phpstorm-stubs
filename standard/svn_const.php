<?php
/**
 * PHPStorm stub file for SVN constants.
 *
 * @link http://php.net/manual/en/svn.constants.php
 */

/**
 * Custom property for ignoring SSL cert verification errors
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const PHP_SVN_AUTH_PARAM_IGNORE_SSL_VERIFY_ERRORS = 'php:svn:auth:ignore-ssl-verify-errors';
const SVN_ALL = 16;
const SVN_AUTH_PARAM_CONFIG = 'svn:auth:config-category-servers';
const SVN_AUTH_PARAM_CONFIG_DIR = 'svn:auth:config-dir';
/**
 * Property for default password to use when performing basic authentication
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_AUTH_PARAM_DEFAULT_PASSWORD = 'svn:auth:password';
/**
 * Property for default username to use when performing basic authentication
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_AUTH_PARAM_DEFAULT_USERNAME = 'svn:auth:username';
const SVN_AUTH_PARAM_DONT_STORE_PASSWORDS = 'svn:auth:dont-store-passwords';
const SVN_AUTH_PARAM_NON_INTERACTIVE = 'svn:auth:non-interactive';
const SVN_AUTH_PARAM_NO_AUTH_CACHE = 'svn:auth:no-auth-cache';
const SVN_AUTH_PARAM_SERVER_GROUP = 'svn:auth:server-group';
const SVN_AUTH_PARAM_SSL_SERVER_CERT_INFO = 'svn:auth:ssl:cert-info';
const SVN_AUTH_PARAM_SSL_SERVER_FAILURES = 'svn:auth:ssl:failures';
const SVN_DISCOVER_CHANGED_PATHS = 2;
/**
 * Configuration key that determines filesystem type
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_FS_CONFIG_FS_TYPE = 'fs-type';
/**
 * Filesystem is Berkeley-DB implementation
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_FS_TYPE_BDB = 'bdb';
/**
 * Filesystem is native-filesystem implementation
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_FS_TYPE_FSFS = 'fsfs';
/**
 * Directory
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_NODE_DIR = 2;
/**
 * File
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_NODE_FILE = 1;
/**
 * Absent
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_NODE_NONE = 0;
/**
 * Something Subversion cannot identify
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_NODE_UNKNOWN = 3;
const SVN_NON_RECURSIVE = 1;
const SVN_NO_IGNORE = 64;
const SVN_OMIT_MESSAGES = 4;
/**
 * svn:author
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_PROP_REVISION_AUTHOR = 'svn:author';
/**
 * svn:date
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_PROP_REVISION_DATE = 'svn:date';
/**
 * svn:log
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_PROP_REVISION_LOG = 'svn:log';
/**
 * svn:original-date
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_PROP_REVISION_ORIG_DATE = 'svn:original-date';
const SVN_REVISION_BASE = -2;
const SVN_REVISION_COMMITTED = -3;
/**
 * Magic number (-1) specifying the HEAD revision
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_REVISION_HEAD = -1;
const SVN_REVISION_INITIAL = 1;
const SVN_REVISION_PREV = -4;
const SVN_REVISION_UNSPECIFIED = -5;
const SVN_SHOW_UPDATES = 32;
const SVN_STOP_ON_COPY = 8;
const SVN_WC_SCHEDULE_ADD = 1;
const SVN_WC_SCHEDULE_DELETE = 2;
const SVN_WC_SCHEDULE_NORMAL = 0;
const SVN_WC_SCHEDULE_REPLACE = 3;
/**
 * Item is scheduled for addition
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_ADDED = 4;
/**
 * Item's local modifications conflicted with repository modifications
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_CONFLICTED = 10;
/**
 * Item is scheduled for deletion
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_DELETED = 6;
/**
 * Unversioned path that is populated using svn:externals
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_EXTERNAL = 13;
/**
 * Item is unversioned but configured to be ignored
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_IGNORED = 11;
/**
 * Directory does not contain complete entries list
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_INCOMPLETE = 14;
/**
 * Item's local modifications were merged with repository modifications
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_MERGED = 9;
/**
 * Item is versioned but missing from the working copy
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_MISSING = 5;
/**
 * Item (text or properties) was modified
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_MODIFIED = 8;
/**
 * Status does not exist
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_NONE = 1;
/**
 * Item exists, nothing else is happening
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_NORMAL = 3;
/**
 * Unversioned item is in the way of a versioned resource
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_OBSTRUCTED = 12;
/**
 * Item was deleted and then re-added
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_REPLACED = 7;
/**
 * Item is not versioned in working copy
 *
 * @link http://php.net/manual/en/svn.constants.php
 */
const SVN_WC_STATUS_UNVERSIONED = 2;
