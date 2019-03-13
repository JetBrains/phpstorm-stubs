<?php

/**
 * @param string $str The string being translated.
 * @param array $replace_pairs The replace_pairs parameter may be used as a substitute for to and from in which case it's an array in the form array('from' => 'to', ...).
 * @return string A copy of str, translating all occurrences of each character in from to the corresponding character in to.
 */
function strtr ($str, array $replace_pairs) {};

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
 * @return bool|string The binary representation of the given data or <b>FALSE</b> on failure.
 * @see bin2hex()
 * @see unpack()
 * @since 5.4.0
 */
function hex2bin($data) {};

/**
 * This function flushes all response data to the client and finishes the request.
 * This allows for time consuming tasks to be performed without leaving the connection to the client open.
 * @return boolean Returns TRUE on success or FALSE on failure.
 * @link https://php.net/manual/en/install.fpm.php
 * @since 5.3.3
 */
function fastcgi_finish_request() {};

/**
 * Get or Set the HTTP response code
 * @param int $response_code [optional] The optional response_code will set the response code.
 * @return int The current response code. By default the return value is int(200).
 */
function http_response_code($response_code = null) {}
