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
 * @return string the recoded string or false, if unable to
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
 * the input
 * </p>
 * @param resource $output <p>
 * A local file handle resource for 
 * the output
 * </p>
 * @return bool false, if unable to comply, true otherwise.
 */
function recode_file ($request, $input, $output) {}

/**
 * (PHP 4, PHP 5)<br/>
 * &Alias; <function>recode_string</function>
 * @link http://php.net/manual/en/function.recode.php
 * @param $request
 * @param $str
 */
function recode ($request, $str) {}

// End of recode v.
?>
