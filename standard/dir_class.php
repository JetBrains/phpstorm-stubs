<?php
/**
 * PHPStorm stub file for Directories classes.
 *
 * @link http://php.net/manual/en/book.dir.php
 */

/**
 * Instances of Directory are created by calling the dir() function, not by the new operator.
 */
class Directory
{
    /**
     * @var resource Can be used with other directory functions such as {@see readdir()}, {@see rewinddir()} and {@see
     *      closedir()}.
     */
    public $handle;
    /**
     * @var string The directory that was opened.
     */
    public $path;

    /**
     * Close directory handle.
     * Same as closedir(), only dir_handle defaults to $this.
     *
     * @param resource $dir_handle [optional]
     *
     * @link http://www.php.net/manual/en/directory.close.php
     */
    public function close($dir_handle) { }

    /**
     * Read entry from directory handle.
     * Same as readdir(), only dir_handle defaults to $this.
     *
     * @param resource $dir_handle [optional]
     *
     * @return string
     * @link http://www.php.net/manual/en/directory.read.php
     */
    public function read($dir_handle) { }

    /**
     *  Rewind directory handle.
     * Same as rewinddir(), only dir_handle defaults to $this.
     *
     * @param resource $dir_handle [optional]
     *
     * @link http://www.php.net/manual/en/directory.rewind.php
     */
    public function rewind($dir_handle) { }
}
