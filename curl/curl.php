<?php

class CURLFile {
    public $name;
    public $mime;
    public $postname;

    /**
     * Create a CURLFile object
     * @link https://secure.php.net/manual/en/curlfile.construct.php
     * @param string $filename <p>Path to the file which will be uploaded.</p>
     * @param string $mimetype [optional] <p>Mimetype of the file.</p>
     * @param string $postname [optional] <p>Name of the file.</p>
     * @since 5.5.0
     */
    function __construct($filename, $mimetype, $postname) {
    }

    /**
     * Get file name
     * @link https://secure.php.net/manual/en/curlfile.getfilename.php
     * @return string Returns file name.
     * @since 5.5.0
     */
    public function getFilename() {
    }

    /**
     * Get MIME type
     * @link https://secure.php.net/manual/en/curlfile.getmimetype.php
     * @return string Returns MIME type.
     * @since 5.5.0
     */
    public function getMimeType() {
    }

    /**
     * Get file name for POST
     * @link https://secure.php.net/manual/en/curlfile.getpostfilename.php
     * @return string Returns file name for POST.
     * @since 5.5.0
     */
    public function getPostFilename() {
    }

    /**
     * Set MIME type
     * @link https://secure.php.net/manual/en/curlfile.setmimetype.php
     * @param string $mime
     * @since 5.5.0
     */
    public function setMimeType($mime) {
    }

    /**
     * Set file name for POST
     * https://secure.php.net/manual/en/curlfile.setpostfilename.php
     * @param string $postname
     * @since 5.5.0
     */
    public function setPostFilename($postname) {
    }

    /**
     * @link https://secure.php.net/manual/en/curlfile.wakeup.php
     * Unserialization handler
     * @since 5.5.0
     */
    public function __wakeup() {
    }
}
/**
 * Initialize a cURL session
 * @link https://php.net/manual/en/function.curl-init.php
 * @param string $url [optional] <p>
 * If provided, the CURLOPT_URL option will be set
 * to its value. You can manually set this using the
 * curl_setopt function.
 * </p>
 * @return resource|false a cURL handle on success, false on errors.
 * @since 4.0.2
 * @since 5.0
 */
function curl_init ($url = null) {}

/**
 * Copy a cURL handle along with all of its preferences
 * @link https://php.net/manual/en/function.curl-copy-handle.php
 * @param resource $ch
 * @return resource a new cURL handle.
 * @since 5.0
 */
function curl_copy_handle ($ch) {}

/**
 * Gets cURL version information
 * @link https://php.net/manual/en/function.curl-version.php
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
 * @since 4.0.2
 * @since 5.0
 */
function curl_version ($age = null) {}

/**
 * Set an option for a cURL transfer
 * @link https://php.net/manual/en/function.curl-setopt.php
 * @param resource $ch
 * @param int $option <p>
 * The CURLOPT_XXX option to set.
 * </p>
 * @param mixed|callable $value <p>
 * The value to be set on option.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.2
 * @since 5.0
 */
function curl_setopt ($ch, $option, $value) {}

/**
 * Set multiple options for a cURL transfer
 * @link https://php.net/manual/en/function.curl-setopt-array.php
 * @param resource $ch
 * @param array $options <p>
 * An array specifying which options to set and their values.
 * The keys should be valid curl_setopt constants or
 * their integer equivalents.
 * </p>
 * @return bool true if all options were successfully set. If an option could
 * not be successfully set, false is immediately returned, ignoring any
 * future options in the options array.
 * @since 5.1.3
 */
