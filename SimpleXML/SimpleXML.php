<?php

// Start of SimpleXML v.0.1

/**
 * Represents an element in an XML document.
 * @link https://php.net/manual/en/class.simplexmlelement.php
 */
class SimpleXMLElement implements Traversable, ArrayAccess, Countable {

	/**
	 * Creates a new SimpleXMLElement object
	 * @link https://php.net/manual/en/simplexmlelement.construct.php
     * @param string $data A well-formed XML string or the path or URL to an XML document if data_is_url is TRUE.
     * @param int $options Optionally used to specify additional Libxml parameters.
     * @param bool $data_is_url By default, data_is_url is FALSE.
     * Use TRUE to specify that data is a path or URL to an XML document instead of string data.
     * @param string $ns Namespace prefix or URI.
     * @param bool $is_prefix TRUE if ns is a prefix, FALSE if it's a URI; defaults to FALSE.
	 * @since 5.0.1
	 */
	final public function __construct ($data, $options = 0, $data_is_url = false, $ns = "", $is_prefix = false) {}

	/**
     * Provides access to element's children
     * @access private Method not callable directly, stub exists for typehint only
     * @param string $name child name
     * @return SimpleXMLElement
     */
    private function __get($name) {}

	/**
	 * Return a well-formed XML string based on SimpleXML element
	 * @link https://php.net/manual/en/simplexmlelement.asxml.php
	 * @param string $filename [optional] <p>
	 * If specified, the function writes the data to the file rather than
	 * returning it.
	 * </p>
	 * @return mixed If the <i>filename</i> isn't specified, this function
	 * returns a string on success and <b>FALSE</b> on error. If the
	 * parameter is specified, it returns <b>TRUE</b> if the file was written
	 * successfully and <b>FALSE</b> otherwise.
	 * @since 5.0.1
	 */
	public function asXML ($filename = null) {}

	/**
	 * Alias of <b>SimpleXMLElement::asXML</b>
     * Return a well-formed XML string based on SimpleXML element
	 * @link https://php.net/manual/en/simplexmlelement.savexml.php
     * @param string $filename [optional] <p>
   	 * If specified, the function writes the data to the file rather than
   	 * returning it.
   	 * </p>
     * @return mixed If the <i>filename</i> isn't specified, this function
   	 * returns a string on success and false on error. If the
   	 * parameter is specified, it returns true if the file was written
   	 * successfully and false otherwise.
	 * @since 5.2.0
	 */
	public function saveXML ($filename = null) {}

	/**
	 * Runs XPath query on XML data
	 * @link https://php.net/manual/en/simplexmlelement.xpath.php
	 * @param string $path <p>
	 * An XPath path
	 * </p>
	 * @return SimpleXMLElement[] an array of SimpleXMLElement objects or <b>FALSE</b> in
	 * case of an error.
	 * @since 5.2.0
	 */
	public function xpath ($path) {}

	/**
	 * Creates a prefix/ns context for the next XPath query
	 * @link https://php.net/manual/en/simplexmlelement.registerxpathnamespace.php
	 * @param string $prefix <p>
	 * The namespace prefix to use in the XPath query for the namespace given in
	 * <i>ns</i>.
	 * </p>
	 * @param string $ns <p>
	 * The namespace to use for the XPath query. This must match a namespace in
	 * use by the XML document or the XPath query using
	 * <i>prefix</i> will not return any results.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.2.0
	 */
	public function registerXPathNamespace ($prefix, $ns) {}

	/**
	 * Identifies an element's attributes
	 * @link https://php.net/manual/en/simplexmlelement.attributes.php
	 * @param string $ns [optional] <p>
	 * An optional namespace for the retrieved attributes
	 * </p>
	 * @param bool $is_prefix [optional] <p>
	 * Default to <b>FALSE</b>
	 * </p>
	 * @return SimpleXMLElement a <b>SimpleXMLElement</b> object that can be
	 * iterated over to loop through the attributes on the tag.
	 * </p>
	 * <p>
	 * Returns <b>NULL</b> if called on a <b>SimpleXMLElement</b>
	 * object that already represents an attribute and not a tag.
	 * @since 5.0.1
	 */
	public function attributes ($ns = null, $is_prefix = false) {}

	/**
	 * Finds children of given node
	 * @link https://php.net/manual/en/simplexmlelement.children.php
	 * @param string $ns [optional] <p>
	 * An XML namespace.
	 * </p>
	 * @param bool $is_prefix [optional] <p>
	 * If <i>is_prefix</i> is <b>TRUE</b>,
	 * <i>ns</i> will be regarded as a prefix. If <b>FALSE</b>,
	 * <i>ns</i> will be regarded as a namespace
	 * URL.
	 * </p>
	 * @return SimpleXMLElement a <b>SimpleXMLElement</b> element, whether the node
	 * has children or not.
	 * @since 5.0.1
	 */
	public function children ($ns = null, $is_prefix = false) {}

