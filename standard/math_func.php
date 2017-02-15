<?php
/**
 * PHPStorm stub file for Math functions.
 *
 * @link http://php.net/manual/en/book.math.php
 */

/**
 * Absolute value
 *
 * @link  http://php.net/manual/en/function.abs.php
 *
 * @param mixed $number <p>
 *                      The numeric value to process
 *                      </p>
 *
 * @return number The absolute value of number. If the
 * argument number is
 * of type float, the return type is also float,
 * otherwise it is integer (as float usually has a
 * bigger value range than integer).
 * @since 4.0
 * @since 5.0
 */
function abs($number) { }

/**
 * Arc cosine
 *
 * @link  http://php.net/manual/en/function.acos.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The arc cosine of arg in radians.
 * @since 4.0
 * @since 5.0
 */
function acos($arg) { }

/**
 * Inverse hyperbolic cosine
 *
 * @link  http://php.net/manual/en/function.acosh.php
 *
 * @param float $arg <p>
 *                   The value to process
 *                   </p>
 *
 * @return float The inverse hyperbolic cosine of arg
 * @since 4.1.0
 * @since 5.0
 */
function acosh($arg) { }

/**
 * Arc sine
 *
 * @link  http://php.net/manual/en/function.asin.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The arc sine of arg in radians
 * @since 4.0
 * @since 5.0
 */
function asin($arg) { }

/**
 * Inverse hyperbolic sine
 *
 * @link  http://php.net/manual/en/function.asinh.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The inverse hyperbolic sine of arg
 * @since 4.1.0
 * @since 5.0
 */
function asinh($arg) { }

/**
 * Arc tangent
 *
 * @link  http://php.net/manual/en/function.atan.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The arc tangent of arg in radians.
 * @since 4.0
 * @since 5.0
 */
function atan($arg) { }

/**
 * Arc tangent of two variables
 *
 * @link  http://php.net/manual/en/function.atan2.php
 *
 * @param float $y <p>
 *                 Dividend parameter
 *                 </p>
 * @param float $x <p>
 *                 Divisor parameter
 *                 </p>
 *
 * @return float The arc tangent of y/x
 * in radians.
 * @since 4.0
 * @since 5.0
 */
function atan2($y, $x) { }

/**
 * Inverse hyperbolic tangent
 *
 * @link  http://php.net/manual/en/function.atanh.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float Inverse hyperbolic tangent of arg
 * @since 4.1.0
 * @since 5.0
 */
function atanh($arg) { }

/**
 * Convert a number between arbitrary bases
 *
 * @link  http://php.net/manual/en/function.base-convert.php
 *
 * @param string $number   <p>
 *                         The number to convert
 *                         </p>
 * @param int    $frombase <p>
 *                         The base number is in
 *                         </p>
 * @param int    $tobase   <p>
 *                         The base to convert number to
 *                         </p>
 *
 * @return string number converted to base tobase
 * @since 4.0
 * @since 5.0
 */
function base_convert($number, $frombase, $tobase) { }

/**
 * Binary to decimal
 *
 * @link  http://php.net/manual/en/function.bindec.php
 *
 * @param string $binary_string <p>
 *                              The binary string to convert
 *                              </p>
 *
 * @return number The decimal value of binary_string
 * @since 4.0
 * @since 5.0
 */
function bindec($binary_string) { }

/**
 * Round fractions up
 *
 * @link  http://php.net/manual/en/function.ceil.php
 *
 * @param float $value <p>
 *                     The value to round
 *                     </p>
 *
 * @return float value rounded up to the next highest
 * integer.
 * The return value of ceil is still of type
 * float as the value range of float is
 * usually bigger than that of integer.
 * @since 4.0
 * @since 5.0
 */
function ceil($value) { }

/**
 * Cosine
 *
 * @link  http://php.net/manual/en/function.cos.php
 *
 * @param float $arg <p>
 *                   An angle in radians
 *                   </p>
 *
 * @return float The cosine of arg
 * @since 4.0
 * @since 5.0
 */
