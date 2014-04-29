<?php

// Start of gmp v.

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Create GMP number
 * @link http://php.net/manual/en/function.gmp-init.php
 * @param mixed $number <p>
 * An integer or a string. The string representation can be decimal,
 * hexadecimal or octal.
 * </p>
 * @param int $base [optional] <p>
 * The base.
 * </p>
 * <p>
 * The base may vary from 2 to 36. If base is 0 (default value), the
 * actual base is determined from the leading characters: if the first
 * two characters are 0x or 0X,
 * hexadecimal is assumed, otherwise if the first character is "0",
 * octal is assumed, otherwise decimal is assumed.
 * </p>
 * @return resource A GMP number resource.
 */
function gmp_init ($number, $base = 0) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Convert GMP number to integer
 * @link http://php.net/manual/en/function.gmp-intval.php
 * @param resource $gmpnumber <p>
 * A GMP number.
 * </p>
 * @return int An integer value of <i>gmpnumber</i>.
 */
function gmp_intval ($gmpnumber) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Convert GMP number to string
 * @link http://php.net/manual/en/function.gmp-strval.php
 * @param resource $gmpnumber <p>
 * The GMP number that will be converted to a string.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $base [optional] <p>
 * The base of the returned number. The default base is 10.
 * Allowed values for the base are from 2 to 62 and -2 to -36.
 * </p>
 * @return string The number, as a string.
 */
function gmp_strval ($gmpnumber, $base = 10) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Add numbers
 * @link http://php.net/manual/en/function.gmp-add.php
 * @param resource $a <p>
 * A number that will be added.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b <p>
 * A number that will be added.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number representing the sum of the arguments.
 */
function gmp_add ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Subtract numbers
 * @link http://php.net/manual/en/function.gmp-sub.php
 * @param resource $a <p>
 * The number being subtracted from.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b <p>
 * The number subtracted from <i>a</i>.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number resource.
 */
function gmp_sub ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Multiply numbers
 * @link http://php.net/manual/en/function.gmp-mul.php
 * @param resource $a <p>
 * A number that will be multiplied by <i>b</i>.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b <p>
 * A number that will be multiplied by <i>a</i>.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number resource.
 */
function gmp_mul ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Divide numbers and get quotient and remainder
 * @link http://php.net/manual/en/function.gmp-div-qr.php
 * @param resource $n <p>
 * The number being divided.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $d <p>
 * The number that <i>n</i> is being divided by.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $round [optional] <p>
 * See the <b>gmp_div_q</b> function for description
 * of the <i>round</i> argument.
 * </p>
 * @return array an array, with the first
 * element being [n/d] (the integer result of the
 * division) and the second being (n - [n/d] * d)
 * (the remainder of the division).
 */
