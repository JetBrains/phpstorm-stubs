<?php

//TODO: copy proper descriptions for all constants from https://php.net/manual/en/function.curl-setopt.php

/**
 * A bitmask consisting of one or more of
 * <b>CURLSSH_AUTH_PUBLICKEY</b>,
 * <b>CURLSSH_AUTH_PASSWORD</b>,
 * <b>CURLSSH_AUTH_HOST</b>,
 * <b>CURLSSH_AUTH_KEYBOARD</b>. Set to
 * <b>CURLSSH_AUTH_ANY</b> to let libcurl pick one.
 */
define('CURLOPT_SSH_AUTH_TYPES', 151);

/**
 * @since 5.5.0
 * @link https://php.net/manual/en/function.curl-setopt.php
 * <b>TRUE</b> tells the library to perform all the required proxy authentication
 * and connection setup, but no data transfer. This option is implemented for
 * HTTP, SMTP and POP3.
 */
define ('CURLOPT_CONNECT_ONLY', 141);

/**
 * @since 5.3.7
 */
define('CURLINFO_REDIRECT_URL', 1048607);

/**
 * @since 5.4.7
 */
define('CURLINFO_PRIMARY_IP', 1048608);
/**
 * @since 5.4.7
 */
define('CURLINFO_PRIMARY_PORT', 2097192);
/**
 * @since 5.4.7
 */
define('CURLINFO_LOCAL_IP', 1048617);
/**
 * @since 5.4.7
 */
define('CURLINFO_LOCAL_PORT', 2097194);
/**
 * A result of {@see curl_share_init()}. Makes the cURL handle to use the data from the shared handle.
 * @link https://php.net/manual/en/function.curl-setopt.php
 * @since 5.5.0
 */
define ('CURLOPT_SHARE', 10100);
define ('CURLOPT_IPRESOLVE', 113);
define ('CURL_IPRESOLVE_WHATEVER', 0);
define ('CURL_IPRESOLVE_V4', 1);
define ('CURL_IPRESOLVE_V6', 2);
define ('CURLOPT_DNS_USE_GLOBAL_CACHE', 91);
define ('CURLOPT_DNS_CACHE_TIMEOUT', 92);
define ('CURLOPT_PORT', 3);
define ('CURLOPT_FILE', 10001);
define ('CURLOPT_READDATA', 10009);
define ('CURLOPT_INFILE', 10009);
define ('CURLOPT_INFILESIZE', 14);
define ('CURLOPT_URL', 10002);
define ('CURLOPT_PROXY', 10004);
define ('CURLOPT_VERBOSE', 41);
define ('CURLOPT_HEADER', 42);
define ('CURLOPT_HTTPHEADER', 10023);
define ('CURLOPT_NOPROGRESS', 43);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.3.0
 */
define ('CURLOPT_PROGRESSFUNCTION', 20056);
define ('CURLOPT_NOBODY', 44);
define ('CURLOPT_FAILONERROR', 45);
define ('CURLOPT_UPLOAD', 46);
define ('CURLOPT_POST', 47);
define ('CURLOPT_FTPLISTONLY', 48);
define ('CURLOPT_FTPAPPEND', 50);
define ('CURLOPT_NETRC', 51);

/**
 * @link https://secure.php.net/manual/en/function.curl-setopt.php
 * @since 5.3.2
 */
define ('CURLOPT_POSTREDIR', 161);
define ('CURLOPT_CERTINFO', -1);
define ('CURLOPT_FTPASCII', -1);
define ('CURLOPT_MUTE', -1);
define ('CURLOPT_PROTOCOLS', -1);
define ('CURLOPT_REDIR_PROTOCOLS', -1);
define ('CURLOPT_MAX_RECV_SPEED_LARGE', -1);
define ('CURLOPT_MAX_SEND_SPEED_LARGE', -1);
define ('CURLOPT_PASSWDFUNCTION', -1);

/**
 * This constant is not available when open_basedir 
 * or safe_mode are enabled.
 * @link https://php.net/manual/en/curl.constants.php
 */
define ('CURLOPT_FOLLOWLOCATION', 52);
define ('CURLOPT_PUT', 54);
define ('CURLOPT_USERPWD', 10005);
define ('CURLOPT_PROXYUSERPWD', 10006);
define ('CURLOPT_RANGE', 10007);
define ('CURLOPT_TIMEOUT', 13);
define ('CURLOPT_TIMEOUT_MS', 155);
define ('CURLOPT_POSTFIELDS', 10015);
define ('CURLOPT_REFERER', 10016);
/**
 * @link https://php.net/manual/en/function.curl-setopt.php
 */
define ('CURLOPT_SSH_HOST_PUBLIC_KEY_MD5', 10162);
/**
 * @link https://php.net/manual/en/function.curl-setopt.php
 */
