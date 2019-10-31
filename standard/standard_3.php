<?php

/**
 * Gets time of last page modification
 * @link https://php.net/manual/en/function.getlastmod.php
 * @return int the time of the last modification of the current
 * page. The value returned is a Unix timestamp, suitable for
 * feeding to date. Returns false on error.
 * @since 4.0
 * @since 5.0
 */
function getlastmod () {}

/**
 * Decodes data encoded with MIME base64
 * @link https://php.net/manual/en/function.base64-decode.php
 * @param string $data <p>
 * The encoded data.
 * </p>
 * @param bool $strict [optional] <p>
 * Returns false if input contains character from outside the base64
 * alphabet.
 * </p>
 * @return string|false the original data or false on failure. The returned data may be
 * binary.
 * @since 4.0
 * @since 5.0
 */
function base64_decode ($data, $strict = null) {}

/**
 * Encodes data with MIME base64
 * @link https://php.net/manual/en/function.base64-encode.php
 * @param string $data <p>
 * The data to encode.
 * </p>
 * @return string The encoded data, as a string.
 * @since 4.0
 * @since 5.0
 */
function base64_encode ($data) {}

/**
 * Uuencode a string
 * @link https://php.net/manual/en/function.convert-uuencode.php
 * @param string $data <p>
 * The data to be encoded.
 * </p>
 * @return string the uuencoded data.
 * @since 5.0
 */
function convert_uuencode ($data) {}

/**
 * Decode a uuencoded string
 * @link https://php.net/manual/en/function.convert-uudecode.php
 * @param string $data <p>
 * The uuencoded data.
 * </p>
 * @return string the decoded data as a string.
 * @since 5.0
 */
function convert_uudecode ($data) {}

/**
 * Absolute value
 * @link https://php.net/manual/en/function.abs.php
 * @param mixed $number <p>
 * The numeric value to process
 * </p>
 * @return float|int The absolute value of number. If the
 * argument number is
 * of type float, the return type is also float,
 * otherwise it is integer (as float usually has a
 * bigger value range than integer).
 * @since 4.0
 * @since 5.0
 */
function abs ($number) {}

/**
 * Round fractions up
 * @link https://php.net/manual/en/function.ceil.php
 * @param float $value <p>
 * The value to round
 * </p>
 * @return float|false value rounded up to the next highest
 * integer.
 * The return value of ceil is still of type
 * float as the value range of float is 
 * usually bigger than that of integer.
 * @since 4.0
 * @since 5.0
 */
function ceil ($value) {}

/**
 * Round fractions down
 * @link https://php.net/manual/en/function.floor.php
 * @param float $value <p>
 * The numeric value to round
 * </p>
 * @return float|false value rounded to the next lowest integer.
 * The return value of floor is still of type
 * float because the value range of float is 
 * usually bigger than that of integer.
 * @since 4.0
 * @since 5.0
 */
function floor ($value) {}

/**
 * Returns the rounded value of val to specified precision (number of digits after the decimal point).
 * precision can also be negative or zero (default).
 * Note: PHP doesn't handle strings like "12,300.2" correctly by default. See converting from strings.
 * @link https://php.net/manual/en/function.round.php
 * @param float $val <p>
 * The value to round
 * </p>
 * @param int $precision [optional] <p>
 * The optional number of decimal digits to round to.
 * </p>
 * @param int $mode [optional] <p>
 * One of PHP_ROUND_HALF_UP,
 * PHP_ROUND_HALF_DOWN,
 * PHP_ROUND_HALF_EVEN, or
 * PHP_ROUND_HALF_ODD.
 * </p>
 * @return float|false The rounded value
 * @since 4.0
 * @since 5.0
 */
function round ($val, $precision = 0, $mode = PHP_ROUND_HALF_UP) {}

/**
 * Sine
 * @link https://php.net/manual/en/function.sin.php
 * @param float $arg <p>
 * A value in radians
 * </p>
 * @return float The sine of arg
 * @since 4.0
 * @since 5.0
 */
function sin ($arg) {}

/**
 * Cosine
 * @link https://php.net/manual/en/function.cos.php
 * @param float $arg <p>
 * An angle in radians 
 * </p>
 * @return float The cosine of arg
 * @since 4.0
 * @since 5.0
 */
function cos ($arg) {}

