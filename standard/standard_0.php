<?php

// Start of standard v.5.3.2-0.dotdeb.1

class __PHP_Incomplete_Class  {
        /**
         * @var string
         */
        public $__PHP_Incomplete_Class_Name;
}

class php_user_filter  {
        public $filtername;
        public $params;


    /**
     * @link https://php.net/manual/en/php-user-filter.filter.php
     * @param resource $in <p> is a resource pointing to a <i>bucket brigade</i< which contains one or more <i>bucket</i> objects containing data to be filtered.</p>
     * @param resource $out <p>is a resource pointing to a second bucket brigade into which your modified buckets should be placed.</p>
     * @param int $consumed <p>which must <i>always</i> be declared by reference, should be incremented by the length of the data which your filter reads in and alters. In most cases this means you will increment consumed by <i>$bucket->datalen</i> for each <i>$bucket</i>.</p>
     * @param bool $closing <p>If the stream is in the process of closing (and therefore this is the last pass through the filterchain), the closing parameter will be set to <b>TRUE</b>
     * @return int <p>
     * The <b>filter()</b> method must return one of
     * three values upon completion.
     * </p><table>
     *
     * <thead>
     * <tr>
     * <th>Return Value</th>
     * <th>Meaning</th>
     * </tr>
     *
     * </thead>
     *
     * <tbody class="tbody">
     * <tr>
     * <td><b>PSFS_PASS_ON</b></td>
     * <td>
     * Filter processed successfully with data available in the
     * <code class="parameter">out</code> <em>bucket brigade</em>.
     * </td>
     * </tr>
     *
     * <tr>
     * <td><b>PSFS_FEED_ME</b></td>
     * <td>
     * Filter processed successfully, however no data was available to
     * return. More data is required from the stream or prior filter.
     * </td>
     * </tr>
     *
     * <tr>
     * <td><b>PSFS_ERR_FATAL</b> (default)</td>
     * <td>
     * The filter experienced an unrecoverable error and cannot continue.
     * </td>
     * </tr>
     *
     */
    public function filter($in, $out, &$consumed, $closing)
    {
    }

    /**
     * @link https://php.net/manual/en/php-user-filter.oncreate.php
     * @return bool
     */
    public function onCreate()
    {
    }

    /**
     * @link https://php.net/manual/en/php-user-filter.onclose.php
     */
    public function onClose()
    {
    }

}

/**
 * Instances of Directory are created by calling the dir() function, not by the new operator.
 */
class Directory  {

    /**
     * @var string The directory that was opened.
     */
    public $path;

    /**
     * @var resource Can be used with other directory functions such as {@see readdir()}, {@see rewinddir()} and {@see closedir()}.
     */
    public $handle;
    
    /**
     * Close directory handle.
     * Same as closedir(), only dir_handle defaults to $this.
     * @param resource $dir_handle [optional]
     * @link https://secure.php.net/manual/en/directory.close.php
     */
    public function close ( $dir_handle ) {}

    /**
     *  Rewind directory handle.
     * Same as rewinddir(), only dir_handle defaults to $this.
     * @param resource $dir_handle [optional]
     * @link https://secure.php.net/manual/en/directory.rewind.php
     */
    public function rewind ( $dir_handle ) {}

    /**
     * Read entry from directory handle.
     * Same as readdir(), only dir_handle defaults to $this.
     * @param resource $dir_handle [optional]
     * @return string
     * @link https://secure.php.net/manual/en/directory.read.php
     */
    public function read ( $dir_handle) { }

}

/**
 * Returns the value of a constant
 * @link https://php.net/manual/en/function.constant.php
 * @param string $name <p>
 * The constant name.
 * </p>
 * @return mixed the value of the constant, or &null; if the constant is not
 * defined.
 * @since 4.0.4
 * @since 5.0
 */
function constant ($name) {}

/**
 * Convert binary data into hexadecimal representation
 * @link https://php.net/manual/en/function.bin2hex.php
 * @param string $str <p>
 * A character.
 * </p>
 * @return string the hexadecimal representation of the given string.
 * @since 4.0
 * @since 5.0
 */
function bin2hex ($str) {}

/**
 * Delay execution
 * @link https://php.net/manual/en/function.sleep.php
 * @param int $seconds <p>
 * Halt time in seconds.
 * </p>
 * @return int zero on success, or false on errors. If the call was interrupted
 * by a signal, sleep returns the number of seconds left
 * to sleep.
 * @since 4.0
 * @since 5.0
 */
function sleep ($seconds) {}

/**
 * Delay execution in microseconds
 * @link https://php.net/manual/en/function.usleep.php
 * @param int $micro_seconds <p>
 * Halt time in micro seconds. A micro second is one millionth of a
 * second.
 * </p>
 * @return void 
 * @since 4.0
 * @since 5.0
 */
function usleep ($micro_seconds) {}

/**
 * Delay for a number of seconds and nanoseconds
 * @link https://php.net/manual/en/function.time-nanosleep.php
 * @param int $seconds <p>
 * Must be a positive integer.
 * </p>
 * @param int $nanoseconds <p>
 * Must be a positive integer less than 1 billion.
 * </p>
 * @return bool|array true on success or false on failure.
 * </p>
 * <p>
 * If the delay was interrupted by a signal, an associative array will be
 * returned with the components:
 * seconds - number of seconds remaining in
 * the delay
 * nanoseconds - number of nanoseconds
 * remaining in the delay
 * @since 5.0
 */
function time_nanosleep ($seconds, $nanoseconds) {}

/**
 * Make the script sleep until the specified time
 * @link https://php.net/manual/en/function.time-sleep-until.php
 * @param float $timestamp <p>
 * The timestamp when the script should wake.
 * </p>
 * @return bool true on success or false on failure.
 * @since 5.1.0
 */