define ('CURLOPT_SSH_PUBLIC_KEYFILE', 10152);
/**
 * @link https://php.net/manual/en/function.curl-setopt.php
 */
define ('CURLOPT_SSH_PRIVATE_KEYFILE', 10153);
define ('CURLOPT_USERAGENT', 10018);
define ('CURLOPT_FTPPORT', 10017);
define ('CURLOPT_FTP_USE_EPSV', 85);
define ('CURLOPT_LOW_SPEED_LIMIT', 19);
define ('CURLOPT_LOW_SPEED_TIME', 20);
define ('CURLOPT_RESUME_FROM', 21);
define ('CURLOPT_COOKIE', 10022);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
define ('CURLOPT_COOKIESESSION', 96);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
define ('CURLOPT_AUTOREFERER', 58);
define ('CURLOPT_SSLCERT', 10025);
define ('CURLOPT_SSLCERTPASSWD', 10026);
define ('CURLOPT_WRITEHEADER', 10029);
define ('CURLOPT_SSL_VERIFYHOST', 81);
define ('CURLOPT_COOKIEFILE', 10031);
define ('CURLOPT_SSLVERSION', 32);
define ('CURL_SSLVERSION_DEFAULT', 0);
define ('CURL_SSLVERSION_TLSv1',1);
define ('CURL_SSLVERSION_SSLv2',2);
define ('CURL_SSLVERSION_SSLv3',3);

/**
 * @since 5.6.3
 * @since 5.5.19
 */
define ('CURL_SSLVERSION_TLSv1_0',4);

/**
 * @since 5.6.3
 * @since 5.5.19
 */
define ('CURL_SSLVERSION_TLSv1_1',5);

/**
 * @since 5.6.3
 * @since 5.5.19
 */
define('CURL_SSLVERSION_TLSv1_2', 6);

define ('CURLOPT_TIMECONDITION', 33);
define ('CURLOPT_TIMEVALUE', 34);
define ('CURLOPT_CUSTOMREQUEST', 10036);
define ('CURLOPT_STDERR', 10037);
define ('CURLOPT_TRANSFERTEXT', 53);
define ('CURLOPT_RETURNTRANSFER', 19913);
define ('CURLOPT_QUOTE', 10028);
define ('CURLOPT_POSTQUOTE', 10039);
define ('CURLOPT_INTERFACE', 10062);
define ('CURLOPT_KRB4LEVEL', 10063);
define ('CURLOPT_HTTPPROXYTUNNEL', 61);
define ('CURLOPT_FILETIME', 69);
define ('CURLOPT_WRITEFUNCTION', 20011);
define ('CURLOPT_READFUNCTION', 20012);
define ('CURLOPT_HEADERFUNCTION', 20079);
define ('CURLOPT_MAXREDIRS', 68);
define ('CURLOPT_MAXCONNECTS', 71);
define ('CURLOPT_CLOSEPOLICY', 72);
define ('CURLOPT_FRESH_CONNECT', 74);
define ('CURLOPT_FORBID_REUSE', 75);
define ('CURLOPT_RANDOM_FILE', 10076);
define ('CURLOPT_EGDSOCKET', 10077);
define ('CURLOPT_CONNECTTIMEOUT', 78);
define ('CURLOPT_CONNECTTIMEOUT_MS', 156);
define ('CURLOPT_SSL_VERIFYPEER', 64);
define ('CURLOPT_CAINFO', 10065);
define ('CURLOPT_CAPATH', 10097);
define ('CURLOPT_COOKIEJAR', 10082);
define ('CURLOPT_SSL_CIPHER_LIST', 10083);
define ('CURLOPT_BINARYTRANSFER', 19914);
define ('CURLOPT_NOSIGNAL', 99);
define ('CURLOPT_PROXYTYPE', 101);
define ('CURLOPT_BUFFERSIZE', 98);
define ('CURLOPT_HTTPGET', 80);
define ('CURLOPT_HTTP_VERSION', 84);
define ('CURLOPT_SSLKEY', 10087);
define ('CURLOPT_SSLKEYTYPE', 10088);
define ('CURLOPT_SSLKEYPASSWD', 10026);
define ('CURLOPT_SSLENGINE', 10089);
define ('CURLOPT_SSLENGINE_DEFAULT', 90);
define ('CURLOPT_SSLCERTTYPE', 10086);
define ('CURLOPT_CRLF', 27);
define ('CURLOPT_ENCODING', 10102);
define ('CURLOPT_PROXYPORT', 59);
define ('CURLOPT_UNRESTRICTED_AUTH', 105);
define ('CURLOPT_FTP_USE_EPRT', 106);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.1
 */
