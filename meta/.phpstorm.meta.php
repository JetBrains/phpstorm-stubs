<?php

namespace PHPSTORM_META {

  /**
   * @param callable $callable Class, Method or function call
   * @param mixed $method one of
   * @see map()
   * @see type()
   * @see elementType()
   * @return mixed override pair object
   */
  function override($callable, $override) {
    return "override $callable $override";
  }

  /**
   * map argument with #$argNum Literal value to one of expressions
   * @param mixed $argNum ignored, for now its always 0
   * @param mixed $map Key-value pairs: string_literal|const|class_const => class_name::class|pattern_literal
   * where pattern literal can contain @ char to be replaced with argument literal value
   * @return mixed overrides map object
   */
  function map($map) {
    return "map $argNum $map";
  }

  /**
   * type of argument #$argNum
   * @param mixed $argNum ignored, for now its always 0
   * @return mixed
   */
  function type($argNum) {
    return "type $argNum";
  }

  /**
   * element type of argument #$argNum
   * @param mixed $argNum
   * @return mixed
   */
  function elementType($argNum) {
    return "elementType $argNum";
  }

  override(\array_shift(0), elementType(0));
  override(\array_reverse(0), type(0));
  override(\array_pop(0), elementType(0));
//  override(\array_map(0), type(1));
  override(\array_filter(0), type(0));
  override(\array_reduce(0), elementType(0));
  override(\array_slice(0), type(0));
  override(\array_diff(0), type(0));
  override(\array_diff_assoc(0), type(0));
  override(\array_diff_uassoc(0), type(0));
  override(\array_diff_key(0), type(0));
  override(\array_diff_ukey(0), type(0));
  override(\array_udiff(0), type(0));
  override(\array_udiff_assoc(0), type(0));
  override(\array_udiff_uassoc(0), type(0));

  override(\current(0), elementType(0));
  override(\reset(0), elementType(0));
  override(\end(0), elementType(0));
  override(\prev(0), elementType(0));
  override(\next(0), elementType(0));

  override(\iterator_to_array(0), type(0));
  override(\array_change_key_case(0), type(0));
  override(\array_rand(0), elementType(0));
  override(\array_unique(0), type(0));

  override(\array_intersect(0), type(0));
  override(\array_intersect_assoc(0), type(0));
  override(\array_intersect_key(0), type(0));
  override(\array_intersect_uassoc(0), type(0));
  override(\array_intersect_ukey(0), type(0));
  override(\array_uintersect(0), type(0));
  override(\array_uintersect_assoc(0), type(0));
  override(\array_uintersect_uassoc(0), type(0));

//should be changed later to map values when map type is supported
  override(\array_values(0), type(0));
  override(\array_combine(0), type(1));


    function expectedArguments($functionReference, $argumentIndex, $values) {
        return "expectedArguments " . $functionReference . "at " . $argumentIndex . ": " . $values;
    }

    function registerArgumentsSet($setName, $values) {
        return "registerArgumentsSet " . $setName . ": "  . $values;
    }

    function argumentsSet($setName) {
        return "argumentsSet " . $setName;
    }

    expectedArguments(\array_change_key_case(), 1, CASE_LOWER,CASE_UPPER);
    expectedArguments(\apc_bin_dumpfile(), 3, FILE_USE_INCLUDE_PATH, FILE_APPEND, LOCK_EX);
    expectedArguments(\apc_bin_load(), 3, APC_BIN_VERIFY_CRC32|APC_BIN_VERIFY_MD5);
    expectedArguments(\apc_bin_loadfile(), 3, APC_BIN_VERIFY_CRC32|APC_BIN_VERIFY_MD5);
    expectedArguments(\jdmonthname(), 1, CAL_MONTH_GREGORIAN_SHORT,CAL_MONTH_GREGORIAN_LONG,CAL_MONTH_JULIAN_SHORT,CAL_MONTH_JULIAN_LONG,CAL_MONTH_JEWISH,CAL_MONTH_FRENCH);
    expectedArguments(\variant_cmp(), 0, NORM_IGNORECASE|NORM_IGNORENONSPACE|NORM_IGNORESYMBOLS|NORM_IGNOREWIDTH|NORM_IGNOREKANATYPE|NORM_IGNOREKASHIDA);

    expectedArguments(\DOMDocument::schemaValidateSource(), 1, LIBXML_SCHEMA_CREATE);
    
    registerArgumentsSet('common_dirname_return', __DIR__);
    expectedArguments(\dirname(), 0, argumentsSet('common_dirname_return'), __FILE__);
    expectedReturnValues(\dirname(), argumentsSet('common_dirname_return'));    // this allows completion for "dirname()" inside dirname(<caret>)
    
    expectedArguments(\EvLoop::__construct(), 0, \Ev::FLAG_AUTO,\Ev::FLAG_NOENV,\Ev::FLAG_FORKCHECK,\Ev::FLAG_NOINOTIFY,\Ev::FLAG_SIGNALFD,\Ev::FLAG_NOSIGMASK); //todo support
    expectedArguments(\Ev::run(), 0, \Ev::FLAG_AUTO,\Ev::FLAG_NOENV,\Ev::FLAG_FORKCHECK,\Ev::FLAG_NOINOTIFY,\Ev::FLAG_SIGNALFD,\Ev::FLAG_NOSIGMASK);
    expectedArguments(\EvLoop::run(), 0, \Ev::RUN_NOWAIT,\Ev::RUN_ONCE);
    expectedArguments(\EvLoop::defaultLoop(), 0, \Ev::FLAG_AUTO,\Ev::FLAG_NOENV,\Ev::FLAG_FORKCHECK,\Ev::FLAG_NOINOTIFY,\Ev::FLAG_SIGNALFD,\Ev::FLAG_NOSIGMASK);
    expectedArguments(\Event::pending(), 0, \Event::READ|\Event::WRITE|\Event::TIMEOUT|\Event::SIGNAL);
    expectedArguments(\EventBase::loop(), 0, \EventBase::LOOP_ONCE, \EventBase::LOOP_NONBLOCK, \EventBase::NOLOCK, \EventBase::STARTUP_IOCP, \EventBase::NO_CACHE_TIME, \EventBase::EPOLL_USE_CHANGELIST);

