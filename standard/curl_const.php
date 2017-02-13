<?php
/**
 * PHPStorm stub file for cURL constants.
 *
 * @link http://php.net/manual/en/curl.constants.php
 */

/**
 * @link  http://php.net/manual/en/curl.constants.php
 */
const CURLAUTH_ANY = -1;
const CURLAUTH_ANYSAFE = -2;
const CURLAUTH_BASIC = 1;
const CURLAUTH_DIGEST = 2;
const CURLAUTH_GSSNEGOTIATE = 4;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLAUTH_NEGOTIATE = 4;
const CURLAUTH_NTLM = 8;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLAUTH_NTLM_WB = 32;
const CURLCLOSEPOLICY_CALLBACK = 5;
const CURLCLOSEPOLICY_LEAST_RECENTLY_USED = 2;
const CURLCLOSEPOLICY_LEAST_TRAFFIC = 3;
const CURLCLOSEPOLICY_OLDEST = 1;
const CURLCLOSEPOLICY_SLOWEST = 4;
const CURLE_ABORTED_BY_CALLBACK = 42;
const CURLE_BAD_CALLING_ORDER = 44;
const CURLE_BAD_CONTENT_ENCODING = 61;
const CURLE_BAD_FUNCTION_ARGUMENT = 43;
const CURLE_BAD_PASSWORD_ENTERED = 46;
const CURLE_COULDNT_CONNECT = 7;
const CURLE_COULDNT_RESOLVE_HOST = 6;
const CURLE_COULDNT_RESOLVE_PROXY = 5;
const CURLE_FAILED_INIT = 2;
const CURLE_FILESIZE_EXCEEDED = 63;
const CURLE_FILE_COULDNT_READ_FILE = 37;
const CURLE_FTP_ACCESS_DENIED = 9;
const CURLE_FTP_BAD_DOWNLOAD_RESUME = 36;
const CURLE_FTP_CANT_GET_HOST = 15;
const CURLE_FTP_CANT_RECONNECT = 16;
const CURLE_FTP_COULDNT_GET_SIZE = 32;
const CURLE_FTP_COULDNT_RETR_FILE = 19;
const CURLE_FTP_COULDNT_SET_ASCII = 29;
const CURLE_FTP_COULDNT_SET_BINARY = 17;
const CURLE_FTP_COULDNT_STOR_FILE = 25;
const CURLE_FTP_COULDNT_USE_REST = 31;
const CURLE_FTP_PORT_FAILED = 30;
const CURLE_FTP_QUOTE_ERROR = 21;
const CURLE_FTP_SSL_FAILED = 64;
const CURLE_FTP_USER_PASSWORD_INCORRECT = 10;
const CURLE_FTP_WEIRD_227_FORMAT = 14;
const CURLE_FTP_WEIRD_PASS_REPLY = 11;
const CURLE_FTP_WEIRD_PASV_REPLY = 13;
const CURLE_FTP_WEIRD_SERVER_REPLY = 8;
const CURLE_FTP_WEIRD_USER_REPLY = 12;
const CURLE_FTP_WRITE_ERROR = 20;
const CURLE_FUNCTION_NOT_FOUND = 41;
const CURLE_GOT_NOTHING = 52;
const CURLE_HTTP_NOT_FOUND = 22;
const CURLE_HTTP_PORT_FAILED = 45;
const CURLE_HTTP_POST_ERROR = 34;
const CURLE_HTTP_RANGE_ERROR = 33;
const CURLE_LDAP_CANNOT_BIND = 38;
const CURLE_LDAP_INVALID_URL = 62;
const CURLE_LDAP_SEARCH_FAILED = 39;
const CURLE_LIBRARY_NOT_FOUND = 40;
const CURLE_MALFORMAT_USER = 24;
const CURLE_OBSOLETE = 50;
const CURLE_OK = 0;
const CURLE_OPERATION_TIMEOUTED = 28;
const CURLE_OUT_OF_MEMORY = 27;
const CURLE_PARTIAL_FILE = 18;
const CURLE_READ_ERROR = 26;
const CURLE_RECV_ERROR = 56;
const CURLE_SEND_ERROR = 55;
const CURLE_SHARE_IN_USE = 57;
const CURLE_SSL_CACERT = 60;
const CURLE_SSL_CERTPROBLEM = 58;
const CURLE_SSL_CIPHER = 59;
const CURLE_SSL_CONNECT_ERROR = 35;
const CURLE_SSL_ENGINE_NOTFOUND = 53;
const CURLE_SSL_ENGINE_SETFAILED = 54;
const CURLE_SSL_PEER_CERTIFICATE = 51;
const CURLE_TELNET_OPTION_SYNTAX = 49;
const CURLE_TOO_MANY_REDIRECTS = 47;
const CURLE_UNKNOWN_TELNET_OPTION = 48;
const CURLE_UNSUPPORTED_PROTOCOL = 1;
const CURLE_URL_MALFORMAT = 3;
const CURLE_URL_MALFORMAT_USER = 4;
const CURLE_WRITE_ERROR = 23;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
const CURLFTPAUTH_DEFAULT = 0;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
const CURLFTPAUTH_SSL = 1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
const CURLFTPAUTH_TLS = 2;
const CURLFTPMETHOD_MULTICWD = 1;
const CURLFTPMETHOD_NOCWD = 2;
const CURLFTPMETHOD_SINGLECWD = 3;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
const CURLFTPSSL_ALL = 3;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
const CURLFTPSSL_CONTROL = 2;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
const CURLFTPSSL_NONE = 0;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
const CURLFTPSSL_TRY = 1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLFTP_CREATE_DIR = 1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLFTP_CREATE_DIR_NONE = 0;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLFTP_CREATE_DIR_RETRY = 2;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLHEADER_SEPARATE = 1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLHEADER_UNIFIED = 0;
/**
 * Time in seconds it took from the start until the SSL/SSH connect/handshake to the remote host was completed
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_APPCONNECT_TIME = 3145761;
/**
 * TLS certificate chain
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_CERTINFO = 4194338;
/**
 * Info on unmet time conditional
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_CONDITION_UNMET = 2097187;
const CURLINFO_CONNECT_TIME = 3145733;
const CURLINFO_CONTENT_LENGTH_DOWNLOAD = 3145743;
const CURLINFO_CONTENT_LENGTH_UPLOAD = 3145744;
const CURLINFO_CONTENT_TYPE = 1048594;
/**
 * All known cookies
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_COOKIELIST = 4194332;
const CURLINFO_EFFECTIVE_URL = 1048577;
const CURLINFO_FILETIME = 2097166;
/**
 * Entry path in FTP server
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_FTP_ENTRY_PATH = 1048606;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.1.3
 */
