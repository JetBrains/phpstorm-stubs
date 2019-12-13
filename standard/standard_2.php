<?php

/**
 * Query language and locale information
 * @link https://php.net/manual/en/function.nl-langinfo.php
 * @param int $item <p>
 * item may be an integer value of the element or the
 * constant name of the element. The following is a list of constant names
 * for item that may be used and their description.
 * Some of these constants may not be defined or hold no value for certain
 * locales.
 * <table>
 * nl_langinfo Constants
 * <tr valign="top">
 * <td>Constant</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * LC_TIME Category Constants</td>
 * </tr>
 * <tr valign="top">
 * <td>ABDAY_(1-7)</td>
 * <td>Abbreviated name of n-th day of the week.</td>
 * </tr>
 * <tr valign="top">
 * <td>DAY_(1-7)</td>
 * <td>Name of the n-th day of the week (DAY_1 = Sunday).</td>
 * </tr>
 * <tr valign="top">
 * <td>ABMON_(1-12)</td>
 * <td>Abbreviated name of the n-th month of the year.</td>
 * </tr>
 * <tr valign="top">
 * <td>MON_(1-12)</td>
 * <td>Name of the n-th month of the year.</td>
 * </tr>
 * <tr valign="top">
 * <td>AM_STR</td>
 * <td>String for Ante meridian.</td>
 * </tr>
 * <tr valign="top">
 * <td>PM_STR</td>
 * <td>String for Post meridian.</td>
 * </tr>
 * <tr valign="top">
 * <td>D_T_FMT</td>
 * <td>String that can be used as the format string for strftime to represent time and date.</td>
 * </tr>
 * <tr valign="top">
 * <td>D_FMT</td>
 * <td>String that can be used as the format string for strftime to represent date.</td>
 * </tr>
 * <tr valign="top">
 * <td>T_FMT</td>
 * <td>String that can be used as the format string for strftime to represent time.</td>
 * </tr>
 * <tr valign="top">
 * <td>T_FMT_AMPM</td>
 * <td>String that can be used as the format string for strftime to represent time in 12-hour format with ante/post meridian.</td>
 * </tr>
 * <tr valign="top">
 * <td>ERA</td>
 * <td>Alternate era.</td>
 * </tr>
 * <tr valign="top">
 * <td>ERA_YEAR</td>
 * <td>Year in alternate era format.</td>
 * </tr>
 * <tr valign="top">
 * <td>ERA_D_T_FMT</td>
 * <td>Date and time in alternate era format (string can be used in strftime).</td>
 * </tr>
 * <tr valign="top">
 * <td>ERA_D_FMT</td>
 * <td>Date in alternate era format (string can be used in strftime).</td>
 * </tr>
 * <tr valign="top">
 * <td>ERA_T_FMT</td>
 * <td>Time in alternate era format (string can be used in strftime).</td>
 * </tr>
 * <tr valign="top">
 * LC_MONETARY Category Constants</td>
 * </tr>
 * <tr valign="top">
 * <td>INT_CURR_SYMBOL</td>
 * <td>International currency symbol.</td>
 * </tr>
 * <tr valign="top">
 * <td>CURRENCY_SYMBOL</td>
 * <td>Local currency symbol.</td>
 * </tr>
 * <tr valign="top">
 * <td>CRNCYSTR</td>
 * <td>Same value as CURRENCY_SYMBOL.</td>
 * </tr>
 * <tr valign="top">
 * <td>MON_DECIMAL_POINT</td>
 * <td>Decimal point character.</td>
 * </tr>
 * <tr valign="top">
 * <td>MON_THOUSANDS_SEP</td>
 * <td>Thousands separator (groups of three digits).</td>
 * </tr>
 * <tr valign="top">
 * <td>MON_GROUPING</td>
 * <td>Like "grouping" element.</td>
 * </tr>
 * <tr valign="top">
 * <td>POSITIVE_SIGN</td>
 * <td>Sign for positive values.</td>
 * </tr>
 * <tr valign="top">
 * <td>NEGATIVE_SIGN</td>
 * <td>Sign for negative values.</td>
 * </tr>
 * <tr valign="top">
 * <td>INT_FRAC_DIGITS</td>
 * <td>International fractional digits.</td>
 * </tr>
 * <tr valign="top">
 * <td>FRAC_DIGITS</td>
 * <td>Local fractional digits.</td>
 * </tr>
 * <tr valign="top">
 * <td>P_CS_PRECEDES</td>
 * <td>Returns 1 if CURRENCY_SYMBOL precedes a positive value.</td>
 * </tr>
 * <tr valign="top">
 * <td>P_SEP_BY_SPACE</td>
 * <td>Returns 1 if a space separates CURRENCY_SYMBOL from a positive value.</td>
 * </tr>
 * <tr valign="top">
 * <td>N_CS_PRECEDES</td>
 * <td>Returns 1 if CURRENCY_SYMBOL precedes a negative value.</td>
 * </tr>
 * <tr valign="top">
 * <td>N_SEP_BY_SPACE</td>
 * <td>Returns 1 if a space separates CURRENCY_SYMBOL from a negative value.</td>
 * </tr>
 * <tr valign="top">
 * <td>P_SIGN_POSN</td>
 * Returns 0 if parentheses surround the quantity and CURRENCY_SYMBOL.
 * @return string|false the element as a string, or false if item
 * is not valid.
 * @since 4.1
 * @since 5.0
 */
