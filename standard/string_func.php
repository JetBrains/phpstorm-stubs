<?php
/**
 * Quote string with slashes in a C style
 *
 * @link  http://php.net/manual/en/function.addcslashes.php
 *
 * @param string $str      <p>
 *                         The string to be escaped.
 *                         </p>
 * @param string $charlist <p>
 *                         A list of characters to be escaped. If
 *                         charlist contains characters
 *                         \n, \r etc., they are
 *                         converted in C-like style, while other non-alphanumeric characters
 *                         with ASCII codes lower than 32 and higher than 126 converted to
 *                         octal representation.
 *                         </p>
 *                         <p>
 *                         When you define a sequence of characters in the charlist argument
 *                         make sure that you know what characters come between the
 *                         characters that you set as the start and end of the range.
 *                         ]]>
 *                         Also, if the first character in a range has a higher ASCII value
 *                         than the second character in the range, no range will be
 *                         constructed. Only the start, end and period characters will be
 *                         escaped. Use the ord function to find the
 *                         ASCII value for a character.
 *                         ]]>
 *                         </p>
 *                         <p>
 *                         Be careful if you choose to escape characters 0, a, b, f, n, r,
 *                         t and v. They will be converted to \0, \a, \b, \f, \n, \r, \t
 *                         and \v.
 *                         In PHP \0 (NULL), \r (carriage return), \n (newline), \f (form feed),
 *                         \v (vertical tab) and \t (tab) are predefined escape sequences,
 *                         while in C all of these are predefined escape sequences.
 *                         </p>
 *
 * @return string the escaped string.
 * @since 4.0
 * @since 5.0
 */
function addcslashes($str, $charlist) { }

/**
 * Quote string with slashes
 *
 * @link  http://php.net/manual/en/function.addslashes.php
 *
 * @param string $str <p>
 *                    The string to be escaped.
 *                    </p>
 *
 * @return string the escaped string.
 * @since 4.0
 * @since 5.0
 */
function addslashes($str) { }

/**
 * Convert binary data into hexadecimal representation
 *
 * @link  http://php.net/manual/en/function.bin2hex.php
 *
 * @param string $str <p>
 *                    A character.
 *                    </p>
 *
 * @return string the hexadecimal representation of the given string.
 * @since 4.0
 * @since 5.0
 */
function bin2hex($str) { }

/**
 * &Alias; <function>rtrim</function>
 *
 * @see   rtrim()
 * @link  http://php.net/manual/en/function.chop.php
 *
 * @param string $str            The input string.
 * @param string $character_mask [optional]
 *
 * @return string the modified string.
 * @since 4.0
 * @since 5.0
 */
function chop($str, $character_mask) { }

/**
 * Return a specific character
 *
 * @link  http://php.net/manual/en/function.chr.php
 *
 * @param int $ascii <p>
 *                   The ascii code.
 *                   </p>
 *
 * @return string the specified character.
 * @since 4.0
 * @since 5.0
 */
function chr($ascii) { }

/**
 * Split a string into smaller chunks
 *
 * @link  http://php.net/manual/en/function.chunk-split.php
 *
 * @param string $body     <p>
 *                         The string to be chunked.
 *                         </p>
 * @param int    $chunklen [optional] <p>
 *                         The chunk length.
 *                         </p>
 * @param string $end      [optional] <p>
 *                         The line ending sequence.
 *                         </p>
 *
 * @return string the chunked string.
 * @since 4.0
 * @since 5.0
 */
function chunk_split($body, $chunklen = null, $end = null) { }

/**
 * Convert from one Cyrillic character set to another
 *
 * @link  http://php.net/manual/en/function.convert-cyr-string.php
 *
 * @param string $str  <p>
 *                     The string to be converted.
 *                     </p>
 * @param string $from <p>
 *                     The source Cyrillic character set, as a single character.
 *                     </p>
 * @param string $to   <p>
 *                     The target Cyrillic character set, as a single character.
 *                     </p>
 *
 * @return string the converted string.
 * @since 4.0
 * @since 5.0
 */
function convert_cyr_string($str, $from, $to) { }

/**
 * Decode a uuencoded string
 *
 * @link  http://php.net/manual/en/function.convert-uudecode.php
 *
 * @param string $data <p>
 *                     The uuencoded data.
 *                     </p>
 *
 * @return string the decoded data as a string.
 * @since 5.0
 */
function convert_uudecode($data) { }

/**
 * Uuencode a string
 *
 * @link  http://php.net/manual/en/function.convert-uuencode.php
 *
 * @param string $data <p>
 *                     The data to be encoded.
 *                     </p>
 *
 * @return string the uuencoded data.
 * @since 5.0
 */
function convert_uuencode($data) { }

/**
 * Return information about characters used in a string
 *
 * @link  http://php.net/manual/en/function.count-chars.php
 *
 * @param string $string <p>
 *                       The examined string.
 *                       </p>
 * @param int    $mode   [optional] <p>
 *                       See return values.
 *                       </p>
 *
 * @return mixed Depending on mode
 * count_chars returns one of the following:
 * 0 - an array with the byte-value as key and the frequency of
 * every byte as value.
 * 1 - same as 0 but only byte-values with a frequency greater
 * than zero are listed.
 * 2 - same as 0 but only byte-values with a frequency equal to
 * zero are listed.
 * 3 - a string containing all unique characters is returned.
 * 4 - a string containing all not used characters is returned.
 * @since 4.0
 * @since 5.0
 */
function count_chars($string, $mode = null) { }

/**
 * Calculates the crc32 polynomial of a string
 *
 * @link  http://php.net/manual/en/function.crc32.php
 *
 * @param string $str <p>
 *                    The data.
 *                    </p>
 *
 * @return int the crc32 checksum of str as an integer.
 * @since 4.0.1
 * @since 5.0
 */
function crc32($str) { }

/**
 * One-way string encryption (hashing)
 *
 * @link  http://php.net/manual/en/function.crypt.php
 *
 * @param string $str  <p>
 *                     The string to be encrypted.
 *                     </p>
 * @param string $salt [optional] <p>
 *                     An optional salt string to base the encryption on. If not provided,
 *                     one will be randomly generated by PHP each time you call this function.
 *                     PHP 5.6 or later raise E_NOTICE error if this parameter is omitted
 *                     </p>
 *                     <p>
 *                     If you are using the supplied salt, you should be aware that the salt
 *                     is generated once. If you are calling this function repeatedly, this
 *                     may impact both appearance and security.
 *                     </p>
 *
 * @return string the encrypted string.
 * @since 4.0
 * @since 5.0
 */
function crypt($str, $salt = null) { }

/**
 * Split a string by string
 *
 * @link  http://php.net/manual/en/function.explode.php
 *
 * @param string $delimiter <p>
 *                          The boundary string.
 *                          </p>
 * @param string $string    <p>
 *                          The input string.
 *                          </p>
 * @param int    $limit     [optional] <p>
 *                          If limit is set and positive, the returned array will contain
 *                          a maximum of limit elements with the last
 *                          element containing the rest of string.
 *                          </p>
 *                          <p>
 *                          If the limit parameter is negative, all components
 *                          except the last -limit are returned.
 *                          </p>
 *                          <p>
 *                          If the limit parameter is zero, then this is treated as 1.
 *                          </p>
 *
 * @return array If delimiter is an empty string (""),
 * explode will return false.
 * If delimiter contains a value that is not
 * contained in string and a negative
 * limit is used, then an empty array will be
 * returned. For any other limit, an array containing
 * string will be returned.
 * @since 4.0
 * @since 5.0
 */
function explode($delimiter, $string, $limit = null) { }

/**
 * Write a formatted string to a stream
 *
 * @link  http://php.net/manual/en/function.fprintf.php
 *
 * @param resource $handle &fs.file.pointer;
 * @param string   $format <p>
 *                         See sprintf for a description of
 *                         format.
 *                         </p>
 * @param mixed    $args   [optional] <p>
 *                         </p>
 * @param mixed    $_      [optional]
 *
 * @return int the length of the string written.
 * @since 5.0
 */
function fprintf($handle, $format, $args = null, $_ = null) { }

/**
 * Returns the translation table used by <function>htmlspecialchars</function> and <function>htmlentities</function>
 *
 * @link  http://php.net/manual/en/function.get-html-translation-table.php
 *
 * @param int $table       [optional] <p>
 *                         There are two new constants (HTML_ENTITIES,
 *                         HTML_SPECIALCHARS) that allow you to specify the
 *                         table you want.
 *                         </p>
 * @param int $quote_style [optional] <p>
 *                         Like the htmlspecialchars and
 *                         htmlentities functions you can optionally specify
 *                         the quote_style you are working with.
 *                         See the description
 *                         of these modes in htmlspecialchars.
 *                         </p>
 *
 * @return array the translation table as an array.
 * @since 4.0
 * @since 5.0
 */
function get_html_translation_table($table = null, $quote_style = null) { }

/**
 * Convert logical Hebrew text to visual text
 *
 * @link  http://php.net/manual/en/function.hebrev.php
 *
 * @param string $hebrew_text        <p>
 *                                   A Hebrew input string.
 *                                   </p>
 * @param int    $max_chars_per_line [optional] <p>
 *                                   This optional parameter indicates maximum number of characters per
 *                                   line that will be returned.
 *                                   </p>
 *
 * @return string the visual string.
 * @since 4.0
 * @since 5.0
 */