const CURLINFO_HEADER_OUT = 2;
const CURLINFO_HEADER_SIZE = 2097163;
/**
 * Bitmask indicating the authentication method(s) available according to the previous response
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_HTTPAUTH_AVAIL = 2097175;
const CURLINFO_HTTP_CODE = 2097154;
/**
 * The CONNECT response code
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_HTTP_CONNECTCODE = 2097174;
/**
 * @since 5.4.7
 */
const CURLINFO_LOCAL_IP = 1048617;
/**
 * @since 5.4.7
 */
const CURLINFO_LOCAL_PORT = 2097194;
const CURLINFO_NAMELOOKUP_TIME = 3145732;
/**
 * Number of connections curl had to create to achieve the previous transfer
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_NUM_CONNECTS = 2097178;
/**
 * Errno from a connect failure. The number is OS and system specific.
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_OS_ERRNO = 2097177;
const CURLINFO_PRETRANSFER_TIME = 3145734;
/**
 * @since 5.4.7
 */
const CURLINFO_PRIMARY_IP = 1048608;
/**
 * @since 5.4.7
 */
const CURLINFO_PRIMARY_PORT = 2097192;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.4
 */
const CURLINFO_PRIVATE = 1048597;
/**
 * Bitmask indicating the proxy authentication method(s) available according to the previous response
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_PROXYAUTH_AVAIL = 2097176;
const CURLINFO_REDIRECT_COUNT = 2097172;
const CURLINFO_REDIRECT_TIME = 3145747;
/**
 * @since 5.3.7
 */
const CURLINFO_REDIRECT_URL = 1048607;
const CURLINFO_REQUEST_SIZE = 2097164;
/**
 * The last response code
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_RESPONSE_CODE = 2097154;
/**
 * Next RTSP client CSeq
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_RTSP_CLIENT_CSEQ = 2097189;
/**
 * Recently received CSeq
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_RTSP_CSEQ_RECV = 2097191;
/**
 * Next RTSP server CSeq
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_RTSP_SERVER_CSEQ = 2097190;
/**
 * RTSP session ID
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_RTSP_SESSION_ID = 1048612;
const CURLINFO_SIZE_DOWNLOAD = 3145736;
const CURLINFO_SIZE_UPLOAD = 3145735;
const CURLINFO_SPEED_DOWNLOAD = 3145737;
const CURLINFO_SPEED_UPLOAD = 3145738;
/**
 * OpenSSL crypto-engines supported
 *
 * @link  http://php.net/manual/en/function.curl-getinfo.php
 * @since 5.5.0
 */