define ('CURLOPT_TCP_NODELAY', 121);
define ('CURLOPT_HTTP200ALIASES', 10104);
define ('CURL_TIMECOND_IFMODSINCE', 1);
define ('CURL_TIMECOND_IFUNMODSINCE', 2);
define ('CURL_TIMECOND_LASTMOD', 3);
define ('CURLOPT_HTTPAUTH', 107);
define ('CURLAUTH_BASIC', 1);
define ('CURLAUTH_DIGEST', 2);
define ('CURLAUTH_GSSNEGOTIATE', 4);
define ('CURLAUTH_NTLM', 8);
define ('CURLAUTH_ANY', -1);
define ('CURLAUTH_ANYSAFE', -2);
define ('CURLOPT_PROXYAUTH', 111);
define ('CURLOPT_FTP_CREATE_MISSING_DIRS', 110);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.4
 */
define ('CURLOPT_PRIVATE', 10103);

/**
 * The last response code
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_RESPONSE_CODE', 2097154);
/**
 * The CONNECT response code
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_HTTP_CONNECTCODE', 2097174);
/**
 * Bitmask indicating the authentication method(s) available according to the previous response
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_HTTPAUTH_AVAIL', 2097175);
/**
 * Bitmask indicating the proxy authentication method(s) available according to the previous response
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_PROXYAUTH_AVAIL', 2097176);
/**
 * Errno from a connect failure. The number is OS and system specific.
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_OS_ERRNO', 2097177);
/**
 * Number of connections curl had to create to achieve the previous transfer
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_NUM_CONNECTS', 2097178);
/**
 * OpenSSL crypto-engines supported
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_SSL_ENGINES', 4194331);
/**
 * All known cookies
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_COOKIELIST', 4194332);
/**
 * Entry path in FTP server
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_FTP_ENTRY_PATH', 1048606);
/**
 * Time in seconds it took from the start until the SSL/SSH connect/handshake to the remote host was completed
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_APPCONNECT_TIME',3145761);
/**
 * TLS certificate chain
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_CERTINFO', 4194338);
/**
 * Info on unmet time conditional
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_CONDITION_UNMET', 2097187);
/**
 * Next RTSP client CSeq
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_RTSP_CLIENT_CSEQ', 2097189);
/**
 * Recently received CSeq
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_RTSP_CSEQ_RECV', 2097191);
/**
 * Next RTSP server CSeq
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_RTSP_SERVER_CSEQ', 2097190);
/**
 * RTSP session ID
 * @link https://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
define ('CURLINFO_RTSP_SESSION_ID', 1048612);
define ('CURLCLOSEPOLICY_LEAST_RECENTLY_USED', 2);
define ('CURLCLOSEPOLICY_LEAST_TRAFFIC', 3);
define ('CURLCLOSEPOLICY_SLOWEST', 4);
define ('CURLCLOSEPOLICY_CALLBACK', 5);
define ('CURLCLOSEPOLICY_OLDEST', 1);
define ('CURLINFO_EFFECTIVE_URL', 1048577);
define ('CURLINFO_HTTP_CODE', 2097154);
define ('CURLINFO_HEADER_SIZE', 2097163);
define ('CURLINFO_REQUEST_SIZE', 2097164);
define ('CURLINFO_TOTAL_TIME', 3145731);
define ('CURLINFO_NAMELOOKUP_TIME', 3145732);
define ('CURLINFO_CONNECT_TIME', 3145733);
define ('CURLINFO_PRETRANSFER_TIME', 3145734);
define ('CURLINFO_SIZE_UPLOAD', 3145735);
define ('CURLINFO_SIZE_DOWNLOAD', 3145736);
define ('CURLINFO_SPEED_DOWNLOAD', 3145737);
define ('CURLINFO_SPEED_UPLOAD', 3145738);
define ('CURLINFO_FILETIME', 2097166);
define ('CURLINFO_SSL_VERIFYRESULT', 2097165);
define ('CURLINFO_CONTENT_LENGTH_DOWNLOAD', 3145743);
define ('CURLINFO_CONTENT_LENGTH_UPLOAD', 3145744);
define ('CURLINFO_STARTTRANSFER_TIME', 3145745);
define ('CURLINFO_CONTENT_TYPE', 1048594);
define ('CURLINFO_REDIRECT_TIME', 3145747);
define ('CURLINFO_REDIRECT_COUNT', 2097172);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.1.3
 */
define ('CURLINFO_HEADER_OUT', 2);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.4
 */