function nl_langinfo ($item) {}

/**
 * Calculate the soundex key of a string
 * @link https://php.net/manual/en/function.soundex.php
 * @param string $str <p>
 * The input string.
 * </p>
 * @return string the soundex key as a string.
 * @since 4.0
 * @since 5.0
 */
function soundex ($str) {}

/**
 * Calculate Levenshtein distance between two strings
 * @link https://php.net/manual/en/function.levenshtein.php
 * Note: In its simplest form the function will take only the two strings
 * as parameter and will calculate just the number of insert, replace and
 * delete operations needed to transform str1 into str2.
 * Note: A second variant will take three additional parameters that define
 * the cost of insert, replace and delete operations. This is more general
 * and adaptive than variant one, but not as efficient.
 * @param string $str1 <p>
 * One of the strings being evaluated for Levenshtein distance.
 * </p>
 * @param string $str2 <p>
 * One of the strings being evaluated for Levenshtein distance.
 * </p>
 * @param int $cost_ins [optional] <p>
 * Defines the cost of insertion.
 * </p>
 * @param int $cost_rep [optional] <p>
 * Defines the cost of replacement.
 * </p>
 * @param int $cost_del [optional] <p>
 * Defines the cost of deletion.
 * </p>
 * @return int This function returns the Levenshtein-Distance between the
 * two argument strings or -1, if one of the argument strings
 * is longer than the limit of 255 characters.
 * @since 4.0.1
 * @since 5.0
 */
function levenshtein ($str1, $str2, $cost_ins = null, $cost_rep = null, $cost_del = null) {}

/**
 * Return a specific character
 * @link https://php.net/manual/en/function.chr.php
 * @param int $ascii <p>
 * The ascii code.
 * </p>
 * @return string the specified character.
 * @since 4.0
 * @since 5.0
 */
function chr ($ascii) {}

/**
 * Return ASCII value of character
 * @link https://php.net/manual/en/function.ord.php
 * @param string $string <p>
 * A character.
 * </p>
 * @return int the ASCII value as an integer.
 * @since 4.0
 * @since 5.0
 */
function ord ($string) {}

/**
 * Parses the string into variables
 * @link https://php.net/manual/en/function.parse-str.php
 * @param string $str <p>
 * The input string.
 * </p>
 * @param array $result [optional] <p>
 * If the second parameter arr is present,
 * variables are stored in this variable as array elements instead.<br/>
 * Since 7.2.0 this parameter is not optional.
 * </p>
 * @return void 
 * @since 4.0
 * @since 5.0
 */
function parse_str ($str, array &$result = null) {}

/**
 * Parse a CSV string into an array
 * @link https://php.net/manual/en/function.str-getcsv.php
 * @param string $input <p>
 * The string to parse.
 * </p>
 * @param string $delimiter [optional] <p>
 * Set the field delimiter (one character only).
 * </p>
 * @param string $enclosure [optional] <p>
 * Set the field enclosure character (one character only).
 * </p>
 * @param string $escape [optional] <p>
 * Set the escape character (one character only). 
 * Defaults as a backslash (\)
 * </p>
 * @return array an indexed array containing the fields read.
 * @since 5.3
 */
function str_getcsv ($input, $delimiter = ",", $enclosure = '"', $escape = "\\") {}