function cos($arg) { }

/**
 * Hyperbolic cosine
 *
 * @link  http://php.net/manual/en/function.cosh.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The hyperbolic cosine of arg
 * @since 4.1.0
 * @since 5.0
 */
function cosh($arg) { }

/**
 * Decimal to binary
 *
 * @link  http://php.net/manual/en/function.decbin.php
 *
 * @param int $number <p>
 *                    Decimal value to convert
 *                    </p>
 *                    <table>
 *                    Range of inputs on 32-bit machines
 *                    <tr valign="top">
 *                    <td>positive number</td>
 *                    <td>negative number</td>
 *                    <td>return value</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>0</td>
 *                    <td></td>
 *                    <td>0</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>1</td>
 *                    <td></td>
 *                    <td>1</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>2</td>
 *                    <td></td>
 *                    <td>10</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    ... normal progression ...</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>2147483646</td>
 *                    <td></td>
 *                    <td>1111111111111111111111111111110</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>2147483647 (largest signed integer)</td>
 *                    <td></td>
 *                    <td>1111111111111111111111111111111 (31 1's)</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>2147483648</td>
 *                    <td>-2147483648</td>
 *                    <td>10000000000000000000000000000000</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    ... normal progression ...</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>4294967294</td>
 *                    <td>-2</td>
 *                    <td>11111111111111111111111111111110</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>4294967295 (largest unsigned integer)</td>
 *                    <td>-1</td>
 *                    <td>11111111111111111111111111111111 (32 1's)</td>
 *                    </tr>
 *                    </table>
 *                    <table>
 *                    Range of inputs on 64-bit machines
 *                    <tr valign="top">
 *                    <td>positive number</td>
 *                    <td>negative number</td>
 *                    <td>return value</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>0</td>
 *                    <td></td>
 *                    <td>0</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>1</td>
 *                    <td></td>
 *                    <td>1</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>2</td>
 *                    <td></td>
 *                    <td>10</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    ... normal progression ...</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>9223372036854775806</td>
 *                    <td></td>
 *                    <td>111111111111111111111111111111111111111111111111111111111111110</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>9223372036854775807 (largest signed integer)</td>
 *                    <td></td>
 *                    <td>111111111111111111111111111111111111111111111111111111111111111 (31 1's)</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td></td>
 *                    <td>-9223372036854775808</td>
 *                    <td>1000000000000000000000000000000000000000000000000000000000000000</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    ... normal progression ...</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td></td>
 *                    <td>-2</td>
 *                    <td>1111111111111111111111111111111111111111111111111111111111111110</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td></td>
 *                    <td>-1</td>
 *                    <td>1111111111111111111111111111111111111111111111111111111111111111 (64 1's)</td>
 *                    </tr>
 *                    </table>
 *
 * @return string Binary string representation of number
 * @since 4.0
 * @since 5.0
 */
function decbin($number) { }

/**
 * Decimal to hexadecimal
 *
 * @link  http://php.net/manual/en/function.dechex.php
 *
 * @param int $number <p>
 *                    Decimal value to convert
 *                    </p>
 *
 * @return string Hexadecimal string representation of number
 * @since 4.0
 * @since 5.0
 */
function dechex($number) { }

/**
 * Decimal to octal
 *
 * @link  http://php.net/manual/en/function.decoct.php
 *
 * @param int $number <p>
 *                    Decimal value to convert
 *                    </p>
 *
 * @return string Octal string representation of number
 * @since 4.0
 * @since 5.0
 */
function decoct($number) { }

/**
 * Converts the number in degrees to the radian equivalent
 *
 * @link  http://php.net/manual/en/function.deg2rad.php
 *
 * @param float $number <p>
 *                      Angular value in degrees
 *                      </p>
 *
 * @return float The radian equivalent of number
 * @since 4.0
 * @since 5.0
 */
