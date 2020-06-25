<?php

/**
 * The <b>ReflectionObject</b> class reports
 * information about an object.
 *
 * @link https://php.net/manual/en/class.reflectionobject.php
 */
class ReflectionObject extends ReflectionClass implements Reflector
{
    /**
     * Constructs a ReflectionObject
     *
     * @link https://php.net/manual/en/reflectionobject.construct.php
     * @param object $argument An object instance.
     */
    public function __construct(object $argument)
    {
    }

    /**
     * Export
     *
     * @link https://php.net/manual/en/reflectionobject.export.php
     * @param string $argument The reflection to export.
     * @param bool $return Setting to {@see true} will return the export,
     * as opposed to emitting it. Setting to {@see false} (the default) will do
     * the opposite.
     * @return string|null If the $return parameter is set to {@see true}, then
     * the export is returned as a string, otherwise {@see null} is returned.
     * @deprecated Since PHP 7.4 and removed in 8.0
     */
    public static function export(string $argument, bool $return = false): ?string
    {
    }
}