function hebrev($hebrew_text, $max_chars_per_line = null) { }

/**
 * Convert logical Hebrew text to visual text with newline conversion
 *
 * @link  http://php.net/manual/en/function.hebrevc.php
 *
 * @param string $hebrew_text        <p>
 *                                   A Hebrew input string.
 *                                   </p>
 * @param int    $max_chars_per_line [optional] <p>
 *                                   This optional parameter indicates maximum number of characters per
 *                                   line that will be returned.
 *                                   </p>
 *
 * @return string the visual string.
 * @since 4.0
 * @since 5.0
 */
function hebrevc($hebrew_text, $max_chars_per_line = null) { }

/**
 * Convert hex to binary
 *
 * @link  http://php.net/manual/en/function.hex2bin.php
 *
 * @param string $data
 *
 * @return string Returns the binary representation of the given data.
 * @see   bin2hex(), unpack()
 * @since 5.4.0
 */
function hex2bin($data) { }

/**
 * Convert all HTML entities to their applicable characters
 *
 * @link  http://php.net/manual/en/function.html-entity-decode.php
 *
 * @param string $string      <p>
 *                            The input string.
 *                            </p>
 * @param int    $quote_style [optional] <p>
 *                            The optional second quote_style parameter lets
 *                            you define what will be done with 'single' and "double" quotes. It takes
 *                            on one of three constants with the default being
 *                            ENT_COMPAT:
 *                            <table>
 *                            Available quote_style constants
 *                            <tr valign="top">
 *                            <td>Constant Name</td>
 *                            <td>Description</td>
 *                            </tr>
 *                            <tr valign="top">
 *                            <td>ENT_COMPAT</td>
 *                            <td>Will convert double-quotes and leave single-quotes alone.</td>
 *                            </tr>
 *                            <tr valign="top">
 *                            <td>ENT_QUOTES</td>
 *                            <td>Will convert both double and single quotes.</td>
 *                            </tr>
 *                            <tr valign="top">
 *                            <td>ENT_NOQUOTES</td>
 *                            <td>Will leave both double and single quotes unconverted.</td>
 *                            </tr>
 *                            </table>
 *                            </p>
 * @param string $charset     [optional] <p>
 *                            The ISO-8859-1 character set is used as default for the optional third
 *                            charset. This defines the character set used in
 *                            conversion.
 *                            </p>
 *                            &reference.strings.charsets;
 *
 * @return string the decoded string.
 * @since 4.3.0
 * @since 5.0
 */
function html_entity_decode($string, $quote_style = null, $charset = null) { }

/**
 * Convert all applicable characters to HTML entities
 *
 * @link  http://php.net/manual/en/function.htmlentities.php
 *
 * @param string $string        <p>
 *                              The input string.
 *                              </p>
 * @param int    $quote_style   [optional] <p>
 *                              Like htmlspecialchars, the optional second
 *                              quote_style parameter lets you define what will
 *                              be done with 'single' and "double" quotes. It takes on one of three
 *                              constants with the default being ENT_COMPAT:
 *                              <table>
 *                              Available quote_style constants
 *                              <tr valign="top">
 *                              <td>Constant Name</td>
 *                              <td>Description</td>
 *                              </tr>
 *                              <tr valign="top">
 *                              <td>ENT_COMPAT</td>
 *                              <td>Will convert double-quotes and leave single-quotes alone.</td>
 *                              </tr>
 *                              <tr valign="top">
 *                              <td>ENT_QUOTES</td>
 *                              <td>Will convert both double and single quotes.</td>
 *                              </tr>
 *                              <tr valign="top">
 *                              <td>ENT_NOQUOTES</td>
 *                              <td>Will leave both double and single quotes unconverted.</td>
 *                              </tr>
 *                              </table>
 *                              </p>
 * @param string $charset       [optional] <p>
 *                              Like htmlspecialchars, it takes an optional
 *                              third argument charset which defines character
 *                              set used in conversion.
 *                              Presently, the ISO-8859-1 character set is used as the default.
 *                              </p>
 *                              &reference.strings.charsets;
 * @param bool   $double_encode [optional] <p>
 *                              When double_encode is turned off PHP will not
 *                              encode existing html entities. The default is to convert everything.
 *                              </p>
 *
 * @return string the encoded string.
 * @since 4.0
 * @since 5.0
 */
function htmlentities($string, $quote_style = null, $charset = null, $double_encode = true) { }

/**
 * Convert special characters to HTML entities
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars.php
 *
 * @param string $string        <p>
 *                              The {@link http://www.php.net/manual/en/language.types.string.php string} being
 *                              converted.
 *                              </p>
 * @param int    $flags         [optional] <p>
 *                              A bitmask of one or more of the following flags, which specify how to handle
 *                              quotes,
 *                              invalid code unit sequences and the used document type. The default is
 *                              <em><b>ENT_COMPAT | ENT_HTML401</b></em>.
 *                              </p><table>
 *                              <caption><b>Available <em>flags</em> constants</b></caption>
 *
 * @since 4.0
 * @since 5.0
 *
 * <thead>
 * <tr>
 * <th>Constant Name</th>
 * <th>Description</th>
 * </tr>
 *
 * </thead>
 *
 * <tbody>
 * <tr>
 * <td><b>ENT_COMPAT</b></td>
 * <td>Will convert double-quotes and leave single-quotes alone.</td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_QUOTES</b></td>
 * <td>Will convert both double and single quotes.</td>
 *</tr>
 *
 * <tr>
 * <td><b>ENT_NOQUOTES</b></td>
 * <td>Will leave both double and single quotes unconverted.</td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_IGNORE</b></td>
 * <td>
 * Silently discard invalid code unit sequences instead of returning
 * an empty string. Using this flag is discouraged as it
 * {@link http://unicode.org/reports/tr36/#Deletion_of_Noncharacters »&nbsp;may have security implications}.
 * </td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_SUBSTITUTE</b></td>
 * <td>
 * Replace invalid code unit sequences with a Unicode Replacement Character
 * U+FFFD (UTF-8) or &amp;#FFFD; (otherwise) instead of returning an empty string.
 * </td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_DISALLOWED</b></td>
 * <td>
 * Replace invalid code points for the given document type with a
 * Unicode Replacement Character U+FFFD (UTF-8) or &amp;#FFFD;
 * (otherwise) instead of leaving them as is. This may be useful, for
 * instance, to ensure the well-formedness of XML documents with
 * embedded external content.
 * </td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_HTML401</b></td>
 * <td>
 * Handle code as HTML 4.01.
 * </td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_XML1</b></td>
 * <td>
 * Handle code as XML 1.
 * </td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_XHTML</b></td>
 * <td>
 * Handle code as XHTML.
 * </td>
 * </tr>
 *
 * <tr>
 * <td><b>ENT_HTML5</b></td>
 * <td>
 * Handle code as HTML 5.
 * </td>
 * </tr>
 *
 * </tbody>
 *
 * </table>
 *
 * @param string $encoding      [optional] <p>
 *                              Defines encoding used in conversion.
 *                              If omitted, the default value for this argument is ISO-8859-1 in
 *                              versions of PHP prior to 5.4.0, and UTF-8 from PHP 5.4.0 onwards.
 *                              </p>
 *                              <p>
 *                              For the purposes of this function, the encodings
 *                              <em>ISO-8859-1</em>, <em>ISO-8859-15</em>,
 *                              <em>UTF-8</em>, <em>cp866</em>,
 *                              <em>cp1251</em>, <em>cp1252</em>, and
 *                              <em>KOI8-R</em> are effectively equivalent, provided the
 *                              <em><b>string</b></em> itself is valid for the encoding, as
 *                              the characters affected by  <b>htmlspecialchars()</b> occupy
 *                              the same positions in all of these encodings.
 *                              </p>
 * @param bool   $double_encode [optional] <p>
 *                              When <em><b>double_encode</b></em> is turned off PHP will not
 *                              encode existing html entities, the default is to convert everything.
 *                              </p>
 *
 * @return string The converted string.
 */
function htmlspecialchars($string, $flags = ENT_COMPAT, $encoding = 'UTF-8', $double_encode = true) { }

/**
 * Convert special HTML entities back to characters
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars-decode.php
 *
 * @param string $string      <p>
 *                            The string to decode
 *                            </p>
 * @param int    $quote_style [optional] <p>
 *                            The quote style. One of the following constants:
 *                            <table>
 *                            quote_style constants
 *                            <tr valign="top">
 *                            <td>Constant Name</td>
 *                            <td>Description</td>
 *                            </tr>
 *                            <tr valign="top">
 *                            <td>ENT_COMPAT</td>
 *                            <td>Will convert double-quotes and leave single-quotes alone
 *                            (default)</td>
 *                            </tr>
 *                            <tr valign="top">
 *                            <td>ENT_QUOTES</td>
 *                            <td>Will convert both double and single quotes</td>
 *                            </tr>
 *                            <tr valign="top">
 *                            <td>ENT_NOQUOTES</td>
 *                            <td>Will leave both double and single quotes unconverted</td>
 *                            </tr>
 *                            </table>
 *                            </p>
 *
 * @return string the decoded string.
 * @since 5.1.0
 */