function deg2rad($number) { }

/**
 * Calculates the exponent of <constant>e</constant>
 *
 * @link  http://php.net/manual/en/function.exp.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float 'e' raised to the power of arg
 * @since 4.0
 * @since 5.0
 */
function exp($arg) { }

/**
 * Returns exp(number) - 1, computed in a way that is accurate even
 *
 * @since 4.1.0
 * @since 5.0
 * when the value of number is close to zero
 * @link  http://php.net/manual/en/function.expm1.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float 'e' to the power of arg minus one
 */
function expm1($arg) { }

/**
 * Round fractions down
 *
 * @link  http://php.net/manual/en/function.floor.php
 *
 * @param float $value <p>
 *                     The numeric value to round
 *                     </p>
 *
 * @return float value rounded to the next lowest integer.
 * The return value of floor is still of type
 * float because the value range of float is
 * usually bigger than that of integer.
 * @since 4.0
 * @since 5.0
 */
function floor($value) { }

/**
 * Returns the floating point remainder (modulo) of the division
 *
 * @since 4.2.0
 * @since 5.0
 * of the arguments
 * @link  http://php.net/manual/en/function.fmod.php
 *
 * @param float $x <p>
 *                 The dividend
 *                 </p>
 * @param float $y <p>
 *                 The divisor
 *                 </p>
 *
 * @return float The floating point remainder of
 * x/y
 */
function fmod($x, $y) { }

/**
 * Show largest possible random value
 *
 * @link  http://php.net/manual/en/function.getrandmax.php
 * @return int The largest possible random value returned by rand
 * @since 4.0
 * @since 5.0
 */
function getrandmax() { }

/**
 * Hexadecimal to decimal
 *
 * @link  http://php.net/manual/en/function.hexdec.php
 *
 * @param string $hex_string <p>
 *                           The hexadecimal string to convert
 *                           </p>
 *
 * @return number The decimal representation of hex_string
 * @since 4.0
 * @since 5.0
 */
function hexdec($hex_string) { }

/**
 * Calculate the length of the hypotenuse of a right-angle triangle
 *
 * @link  http://php.net/manual/en/function.hypot.php
 *
 * @param float $x <p>
 *                 Length of first side
 *                 </p>
 * @param float $y <p>
 *                 Length of second side
 *                 </p>
 *
 * @return float Calculated length of the hypotenuse
 * @since 4.1.0
 * @since 5.0
 */
function hypot($x, $y) { }

/**
 * Integer division
 *
 * @link  http://php.net/manual/en/function.intdiv.php
 *
 * @param $dividend <p>Number to be divide.</p>
 * @param $divisor  <p>Number which divides the <b><i>dividend</i></b></p>
 *
 * @return int <p>
 * If divisor is 0, a {@link DivisionByZeroError} exception is thrown.
 * If the <b><i>dividend</i></b> is <b>PHP_INT_MIN</b> and the <b><i>divisor</i></b> is -1,
 * then an {@link ArithmeticError} exception is thrown.
 * </p>
 * @since 7.0
 */
function intdiv($dividend, $divisor) { }

/**
 * Finds whether a value is a legal finite number
 *
 * @link  http://php.net/manual/en/function.is-finite.php
 *
 * @param float $val <p>
 *                   The value to check
 *                   </p>
 *
 * @return bool true if val is a legal finite
 * number within the allowed range for a PHP float on this platform,
 * else false.
 * @since 4.2.0
 * @since 5.0
 */
function is_finite($val) { }

/**
 * Finds whether a value is infinite
 *
 * @link  http://php.net/manual/en/function.is-infinite.php
 *
 * @param float $val <p>
 *                   The value to check
 *                   </p>
 *
 * @return bool true if val is infinite, else false.
 * @since 4.2.0
 * @since 5.0
 */
function is_infinite($val) { }

