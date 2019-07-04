<?php

// Start of iconv v.

/**
 * Convert string to requested character encoding
 * @link https://php.net/manual/en/function.iconv.php
 * @param string $in_charset <p>
 * The input charset.
 * </p>
 * @param string $out_charset <p>
 * The output charset.
 * </p>
 * <p>
 * If you append the string //TRANSLIT to
 * <i>out_charset</i> transliteration is activated. This
 * means that when a character can't be represented in the target charset,
 * it can be approximated through one or several similarly looking
 * characters. If you append the string //IGNORE,
 * characters that cannot be represented in the target charset are silently
 * discarded. Otherwise, <i>str</i> is cut from the first
 * illegal character and an <b>E_NOTICE</b> is generated.
 * </p>
 * @param string $str <p>
 * The string to be converted.
 * </p>
 * @return string|false the converted string or <b>FALSE</b> on failure.
 * @since 4.0.5
 * @since 5.0
 */
function iconv ($in_charset, $out_charset, $str) {}

/**
 * Convert character encoding as output buffer handler
 * @link https://php.net/manual/en/function.ob-iconv-handler.php
 * @param string $contents
 * @param int $status
 * @return string See <b>ob_start</b> for information about this handler
 * return values.
 * @since 4.0.5
 * @since 5.0
 */
function ob_iconv_handler ($contents, $status) {}

/**
 * Retrieve internal configuration variables of iconv extension
 * @link https://php.net/manual/en/function.iconv-get-encoding.php
 * @param string $type [optional] <p>
 * The value of the optional <i>type</i> can be:
 * all
 * input_encoding
 * output_encoding
 * internal_encoding
 * </p>
 * @return mixed the current value of the internal configuration variable if
 * successful or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * If <i>type</i> is omitted or set to "all",
 * <b>iconv_get_encoding</b> returns an array that
 * stores all these variables.
 * @since 4.0.5
 * @since 5.0
 */
function iconv_get_encoding ($type = "all") {}

/**
 * Set current setting for character encoding conversion
 * @link https://php.net/manual/en/function.iconv-set-encoding.php
 * @param string $type <p>
 * The value of <i>type</i> can be any one of these:
 * input_encoding
 * output_encoding
 * internal_encoding
 * </p>
 * @param string $charset <p>
 * The character set.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.5
 * @since 5.0
 */
function iconv_set_encoding ($type, $charset) {}

/**
 * Returns the character count of string
 * @link https://php.net/manual/en/function.iconv-strlen.php
 * @param string $str <p>
 * The string.
 * </p>
 * @param string $charset [optional] <p>
 * If <i>charset</i> parameter is omitted,
 * <i>str</i> is assumed to be encoded in
 * iconv.internal_encoding.
 * </p>
 * @return int|false the character count of <i>str</i>, as an integer. False on error.
 * @since 5.0
 */
function iconv_strlen ($str, $charset = 'ini_get("iconv.internal_encoding")') {}

/**
 * Cut out part of a string
 * @link https://php.net/manual/en/function.iconv-substr.php
 * @param string $str <p>
 * The original string.
 * </p>
 * @param int $offset <p>
 * If <i>offset</i> is non-negative,
 * <b>iconv_substr</b> cuts the portion out of
 * <i>str</i> beginning at <i>offset</i>'th
 * character, counting from zero.
 * </p>
 * <p>
 * If <i>offset</i> is negative,
 * <b>iconv_substr</b> cuts out the portion beginning
 * at the position, <i>offset</i> characters
 * away from the end of <i>str</i>.
 * </p>
 * @param int $length [optional] <p>
 * If <i>length</i> is given and is positive, the return
 * value will contain at most <i>length</i> characters
 * of the portion that begins at <i>offset</i>
 * (depending on the length of <i>string</i>).
 * </p>
 * <p>
 * If negative <i>length</i> is passed,
 * <b>iconv_substr</b> cuts the portion out of
 * <i>str</i> from the <i>offset</i>'th
 * character up to the character that is
 * <i>length</i> characters away from the end of the string.
 * In case <i>offset</i> is also negative, the start position
 * is calculated beforehand according to the rule explained above.
 * </p>
 * @param string $charset [optional] <p>
 * If <i>charset</i> parameter is omitted,
 * <i>string</i> are assumed to be encoded in
 * iconv.internal_encoding.
 * </p>
 * <p>
 * Note that <i>offset</i> and <i>length</i>
 * parameters are always deemed to represent offsets that are
 * calculated on the basis of the character set determined by
 * <i>charset</i>, whilst the counterpart
 * <b>substr</b> always takes these for byte offsets.
 * </p>
 * @return string|false the portion of <i>str</i> specified by the
 * <i>offset</i> and <i>length</i> parameters.
 * </p>
 * <p>
 * If <i>str</i> is shorter than <i>offset</i>
 * characters long, <b>FALSE</b> will be returned.
 * @since 5.0
 */
