<?php
/**
 * PHPStorm stub file for HTTP functions.
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
 * (PECL pecl_http &gt;= 1.2.0)<br/>
 * Build cookie string
 *
 * @link http://php.net/manual/en/function.http-build-cookie.php
 *
 * @param array $cookie <p>
 *                      a cookie list like returned from http_parse_cookie
 *                      </p>
 *
 * @return string the cookie(s) as string.
 */
function http_build_cookie(array $cookie) { }

/**
 * (PECL pecl_http &gt;= 0.23.0)<br/>
 * Build query string
 *
 * @link http://php.net/manual/en/function.http-build-str.php
 *
 * @param array  $query         <p>
 *                              associative array of query string parameters
 *                              </p>
 * @param string $prefix        [optional] <p>
 *                              top level prefix
 *                              </p>
 * @param string $arg_separator [optional] <p>
 *                              argument separator to use (by default the INI setting arg_separator.output will be
 *                              used, or &quot;&amp;&quot; if neither is set
 *                              </p>
 *
 * @return string the built query as string on success or false on failure.
 */
function http_build_str(array $query, $prefix = null, $arg_separator = null) { }

/**
 * (PECL pecl_http &gt;= 0.21.0)<br/>
 * Build an URL
 *
 * @link http://php.net/manual/en/function.http-build-url.php
 *
 * @param mixed $url     [optional] <p>
 *                       (part(s) of) an URL in form of a string or associative array like parse_url returns
 *                       </p>
 * @param mixed $parts   [optional] <p>
 *                       same as the first argument
 *                       </p>
 * @param int   $flags   [optional] <p>
 *                       a bitmask of binary or'ed HTTP_URL constants;
 *                       HTTP_URL_REPLACE is the default
 *                       </p>
 * @param array $new_url [optional] <p>
 *                       if set, it will be filled with the parts of the composed url like parse_url would return
 *                       </p>
 *
 * @return string the new URL as string on success or false on failure.
 */
