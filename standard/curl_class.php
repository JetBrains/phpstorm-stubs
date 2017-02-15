<?php
/**
 * PHPStorm stub file for cURL classes.
 *
 * @link http://php.net/manual/en/book.curl.php
 */

/**
 * Class CURLFile
 *
 * @link http://php.net/manual/en/class.curlfile.php
 * @since 5.5.0
 */
class CURLFile
{
    public $mime;
    public $name;
    public $postname;

    /**
     * Create a CURLFile object
     *
     * @link  http://www.php.net/manual/en/curlfile.construct.php
     *
     * @param string $filename <p>Path to the file which will be uploaded.</p>
     * @param string $mimetype [optional] <p>Mimetype of the file.</p>
     * @param string $postname [optional] <p>Name of the file.</p>
     *
     * @since 5.5.0
     */
    public function __construct($filename, $mimetype, $postname) { }

    /**
     * @link  http://www.php.net/manual/en/curlfile.wakeup.php
     * Unserialization handler
     * @since 5.5.0
     */
    public function __wakeup() { }

    /**
     * Get file name
     *
     * @link  http://www.php.net/manual/en/curlfile.getfilename.php
     * @return string Returns file name.
     * @since 5.5.0
     */
    public function getFilename() { }

    /**
     * Get MIME type
     *
     * @link  http://www.php.net/manual/en/curlfile.getmimetype.php
     * @return string Returns MIME type.
     * @since 5.5.0
     */
    public function getMimeType() { }

    /**
     * Get file name for POST
     *
     * @link  http://www.php.net/manual/en/curlfile.getpostfilename.php
     * @return string Returns file name for POST.
     * @since 5.5.0
     */
    public function getPostFilename() { }

    /**
     * Set MIME type
     *
     * @link  http://www.php.net/manual/en/curlfile.setmimetype.php
     *
     * @param string $mime
     *
     * @since 5.5.0
     */
    public function setMimeType($mime) { }

    /**
     * Set file name for POST
     * http://www.php.net/manual/en/curlfile.setpostfilename.php
     *
     * @param string $postname
     *
     * @since 5.5.0
     */
    public function setPostFilename($postname) { }
}