function htmlspecialchars_decode($string, $quote_style = null) { }

/**
 * Join array elements with a string
 *
 * @link  http://php.net/manual/en/function.implode.php
 *
 * @param string $glue   [optional]<p>
 *                       Defaults to an empty string. This is not the preferred usage of
 *                       implode as glue would be
 *                       the second parameter and thus, the bad prototype would be used.
 *                       </p>
 * @param array  $pieces <p>
 *                       The array of strings to implode.
 *                       </p>
 *
 * @return string a string containing a string representation of all the array
 * elements in the same order, with the glue string between each element.
 * @since 4.0
 * @since 5.0
 */
function implode($glue = "", array $pieces) { }

/**
 * &Alias; <function>implode</function>
 *
 * @link  http://php.net/manual/en/function.join.php
 *
 * @param string $glue   [optional] <p>
 *                       Defaults to an empty string. This is not the preferred usage of
 *                       implode as glue would be
 *                       the second parameter and thus, the bad prototype would be used.
 *                       </p>
 * @param array  $pieces <p>
 *                       The array of strings to implode.
 *                       </p>
 *
 * @return string a string containing a string representation of all the array
 * elements in the same order, with the glue string between each element.
 * @since 4.0
 * @since 5.0
 */
function join($glue = "", $pieces) { }

/**
 * Make a string's first character lowercase
 *
 * @link  http://php.net/manual/en/function.lcfirst.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the resulting string.
 * @since 5.3.0
 */
function lcfirst($str) { }

/**
 * Calculate Levenshtein distance between two strings
 *
 * @link  http://php.net/manual/en/function.levenshtein.php
 * Note: In its simplest form the function will take only the two strings
 * as parameter and will calculate just the number of insert, replace and
 * delete operations needed to transform str1 into str2.
 * Note: A second variant will take three additional parameters that define
 * the cost of insert, replace and delete operations. This is more general
 * and adaptive than variant one, but not as efficient.
 *
 * @param string $str1     <p>
 *                         One of the strings being evaluated for Levenshtein distance.
 *                         </p>
 * @param string $str2     <p>
 *                         One of the strings being evaluated for Levenshtein distance.
 *                         </p>
 * @param int    $cost_ins [optional] <p>
 *                         Defines the cost of insertion.
 *                         </p>
 * @param int    $cost_rep [optional] <p>
 *                         Defines the cost of replacement.
 *                         </p>
 * @param int    $cost_del [optional] <p>
 *                         Defines the cost of deletion.
 *                         </p>
 *
 * @return int This function returns the Levenshtein-Distance between the
 * two argument strings or -1, if one of the argument strings
 * is longer than the limit of 255 characters.
 * @since 4.0.1
 * @since 5.0
 */
function levenshtein($str1, $str2, $cost_ins = null, $cost_rep = null, $cost_del = null) { }

/**
 * Get numeric formatting information
 *
 * @link  http://php.net/manual/en/function.localeconv.php
 * @return array localeconv returns data based upon the current locale
 * as set by setlocale. The associative array that is
 * returned contains the following fields:
 * <tr valign="top">
 * <td>Array element</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>decimal_point</td>
 * <td>Decimal point character</td>
 * </tr>
 * <tr valign="top">
 * <td>thousands_sep</td>
 * <td>Thousands separator</td>
 * </tr>
 * <tr valign="top">
 * <td>grouping</td>
 * <td>Array containing numeric groupings</td>
 * </tr>
 * <tr valign="top">
 * <td>int_curr_symbol</td>
 * <td>International currency symbol (i.e. USD)</td>
 * </tr>
 * <tr valign="top">
 * <td>currency_symbol</td>
 * <td>Local currency symbol (i.e. $)</td>
 * </tr>
 * <tr valign="top">
 * <td>mon_decimal_point</td>
 * <td>Monetary decimal point character</td>
 * </tr>
 * <tr valign="top">
 * <td>mon_thousands_sep</td>
 * <td>Monetary thousands separator</td>
 * </tr>
 * <tr valign="top">
 * <td>mon_grouping</td>
 * <td>Array containing monetary groupings</td>
 * </tr>
 * <tr valign="top">
 * <td>positive_sign</td>
 * <td>Sign for positive values</td>
 * </tr>
 * <tr valign="top">
 * <td>negative_sign</td>
 * <td>Sign for negative values</td>
 * </tr>
 * <tr valign="top">
 * <td>int_frac_digits</td>
 * <td>International fractional digits</td>
 * </tr>
 * <tr valign="top">
 * <td>frac_digits</td>
 * <td>Local fractional digits</td>
 * </tr>
 * <tr valign="top">
 * <td>p_cs_precedes</td>
 * <td>
 * true if currency_symbol precedes a positive value, false
 * if it succeeds one
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>p_sep_by_space</td>
 * <td>
 * true if a space separates currency_symbol from a positive
 * value, false otherwise
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>n_cs_precedes</td>
 * <td>
 * true if currency_symbol precedes a negative value, false
 * if it succeeds one
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>n_sep_by_space</td>
 * <td>
 * true if a space separates currency_symbol from a negative
 * value, false otherwise
 * </td>
 * </tr>
 * <td>p_sign_posn</td>
 * <td>
 * 0 - Parentheses surround the quantity and currency_symbol
 * 1 - The sign string precedes the quantity and currency_symbol
 * 2 - The sign string succeeds the quantity and currency_symbol
 * 3 - The sign string immediately precedes the currency_symbol
 * 4 - The sign string immediately succeeds the currency_symbol
 * </td>
 * </tr>
 * <td>n_sign_posn</td>
 * <td>
 * 0 - Parentheses surround the quantity and currency_symbol
 * 1 - The sign string precedes the quantity and currency_symbol
 * 2 - The sign string succeeds the quantity and currency_symbol
 * 3 - The sign string immediately precedes the currency_symbol
 * 4 - The sign string immediately succeeds the currency_symbol
 * </td>
 * </tr>
 * </p>
 * <p>
 * The p_sign_posn, and n_sign_posn contain a string
 * of formatting options. Each number representing one of the above listed conditions.
 * </p>
 * <p>
 * The grouping fields contain arrays that define the way numbers should be
 * grouped. For example, the monetary grouping field for the nl_NL locale (in
 * UTF-8 mode with the euro sign), would contain a 2 item array with the
 * values 3 and 3. The higher the index in the array, the farther left the
 * grouping is. If an array element is equal to CHAR_MAX,
 * no further grouping is done. If an array element is equal to 0, the previous
 * element should be used.
 * @since 4.0.5
 * @since 5.0
 */
function localeconv() { }

/**
 * Strip whitespace (or other characters) from the beginning of a string
 *
 * @link  http://php.net/manual/en/function.ltrim.php
 *
 * @param string $str      <p>
 *                         The input string.
 *                         </p>
 * @param string $charlist [optional] <p>
 *                         You can also specify the characters you want to strip, by means of the
 *                         charlist parameter.
 *                         Simply list all characters that you want to be stripped. With
 *                         .. you can specify a range of characters.
 *                         </p>
 *
 * @return string This function returns a string with whitespace stripped from the
 * beginning of str.
 * Without the second parameter,
 * ltrim will strip these characters:
 * " " (ASCII 32
 * (0x20)), an ordinary space.
 * "\t" (ASCII 9
 * (0x09)), a tab.
 * "\n" (ASCII 10
 * (0x0A)), a new line (line feed).
 * "\r" (ASCII 13
 * (0x0D)), a carriage return.
 * "\0" (ASCII 0
 * (0x00)), the NUL-byte.
 * "\x0B" (ASCII 11
 * (0x0B)), a vertical tab.
 * @since 4.0
 * @since 5.0
 */
function ltrim($str, $charlist = " \t\n\r\0\x0B") { }

/**
 * Calculate the md5 hash of a string
 *
 * @link  http://php.net/manual/en/function.md5.php
 *
 * @param string $str        <p>
 *                           The string.
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           If the optional raw_output is set to true,
 *                           then the md5 digest is instead returned in raw binary format with a
 *                           length of 16.
 *                           </p>
 *
 * @return string the hash as a 32-character hexadecimal number.
 * @since 4.0
 * @since 5.0
 */
function md5($str, $raw_output = null) { }

/**
 * Calculates the md5 hash of a given file
 *
 * @link  http://php.net/manual/en/function.md5-file.php
 *
 * @param string $filename   <p>
 *                           The filename
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           When true, returns the digest in raw binary format with a length of
 *                           16.
 *                           </p>
 *
 * @return string a string on success, false otherwise.
 * @since 4.2.0
 * @since 5.0
 */
function md5_file($filename, $raw_output = null) { }

/**
 * Calculate the metaphone key of a string
 *
 * @link  http://php.net/manual/en/function.metaphone.php
 *
 * @param string $str      <p>
 *                         The input string.
 *                         </p>
 * @param int    $phonemes [optional] <p>
 *                         This parameter restricts the returned metaphone key to phonemes characters in length.
 *                         The default value of 0 means no restriction.
 *                         </p>
 *
 * @return string|false the metaphone key as a string, or FALSE on failure
 * @since 4.0
 * @since 5.0
 */
