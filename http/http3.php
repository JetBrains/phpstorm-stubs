<?php
/**
 * Extension stub file for PECL HTTP version 3.x
 *
 * @author Katherine Rossiter <signe@users.noreply.github.com>
 * @see https://mdref.m6w6.name/http
 */

namespace http {

    /**
     * The HTTP client. See http\Client\Curl’s options which is the only driver currently supported.
     */
    class Client implements \SplSubject, \Countable {

        const DEBUG_INFO = 0;

        const DEBUG_IN = 1;

        const DEBUG_OUT = 2;

        const DEBUG_HEADER = 16;

        const DEBUG_BODY = 32;

        const DEBUG_SSL = 64;

        private $observers;

        protected $options;

        protected $history;

        public $recordHistory;

        /**
         * Create a new HTTP client.
         *
         * @param string $driver
         * The HTTP client driver to employ. Currently only the default driver, “curl”, is supported.
         *
         * @param string $persistent_handle_id
         * If supplied, created curl handles will be persisted with this identifier for later reuse.
         */
        public function __construct($driver = null, $persistent_handle_id = null) {
        }

        public function reset() {
        }

        public function enqueue(\http\Client\Request $request, $callable = null) {
        }

        public function dequeue(\http\Client\Request $request) {
        }

        public function requeue(\http\Client\Request $request, $callable = null) {
        }

        public function count() {
        }

        public function send() {
        }

        public function once() {
        }

        public function wait($timeout = null) {
        }

        public function getResponse(\http\Client\Request $request = null) {
        }

        public function getHistory() {
        }

        public function configure(array $settings) {
        }

        public function enablePipelining($enable = null) {
        }

        public function enableEvents($enable = null) {
        }

        public function notify(\http\Client\Request $request = null) {
        }

        public function attach(\SplObserver $observer) {
        }

        public function detach(\SplObserver $observer) {
        }

        public function getObservers() {
        }

        public function getProgressInfo(\http\Client\Request $request) {
        }

        public function getTransferInfo(\http\Client\Request $request) {
        }

        public function setOptions(array $options = null) {
        }

        public function getOptions() {
        }

        public function setSslOptions(array $ssl_option = null) {
        }

        public function addSslOptions(array $ssl_options = null) {
        }

        public function getSslOptions() {
        }

        public function setCookies(array $cookies = null) {
        }

        public function addCookies(array $cookies = null) {
        }

        public function getCookies() {
        }

        public static function getAvailableDrivers() {
        }

        public function getAvailableOptions() {
        }

        public function getAvailableConfiguration() {
        }

        public function setDebug($callback) {
        }

    }

    /**
     * A class representing a list of cookies with specific attributes.
     */
    class Cookie {

        const PARSE_RAW = 1;

        const SECURE = 16;

        const HTTPONLY = 32;

        /**
         * Create a new cookie list.
         *
         * @param mixed $cookie_string
         * The string or list of cookies to parse or set.
         *
         * @param int $parser_flags
         * Parse flags. See http\Cookie::PARSE_* constants.
         *
         * @param array $allowed_extras
         * List of extra attribute names to recognize.
         */
        public function __construct($cookie_string = null, $parser_flags = null, $allowed_extras = null) {
        }

        public function getCookies() {
        }

        public function setCookies($cookies = null) {
        }

        public function addCookies($cookies) {
        }

        public function getCookie($name) {
        }

        public function setCookie($cookie_name, $cookie_value = null) {
        }

        public function addCookie($cookie_name, $cookie_value) {
        }

        public function getExtras() {
        }

        public function setExtras($extras = null) {
        }

        public function addExtras($extras) {
        }

        public function getExtra($name) {
        }

        public function setExtra($extra_name, $extra_value = null) {
        }

        public function addExtra($extra_name, $extra_value) {
        }

        public function getDomain() {
        }

        public function setDomain($value = null) {
        }

        public function getPath() {
        }

        public function setPath($value = null) {
        }

        public function getExpires() {
        }

        public function setExpires($value = null) {
        }

        public function getMaxAge() {
        }

        public function setMaxAge($value = null) {
        }

        public function getFlags() {
        }

        public function setFlags($value = null) {
        }