/**
 * Tangent
 * @link https://php.net/manual/en/function.tan.php
 * @param float $arg <p>
 * The argument to process in radians 
 * </p>
 * @return float The tangent of arg
 * @since 4.0
 * @since 5.0
 */
function tan ($arg) {}

/**
 * Arc sine
 * @link https://php.net/manual/en/function.asin.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The arc sine of arg in radians
 * @since 4.0
 * @since 5.0
 */
function asin ($arg) {}

/**
 * Arc cosine
 * @link https://php.net/manual/en/function.acos.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The arc cosine of arg in radians.
 * @since 4.0
 * @since 5.0
 */
function acos ($arg) {}

/**
 * Arc tangent
 * @link https://php.net/manual/en/function.atan.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The arc tangent of arg in radians.
 * @since 4.0
 * @since 5.0
 */
function atan ($arg) {}

/**
 * Inverse hyperbolic tangent
 * @link https://php.net/manual/en/function.atanh.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float Inverse hyperbolic tangent of arg
 * @since 4.1
 * @since 5.0
 */
function atanh ($arg) {}

/**
 * Arc tangent of two variables
 * @link https://php.net/manual/en/function.atan2.php
 * @param float $y <p>
 * Dividend parameter
 * </p>
 * @param float $x <p>
 * Divisor parameter
 * </p>
 * @return float The arc tangent of y/x 
 * in radians.
 * @since 4.0
 * @since 5.0
 */
function atan2 ($y, $x) {}

/**
 * Hyperbolic sine
 * @link https://php.net/manual/en/function.sinh.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The hyperbolic sine of arg
 * @since 4.1
 * @since 5.0
 */
function sinh ($arg) {}

/**
 * Hyperbolic cosine
 * @link https://php.net/manual/en/function.cosh.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The hyperbolic cosine of arg
 * @since 4.1
 * @since 5.0
 */
function cosh ($arg) {}

/**
 * Hyperbolic tangent
 * @link https://php.net/manual/en/function.tanh.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The hyperbolic tangent of arg
 * @since 4.1
 * @since 5.0
 */
function tanh ($arg) {}

/**
 * Inverse hyperbolic sine
 * @link https://php.net/manual/en/function.asinh.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The inverse hyperbolic sine of arg
 * @since 4.1
 * @since 5.0
 */
function asinh ($arg) {}

/**
 * Inverse hyperbolic cosine
 * @link https://php.net/manual/en/function.acosh.php
 * @param float $arg <p>
 * The value to process
 * </p>
 * @return float The inverse hyperbolic cosine of arg
 * @since 4.1
 * @since 5.0
 */
function acosh ($arg) {}

/**
 * Returns exp(number) - 1, computed in a way that is accurate even
 * @since 4.1
 * @since 5.0
   when the value of number is close to zero
 * @link https://php.net/manual/en/function.expm1.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float 'e' to the power of arg minus one
 */
function expm1 ($arg) {}

/**
 * Returns log(1 + number), computed in a way that is accurate even when
 * @since 4.1
 * @since 5.0
   the value of number is close to zero
 * @link https://php.net/manual/en/function.log1p.php
 * @param float $number <p>
 * The argument to process
 * </p>
 * @return float log(1 + number)
 */
function log1p ($number) {}

/**
 * Get value of pi
 * @link https://php.net/manual/en/function.pi.php
 * @return float The value of pi as float.
 * @since 4.0
 * @since 5.0
 */
function pi () {}

/**
 * Finds whether a value is a legal finite number
 * @link https://php.net/manual/en/function.is-finite.php
 * @param float $val <p>
 * The value to check
 * </p>
 * @return bool true if val is a legal finite
 * number within the allowed range for a PHP float on this platform,
 * else false.
 * @since 4.2
 * @since 5.0
 */
function is_finite ($val) {}

/**
 * Finds whether a value is not a number
 * @link https://php.net/manual/en/function.is-nan.php
 * @param float $val <p>
 * The value to check
 * </p>
 * @return bool true if val is 'not a number',
 * else false.
 * @since 4.2
 * @since 5.0
 */
function is_nan ($val) {}

/**
 * Integer division
 * @link https://php.net/manual/en/function.intdiv.php
 * @param $dividend <p>Number to be divided.</p>
 * @param $divisor <p>Number which divides the <b><i>dividend</i></b></p>
 * @return int <p>
 * If divisor is 0, a {@link DivisionByZeroError} exception is thrown.
 * If the <b><i>dividend</i></b> is <b>PHP_INT_MIN</b> and the <b><i>divisor</i></b> is -1,
 * then an {@link ArithmeticError} exception is thrown.
 * </p>
 * @since 7.0
 */
