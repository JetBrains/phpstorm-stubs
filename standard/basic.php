<?php

use JetBrains\PhpStorm\Deprecated;
use JetBrains\PhpStorm\Pure;

/**
 * The full path and filename of the file. If used inside an include,
 * the name of the included file is returned.
 * Since PHP 4.0.2, <b>__FILE__</b> always contains an
 * absolute path with symlinks resolved whereas in older versions it contained relative path
 * under some circumstances.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__FILE__', "");

/**
 * The current line number of the file.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__LINE__', 0);

/**
 * The class name. (Added in PHP 4.3.0) As of PHP 5 this constant
 * returns the class name as it was declared (case-sensitive). In PHP
 * 4 its value is always lowercased. The class name includes the namespace
 * it was declared in (e.g. Foo\Bar).
 * Note that as of PHP 5.4 __CLASS__ works also in traits. When used
 * in a trait method, __CLASS__ is the name of the class the trait
 * is used in.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__CLASS__', "");

/**
 * The function name. (Added in PHP 4.3.0) As of PHP 5 this constant
 * returns the function name as it was declared (case-sensitive). In
 * PHP 4 its value is always lowercased.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__FUNCTION__', "");

/**
 * The class method name. (Added in PHP 5.0.0) The method name is
 * returned as it was declared (case-sensitive).
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__METHOD__', "");

/**
 * The trait name. (Added in PHP 5.4.0) As of PHP 5.4 this constant
 * returns the trait as it was declared (case-sensitive). The trait name includes the namespace
 * it was declared in (e.g. Foo\Bar).
 * @since 5.4
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__TRAIT__', "");

/**
 * The directory of the file. If used inside an include,
 * the directory of the included file is returned. This is equivalent
 * to `dirname(__FILE__)`. This directory name
 * does not have a trailing slash unless it is the root directory.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__DIR__', "");

/**
 * The name of the current namespace (case-sensitive). This constant
 * is defined in compile-time (Added in PHP 5.3.0).
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define('__NAMESPACE__', "");

/**
 * Loads a php extension at runtime
 * @param string $extension_filename <p>
 * This parameter is only the filename of the
 * extension to load which also depends on your platform. For example,
 * the sockets extension (if compiled
 * as a shared module, not the default!) would be called
 * sockets.so on Unix platforms whereas it is called
 * php_sockets.dll on the Windows platform.
 * </p>
 * <p>
 * The directory where the extension is loaded from depends on your
 * platform:
 * </p>
 * <p>
 * Windows - If not explicitly set in the <i>php.ini</i>, the extension is
 * loaded from C:\php4\extensions\ (PHP 4) or
 * C:\php5\ (PHP 5) by default.
 * </p>
 * <p>
 * Unix - If not explicitly set in the <i>php.ini</i>, the default extension
 * directory depends on
 * whether PHP has been built with --enable-debug
 * or not</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure. If the functionality of loading modules is not available
 * or has been disabled (either by setting
 * enable_dl off or by enabling safe mode
 * in <i>php.ini</i>) an <b>E_ERROR</b> is emitted
 * and execution is stopped. If <b>dl</b> fails because the
 * specified library couldn't be loaded, in addition to <b>FALSE</b> an
 * <b>E_WARNING</b> message is emitted.
 * Loads a PHP extension at runtime
 * @link https://php.net/manual/en/function.dl.php
 */
#[Deprecated(since: "5.3")]
function dl(string $extension_filename): bool {}

/**
 * Encodes an ISO-8859-1 string to UTF-8
 * @link https://php.net/manual/en/function.utf8-encode.php
 * @param string $string <p>
 * An ISO-8859-1 string.
 * </p>
 * @return string the UTF-8 translation of <i>data</i>.
 * @deprecated 8.2 Consider to use {@link mb_convert_encoding}, {@link UConverter::transcode()} or {@link iconv()}
 */
#[Pure]
#[Deprecated(replacement: "mb_convert_encoding(%parameter0%, 'UTF-8')", since: "8.2")]
function utf8_encode(string $string): string {}

/**
 * Converts a string with ISO-8859-1 characters encoded with UTF-8
 * to single-byte ISO-8859-1
 * @link https://php.net/manual/en/function.utf8-decode.php
 * @param string $string <p>
 * An UTF-8 encoded string.
 * </p>
 * @return string the ISO-8859-1 translation of <i>data</i>.
 * @deprecated 8.2 Consider to use {@link mb_convert_encoding}, {@link UConverter::transcode()} or {@link iconv()}
 */
#[Pure]
#[Deprecated(replacement: "mb_convert_encoding(%parameter0%, 'ISO-8859-1')", since: "8.2")]
function utf8_decode(string $string): string {}
