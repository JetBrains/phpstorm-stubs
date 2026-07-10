<?php

namespace StubTests\Framework\DataProvider;

/**
 * Defines categories of PHP stubs based on how the corresponding extension is
 * obtained.
 *
 * The five categories are mutually exclusive and, together, cover every
 * top-level stub directory (enforced by StubsStructureValidatorTest):
 *
 * - {@see StubCategory::CORE}     Language core and the SAPIs shipped with PHP.
 * - {@see StubCategory::BUNDLED}  Extensions compiled in and enabled by default
 *                                 in a standard PHP build (e.g. json, mbstring).
 * - {@see StubCategory::EXTERNAL} Extensions that ship in the PHP source tree or
 *                                 build against a system library and are enabled
 *                                 at compile time (docker-php-ext-install /
 *                                 ./configure --with|--enable) but are NOT
 *                                 distributed through PECL.
 * - {@see StubCategory::PECL}     Extensions whose primary distribution channel
 *                                 is PECL (`pecl install <ext>`).
 * - {@see StubCategory::OTHERS}   Everything else: commercial/proprietary agents,
 *                                 alternative runtimes and abandoned projects that
 *                                 are installed neither via PECL nor as a bundled
 *                                 PHP extension.
 *
 * Directory lists are kept sorted alphabetically (case-insensitive) for easy
 * diffing and maintenance.
 */
enum StubCategory: string
{
    /**
     * PHP language core and the SAPIs bundled with the PHP distribution.
     * Includes the SAPIs apache, litespeed, fpm and phpdbg.
     */
    case CORE = 'core';

    /**
     * Extensions compiled in and enabled by default in a standard PHP build
     * (present in the official php:* Docker images without docker-php-ext-install).
     */
    case BUNDLED = 'bundled';

    /**
     * Extensions that ship in the PHP source tree or build against a system
     * library and are enabled at compile time (docker-php-ext-install /
     * ./configure), but are NOT distributed via PECL. Includes historically
     * bundled extensions that were later removed (ereg/regex, wddx, recode, the
     * old mysql/mssql/sybase/interbase drivers, xmlrpc).
     */
    case EXTERNAL = 'external';

    /**
     * Extensions whose primary distribution channel is PECL.
     * All third-party extensions installable via `pecl install`.
     */
    case PECL = 'pecl';

    /**
     * Everything that is installed neither via PECL nor as a bundled PHP
     * extension: commercial/proprietary agents (blackfire, newrelic, ddtrace,
     * elastic_apm, pdflib, relay, SaxonC), Zend commercial products
     * (ZendCache, ZendDebugger, ZendUtils, zend), alternative runtimes
     * (frankenphp) and abandoned projects (suhosin, xcache, wincache, winbinder).
     */
    case OTHERS = 'others';

    /**
     * Get the list of directories for this category.
     *
     * @return string[]
     */
    public function getDirectories(): array
    {
        return match ($this) {
            self::CORE => [
                'apache',
                'Core',
                'date',
                'filter',
                'fpm',
                'hash',
                'io',
                'litespeed',
                'meta',
                'pcre',
                'Phar',
                'phpdbg',
                'random',
                'Reflection',
                'session',
                'SPL',
                'standard',
                'superglobals',
                'tokenizer',
                'uri',
            ],
            self::BUNDLED => [
                'ctype',
                'curl',
                'dom',
                'fileinfo',
                'iconv',
                'json',
                'libxml',
                'mbstring',
                'openssl',
                'PDO',
                'posix',
                'readline',
                'SimpleXML',
                'sodium',
                'sqlite3',
                'xml',
                'xmlreader',
                'xmlwriter',
                'zlib',
            ],
            self::EXTERNAL => [
                'bcmath',
                'bz2',
                'calendar',
                'com_dotnet',
                'dba',
                'enchant',
                'exif',
                'FFI',
                'ftp',
                'gd',
                'gettext',
                'gmp',
                'imap',
                'interbase',
                'intl',
                'ldap',
                'mcrypt',
                'mssql',
                'mysql',
                'mysqli',
                'oci8',
                'odbc',
                'pcntl',
                'pgsql',
                'pspell',
                'recode',
                'regex',
                'shmop',
                'snmp',
                'soap',
                'sockets',
                'sybase',
                'sysvmsg',
                'sysvsem',
                'sysvshm',
                'tidy',
                'wddx',
                'xmlrpc',
                'xsl',
                'Zend OPcache',
                'zip',
            ],
            self::PECL => [
                'aerospike',
                'amqp',
                'apcu',
                'ast',
                'brotli',
                'cassandra',
                'couchbase',
                'couchbase_v2',
                'crypto',
                'cubrid',
                'decimal',
                'dio',
                'ds',
                'ds_v2',
                'eio',
                'Ev',
                'event',
                'excimer',
                'expect',
                'fann',
                'ffmpeg',
                'gearman',
                'geoip',
                'geos',
                'gmagick',
                'gnupg',
                'grpc',
                'http',
                'ibm_db2',
                'igbinary',
                'imagick',
                'inotify',
                'jsonpath',
                'judy',
                'leveldb',
                'libevent',
                'libsodium',
                'libvirt-php',
                'lua',
                'LuaSandbox',
                'lzf',
                'mailparse',
                'mapscript',
                'maxminddb',
                'memcache',
                'memcached',
                'meminfo',
                'ming',
                'mongo',
                'mongodb',
                'mosquitto-php',
                'mqseries',
                'msgpack',
                'mysql_xdevapi',
                'ncurses',
                'oauth',
                'opentelemetry',
                'pam',
                'parallel',
                'Parle',
                'pcov',
                'pq',
                'pthreads',
                'radius',
                'rar',
                'rdkafka',
                'redis',
                'rpminfo',
                'rrd',
                'simdjson',
                'simple_kafka_client',
                'snappy',
                'solr',
                'SplType',
                'SQLite',
                'sqlsrv',
                'ssh2',
                'stats',
                'stomp',
                'svm',
                'svn',
                'swoole',
                'sync',
                'uopz',
                'uploadprogress',
                'uuid',
                'uv',
                'v8js',
                'win32service',
                'xdebug',
                'xdiff',
                'xhprof',
                'xlswriter',
                'xxtea',
                'yaf',
                'yaml',
                'yar',
                'zmq',
                'zookeeper',
                'zstd',
            ],
            self::OTHERS => [
                'blackfire',
                'ddtrace',
                'elastic_apm',
                'frankenphp',
                'newrelic',
                'pdflib',
                'relay',
                'SaxonC',
                'suhosin',
                'winbinder',
                'wincache',
                'xcache',
                'zend',
                'ZendCache',
                'ZendDebugger',
                'ZendUtils',
            ],
        };
    }

    /**
     * Check if a given directory path belongs to this category.
     *
     * Categories are explicit and mutually exclusive, so this is a plain
     * membership test. A directory that is not listed in any category is
     * intentionally reported as belonging to none — StubsStructureValidatorTest
     * fails in that case so the new directory must be classified deliberately.
     *
     * @param string $directoryName The directory name (not full path)
     * @return bool
     */
    public function containsDirectory(string $directoryName): bool
    {
        /** @var array<string, array<string, true>> $index */
        static $index = [];

        if (!isset($index[$this->value])) {
            $index[$this->value] = array_fill_keys($this->getDirectories(), true);
        }

        return isset($index[$this->value][$directoryName]);
    }
}