/**
 * Pad a string to a certain length with another string
 * @link https://php.net/manual/en/function.str-pad.php
 * @param string $input <p>
 * The input string.
 * </p>
 * @param int $pad_length <p>
 * If the value of pad_length is negative,
 * less than, or equal to the length of the input string, no padding
 * takes place.
 * </p>
 * @param string $pad_string [optional] <p>
 * The pad_string may be truncated if the
 * required number of padding characters can't be evenly divided by the
 * pad_string's length.
 * </p>
 * @param int $pad_type [optional] <p>
 * Optional argument pad_type can be
 * STR_PAD_RIGHT, STR_PAD_LEFT,
 * or STR_PAD_BOTH. If
 * pad_type is not specified it is assumed to be
 * STR_PAD_RIGHT.
 * </p>
 * @return string the padded string.
 * @since 4.0.1
 * @since 5.0
 */
function str_pad ($input, $pad_length, $pad_string = " ", $pad_type = STR_PAD_RIGHT) {}

/**
 * &Alias; <function>rtrim</function>
 * @see rtrim()
 * @link https://php.net/manual/en/function.chop.php
 * @param string $str The input string.
 * @param string $character_mask [optional]
 * @return string the modified string.
 * @since 4.0
 * @since 5.0
 */
function chop ($str, $character_mask = null) {}

/**
 * &Alias; <function>strstr</function>
 * @link https://php.net/manual/en/function.strchr.php
 * Note: This function is case-sensitive. For case-insensitive searches, use stristr().
 * Note: If you only want to determine if a particular needle occurs within haystack,
 * use the faster and less memory intensive function strpos() instead.
 * @since 4.0
 * @since 5.0
 *
 * @param string $haystack The input string.
 * @param mixed $needle If needle is not a string, it is converted to an integer and applied as the ordinal value of a character.
 * @param bool $part [optional] If TRUE, strstr() returns the part of the haystack before the first occurrence of the needle (excluding the needle).
 * @return string|false Returns the portion of string, or FALSE if needle is not found.
 */
function strchr ($haystack, $needle, $part = false) {}

/**
 * Return a formatted string
 * @link https://php.net/manual/en/function.sprintf.php
 * @param string $format <p>
 * The format string is composed of zero or more directives:
 * ordinary characters (excluding %) that are
 * copied directly to the result, and conversion
 * specifications, each of which results in fetching its
 * own parameter. This applies to both sprintf
 * and printf.
 * </p>
 * <p>
 * Each conversion specification consists of a percent sign
 * (%), followed by one or more of these
 * elements, in order:
 * An optional sign specifier that forces a sign
 * (- or +) to be used on a number. By default, only the - sign is used
 * on a number if it's negative. This specifier forces positive numbers
 * to have the + sign attached as well, and was added in PHP 4.3.0.
 * @param mixed $args [optional] <p>
 * </p>
 * @param mixed $_ [optional] 
 * @return string a string produced according to the formatting string
 * format.
 * @since 4.0
 * @since 5.0
 */
function sprintf ($format, $args = null, $_ = null) {}

/**
 * Output a formatted string
 * @link https://php.net/manual/en/function.printf.php
 * @param string $format <p>
 * See sprintf for a description of
 * format.
 * </p>
 * @param mixed $args [optional] <p>
 * </p>
 * @param mixed $_ [optional] 
 * @return int the length of the outputted string.
 * @since 4.0
 * @since 5.0
 */
function printf ($format, $args = null, $_ = null) {}

/**
 * Output a formatted string
 * @link https://php.net/manual/en/function.vprintf.php
 * @param string $format <p>
 * See sprintf for a description of
 * format.
 * </p>
 * @param array $args <p>
 * </p>
 * @return int the length of the outputted string.
 * @since 4.1
 * @since 5.0
 */
function vprintf ($format, array $args) {}

/**
 * Return a formatted string
 * @link https://php.net/manual/en/function.vsprintf.php
 * @param string $format <p>
 * See sprintf for a description of
 * format.
 * </p>
 * @param array $args <p>
 * </p>
 * @return string Return array values as a formatted string according to
 * format (which is described in the documentation
 * for sprintf).
 * @since 4.1
 * @since 5.0
 */
function vsprintf ($format, array $args) {}

