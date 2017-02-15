<?php
/**
 * PHPStorm stub file for sapi functions.
 *
 * _Not_ documented yet on php.net. Believe it's a Windows only extension.
 */

/**
 * @param int|string $in_codepage
 * @param int|string $out_codepage
 * @param string     $subject
 *
 * @return string
 * @since 7.1
 */
function sapi_windows_cp_conv($in_codepage, $out_codepage, $subject) { }

/**
 * @param string $kind
 *
 * @return int
 * @since 7.1
 */
function sapi_windows_cp_get($kind) { }

/**
 * @return bool
 * @since 7.1
 */
function sapi_windows_cp_is_utf8() { }

/**
 * @param int $cp
 *
 * @return bool
 * @since 7.1
 */
function sapi_windows_cp_set($cp) { }
