<?php

// Start of mbstring v.

/**
 * Perform case folding on a string
 * @link https://php.net/manual/en/function.mb-convert-case.php
 * @param string $str <p>
 * The string being converted.
 * </p>
 * @param int $mode <p>
 * The mode of the conversion. It can be one of 
 * MB_CASE_UPPER, 
 * MB_CASE_LOWER, or 
 * MB_CASE_TITLE.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return string A case folded version of string converted in the
 * way specified by mode.
 * @since 4.3
 * @since 5.0
 */
function mb_convert_case ($str, $mode, $encoding = null) {}

/**
 * Make a string uppercase
 * @link https://php.net/manual/en/function.mb-strtoupper.php
 * @param string $str <p>
 * The string being uppercased.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return string str with all alphabetic characters converted to uppercase.
 * @since 4.3
 * @since 5.0
 */
function mb_strtoupper ($str, $encoding = null) {}

/**
 * Make a string lowercase
 * @link https://php.net/manual/en/function.mb-strtolower.php
 * @param string $str <p>
 * The string being lowercased.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return string str with all alphabetic characters converted to lowercase.
 * @since 4.3
 * @since 5.0
 */
function mb_strtolower ($str, $encoding = null) {}

/**
 * Set/Get current language
 * @link https://php.net/manual/en/function.mb-language.php
 * @param string $language [optional] <p>
 * Used for encoding
 * e-mail messages. Valid languages are "Japanese",
 * "ja","English","en" and "uni"
 * (UTF-8). mb_send_mail uses this setting to
 * encode e-mail.
 * </p>
 * <p> 
 * Language and its setting is ISO-2022-JP/Base64 for
 * Japanese, UTF-8/Base64 for uni, ISO-8859-1/quoted printable for
 * English.
 * </p>
 * @return bool|string If language is set and
 * language is valid, it returns
 * true. Otherwise, it returns false. 
 * When language is omitted, it returns the language
 * name as a string. If no language is set previously, it then returns
 * false.
 * @since 4.0.6
 * @since 5.0
 */
function mb_language ($language = null) {}

/**
 * Set/Get internal character encoding
 * @link https://php.net/manual/en/function.mb-internal-encoding.php
 * @param string $encoding [optional] <p>
 * encoding is the character encoding name 
 * used for the HTTP input character encoding conversion, HTTP output 
 * character encoding conversion, and the default character encoding 
 * for string functions defined by the mbstring module.
 * </p>
 * @return bool|string If encoding is set, then
 * true on success or false on failure.
 * If encoding is omitted, then 
 * the current character encoding name is returned.
 * @since 4.0.6
 * @since 5.0
 */
function mb_internal_encoding ($encoding = null) {}

/**
 * Detect HTTP input character encoding
 * @link https://php.net/manual/en/function.mb-http-input.php
 * @param string $type [optional] <p>
 * Input string specifies the input type. 
 * "G" for GET, "P" for POST, "C" for COOKIE, "S" for string, "L" for list, and
 * "I" for the whole list (will return array). 
 * If type is omitted, it returns the last input type processed. 
 * </p>
 * @return false|string The character encoding name, as per the type.
 * If mb_http_input does not process specified
 * HTTP input, it returns false.
 * @since 4.0.6
 * @since 5.0
 */
function mb_http_input ($type = null) {}

/**
 * Set/Get HTTP output character encoding
 * @link https://php.net/manual/en/function.mb-http-output.php
 * @param string $encoding [optional] <p>
 * If encoding is set,
 * mb_http_output sets the HTTP output character
 * encoding to encoding.
 * </p>
 * <p>
 * If encoding is omitted,
 * mb_http_output returns the current HTTP output
 * character encoding.
 * </p>
 * @return bool|string If encoding is omitted,
 * mb_http_output returns the current HTTP output
 * character encoding. Otherwise, 
 * true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function mb_http_output ($encoding = null) {}

/**
 * Set/Get character encoding detection order
 * @link https://php.net/manual/en/function.mb-detect-order.php
 * @param mixed $encoding_list [optional] <p>
 * encoding_list is an array or 
 * comma separated list of character encoding. ("auto" is expanded to
 * "ASCII, JIS, UTF-8, EUC-JP, SJIS")
 * </p>
 * <p>
 * If encoding_list is omitted, it returns
 * the current character encoding detection order as array.
 * </p>
 * <p>
 * This setting affects mb_detect_encoding and
 * mb_send_mail.
 * </p>
 * <p>
 * mbstring currently implements the following
 * encoding detection filters. If there is an invalid byte sequence
 * for the following encodings, encoding detection will fail.
 * </p>
 * UTF-8, UTF-7,
 * ASCII,
 * EUC-JP,SJIS,
 * eucJP-win, SJIS-win,
 * JIS, ISO-2022-JP 
 * <p>
 * For ISO-8859-*, mbstring
 * always detects as ISO-8859-*.
 * </p>
 * <p>
 * For UTF-16, UTF-32,
 * UCS2 and UCS4, encoding
 * detection will fail always.
 * </p>
 * <p>
 * Useless detect order example
 * </p>
 * @return bool|string[] When setting the encoding detection order,
 * true is returned on success or FALSE on failure.
 * When getting the encoding detection order, an ordered array
 * of the encodings is returned.
 * @since 4.0.6
 * @since 5.0
 */