/**
 * Write a formatted string to a stream
 * @link https://php.net/manual/en/function.fprintf.php
 * @param resource $handle &fs.file.pointer;
 * @param string $format <p>
 * See sprintf for a description of 
 * format.
 * </p>
 * @param mixed $args [optional] <p>
 * </p>
 * @param mixed $_ [optional] 
 * @return int the length of the string written.
 * @since 5.0
 */
function fprintf ($handle, $format, $args = null, $_ = null) {}

/**
 * Write a formatted string to a stream
 * @link https://php.net/manual/en/function.vfprintf.php
 * @param resource $handle <p>
 * </p>
 * @param string $format <p>
 * See sprintf for a description of
 * format.
 * </p>
 * @param array $args <p>
 * </p>
 * @return int the length of the outputted string.
 * @since 5.0
 */
function vfprintf ($handle, $format, array $args) {}

/**
 * Parses input from a string according to a format
 * @link https://php.net/manual/en/function.sscanf.php
 * @param string $str <p>
 * The input string being parsed.
 * </p>
 * @param string $format <p>
 * The interpreted format for str, which is
 * described in the documentation for sprintf with
 * following differences:
 * Function is not locale-aware.
 * F, g, G and
 * b are not supported.
 * D stands for decimal number.
 * i stands for integer with base detection.
 * n stands for number of characters processed so far.
 * </p>
 * @param mixed ...$_
 * @return array|int If only
 * two parameters were passed to this function, the values parsed
 * will be returned as an array. Otherwise, if optional parameters are passed,
 * the function will return the number of assigned values. The optional
 * parameters must be passed by reference.
 * @since 4.0.1
 * @since 5.0
 */
function sscanf ($str, $format, &...$_) {}

/**
 * Parses input from a file according to a format
 * @link https://php.net/manual/en/function.fscanf.php
 * @param resource $handle &fs.file.pointer;
 * @param string $format <p>
 * The specified format as described in the 
 * sprintf documentation.
 * </p>
 * @param mixed $_ [optional] 
 * @return array|int If only two parameters were passed to this function, the values parsed will be
 * returned as an array. Otherwise, if optional parameters are passed, the
 * function will return the number of assigned values. The optional
 * parameters must be passed by reference.
 * @since 4.0.1
 * @since 5.0
 */
function fscanf ($handle, $format, &$_ = null) {}

/**
 * Parse a URL and return its components
 * @link https://php.net/manual/en/function.parse-url.php
 * @param string $url <p>
 * The URL to parse. Invalid characters are replaced by
 * _.
 * </p>
 * @param int $component [optional] <p>
 * Specify one of PHP_URL_SCHEME,
 * PHP_URL_HOST, PHP_URL_PORT,
 * PHP_URL_USER, PHP_URL_PASS,
 * PHP_URL_PATH, PHP_URL_QUERY
 * or PHP_URL_FRAGMENT to retrieve just a specific
 * URL component as a string.
 * </p>
 * @return array|string|int|null|false On seriously malformed URLs, parse_url() may return FALSE.
 * If the component parameter is omitted, an associative array is returned.
 * At least one element will be present within the array. Potential keys within this array are:
 * scheme - e.g. http
 * host 
 * port
 * user
 * pass
 * path
 * query - after the question mark ?
 * fragment - after the hashmark #
 * </p>
 * <p>
 * If the component parameter is specified a
 * string is returned instead of an array.
 * @since 4.0
 * @since 5.0
 */
function parse_url ($url, $component = -1) {}

/**
 * URL-encodes string
 * @link https://php.net/manual/en/function.urlencode.php
 * @param string $str <p>
 * The string to be encoded.
 * </p>
 * @return string a string in which all non-alphanumeric characters except
 * -_. have been replaced with a percent
 * (%) sign followed by two hex digits and spaces encoded
 * as plus (+) signs. It is encoded the same way that the
 * posted data from a WWW form is encoded, that is the same way as in
 * application/x-www-form-urlencoded media type. This
 * differs from the RFC 1738 encoding (see
 * rawurlencode) in that for historical reasons, spaces
 * are encoded as plus (+) signs.
 * @since 4.0
 * @since 5.0
 */
function urlencode ($str) {}

/**
 * Decodes URL-encoded string
 * @link https://php.net/manual/en/function.urldecode.php
 * @param string $str <p>
 * The string to be decoded.
 * </p>
 * @return string the decoded string.
 * @since 4.0
 * @since 5.0
 */