	/**
	 * Returns namespaces used in document
	 * @link https://php.net/manual/en/simplexmlelement.getnamespaces.php
	 * @param bool $recursive [optional] <p>
	 * If specified, returns all namespaces used in parent and child nodes.
	 * Otherwise, returns only namespaces used in root node.
	 * </p>
	 * @return array The getNamespaces method returns an array of
	 * namespace names with their associated URIs.
	 * @since 5.1.2
	 */
	public function getNamespaces ($recursive = false) {}

	/**
	 * Returns namespaces declared in document
	 * @link https://php.net/manual/en/simplexmlelement.getdocnamespaces.php
	 * @param bool $recursive [optional] <p>
	 * If specified, returns all namespaces declared in parent and child nodes.
	 * Otherwise, returns only namespaces declared in root node.
	 * </p>
	 * @param bool $from_root [optional] <p>
	 * Allows you to recursively check namespaces under a child node instead of
	 * from the root of the XML doc.
	 * </p>
	 * @return array The getDocNamespaces method returns an array
	 * of namespace names with their associated URIs.
	 * @since 5.1.2
	 */
	public function getDocNamespaces ($recursive = false, $from_root = true) {}

	/**
	 * Gets the name of the XML element
	 * @link https://php.net/manual/en/simplexmlelement.getname.php
	 * @return string The getName method returns as a string the
	 * name of the XML tag referenced by the SimpleXMLElement object.
	 * @since 5.1.3
	 */
	public function getName () {}

	/**
	 * Adds a child element to the XML node
	 * @link https://php.net/manual/en/simplexmlelement.addchild.php
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
	 * @since 5.1.3
	 */
	public function addChild ($name, $value = null, $namespace = null) {}

	/**
	 * Adds an attribute to the SimpleXML element
	 * @link https://php.net/manual/en/simplexmlelement.addattribute.php
	 * @param string $name <p>
	 * The name of the attribute to add.
	 * </p>
	 * @param string $value [optional] <p>
	 * The value of the attribute.
	 * </p>
	 * @param string $namespace [optional] <p>
	 * If specified, the namespace to which the attribute belongs.
	 * </p>
	 * @return void No value is returned.
	 * @since 5.1.3
	 */
	public function addAttribute ($name, $value = null, $namespace = null) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Returns the string content
	 * @link https://php.net/manual/en/simplexmlelement.tostring.php
	 * @return string the string content on success or an empty string on failure.
	 */
	public function __toString () {}

	/**
	 * Counts the children of an element
	 * @link https://php.net/manual/en/simplexmlelement.count.php
	 * @return int the number of elements of an element.
	 * @since 5.3.0
	 */
	public function count () {}

    /**
     * Class provides access to children by position, and attributes by name
     * @access private Method not callable directly, stub exists for typehint only
     * @param string|int $offset
     * @return boolean true on success or false on failure.
     */
    private function offsetExists ($offset) {}

    /**
     * Class provides access to children by position, and attributes by name
     * @access private Method not callable directly, stub exists for typehint only
     * @param string|int $offset
     * @return SimpleXMLElement Either a named attribute or an element from a list of children
     */
    private function offsetGet ($offset) {}

    /**
     * Class provides access to children by position, and attributes by name
     * @access private Method not callable directly, stub exists for typehint only
     * @param string|int $offset
     * @param mixed $value
     * @return void
     */
    private function offsetSet ($offset, $value) {}

    /**
     * Class provides access to children by position, and attributes by name
     * @access private Method not callable directly, stub exists for typehint only
     * @param string|int $offset
     * @return void
     */
    private function offsetUnset ($offset) {}
}

/**
 * The SimpleXMLIterator provides recursive iteration over all nodes of a <b>SimpleXMLElement</b> object.
 * @link https://php.net/manual/en/class.simplexmliterator.php
 */
class SimpleXMLIterator extends SimpleXMLElement implements RecursiveIterator, Countable {

	/**
	 * Rewind to the first element
	 * @link https://php.net/manual/en/simplexmliterator.rewind.php
	 * @return void No value is returned.
	 * @since 5.1.0
	 */
	public function rewind () {}