function mb_detect_order ($encoding_list = null) {}

/**
 * Set/Get substitution character
 * @link https://php.net/manual/en/function.mb-substitute-character.php
 * @param int|string $substrchar [optional] <p>
 * Specify the Unicode value as an integer,
 * or as one of the following strings:<ul>
 * <li>"none" : no output
 * <li>"long": Output character code value (Example: U+3000, JIS+7E7E)
 * <li>"entity": Output character entity (Example: Ȁ)
 * @return bool|int|string If substchar is set, it returns true for success,
 * otherwise returns false.
 * If substchar is not set, it returns the Unicode value,
 * or "none" or "long".
 * @since 4.0.6
 * @since 5.0
 */
function mb_substitute_character ($substrchar = null) {}

/**
 * Parse GET/POST/COOKIE data and set global variable
 * @link https://php.net/manual/en/function.mb-parse-str.php
 * @param string $encoded_string <p>
 * The URL encoded data.
 * </p>
 * @param array $result [optional] <p>
 * An array containing decoded and character encoded converted values.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function mb_parse_str ($encoded_string, array &$result = null) {}

/**
 * Callback function converts character encoding in output buffer
 * @link https://php.net/manual/en/function.mb-output-handler.php
 * @param string $contents <p>
 * The contents of the output buffer.
 * </p>
 * @param int $status <p>
 * The status of the output buffer.
 * </p>
 * @return string The converted string.
 * @since 4.0.6
 * @since 5.0
 */
function mb_output_handler ($contents, $status) {}

/**
 * Get MIME charset string
 * @link https://php.net/manual/en/function.mb-preferred-mime-name.php
 * @param string $encoding <p>
 * The encoding being checked.
 * </p>
 * @return string The MIME charset string for character encoding
 * encoding.
 * @since 4.0.6
 * @since 5.0
 */
function mb_preferred_mime_name ($encoding) {}

/**
 * Get string length
 * @link https://php.net/manual/en/function.mb-strlen.php
 * @param string $str <p>
 * The string being checked for length.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return int the number of characters in
 * string str having character encoding
 * encoding. A multi-byte character is
 * counted as 1.
 * @since 4.0.6
 * @since 5.0
 */
function mb_strlen ($str, $encoding = null) {}

/**
 * Find position of first occurrence of string in a string
 * @link https://php.net/manual/en/function.mb-strpos.php
 * @param string $haystack <p>
 * The string being checked.
 * </p>
 * @param string $needle <p>
 * The position counted from the beginning of haystack.
 * </p>
 * @param int $offset [optional] <p>
 * The search offset. If it is not specified, 0 is used.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return int|false the numeric position of
 * the first occurrence of needle in the
 * haystack string. If
 * needle is not found, it returns false.
 * @since 4.0.6
 * @since 5.0
 */
function mb_strpos ($haystack, $needle, $offset = 0, $encoding = null) {}

/**
 * Find position of last occurrence of a string in a string
 * @link https://php.net/manual/en/function.mb-strrpos.php
 * @param string $haystack <p>
 * The string being checked, for the last occurrence
 * of needle
 * </p>
 * @param string $needle <p>
 * The string to find in haystack.
 * </p>
 * @param int $offset [optional] May be specified to begin searching an arbitrary number of characters into
 * the string. Negative values will stop searching at an arbitrary point
 * prior to the end of the string.
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return int|false the numeric position of
 * the last occurrence of needle in the
 * haystack string. If
 * needle is not found, it returns false.
 * @since 4.0.6
 * @since 5.0
 */
function mb_strrpos ($haystack, $needle, $offset = 0, $encoding = null) {}

/**
 * Finds position of first occurrence of a string within another, case insensitive
 * @link https://php.net/manual/en/function.mb-stripos.php
 * @param string $haystack <p>
 * The string from which to get the position of the first occurrence
 * of needle
 * </p>
 * @param string $needle <p>
 * The string to find in haystack
 * </p>
 * @param int $offset [optional] <p>
 * The position in haystack
 * to start searching
 * </p>
 * @param string $encoding [optional] <p>
 * Character encoding name to use.
 * If it is omitted, internal character encoding is used.
 * </p>
 * @return int|false Return the numeric position of the first occurrence of
 * needle in the haystack
 * string, or false if needle is not found.
 * @since 5.2
 */
function mb_stripos ($haystack, $needle, $offset = 0, $encoding = null) {}

/**
 * Finds position of last occurrence of a string within another, case insensitive
 * @link https://php.net/manual/en/function.mb-strripos.php
 * @param string $haystack <p>
 * The string from which to get the position of the last occurrence
 * of needle
 * </p>
 * @param string $needle <p>
 * The string to find in haystack
 * </p>
 * @param int $offset [optional] <p>
 * The position in haystack
 * to start searching
 * </p>
 * @param string $encoding [optional] <p>
 * Character encoding name to use.
 * If it is omitted, internal character encoding is used.
 * </p>
 * @return int|false Return the numeric position of
 * the last occurrence of needle in the
 * haystack string, or false
 * if needle is not found.
 * @since 5.2
 */