function time_sleep_until ($timestamp) {}

/**
 * Parse a time/date generated with <function>strftime</function>
 * @link https://php.net/manual/en/function.strptime.php
 * @param string $date <p>
 * The string to parse (e.g. returned from strftime)
 * </p>
 * @param string $format <p>
 * The format used in date (e.g. the same as
 * used in strftime).
 * </p>
 * <p>
 * For more information about the format options, read the
 * strftime page.
 * </p>
 * @return array|bool an array or false on failure.
 * </p>
 * <p>
 * <table>
 * The following parameters are returned in the array
 * <tr valign="top">
 * <td>parameters</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_sec"</td>
 * <td>Seconds after the minute (0-61)</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_min"</td>
 * <td>Minutes after the hour (0-59)</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_hour"</td>
 * <td>Hour since midnight (0-23)</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_mday"</td>
 * <td>Day of the month (1-31)</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_mon"</td>
 * <td>Months since January (0-11)</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_year"</td>
 * <td>Years since 1900</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_wday"</td>
 * <td>Days since Sunday (0-6)</td>
 * </tr>
 * <tr valign="top">
 * <td>"tm_yday"</td>
 * <td>Days since January 1 (0-365)</td>
 * </tr>
 * <tr valign="top">
 * <td>"unparsed"</td>
 * <td>the date part which was not
 * recognized using the specified format</td>
 * </tr>
 * </table>
 * @since 5.1.0
 */
function strptime ($date, $format) {}

/**
 * Flush the output buffer
 * @link https://php.net/manual/en/function.flush.php
 * @return void 
 * @since 4.0
 * @since 5.0
 */
function flush () {}

/**
 * Wraps a string to a given number of characters
 * @link https://php.net/manual/en/function.wordwrap.php
 * @param string $str <p>
 * The input string.
 * </p>
 * @param int $width [optional] <p>
 * The column width.
 * </p>
 * @param string $break [optional] <p>
 * The line is broken using the optional
 * break parameter.
 * </p>
 * @param bool $cut [optional] <p>
 * If the cut is set to true, the string is
 * always wrapped at or before the specified width. So if you have
 * a word that is larger than the given width, it is broken apart.
 * (See second example).
 * </p>
 * @return string the given string wrapped at the specified column.
 * @since 4.0.2
 * @since 5.0
 */
function wordwrap ($str, $width = 75, $break = "\n", $cut = false) {}

/**
 * Convert special characters to HTML entities
 * @link https://php.net/manual/en/function.htmlspecialchars.php
 * @param string $string <p>
 * The {@link https://secure.php.net/manual/en/language.types.string.php string} being converted.
 * </p>
 * @param int $flags [optional] <p>
 * A bitmask of one or more of the following flags, which specify how to handle quotes,
 * invalid code unit sequences and the used document type. The default is
 * <em><b>ENT_COMPAT | ENT_HTML401</b></em>.
 * </p><table>
 * <caption><b>Available <em>flags</em> constants</b></caption>
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
 * {@link https://unicode.org/reports/tr36/#Deletion_of_Noncharacters »&nbsp;may have security implications}.
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
 * @param string $encoding [optional] <p>
 * Defines encoding used in conversion.
 * If omitted, the default value for this argument is ISO-8859-1 in
 * versions of PHP prior to 5.4.0, and UTF-8 from PHP 5.4.0 onwards.
 * </p>
 * <p>
 * For the purposes of this function, the encodings
 * <em>ISO-8859-1</em>, <em>ISO-8859-15</em>,
 * <em>UTF-8</em>, <em>cp866</em>,
 * <em>cp1251</em>, <em>cp1252</em>, and
 * <em>KOI8-R</em> are effectively equivalent, provided the
 * <em><b>string</b></em> itself is valid for the encoding, as
 * the characters affected by  <b>htmlspecialchars()</b> occupy
 * the same positions in all of these encodings.
 * </p>
 * @param bool $double_encode [optional] <p>
 * When <em><b>double_encode</b></em> is turned off PHP will not
 * encode existing html entities, the default is to convert everything.
 * </p>
 * @return string The converted string.
 * @since 4.0
 * @since 5.0
 */
function htmlspecialchars ($string, $flags = ENT_COMPAT | ENT_HTML401, $encoding = 'UTF-8', $double_encode = true) {}

/**
 * Convert all applicable characters to HTML entities
 * @link https://php.net/manual/en/function.htmlentities.php
 * @param string $string <p>
 * The input string.
 * </p>
 * @param int $quote_style [optional] <p>
 * Like htmlspecialchars, the optional second
 * quote_style parameter lets you define what will
 * be done with 'single' and "double" quotes. It takes on one of three
 * constants with the default being ENT_COMPAT:
 * <table>
 * Available quote_style constants
 * <tr valign="top">
 * <td>Constant Name</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_COMPAT</td>
 * <td>Will convert double-quotes and leave single-quotes alone.</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_QUOTES</td>
 * <td>Will convert both double and single quotes.</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_NOQUOTES</td>
 * <td>Will leave both double and single quotes unconverted.</td>
 * </tr>
 * </table>
 * </p>
 * @param string $charset [optional] <p>
 * Like htmlspecialchars, it takes an optional
 * third argument charset which defines character
 * set used in conversion.
 * Presently, the ISO-8859-1 character set is used as the default.
 * </p>
 * &reference.strings.charsets;
 * @param bool $double_encode [optional] <p>
 * When double_encode is turned off PHP will not
 * encode existing html entities. The default is to convert everything.
 * </p>
 * @return string the encoded string.
 * @since 4.0
 * @since 5.0
 */
