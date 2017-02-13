<?php
/**
 * PHPStorm stub file for Regular Expressions (Perl-Compatible) constants.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */

/**
 * PCRE version and release date (e.g. "7.0 18-Dec-2006").
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PCRE_VERSION = '8.31 2012-07-06';
/**
 * Returned by <b>preg_last_error</b> if backtrack limit was exhausted.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_BACKTRACK_LIMIT_ERROR = 2;
/**
 * Returned by <b>preg_last_error</b> if the last error was
 * caused by malformed UTF-8 data (only when running a regex in UTF-8 mode).
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_BAD_UTF8_ERROR = 4;
/**
 * Returned by <b>preg_last_error</b> if the offset didn't
 * correspond to the begin of a valid UTF-8 code point (only when running
 * a regex in UTF-8
 * mode).
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_BAD_UTF8_OFFSET_ERROR = 5;
const PREG_GREP_INVERT = 1;
/**
 * Returned by <b>preg_last_error</b> if there was an
 * internal PCRE error.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_INTERNAL_ERROR = 1;
/**
 * Returned by {@see preg_last_error()} if the last PCRE function failed due to limited JIT stack space.
 *
 * @since 7.0
 */
const PREG_JIT_STACKLIMIT_ERROR = 6;
/**
 * Returned by <b>preg_last_error</b> if there were no
 * errors.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_NO_ERROR = 0;
/**
 * See the description of
 * <b>PREG_SPLIT_OFFSET_CAPTURE</b>.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_OFFSET_CAPTURE = 256;
/**
 * Orders results so that $matches[0] is an array of full pattern
 * matches, $matches[1] is an array of strings matched by the first
 * parenthesized subpattern, and so on. This flag is only used with
 * <b>preg_match_all</b>.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_PATTERN_ORDER = 1;
/**
 * Returned by <b>preg_last_error</b> if recursion limit was exhausted.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_RECURSION_LIMIT_ERROR = 3;
/**
 * Orders results so that $matches[0] is an array of first set of
 * matches, $matches[1] is an array of second set of matches, and so
 * on. This flag is only used with <b>preg_match_all</b>.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_SET_ORDER = 2;
/**
 * This flag tells <b>preg_split</b> to capture
 * parenthesized expression in the delimiter pattern as well.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_SPLIT_DELIM_CAPTURE = 2;
/**
 * This flag tells <b>preg_split</b> to return only non-empty
 * pieces.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_SPLIT_NO_EMPTY = 1;
/**
 * If this flag is set, for every occurring match the appendant string
 * offset will also be returned. Note that this changes the return
 * values in an array where every element is an array consisting of the
 * matched string at offset 0 and its string offset within subject at
 * offset 1. This flag is only used for <b>preg_split</b>.
 *
 * @link http://php.net/manual/en/pcre.constants.php
 */
const PREG_SPLIT_OFFSET_CAPTURE = 4;