function mb_strripos ($haystack, $needle, $offset = 0, $encoding = null) {}

/**
 * Finds first occurrence of a string within another
 * @link https://php.net/manual/en/function.mb-strstr.php
 * @param string $haystack <p>
 * The string from which to get the first occurrence
 * of needle
 * </p>
 * @param string $needle <p>
 * The string to find in haystack
 * </p>
 * @param bool $before_needle [optional] <p>
 * Determines which portion of haystack
 * this function returns. 
 * If set to true, it returns all of haystack
 * from the beginning to the first occurrence of needle.
 * If set to false, it returns all of haystack
 * from the first occurrence of needle to the end,
 * </p>
 * @param string $encoding [optional] <p>
 * Character encoding name to use.
 * If it is omitted, internal character encoding is used.
 * </p>
 * @return string|false the portion of haystack,
 * or false if needle is not found.
 * @since 5.2
 */
function mb_strstr ($haystack, $needle, $before_needle = false, $encoding = null) {}

/**
 * Finds the last occurrence of a character in a string within another
 * @link https://php.net/manual/en/function.mb-strrchr.php
 * @param string $haystack <p>
 * The string from which to get the last occurrence
 * of needle
 * </p>
 * @param string $needle <p>
 * The string to find in haystack
 * </p>
 * @param bool $before_needle [optional] <p>
 * Determines which portion of haystack
 * this function returns. 
 * If set to true, it returns all of haystack
 * from the beginning to the last occurrence of needle.
 * If set to false, it returns all of haystack
 * from the last occurrence of needle to the end,
 * </p>
 * @param string $encoding [optional] <p>
 * Character encoding name to use.
 * If it is omitted, internal character encoding is used.
 * </p>
 * @return string|false the portion of haystack.
 * or false if needle is not found.
 * @since 5.2
 */
function mb_strrchr ($haystack, $needle, $before_needle = false, $encoding = null) {}

/**
 * Finds first occurrence of a string within another, case insensitive
 * @link https://php.net/manual/en/function.mb-stristr.php
 * @param string $haystack <p>
 * The string from which to get the first occurrence
 * of needle
 * </p>
 * @param string $needle <p>
 * The string to find in haystack
 * </p>
 * @param bool $before_needle [optional] <p>
 * Determines which portion of haystack
 * this function returns.
 * If set to true, it returns all of haystack
 * from the beginning to the first occurrence of needle.
 * If set to false, it returns all of haystack
 * from the first occurrence of needle to the end,
 * </p>
 * @param string $encoding [optional] <p>
 * Character encoding name to use.
 * If it is omitted, internal character encoding is used.
 * </p>
 * @return string|false the portion of haystack,
 * or false if needle is not found.
 * @since 5.2
 */
function mb_stristr ($haystack, $needle, $before_needle = false, $encoding = null) {}

/**
 * Finds the last occurrence of a character in a string within another, case insensitive
 * @link https://php.net/manual/en/function.mb-strrichr.php
 * @param string $haystack <p>
 * The string from which to get the last occurrence
 * of needle
 * </p>
 * @param string $needle <p>
 * The string to find in haystack
 * </p>
 * @param bool $before_needle [optional] <p>
 * Determines which portion of haystack
 * this function returns. 
 * If set to true, it returns all of haystack
 * from the beginning to the last occurrence of needle.
 * If set to false, it returns all of haystack
 * from the last occurrence of needle to the end,
 * </p>
 * @param string $encoding [optional] <p>
 * Character encoding name to use.
 * If it is omitted, internal character encoding is used.
 * </p>
 * @return string|false the portion of haystack.
 * or false if needle is not found.
 * @since 5.2
 */
function mb_strrichr ($haystack, $needle, $before_needle = false, $encoding = null) {}

/**
 * Count the number of substring occurrences
 * @link https://php.net/manual/en/function.mb-substr-count.php
 * @param string $haystack <p>
 * The string being checked.
 * </p>
 * @param string $needle <p>
 * The string being found.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return int The number of times the
 * needle substring occurs in the
 * haystack string.
 * @since 4.3
 * @since 5.0
 */
function mb_substr_count ($haystack, $needle, $encoding = null) {}

/**
 * Get part of string
 * @link https://php.net/manual/en/function.mb-substr.php
 * @param string $str <p>
 * The string being checked.
 * </p>
 * @param int $start <p>
 * The first position used in str.
 * </p>
 * @param int $length [optional] <p>
 * The maximum length of the returned string.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return string mb_substr returns the portion of
 * str specified by the
 * start and
 * length parameters.
 * @since 4.0.6
 * @since 5.0
 */
function mb_substr ($str, $start, $length = null, $encoding = null) {}

/**
 * Get part of string
 * @link https://php.net/manual/en/function.mb-strcut.php
 * @param string $str <p>
 * The string being cut.
 * </p>
 * @param int $start <p>
 * The position that begins the cut.
 * </p>
 * @param int $length [optional] <p>
 * The string being decoded.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return string mb_strcut returns the portion of
 * str specified by the
 * start and
 * length parameters.
 * @since 4.0.6
 * @since 5.0
 */
