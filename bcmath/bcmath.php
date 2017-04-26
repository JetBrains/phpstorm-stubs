<?php

/**
 * Add two arbitrary precision numbers
 * @link http://php.net/manual/en/function.bcadd.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string The sum of the two operands, as a string.
 * @since 4.0
 * @since 5.0
 */
function bcadd ($left_operand, $right_operand, $scale = null) {}

/**
 * Subtract one arbitrary precision number from another
 * @link http://php.net/manual/en/function.bcsub.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string The result of the subtraction, as a string.
 * @since 4.0
 * @since 5.0
 */
function bcsub ($left_operand, $right_operand, $scale = null) {}

/**
 * Multiply two arbitrary precision numbers
 * @link http://php.net/manual/en/function.bcmul.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string the result as a string.
 * @since 4.0
 * @since 5.0
 */
function bcmul ($left_operand, $right_operand, $scale = null) {}

/**
 * Divide two arbitrary precision numbers
 * @link http://php.net/manual/en/function.bcdiv.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string the result of the division as a string, or <b>NULL</b> if
 * <i>right_operand</i> is 0.
 * @since 4.0
 * @since 5.0
 */
function bcdiv ($left_operand, $right_operand, $scale = null) {}

/**
 * Get modulus of an arbitrary precision number
 * @link http://php.net/manual/en/function.bcmod.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $modulus <p>
 * The modulus, as a string.
 * </p>
 * @return string the modulus as a string, or <b>NULL</b> if
 * <i>modulus</i> is 0.
 * @since 4.0
 * @since 5.0
 */
function bcmod ($left_operand, $modulus) {}

/**
 * Raise an arbitrary precision number to another
 * @link http://php.net/manual/en/function.bcpow.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string the result as a string.
 * @since 4.0
 * @since 5.0
 */
function bcpow ($left_operand, $right_operand, $scale = null) {}

/**
 * Get the square root of an arbitrary precision number
 * @link http://php.net/manual/en/function.bcsqrt.php
 * @param string $operand <p>
 * The operand, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string the square root as a string, or <b>NULL</b> if
 * <i>operand</i> is negative.
 * @since 4.0
 * @since 5.0
 */
function bcsqrt ($operand, $scale = null) {}

/**
 * Set default scale parameter for all bc math functions
 * @link http://php.net/manual/en/function.bcscale.php
 * @param int $scale <p>
 * The scale factor.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function bcscale ($scale) {}

/**
 * Compare two arbitrary precision numbers
 * @link http://php.net/manual/en/function.bccomp.php
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
 * @since 4.0
 * @since 5.0
 */
function bccomp ($left_operand, $right_operand, $scale = null) {}

/**
 * Raise an arbitrary precision number to another, reduced by a specified modulus
 * @link http://php.net/manual/en/function.bcpowmod.php
 * @param string $left_operand <p>
 * The left operand, as a string.
 * </p>
 * @param string $right_operand <p>
 * The right operand, as a string.
 * </p>
 * @param string $modulus <p>
 * The modulus, as a string.
 * </p>
 * @param int $scale [optional]
 * @return string the result as a string, or <b>NULL</b> if <i>modulus</i>
 * is 0.
 * @since 5.0
 */
function bcpowmod ($left_operand, $right_operand, $modulus, $scale = null) {}
