<?php

/**
 * @deprecated 5.3.0 since 5.3.0
 * Loads a PHP extension at runtime
 * @link https://php.net/manual/en/function.dl.php
 * @param string $library <p>
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
 * or not
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure. If the functionality of loading modules is not available
 * or has been disabled (either by setting
 * enable_dl off or by enabling safe mode
 * in <i>php.ini</i>) an <b>E_ERROR</b> is emitted
 * and execution is stopped. If <b>dl</b> fails because the
 * specified library couldn't be loaded, in addition to <b>FALSE</b> an
 * <b>E_WARNING</b> message is emitted.
 * @since 4.0
 * @since 5.0
 */
function dl ($library) {}

/**
 * Sets the process title
 * @link https://php.net/manual/en/function.cli-set-process-title.php
 * @param string $title <p>
 * The new title.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.5.0
 */
function cli_set_process_title ($title) {}

/**
 * Returns the current process title
 * @link https://php.net/manual/en/function.cli-get-process-title.php
 * @return string Return a string with the current process title or <b>NULL</b> on error.
 * @since 5.5.0
 */
function cli_get_process_title () {}

/**
 * Reclaims memory used by the Zend Engine memory manager
 * @link https://php.net/manual/en/function.gc-mem-caches.php
 * @return int Returns the number of bytes freed.
 * @since 7.0
 */
function gc_mem_caches () {}

/**
 * Returns active resources
 * @link https://php.net/manual/en/function.get-resources.php
 * @param string $type [optional]<p>
 *
 * If defined, this will cause get_resources() to only return resources of the given type. A list of resource types is available.
 *
 * If the string Unknown is provided as the type, then only resources that are of an unknown type will be returned.
 *
 * If omitted, all resources will be returned.
 * </p>
 * @return array Returns an array of currently active resources, indexed by resource number.
 * @since 7.0
 */
function get_resources ($type) {}


/**
 * The full path and filename of the file. If used inside an include,
 * the name of the included file is returned.
 * Since PHP 4.0.2, <b>__FILE__</b> always contains an
 * absolute path with symlinks resolved whereas in older versions it contained relative path
 * under some circumstances.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define ('__FILE__', '', true);

/**
 * The current line number of the file.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define ('__LINE__', 0, true);

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
define ('__CLASS__', '', true);

/**
 * The function name. (Added in PHP 4.3.0) As of PHP 5 this constant
 * returns the function name as it was declared (case-sensitive). In
 * PHP 4 its value is always lowercased.
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define ('__FUNCTION__', '', true);

/**
 * The class method name. (Added in PHP 5.0.0) The method name is
 * returned as it was declared (case-sensitive).
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define ('__METHOD__', '', true);

/**
 * The trait name. (Added in PHP 5.4.0) As of PHP 5.4 this constant
 * returns the trait as it was declared (case-sensitive). The trait name includes the namespace
 * it was declared in (e.g. Foo\Bar).
 * @since 5.4.0
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define ('__TRAIT__', '', true);

/**
 * The directory of the file. If used inside an include,
 * the directory of the included file is returned. This is equivalent
 * to dirname(__FILE__). This directory name
 * does not have a trailing slash unless it is the root directory.
 * @since 5.3.0
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define ('__DIR__', '', true);

/**
 * The name of the current namespace (case-sensitive). This constant
 * is defined in compile-time (Added in PHP 5.3.0).
 * @since 5.3.0
 * @link https://php.net/manual/en/language.constants.predefined.php
 */
define ('__NAMESPACE__', '', true);