define ('CURLINFO_PRIVATE', 1048597);
define ('CURL_VERSION_IPV6', 1);
define ('CURL_VERSION_KERBEROS4', 2);
define ('CURL_VERSION_SSL', 4);
define ('CURL_VERSION_LIBZ', 8);
define ('CURLVERSION_NOW', 3);
define ('CURLE_OK', 0);
define ('CURLE_UNSUPPORTED_PROTOCOL', 1);
define ('CURLE_FAILED_INIT', 2);
define ('CURLE_URL_MALFORMAT', 3);
define ('CURLE_URL_MALFORMAT_USER', 4);
define ('CURLE_COULDNT_RESOLVE_PROXY', 5);
define ('CURLE_COULDNT_RESOLVE_HOST', 6);
define ('CURLE_COULDNT_CONNECT', 7);
define ('CURLE_FTP_WEIRD_SERVER_REPLY', 8);
define ('CURLE_FTP_ACCESS_DENIED', 9);
define ('CURLE_FTP_USER_PASSWORD_INCORRECT', 10);
define ('CURLE_FTP_WEIRD_PASS_REPLY', 11);
define ('CURLE_FTP_WEIRD_USER_REPLY', 12);
define ('CURLE_FTP_WEIRD_PASV_REPLY', 13);
define ('CURLE_FTP_WEIRD_227_FORMAT', 14);
define ('CURLE_FTP_CANT_GET_HOST', 15);
define ('CURLE_FTP_CANT_RECONNECT', 16);
define ('CURLE_FTP_COULDNT_SET_BINARY', 17);
define ('CURLE_PARTIAL_FILE', 18);
define ('CURLE_FTP_COULDNT_RETR_FILE', 19);
define ('CURLE_FTP_WRITE_ERROR', 20);
define ('CURLE_FTP_QUOTE_ERROR', 21);
define ('CURLE_HTTP_NOT_FOUND', 22);
define ('CURLE_WRITE_ERROR', 23);
define ('CURLE_MALFORMAT_USER', 24);
define ('CURLE_FTP_COULDNT_STOR_FILE', 25);
define ('CURLE_READ_ERROR', 26);
define ('CURLE_OUT_OF_MEMORY', 27);
define ('CURLE_OPERATION_TIMEOUTED', 28);
define ('CURLE_FTP_COULDNT_SET_ASCII', 29);
define ('CURLE_FTP_PORT_FAILED', 30);
define ('CURLE_FTP_COULDNT_USE_REST', 31);
define ('CURLE_FTP_COULDNT_GET_SIZE', 32);
define ('CURLE_HTTP_RANGE_ERROR', 33);
define ('CURLE_HTTP_POST_ERROR', 34);
define ('CURLE_SSL_CONNECT_ERROR', 35);
define ('CURLE_FTP_BAD_DOWNLOAD_RESUME', 36);
define ('CURLE_FILE_COULDNT_READ_FILE', 37);
define ('CURLE_LDAP_CANNOT_BIND', 38);
define ('CURLE_LDAP_SEARCH_FAILED', 39);
define ('CURLE_LIBRARY_NOT_FOUND', 40);
define ('CURLE_FUNCTION_NOT_FOUND', 41);
define ('CURLE_ABORTED_BY_CALLBACK', 42);
define ('CURLE_BAD_FUNCTION_ARGUMENT', 43);
define ('CURLE_BAD_CALLING_ORDER', 44);
define ('CURLE_HTTP_PORT_FAILED', 45);
define ('CURLE_BAD_PASSWORD_ENTERED', 46);
define ('CURLE_TOO_MANY_REDIRECTS', 47);
define ('CURLE_UNKNOWN_TELNET_OPTION', 48);
define ('CURLE_TELNET_OPTION_SYNTAX', 49);
define ('CURLE_OBSOLETE', 50);
define ('CURLE_SSL_PEER_CERTIFICATE', 51);
define ('CURLE_GOT_NOTHING', 52);
define ('CURLE_SSL_ENGINE_NOTFOUND', 53);
define ('CURLE_SSL_ENGINE_SETFAILED', 54);
define ('CURLE_SEND_ERROR', 55);
define ('CURLE_RECV_ERROR', 56);
define ('CURLE_SHARE_IN_USE', 57);
define ('CURLE_SSL_CERTPROBLEM', 58);
define ('CURLE_SSL_CIPHER', 59);
define ('CURLE_SSL_CACERT', 60);
define ('CURLE_BAD_CONTENT_ENCODING', 61);
define ('CURLE_LDAP_INVALID_URL', 62);
define ('CURLE_FILESIZE_EXCEEDED', 63);
define ('CURLE_FTP_SSL_FAILED', 64);
define ('CURLPROXY_HTTP', 0);
define ('CURLPROXY_SOCKS4', 4);
define ('CURLPROXY_SOCKS5', 5);
define ('CURL_NETRC_OPTIONAL', 1);
define ('CURL_NETRC_IGNORED', 0);
define ('CURL_NETRC_REQUIRED', 2);
define ('CURL_HTTP_VERSION_NONE', 0);
define ('CURL_HTTP_VERSION_1_0', 1);
define ('CURL_HTTP_VERSION_1_1', 2);
define ('CURL_HTTP_VERSION_2_0', 3);
define ('CURLM_CALL_MULTI_PERFORM', -1);
define ('CURLM_OK', 0);
define ('CURLM_BAD_HANDLE', 1);
define ('CURLM_BAD_EASY_HANDLE', 2);
define ('CURLM_OUT_OF_MEMORY', 3);
define ('CURLM_INTERNAL_ERROR', 4);
define ('CURLMSG_DONE', 1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
define ('CURLOPT_FTPSSLAUTH', 129);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
define ('CURLFTPAUTH_DEFAULT', 0);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
define ('CURLFTPAUTH_SSL', 1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
define ('CURLFTPAUTH_TLS', 2);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
define ('CURLOPT_FTP_SSL', 119);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
define ('CURLFTPSSL_NONE', 0);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
define ('CURLFTPSSL_TRY', 1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
define ('CURLFTPSSL_CONTROL', 2);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
define ('CURLFTPSSL_ALL', 3);
define ('CURLOPT_FTP_FILEMETHOD', 138);
define ('CURLOPT_FTP_SKIP_PASV_IP', 137);
define ('CURLOPT_SAFE_UPLOAD', -1);
define ('CURLFTPMETHOD_MULTICWD', 1);
define ('CURLFTPMETHOD_NOCWD', 2);
define ('CURLFTPMETHOD_SINGLECWD', 3);

define ('CURLPROTO_HTTP', 1);
define ('CURLPROTO_HTTPS', 2);
define ('CURLPROTO_FTP', 4);
define ('CURLPROTO_FTPS', 8);
define ('CURLPROTO_SCP', 16);
define ('CURLPROTO_SFTP', 32);
define ('CURLPROTO_TELNET', 64);
define ('CURLPROTO_LDAP', 128);
define ('CURLPROTO_LDAPS', 256);
define ('CURLPROTO_DICT', 512);
define ('CURLPROTO_FILE', 1024);
define ('CURLPROTO_TFTP', 2048);
define ('CURLPROTO_ALL', -1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.5.0
 */
define ('CURLMOPT_PIPELINING', 3);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 5.5.0
 */
define ('CURLMOPT_MAXCONNECTS', 6);

define ('CURLSHOPT_SHARE', 1);
define ('CURLSHOPT_UNSHARE', 2);
define ('CURL_LOCK_DATA_COOKIE', 2);
define ('CURL_LOCK_DATA_DNS', 3);
define ('CURL_LOCK_DATA_SSL_SESSION', 4);

define ('CURLOPT_KEYPASSWD', 10026);


/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLFTP_CREATE_DIR', 1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLFTP_CREATE_DIR_NONE', 0);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLAUTH_NTLM_WB', 32);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURL_HTTP_VERSION_2', 3);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURL_HTTP_VERSION_2TLS', 4);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURL_HTTP_VERSION_2_PRIOR_KNOWLEDGE', 5);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_SASL_IR', 218);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_DNS_INTERFACE', 10221);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_DNS_LOCAL_IP4', 10222);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_DNS_LOCAL_IP6', 10223);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_XOAUTH2_BEARER', 10220);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_LOGIN_OPTIONS', 10224);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_EXPECT_100_TIMEOUT_MS', 227);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_SSL_ENABLE_ALPN', 226);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_SSL_ENABLE_NPN', 225);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_PINNEDPUBLICKEY', 10230);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_UNIX_SOCKET_PATH', 10231);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_SSL_VERIFYSTATUS', 232);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_PATH_AS_IS', 234);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_SSL_FALSESTART', 233);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_PIPEWAIT', 237);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_PROXY_SERVICE_NAME', 10235);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_SERVICE_NAME', 10236);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLSSH_AUTH_AGENT', 16);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLPIPE_NOTHING', 0);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLPIPE_HTTP1', 1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLPIPE_MULTIPLEX', 2);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLHEADER_SEPARATE', 1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLHEADER_UNIFIED', 0);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLPROTO_SMB', 67108864);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLPROTO_SMBS', 134217728);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_HEADEROPT', 229);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLOPT_PROXYHEADER', 10228);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURL_REDIR_POST_301', 1);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURL_REDIR_POST_302', 2);