function metaphone($str, $phonemes = 0) { }

/**
 * Formats a number as a currency string
 *
 * @link  http://php.net/manual/en/function.money-format.php
 *
 * @param string $format <p>
 *                       The format specification consists of the following sequence:
 *                       <p>a % character</p>
 * @param float  $number <p>
 *                       The number to be formatted.
 *                       </p>
 *
 * @return string the formatted string. Characters before and after the formatting
 * string will be returned unchanged.
 * Non-numeric number causes returning &null; and
 * emitting E_WARNING.
 * @since 4.3.0
 * @since 5.0
 */
function money_format($format, $number) { }

/**
 * Inserts HTML line breaks before all newlines in a string
 *
 * @link  http://php.net/manual/en/function.nl2br.php
 *
 * @param string $string   <p>
 *                         The input string.
 *                         </p>
 * @param bool   $is_xhtml [optional] <p>
 *                         Whenever to use XHTML compatible line breaks or not.
 *                         </p>
 *
 * @return string the altered string.
 * @since 4.0
 * @since 5.0
 */
function nl2br($string, $is_xhtml = null) { }

/**
 * Query language and locale information
 *
 * @link  http://php.net/manual/en/function.nl-langinfo.php
 *
 * @param int $item <p>
 *                  item may be an integer value of the element or the
 *                  constant name of the element. The following is a list of constant names
 *                  for item that may be used and their description.
 *                  Some of these constants may not be defined or hold no value for certain
 *                  locales.
 *                  <table>
 *                  nl_langinfo Constants
 *                  <tr valign="top">
 *                  <td>Constant</td>
 *                  <td>Description</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  LC_TIME Category Constants</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>ABDAY_(1-7)</td>
 *                  <td>Abbreviated name of n-th day of the week.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>DAY_(1-7)</td>
 *                  <td>Name of the n-th day of the week (DAY_1 = Sunday).</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>ABMON_(1-12)</td>
 *                  <td>Abbreviated name of the n-th month of the year.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>MON_(1-12)</td>
 *                  <td>Name of the n-th month of the year.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>AM_STR</td>
 *                  <td>String for Ante meridian.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>PM_STR</td>
 *                  <td>String for Post meridian.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>D_T_FMT</td>
 *                  <td>String that can be used as the format string for strftime to represent time and date.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>D_FMT</td>
 *                  <td>String that can be used as the format string for strftime to represent date.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>T_FMT</td>
 *                  <td>String that can be used as the format string for strftime to represent time.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>T_FMT_AMPM</td>
 *                  <td>String that can be used as the format string for strftime to represent time in 12-hour
 *                  format with ante/post meridian.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>ERA</td>
 *                  <td>Alternate era.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>ERA_YEAR</td>
 *                  <td>Year in alternate era format.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>ERA_D_T_FMT</td>
 *                  <td>Date and time in alternate era format (string can be used in strftime).</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>ERA_D_FMT</td>
 *                  <td>Date in alternate era format (string can be used in strftime).</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>ERA_T_FMT</td>
 *                  <td>Time in alternate era format (string can be used in strftime).</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  LC_MONETARY Category Constants</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INT_CURR_SYMBOL</td>
 *                  <td>International currency symbol.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CURRENCY_SYMBOL</td>
 *                  <td>Local currency symbol.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CRNCYSTR</td>
 *                  <td>Same value as CURRENCY_SYMBOL.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>MON_DECIMAL_POINT</td>
 *                  <td>Decimal point character.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>MON_THOUSANDS_SEP</td>
 *                  <td>Thousands separator (groups of three digits).</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>MON_GROUPING</td>
 *                  <td>Like "grouping" element.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>POSITIVE_SIGN</td>
 *                  <td>Sign for positive values.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>NEGATIVE_SIGN</td>
 *                  <td>Sign for negative values.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INT_FRAC_DIGITS</td>
 *                  <td>International fractional digits.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>FRAC_DIGITS</td>
 *                  <td>Local fractional digits.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>P_CS_PRECEDES</td>
 *                  <td>Returns 1 if CURRENCY_SYMBOL precedes a positive value.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>P_SEP_BY_SPACE</td>
 *                  <td>Returns 1 if a space separates CURRENCY_SYMBOL from a positive value.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>N_CS_PRECEDES</td>
 *                  <td>Returns 1 if CURRENCY_SYMBOL precedes a negative value.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>N_SEP_BY_SPACE</td>
 *                  <td>Returns 1 if a space separates CURRENCY_SYMBOL from a negative value.</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>P_SIGN_POSN</td>
 *                  Returns 0 if parentheses surround the quantity and CURRENCY_SYMBOL.
 *
 * @return string the element as a string, or false if item
 * is not valid.
 * @since 4.1.0
 * @since 5.0
 */
function nl_langinfo($item) { }

/**
 * Format a number with grouped thousands
 *
 * @link  http://php.net/manual/en/function.number-format.php
 *
 * @param float  $number        <p>
 *                              The number being formatted.
 *                              </p>
 * @param int    $decimals      [optional] <p>
 *                              Sets the number of decimal points.
 *                              </p>
 * @param string $dec_point     [optional]
 * @param string $thousands_sep [optional]
 *
 * @return string A formatted version of number.
 * @since 4.0
 * @since 5.0
 */
function number_format($number, $decimals = 0, $dec_point = '.', $thousands_sep = ',') { }

/**
 * Return ASCII value of character
 *
 * @link  http://php.net/manual/en/function.ord.php
 *
 * @param string $string <p>
 *                       A character.
 *                       </p>
 *
 * @return int the ASCII value as an integer.
 * @since 4.0
 * @since 5.0
 */
function ord($string) { }

/**
 * Parses the string into variables
 *
 * @link  http://php.net/manual/en/function.parse-str.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 * @param array  $arr [optional] <p>
 *                    If the second parameter arr is present,
 *                    variables are stored in this variable as array elements instead.
 *                    </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function parse_str($str, array &$arr = null) { }

/**
 * Output a formatted string
 *
 * @link  http://php.net/manual/en/function.printf.php
 *
 * @param string $format <p>
 *                       See sprintf for a description of
 *                       format.
 *                       </p>
 * @param mixed  $args   [optional] <p>
 *                       </p>
 * @param mixed  $_      [optional]
 *
 * @return int the length of the outputted string.
 * @since 4.0
 * @since 5.0
 */
function printf($format, $args = null, $_ = null) { }

/**
 * Convert a quoted-printable string to an 8 bit string
 *
 * @link  http://php.net/manual/en/function.quoted-printable-decode.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the 8-bit binary string.
 * @since 4.0
 * @since 5.0
 */
function quoted_printable_decode($str) { }

/**
 * Convert a 8 bit string to a quoted-printable string
 *
 * @link  http://php.net/manual/en/function.quoted-printable-encode.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the encoded string.
 * @since 5.3.0
 */
function quoted_printable_encode($str) { }

/**
 * Quote meta characters
 *
 * @link  http://php.net/manual/en/function.quotemeta.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the string with meta characters quoted.
 * @since 4.0
 * @since 5.0
 */
function quotemeta($str) { }

/**
 * Strip whitespace (or other characters) from the end of a string.
 * Without the second parameter, rtrim() will strip these characters:
 * <ul>
 * <li>" " (ASCII 32 (0x20)), an ordinary space.
 * <li>"\t" (ASCII 9 (0x09)), a tab.
 * <li>"\n" (ASCII 10 (0x0A)), a new line (line feed).
 * <li>"\r" (ASCII 13 (0x0D)), a carriage return.
 * <li>"\0" (ASCII 0 (0x00)), the NUL-byte.
 * <li>"\x0B" (ASCII 11 (0x0B)), a vertical tab.
 * </ul>
 *
 * @link  http://php.net/manual/en/function.rtrim.php
 *
 * @param string $str      <p>
 *                         The input string.
 *                         </p>
 * @param string $charlist [optional] <p>
 *                         You can also specify the characters you want to strip, by means
 *                         of the charlist parameter.
 *                         Simply list all characters that you want to be stripped. With
 *                         .. you can specify a range of characters.
 *                         </p>
 *
 * @return string the modified string.
 * @since 4.0
 * @since 5.0
 */
function rtrim($str, $charlist = " \t\n\r\0\x0B") { }