function htmlentities ($string, $quote_style = null, $charset = null, $double_encode = true) {}

/**
 * Convert all HTML entities to their applicable characters
 * @link https://php.net/manual/en/function.html-entity-decode.php
 * @param string $string <p>
 * The input string.
 * </p>
 * @param int $quote_style [optional] <p>
 * The optional second quote_style parameter lets
 * you define what will be done with 'single' and "double" quotes. It takes
 * on one of three constants with the default being
 * ENT_COMPAT:
 * <table>
 * Available quote_style constants
 * <tr valign="top">
 * <td>Constant Name</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_COMPAT</td>
 * <td>Will convert double-quotes and leave single-quotes alone.</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_QUOTES</td>
 * <td>Will convert both double and single quotes.</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_NOQUOTES</td>
 * <td>Will leave both double and single quotes unconverted.</td>
 * </tr>
 * </table>
 * </p>
 * @param string $charset [optional] <p>
 * The ISO-8859-1 character set is used as default for the optional third
 * charset. This defines the character set used in
 * conversion.
 * </p>
 * &reference.strings.charsets;
 * @return string the decoded string.
 * @since 4.3.0
 * @since 5.0
 */
function html_entity_decode ($string, $quote_style = null, $charset = null) {}

/**
 * Convert special HTML entities back to characters
 * @link https://php.net/manual/en/function.htmlspecialchars-decode.php
 * @param string $string <p>
 * The string to decode
 * </p>
 * @param int $quote_style [optional] <p>
 * The quote style. One of the following constants:
 * <table>
 * quote_style constants
 * <tr valign="top">
 * <td>Constant Name</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_COMPAT</td>
 * <td>Will convert double-quotes and leave single-quotes alone
 * (default)</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_QUOTES</td>
 * <td>Will convert both double and single quotes</td>
 * </tr>
 * <tr valign="top">
 * <td>ENT_NOQUOTES</td>
 * <td>Will leave both double and single quotes unconverted</td>
 * </tr>
 * </table>
 * </p>
 * @return string the decoded string.
 * @since 5.1.0
 */
function htmlspecialchars_decode ($string, $quote_style = null) {}

/**
 * Returns the translation table used by <function>htmlspecialchars</function> and <function>htmlentities</function>
 * @link https://php.net/manual/en/function.get-html-translation-table.php
 * @param int $table [optional] <p>
 * There are two new constants (HTML_ENTITIES,
 * HTML_SPECIALCHARS) that allow you to specify the
 * table you want.
 * </p>
 * @param int $quote_style [optional] <p>
 * Like the htmlspecialchars and
 * htmlentities functions you can optionally specify
 * the quote_style you are working with.
 * See the description
 * of these modes in htmlspecialchars.
 * </p>
 * @param string $encoding <dd>
 *
 * <p>
 * Encoding to use.
 * If omitted, the default value for this argument is ISO-8859-1 in
 * versions of PHP prior to 5.4.0, and UTF-8 from PHP 5.4.0 onwards.
 * </p>
 *
 *
 * <p>
 * The following character sets are supported:
 * </p><table class="doctable table">
 * <caption><strong>Supported charsets</strong></caption>
 *
 * <thead>
 * <tr>
 * <th>Charset</th>
 * <th>Aliases</th>
 * <th>Description</th>
 * </tr>
 *
 * </thead>
 *
 * <tbody class="tbody">
 * <tr>
 * <td>ISO-8859-1</td>
 * <td>ISO8859-1</td>
 * <td>
 * Western European, Latin-1.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>ISO-8859-5</td>
 * <td>ISO8859-5</td>
 * <td>
 * Little used cyrillic charset (Latin/Cyrillic).
 * </td>
 * </tr>
 *
 * <tr>
 * <td>ISO-8859-15</td>
 * <td>ISO8859-15</td>
 * <td>
 * Western European, Latin-9. Adds the Euro sign, French and Finnish
 * letters missing in Latin-1 (ISO-8859-1).
 * </td>
 * </tr>
 *
 * <tr>
 * <td>UTF-8</td>
 * <td class="empty">&nbsp;</td>
 * <td>
 * ASCII compatible multi-byte 8-bit Unicode.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>cp866</td>
 * <td>ibm866, 866</td>
 * <td>
 * DOS-specific Cyrillic charset.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>cp1251</td>
 * <td>Windows-1251, win-1251, 1251</td>
 * <td>
 * Windows-specific Cyrillic charset.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>cp1252</td>
 * <td>Windows-1252, 1252</td>
 * <td>
 * Windows specific charset for Western European.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>KOI8-R</td>
 * <td>koi8-ru, koi8r</td>
 * <td>
 * Russian.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>BIG5</td>
 * <td>950</td>
 * <td>
 * Traditional Chinese, mainly used in Taiwan.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>GB2312</td>
 * <td>936</td>
 * <td>
 * Simplified Chinese, national standard character set.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>BIG5-HKSCS</td>
 * <td class="empty">&nbsp;</td>
 * <td>
 * Big5 with Hong Kong extensions, Traditional Chinese.
 * </td>
 * </tr>
 *
 * <tr>
 * <td>Shift_JIS</td>
 * <td>SJIS, SJIS-win, cp932, 932</td>
 * <td>
 * Japanese
 * </td>
 * </tr>
 *
 * <tr>
 * <td>EUC-JP</td>
 * <td>EUCJP, eucJP-win</td>
 * <td>
 * Japanese
 * </td>
 * </tr>
 *
 * <tr>
 * <td>MacRoman</td>
 * <td class="empty">&nbsp;</td>
 * <td>
 * Charset that was used by Mac OS.
 * </td>
 * </tr>
 *
 * <tr>
 * <td><em>''</em></td>
 * <td class="empty">&nbsp;</td>
 * <td>
 * An empty string activates detection from script encoding (Zend multibyte),
 * {@link https://php.net/manual/en/ini.core.php#ini.default-charset default_charset} and current
 * locale {@link https://php.net/manual/en/function.nl-langinfo.php nl_langinfo()} and
 * {@link https://php.net/manual/en/function.setlocale.php setlocale()}), in this order. Not recommended.
 * </td>
 * </tr>
 *
 * </tbody>
 *
 * </table>
 *
 * <blockquote><p><strong>Note</strong>:
 *
 * Any other character sets are not recognized. The default encoding will be
 * used instead and a warning will be emitted.
 *
 * </p></blockquote>
 * @return array the translation table as an array.
 * @since 4.0
 * @since 5.0
 */