        public function toArray() {
        }

        public function toString() {
        }

        public function __toString() {
        }

    }

    /**
     * The http\Env class provides static methods to manipulate and inspect the server’s current request’s HTTP environment
     */
    class Env {

        public static function getRequestHeader($header_name = null) {
        }

        public static function getRequestBody($body_class_name = null) {
        }

        public static function getResponseStatusForCode($code) {
        }

        public static function getResponseStatusForAllCodes() {
        }

        public static function getResponseHeader($header_name = null) {
        }

        public static function getResponseCode() {
        }

        public static function setResponseHeader($header_name, $header_value = null, $response_code = null, $replace_header = null) {
        }

        public static function setResponseCode($code) {
        }

        public static function negotiateLanguage($supported, &$result_array = null) {
        }

        public static function negotiateContentType($supported, &$result_array = null) {
        }

        public static function negotiateEncoding($supported, &$result_array = null) {
        }

        public static function negotiateCharset($supported, &$result_array = null) {
        }

        public static function negotiate($params, $supported, $primary_type_separator = null, &$result_array = null) {
        }

    }

    interface Exception {

    }

    /**
     * The http\Header class provides methods to manipulate, match, negotiate and serialize HTTP headers.
     */
    class Header implements \Serializable {

        const MATCH_LOOSE = 0;

        const MATCH_CASE = 1;

        const MATCH_WORD = 16;

        const MATCH_FULL = 32;

        const MATCH_STRICT = 33;

        public $name;

        public $value;

        public function __construct($name = null, $value = null) {
        }

        public function serialize() {
        }

        public function __toString() {
        }

        public function toString() {
        }

        public function unserialize($serialized) {
        }

        public function match($value, $flags = null) {
        }

        public function negotiate($supported, &$result = null) {
        }

        public function getParams($param_sep = null, $arg_sep = null, $val_sep = null, $flags = null) {
        }

        public static function parse($string, $header_class = null) {
        }

    }

    /**
     * The message class builds the foundation for any request and response message.
     *
     * See http\Client\Request and http\Client\Response, as well as http\Env\Request and http\Env\Response.
     */
    class Message implements \Countable, \Serializable, \Iterator {

        const TYPE_NONE = 0;

        const TYPE_REQUEST = 1;

        const TYPE_RESPONSE = 2;

        protected $type;

        protected $body;

        protected $requestMethod;

        protected $requestUrl;

        protected $responseStatus;

        protected $responseCode;

        protected $httpVersion;

        protected $headers;

        protected $parentMessage;

        /**
         * Create a new HTTP message.
         *
         * @param mixed $message
         * Either a resource or a string, representing the HTTP message.
         *
         * @param bool $greedy
         * Whether to read from a $message resource until EOF.
         */
        public function __construct($message = null, $greedy = null) {
        }

        public function getBody() {
        }

        public function setBody(\http\Message\Body $body) {
        }

        public function addBody(\http\Message\Body $body) {
        }

        public function getHeader($header, $into_class = null) {
        }

        public function setHeader($header, $value = null) {
        }

        public function addHeader($header, $value) {
        }

        public function getHeaders() {
        }

        public function setHeaders(array $headers) {
        }

        public function addHeaders(array $headers, $append = null) {
        }

        public function getType() {
        }

        public function setType($type) {
        }

        public function getInfo() {
        }

        public function setInfo($http_info) {
        }

        public function getResponseCode() {
        }

        public function setResponseCode($response_code, $strict = null) {
        }

        public function getResponseStatus() {
        }

        public function setResponseStatus($response_status) {
        }

        public function getRequestMethod() {
        }

        public function setRequestMethod($request_method) {
        }

        public function getRequestUrl() {
        }

        public function setRequestUrl($url) {
        }

        public function getHttpVersion() {
        }

        public function setHttpVersion($http_version) {
        }

        public function getParentMessage() {
        }

        public function toString($include_parent = null) {
        }

        public function toCallback($callback) {
        }

        public function toStream($stream) {
        }

        public function count() {
        }

        public function serialize() {
        }

        public function unserialize($serialized) {
        }

        public function rewind() {
        }

        public function valid() {
        }

        public function current() {
        }