	expectedArguments(\extension_loaded(), 0, 'amqp', 'apache', 'apc', 'apd', 'bbcode', 'bcmath', 'bcompiler', 'bz2', 'cairo', 'calendar', 'chdb', 'classkit', 'com', 'crack', 'ctype', 'cubrid', 'curl', 'cyrus', 'dba', 'dbase', 'dbplus', 'dbx', 'dio', 'dom', 'dotnet', 'eio', 'enchant', 'ev', 'event', 'exif', 'expect', 'fam', 'fbsql', 'fdf', 'fileinfo', 'filepro', 'filter', 'fribidi', 'ftp', 'gearman', 'gender', 'geoip', 'gettext', 'gmagick', 'gmp', 'gnupg', 'gupnp', 'haru', 'htscanner', 'pecl_http', 'hyperwave', 'hwapi', 'interbase', 'ibm_db2', 'iconv', 'id3', 'informix', 'iisfunc', 'gd', 'imagick', 'imap', 'inclued', 'ingres', 'inotify', 'intl', 'java', 'json', 'judy', 'kadm5', 'ktaglib', 'lapack', 'ldap', 'libevent', 'libxml', 'lua', 'lzf', 'mailparse', 'maxdb', 'mbstring', 'mcrypt', 'mcve', 'memcache', 'memcached', 'memtrack', 'mhash', 'ming', 'mnogosearch', 'mongo', 'mqseries', 'msession', 'msql', 'mssql', 'mysql', 'mysqli', 'mysqlnd', 'mysqlnd_memcache', 'mysqlnd_ms', 'mysqlnd_mux', 'mysqlnd_qc', 'mysqlnd_uh', 'ncurses', 'net_gopher', 'newt', 'notes', 'nsapi', 'oauth', 'oci8', 'oggvorbis', 'openal', 'openssl', 'ovrimos', 'paradox', 'parsekit', 'pcntl', 'pcre', 'pdflib', 'pdo', 'pdo_4d', 'pdo_cubrid', 'pdo_dblib', 'pdo_firebird', 'pdo_ibm', 'pdo_informix', 'pdo_mysql', 'pdo_oci', 'pdo_odbc', 'pdo_pgsql', 'pdo_sqlite', 'pdo_sqlsrv', 'pdo_pgsql', 'phar', 'posix', 'printer', 'proctitle', 'ps', 'pspell', 'pthreads', 'qtdom', 'quickhash', 'radius', 'rar', 'readline', 'recode', 'rpmreader', 'rrd', 'runkit', 'sam', 'sca', 'scream', 'sca_sdo', 'sysvmsg', 'session', 'session_pgsql', 'shmop', 'simplexml', 'snmp', 'soap', 'sockets', 'solr', 'sphinx', 'spl_types', 'spplus', 'sqlite', 'sqlite3', 'sqlsrv', 'ssdeep', 'ssh2', 'stats', 'stomp', 'svm', 'svn', 'swf', 'swish', 'sybase', 'taint', 'tcpwrap', 'tidy', 'tokenizer', 'tokyo_tyrant', 'trader', 'odbc', 'v8js', 'varnish', 'vpopmail', 'w32api', 'wddx', 'weakref', 'win32ps', 'win32service', 'wincache', 'xattr', 'xdiff', 'xhprof', 'xml', 'xmlreader', 'xmlrpc', 'xmlwriter', 'xsl', 'xslt', 'yaf', 'yaml', 'yaz', 'zip', 'zlib');
    
    registerArgumentsSet('error_levels', E_ALL|E_ERROR|E_WARNING|E_PARSE|E_NOTICE|E_STRICT|E_RECOVERABLE_ERROR|E_DEPRECATED|E_CORE_ERROR|E_CORE_WARNING|E_COMPILE_ERROR|E_COMPILE_WARNING|E_USER_ERROR|E_USER_WARNING|E_USER_NOTICE|E_USER_DEPRECATED);
    expectedArguments(\error_reporting(), 0, argumentsSet('error_levels'));
    expectedReturnValues(\error_reporting(), argumentsSet('error_levels'));

    registerArgumentsSet('user_error_levels', E_USER_NOTICE,E_USER_WARNING,E_USER_ERROR,E_USER_DEPRECATED);
    expectedArguments(\trigger_error(), 1, argumentsSet('user_error_levels'));
    expectedArguments(\user_error(), 1, argumentsSet('user_error_levels'));

    expectedArguments(\ftp_get(), 3, FTP_ASCII,FTP_BINARY);
    expectedArguments(\ftp_fget(), 3, FTP_ASCII,FTP_BINARY);
    expectedArguments(\ftp_put(), 3, FTP_ASCII,FTP_BINARY);
    expectedArguments(\ftp_fput(), 3, FTP_ASCII,FTP_BINARY);
    expectedArguments(\ftp_nb_put(), 3, FTP_ASCII,FTP_BINARY);
    expectedArguments(\ftp_nb_fput(), 3, FTP_ASCII,FTP_BINARY);

	expectedArguments(\fopen(), 1, 'r', 'r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+', 'e');
	expectedArguments(\popen(), 1, 'r', 'r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+', 'e');
	expectedArguments(\SplFileInfo::openFile(), 0, 'r', 'r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+', 'e');

	expectedArguments(\htmlentities(), 1, ENT_COMPAT | ENT_QUOTES | ENT_NOQUOTES | ENT_IGNORE | ENT_SUBSTITUTE | ENT_DISALLOWED | ENT_HTML401 | ENT_XML1 | ENT_XHTML | ENT_HTML5);
	expectedArguments(\htmlentities(), 2, 'ISO-8859-1', 'ISO-8859-5', 'ISO-8859-15', 'UTF-8', 'cp866', 'cp1251', 'cp1252', 'KOI8-R', 'BIG5', 'GB2312', 'BIG5-HKSCS', 'Shift_JIS', 'EUC-JP', 'MacRoman');
	expectedArguments(\htmlspecialchars(), 1, ENT_COMPAT | ENT_QUOTES | ENT_NOQUOTES | ENT_IGNORE | ENT_SUBSTITUTE | ENT_DISALLOWED | ENT_HTML401 | ENT_XML1 | ENT_XHTML | ENT_HTML5);
	expectedArguments(\htmlspecialchars(), 2, 'ISO-8859-1', 'ISO-8859-5', 'ISO-8859-15', 'UTF-8', 'cp866', 'cp1251', 'cp1252', 'KOI8-R', 'BIG5', 'GB2312', 'BIG5-HKSCS', 'Shift_JIS', 'EUC-JP', 'MacRoman');
	expectedArguments(\html_entity_decode(), 1, ENT_COMPAT | ENT_QUOTES | ENT_NOQUOTES | ENT_HTML401 | ENT_XML1 | ENT_XHTML | ENT_HTML5);
	expectedArguments(\html_entity_decode(), 2, 'ISO-8859-1', 'ISO-8859-5', 'ISO-8859-15', 'UTF-8', 'cp866', 'cp1251', 'cp1252', 'KOI8-R', 'BIG5', 'GB2312', 'BIG5-HKSCS', 'Shift_JIS', 'EUC-JP', 'MacRoman');
    expectedArguments(\htmlspecialchars_decode(), 1, ENT_COMPAT | ENT_QUOTES | ENT_NOQUOTES | ENT_HTML401 | ENT_XML1 | ENT_XHTML | ENT_HTML5);
	
    expectedArguments(\parse_url(), 1, PHP_URL_SCHEME, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_USER, PHP_URL_PASS, PHP_URL_PATH, PHP_URL_QUERY, PHP_URL_FRAGMENT);

    expectedArguments(\iconv_mime_decode(), 1, ICONV_MIME_DECODE_STRICT,ICONV_MIME_DECODE_CONTINUE_ON_ERROR);
    expectedArguments(\iconv_mime_decode_headers(), 1, ICONV_MIME_DECODE_STRICT,ICONV_MIME_DECODE_CONTINUE_ON_ERROR);
    expectedArguments(\Imagick::setImageAlphaChannel(), 0, \Imagick::ALPHACHANNEL_ACTIVATE,\Imagick::ALPHACHANNEL_BACKGROUND,\Imagick::ALPHACHANNEL_COPY,\Imagick::ALPHACHANNEL_DEACTIVATE,\Imagick::ALPHACHANNEL_EXTRACT,\Imagick::ALPHACHANNEL_FLATTEN,\Imagick::ALPHACHANNEL_DEACTIVATE,\Imagick::ALPHACHANNEL_OPAQUE,\Imagick::ALPHACHANNEL_REMOVE,\Imagick::ALPHACHANNEL_RESET,\Imagick::ALPHACHANNEL_SET,\Imagick::ALPHACHANNEL_SHAPE,\Imagick::ALPHACHANNEL_TRANSPARENT,\Imagick::ALPHACHANNEL_UNDEFINED); //todo introduce byPrefix
    expectedArguments(\Imagick::montageImage(), 3, \Imagick::MONTAGEMODE_FRAME,\Imagick::MONTAGEMODE_UNFRAME,\Imagick::MONTAGEMODE_CONCATENATE);