/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURL_REDIR_POST_303', 4);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLPROXY_HTTP_1_0',1);
/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURL_REDIR_POST_ALL', 7);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define ('CURLMOPT_CHUNK_LENGTH_PENALTY_SIZE', 30010);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define ('CURLMOPT_CONTENT_LENGTH_PENALTY_SIZE', 30009);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLMOPT_MAX_HOST_CONNECTIONS', 7);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLMOPT_MAX_PIPELINE_LENGTH', 8);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLMOPT_MAX_TOTAL_CONNECTIONS', 13);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define ('CURLFTP_CREATE_DIR_RETRY', 2);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
define('CURLAUTH_NEGOTIATE', 4);


/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.1
 */

define('CURLMOPT_PUSHFUNCTION', 20014);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.1
 */
define('CURL_PUSH_OK', 0);

/**
 * @link https://php.net/manual/en/curl.constants.php
 * @since 7.1
 */
define('CURL_PUSH_DENY',1);


/**
 * @since 5.5
 */

define ('CURLOPT_FTP_RESPONSE_TIMEOUT', 112);
/**
 * @since 5.5
 */
define('CURLOPT_RESOLVE', 10203);

/**
 * @since 5.5
 */
define('CURLOPT_APPEND', 50);

/**
 * @since 5.5
 */