function intdiv ($dividend,  $divisor) {}

/**
 * Finds whether a value is infinite
 * @link https://php.net/manual/en/function.is-infinite.php
 * @param float $val <p>
 * The value to check
 * </p>
 * @return bool true if val is infinite, else false.
 * @since 4.2
 * @since 5.0
 */
function is_infinite ($val) {}

/**
 * Exponential expression
 * @link https://php.net/manual/en/function.pow.php
 * @param int|float $base <p>
 * The base to use
 * </p>
 * @param int|float $exp <p>
 * The exponent
 * </p>
 * @return int|float base raised to the power of exp.
 * If the result can be represented as integer it will be returned as type
 * integer, else it will be returned as type float.
 * If the power cannot be computed false will be returned instead.
 * @since 4.0
 * @since 5.0
 */
function pow ($base, $exp) {}

/**
 * Calculates the exponent of <constant>e</constant>
 * @link https://php.net/manual/en/function.exp.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float 'e' raised to the power of arg
 * @since 4.0
 * @since 5.0
 */
function exp ($arg) {}

/**
 * Natural logarithm
 * @link https://php.net/manual/en/function.log.php
 * @param float $arg <p>
 * The value to calculate the logarithm for
 * </p>
 * @param float $base [optional] <p>
 * The optional logarithmic base to use 
 * (defaults to 'e' and so to the natural logarithm).
 * </p>
 * @return float The logarithm of arg to 
 * base, if given, or the
 * natural logarithm.
 * @since 4.0
 * @since 5.0
 */
function log ($arg, $base = null) {}

/**
 * Base-10 logarithm
 * @link https://php.net/manual/en/function.log10.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The base-10 logarithm of arg
 * @since 4.0
 * @since 5.0
 */
function log10 ($arg) {}

/**
 * Square root
 * @link https://php.net/manual/en/function.sqrt.php
 * @param float $arg <p>
 * The argument to process
 * </p>
 * @return float The square root of arg
 * or the special value NAN for negative numbers.
 * @since 4.0
 * @since 5.0
 */
function sqrt ($arg) {}

/**
 * Calculate the length of the hypotenuse of a right-angle triangle
 * @link https://php.net/manual/en/function.hypot.php
 * @param float $x <p>
 * Length of first side
 * </p>
 * @param float $y <p>
 * Length of second side
 * </p>
 * @return float Calculated length of the hypotenuse
 * @since 4.1
 * @since 5.0
 */
function hypot ($x, $y) {}

/**
 * Converts the number in degrees to the radian equivalent
 * @link https://php.net/manual/en/function.deg2rad.php
 * @param float $number <p>
 * Angular value in degrees 
 * </p>
 * @return float The radian equivalent of number
 * @since 4.0
 * @since 5.0
 */
function deg2rad ($number) {}

/**
 * Converts the radian number to the equivalent number in degrees
 * @link https://php.net/manual/en/function.rad2deg.php
 * @param float $number <p>
 * A radian value
 * </p>
 * @return float The equivalent of number in degrees
 * @since 4.0
 * @since 5.0
 */
function rad2deg ($number) {}

/**
 * Binary to decimal
 * @link https://php.net/manual/en/function.bindec.php
 * @param string $binary_string <p>
 * The binary string to convert
 * </p>
 * @return int|float The decimal value of binary_string
 * @since 4.0
 * @since 5.0
 */
function bindec ($binary_string) {}

/**
 * Hexadecimal to decimal
 * @link https://php.net/manual/en/function.hexdec.php
 * @param string $hex_string <p>
 * The hexadecimal string to convert
 * </p>
 * @return int|float The decimal representation of hex_string
 * @since 4.0
 * @since 5.0
 */
function hexdec ($hex_string) {}

/**
 * Octal to decimal
 * @link https://php.net/manual/en/function.octdec.php
 * @param string $octal_string <p>
 * The octal string to convert
 * </p>
 * @return int|float The decimal representation of octal_string
 * @since 4.0
 * @since 5.0
 */
function octdec ($octal_string) {}