/**
 * Set locale information
 *
 * @link  http://php.net/manual/en/function.setlocale.php
 *
 * @param int    $category <p>
 *                         <p>
 *                         <em>category</em> is a named constant specifying the
 *                         category of the functions affected by the locale setting:
 *                         </p><ul>
 *                         <li>
 *                         <b>LC_ALL</b> for all of the below
 *                         </li>
 *                         <li>
 *                         <b>LC_COLLATE</b> for string comparison, see
 *                         {@see strcoll()}
 *                         </li>
 *                         <li>
 *                         <b>LC_CTYPE</b> for character classification and conversion, for
 *                         example {@see strtoupper()}
 *                         </li>
 *                         <li>
 *                         <b>LC_MONETARY</b> for {@see localeconv()}
 *                         </li>
 *                         <li>
 *                         <b>LC_NUMERIC</b> for decimal separator (See also
 *                         {@see localeconv()})
 *                         </li>
 *                         <li>
 *                         <b>LC_TIME</b> for date and time formatting with
 *                         {@see strftime()}
 *
 * </li>
 * <li>
 * <b>LC_MESSAGES</B> for system responses (available if PHP was compiled with
 * <em>libintl</em>)
 *
 * </li>
 * </ul>
 * @param string $locale   <p>
 *                         If locale is &null; or the empty string
 *                         "", the locale names will be set from the
 *                         values of environment variables with the same names as the above
 *                         categories, or from "LANG".
 *                         </p>
 *                         <p>
 *                         If locale is "0",
 *                         the locale setting is not affected, only the current setting is returned.
 *                         </p>
 *                         <p>
 *                         If locale is an array or followed by additional
 *                         parameters then each array element or parameter is tried to be set as
 *                         new locale until success. This is useful if a locale is known under
 *                         different names on different systems or for providing a fallback
 *                         for a possibly not available locale.
 *                         </p>
 * @param string $_        [optional]
 *
 * @return string the new current locale, or false if the locale functionality is
 * not implemented on your platform, the specified locale does not exist or
 * the category name is invalid.
 * </p>
 * <p>
 * An invalid category name also causes a warning message. Category/locale
 * names can be found in RFC 1766
 * and ISO 639.
 * Different systems have different naming schemes for locales.
 * </p>
 * <p>
 * The return value of setlocale depends
 * on the system that PHP is running. It returns exactly
 * what the system setlocale function returns.
 * @since 4.0
 * @since 5.0
 */
function setlocale($category, $locale, $_ = null) { }

/**
 * Calculate the sha1 hash of a string
 *
 * @link  http://php.net/manual/en/function.sha1.php
 *
 * @param string $str        <p>
 *                           The input string.
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           If the optional raw_output is set to true,
 *                           then the sha1 digest is instead returned in raw binary format with a
 *                           length of 20, otherwise the returned value is a 40-character
 *                           hexadecimal number.
 *                           </p>
 *
 * @return string the sha1 hash as a string.
 * @since 4.3.0
 * @since 5.0
 */
function sha1($str, $raw_output = null) { }

/**
 * Calculate the sha1 hash of a file
 *
 * @link  http://php.net/manual/en/function.sha1-file.php
 *
 * @param string $filename   <p>
 *                           The filename
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           When true, returns the digest in raw binary format with a length of
 *                           20.
 *                           </p>
 *
 * @return string a string on success, false otherwise.
 * @since 4.3.0
 * @since 5.0
 */
function sha1_file($filename, $raw_output = null) { }

/**
 * Calculate the similarity between two strings
 *
 * @link  http://php.net/manual/en/function.similar-text.php
 *
 * @param string $first   <p>
 *                        The first string.
 *                        </p>
 * @param string $second  <p>
 *                        The second string.
 *                        </p>
 * @param float  $percent [optional] <p>
 *                        By passing a reference as third argument,
 *                        similar_text will calculate the similarity in
 *                        percent for you.
 *                        </p>
 *
 * @return int the number of matching chars in both strings.
 * @since 4.0
 * @since 5.0
 */
function similar_text($first, $second, &$percent = null) { }

/**
 * Calculate the soundex key of a string
 *
 * @link  http://php.net/manual/en/function.soundex.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the soundex key as a string.
 * @since 4.0
 * @since 5.0
 */
function soundex($str) { }

/**
 * Return a formatted string
 *
 * @link  http://php.net/manual/en/function.sprintf.php
 *
 * @param string $format <p>
 *                       The format string is composed of zero or more directives:
 *                       ordinary characters (excluding %) that are
 *                       copied directly to the result, and conversion
 *                       specifications, each of which results in fetching its
 *                       own parameter. This applies to both sprintf
 *                       and printf.
 *                       </p>
 *                       <p>
 *                       Each conversion specification consists of a percent sign
 *                       (%), followed by one or more of these
 *                       elements, in order:
 *                       An optional sign specifier that forces a sign
 *                       (- or +) to be used on a number. By default, only the - sign is used
 *                       on a number if it's negative. This specifier forces positive numbers
 *                       to have the + sign attached as well, and was added in PHP 4.3.0.
 * @param mixed  $args   [optional] <p>
 *                       </p>
 * @param mixed  $_      [optional]
 *
 * @return string a string produced according to the formatting string
 * format.
 * @since 4.0
 * @since 5.0
 */
function sprintf($format, $args = null, $_ = null) { }

/**
 * Parses input from a string according to a format
 *
 * @link  http://php.net/manual/en/function.sscanf.php
 *
 * @param string $str    <p>
 *                       The input string being parsed.
 *                       </p>
 * @param string $format <p>
 *                       The interpreted format for str, which is
 *                       described in the documentation for sprintf with
 *                       following differences:
 *                       Function is not locale-aware.
 *                       F, g, G and
 *                       b are not supported.
 *                       D stands for decimal number.
 *                       i stands for integer with base detection.
 *                       n stands for number of characters processed so far.
 *                       </p>
 * @param mixed  $_      [optional]
 *
 * @return mixed If only
 * two parameters were passed to this function, the values parsed
 * will be returned as an array. Otherwise, if optional parameters are passed,
 * the function will return the number of assigned values. The optional
 * parameters must be passed by reference.
 * @since 4.0.1
 * @since 5.0
 */
function sscanf($str, $format, &$_ = null) { }

/**
 * Parse a CSV string into an array
 *
 * @link  http://php.net/manual/en/function.str-getcsv.php
 *
 * @param string $input     <p>
 *                          The string to parse.
 *                          </p>
 * @param string $delimiter [optional] <p>
 *                          Set the field delimiter (one character only).
 *                          </p>
 * @param string $enclosure [optional] <p>
 *                          Set the field enclosure character (one character only).
 *                          </p>
 * @param string $escape    [optional] <p>
 *                          Set the escape character (one character only).
 *                          Defaults as a backslash (\)
 *                          </p>
 *
 * @return array an indexed array containing the fields read.
 * @since 5.3.0
 */
function str_getcsv($input, $delimiter = ",", $enclosure = '"', $escape = "\\") { }

/**
 * Case-insensitive version of <function>str_replace</function>.
 *
 * @link  http://php.net/manual/en/function.str-ireplace.php
 *
 * @param mixed $search  <p>
 *                       Every replacement with search array is
 *                       performed on the result of previous replacement.
 *                       </p>
 * @param mixed $replace <p>
 *                       </p>
 * @param mixed $subject <p>
 *                       If subject is an array, then the search and
 *                       replace is performed with every entry of
 *                       subject, and the return value is an array as
 *                       well.
 *                       </p>
 * @param int   $count   [optional] <p>
 *                       The number of matched and replaced needles will
 *                       be returned in count which is passed by
 *                       reference.
 *                       </p>
 *
 * @return mixed a string or an array of replacements.
 * @since 5.0
 */
function str_ireplace($search, $replace, $subject, &$count = null) { }

/**
 * Pad a string to a certain length with another string
 *
 * @link  http://php.net/manual/en/function.str-pad.php
 *
 * @param string $input      <p>
 *                           The input string.
 *                           </p>
 * @param int    $pad_length <p>
 *                           If the value of pad_length is negative,
 *                           less than, or equal to the length of the input string, no padding
 *                           takes place.
 *                           </p>
 * @param string $pad_string [optional] <p>
 *                           The pad_string may be truncated if the
 *                           required number of padding characters can't be evenly divided by the
 *                           pad_string's length.
 *                           </p>
 * @param int    $pad_type   [optional] <p>
 *                           Optional argument pad_type can be
 *                           STR_PAD_RIGHT, STR_PAD_LEFT,
 *                           or STR_PAD_BOTH. If
 *                           pad_type is not specified it is assumed to be
 *                           STR_PAD_RIGHT.
 *                           </p>
 *
 * @return string the padded string.
 * @since 4.0.1
 * @since 5.0
 */
function str_pad($input, $pad_length, $pad_string = null, $pad_type = null) { }

/**
 * Repeat a string
 *
 * @link  http://php.net/manual/en/function.str-repeat.php
 *
 * @param string $input      <p>
 *                           The string to be repeated.
 *                           </p>
 * @param int    $multiplier <p>
 *                           Number of time the input string should be
 *                           repeated.
 *                           </p>
 *                           <p>
 *                           multiplier has to be greater than or equal to 0.
 *                           If the multiplier is set to 0, the function
 *                           will return an empty string.
 *                           </p>
 *
 * @return string the repeated string.
 * @since 4.0
 * @since 5.0
 */
function str_repeat($input, $multiplier) { }