	/**
	 * Check whether the current element is valid
	 * @link https://php.net/manual/en/simplexmliterator.valid.php
	 * @return bool <b>TRUE</b> if the current element is valid, otherwise <b>FALSE</b>
	 * @since 5.1.0
	 */
	public function valid () {}

	/**
	 * Returns the current element
	 * @link https://php.net/manual/en/simplexmliterator.current.php
	 * @return mixed the current element as a <b>SimpleXMLIterator</b> object or <b>NULL</b> on failure.
	 * @since 5.1.0
	 */
	public function current () {}

	/**
	 * Return current key
	 * @link https://php.net/manual/en/simplexmliterator.key.php
	 * @return mixed the XML tag name of the element referenced by the current <b>SimpleXMLIterator</b> object or <b>FALSE</b>
	 * @since 5.1.0
	 */
	public function key () {}

	/**
	 * Move to next element
	 * @link https://php.net/manual/en/simplexmliterator.next.php
	 * @return void No value is returned.
	 * @since 5.1.0
	 */
	public function next () {}

	/**
	 * Checks whether the current element has sub elements.
	 * @link https://php.net/manual/en/simplexmliterator.haschildren.php
	 * @return bool <b>TRUE</b> if the current element has sub-elements, otherwise <b>FALSE</b>
	 * @since 5.1.0
	 */
	public function hasChildren () {}

	/**
	 * Returns the sub-elements of the current element
	 * @link https://php.net/manual/en/simplexmliterator.getchildren.php
	 * @return SimpleXMLIterator a <b>SimpleXMLIterator</b> object containing
	 * the sub-elements of the current element.
	 * @since 5.1.0
	 */
	public function getChildren () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Returns the string content
	 * @link https://php.net/manual/en/simplexmlelement.tostring.php
	 * @return string the string content on success or an empty string on failure.
	 */
	public function __toString () {}

	/**
	 * Counts the children of an element
	 * @link https://php.net/manual/en/simplexmlelement.count.php
	 * @return int the number of elements of an element.
	 * @since 5.3.0
	 */
	public function count () {}

}

/**
 * Interprets an XML file into an object
 * @link https://php.net/manual/en/function.simplexml-load-file.php
 * @param string $filename <p>
 * Path to the XML file
 * </p>
 * <p>
 * Libxml 2 unescapes the URI, so if you want to pass e.g.
 * b&#38;#38;c as the URI parameter a,
 * you have to call
 * simplexml_load_file(rawurlencode('https://example.com/?a=' .
 * urlencode('b&#38;#38;c'))). Since PHP 5.1.0 you don't need to do
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
 * @param string $ns [optional] <p>
 * Namespace prefix or URI.
 * </p>
 * @param bool $is_prefix [optional] <p>
 * <b>TRUE</b> if <i>ns</i> is a prefix, <b>FALSE</b> if it's a URI;
 * defaults to <b>FALSE</b>.
 * </p>
 * @return SimpleXMLElement an object of class SimpleXMLElement with
 * properties containing the data held within the XML document, or <b>FALSE</b> on failure.
 * @since 5.0
 */
function simplexml_load_file ($filename, $class_name = "SimpleXMLElement", $options = 0, $ns = "", $is_prefix = false) {}

/**
 * Interprets a string of XML into an object
 * @link https://php.net/manual/en/function.simplexml-load-string.php
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
 * @param string $ns [optional] <p>
 * Namespace prefix or URI.
 * </p>
 * @param bool $is_prefix [optional] <p>
 * <b>TRUE</b> if <i>ns</i> is a prefix, <b>FALSE</b> if it's a URI;
 * defaults to <b>FALSE</b>.
 * </p>
 * @return SimpleXMLElement an object of class SimpleXMLElement with
 * properties containing the data held within the xml document, or <b>FALSE</b> on failure.
 * @since 5.0
 */
function simplexml_load_string ($data, $class_name = "SimpleXMLElement", $options = 0, $ns = "", $is_prefix = false) {}

/**
 * Get a SimpleXMLElement object from a DOM node.
 * @link https://php.net/manual/en/function.simplexml-import-dom.php
 * @param DOMNode $node <p>
 * A DOM Element node
 * </p>
 * @param string $class_name [optional] <p>
 * You may use this optional parameter so that
 * <b>simplexml_import_dom</b> will return an object of
 * the specified class. That class should extend the
 * SimpleXMLElement class.
 * </p>
 * @return SimpleXMLElement a SimpleXMLElement or <b>FALSE</b> on failure.
 * @since 5.0
 */
function simplexml_import_dom (DOMNode $node, $class_name = "SimpleXMLElement") {}

// End of SimpleXML v.0.1