    registerArgumentsSet('imagetypes',
        IMAGETYPE_GIF,
        IMAGETYPE_JPEG,
        IMAGETYPE_PNG,
        IMAGETYPE_SWF,
        IMAGETYPE_PSD,
        IMAGETYPE_BMP,
        IMAGETYPE_TIFF_II,
        IMAGETYPE_TIFF_MM,
        IMAGETYPE_JPC,
        IMAGETYPE_JP2,
        IMAGETYPE_JPX,
        IMAGETYPE_JB2,
        IMAGETYPE_SWC,
        IMAGETYPE_IFF,
        IMAGETYPE_WBMP,
        IMAGETYPE_XBM,
        IMAGETYPE_ICO,
        IMAGETYPE_WEBP
    );
    expectedArguments(\image_type_to_extension(), 0, argumentsSet('imagetypes'));
    expectedArguments(\image_type_to_mime_type(), 0, argumentsSet('imagetypes'));
    expectedReturnValues(\exif_imagetype(), argumentsSet('imagetypes'));
    
    expectedArguments(\exif_read_data(), 1, 'FILE', 'COMPUTED', 'ANY_TAG', 'IFD0', 'THUMBNAIL', 'COMMENT', 'EXIF');

    expectedArguments(\imap_close(), 1, CL_EXPUNGE);
    expectedArguments(\event_base_loop(), 1, EVLOOP_ONCE|EVLOOP_NONBLOCK);
    expectedArguments(\mb_convert_case(), 1, MB_CASE_UPPER,MB_CASE_LOWER,MB_CASE_TITLE);
	expectedArguments(\mb_get_info(), 0, 'all', 'http_output', 'http_input', 'internal_encoding', 'func_overload');
	expectedArguments(\mb_language(), 0, 'Japanese', 'ja', 'English', 'en', 'uni');
    expectedArguments(\MemcachePool::add(), 2, MEMCACHE_COMPRESSED);
    expectedArguments(\MemcachePool::set(), 2, MEMCACHE_COMPRESSED);
    expectedArguments(\MemcachePool::replace(), 2, MEMCACHE_COMPRESSED);