/**
 * Replace all occurrences of the search string with the replacement string
 *
 * @link  http://php.net/manual/en/function.str-replace.php
 *
 * @param mixed $search  <p>
 *                       The value being searched for, otherwise known as the needle.
 *                       An array may be used to designate multiple needles.
 *                       </p>
 * @param mixed $replace <p>
 *                       The replacement value that replaces found search
 *                       values. An array may be used to designate multiple replacements.
 *                       </p>
 * @param mixed $subject <p>
 *                       The string or array being searched and replaced on,
 *                       otherwise known as the haystack.
 *                       </p>
 *                       <p>
 *                       If subject is an array, then the search and
 *                       replace is performed with every entry of
 *                       subject, and the return value is an array as
 *                       well.
 *                       </p>
 * @param int   $count   [optional] If passed, this will hold the number of matched and replaced needles.
 *
 * @return mixed This function returns a string or an array with the replaced values.
 * @since 4.0
 * @since 5.0
 */
function str_replace($search, $replace, $subject, &$count = null) { }

/**
 * Perform the rot13 transform on a string
 *
 * @link  http://php.net/manual/en/function.str-rot13.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the ROT13 version of the given string.
 * @since 4.2.0
 * @since 5.0
 */
function str_rot13($str) { }

/**
 * Randomly shuffles a string
 *
 * @link  http://php.net/manual/en/function.str-shuffle.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the shuffled string.
 * @since 4.3.0
 * @since 5.0
 */
function str_shuffle($str) { }

/**
 * Convert a string to an array
 *
 * @link  http://php.net/manual/en/function.str-split.php
 *
 * @param string $string       <p>
 *                             The input string.
 *                             </p>
 * @param int    $split_length [optional] <p>
 *                             Maximum length of the chunk.
 *                             </p>
 *
 * @return array If the optional split_length parameter is
 * specified, the returned array will be broken down into chunks with each
 * being split_length in length, otherwise each chunk
 * will be one character in length.
 * </p>
 * <p>
 * false is returned if split_length is less than 1.
 * If the split_length length exceeds the length of
 * string, the entire string is returned as the first
 * (and only) array element.
 * @since 5.0
 */
function str_split($string, $split_length = 1) { }

/**
 * Return information about words used in a string
 *
 * @link  http://php.net/manual/en/function.str-word-count.php
 *
 * @param string $string   <p>
 *                         The string
 *                         </p>
 * @param int    $format   [optional] <p>
 *                         Specify the return value of this function. The current supported values
 *                         are:
 *                         0 - returns the number of words found
 * @param string $charlist [optional] <p>
 *                         A list of additional characters which will be considered as 'word'
 *                         </p>
 *
 * @return mixed an array or an integer, depending on the
 * format chosen.
 * @since 4.3.0
 * @since 5.0
 */
function str_word_count($string, $format = null, $charlist = null) { }

/**
 * Binary safe case-insensitive string comparison
 *
 * @link  http://php.net/manual/en/function.strcasecmp.php
 *
 * @param string $str1 <p>
 *                     The first string
 *                     </p>
 * @param string $str2 <p>
 *                     The second string
 *                     </p>
 *
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i>
 * is greater than <i>str2</i>, and 0 if they are
 * equal.
 * @since 4.0
 * @since 5.0
 */
function strcasecmp($str1, $str2) { }

/**
 * &Alias; <function>strstr</function>
 *
 * @link  http://php.net/manual/en/function.strchr.php
 * Note: This function is case-sensitive. For case-insensitive searches, use stristr().
 * Note: If you only want to determine if a particular needle occurs within haystack,
 * use the faster and less memory intensive function strpos() instead.
 * @since 4.0
 * @since 5.0
 *
 * @param string $haystack The input string.
 * @param mixed  $needle   If needle is not a string, it is converted to an integer and applied as the ordinal
 *                         value of a character.
 * @param bool   $part     [optional] If TRUE, strstr() returns the part of the haystack before the first
 *                         occurrence of the needle (excluding the needle).
 *
 * @return string Returns the portion of string, or FALSE if needle is not found.
 */
function strchr($haystack, $needle, $part) { }

/**
 * Binary safe string comparison
 *
 * @link  http://php.net/manual/en/function.strcmp.php
 *
 * @param string $str1 <p>
 *                     The first string.
 *                     </p>
 * @param string $str2 <p>
 *                     The second string.
 *                     </p>
 *
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i>
 * is greater than <i>str2</i>, and 0 if they are
 * equal.
 * @since 4.0
 * @since 5.0
 */
function strcmp($str1, $str2) { }

/**
 * Locale based string comparison
 *
 * @link  http://php.net/manual/en/function.strcoll.php
 *
 * @param string $str1 <p>
 *                     The first string.
 *                     </p>
 * @param string $str2 <p>
 *                     The second string.
 *                     </p>
 *
 * @return int &lt; 0 if str1 is less than
 * str2; &gt; 0 if
 * str1 is greater than
 * str2, and 0 if they are equal.
 * @since 4.0.5
 * @since 5.0
 */
function strcoll($str1, $str2) { }

/**
 * Find length of initial segment not matching mask
 *
 * @link  http://php.net/manual/en/function.strcspn.php
 *
 * @param string $str1   <p>
 *                       The first string.
 *                       </p>
 * @param string $str2   <p>
 *                       The second string.
 *                       </p>
 * @param int    $start  [optional] <p>
 *                       The start position of the string to examine.
 *                       </p>
 * @param int    $length [optional] <p>
 *                       The length of the string to examine.
 *                       </p>
 *
 * @return int the length of the segment as an integer.
 * @since 4.0
 * @since 5.0
 */
function strcspn($str1, $str2, $start = null, $length = null) { }

/**
 * Strip HTML and PHP tags from a string
 *
 * @link  http://php.net/manual/en/function.strip-tags.php
 *
 * @param string $str            <p>
 *                               The input string.
 *                               </p>
 * @param string $allowable_tags [optional] <p>
 *                               You can use the optional second parameter to specify tags which should
 *                               not be stripped.
 *                               </p>
 *                               <p>
 *                               HTML comments and PHP tags are also stripped. This is hardcoded and
 *                               can not be changed with allowable_tags.
 *                               </p>
 *
 * @return string the stripped string.
 * @since 4.0
 * @since 5.0
 */
function strip_tags($str, $allowable_tags = null) { }

/**
 * Un-quote string quoted with <function>addcslashes</function>
 *
 * @link  http://php.net/manual/en/function.stripcslashes.php
 *
 * @param string $str <p>
 *                    The string to be unescaped.
 *                    </p>
 *
 * @return string the unescaped string.
 * @since 4.0
 * @since 5.0
 */
function stripcslashes($str) { }

/**
 * Find position of first occurrence of a case-insensitive string
 *
 * @link  http://php.net/manual/en/function.stripos.php
 *
 * @param string $haystack <p>
 *                         The string to search in
 *                         </p>
 * @param string $needle   <p>
 *                         Note that the needle may be a string of one or
 *                         more characters.
 *                         </p>
 *                         <p>
 *                         If needle is not a string, it is converted to
 *                         an integer and applied as the ordinal value of a character.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         The optional offset parameter allows you
 *                         to specify which character in haystack to
 *                         start searching. The position returned is still relative to the
 *                         beginning of haystack.
 *                         </p>
 *
 * @return int If needle is not found,
 * stripos will return boolean false.
 * @since 5.0
 */
function stripos($haystack, $needle, $offset = null) { }

/**
 * Un-quotes a quoted string
 *
 * @link  http://php.net/manual/en/function.stripslashes.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string a string with backslashes stripped off.
 * (\' becomes ' and so on.)
 * Double backslashes (\\) are made into a single
 * backslash (\).
 * @since 4.0
 * @since 5.0
 */
function stripslashes($str) { }

/**
 * Case-insensitive <function>strstr</function>
 *
 * @link  http://php.net/manual/en/function.stristr.php
 *
 * @param string $haystack      <p>
 *                              The string to search in
 *                              </p>
 * @param mixed  $needle        <p>
 *                              If needle is not a string, it is converted to
 *                              an integer and applied as the ordinal value of a character.
 *                              </p>
 * @param bool   $before_needle [optional] <p>
 *                              If true, stristr
 *                              returns the part of the haystack before the
 *                              first occurrence of the needle.
 *                              </p>
 *
 * @return string the matched substring. If needle is not
 * found, returns false.
 * @since 4.0
 * @since 5.0
 */
function stristr($haystack, $needle, $before_needle = null) { }

/**
 * Get string length
 *
 * @link  http://php.net/manual/en/function.strlen.php
 *
 * @param string $string <p>
 *                       The string being measured for length.
 *                       </p>
 *
 * @return int The length of the <i>string</i> on success,
 * and 0 if the <i>string</i> is empty.
 * @since 4.0
 * @since 5.0
 */
function strlen($string) { }

/**
 * Case insensitive string comparisons using a "natural order" algorithm
 *
 * @link  http://php.net/manual/en/function.strnatcasecmp.php
 *
 * @param string $str1 <p>
 *                     The first string.
 *                     </p>
 * @param string $str2 <p>
 *                     The second string.
 *                     </p>
 *
 * @return int Similar to other string comparison functions, this one returns &lt; 0 if
 * str1 is less than str2 &gt;
 * 0 if str1 is greater than
 * str2, and 0 if they are equal.
 * @since 4.0
 * @since 5.0
 */
function strnatcasecmp($str1, $str2) { }