function mb_strcut ($str, $start, $length = null, $encoding = null) {}

/**
 * Return width of string
 * @link https://php.net/manual/en/function.mb-strwidth.php
 * @param string $str <p>
 * The string being decoded.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return int The width of string str.
 * @since 4.0.6
 * @since 5.0
 */
function mb_strwidth ($str, $encoding = null) {}

/**
 * Get truncated string with specified width
 * @link https://php.net/manual/en/function.mb-strimwidth.php
 * @param string $str <p>
 * The string being decoded.
 * </p>
 * @param int $start <p>
 * The start position offset. Number of
 * characters from the beginning of string. (First character is 0)
 * </p>
 * @param int $width <p>
 * The width of the desired trim.
 * </p>
 * @param string $trimmarker [optional] <p>
 * A string that is added to the end of string 
 * when string is truncated.
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return string The truncated string. If trimmarker is set,
 * trimmarker is appended to the return value.
 * @since 4.0.6
 * @since 5.0
 */
function mb_strimwidth ($str, $start, $width, $trimmarker = null, $encoding = null) {}

/**
 * Convert character encoding
 * @link https://php.net/manual/en/function.mb-convert-encoding.php
 * @param string|array $str <p>
 * The string being encoded.
 * </p>
 * @param string $to_encoding <p>
 * The type of encoding that str is being converted to.
 * </p>
 * @param string|string[] $from_encoding [optional] <p>
 * Is specified by character code names before conversion. It is either
 * an array, or a comma separated enumerated list.
 * If from_encoding is not specified, the internal 
 * encoding will be used.
 * </p>
 * <p>
 * "auto" may be used, which expands to 
 * "ASCII,JIS,UTF-8,EUC-JP,SJIS".
 * </p>
 * @return string The encoded string.
 * @since 4.0.6
 * @since 5.0
 */
function mb_convert_encoding ($str, $to_encoding, $from_encoding = null) {}

/**
 * Detect character encoding
 * @link https://php.net/manual/en/function.mb-detect-encoding.php
 * @param string $str <p>
 * The string being detected.
 * </p>
 * @param string|string[] $encoding_list [optional] <p>
 * encoding_list is list of character
 * encoding. Encoding order may be specified by array or comma
 * separated list string.
 * </p>
 * <p>
 * If encoding_list is omitted,
 * detect_order is used.
 * </p>
 * @param bool $strict [optional] <p>
 * strict specifies whether to use
 * the strict encoding detection or not.
 * Default is false.
 * </p>
 * @return string|false The detected character encoding or false if the encoding cannot be
 * detected from the given string.
 * @since 4.0.6
 * @since 5.0
 */
function mb_detect_encoding ($str, $encoding_list = null, $strict = false) {}

/**
 * Returns an array of all supported encodings
 * @link https://php.net/manual/en/function.mb-list-encodings.php
 * @return string[] a numerically indexed array.
 * @since 5.0
 */
function mb_list_encodings () {}

/**
 * Get aliases of a known encoding type
 * @param string $encoding The encoding type being checked, for aliases.
 * @return string[]|false a numerically indexed array of encoding aliases on success, or FALSE on failure
 * @link https://php.net/manual/en/function.mb-encoding-aliases.php
 * @since 5.3
 */
function mb_encoding_aliases ($encoding) {}

/**
 * Convert "kana" one from another ("zen-kaku", "han-kaku" and more)
 * @link https://php.net/manual/en/function.mb-convert-kana.php
 * @param string $str <p>
 * The string being converted.
 * </p>
 * @param string $option [optional] <p>
 * The conversion option.
 * </p>
 * <p>
 * Specify with a combination of following options.
 * <table>
 * Applicable Conversion Options
 * <tr valign="top">
 * <td>Option</td>
 * <td>Meaning</td>
 * </tr>
 * <tr valign="top">
 * <td>r</td>
 * <td>
 * Convert "zen-kaku" alphabets to "han-kaku"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>R</td>
 * <td>
 * Convert "han-kaku" alphabets to "zen-kaku"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>n</td>
 * <td>
 * Convert "zen-kaku" numbers to "han-kaku"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>N</td>
 * <td>
 * Convert "han-kaku" numbers to "zen-kaku"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>a</td>
 * <td>
 * Convert "zen-kaku" alphabets and numbers to "han-kaku"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>A</td>
 * <td>
 * Convert "han-kaku" alphabets and numbers to "zen-kaku"
 * (Characters included in "a", "A" options are
 * U+0021 - U+007E excluding U+0022, U+0027, U+005C, U+007E)
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>s</td>
 * <td>
 * Convert "zen-kaku" space to "han-kaku" (U+3000 -> U+0020)
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>S</td>
 * <td>
 * Convert "han-kaku" space to "zen-kaku" (U+0020 -> U+3000)
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>k</td>
 * <td>
 * Convert "zen-kaku kata-kana" to "han-kaku kata-kana"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>K</td>
 * <td>
 * Convert "han-kaku kata-kana" to "zen-kaku kata-kana"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>h</td>
 * <td>
 * Convert "zen-kaku hira-gana" to "han-kaku kata-kana"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>H</td>
 * <td>
 * Convert "han-kaku kata-kana" to "zen-kaku hira-gana"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>c</td>
 * <td>
 * Convert "zen-kaku kata-kana" to "zen-kaku hira-gana"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>C</td>
 * <td>
 * Convert "zen-kaku hira-gana" to "zen-kaku kata-kana"
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>V</td>
 * <td>
 * Collapse voiced sound notation and convert them into a character. Use with "K","H"
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return string The converted string.
 * @since 4.0.6
 * @since 5.0
 */
