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
 * @return resource &gmp.return;
 */
function gmp_init ($number, $base = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Convert GMP number to integer
 * @link http://php.net/manual/en/function.gmp-intval.php
 * @param resource $gmpnumber <p>
 * A GMP number.
 * </p>
 * @return int An integer value of gmpnumber.
 */
function gmp_intval ($gmpnumber) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Convert GMP number to string
 * @link http://php.net/manual/en/function.gmp-strval.php
 * @param resource $gmpnumber <p>
 * The GMP number that will be converted to a string.
 * </p>
 * &gmp.parameter;
 * @param int $base [optional] <p>
 * The base of the returned number. The default base is 10. 
 * Allowed values for the base are from 2 to 62 and -2 to -36.
 * </p>
 * @return string The number, as a string.
 */
function gmp_strval ($gmpnumber, $base = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Add numbers
 * @link http://php.net/manual/en/function.gmp-add.php
 * @param resource $a <p>
 * A number that will be added.
 * </p>
 * &gmp.parameter;
 * @param resource $b <p>
 * A number that will be added.
 * </p>
 * &gmp.parameter;
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
 * &gmp.parameter;
 * @param resource $b <p>
 * The number subtracted from a.
 * </p>
 * &gmp.parameter;
 * @return resource &gmp.return;
 */
function gmp_sub ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Multiply numbers
 * @link http://php.net/manual/en/function.gmp-mul.php
 * @param resource $a <p>
 * A number that will be multiplied by b.
 * </p>
 * &gmp.parameter;
 * @param resource $b <p>
 * A number that will be multiplied by a.
 * </p>
 * &gmp.parameter;
 * @return resource &gmp.return;
 */
function gmp_mul ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Divide numbers and get quotient and remainder
 * @link http://php.net/manual/en/function.gmp-div-qr.php
 * @param resource $n <p>
 * The number being divided.
 * </p>
 * &gmp.parameter;
 * @param resource $d <p>
 * The number that n is being divided by.
 * </p>
 * &gmp.parameter;
 * @param int $round [optional] <p>
 * See the gmp_div_q function for description
 * of the round argument.
 * </p>
 * @return array an array, with the first
 * element being [n/d] (the integer result of the
 * division) and the second being (n - [n/d] * d)
 * (the remainder of the division).
 */
function gmp_div_qr ($n, $d, $round = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Divide numbers
 * @link http://php.net/manual/en/function.gmp-div-q.php
 * @param resource $a <p>
 * The number being divided.
 * </p>
 * &gmp.parameter;
 * @param resource $b <p>
 * The number that a is being divided by.
 * </p>
 * &gmp.parameter;
 * @param int $round [optional] <p>
 * The result rounding is defined by the
 * round, which can have the following
 * values:
 * GMP_ROUND_ZERO: The result is truncated
 * towards 0.
 * @return resource &gmp.return;
 */
function gmp_div_q ($a, $b, $round = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Remainder of the division of numbers
 * @link http://php.net/manual/en/function.gmp-div-r.php
 * @param resource $n <p>
 * The number being divided.
 * </p>
 * &gmp.parameter;
 * @param resource $d <p>
 * The number that n is being divided by.
 * </p>
 * &gmp.parameter;
 * @param int $round [optional] <p>
 * See the gmp_div_q function for description
 * of the round argument.
 * </p>
 * @return resource The remainder, as a GMP number.
 */
function gmp_div_r ($n, $d, $round = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * &Alias; <function>gmp_div_q</function>
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
 * @param resource $n &gmp.parameter;
 * @param resource $d <p>
 * The modulo that is being evaluated.
 * </p>
 * &gmp.parameter;
 * @return resource &gmp.return;
 */
function gmp_mod ($n, $d) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Exact division of numbers
 * @link http://php.net/manual/en/function.gmp-divexact.php
 * @param resource $n <p>
 * The number being divided.
 * </p>
 * &gmp.parameter;
 * @param resource $d <p>
 * The number that a is being divided by.
 * </p>
 * &gmp.parameter;
 * @return resource &gmp.return;
 */
function gmp_divexact ($n, $d) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Negate number
 * @link http://php.net/manual/en/function.gmp-neg.php
 * @param resource $a &gmp.parameter;
 * @return resource -a, as a GMP number.
 */
function gmp_neg ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Absolute value
 * @link http://php.net/manual/en/function.gmp-abs.php
 * @param resource $a &gmp.parameter;
 * @return resource the absolute value of a, as a GMP number.
 */
function gmp_abs ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Factorial
 * @link http://php.net/manual/en/function.gmp-fact.php
 * @param mixed $a <p>
 * The factorial number.
 * </p>
 * &gmp.parameter;
 * @return resource &gmp.return;
 */
function gmp_fact ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculate square root
 * @link http://php.net/manual/en/function.gmp-sqrt.php
 * @param resource $a &gmp.parameter;
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
 * &gmp.parameter;
 * @return array array where first element is the integer square root of
 * a and the second is the remainder
 * (i.e., the difference between a and the
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
 * &gmp.parameter;
 * @param int $exp <p>
 * The positive power to raise the base.
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
 * &gmp.parameter;
 * @param resource $exp <p>
 * The positive power to raise the base.
 * </p>
 * &gmp.parameter;
 * @param resource $mod <p>
 * The modulo.
 * </p>
 * &gmp.parameter;
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
 * &gmp.parameter;
 * @return bool true if a is a perfect square,
 * false otherwise.
 */
function gmp_perfect_square ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Check if number is "probably prime"
 * @link http://php.net/manual/en/function.gmp-prob-prime.php
 * @param resource $a <p>
 * The number being checked as a prime.
 * </p>
 * &gmp.parameter;
 * @param int $reps [optional] <p>
 * Reasonable values
 * of reps vary from 5 to 10 (default being
 * 10); a higher value lowers the probability for a non-prime to
 * pass as a "probable" prime.
 * </p>
 * &gmp.parameter;
 * @return int If this function returns 0, a is
 * definitely not prime. If it returns 1, then
 * a is "probably" prime. If it returns 2,
 * then a is surely prime.
 */
function gmp_prob_prime ($a, $reps = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculate GCD
 * @link http://php.net/manual/en/function.gmp-gcd.php
 * @param resource $a &gmp.parameter;
 * @param resource $b &gmp.parameter;
 * @return resource A positive GMP number that divides into both
 * a and b.
 */
function gmp_gcd ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculate GCD and multipliers
 * @link http://php.net/manual/en/function.gmp-gcdext.php
 * @param resource $a &gmp.parameter;
 * @param resource $b &gmp.parameter;
 * @return array An array of GMP numbers.
 */
function gmp_gcdext ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Inverse by modulo
 * @link http://php.net/manual/en/function.gmp-invert.php
 * @param resource $a &gmp.parameter;
 * @param resource $b &gmp.parameter;
 * @return resource A GMP number on success or false if an inverse does not exist.
 */
function gmp_invert ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Jacobi symbol
 * @link http://php.net/manual/en/function.gmp-jacobi.php
 * @param resource $a &gmp.parameter;
 * @param resource $p &gmp.parameter; 
 * <p>
 * Should be odd and must be positive.
 * </p>
 * @return int &gmp.return;
 */
function gmp_jacobi ($a, $p) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Legendre symbol
 * @link http://php.net/manual/en/function.gmp-legendre.php
 * @param resource $a &gmp.parameter;
 * @param resource $p &gmp.parameter; 
 * <p>
 * Should be odd and must be positive.
 * </p>
 * @return int &gmp.return;
 */
function gmp_legendre ($a, $p) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Compare numbers
 * @link http://php.net/manual/en/function.gmp-cmp.php
 * @param resource $a &gmp.parameter;
 * @param resource $b &gmp.parameter;
 * @return int a positive value if a &gt; b, zero if
 * a = b and a negative value if a &lt;
 * b.
 */
function gmp_cmp ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Sign of number
 * @link http://php.net/manual/en/function.gmp-sign.php
 * @param resource $a &gmp.parameter;
 * @return int 1 if a is positive,
 * -1 if a is negative,
 * and 0 if a is zero.
 */
function gmp_sign ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Random number
 * @link http://php.net/manual/en/function.gmp-random.php
 * @param int $limiter [optional] <p>
 * The limiter.
 * </p>
 * &gmp.parameter;
 * @return resource A random GMP number.
 */
function gmp_random ($limiter = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Bitwise AND
 * @link http://php.net/manual/en/function.gmp-and.php
 * @param resource $a &gmp.parameter;
 * @param resource $b &gmp.parameter;
 * @return resource A GMP number representing the bitwise AND comparison.
 */
function gmp_and ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Bitwise OR
 * @link http://php.net/manual/en/function.gmp-or.php
 * @param resource $a &gmp.parameter;
 * @param resource $b &gmp.parameter;
 * @return resource &gmp.return;
 */
function gmp_or ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Calculates one's complement
 * @link http://php.net/manual/en/function.gmp-com.php
 * @param resource $a &gmp.parameter;
 * @return resource the one's complement of a, as a GMP number.
 */
function gmp_com ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Bitwise XOR
 * @link http://php.net/manual/en/function.gmp-xor.php
 * @param resource $a &gmp.parameter;
 * @param resource $b &gmp.parameter;
 * @return resource &gmp.return;
 */
function gmp_xor ($a, $b) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Set bit
 * @link http://php.net/manual/en/function.gmp-setbit.php
 * @param resource $a <p>
 * The number being set to.
 * </p>
 * &gmp.parameter;
 * @param int $index <p>
 * The set bit.
 * </p>
 * @param bool $set_clear [optional] <p>
 * Defines if the bit is set to 0 or 1. By default the bit is set to
 * 1. Index starts at 0.
 * </p>
 * @return void &gmp.return;
 */
function gmp_setbit (&$a, $index, $set_clear = null) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Clear bit
 * @link http://php.net/manual/en/function.gmp-clrbit.php
 * @param resource $a &gmp.parameter;
 * @param int $index &gmp.parameter;
 * @return void &gmp.return;
 */
function gmp_clrbit ($a, $index) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Scan for 0
 * @link http://php.net/manual/en/function.gmp-scan0.php
 * @param resource $a <p>
 * The number to scan.
 * </p>
 * &gmp.parameter;
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
 * &gmp.parameter;
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
 * @param resource $a &gmp.parameter;
 * @param int $index <p>
 * The bit to test
 * </p>
 * @return bool true on success or false on failure.
 */
function gmp_testbit ($a, $index) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Population count
 * @link http://php.net/manual/en/function.gmp-popcount.php
 * @param resource $a &gmp.parameter;
 * @return int The population count of a, as an integer.
 */
function gmp_popcount ($a) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Hamming distance
 * @link http://php.net/manual/en/function.gmp-hamdist.php
 * @param resource $a &gmp.parameter; 
 * <p>
 * It should be positive.
 * </p>
 * @param resource $b &gmp.parameter; 
 * <p>
 * It should be positive.
 * </p>
 * @return int &gmp.return;
 */
function gmp_hamdist ($a, $b) {}

/**
 * (PHP 5 &gt;= 5.2.0)<br/>
 * Find next prime number
 * @link http://php.net/manual/en/function.gmp-nextprime.php
 * @param int $a &gmp.parameter;
 * @return resource Return the next prime number greater than a,
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
define ('GMP_VERSION', "4.3.1");

// End of gmp v.
?>
