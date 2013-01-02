<?php

// Start of libxml v.

/**
 * Contains various information about errors thrown by libxml. The error codes
 * are described within the official 
 * xmlError API documentation.
 * @link http://php.net/manual/en/class.libxmlerror.php
 */
class LibXMLError  {
    /**
     * @var int the severity of the error (one of the following constants: LIBXML_ERR_WARNING, LIBXML_ERR_ERROR or LIBXML_ERR_FATAL)
     */
    public $level;
    /**
     * @var int The error's code.
     */
    public $code;
    /**
     * @var int The column where the error occurred. Note: This property isn't entirely implemented in libxml and therefore 0 is often returned.
     */
    public $column;
    /**
     * @var string The error message, if any.
     */
    public $message;
    /**
     * @var string The filename, or empty if the XML was loaded from a string.
     */
    public $file;
    /**
     * @var int The line where the error occurred.
     */
    public $line;
}

/**
 * (PHP 5)<br/>
 * Set the streams context for the next libxml document load or write
 * @link http://php.net/manual/en/function.libxml-set-streams-context.php
 * @param resource $streams_context <p>
 * The stream context resource (created with
 * <b>stream_context_create</b>)
 * </p>
 * @return void 
 */
function libxml_set_streams_context ($streams_context) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Disable libxml errors and allow user to fetch error information as needed
 * @link http://php.net/manual/en/function.libxml-use-internal-errors.php
 * @param bool $use_errors [optional] <p>
 * Enable (true) user error handling or disable (false) user error handling. Disabling will also clear any existing libxml errors.
 * </p>
 * @return bool This function returns the previous value of
 * <i>use_errors</i>.
 */
function libxml_use_internal_errors ($use_errors = false) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Retrieve last error from libxml
 * @link http://php.net/manual/en/function.libxml-get-last-error.php
 * @return LibXMLError a LibXMLError object if there is any error in the
 * buffer, false otherwise.
 */
function libxml_get_last_error () {}

/**
 * PHP > 5.4.0 <br/>
 * Changes the default external entity loader.
 * @link http://www.php.net/manual/en/function.libxml-set-external-entity-loader.php
 * @param callable $resolver_function A callable that takes three arguments. <br>
 * Two strings, a public id and system id, and a context (an array with four keys) <br>
 * as the third argument. This callback should return a resource, <br>
 * a string from which a resource can be opened, or <b>NULL</b>.
 */
function libxml_set_external_entity_loader ($resolver_function) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Clear libxml error buffer
 * @link http://php.net/manual/en/function.libxml-clear-errors.php
 * @return void 
 */
function libxml_clear_errors () {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Retrieve array of errors
 * @link http://php.net/manual/en/function.libxml-get-errors.php
 * @return array an array with LibXMLError objects if there are any
 * errors in the buffer, or an empty array otherwise.
 */
function libxml_get_errors () {}

/**
 * (PHP 5 &gt;= 5.2.11)<br/>
 * Disable the ability to load external entities
 * @link http://php.net/manual/en/function.libxml-disable-entity-loader.php
 * @param bool $disable [optional] <p>
 * Disable (true) or enable (false) libxml extensions (such as
 * , 
 * and ) to load external entities.
 * </p>
 * @return bool the previous value.
 */
function libxml_disable_entity_loader ($disable = true) {}


/**
 * libxml version like 20605 or 20617
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_VERSION', 20708);

/**
 * libxml version like 2.6.5 or 2.6.17
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_DOTTED_VERSION', "2.7.8");
define ('LIBXML_LOADED_VERSION', 20708);

/**
 * Substitute entities
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NOENT', 2);

/**
 * Load the external subset
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_DTDLOAD', 4);

/**
 * Default DTD attributes
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_DTDATTR', 8);

/**
 * Validate with the DTD
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_DTDVALID', 16);

/**
 * Suppress error reports
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NOERROR', 32);

/**
 * Suppress warning reports
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NOWARNING', 64);

/**
 * Remove blank nodes
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NOBLANKS', 256);

/**
 * Implement XInclude substitution
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_XINCLUDE', 1024);

/**
 * Remove redundant namespaces declarations
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NSCLEAN', 8192);

/**
 * Merge CDATA as text nodes
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NOCDATA', 16384);

/**
 * Disable network access when loading documents
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NONET', 2048);

/**
 * Activate small nodes allocation optimization. This may speed up your
 * application without needing to change the code.
 * <p>
 * Only available in Libxml &gt;= 2.6.21
 * </p>
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_COMPACT', 65536);

/**
 * Drop the XML declaration when saving a document
 * <p>
 * Only available in Libxml &gt;= 2.6.21
 * </p>
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NOXMLDECL', 2);

/**
 * Sets XML_PARSE_HUGE flag, which relaxes any hardcoded limit from the parser.
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_PARSEHUGE', 524288);

/**
 * Expand empty tags (e.g. &lt;br/&gt; to
 * &lt;br&gt;&lt;/br&gt;)
 * <p>
 * This option is currently just available in the
 * and
 * functions.
 * </p>
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_NOEMPTYTAG', 4);

/**
 * No errors
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_ERR_NONE', 0);

/**
 * A simple warning
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_ERR_WARNING', 1);

/**
 * A recoverable error
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_ERR_ERROR', 2);

/**
 * A fatal error
 * @link http://php.net/manual/en/libxml.constants.php
 */
define ('LIBXML_ERR_FATAL', 3);


/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('LIBXML_HTML_NODEFDTD', 0);

/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('LIBXML_HTML_NOIMPLIED', 0);


// End of libxml v.
?>