function urldecode ($str) {}

/**
 * URL-encode according to RFC 1738
 * @link https://php.net/manual/en/function.rawurlencode.php
 * @param string $str <p>
 * The URL to be encoded.
 * </p>
 * @return string a string in which all non-alphanumeric characters except
 * -_. have been replaced with a percent
 * (%) sign followed by two hex digits. This is the
 * encoding described in RFC 1738 for
 * protecting literal characters from being interpreted as special URL
 * delimiters, and for protecting URLs from being mangled by transmission
 * media with character conversions (like some email systems).
 * @since 4.0
 * @since 5.0
 */
function rawurlencode ($str) {}

/**
 * Decode URL-encoded strings
 * @link https://php.net/manual/en/function.rawurldecode.php
 * @param string $str <p>
 * The URL to be decoded.
 * </p>
 * @return string the decoded URL, as a string.
 * @since 4.0
 * @since 5.0
 */
function rawurldecode ($str) {}

/**
 * Generate URL-encoded query string
 * @link https://php.net/manual/en/function.http-build-query.php
 * @param mixed $query_data <p>
 * May be an array or object containing properties.
 * </p>
 * <p>
 * If query_data is an array, it may be a simple one-dimensional structure,
 * or an array of arrays (which in turn may contain other arrays).
 * </p>
 * <p>
 * If query_data is an object, then only public properties will be incorporated into the result.
 * </p>
 * @param string $numeric_prefix [optional] <p>
 * If numeric indices are used in the base array and this parameter is
 * provided, it will be prepended to the numeric index for elements in
 * the base array only.
 * </p>
 * <p>
 * This is meant to allow for legal variable names when the data is
 * decoded by PHP or another CGI application later on.
 * </p>
 * @param string $arg_separator [optional] <p>
 * arg_separator.output
 * is used to separate arguments, unless this parameter is specified,
 * and is then used.
 * </p>
 * @param int $enc_type By default, PHP_QUERY_RFC1738.
 *  <p>If enc_type is PHP_QUERY_RFC1738, then encoding is performed per » RFC 1738 and the application/x-www-form-urlencoded media type,
 *  which implies that spaces are encoded as plus (+) signs.
 *  <p>If enc_type is PHP_QUERY_RFC3986, then encoding is performed according to » RFC 3986, and spaces will be percent encoded (%20).
 * @return string a URL-encoded string.
 * @since 5.0
 */
function http_build_query ($query_data, $numeric_prefix = null, $arg_separator = null, $enc_type = PHP_QUERY_RFC1738){}

/**
 * Returns the target of a symbolic link
 * @link https://php.net/manual/en/function.readlink.php
 * @param string $path <p>
 * The symbolic link path.
 * </p>
 * @return string|false the contents of the symbolic link path or false on error.
 * @since 4.0
 * @since 5.0
 */
function readlink ($path) {}

/**
 * Gets information about a link
 * @link https://php.net/manual/en/function.linkinfo.php
 * @param string $path <p>
 * Path to the link.
 * </p>
 * @return int linkinfo returns the st_dev field
 * of the Unix C stat structure returned by the lstat
 * system call. Returns 0 or false in case of error.
 * @since 4.0
 * @since 5.0
 */
function linkinfo ($path) {}

/**
 * Creates a symbolic link
 * @link https://php.net/manual/en/function.symlink.php
 * @param string $target <p>
 * Target of the link.
 * </p>
 * @param string $link <p>
 * The link name.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function symlink ($target, $link) {}

/**
 * Create a hard link
 * @link https://php.net/manual/en/function.link.php
 * @param string $target Target of the link.
 * @param string $link The link name.
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function link (string $target , string $link):bool {}

/**
 * Deletes a file
 * @link https://php.net/manual/en/function.unlink.php
 * @param string $filename <p>
 * Path to the file.
 * </p>
 * @param resource $context [optional] &note.context-support;
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function unlink ($filename, $context = null):bool {}

/**
 * Execute an external program
 * @link https://php.net/manual/en/function.exec.php
 * @param string $command <p>
 * The command that will be executed.
 * </p>
 * @param array $output [optional] <p>
 * If the output argument is present, then the
 * specified array will be filled with every line of output from the
 * command. Trailing whitespace, such as \n, is not
 * included in this array. Note that if the array already contains some
 * elements, exec will append to the end of the array.
 * If you do not want the function to append elements, call
 * unset on the array before passing it to
 * exec.
 * </p>
 * @param int $return_var [optional] <p>
 * If the return_var argument is present
 * along with the output argument, then the
 * return status of the executed command will be written to this
 * variable.
 * </p>
 * @return string The last line from the result of the command. If you need to execute a 
 * command and have all the data from the command passed directly back without 
 * any interference, use the passthru function.
 * </p>
 * <p>
 * To get the output of the executed command, be sure to set and use the
 * output parameter.
 * @since 4.0
 * @since 5.0
 */
