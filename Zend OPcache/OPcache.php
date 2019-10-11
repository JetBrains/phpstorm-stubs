<?php

/**
 * (PHP 5 &gt;= 5.5.5, PECL ZendOpcache &gt;= 7.0.2 )<br/>
 * Compiles and caches a PHP script without executing it
 * @link https://secure.php.net/manual/en/function.opcache-compile-file.php
 * @param string $file The path to the PHP script to be compiled.
 * @return bool
 * Returns <b>TRUE</b> if the opcode cache for <em>script</em> was
 * invalidated or if there was nothing to invalidate, or <b>FALSE</b> if the opcode
 * cache is disabled.
 */
function opcache_compile_file($file) { }

/**
 * (PHP 5 &gt;= 5.5.0, PECL ZendOpcache &gt;= 7.0.0 )<br/>
 * Invalidates a cached script
 * @link https://secure.php.net/manual/en/function.opcache-invalidate.php
 * @param string $script <p>The path to the script being invalidated.</p>
 * @param bool $force [optional] <p> If set to <b>TRUE</b>, the script will be invalidated regardless of whether invalidation is necessary.</p>
 * @return bool
 * Returns <b>TRUE</b> if the opcode cache for <em>script</em> was
 * invalidated or if there was nothing to invalidate, or <b>FALSE</b> if the opcode
 * cache is disabled.
 */
function opcache_invalidate($script, $force = FALSE) { }

/**
 * (PHP 5 &gt;= 5.5.0, PECL ZendOpcache &gt;= 7.0.0 )<br/>
 * Resets the contents of the opcode cache
 * @link https://secure.php.net/manual/en/function.opcache-reset.php
 * @return bool Returns <b>TRUE</b> if the opcode cache was reset, or <b>FALSE</b> if the opcode cache is disabled.
 */
function opcache_reset() { }

/**
 * (PHP 5 &gt;= 5.5.5, PECL ZendOpcache &gt;= 7.0.2 )<br/>
 * Get status information about the cache
 * @link https://php.net/manual/en/function.opcache-get-status.php
 * @param bool $get_scripts <p>Include script specific state information</p>
 * @return array <p>Returns an array of information, optionally containing script specific state information</p>
 */
function opcache_get_status ($get_scripts = TRUE) {}

/**
 * (PHP 5 &gt;= 5.5.5, PECL ZendOpcache &gt;= 7.0.2 )<br/>
 * Get configuration information about the cache
 * @link https://php.net/manual/en/function.opcache-get-configuration.php
 * @return array <p>Returns an array of information, including ini, blacklist and version</p>
 */
function opcache_get_configuration() {}

/**
 * (PHP 5 &gt;= 5.6, PECL ZendOpcache &gt;= 7.0.4 )<br/>
 * This function checks if a PHP script has been cached in OPCache. 
 * This can be used to more easily detect the "warming" of the cache for a particular script.
 * @link https://secure.php.net/manual/en/function.opcache-is-script-cached.php
 * @param string $file The path to the PHP script to be checked.
 * @return bool Returns TRUE if file is cached in OPCache, FALSE otherwise.
 */
function opcache_is_script_cached($file) {}