/**
 * Finds whether a value is not a number
 *
 * @link  http://php.net/manual/en/function.is-nan.php
 *
 * @param float $val <p>
 *                   The value to check
 *                   </p>
 *
 * @return bool true if val is 'not a number',
 * else false.
 * @since 4.2.0
 * @since 5.0
 */
function is_nan($val) { }

/**
 * Combined linear congruential generator
 *
 * @link  http://php.net/manual/en/function.lcg-value.php
 * @return float A pseudo random float value in the range of (0, 1)
 * @since 4.0
 * @since 5.0
 */
function lcg_value() { }

/**
 * Natural logarithm
 *
 * @link  http://php.net/manual/en/function.log.php
 *
 * @param float $arg  <p>
 *                    The value to calculate the logarithm for
 *                    </p>
 * @param float $base [optional] <p>
 *                    The optional logarithmic base to use
 *                    (defaults to 'e' and so to the natural logarithm).
 *                    </p>
 *
 * @return float The logarithm of arg to
 * base, if given, or the
 * natural logarithm.
 * @since 4.0
 * @since 5.0
 */
function log($arg, $base = null) { }

/**
 * Base-10 logarithm
 *
 * @link  http://php.net/manual/en/function.log10.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The base-10 logarithm of arg
 * @since 4.0
 * @since 5.0
 */
function log10($arg) { }

/**
 * Returns log(1 + number), computed in a way that is accurate even when the value of number is close to zero.
 *
 * @since 4.1.0
 * @since 5.0
 *
 * @link  http://php.net/manual/en/function.log1p.php
 *
 * @param float $number <p>
 *                      The argument to process
 *                      </p>
 *
 * @return float log(1 + number)
 */
function log1p($number) { }

/**
 * Find highest value
 *
 * @link  http://php.net/manual/en/function.max.php
 *
 * @param array|mixed $value1 Array to look through or first value to compare
 * @param mixed       $value2 [optional] second value to compare
 *                            </p>
 * @param mixed       $values [optional] any comparable value
 *
 * @return mixed max returns the numerically highest of the
 * parameter values, either within a arg array or two arguments.
 * @since 4.0
 * @since 5.0
 */
function max(array $value1, $value2 = null, ...$values) { }

/**
 * Find lowest value
 *
 * @link  http://php.net/manual/en/function.min.php
 *
 * @param array|mixed $value1 Array to look through or first value to compare
 * @param mixed       $value2 [optional] second value to compare
 *                            </p>
 * @param mixed       $values [optional] any comparable value
 *
 * @return mixed min returns the numerically lowest of the
 * parameter values.
 * @since 4.0
 * @since 5.0
 */
function min(array $value1, $value2 = null, ...$values) { }

/**
 * Show largest possible random value
 *
 * @link  http://php.net/manual/en/function.mt-getrandmax.php
 * @return int the maximum random value returned by mt_rand
 * @since 4.0
 * @since 5.0
 */
function mt_getrandmax() { }

/**
 * Generate a better random value
 *
 * @link  http://php.net/manual/en/function.mt-rand.php
 *
 * @param $min [optional]
 * @param $max [optional]
 *
 * @return int A random integer value between min (or 0)
 * and max (or mt_getrandmax, inclusive)
 * @since 4.0
 * @since 5.0
 */
function mt_rand($min, $max) { }

/**
 * Seed the better random number generator
 *
 * @link  http://php.net/manual/en/function.mt-srand.php
 *
 * @param int $seed [optional] <p>
 *                  An optional seed value
 *                  </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function mt_srand($seed = null) { }

/**
 * Octal to decimal
 *
 * @link  http://php.net/manual/en/function.octdec.php
 *
 * @param string $octal_string <p>
 *                             The octal string to convert
 *                             </p>
 *
 * @return number The decimal representation of octal_string
 * @since 4.0
 * @since 5.0
 */
function octdec($octal_string) { }