/**
 * Decimal to binary
 * @link https://php.net/manual/en/function.decbin.php
 * @param int $number <p>
 * Decimal value to convert
 * </p>
 * <table>
 * Range of inputs on 32-bit machines
 * <tr valign="top">
 * <td>positive number</td>
 * <td>negative number</td>
 * <td>return value</td>
 * </tr>
 * <tr valign="top">
 * <td>0</td>
 * <td></td>
 * <td>0</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td></td>
 * <td>1</td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td></td>
 * <td>10</td>
 * </tr>
 * <tr valign="top">
 * ... normal progression ...</td>
 * </tr>
 * <tr valign="top">
 * <td>2147483646</td>
 * <td></td>
 * <td>1111111111111111111111111111110</td>
 * </tr>
 * <tr valign="top">
 * <td>2147483647 (largest signed integer)</td>
 * <td></td>
 * <td>1111111111111111111111111111111 (31 1's)</td>
 * </tr>
 * <tr valign="top">
 * <td>2147483648</td>
 * <td>-2147483648</td>
 * <td>10000000000000000000000000000000</td>
 * </tr>
 * <tr valign="top">
 * ... normal progression ...</td>
 * </tr>
 * <tr valign="top">
 * <td>4294967294</td>
 * <td>-2</td>
 * <td>11111111111111111111111111111110</td>
 * </tr>
 * <tr valign="top">
 * <td>4294967295 (largest unsigned integer)</td>
 * <td>-1</td>
 * <td>11111111111111111111111111111111 (32 1's)</td>
 * </tr>
 * </table>
 * <table>
 * Range of inputs on 64-bit machines
 * <tr valign="top">
 * <td>positive number</td>
 * <td>negative number</td>
 * <td>return value</td>
 * </tr>
 * <tr valign="top">
 * <td>0</td>
 * <td></td>
 * <td>0</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td></td>
 * <td>1</td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td></td>
 * <td>10</td>
 * </tr>
 * <tr valign="top">
 * ... normal progression ...</td>
 * </tr>
 * <tr valign="top">
 * <td>9223372036854775806</td>
 * <td></td>
 * <td>111111111111111111111111111111111111111111111111111111111111110</td>
 * </tr>
 * <tr valign="top">
 * <td>9223372036854775807 (largest signed integer)</td>
 * <td></td>
 * <td>111111111111111111111111111111111111111111111111111111111111111 (31 1's)</td>
 * </tr>
 * <tr valign="top">
 * <td></td>
 * <td>-9223372036854775808</td>
 * <td>1000000000000000000000000000000000000000000000000000000000000000</td>
 * </tr>
 * <tr valign="top">
 * ... normal progression ...</td>
 * </tr>
 * <tr valign="top">
 * <td></td>
 * <td>-2</td>
 * <td>1111111111111111111111111111111111111111111111111111111111111110</td>
 * </tr>
 * <tr valign="top">
 * <td></td>
 * <td>-1</td>
 * <td>1111111111111111111111111111111111111111111111111111111111111111 (64 1's)</td>
 * </tr>
 * </table>
 * @return string Binary string representation of number
 * @since 4.0
 * @since 5.0
 */
function decbin ($number) {}

/**
 * Decimal to octal
 * @link https://php.net/manual/en/function.decoct.php
 * @param int $number <p>
 * Decimal value to convert
 * </p>
 * @return string Octal string representation of number
 * @since 4.0
 * @since 5.0
 */
function decoct ($number) {}

/**
 * Decimal to hexadecimal
 * @link https://php.net/manual/en/function.dechex.php
 * @param int $number <p>
 * Decimal value to convert
 * </p>
 * @return string Hexadecimal string representation of number
 * @since 4.0
 * @since 5.0
 */
function dechex ($number) {}

/**
 * Convert a number between arbitrary bases
 * @link https://php.net/manual/en/function.base-convert.php
 * @param string $number <p>
 * The number to convert
 * </p>
 * @param int $frombase <p>
 * The base number is in
 * </p>
 * @param int $tobase <p>
 * The base to convert number to
 * </p>
 * @return string number converted to base tobase
 * @since 4.0
 * @since 5.0
 */
function base_convert ($number, $frombase, $tobase) {}

/**
 * Format a number with grouped thousands
 * @link https://php.net/manual/en/function.number-format.php
 * @param float $number <p>
 * The number being formatted.
 * </p>
 * @param int $decimals [optional] <p>
 * Sets the number of decimal points.
 * </p>
 * @param string $dec_point [optional]
 * @param string $thousands_sep [optional]
 * @return string A formatted version of number.
 * @since 4.0
 * @since 5.0
 */
