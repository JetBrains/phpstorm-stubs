<?php

/** @link https://github.com/krakjoe/pcov/blob/develop/README.md */

namespace
{
    define('pcov\all', 0);
    define('pcov\inclusive', 1);
    define('pcov\exclusive', 2);
    define('pcov\version', '1.0.6');
}

namespace pcov
{
    /**
     * Shall start recording coverage information
     * @return void
     * @since 7.0
     */
    function start () {}

    /**
     * Shall stop recording coverage information
     * @return void
     * @since 7.0
     */
    function stop() {}

    /*
    * Shall collect coverage information
    * @param int $type [optional] <p>
    * pcov\all shall collect coverage information for all files
    * pcov\inclusive shall collect coverage information for the specified files
    * pcov\exclusive shall collect coverage information for all but the specified files
    * </p>
    * @param array $filenames [optional] <p>
    * Note: paths in filter must be realpath
    * </p>
    * @return array
    * @since 7.0
    */
    function collect($type = all, $filter = []) {}

    /*
    * Shall clear stored information
    * @param bool $files [optional] <p>
    * set true to clear file tables
    * Note: clearing the file tables may have surprising consequences
    * </p>
    * @return void
    * @since 7.0
    */
    function clear($files = false) {}

    /*
    * Shall return list of files waiting to be collected
    * @return array
    * @since 7.0
    */
    function waiting() {}

    /*
    * Shall return the current size of the trace and cfg arena
    * @return int
    * @since 7.0
    */
    function memory() {}
}
