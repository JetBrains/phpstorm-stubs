<?php

// Start of recode v.

/**
 * @since 4.0
 * @since 5.0
 * Recode a string according to a recode request
 * @link http://php.net/manual/en/function.recode-string.php
 * @param string $request <p>
 * The desired recode request type
 * </p>
 * @param string $string <p>
 * The string to be recoded
 * </p>
 * @return string the recoded string or <b>FALSE</b>, if unable to
 * perform the recode request.
 */
function recode_string ($request, $string) {}

/**
 * @since 4.0
 * @since 5.0
 * Recode from file to file according to recode request
 * @link http://php.net/manual/en/function.recode-file.php
 * @param string $request <p>
 * The desired recode request type
 * </p>
 * @param resource $input <p>
 * A local file handle resource for
 * the <i>input</i>
 * </p>
 * @param resource $output <p>
 * A local file handle resource for
 * the <i>output</i>
 * </p>
 * @return bool <b>FALSE</b>, if unable to comply, <b>TRUE</b> otherwise.
 */
function recode_file ($request, $input, $output) {}

/**
 * @since 4.0
 * @since 5.0
 * Alias of <b>recode_string</b>
 * @link http://php.net/manual/en/function.recode.php
 * @param $request
 * @param $str
 */
function recode ($request, $str) {}

// End of recode v.
?>
