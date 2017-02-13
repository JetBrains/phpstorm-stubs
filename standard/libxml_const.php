<?php
/**
 * PHPStorm stub file for libxml constants.
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */

/**
 * Allows line numbers greater than 65535 to be reported correctly.
 * <p>
 * Only available in Libxml &gt;= 2.9.0
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_BIGLINES = 65535;
/**
 * Activate small nodes allocation optimization. This may speed up your
 * application without needing to change the code.
 * <p>
 * Only available in Libxml &gt;= 2.6.21
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_COMPACT = 65536;
/**
 * libxml version like 2.6.5 or 2.6.17
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_DOTTED_VERSION = '2.9.1';
/**
 * Default DTD attributes
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_DTDATTR = 8;
/**
 * Load the external subset
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_DTDLOAD = 4;
/**
 * Validate with the DTD
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_DTDVALID = 16;
/**
 * A recoverable error
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_ERR_ERROR = 2;
/**
 * A fatal error
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_ERR_FATAL = 3;
/**
 * No errors
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_ERR_NONE = 0;
/**
 * A simple warning
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_ERR_WARNING = 1;
/**
 * Sets HTML_PARSE_NODEFDTD flag, which prevents a default doctype
 * being added when one is not found.
 * <p>
 * Only available in Libxml &gt;= 2.7.8 (as of PHP &gt;= 5.4.0)
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_HTML_NODEFDTD = 4;
/**
 * Sets HTML_PARSE_NOIMPLIED flag, which turns off the
 * automatic adding of implied html/body... elements.
 * <p>
 * Only available in Libxml &gt;= 2.7.7 (as of PHP &gt;= 5.4.0)
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_HTML_NOIMPLIED = 8192;
const LIBXML_LOADED_VERSION = 20901;
/**
 * Remove blank nodes
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NOBLANKS = 256;
/**
 * Merge CDATA as text nodes
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NOCDATA = 16384;
/**
 * Expand empty tags (e.g. &lt;br/&gt; to
 * &lt;br&gt;&lt;/br&gt;)
 * <p>
 * This option is currently just available in the
 * and
 * functions.
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NOEMPTYTAG = 4;
/**
 * Substitute entities
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NOENT = 2;
/**
 * Suppress error reports
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NOERROR = 32;
/**
 * Disable network access when loading documents
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NONET = 2048;
/**
 * Suppress warning reports
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NOWARNING = 64;
/**
 * Drop the XML declaration when saving a document
 * <p>
 * Only available in Libxml &gt;= 2.6.21
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NOXMLDECL = 2;
/**
 * Remove redundant namespaces declarations
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_NSCLEAN = 8192;
/**
 * Sets XML_PARSE_HUGE flag, which relaxes any hardcoded limit from the parser. This affects
 * limits like maximum depth of a document or the entity recursion, as well as limits of the
 * size of text nodes.
 * <p>
 * Only available in Libxml &gt;= 2.7.0 (as of PHP &gt;= 5.3.2 and PHP &gt;= 5.2.12)
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_PARSEHUGE = 524288;
/**
 * Sets XML_PARSE_PEDANTIC flag, which enables pedentic error reporting.
 *
 * @link  http://php.net/manual/en/libxml.constants.php
 * @since 5.4.0
 */
const LIBXML_PEDANTIC = 128;
/**
 * Create default/fixed value nodes during XSD schema validation
 * <p>
 * Only available in Libxml &gt;= 2.6.14 (as of PHP &gt;= 5.5.2)
 * </p>
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_SCHEMA_CREATE = 1;
/**
 * libxml version like 20605 or 20617
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_VERSION = 20901;
/**
 * Implement XInclude substitution
 *
 * @link http://php.net/manual/en/libxml.constants.php
 */
const LIBXML_XINCLUDE = 1024;