        public function key() {
        }

        public function next() {
        }

        public function __toString() {
        }

        public function detach() {
        }

        public function prepend(\http\Message $message, $top = null) {
        }

        public function reverse() {
        }

        public function isMultipart(&$boundary = null) {
        }

        public function splitMultipartBody() {
        }

    }

    /**
     * Parse, interpret and compose HTTP (header) parameters.
     */
    class Params implements \ArrayAccess {

        const DEF_PARAM_SEP = ',';

        const DEF_ARG_SEP = ';';

        const DEF_VAL_SEP = '=';

        const COOKIE_PARAM_SEP = '';

        const PARSE_RAW = 0;

        const PARSE_ESCAPED = 1;

        const PARSE_URLENCODED = 4;

        const PARSE_DIMENSION = 8;

        const PARSE_RFC5987 = 16;

        const PARSE_RFC5988 = 32;

        const PARSE_DEFAULT = 17;

        const PARSE_QUERY = 12;

        public $params;

        public $param_sep;

        public $arg_sep;

        public $val_sep;

        public $flags;

        final public function __construct($params = null, $param_sep = null, $arg_sep = null, $val_sep = null, $flags = null) {
        }

        public function toArray() {
        }

        public function toString() {
        }

        public function __toString() {
        }

        public function offsetExists($name) {
        }

        public function offsetUnset($name) {
        }

        public function offsetSet($name, $value) {
        }

        public function offsetGet($name) {
        }

    }

    /**
     * The http\QueryString class provides versatile facilities to retrieve, use and manipulate query strings and form data.
     */
    class QueryString implements \Serializable, \ArrayAccess, \IteratorAggregate {

        const TYPE_ARRAY = 7;

        const TYPE_BOOL = 13;

        const TYPE_FLOAT = 5;

        const TYPE_INT = 4;

        const TYPE_OBJECT = 8;

        const TYPE_STRING = 6;

        /**
         * The global instance. See http\QueryString::getGlobalInstance().
         *
         * @var QueryString
         */
        private $instance;

        /**
         * The data
         *
         * @var mixed[]
         */
        private $queryArray = null;

        /**
         * QueryString constructor.
         *
         * @param string $querystring
         */
        public function __construct($querystring) {
        }

        /**
         * @return string
         */
        public function __toString() {
        }

        /**
         * Retrieve an querystring value
         *
         * @param string $name
         * @param mixed $type
         * @param mixed $defval
         * @param bool $delete
         */
        public function get($name = null, $type = null, $defval = null, $delete = false) {
        }

        /**
         * Retrieve an array value at offset $name
         *
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         *
         * @return array
         */
        public function getArray($name, $defval = null, $delete = false) {
        }

        /**
         * Retrieve an array value at offset $name
         *
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         *
         * @return bool
         */
        public function getBool($name, $defval = null, $delete = false) {
        }

        /**
         * Retrieve an array value at offset $name
         *
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         *
         * @return float
         */
        public function getFloat($name, $defval = null, $delete = false) {
        }

        /**
         * Retrieve the global querystring instance referencing $_GET
         *
         * @return QueryString
         */
        public static function getGlobalInstance() {
        }

        /**
         * Retrieve an array value at offset $name
         *
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         *
         * @return int
         */
        public function getInt($name, $defval = null, $delete = false) {
        }

        /**
         * @return \IteratorAggregate
         */
        public function getIterator() {
        }

        /**
         * Retrieve an array value at offset $name
         *
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         */
        public function getObject($name, $defval = null, $delete = false) {
        }

        /**
         * Retrieve an array value at offset $name
         *
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         *
         * @return string
         */
        public function getString($name, $defval = null, $delete = false) {
        }

        /**
         * Set additional $params to a clone of this instance
         *
         * @param mixed $params
         *
         * @return QueryString
         */
        public function mod($params = null) {
        }

        public function offsetExists($offset) {
        }

        public function offsetGet($offset) {
        }

        public function offsetSet($offset, $value) {
        }

        public function offsetUnset($offset) {
        }

        public function serialize() {
        }

        /**
         * Set additional querystring entries
         *
         * @param mixed $params
         *
         * @return QueryString
         */
        public function set($params) {
        }