function mb_convert_kana ($str, $option = null, $encoding = null) {}

/**
 * Encode string for MIME header
 * @link https://php.net/manual/en/function.mb-encode-mimeheader.php
 * @param string $str <p>
 * The string being encoded.
 * </p>
 * @param string $charset [optional] <p>
 * charset specifies the name of the character set
 * in which str is represented in. The default value
 * is determined by the current NLS setting (mbstring.language).
 * mb_internal_encoding should be set to same encoding.
 * </p>
 * @param string $transfer_encoding [optional] <p>
 * transfer_encoding specifies the scheme of MIME
 * encoding. It should be either "B" (Base64) or
 * "Q" (Quoted-Printable). Falls back to
 * "B" if not given.
 * </p>
 * @param string $linefeed [optional] <p>
 * linefeed specifies the EOL (end-of-line) marker
 * with which mb_encode_mimeheader performs
 * line-folding (a RFC term,
 * the act of breaking a line longer than a certain length into multiple
 * lines. The length is currently hard-coded to 74 characters).
 * Falls back to "\r\n" (CRLF) if not given.
 * </p>
 * @param int $indent [optional] <p>
 * Indentation of the first line (number of characters in the header
 * before str).
 * </p>
 * @return string A converted version of the string represented in ASCII.
 * @since 4.0.6
 * @since 5.0
 */
function mb_encode_mimeheader ($str, $charset = null, $transfer_encoding = null, $linefeed = null, $indent = null) {}

/**
 * Decode string in MIME header field
 * @link https://php.net/manual/en/function.mb-decode-mimeheader.php
 * @param string $str <p>
 * The string being decoded.
 * </p>
 * @return string The decoded string in internal character encoding.
 * @since 4.0.6
 * @since 5.0
 */
function mb_decode_mimeheader ($str) {}

/**
 * Convert character code in variable(s)
 * @link https://php.net/manual/en/function.mb-convert-variables.php
 * @param string $to_encoding <p>
 * The encoding that the string is being converted to.
 * </p>
 * @param string|string[] $from_encoding <p>
 * from_encoding is specified as an array
 * or comma separated string, it tries to detect encoding from
 * from-coding. When from_encoding 
 * is omitted, detect_order is used.
 * </p>
 * @param string|array|object $vars <p>
 * vars is the reference to the
 * variable being converted. String, Array and Object are accepted.
 * mb_convert_variables assumes all parameters
 * have the same encoding.
 * </p>
 * @return string|false The character encoding before conversion for success,
 * or false for failure.
 * @since 4.0.6
 * @since 5.0
 */
function mb_convert_variables ($to_encoding, $from_encoding, &...$vars) {}

/**
 * Encode character to HTML numeric string reference
 * @link https://php.net/manual/en/function.mb-encode-numericentity.php
 * @param string $str <p>
 * The string being encoded.
 * </p>
 * @param int[] $convmap <p>
 * convmap is array specifies code area to
 * convert.
 * </p>
 * @param string $encoding &mbstring.encoding.parameter;
 * @param bool $is_hex [optional]
 * @return string|false|null The converted string.
 * @since 4.0.6
 * @since 5.0
 */
function mb_encode_numericentity ($str, array $convmap, $encoding = null, $is_hex = false) {}

/**
 * Decode HTML numeric string reference to character
 * @link https://php.net/manual/en/function.mb-decode-numericentity.php
 * @param string $str <p>
 * The string being decoded.
 * </p>
 * @param int[] $convmap <p>
 * convmap is an array that specifies
 * the code area to convert.
 * </p>
 * @param string $encoding &mbstring.encoding.parameter;
 * @param bool $is_hex [optional] <p>
 * this parameter is not used.
 * </p>
 * @return string|false|null The converted string.
 * @since 4.0.6
 * @since 5.0
 */
function mb_decode_numericentity ($str, array $convmap, $encoding = null, $is_hex = false) {}

