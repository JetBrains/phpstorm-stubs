<?php

/**
 * Check for alphanumeric character(s)
 * @link https://php.net/manual/en/function.ctype-alnum.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i> is either
 * a letter or a digit, <b>FALSE</b> otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_alnum ($text) {}

/**
 * Check for alphabetic character(s)
 * @link https://php.net/manual/en/function.ctype-alpha.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i> is
 * a letter from the current locale, <b>FALSE</b> otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_alpha ($text) {}

/**
 * Check for control character(s)
 * @link https://php.net/manual/en/function.ctype-cntrl.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i> is
 * a control character from the current locale, <b>FALSE</b> otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_cntrl ($text) {}

/**
 * Check for numeric character(s)
 * @link https://php.net/manual/en/function.ctype-digit.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in the string
 * <i>text</i> is a decimal digit, <b>FALSE</b> otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_digit ($text) {}

/**
 * Check for lowercase character(s)
 * @link https://php.net/manual/en/function.ctype-lower.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i> is
 * a lowercase letter in the current locale.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_lower ($text) {}

/**
 * Check for any printable character(s) except space
 * @link https://php.net/manual/en/function.ctype-graph.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i> is
 * printable and actually creates visible output (no white space), <b>FALSE</b>
 * otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_graph ($text) {}

/**
 * Check for printable character(s)
 * @link https://php.net/manual/en/function.ctype-print.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i>
 * will actually create output (including blanks). Returns <b>FALSE</b> if
 * <i>text</i> contains control characters or characters
 * that do not have any output or control function at all.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_print ($text) {}

/**
 * Check for any printable character which is not whitespace or an
 * @since 4.0.4
 * @since 5.0
alphanumeric character
 * @link https://php.net/manual/en/function.ctype-punct.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i>
 * is printable, but neither letter, digit or blank, <b>FALSE</b> otherwise.
 */
function ctype_punct ($text) {}

/**
 * Check for whitespace character(s)
 * @link https://php.net/manual/en/function.ctype-space.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i>
 * creates some sort of white space, <b>FALSE</b> otherwise. Besides the
 * blank character this also includes tab, vertical tab, line feed,
 * carriage return and form feed characters.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_space ($text) {}

/**
 * Check for uppercase character(s)
 * @link https://php.net/manual/en/function.ctype-upper.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i> is
 * an uppercase letter in the current locale.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_upper ($text) {}

/**
 * Check for character(s) representing a hexadecimal digit
 * @link https://php.net/manual/en/function.ctype-xdigit.php
 * @param string $text <p>
 * The tested string.
 * </p>
 * @return bool <b>TRUE</b> if every character in <i>text</i> is
 * a hexadecimal 'digit', that is a decimal digit or a character from
 * [A-Fa-f] , <b>FALSE</b> otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function ctype_xdigit ($text) {}