        /**
         * Returns http\QueryString::$queryArray
         *
         * @return mixed[]
         */
        public function toArray() {
        }

        /**
         * Get the string represenation of the querystring (x-www-form-urlencoded)
         *
         * @return string
         */
        public function toString() {
        }

        public function unserialize($serialized) {
        }

        /**
         * Translate character encodings of the querystring with ext/iconv
         *
         * @param string $from_enc
         * @param string $to_enc
         *
         * @return QueryString
         */
        public function xlate($from_encoding, $to_encoding) {
        }
    }

    /**
     * The http\Url class provides versatile means to parse, construct and manipulate URLs.
     */
    class Url {

        const FROM_ENV = 0x1000;

        const IGNORE_ERRORS = 0x10000000;

        const JOIN_PATH = 0x1;

        const JOIN_QUERY = 0x2;

        const PARSE_MBLOC = 0x10000;

        const PARSE_MBUTF8 = 0x20000;

        const PARSE_TOIDN = 0x100000;

        const PARSE_TOIDN_2003 = 0x900000;

        const PARSE_TOIDN_2008 = 0x500000;

        const PARSE_TOPCT = 0x200000;

        const REPLACE = 0x0;

        const SANITIZE_PATH = 0x2000;

        const SILENT_ERRORS = 0x20000000;

        const STDFLAGS = 0x332003;

        const STRIP_ALL = 0x1EC;

        const STRIP_AUTH = 0xC;

        const STRIP_FRAGMENT = 0x100;

        const STRIP_PASS = 0x8;

        const STRIP_PATH = 0x40;

        const STRIP_PORT = 0x20;

        const STRIP_QUERY = 0x80;

        const STRIP_USER = 0x4;

        /** @var string */
        public $scheme = null;

        /** @var string */
        public $user = null;

        /** @var string */
        public $pass = null;

        /** @var string */
        public $host = null;

        /** @var string */
        public $port = null;

        /** @var string */
        public $path = null;

        /** @var string */
        public $query = null;

        /** @var string */
        public $fragment = null;

        /**
         * Url constructor.
         *
         * @param mixed $old_url
         * @param mixed $new_url
         * @param int $flags
         */
        public function __construct($old_url = null, $new_url = null, $flags = 0) {
        }

        /**
         * Alias of Url::toString()
         */
        public function __toString() {
        }

        /**
         * Clone this URL and apply $parts to the cloned URL
         *
         * @param mixed $parts
         * @param $flags
         *
         * @return Url
         */
        public function mod($parts, $flags = http\Url::JOIN_PATH | http\Url::JOIN_QUERY | http\Url::SANITIZE_PATH) {
        }

        /**
         * Retrieve the URL parts as array
         *
         * @return string[]
         */
        public function toArray() {
        }

        /**
         * Get the string prepresentation of the URL
         *
         * @return string
         */
        public function toString() {
        }
    }
}

namespace http\Client {

    class Request extends \http\Message implements \Iterator, \Serializable, \Countable {

        protected $options;

        public function __construct($method = null, $url = null, array $headers = null, \http\Message\Body $body = null) {
        }

        public function setContentType($content_type) {
        }

        public function getContentType() {
        }

        public function setQuery($query_data = null) {
        }

        public function getQuery() {
        }

        public function addQuery($query_data) {
        }

        public function setOptions(array $options = null) {
        }

        public function getOptions() {
        }

        public function setSslOptions(array $ssl_options = null) {
        }

        public function getSslOptions() {
        }

        public function addSslOptions(array $ssl_options = null) {
        }

    }

    class Response extends \http\Message implements \Iterator, \Serializable, \Countable {

        protected $transferInfo;

        public function getCookies($flags = null, $allowed_extras = null) {
        }

        public function getTransferInfo($element = null) {
        }

    }
}

namespace http\Client\Curl {