/**
 * Send encoded mail
 * @link https://php.net/manual/en/function.mb-send-mail.php
 * @param string $to <p>
 * The mail addresses being sent to. Multiple
 * recipients may be specified by putting a comma between each
 * address in to.
 * This parameter is not automatically encoded.
 * </p>
 * @param string $subject <p>
 * The subject of the mail.
 * </p>
 * @param string $message <p>
 * The message of the mail.
 * </p>
 * @param string|array $additional_headers [optional] <p>
 * String or array to be inserted at the end of the email header. <br/>
 * Since 7.2.0 accepts an array. Its keys are the header names and its values are the respective header values.<br/>
 * This is typically used to add extra
 * headers. Multiple extra headers are separated with a
 * newline ("\n").
 * </p>
 * @param string $additional_parameter [optional] <p>
 * additional_parameter is a MTA command line
 * parameter. It is useful when setting the correct Return-Path
 * header when using sendmail.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function mb_send_mail ($to, $subject, $message, $additional_headers = null, $additional_parameter = null) {}

/**
 * Get internal settings of mbstring
 * @link https://php.net/manual/en/function.mb-get-info.php
 * @param string $type [optional] <p>
 * If type isn't specified or is specified to
 * "all", an array having the elements "internal_encoding",
 * "http_output", "http_input", "func_overload", "mail_charset",
 * "mail_header_encoding", "mail_body_encoding" will be returned. 
 * </p>
 * <p>
 * If type is specified as "http_output",
 * "http_input", "internal_encoding", "func_overload",
 * the specified setting parameter will be returned.
 * </p>
 * @return array|mixed An array of type information if type
 * is not specified, otherwise a specific type.
 * @since 4.2
 * @since 5.0
 */
function mb_get_info ($type = null) {}

/**
 * Check if the string is valid for the specified encoding
 * @link https://php.net/manual/en/function.mb-check-encoding.php
 * @param string|array $var [optional] <p>
 * The byte stream to check. If it is omitted, this function checks
 * all the input from the beginning of the request.
 * </p>
 * @param string $encoding [optional] <p>
 * The expected encoding.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.4.3
 * @since 5.1.3
 */
function mb_check_encoding ($var = null, $encoding = null) {}

/**
 * Returns current encoding for multibyte regex as string
 * @link https://php.net/manual/en/function.mb-regex-encoding.php
 * @param string $encoding [optional] &mbstring.encoding.parameter;
 * @return bool|string If encoding is set, then Returns TRUE on success
 * or FALSE on failure. In this case, the internal character encoding
 * is NOT changed. If encoding is omitted, then the current character
 * encoding name for a multibyte regex is returned.
 * @since 4.2
 * @since 5.0
 */
function mb_regex_encoding ($encoding = null) {}

/**
 * Set/Get the default options for mbregex functions
 * @link https://php.net/manual/en/function.mb-regex-set-options.php
 * @param string $options [optional] <p>
 * The options to set.
 * </p>
 * @return string The previous options. If options is omitted, 
 * it returns the string that describes the current options.
 * @since 4.3
 * @since 5.0
 */
function mb_regex_set_options ($options = null) {}

/**
 * Regular expression match with multibyte support
 * @link https://php.net/manual/en/function.mb-ereg.php
 * @param string $pattern <p>
 * The search pattern.
 * </p>
 * @param string $string <p>
 * The search string.
 * </p>
 * @param string[] $regs [optional] <p>
 * Contains a substring of the matched string.
 * </p>
 * @return int 
 * @since 4.2
 * @since 5.0
 */
function mb_ereg ($pattern, $string, array &$regs = null) {}

/**
 * Regular expression match ignoring case with multibyte support
 * @link https://php.net/manual/en/function.mb-eregi.php
 * @param string $pattern <p>
 * The regular expression pattern.
 * </p>
 * @param string $string <p>
 * The string being searched.
 * </p>
 * @param string[] $regs [optional] <p>
 * Contains a substring of the matched string.
 * </p>
 * @return int 
 * @since 4.2
 * @since 5.0
 */
function mb_eregi ($pattern, $string, array &$regs = null) {}

/**
 * Replace regular expression with multibyte support
 * @link https://php.net/manual/en/function.mb-ereg-replace.php
 * @param string $pattern <p>
 * The regular expression pattern.
 * </p>
 * <p>
 * Multibyte characters may be used in pattern.
 * </p>
 * @param string $replacement <p>
 * The replacement text.
 * </p>
 * @param string $string <p>
 * The string being checked.
 * </p>
 * @param string $option [optional] Matching condition can be set by option
 * parameter. If i is specified for this
 * parameter, the case will be ignored. If x is
 * specified, white space will be ignored. If m
 * is specified, match will be executed in multiline mode and line
 * break will be included in '.'. If p is
 * specified, match will be executed in POSIX mode, line break 
 * will be considered as normal character. If e
 * is specified, replacement string will be
 * evaluated as PHP expression.
 * <p>PHP 7.1: The <i>e</i> modifier has been deprecated.</p>
 * @return string|false The resultant string on success, or false on error.
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_replace ($pattern, $replacement, $string, $option = "msr") {}

/**
 * Perform a regular expresssion seach and replace with multibyte support using a callback
 * @link https://secure.php.net/manual/en/function.mb-ereg-replace-callback.php
 * @param string $pattern <p>
 * The regular expression pattern.
 * </p>
 * <p>
 * Multibyte characters may be used in <b>pattern</b>.
 * </p>
 * @param callable $callback <p>
 * A callback that will be called and passed an array of matched elements
 * in the  <b>subject</b> string. The callback should
 * return the replacement string.
 * </p>
 * <p>
 * You'll often need the <b>callback</b> function
 * for a <b>mb_ereg_replace_callback()</b> in just one place.
 * In this case you can use an anonymous function to
 * declare the callback within the call to
 * <b>mb_ereg_replace_callback()</b>. By doing it this way
 * you have all information for the call in one place and do not
 * clutter the function namespace with a callback function's name
 * not used anywhere else.
 * </p>
 * @param string $string <p>
 * The string being checked.
 * </p>
 * @param string $option [optional <p>
 * Matching condition can be set by <em><b>option</b></em>
 * parameter. If <em>i</em> is specified for this
 * parameter, the case will be ignored. If <em>x</em> is
 * specified, white space will be ignored. If <em>m</em>
 * is specified, match will be executed in multiline mode and line
 * break will be included in '.'. If <em>p</em> is
 * specified, match will be executed in POSIX mode, line break
 * will be considered as normal character. Note that <em>e</em>
 * cannot be used for <b>mb_ereg_replace_callback()</b>.
 * </p>
 * @return string|false <p>
 * The resultant string on success, or <b>FALSE</b> on error.
 * </p>
 * @since 5.4.1
 */
