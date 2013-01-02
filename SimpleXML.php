<?php

// Start of SimpleXML v.0.1

/**
 * Represents an element in an XML document.
 * @link http://php.net/manual/en/class.simplexmlelement.php
 */
class SimpleXMLElement implements Traversable {

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Creates a new SimpleXMLElement object
	 * @link http://php.net/manual/en/simplexmlelement.construct.php
     * @param string $data A well-formed XML string or the path or URL to an XML document if data_is_url is TRUE.
     * @param int $options Optionally used to specify additional Libxml parameters.
     * @param bool $data_is_url By default, data_is_url is FALSE.
     * Use TRUE to specify that data is a path or URL to an XML document instead of string data.
     * @param string $ns Namespace prefix or URI.
     * @param bool $is_prefix TRUE if ns is a prefix, FALSE if it's a URI; defaults to FALSE.
	 */
	final public function __construct ($data, $options = 0, $data_is_url = false, $ns = "", $is_prefix = false) {}

	/**
     * Provides access to element's children
     * @param $name child name
     * @return SimpleXMLElement[]
     */
    function __get($name) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Return a well-formed XML string based on SimpleXML element
	 * @link http://php.net/manual/en/simplexmlelement.asxml.php
	 * @param string $filename [optional] <p>
	 * If specified, the function writes the data to the file rather than
	 * returning it.
	 * </p>
	 * @return mixed If the <i>filename</i> isn't specified, this function
	 * returns a string on success and false on error. If the
	 * parameter is specified, it returns true if the file was written
	 * successfully and false otherwise.
	 */
	public function asXML ($filename = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Alias of <b>SimpleXMLElement::asXML</b>
     * Return a well-formed XML string based on SimpleXML element
	 * @link http://php.net/manual/en/simplexmlelement.savexml.php
     * @param string $filename [optional] <p>
   	 * If specified, the function writes the data to the file rather than
   	 * returning it.
   	 * </p>
     * @return mixed If the <i>filename</i> isn't specified, this function
   	 * returns a string on success and false on error. If the
   	 * parameter is specified, it returns true if the file was written
   	 * successfully and false otherwise.
	 */
	public function saveXML ($filename = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Runs XPath query on XML data
	 * @link http://php.net/manual/en/simplexmlelement.xpath.php
	 * @param string $path <p>
	 * An XPath path
	 * </p>
	 * @return SimpleXMLElement[] an array of SimpleXMLElement objects or false in
	 * case of an error.
	 */
	public function xpath ($path) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Creates a prefix/ns context for the next XPath query
	 * @link http://php.net/manual/en/simplexmlelement.registerxpathnamespace.php
	 * @param string $prefix <p>
	 * The namespace prefix to use in the XPath query for the namespace given in
	 * <i>ns</i>.
	 * </p>
	 * @param string $ns <p>
	 * The namespace to use for the XPath query. This must match a namespace in
	 * use by the XML document or the XPath query using
	 * <i>prefix</i> will not return any results.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function registerXPathNamespace ($prefix, $ns) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Identifies an element's attributes
	 * @link http://php.net/manual/en/simplexmlelement.attributes.php
	 * @param string $ns [optional] <p>
	 * An optional namespace for the retrieved attributes
	 * </p>
	 * @param bool $is_prefix [optional] <p>
	 * Default to false
	 * </p>
	 * @return SimpleXMLElement a <b>SimpleXMLElement</b> object that can be
	 * iterated over to loop through the attributes on the tag.
	 * </p>
	 * <p>
	 * Returns null if called on a <b>SimpleXMLElement</b>
	 * object that already represents an attribute and not a tag.
	 */
	public function attributes ($ns = null, $is_prefix = false) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Finds children of given node
	 * @link http://php.net/manual/en/simplexmlelement.children.php
	 * @param string $ns [optional] <p>
	 * An XML namespace.
	 * </p>
	 * @param bool $is_prefix [optional] <p>
	 * If <i>is_prefix</i> is true,
	 * <i>ns</i> will be regarded as a prefix. If false,
	 * <i>ns</i> will be regarded as a namespace
	 * URL.
	 * </p>
	 * @return SimpleXMLElement a <b>SimpleXMLElement</b> element, whether the node
	 * has children or not.
	 */
	public function children ($ns = null, $is_prefix = false) {}

	/**
	 * (PHP 5 &gt;= 5.1.2)<br/>
	 * Returns namespaces used in document
	 * @link http://php.net/manual/en/simplexmlelement.getnamespaces.php
	 * @param bool $recursive [optional] <p>
	 * If specified, returns all namespaces used in parent and child nodes.
	 * Otherwise, returns only namespaces used in root node.
	 * </p>
	 * @return array The getNamespaces method returns an array of
	 * namespace names with their associated URIs.
	 */
	public function getNamespaces ($recursive = false) {}

	/**
	 * (PHP 5 &gt;= 5.1.2)<br/>
	 * Returns namespaces declared in document
	 * @link http://php.net/manual/en/simplexmlelement.getdocnamespaces.php
	 * @param bool $recursive [optional] <p>
	 * If specified, returns all namespaces declared in parent and child nodes.
	 * Otherwise, returns only namespaces declared in root node.
	 * </p>
	 * @return array The getDocNamespaces method returns an array
	 * of namespace names with their associated URIs.
	 */
	public function getDocNamespaces ($recursive = false) {}

	/**
	 * (PHP 5 &gt;= 5.1.3)<br/>
	 * Gets the name of the XML element
	 * @link http://php.net/manual/en/simplexmlelement.getname.php
	 * @return string The getName method returns as a string the
	 * name of the XML tag referenced by the SimpleXMLElement object.
	 */
	public function getName () {}

	/**
	 * (PHP 5 &gt;= 5.1.3)<br/>
	 * Adds a child element to the XML node
	 * @link http://php.net/manual/en/simplexmlelement.addchild.php
	 * @param string $name <p>
	 * The name of the child element to add.
	 * </p>
	 * @param string $value [optional] <p>
	 * If specified, the value of the child element.
	 * </p>
	 * @param string $namespace [optional] <p>
	 * If specified, the namespace to which the child element belongs.
	 * </p>
	 * @return SimpleXMLElement The addChild method returns a SimpleXMLElement
	 * object representing the child added to the XML node.
	 */
	public function addChild ($name, $value = null, $namespace = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.3)<br/>
	 * Adds an attribute to the SimpleXML element
	 * @link http://php.net/manual/en/simplexmlelement.addattribute.php
	 * @param string $name <p>
	 * The name of the attribute to add.
	 * </p>
	 * @param string $value <p>
	 * The value of the attribute.
	 * </p>
	 * @param string $namespace [optional] <p>
	 * If specified, the namespace to which the attribute belongs.
	 * </p>
	 * @return void
	 */
	public function addAttribute ($name, $value, $namespace = null) {}

	public function __toString () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Counts the children of an element
	 * @link http://php.net/manual/en/simplexmlelement.count.php
	 * @return int the number of elements of an element.
	 */
	public function count () {}

}

/**
 * The SimpleXMLIterator provides recursive iteration over all nodes of a <b>SimpleXMLElement</b> object.
 * @link http://php.net/manual/en/class.simplexmliterator.php
 */
class SimpleXMLIterator extends SimpleXMLElement implements Traversable, RecursiveIterator, Iterator, Countable {

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Rewind to the first element
	 * @link http://php.net/manual/en/simplexmliterator.rewind.php
	 * @return void
	 */
	public function rewind () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Check whether the current element is valid
	 * @link http://php.net/manual/en/simplexmliterator.valid.php
	 * @return bool true if the current element is valid, otherwise false
	 */
	public function valid () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Returns the current element
	 * @link http://php.net/manual/en/simplexmliterator.current.php
	 * @return mixed the current element as a <b>SimpleXMLIterator</b> object or null on failure.
	 */
	public function current () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Return current key
	 * @link http://php.net/manual/en/simplexmliterator.key.php
	 * @return mixed the XML tag name of the element referenced by the current <b>SimpleXMLIterator</b> object or false
	 */
	public function key () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Move to next element
	 * @link http://php.net/manual/en/simplexmliterator.next.php
	 * @return void
	 */
	public function next () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Checks whether the current element has sub elements.
	 * @link http://php.net/manual/en/simplexmliterator.haschildren.php
	 * @return bool true if the current element has sub-elements, otherwise false
	 */
	public function hasChildren () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Returns the sub-elements of the current element
	 * @link http://php.net/manual/en/simplexmliterator.getchildren.php
	 * @return object a <b>SimpleXMLIterator</b> object containing
	 * the sub-elements of the current element.
	 */
	public function getChildren () {}

	public function __toString () {}

}

/**
 * (PHP 5)<br/>
 * Interprets an XML file into an object
 * @link http://php.net/manual/en/function.simplexml-load-file.php
 * @param string $filename <p>
 * Path to the XML file
 * </p>
 * <p>
 * Libxml 2 unescapes the URI, so if you want to pass e.g.
 * b&amp;c as the URI parameter a,
 * you have to call
 * simplexml_load_file(rawurlencode('http://example.com/?a=' .
 * urlencode('b&amp;c'))). Since PHP 5.1.0 you don't need to do
 * this because PHP will do it for you.
 * </p>
 * @param string $class_name [optional] <p>
 * You may use this optional parameter so that
 * <b>simplexml_load_file</b> will return an object of
 * the specified class. That class should extend the
 * SimpleXMLElement class.
 * </p>
 * @param int $options [optional] <p>
 * Since PHP 5.1.0 and Libxml 2.6.0, you may also use the
 * <i>options</i> parameter to specify additional Libxml parameters.
 * </p>
 * @param string $ns [optional]
 * @param bool $is_prefix [optional]
 * @return SimpleXMLElement an object of class SimpleXMLElement with
 * properties containing the data held within the XML document. On errors, it
 * will return false.
 */
function simplexml_load_file ($filename, $class_name = "SimpleXMLElement", $options = 0, $ns = null, $is_prefix = false) {}

/**
 * (PHP 5)<br/>
 * Interprets a string of XML into an object
 * @link http://php.net/manual/en/function.simplexml-load-string.php
 * @param string $data <p>
 * A well-formed XML string
 * </p>
 * @param string $class_name [optional] <p>
 * You may use this optional parameter so that
 * <b>simplexml_load_string</b> will return an object of
 * the specified class. That class should extend the
 * SimpleXMLElement class.
 * </p>
 * @param int $options [optional] <p>
 * Since PHP 5.1.0 and Libxml 2.6.0, you may also use the
 * <i>options</i> parameter to specify additional Libxml parameters.
 * </p>
 * @param string $ns [optional]
 * @param bool $is_prefix [optional]
 * @return object an object of class SimpleXMLElement with
 * properties containing the data held within the xml document. On errors, it
 * will return false.
 */
function simplexml_load_string ($data, $class_name = "SimpleXMLElement", $options = 0, $ns = null, $is_prefix = false) {}

/**
 * (PHP 5)<br/>
 * Get a SimpleXMLElement object from a DOM node.
 * @link http://php.net/manual/en/function.simplexml-import-dom.php
 * @param DOMNode $node <p>
 * A DOM Element node
 * </p>
 * @param string $class_name [optional] <p>
 * You may use this optional parameter so that
 * <b>simplexml_import_dom</b> will return an object of
 * the specified class. That class should extend the
 * SimpleXMLElement class.
 * </p>
 * @return SimpleXMLElement a SimpleXMLElement or false on failure.
 */
function simplexml_import_dom (DOMNode $node, $class_name = "SimpleXMLElement") {}

// End of SimpleXML v.0.1
?>