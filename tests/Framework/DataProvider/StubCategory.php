<?php

namespace StubTests\Framework\DataProvider;

/**
 * Defines categories of PHP stubs based on their bundling with PHP.
 *
 * This categorization helps differentiate between:
 * - Core PHP functionality
 * - Extensions bundled with PHP
 * - External extensions typically compiled separately
 * - PECL extensions installed via pecl
 */
enum StubCategory: string
{
    /**
     * Core PHP functionality and essential extensions.
     * Directories: Core, date, filter, fpm, hash, meta, pcre, random, Phar,
     * Reflection, regex, session, SPL, standard, superglobals, tokenizer
     */
    case CORE = 'core';

    /**
     * Extensions bundled with PHP but can be disabled at compile time.
     * Directories: apache, bcmath, calendar, ctype, dba, exif, fileinfo, ftp,
     * gd, iconv, intl, json, litespeed, mbstring, pcntl, PDO, posix, shmop,
     * sockets, sqlite3, sysvmsg, sysvsem, sysvshm, xmlrpc, zlib
     */
    case BUNDLED = 'bundled';

    /**
     * External extensions that are commonly available but require separate compilation.
     * Directories: aerospike, bz2, curl, dom, enchant, gettext, gmp, imap, ldap,
     * libxml, mcrypt, mssql, mysql, mysqli, oci8, odbc, openssl, pdo_ibm,
     * pdo_mysql, pdo_pgsql, pdo_sqlite, pgsql, pspell, readline, recode,
     * SimpleXML, snmp, soap, sodium, sybase, tidy, wddx, xml, xmlreader,
     * xmlwriter, xsl, Zend OPcache, zip
     */
    case EXTERNAL = 'external';

    /**
     * PECL extensions - third-party extensions not bundled with PHP.
     * All directories not in CORE, BUNDLED, or EXTERNAL categories.
     */
    case PECL = 'pecl';

    /**
     * Get the list of directories for this category.
     *
     * @return string[]
     */
    public function getDirectories(): array
    {
        return match ($this) {
            self::CORE => [
                'Core',
                'date',
                'filter',
                'fpm',
                'hash',
                'meta',
                'pcre',
                'random',
                'Phar',
                'Reflection',
                'regex',
                'session',
                'SPL',
                'standard',
                'superglobals',
                'tokenizer',
                'uri'
            ],
            self::BUNDLED => [
                'apache',
                'bcmath',
                'calendar',
                'ctype',
                'dba',
                'exif',
                'fileinfo',
                'ftp',
                'gd',
                'iconv',
                'intl',
                'json',
                'litespeed',
                'mbstring',
                'pcntl',
                'PDO',
                'posix',
                'shmop',
                'sockets',
                'sqlite3',
                'sysvmsg',
                'sysvsem',
                'sysvshm',
                'xmlrpc',
                'zlib'
            ],
            self::EXTERNAL => [
                'aerospike',
                'bz2',
                'curl',
                'dom',
                'enchant',
                'gettext',
                'gmp',
                'imap',
                'ldap',
                'libxml',
                'mcrypt',
                'mssql',
                'mysql',
                'mysqli',
                'oci8',
                'odbc',
                'openssl',
                'pdo_ibm',
                'pdo_mysql',
                'pdo_pgsql',
                'pdo_sqlite',
                'pgsql',
                'pspell',
                'readline',
                'recode',
                'SimpleXML',
                'snmp',
                'soap',
                'sodium',
                'sybase',
                'tidy',
                'wddx',
                'xml',
                'xmlreader',
                'xmlwriter',
                'xsl',
                'Zend OPcache',
                'zip'
            ],
            self::PECL => [
                'Ev',
                'FFI',
                'LuaSandbox',
                'Parle',
                'SQLite',
                'SaxonC',
                'SplType',
                'ZendCache',
                'ZendDebugger',
                'ZendUtils',
                'amqp',
                'apcu',
                'ast',
                'blackfire',
                'brotli',
                'cassandra',
                'com_dotnet',
                'couchbase',
                'couchbase_v2',
                'crypto',
                'cubrid',
                'decimal',
                'ddtrace',
                'dio',
                'ds',
                'ds_v2',
                'eio',
                'elastic_apm',
                'event',
                'excimer',
                'expect',
                'fann',
                'ffmpeg',
                'frankenphp',
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
                'interbase',
                'jsonpath',
                'judy',
                'leveldb',
                'libevent',
                'libsodium',
                'libvirt-php',
                'lua',
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
                'newrelic',
                'oauth',
                'opentelemetry',
                'pam',
                'parallel',
                'pcov',
                'pdflib',
                'phpdbg',
                'pq',
                'pthreads',
                'radius',
                'rar',
                'rdkafka',
                'redis',
                'relay',
                'rpminfo',
                'rrd',
                'simdjson',
                'simple_kafka_client',
                'snappy',
                'solr',
                'sqlsrv',
                'ssh2',
                'stats',
                'stomp',
                'suhosin',
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
                'winbinder',
                'wincache',
                'xcache',
                'xdebug',
                'xdiff',
                'xhprof',
                'xlswriter',
                'xxtea',
                'yaf',
                'yaml',
                'yar',
                'zend',
                'zmq',
                'zookeeper',
                'zstd',
            ]
        };
    }

    /**
     * Check if a given directory path belongs to this category.
     *
     * For PECL, uses exclusion logic: any directory NOT in CORE, BUNDLED, or EXTERNAL
     * is considered PECL. This is consistent with CoreStubsDataProvider's filtering.
     *
     * @param string $directoryName The directory name (not full path)
     * @return bool
     */
    public function containsDirectory(string $directoryName): bool
    {
        if ($this === self::PECL) {
            return !self::CORE->containsDirectory($directoryName)
                && !self::BUNDLED->containsDirectory($directoryName)
                && !self::EXTERNAL->containsDirectory($directoryName);
        }

        /** @var array<string, array<string, true>> $index */
        static $index = [];

        if (!isset($index[$this->value])) {
            $index[$this->value] = array_fill_keys($this->getDirectories(), true);
        }

        return isset($index[$this->value][$directoryName]);
    }
}