function get_html_translation_table ($table = null, $quote_style = null, string $encoding = "UTF-8") {}

/**
 * Calculate the sha1 hash of a string
 * @link https://php.net/manual/en/function.sha1.php
 * @param string $str <p>
 * The input string.
 * </p>
 * @param bool $raw_output [optional] <p>
 * If the optional raw_output is set to true,
 * then the sha1 digest is instead returned in raw binary format with a
 * length of 20, otherwise the returned value is a 40-character
 * hexadecimal number.
 * </p>
 * @return string the sha1 hash as a string.
 * @since 4.3.0
 * @since 5.0
 */
function sha1 ($str, $raw_output = null) {}

/**
 * Calculate the sha1 hash of a file
 * @link https://php.net/manual/en/function.sha1-file.php
 * @param string $filename <p>
 * The filename
 * </p>
 * @param bool $raw_output [optional] <p>
 * When true, returns the digest in raw binary format with a length of
 * 20.
 * </p>
 * @return string a string on success, false otherwise.
 * @since 4.3.0
 * @since 5.0
 */
function sha1_file ($filename, $raw_output = null) {}

/**
 * Calculate the md5 hash of a string
 * @link https://php.net/manual/en/function.md5.php
 * @param string $str <p>
 * The string.
 * </p>
 * @param bool $raw_output [optional] <p>
 * If the optional raw_output is set to true,
 * then the md5 digest is instead returned in raw binary format with a
 * length of 16.
 * </p>
 * @return string the hash as a 32-character hexadecimal number.
 * @since 4.0
 * @since 5.0
 */
function md5 ($str, $raw_output = null) {}

/**
 * Calculates the md5 hash of a given file
 * @link https://php.net/manual/en/function.md5-file.php
 * @param string $filename <p>
 * The filename
 * </p>
 * @param bool $raw_output [optional] <p>
 * When true, returns the digest in raw binary format with a length of
 * 16.
 * </p>
 * @return string a string on success, false otherwise.
 * @since 4.2.0
 * @since 5.0
 */
function md5_file ($filename, $raw_output = null) {}

/**
 * Calculates the crc32 polynomial of a string
 * @link https://php.net/manual/en/function.crc32.php
 * @param string $str <p>
 * The data.
 * </p>
 * @return int the crc32 checksum of str as an integer.
 * @since 4.0.1
 * @since 5.0
 */
function crc32 ($str) {}

/**
 * Parse a binary IPTC block into single tags.
 * @link https://php.net/manual/en/function.iptcparse.php
 * @param string $iptcblock <p>
 * A binary IPTC block.
 * </p>
 * @return array an array using the tagmarker as an index and the value as the
 * value. It returns false on error or if no IPTC data was found.
 * @since 4.0
 * @since 5.0
 */
function iptcparse ($iptcblock) {}

/**
 * Embeds binary IPTC data into a JPEG image
 * @link https://php.net/manual/en/function.iptcembed.php
 * @param string $iptcdata <p>
 * The data to be written.
 * </p>
 * @param string $jpeg_file_name <p>
 * Path to the JPEG image.
 * </p>
 * @param int $spool [optional] <p>
 * Spool flag. If the spool flag is over 2 then the JPEG will be 
 * returned as a string.
 * </p>
 * @return mixed If success and spool flag is lower than 2 then the JPEG will not be 
 * returned as a string, false on errors.
 * @since 4.0
 * @since 5.0
 */
function iptcembed ($iptcdata, $jpeg_file_name, $spool = null) {}

/**
 * Get the size of an image
 * @link https://php.net/manual/en/function.getimagesize.php
 * @param string $filename <p>
 * This parameter specifies the file you wish to retrieve information
 * about. It can reference a local file or (configuration permitting) a
 * remote file using one of the supported streams. 
 * </p>
 * @param array $imageinfo [optional] <p>
 * This optional parameter allows you to extract some extended
 * information from the image file. Currently, this will return the
 * different JPG APP markers as an associative array.
 * Some programs use these APP markers to embed text information in 
 * images. A very common one is to embed 
 * IPTC information in the APP13 marker.
 * You can use the iptcparse function to parse the
 * binary APP13 marker into something readable.
 * </p>
 * @return array|bool an array with 7 elements.
 * </p>
 * <p>
 * Index 0 and 1 contains respectively the width and the height of the image.
 * </p>
 * <p>
 * Some formats may contain no image or may contain multiple images. In these
 * cases, getimagesize might not be able to properly
 * determine the image size. getimagesize will return
 * zero for width and height in these cases.
 * </p>
 * <p>
 * Index 2 is one of the IMAGETYPE_XXX constants indicating 
 * the type of the image.
 * </p>
 * <p>
 * Index 3 is a text string with the correct 
 * height="yyy" width="xxx" string that can be used
 * directly in an IMG tag.
 * </p>
 * <p>
 * mime is the correspondant MIME type of the image.
 * This information can be used to deliver images with correct the HTTP 
 * Content-type header:
 * getimagesize and MIME types
 * ]]>
 * </p>
 * <p>
 * channels will be 3 for RGB pictures and 4 for CMYK
 * pictures.
 * </p>
 * <p>
 * bits is the number of bits for each color.
 * </p>
 * <p>
 * For some image types, the presence of channels and
 * bits values can be a bit
 * confusing. As an example, GIF always uses 3 channels
 * per pixel, but the number of bits per pixel cannot be calculated for an
 * animated GIF with a global color table.
 * </p>
 * <p>
 * On failure, false is returned.
 * @since 4.0
 * @since 5.0
 */
