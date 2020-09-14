<?php

/**
 * Add two arbitrary precision numbers
 * @link https://php.net/manual/en/function.bcadd.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional] <p>
 * This optional parameter is used to set the number of digits after the
 * decimal place in the result. If omitted, it will default to the scale
 * set globally with the {@link bcscale()} function, or fallback to 0 if
 * this has not been set.
 * </p>
 * @return string The sum of the two operands, as a string.
 */
function bcadd ($left_operand, $right_operand, $scale = 0) {}

/**
 * Subtract one arbitrary precision number from another
 * @link https://php.net/manual/en/function.bcsub.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional] <p>
 * This optional parameter is used to set the number of digits after the
 * decimal place in the result. If omitted, it will default to the scale
 * set globally with the {@link bcscale()} function, or fallback to 0 if
 * this has not been set.
 * </p>
 * @return string The result of the subtraction, as a string.
 */
function bcsub ($left_operand, $right_operand, $scale = 0) {}

/**
 * Multiply two arbitrary precision numbers
 * @link https://php.net/manual/en/function.bcmul.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional] <p>
 * This optional parameter is used to set the number of digits after the
 * decimal place in the result. If omitted, it will default to the scale
 * set globally with the {@link bcscale()} function, or fallback to 0 if
 * this has not been set.
 * </p>
 * @return string the result as a string.
 */
function bcmul ($left_operand, $right_operand, $scale = 0) {}

/**
 * Divide two arbitrary precision numbers
 * @link https://php.net/manual/en/function.bcdiv.php
 * @param string $dividend <p>
 * The dividend, as a string.
 * </p>
 * @param string $divisor <p>
 * The divisor, as a string.
 * </p>
 * @param int $scale [optional] <p>
 * This optional parameter is used to set the number of digits after the
 * decimal place in the result. If omitted, it will default to the scale
 * set globally with the {@link bcscale()} function, or fallback to 0 if
 * this has not been set.
 * </p>
 * @return string|null the result of the division as a string, or <b>NULL</b> if
 * <i>divisor</i> is 0.
 */
function bcdiv ($dividend, $divisor, $scale = 0) {}

/**
 * Get modulus of an arbitrary precision number
 * @link https://php.net/manual/en/function.bcmod.php
 * @param string $dividend <p>
 * The dividend, as a string. Since PHP 7.2, the divided is no longer truncated to an integer.
 * </p>
 * @param string $divisor <p>
 * The divisor, as a string. Since PHP 7.2, the divisor is no longer truncated to an integer.
 * </p>
 * @param int $scale [optional] <p>
 * This optional parameter is used to set the number of digits after the
 * decimal place in the result. If omitted, it will default to the scale
 * set globally with the {@link bcscale()} function, or fallback to 0 if
 * this has not been set. Available since PHP 7.2.
 * </p>
 * @return string|null the modulus as a string, or <b>NULL</b> if
 * <i>divisor</i> is 0.
 */
function bcmod ($dividend, $divisor, $scale = 0) {}

/**
 * Raise an arbitrary precision number to another
 * @link https://php.net/manual/en/function.bcpow.php
 * @param string $base <p>
 * The base, as a string.
 * </p>
 * @param string $exponent <p>
 * The exponent, as a string. If the exponent is non-integral, it is truncated.
 * The valid range of the exponent is platform specific, but is at least
 * -2147483648 to 2147483647.
 * </p>
 * @param int $scale [optional] <p>
 * This optional parameter is used to set the number of digits after the
 * decimal place in the result. If omitted, it will default to the scale
 * set globally with the {@link bcscale()} function, or fallback to 0 if
 * this has not been set.
 * </p>
 * @return string the result as a string.
 */
function bcpow ($base, $exponent, $scale = 0) {}

/**
 * Get the square root of an arbitrary precision number
 * @link https://php.net/manual/en/function.bcsqrt.php
 * @param string $operand <p>
 * The operand, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string|null the square root as a string, or <b>NULL</b> if
 * <i>operand</i> is negative.
 */
function bcsqrt ($operand, $scale = null) {}

/**
 * Set default scale parameter for all bc math functions
 * @link https://php.net/manual/en/function.bcscale.php
 * @param int $scale <p>
 * The scale factor. Since 7.3.0 can be omitted.
 * </p>
 * @return int|true <b>INT</b> since 7.3.0 and <b>TRUE</b> before.
 */
function bcscale ($scale = null) {}

/**
 * Compare two arbitrary precision numbers
 * @link https://php.net/manual/en/function.bccomp.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional] <p>
 * The optional <i>scale</i> parameter is used to set the
 * number of digits after the decimal place which will be used in the
 * comparison.
 * </p>
 * @return int 0 if the two operands are equal, 1 if the
 * <i>left_operand</i> is larger than the
 * <i>right_operand</i>, -1 otherwise.
 */
function bccomp ($left_operand, $right_operand, $scale = 0) {}

/**
 * Raise an arbitrary precision number to another, reduced by a specified modulus
 * @link https://php.net/manual/en/function.bcpowmod.php
 * @param string $base <p>
 * The base, as an integral string (i.e. the scale has to be zero).
 * </p>
 * @param string $exponent <p>
 * The exponent, as an non-negative, integral string (i.e. the scale has to be
 * zero).
 * </p>
 * @param string $modulus <p>
 * The modulus, as an integral string (i.e. the scale has to be zero).
 * </p>
 * @param int $scale [optional] <p>
 * This optional parameter is used to set the number of digits after the
 * decimal place in the result. If omitted, it will default to the scale
 * set globally with the {@link bcscale()} function, or fallback to 0 if
 * this has not been set.
 * </p>
 * @return string|null the result as a string, or <b>NULL</b> if <i>modulus</i>
 * is 0 or <i>exponent</i> is negative.
 */
function bcpowmod ($base, $exponent, $modulus, $scale = 0) {}
