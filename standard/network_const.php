<?php
/**
 * PHPStorm stub file for Network constants.
 *
 * @link http://php.net/manual/en/network.constants.php
 */

/**
 * IPv4 Address Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_A = 1;
const DNS_A6 = 16777216;
/**
 * IPv6 Address Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_AAAA = 134217728;
/**
 * Iteratively query the name server for
 * each available record type.
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_ALL = 251713587;
/**
 * Any Resource Record. On most systems
 * this returns all resource records, however
 * it should not be counted upon for critical
 * uses. Try DNS_ALL instead.
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_ANY = 268435456;
/**
 * Alias (Canonical Name) Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_CNAME = 16;
/**
 * Host Info Resource (See IANA's
 * Operating System Names
 * for the meaning of these values)
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_HINFO = 4096;
/**
 * Mail Exchanger Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_MX = 16384;
const DNS_NAPTR = 67108864;
/**
 * Authoritative Name Server Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_NS = 2;
/**
 * Pointer Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_PTR = 2048;
/**
 * Start of Authority Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_SOA = 32;
const DNS_SRV = 33554432;
/**
 * Text Resource
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const DNS_TXT = 32768;
/**
 * action must be taken immediately
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_ALERT = 1;
/**
 * security/authorization messages (use <b>LOG_AUTHPRIV</b> instead
 * in systems where that constant is defined)
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_AUTH = 32;
/**
 * security/authorization messages (private)
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_AUTHPRIV = 80;
/**
 * if there is an error while sending data to the system logger,
 * write directly to the system console
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_CONS = 2;
/**
 * critical conditions
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_CRIT = 2;
/**
 * clock daemon (cron and at)
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_CRON = 72;
/**
 * other system daemons
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_DAEMON = 24;
/**
 * debug-level message
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_DEBUG = 7;
/**
 * system is unusable
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_EMERG = 0;
/**
 * error conditions
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_ERR = 3;
/**
 * informational message
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_INFO = 6;
/**
 * kernel messages
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_KERN = 0;
const LOG_LOCAL0 = 128;
const LOG_LOCAL1 = 136;
const LOG_LOCAL2 = 144;
const LOG_LOCAL3 = 152;
const LOG_LOCAL4 = 160;
const LOG_LOCAL5 = 168;
const LOG_LOCAL6 = 176;
const LOG_LOCAL7 = 184;
/**
 * line printer subsystem
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_LPR = 48;
/**
 * mail subsystem
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_MAIL = 16;
/**
 * open the connection to the logger immediately
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_NDELAY = 8;
/**
 * USENET news subsystem
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_NEWS = 56;
/**
 * normal, but significant, condition
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_NOTICE = 5;
const LOG_NOWAIT = 16;
/**
 * (default) delay opening the connection until the first
 * message is logged
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_ODELAY = 4;
/**
 * print log message also to standard error
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_PERROR = 32;
/**
 * include PID with each message
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_PID = 1;
/**
 * messages generated internally by syslogd
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_SYSLOG = 40;
/**
 * generic user-level messages
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_USER = 8;
/**
 * UUCP subsystem
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_UUCP = 64;
/**
 * warning conditions
 *
 * @link http://php.net/manual/en/network.constants.php
 */
const LOG_WARNING = 4;
