<?php

// Start of xsl v.0.1

/**
 * Description of the class.
 * @link http://php.net/manual/en/class.xsltprocessor.php
 */
class XSLTProcessor  {

	/**
	 * (PHP 5)<br/>
	 * Import stylesheet
	 * @link http://php.net/manual/en/xsltprocessor.importstylesheet.php
	 * @param object $stylesheet <p>
	 * The imported style sheet as a <b>DOMDocument</b> or
	 * <b>SimpleXMLElement</b> object.
	 * </p>
	 * @return void 
	 */
	public function importStylesheet ($stylesheet) {}

	/**
	 * (PHP 5)<br/>
	 * Transform to a DOMDocument
	 * @link http://php.net/manual/en/xsltprocessor.transformtodoc.php
	 * @param DOMNode $doc <p>
	 * The node to be transformed.
	 * </p>
	 * @return DOMDocument The resulting <b>DOMDocument</b> or false on error.
	 */
	public function transformToDoc (DOMNode $doc) {}

	/**
	 * (PHP 5)<br/>
	 * Transform to URI
	 * @link http://php.net/manual/en/xsltprocessor.transformtouri.php
	 * @param DOMDocument $doc <p>
	 * The document to transform.
	 * </p>
	 * @param string $uri <p>
	 * The target URI for the transformation.
	 * </p>
	 * @return int the number of bytes written or false if an error occurred.
	 */
	public function transformToUri (DOMDocument $doc , $uri) {}

	/**
	 * (PHP 5)<br/>
	 * Transform to XML
	 * @link http://php.net/manual/en/xsltprocessor.transformtoxml.php
	 * @param DOMDocument $doc <p>
	 * The transformed document.
	 * </p>
	 * @return string The result of the transformation as a string or false on error.
	 */
	public function transformToXml (DOMDocument $doc ) {}

	/**
	 * (PHP 5)<br/>
	 * Set value for a parameter
	 * @link http://php.net/manual/en/xsltprocessor.setparameter.php
	 * @param string $namespace <p>
	 * The namespace URI of the XSLT parameter.
	 * </p>
	 * @param array $options <p>
	 * An array of name =&gt; value pairs. This syntax is
	 * available since PHP 5.1.0.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function setParameter ($namespace, array $options ) {}

	/**
	 * (PHP 5)<br/>
	 * Get value of a parameter
	 * @link http://php.net/manual/en/xsltprocessor.getparameter.php
	 * @param string $namespaceURI <p>
	 * The namespace URI of the XSLT parameter.
	 * </p>
	 * @param string $localName <p>
	 * The local name of the XSLT parameter.
	 * </p>
	 * @return string The value of the parameter or null if it's not set.
	 */
	public function getParameter ($namespaceURI, $localName) {}


    /**
     * @since 5.4
     * @param int $securityPrefs
     * @link http://php.net/manual/en/xsltprocessor.setsecurityprefs.php
     */
    public function setSecurityPrefs ($securityPrefs) {}

    /**
     * @since 5.4
     * @return int
     * @link http://php.net/manual/en/xsltprocessor.getsecurityprefs.php
     */
    public function getSecurityPrefs () {}

	/**
	 * (PHP 5)<br/>
	 * Remove parameter
	 * @link http://php.net/manual/en/xsltprocessor.removeparameter.php
	 * @param string $namespaceURI <p>
	 * The namespace URI of the XSLT parameter.
	 * </p>
	 * @param string $localName <p>
	 * The local name of the XSLT parameter.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function removeParameter ($namespaceURI, $localName) {}
	
        /**
         * (PHP 5 &gt;= 5.0.4)<br/>
         * Determine if PHP has EXSLT support
         * @link http://php.net/manual/en/xsltprocessor.hasexsltsupport.php
	 * @return bool true on success or false on failure.
         */
        public function hasExsltSupport () {}

	/**
	 * (PHP 5 &gt;= 5.0.4)<br/>
	 * Enables the ability to use PHP functions as XSLT functions
	 * @link http://php.net/manual/en/xsltprocessor.registerphpfunctions.php
	 * @param mixed $restrict [optional] <p>
	 * Use this parameter to only allow certain functions to be called from 
	 * XSLT.
	 * </p>
	 * <p>
	 * This parameter can be either a string (a function name) or an array of
	 * functions.
	 * </p>
	 * @return void 
	 */
	public function registerPHPFunctions ($restrict = null) {}

	/**
	 * (PHP &gt;= 5.3.0)<br/>
	 * Sets profiling output file
	 * @link http://php.net/manual/en/xsltprocessor.setprofiling.php
	 * @param string $filename <p>
	 * Path to the file to dump profiling information.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function setProfiling ($filename) {}

}
define ('XSL_CLONE_AUTO', 0);
define ('XSL_CLONE_NEVER', -1);
define ('XSL_CLONE_ALWAYS', 1);

/**
 * libxslt version like 10117. Available as of PHP 5.1.2.
 * @link http://php.net/manual/en/xsl.constants.php
 */
define ('LIBXSLT_VERSION', 10126);

/**
 * libxslt version like 1.1.17. Available as of PHP 5.1.2.
 * @link http://php.net/manual/en/xsl.constants.php
 */
define ('LIBXSLT_DOTTED_VERSION', "1.1.26");

/**
 * libexslt version like 813. Available as of PHP 5.1.2.
 * @link http://php.net/manual/en/xsl.constants.php
 */
define ('LIBEXSLT_VERSION', 815);

/**
 * libexslt version like 1.1.17. Available as of PHP 5.1.2.
 * @link http://php.net/manual/en/xsl.constants.php
 */
define ('LIBEXSLT_DOTTED_VERSION', "1.1.26");

// End of xsl v.0.1


/** @link http://php.net/manual/en/xsl.constants.php */
define('XSL_SECPREF_NONE', 0);
/** @link http://php.net/manual/en/xsl.constants.php */
define('XSL_SECPREF_READ_FILE', 2);
/** @link http://php.net/manual/en/xsl.constants.php */
define('XSL_SECPREF_WRITE_FILE', 4);
/** @link http://php.net/manual/en/xsl.constants.php */
define('XSL_SECPREF_CREATE_DIRECTORY', 8);
/** @link http://php.net/manual/en/xsl.constants.php */
define('XSL_SECPREF_READ_NETWORK', 16);
/** @link http://php.net/manual/en/xsl.constants.php */
define('XSL_SECPREF_WRITE_NETWORK', 32);
/** @link http://php.net/manual/en/xsl.constants.php */
define('XSL_SECPREF_DEFAULT', 44);

?>
