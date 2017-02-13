<?php
/**
 * PHPStorm stub file for PHP pre-defined constants.
 */

/**
 *  Default include path where extensions will be looked for.
 */
const DEFAULT_INCLUDE_PATH = '.:/usr/share/php:/usr/share/pear';
const PEAR_EXTENSION_DIR = '/usr/lib/php5/20090626';
const PEAR_INSTALL_DIR = '/usr/share/php';
/**
 * Specifies where the binaries were installed into.
 *
 * @link http://php.net/manual/en/reserved.constants.php
 */
const PHP_BINARY = '/usr/local/php/bin/php';
const PHP_BINDIR = '/usr/bin';
const PHP_CONFIG_FILE_PATH = '/etc/php5/cli';
const PHP_CONFIG_FILE_SCAN_DIR = '/etc/php5/cli/conf.d';
const PHP_DATADIR = '/usr/share';
const PHP_DEBUG = 0;
const PHP_EOL = "\n";
const PHP_EXTENSION_DIR = '/usr/lib/php5/20090626';
const PHP_EXTRA_VERSION = '-13ubuntu3.2';
/**
 * The maximum number of file descriptors for select system calls.
 *
 * @since 7.1.0
 */
const PHP_FD_SETSIZE = 1024;
const PHP_INT_MAX = 9223372036854775807;
const PHP_INT_MIN = -9223372036854775808;
const PHP_INT_SIZE = 8;
const PHP_LIBDIR = '/usr/lib/php5';
const PHP_LOCALSTATEDIR = '/var';
const PHP_MAJOR_VERSION = 5;
/**
 * Specifies where the manpages were installed into.
 *
 * @since PHP 5.3.7
 * @link  http://php.net/manual/en/reserved.constants.php
 */
const PHP_MANDIR = '/usr/local/php/php/man';
const PHP_MAXPATHLEN = 4096;
const PHP_MINOR_VERSION = 3;
const PHP_OS = 'Linux';
const PHP_OUTPUT_HANDLER_CONT = 2;
const PHP_OUTPUT_HANDLER_END = 4;
const PHP_OUTPUT_HANDLER_START = 1;
const PHP_PREFIX = '/usr';
const PHP_RELEASE_VERSION = 6;
const PHP_SAPI = 'cli';
/**
 * The build-platform's shared library suffix, such as "so" (most Unixes) or "dll" (Windows).
 *
 * @link http://php.net/manual/en/reserved.constants.php
 */
const PHP_SHLIB_SUFFIX = 'so';
const PHP_SYSCONFDIR = '/etc';
const PHP_VERSION = '5.3.6-13ubuntu3.2';
const PHP_VERSION_ID = 50306;
const PHP_ZTS = 0;
const S_ALL = 511;
const S_EXECUTOR = 64;
const S_FILES = 8;
const S_INCLUDE = 16;
const S_INTERNAL = 536870912;
const S_MAIL = 128;
const S_MEMORY = 1;
const S_MISC = 2;
const S_SESSION = 256;
const S_SQL = 32;
const S_VARS = 4;
const UPLOAD_ERR_CANT_WRITE = 7;
const UPLOAD_ERR_EXTENSION = 8;
const UPLOAD_ERR_FORM_SIZE = 2;
const UPLOAD_ERR_INI_SIZE = 1;
const UPLOAD_ERR_NO_FILE = 4;
const UPLOAD_ERR_NO_TMP_DIR = 6;
const UPLOAD_ERR_OK = 0;
const UPLOAD_ERR_PARTIAL = 3;
const ZEND_DEBUG_BUILD = false;
const ZEND_MULTIBYTE = 0;
const ZEND_THREAD_SAFE = false;
define('FALSE', false);
define('NULL', null);
define('STDIN', fopen('php://stdin', 'r'));
define('STDOUT', fopen('php://stdout', 'w'));
define('STDERR', fopen('php://stderr', 'w'));
define('TRUE', true);

