<?php
/**
 * PHPStorm stub file for Lightweight Directory Access Protocol(LDAP) constants.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */

/**
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_DEREF_ALWAYS = 3;
const LDAP_DEREF_FINDING = 2;
const LDAP_DEREF_NEVER = 0;
const LDAP_DEREF_SEARCHING = 1;
const LDAP_ESCAPE_DN = 2;
const LDAP_ESCAPE_FILTER = 1;
const LDAP_MODIFY_BATCH_ADD = 1;
const LDAP_MODIFY_BATCH_REMOVE = 2;
const LDAP_MODIFY_BATCH_REMOVE_ALL = 18;
const LDAP_MODIFY_BATCH_REPLACE = 3;
/**
 * Specifies a default list of client controls to be processed with each request.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_CLIENT_CONTROLS = 19;
/**
 * Specifies a bitwise level for debug traces.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_DEBUG_LEVEL = 20481;
/**
 * Specifies alternative rules for following aliases at the server.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_DEREF = 2;
const LDAP_OPT_ERROR_NUMBER = 49;
const LDAP_OPT_ERROR_STRING = 50;
const LDAP_OPT_HOST_NAME = 48;
const LDAP_OPT_MATCHED_DN = 51;
/**
 * Option for <b>ldap_set_option</b> to allow setting network timeout.
 * (Available as of PHP 5.3.0)
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_NETWORK_TIMEOUT = 20485;
/**
 * Specifies the LDAP protocol to be used (V2 or V3).
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_PROTOCOL_VERSION = 17;
/**
 * Specifies whether to automatically follow referrals returned
 * by the LDAP server.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_REFERRALS = 8;
const LDAP_OPT_RESTART = 9;
/**
 * Specifies a default list of server controls to be sent with each request.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_SERVER_CONTROLS = 18;
/**
 * <p>
 * Specifies the maximum number of entries that can be
 * returned on a search operation.
 * </p>
 * The actual size limit for operations is also bounded
 * by the server's configured maximum number of return entries.
 * The lesser of these two settings is the actual size limit.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_SIZELIMIT = 3;
/**
 * Specifies the number of seconds to wait for search results.
 * The actual time limit for operations is also bounded
 * by the server's configured maximum time.
 * The lesser of these two settings is the actual time limit.
 *
 * @link http://php.net/manual/en/ldap.constants.php
 */
const LDAP_OPT_TIMELIMIT = 4;
const LDAP_OPT_X_KEEPALIVE_IDLE = 25344;
const LDAP_OPT_X_KEEPALIVE_INTERVAL = 25346;
const LDAP_OPT_X_KEEPALIVE_PROBES = 25345;
const LDAP_OPT_X_SASL_AUTHCID = 24834;
const LDAP_OPT_X_SASL_AUTHZID = 24835;
const LDAP_OPT_X_SASL_MECH = 24832;
const LDAP_OPT_X_SASL_NOCANON = 24843;
const LDAP_OPT_X_SASL_REALM = 24833;
const LDAP_OPT_X_SASL_USERNAME = 24844;
const LDAP_OPT_X_TLS_ALLOW = 3;
/**
 * Specifies the path of the directory containing CA certificates.
 *
 * @link  http://php.net/manual/en/ldap.constants.php
 * @since 7.1
 */
const LDAP_OPT_X_TLS_CACERTDIR = 24579;
/**
 * Specifies the full-path of the CA certificate file.
 *
 * @link  http://php.net/manual/en/ldap.constants.php
 * @since 7.1
 */
const LDAP_OPT_X_TLS_CACERTFILE = 24578;
const LDAP_OPT_X_TLS_CERTFILE = 24580;
const LDAP_OPT_X_TLS_CIPHER_SUITE = 24584;
const LDAP_OPT_X_TLS_CRLCHECK = 24587;
const LDAP_OPT_X_TLS_CRLFILE = 24592;
const LDAP_OPT_X_TLS_CRL_ALL = 2;
const LDAP_OPT_X_TLS_CRL_NONE = 0;
const LDAP_OPT_X_TLS_CRL_PEER = 1;
const LDAP_OPT_X_TLS_DEMAND = 2;
const LDAP_OPT_X_TLS_DHFILE = 24590;
const LDAP_OPT_X_TLS_HARD = 1;
const LDAP_OPT_X_TLS_KEYFILE = 24581;
const LDAP_OPT_X_TLS_NEVER = 0;
const LDAP_OPT_X_TLS_PACKAGE = 24593;
const LDAP_OPT_X_TLS_PROTOCOL_MIN = 24583;
const LDAP_OPT_X_TLS_PROTOCOL_SSL2 = 512;
const LDAP_OPT_X_TLS_PROTOCOL_SSL3 = 768;
const LDAP_OPT_X_TLS_PROTOCOL_TLS1_0 = 769;
const LDAP_OPT_X_TLS_PROTOCOL_TLS1_1 = 770;
const LDAP_OPT_X_TLS_PROTOCOL_TLS1_2 = 771;
const LDAP_OPT_X_TLS_RANDOM_FILE = 24585;
const LDAP_OPT_X_TLS_REQUIRE_CERT = 24582;
const LDAP_OPT_X_TLS_TRY = 4;