function number_format ($number , $decimals = 0 , $dec_point = '.' , $thousands_sep = ',' ) {}

/**
 * Returns the floating point remainder (modulo) of the division
 * @since 4.2
 * @since 5.0
  of the arguments
 * @link https://php.net/manual/en/function.fmod.php
 * @param float $x <p>
 * The dividend
 * </p>
 * @param float $y <p>
 * The divisor
 * </p>
 * @return float The floating point remainder of 
 * x/y
 */
function fmod ($x, $y) {}

/**
 * Converts a packed internet address to a human readable representation
 * @link https://php.net/manual/en/function.inet-ntop.php
 * @param string $in_addr <p>
 * A 32bit IPv4, or 128bit IPv6 address.
 * </p>
 * @return string|false a string representation of the address or false on failure.
 * @since 5.1
 */
function inet_ntop ($in_addr) {}

/**
 * Converts a human readable IP address to its packed in_addr representation
 * @link https://php.net/manual/en/function.inet-pton.php
 * @param string $address <p>
 * A human readable IPv4 or IPv6 address.
 * </p>
 * @return string the in_addr representation of the given
 * address
 * @since 5.1
 */
function inet_pton ($address) {}

/**
 * Converts a string containing an (IPv4) Internet Protocol dotted address into a proper address
 * @link https://php.net/manual/en/function.ip2long.php
 * @param string $ip_address <p>
 * A standard format address.
 * </p>
 * @return int|false the IPv4 address or false if ip_address
 * is invalid.
 * @since 4.0
 * @since 5.0
 */
function ip2long ($ip_address) {}

/**
 * Converts an (IPv4) Internet network address into a string in Internet standard dotted format
 * @link https://php.net/manual/en/function.long2ip.php
 * @param string|int $proper_address <p>
 * A proper address representation.
 * </p>
 * @return string the Internet IP address as a string.
 * @since 4.0
 * @since 5.0
 */
function long2ip ($proper_address) {}

/**
 * Gets the value of an environment variable
 * @link https://php.net/manual/en/function.getenv.php
 * @param string $varname [optional] <p>
 * The variable name.
 * </p>
 * @param bool $local_only [optional] <p>
 * Set to true to only return local environment variables (set by the operating system or putenv).
 * </p>
 * @return string|array|false the value of the environment variable
 * varname or an associative array with all environment variables if no variable name
 * is provided, or false on an error.
 * @since 4.0
 * @since 5.5.38 The local_only parameter has been added.
 * @since 5.6.24 The local_only parameter has been added.
 * @since 7.0.9 The local_only parameter has been added.
 * @since 7.1 The varname parameter was made optional.
 */
function getenv ($varname = null, $local_only = false) {}

/**
 * Sets the value of an environment variable
 * @link https://php.net/manual/en/function.putenv.php
 * @param string $setting <p>
 * The setting, like "FOO=BAR"
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function putenv ($setting) {}

/**
 * Gets options from the command line argument list
 * @link https://php.net/manual/en/function.getopt.php
 * @param string $options Each character in this string will be used as option characters and
 * matched against options passed to the script starting with a single
 * hyphen (-).
 * For example, an option string "x" recognizes an
 * option -x.
 * Only a-z, A-Z and 0-9 are allowed.
 * @param array $longopts [optional] An array of options. Each element in this array will be used as option
 * strings and matched against options passed to the script starting with
 * two hyphens (--).
 * For example, an longopts element "opt" recognizes an
 * option --opt.
 * Prior to PHP5.3.0 this parameter was only available on few systems
 * @param int $optind If the optind parameter is present, then the index where argument parsing stopped will be written to this variable.
 * @return array This function will return an array of option / argument pairs or false on
 * failure.
 * @since 4.3
 * @since 5.0
 */
function getopt ($options, array $longopts = null, &$optind = null) {}

/**
 * Gets system load average
 * @link https://php.net/manual/en/function.sys-getloadavg.php
 * @return array an array with three samples (last 1, 5 and 15
 * minutes).
 * @since 5.1.3
 */
function sys_getloadavg () {}

