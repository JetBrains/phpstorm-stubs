<?php
/**
 * PHPStorm stub file for JavaScript Object Notation(JSON) constants.
 *
 * @link http://php.net/manual/en/json.constants.php
 */

/**
 * Encodes large integers as their original string value.
 *
 * @since 5.4.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_BIGINT_AS_STRING = 2;
/**
 * Control character error, possibly incorrectly encoded.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_CTRL_CHAR = 3;
/**
 * The maximum stack depth has been exceeded.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_DEPTH = 1;
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
 *
 * @link http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_INF_OR_NAN = 7;
/**
 * No error has occurred.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_NONE = 0;
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
 *
 * @link http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_RECURSION = 6;
/**
 * Occurs with underflow or with the modes mismatch.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_STATE_MISMATCH = 2;
/**
 * Syntax error.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_SYNTAX = 4;
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
 *
 * @link http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_UNSUPPORTED_TYPE = 8;
/**
 * Malformed UTF-8 characters, possibly incorrectly encoded. This
 * constant is available as of PHP 5.3.3.
 *
 * @link http://php.net/manual/en/json.constants.php
 */
const JSON_ERROR_UTF8 = 5;
/**
 * Outputs an object rather than an array when a non-associative array is
 * used. Especially useful when the recipient of the output is expecting
 * an object and the array is empty.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_FORCE_OBJECT = 16;
/**
 * All &#38;#38;s are converted to \u0026.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_HEX_AMP = 2;
/**
 * All ' are converted to \u0027.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_HEX_APOS = 4;
/**
 * All " are converted to \u0022.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_HEX_QUOT = 8;
/**
 * All &lt; and &gt; are converted to \u003C and \u003E.
 *
 * @since 5.3.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_HEX_TAG = 1;
/**
 * Encodes numeric strings as numbers.
 *
 * @since 5.3.3
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_NUMERIC_CHECK = 32;
const JSON_OBJECT_AS_ARRAY = 1;
const JSON_PARSER_NOTSTRICT = 4;
const JSON_PARTIAL_OUTPUT_ON_ERROR = 512;
/**
 * Ensures that float values are always encoded as a float value.
 *
 * @since 5.6.6
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_PRESERVE_ZERO_FRACTION = 1024;
/**
 * Use whitespace in returned data to format it.
 *
 * @since 5.4.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_PRETTY_PRINT = 128;
/**
 * The line terminators are kept unescaped when JSON_UNESCAPED_UNICODE is supplied.
 * It uses the same behaviour as it was before PHP 7.1 without this constant. Available since PHP 7.1.0.
 *
 * @link  http://php.net/manual/en/json.constants.php
 * @since 7.1
 */
const JSON_UNESCAPED_LINE_TERMINATORS = 2048;
/**
 * Don't escape /.
 *
 * @since 5.4.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_UNESCAPED_SLASHES = 64;
/**
 * Encode multibyte Unicode characters literally (default is to escape as \uXXXX).
 *
 * @since 5.4.0
 * @link  http://php.net/manual/en/json.constants.php
 */
const JSON_UNESCAPED_UNICODE = 256;