function getimagesize ($filename, array &$imageinfo = null) {}

/**
 * Return an image containing the affine tramsformed src image, using an optional clipping area
 * @link https://secure.php.net/manual/en/function.imageaffine.php
 * @param resource $image <p>An image resource, returned by one of the image creation functions,
 * such as {@link https://secure.php.net/manual/en/function.imagecreatetruecolor.php imagecreatetruecolor()}.</p>
 * @param array $affine <p>Array with keys 0 to 5.</p>
 * @param array $clip [optional] <p>Array with keys "x", "y", "width" and "height".</p>
 * @return resource|bool Return affined image resource on success or FALSE on failure.
 */
function imageaffine($image, $affine, $clip = null) {}

/**
 * Concat two matrices (as in doing many ops in one go)
 * @link https://secure.php.net/manual/en/function.imageaffinematrixconcat.php
 * @param array $m1 <p>Array with keys 0 to 5.</p>
 * @param array $m2 <p>Array with keys 0 to 5.</p>
 * @return array|bool Array with keys 0 to 5 and float values or <b>FALSE</b> on failure.
 * @since 5.5.0
 */
function imageaffinematrixconcat(array $m1, array $m2) {}

/**
 * Return an image containing the affine tramsformed src image, using an optional clipping area
 * @link https://secure.php.net/manual/en/function.imageaffinematrixget.php
 * @param int $type <p> One of <b>IMG_AFFINE_*</b> constants.
 * @param mixed $options [optional]
 * @return array|bool Array with keys 0 to 5 and float values or <b>FALSE</b> on failure.
 * @since 5.5.0
 */

function imageaffinematrixget ($type, $options = null) {}

/**
 * Crop an image using the given coordinates and size, x, y, width and height
 * @link https://secure.php.net/manual/en/function.imagecrop.php
 * @param resource $image <p>
 * An image resource, returned by one of the image creation functions, such as {@link https://secure.php.net/manual/en/function.imagecreatetruecolor.php imagecreatetruecolor()}.
 * </p>
 * @param array $rect <p>Array with keys "x", "y", "width" and "height".</p>
 * @return resource|bool Return cropped image resource on success or FALSE on failure.
 * @since 5.5.0
 */
function imagecrop ($image, $rect) {}

/**
 * Crop an image automatically using one of the available modes
 * @link https://secure.php.net/manual/en/function.imagecropauto.php
 * @param resource $image <p>
 * An image resource, returned by one of the image creation functions, such as {@link https://secure.php.net/manual/en/function.imagecreatetruecolor.php imagecreatetruecolor()}.
 * </p>
 * @param int $mode [optional] <p>
 * One of <b>IMG_CROP_*</b> constants.
 * </p>
 * @param float $threshold [optional] <p>
 * Used <b>IMG_CROP_THRESHOLD</b> mode.
 * </p>
 * @param int $color [optional]
 * <p>
 * Used in <b>IMG_CROP_THRESHOLD</b> mode.
 * </p>
 * @return resource|bool Return cropped image resource on success or <b>FALSE</b> on failure.
 * @since 5.5.0
 */
function imagecropauto ($image, $mode = -1, $threshold = .5, $color = -1) {}

/**
 * Flips an image using a given mode
 * @link https://secure.php.net/manual/en/function.imageflip.php
 * @param resource $image <p>
 * An image resource, returned by one of the image creation functions, such as {@link https://secure.php.net/manual/en/function.imagecreatetruecolor.php imagecreatetruecolor()}.
 * </p>
 * @param int $mode <p>
 * Flip mode, this can be one of the <b>IMG_FLIP_*</b> constants:
 * </p>
 * <table>
 * <thead>
 * <tr>
 * <th>Constant</th>
 * <th>Meaning</th>
 * </tr>
 * </thead>
 * <tr>
 * <td><b>IMG_FLIP_HORIZONTAL</b></td>
 * <td>
 * Flips the image horizontally.
 * </td>
 * </tr>
 * <tr>
 * <td><b>IMG_FLIP_VERTICAL</b></td>
 * <td>
 * Flips the image vertically.
 * </td>
 * </tr>
 * <tr>
 * <td><b>IMG_FLIP_BOTH</b></td>
 * <td>
 * Flips the image both horizontally and vertically.
 * </td>
 * </tr>
 * </tbody>
 * </table>
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.5.0
 */
function imageflip ($image, $mode) {}

/**
 * Converts a palette based image to true color
 * @link https://secure.php.net/manual/en/function.imagepalettetotruecolor.php
 * @param resource $image <p>
 * An image resource, returnd by one of the image creation functions, such as {@link https://secure.php.net/manual/en/function.imagecreatetruecolor.php imagecreatetruecolor()}.
 * </p>
 * @return bool Returns <b>TRUE</b> if the convertion was complete, or if the source image already is a true color image, otherwise <b>FALSE</b> is returned.
 * @since 5.5.0
 */
