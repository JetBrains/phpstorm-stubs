<?php
/**
 * PHPStorm stub file for libxml classes.
 *
 * @link http://php.net/manual/en/book.libxml.php
 */

/**
 * Contains various information about errors thrown by libxml.
 *
 * The error codes are described within the official xmlError API documentation.
 *
 * @link http://php.net/manual/en/class.libxmlerror.php
 */
class LibXMLError
{
    /**
     * <p style="margin-top:0;">
     * The error's code.
     * </p>
     *
     * @var int
     */
    public $code;
    /**
     * <p style="margin-top:0;">
     * The column where the error occurred.
     * </p>
     * <p><b>Note</b>:
     * </p><p>
     * This property isn't entirely implemented in libxml and therefore
     * 0 is often returned.
     * </p>
     *
     * @var int
     */
    public $column;
    /**
     * <p style="margin-top:0;">The filename, or empty if the XML was loaded from a string.</p>
     *
     * @var string
     */
    public $file;
    /**
     * <p style="margin-top:0;">
     * the severity of the error (one of the following constants:
     * <b><code>LIBXML_ERR_WARNING</code></b>,
     * <b><code>LIBXML_ERR_ERROR</code></b> or
     * <b><code>LIBXML_ERR_FATAL</code></b>)
     * </p>
     *
     * @var int
     */
    public $level;
    /**
     * <p style="margin-top:0;">
     * The line where the error occurred.
     * </p>
     *
     * @var int
     */
    public $line;
    /**
     * <p style="margin-top:0;">
     * The error message, if any.
     * </p>
     *
     * @var string
     */
    public $message;
}
