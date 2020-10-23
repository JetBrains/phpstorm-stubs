<?php

/**
 * <b>Reflector</b> is an interface implemented by all
 * exportable Reflection classes.
 *
 * @link https://php.net/manual/en/class.reflector.php
 */
interface Reflector extends Stringable
{
    /**
     * Exports a class.
     *
     * @link https://php.net/manual/en/reflector.export.php
     * @return string|void
     * @deprecated 7.4
     * @removed 8.0
     */
    public static function export();

    /**
     * Returns the string representation of any Reflection object.
     *
     * @return string
     */
    public function __toString();
}
