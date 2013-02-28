<?php

// Start of recode v.

/**
 * (PHP 4, PHP 5)<br/>
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
 * (PHP 4, PHP 5)<br/>
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
 * (PHP 4, PHP 5)<br/>
 * Alias of <b>recode_string</b>
 * @link http://php.net/manual/en/function.recode.php
 * @param $request
 * @param $str
 */
function recode ($request, $str) {}

// End of recode v.
?>
