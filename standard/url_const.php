<?php
/**
 * PHPStorm stub file for URL constants.
 *
 * @link http://php.net/manual/en/url.constants.php
 */

/**
 * Encoding is performed per RFC 1738 and the application/x-www-form-urlencoded media type,
 * which implies that spaces are encoded as plus (+) signs.
 *
 * @link http://php.net/manual/en/function.http-build-query.php
 */
const PHP_QUERY_RFC1738 = 1;
/**
 * Encoding is performed according to RFC 3986, and spaces will be percent encoded (%20).
 *
 * @link http://php.net/manual/en/function.http-build-query.php
 */
const PHP_QUERY_RFC3986 = 2;
/**
 * @link  http://php.net/manual/en/url.constants.php
 */
const PHP_URL_FRAGMENT = 7;
const PHP_URL_HOST = 1;
const PHP_URL_PASS = 4;
const PHP_URL_PATH = 5;
const PHP_URL_PORT = 2;
const PHP_URL_QUERY = 6;
const PHP_URL_SCHEME = 0;
const PHP_URL_USER = 3;