function curl_setopt_array ($ch, array $options) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Close a cURL share handle
 * @link https://secure.php.net/manual/en/function.curl-share-close.php
 * @param resource $sh <p>
 * A cURL share handle returned by  {@link https://secure.php.net/manual/en/function.curl-share-init.php curl_share_init()}
 * </p>
 * @return void
 * @since 5.5.0
 */
function curl_share_close ($sh) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Initialize a cURL share handle
 * @link https://secure.php.net/manual/en/function.curl-share-init.php
 * @return resource Returns resource of type "cURL Share Handle".
 * @since 5.5.0
 */
function curl_share_init () {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Set an option for a cURL share handle.
 * @link https://secure.php.net/manual/en/function.curl-share-setopt.php
 * @param resource $sh <p>
 * A cURL share handle returned by  {@link https://secure.php.net/manual/en/function.curl-share-init.php curl_share_init()}.
 * </p>
 * @param int $option <table>
 *
 * <thead>
 * <tr>
 * <th>Option</th>
 * <th>Description</th>
 * </tr>
 *
 * </thead>
 *
 * <tbody>
 * <tr>
 * <td style="vertical-align: top;"><b>CURLSHOPT_SHARE</b></td>
 * <td style="vertical-align: top;">
 * Specifies a type of data that should be shared.
 * </td>
 * </tr>
 *
 * <tr>
 * <td style="vertical-align: top;"><b>CURLSHOPT_UNSHARE</b></td>
 * <td style="vertical-align: top;">
 * Specifies a type of data that will be no longer shared.
 * </td>
 * </tr>
 *
 * </tbody>
 *
 * </table>
 * @param string $value  <p><table>
 *
 * <thead>
 * <tr>
 * <th>Value</th>
 * <th>Description</th>
 * </tr>
 *
 * </thead>
 *
 * <tbody class="tbody">
 * <tr>
 * <td style="vertical-align: top;"><b>CURL_LOCK_DATA_COOKIE</b></td>
 * <td style="vertical-align: top;">
 * Shares cookie data.
 * </td>
 * </tr>
 *
 * <tr>
 * <td style="vertical-align: top;"><b>CURL_LOCK_DATA_DNS</b></td>
 * <td style="vertical-align: top;">
 * Shares DNS cache. Note that when you use cURL multi handles,
 * all handles added to the same multi handle will share DNS cache
 * by default.
 * </td>
 * </tr>
 *
 * <tr>
 * <td style="vertical-align: top;"><b>CURL_LOCK_DATA_SSL_SESSION</b></td>
 * <td style="vertical-align: top;">
 * Shares SSL session IDs, reducing the time spent on the SSL
 * handshake when reconnecting to the same server. Note that SSL
 * session IDs are reused withing the same handle by default.
 * </td>
 * </tr>
 *
 * </tbody>
 *
 * </table>
 * </p>
 * @return bool
 * Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.5.0
 */
function curl_share_setopt ($sh, $option, $value ) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Return string describing the given error code
 * @link https://secure.php.net/manual/en/function.curl-strerror.php
 * @param int $errornum <p>
 * One of the {@link https://curl.haxx.se/libcurl/c/libcurl-errors.html &nbsp;cURL error codes} constants.
 * </p>
 * @return string|NULL Returns error description or <b>NULL</b> for invalid error code.
 * @since 5.5.0
 */
function curl_strerror ($errornum ) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Decodes the given URL encoded string
 * @link https://secure.php.net/manual/en/function.curl-unescape.php
 * @param resource $ch <p>A cURL handle returned by
 * {@link https://secure.php.net/manual/en/function.curl-init.php curl_init()}.</p>
 * @param string $str <p>
 * The URL encoded string to be decoded.
 * </p>
 * @return string|bool Returns decoded string or FALSE on failure.
 * @since 5.5.0
 */
function  curl_unescape ($ch, $str)  {}
/**
 * Perform a cURL session
 * @link https://php.net/manual/en/function.curl-exec.php
 * @param resource $ch
 * @return string|bool true on success or false on failure. However, if the CURLOPT_RETURNTRANSFER
 * option is set, it will return the result on success, false on failure.
 * @since 4.0.2
 * @since 5.0
 */
function curl_exec ($ch) {}

/**
 * Get information regarding a specific transfer
 * @link https://php.net/manual/en/function.curl-getinfo.php
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
 * @since 4.0.4
 * @since 5.0
 */
function curl_getinfo ($ch, $opt = null) {}

/**
 * Return a string containing the last error for the current session
 * @link https://php.net/manual/en/function.curl-error.php
 * @param resource $ch
 * @return string the error message or '' (the empty string) if no
 * error occurred.
 * @since 4.0.3
 * @since 5.0
 */
function curl_error ($ch) {}

/**
 * Return the last error number
 * @link https://php.net/manual/en/function.curl-errno.php
 * @param resource $ch
 * @return int the error number or 0 (zero) if no error
 * occurred.
 * @since 4.0.3
 * @since 5.0
 */
function curl_errno ($ch) {}

/**
 * URL encodes the given string
 * @link https://secure.php.net/manual/en/function.curl-escape.php
 * @param resource $ch <p>
 * A cURL handle returned by
 * {@link https://secure.php.net/manual/en/function.curl-init.php curl_init()}.</p>
 * @param string $str <p>
 * The string to be encoded.</p>
 * @return string|boolean Returns escaped string or FALSE on failure.
 * @since 5.5.0
 */
function curl_escape($ch, $str) {}

/**
 * (PHP 5 >= 5.5.0) <br/>
 * Create a CURLFile object
 * @link https://secure.php.net/manual/en/curlfile.construct.php
 * @param string $filename <p> Path to the file which will be uploaded.</p>
 * @param string $mimetype [optional] <p>Mimetype of the file.</p>
 * @param string $postname [optional] <p>Name of the file.</p>
 * @return CURLFile
 * Returns a {@link https://secure.php.net/manual/en/class.curlfile.php CURLFile} object.
 * @since 5.5.0
 */
function curl_file_create($filename, $mimetype, $postname) {}

/**
 * Close a cURL session
 * @link https://php.net/manual/en/function.curl-close.php
 * @param resource $ch
 * @return void
 * @since 4.0.2
 * @since 5.0
 */
function curl_close ($ch) {}

/**
 * Returns a new cURL multi handle
 * @link https://php.net/manual/en/function.curl-multi-init.php
 * @return resource a cURL multi handle resource on success, false on failure.
 * @since 5.0
 */
function curl_multi_init () {}

/**
 * Add a normal cURL handle to a cURL multi handle
 * @link https://php.net/manual/en/function.curl-multi-add-handle.php
 * @param resource $mh
 * @param resource $ch
 * @return int 0 on success, or one of the CURLM_XXX errors
 * code.
 * @since 5.0
 */
function curl_multi_add_handle ($mh, $ch) {}

/**
 * Remove a multi handle from a set of cURL handles
 * @link https://php.net/manual/en/function.curl-multi-remove-handle.php
 * @param resource $mh
 * @param resource $ch
 * @return int On success, returns a cURL handle, false on failure.
 * @since 5.0
 */
function curl_multi_remove_handle ($mh, $ch) {}

/**
 * Wait for activity on any curl_multi connection
 * @link https://php.net/manual/en/function.curl-multi-select.php
 * @param resource $mh
 * @param float $timeout [optional] <p>
 * Time, in seconds, to wait for a response.
 * </p>
 * @return int On success, returns the number of descriptors contained in,
 * the descriptor sets. On failure, this function will return -1 on a select failure or timeout (from the underlying select system call).
 * @since 5.0
 */
function curl_multi_select ($mh, $timeout = null) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Set an option for the cURL multi handle
 * @link https://secure.php.net/manual/en/function.curl-multi-setopt.php
 * @param resource $mh
 * @param int $option <p>
 * One of the <b>CURLMOPT_*</b> constants.
 * </p>
 * @param mixed $value   <p>
 * The value to be set on <em>option</em>.
 * </p>
 * <p>
 * <em>value</em> should be an {@link https://php.net/manual/en/language.types.integer.php int} for the
 * following values of the <em>option</em> parameter:
 * </p><table>
 *
 * <thead>
 * <tr>
 * <th>Option</th>
 * <th>Set <em><code class="parameter">value</code></em> to</th>
 * </tr>
 *
 * </thead>
 *
 * <tbody>
 * <tr>
 * <td><b>CURLMOPT_PIPELINING</b></td>
 * <td style="vertical-align: top;">
 * Pass 1 to enable or 0 to disable. Enabling pipelining on a multi
 * handle will make it attempt to perform HTTP Pipelining as far as
 * possible for transfers using this handle. This means that if you add
 * a second request that can use an already existing connection, the
 * second request will be "piped" on the same connection rather than
 * being executed in parallel.
 * </td>
 * </tr>
 *
 * <tr>
 * <td style="vertical-align: top;"><b>CURLMOPT_MAXCONNECTS</b></td>
 * <td style="vertical-align: top;">
 * Pass a number that will be used as the maximum amount of
 * simultaneously open connections that libcurl may cache. Default is
 * 10. When the cache is full, curl closes the oldest one in the cache
 * to prevent the number of open connections from increasing.
 * </td>
 * </tr>
 * </tbody>
 * </table>
 * @return boolean Returns TRUE on success or FALSE on failure.
 * @since 5.5.0
 */
function curl_multi_setopt ($mh, $option, $value) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Return string describing error code
 * @link https://secure.php.net/manual/en/function.curl-multi-strerror.php
 * @param int $errornum <p>
 * One of the {@link https://curl.haxx.se/libcurl/c/libcurl-errors.html CURLM error codes} constants.
 * </p>
 * @return string|NULL Returns error string for valid error code, NULL otherwise.
 * @since 5.5.0
 */
function curl_multi_strerror ($errornum) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Pause and unpause a connection
 * @link https://secure.php.net/manual/en/function.curl-pause.php
 * @param resource $ch
 * <p>A cURL handle returned by {@link https://secure.php.net/manual/en/function.curl-init.php curl_init()}.</p>
 * @param int $bitmask <p>One of <b>CURLPAUSE_*</b> constants.</p>
 * @return int Returns an error code (<b>CURLE_OK</b> for no error).
 * @since 5.5.0
 */
function curl_pause ($ch, $bitmask ) {}

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Reset all options of a libcurl session handle
 * @link https://secure.php.net/manual/en/function.curl-reset.php
 * @param resource $ch <p>A cURL handle returned by
 * {@link https://secure.php.net/manual/en/function.curl-init.php curl_init()}.</p>
 * @return void
 * @since 5.5.0
 */
function curl_reset ($ch) {}

/**
 * Run the sub-connections of the current cURL handle
 * @link https://php.net/manual/en/function.curl-multi-exec.php
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
 * @since 5.0
 */
function curl_multi_exec ($mh, &$still_running) {}

/**
 * Return the content of a cURL handle if <constant>CURLOPT_RETURNTRANSFER</constant> is set
 * @link https://php.net/manual/en/function.curl-multi-getcontent.php
 * @param resource $ch
 * @return string Return the content of a cURL handle if CURLOPT_RETURNTRANSFER is set.
 * @since 5.0
 */
function curl_multi_getcontent ($ch) {}

/**
 * Get information about the current transfers
 * @link https://php.net/manual/en/function.curl-multi-info-read.php
 * @param resource $mh
 * @param int $msgs_in_queue [optional] <p>
 * Number of messages that are still in the queue
 * </p>
 * @return array On success, returns an associative array for the message, false on failure.
 * @since 5.0
 */
function curl_multi_info_read ($mh, &$msgs_in_queue = null) {}

/**
 * Close a set of cURL handles
 * @link https://php.net/manual/en/function.curl-multi-close.php
 * @param resource $mh
 * @return void
 * @since 5.0
 */
function curl_multi_close ($mh) {}

/**
 * @param resource $mh
 * @since 7.1
 * @return int
 */
function curl_multi_errno($mh) {}

/**
 * @param resource $rh
 * @since 7.1
 * @return int
 */
function curl_share_errno($rh) {}

/**
 * @param int $errno
 * @since 7.1
 * @return string
 */
function curl_share_strerror($errno){}
