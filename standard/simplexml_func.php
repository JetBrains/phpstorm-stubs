<?php
/**
 * PHPStorm stub file for SimpleXML functions.
 *
 * @link http://php.net/manual/en/book.simplexml.php
 */

/**
 * Get a SimpleXMLElement object from a DOM node.
 *
 * @link  http://php.net/manual/en/function.simplexml-import-dom.php
 *
 * @param DOMNode $node       <p>
 *                            A DOM Element node
 *                            </p>
 * @param string  $class_name [optional] <p>
 *                            You may use this optional parameter so that
 *                            <b>simplexml_import_dom</b> will return an object of
 *                            the specified class. That class should extend the
 *                            SimpleXMLElement class.
 *                            </p>
 *
 * @return SimpleXMLElement a SimpleXMLElement or <b>FALSE</b> on failure.
 * @since 5.0
 */
function simplexml_import_dom(DOMNode $node, $class_name = 'SimpleXMLElement') { }

/**
 * Interprets an XML file into an object
 *
 * @link  http://php.net/manual/en/function.simplexml-load-file.php
 *
 * @param string $filename   <p>
 *                           Path to the XML file
 *                           </p>
 *                           <p>
 *                           Libxml 2 unescapes the URI, so if you want to pass e.g.
 *                           b&#38;#38;c as the URI parameter a,
 *                           you have to call
 *                           simplexml_load_file(rawurlencode('http://example.com/?a=' .
 *                           urlencode('b&#38;#38;c'))). Since PHP 5.1.0 you don't need to do
 *                           this because PHP will do it for you.
 *                           </p>
 * @param string $class_name [optional] <p>
 *                           You may use this optional parameter so that
 *                           <b>simplexml_load_file</b> will return an object of
 *                           the specified class. That class should extend the
 *                           SimpleXMLElement class.
 *                           </p>
 * @param int    $options    [optional] <p>
 *                           Since PHP 5.1.0 and Libxml 2.6.0, you may also use the
 *                           <i>options</i> parameter to specify additional Libxml parameters.
 *                           </p>
 * @param string $ns         [optional] <p>
 *                           Namespace prefix or URI.
 *                           </p>
 * @param bool   $is_prefix  [optional] <p>
 *                           <b>TRUE</b> if <i>ns</i> is a prefix, <b>FALSE</b> if it's a URI;
 *                           defaults to <b>FALSE</b>.
 *                           </p>
 *
 * @return SimpleXMLElement an object of class SimpleXMLElement with
 * properties containing the data held within the XML document, or <b>FALSE</b> on failure.
 * @since 5.0
 */
function simplexml_load_file(
    $filename,
    $class_name = 'SimpleXMLElement',
    $options = 0,
    $ns = "",
    $is_prefix = false
) {
}

/**
 * Interprets a string of XML into an object
 *
 * @link  http://php.net/manual/en/function.simplexml-load-string.php
 *
 * @param string $data       <p>
 *                           A well-formed XML string
 *                           </p>
 * @param string $class_name [optional] <p>
 *                           You may use this optional parameter so that
 *                           <b>simplexml_load_string</b> will return an object of
 *                           the specified class. That class should extend the
 *                           SimpleXMLElement class.
 *                           </p>
 * @param int    $options    [optional] <p>
 *                           Since PHP 5.1.0 and Libxml 2.6.0, you may also use the
 *                           <i>options</i> parameter to specify additional Libxml parameters.
 *                           </p>
 * @param string $ns         [optional] <p>
 *                           Namespace prefix or URI.
 *                           </p>
 * @param bool   $is_prefix  [optional] <p>
 *                           <b>TRUE</b> if <i>ns</i> is a prefix, <b>FALSE</b> if it's a URI;
 *                           defaults to <b>FALSE</b>.
 *                           </p>
 *
 * @return SimpleXMLElement an object of class SimpleXMLElement with
 * properties containing the data held within the xml document, or <b>FALSE</b> on failure.
 * @since 5.0
 */
function simplexml_load_string($data, $class_name = 'SimpleXMLElement', $options = 0, $ns = '', $is_prefix = false) { }
