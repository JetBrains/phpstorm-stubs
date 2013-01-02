<?php

// Start of curl v.

/**
 * (PHP 4 &gt;= 4.0.2, PHP 5)<br/>
 * Initialize a cURL session
 * @link http://php.net/manual/en/function.curl-init.php
 * @param string $url [optional] <p>
 * If provided, the CURLOPT_URL option will be set
 * to its value. You can manually set this using the 
 * curl_setopt function.
 * </p>
 * @return resource a cURL handle on success, false on errors.
 */
function curl_init ($url = null) {}

/**
 * (PHP 5)<br/>
 * Copy a cURL handle along with all of its preferences
 * @link http://php.net/manual/en/function.curl-copy-handle.php
 * @param resource $ch 
 * @return resource a new cURL handle.
 */
function curl_copy_handle ($ch) {}

/**
 * (PHP 4 &gt;= 4.0.2, PHP 5)<br/>
 * Gets cURL version information
 * @link http://php.net/manual/en/function.curl-version.php
 * @param int $age [optional] <p>
 * </p>
 * @return array an associative array with the following elements: 
 * <tr valign="top">
 * <td>Indice</td>
 * <td>Value description</td>
 * </tr>
 * <tr valign="top">
 * <td>version_number</td>
 * <td>cURL 24 bit version number</td>
 * </tr>
 * <tr valign="top">
 * <td>version</td>
 * <td>cURL version number, as a string</td>
 * </tr>
 * <tr valign="top">
 * <td>ssl_version_number</td>
 * <td>OpenSSL 24 bit version number</td>
 * </tr>
 * <tr valign="top">
 * <td>ssl_version</td>
 * <td>OpenSSL version number, as a string</td>
 * </tr>
 * <tr valign="top">
 * <td>libz_version</td>
 * <td>zlib version number, as a string</td>
 * </tr>
 * <tr valign="top">
 * <td>host</td>
 * <td>Information about the host where cURL was built</td>
 * </tr>
 * <tr valign="top">
 * <td>age</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td>features</td>
 * <td>A bitmask of the CURL_VERSION_XXX constants</td>
 * </tr>
 * <tr valign="top">
 * <td>protocols</td>
 * <td>An array of protocols names supported by cURL</td>
 * </tr>
 */
function curl_version ($age = null) {}