    const AUTH_ANY = -17;
    const AUTH_BASIC = 1;
    const AUTH_DIGEST = 2;
    const AUTH_DIGEST_IE = 16;
    const AUTH_GSSNEG = 4;
    const AUTH_NTLM = 8;
    const AUTH_SPNEGO = 4;
    const FEATURES = 4179869;
    const HTTP_VERSION_1_0 = 1;
    const HTTP_VERSION_1_1 = 2;
    const HTTP_VERSION_2TLS = 4;
    const HTTP_VERSION_2_0 = 3;
    const HTTP_VERSION_ANY = 0;
    const IPRESOLVE_ANY = 0;
    const IPRESOLVE_V4 = 1;
    const IPRESOLVE_V6 = 2;
    const POSTREDIR_301 = 1;
    const POSTREDIR_302 = 2;
    const POSTREDIR_303 = 4;
    const POSTREDIR_ALL = 7;
    const PROXY_HTTP = 0;
    const PROXY_HTTP_1_0 = 1;
    const PROXY_SOCKS4 = 4;
    const PROXY_SOCKS4A = 5;
    const PROXY_SOCKS5 = 5;
    const PROXY_SOCKS5_HOSTNAME = 5;
    const SSL_VERSION_ANY = 0;
    const SSL_VERSION_SSLv2 = 2;
    const SSL_VERSION_SSLv3 = 3;
    const SSL_VERSION_TLSv1 = 1;
    const SSL_VERSION_TLSv1_0 = 4;
    const SSL_VERSION_TLSv1_1 = 5;
    const SSL_VERSION_TLSv1_2 = 6;
    const TLSAUTH_SRP = 1;
    const VERSIONS = 'libcurl/7.58.0 OpenSSL/1.1.1 zlib/1.2.11 libidn2/2.0.4 libpsl/0.19.1 (+libidn2/2.0.4) nghttp2/1.30.0 librtmp/2.3';

    interface User {

        const POLL_NONE = 0;

        const POLL_IN = 1;

        const POLL_OUT = 2;

        const POLL_INOUT = 3;

        const POLL_REMOVE = 4;

        public function init($run);

        public function timer($timeout_ms);

        public function socket($socket, $action);

        public function once();

        public function wait($timeout_ms = null);

        public function send();

    }
}

namespace http\Client\Curl\Features {

    const ASYNCHDNS = 128;
    const GSSAPI = 131072;
    const GSSNEGOTIATE = 32;
    const HTTP2 = 65536;
    const IDN = 1024;
    const IPV6 = 1;
    const KERBEROS4 = 2;
    const KERBEROS5 = 262144;
    const LARGEFILE = 512;
    const LIBZ = 8;
    const NTLM = 16;
    const NTLM_WB = 32768;
    const PSL = 1048576;
    const SPNEGO = 256;
    const SSL = 4;
    const SSPI = 2048;
    const TLSAUTH_SRP = 16384;
    const UNIX_SOCKETS = 524288;
}

namespace http\Client\Curl\Versions {

    const CURL = '7.58.0';
    const LIBZ = '1.2.11';
    const SSL = 'OpenSSL/1.1.1';
}


namespace http\Encoding {

    abstract class Stream {
        const FLUSH_NONE = 0;
        const FLUSH_SYNC = 1048576;
        const FLUSH_FULL = 2097152;

        public function __construct($flags = null) {
        }

        public function update($data) {
        }

        public function flush() {
        }

        public function done() {
        }

        public function finish() {
        }

    }
}

namespace http\Encoding\Stream {

    class Dechunk extends \http\Encoding\Stream {
        public static function decode($data, &$decoded_len = null) {
        }

    }

    class Deflate extends \http\Encoding\Stream {
        const TYPE_GZIP = 16;
        const TYPE_ZLIB = 0;
        const TYPE_RAW = 32;
        const LEVEL_DEF = 0;
        const LEVEL_MIN = 1;
        const LEVEL_MAX = 9;
        const STRATEGY_DEF = 0;
        const STRATEGY_FILT = 256;
        const STRATEGY_HUFF = 512;
        const STRATEGY_RLE = 768;
        const STRATEGY_FIXED = 1024;

        public static function encode($data, $flags = null) {
        }

    }

    class Inflate extends \http\Encoding\Stream {
        public static function decode($data) {
        }

    }
}

namespace http\Env {

    /**
     * The http\Env\Request class' instances represent the server’s current HTTP request.
     *
     * See http\Message for inherited members.
     */
    class Request extends \http\Message {