function gmp_div_qr ($n, $d, $round = 'GMP_ROUND_ZERO') {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Divide numbers
 * @link http://php.net/manual/en/function.gmp-div-q.php
 * @param resource $a <p>
 * The number being divided.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b <p>
 * The number that <i>a</i> is being divided by.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $round [optional] <p>
 * The result rounding is defined by the
 * <i>round</i>, which can have the following
 * values:
 * <b>GMP_ROUND_ZERO</b>: The result is truncated
 * towards 0.
 * @return resource A GMP number resource.
 */
function gmp_div_q ($a, $b, $round = 'GMP_ROUND_ZERO') {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Remainder of the division of numbers
 * @link http://php.net/manual/en/function.gmp-div-r.php
 * @param resource $n <p>
 * The number being divided.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $d <p>
 * The number that <i>n</i> is being divided by.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $round [optional] <p>
 * See the <b>gmp_div_q</b> function for description
 * of the <i>round</i> argument.
 * </p>
 * @return resource The remainder, as a GMP number.
 */
function gmp_div_r ($n, $d, $round = 'GMP_ROUND_ZERO') {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Alias of <b>gmp_div_q</b>
 * @link http://php.net/manual/en/function.gmp-div.php
 * @param $a
 * @param $b
 * @param $round [optional]
 */
function gmp_div ($a, $b, $round) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Modulo operation
 * @link http://php.net/manual/en/function.gmp-mod.php
 * @param resource $n It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $d <p>
 * The modulo that is being evaluated.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number resource.
 */
function gmp_mod ($n, $d) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Exact division of numbers
 * @link http://php.net/manual/en/function.gmp-divexact.php
 * @param resource $n <p>
 * The number being divided.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $d <p>
 * The number that <i>a</i> is being divided by.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number resource.
 */
function gmp_divexact ($n, $d) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Negate number
 * @link http://php.net/manual/en/function.gmp-neg.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource -<i>a</i>, as a GMP number.
 */
function gmp_neg ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Absolute value
 * @link http://php.net/manual/en/function.gmp-abs.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource the absolute value of <i>a</i>, as a GMP number.
 */
function gmp_abs ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Factorial
 * @link http://php.net/manual/en/function.gmp-fact.php
 * @param mixed $a <p>
 * The factorial number.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number resource.
 */
function gmp_fact ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculate square root
 * @link http://php.net/manual/en/function.gmp-sqrt.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource The integer portion of the square root, as a GMP number.
 */
function gmp_sqrt ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Square root with remainder
 * @link http://php.net/manual/en/function.gmp-sqrtrem.php
 * @param resource $a <p>
 * The number being square rooted.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return array array where first element is the integer square root of
 * <i>a</i> and the second is the remainder
 * (i.e., the difference between <i>a</i> and the
 * first element squared).
 */
function gmp_sqrtrem ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Raise number into power
 * @link http://php.net/manual/en/function.gmp-pow.php
 * @param resource $base <p>
 * The base number.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $exp <p>
 * The positive power to raise the <i>base</i>.
 * </p>
 * @return resource The new (raised) number, as a GMP number. The case of
 * 0^0 yields 1.
 */
function gmp_pow ($base, $exp) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Raise number into power with modulo
 * @link http://php.net/manual/en/function.gmp-powm.php
 * @param resource $base <p>
 * The base number.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $exp <p>
 * The positive power to raise the <i>base</i>.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $mod <p>
 * The modulo.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource The new (raised) number, as a GMP number.
 */
function gmp_powm ($base, $exp, $mod) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Perfect square check
 * @link http://php.net/manual/en/function.gmp-perfect-square.php
 * @param resource $a <p>
 * The number being checked as a perfect square.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return bool <b>TRUE</b> if <i>a</i> is a perfect square,
 * <b>FALSE</b> otherwise.
 */
function gmp_perfect_square ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Check if number is "probably prime"
 * @link http://php.net/manual/en/function.gmp-prob-prime.php
 * @param resource $a <p>
 * The number being checked as a prime.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $reps [optional] <p>
 * Reasonable values
 * of <i>reps</i> vary from 5 to 10 (default being
 * 10); a higher value lowers the probability for a non-prime to
 * pass as a "probable" prime.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return int If this function returns 0, <i>a</i> is
 * definitely not prime. If it returns 1, then
 * <i>a</i> is "probably" prime. If it returns 2,
 * then <i>a</i> is surely prime.
 */
function gmp_prob_prime ($a, $reps = 10) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculate GCD
 * @link http://php.net/manual/en/function.gmp-gcd.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A positive GMP number that divides into both
 * <i>a</i> and <i>b</i>.
 */
function gmp_gcd ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculate GCD and multipliers
 * @link http://php.net/manual/en/function.gmp-gcdext.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return array An array of GMP numbers.
 */
function gmp_gcdext ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Inverse by modulo
 * @link http://php.net/manual/en/function.gmp-invert.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number on success or <b>FALSE</b> if an inverse does not exist.
 */
function gmp_invert ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Jacobi symbol
 * @link http://php.net/manual/en/function.gmp-jacobi.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $p It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * <p>
 * Should be odd and must be positive.
 * </p>
 * @return int A GMP number resource.
 */
function gmp_jacobi ($a, $p) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Legendre symbol
 * @link http://php.net/manual/en/function.gmp-legendre.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $p It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * <p>
 * Should be odd and must be positive.
 * </p>
 * @return int A GMP number resource.
 */
function gmp_legendre ($a, $p) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Compare numbers
 * @link http://php.net/manual/en/function.gmp-cmp.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return int a positive value if a &gt; b, zero if
 * a = b and a negative value if a &lt;
 * b.
 */
function gmp_cmp ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Sign of number
 * @link http://php.net/manual/en/function.gmp-sign.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return int 1 if <i>a</i> is positive,
 * -1 if <i>a</i> is negative,
 * and 0 if <i>a</i> is zero.
 */
function gmp_sign ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Random number
 * @link http://php.net/manual/en/function.gmp-random.php
 * @param int $limiter [optional] <p>
 * The limiter.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A random GMP number.
 */
function gmp_random ($limiter = 20) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Bitwise AND
 * @link http://php.net/manual/en/function.gmp-and.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number representing the bitwise AND comparison.
 */
function gmp_and ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Bitwise OR
 * @link http://php.net/manual/en/function.gmp-or.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number resource.
 */
function gmp_or ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculates one's complement
 * @link http://php.net/manual/en/function.gmp-com.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource the one's complement of <i>a</i>, as a GMP number.
 */
function gmp_com ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Bitwise XOR
 * @link http://php.net/manual/en/function.gmp-xor.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource A GMP number resource.
 */
function gmp_xor ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Set bit
 * @link http://php.net/manual/en/function.gmp-setbit.php
 * @param resource $a <p>
 * The value to modify.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $index <p>
 * The index of the bit to set. Index 0 represents the least significant bit.
 * </p>
 * @param bool $bit_on [optional] <p>
 * True to set the bit (set it to 1/on); false to clear the bit (set it to 0/off).
 * </p>
 * @return void A GMP number resource.
 */
function gmp_setbit (&$a, $index, $bit_on = true) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Clear bit
 * @link http://php.net/manual/en/function.gmp-clrbit.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $index <p>
 * The index of the bit to clear. Index 0 represents the least significant bit.
 * </p>
 * @return void A GMP number resource.
 */
function gmp_clrbit ($a, $index) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Scan for 0
 * @link http://php.net/manual/en/function.gmp-scan0.php
 * @param resource $a <p>
 * The number to scan.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $start <p>
 * The starting bit.
 * </p>
 * @return int the index of the found bit, as an integer. The
 * index starts from 0.
 */
function gmp_scan0 ($a, $start) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Scan for 1
 * @link http://php.net/manual/en/function.gmp-scan1.php
 * @param resource $a <p>
 * The number to scan.
 * </p>
 * It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $start <p>
 * The starting bit.
 * </p>
 * @return int the index of the found bit, as an integer.
 * If no set bit is found, -1 is returned.
 */
function gmp_scan1 ($a, $start) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Tests if a bit is set
 * @link http://php.net/manual/en/function.gmp-testbit.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @param int $index <p>
 * The bit to test
 * </p>
 * @return bool <b>TRUE</b> if the bit is set in resource <i>$a</i>,
 * otherwise <b>FALSE</b>.
 */
function gmp_testbit ($a, $index) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Population count
 * @link http://php.net/manual/en/function.gmp-popcount.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return int The population count of <i>a</i>, as an integer.
 */
function gmp_popcount ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Hamming distance
 * @link http://php.net/manual/en/function.gmp-hamdist.php
 * @param resource $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * <p>
 * It should be positive.
 * </p>
 * @param resource $b It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * <p>
 * It should be positive.
 * </p>
 * @return int A GMP number resource.
 */
function gmp_hamdist ($a, $b) {}

/**
 * (PHP 5 &gt;= 5.2.0)<br/>
 * Find next prime number
 * @link http://php.net/manual/en/function.gmp-nextprime.php
 * @param int $a It can be either a GMP number resource, or a
 * numeric string given that it is possible to convert the latter to a number.</p>
 * @return resource Return the next prime number greater than <i>a</i>,
 * as a GMP number.
 */
function gmp_nextprime ($a) {}

define ('GMP_ROUND_ZERO', 0);
define ('GMP_ROUND_PLUSINF', 1);
define ('GMP_ROUND_MINUSINF', 2);

/**
 * The GMP library version
 * @link http://php.net/manual/en/gmp.constants.php
 */
define ('GMP_VERSION', "5.1.2");

// End of gmp v.
?>