function exec ($command, array &$output = null, &$return_var = null) {}

/**
 * Execute an external program and display the output
 * @link https://php.net/manual/en/function.system.php
 * @param string $command <p>
 * The command that will be executed.
 * </p>
 * @param int $return_var [optional] <p>
 * If the return_var argument is present, then the
 * return status of the executed command will be written to this
 * variable.
 * </p>
 * @return string|false the last line of the command output on success, and false
 * on failure.
 * @since 4.0
 * @since 5.0
 */
function system ($command, &$return_var = null) {}

/**
 * Escape shell metacharacters
 * @link https://php.net/manual/en/function.escapeshellcmd.php
 * @param string $command <p>
 * The command that will be escaped.
 * </p>
 * @return string The escaped string.
 * @since 4.0
 * @since 5.0
 */
function escapeshellcmd ($command) {}

/**
 * Escape a string to be used as a shell argument
 * @link https://php.net/manual/en/function.escapeshellarg.php
 * @param string $arg <p>
 * The argument that will be escaped.
 * </p>
 * @return string The escaped string.
 * @since 4.0.3
 * @since 5.0
 */
function escapeshellarg ($arg) {}

/**
 * Execute an external program and display raw output
 * @link https://php.net/manual/en/function.passthru.php
 * @param string $command <p>
 * The command that will be executed.
 * </p>
 * @param int $return_var [optional] <p>
 * If the return_var argument is present, the 
 * return status of the Unix command will be placed here.
 * </p>
 * @return void 
 * @since 4.0
 * @since 5.0
 */
function passthru ($command, &$return_var = null) {}

/**
 * Execute command via shell and return the complete output as a string
 * @link https://php.net/manual/en/function.shell-exec.php
 * @param string $cmd <p>
 * The command that will be executed.
 * </p>
 * @return string|null The output from the executed command or NULL if an error occurred or the command produces no output.
 * @since 4.0
 * @since 5.0
 */
function shell_exec ($cmd) {}

/**
 * Execute a command and open file pointers for input/output
 * @link https://php.net/manual/en/function.proc-open.php
 * @param string $cmd <p>
 * The command to execute
 * </p>
 * @param array $descriptorspec <p>
 * An indexed array where the key represents the descriptor number and the
 * value represents how PHP will pass that descriptor to the child
 * process. 0 is stdin, 1 is stdout, while 2 is stderr.
 * </p>
 * <p>
 * Each element can be:
 * An array describing the pipe to pass to the process. The first
 * element is the descriptor type and the second element is an option for
 * the given type. Valid types are pipe (the second
 * element is either r to pass the read end of the pipe
 * to the process, or w to pass the write end) and
 * file (the second element is a filename).
 * A stream resource representing a real file descriptor (e.g. opened file,
 * a socket, STDIN).
 * </p>
 * <p>
 * The file descriptor numbers are not limited to 0, 1 and 2 - you may
 * specify any valid file descriptor number and it will be passed to the
 * child process. This allows your script to interoperate with other
 * scripts that run as "co-processes". In particular, this is useful for
 * passing passphrases to programs like PGP, GPG and openssl in a more
 * secure manner. It is also useful for reading status information
 * provided by those programs on auxiliary file descriptors.
 * </p>
 * @param array $pipes <p>
 * Will be set to an indexed array of file pointers that correspond to
 * PHP's end of any pipes that are created.
 * </p>
 * @param string $cwd [optional] <p>
 * The initial working dir for the command. This must be an
 * absolute directory path, or &null;
 * if you want to use the default value (the working dir of the current
 * PHP process)
 * </p>
 * @param array $env [optional] <p>
 * An array with the environment variables for the command that will be
 * run, or &null; to use the same environment as the current PHP process
 * </p>
 * @param array $other_options [optional] <p>
 * Allows you to specify additional options. Currently supported options
 * include:
 * suppress_errors (windows only): suppresses errors
 * generated by this function when it's set to true
 * bypass_shell (windows only): bypass
 * cmd.exe shell when set to true
 * context: stream context used when opening files
 * (created with stream_context_create)
 * binary_pipes: open pipes in binary mode, instead
 * of using the usual stream_encoding
 * </p>
 * @return resource|false a resource representing the process, which should be freed using
 * proc_close when you are finished with it. On failure
 * returns false.
 * @since 4.3
 * @since 5.0
 */