define('CURLOPT_DIRLISTONLY', 48);

/**
 * @since 5.5
 */
define('CURLOPT_NEW_DIRECTORY_PERMS', 160);

/**
 * @since 5.5
 */
define('CURLOPT_NEW_FILE_PERMS', 159);

/**
 * @since 5.5
 */
define('CURLOPT_NETRC_FILE', 10118);

/**
 * @since 5.5
 */
define('CURLOPT_PREQUOTE',10093);

/**
 * @since 5.5
 */
define('CURLOPT_KRBLEVEL',10063);

/**
 * @since 5.5
 */
define ('CURLOPT_MAXFILESIZE', 114);

/**
 * @since 5.5
 */
define('CURLOPT_FTP_ACCOUNT', 10134);

/**
 * @since 5.5
 */
define('CURLOPT_COOKIELIST', 10135);

/**
 * @since 5.5
 */
define('CURLOPT_LOCALPORT', 139);

/**
 * @since 5.5
 */
define('CURLOPT_LOCALPORTRANGE', 140);

/**
 * @since 5.5
 */
define('CURLOPT_FTP_ALTERNATIVE_TO_USER', 10147);

/**
 * @since 5.5
 */
define('CURLOPT_SSL_SESSIONID_CACHE', 150);

/**
 * @since 5.5
 */
define('CURLOPT_FTP_SSL_CCC', 154);

/**
 * @since 5.5
 */
define('CURLOPT_HTTP_CONTENT_DECODING', 158);

/**
 * @since 5.5
 */
define('CURLOPT_HTTP_TRANSFER_DECODING', 157);

/**
 * @since 5.5
 */
define('CURLOPT_PROXY_TRANSFER_MODE', 166);

/**
 * @since 5.5
 */
define('CURLOPT_ADDRESS_SCOPE', 171);

/**
 * @since 5.5
 */
define('CURLOPT_CRLFILE', 10169);

/**
 * @since 5.5
 */
define('CURLOPT_ISSUERCERT', 10170);

/**
 * @since 5.5
 */
define('CURLOPT_USERNAME', 10173);

/**
 * @since 5.5
 */
define('CURLOPT_PASSWORD', 10174);

/**
 * @since 5.5
 */
define('CURLOPT_PROXYUSERNAME', 10175);

/**
 * @since 5.5
 */
define('CURLOPT_PROXYPASSWORD', 10176);

/**
 * @since 5.5
 */
define('CURLOPT_NOPROXY', 10177);

/**
 * @since 5.5
 */
define('CURLOPT_SOCKS5_GSSAPI_NEC', 180);

/**
 * @since 5.5
 */
define('CURLOPT_SOCKS5_GSSAPI_SERVICE', 10179);

/**
 * @since 5.5
 */
define('CURLOPT_TFTP_BLKSIZE', 178);

/**
 * @since 5.5
 */
define('CURLOPT_SSH_KNOWNHOSTS', 10183);

/**
 * @since 5.5
 */
define('CURLOPT_FTP_USE_PRET', 188);

/**
 * @since 5.5
 */
define('CURLOPT_MAIL_FROM', 10186);

/**
 * @since 5.5
 */
define('CURLOPT_MAIL_RCPT', 10187);

/**
 * @since 5.5
 */
define('CURLOPT_RTSP_CLIENT_CSEQ', 193);

/**
 * @since 5.5
 */
define('CURLOPT_RTSP_SERVER_CSEQ', 194);

/**
 * @since 5.5
 */
define('CURLOPT_RTSP_SESSION_ID', 10190);

/**
 * @since 5.5
 */
define('CURLOPT_RTSP_STREAM_URI', 10191);

/**
 * @since 5.5
 */
define('CURLOPT_RTSP_TRANSPORT', 10192);

/**
 * @since 5.5
 */
define('CURLOPT_RTSP_REQUEST', 189);

/**
 * @since 5.5
 */
define('CURLOPT_IGNORE_CONTENT_LENGTH', 136);
/**
 * @since 5.5
 */
define('CURLOPT_ACCEPT_ENCODING', 10102);

/**
 * @since 5.5
 */
define('CURLOPT_TRANSFER_ENCODING', 207);