const CURLINFO_SSL_ENGINES = 4194331;
const CURLINFO_SSL_VERIFYRESULT = 2097165;
const CURLINFO_STARTTRANSFER_TIME = 3145745;
const CURLINFO_TOTAL_TIME = 3145731;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLMOPT_CHUNK_LENGTH_PENALTY_SIZE = 30010;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLMOPT_CONTENT_LENGTH_PENALTY_SIZE = 30009;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.5.0
 */
const CURLMOPT_MAXCONNECTS = 6;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLMOPT_MAX_HOST_CONNECTIONS = 7;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLMOPT_MAX_PIPELINE_LENGTH = 8;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLMOPT_MAX_TOTAL_CONNECTIONS = 13;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.5.0
 */
const CURLMOPT_PIPELINING = 3;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.1
 */
const CURLMOPT_PUSHFUNCTION = 20014;
const CURLMSG_DONE = 1;
const CURLM_BAD_EASY_HANDLE = 2;
const CURLM_BAD_HANDLE = 1;
const CURLM_CALL_MULTI_PERFORM = -1;
const CURLM_INTERNAL_ERROR = 4;
const CURLM_OK = 0;
const CURLM_OUT_OF_MEMORY = 3;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
const CURLOPT_AUTOREFERER = 58;
const CURLOPT_BINARYTRANSFER = 19914;
const CURLOPT_BUFFERSIZE = 98;
const CURLOPT_CAINFO = 10065;
const CURLOPT_CAPATH = 10097;
/**
 * @link  http://us.php.net/manual/en/function.curl-setopt.php
 * @since 5.3.2
 */
const CURLOPT_CERTINFO = -1;
const CURLOPT_CLOSEPOLICY = 72;
const CURLOPT_CONNECTTIMEOUT = 78;
const CURLOPT_CONNECTTIMEOUT_MS = 156;
/**
 * @since 5.5.0
 * @link  http://php.net/manual/en/function.curl-setopt.php
 * <b>TRUE</b> tells the library to perform all the required proxy authentication
 * and connection setup, but no data transfer. This option is implemented for
 * HTTP, SMTP and POP3.
 */
const CURLOPT_CONNECT_ONLY = 141;
const CURLOPT_COOKIE = 10022;
const CURLOPT_COOKIEFILE = 10031;
const CURLOPT_COOKIEJAR = 10082;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
const CURLOPT_COOKIESESSION = 96;
const CURLOPT_CRLF = 27;
const CURLOPT_CUSTOMREQUEST = 10036;
const CURLOPT_DNS_CACHE_TIMEOUT = 92;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_DNS_INTERFACE = 10221;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_DNS_LOCAL_IP4 = 10222;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_DNS_LOCAL_IP6 = 10223;
const CURLOPT_DNS_USE_GLOBAL_CACHE = 91;
const CURLOPT_EGDSOCKET = 10077;
const CURLOPT_ENCODING = 10102;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_EXPECT_100_TIMEOUT_MS = 227;
const CURLOPT_FAILONERROR = 45;
const CURLOPT_FILE = 10001;
const CURLOPT_FILETIME = 69;
/**
 * This constant is not available when open_basedir
 * or safe_mode are enabled.
 *
 * @link http://php.net/manual/en/curl.constants.php
 */
const CURLOPT_FOLLOWLOCATION = 52;
const CURLOPT_FORBID_REUSE = 75;
const CURLOPT_FRESH_CONNECT = 74;
const CURLOPT_FTPAPPEND = 50;
const CURLOPT_FTPASCII = -1;
const CURLOPT_FTPLISTONLY = 48;
const CURLOPT_FTPPORT = 10017;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.1.0
 */
const CURLOPT_FTPSSLAUTH = 129;
const CURLOPT_FTP_CREATE_MISSING_DIRS = 110;
const CURLOPT_FTP_FILEMETHOD = 138;
const CURLOPT_FTP_SKIP_PASV_IP = 137;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.0
 */