function imagepalettetotruecolor ($image) {}

/**
 * @since 5.5.0
 * Scale an image using the given new width and height
 * @link https://secure.php.net/manual/en/function.imagescale.php
 * @param resource $image <p>
 * An image resource, returnd by one of the image creation functions, such as {@link https://secure.php.net/manual/en/function.imagecreatetruecolor.php imagecreatetruecolor()}.
 * </p>
 * @param int $new_width
 * @param int $new_height [optional]
 * @param int $mode [optional] One of <b>IMG_NEAREST_NEIGHBOUR</b>, <b>IMG_BILINEAR_FIXED</b>, <b>IMG_BICUBIC</b>, <b>IMG_BICUBIC_FIXED</b> or anything else (will use two pass).
 * @return resource|bool Return scaled image resource on success or <b>FALSE</b> on failure.
 */

function imagescale ($image, $new_width, $new_height = -1, $mode = IMG_BILINEAR_FIXED) {}

/**
 * Set the interpolation method
 * @link https://secure.php.net/manual/en/function.imagesetinterpolation.php
 * @param resource $image <p>
 * An image resource, returned by one of the image creation functions, such as {@link https://secure.php.net/manual/en/function.imagecreatetruecolor.php imagecreatetruecolor()}.
 * </p>
 * @param int $method <p>
 * The interpolation method, which can be one of the following:
 * <ul>
 * <li>
 * IMG_BELL: Bell filter.
 * </li>
 * <li>
 * IMG_BESSEL: Bessel filter.
 * </li>
 * <li>
 * IMG_BICUBIC: Bicubic interpolation.
 * </li>
 * <li>
 * IMG_BICUBIC_FIXED: Fixed point implementation of the bicubic interpolation.
 * </li>
 * <li>
 * IMG_BILINEAR_FIXED: Fixed point implementation of the  bilinear interpolation (<em>default (also on image creation)</em>).
 * </li>
 * <li>
 * IMG_BLACKMAN: Blackman window function.
 * </li>
 * <li>
 * IMG_BOX: Box blur filter.
 * </li>
 * <li>
 * IMG_BSPLINE: Spline interpolation.
 * </li>
 * <li>
 * IMG_CATMULLROM: Cubbic Hermite spline interpolation.
 * </li>
 * <li>
 * IMG_GAUSSIAN: Gaussian function.
 * </li>
 * <li>
 * IMG_GENERALIZED_CUBIC: Generalized cubic spline fractal interpolation.
 * </li>
 * <li>
 * IMG_HERMITE: Hermite interpolation.
 * </li>
 * <li>
 * IMG_HAMMING: Hamming filter.
 * </li>
 * <li>
 * IMG_HANNING: Hanning filter.
 * </li>
 * <li>
 * IMG_MITCHELL: Mitchell filter.
 * </li>
 * <li>
 * IMG_POWER: Power interpolation.
 * </li>
 * <li>
 * IMG_QUADRATIC: Inverse quadratic interpolation.
 * </li>
 * <li>
 * IMG_SINC: Sinc function.
 * </li>
 * <li>
 * IMG_NEAREST_NEIGHBOUR: Nearest neighbour interpolation.
 * </li>
 * <li>
 * IMG_WEIGHTED4: Weighting filter.
 * </li>
 * <li>
 * IMG_TRIANGLE: Triangle interpolation.
 * </li>
 * </ul>
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 * @since 5.5.0
 */
function imagesetinterpolation ($image, $method = IMG_BILINEAR_FIXED) {}

/**
 * Get Mime-Type for image-type returned by getimagesize,
 * @since 4.3.0
 * @since 5.0
   exif_read_data, exif_thumbnail, exif_imagetype
 * @link https://php.net/manual/en/function.image-type-to-mime-type.php
 * @param int $imagetype <p>
 * One of the IMAGETYPE_XXX constants.
 * </p>
 * @return string The returned values are as follows
 * <table>
 * Returned values Constants
 * <tr valign="top">
 * <td>imagetype</td>
 * <td>Returned value</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_GIF</td>
 * <td>image/gif</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_JPEG</td>
 * <td>image/jpeg</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_PNG</td>
 * <td>image/png</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_SWF</td>
 * <td>application/x-shockwave-flash</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_PSD</td>
 * <td>image/psd</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_BMP</td>
 * <td>image/bmp</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_TIFF_II (intel byte order)</td>
 * <td>image/tiff</td>
 * </tr>
 * <tr valign="top">
 * <td>
 * IMAGETYPE_TIFF_MM (motorola byte order)
 * </td>
 * <td>image/tiff</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_JPC</td>
 * <td>application/octet-stream</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_JP2</td>
 * <td>image/jp2</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_JPX</td>
 * <td>application/octet-stream</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_JB2</td>
 * <td>application/octet-stream</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_SWC</td>
 * <td>application/x-shockwave-flash</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_IFF</td>
 * <td>image/iff</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_WBMP</td>
 * <td>image/vnd.wap.wbmp</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_XBM</td>
 * <td>image/xbm</td>
 * </tr>
 * <tr valign="top">
 * <td>IMAGETYPE_ICO</td>
 * <td>image/vnd.microsoft.icon</td>
 * </tr>
 * </table>
 */
function image_type_to_mime_type ($imagetype) {}

/**
 * Get file extension for image type
 * @link https://php.net/manual/en/function.image-type-to-extension.php
 * @param int $imagetype <p>
 * One of the IMAGETYPE_XXX constant.
 * </p>
 * @param bool $include_dot [optional] <p>
 * Whether to prepend a dot to the extension or not. Default to true.
 * </p>
 * @return string A string with the extension corresponding to the given image type.
 * @since 5.0
 */