function iconv_substr ($str, $offset, $length = 'iconv_strlen($str, $charset)', $charset = 'ini_get("iconv.internal_encoding")') {}

/**
 * Finds position of first occurrence of a needle within a haystack
 * @link https://php.net/manual/en/function.iconv-strpos.php
 * @param string $haystack <p>
 * The entire string.
 * </p>
 * @param string $needle <p>
 * The searched substring.
 * </p>
 * @param int $offset [optional] <p>
 * The optional <i>offset</i> parameter specifies
 * the position from which the search should be performed.
 * </p>
 * @param string $charset [optional] <p>
 * If <i>charset</i> parameter is omitted,
 * <i>string</i> are assumed to be encoded in
 * iconv.internal_encoding.
 * </p>
 * @return int|false the numeric position of the first occurrence of
 * <i>needle</i> in <i>haystack</i>.
 * </p>
 * <p>
 * If <i>needle</i> is not found,
 * <b>iconv_strpos</b> will return <b>FALSE</b>.
 * @since 5.0
 */
function iconv_strpos ($haystack, $needle, $offset = 0, $charset = 'ini_get("iconv.internal_encoding")') {}

/**
 * Finds the last occurrence of a needle within a haystack
 * @link https://php.net/manual/en/function.iconv-strrpos.php
 * @param string $haystack <p>
 * The entire string.
 * </p>
 * @param string $needle <p>
 * The searched substring.
 * </p>
 * @param string $charset [optional] <p>
 * If <i>charset</i> parameter is omitted,
 * <i>string</i> are assumed to be encoded in
 * iconv.internal_encoding.
 * </p>
 * @return int|false the numeric position of the last occurrence of
 * <i>needle</i> in <i>haystack</i>.
 * </p>
 * <p>
 * If <i>needle</i> is not found,
 * <b>iconv_strrpos</b> will return <b>FALSE</b>.
 * @since 5.0
 */
function iconv_strrpos ($haystack, $needle, $charset = 'ini_get("iconv.internal_encoding")') {}

/**
 * Composes a MIME header field
 * @link https://php.net/manual/en/function.iconv-mime-encode.php
 * @param string $field_name <p>
 * The field name.
 * </p>
 * @param string $field_value <p>
 * The field value.
 * </p>
 * @param array $preferences [optional] <p>
 * You can control the behaviour of <b>iconv_mime_encode</b>
 * by specifying an associative array that contains configuration items
 * to the optional third parameter <i>preferences</i>.
 * The items supported by <b>iconv_mime_encode</b> are
 * listed below. Note that item names are treated case-sensitive.
 * <table>
 * Configuration items supported by <b>iconv_mime_encode</b>
 * <tr valign="top">
 * <td>Item</td>
 * <td>Type</td>
 * <td>Description</td>
 * <td>Default value</td>
 * <td>Example</td>
 * </tr>
 * <tr valign="top">
 * <td>scheme</td>
 * <td>string</td>
 * <td>
 * Specifies the method to encode a field value by. The value of
 * this item may be either "B" or "Q", where "B" stands for
 * base64 encoding scheme and "Q" stands for
 * quoted-printable encoding scheme.
 * </td>
 * <td>B</td>
 * <td>B</td>
 * </tr>
 * <tr valign="top">
 * <td>input-charset</td>
 * <td>string</td>
 * <td>
 * Specifies the character set in which the first parameter
 * <i>field_name</i> and the second parameter
 * <i>field_value</i> are presented. If not given,
 * <b>iconv_mime_encode</b> assumes those parameters
 * are presented to it in the
 * iconv.internal_encoding
 * ini setting.
 * </td>
 * <td>
 * iconv.internal_encoding
 * </td>
 * <td>ISO-8859-1</td>
 * </tr>
 * <tr valign="top">
 * <td>output-charset</td>
 * <td>string</td>
 * <td>
 * Specifies the character set to use to compose the
 * MIME header.
 * </td>
 * <td>
 * iconv.internal_encoding
 * </td>
 * <td>UTF-8</td>
 * </tr>
 * <tr valign="top">
 * <td>line-length</td>
 * <td>integer</td>
 * <td>
 * Specifies the maximum length of the header lines. The resulting
 * header is "folded" to a set of multiple lines in case
 * the resulting header field would be longer than the value of this
 * parameter, according to
 * RFC2822 - Internet Message Format.
 * If not given, the length will be limited to 76 characters.
 * </td>
 * <td>76</td>
 * <td>996</td>
 * </tr>
 * <tr valign="top">
 * <td>line-break-chars</td>
 * <td>string</td>
 * <td>
 * Specifies the sequence of characters to append to each line
 * as an end-of-line sign when "folding" is performed on a long header
 * field. If not given, this defaults to "\r\n"
 * (CR LF). Note that
 * this parameter is always treated as an ASCII string regardless
 * of the value of input-charset.
 * </td>
 * <td>\r\n</td>
 * <td>\n</td>
 * </tr>
 * </table>
 * </p>
 * @return string|false an encoded MIME field on success,
 * or <b>FALSE</b> if an error occurs during the encoding.
 * @since 5.0
 */
