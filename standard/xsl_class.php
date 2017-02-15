<?php
/**
 * PHPStorm stub file for XSL classes.
 *
 * @link http://php.net/manual/en/book.xsl.php
 */

/**
 * @link http://php.net/manual/en/class.xsltprocessor.php
 */
class XSLTProcessor
{
    /**
     * Get value of a parameter
     *
     * @link  http://php.net/manual/en/xsltprocessor.getparameter.php
     *
     * @param string $namespaceURI <p>
     *                             The namespace URI of the XSLT parameter.
     *                             </p>
     * @param string $localName    <p>
     *                             The local name of the XSLT parameter.
     *                             </p>
     *
     * @return string The value of the parameter (as a string), or <b>FALSE</b> if it's not set.
     * @since 5.0
     */
    public function getParameter($namespaceURI, $localName) { }

    /**
     * Get security preferences
     *
     * @link  http://php.net/manual/en/xsltprocessor.getsecurityprefs.php
     * @return int
     * @since 5.4.0
     */
    public function getSecurityPrefs() { }

    /**
     * Determine if PHP has EXSLT support
     *
     * @link  http://php.net/manual/en/xsltprocessor.hasexsltsupport.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.0.4
     */
    public function hasExsltSupport() { }

    /**
     * Import stylesheet
     *
     * @link  http://php.net/manual/en/xsltprocessor.importstylesheet.php
     *
     * @param DOMDocument|SimpleXMLElement $stylesheet <p>
     *                                                 The imported style sheet as a <b>DOMDocument</b> or
     *                                                 <b>SimpleXMLElement</b> object.
     *                                                 </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.0
     */
    public function importStylesheet($stylesheet) { }

    /**
     * Enables the ability to use PHP functions as XSLT functions
     *
     * @link  http://php.net/manual/en/xsltprocessor.registerphpfunctions.php
     *
     * @param mixed $restrict [optional] <p>
     *                        Use this parameter to only allow certain functions to be called from
     *                        XSLT.
     *                        </p>
     *                        <p>
     *                        This parameter can be either a string (a function name) or an array of
     *                        functions.
     *                        </p>
     *
     * @return void No value is returned.
     * @since 5.0.4
     */
    public function registerPHPFunctions($restrict = null) { }

    /**
     * Remove parameter
     *
     * @link  http://php.net/manual/en/xsltprocessor.removeparameter.php
     *
     * @param string $namespaceURI <p>
     *                             The namespace URI of the XSLT parameter.
     *                             </p>
     * @param string $localName    <p>
     *                             The local name of the XSLT parameter.
     *                             </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.0
     */
    public function removeParameter($namespaceURI, $localName) { }

    /**
     * Set value for a parameter
     *
     * @link  http://php.net/manual/en/xsltprocessor.setparameter.php
     *
     * @param string $namespace <p>
     *                          The namespace URI of the XSLT parameter.
     *                          </p>
     * @param string $name      <p>
     *                          The local name of the XSLT parameter.
     *                          </p>
     * @param string $value     <p>
     *                          The new value of the XSLT parameter.
     *                          </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.0
     */
    public function setParameter($namespace, $name, $value) { }

    /**
     * Sets profiling output file
     *
     * @link  http://php.net/manual/en/xsltprocessor.setprofiling.php
     *
     * @param string $filename <p>
     *                         Path to the file to dump profiling information.
     *                         </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.3.0
     */
    public function setProfiling($filename) { }

    /**
     * Set security preferences
     *
     * @link  http://php.net/manual/en/xsltprocessor.setsecurityprefs.php
     *
     * @param int $securityPrefs
     *
     * @return int
     * @since 5.4.0
     */
    public function setSecurityPrefs($securityPrefs) { }

    /**
     * Transform to a DOMDocument
     *
     * @link  http://php.net/manual/en/xsltprocessor.transformtodoc.php
     *
     * @param DOMNode $doc <p>
     *                     The node to be transformed.
     *                     </p>
     *
     * @return DOMDocument The resulting <b>DOMDocument</b> or <b>FALSE</b> on error.
     * @since 5.0
     */
    public function transformToDoc(DOMNode $doc) { }

    /**
     * Transform to URI
     *
     * @link  http://php.net/manual/en/xsltprocessor.transformtouri.php
     *
     * @param DOMDocument|SimpleXMLElement $doc <p>
     *                                          The document to transform.
     *                                          </p>
     * @param string                       $uri <p>
     *                                          The target URI for the transformation.
     *                                          </p>
     *
     * @return int the number of bytes written or <b>FALSE</b> if an error occurred.
     * @since 5.0
     */
    public function transformToUri($doc, $uri) { }

    /**
     * Transform to XML
     *
     * @link  http://php.net/manual/en/xsltprocessor.transformtoxml.php
     *
     * @param DOMDocument|SimpleXMLElement $doc <p>
     *                                          The transformed document.
     *                                          </p>
     *
     * @return string The result of the transformation as a string or <b>FALSE</b> on error.
     * @since 5.0
     */
    public function transformToXml($doc) { }
}