/**
 * (PHP 4 &gt;= 4.0.2, PHP 5)<br/>
 * Set an option for a cURL transfer
 * @link http://php.net/manual/en/function.curl-setopt.php
 * @param resource $ch 
 * @param int $option <p>
 * The CURLOPT_XXX option to set.
 * </p>
 * @param mixed $value <p>
 * The value to be set on option.
 * </p>
 * <p>
 * value should be a bool for the
 * following values of the option parameter:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Set value to</td>
 * <td>Notes</td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_AUTOREFERER</td>
 * <td>
 * true to automatically set the Referer: field in
 * requests where it follows a Location: redirect.
 * </td>
 * <td>
 * Available since PHP 5.1.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_BINARYTRANSFER</td>
 * <td>
 * true to return the raw output when
 * CURLOPT_RETURNTRANSFER is used.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_COOKIESESSION</td>
 * <td>
 * true to mark this as a new cookie "session". It will force libcurl
 * to ignore all cookies it is about to load that are "session cookies"
 * from the previous session. By default, libcurl always stores and
 * loads all cookies, independent if they are session cookies or not.
 * Session cookies are cookies without expiry date and they are meant
 * to be alive and existing for this "session" only.
 * </td>
 * <td>
 * Available since PHP 5.1.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_CRLF</td>
 * <td>
 * true to convert Unix newlines to CRLF newlines
 * on transfers.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_DNS_USE_GLOBAL_CACHE</td>
 * <td>
 * true to use a global DNS cache. This option is
 * not thread-safe and is enabled by default.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FAILONERROR</td>
 * <td>
 * true to fail silently if the HTTP code returned
 * is greater than or equal to 400. The default behavior is to return
 * the page normally, ignoring the code.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FILETIME</td>
 * <td>
 * true to attempt to retrieve the modification
 * date of the remote document. This value can be retrieved using
 * the CURLINFO_FILETIME option with
 * curl_getinfo.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FOLLOWLOCATION</td>
 * <td>
 * true to follow any
 * "Location: " header that the server sends as
 * part of the HTTP header (note this is recursive, PHP will follow as
 * many "Location: " headers that it is sent,
 * unless CURLOPT_MAXREDIRS is set).
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FORBID_REUSE</td>
 * <td>
 * true to force the connection to explicitly
 * close when it has finished processing, and not be pooled for reuse.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FRESH_CONNECT</td>
 * <td>
 * true to force the use of a new connection
 * instead of a cached one.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FTP_USE_EPRT</td>
 * <td>
 * true to use EPRT (and LPRT) when doing active
 * FTP downloads. Use false to disable EPRT and LPRT and use PORT
 * only.
 * </td>
 * <td>
 * Added in PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FTP_USE_EPSV</td>
 * <td>
 * true to first try an EPSV command for FTP
 * transfers before reverting back to PASV. Set to false
 * to disable EPSV.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FTPAPPEND</td>
 * <td>
 * true to append to the remote file instead of
 * overwriting it.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FTPASCII</td>
 * <td>
 * An alias of
 * CURLOPT_TRANSFERTEXT. Use that instead.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FTPLISTONLY</td>
 * <td>
 * true to only list the names of an FTP
 * directory.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HEADER</td>
 * <td>
 * true to include the header in the output.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HTTPGET</td>
 * <td>
 * true to reset the HTTP request method to GET.
 * Since GET is the default, this is only necessary if the request
 * method has been changed.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HTTPPROXYTUNNEL</td>
 * <td>
 * true to tunnel through a given HTTP proxy.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_MUTE</td>
 * <td>
 * true to be completely silent with regards to
 * the cURL functions.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_NETRC</td>
 * <td>
 * true to scan the ~/.netrc
 * file to find a username and password for the remote site that
 * a connection is being established with.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_NOBODY</td>
 * <td>
 * true to exclude the body from the output.
 * Request method is then set to HEAD. Changing this to false does
 * not change it to GET.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_NOPROGRESS</td>
 * <td><p>
 * true to disable the progress meter for cURL transfers.
 * <p>
 * PHP automatically sets this option to true, this should only be
 * changed for debugging purposes.
 * </p>
 * </p></td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_NOSIGNAL</td>
 * <td>
 * true to ignore any cURL function that causes a
 * signal to be sent to the PHP process. This is turned on by default
 * in multi-threaded SAPIs so timeout options can still be used.
 * </td>
 * <td>
 * Added in cURL 7.10 and PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_POST</td>
 * <td>
 * true to do a regular HTTP POST. This POST is the
 * normal application/x-www-form-urlencoded kind,
 * most commonly used by HTML forms.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PUT</td>
 * <td>
 * true to HTTP PUT a file. The file to PUT must
 * be set with CURLOPT_INFILE and
 * CURLOPT_INFILESIZE.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_RETURNTRANSFER</td>
 * <td>
 * true to return the transfer as a string of the
 * return value of curl_exec instead of outputting
 * it out directly.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSL_VERIFYPEER</td>
 * <td>
 * false to stop cURL from verifying the peer's
 * certificate. Alternate certificates to verify against can be
 * specified with the CURLOPT_CAINFO option
 * or a certificate directory can be specified with the
 * CURLOPT_CAPATH option.
 * CURLOPT_SSL_VERIFYHOST may also need to be
 * true or false if
 * CURLOPT_SSL_VERIFYPEER is disabled (it
 * defaults to 2).
 * </td>
 * <td>
 * true by default as of cURL 7.10. Default bundle installed as of
 * cURL 7.10.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_TRANSFERTEXT</td>
 * <td>
 * true to use ASCII mode for FTP transfers.
 * For LDAP, it retrieves data in plain text instead of HTML. On
 * Windows systems, it will not set STDOUT to binary
 * mode.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_UNRESTRICTED_AUTH</td>
 * <td>
 * true to keep sending the username and password
 * when following locations (using
 * CURLOPT_FOLLOWLOCATION), even when the
 * hostname has changed.
 * </td>
 * <td>
 * Added in PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_UPLOAD</td>
 * <td>
 * true to prepare for an upload.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_VERBOSE</td>
 * <td>
 * true to output verbose information. Writes
 * output to STDERR, or the file specified using
 * CURLOPT_STDERR.
 * </td>
 * <td>
 * </td>
 * </tr>
 * </p>
 * <p>
 * value should be an integer for the
 * following values of the option parameter:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Set value to</td>
 * <td>Notes</td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_BUFFERSIZE</td>
 * <td>
 * The size of the buffer to use for each read. There is no guarantee
 * this request will be fulfilled, however.
 * </td>
 * <td>
 * Added in cURL 7.10 and PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_CLOSEPOLICY</td>
 * <td>
 * Either
 * CURLCLOSEPOLICY_LEAST_RECENTLY_USED or
 * CURLCLOSEPOLICY_OLDEST.
 * There are three other CURLCLOSEPOLICY_
 * constants, but cURL does not support them yet.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_CONNECTTIMEOUT</td>
 * <td>
 * The number of seconds to wait while trying to connect. Use 0 to
 * wait indefinitely.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_CONNECTTIMEOUT_MS</td>
 * <td>
 * The number of milliseconds to wait while trying to connect. Use 0 to
 * wait indefinitely.
 * </td>
 * <td>
 * Added in cURL 7.16.2. Available since PHP 5.2.3.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_DNS_CACHE_TIMEOUT</td>
 * <td>
 * The number of seconds to keep DNS entries in memory. This
 * option is set to 120 (2 minutes) by default.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FTPSSLAUTH</td>
 * <td>
 * The FTP authentication method (when is activated):
 * CURLFTPAUTH_SSL (try SSL first),
 * CURLFTPAUTH_TLS (try TLS first), or
 * CURLFTPAUTH_DEFAULT (let cURL decide).
 * </td>
 * <td>
 * Added in cURL 7.12.2 and PHP 5.1.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HTTP_VERSION</td>
 * <td>
 * CURL_HTTP_VERSION_NONE (default, lets CURL
 * decide which version to use),
 * CURL_HTTP_VERSION_1_0 (forces HTTP/1.0),
 * or CURL_HTTP_VERSION_1_1 (forces HTTP/1.1).
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HTTPAUTH</td>
 * <td>
 * <p>
 * The HTTP authentication method(s) to use. The options are:
 * CURLAUTH_BASIC,
 * CURLAUTH_DIGEST,
 * CURLAUTH_GSSNEGOTIATE,
 * CURLAUTH_NTLM,
 * CURLAUTH_ANY, and
 * CURLAUTH_ANYSAFE.
 * </p>
 * <p>
 * The bitwise | (or) operator can be used to combine
 * more than one method. If this is done, cURL will poll the server to see
 * what methods it supports and pick the best one.
 * </p>
 * <p>
 * CURLAUTH_ANY is an alias for
 * CURLAUTH_BASIC | CURLAUTH_DIGEST | CURLAUTH_GSSNEGOTIATE | CURLAUTH_NTLM.
 * </p>
 * <p>
 * CURLAUTH_ANYSAFE is an alias for
 * CURLAUTH_DIGEST | CURLAUTH_GSSNEGOTIATE | CURLAUTH_NTLM.
 * </p>
 * </td>
 * <td>
 * Added in PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_INFILESIZE</td>
 * <td>
 * The expected size, in bytes, of the file when uploading a file to a
 * remote site.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_LOW_SPEED_LIMIT</td>
 * <td>
 * The transfer speed, in bytes per second, that the transfer should be
 * below during CURLOPT_LOW_SPEED_TIME seconds
 * for PHP to consider the transfer too slow and abort.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_LOW_SPEED_TIME</td>
 * <td>
 * The number of seconds the transfer should be below
 * CURLOPT_LOW_SPEED_LIMIT for PHP to consider
 * the transfer too slow and abort.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_MAXCONNECTS</td>
 * <td>
 * The maximum amount of persistent connections that are allowed.
 * When the limit is reached,
 * CURLOPT_CLOSEPOLICY is used to determine
 * which connection to close.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_MAXREDIRS</td>
 * <td>
 * The maximum amount of HTTP redirections to follow. Use this option
 * alongside CURLOPT_FOLLOWLOCATION.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PORT</td>
 * <td>
 * An alternative port number to connect to.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PROTOCOLS</td>
 * <td>
 * <p>
 * Bitmask of CURLPROTO_* values. If used, this bitmask 
 * limits what protocols libcurl may use in the transfer. This allows you to have
 * a libcurl built to support a wide range of protocols but still limit specific
 * transfers to only be allowed to use a subset of them. By default libcurl will
 * accept all protocols it supports. 
 * See also CURLOPT_REDIR_PROTOCOLS.
 * </p>
 * <p>
 * Valid protocol options are: 
 * CURLPROTO_HTTP,
 * CURLPROTO_HTTPS,
 * CURLPROTO_FTP,
 * CURLPROTO_FTPS,
 * CURLPROTO_SCP,
 * CURLPROTO_SFTP,
 * CURLPROTO_TELNET,
 * CURLPROTO_LDAP,
 * CURLPROTO_LDAPS,
 * CURLPROTO_DICT,
 * CURLPROTO_FILE,
 * CURLPROTO_TFTP,
 * CURLPROTO_ALL
 * </p>
 * </td>
 * <td>
 * Added in cURL 7.19.4.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PROXYAUTH</td>
 * <td>
 * The HTTP authentication method(s) to use for the proxy connection.
 * Use the same bitmasks as described in
 * CURLOPT_HTTPAUTH. For proxy authentication,
 * only CURLAUTH_BASIC and
 * CURLAUTH_NTLM are currently supported.
 * </td>
 * <td>
 * Added in cURL 7.10.7 and PHP 5.1.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PROXYPORT</td>
 * <td>
 * The port number of the proxy to connect to. This port number can
 * also be set in CURLOPT_PROXY.
 * </td>
 * <td>
 * Added in PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PROXYTYPE</td>
 * <td>
 * Either CURLPROXY_HTTP (default) or
 * CURLPROXY_SOCKS5.
 * </td>
 * <td>
 * Added in cURL 7.10 and PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_REDIR_PROTOCOLS</td>
 * <td>
 * Bitmask of CURLPROTO_* values. If used, this bitmask
 * limits what protocols libcurl may use in a transfer that it follows to in
 * a redirect when CURLOPT_FOLLOWLOCATION is enabled.
 * This allows you to limit specific transfers to only be allowed to use a subset
 * of protocols in redirections. By default libcurl will allow all protocols
 * except for FILE and SCP. This is a difference compared to pre-7.19.4 versions
 * which unconditionally would follow to all protocols supported. 
 * See also CURLOPT_PROTOCOLS for protocol constant values.
 * </td>
 * <td>
 * Added in cURL 7.19.4.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_RESUME_FROM</td>
 * <td>
 * The offset, in bytes, to resume a transfer from.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSL_VERIFYHOST</td>
 * <td>
 * 1 to check the existence of a common name in the
 * SSL peer certificate. 2 to check the existence of
 * a common name and also verify that it matches the hostname
 * provided.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLVERSION</td>
 * <td>
 * The SSL version (2 or 3) to use. By default PHP will try to determine
 * this itself, although in some cases this must be set manually.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_TIMECONDITION</td>
 * <td>
 * How CURLOPT_TIMEVALUE is treated.
 * Use CURL_TIMECOND_IFMODSINCE to return the
 * page only if it has been modified since the time specified in
 * CURLOPT_TIMEVALUE. If it hasn't been modified,
 * a "304 Not Modified" header will be returned
 * assuming CURLOPT_HEADER is true.
 * Use CURL_TIMECOND_IFUNMODSINCE for the reverse
 * effect. CURL_TIMECOND_IFMODSINCE is the
 * default.
 * </td>
 * <td>
 * Added in PHP 5.1.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_TIMEOUT</td>
 * <td>
 * The maximum number of seconds to allow cURL functions to execute.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_TIMEOUT_MS</td>
 * <td>
 * The maximum number of milliseconds to allow cURL functions to
 * execute.
 * </td>
 * <td>
 * Added in cURL 7.16.2. Available since PHP 5.2.3.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_TIMEVALUE</td>
 * <td>
 * The time in seconds since January 1st, 1970. The time will be used
 * by CURLOPT_TIMECONDITION. By default,
 * CURL_TIMECOND_IFMODSINCE is used.
 * </td>
 * <td>
 * </td>
 * </tr>
 * </p>
 * <p>
 * value should be a string for the
 * following values of the option parameter:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Set value to</td>
 * <td>Notes</td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_CAINFO</td>
 * <td>
 * The name of a file holding one or more certificates to verify the
 * peer with. This only makes sense when used in combination with
 * CURLOPT_SSL_VERIFYPEER.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_CAPATH</td>
 * <td>
 * A directory that holds multiple CA certificates. Use this option
 * alongside CURLOPT_SSL_VERIFYPEER.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_COOKIE</td>
 * <td>
 * The contents of the "Cookie: " header to be
 * used in the HTTP request.
 * Note that multiple cookies are separated with a semicolon followed
 * by a space (e.g., "fruit=apple; colour=red")
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_COOKIEFILE</td>
 * <td>
 * The name of the file containing the cookie data. The cookie file can
 * be in Netscape format, or just plain HTTP-style headers dumped into
 * a file.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_COOKIEJAR</td>
 * <td>
 * The name of a file to save all internal cookies to when the
 * connection closes.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_CUSTOMREQUEST</td>
 * <td><p>
 * A custom request method to use instead of
 * "GET" or "HEAD" when doing
 * a HTTP request. This is useful for doing
 * "DELETE" or other, more obscure HTTP requests.
 * Valid values are things like "GET",
 * "POST", "CONNECT" and so on;
 * i.e. Do not enter a whole HTTP request line here. For instance,
 * entering "GET /index.html HTTP/1.0\r\n\r\n"
 * would be incorrect.
 * <p>
 * Don't do this without making sure the server supports the custom
 * request method first.
 * </p>
 * </p></td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_EGDSOCKET</td>
 * <td>
 * Like CURLOPT_RANDOM_FILE, except a filename
 * to an Entropy Gathering Daemon socket.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_ENCODING</td>
 * <td>
 * The contents of the "Accept-Encoding: " header.
 * This enables decoding of the response. Supported encodings are
 * "identity", "deflate", and
 * "gzip". If an empty string, "",
 * is set, a header containing all supported encoding types is sent.
 * </td>
 * <td>
 * Added in cURL 7.10.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FTPPORT</td>
 * <td>
 * The value which will be used to get the IP address to use
 * for the FTP "POST" instruction. The "POST" instruction tells
 * the remote server to connect to our specified IP address. The
 * string may be a plain IP address, a hostname, a network
 * interface name (under Unix), or just a plain '-' to use the
 * systems default IP address.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_INTERFACE</td>
 * <td>
 * The name of the outgoing network interface to use. This can be an
 * interface name, an IP address or a host name.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_KRB4LEVEL</td>
 * <td>
 * The KRB4 (Kerberos 4) security level. Any of the following values
 * (in order from least to most powerful) are valid:
 * "clear",
 * "safe",
 * "confidential",
 * "private"..
 * If the string does not match one of these,
 * "private" is used. Setting this option to &null;
 * will disable KRB4 security. Currently KRB4 security only works
 * with FTP transactions.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_POSTFIELDS</td>
 * <td>
 * The full data to post in a HTTP "POST" operation.
 * To post a file, prepend a filename with @ and
 * use the full path. This can either be passed as a urlencoded 
 * string like 'para1=val1&amp;para2=val2&amp;...' 
 * or as an array with the field name as key and field data as value.
 * If value is an array, the
 * Content-Type header will be set to
 * multipart/form-data.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PROXY</td>
 * <td>
 * The HTTP proxy to tunnel requests through.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PROXYUSERPWD</td>
 * <td>
 * A username and password formatted as
 * "[username]:[password]" to use for the
 * connection to the proxy.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_RANDOM_FILE</td>
 * <td>
 * A filename to be used to seed the random number generator for SSL.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_RANGE</td>
 * <td>
 * Range(s) of data to retrieve in the format
 * "X-Y" where X or Y are optional. HTTP transfers
 * also support several intervals, separated with commas in the format
 * "X-Y,N-M".
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_REFERER</td>
 * <td>
 * The contents of the "Referer: " header to be used
 * in a HTTP request.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSL_CIPHER_LIST</td>
 * <td>
 * A list of ciphers to use for SSL. For example,
 * RC4-SHA and TLSv1 are valid
 * cipher lists.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLCERT</td>
 * <td>
 * The name of a file containing a PEM formatted certificate.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLCERTPASSWD</td>
 * <td>
 * The password required to use the
 * CURLOPT_SSLCERT certificate.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLCERTTYPE</td>
 * <td>
 * The format of the certificate. Supported formats are
 * "PEM" (default), "DER",
 * and "ENG".
 * </td>
 * <td>
 * Added in cURL 7.9.3 and PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLENGINE</td>
 * <td>
 * The identifier for the crypto engine of the private SSL key
 * specified in CURLOPT_SSLKEY.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLENGINE_DEFAULT</td>
 * <td>
 * The identifier for the crypto engine used for asymmetric crypto
 * operations.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLKEY</td>
 * <td>
 * The name of a file containing a private SSL key.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLKEYPASSWD</td>
 * <td><p>
 * The secret password needed to use the private SSL key specified in
 * CURLOPT_SSLKEY.
 * <p>
 * Since this option contains a sensitive password, remember to keep
 * the PHP script it is contained within safe.
 * </p>
 * </p></td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_SSLKEYTYPE</td>
 * <td>
 * The key type of the private SSL key specified in
 * CURLOPT_SSLKEY. Supported key types are
 * "PEM" (default), "DER",
 * and "ENG".
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_URL</td>
 * <td>
 * The URL to fetch. This can also be set when initializing a
 * session with curl_init.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_USERAGENT</td>
 * <td>
 * The contents of the "User-Agent: " header to be
 * used in a HTTP request.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_USERPWD</td>
 * <td>
 * A username and password formatted as
 * "[username]:[password]" to use for the
 * connection.
 * </td>
 * <td>
 * </td>
 * </tr>
 * </p>
 * <p>
 * value should be an array for the
 * following values of the option parameter:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Set value to</td>
 * <td>Notes</td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HTTP200ALIASES</td>
 * <td>
 * An array of HTTP 200 responses that will be treated as valid
 * responses and not as errors.
 * </td>
 * <td>
 * Added in cURL 7.10.3 and PHP 5.0.0.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HTTPHEADER</td>
 * <td>
 * An array of HTTP header fields to set.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_POSTQUOTE</td>
 * <td>
 * An array of FTP commands to execute on the server after the FTP
 * request has been performed.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_QUOTE</td>
 * <td>
 * An array of FTP commands to execute on the server prior to the FTP
 * request.
 * </td>
 * <td>
 * </td>
 * </tr>
 * </p>
 * <p>
 * value should be a stream resource (using
 * fopen, for example) for the following values of the
 * option parameter:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Set value to</td>
 * <td>Notes</td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_FILE</td>
 * <td>
 * The file that the transfer should be written to. The default
 * is STDOUT (the browser window).
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_INFILE</td>
 * <td>
 * The file that the transfer should be read from when uploading.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_STDERR</td>
 * <td>
 * An alternative location to output errors to instead of
 * STDERR.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_WRITEHEADER</td>
 * <td>
 * The file that the header part of the transfer is written to.
 * </td>
 * <td>
 * </td>
 * </tr>
 * </p>
 * <p>
 * value should be a string that is the name of a valid
 * callback function for the following values of the
 * option parameter:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Set value to</td>
 * <td>Notes</td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_HEADERFUNCTION</td>
 * <td>
 * The name of a callback function where the callback function takes
 * two parameters. The first is the cURL resource, the second is a
 * string with the header data to be written. The header data must
 * be written when using this callback function. Return the number of 
 * bytes written.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PASSWDFUNCTION</td>
 * <td>
 * The name of a callback function where the callback function takes
 * three parameters. The first is the cURL resource, the second is a
 * string containing a password prompt, and the third is the maximum
 * password length. Return the string containing the password.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_PROGRESSFUNCTION</td>
 * <td>
 * The name of a callback function where the callback function takes
 * three parameters. The first is the cURL resource, the second is a
 * file-descriptor resource, and the third is length. Return the
 * string containing the data.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_READFUNCTION</td>
 * <td>
 * The name of a callback function where the callback function takes
 * two parameters. The first is the cURL resource, and the second is a
 * string with the data to be read. The data must be read by using this
 * callback function. Return the number of bytes read. Return 0 to signal
 * EOF.
 * </td>
 * <td>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CURLOPT_WRITEFUNCTION</td>
 * <td>
 * The name of a callback function where the callback function takes
 * two parameters. The first is the cURL resource, and the second is a
 * string with the data to be written. The data must be written by using
 * this callback function. Must return the exact number of bytes written 
 * or this will fail.
 * </td>
 * <td>
 * </td>
 * </tr>
 * </p>
 * @return bool true on success or false on failure.
 */