function mb_ereg_replace_callback ($pattern, callable $callback, $string, $option = "msr") {}

/**
 * Replace regular expression with multibyte support ignoring case
 * @link https://php.net/manual/en/function.mb-eregi-replace.php
 * @param string $pattern <p>
 * The regular expression pattern. Multibyte characters may be used. The case will be ignored.
 * </p>
 * @param string $replace <p>
 * The replacement text.
 * </p>
 * @param string $string <p>
 * The searched string.
 * </p>
 * @param string $option [optional] option has the same meaning as in
 * mb_ereg_replace.
 * <p>PHP 7.1: The <i>e</i> modifier has been deprecated.</p>
 * @return string|false The resultant string or false on error.
 * @since 4.2
 * @since 5.0
 */
function mb_eregi_replace ($pattern, $replace, $string, $option = "msr") {}

/**
 * Split multibyte string using regular expression
 * @link https://php.net/manual/en/function.mb-split.php
 * @param string $pattern <p>
 * The regular expression pattern.
 * </p>
 * @param string $string <p>
 * The string being split.
 * </p>
 * @param int $limit [optional] If optional parameter limit is specified, 
 * it will be split in limit elements as
 * maximum.
 * @return string[] The result as an array.
 * @since 4.2
 * @since 5.0
 */
function mb_split ($pattern, $string, $limit = null) {}

/**
 * Regular expression match for multibyte string
 * @link https://php.net/manual/en/function.mb-ereg-match.php
 * @param string $pattern <p>
 * The regular expression pattern.
 * </p>
 * @param string $string <p>
 * The string being evaluated.
 * </p>
 * @param string $option [optional] <p>
 * </p>
 * @return bool 
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_match ($pattern, $string, $option = null) {}

/**
 * Multibyte regular expression match for predefined multibyte string
 * @link https://php.net/manual/en/function.mb-ereg-search.php
 * @param string $pattern [optional] <p>
 * The search pattern.
 * </p>
 * @param string $option [optional] <p>
 * The search option.
 * </p>
 * @return bool 
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_search ($pattern = null, $option = null) {}

/**
 * Returns position and length of a matched part of the multibyte regular expression for a predefined multibyte string
 * @link https://php.net/manual/en/function.mb-ereg-search-pos.php
 * @param string $pattern [optional] <p>
 * The search pattern.
 * </p>
 * @param string $option [optional] <p>
 * The search option.
 * </p>
 * @return int[]|false An array containing two elements. The first
 * element is the offset, in bytes, where the match begins relative
 * to the start of the search string, and the second element is the
 * length in bytes of the match. If an error occurs, FALSE is returned.
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_search_pos ($pattern = null, $option = null) {}

/**
 * Returns the matched part of a multibyte regular expression
 * @link https://php.net/manual/en/function.mb-ereg-search-regs.php
 * @param string $pattern [optional] <p>
 * The search pattern.
 * </p>
 * @param string $option [optional] <p>
 * The search option.
 * </p>
 * @return string[]|false mb_ereg_search_regs() executes the multibyte
 * regular expression match, and if there are some matched part, it
 * returns an array including substring of matched part as first element,
 * the first grouped part with brackets as second element, the second grouped
 * part as third element, and so on. It returns FALSE on error.
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_search_regs ($pattern = null, $option = null) {}

/**
 * Setup string and regular expression for a multibyte regular expression match
 * @link https://php.net/manual/en/function.mb-ereg-search-init.php
 * @param string $string <p>
 * The search string.
 * </p>
 * @param string $pattern [optional] <p>
 * The search pattern.
 * </p>
 * @param string $option [optional] <p>
 * The search option.
 * </p>
 * @return bool 
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_search_init ($string, $pattern = null, $option = null) {}

/**
 * Retrieve the result from the last multibyte regular expression match
 * @link https://php.net/manual/en/function.mb-ereg-search-getregs.php
 * @return string[]|false An array including the sub-string of matched
 * part by last mb_ereg_search(), mb_ereg_search_pos(), mb_ereg_search_regs().
 * If there are some matches, the first element will have the matched
 * sub-string, the second element will have the first part grouped with
 * brackets, the third element will have the second part grouped with
 * brackets, and so on. It returns FALSE on error;
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_search_getregs () {}

/**
 * Returns start point for next regular expression match
 * @link https://php.net/manual/en/function.mb-ereg-search-getpos.php
 * @return int 
 * @since 4.2
 * @since 5.0
 * @deprecated 7.3
 */
