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
     * Exports a class
     *
     * @link https://php.net/manual/en/reflector.export.php
     * @return string|null
     * @deprecated Since PHP 7.4 and removed in 8.0
     */
    public static function export(): ?string;
}
