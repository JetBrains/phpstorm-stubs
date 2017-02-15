<?php
/**
 * PHPStorm stub file for SimpleXML classes.
 *
 * @link http://php.net/manual/en/book.simplexml.php
 */

/**
 * Represents an element in an XML document.
 *
 * @link http://php.net/manual/en/class.simplexmlelement.php
 */
class SimpleXMLElement implements Traversable
{
    /**
     * Creates a new SimpleXMLElement object
     *
     * @link  http://php.net/manual/en/simplexmlelement.construct.php
     *
     * @param string $data        A well-formed XML string or the path or URL to an XML document if data_is_url is
     *                            TRUE.
     * @param int    $options     Optionally used to specify additional Libxml parameters.
     * @param bool   $data_is_url By default, data_is_url is FALSE.
     *                            Use TRUE to specify that data is a path or URL to an XML document instead of string
     *                            data.
     * @param string $ns          Namespace prefix or URI.
     * @param bool   $is_prefix   TRUE if ns is a prefix, FALSE if it's a URI; defaults to FALSE.
     *
     * @since 5.0.1
     */
    final public function __construct($data, $options = 0, $data_is_url = false, $ns = "", $is_prefix = false) { }

    /**
     * Provides access to element's children
     *
     * @param string $name child name
     *
     * @return SimpleXMLElement[]
     */
    public function __get($name) { }

    /**
     * (No version information available, might only be in SVN)<br/>
     * Returns the string content
     *
     * @link http://php.net/manual/en/simplexmlelement.tostring.php
     * @return string the string content on success or an empty string on failure.
     */
    public function __toString() { }

    /**
     * Adds an attribute to the SimpleXML element
     *
     * @link  http://php.net/manual/en/simplexmlelement.addattribute.php
     *
     * @param string $name      <p>
     *                          The name of the attribute to add.
     *                          </p>
     * @param string $value     [optional] <p>
     *                          The value of the attribute.
     *                          </p>
     * @param string $namespace [optional] <p>
     *                          If specified, the namespace to which the attribute belongs.
     *                          </p>
     *
     * @return void No value is returned.
     * @since 5.1.3
     */
    public function addAttribute($name, $value = null, $namespace = null) { }

    /**
     * Adds a child element to the XML node
     *
     * @link  http://php.net/manual/en/simplexmlelement.addchild.php
     *
     * @param string $name      <p>
     *                          The name of the child element to add.
     *                          </p>
     * @param string $value     [optional] <p>
     *                          If specified, the value of the child element.
     *                          </p>
     * @param string $namespace [optional] <p>
     *                          If specified, the namespace to which the child element belongs.
     *                          </p>
     *
     * @return SimpleXMLElement The addChild method returns a SimpleXMLElement
     * object representing the child added to the XML node.
     * @since 5.1.3
     */
    public function addChild($name, $value = null, $namespace = null) { }

    /**
     * Return a well-formed XML string based on SimpleXML element
     *
     * @link  http://php.net/manual/en/simplexmlelement.asxml.php
     *
     * @param string $filename [optional] <p>
     *                         If specified, the function writes the data to the file rather than
     *                         returning it.
     *                         </p>
     *
     * @return mixed If the <i>filename</i> isn't specified, this function
     * returns a string on success and <b>FALSE</b> on error. If the
     * parameter is specified, it returns <b>TRUE</b> if the file was written
     * successfully and <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function asXML($filename = null) { }

    /**
     * Identifies an element's attributes
     *
     * @link  http://php.net/manual/en/simplexmlelement.attributes.php
     *
     * @param string $ns        [optional] <p>
     *                          An optional namespace for the retrieved attributes
     *                          </p>
     * @param bool   $is_prefix [optional] <p>
     *                          Default to <b>FALSE</b>
     *                          </p>
     *
     * @return SimpleXMLElement a <b>SimpleXMLElement</b> object that can be
     * iterated over to loop through the attributes on the tag.
     * </p>
     * <p>
     * Returns <b>NULL</b> if called on a <b>SimpleXMLElement</b>
     * object that already represents an attribute and not a tag.
     * @since 5.0.1
     */
    public function attributes($ns = null, $is_prefix = false) { }

    /**
     * Finds children of given node
     *
     * @link  http://php.net/manual/en/simplexmlelement.children.php
     *
     * @param string $ns        [optional] <p>
     *                          An XML namespace.
     *                          </p>
     * @param bool   $is_prefix [optional] <p>
     *                          If <i>is_prefix</i> is <b>TRUE</b>,
     *                          <i>ns</i> will be regarded as a prefix. If <b>FALSE</b>,
     *                          <i>ns</i> will be regarded as a namespace
     *                          URL.
     *                          </p>
     *
     * @return SimpleXMLElement a <b>SimpleXMLElement</b> element, whether the node
     * has children or not.
     * @since 5.0.1
     */
    public function children($ns = null, $is_prefix = false) { }

    /**
     * Counts the children of an element
     *
     * @link  http://php.net/manual/en/simplexmlelement.count.php
     * @return int the number of elements of an element.
     * @since 5.3.0
     */
    public function count() { }