function curl_setopt ($ch, $option, $value) {}

/**
 * (PHP 5 &gt;= 5.1.3)<br/>
 * Set multiple options for a cURL transfer
 * @link http://php.net/manual/en/function.curl-setopt-array.php
 * @param resource $ch 
 * @param array $options <p>
 * An array specifying which options to set and their values.
 * The keys should be valid curl_setopt constants or
 * their integer equivalents.
 * </p>
 * @return bool true if all options were successfully set. If an option could
 * not be successfully set, false is immediately returned, ignoring any
 * future options in the options array.
 */
function curl_setopt_array ($ch, array $options) {}

/**
 * (PHP 4 &gt;= 4.0.2, PHP 5)<br/>
 * Perform a cURL session
 * @link http://php.net/manual/en/function.curl-exec.php
 * @param resource $ch 
 * @return mixed true on success or false on failure. However, if the CURLOPT_RETURNTRANSFER
 * option is set, it will return the result on success, false on failure.
 */
function curl_exec ($ch) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Get information regarding a specific transfer
 * @link http://php.net/manual/en/function.curl-getinfo.php
 * @param resource $ch 
 * @param int $opt [optional] <p>
 * This may be one of the following constants:
 * CURLINFO_EFFECTIVE_URL - Last effective URL
 * @return mixed If opt is given, returns its value as a string.
 * Otherwise, returns an associative array with the following elements 
 * (which correspond to opt):
 * "url"
 * "content_type"
 * "http_code"
 * "header_size"
 * "request_size"
 * "filetime"
 * "ssl_verify_result"
 * "redirect_count"
 * "total_time"
 * "namelookup_time"
 * "connect_time"
 * "pretransfer_time"
 * "size_upload"
 * "size_download"
 * "speed_download"
 * "speed_upload"
 * "download_content_length"
 * "upload_content_length"
 * "starttransfer_time"
 * "redirect_time"
 */