/**
 * Return current Unix timestamp with microseconds
 * @link https://php.net/manual/en/function.microtime.php
 * @param bool $get_as_float [optional] <p>
 * When called without the optional argument, this function returns the string
 * "msec sec" where sec is the current time measured in the number of
 * seconds since the Unix Epoch (0:00:00 January 1, 1970 GMT), and
 * msec is the microseconds part.
 * Both portions of the string are returned in units of seconds.
 * </p>
 * <p>
 * If the optional get_as_float is set to
 * true then a float (in seconds) is returned.
 * </p>
 * @return string|float
 * @since 4.0
 * @since 5.0
 */
function microtime ($get_as_float = null) {}

/**
 * Get current time
 * @link https://php.net/manual/en/function.gettimeofday.php
 * @param bool $return_float [optional] <p>
 * When set to true, a float instead of an array is returned.
 * </p>
 * @return int[]|float By default an array is returned. If return_float
 * is set, then a float is returned.
 * </p>
 * <p>
 * Array keys:
 * "sec" - seconds since the Unix Epoch
 * "usec" - microseconds
 * "minuteswest" - minutes west of Greenwich
 * "dsttime" - type of dst correction
 * @since 4.0
 * @since 5.0
 */
function gettimeofday ($return_float = null) {}

/**
 * Gets the current resource usages
 * @link https://php.net/manual/en/function.getrusage.php
 * @param int $who [optional] <p>
 * If who is 1, getrusage will be called with
 * RUSAGE_CHILDREN.
 * </p>
 * @return array an associative array containing the data returned from the system
 * call. All entries are accessible by using their documented field names.
 * @since 4.0
 * @since 5.0
 */
function getrusage ($who = null) {}

/**
 * Generate a unique ID
 * @link https://php.net/manual/en/function.uniqid.php
 * @param string $prefix [optional] <p>
 * Can be useful, for instance, if you generate identifiers
 * simultaneously on several hosts that might happen to generate the
 * identifier at the same microsecond.
 * </p>
 * <p>
 * With an empty prefix, the returned string will
 * be 13 characters long. If more_entropy is
 * true, it will be 23 characters.
 * </p>
 * @param bool $more_entropy [optional] <p>
 * If set to true, uniqid will add additional
 * entropy (using the combined linear congruential generator) at the end
 * of the return value, which should make the results more unique.
 * </p>
 * @return string the unique identifier, as a string.
 * @since 4.0
 * @since 5.0
 */
function uniqid ($prefix = "", $more_entropy = false) {}

/**
 * Convert a quoted-printable string to an 8 bit string
 * @link https://php.net/manual/en/function.quoted-printable-decode.php
 * @param string $str <p>
 * The input string.
 * </p>
 * @return string the 8-bit binary string.
 * @since 4.0
 * @since 5.0
 */
function quoted_printable_decode ($str) {}

/**
 * Convert a 8 bit string to a quoted-printable string
 * @link https://php.net/manual/en/function.quoted-printable-encode.php
 * @param string $str <p>
 * The input string.
 * </p>
 * @return string the encoded string.
 * @since 5.3
 */
function quoted_printable_encode ($str) {}

/**
 * Convert from one Cyrillic character set to another
 * @link https://php.net/manual/en/function.convert-cyr-string.php
 * @param string $str <p>
 * The string to be converted.
 * </p>
 * @param string $from <p>
 * The source Cyrillic character set, as a single character.
 * </p>
 * @param string $to <p>
 * The target Cyrillic character set, as a single character.
 * </p>
 * @return string the converted string.
 * @since 4.0
 * @since 5.0
 * @deprecated 7.4
 */
function convert_cyr_string ($str, $from, $to) {}

/**
 * Gets the name of the owner of the current PHP script
 * @link https://php.net/manual/en/function.get-current-user.php
 * @return string the username as a string.
 * @since 4.0
 * @since 5.0
 */
function get_current_user () {}

/**
 * Limits the maximum execution time
 * @link https://php.net/manual/en/function.set-time-limit.php
 * @param int $seconds <p>
 * The maximum execution time, in seconds. If set to zero, no time limit
 * is imposed.
 * </p>
 * @return bool Returns TRUE on success, or FALSE on failure. 
 * @since 4.0
 * @since 5.0
 */
function set_time_limit ($seconds) {}

/**
 * Gets the value of a PHP configuration option
 * @link https://php.net/manual/en/function.get-cfg-var.php
 * @param string $option <p>
 * The configuration option name.
 * </p>
 * @return string the current value of the PHP configuration variable specified by
 * option, or false if an error occurs.
 * @since 4.0
 * @since 5.0
 */