const CURLOPT_FTP_SSL = 119;
const CURLOPT_FTP_USE_EPRT = 106;
const CURLOPT_FTP_USE_EPSV = 85;
const CURLOPT_HEADER = 42;
const CURLOPT_HEADERFUNCTION = 20079;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_HEADEROPT = 229;
const CURLOPT_HTTP200ALIASES = 10104;
const CURLOPT_HTTPAUTH = 107;
const CURLOPT_HTTPGET = 80;
const CURLOPT_HTTPHEADER = 10023;
const CURLOPT_HTTPPROXYTUNNEL = 61;
const CURLOPT_HTTP_VERSION = 84;
const CURLOPT_HTTP_VERSION_2_0 = 3;
const CURLOPT_INFILE = 10009;
const CURLOPT_INFILESIZE = 14;
const CURLOPT_INTERFACE = 10062;
const CURLOPT_IPRESOLVE = 113;
const CURLOPT_KEYPASSWD = 10026;
const CURLOPT_KRB4LEVEL = 10063;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_LOGIN_OPTIONS = 10224;
const CURLOPT_LOW_SPEED_LIMIT = 19;
const CURLOPT_LOW_SPEED_TIME = 20;
const CURLOPT_MAXCONNECTS = 71;
const CURLOPT_MAXREDIRS = 68;
const CURLOPT_MAX_RECV_SPEED_LARGE = -1;
const CURLOPT_MAX_SEND_SPEED_LARGE = -1;
const CURLOPT_MUTE = -1;
const CURLOPT_NETRC = 51;
const CURLOPT_NOBODY = 44;
const CURLOPT_NOPROGRESS = 43;
const CURLOPT_NOSIGNAL = 99;
const CURLOPT_PASSWDFUNCTION = -1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_PATH_AS_IS = 234;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_PINNEDPUBLICKEY = 10230;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_PIPEWAIT = 237;
const CURLOPT_PORT = 3;
const CURLOPT_POST = 47;
const CURLOPT_POSTFIELDS = 10015;
const CURLOPT_POSTQUOTE = 10039;
/**
 * @link  http://us.php.net/manual/en/function.curl-setopt.php
 * @since 5.3.2
 */
const CURLOPT_POSTREDIR = 161;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.4
 */
const CURLOPT_PRIVATE = 10103;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.3.0
 */
const CURLOPT_PROGRESSFUNCTION = 20056;
const CURLOPT_PROTOCOLS = -1;
const CURLOPT_PROXY = 10004;
const CURLOPT_PROXYAUTH = 111;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_PROXYHEADER = 10228;
const CURLOPT_PROXYPORT = 59;
const CURLOPT_PROXYTYPE = 101;
const CURLOPT_PROXYUSERPWD = 10006;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_PROXY_SERVICE_NAME = 10235;
const CURLOPT_PUT = 54;
const CURLOPT_QUOTE = 10028;
const CURLOPT_RANDOM_FILE = 10076;
const CURLOPT_RANGE = 10007;
const CURLOPT_READDATA = 10009;
const CURLOPT_READFUNCTION = 20012;
const CURLOPT_REDIR_PROTOCOLS = -1;
const CURLOPT_REFERER = 10016;
const CURLOPT_RESUME_FROM = 21;
const CURLOPT_RETURNTRANSFER = 19913;
const CURLOPT_SAFE_UPLOAD = -1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_SASL_IR = 218;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_SERVICE_NAME = 10236;
/**
 * A result of {@see curl_share_init()}. Makes the cURL handle to use the data from the shared handle.
 *
 * @link  http://php.net/manual/en/function.curl-setopt.php
 * @since 5.5.0
 */
const CURLOPT_SHARE = 10100;
/**
 * A bitmask consisting of one or more of
 * <b>CURLSSH_AUTH_PUBLICKEY</b>,
 * <b>CURLSSH_AUTH_PASSWORD</b>,
 * <b>CURLSSH_AUTH_HOST</b>,
 * <b>CURLSSH_AUTH_KEYBOARD</b>. Set to
 * <b>CURLSSH_AUTH_ANY</b> to let libcurl pick one.
 */
const CURLOPT_SSH_AUTH_TYPES = 151;
/**
 * @link http://php.net/manual/en/function.curl-setopt.php
 */
const CURLOPT_SSH_HOST_PUBLIC_KEY_MD5 = 10162;
/**
 * @link http://php.net/manual/en/function.curl-setopt.php
 */
const CURLOPT_SSH_PRIVATE_KEYFILE = 10153;
/**
 * @link http://php.net/manual/en/function.curl-setopt.php
 */
const CURLOPT_SSH_PUBLIC_KEYFILE = 10152;
const CURLOPT_SSLCERT = 10025;
const CURLOPT_SSLCERTPASSWD = 10026;
const CURLOPT_SSLCERTTYPE = 10086;
const CURLOPT_SSLENGINE = 10089;
const CURLOPT_SSLENGINE_DEFAULT = 90;
const CURLOPT_SSLKEY = 10087;
const CURLOPT_SSLKEYPASSWD = 10026;
const CURLOPT_SSLKEYTYPE = 10088;
const CURLOPT_SSLVERSION = 32;
const CURLOPT_SSL_CIPHER_LIST = 10083;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_SSL_ENABLE_ALPN = 226;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_SSL_ENABLE_NPN = 225;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_SSL_FALSESTART = 233;
const CURLOPT_SSL_VERIFYHOST = 81;
const CURLOPT_SSL_VERIFYPEER = 64;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_SSL_VERIFYSTATUS = 232;
const CURLOPT_STDERR = 10037;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 5.2.1
 */