/**
 * String comparisons using a "natural order" algorithm
 *
 * @link  http://php.net/manual/en/function.strnatcmp.php
 *
 * @param string $str1 <p>
 *                     The first string.
 *                     </p>
 * @param string $str2 <p>
 *                     The second string.
 *                     </p>
 *
 * @return int Similar to other string comparison functions, this one returns &lt; 0 if
 * str1 is less than str2; &gt;
 * 0 if str1 is greater than
 * str2, and 0 if they are equal.
 * @since 4.0
 * @since 5.0
 */
function strnatcmp($str1, $str2) { }

/**
 * Binary safe case-insensitive string comparison of the first n characters
 *
 * @link  http://php.net/manual/en/function.strncasecmp.php
 *
 * @param string $str1 <p>
 *                     The first string.
 *                     </p>
 * @param string $str2 <p>
 *                     The second string.
 *                     </p>
 * @param int    $len  <p>
 *                     The length of strings to be used in the comparison.
 *                     </p>
 *
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i> is
 * greater than <i>str2</i>, and 0 if they are equal.
 * @since 4.0.4
 * @since 5.0
 */
function strncasecmp($str1, $str2, $len) { }

/**
 * Binary safe string comparison of the first n characters
 *
 * @link  http://php.net/manual/en/function.strncmp.php
 *
 * @param string $str1 <p>
 *                     The first string.
 *                     </p>
 * @param string $str2 <p>
 *                     The second string.
 *                     </p>
 * @param int    $len  <p>
 *                     Number of characters to use in the comparison.
 *                     </p>
 *
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i>
 * is greater than <i>str2</i>, and 0 if they are
 * equal.
 * @since 4.0
 * @since 5.0
 */
function strncmp($str1, $str2, $len) { }

/**
 * Search a string for any of a set of characters
 *
 * @link  http://php.net/manual/en/function.strpbrk.php
 *
 * @param string $haystack  <p>
 *                          The string where char_list is looked for.
 *                          </p>
 * @param string $char_list <p>
 *                          This parameter is case sensitive.
 *                          </p>
 *
 * @return string a string starting from the character found, or false if it is
 * not found.
 * @since 5.0
 */
function strpbrk($haystack, $char_list) { }

/**
 * Find the position of the first occurrence of a substring in a string
 *
 * @link  http://php.net/manual/en/function.strpos.php
 *
 * @param string $haystack <p>
 *                         The string to search in
 *                         </p>
 * @param mixed  $needle   <p>
 *                         If <b>needle</b> is not a string, it is converted
 *                         to an integer and applied as the ordinal value of a character.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         If specified, search will start this number of characters counted from
 *                         the beginning of the string. Unlike {@see strrpos()} and {@see strripos()}, the offset
 *                         cannot be negative.
 *                         </p>
 *
 * @return int|boolean <p>
 * Returns the position where the needle exists relative to the beginnning of
 * the <b>haystack</b> string (independent of search direction
 * or offset).
 * Also note that string positions start at 0, and not 1.
 * </p>
 * <p>
 * Returns <b>FALSE</b> if the needle was not found.
 * </p>
 * @since 4.0
 * @since 5.0
 */
function strpos($haystack, $needle, $offset = 0) { }

/**
 * Find the last occurrence of a character in a string
 *
 * @link  http://php.net/manual/en/function.strrchr.php
 *
 * @param string $haystack <p>
 *                         The string to search in
 *                         </p>
 * @param mixed  $needle   <p>
 *                         If <b>needle</b> contains more than one character,
 *                         only the first is used. This behavior is different from that of {@see strstr()}.
 *                         </p>
 *                         <p>
 *                         If <b>needle</b> is not a string, it is converted to
 *                         an integer and applied as the ordinal value of a character.
 *                         </p>
 *
 * @return string <p>
 * This function returns the portion of string, or <b>FALSE</b> if
 * <b>needle</b> is not found.
 * </p>
 * @since 4.0
 * @since 5.0
 */
function strrchr($haystack, $needle) { }

/**
 * Reverse a string
 *
 * @link  http://php.net/manual/en/function.strrev.php
 *
 * @param string $string <p>
 *                       The string to be reversed.
 *                       </p>
 *
 * @return string the reversed string.
 * @since 4.0
 * @since 5.0
 */
function strrev($string) { }

/**
 * Find position of last occurrence of a case-insensitive string in a string
 *
 * @link  http://php.net/manual/en/function.strripos.php
 *
 * @param string $haystack <p>
 *                         The string to search in
 *                         </p>
 * @param string $needle   <p>
 *                         Note that the needle may be a string of one or
 *                         more characters.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         The offset parameter may be specified to begin
 *                         searching an arbitrary number of characters into the string.
 *                         </p>
 *                         <p>
 *                         Negative offset values will start the search at
 *                         offset characters from the
 *                         start of the string.
 *                         </p>
 *
 * @return int the numerical position of the last occurrence of
 * needle. Also note that string positions start at 0,
 * and not 1.
 * </p>
 * <p>
 * If needle is not found, false is returned.
 * @since 5.0
 */
function strripos($haystack, $needle, $offset = null) { }

/**
 * Find the position of the last occurrence of a substring in a string
 *
 * @link  http://php.net/manual/en/function.strrpos.php
 *
 * @param string $haystack <p>
 *                         The string to search in.
 *                         </p>
 * @param string $needle   <p>
 *                         If <b>needle</b> is not a string, it is converted to an integer and applied as the
 *                         ordinal value of a character.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         If specified, search will start this number of characters counted from the beginning of
 *                         the string. If the value is negative, search will instead start from that many
 *                         characters from the end of the string, searching backwards.
 *                         </p>
 *
 * @return int|boolean <p>
 * Returns the position where the needle exists relative to the beginning of
 * the <b>haystack</b> string (independent of search direction
 * or offset).
 * Also note that string positions start at 0, and not 1.
 * </p>
 * <p>
 * Returns <b>FALSE</b> if the needle was not found.
 * </p>
 * @since 4.0
 * @since 5.0
 */
function strrpos($haystack, $needle, $offset = 0) { }

/**
 * Finds the length of the first segment of a string consisting
 *
 * @since 4.0
 * @since 5.0
 * entirely of characters contained within a given mask.
 * @link  http://php.net/manual/en/function.strspn.php
 *
 * @param string $subject <p>
 *                        The string to examine.
 *                        </p>
 * @param string $mask    <p>
 *                        The list of allowable characters to include in counted segments.
 *                        </p>
 * @param int    $start   [optional] <p>
 *                        The position in subject to
 *                        start searching.
 *                        </p>
 *                        <p>
 *                        If start is given and is non-negative,
 *                        then strspn will begin
 *                        examining subject at
 *                        the start'th position. For instance, in
 *                        the string 'abcdef', the character at
 *                        position 0 is 'a', the
 *                        character at position 2 is
 *                        'c', and so forth.
 *                        </p>
 *                        <p>
 *                        If start is given and is negative,
 *                        then strspn will begin
 *                        examining subject at
 *                        the start'th position from the end
 *                        of subject.
 *                        </p>
 * @param int    $length  [optional] <p>
 *                        The length of the segment from subject
 *                        to examine.
 *                        </p>
 *                        <p>
 *                        If length is given and is non-negative,
 *                        then subject will be examined
 *                        for length characters after the starting
 *                        position.
 *                        </p>
 *                        <p>
 *                        If lengthis given and is negative,
 *                        then subject will be examined from the
 *                        starting position up to length
 *                        characters from the end of subject.
 *                        </p>
 *
 * @return int the length of the initial segment of str1
 * which consists entirely of characters in str2.
 */
function strspn($subject, $mask, $start = null, $length = null) { }

/**
 * Find first occurrence of a string
 *
 * @link  http://php.net/manual/en/function.strstr.php
 *
 * @param string $haystack      <p>
 *                              The input string.
 *                              </p>
 * @param mixed  $needle        <p>
 *                              If needle is not a string, it is converted to
 *                              an integer and applied as the ordinal value of a character.
 *                              </p>
 * @param bool   $before_needle [optional] <p>
 *                              If true, strstr returns
 *                              the part of the haystack before the first
 *                              occurrence of the needle.
 *                              </p>
 *
 * @return string the portion of string, or false if needle
 * is not found.
 * @since 4.0
 * @since 5.0
 */
function strstr($haystack, $needle, $before_needle = null) { }

/**
 * Tokenize string
 * Note that only the first call to strtok uses the string argument.
 * Every subsequent call to strtok only needs the token to use, as it keeps track of where it is in the current
 * string. To start over, or to tokenize a new string you simply call strtok with the string argument again to
 * initialize it. Note that you may put multiple tokens in the token parameter. The string will be tokenized when
 * any one of the characters in the argument are found.
 *
 * @link  http://php.net/manual/en/function.strtok.php
 *
 * @param string $str   [optional] <p>
 *                      The string being split up into smaller strings (tokens).
 *                      </p>
 * @param string $token <p>
 *                      The delimiter used when splitting up str.
 *                      </p>
 *
 * @return string A string token.
 * @since 4.0
 * @since 5.0
 */
function strtok($str = null, $token) { }

/**
 * Make a string lowercase
 *
 * @link  http://php.net/manual/en/function.strtolower.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the lowercased string.
 * @since 4.0
 * @since 5.0
 */