    /**
     * Returns namespaces declared in document
     *
     * @link  http://php.net/manual/en/simplexmlelement.getdocnamespaces.php
     *
     * @param bool $recursive [optional] <p>
     *                        If specified, returns all namespaces declared in parent and child nodes.
     *                        Otherwise, returns only namespaces declared in root node.
     *                        </p>
     * @param bool $from_root [optional] <p>
     *                        Allows you to recursively check namespaces under a child node instead of
     *                        from the root of the XML doc.
     *                        </p>
     *
     * @return array The getDocNamespaces method returns an array
     * of namespace names with their associated URIs.
     * @since 5.1.2
     */
    public function getDocNamespaces($recursive = false, $from_root = true) { }

    /**
     * Gets the name of the XML element
     *
     * @link  http://php.net/manual/en/simplexmlelement.getname.php
     * @return string The getName method returns as a string the
     * name of the XML tag referenced by the SimpleXMLElement object.
     * @since 5.1.3
     */
    public function getName() { }

    /**
     * Returns namespaces used in document
     *
     * @link  http://php.net/manual/en/simplexmlelement.getnamespaces.php
     *
     * @param bool $recursive [optional] <p>
     *                        If specified, returns all namespaces used in parent and child nodes.
     *                        Otherwise, returns only namespaces used in root node.
     *                        </p>
     *
     * @return array The getNamespaces method returns an array of
     * namespace names with their associated URIs.
     * @since 5.1.2
     */
    public function getNamespaces($recursive = false) { }

    /**
     * Creates a prefix/ns context for the next XPath query
     *
     * @link  http://php.net/manual/en/simplexmlelement.registerxpathnamespace.php
     *
     * @param string $prefix <p>
     *                       The namespace prefix to use in the XPath query for the namespace given in
     *                       <i>ns</i>.
     *                       </p>
     * @param string $ns     <p>
     *                       The namespace to use for the XPath query. This must match a namespace in
     *                       use by the XML document or the XPath query using
     *                       <i>prefix</i> will not return any results.
     *                       </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.2.0
     */
    public function registerXPathNamespace($prefix, $ns) { }

    /**
     * Alias of <b>SimpleXMLElement::asXML</b>
     * Return a well-formed XML string based on SimpleXML element
     *
     * @link  http://php.net/manual/en/simplexmlelement.savexml.php
     *
     * @param string $filename [optional] <p>
     *                         If specified, the function writes the data to the file rather than
     *                         returning it.
     *                         </p>
     *
     * @return mixed If the <i>filename</i> isn't specified, this function
     * returns a string on success and false on error. If the
     * parameter is specified, it returns true if the file was written
     * successfully and false otherwise.
     * @since 5.2.0
     */
    public function saveXML($filename = null) { }

    /**
     * Runs XPath query on XML data
     *
     * @link  http://php.net/manual/en/simplexmlelement.xpath.php
     *
     * @param string $path <p>
     *                     An XPath path
     *                     </p>
     *
     * @return SimpleXMLElement[] an array of SimpleXMLElement objects or <b>FALSE</b> in
     * case of an error.
     * @since 5.2.0
     */
    public function xpath($path) { }
}

/**
 * The SimpleXMLIterator provides recursive iteration over all nodes of a <b>SimpleXMLElement</b> object.
 *
 * @link http://php.net/manual/en/class.simplexmliterator.php
 */
class SimpleXMLIterator extends SimpleXMLElement implements RecursiveIterator, Iterator, Countable
{
    /**
     * (No version information available, might only be in SVN)<br/>
     * Returns the string content
     *
     * @link http://php.net/manual/en/simplexmlelement.tostring.php
     * @return string the string content on success or an empty string on failure.
     */
    public function __toString() { }

    /**
     * Counts the children of an element
     *
     * @link  http://php.net/manual/en/simplexmlelement.count.php
     * @return int the number of elements of an element.
     * @since 5.3.0
     */
    public function count() { }

    /**
     * Returns the current element
     *
     * @link  http://php.net/manual/en/simplexmliterator.current.php
     * @return mixed the current element as a <b>SimpleXMLIterator</b> object or <b>NULL</b> on failure.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * Returns the sub-elements of the current element
     *
     * @link  http://php.net/manual/en/simplexmliterator.getchildren.php
     * @return SimpleXMLIterator a <b>SimpleXMLIterator</b> object containing
     * the sub-elements of the current element.
     * @since 5.1.0
     */
    public function getChildren() { }

    /**
     * Checks whether the current element has sub elements.
     *
     * @link  http://php.net/manual/en/simplexmliterator.haschildren.php
     * @return bool <b>TRUE</b> if the current element has sub-elements, otherwise <b>FALSE</b>
     * @since 5.1.0
     */
    public function hasChildren() { }

    /**
     * Return current key
     *
     * @link  http://php.net/manual/en/simplexmliterator.key.php
     * @return mixed the XML tag name of the element referenced by the current <b>SimpleXMLIterator</b> object or
     *               <b>FALSE</b>
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Move to next element
     *
     * @link  http://php.net/manual/en/simplexmliterator.next.php
     * @return void No value is returned.
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Rewind to the first element
     *
     * @link  http://php.net/manual/en/simplexmliterator.rewind.php
     * @return void No value is returned.
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Check whether the current element is valid
     *
     * @link  http://php.net/manual/en/simplexmliterator.valid.php
     * @return bool <b>TRUE</b> if the current element is valid, otherwise <b>FALSE</b>
     * @since 5.1.0
     */
    public function valid() { }
}