function image_type_to_extension ($imagetype, $include_dot = null) {}

/**
 * Outputs lots of PHP information
 * @link https://php.net/manual/en/function.phpinfo.php
 * @param int $what [optional] <p>
 * The output may be customized by passing one or more of the
 * following constants bitwise values summed
 * together in the optional what parameter.
 * One can also combine the respective constants or bitwise values
 * together with the or operator.
 * </p>
 * <p>
 * <table>
 * phpinfo options
 * <tr valign="top">
 * <td>Name (constant)</td>
 * <td>Value</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_GENERAL</td>
 * <td>1</td>
 * <td>
 * The configuration line, &php.ini; location, build date, Web
 * Server, System and more.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_CREDITS</td>
 * <td>2</td>
 * <td>
 * PHP Credits. See also phpcredits.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_CONFIGURATION</td>
 * <td>4</td>
 * <td>
 * Current Local and Master values for PHP directives. See
 * also ini_get.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_MODULES</td>
 * <td>8</td>
 * <td>
 * Loaded modules and their respective settings. See also
 * get_loaded_extensions.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_ENVIRONMENT</td>
 * <td>16</td>
 * <td>
 * Environment Variable information that's also available in
 * $_ENV.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_VARIABLES</td>
 * <td>32</td>
 * <td>
 * Shows all 
 * predefined variables from EGPCS (Environment, GET,
 * POST, Cookie, Server).
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_LICENSE</td>
 * <td>64</td>
 * <td>
 * PHP License information. See also the license FAQ.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>INFO_ALL</td>
 * <td>-1</td>
 * <td>
 * Shows all of the above.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function phpinfo ($what = null) {}

/**
 * Gets the current PHP version
 * @link https://php.net/manual/en/function.phpversion.php
 * @param string $extension [optional] <p>
 * An optional extension name.
 * </p>
 * @return string If the optional extension parameter is
 * specified, phpversion returns the version of that
 * extension, or false if there is no version information associated or
 * the extension isn't enabled.
 * @since 4.0
 * @since 5.0
 */
function phpversion ($extension = null) {}

/**
 * Prints out the credits for PHP
 * @link https://php.net/manual/en/function.phpcredits.php
 * @param int $flag [optional] <p>
 * To generate a custom credits page, you may want to use the
 * flag parameter.
 * </p>
 * <p>
 * <table>
 * Pre-defined phpcredits flags
 * <tr valign="top">
 * <td>name</td>
 * <td>description</td>
 * </tr>
 * <tr valign="top">
 * <td>CREDITS_ALL</td>
 * <td>
 * All the credits, equivalent to using: CREDITS_DOCS +
 * CREDITS_GENERAL + CREDITS_GROUP +
 * CREDITS_MODULES + CREDITS_FULLPAGE.
 * It generates a complete stand-alone HTML page with the appropriate tags.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CREDITS_DOCS</td>
 * <td>The credits for the documentation team</td>
 * </tr>
 * <tr valign="top">
 * <td>CREDITS_FULLPAGE</td>
 * <td>
 * Usually used in combination with the other flags. Indicates
 * that a complete stand-alone HTML page needs to be
 * printed including the information indicated by the other
 * flags.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CREDITS_GENERAL</td>
 * <td>
 * General credits: Language design and concept, PHP 4.0
 * authors and SAPI module.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CREDITS_GROUP</td>
 * <td>A list of the core developers</td>
 * </tr>
 * <tr valign="top">
 * <td>CREDITS_MODULES</td>
 * <td>
 * A list of the extension modules for PHP, and their authors
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CREDITS_SAPI</td>
 * <td>
 * A list of the server API modules for PHP, and their authors
 * </td>
 * </tr>
 * </table>
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function phpcredits ($flag = null) {}

/**
 * @deprecated 5.5 Removed in PHP 5.5
 * Gets the logo guid
 * @link https://php.net/manual/en/function.php-logo-guid.php
 * @return string PHPE9568F34-D428-11d2-A769-00AA001ACF42.
 * @since 4.0
 * @since 5.0
 */
function php_logo_guid () {}

/**
 * @deprecated 5.5 Removed in PHP 5.5
 * @since 4.0
 * @since 5.0
 */
function php_real_logo_guid () {}

/**
 * @deprecated 5.5 Removed in PHP 5.5
 * @since 4.0
 * @since 5.0
 */
function php_egg_logo_guid () {}

/**
 * @deprecated 5.5 Removed in PHP 5.5
 * Gets the Zend guid
 * @link https://php.net/manual/en/function.zend-logo-guid.php
 * @return string PHPE9568F35-D428-11d2-A769-00AA001ACF42.
 * @since 4.0
 * @since 5.0
 */
function zend_logo_guid () {}

/**
 * Returns the type of interface between web server and PHP
 * @link https://php.net/manual/en/function.php-sapi-name.php
 * @return string the interface type, as a lowercase string.
 * </p>
 * <p>
 * Although not exhaustive, the possible return values include 
 * aolserver, apache, 
 * apache2filter, apache2handler, 
 * caudium, cgi (until PHP 5.3), 
 * cgi-fcgi, cli, 
 * continuity, embed,
 * isapi, litespeed, 
 * milter, nsapi, 
 * phttpd, pi3web, roxen,
 * thttpd, tux, and webjames.
 * @since 4.0.1
 * @since 5.0
 */
function php_sapi_name () {}

