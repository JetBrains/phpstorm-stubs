<?php

class OPcache {

    /**
     * (PHP 5 &gt;= 5.5.5, PECL ZendOpcache &gt;= 7.0.2 )<br/>
     * Compiles and caches a PHP script without executing it
     * @link http://www.php.net/manual/en/function.opcache-compile-file.php
     * @param string $file The path to the PHP script to be compiled.
     * @return boolean
     * Returns <b>TRUE</b> if the opcode cache for <em>script</em> was
     * invalidated or if there was nothing to invalidate, or <b>FALSE</b> if the opcode
     * cache is disabled.
     */
    function opcache_compile_file($file) { }

    /**
     * (PHP 5 &gt;= 5.5.0, PECL ZendOpcache &gt;= 7.0.0 )<br/>
     * Invalidates a cached script
     * @link http://www.php.net/manual/en/function.opcache-invalidate.php
     * @param string $script <p>The path to the script being invalidated.</p>
     * @param bool $force [optional] <p> If set to <b>TRUE</b>, the script will be invalidated regardless of whether invalidation is necessary.</p>
     * @return boolean
     * Returns <b>TRUE</b> if the opcode cache for <em>script</em> was
     * invalidated or if there was nothing to invalidate, or <b>FALSE</b> if the opcode
     * cache is disabled.
     */
    function opcache_invalidate($script, $force = FALSE) { }

    /**
     * (PHP 5 &gt;= 5.5.0, PECL ZendOpcache &gt;= 7.0.0 )<br/>
     * Resets the contents of the opcode cache
     * @link http://www.php.net/manual/en/function.opcache-reset.php
     * @return boolean Returns <b>TRUE</b> if the opcode cache was reset, or <b>FALSE</b> if the opcode cache is disabled.
     */
    function opcache_reset() { }
}