/**
 * Get value of pi
 *
 * @link  http://php.net/manual/en/function.pi.php
 * @return float The value of pi as float.
 * @since 4.0
 * @since 5.0
 */
function pi() { }

/**
 * Exponential expression
 *
 * @link  http://php.net/manual/en/function.pow.php
 *
 * @param number $base <p>
 *                     The base to use
 *                     </p>
 * @param number $exp  <p>
 *                     The exponent
 *                     </p>
 *
 * @return number base raised to the power of exp.
 * If the result can be represented as integer it will be returned as type
 * integer, else it will be returned as type float.
 * If the power cannot be computed false will be returned instead.
 * @since 4.0
 * @since 5.0
 */
function pow($base, $exp) { }

/**
 * Converts the radian number to the equivalent number in degrees
 *
 * @link  http://php.net/manual/en/function.rad2deg.php
 *
 * @param float $number <p>
 *                      A radian value
 *                      </p>
 *
 * @return float The equivalent of number in degrees
 * @since 4.0
 * @since 5.0
 */
function rad2deg($number) { }

/**
 * Generate a random integer
 *
 * @link  http://php.net/manual/en/function.rand.php
 *
 * @param $min [optional]
 * @param $max [optional]
 *
 * @return int A pseudo random value between min
 * (or 0) and max (or getrandmax, inclusive).
 * @since 4.0
 * @since 5.0
 */
function rand($min, $max) { }

/**
 * Returns the rounded value of val to specified precision (number of digits after the decimal point).
 * precision can also be negative or zero (default).
 * Note: PHP doesn't handle strings like "12,300.2" correctly by default. See converting from strings.
 *
 * @link  http://php.net/manual/en/function.round.php
 *
 * @param float $val       <p>
 *                         The value to round
 *                         </p>
 * @param int   $precision [optional] <p>
 *                         The optional number of decimal digits to round to.
 *                         </p>
 * @param int   $mode      [optional] <p>
 *                         One of PHP_ROUND_HALF_UP,
 *                         PHP_ROUND_HALF_DOWN,
 *                         PHP_ROUND_HALF_EVEN, or
 *                         PHP_ROUND_HALF_ODD.
 *                         </p>
 *
 * @return float The rounded value
 * @since 4.0
 * @since 5.0
 */
function round($val, $precision = 0, $mode = PHP_ROUND_HALF_UP) { }

/**
 * Sine
 *
 * @link  http://php.net/manual/en/function.sin.php
 *
 * @param float $arg <p>
 *                   A value in radians
 *                   </p>
 *
 * @return float The sine of arg
 * @since 4.0
 * @since 5.0
 */
function sin($arg) { }

/**
 * Hyperbolic sine
 *
 * @link  http://php.net/manual/en/function.sinh.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The hyperbolic sine of arg
 * @since 4.1.0
 * @since 5.0
 */
function sinh($arg) { }

/**
 * Square root
 *
 * @link  http://php.net/manual/en/function.sqrt.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The square root of arg
 * or the special value NAN for negative numbers.
 * @since 4.0
 * @since 5.0
 */
function sqrt($arg) { }

/**
 * Seed the random number generator
 *
 * @link  http://php.net/manual/en/function.srand.php
 *
 * @param int $seed [optional] <p>
 *                  Optional seed value
 *                  </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function srand($seed = null) { }

/**
 * Tangent
 *
 * @link  http://php.net/manual/en/function.tan.php
 *
 * @param float $arg <p>
 *                   The argument to process in radians
 *                   </p>
 *
 * @return float The tangent of arg
 * @since 4.0
 * @since 5.0
 */
function tan($arg) { }

/**
 * Hyperbolic tangent
 *
 * @link  http://php.net/manual/en/function.tanh.php
 *
 * @param float $arg <p>
 *                   The argument to process
 *                   </p>
 *
 * @return float The hyperbolic tangent of arg
 * @since 4.1.0
 * @since 5.0
 */
function tanh($arg) { }
