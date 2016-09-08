<?php

// Start of json v.1.3.1

/**
 * Objects implementing JsonSerializable
 * can customize their JSON representation when encoded with
 * <b>json_encode</b>.
 * @link http://php.net/manual/en/class.jsonserializable.php
 */
interface JsonSerializable  {

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
    function jsonSerialize ();

}

class JsonIncrementalParser  {
	const JSON_PARSER_SUCCESS = 0;
	const JSON_PARSER_CONTINUE = 1;


	/**
	 * @param $depth [optional]
	 * @param $options [optional]
	 */
	public function __construct ($depth, $options) {}

	public function getError () {}

	public function reset () {}

	/**
	 * @param $json
	 */
	public function parse ($json) {}

	/**
	 * @param $filename
	 */
	public function parseFile ($filename) {}

	/**
	 * @param $options [optional]
	 */
	public function get ($options) {}

}

/**
 * (PHP 5 &gt;= 5.2.0, PECL json &gt;= 1.2.0)<br/>
 * Returns the JSON representation of a value
 * @link http://php.net/manual/en/function.json-encode.php
 * @param mixed $value <p>
 * The <i>value</i> being encoded. Can be any type except
 * a resource.
 * </p>
 * <p>
 * All string data must be UTF-8 encoded.
 * </p>
 * <p>PHP implements a superset of
 * JSON - it will also encode and decode scalar types and <b>NULL</b>. The JSON standard
 * only supports these values when they are nested inside an array or an object.
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
 * <b>JSON_UNESCAPED_UNICODE</b>. The behaviour of these
 * constants is described on
 * the JSON constants page.
 * </p>
 * @param int $depth [optional] <p>
 * Set the maximum depth. Must be greater than zero.
 * </p>
 * @return string a JSON encoded string on success or <b>FALSE</b> on failure.
 */
function json_encode ($value, $options = 0, $depth = 512) {}

/**
 * (PHP 5 &gt;= 5.2.0, PECL json &gt;= 1.2.0)<br/>
 * Decodes a JSON string
 * @link http://php.net/manual/en/function.json-decode.php
 * @param string $json <p>
 * The <i>json</i> string being decoded.
 * </p>
 * <p>
 * This function only works with UTF-8 encoded strings.
 * </p>
 * <p>PHP implements a superset of
 * JSON - it will also encode and decode scalar types and <b>NULL</b>. The JSON standard
 * only supports these values when they are nested inside an array or an object.
 * </p>
 * @param bool $assoc [optional] <p>
 * When <b>TRUE</b>, returned objects will be converted into
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
 * null (case-insensitive) are returned as <b>TRUE</b>, <b>FALSE</b>
 * and <b>NULL</b> respectively. <b>NULL</b> is returned if the
 * <i>json</i> cannot be decoded or if the encoded
 * data is deeper than the recursion limit.
 */
function json_decode ($json, $assoc = false, $depth = 512, $options = 0) {}

/**
 * Returns the last error occurred
 * @link http://php.net/manual/en/function.json-last-error.php
 * @return int an integer, the value can be one of the following
 * constants:
 * @since 5.3.0
 */
function json_last_error () {}

/**
 * Returns the error string of the last json_encode() or json_decode() call
 * @link http://php.net/manual/en/function.json-last-error-msg.php
 * @return string the error message on success or <b>NULL</b> with wrong parameters.
 * @since 5.5.0
 */
function json_last_error_msg () {}


/**
 * All &lt; and &gt; are converted to \u003C and \u003E.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_TAG', 1);

/**
 * All &#38;#38;s are converted to \u0026.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_AMP', 2);

/**
 * All ' are converted to \u0027.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_APOS', 4);

/**
 * All " are converted to \u0022.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_HEX_QUOT', 8);

/**
 * Outputs an object rather than an array when a non-associative array is
 * used. Especially useful when the recipient of the output is expecting
 * an object and the array is empty.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_FORCE_OBJECT', 16);

/**
 * Encodes numeric strings as numbers.
 * @since 5.3.3
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_NUMERIC_CHECK', 32);

/**
 * Don't escape /.
 * @since 5.4.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_UNESCAPED_SLASHES', 64);

/**
 * Use whitespace in returned data to format it.
 * @since 5.4.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_PRETTY_PRINT', 128);

/**
 * Encode multibyte Unicode characters literally (default is to escape as \uXXXX).
 * @since 5.4.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_UNESCAPED_UNICODE', 256);
define ('JSON_PARTIAL_OUTPUT_ON_ERROR', 512);

/**
 * Occurs with underflow or with the modes mismatch.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_STATE_MISMATCH', 2);

/**
 * Control character error, possibly incorrectly encoded.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_CTRL_CHAR', 3);

/**
 * Malformed UTF-8 characters, possibly incorrectly encoded. This
 * constant is available as of PHP 5.3.3.
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_UTF8', 5);

/**
 * <p>
 * The object or array passed to <b>json_encode</b> include
 * recursive references and cannot be encoded.
 * If the <b>JSON_PARTIAL_OUTPUT_ON_ERROR</b> option was
 * given, <b>NULL</b> will be encoded in the place of the recursive reference.
 * </p>
 * <p>
 * This constant is available as of PHP 5.5.0.
 * </p>
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_RECURSION', 6);

/**
 * <p>
 * The value passed to <b>json_encode</b> includes either
 * <b>NAN</b>
 * or <b>INF</b>.
 * If the <b>JSON_PARTIAL_OUTPUT_ON_ERROR</b> option was
 * given, 0 will be encoded in the place of these
 * special numbers.
 * </p>
 * <p>
 * This constant is available as of PHP 5.5.0.
 * </p>
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_INF_OR_NAN', 7);

/**
 * <p>
 * A value of an unsupported type was given to
 * <b>json_encode</b>, such as a resource.
 * If the <b>JSON_PARTIAL_OUTPUT_ON_ERROR</b> option was
 * given, <b>NULL</b> will be encoded in the place of the unsupported value.
 * </p>
 * <p>
 * This constant is available as of PHP 5.5.0.
 * </p>
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_UNSUPPORTED_TYPE', 8);

/**
 * No error has occurred.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_NONE', 0);

/**
 * The maximum stack depth has been exceeded.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_DEPTH', 1);

/**
 * Syntax error.
 * @since 5.3.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_ERROR_SYNTAX', 4);
define ('JSON_OBJECT_AS_ARRAY', 1);
define ('JSON_PARSER_NOTSTRICT', 4);

/**
 * Encodes large integers as their original string value.
 * @since 5.4.0
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_BIGINT_AS_STRING', 2);

/**
 * Ensures that float values are always encoded as a float value.
 * @since 5.6.6
 * @link http://php.net/manual/en/json.constants.php
 */
define ('JSON_PRESERVE_ZERO_FRACTION', 1024);

// End of json v.1.3.1
?>