/**
 * Returns information about the operating system PHP is running on
 * @link https://php.net/manual/en/function.php-uname.php
 * @param string $mode [optional] <p>
 * mode is a single character that defines what
 * information is returned:
 * 'a': This is the default. Contains all modes in
 * the sequence "s n r v m".
 * @return string the description, as a string.
 * @since 4.0.2
 * @since 5.0
 */
function php_uname ($mode = null) {}

/**
 * Return a list of .ini files parsed from the additional ini dir
 * @link https://php.net/manual/en/function.php-ini-scanned-files.php
 * @return string a comma-separated string of .ini files on success. Each comma is
 * followed by a newline. If the directive --with-config-file-scan-dir wasn't set,
 * false is returned. If it was set and the directory was empty, an
 * empty string is returned. If a file is unrecognizable, the file will
 * still make it into the returned string but a PHP error will also result.
 * This PHP error will be seen both at compile time and while using
 * php_ini_scanned_files.
 * @since 4.3.0
 * @since 5.0
 */
function php_ini_scanned_files () {}

/**
 * Retrieve a path to the loaded php.ini file
 * @link https://php.net/manual/en/function.php-ini-loaded-file.php
 * @return string The loaded &php.ini; path, or false if one is not loaded.
 * @since 5.2.4
 */
function php_ini_loaded_file () {}

/**
 * String comparisons using a "natural order" algorithm
 * @link https://php.net/manual/en/function.strnatcmp.php
 * @param string $str1 <p>
 * The first string.
 * </p>
 * @param string $str2 <p>
 * The second string.
 * </p>
 * @return int Similar to other string comparison functions, this one returns &lt; 0 if
 * str1 is less than str2; &gt;
 * 0 if str1 is greater than
 * str2, and 0 if they are equal.
 * @since 4.0
 * @since 5.0
 */
function strnatcmp ($str1, $str2) {}

/**
 * Case insensitive string comparisons using a "natural order" algorithm
 * @link https://php.net/manual/en/function.strnatcasecmp.php
 * @param string $str1 <p>
 * The first string.
 * </p>
 * @param string $str2 <p>
 * The second string.
 * </p>
 * @return int Similar to other string comparison functions, this one returns &lt; 0 if
 * str1 is less than str2 &gt;
 * 0 if str1 is greater than
 * str2, and 0 if they are equal.
 * @since 4.0
 * @since 5.0
 */
function strnatcasecmp ($str1, $str2) {}

/**
 * Count the number of substring occurrences
 * @link https://php.net/manual/en/function.substr-count.php
 * @param string $haystack <p>
 * The string to search in
 * </p>
 * @param string $needle <p>
 * The substring to search for
 * </p>
 * @param int $offset [optional] <p>
 * The offset where to start counting
 * </p>
 * @param int $length [optional] <p>
 * The maximum length after the specified offset to search for the
 * substring. It outputs a warning if the offset plus the length is
 * greater than the haystack length.
 * </p>
 * @return int This functions returns an integer.
 * @since 4.0
 * @since 5.0
 */
function substr_count ($haystack, $needle, $offset = null, $length = null) {}

/**
 * Finds the length of the first segment of a string consisting
 * @since 4.0
 * @since 5.0
   entirely of characters contained within a given mask.
 * @link https://php.net/manual/en/function.strspn.php
 * @param string $subject <p>
 * The string to examine.
 * </p>
 * @param string $mask <p>
 * The list of allowable characters to include in counted segments.
 * </p>
 * @param int $start [optional] <p>
 * The position in subject to
 * start searching.
 * </p>
 * <p>
 * If start is given and is non-negative,
 * then strspn will begin
 * examining subject at
 * the start'th position. For instance, in
 * the string 'abcdef', the character at
 * position 0 is 'a', the
 * character at position 2 is
 * 'c', and so forth.
 * </p>
 * <p>
 * If start is given and is negative,
 * then strspn will begin
 * examining subject at
 * the start'th position from the end
 * of subject.
 * </p>
 * @param int $length [optional] <p>
 * The length of the segment from subject
 * to examine. 
 * </p>
 * <p>
 * If length is given and is non-negative,
 * then subject will be examined
 * for length characters after the starting
 * position.
 * </p>
 * <p>
 * If lengthis given and is negative,
 * then subject will be examined from the
 * starting position up to length
 * characters from the end of subject.
 * </p>
 * @return int the length of the initial segment of str1
 * which consists entirely of characters in str2.
 */
function strspn ($subject, $mask, $start = null, $length = null) {}

/**
 * Find length of initial segment not matching mask
 * @link https://php.net/manual/en/function.strcspn.php
 * @param string $str1 <p>
 * The first string.
 * </p>
 * @param string $str2 <p>
 * The second string.
 * </p>
 * @param int $start [optional] <p>
 * The start position of the string to examine.
 * </p>
 * @param int $length [optional] <p>
 * The length of the string to examine.
 * </p>
 * @return int the length of the segment as an integer.
 * @since 4.0
 * @since 5.0
 */
function strcspn ($str1, $str2, $start = null, $length = null) {}

/**
 * Tokenize string
 * Note that only the first call to strtok uses the string argument.
 * Every subsequent call to strtok only needs the token to use, as it keeps track of where it is in the current string.
 * To start over, or to tokenize a new string you simply call strtok with the string argument again to initialize it.
 * Note that you may put multiple tokens in the token parameter.
 * The string will be tokenized when any one of the characters in the argument are found.
 * @link https://php.net/manual/en/function.strtok.php
 * @param string $str [optional] <p>
 * The string being split up into smaller strings (tokens).
 * </p>
 * @param string $token <p>
 * The delimiter used when splitting up str.
 * </p>
 * @return string A string token.
 * @since 4.0
 * @since 5.0
 */
function strtok ($str = null, $token) {}