    expectedArguments(\MongoDB\Driver\ReadPreference::__construct(), 0, \MongoDB\Driver\ReadPreference::RP_PRIMARY,\MongoDB\Driver\ReadPreference::RP_PRIMARY_PREFERRED,\MongoDB\Driver\ReadPreference::RP_SECONDARY,\MongoDB\Driver\ReadPreference::RP_SECONDARY_PREFERRED,\MongoDB\Driver\ReadPreference::RP_NEAREST);
    expectedArguments(\mysqli::begin_transaction(), 0, MYSQLI_TRANS_START_READ_ONLY,MYSQLI_TRANS_START_READ_WRITE,MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
    expectedArguments(\mysqli::commit(), 0, MYSQLI_TRANS_COR_AND_CHAIN|MYSQLI_TRANS_COR_AND_NO_CHAIN|MYSQLI_TRANS_COR_NO_RELEASE|MYSQLI_TRANS_COR_RELEASE);
    expectedArguments(\mysqli::real_connect(), 6, MYSQLI_CLIENT_COMPRESS|MYSQLI_CLIENT_FOUND_ROWS|MYSQLI_CLIENT_IGNORE_SPACE|MYSQLI_CLIENT_INTERACTIVE|MYSQLI_CLIENT_SSL|MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
    expectedArguments(\mysqli::rollback(), 0, MYSQLI_TRANS_COR_AND_CHAIN|MYSQLI_TRANS_COR_AND_NO_CHAIN|MYSQLI_TRANS_COR_NO_RELEASE|MYSQLI_TRANS_COR_RELEASE);
    expectedArguments(\mysqli_begin_transaction(), 1, MYSQLI_TRANS_START_READ_ONLY,MYSQLI_TRANS_START_READ_WRITE,MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
    expectedArguments(\mysqli_report(), 0, MYSQLI_REPORT_OFF,MYSQLI_REPORT_ERROR,MYSQLI_REPORT_STRICT,MYSQLI_REPORT_INDEX,MYSQLI_REPORT_ALL);
    expectedArguments(\mysqli_real_connect(), 7, MYSQLI_CLIENT_COMPRESS|MYSQLI_CLIENT_FOUND_ROWS|MYSQLI_CLIENT_IGNORE_SPACE|MYSQLI_CLIENT_INTERACTIVE|MYSQLI_CLIENT_SSL|MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
    registerArgumentsSet("mysqliAttributesSet", MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH, MYSQLI_STMT_ATTR_CURSOR_TYPE, MYSQLI_STMT_ATTR_PREFETCH_ROWS);
    expectedArguments(\mysqli_stmt::attr_set(), 0, argumentsSet("mysqliAttributesSet"));
    expectedArguments(\mysqli_stmt_attr_set(), 1, argumentsSet("mysqliAttributesSet"));

	expectedArguments(\ob_start(), 2, \PHP_OUTPUT_HANDLER_CLEANABLE | \PHP_OUTPUT_HANDLER_FLUSHABLE | PHP_OUTPUT_HANDLER_REMOVABLE, PHP_OUTPUT_HANDLER_STDFLAGS);
	expectedArguments(\ob_implicit_flush(), 0, 0, 1);
    expectedArguments(\OCI_Lob::flush(), 0, OCI_LOB_BUFFER_FREE);
    expectedArguments(\oci_execute(), 1, OCI_COMMIT_ON_SUCCESS,OCI_DESCRIBE_ONLY,OCI_NO_AUTO_COMMIT);
    expectedArguments(\odbc_binmode(), 1, ODBC_BINMODE_PASSTHRU,ODBC_BINMODE_RETURN,ODBC_BINMODE_CONVERT);
    expectedArguments(\openlog(), 1, LOG_CONS|LOG_NDELAY|LOG_ODELAY|LOG_PERROR|LOG_PID);
    expectedArguments(\openlog(), 2, LOG_USER,LOG_AUTH,LOG_AUTHPRIV,LOG_CRON,LOG_DAEMON,LOG_KERN,LOG_LOCAL0,LOG_LOCAL1,LOG_LOCAL2,LOG_LOCAL3,LOG_LOCAL4,LOG_LOCAL5,LOG_LOCAL6,LOG_LOCAL7,LOG_LPR,LOG_MAIL,LOG_NEWS,LOG_SYSLOG,LOG_UUCP);
    expectedArguments(\openssl_pkcs7_verify(), 1, PKCS7_TEXT|PKCS7_BINARY|PKCS7_NOINTERN|PKCS7_NOVERIFY|PKCS7_NOCHAIN|PKCS7_NOCERTS|PKCS7_NOATTR|PKCS7_DETACHED|PKCS7_NOSIGS);
    expectedArguments(\openssl_pkcs7_sign(), 5, PKCS7_TEXT|PKCS7_BINARY|PKCS7_NOINTERN|PKCS7_NOVERIFY|PKCS7_NOCHAIN|PKCS7_NOCERTS|PKCS7_NOATTR|PKCS7_DETACHED|PKCS7_NOSIGS);
    expectedArguments(\openssl_pkcs7_encrypt(), 4, PKCS7_TEXT|PKCS7_BINARY|PKCS7_NOINTERN|PKCS7_NOVERIFY|PKCS7_NOCHAIN|PKCS7_NOCERTS|PKCS7_NOATTR|PKCS7_DETACHED|PKCS7_NOSIGS);
    expectedArguments(\preg_match(), 3, PREG_OFFSET_CAPTURE|PREG_UNMATCHED_AS_NULL);
    expectedArguments(\preg_match_all(), 3, PREG_PATTERN_ORDER|PREG_SET_ORDER|PREG_OFFSET_CAPTURE|PREG_UNMATCHED_AS_NULL);
    expectedArguments(\preg_split(), 3, PREG_SPLIT_NO_EMPTY);
    expectedArguments(\preg_grep(), 2, PREG_GREP_INVERT);

    expectedArguments(\PDO::query(), 1, \PDO::ATTR_FETCH_CATALOG_NAMES,\PDO::ATTR_FETCH_TABLE_NAMES,\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::ATTR_STRINGIFY_FETCHES);
    expectedArguments(\PDOStatement::setFetchMode(), 0, \PDO::ATTR_FETCH_CATALOG_NAMES,\PDO::ATTR_FETCH_TABLE_NAMES,\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::ATTR_STRINGIFY_FETCHES);
    expectedArguments(\Phar::__construct(), 1, \FilesystemIterator::KEY_AS_PATHNAME|\FilesystemIterator::CURRENT_AS_FILEINFO);
    expectedArguments(\PharData::__construct(), 1, \FilesystemIterator::KEY_AS_PATHNAME|\FilesystemIterator::CURRENT_AS_FILEINFO);
    expectedArguments(\posix_mknod(), 1, POSIX_S_IFREG,POSIX_S_IFCHR,POSIX_S_IFBLK,POSIX_S_IFIFO,POSIX_S_IFSOCK);
    expectedArguments(\posix_access(), 1, POSIX_F_OK|POSIX_R_OK|POSIX_W_OK|POSIX_X_OK);
    expectedArguments(\pspell_new(), 4, PSPELL_FAST,PSPELL_NORMAL,PSPELL_BAD_SPELLERS,PSPELL_RUN_TOGETHER);
    expectedArguments(\pspell_new_personal(), 5, PSPELL_FAST,PSPELL_NORMAL,PSPELL_BAD_SPELLERS,PSPELL_RUN_TOGETHER);
    expectedArguments(\SoapServer::setPersistence(), 0, SOAP_PERSISTENCE_REQUEST,SOAP_PERSISTENCE_SESSION);
    expectedArguments(\socket_recv(), 3, MSG_OOB|MSG_PEEK|MSG_WAITALL|MSG_DONTWAIT);
    expectedArguments(\socket_send(), 3, MSG_OOB|MSG_EOR|MSG_EOF|MSG_DONTROUTE);
    expectedArguments(\socket_recvfrom(), 3, MSG_OOB|MSG_PEEK|MSG_WAITALL|MSG_DONTWAIT);
    expectedArguments(\socket_sendto(), 3, MSG_OOB|MSG_EOR|MSG_EOF|MSG_DONTROUTE);

    expectedArguments(\RecursiveIteratorIterator::__construct(), 1, \RecursiveIteratorIterator::LEAVES_ONLY,\RecursiveIteratorIterator::SELF_FIRST,\RecursiveIteratorIterator::CHILD_FIRST);
    expectedArguments(\RecursiveIteratorIterator::__construct(), 2, \RecursiveIteratorIterator::CATCH_GET_CHILD);
    expectedArguments(\RecursiveCachingIterator::__construct(), 1, \CachingIterator::CALL_TOSTRING|\CachingIterator::TOSTRING_USE_KEY|\CachingIterator::TOSTRING_USE_CURRENT|\CachingIterator::TOSTRING_USE_INNER);
    expectedArguments(\RegexIterator::__construct(), 2, \RegexIterator::MATCH,\RegexIterator::GET_MATCH,\RegexIterator::ALL_MATCHES,\RegexIterator::SPLIT,\RegexIterator::REPLACE);
    expectedArguments(\RegexIterator::__construct(), 3, \RegexIterator::USE_KEY);
    expectedArguments(\RegexIterator::__construct(), 4, \RegexIterator::USE_KEY);
    expectedArguments(\RegexIterator::setMode(), 0, \RegexIterator::MATCH,\RegexIterator::GET_MATCH,\RegexIterator::ALL_MATCHES,\RegexIterator::SPLIT,\RegexIterator::REPLACE);
    expectedArguments(\RegexIterator::setFlags(), 0, \RegexIterator::USE_KEY);
    expectedArguments(\RecursiveRegexIterator::__construct(), 2, \RegexIterator::MATCH,\RegexIterator::GET_MATCH,\RegexIterator::ALL_MATCHES,\RegexIterator::SPLIT,\RegexIterator::REPLACE);
    expectedArguments(\RecursiveRegexIterator::__construct(), 3, \RegexIterator::USE_KEY);
    expectedArguments(\RecursiveRegexIterator::__construct(), 4, \RegexIterator::USE_KEY);
    expectedArguments(\RecursiveTreeIterator::__construct(), 1, \RecursiveTreeIterator::BYPASS_KEY);
    expectedArguments(\RecursiveTreeIterator::__construct(), 2, \CachingIterator::CATCH_GET_CHILD);
    expectedArguments(\RecursiveTreeIterator::__construct(), 3, \RecursiveIteratorIterator::SELF_FIRST);
    expectedArguments(\ArrayObject::__construct(), 1, \ArrayObject::STD_PROP_LIST|\ArrayObject::ARRAY_AS_PROPS);
    expectedArguments(\ArrayIterator::__construct(), 1, \ArrayIterator::STD_PROP_LIST|\ArrayIterator::ARRAY_AS_PROPS);

    expectedArguments(\FilesystemIterator::setFlags(), 0, \FilesystemIterator::CURRENT_MODE_MASK,\FilesystemIterator::CURRENT_AS_PATHNAME,\FilesystemIterator::CURRENT_AS_FILEINFO,\FilesystemIterator::CURRENT_AS_SELF,\FilesystemIterator::KEY_MODE_MASK,\FilesystemIterator::KEY_AS_PATHNAME,\FilesystemIterator::FOLLOW_SYMLINKS,\FilesystemIterator::KEY_AS_FILENAME,\FilesystemIterator::NEW_CURRENT_AND_KEY,\FilesystemIterator::SKIP_DOTS,\FilesystemIterator::UNIX_PATHS,\FilesystemIterator::OTHER_MODE_MASK);

    registerArgumentsSet("splFileObjectFlags", \SplFileObject::DROP_NEW_LINE|\SplFileObject::READ_AHEAD|\SplFileObject::SKIP_EMPTY|\SplFileObject::READ_CSV);
    expectedArguments(\SplFileObject::setFlags(), 0, argumentsSet("splFileObjectFlags"));
    expectedArguments(\SplFileObject::flock(), 0, LOCK_SH, LOCK_EX, LOCK_UN, LOCK_NB);
    expectedArguments(\SplDoublyLinkedList::setIteratorMode(), 0, \SplDoublyLinkedList::IT_MODE_LIFO|\SplDoublyLinkedList::IT_MODE_FIFO|\SplDoublyLinkedList::IT_MODE_DELETE|\SplDoublyLinkedList::IT_MODE_KEEP);
    expectedArguments(\SplQueue::setIteratorMode(), 0, \SplDoublyLinkedList::IT_MODE_LIFO|\SplDoublyLinkedList::IT_MODE_FIFO|\SplDoublyLinkedList::IT_MODE_DELETE|\SplDoublyLinkedList::IT_MODE_KEEP);
    expectedArguments(\SplStack::setIteratorMode(), 0, \SplDoublyLinkedList::IT_MODE_LIFO|\SplDoublyLinkedList::IT_MODE_FIFO|\SplDoublyLinkedList::IT_MODE_DELETE|\SplDoublyLinkedList::IT_MODE_KEEP);
    expectedArguments(\SplPriorityQueue::setExtractFlags(), 0, \SplPriorityQueue::EXTR_DATA,\SplPriorityQueue::EXTR_PRIORITY,\SplPriorityQueue::EXTR_BOTH);
    registerArgumentsSet("multipleIteratorFlags", \MultipleIterator::MIT_NEED_ANY|\MultipleIterator::MIT_NEED_ALL|\MultipleIterator::MIT_KEYS_NUMERIC|\MultipleIterator::MIT_KEYS_ASSOC);
    expectedArguments(\MultipleIterator::setFlags(), 0, argumentsSet("multipleIteratorFlags"));

    expectedArguments(\SQLite3::open(), 1, SQLITE3_OPEN_READWRITE|SQLITE3_OPEN_CREATE|SQLITE3_OPEN_READONLY);
    expectedArguments(\SQLite3::createFunction(), 3, SQLITE3_DETERMINISTIC);
    expectedArguments(\SQLite3::openBlob(), 4, SQLITE3_OPEN_READONLY,SQLITE3_OPEN_READWRITE);
    expectedArguments(\SQLite3::__construct(), 1, SQLITE3_OPEN_READWRITE|SQLITE3_OPEN_CREATE|SQLITE3_OPEN_READONLY);
    expectedArguments(\SQLite3Result::fetchArray(), 0, SQLITE3_ASSOC,SQLITE3_NUM,SQLITE3_BOTH);

    expectedArguments(\ssh2_fingerprint(), 1, SSH2_FINGERPRINT_MD5|SSH2_FINGERPRINT_SHA1|SSH2_FINGERPRINT_HEX|SSH2_FINGERPRINT_RAW);
    expectedArguments(\imagecropauto(), 1, IMG_CROP_BLACK,IMG_CROP_DEFAULT,IMG_CROP_SIDES,IMG_CROP_THRESHOLD,IMG_CROP_TRANSPARENT,IMG_CROP_WHITE);
    expectedArguments(\srand(), 1, MT_RAND_MT19937,MT_RAND_PHP);
    expectedArguments(\mt_srand(), 1, MT_RAND_MT19937,MT_RAND_PHP);
    expectedArguments(\round(), 2, PHP_ROUND_HALF_UP,PHP_ROUND_HALF_DOWN,PHP_ROUND_HALF_EVEN,PHP_ROUND_HALF_ODD);
    expectedArguments(\file_put_contents(), 2, FILE_USE_INCLUDE_PATH|FILE_APPEND|LOCK_EX);
    expectedArguments(\stream_socket_client(), 4, STREAM_CLIENT_CONNECT|STREAM_CLIENT_ASYNC_CONNECT|STREAM_CLIENT_PERSISTENT);
    expectedArguments(\stream_socket_server(), 3, STREAM_SERVER_BIND|STREAM_SERVER_LISTEN);
    expectedArguments(\stream_socket_recvfrom(), 2, STREAM_OOB|STREAM_PEEK);
    expectedArguments(\stream_socket_sendto(), 2, STREAM_OOB);
    expectedArguments(\stream_wrapper_register(), 2, STREAM_IS_URL);
    expectedArguments(\stream_register_wrapper(), 2, STREAM_IS_URL);
    expectedArguments(\fnmatch(), 2, FNM_NOESCAPE|FNM_PATHNAME|FNM_PERIOD|FNM_CASEFOLD);
    expectedArguments(\glob(), 1, GLOB_MARK|GLOB_NOSORT|GLOB_NOCHECK|GLOB_NOESCAPE|GLOB_BRACE|GLOB_ONLYDIR|GLOB_ERR);
    expectedArguments(\count(), 1, COUNT_NORMAL,COUNT_RECURSIVE);
    expectedArguments(\array_filter(), 2, ARRAY_FILTER_USE_KEY,ARRAY_FILTER_USE_BOTH);
    expectedArguments(\svn_checkout(), 4, SVN_NON_RECURSIVE);
    expectedArguments(\svn_log(), 4, SVN_OMIT_MESSAGES|SVN_DISCOVER_CHANGED_PATHS|SVN_STOP_ON_COPY);
    expectedArguments(\svn_status(), 1, \Svn::NON_RECURSIVE|\Svn::ALL|\Svn::SHOW_UPDATES|\Svn::NO_IGNORE|\Svn::IGNORE_EXTERNALS);
    expectedArguments(\msg_receive(), 6, MSG_IPC_NOWAIT|MSG_EXCEPT|MSG_NOERROR);
    expectedArguments(\token_get_all(), 1, TOKEN_PARSE);

    expectedArguments(\V8Js::executeString(), 2, \V8Js::FLAG_NONE,\V8Js::FLAG_FORCE_ARRAY,\V8Js::FLAG_PROPAGATE_PHP_EXCEPTIONS);
    expectedArguments(\V8Js::executeScript(), 1, \V8Js::FLAG_NONE,\V8Js::FLAG_FORCE_ARRAY,\V8Js::FLAG_PROPAGATE_PHP_EXCEPTIONS);

    expectedArguments(\ZipArchive::open(), 1, \ZipArchive::OVERWRITE|\ZipArchive::CREATE|\ZipArchive::EXCL|\ZipArchive::CHECKCONS);
    expectedArguments(\ZipArchive::addGlob(), 1, GLOB_MARK|GLOB_NOSORT|GLOB_NOCHECK|GLOB_NOESCAPE|GLOB_BRACE|GLOB_ONLYDIR|GLOB_ERR);
    expectedArguments(\ZipArchive::getArchiveComment(), 0, \ZipArchive::FL_UNCHANGED);
    expectedArguments(\ZipArchive::getCommentIndex(), 1, \ZipArchive::FL_UNCHANGED);
    expectedArguments(\ZipArchive::getCommentName(), 1, \ZipArchive::FL_UNCHANGED);
    expectedArguments(\ZipArchive::statName(), 1, \ZipArchive::FL_UNCHANGED|\ZipArchive::FL_NOCASE);
    expectedArguments(\ZipArchive::statIndex(), 1, \ZipArchive::FL_UNCHANGED);
    expectedArguments(\ZipArchive::locateName(), 1, \ZipArchive::FL_NOCASE);
    expectedArguments(\ZipArchive::getNameIndex(), 1, \ZipArchive::FL_NOCASE);
    expectedArguments(\ZipArchive::getFromName(), 1, \ZipArchive::FL_NOCASE);
    expectedArguments(\ZipArchive::getFromIndex(), 1, \ZipArchive::FL_NOCASE);

    expectedArguments(\ZMQSocket::recv(), 0, \ZMQ::MODE_DONTWAIT,\ZMQ::MODE_SNDMORE,\ZMQ::MODE_NOBLOCK);

    registerArgumentsSet('ini_values', 'allow_call_time_pass_reference', 'allow_url_fopen', 'allow_url_include', 'always_populate_raw_post_data',
        'apc.cache_by_default', 'apc.enabled', 'apc.enable_cli', 'apc.file_update_protection', 'apc.filters', 'apc.gc_ttl', 'apc.include_once_override', 'apc.localcache', 'apc.localcache.size', 'apc.max_file_size', 'apc.mmap_file_mask', 'apc.num_files_hint', 'apc.optimization', 'apc.report_autofilter', 'apc.rfc1867', 'apc.rfc1867_freq', 'apc.rfc1867_name', 'apc.rfc1867_prefix', 'apc.shm_segments', 'apc.shm_size', 'apc.slam_defense', 'apc.stat', 'apc.stat_ctime', 'apc.ttl', 'apc.user_entries_hint', 'apc.user_ttl', 'apc.write_lock',
        'apd.bitmask', 'apd.dumpdir', 'apd.statement_tracing',
        'arg_separator', 'arg_separator.input', 'arg_separator.output',
        'asp_tags',
        'assert.active', 'assert.bail', 'assert.callback', 'assert.quiet_eval', 'assert.warning',
        'async_send',
        'auto_append_file', 'auto_detect_line_endings', 'auto_globals_jit', 'auto_prepend_file',
        'axis2.client_home', 'axis2.enable_exception', 'axis2.enable_trace', 'axis2.log_path',
        'bcmath.scale',
        'bcompiler.enabled',
        'birdstep.max_links',
        'blenc.key_file',
        'browscap',
        'cgi.check_shebang_line', 'cgi.discard_path', 'cgi.fix_pathinfo', 'cgi.force_redirect', 'cgi.nph', 'cgi.redirect_status_env', 'cgi.rfc2616_headers',
        'child_terminate',
        'cli.pager', 'cli.prompt', 'cli_server.color',
        'coin_acceptor.autoreset', 'coin_acceptor.auto_initialize', 'coin_acceptor.auto_reset', 'coin_acceptor.command_function', 'coin_acceptor.delay', 'coin_acceptor.delay_coins', 'coin_acceptor.delay_prom', 'coin_acceptor.device', 'coin_acceptor.lock_on_close', 'coin_acceptor.start_unlocked',
        'com.allow_dcom', 'com.autoregister_casesensitive', 'com.autoregister_typelib', 'com.autoregister_verbose', 'com.code_page', 'com.typelib_file',
        'crack.default_dictionary',
        'curl.cainfo',
        'daffodildb.default_host', 'daffodildb.default_password', 'daffodildb.default_socket', 'daffodildb.default_user', 'daffodildb.port',
        'date.default_latitude', 'date.default_longitude', 'date.sunrise_zenith', 'date.sunset_zenith', 'date.timezone',
        'dba.default_handler',
        'dbx.colnames_case',
        'default_charset', 'default_mimetype', 'default_socket_timeout',
        'define_syslog_variables',
        'detect_unicode',
        'disable_classes', 'disable_functions',
        'display_errors', 'display_startup_errors',
        'docref_ext', 'docref_root', 'doc_root',
        'enable_dl',
        'engine',
        'error_append_string', 'error_log', 'error_prepend_string', 'error_reporting',
        'etpan.default.charset', 'etpan.default.protocol',
        'exif.decode_jis_intel', 'exif.decode_jis_motorola', 'exif.decode_unicode_intel', 'exif.decode_unicode_motorola', 'exif.encode_jis', 'exif.encode_unicode',
        'exit_on_timeout',
        'expect.logfile', 'expect.loguser', 'expect.timeout',
        'expose_php',
        'extension_dir',
        'fastcgi.impersonate', 'fastcgi.logging',
        'fbsql.allow_persistant', 'fbsql.allow_persistent', 'fbsql.autocommit', 'fbsql.batchSize', 'fbsql.batchsize', 'fbsql.default_database', 'fbsql.default_database_password', 'fbsql.default_host', 'fbsql.default_password', 'fbsql.default_user', 'fbsql.generate_warnings', 'fbsql.max_connections', 'fbsql.max_links', 'fbsql.max_persistent', 'fbsql.max_results', 'fbsql.mbatchSize', 'fbsql.show_timestamp_decimals',
        'file_uploads',
        'filter.default',
        'filter.default_flags',
        'from',
        'gd.jpeg_ignore_warning',
        'geoip.custom_directory', 'geoip.database_standard',
        'gpc_order',
        'hidef.ini_path',
        'highlight.bg', 'highlight.comment', 'highlight.default', 'highlight.html', 'highlight.keyword', 'highlight.string',
        'html_errors',
        'htscanner.config_file', 'htscanner.default_docroot', 'htscanner.default_ttl', 'htscanner.stop_on_error',
        'http.allowed_methods', 'http.allowed_methods_log', 'http.cache_log', 'http.composite_log', 'http.etag.mode', 'http.etag_mode', 'http.force_exit', 'http.log.allowed_methods', 'http.log.cache', 'http.log.composite', 'http.log.not_found', 'http.log.redirect', 'http.ob_deflate_auto', 'http.ob_deflate_flags', 'http.ob_inflate_auto', 'http.ob_inflate_flags', 'http.only_exceptions', 'http.persistent.handles.ident', 'http.persistent.handles.limit', 'http.redirect_log', 'http.request.datashare.connect', 'http.request.datashare.cookie', 'http.request.datashare.dns', 'http.request.datashare.ssl', 'http.request.methods.allowed', 'http.request.methods.custom', 'http.send.deflate.start_auto', 'http.send.deflate.start_flags', 'http.send.inflate.start_auto', 'http.send.inflate.start_flags', 'http.send.not_found_404',
        'hyerwave.allow_persistent', 'hyperwave.allow_persistent', 'hyperwave.default_port',
        'ibase.allow_persistent', 'ibase.dateformat', 'ibase.default_charset', 'ibase.default_db', 'ibase.default_password', 'ibase.default_user', 'ibase.max_links', 'ibase.max_persistent', 'ibase.timeformat', 'ibase.timestampformat',
        'ibm_db2.binmode', 'ibm_db2.i5_allow_commit', 'ibm_db2.i5_dbcs_alloc', 'ibm_db2.instance_name',
        'iconv.input_encoding', 'iconv.internal_encoding', 'iconv.output_encoding',
        'ifx.allow_persistent', 'ifx.blobinfile', 'ifx.byteasvarchar', 'ifx.charasvarchar', 'ifx.default_host', 'ifx.default_password', 'ifx.default_user', 'ifx.max_links', 'ifx.max_persistent', 'ifx.nullformat', 'ifx.textasvarchar',
        'ignore_repeated_errors', 'ignore_repeated_source',
        'ignore_user_abort',
        'imlib2.font_cache_max_size', 'imlib2.font_path',
        'implicit_flush',
        'include_path',
        'ingres.allow_persistent', 'ingres.array_index_start', 'ingres.blob_segment_length', 'ingres.cursor_mode', 'ingres.default_database', 'ingres.default_password', 'ingres.default_user', 'ingres.max_links', 'ingres.max_persistent', 'ingres.report_db_warnings', 'ingres.timeout', 'ingres.trace_connect',
        'ircg.control_user', 'ircg.keep_alive_interval', 'ircg.max_format_message_sets', 'ircg.shared_mem_size', 'ircg.work_dir',
        'last_modified',
        'ldap.base_dn', 'ldap.max_links',
        'log.dbm_dir',
        'log_errors', 'log_errors_max_len',
        'magic_quotes_gpc', 'magic_quotes_runtime', 'magic_quotes_sybase',
        'mail.add_x_header', 'mail.force_extra_parameters', 'mail.log',
        'mailparse.def_charset',
        'maxdb.default_db', 'maxdb.default_host', 'maxdb.default_pw', 'maxdb.default_user', 'maxdb.long_readlen',
        'max_execution_time', 'max_input_nesting_level', 'max_input_vars', 'max_input_time',
        'mbstring.detect_order', 'mbstring.encoding_translation', 'mbstring.func_overload', 'mbstring.http_input', 'mbstring.http_output', 'mbstring.internal_encoding', 'mbstring.language', 'mbstring.script_encoding', 'mbstring.strict_detection', 'mbstring.substitute_character',
        'mcrypt.algorithms_dir', 'mcrypt.modes_dir',
        'memcache.allow_failover', 'memcache.chunk_size', 'memcache.default_port', 'memcache.hash_function', 'memcache.hash_strategy', 'memcache.max_failover_attempts',
        'memory_limit',
        'mime_magic.debug', 'mime_magic.magicfile',
        'mongo.allow_empty_keys', 'mongo.allow_persistent', 'mongo.chunk_size', 'mongo.cmd', 'mongo.default_host', 'mongo.default_port', 'mongo.is_master_interval', 'mongo.long_as_object', 'mongo.native_long', 'mongo.ping_interval', 'mongo.utf8',
        'msql.allow_persistent', 'msql.max_links', 'msql.max_persistent',
        'mssql.allow_persistent', 'mssql.batchsize', 'mssql.charset', 'mssql.compatability_mode', 'mssql.connect_timeout', 'mssql.datetimeconvert', 'mssql.max_links', 'mssql.max_persistent', 'mssql.max_procs', 'mssql.min_error_severity', 'mssql.min_message_severity', 'mssql.secure_connection', 'mssql.textlimit', 'mssql.textsize', 'mssql.timeout',
        'mysql.allow_persistent', 'mysql.connect_timeout', 'mysql.default_host', 'mysql.default_password', 'mysql.default_port', 'mysql.default_socket', 'mysql.default_user', 'mysql.max_links', 'mysql.max_persistent', 'mysql.trace_mode',
        'mysqli.default_host', 'mysqli.default_port', 'mysqli.default_pw', 'mysqli.default_socket', 'mysqli.default_user', 'mysqli.max_links', 'mysqli.reconnect',
        'namazu.debugmode', 'namazu.lang', 'namazu.loggingmode', 'namazu.sortmethod', 'namazu.sortorder',
        'nsapi.read_timeout',
        'oci8.connection_class', 'oci8.default_prefetch', 'oci8.events', 'oci8.max_persistent', 'oci8.old_oci_close_semantics', 'oci8.persistent_timeout', 'oci8.ping_interval', 'oci8.privileged_connect', 'oci8.statement_cache_size',
        'odbc.allow_persistent', 'odbc.check_persistent', 'odbc.defaultbinmode', 'odbc.defaultlrl', 'odbc.default_db', 'odbc.default_pw', 'odbc.default_user', 'odbc.max_links', 'odbc.max_persistent',
        'odbtp.datetime_format', 'odbtp.detach_default_queries', 'odbtp.guid_format', 'odbtp.interface_file', 'odbtp.truncation_errors',
        'opendirectory.default_separator', 'opendirectory.max_refs', 'opendirectory.separator',
        'open_basedir',
        'oracle.allow_persistent', 'oracle.max_links', 'oracle.max_persistent',
        'output_buffering', 'output_handler',
        'pam.servicename',
        'pcre.backtrack_limit', 'pcre.recursion_limit',
        'pdo_odbc.connection_pooling', 'pdo_odbc.db2_instance_name',
        'pfpro.defaulthost', 'pfpro.defaultport', 'pfpro.defaulttimeout', 'pfpro.proxyaddress', 'pfpro.proxylogon', 'pfpro.proxypassword', 'pfpro.proxyport',
        'pgsql.allow_persistent', 'pgsql.auto_reset_persistent', 'pgsql.ignore_notice', 'pgsql.log_notice', 'pgsql.max_links', 'pgsql.max_persistent',
        'phar.extract_list', 'phar.readonly', 'phar.require_hash',
        'enable_post_data_reading',
        'post_max_size',
        'precision',
        'printer.default_printer',
        'python.append_path', 'python.prepend_path',
        'realpath_cache_size', 'realpath_cache_ttl',
        'register_argc_argv', 'register_globals', 'register_long_arrays',
        'report_memleaks', 'report_zend_debug',
        'request_order',
        'runkit.internal_override', 'runkit.superglobal',
        'safe_mode', 'safe_mode_allowed_env_vars', 'safe_mode_exec_dir', 'safe_mode_gid', 'safe_mode_include_dir', 'safe_mode_protected_env_vars',
        'sendmail_from', 'sendmail_path',
        'serialize_precision',
        'session.auto_start', 'session.bug_compat_42', 'session.bug_compat_warn', 'session.cache_expire', 'session.cache_limiter', 'session.cookie_domain', 'session.cookie_httponly', 'session.cookie_lifetime', 'session.cookie_path', 'session.cookie_secure', 'session.entropy_file', 'session.entropy_length', 'session.gc_dividend', 'session.gc_divisor', 'session.gc_maxlifetime', 'session.gc_probability', 'session.hash_bits_per_character', 'session.hash_function', 'session.name', 'session.referer_check', 'session.save_handler', 'session.save_path', 'session.serialize_handler', 'session.use_cookies', 'session.use_only_cookies', 'session.use_trans_sid',
        'session_pgsql.create_table', 'session_pgsql.db', 'session_pgsql.disable', 'session_pgsql.failover_mode', 'session_pgsql.gc_interval', 'session_pgsql.keep_expired', 'session_pgsql.sem_file_name', 'session_pgsql.serializable', 'session_pgsql.short_circuit', 'session_pgsql.use_app_vars', 'session_pgsql.vacuum_interval',
        'short_open_tag',
        'simple_cvs.authMethod', 'simple_cvs.compressionLevel', 'simple_cvs.cvsRoot', 'simple_cvs.host', 'simple_cvs.moduleName', 'simple_cvs.userName', 'simple_cvs.workingDir',
        'SMTP',
        'smtp_port',
        'soap.wsdl_cache', 'soap.wsdl_cache_dir', 'soap.wsdl_cache_enabled', 'soap.wsdl_cache_limit', 'soap.wsdl_cache_ttl',
        'sql.safe_mode',
        'sqlite.assoc_case',
        'sybase.allow_persistent', 'sybase.hostname', 'sybase.interface_file', 'sybase.login_timeout', 'sybase.max_links', 'sybase.max_persistent', 'sybase.min_client_severity', 'sybase.min_error_severity', 'sybase.min_message_severity', 'sybase.min_server_severity', 'sybase.timeout',
        'sybct.allow_persistent', 'sybct.deadlock_retry_count', 'sybct.hostname', 'sybct.login_timeout', 'sybct.max_links', 'sybct.max_persistent', 'sybct.min_client_severity', 'sybct.min_server_severity', 'sybct.packet_size', 'sybct.timeout',
        'sysvshm.init_mem',
        'tidy.clean_output', 'tidy.default_config',
        'track_errors', 'track_vars',
        'unserialize_callback_func',
        'uploadprogress.file.filename_template', 'upload_max_filesize', 'max_file_uploads', 'upload_tmp_dir',
        'url_rewriter.tags',
        'user_agent',
        'user_dir',
        'user_ini.cache_ttl', 'user_ini.filename',
        'valkyrie.auto_validate', 'valkyrie.config_path',
        'variables_order',
        'velocis.max_links',
        'vld.active', 'vld.execute', 'vld.skip_append', 'vld.skip_prepend',
        'windows_show_crt_warning',
        'xbithack',
        'xdebug.auto_profile', 'xdebug.auto_profile_mode', 'xdebug.auto_trace', 'xdebug.collect_includes', 'xdebug.collect_params', 'xdebug.collect_return', 'xdebug.collect_vars', 'xdebug.default_enable', 'xdebug.dump.COOKIE', 'xdebug.dump.ENV', 'xdebug.dump.FILES', 'xdebug.dump.GET', 'xdebug.dump.POST', 'xdebug.dump.REQUEST', 'xdebug.dump.SERVER', 'xdebug.dump.SESSION', 'xdebug.dump_globals', 'xdebug.dump_once', 'xdebug.dump_undefined', 'xdebug.extended_info', 'xdebug.idekey', 'xdebug.manual_url', 'xdebug.max_nesting_level', 'xdebug.output_dir', 'xdebug.profiler_aggregate', 'xdebug.profiler_append', 'xdebug.profiler_enable', 'xdebug.profiler_enable_trigger', 'xdebug.profiler_output_dir', 'xdebug.profiler_output_name', 'xdebug.remote_autostart', 'xdebug.remote_enable', 'xdebug.remote_handler', 'xdebug.remote_host', 'xdebug.remote_log', 'xdebug.remote_mode', 'xdebug.remote_port', 'xdebug.show_exception_trace', 'xdebug.show_local_vars', 'xdebug.show_mem_delta', 'xdebug.trace_format', 'xdebug.trace_options', 'xdebug.trace_output_dir', 'xdebug.trace_output_name', 'xdebug.var_display_max_children', 'xdebug.var_display_max_data', 'xdebug.var_display_max_depth',
        'xmlrpc_errors',
        'xmlrpc_error_number',
        'xmms.path', 'xmms.session',
        'y2k_compliance',
        'yami.response.timeout',
        'yaz.keepalive', 'yaz.log_file', 'yaz.log_mask', 'yaz.max_links',
        'zend.enable_gc', 'zend.multibyte', 'zend.script_encoding', 'zend.signal_check', 'zend.ze1_compatibility_mode',
        'zlib.output_compression', 'zlib.output_compression_level', 'zlib.output_handler');

    expectedArguments(\ini_get(), 0, argumentsSet("ini_values"));
    expectedArguments(\ini_set(), 0, argumentsSet("ini_values"));
    expectedArguments(\ini_alter(), 0, argumentsSet("ini_values"));
    expectedArguments(\ini_restore(), 0, argumentsSet("ini_values"));
    expectedArguments(\get_cfg_var(), 0, argumentsSet("ini_values"));

    expectedArguments(\json_encode(), 1, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_LINE_TERMINATORS | JSON_THROW_ON_ERROR);
    expectedArguments(\json_decode(), 3, JSON_BIGINT_AS_STRING | JSON_OBJECT_AS_ARRAY | JSON_THROW_ON_ERROR);

    expectedArguments(\idn_to_ascii(), 1, IDNA_ALLOW_UNASSIGNED | IDNA_CHECK_BIDI | IDNA_CHECK_CONTEXTJ | IDNA_DEFAULT | IDNA_NONTRANSITIONAL_TO_ASCII | IDNA_NONTRANSITIONAL_TO_UNICODE | IDNA_USE_STD3_RULES);
    expectedArguments(\idn_to_ascii(), 2, INTL_IDNA_VARIANT_UTS46, INTL_IDNA_VARIANT_2003);
    expectedArguments(\idn_to_utf8(), 1, IDNA_ALLOW_UNASSIGNED | IDNA_CHECK_BIDI | IDNA_CHECK_CONTEXTJ | IDNA_DEFAULT | IDNA_NONTRANSITIONAL_TO_ASCII | IDNA_NONTRANSITIONAL_TO_UNICODE | IDNA_USE_STD3_RULES);
    expectedArguments(\idn_to_utf8(), 2, INTL_IDNA_VARIANT_UTS46, INTL_IDNA_VARIANT_2003);

    expectedArguments(\debug_print_backtrace(), 0, DEBUG_BACKTRACE_IGNORE_ARGS);
    expectedArguments(\debug_backtrace(), 0, DEBUG_BACKTRACE_PROVIDE_OBJECT|DEBUG_BACKTRACE_IGNORE_ARGS);

    expectedArguments(\geoip_database_info(), 0, GEOIP_COUNTRY_EDITION,GEOIP_REGION_EDITION_REV0,GEOIP_CITY_EDITION_REV0,GEOIP_ORG_EDITION,GEOIP_ISP_EDITION,GEOIP_CITY_EDITION_REV1,GEOIP_REGION_EDITION_REV1,GEOIP_PROXY_EDITION,GEOIP_ASNUM_EDITION,GEOIP_NETSPEED_EDITION,GEOIP_DOMAIN_EDITION);
    expectedArguments(\count_chars(), 1, 0, 1, 2, 3, 4);
    expectedArguments(\cubrid_fetch_array(), 1, CUBRID_NUM, CUBRID_ASSOC, CUBRID_BOTH);
    expectedArguments(\imagelayereffect(), 1, IMG_EFFECT_REPLACE, IMG_EFFECT_ALPHABLEND, IMG_EFFECT_NORMAL, IMG_EFFECT_OVERLAY, IMG_EFFECT_MULTIPLY);
    expectedArguments(\db2_autocommit(), 1, DB2_AUTOCOMMIT_OFF, DB2_AUTOCOMMIT_ON);

    registerArgumentsSet("mysqliOptions", MYSQLI_OPT_CONNECT_TIMEOUT, MYSQLI_OPT_LOCAL_INFILE, MYSQLI_INIT_COMMAND, MYSQLI_READ_DEFAULT_FILE, MYSQLI_READ_DEFAULT_GROUP, MYSQLI_SERVER_PUBLIC_KEY, MYSQLI_OPT_NET_CMD_BUFFER_SIZE, MYSQLI_OPT_NET_READ_BUFFER_SIZE, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT);
    expectedArguments(\mysqli::options(), 0, argumentsSet("mysqliOptions"));
    expectedArguments(\mysqli_options(), 1, argumentsSet("mysqliOptions"));

    expectedArguments(\SolrClient::setServlet(), 0, \SolrClient::SEARCH_SERVLET_TYPE, \SolrClient::UPDATE_SERVLET_TYPE, \SolrClient::THREADS_SERVLET_TYPE, \SolrClient::PING_SERVLET_TYPE, \SolrClient::TERMS_SERVLET_TYPE);
    expectedArguments(\stream_socket_shutdown(), 1, STREAM_SHUT_RD, STREAM_SHUT_WR, STREAM_SHUT_RDWR);

    function expectedReturnValues($functionReference, $values) {
        return "expectedReturnValues " . $functionReference . ": " . $values;
    }
    expectedReturnValues(\fseek(), 0, -1);
    expectedReturnValues(\SplFileObject::getFlags(), argumentsSet("splFileObjectFlags"));
    expectedReturnValues(\MultipleIterator::getFlags(), argumentsSet("multipleIteratorFlags"));
    expectedReturnValues(\json_last_error(), JSON_ERROR_NONE, JSON_ERROR_DEPTH, JSON_ERROR_STATE_MISMATCH, JSON_ERROR_CTRL_CHAR, JSON_ERROR_SYNTAX, JSON_ERROR_UTF8, JSON_ERROR_RECURSION, JSON_ERROR_INF_OR_NAN, JSON_ERROR_UNSUPPORTED_TYPE, JSON_ERROR_INVALID_PROPERTY_NAME, JSON_ERROR_UTF16);
    expectedReturnValues(\preg_last_error(), PREG_NO_ERROR,PREG_INTERNAL_ERROR,PREG_BACKTRACK_LIMIT_ERROR,PREG_RECURSION_LIMIT_ERROR,PREG_BAD_UTF8_ERROR,PREG_BAD_UTF8_OFFSET_ERROR);

    expectedArguments(\password_hash(), 1, PASSWORD_DEFAULT, PASSWORD_BCRYPT, PASSWORD_ARGON2I, PASSWORD_ARGON2ID);
    expectedArguments(\password_needs_rehash(), 1, PASSWORD_DEFAULT, PASSWORD_BCRYPT, PASSWORD_ARGON2I, PASSWORD_ARGON2ID);

    registerArgumentsSet('pgResultTypes', PGSQL_ASSOC, PGSQL_NUM, PGSQL_BOTH);
    expectedArguments(\pg_fetch_all(), 1, argumentsSet('pgResultTypes'));
    expectedArguments(\pg_fetch_array(), 2, argumentsSet('pgResultTypes'));
    expectedArguments(\pg_get_notify(), 1, argumentsSet('pgResultTypes'));
    expectedArguments(\pg_select(), 3, PGSQL_CONV_FORCE_NULL | PGSQL_DML_NO_CONV | PGSQL_DML_EXEC | PGSQL_DML_ASYNC | PGSQL_DML_STRING);
    expectedArguments(\pg_select(), 4, argumentsSet('pgResultTypes'));

    expectedArguments(\checkdnsrr(), 1, 'A', 'MX', 'NS', 'SOA', 'PTR', 'CNAME', 'AAAA', 'A6', 'SRV', 'NAPTR', 'TXT', 'ANY');

    expectedArguments(\yaml_emit(), 1, YAML_ANY_ENCODING, YAML_UTF8_ENCODING, YAML_UTF16LE_ENCODING, YAML_UTF16BE_ENCODING);
    expectedArguments(\yaml_emit(), 2, YAML_ANY_BREAK, YAML_CR_BREAK, YAML_LN_BREAK, YAML_CRLN_BREAK);

//  override( \ServiceLocatorInterface::get(0),
//    map( [
//      "A" => \Exception::class,
//      \ExampleFactory::EXAMPLE_B => ExampleB::class,
//      \EXAMPLE_B => \ExampleB::class,
//      '' =>  '@|\Iterator',
//    ]));

}