function get_cfg_var ($option) {}

/**
 * &Alias; <function>set_magic_quotes_runtime</function>
 * @link https://php.net/manual/en/function.magic-quotes-runtime.php
 * @deprecated 5.3
 * @param $new_setting
 * @since 4.0
 * @since 5.0
 */
function magic_quotes_runtime ($new_setting) {}

/**
 * Sets the current active configuration setting of magic_quotes_runtime
 * @link https://php.net/manual/en/function.set-magic-quotes-runtime.php
 * @deprecated 5.3
 * @param bool $new_setting <p>
 * false for off, true for on.
 * </p>
 * @return bool true on success or false on failure.
 * @deprecated 5.4 This function has been DEPRECATED as of PHP 5.4.0. Raises an E_CORE_ERROR.
 * @since 4.0
 * @since 5.0
 */
function set_magic_quotes_runtime ($new_setting) {}

/**
 * Gets the current configuration setting of magic quotes gpc
 * @link https://php.net/manual/en/function.get-magic-quotes-gpc.php
 * @return int 0 if magic quotes gpc are off, 1 otherwise.
 * @since 4.0
 * @since 5.0
 * @deprecated 7.4
 */
function get_magic_quotes_gpc () {}

/**
 * Gets the current active configuration setting of magic_quotes_runtime
 * @link https://php.net/manual/en/function.get-magic-quotes-runtime.php
 * @return int 0 if magic quotes runtime is off, 1 otherwise.
 * @since 4.0
 * @since 5.0
 * @deprecated 7.4
 */
function get_magic_quotes_runtime () {}

/**
 * Import GET/POST/Cookie variables into the global scope
 * @link https://php.net/manual/en/function.import-request-variables.php
 * @param string $types <p>
 * Using the types parameter, you can specify
 * which request variables to import. You can use 'G', 'P' and 'C' 
 * characters respectively for GET, POST and Cookie. These characters are
 * not case sensitive, so you can also use any combination of 'g', 'p'
 * and 'c'. POST includes the POST uploaded file information.
 * </p>
 * <p>
 * Note that the order of the letters matters, as when using
 * "GP", the
 * POST variables will overwrite GET variables with the same name. Any
 * other letters than GPC are discarded.
 * </p>
 * @param string $prefix [optional] <p>
 * Variable name prefix, prepended before all variable's name imported
 * into the global scope. So if you have a GET value named
 * "userid", and provide a prefix
 * "pref_", then you'll get a global variable named
 * $pref_userid.
 * </p>
 * <p>
 * Although the prefix parameter is optional, you
 * will get an E_NOTICE level
 * error if you specify no prefix, or specify an empty string as a
 * prefix. This is a possible security hazard. Notice level errors are
 * not displayed using the default error reporting level.
 * </p>
 * @return bool true on success or false on failure.
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since 4.1
 * @since 5.0
 */
function import_request_variables ($types, $prefix = null) {}

/**
 * Send an error message somewhere
 * @link https://php.net/manual/en/function.error-log.php
 * @param string $message <p>
 * The error message that should be logged.
 * </p>
 * @param int $message_type [optional] <p>
 * Says where the error should go. The possible message types are as 
 * follows:
 * </p>
 * <p>
 * <table>
 * error_log log types
 * <tr valign="top">
 * <td>0</td>
 * <td>
 * message is sent to PHP's system logger, using
 * the Operating System's system logging mechanism or a file, depending
 * on what the error_log
 * configuration directive is set to. This is the default option.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>
 * message is sent by email to the address in
 * the destination parameter. This is the only
 * message type where the fourth parameter,
 * extra_headers is used.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>
 * No longer an option.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>3</td>
 * <td>
 * message is appended to the file
 * destination. A newline is not automatically 
 * added to the end of the message string.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>4</td>
 * <td>
 * message is sent directly to the SAPI logging
 * handler.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param string $destination [optional] <p>
 * The destination. Its meaning depends on the 
 * message_type parameter as described above.
 * </p>
 * @param string $extra_headers [optional] <p>
 * The extra headers. It's used when the message_type
 * parameter is set to 1.
 * This message type uses the same internal function as 
 * mail does.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function error_log ($message, $message_type = null, $destination = null, $extra_headers = null) {}