function http_build_url($url = null, $parts = null, $flags = null, array &$new_url = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Caching by ETag
 *
 * @link http://php.net/manual/en/function.http-cache-etag.php
 *
 * @param string $etag [optional] <p>
 *                     custom ETag
 *                     </p>
 *
 * @return bool &returns.http.false.orexits; with 304 Not Modified if the entity is cached.
 * &see.http.configuration.force_exit;
 */
function http_cache_etag($etag = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Caching by last modification
 *
 * @link http://php.net/manual/en/function.http-cache-last-modified.php
 *
 * @param int $timestamp_or_expires [optional] <p>
 *                                  Unix timestamp
 *                                  </p>
 *
 * @return bool &returns.http.false.orexits; with 304 Not Modified if the entity is cached.
 * &see.http.configuration.force_exit;
 */
function http_cache_last_modified($timestamp_or_expires = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Decode chunked-encoded data
 *
 * @link http://php.net/manual/en/function.http-chunked-decode.php
 *
 * @param string $encoded <p>
 *                        chunked encoded string
 *                        </p>
 *
 * @return string the decoded string on success or false on failure.
 */
function http_chunked_decode($encoded) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Compose HTTP RFC compliant date
 *
 * @link http://php.net/manual/en/function.http-date.php
 *
 * @param int $timestamp [optional] <p>
 *                       Unix timestamp; current time if omitted
 *                       </p>
 *
 * @return string the HTTP date as string.
 */
function http_date($timestamp = null) { }

/**
 * (PECL pecl_http &gt;= 0.15.0)<br/>
 * Deflate data
 *
 * @link http://php.net/manual/en/function.http-deflate.php
 *
 * @param string $data  <p>
 *                      String containing the data that should be encoded
 *                      </p>
 * @param int    $flags [optional] <p>
 *                      deflate options
 *                      </p>
 *
 * @return string the encoded string on success, or NULL on failure.
 */
function http_deflate($data, $flags = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Perform GET request
 *
 * @link http://php.net/manual/en/function.http-get.php
 *
 * @param string $url     <p>
 *                        URL
 *                        </p>
 * @param array  $options [optional] <p>
 *                        &link.http.request.options;
 *                        </p>
 * @param array  $info    [optional] <p>
 *                        Will be filled with request/response information
 *                        </p>
 *
 * @return string &returns.http.response;
 */
function http_get($url, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Get request body as string
 *
 * @link http://php.net/manual/en/function.http-get-request-body.php
 * @return string the raw request body as string on success or NULL on failure.
 */
function http_get_request_body() { }

/**
 * (PECL pecl_http &gt;= 0.22.0)<br/>
 * Get request body as stream
 *
 * @link http://php.net/manual/en/function.http-get-request-body-stream.php
 * @return resource the raw request body as stream on success or NULL on failure.
 */
function http_get_request_body_stream() { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Get request headers as array
 *
 * @link http://php.net/manual/en/function.http-get-request-headers.php
 * @return array an associative array of incoming request headers.
 */
function http_get_request_headers() { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Perform HEAD request
 *
 * @link http://php.net/manual/en/function.http-head.php
 *
 * @param string $url     [optional] <p>
 *                        URL
 *                        </p>
 * @param array  $options [optional] <p>
 *                        &link.http.request.options;
 *                        </p>
 * @param array  $info    [optional] <p>
 *                        &link.http.request.info;
 *                        </p>
 *
 * @return string &returns.http.response;
 */
function http_head($url = null, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 0.15.0)<br/>
 * Inflate data
 *
 * @link http://php.net/manual/en/function.http-inflate.php
 *
 * @param string $data <p>
 *                     string containing the compressed data
 *                     </p>
 *
 * @return string the decoded string on success, or NULL on failure.
 */
function http_inflate($data) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Match ETag
 *
 * @link http://php.net/manual/en/function.http-match-etag.php
 *
 * @param string $etag      <p>
 *                          the ETag to match
 *                          </p>
 * @param bool   $for_range [optional] <p>
 *                          if set to true, the header usually used to validate HTTP ranges will be checked
 *                          </p>
 *
 * @return bool true if ETag matches or the header contained the asterisk (&quot;*&quot;), else false.
 */
function http_match_etag($etag, $for_range = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Match last modification
 *
 * @link http://php.net/manual/en/function.http-match-modified.php
 *
 * @param int  $timestamp [optional] <p>
 *                        Unix timestamp; current time, if omitted
 *                        </p>
 * @param bool $for_range [optional] <p>
 *                        if set to true, the header usually used to validate HTTP ranges will be checked
 *                        </p>
 *
 * @return bool true if timestamp represents an earlier date than the header, else false.
 */
function http_match_modified($timestamp = null, $for_range = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Match any header
 *
 * @link http://php.net/manual/en/function.http-match-request-header.php
 *
 * @param string $header     <p>
 *                           the header name (case-insensitive)
 *                           </p>
 * @param string $value      <p>
 *                           the header value that should be compared
 *                           </p>
 * @param bool   $match_case [optional] <p>
 *                           whether the value should be compared case sensitively
 *                           </p>
 *
 * @return bool true if header value matches, else false.
 */
function http_match_request_header($header, $value, $match_case = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Negotiate clients preferred character set
 *
 * @link http://php.net/manual/en/function.http-negotiate-charset.php
 *
 * @param array $supported <p>
 *                         array containing the supported charsets as values
 *                         </p>
 * @param array $result    [optional] <p>
 *                         will be filled with an array containing the negotiation results
 *                         </p>
 *
 * @return string the negotiated charset or the default charset (i.e. first array entry) if none match.
 */
function http_negotiate_charset(array $supported, array &$result = null) { }

/**
 * (PECL pecl_http &gt;= 0.19.0)<br/>
 * Negotiate clients preferred content type
 *
 * @link http://php.net/manual/en/function.http-negotiate-content-type.php
 *
 * @param array $supported <p>
 *                         array containing the supported content types as values
 *                         </p>
 * @param array $result    [optional] <p>
 *                         will be filled with an array containing the negotiation results
 *                         </p>
 *
 * @return string the negotiated content type or the default content type (i.e. first array entry) if none match.
 */
function http_negotiate_content_type(array $supported, array &$result = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Negotiate clients preferred language
 *
 * @link http://php.net/manual/en/function.http-negotiate-language.php
 *
 * @param array $supported <p>
 *                         array containing the supported languages as values
 *                         </p>
 * @param array $result    [optional] <p>
 *                         will be filled with an array containing the negotiation results
 *                         </p>
 *
 * @return string the negotiated language or the default language (i.e. first array entry) if none match.
 */
function http_negotiate_language(array $supported, array &$result = null) { }

/**
 * (PECL pecl_http &gt;= 0.20.0)<br/>
 * Parse HTTP cookie
 *
 * @link http://php.net/manual/en/function.http-parse-cookie.php
 *
 * @param string $cookie         <p>
 *                               string containing the value of a Set-Cookie response header
 *                               </p>
 * @param int    $flags          [optional] <p>
 *                               parse flags (HTTP_COOKIE_PARSE_RAW)
 *                               </p>
 * @param array  $allowed_extras [optional] <p>
 *                               array containing recognized extra keys;
 *                               by default all unknown keys will be treated as cookie names
 *                               </p>
 *
 * @return stdClass|object a stdClass object on success or false on failure.
 */
function http_parse_cookie($cookie, $flags = null, array $allowed_extras = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Parse HTTP headers
 *
 * @link http://php.net/manual/en/function.http-parse-headers.php
 *
 * @param string $header <p>
 *                       string containing HTTP headers
 *                       </p>
 *
 * @return array an array on success or false on failure.
 */
function http_parse_headers($header) { }

/**
 * (PECL pecl_http &gt;= 0.12.0)<br/>
 * Parse HTTP messages
 *
 * @link http://php.net/manual/en/function.http-parse-message.php
 *
 * @param string $message <p>
 *                        string containing a single HTTP message or several consecutive HTTP messages
 *                        </p>
 *
 * @return object a hierarchical object structure of the parsed messages.
 */
function http_parse_message($message) { }

/**
 * (PECL pecl_http &gt;= 1.0.0)<br/>
 * Parse parameter list
 *
 * @link http://php.net/manual/en/function.http-parse-params.php
 *
 * @param string $param <p>
 *                      Parameters
 *                      </p>
 * @param int    $flags [optional] <p>
 *                      Parse flags
 *                      </p>
 *
 * @return stdClass|object parameter list as stdClass object.
 */
function http_parse_params($param, $flags = null) { }

/**
 * (PECL pecl_http &gt;= 1.5.0)<br/>
 * Clean up persistent handles
 *
 * @link http://php.net/manual/en/function.http-persistent-handles-clean.php
 *
 * @param string $ident [optional]
 *
 * @return string
 */
function http_persistent_handles_clean($ident = null) { }

/**
 * (PECL pecl_http &gt;= 1.5.0)<br/>
 * Stat persistent handles
 *
 * @link http://php.net/manual/en/function.http-persistent-handles-count.php
 * @return stdClass|object persistent handles statistics as stdClass object on success or false on failure.
 */
function http_persistent_handles_count() { }

/**
 * (PECL pecl_http &gt;= 1.5.0)<br/>
 * Get/set ident of persistent handles
 *
 * @link http://php.net/manual/en/function.http-persistent-handles-ident.php
 *
 * @param string $ident <p>
 *                      the identification string
 *                      </p>
 *
 * @return string the prior ident as string on success or false on failure.
 */
function http_persistent_handles_ident($ident) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Perform POST request with pre-encoded data
 *
 * @link http://php.net/manual/en/function.http-post-data.php
 *
 * @param string $url     <p>
 *                        URL
 *                        </p>
 * @param string $data    [optional] <p>
 *                        String containing the pre-encoded post data
 *                        </p>
 * @param array  $options [optional] <p>
 *                        &link.http.request.options;
 *                        </p>
 * @param array  $info    [optional] <p>
 *                        &link.http.request.info;
 *                        </p>
 *
 * @return string &returns.http.response;
 */
function http_post_data($url, $data = null, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Perform POST request with data to be encoded
 *
 * @link http://php.net/manual/en/function.http-post-fields.php
 *
 * @param string $url     <p>
 *                        URL
 *                        </p>
 * @param array  $data    [optional] <p>
 *                        Associative array of POST values
 *                        </p>
 * @param array  $files   [optional] <p>
 *                        Array of files to post
 *                        </p>
 * @param array  $options [optional] <p>
 *                        &link.http.request.options;
 *                        </p>
 * @param array  $info    [optional] <p>
 *                        &link.http.request.info;
 *                        </p>
 *
 * @return string &returns.http.response;
 */
function http_post_fields($url, array $data = null, array $files = null, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 0.25.0)<br/>
 * Perform PUT request with data
 *
 * @link http://php.net/manual/en/function.http-put-data.php
 *
 * @param string $url     <p>
 *                        URL
 *                        </p>
 * @param string $data    [optional] <p>
 *                        PUT request body
 *                        </p>
 * @param array  $options [optional] <p>
 *                        &link.http.request.options;
 *                        </p>
 * @param array  $info    [optional] <p>
 *                        &link.http.request.info;
 *                        </p>
 *
 * @return string &returns.http.response;
 */
function http_put_data($url, $data = null, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Perform PUT request with file
 *
 * @link http://php.net/manual/en/function.http-put-file.php
 *
 * @param string $url     <p>
 *                        URL
 *                        </p>
 * @param string $file    [optional] <p>
 *                        The file to put
 *                        </p>
 * @param array  $options [optional] <p>
 *                        &link.http.request.options;
 *                        </p>
 * @param array  $info    [optional] <p>
 *                        &link.http.request.info;
 *                        </p>
 *
 * @return string &returns.http.response;
 */
function http_put_file($url, $file = null, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Perform PUT request with stream
 *
 * @link http://php.net/manual/en/function.http-put-stream.php
 *
 * @param string   $url     <p>
 *                          URL
 *                          </p>
 * @param resource $stream  [optional] <p>
 *                          The stream to read the PUT request body from
 *                          </p>
 * @param array    $options [optional] <p>
 *                          &link.http.request.options;
 *                          </p>
 * @param array    $info    [optional] <p>
 *                          &link.http.request.info;
 *                          </p>
 *
 * @return string &returns.http.response;
 */
function http_put_stream($url, $stream = null, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Issue HTTP redirect
 *
 * @link http://php.net/manual/en/function.http-redirect.php
 *
 * @param string $url     [optional] <p>
 *                        the URL to redirect to
 *                        </p>
 * @param array  $params  [optional] <p>
 *                        associative array of query parameters
 *                        </p>
 * @param bool   $session [optional] <p>
 *                        whether to append session information
 *                        </p>
 * @param int    $status  [optional] <p>
 *                        custom response status code
 *                        </p>
 *
 * @return void &returns.http.false.orexits; with the specified redirection status code.
 * &see.http.configuration.force_exit;
 */
function http_redirect($url = null, array $params = null, $session = null, $status = null) { }

/**
 * (PECL pecl_http &gt;= 1.0.0)<br/>
 * Perform custom request
 *
 * @link http://php.net/manual/en/function.http-request.php
 *
 * @param int    $method  <p>
 *                        Request method
 *                        </p>
 * @param string $url     [optional] <p>
 *                        URL
 *                        </p>
 * @param string $body    [optional] <p>
 *                        Request body
 *                        </p>
 * @param array  $options [optional] <p>
 *                        &link.http.request.options;
 *                        </p>
 * @param array  $info    [optional] <p>
 *                        &link.http.request.info;
 *                        </p>
 *
 * @return string &returns.http.response;
 */
function http_request($method, $url = null, $body = null, array $options = null, array &$info = null) { }

/**
 * (PECL pecl_http &gt;= 1.0.0)<br/>
 * Encode request body
 *
 * @link http://php.net/manual/en/function.http-request-body-encode.php
 *
 * @param array $fields <p>
 *                      POST fields
 *                      </p>
 * @param array $files  <p>
 *                      POST files
 *                      </p>
 *
 * @return string encoded string on success or false on failure.
 */
function http_request_body_encode(array $fields, array $files) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Check whether request method exists
 *
 * @link http://php.net/manual/en/function.http-request-method-exists.php
 *
 * @param mixed $method <p>
 *                      request method name or ID
 *                      </p>
 *
 * @return int true if the request method is known, else false.
 */
function http_request_method_exists($method) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Get request method name
 *
 * @link http://php.net/manual/en/function.http-request-method-name.php
 *
 * @param int $method <p>
 *                    request method ID
 *                    </p>
 *
 * @return string the request method name as string on success or false on failure.
 */
function http_request_method_name($method) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Register request method
 *
 * @link http://php.net/manual/en/function.http-request-method-register.php
 *
 * @param string $method <p>
 *                       the request method name to register
 *                       </p>
 *
 * @return int the ID of the request method on success or false on failure.
 */
function http_request_method_register($method) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Unregister request method
 *
 * @link http://php.net/manual/en/function.http-request-method-unregister.php
 *
 * @param mixed $method <p>
 *                      The request method name or ID
 *                      </p>
 *
 * @return bool true on success or false on failure.
 */
function http_request_method_unregister($method) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Send Content-Disposition
 *
 * @link http://php.net/manual/en/function.http-send-content-disposition.php
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
function http_send_content_disposition($filename, $inline = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * Send Content-Type
 *
 * @link http://php.net/manual/en/function.http-send-content-type.php
 *
 * @param string $content_type [optional] <p>
 *                             the desired content type (primary/secondary)
 *                             </p>
 *
 * @return bool true on success or false on failure.
 */
function http_send_content_type($content_type = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Send arbitrary data
 *
 * @link http://php.net/manual/en/function.http-send-data.php
 *
 * @param string $data <p>
 *                     data to send
 *                     </p>
 *
 * @return bool true on success or false on failure.
 */
function http_send_data($data) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Send file
 *
 * @link http://php.net/manual/en/function.http-send-file.php
 *
 * @param string $file <p>
 *                     the file to send
 *                     </p>
 *
 * @return bool true on success or false on failure.
 */
function http_send_file($file) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Send Last-Modified
 *
 * @link http://php.net/manual/en/function.http-send-last-modified.php
 *
 * @param int $timestamp [optional] <p>
 *                       a Unix timestamp, converted to a valid HTTP date;
 *                       if omitted, the current time will be sent
 *                       </p>
 *
 * @return bool true on success or false on failure.
 */
function http_send_last_modified($timestamp = null) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Send HTTP response status
 *
 * @link http://php.net/manual/en/function.http-send-status.php
 *
 * @param int $status <p>
 *                    HTTP status code (100-599)
 *                    </p>
 *
 * @return bool true on success or false on failure.
 */
function http_send_status($status) { }

/**
 * (PECL pecl_http &gt;= 0.1.0)<br/>
 * Send stream
 *
 * @link http://php.net/manual/en/function.http-send-stream.php
 *
 * @param resource $stream <p>
 *                         stream to read from (must be seekable)
 *                         </p>
 *
 * @return bool true on success or false on failure.
 */
function http_send_stream($stream) { }

/**
 * (PECL pecl_http &gt;= 0.15.0)<br/>
 * Check built-in HTTP support
 *
 * @link http://php.net/manual/en/function.http-support.php
 *
 * @param int $feature [optional] <p>
 *                     feature to probe for
 *                     </p>
 *
 * @return int integer, whether requested feature is supported,
 * or a bitmask with all supported features if feature was omitted.
 */
function http_support($feature = null) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * HTTP throttling
 *
 * @link http://php.net/manual/en/function.http-throttle.php
 *
 * @param float $sec   [optional] <p>
 *                     seconds to sleep after each chunk sent
 *                     </p>
 * @param int   $bytes [optional] <p>
 *                     the chunk size in bytes
 *                     </p>
 *
 * @return void
 */
function http_throttle($sec = null, $bytes = null) { }

/**
 * (PECL pecl_http &gt;= 0.21.0)<br/>
 * Deflate output handler
 *
 * @link http://php.net/manual/en/function.ob-deflatehandler.php
 *
 * @param string $data
 * @param int    $mode
 *
 * @return string
 */
function ob_deflatehandler($data, $mode) { }

/**
 * (PECL pecl_http &gt;= 0.10.0)<br/>
 * ETag output handler
 *
 * @link http://php.net/manual/en/function.ob-etaghandler.php
 *
 * @param string $data
 * @param int    $mode
 *
 * @return string
 */
function ob_etaghandler($data, $mode) { }

/**
 * (PECL pecl_http &gt;= 0.21.0)<br/>
 * Inflate output handler
 *
 * @link http://php.net/manual/en/function.ob-inflatehandler.php
 *
 * @param string $data
 * @param int    $mode
 *
 * @return string
 */
function ob_inflatehandler($data, $mode) { }