function curl_getinfo ($ch, $opt = null) {}

/**
 * (PHP 4 &gt;= 4.0.3, PHP 5)<br/>
 * Return a string containing the last error for the current session
 * @link http://php.net/manual/en/function.curl-error.php
 * @param resource $ch 
 * @return string the error message or '' (the empty string) if no
 * error occurred.
 */
function curl_error ($ch) {}

/**
 * (PHP 4 &gt;= 4.0.3, PHP 5)<br/>
 * Return the last error number
 * @link http://php.net/manual/en/function.curl-errno.php
 * @param resource $ch 
 * @return int the error number or 0 (zero) if no error
 * occurred.
 */
function curl_errno ($ch) {}

/**
 * (PHP 4 &gt;= 4.0.2, PHP 5)<br/>
 * Close a cURL session
 * @link http://php.net/manual/en/function.curl-close.php
 * @param resource $ch 
 * @return void 
 */
function curl_close ($ch) {}

/**
 * (PHP 5)<br/>
 * Returns a new cURL multi handle
 * @link http://php.net/manual/en/function.curl-multi-init.php
 * @return resource a cURL multi handle resource on success, false on failure.
 */
function curl_multi_init () {}

/**
 * (PHP 5)<br/>
 * Add a normal cURL handle to a cURL multi handle
 * @link http://php.net/manual/en/function.curl-multi-add-handle.php
 * @param resource $mh 
 * @param resource $ch 
 * @return int 0 on success, or one of the CURLM_XXX errors
 * code.
 */
