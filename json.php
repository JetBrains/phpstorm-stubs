<?php

// Start of json v.1.2.1

/**
 * (PHP 5 &gt;= 5.2.0, PECL json &gt;= 1.2.0)<br/>
 * Returns the JSON representation of a value
 * @link http://php.net/manual/en/function.json-encode.php
 * @param mixed $value <p>
 * The <i>value</i> being encoded. Can be any type except
 * a resource.
 * </p>
 * <p>
 * This function only works with UTF-8 encoded data.
 * </p>
 * @param int $options [optional] <p>
 * Bitmask consisting of <b>JSON_HEX_QUOT</b>,
 * <b>JSON_HEX_TAG</b>,
 * <b>JSON_HEX_AMP</b>,
 * <b>JSON_HEX_APOS</b>,
 * <b>JSON_NUMERIC_CHECK</b>,
 * <b>JSON_PRETTY_PRINT</b>,
 * <b>JSON_UNESCAPED_SLASHES</b>,
 * <b>JSON_FORCE_OBJECT</b>,
 * <b>JSON_UNESCAPED_UNICODE</b>.
 * </p>
 * @return string a JSON encoded string on success.
 */
function json_encode ($value, $options = 0) {}

/**
 * (PHP 5 &gt;= 5.2.0, PECL json &gt;= 1.2.0)<br/>
 * Decodes a JSON string
 * @link http://php.net/manual/en/function.json-decode.php
 * @param string $json <p>
 * The <i>json</i> string being decoded.
 * </p>
 * <p>
 * This function only works with UTF-8 encoded data.
 * </p>
 * @param bool $assoc [optional] <p>
 * When true, returned objects will be converted into
 * associative arrays.
 * </p>
 * @param int $depth [optional] <p>
 * User specified recursion depth.
 * </p>
 * @param int $options [optional] <p>
 * Bitmask of JSON decode options. Currently only
 * <b>JSON_BIGINT_AS_STRING</b>
 * is supported (default is to cast large integers as floats)
 * </p>
 * @return mixed the value encoded in <i>json</i> in appropriate
 * PHP type. Values true, false and
 * null (case-insensitive) are returned as true, false
 * and null respectively. null is returned if the
 * <i>json</i> cannot be decoded or if the encoded
 * data is deeper than the recursion limit.
 */
function json_decode ($json, $assoc = false, $depth = 512, $options = 0) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Returns the last error occurred
 * @link http://php.net/manual/en/function.json-last-error.php
 * @return int an integer, the value can be one of the following 
 * constants:
 */
function json_last_error () {}


/**
 * All &lt; and &gt; are converted to \u003C and \u003E.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_TAG', 1);

/**
 * All &amp;s are converted to \u0026.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_AMP', 2);

/**
 * All ' are converted to \u0027.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_APOS', 4);

/**
 * All " are converted to \u0022.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_QUOT', 8);

/**
 * Outputs an object rather than an array when a non-associative array is
 * used. Especially useful when the recipient of the output is expecting
 * an object and the array is empty.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_FORCE_OBJECT', 16);

/**
 * Encodes numeric strings as numbers.
 * Available since PHP 5.3.3.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_NUMERIC_CHECK', 32);

/**
 * No error has occurred.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_NONE', 0);

/**
 * The maximum stack depth has been exceeded.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_DEPTH', 1);

/**
 * Since 5.4.0
 * Use whitespace in returned data to format it.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_PRETTY_PRINT', 0);

/**
 * Occurs with underflow or with the modes mismatch.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_STATE_MISMATCH', 2);


/**
 * Since 5.4.0
 * Don't escape /
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_UNESCAPED_SLASHES', 0);

/**
 * Since 5.4.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_BIGINT_AS_STRING', 0);



/**
 * Control character error, possibly incorrectly encoded.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_CTRL_CHAR', 3);

/**
 * Syntax error.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_SYNTAX', 4);

/**
 * Malformed UTF-8 characters, possibly incorrectly encoded. This
 * constant is available as of PHP 5.3.1.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_UTF8', 5);

// End of json v.1.2.1


/**
 * Encode multibyte Unicode characters literally (default is to escape as \uXXXX). Available since PHP 5.4.0.
 * @link http://php.net/manual/en/function.json-encode.php
 */
define('JSON_UNESCAPED_UNICODE', 256);
/** @link http://php.net/manual/en/function.json-decode.php */
define('JSON_OBJECT_AS_ARRAY', 1);

?>