function strtolower($str) { }

/**
 * Make a string uppercase
 *
 * @link  http://php.net/manual/en/function.strtoupper.php
 *
 * @param string $string <p>
 *                       The input string.
 *                       </p>
 *
 * @return string the uppercased string.
 * @since 4.0
 * @since 5.0
 */
function strtoupper($string) { }

/**
 * Translate certain characters
 *
 * @link  http://php.net/manual/en/function.strtr.php
 *
 * @param string $str  <p>
 *                     The string being translated.
 *                     </p>
 * @param string $from <p>
 *                     The string replacing from.
 *                     </p>
 * @param string $to   <p>
 *                     The string being translated to to.
 *                     </p>
 *
 * @return string This function returns a copy of str,
 * translating all occurrences of each character in
 * from to the corresponding character in
 * to.
 * @since 4.0
 * @since 5.0
 */
function strtr($str, $from, $to) { }

/**
 * Return part of a string
 *
 * @link  http://php.net/manual/en/function.substr.php
 *
 * @param string $string <p>
 *                       The input string.
 *                       </p>
 * @param int    $start  <p>
 *                       If start is non-negative, the returned string
 *                       will start at the start'th position in
 *                       string, counting from zero. For instance,
 *                       in the string 'abcdef', the character at
 *                       position 0 is 'a', the
 *                       character at position 2 is
 *                       'c', and so forth.
 *                       </p>
 *                       <p>
 *                       If start is negative, the returned string
 *                       will start at the start'th character
 *                       from the end of string.
 *                       </p>
 *                       <p>
 *                       If string is less than or equal to
 *                       start characters long, false will be returned.
 *                       </p>
 *                       <p>
 *                       Using a negative start
 *                       ]]>
 *                       </p>
 * @param int    $length [optional] <p>
 *                       If length is given and is positive, the string
 *                       returned will contain at most length characters
 *                       beginning from start (depending on the length of
 *                       string).
 *                       </p>
 *                       <p>
 *                       If length is given and is negative, then that many
 *                       characters will be omitted from the end of string
 *                       (after the start position has been calculated when a
 *                       start is negative). If
 *                       start denotes a position beyond this truncation,
 *                       an empty string will be returned.
 *                       </p>
 *                       <p>
 *                       If length is given and is 0,
 *                       false or &null; an empty string will be returned.
 *                       </p>
 *                       Using a negative length
 *                       ]]>
 *
 * @return string|bool the extracted part of string or false on failure.
 * @since 4.0
 * @since 5.0
 */
function substr($string, $start, $length = null) { }

/**
 * Binary safe comparison of 2 strings from an offset, up to length characters
 *
 * @link  http://php.net/manual/en/function.substr-compare.php
 *
 * @param string $main_str           <p>
 *                                   The main string being compared.
 *                                   </p>
 * @param string $str                <p>
 *                                   The secondary string being compared.
 *                                   </p>
 * @param int    $offset             <p>
 *                                   The start position for the comparison. If negative, it starts counting
 *                                   from the end of the string.
 *                                   </p>
 * @param int    $length             [optional] <p>
 *                                   The length of the comparison.
 *                                   </p>
 * @param bool   $case_insensitivity [optional] <p>
 *                                   If case_insensitivity is true, comparison is
 *                                   case insensitive.
 *                                   </p>
 *
 * @return int &lt; 0 if main_str from position
 * offset is less than str, &gt;
 * 0 if it is greater than str, and 0 if they are equal.
 * If offset is equal to or greater than the length of
 * main_str or length is set and
 * is less than 1, substr_compare prints a warning and returns
 * false.
 * @since 5.0
 */
function substr_compare($main_str, $str, $offset, $length = null, $case_insensitivity = null) { }

/**
 * Count the number of substring occurrences
 *
 * @link  http://php.net/manual/en/function.substr-count.php
 *
 * @param string $haystack <p>
 *                         The string to search in
 *                         </p>
 * @param string $needle   <p>
 *                         The substring to search for
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         The offset where to start counting
 *                         </p>
 * @param int    $length   [optional] <p>
 *                         The maximum length after the specified offset to search for the
 *                         substring. It outputs a warning if the offset plus the length is
 *                         greater than the haystack length.
 *                         </p>
 *
 * @return int This functions returns an integer.
 * @since 4.0
 * @since 5.0
 */
function substr_count($haystack, $needle, $offset = null, $length = null) { }

/**
 * Replace text within a portion of a string
 *
 * @link  http://php.net/manual/en/function.substr-replace.php
 *
 * @param mixed  $string      <p>
 *                            The input string.
 *                            </p>
 * @param string $replacement <p>
 *                            The replacement string.
 *                            </p>
 * @param int    $start       <p>
 *                            If start is positive, the replacing will
 *                            begin at the start'th offset into
 *                            string.
 *                            </p>
 *                            <p>
 *                            If start is negative, the replacing will
 *                            begin at the start'th character from the
 *                            end of string.
 *                            </p>
 * @param int    $length      [optional] <p>
 *                            If given and is positive, it represents the length of the portion of
 *                            string which is to be replaced. If it is
 *                            negative, it represents the number of characters from the end of
 *                            string at which to stop replacing. If it
 *                            is not given, then it will default to strlen(
 *                            string ); i.e. end the replacing at the
 *                            end of string. Of course, if
 *                            length is zero then this function will have the
 *                            effect of inserting replacement into
 *                            string at the given
 *                            start offset.
 *                            </p>
 *
 * @return mixed The result string is returned. If string is an
 * array then array is returned.
 * @since 4.0
 * @since 5.0
 */
function substr_replace($string, $replacement, $start, $length = null) { }

/**
 * Strip whitespace (or other characters) from the beginning and end of a string
 *
 * @link  http://php.net/manual/en/function.trim.php
 *
 * @param string $str      <p>
 *                         The string that will be trimmed.
 *                         </p>
 * @param string $charlist [optional] <p>
 *                         Optionally, the stripped characters can also be specified using
 *                         the charlist parameter.
 *                         Simply list all characters that you want to be stripped. With
 *                         .. you can specify a range of characters.
 *                         </p>
 *
 * @return string The trimmed string.
 * @since 4.0
 * @since 5.0
 */
function trim($str, $charlist = " \t\n\r\0\x0B") { }

/**
 * Make a string's first character uppercase
 *
 * @link  http://php.net/manual/en/function.ucfirst.php
 *
 * @param string $str <p>
 *                    The input string.
 *                    </p>
 *
 * @return string the resulting string.
 * @since 4.0
 * @since 5.0
 */
function ucfirst($str) { }

/**
 * Uppercase the first character of each word in a string
 *
 * @link  http://php.net/manual/en/function.ucwords.php
 *
 * @param string $str        <p>
 *                           The input string.
 *                           </p>
 * @param string $delimiters [optional] <p>
 *
 * @return string the modified string.
 * @since 4.0
 * @since 5.0
 */
function ucwords($str, $delimiters = " \t\r\n\f\v") { }

/**
 * Write a formatted string to a stream
 *
 * @link  http://php.net/manual/en/function.vfprintf.php
 *
 * @param resource $handle <p>
 *                         </p>
 * @param string   $format <p>
 *                         See sprintf for a description of
 *                         format.
 *                         </p>
 * @param array    $args   <p>
 *                         </p>
 *
 * @return int the length of the outputted string.
 * @since 5.0
 */
function vfprintf($handle, $format, array $args) { }

/**
 * Output a formatted string
 *
 * @link  http://php.net/manual/en/function.vprintf.php
 *
 * @param string $format <p>
 *                       See sprintf for a description of
 *                       format.
 *                       </p>
 * @param array  $args   <p>
 *                       </p>
 *
 * @return int the length of the outputted string.
 * @since 4.1.0
 * @since 5.0
 */
function vprintf($format, array $args) { }

/**
 * Return a formatted string
 *
 * @link  http://php.net/manual/en/function.vsprintf.php
 *
 * @param string $format <p>
 *                       See sprintf for a description of
 *                       format.
 *                       </p>
 * @param array  $args   <p>
 *                       </p>
 *
 * @return string Return array values as a formatted string according to
 * format (which is described in the documentation
 * for sprintf).
 * @since 4.1.0
 * @since 5.0
 */
function vsprintf($format, array $args) { }

/**
 * Wraps a string to a given number of characters
 *
 * @link  http://php.net/manual/en/function.wordwrap.php
 *
 * @param string $str   <p>
 *                      The input string.
 *                      </p>
 * @param int    $width [optional] <p>
 *                      The column width.
 *                      </p>
 * @param string $break [optional] <p>
 *                      The line is broken using the optional
 *                      break parameter.
 *                      </p>
 * @param bool   $cut   [optional] <p>
 *                      If the cut is set to true, the string is
 *                      always wrapped at or before the specified width. So if you have
 *                      a word that is larger than the given width, it is broken apart.
 *                      (See second example).
 *                      </p>
 *
 * @return string the given string wrapped at the specified column.
 * @since 4.0.2
 * @since 5.0
 */
function wordwrap($str, $width = 75, $break = "\n", $cut = false) { }