function proc_open ($cmd, array $descriptorspec, array &$pipes, $cwd = null, array $env = null, array $other_options = null) {}

/**
 * Close a process opened by <function>proc_open</function> and return the exit code of that process
 * @link https://php.net/manual/en/function.proc-close.php
 * @param resource $process <p>
 * The proc_open resource that will
 * be closed.
 * </p>
 * @return int the termination status of the process that was run.
 * @since 4.3
 * @since 5.0
 */
function proc_close ($process) {}

/**
 * Kills a process opened by proc_open
 * @link https://php.net/manual/en/function.proc-terminate.php
 * @param resource $process <p>
 * The proc_open resource that will
 * be closed.
 * </p>
 * @param int $signal [optional] <p>
 * This optional parameter is only useful on POSIX
 * operating systems; you may specify a signal to send to the process
 * using the kill(2) system call. The default is
 * SIGTERM.
 * </p>
 * @return bool the termination status of the process that was run.
 * @since 5.0
 */
function proc_terminate ($process, $signal = 15) {}

/**
 * Get information about a process opened by <function>proc_open</function>
 * @link https://php.net/manual/en/function.proc-get-status.php
 * @param resource $process <p>
 * The proc_open resource that will
 * be evaluated.
 * </p>
 * @return array|false An array of collected information on success, and false
 * on failure. The returned array contains the following elements:
 * </p>
 * <p>
 * <tr valign="top"><td>element</td><td>type</td><td>description</td></tr>
 * <tr valign="top">
 * <td>command</td>
 * <td>string</td>
 * <td>
 * The command string that was passed to proc_open.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>pid</td>
 * <td>int</td>
 * <td>process id</td>
 * </tr>
 * <tr valign="top">
 * <td>running</td>
 * <td>bool</td>
 * <td>
 * true if the process is still running, false if it has
 * terminated.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>signaled</td>
 * <td>bool</td>
 * <td>
 * true if the child process has been terminated by
 * an uncaught signal. Always set to false on Windows.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>stopped</td>
 * <td>bool</td>
 * <td>
 * true if the child process has been stopped by a
 * signal. Always set to false on Windows.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>exitcode</td>
 * <td>int</td>
 * <td>
 * The exit code returned by the process (which is only
 * meaningful if running is false).
 * Only first call of this function return real value, next calls return
 * -1.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>termsig</td>
 * <td>int</td>
 * <td>
 * The number of the signal that caused the child process to terminate
 * its execution (only meaningful if signaled is true).
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>stopsig</td>
 * <td>int</td>
 * <td>
 * The number of the signal that caused the child process to stop its
 * execution (only meaningful if stopped is true).
 * </td>
 * </tr>
 * @since 5.0
 */
function proc_get_status ($process) {}

/**
 * Change the priority of the current process. <br/>
 * Since 7.2.0 supported on Windows platforms.
 * @link https://php.net/manual/en/function.proc-nice.php
 * @param int $increment <p>
 * The increment value of the priority change.
 * </p>
 * @return bool true on success or false on failure.
 * If an error occurs, like the user lacks permission to change the priority, 
 * an error of level E_WARNING is also generated.
 * @since 5.0
 */
function proc_nice ($increment) {}

/**
 * Generate a random integer
 * @link https://php.net/manual/en/function.rand.php
 * @param int $min [optional]
 * @param int $max [optional]
 * @return int A pseudo random value between min
 * (or 0) and max (or getrandmax, inclusive).
 * @since 4.0
 * @since 5.0
 */
function rand ($min = 0, $max = null) {}

