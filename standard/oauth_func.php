<?php
/**
 * PHPStorm stub file for OAuth functions.
 *
 * @link http://php.net/manual/en/book.oauth.php
 */

/**
 * Generate a Signature Base String
 *
 * @param string $http_method
 * @param string $uri
 * @param array  $request_parameters
 *
 * @return string
 */
function oauth_get_sbs($http_method, $uri, $request_parameters = []) { }

/**
 * Encode a URI to RFC 3986
 *
 * @param string $uri
 *
 * @return string
 */
function oauth_urlencode($uri) { }
