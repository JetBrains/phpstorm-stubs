<?php
/**
 * PHPStorm stub file for HTTP classes.
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
 * @link http://php.net/manual/en/class.httpdeflatestream.php
 */
class HttpDeflateStream
{
    const FLUSH_FULL = 2097152;
    const FLUSH_NONE = 0;
    const FLUSH_SYNC = 1048576;
    const LEVEL_DEF = 0;
    const LEVEL_MAX = 9;
    const LEVEL_MIN = 1;
    const STRATEGY_DEF = 0;
    const STRATEGY_FILT = 256;
    const STRATEGY_FIXED = 1024;
    const STRATEGY_HUFF = 512;
    const STRATEGY_RLE = 768;
    const TYPE_GZIP = 16;
    const TYPE_RAW = 32;
    const TYPE_ZLIB = 0;

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * HttpDeflateStream class constructor
     *
     * @link http://php.net/manual/en/function.httpdeflatestream-construct.php
     *
     * @param int $flags [optional] <p>
     *                   initialization flags
     *                   </p>
     */
    public function __construct($flags = null) { }

    /**
     * (PECL pecl_http &gt;= 1.4.0)<br/>
     * HttpDeflateStream class factory
     *
     * @link http://php.net/manual/en/function.httpdeflatestream-factory.php
     *
     * @param int    $flags      [optional] <p>
     *                           initialization flags
     *                           </p>
     * @param string $class_name [optional] <p>
     *                           name of a subclass of HttpDeflateStream
     *                           </p>
     *
     * @return HttpDeflateStream
     */
    public static function factory($flags = null, $class_name = null) { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Finalize deflate stream
     *
     * @link http://php.net/manual/en/function.httpdeflatestream-finish.php
     *
     * @param string $data [optional] <p>
     *                     data to deflate
     *                     </p>
     *
     * @return string the final part of deflated data.
     */
    public function finish($data = null) { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Flush deflate stream
     *
     * @link http://php.net/manual/en/function.httpdeflatestream-flush.php
     *
     * @param string $data [optional] <p>
     *                     more data to deflate
     *                     </p>
     *
     * @return string some deflated data as string on success or false on failure.
     */
    public function flush($data = null) { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Update deflate stream
     *
     * @link http://php.net/manual/en/function.httpdeflatestream-update.php
     *
     * @param string $data <p>
     *                     data to deflate
     *                     </p>
     *
     * @return string deflated data on success or false on failure.
     */
    public function update($data) { }
}

/**
 * Class HttpEncodingException
 */
class HttpEncodingException extends HttpException
{
}

/**
 * Class HttpException
 */
class HttpException extends Exception
{
    public $innerException;
}

/**
 * Class HttpHeaderException
 */
class HttpHeaderException extends HttpException
{
}

/**
 * @link http://php.net/manual/en/class.httpinflatestream.php
 */
class HttpInflateStream
{
    const FLUSH_FULL = 2097152;
    const FLUSH_NONE = 0;
    const FLUSH_SYNC = 1048576;

    /**
     * (PECL pecl_http &gt;= 1.0.0)<br/>
     * HttpInflateStream class constructor
     *
     * @link http://php.net/manual/en/function.httpinflatestream-construct.php
     *
     * @param int $flags [optional] <p>
     *                   initialization flags
     *                   </p>
     */
    public function __construct($flags = null) { }

    /**
     * (PECL pecl_http &gt;= 1.4.0)<br/>
     * HttpInflateStream class factory
     *
     * @link http://php.net/manual/en/function.httpinflatestream-factory.php
     *
     * @param int    $flags      [optional] <p>
     *                           initialization flags
     *                           </p>
     * @param string $class_name [optional] <p>
     *                           name of a subclass of HttpInflateStream
     *                           </p>
     *
     * @return HttpInflateStream
     */
    public static function factory($flags = null, $class_name = null) { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Finalize inflate stream
     *
     * @link http://php.net/manual/en/function.httpinflatestream-finish.php
     *
     * @param string $data [optional] <p>
     *                     data to inflate
     *                     </p>
     *
     * @return string the final part of inflated data.
     */
    public function finish($data = null) { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Flush inflate stream
     *
     * @link http://php.net/manual/en/function.httpinflatestream-flush.php
     *
     * @param string $data [optional] <p>
     *                     more data to inflate
     *                     </p>
     *
     * @return string some inflated data as string on success or false on failure.
     */
    public function flush($data = null) { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Update inflate stream
     *
     * @link http://php.net/manual/en/function.httpinflatestream-update.php
     *
     * @param string $data <p>
     *                     data to inflate
     *                     </p>
     *
     * @return string inflated data on success or false on failure.
     */
    public function update($data) { }
}

/**
 * Class HttpInvalidParamException
 */
class HttpInvalidParamException extends HttpException
{
}

/**
 * Class HttpMalformedHeadersException
 */
class HttpMalformedHeadersException extends HttpException
{
}

/**
 * @link http://php.net/manual/en/class.httpmessage.php
 */
class HttpMessage implements Countable, Serializable, Iterator, Traversable
{
    const TYPE_NONE = 0;
    const TYPE_REQUEST = 1;
    const TYPE_RESPONSE = 2;
    protected $body;
    protected $headers;
    protected $httpVersion;
    protected $parentMessage;
    protected $requestMethod;
    protected $requestUrl;
    protected $responseCode;
    protected $responseStatus;
    protected $type;

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * HttpMessage constructor
     *
     * @link http://php.net/manual/en/function.httpmessage-construct.php
     *
     * @param string $message [optional] <p>
     *                        a single or several consecutive HTTP messages
     *                        </p>
     */
    public function __construct($message = null) { }

    /**
     * (PECL pecl_http &gt;= 1.4.0)<br/>
     * Create HttpMessage from string
     *
     * @link http://php.net/manual/en/function.httpmessage-factory.php
     *
     * @param string $raw_message [optional] <p>
     *                            a single or several consecutive HTTP messages
     *                            </p>
     * @param string $class_name  [optional] <p>
     *                            a class extending HttpMessage
     *                            </p>
     *
     * @return HttpMessage an HttpMessage object on success or NULL on failure.
     */
    public static function factory($raw_message = null, $class_name = null) { }

    /**
     * (PECL pecl_http &gt;= 1.5.0)<br/>
     * Create HttpMessage from environment
     *
     * @link http://php.net/manual/en/function.httpmessage-fromenv.php
     *
     * @param int    $message_type <p>
     *                             The message type. See HttpMessage type constants.
     *                             </p>
     * @param string $class_name   [optional] <p>
     *                             a class extending HttpMessage
     *                             </p>
     *
     * @return HttpMessage an HttpMessage object on success or NULL on failure.
     */
    public static function fromEnv($message_type, $class_name = null) { }

    /**
     * (PECL pecl_http 0.10.0-1.3.3)<br/>
     * Create HttpMessage from string
     *
     * @link http://php.net/manual/en/function.httpmessage-fromstring.php
     *
     * @param string $raw_message [optional] <p>
     *                            a single or several consecutive HTTP messages
     *                            </p>
     * @param string $class_name  [optional] <p>
     *                            a class extending HttpMessage
     *                            </p>
     *
     * @return HttpMessage an HttpMessage object on success or NULL on failure.
     */
    public static function fromString($raw_message = null, $class_name = null) { }

    /**
     * @return string
     */
    public function __toString() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Add headers
     *
     * @link http://php.net/manual/en/function.httpmessage-addheaders.php
     *
     * @param array $headers <p>
     *                       associative array containing the additional HTTP headers to add to the messages existing
     *                       headers
     *                       </p>
     * @param bool  $append  [optional] <p>
     *                       if true, and a header with the same name of one to add exists already, this respective
     *                       header will be converted to an array containing both header values, otherwise
     *                       it will be overwritten with the new header value
     *                       </p>
     *
     * @return void true on success or false on failure.
     */
    public function addHeaders(array $headers, $append = null) { }

    public function count() { }

    public function current() { }

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * Detach HttpMessage
     *
     * @link http://php.net/manual/en/function.httpmessage-detach.php
     * @return HttpMessage detached HttpMessage object copy.
     */
    public function detach() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get message body
     *
     * @link http://php.net/manual/en/function.httpmessage-getbody.php
     * @return string the message body as string.
     */
    public function getBody() { }

    /**
     * (PECL pecl_http &gt;= 0.14.0)<br/>
     * Set message body
     *
     * @link http://php.net/manual/en/function.httpmessage-setbody.php
     *
     * @param string $body <p>
     *                     the new body of the message
     *                     </p>
     *
     * @return void
     */
    public function setBody($body) { }

    /**
     * (PECL pecl_http &gt;= 1.1.0)<br/>
     * Get header
     *
     * @link http://php.net/manual/en/function.httpmessage-getheader.php
     *
     * @param string $header <p>
     *                       header name
     *                       </p>
     *
     * @return string the header value on success or NULL if the header does not exist.
     */
    public function getHeader($header) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get message headers
     *
     * @link http://php.net/manual/en/function.httpmessage-getheaders.php
     * @return array an associative array containing the messages HTTP headers.
     */
    public function getHeaders() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set headers
     *
     * @link http://php.net/manual/en/function.httpmessage-setheaders.php
     *
     * @param array $headers <p>
     *                       associative array containing the new HTTP headers, which will replace all previous HTTP
     *                       headers of the message
     *                       </p>
     *
     * @return void
     */
    public function setHeaders(array $headers) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get HTTP version
     *
     * @link http://php.net/manual/en/function.httpmessage-gethttpversion.php
     * @return string the HTTP protocol version as string.
     */
    public function getHttpVersion() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set HTTP version
     *
     * @link http://php.net/manual/en/function.httpmessage-sethttpversion.php
     *
     * @param string $version <p>
     *                        the HTTP protocol version
     *                        </p>
     *
     * @return bool TRUE on success, or FALSE if supplied version is out of range (1.0/1.1).
     */
    public function setHttpVersion($version) { }

    public function getInfo() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get parent message
     *
     * @link http://php.net/manual/en/function.httpmessage-getparentmessage.php
     * @return HttpMessage the parent HttpMessage object.
     */
    public function getParentMessage() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get request method
     *
     * @link http://php.net/manual/en/function.httpmessage-getrequestmethod.php
     * @return string the request method name on success, or FALSE if the message is
     * not of type HttpMessage::TYPE_REQUEST.
     */
    public function getRequestMethod() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set request method
     *
     * @link http://php.net/manual/en/function.httpmessage-setrequestmethod.php
     *
     * @param string $method <p>
     *                       the request method name
     *                       </p>
     *
     * @return bool TRUE on success, or FALSE if the message is not of type
     * HttpMessage::TYPE_REQUEST or an invalid request method was supplied.
     */
    public function setRequestMethod($method) { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Get request URL
     *
     * @link http://php.net/manual/en/function.httpmessage-getrequesturl.php
     * @return string the request URL as string on success, or FALSE if the message
     * is not of type HttpMessage::TYPE_REQUEST.
     */
    public function getRequestUrl() { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Set request URL
     *
     * @link http://php.net/manual/en/function.httpmessage-setrequesturl.php
     *
     * @param string $url <p>
     *                    the request URL
     *                    </p>
     *
     * @return bool TRUE on success, or FALSE if the message is not of type
     * HttpMessage::TYPE_REQUEST or supplied URL was empty.
     */
    public function setRequestUrl($url) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get response code
     *
     * @link http://php.net/manual/en/function.httpmessage-getresponsecode.php
     * @return int the HTTP response code if the message is of type HttpMessage::TYPE_RESPONSE, else FALSE.
     */
    public function getResponseCode() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set response code
     *
     * @link http://php.net/manual/en/function.httpmessage-setresponsecode.php
     *
     * @param int $code <p>
     *                  HTTP response code
     *                  </p>
     *
     * @return bool TRUE on success, or FALSE if the message is not of type
     * HttpMessage::TYPE_RESPONSE or the response code is out of range (100-510).
     */
    public function setResponseCode($code) { }

    /**
     * (PECL pecl_http &gt;= 0.23.0)<br/>
     * Get response status
     *
     * @link http://php.net/manual/en/function.httpmessage-getresponsestatus.php
     * @return string the HTTP response status string if the message is of type
     * HttpMessage::TYPE_RESPONSE, else FALSE.
     */
    public function getResponseStatus() { }

    /**
     * (PECL pecl_http &gt;= 0.23.0)<br/>
     * Set response status
     *
     * @link http://php.net/manual/en/function.httpmessage-setresponsestatus.php
     *
     * @param string $status <p>
     *                       the response status text
     *                       </p>
     *
     * @return bool TRUE on success or FALSE if the message is not of type
     * HttpMessage::TYPE_RESPONSE.
     */
    public function setResponseStatus($status) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get message type
     *
     * @link http://php.net/manual/en/function.httpmessage-gettype.php
     * @return int the HttpMessage::TYPE.
     */
    public function getType() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set message type
     *
     * @link http://php.net/manual/en/function.httpmessage-settype.php
     *
     * @param int $type <p>
     *                  the HttpMessage::TYPE
     *                  </p>
     *
     * @return void
     */
    public function setType($type) { }

    /**
     * (PECL pecl_http &gt;= 1.0.0)<br/>
     * Guess content type
     *
     * @link http://php.net/manual/en/function.httpmessage-guesscontenttype.php
     *
     * @param string $magic_file <p>
     *                           the magic.mime database to use
     *                           </p>
     * @param int    $magic_mode [optional] <p>
     *                           flags for libmagic
     *                           </p>
     *
     * @return string the guessed content type on success or false on failure.
     */
    public function guessContentType($magic_file, $magic_mode = null) { }

    public function key() { }

    public function next() { }

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * Prepend message(s)
     *
     * @link http://php.net/manual/en/function.httpmessage-prepend.php
     *
     * @param HttpMessage $message <p>
     *                             HttpMessage object to prepend
     *                             </p>
     * @param bool        $top     [optional] <p>
     *                             whether to prepend to the top most or right this message
     *                             </p>
     *
     * @return void
     */
    public function prepend(HttpMessage $message, $top = null) { }

    /**
     * (PECL pecl_http &gt;= 0.23.0)<br/>
     * Reverse message chain
     *
     * @link http://php.net/manual/en/function.httpmessage-reverse.php
     * @return HttpMessage the most parent HttpMessage object.
     */
    public function reverse() { }

    public function rewind() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Send message
     *
     * @link http://php.net/manual/en/function.httpmessage-send.php
     * @return bool true on success or false on failure.
     */
    public function send() { }

    public function serialize() { }

    /**
     * @param $http_info
     */
    public function setInfo($http_info) { }

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * Create HTTP object regarding message type
     *
     * @link http://php.net/manual/en/function.httpmessage-tomessagetypeobject.php
     * @return HttpRequest|HttpResponse either an HttpRequest or HttpResponse object on success, or NULL on failure.
     */
    public function toMessageTypeObject() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get string representation
     *
     * @link http://php.net/manual/en/function.httpmessage-tostring.php
     *
     * @param bool $include_parent [optional] <p>
     *                             specifies whether the returned string should also contain any parent messages
     *                             </p>
     *
     * @return string the message as string.
     */
    public function toString($include_parent = null) { }

    /**
     * @param $serialized
     */
    public function unserialize($serialized) { }

    public function valid() { }
}

/**
 * Class HttpMessageTypeException
 */
class HttpMessageTypeException extends HttpException
{
}

/**
 * @link http://php.net/manual/en/class.httpquerystring.php
 */
class HttpQueryString implements Serializable, ArrayAccess
{
    const TYPE_ARRAY = 4;
    const TYPE_BOOL = 3;
    const TYPE_FLOAT = 2;
    const TYPE_INT = 1;
    const TYPE_OBJECT = 5;
    const TYPE_STRING = 6;

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * HttpQueryString constructor
     *
     * @link http://php.net/manual/en/function.httpquerystring-construct.php
     *
     * @param bool  $global [optional] <p>
     *                      whether to operate on $_GET and
     *                      $_SERVER['QUERY_STRING']
     *                      </p>
     * @param mixed $add    [optional] <p>
     *                      additional/initial query string parameters
     *                      </p>
     */
    final public function __construct($global = null, $add = null) { }

    /**
     * @param $global     [optional]
     * @param $params     [optional]
     * @param $class_name [optional]
     */
    public static function factory($global, $params, $class_name) { }

    /**
     * (PECL pecl_http &gt;= 0.25.0)<br/>
     * HttpQueryString singleton
     *
     * @link http://php.net/manual/en/function.httpquerystring-singleton.php
     *
     * @param bool $global [optional] <p>
     *                     whether to operate on $_GET and
     *                     $_SERVER['QUERY_STRING']
     *                     </p>
     *
     * @return HttpQueryString always the same HttpQueryString instance regarding the global setting.
     */
    public static function singleton($global = null) { }

    /**
     * @return string
     */
    public function __toString() { }

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * Get (part of) query string
     *
     * @link http://php.net/manual/en/function.httpquerystring-get.php
     *
     * @param string $key    [optional] <p>
     *                       key of the query string param to retrieve
     *                       </p>
     * @param mixed  $type   [optional] <p>
     *                       which variable type to enforce
     *                       </p>
     * @param mixed  $defval [optional] <p>
     *                       default value if key does not exist
     *                       </p>
     * @param bool   $delete [optional] <p>
     *                       whether to remove the key/value pair from the query string
     *                       </p>
     *
     * @return mixed the value of the query string param or the whole query string if no key was specified on success
     *               or defval if key does not exist.
     */
    public function get($key = null, $type = null, $defval = null, $delete = null) { }

    /**
     * @param $name
     * @param $defval [optional]
     * @param $delete [optional]
     */
    public function getArray($name, $defval, $delete) { }

    /**
     * @param $name
     * @param $defval [optional]
     * @param $delete [optional]
     */
    public function getBool($name, $defval, $delete) { }

    /**
     * @param $name
     * @param $defval [optional]
     * @param $delete [optional]
     */
    public function getFloat($name, $defval, $delete) { }

    /**
     * @param $name
     * @param $defval [optional]
     * @param $delete [optional]
     */
    public function getInt($name, $defval, $delete) { }

    /**
     * @param $name
     * @param $defval [optional]
     * @param $delete [optional]
     */
    public function getObject($name, $defval, $delete) { }

    /**
     * @param $name
     * @param $defval [optional]
     * @param $delete [optional]
     */
    public function getString($name, $defval, $delete) { }

    /**
     * (PECL pecl_http &gt;= 1.1.0)<br/>
     * Modifiy query string copy
     *
     * @link http://php.net/manual/en/function.httpquerystring-mod.php
     *
     * @param mixed $params <p>
     *                      query string params to add
     *                      </p>
     *
     * @return HttpQueryString a new HttpQueryString object
     */
    public function mod($params) { }

    /**
     * Whether a offset exists
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset) { }

    /**
     * Offset to retrieve
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset) { }

    /**
     * Offset to set
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value) { }

    /**
     * Offset to unset
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset) { }

    /**
     * String representation of object
     *
     * @link  http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize() { }

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * Set query string params
     *
     * @link http://php.net/manual/en/function.httpquerystring-set.php
     *
     * @param mixed $params <p>
     *                      query string params to add
     *                      </p>
     *
     * @return string the current query string.
     */
    public function set($params) { }

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * Get query string as array
     *
     * @link http://php.net/manual/en/function.httpquerystring-toarray.php
     * @return array the array representation of the query string.
     */
    public function toArray() { }

    /**
     * (PECL pecl_http &gt;= 0.22.0)<br/>
     * Get query string
     *
     * @link http://php.net/manual/en/function.httpquerystring-tostring.php
     * @return string the string representation of the query string.
     */
    public function toString() { }

    /**
     * Constructs the object
     *
     * @link  http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized <p>
     *                           The string representation of the object.
     *                           </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized) { }

    /**
     * (PECL pecl_http &gt;= 0.25.0)<br/>
     * Change query strings charset
     *
     * @link http://php.net/manual/en/function.httpquerystring-xlate.php
     *
     * @param string $ie <p>
     *                   input encoding
     *                   </p>
     * @param string $oe <p>
     *                   output encoding
     *                   </p>
     *
     * @return bool true on success or false on failure.
     */
    public function xlate($ie, $oe) { }
}

/**
 * Class HttpQueryStringException
 */
class HttpQueryStringException extends HttpException
{
}

/**
 * @link http://php.net/manual/en/class.httprequest.php
 */
class HttpRequest
{
    const AUTH_ANY = -1;
    const AUTH_BASIC = 1;
    const AUTH_DIGEST = 2;
    const AUTH_GSSNEG = 4;
    const AUTH_NTLM = 8;
    const IPRESOLVE_ANY = 0;
    const IPRESOLVE_V4 = 1;
    const IPRESOLVE_V6 = 2;
    const METH_ACL = 27;
    const METH_BASELINE_CONTROL = 25;
    const METH_CHECKIN = 19;
    const METH_CHECKOUT = 18;
    const METH_CONNECT = 8;
    const METH_COPY = 12;
    const METH_DELETE = 5;
    const METH_GET = 1;
    const METH_HEAD = 2;
    const METH_LABEL = 23;
    const METH_LOCK = 14;
    const METH_MERGE = 24;
    const METH_MKACTIVITY = 26;
    const METH_MKCOL = 11;
    const METH_MKWORKSPACE = 21;
    const METH_MOVE = 13;
    const METH_OPTIONS = 6;
    const METH_POST = 3;
    const METH_PROPFIND = 9;
    const METH_PROPPATCH = 10;
    const METH_PUT = 4;
    const METH_REPORT = 17;
    const METH_TRACE = 7;
    const METH_UNCHECKOUT = 20;
    const METH_UNLOCK = 15;
    const METH_UPDATE = 22;
    const METH_VERSION_CONTROL = 16;
    const PROXY_HTTP = 0;
    const PROXY_SOCKS4 = 4;
    const PROXY_SOCKS5 = 5;
    const SSL_VERSION_ANY = 0;
    const SSL_VERSION_SSLv2 = 2;
    const SSL_VERSION_SSLv3 = 3;
    const SSL_VERSION_TLSv1 = 1;
    const VERSION_1_0 = 1;
    const VERSION_1_1 = 2;
    const VERSION_ANY = 0;
    const VERSION_NONE = 0;
    public $recordHistory;

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * HttpRequest constructor
     *
     * @link http://php.net/manual/en/function.httprequest-construct.php
     *
     * @param string $url            [optional] <p>
     *                               the target request url
     *                               </p>
     * @param int    $request_method [optional] <p>
     *                               the request method to use
     *                               </p>
     * @param array  $options        [optional] <p>
     *                               an associative array with request options
     *                               </p>
     */
    public function __construct($url = null, $request_method = null, array $options = null) { }

    /**
     * @param $fields
     * @param $files
     */
    public static function encodeBody($fields, $files) { }

    /**
     * @param $url        [optional]
     * @param $method     [optional]
     * @param $options    [optional]
     * @param $class_name [optional]
     */
    public static function factory($url, $method, $options, $class_name) { }

    /**
     * @param $url
     * @param $options [optional]
     * @param $info    [optional]
     */
    public static function get($url, $options, &$info) { }

    /**
     * @param $url
     * @param $options [optional]
     * @param $info    [optional]
     */
    public static function head($url, $options, &$info) { }

    /**
     * @param $method
     */
    public static function methodExists($method) { }

    /**
     * @param $method_id
     */
    public static function methodName($method_id) { }

    /**
     * @param $method_name
     */
    public static function methodRegister($method_name) { }

    /**
     * @param $method
     */
    public static function methodUnregister($method) { }

    /**
     * @param $url
     * @param $data
     * @param $options [optional]
     * @param $info    [optional]
     */
    public static function postData($url, $data, $options, &$info) { }

    /**
     * @param $url
     * @param $data
     * @param $options [optional]
     * @param $info    [optional]
     */
    public static function postFields($url, $data, $options, &$info) { }

    /**
     * @param $url
     * @param $data
     * @param $options [optional]
     * @param $info    [optional]
     */
    public static function putData($url, $data, $options, &$info) { }

    /**
     * @param $url
     * @param $file
     * @param $options [optional]
     * @param $info    [optional]
     */
    public static function putFile($url, $file, $options, &$info) { }

    /**
     * @param $url
     * @param $stream
     * @param $options [optional]
     * @param $info    [optional]
     */
    public static function putStream($url, $stream, $options, &$info) { }

    /**
     * @param $request_body_data
     */
    public function addBody($request_body_data) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Add cookies
     *
     * @link http://php.net/manual/en/function.httprequest-addcookies.php
     *
     * @param array $cookies <p>
     *                       an associative array containing any cookie name/value pairs to add
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public function addCookies(array $cookies) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Add headers
     *
     * @link http://php.net/manual/en/function.httprequest-addheaders.php
     *
     * @param array $headers <p>
     *                       an associative array as parameter containing additional header name/value pairs
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public function addHeaders(array $headers) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Add post fields
     *
     * @link http://php.net/manual/en/function.httprequest-addpostfields.php
     *
     * @param array $post_data <p>
     *                         an associative array as parameter containing the post fields
     *                         </p>
     *
     * @return bool true on success or false on failure.
     */
    public function addPostFields(array $post_data) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Add post file
     *
     * @link http://php.net/manual/en/function.httprequest-addpostfile.php
     *
     * @param string $name         <p>
     *                             the form element name
     *                             </p>
     * @param string $file         <p>
     *                             the path to the file
     *                             </p>
     * @param string $content_type [optional] <p>
     *                             the content type of the file
     *                             </p>
     *
     * @return bool TRUE on success, or FALSE if the content type seems not to contain a
     * primary and a secondary content type part.
     */
    public function addPostFile($name, $file, $content_type = null) { }

    /**
     * (PECL pecl_http &gt;= 0.25.0)<br/>
     * Add put data
     *
     * @link http://php.net/manual/en/function.httprequest-addputdata.php
     *
     * @param string $put_data <p>
     *                         the data to concatenate
     *                         </p>
     *
     * @return bool true on success or false on failure.
     */
    public function addPutData($put_data) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Add query data
     *
     * @link http://php.net/manual/en/function.httprequest-addquerydata.php
     *
     * @param array $query_params <p>
     *                            an associative array as parameter containing the query fields to add
     *                            </p>
     *
     * @return bool true on success or false on failure.
     */
    public function addQueryData(array $query_params) { }

    /**
     * (PECL pecl_http 0.14.0-1.4.1)<br/>
     * Add raw post data
     *
     * @link http://php.net/manual/en/function.httprequest-addrawpostdata.php
     *
     * @param string $raw_post_data <p>
     *                              the raw post data to concatenate
     *                              </p>
     *
     * @return bool true on success or false on failure.
     */
    public function addRawPostData($raw_post_data) { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Add ssl options
     *
     * @link http://php.net/manual/en/function.httprequest-addssloptions.php
     *
     * @param array $options <p>
     *                       an associative array as parameter containing additional SSL specific options
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public function addSslOptions(array $options) { }

    /**
     * (PECL pecl_http &gt;= 0.15.0)<br/>
     * Clear history
     *
     * @link http://php.net/manual/en/function.httprequest-clearhistory.php
     * @return void
     */
    public function clearHistory() { }

    /**
     * (PECL pecl_http &gt;= 1.0.0)<br/>
     * Enable cookies
     *
     * @link http://php.net/manual/en/function.httprequest-enablecookies.php
     * @return bool true on success or false on failure.
     */
    public function enableCookies() { }

    public function flushCookies() { }

    public function getBody() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get content type
     *
     * @link http://php.net/manual/en/function.httprequest-getcontenttype.php
     * @return string the previously set content type as string.
     */
    public function getContentType() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get cookies
     *
     * @link http://php.net/manual/en/function.httprequest-getcookies.php
     * @return array an associative array containing any previously set cookies.
     */
    public function getCookies() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get headers
     *
     * @link http://php.net/manual/en/function.httprequest-getheaders.php
     * @return array an associative array containing all currently set headers.
     */
    public function getHeaders() { }

    /**
     * (PECL pecl_http &gt;= 0.15.0)<br/>
     * Get history
     *
     * @link http://php.net/manual/en/function.httprequest-gethistory.php
     * @return HttpMessage an HttpMessage object representing the complete request/response history.
     */
    public function getHistory() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get method
     *
     * @link http://php.net/manual/en/function.httprequest-getmethod.php
     * @return int the currently set request method.
     */
    public function getMethod() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get options
     *
     * @link http://php.net/manual/en/function.httprequest-getoptions.php
     * @return array an associative array containing currently set options.
     */
    public function getOptions() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get post fields
     *
     * @link http://php.net/manual/en/function.httprequest-getpostfields.php
     * @return array the currently set post fields as associative array.
     */
    public function getPostFields() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get post files
     *
     * @link http://php.net/manual/en/function.httprequest-getpostfiles.php
     * @return array an array containing currently set post files.
     */
    public function getPostFiles() { }

    /**
     * (PECL pecl_http &gt;= 0.25.0)<br/>
     * Get put data
     *
     * @link http://php.net/manual/en/function.httprequest-getputdata.php
     * @return string a string containing the currently set PUT data.
     */
    public function getPutData() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get put file
     *
     * @link http://php.net/manual/en/function.httprequest-getputfile.php
     * @return string a string containing the path to the currently set put file.
     */
    public function getPutFile() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get query data
     *
     * @link http://php.net/manual/en/function.httprequest-getquerydata.php
     * @return string a string containing the urlencoded query.
     */
    public function getQueryData() { }

    /**
     * (PECL pecl_http 0.14.0-1.4.1)<br/>
     * Get raw post data
     *
     * @link http://php.net/manual/en/function.httprequest-getrawpostdata.php
     * @return string a string containing the currently set raw post data.
     */
    public function getRawPostData() { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Get raw request message
     *
     * @link http://php.net/manual/en/function.httprequest-getrawrequestmessage.php
     * @return string an HttpMessage in a form of a string.
     */
    public function getRawRequestMessage() { }

    /**
     * (PECL pecl_http &gt;= 0.21.0)<br/>
     * Get raw response message
     *
     * @link http://php.net/manual/en/function.httprequest-getrawresponsemessage.php
     * @return string the complete web server response, including the headers in a form of a string.
     */
    public function getRawResponseMessage() { }

    /**
     * (PECL pecl_http &gt;= 0.11.0)<br/>
     * Get request message
     *
     * @link http://php.net/manual/en/function.httprequest-getrequestmessage.php
     * @return HttpMessage an HttpMessage object representing the sent request.
     */
    public function getRequestMessage() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get response body
     *
     * @link http://php.net/manual/en/function.httprequest-getresponsebody.php
     * @return string a string containing the response body.
     */
    public function getResponseBody() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get response code
     *
     * @link http://php.net/manual/en/function.httprequest-getresponsecode.php
     * @return int an int representing the response code.
     */
    public function getResponseCode() { }

    /**
     * (PECL pecl_http &gt;= 0.23.0)<br/>
     * Get response cookie(s)
     *
     * @link http://php.net/manual/en/function.httprequest-getresponsecookies.php
     *
     * @param int   $flags          [optional] <p>
     *                              http_parse_cookie flags
     *                              </p>
     * @param array $allowed_extras [optional] <p>
     *                              allowed keys treated as extra information instead of cookie names
     *                              </p>
     *
     * @return stdClass[] an array of stdClass objects like http_parse_cookie would return.
     */
    public function getResponseCookies($flags = null, array $allowed_extras = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get response data
     *
     * @link http://php.net/manual/en/function.httprequest-getresponsedata.php
     * @return array an associative array with the key "headers" containing an associative
     * array holding all response headers, as well as the key "body" containing a
     * string with the response body.
     */
    public function getResponseData() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get response header(s)
     *
     * @link http://php.net/manual/en/function.httprequest-getresponseheader.php
     *
     * @param string $name [optional] <p>
     *                     header to read; if empty, all response headers will be returned
     *                     </p>
     *
     * @return mixed either a string with the value of the header matching name if requested,
     * FALSE on failure, or an associative array containing all response headers.
     */
    public function getResponseHeader($name = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get response info
     *
     * @link http://php.net/manual/en/function.httprequest-getresponseinfo.php
     *
     * @param string $name [optional] <p>
     *                     the info to read; if empty or omitted, an associative array containing
     *                     all available info will be returned
     *                     </p>
     *
     * @return mixed either a scalar containing the value of the info matching name if
     * requested, FALSE on failure, or an associative array containing all
     * available info.
     */
    public function getResponseInfo($name = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get response message
     *
     * @link http://php.net/manual/en/function.httprequest-getresponsemessage.php
     * @return HttpMessage an HttpMessage object of the response.
     */
    public function getResponseMessage() { }

    /**
     * (PECL pecl_http &gt;= 0.23.0)<br/>
     * Get response status
     *
     * @link http://php.net/manual/en/function.httprequest-getresponsestatus.php
     * @return string a string containing the response status text.
     */
    public function getResponseStatus() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get ssl options
     *
     * @link http://php.net/manual/en/function.httprequest-getssloptions.php
     * @return array an associative array containing any previously set SSL options.
     */
    public function getSslOptions() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get url
     *
     * @link http://php.net/manual/en/function.httprequest-geturl.php
     * @return string the currently set request url as string.
     */
    public function getUrl() { }

    /**
     * (PECL pecl_http &gt;= 1.0.0)<br/>
     * Reset cookies
     *
     * @link http://php.net/manual/en/function.httprequest-resetcookies.php
     *
     * @param bool $session_only [optional] <p>
     *                           whether only session cookies should be reset (needs libcurl >= v7.15.4, else libcurl
     *                           >= v7.14.1)
     *                           </p>
     *
     * @return bool true on success or false on failure.
     */
    public function resetCookies($session_only = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Send request
     *
     * @link http://php.net/manual/en/function.httprequest-send.php
     * @return HttpMessage the received response as HttpMessage object.
     */
    public function send() { }

    /**
     * @param $request_body_data [optional]
     */
    public function setBody($request_body_data) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set content type
     *
     * @link http://php.net/manual/en/function.httprequest-setcontenttype.php
     *
     * @param string $content_type <p>
     *                             the content type of the request (primary/secondary)
     *                             </p>
     *
     * @return bool TRUE on success, or FALSE if the content type does not seem to
     * contain a primary and a secondary part.
     */
    public function setContentType($content_type) { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Set cookies
     *
     * @link http://php.net/manual/en/function.httprequest-setcookies.php
     *
     * @param array $cookies [optional] <p>
     *                       an associative array as parameter containing cookie name/value pairs;
     *                       if empty or omitted, all previously set cookies will be unset
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setCookies(array $cookies = null) { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Set headers
     *
     * @link http://php.net/manual/en/function.httprequest-setheaders.php
     *
     * @param array $headers [optional] <p>
     *                       an associative array as parameter containing header name/value pairs;
     *                       if empty or omitted, all previously set headers will be unset
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setHeaders(array $headers = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set method
     *
     * @link http://php.net/manual/en/function.httprequest-setmethod.php
     *
     * @param int $request_method <p>
     *                            the request method to use
     *                            </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setMethod($request_method) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set options
     *
     * @link http://php.net/manual/en/function.httprequest-setoptions.php
     *
     * @param array $options [optional] <p>
     *                       an associative array, which values will overwrite the
     *                       currently set request options;
     *                       if empty or omitted, the options of the HttpRequest object will be reset
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setOptions(array $options = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set post fields
     *
     * @link http://php.net/manual/en/function.httprequest-setpostfields.php
     *
     * @param array $post_data <p>
     *                         an associative array containing the post fields;
     *                         if empty, the post data will be unset
     *                         </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setPostFields(array $post_data) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set post files
     *
     * @link http://php.net/manual/en/function.httprequest-setpostfiles.php
     *
     * @param array $post_files <p>
     *                          an array containing the files to post;
     *                          if empty, the post files will be unset
     *                          </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setPostFiles(array $post_files) { }

    /**
     * (PECL pecl_http &gt;= 0.25.0)<br/>
     * Set put data
     *
     * @link http://php.net/manual/en/function.httprequest-setputdata.php
     *
     * @param string $put_data [optional] <p>
     *                         the data to upload
     *                         </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setPutData($put_data = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set put file
     *
     * @link http://php.net/manual/en/function.httprequest-setputfile.php
     *
     * @param string $file [optional] <p>
     *                     the path to the file to send;
     *                     if empty or omitted the put file will be unset
     *                     </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setPutFile($file = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set query data
     *
     * @link http://php.net/manual/en/function.httprequest-setquerydata.php
     *
     * @param mixed $query_data <p>
     *                          a string or associative array parameter containing the pre-encoded
     *                          query string or to be encoded query fields;
     *                          if empty, the query data will be unset
     *                          </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setQueryData($query_data) { }

    /**
     * (PECL pecl_http 0.14.0-1.4.1)<br/>
     * Set raw post data
     *
     * @link http://php.net/manual/en/function.httprequest-setrawpostdata.php
     *
     * @param string $raw_post_data [optional] <p>
     *                              raw post data
     *                              </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setRawPostData($raw_post_data = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set ssl options
     *
     * @link http://php.net/manual/en/function.httprequest-setssloptions.php
     *
     * @param array $options [optional] <p>
     *                       an associative array containing any SSL specific options;
     *                       if empty or omitted, the SSL options will be reset
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setSslOptions(array $options = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set URL
     *
     * @link http://php.net/manual/en/function.httprequest-seturl.php
     *
     * @param string $url <p>
     *                    the request url
     *                    </p>
     *
     * @return bool true on success or false on failure.
     */
    public function setUrl($url) { }
}

/**
 * Class HttpRequestDataShare
 */
class HttpRequestDataShare implements Countable
{
    public $connect;
    public $cookie;
    public $dns;
    public $ssl;

    /**
     * @param $global     [optional]
     * @param $class_name [optional]
     */
    public static function factory($global, $class_name) { }

    /**
     * @param $global [optional]
     */
    public static function singleton($global) { }

    public function __destruct() { }

    /**
     * @param HttpRequest $request
     */
    public function attach(HttpRequest $request) { }

    public function count() { }

    /**
     * @param HttpRequest $request
     */
    public function detach(HttpRequest $request) { }

    public function reset() { }
}

/**
 * Class HttpRequestException
 */
class HttpRequestException extends HttpException
{
}

/**
 * Class HttpRequestMethodException
 */
class HttpRequestMethodException extends HttpException
{
}

/**
 * @link http://php.net/manual/en/class.httprequestpool.php
 */
class HttpRequestPool implements Countable, Iterator, Traversable
{
    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * HttpRequestPool constructor
     *
     * @link http://php.net/manual/en/function.httprequestpool-construct.php
     *
     * @param HttpRequest $request [optional] <p>
     *                             HttpRequest object to attach
     *                             </p>
     */
    public function __construct(HttpRequest $request = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * HttpRequestPool destructor
     *
     * @link http://php.net/manual/en/function.httprequestpool-destruct.php
     * @return void
     */
    public function __destruct() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Attach HttpRequest
     *
     * @link http://php.net/manual/en/function.httprequestpool-attach.php
     *
     * @param HttpRequest $request <p>
     *                             an HttpRequest object not already attached to any HttpRequestPool object
     *                             </p>
     *
     * @return bool true on success or false on failure.
     */
    public function attach(HttpRequest $request) { }

    public function count() { }

    public function current() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Detach HttpRequest
     *
     * @link http://php.net/manual/en/function.httprequestpool-detach.php
     *
     * @param HttpRequest $request <p>
     *                             an HttpRequest object attached to this HttpRequestPool object
     *                             </p>
     *
     * @return bool true on success or false on failure.
     */
    public function detach(HttpRequest $request) { }

    /**
     * @param $enable [optional]
     */
    public function enableEvents($enable) { }

    /**
     * @param $enable [optional]
     */
    public function enablePipelining($enable) { }

    /**
     * (PECL pecl_http &gt;= 0.16.0)<br/>
     * Get attached requests
     *
     * @link http://php.net/manual/en/function.httprequestpool-getattachedrequests.php
     * @return array an array containing all currently attached HttpRequest objects.
     */
    public function getAttachedRequests() { }

    /**
     * (PECL pecl_http &gt;= 0.16.0)<br/>
     * Get finished requests
     *
     * @link http://php.net/manual/en/function.httprequestpool-getfinishedrequests.php
     * @return array an array containing all attached HttpRequest objects that already have finished their work.
     */
    public function getFinishedRequests() { }

    public function key() { }

    public function next() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Reset request pool
     *
     * @link http://php.net/manual/en/function.httprequestpool-reset.php
     * @return void
     */
    public function reset() { }

    public function rewind() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Send all requests
     *
     * @link http://php.net/manual/en/function.httprequestpool-send.php
     * @return bool true on success or false on failure.
     */
    public function send() { }

    public function valid() { }

    /**
     * (PECL pecl_http &gt;= 0.15.0)<br/>
     * Perform socket actions
     *
     * @link http://php.net/manual/en/function.httprequestpool-socketperform.php
     * @return bool TRUE until each request has finished its transaction.
     */
    protected function socketPerform() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Perform socket select
     *
     * @link http://php.net/manual/en/function.httprequestpool-socketselect.php
     * @return bool true on success or false on failure.
     */
    protected function socketSelect() { }
}

/**
 * Class HttpRequestPoolException
 */
class HttpRequestPoolException extends HttpException
{
}

/**
 * @link http://php.net/manual/en/class.httpresponse.php
 */
class HttpResponse
{
    const REDIRECT = 0;
    const REDIRECT_FOUND = 302;
    const REDIRECT_PERM = 301;
    const REDIRECT_POST = 303;
    const REDIRECT_PROXY = 305;
    const REDIRECT_TEMP = 307;
    protected static $bufferSize;
    protected static $cache;
    protected static $cacheControl;
    protected static $contentDisposition;
    protected static $contentType;
    protected static $eTag;
    protected static $gzip;
    protected static $lastModified;
    protected static $throttleDelay;

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Capture script output
     *
     * @link http://php.net/manual/en/function.httpresponse-capture.php
     * @return void
     */
    public static function capture() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get buffer size
     *
     * @link http://php.net/manual/en/function.httpresponse-getbuffersize.php
     * @return int an int representing the current buffer size in bytes.
     */
    public static function getBufferSize() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set buffer size
     *
     * @link http://php.net/manual/en/function.httpresponse-setbuffersize.php
     *
     * @param int $bytes <p>
     *                   the chunk size in bytes
     *                   </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setBufferSize($bytes) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get cache
     *
     * @link http://php.net/manual/en/function.httpresponse-getcache.php
     * @return bool true if caching should be attempted, else false.
     */
    public static function getCache() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set cache
     *
     * @link http://php.net/manual/en/function.httpresponse-setcache.php
     *
     * @param bool $cache <p>
     *                    whether caching should be attempted
     *                    </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setCache($cache) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get cache control
     *
     * @link http://php.net/manual/en/function.httpresponse-getcachecontrol.php
     * @return string the current cache control setting as a string like sent in a header.
     */
    public static function getCacheControl() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set cache control
     *
     * @link http://php.net/manual/en/function.httpresponse-setcachecontrol.php
     *
     * @param string $control         <p>
     *                                the primary cache control setting
     *                                </p>
     * @param int    $max_age         [optional] <p>
     *                                the max-age in seconds, suggesting how long the cache entry is valid on the
     *                                client side
     *                                </p>
     * @param bool   $must_revalidate [optional] <p>
     *                                whether the cached entity should be revalidated by the client for every request
     *                                </p>
     *
     * @return bool true on success, or false if control does not match one of public, private or no-cache.
     */
    public static function setCacheControl($control, $max_age = null, $must_revalidate = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get content disposition
     *
     * @link http://php.net/manual/en/function.httpresponse-getcontentdisposition.php
     * @return string the current content disposition as string like sent in a header.
     */
    public static function getContentDisposition() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set content disposition
     *
     * @link http://php.net/manual/en/function.httpresponse-setcontentdisposition.php
     *
     * @param string $filename <p>
     *                         the file name the &quot;Save as...&quot; dialog should display
     *                         </p>
     * @param bool   $inline   [optional] <p>
     *                         if set to true and the user agent knows how to handle the content type,
     *                         it will probably not cause the popup window to be shown
     *                         </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setContentDisposition($filename, $inline = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get content type
     *
     * @link http://php.net/manual/en/function.httpresponse-getcontenttype.php
     * @return string the currently set content type as string.
     */
    public static function getContentType() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set content type
     *
     * @link http://php.net/manual/en/function.httpresponse-setcontenttype.php
     *
     * @param string $content_type <p>
     *                             the content type of the sent entity (primary/secondary)
     *                             </p>
     *
     * @return bool true on success, or false if the content type does not seem to
     * contain a primary and secondary content type part.
     */
    public static function setContentType($content_type) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get data
     *
     * @link http://php.net/manual/en/function.httpresponse-getdata.php
     * @return string a string containing the previously set data to send.
     */
    public static function getData() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get ETag
     *
     * @link http://php.net/manual/en/function.httpresponse-getetag.php
     * @return string the calculated or previously set ETag as unquoted string.
     */
    public static function getETag() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set ETag
     *
     * @link http://php.net/manual/en/function.httpresponse-setetag.php
     *
     * @param string $etag <p>
     *                     unquoted string as parameter containing the ETag
     *                     </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setETag($etag) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get file
     *
     * @link http://php.net/manual/en/function.httpresponse-getfile.php
     * @return string the previously set path to the file to send as string.
     */
    public static function getFile() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get gzip
     *
     * @link http://php.net/manual/en/function.httpresponse-getgzip.php
     * @return bool true if GZip compression is enabled, else false.
     */
    public static function getGzip() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set gzip
     *
     * @link http://php.net/manual/en/function.httpresponse-setgzip.php
     *
     * @param bool $gzip <p>
     *                   whether GZip compression should be enabled
     *                   </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setGzip($gzip) { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Get header
     *
     * @link http://php.net/manual/en/function.httpresponse-getheader.php
     *
     * @param string $name [optional] <p>
     *                     specifies the name of the header to read;
     *                     if empty or omitted, an associative array with all headers will be returned
     *                     </p>
     *
     * @return mixed either a string containing the value of the header matching name,
     * false on failure, or an associative array with all headers.
     */
    public static function getHeader($name = null) { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Get last modified
     *
     * @link http://php.net/manual/en/function.httpresponse-getlastmodified.php
     * @return int the calculated or previously set Unix timestamp.
     */
    public static function getLastModified() { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Set last modified
     *
     * @link http://php.net/manual/en/function.httpresponse-setlastmodified.php
     *
     * @param int $timestamp <p>
     *                       Unix timestamp representing the last modification time of the sent entity
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setLastModified($timestamp) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get request body
     *
     * @link http://php.net/manual/en/function.httpresponse-getrequestbody.php
     * @return string
     */
    public static function getRequestBody() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get request body stream
     *
     * @link http://php.net/manual/en/function.httpresponse-getrequestbodystream.php
     * @return resource
     */
    public static function getRequestBodyStream() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get request headers
     *
     * @link http://php.net/manual/en/function.httpresponse-getrequestheaders.php
     * @return array
     */
    public static function getRequestHeaders() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get Stream
     *
     * @link http://php.net/manual/en/function.httpresponse-getstream.php
     * @return resource the previously set resource.
     */
    public static function getStream() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Get throttle delay
     *
     * @link http://php.net/manual/en/function.httpresponse-getthrottledelay.php
     * @return double a double representing the throttle delay in seconds.
     */
    public static function getThrottleDelay() { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set throttle delay
     *
     * @link http://php.net/manual/en/function.httpresponse-setthrottledelay.php
     *
     * @param float $seconds <p>
     *                       seconds to sleep after each chunk sent
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setThrottleDelay($seconds) { }

    /**
     * (PECL pecl_http &gt;= 0.13.0)<br/>
     * Guess content type
     *
     * @link http://php.net/manual/en/function.httpresponse-guesscontenttype.php
     *
     * @param string $magic_file <p>
     *                           specifies the magic.mime database to use
     *                           </p>
     * @param int    $magic_mode [optional] <p>
     *                           flags for libmagic
     *                           </p>
     *
     * @return string the guessed content type on success or false on failure.
     */
    public static function guessContentType($magic_file, $magic_mode = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Redirect
     *
     * @link http://php.net/manual/en/function.httpresponse-redirect.php
     *
     * @param string $url     [optional]
     * @param array  $params  [optional]
     * @param bool   $session [optional]
     * @param int    $status  [optional]
     *
     * @return void
     */
    public static function redirect($url = null, array $params = null, $session = null, $status = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Send response
     *
     * @link http://php.net/manual/en/function.httpresponse-send.php
     *
     * @param bool $clean_ob [optional] <p>
     *                       whether to destroy all previously started output handlers and their buffers
     *                       </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function send($clean_ob = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set data
     *
     * @link http://php.net/manual/en/function.httpresponse-setdata.php
     *
     * @param mixed $data <p>
     *                    data to send
     *                    </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setData($data) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set file
     *
     * @link http://php.net/manual/en/function.httpresponse-setfile.php
     *
     * @param string $file <p>
     *                     the path to the file to send
     *                     </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setFile($file) { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Set header
     *
     * @link http://php.net/manual/en/function.httpresponse-setheader.php
     *
     * @param string $name    <p>
     *                        the name of the header
     *                        </p>
     * @param mixed  $value   [optional] <p>
     *                        the value of the header;
     *                        if not set, no header with this name will be sent
     *                        </p>
     * @param bool   $replace [optional] <p>
     *                        whether an existing header should be replaced
     *                        </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setHeader($name, $value = null, $replace = null) { }

    /**
     * (PECL pecl_http &gt;= 0.10.0)<br/>
     * Set stream
     *
     * @link http://php.net/manual/en/function.httpresponse-setstream.php
     *
     * @param resource $stream <p>
     *                         already opened stream from which the data to send will be read
     *                         </p>
     *
     * @return bool true on success or false on failure.
     */
    public static function setStream($stream) { }

    /**
     * (PECL pecl_http &gt;= 0.12.0)<br/>
     * Send HTTP response status
     *
     * @link http://php.net/manual/en/function.httpresponse-status.php
     *
     * @param int $status
     *
     * @return bool
     */
    public static function status($status) { }
}

/**
 * Class HttpResponseException
 */
class HttpResponseException extends HttpException
{
}

/**
 * Class HttpRuntimeException
 */
class HttpRuntimeException extends HttpException
{
}

/**
 * Class HttpSocketException
 */
class HttpSocketException extends HttpException
{
}

/**
 * Class HttpUrlException
 */
class HttpUrlException extends HttpException
{
}

/**
 * Class HttpUtil
 */
class HttpUtil
{
    /**
     * @param $cookie_array
     */
    public static function buildCookie($cookie_array) { }

    /**
     * @param $query
     * @param $prefix  [optional]
     * @param $arg_sep [optional]
     */
    public static function buildStr($query, $prefix, $arg_sep) { }

    /**
     * @param $url
     * @param $parts    [optional]
     * @param $flags    [optional]
     * @param $composed [optional]
     */
    public static function buildUrl($url, $parts, $flags, &$composed) { }

    /**
     * @param $encoded_string
     */
    public static function chunkedDecode($encoded_string) { }

    /**
     * @param $timestamp [optional]
     */
    public static function date($timestamp) { }

    /**
     * @param $plain
     * @param $flags [optional]
     */
    public static function deflate($plain, $flags) { }

    /**
     * @param $encoded
     */
    public static function inflate($encoded) { }

    /**
     * @param $plain_etag
     * @param $for_range [optional]
     */
    public static function matchEtag($plain_etag, $for_range) { }

    /**
     * @param $last_modified
     * @param $for_range [optional]
     */
    public static function matchModified($last_modified, $for_range) { }

    /**
     * @param $header_name
     * @param $header_value
     * @param $case_sensitive [optional]
     */
    public static function matchRequestHeader($header_name, $header_value, $case_sensitive) { }

    /**
     * @param $supported
     * @param $result [optional]
     */
    public static function negotiateCharset($supported, &$result) { }

    /**
     * @param $supported
     * @param $result [optional]
     */
    public static function negotiateContentType($supported, &$result) { }

    /**
     * @param $supported
     * @param $result [optional]
     */
    public static function negotiateLanguage($supported, &$result) { }

    /**
     * @param $cookie_string
     */
    public static function parseCookie($cookie_string) { }

    /**
     * @param $headers_string
     */
    public static function parseHeaders($headers_string) { }

    /**
     * @param $message_string
     */
    public static function parseMessage($message_string) { }

    /**
     * @param $param_string
     * @param $flags [optional]
     */
    public static function parseParams($param_string, $flags) { }

    /**
     * @param $feature [optional]
     */
    public static function support($feature) { }
}