function curl_multi_add_handle ($mh, $ch) {}

/**
 * (PHP 5)<br/>
 * Remove a multi handle from a set of cURL handles
 * @link http://php.net/manual/en/function.curl-multi-remove-handle.php
 * @param resource $mh 
 * @param resource $ch 
 * @return int On success, returns a cURL handle, false on failure.
 */
function curl_multi_remove_handle ($mh, $ch) {}

/**
 * (PHP 5)<br/>
 * Wait for activity on any curl_multi connection
 * @link http://php.net/manual/en/function.curl-multi-select.php
 * @param resource $mh 
 * @param float $timeout [optional] <p>
 * Time, in seconds, to wait for a response.
 * </p>
 * @return int On success, returns the number of descriptors contained in, 
 * the descriptor sets. On failure, this function will return -1 on a select failure or timeout (from the underlying select system call).
 */
function curl_multi_select ($mh, $timeout = null) {}

/**
 * (PHP 5)<br/>
 * Run the sub-connections of the current cURL handle
 * @link http://php.net/manual/en/function.curl-multi-exec.php
 * @param resource $mh 
 * @param int $still_running <p>
 * A reference to a flag to tell whether the operations are still running.
 * </p>
 * @return int A cURL code defined in the cURL Predefined Constants.
 * </p>
 * <p>
 * This only returns errors regarding the whole multi stack. There might still have 
 * occurred problems on individual transfers even when this function returns 
 * CURLM_OK.
 */
function curl_multi_exec ($mh, &$still_running) {}

/**
 * (PHP 5)<br/>
 * Return the content of a cURL handle if <constant>CURLOPT_RETURNTRANSFER</constant> is set
 * @link http://php.net/manual/en/function.curl-multi-getcontent.php
 * @param resource $ch 
 * @return string Return the content of a cURL handle if CURLOPT_RETURNTRANSFER is set.
 */
function curl_multi_getcontent ($ch) {}

/**
 * (PHP 5)<br/>
 * Get information about the current transfers
 * @link http://php.net/manual/en/function.curl-multi-info-read.php
 * @param resource $mh 
 * @param int $msgs_in_queue [optional] <p>
 * Number of messages that are still in the queue
 * </p>
 * @return array On success, returns an associative array for the message, false on failure.
 */
function curl_multi_info_read ($mh, &$msgs_in_queue = null) {}

/**
 * (PHP 5)<br/>
 * Close a set of cURL handles
 * @link http://php.net/manual/en/function.curl-multi-close.php
 * @param resource $mh 
 * @return void 
 */
function curl_multi_close ($mh) {}

// End of curl v.
?>