        /**
         * The request’s query parameters. ($_GET)
         *
         * @var http\QueryString
         */
        protected $query = null;

        /**
         * The request’s form parameters. ($_POST)
         *
         * @var http\QueryString
         */
        protected $form = null;

        /**
         * The request’s form uploads. ($_FILES)
         *
         * @var array
         */
        protected $files = null;

        /**
         * The request’s cookies. ($_COOKIE)
         *
         * @var array
         */
        protected $cookie = null;

        public function __construct() {
        }

        /**
         * Retrieve an URL query value ($_GET)
         *
         * @param string $name
         * @param mixed $type
         * @param mixed $defval
         * @param bool $delete
         *
         * @return mixed
         */
        public function getCookie($name = null, $type = null, $defval = null, $delete = false) {
        }

        /**
         * Retrieve the uploaded files list ($_FILES)
         *
         * @return array
         */
        public function getFiles() {
        }

        /**
         * Retrieve a form value ($_POST)
         *
         * @param string $name
         * @param mixed $type
         * @param mixed $defval
         * @param bool $delete
         *
         * @return mixed
         */
        public function getForm($name = null, $type = null, $defval = null, $delete = false) {
        }

        /**
         * Retrieve an URL query value ($_GET)
         *
         * @param string $name
         * @param mixed $type
         * @param mixed $defval
         * @param bool $delete
         *
         * @return mixed
         */
        public function getQuery($name = null, $type = null, $defval = null, $delete = false) {
        }
    }

    /**
     * Class Response
     *
     * The http\Env\Response class' instances represent the server’s current HTTP response.
     *
     * See http\Message for inherited members.
     *
     * @package http\Env
     */
    class Response extends \http\Message {

        const CACHE_HIT = 1;

        const CACHE_MISS = 2;

        const CACHE_NO = 0;

        const CONTENT_ENCODING_GZIP = 1;

        const CONTENT_ENCODING_NONE = 0;

        /**
         * How the client should treat this response in regards to caching
         *
         * @var string
         */
        protected $cacheControl = null;

        /**
         * The response’s cookies.
         *
         * @var array
         */
        protected $cookies = null;

        /**
         * The response’s MIME content type
         *
         * @var string
         */
        protected $contentType = null;

        /**
         * The response’s MIME content disposition
         *
         * @var string
         */
        protected $contentDisposition = null;

        /**
         * See http\Env\Response::CONTENT_ENCODING_* constants
         *
         * @var int
         */
        protected $contentEncoding = null;

        /**
         * A custom ETag
         *
         * @var string
         */
        protected $etag = null;

        /**
         * A “Last-Modified” time stamp.
         *
         * @var int
         */
        protected $lastModified = null;

        /**
         * A request instance which overrides the environments default request
         *
         * @var \http\Env\Request
         */
        protected $request = null;

        /**
         * Any throttling delay.
         *
         * @var int
         */
        protected $throttleDelay = null;

        /**
         * The chunk to send every $throttleDelay seconds.
         *
         * @var int
         */
        protected $throttleChunk = null;

        public function __construct() {
        }

        /**
         * Output buffer handler
         *
         * @param string $data
         * @param int $ob_flags
         *
         * @return bool
         */
        public function __invoke($data, $ob_flags = 0) {
        }

        /**
         * @param string $header_name
         *
         * @return int
         */
        public function isCachedByETag($header_name = 'If-None-Match') {
        }

        /**
         * @param string $header_name
         *
         * @return int
         */
        public function isCachedByLastModified($header_name = 'If-Modified-Since') {
        }

        /**
         * Send the response through the SAPI or $stream
         *
         * @param resource $stream
         *
         * @return bool
         */
        public function send($stream = null) {
        }

        /**
         * Make suggestions to the client how it should cache the response
         *
         * @param string $cache_control
         *
         * @return Response
         */
        public function setCacheControl($cache_control) {
        }

        /**
         * Set the reponse’s content disposition parameters
         *
         * @param array $disposition_params
         *
         * @return Response
         */
        public function setContentDisposition($disposition_params) {
        }

        /**
         * Enable support for “Accept-Encoding” requests with deflate or gzip
         *
         * @param int $content_encoding
         *
         * @return Response
         */
        public function setContentEncoding($content_encoding) {
        }