/**
 * Seed the random number generator
 * <p><strong>Note</strong>: As of PHP 7.1.0, {@see srand()} has been made
 * an alias of {@see mt_srand()}.
 * </p>
 * @link https://php.net/manual/en/function.srand.php
 * @param int $seed [optional] <p>
 * Optional seed value
 * </p>
 * @param int $mode [optional] <p>
 * Use one of the following constants to specify the implementation of the algorithm to use.
 * </p>
 * @return void 
 * @since 4.0
 * @since 5.0
 */
function srand ($seed = null, $mode = MT_RAND_MT19937) {}

/**
 * Show largest possible random value
 * @link https://php.net/manual/en/function.getrandmax.php
 * @return int The largest possible random value returned by rand
 * @since 4.0
 * @since 5.0
 */
function getrandmax () {}

/**
 * Generate a random value via the Mersenne Twister Random Number Generator
 * @link https://php.net/manual/en/function.mt-rand.php
 * @param int $min [optional] <p>
 * Optional lowest value to be returned (default: 0)
 * </p>
 * @param int $max [optional] <p>
 * Optional highest value to be returned (default: mt_getrandmax())
 * </p>
 * @return int A random integer value between min (or 0)
 * and max (or mt_getrandmax, inclusive)
 * @since 4.0
 * @since 5.0
 */
function mt_rand ($min = 0, $max = null) {}

/**
 * Seed the better random number generator
 * @link https://php.net/manual/en/function.mt-srand.php
 * @param int $seed [optional] <p>
 * An optional seed value
 * </p>
 * @param int $mode [optional] <p>
 * Use one of the following constants to specify the implementation of the algorithm to use.
 * </p>
 * @return void 
 * @since 4.0
 * @since 5.0
 */
function mt_srand ($seed = null, $mode = MT_RAND_MT19937) {}

/**
 * Show largest possible random value
 * @link https://php.net/manual/en/function.mt-getrandmax.php
 * @return int the maximum random value returned by mt_rand
 * @since 4.0
 * @since 5.0
 */
function mt_getrandmax () {}

/**
 * Get port number associated with an Internet service and protocol
 * @link https://php.net/manual/en/function.getservbyname.php
 * @param string $service <p>
 * The Internet service name, as a string.
 * </p>
 * @param string $protocol <p>
 * protocol is either "tcp"
 * or "udp" (in lowercase).
 * </p>
 * @return int the port number, or false if service or
 * protocol is not found.
 * @since 4.0
 * @since 5.0
 */
function getservbyname ($service, $protocol) {}

/**
 * Get Internet service which corresponds to port and protocol
 * @link https://php.net/manual/en/function.getservbyport.php
 * @param int $port <p>
 * The port number.
 * </p>
 * @param string $protocol <p>
 * protocol is either "tcp"
 * or "udp" (in lowercase).
 * </p>
 * @return string the Internet service name as a string.
 * @since 4.0
 * @since 5.0
 */
function getservbyport ($port, $protocol) {}

/**
 * Get protocol number associated with protocol name
 * @link https://php.net/manual/en/function.getprotobyname.php
 * @param string $name <p>
 * The protocol name.
 * </p>
 * @return int the protocol number or -1 if the protocol is not found.
 * @since 4.0
 * @since 5.0
 */
function getprotobyname ($name) {}

/**
 * Get protocol name associated with protocol number
 * @link https://php.net/manual/en/function.getprotobynumber.php
 * @param int $number <p>
 * The protocol number.
 * </p>
 * @return string the protocol name as a string.
 * @since 4.0
 * @since 5.0
 */
function getprotobynumber ($number) {}

/**
 * Gets PHP script owner's UID
 * @link https://php.net/manual/en/function.getmyuid.php
 * @return int the user ID of the current script, or false on error.
 * @since 4.0
 * @since 5.0
 */
function getmyuid () {}

/**
 * Get PHP script owner's GID
 * @link https://php.net/manual/en/function.getmygid.php
 * @return int the group ID of the current script, or false on error.
 * @since 4.1
 * @since 5.0
 */
function getmygid () {}

/**
 * Gets PHP's process ID
 * @link https://php.net/manual/en/function.getmypid.php
 * @return int the current PHP process ID, or false on error.
 * @since 4.0
 * @since 5.0
 */
function getmypid () {}

/**
 * Gets the inode of the current script
 * @link https://php.net/manual/en/function.getmyinode.php
 * @return int the current script's inode as an integer, or false on error.
 * @since 4.0
 * @since 5.0
 */
function getmyinode () {}
