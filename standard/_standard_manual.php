<?php

/**
 * (PHP 5.1)<br/>
 * Halts the execution of the compiler. This can be useful to embed data in PHP scripts, like the installation files.
 * Byte position of the data start can be determined by the __COMPILER_HALT_OFFSET__ constant
 * which is defined only if there is a __halt_compiler() presented in the file.
 * <p> Note: __halt_compiler() can only be used from the outermost scope.
 * @link https://php.net/manual/en/function.halt-compiler.php
 * @return void
 */
function PS_UNRESERVE_PREFIX___halt_compiler(){}

/**
 * (PHP 5.1)<br/>
 * Byte position of the data start, defined only if there is a __halt_compiler() presented in the file.
 * @link https://php.net/manual/en/function.halt-compiler.php
 * @return void
 */
define("__COMPILER_HALT_OFFSET__",0);


/**
 * Convert hexadecimal string to its binary representation.
 *
 * If the hexadecimal input string is of odd length or invalid hexadecimal string an <code>E_WARNING</code> level error is emitted.
 *
 * @link https://php.net/manual/en/function.hex2bin.php
 * @param string $data Hexadecimal string to convert.
 * @return string|false The binary representation of the given data or <b>FALSE</b> on failure.
 * @see bin2hex()
 * @see unpack()
 * @since 5.4
 */
function hex2bin($data) {};

/**
 * Get or Set the HTTP response code
 * @param int $response_code [optional] The optional response_code will set the response code.
 * @return int The current response code. By default the return value is int(200).
 */
function http_response_code($response_code = null) {}

/**
 * Fetches all HTTP headers from the current request.
 * This function is an alias for apache_request_headers(). Please read the apache_request_headers() documentation for more information on how this function works.
 * @link https://php.net/manual/en/function.getallheaders.php
 * @return array|false An associative array of all the HTTP headers in the current request, or <b>FALSE</b> on failure.
 */
function getallheaders () {}