        /**
         * Set the MIME content type of the response
         *
         * @param string $content_type
         *
         * @return Response
         */
        public function setContentType($content_type) {
        }

        /**
         * Add cookies to the response to send
         *
         * @param mixed $cookie
         *
         * @return Response
         */
        public function setCookie($cookie) {
        }

        /**
         * Override the environment’s request
         *
         * @param \http\Message $env_request
         *
         * @return Response
         */
        public function setEnvRequest($env_request) {
        }

        /**
         * Override the environment’s request
         *
         * @param string $etag
         *
         * @return Response
         */
        public function setEtag($etag) {
        }

        /**
         * Override the environment’s request
         *
         * @param int $last_modified
         *
         * @return Response
         */
        public function setLastModified($last_modified) {
        }

        /**
         * Override the environment’s request
         *
         * @param int $chunk_size
         * @param float $delay
         *
         * @return Response
         */
        public function setThrottleRate($chunk_size, $delay = 1) {
        }
    }

    class Url extends \http\Url {

    }
}

namespace http\Exception {

    class BadConversionException extends \DomainException implements \Throwable, \http\Exception {
    }

    class BadQueryStringException extends \DomainException implements \Throwable, \http\Exception {
    }

    class BadUrlException extends \DomainException implements \Throwable, \http\Exception {
    }

    class BadMessageException extends \DomainException implements \Throwable, \http\Exception {
    }

    class BadHeaderException extends \DomainException implements \Throwable, \http\Exception {
    }

    class InvalidArgumentException extends \InvalidArgumentException implements \Throwable, \http\Exception {
    }

    class BadMethodCallException extends \BadMethodCallException implements \Throwable, \http\Exception {
    }

    class UnexpectedValueException extends \UnexpectedValueException implements \Throwable, \http\Exception {
    }

    class RuntimeException extends \RuntimeException implements \Throwable, \http\Exception {
    }
}

namespace http\Header {

    class Parser {
        const CLEANUP = 1;
        const STATE_FAILURE = -1;
        const STATE_START = 0;
        const STATE_KEY = 1;
        const STATE_VALUE = 2;
        const STATE_VALUE_EX = 3;
        const STATE_HEADER_DONE = 4;
        const STATE_DONE = 5;

        public function getState() {
        }

        public function parse($data, $flags, array &$headers) {
        }

        public function stream($stream, $flags, array &$headers) {
        }

    }
}

namespace http\Message {

    /**
     * The message body, represented as a PHP (temporary) stream.
     */
    class Body implements \Serializable {

        /**
         * Create a new message body, optionally referencing $stream.
         *
         * @param resource $stream A stream to be used as message body.
         */
        public function __construct($stream = null) {
        }

        public function __toString() {
        }

        public function toString() {
        }

        public function serialize() {
        }

        public function unserialize($serialized) {
        }

        public function toStream($stream, $offset = null, $maxlen = null) {
        }

        public function toCallback($callback, $offset = null, $maxlen = null) {
        }

        public function getResource() {
        }

        public function getBoundary() {
        }

        public function append($string) {
        }

        public function addForm(array $fields = null, array $files = null) {
        }

        public function addPart(\http\Message $message) {
        }

        public function etag() {
        }

        public function stat($field = null) {
        }

    }

    /**
     * The parser which is underlying http\Message.
     */
    class Parser {
        const CLEANUP = 1;
        const DUMB_BODIES = 2;
        const EMPTY_REDIRECTS = 4;
        const GREEDY = 8;
        const STATE_FAILURE = -1;
        const STATE_START = 0;
        const STATE_HEADER = 1;
        const STATE_HEADER_DONE = 2;
        const STATE_BODY = 3;
        const STATE_BODY_DUMB = 4;
        const STATE_BODY_LENGTH = 5;
        const STATE_BODY_CHUNKED = 6;
        const STATE_BODY_DONE = 7;
        const STATE_UPDATE_CL = 8;
        const STATE_DONE = 9;

        public function getState() {
        }

        public function parse($data, $flags, &$message) {
        }

        public function stream($stream, $flags, &$message) {
        }

    }
}