function mb_ereg_search_getpos () {}

/**
 * Set start point of next regular expression match
 * @link https://php.net/manual/en/function.mb-ereg-search-setpos.php
 * @param int $position <p>
 * The position to set.
 * </p>
 * @return bool
 * @since 4.2
 * @since 5.0
 */
function mb_ereg_search_setpos ($position) {}

/**
 * @param $encoding [optional]
 * @deprecated 7.3 use {@see mb_regex_encoding} instead
 */
function mbregex_encoding ($encoding) {}

/**
 * @param $pattern
 * @param $string
 * @param $registers [optional]
 * @deprecated 7.3 use {@see mb_ereg} instead
 */
function mbereg ($pattern, $string, &$registers) {}

/**
 * @param $pattern
 * @param $string
 * @param $registers [optional]
 * @deprecated 7.3 use {@see mb_eregi} instead
 */
function mberegi ($pattern, $string, &$registers) {}

/**
 * @param $pattern
 * @param $replacement
 * @param $string
 * @param $option [optional]
 * @deprecated 7.3 use {@see mb_ereg_replace} instead
 */
function mbereg_replace ($pattern, $replacement, $string, $option) {}

/**
 * @param $pattern
 * @param $replacement
 * @param $string
 * @param string $option
 * @return string
 * @deprecated 7.3 use {@see mb_eregi_replace} instead
 */
function mberegi_replace ($pattern, $replacement, $string, string $option = "msri") {}

/**
 * @param $pattern
 * @param $string
 * @param $limit [optional]
 * @deprecated 7.3 use {@see mb_split} instead
 */
function mbsplit ($pattern, $string, $limit) {}

/**
 * @param $pattern
 * @param $string
 * @param $option [optional]
 * @deprecated 7.3 use {@see mb_ereg_match} instead
 */
function mbereg_match ($pattern, $string, $option) {}

/**
 * @param $pattern [optional]
 * @param $option [optional]
 * @deprecated 7.3 use {@see mb_ereg_search} instead
 */
function mbereg_search ($pattern, $option) {}

/**
 * @param $pattern [optional]
 * @param $option [optional]
 * @deprecated 7.3 use {@see mb_ereg_search_pos} instead
 */
function mbereg_search_pos ($pattern, $option) {}

/**
 * @param $pattern [optional]
 * @param $option [optional]
 * @deprecated 7.3 use {@see mb_ereg_search_regs} instead
 */
function mbereg_search_regs ($pattern, $option) {}

/**
 * @param $string
 * @param $pattern [optional]
 * @param $option [optional]
 * @deprecated 7.3 use {@see mb_ereg_search_init} instead
 */
function mbereg_search_init ($string, $pattern, $option) {}

/**
 * @deprecated 7.3 use {@see mb_ereg_search_getregs} instead
 */
function mbereg_search_getregs () {}

/**
 * @deprecated 7.3 use {@see mb_ereg_search_getpos} instead
 */
function mbereg_search_getpos () {}

/**
 * Get a specific character.
 * @link https://www.php.net/manual/en/function.mb-chr.php
 * @param int $cp
 * @param string $encoding
 * @return string|false specific character or FALSE on failure.
 * @since 7.2
 */
function mb_chr($cp, $encoding) {}

/**
 * Get code point of character
 * @link https://www.php.net/manual/en/function.mb-ord.php
 * @param string $str
 * @param string $encoding
 * @return int|false code point of character or FALSE on failure.
 * @since 7.2
 */
function mb_ord($str, $encoding) {}

/**
 * Scrub broken multibyte strings.
 * @link https://www.php.net/manual/en/function.mb-scrub.php
 * @param string $str
 * @param string $encoding
 * @return string|false
 * @since 7.2
 */
function mb_scrub($str, $encoding) {}

/**
 * @param $position
 * @deprecated 7.3 use {@see mb_ereg_search_setpos} instead
 */
function mbereg_search_setpos ($position) {}

/**
 * Function performs string splitting to an array of defined size chunks.
 * @param string $str
 * @param int $split_length [optional]
 * @param string $encoding [optional]
 * @return string[]
 * @since 7.4
 */
function mb_str_split($str, $split_length, $encoding){}

define ('MB_OVERLOAD_MAIL', 1);
define ('MB_OVERLOAD_STRING', 2);
define ('MB_OVERLOAD_REGEX', 4);
define ('MB_CASE_UPPER', 0);
define ('MB_CASE_LOWER', 1);
define ('MB_CASE_TITLE', 2);
/**
 * @since 7.3
 */
define('MB_CASE_FOLD', 3);
/**
 * @since 7.3
 */
define('MB_CASE_UPPER_SIMPLE', 4);
/**
 * @since 7.3
 */
define('MB_CASE_LOWER_SIMPLE', 5);
/**
 * @since 7.3
 */
define('MB_CASE_TITLE_SIMPLE', 6);
/**
 * @since 7.3
 */
define('MB_CASE_FOLD_SIMPLE', 7);

/**
 * @since 7.4
 */
define('MB_ONIGURUMA_VERSION', '6.9.1');

// End of mbstring v.
?>
