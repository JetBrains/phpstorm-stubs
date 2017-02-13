<?php
/**
 * PHPStorm stub file for HTTP contants.
 *
 * __WARNING__
 * None of the links work!!!
 *
 * @todo Isn't this really really old? like in dead since PHP 4.x or earlier? All the links seem to be dead I think
 *       it's time to just drop it from stubs as well.
 *
 * @link http://php.net/manual/en/book.http.php
 */

/**
 * try any authentication scheme
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_AUTH_ANY = -1;
/**
 * use &quot;basic&quot; authentication
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_AUTH_BASIC = 1;
/**
 * use &quot;digest&quot; authentication
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_AUTH_DIGEST = 2;
/**
 * use &quot;GSS-NEGOTIATE&quot; authentication
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_AUTH_GSSNEG = 4;
/**
 * use &quot;NTLM&quot; authentication
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_AUTH_NTLM = 8;
/**
 * whether &quot;httpOnly&quot; was found in the cookie's parameter list
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_COOKIE_HTTPONLY = 32;
/**
 * don't urldecode values
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_COOKIE_PARSE_RAW = 1;
/**
 * whether &quot;secure&quot; was found in the cookie's parameters list
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_COOKIE_SECURE = 16;
const HTTP_DEFLATE_LEVEL_DEF = 0;
const HTTP_DEFLATE_LEVEL_MAX = 9;
const HTTP_DEFLATE_LEVEL_MIN = 1;
const HTTP_DEFLATE_STRATEGY_DEF = 0;
const HTTP_DEFLATE_STRATEGY_FILT = 256;
const HTTP_DEFLATE_STRATEGY_FIXED = 1024;
const HTTP_DEFLATE_STRATEGY_HUFF = 512;
const HTTP_DEFLATE_STRATEGY_RLE = 768;
const HTTP_DEFLATE_TYPE_GZIP = 16;
const HTTP_DEFLATE_TYPE_RAW = 32;
const HTTP_DEFLATE_TYPE_ZLIB = 0;
/**
 * full data flush
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_ENCODING_STREAM_FLUSH_FULL = 2097152;
/**
 * don't flush
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_ENCODING_STREAM_FLUSH_NONE = 0;
/**
 * synchronized flush only
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_ENCODING_STREAM_FLUSH_SYNC = 1048576;
/**
 * encoding/decoding error
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_ENCODING = 7;
/**
 * header() or similar operation failed
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_HEADER = 3;
/**
 * an invalid parameter was passed
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_INVALID_PARAM = 2;
/**
 * HTTP header parse error
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_MALFORMED_HEADERS = 4;
/**
 * with operation incompatible message type
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_MESSAGE_TYPE = 6;
/**
 * querystring operation failure
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_QUERYSTRING = 13;
/**
 * request failure
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_REQUEST = 8;
/**
 * unknown/invalid request method
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_REQUEST_METHOD = 5;
/**
 * request pool failure
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_REQUEST_POOL = 9;
/**
 * response failure
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_RESPONSE = 11;
/**
 * runtime error
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_RUNTIME = 1;
/**
 * socket exception
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_SOCKET = 10;
/**
 * invalid URL
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_E_URL = 12;
/**
 * use any IP mechanism only for name lookups
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_IPRESOLVE_ANY = 0;
/**
 * use IPv4 only for name lookups
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_IPRESOLVE_V4 = 1;
/**
 * use IPv6 only for name lookups
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_IPRESOLVE_V6 = 2;
const HTTP_METH_ACL = 27;
const HTTP_METH_BASELINE_CONTROL = 25;
const HTTP_METH_CHECKIN = 19;
const HTTP_METH_CHECKOUT = 18;
const HTTP_METH_CONNECT = 8;
const HTTP_METH_COPY = 12;
const HTTP_METH_DELETE = 5;
const HTTP_METH_GET = 1;
const HTTP_METH_HEAD = 2;
const HTTP_METH_LABEL = 23;
const HTTP_METH_LOCK = 14;
const HTTP_METH_MERGE = 24;
const HTTP_METH_MKACTIVITY = 26;
const HTTP_METH_MKCOL = 11;
const HTTP_METH_MKWORKSPACE = 21;
const HTTP_METH_MOVE = 13;
const HTTP_METH_OPTIONS = 6;
const HTTP_METH_POST = 3;
const HTTP_METH_PROPFIND = 9;
const HTTP_METH_PROPPATCH = 10;
const HTTP_METH_PUT = 4;
const HTTP_METH_REPORT = 17;
const HTTP_METH_TRACE = 7;
const HTTP_METH_UNCHECKOUT = 20;
const HTTP_METH_UNLOCK = 15;
const HTTP_METH_UPDATE = 22;
const HTTP_METH_VERSION_CONTROL = 16;
/**
 * the message is of no specific type
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_MSG_NONE = 0;
/**
 * request style message
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_MSG_REQUEST = 1;
/**
 * response style message
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_MSG_RESPONSE = 2;
/**
 * allow commands additionally to semicolons as separator
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_PARAMS_ALLOW_COMMA = 1;
/**
 * continue parsing after an error occurred
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_PARAMS_ALLOW_FAILURE = 2;
/**
 * all three values above, bitwise or'ed
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_PARAMS_DEFAULT = 7;
/**
 * raise PHP warnings on parse errors
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_PARAMS_RAISE_ERROR = 4;
/**
 * standard HTTP proxy
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_PROXY_HTTP = 0;
/**
 * the proxy is a SOCKS4 type proxy
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_PROXY_SOCKS4 = 4;
/**
 * the proxy is a SOCKS5 type proxy
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_PROXY_SOCKS5 = 5;
const HTTP_QUERYSTRING_TYPE_ARRAY = 4;
const HTTP_QUERYSTRING_TYPE_BOOL = 3;
const HTTP_QUERYSTRING_TYPE_FLOAT = 2;
const HTTP_QUERYSTRING_TYPE_INT = 1;
const HTTP_QUERYSTRING_TYPE_OBJECT = 5;
const HTTP_QUERYSTRING_TYPE_STRING = 6;
/**
 * guess applicable redirect method
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_REDIRECT = 0;
/**
 * standard redirect (302 Found)
 * RFC 1945 and RFC 2068 specify that the client is not allowed
 * to change the method on the redirected request. However, most
 * existing user agent implementations treat 302 as if it were a 303
 * response, performing a GET on the Location field-value regardless
 * of the original request method. The status codes 303 and 307 have
 * been added for servers that wish to make unambiguously clear which
 * kind of reaction is expected of the client.
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_REDIRECT_FOUND = 302;
/**
 * permanent redirect (301 Moved permanently)
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_REDIRECT_PERM = 301;
/**
 * redirect applicable to POST requests (303 See other)
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_REDIRECT_POST = 303;
/**
 * proxy redirect (305 Use proxy)
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_REDIRECT_PROXY = 305;
/**
 * temporary redirect (307 Temporary Redirect)
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_REDIRECT_TEMP = 307;
/**
 * no specific SSL protocol version
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SSL_VERSION_ANY = 0;
/**
 * use SSLv2 only
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SSL_VERSION_SSLv2 = 2;
/**
 * use SSLv3 only
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SSL_VERSION_SSLv3 = 3;
/**
 * use TLSv1 only
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SSL_VERSION_TLSv1 = 1;
/**
 * querying for this constant will always return true
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SUPPORT = 1;
/**
 * whether support for zlib encodings is given, ie. libz support was compiled in
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SUPPORT_ENCODINGS = 8;
const HTTP_SUPPORT_EVENTS = 128;
/**
 * whether support to guess the Content-Type of HTTP messages is given, ie. libmagic support was compiled in
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SUPPORT_MAGICMIME = 4;
/**
 * whether support to issue HTTP requests is given, ie. libcurl support was compiled in
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SUPPORT_REQUESTS = 2;
/**
 * whether support to issue HTTP requests over SSL is given, ie. linked libcurl was built with SSL support
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_SUPPORT_SSLREQUESTS = 32;
const HTTP_URL_FROM_ENV = 4096;
/**
 * join relative paths
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_JOIN_PATH = 1;
/**
 * join query strings
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_JOIN_QUERY = 2;
/**
 * replace every part of the first URL when there's one of the second URL
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_REPLACE = 0;
/**
 * strip anything but scheme and host
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_ALL = 492;
/**
 * strip any authentication information
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_AUTH = 12;
/**
 * strip any fragments (#identifier)
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_FRAGMENT = 256;
/**
 * strip any password authentication information
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_PASS = 8;
/**
 * strip complete path
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_PATH = 64;
/**
 * strip explicit port numbers
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_PORT = 32;
/**
 * strip query string
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_QUERY = 128;
/**
 * strip any user authentication information
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_URL_STRIP_USER = 4;
/**
 * HTTP version 1.0
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_VERSION_1_0 = 1;
/**
 * HTTP version 1.1
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_VERSION_1_1 = 2;
/**
 * no specific HTTP protocol version
 *
 * @link http://php.net/manual/en/http.constants.php
 */
const HTTP_VERSION_ANY = 0;
const HTTP_VERSION_NONE = 0;