/**
 * @since 5.5
 */
define('CURLOPT_DNS_SERVERS', 10211);


/**
 * @since 5.5
 */
define('CURLOPT_USE_SSL', 119);

define("CURLOPT_TELNETOPTIONS",10070);
define("CURLE_BAD_DOWNLOAD_RESUME",36);
define("CURLE_FTP_PARTIAL_FILE",18);
define("CURLE_HTTP_RETURNED_ERROR",22);
define("CURLE_OPERATION_TIMEDOUT",28);
define("CURLE_SSL_PINNEDPUBKEYNOTMATCH",90);
define("CURLINFO_LASTONE",45);
define("CURLM_ADDED_ALREADY",7);
define("CURLSHOPT_NONE",0);
define("CURL_TIMECOND_NONE",0);
define("CURLAUTH_NONE",0);
define("CURLE_SSL_CACERT_BADFILE",77);
/**
 * @since 5.3
 */
define("CURLE_SSH",79);
define("CURLFTPSSL_CCC_ACTIVE",2);
define("CURLFTPSSL_CCC_NONE",0);
define("CURLFTPSSL_CCC_PASSIVE",1);
define("CURLUSESSL_ALL",3);
define("CURLUSESSL_CONTROL",2);
define("CURLUSESSL_NONE",0);
define("CURLUSESSL_TRY",1);
/**
 * @since 5.5
 */
define("CURLPAUSE_ALL",5);
/**
 * @since 5.5
 */
define("CURLPAUSE_CONT",0);
/**
 * @since 5.5
 */
define("CURLPAUSE_RECV",1);
/**
 * @since 5.5
 */
define("CURLPAUSE_RECV_CONT",0);
/**
 * @since 5.5
 */
define("CURLPAUSE_SEND",4);
/**
 * @since 5.5
 */
define("CURLPAUSE_SEND_CONT",0);
define("CURL_READFUNC_PAUSE",268435457);
define("CURL_WRITEFUNC_PAUSE",268435457);
/**
 * @since 5.5.23
 */
define("CURLPROXY_SOCKS4A",6);
/**
 * @since 5.5.23
 */
define("CURLPROXY_SOCKS5_HOSTNAME",7);

define("CURLSSH_AUTH_ANY",-1);
define("CURLSSH_AUTH_DEFAULT",-1);
define("CURLSSH_AUTH_HOST",4);
define("CURLSSH_AUTH_KEYBOARD",8);
define("CURLSSH_AUTH_NONE",0);
define("CURLSSH_AUTH_PASSWORD",2);
define("CURLSSH_AUTH_PUBLICKEY",1);
define("CURLAUTH_DIGEST_IE",16);
define("CURLPROTO_IMAP",4096);
define("CURLPROTO_IMAPS",8192);
define("CURLPROTO_POP3",16384);
define("CURLPROTO_POP3S",32768);
define("CURLPROTO_RTSP",262144);
define("CURLPROTO_SMTP",65536);
define("CURLPROTO_SMTPS",131072);
define("CURL_RTSPREQ_ANNOUNCE",3);
define("CURL_RTSPREQ_DESCRIBE",2);
define("CURL_RTSPREQ_GET_PARAMETER",8);
define("CURL_RTSPREQ_OPTIONS",1);
define("CURL_RTSPREQ_PAUSE",6);
define("CURL_RTSPREQ_PLAY",5);
define("CURL_RTSPREQ_RECEIVE",11);
define("CURL_RTSPREQ_RECORD",10);
define("CURL_RTSPREQ_SET_PARAMETER",9);
define("CURL_RTSPREQ_SETUP",4);
define("CURL_RTSPREQ_TEARDOWN",7);
define("CURLOPT_FNMATCH_FUNCTION",20200);
define("CURLOPT_WILDCARDMATCH",197);
define("CURLPROTO_RTMP",524288);
define("CURLPROTO_RTMPE",2097152);
define("CURLPROTO_RTMPS",8388608);
define("CURLPROTO_RTMPT",1048576);
define("CURLPROTO_RTMPTE",4194304);
define("CURLPROTO_RTMPTS",16777216);
define("CURL_FNMATCHFUNC_FAIL",2);
define("CURL_FNMATCHFUNC_MATCH",0);
define("CURL_FNMATCHFUNC_NOMATCH",1);
define("CURLPROTO_GOPHER",33554432);
define("CURLAUTH_ONLY",2147483648);
define("CURLOPT_TLSAUTH_PASSWORD",10205);
define("CURLOPT_TLSAUTH_TYPE",10206);
define("CURLOPT_TLSAUTH_USERNAME",10204);
define("CURL_TLSAUTH_SRP",1);
define("CURLGSSAPI_DELEGATION_FLAG",2);
define("CURLGSSAPI_DELEGATION_POLICY_FLAG",1);
define("CURLOPT_GSSAPI_DELEGATION",210);
define("CURLOPT_ACCEPTTIMEOUT_MS",212);
define("CURLOPT_MAIL_AUTH",10217);
/**
 * @since 5.5.0
 */
