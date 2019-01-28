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

    expectedArguments(\count(), 1, COUNT_NORMAL, COUNT_RECURSIVE);
    expectedArguments(\apc_bin_dumpfile(), 3, FILE_USE_INCLUDE_PATH, FILE_APPEND, LOCK_EX);
    expectedArguments(\apc_bin_load(), 3, APC_BIN_VERIFY_CRC32|APC_BIN_VERIFY_MD5);
    expectedArguments(\apc_bin_loadfile(), 3, APC_BIN_VERIFY_CRC32|APC_BIN_VERIFY_MD5);
    expectedArguments(\jdmonthname(), 1, CAL_MONTH_GREGORIAN_SHORT,CAL_MONTH_GREGORIAN_LONG,CAL_MONTH_JULIAN_SHORT,CAL_MONTH_JULIAN_LONG,CAL_MONTH_JEWISH,CAL_MONTH_FRENCH);
    expectedArguments(\variant_cmp(), 0, NORM_IGNORECASE|NORM_IGNORENONSPACE|NORM_IGNORESYMBOLS|NORM_IGNOREWIDTH|NORM_IGNOREKANATYPE|NORM_IGNOREKASHIDA);

    expectedArguments(\DOMDocument::schemaValidateSource(), 1, LIBXML_SCHEMA_CREATE);
    expectedArguments(\EvLoop::__construct(), 0, \Ev::FLAG_AUTO,\Ev::FLAG_NOENV,\Ev::FLAG_FORKCHECK,\Ev::FLAG_NOINOTIFY,\Ev::FLAG_SIGNALFD,\Ev::FLAG_NOSIGMASK); //todo support
    expectedArguments(\Ev::run(), 0, \Ev::FLAG_AUTO,\Ev::FLAG_NOENV,\Ev::FLAG_FORKCHECK,\Ev::FLAG_NOINOTIFY,\Ev::FLAG_SIGNALFD,\Ev::FLAG_NOSIGMASK);
    expectedArguments(\EvLoop::run(), 0, \Ev::RUN_NOWAIT,\Ev::RUN_ONCE);
    expectedArguments(\EvLoop::defaultLoop(), 0, \Ev::FLAG_AUTO,\Ev::FLAG_NOENV,\Ev::FLAG_FORKCHECK,\Ev::FLAG_NOINOTIFY,\Ev::FLAG_SIGNALFD,\Ev::FLAG_NOSIGMASK);
    expectedArguments(\Event::pending(), 0, \Event::READ|\Event::WRITE|\Event::TIMEOUT|\Event::SIGNAL);
    expectedArguments(\EventBase::loop(), 0, \EventBase::LOOP_ONCE, \EventBase::LOOP_NONBLOCK, \EventBase::NOLOCK, \EventBase::STARTUP_IOCP, \EventBase::NO_CACHE_TIME, \EventBase::EPOLL_USE_CHANGELIST);

	expectedArguments(\extension_loaded(), 0, 'amqp', 'apache', 'apc', 'apd', 'bbcode', 'bcmath', 'bcompiler', 'bz2', 'cairo', 'calendar', 'chdb', 'classkit', 'com', 'crack', 'ctype', 'cubrid', 'curl', 'cyrus', 'dba', 'dbase', 'dbplus', 'dbx', 'dio', 'dom', 'dotnet', 'eio', 'enchant', 'ev', 'event', 'exif', 'expect', 'fam', 'fbsql', 'fdf', 'fileinfo', 'filepro', 'filter', 'fribidi', 'ftp', 'gearman', 'gender', 'geoip', 'gettext', 'gmagick', 'gmp', 'gnupg', 'gupnp', 'haru', 'htscanner', 'pecl_http', 'hyperwave', 'hwapi', 'interbase', 'ibm_db2', 'iconv', 'id3', 'informix', 'iisfunc', 'gd', 'imagick', 'imap', 'inclued', 'ingres', 'inotify', 'intl', 'java', 'json', 'judy', 'kadm5', 'ktaglib', 'lapack', 'ldap', 'libevent', 'libxml', 'lua', 'lzf', 'mailparse', 'maxdb', 'mbstring', 'mcrypt', 'mcve', 'memcache', 'memcached', 'memtrack', 'mhash', 'ming', 'mnogosearch', 'mongo', 'mqseries', 'msession', 'msql', 'mssql', 'mysql', 'mysqli', 'mysqlnd', 'mysqlnd_memcache', 'mysqlnd_ms', 'mysqlnd_mux', 'mysqlnd_qc', 'mysqlnd_uh', 'ncurses', 'net_gopher', 'newt', 'notes', 'nsapi', 'oauth', 'oci8', 'oggvorbis', 'openal', 'openssl', 'ovrimos', 'paradox', 'parsekit', 'pcntl', 'pcre', 'pdflib', 'pdo', 'pdo_4d', 'pdo_cubrid', 'pdo_dblib', 'pdo_firebird', 'pdo_ibm', 'pdo_informix', 'pdo_mysql', 'pdo_oci', 'pdo_odbc', 'pdo_pgsql', 'pdo_sqlite', 'pdo_sqlsrv', 'pdo_pgsql', 'phar', 'posix', 'printer', 'proctitle', 'ps', 'pspell', 'pthreads', 'qtdom', 'quickhash', 'radius', 'rar', 'readline', 'recode', 'rpmreader', 'rrd', 'runkit', 'sam', 'sca', 'scream', 'sca_sdo', 'sysvmsg', 'session', 'session_pgsql', 'shmop', 'simplexml', 'snmp', 'soap', 'sockets', 'solr', 'sphinx', 'spl_types', 'spplus', 'sqlite', 'sqlite3', 'sqlsrv', 'ssdeep', 'ssh2', 'stats', 'stomp', 'svm', 'svn', 'swf', 'swish', 'sybase', 'taint', 'tcpwrap', 'tidy', 'tokenizer', 'tokyo_tyrant', 'trader', 'odbc', 'v8js', 'varnish', 'vpopmail', 'w32api', 'wddx', 'weakref', 'win32ps', 'win32service', 'wincache', 'xattr', 'xdiff', 'xhprof', 'xml', 'xmlreader', 'xmlrpc', 'xmlwriter', 'xsl', 'xslt', 'yaf', 'yaml', 'yaz', 'zip', 'zlib');

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

    expectedArguments(\iconv_mime_decode(), 1, ICONV_MIME_DECODE_STRICT,ICONV_MIME_DECODE_CONTINUE_ON_ERROR);
    expectedArguments(\iconv_mime_decode_headers(), 1, ICONV_MIME_DECODE_STRICT,ICONV_MIME_DECODE_CONTINUE_ON_ERROR);
    expectedArguments(\Imagick::setImageAlphaChannel(), 0, \Imagick::ALPHACHANNEL_ACTIVATE,\Imagick::ALPHACHANNEL_BACKGROUND,\Imagick::ALPHACHANNEL_COPY,\Imagick::ALPHACHANNEL_DEACTIVATE,\Imagick::ALPHACHANNEL_EXTRACT,\Imagick::ALPHACHANNEL_FLATTEN,\Imagick::ALPHACHANNEL_DEACTIVATE,\Imagick::ALPHACHANNEL_OPAQUE,\Imagick::ALPHACHANNEL_REMOVE,\Imagick::ALPHACHANNEL_RESET,\Imagick::ALPHACHANNEL_SET,\Imagick::ALPHACHANNEL_SHAPE,\Imagick::ALPHACHANNEL_TRANSPARENT,\Imagick::ALPHACHANNEL_UNDEFINED); //todo introduce byPrefix
    expectedArguments(\Imagick::montageImage(), 3, \Imagick::MONTAGEMODE_FRAME,\Imagick::MONTAGEMODE_UNFRAME,\Imagick::MONTAGEMODE_CONCATENATE);

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
    expectedArguments(\mysqli_stmt::attr_set(), 0, MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH,MYSQLI_STMT_ATTR_CURSOR_TYPE,MYSQLI_STMT_ATTR_PREFETCH_ROWS);
    expectedArguments(\mysqli_begin_transaction(), 1, MYSQLI_TRANS_START_READ_ONLY,MYSQLI_TRANS_START_READ_WRITE,MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
    expectedArguments(\mysqli_report(), 0, MYSQLI_REPORT_OFF,MYSQLI_REPORT_ERROR,MYSQLI_REPORT_STRICT,MYSQLI_REPORT_INDEX,MYSQLI_REPORT_ALL);
    expectedArguments(\mysqli_real_connect(), 7, MYSQLI_CLIENT_COMPRESS|MYSQLI_CLIENT_FOUND_ROWS|MYSQLI_CLIENT_IGNORE_SPACE|MYSQLI_CLIENT_INTERACTIVE|MYSQLI_CLIENT_SSL|MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
    expectedArguments(\mysqli_stmt_attr_set(), 1, MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH,MYSQLI_STMT_ATTR_CURSOR_TYPE,MYSQLI_STMT_ATTR_PREFETCH_ROWS);

	expectedArguments(\ob_start(), 2, \PHP_OUTPUT_HANDLER_CLEANABLE | \PHP_OUTPUT_HANDLER_FLUSHABLE | PHP_OUTPUT_HANDLER_REMOVABLE, PHP_OUTPUT_HANDLER_STDFLAGS);
	expectedArguments(\ob_implicit_flush(), 0, 1, 2);
    expectedArguments(\OCI_Lob::flush(), 0, OCI_LOB_BUFFER_FREE);
    expectedArguments(\oci_execute(), 1, OCI_COMMIT_ON_SUCCESS,OCI_DESCRIBE_ONLY,OCI_NO_AUTO_COMMIT);
    expectedArguments(\odbc_binmode(), 1, ODBC_BINMODE_PASSTHRU,ODBC_BINMODE_RETURN,ODBC_BINMODE_CONVERT);
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
    expectedArguments(\ArrayObject::__construct(), 1, \ArrayObject::STD_PROP_LIST|\ArrayObject::ARRAY_AS_PROPS);
    expectedArguments(\ArrayIterator::__construct(), 1, \ArrayIterator::STD_PROP_LIST|\ArrayIterator::ARRAY_AS_PROPS);

    expectedArguments(\FilesystemIterator::setFlags(), 0, \FilesystemIterator::CURRENT_MODE_MASK,\FilesystemIterator::CURRENT_AS_PATHNAME,\FilesystemIterator::CURRENT_AS_FILEINFO,\FilesystemIterator::CURRENT_AS_SELF,\FilesystemIterator::KEY_MODE_MASK,\FilesystemIterator::KEY_AS_PATHNAME,\FilesystemIterator::FOLLOW_SYMLINKS,\FilesystemIterator::KEY_AS_FILENAME,\FilesystemIterator::NEW_CURRENT_AND_KEY,\FilesystemIterator::SKIP_DOTS,\FilesystemIterator::UNIX_PATHS,\FilesystemIterator::OTHER_MODE_MASK);

    expectedArguments(\SplFileObject::setFlags(), 0, \SplFileObject::DROP_NEW_LINE|\SplFileObject::READ_AHEAD|\SplFileObject::SKIP_EMPTY|\SplFileObject::READ_CSV);
    expectedArguments(\SplDoublyLinkedList::setIteratorMode(), 0, \SplDoublyLinkedList::IT_MODE_LIFO|\SplDoublyLinkedList::IT_MODE_FIFO|\SplDoublyLinkedList::IT_MODE_DELETE|\SplDoublyLinkedList::IT_MODE_KEEP);
    expectedArguments(\SplQueue::setIteratorMode(), 0, \SplDoublyLinkedList::IT_MODE_LIFO|\SplDoublyLinkedList::IT_MODE_FIFO|\SplDoublyLinkedList::IT_MODE_DELETE|\SplDoublyLinkedList::IT_MODE_KEEP);
    expectedArguments(\SplStack::setIteratorMode(), 0, \SplDoublyLinkedList::IT_MODE_LIFO|\SplDoublyLinkedList::IT_MODE_FIFO|\SplDoublyLinkedList::IT_MODE_DELETE|\SplDoublyLinkedList::IT_MODE_KEEP);
    expectedArguments(\SplPriorityQueue::setExtractFlags(), 0, \SplPriorityQueue::EXTR_DATA,\SplPriorityQueue::EXTR_PRIORITY,\SplPriorityQueue::EXTR_BOTH);
    expectedArguments(\MultipleIterator::setFlags(), 0, \MultipleIterator::MIT_NEED_ANY|\MultipleIterator::MIT_NEED_ALL|\MultipleIterator::MIT_KEYS_NUMERIC|\MultipleIterator::MIT_KEYS_ASSOC);

    expectedArguments(\SQLite3::open(), 1, SQLITE3_OPEN_READWRITE|SQLITE3_OPEN_CREATE|SQLITE3_OPEN_READONLY);
    expectedArguments(\SQLite3::createFunction(), 3, SQLITE3_DETERMINISTIC);
    expectedArguments(\SQLite3::openBlob(), 4, SQLITE3_OPEN_READONLY,SQLITE3_OPEN_READWRITE);
    expectedArguments(\SQLite3::__construct(), 1, SQLITE3_OPEN_READWRITE|SQLITE3_OPEN_CREATE|SQLITE3_OPEN_READONLY);
    expectedArguments(\SQLite3Result::fetchArray(), 0, SQLITE3_ASSOC,SQLITE3_NUM,SQLITE3_BOTH);

    expectedArguments(\ssh2_fingerprint(), 1, SSH2_FINGERPRINT_MD5|SSH2_FINGERPRINT_SHA1|SSH2_FINGERPRINT_HEX|SSH2_FINGERPRINT_RAW);
    expectedArguments(\htmlspecialchars(), 1, ENT_COMPAT|ENT_QUOTES|ENT_NOQUOTES|ENT_IGNORE|ENT_SUBSTITUTE|ENT_DISALLOWED|ENT_HTML401|ENT_XML1|ENT_XHTML|ENT_HTML5);
    expectedArguments(\imagecropauto(), 1, IMG_CROP_BLACK,IMG_CROP_DEFAULT,IMG_CROP_SIDES,IMG_CROP_THRESHOLD,IMG_CROP_TRANSPARENT,IMG_CROP_WHITE);
    expectedArguments(\srand(), 1, MT_RAND_MT19937,MT_RAND_PHP);
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


//  override( \ServiceLocatorInterface::get(0),
//    map( [
//      "A" => \Exception::class,
//      \ExampleFactory::EXAMPLE_B => ExampleB::class,
//      \EXAMPLE_B => \ExampleB::class,
//      '' =>  '@|\Iterator',
//    ]));

}