function iconv_mime_encode ($field_name, $field_value, array $preferences = null) {}

/**
 * Decodes a MIME header field
 * @link https://php.net/manual/en/function.iconv-mime-decode.php
 * @param string $encoded_header <p>
 * The encoded header, as a string.
 * </p>
 * @param int $mode [optional] <p>
 * <i>mode</i> determines the behaviour in the event
 * <b>iconv_mime_decode</b> encounters a malformed
 * MIME header field. You can specify any combination
 * of the following bitmasks.
 * <table>
 * Bitmasks acceptable to <b>iconv_mime_decode</b>
 * <tr valign="top">
 * <td>Value</td>
 * <td>Constant</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>ICONV_MIME_DECODE_STRICT</td>
 * <td>
 * If set, the given header is decoded in full conformance with the
 * standards defined in RFC2047.
 * This option is disabled by default because there are a lot of
 * broken mail user agents that don't follow the specification and don't
 * produce correct MIME headers.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>ICONV_MIME_DECODE_CONTINUE_ON_ERROR</td>
 * <td>
 * If set, <b>iconv_mime_decode_headers</b>
 * attempts to ignore any grammatical errors and continue to process
 * a given header.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param string $charset [optional] <p>
 * The optional <i>charset</i> parameter specifies the
 * character set to represent the result by. If omitted,
 * iconv.internal_encoding
 * will be used.
 * </p>
 * @return string|false a decoded MIME field on success,
 * or <b>FALSE</b> if an error occurs during the decoding.
 * @since 5.0
 */
function iconv_mime_decode ($encoded_header, $mode = 0, $charset = 'ini_get("iconv.internal_encoding")') {}

/**
 * Decodes multiple MIME header fields at once
 * @link https://php.net/manual/en/function.iconv-mime-decode-headers.php
 * @param string $encoded_headers <p>
 * The encoded headers, as a string.
 * </p>
 * @param int $mode [optional] <p>
 * <i>mode</i> determines the behaviour in the event
 * <b>iconv_mime_decode_headers</b> encounters a malformed
 * MIME header field. You can specify any combination
 * of the following bitmasks.
 * <table>
 * Bitmasks acceptable to <b>iconv_mime_decode_headers</b>
 * <tr valign="top">
 * <td>Value</td>
 * <td>Constant</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>ICONV_MIME_DECODE_STRICT</td>
 * <td>
 * If set, the given header is decoded in full conformance with the
 * standards defined in RFC2047.
 * This option is disabled by default because there are a lot of
 * broken mail user agents that don't follow the specification and don't
 * produce correct MIME headers.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>ICONV_MIME_DECODE_CONTINUE_ON_ERROR</td>
 * <td>
 * If set, <b>iconv_mime_decode_headers</b>
 * attempts to ignore any grammatical errors and continue to process
 * a given header.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param string $charset [optional] <p>
 * The optional <i>charset</i> parameter specifies the
 * character set to represent the result by. If omitted,
 * iconv.internal_encoding
 * will be used.
 * </p>
 * @return array|false an associative array that holds a whole set of
 * MIME header fields specified by
 * <i>encoded_headers</i> on success, or <b>FALSE</b>
 * if an error occurs during the decoding.
 * </p>
 * <p>
 * Each key of the return value represents an individual
 * field name and the corresponding element represents a field value.
 * If more than one field of the same name are present,
 * <b>iconv_mime_decode_headers</b> automatically incorporates
 * them into a numerically indexed array in the order of occurrence.
 * @since 5.0
 */
function iconv_mime_decode_headers ($encoded_headers, $mode = 0, $charset = 'ini_get("iconv.internal_encoding")') {}


/**
 * string
 * @link https://php.net/manual/en/iconv.constants.php
 */
define ('ICONV_IMPL', "glibc");

/**
 * string
 * @link https://php.net/manual/en/iconv.constants.php
 */
define ('ICONV_VERSION', 2.17);

/**
 * integer
 * @link https://php.net/manual/en/iconv.constants.php
 */
define ('ICONV_MIME_DECODE_STRICT', 1);

/**
 * integer
 * @link https://php.net/manual/en/iconv.constants.php
 */
define ('ICONV_MIME_DECODE_CONTINUE_ON_ERROR', 2);

// End of iconv v.
?>