define("CURLOPT_SSL_OPTIONS",216);
define("CURLOPT_TCP_KEEPALIVE",213);
define("CURLOPT_TCP_KEEPIDLE",214);
define("CURLOPT_TCP_KEEPINTVL",215);
/**
 * @since 5.5.0
 */
define("CURLSSLOPT_ALLOW_BEAST",1);
/**
 * @since 5.5.24
 */
define("CURL_VERSION_HTTP2",65536);
/**
 * @since 7.0.7
 */
define("CURLSSLOPT_NO_REVOKE",2);
/**
 * @since 7.0.7
 */
define("CURLOPT_DEFAULT_PROTOCOL",10238);
/**
 * @since 7.0.7
 */
define("CURLOPT_STREAM_WEIGHT",239);
/**
 * @since 7.0.7
 */
define("CURLOPT_TFTP_NO_OPTIONS",242);
/**
 * @since 7.0.7
 */
define("CURLOPT_CONNECT_TO",10243);
/**
 * @since 7.0.7
 */
define("CURLOPT_TCP_FASTOPEN",244);

/**
 * @since 7.3
 */
define('CURLE_WEIRD_SERVER_REPLY', 8);
/**
 * @since 7.3
 */
define('CURLOPT_KEEP_SENDING_ON_ERROR', 245);
/**
 * @since 7.3
 */
define('CURL_SSLVERSION_TLSv1_3', 7);

/**
 * @since 7.3
 */
define('CURL_VERSION_HTTPS_PROXY', 2097152);


/**
 * @since 7.3
 */
define('CURLINFO_PROTOCOL', 2097200);

/**
 * @since 7.3
 */
define('CURL_VERSION_ASYNCHDNS', 128);

/**
 * @since 7.3.6
 */
define('CURL_VERSION_CURLDEBUG', 8192);

/**
 * @since 7.3
 */
define('CURL_VERSION_CONV', 4096);

/**
 * @since 7.3
 */
define('CURL_VERSION_DEBUG', 64);

/**
 * @since 7.3
 */
define('CURL_VERSION_GSSNEGOTIATE', 32);

/**
 * @since 7.3
 */
define('CURL_VERSION_IDN', 1024);

/**
 * @since 7.3
 */
define('CURL_VERSION_LARGEFILE', 512);

/**
 * @since 7.3
 */
define('CURL_VERSION_NTLM', 16);

/**
 * @since 7.3.6
 */
define('CURL_VERSION_PSL', 1048576);

/**
 * @since 7.3
 */
define('CURL_VERSION_SPNEGO', 256);

/**
 * @since 7.3
 */
define('CURL_VERSION_SSPI', 2048);

/**
 * @since 7.3
 */
define('CURL_VERSION_TLSAUTH_SRP', 16384);

/**
 * @since 7.3
 */
define('CURL_VERSION_NTLM_WB', 32768);

/**
 * @since 7.3
 */
define('CURL_VERSION_GSSAPI', 131072);

/**
 * @since 7.3
 */
define('CURL_VERSION_KERBEROS5', 262144);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_CAINFO', 10246);

/**
 * @since 7.3
 */
define ('CURLOPT_PROXY_CAPATH', 10247);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_CRLFILE', 10260);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_KEYPASSWD', 10258);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSLCERTTYPE', 10255);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSLKEYTYPE', 10257);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSLVERSION', 250);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_TLSAUTH_USERNAME' ,10251);
/**
 * @since 7.3
 */
define('CURLOPT_PROXY_TLSAUTH_PASSWORD', 10252);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_TLSAUTH_TYPE', 10253);

/**
 * @since 7.3
 */
define('CURLPROXY_HTTPS', 2);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_PINNEDPUBLICKEY', 10263);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSLKEY', 10256);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSL_CIPHER_LIST', 10259);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSL_OPTIONS', 261);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSL_VERIFYHOST', 249);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSL_VERIFYPEER', 248);

/**
 * @since 7.3
 */
define('CURLOPT_PROXY_SSLCERT', 10254);

/**
 * @since 7.3
 */
define('CURLINFO_SCHEME', 1048625);

/**
 * @since 7.3
 */
define('CURL_VERSION_UNIX_SOCKETS', 524288);

/**
 * @since 7.3
 */
define('CURLINFO_HTTP_VERSION', 2097198);
/**
 * @since 7.3
 */
define('CURLOPT_PRE_PROXY', 10262);
/**
 * @since 7.3
 */
define('CURLINFO_PROXY_SSL_VERIFYRESULT', 2097199);