const CURLOPT_TCP_NODELAY = 121;
const CURLOPT_TIMECONDITION = 33;
const CURLOPT_TIMEOUT = 13;
const CURLOPT_TIMEOUT_MS = 155;
const CURLOPT_TIMEVALUE = 34;
const CURLOPT_TRANSFERTEXT = 53;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_UNIX_SOCKET_PATH = 10231;
const CURLOPT_UNRESTRICTED_AUTH = 105;
const CURLOPT_UPLOAD = 46;
const CURLOPT_URL = 10002;
const CURLOPT_USERAGENT = 10018;
const CURLOPT_USERPWD = 10005;
const CURLOPT_VERBOSE = 41;
const CURLOPT_WRITEFUNCTION = 20011;
const CURLOPT_WRITEHEADER = 10029;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLOPT_XOAUTH2_BEARER = 10220;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLPIPE_HTTP1 = 1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLPIPE_MULTIPLEX = 2;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLPIPE_NOTHING = 0;
const CURLPROTO_ALL = -1;
const CURLPROTO_DICT = 512;
const CURLPROTO_FILE = 1024;
const CURLPROTO_FTP = 4;
const CURLPROTO_FTPS = 8;
const CURLPROTO_HTTP = 1;
const CURLPROTO_HTTPS = 2;
const CURLPROTO_LDAP = 128;
const CURLPROTO_LDAPS = 256;
const CURLPROTO_SCP = 16;
const CURLPROTO_SFTP = 32;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLPROTO_SMB = 67108864;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLPROTO_SMBS = 134217728;
const CURLPROTO_TELNET = 64;
const CURLPROTO_TFTP = 2048;
const CURLPROXY_HTTP = 0;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLPROXY_HTTP_1_0 = 1;
const CURLPROXY_SOCKS4 = 4;
const CURLPROXY_SOCKS5 = 5;
const CURLSHOPT_SHARE = 1;
const CURLSHOPT_UNSHARE = 2;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURLSSH_AUTH_AGENT = 16;
const CURLVERSION_NOW = 3;
const CURL_HTTP_VERSION_1_0 = 1;
const CURL_HTTP_VERSION_1_1 = 2;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURL_HTTP_VERSION_2 = 3;
const CURL_HTTP_VERSION_NONE = 0;
const CURL_IPRESOLVE_V4 = 1;
const CURL_IPRESOLVE_V6 = 2;
const CURL_IPRESOLVE_WHATEVER = 0;
const CURL_LOCK_DATA_COOKIE = 2;
const CURL_LOCK_DATA_DNS = 3;
const CURL_LOCK_DATA_SSL_SESSION = 4;
const CURL_NETRC_IGNORED = 0;
const CURL_NETRC_OPTIONAL = 1;
const CURL_NETRC_REQUIRED = 2;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.1
 */
const CURL_PUSH_DENY = 1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.1
 */
const CURL_PUSH_OK = 0;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURL_REDIR_POST_301 = 1;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURL_REDIR_POST_302 = 2;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURL_REDIR_POST_303 = 4;
/**
 * @link  http://php.net/manual/en/curl.constants.php
 * @since 7.0.7
 */
const CURL_REDIR_POST_ALL = 7;
const CURL_SSLVERSION_DEFAULT = 0;
const CURL_SSLVERSION_SSLv2 = 2;
const CURL_SSLVERSION_SSLv3 = 3;
const CURL_SSLVERSION_TLSv1 = 1;
/**
 * @since 5.6.3
 * @since 5.5.19
 */
const CURL_SSLVERSION_TLSv1_0 = 4;
/**
 * @since 5.6.3
 * @since 5.5.19
 */
const CURL_SSLVERSION_TLSv1_1 = 5;
/**
 * @since 5.6.3
 * @since 5.5.19
 */
const CURL_SSLVERSION_TLSv1_2 = 6;
const CURL_TIMECOND_IFMODSINCE = 1;
const CURL_TIMECOND_IFUNMODSINCE = 2;
const CURL_TIMECOND_LASTMOD = 3;
const CURL_VERSION_IPV6 = 1;
const CURL_VERSION_KERBEROS4 = 2;
const CURL_VERSION_LIBZ = 8;
const CURL_VERSION_SSL = 4;
