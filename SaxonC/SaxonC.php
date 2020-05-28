<?php
namespace Saxon;

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class SaxonProcessor {

    /**
     * Constructor
     *
     * @param bool $license Indicates whether the Processor requires features of Saxon that need a license file. If false, the method will creates a Configuration appropriate for Saxon HE (Home edition). If true, the method will create a Configuration appropriate to the version of the software that is running Saxon-PE or Saxon-EE.
     * @param string $cwd The cwd argument is used to manually set the current working directory used for executions of source files
     */
    public function __construct($license = false, $cwd = '') {}

    /**
     * Create an Xdm Atomic value from any of the main primitive types (i.e. bool, int, float, double, string)
     *
     * @param bool|int|float|string $primitive_type_val
     * @return XdmValue
     */
    public function createAtomicValue($primitive_type_val) {}

    /**
     * Create an {@link XdmNode} object.
     *
     * @param string $value The $value is a lexical representation of the XML document.
     * @return XdmNode
     */
    public function parseXmlFromString($value) {}

    /**
     * Create an {@link XdmNode} object.
     *
     * @param string $fileName Value is a string type and the file name to the XML document. File name can be relative or absolute. IF relative the cwd is used to resolve the file.
     * @return XdmNode
     */
    public function parseXmlFromFile($fileName) {}

    /**
     * Set the current working directory used to resolve against files
     *
     * @param string $cwd
     * @return void
     */
    public function setcwd($cwd) {}


    /**
     * Set the resources directory of where Saxon can locate data folder
     *
     * @param string $dir
     * @return void
     */
    public function setResourceDirectory($dir) {}

    /**
     * Set a configuration property specific to the processor in use. Properties specified here are common across all the processors.
     *
     * @param string $name
     * @param string $value
     * @return void
     * @link https://www.saxonica.com/documentation9.6/index.html#!configuration/config-features
     */
    public function setConfigurationProperty($name, $value) {}

    /**
     * Create an {@link XsltProcessor} in the PHP environment. An {@link XsltProcessor} is used to compile and execute XSLT sytlesheets
     *
     * @return XsltProcessor
     */
    public function newXsltProcessor() {}

    /**
     * Create an {@link XQueryProcessor} in the PHP environment. An {@link XQueryProcessor} is used to compile and execute XQuery queries
     *
     * @return XQueryProcessor
     */
    public function newXQueryProcessor() {}

    /**
     * Create an {@link XPathProcessor} in the PHP environment. An {@link XPathProcessor} is used to compile and execute XPath queries
     *
     * @return XPathProcessor
     */
    public function newXPathProcessor() {}

    /**
     * Create a {@link SchemaValidator} in the PHP environment. A {@link SchemaValidator} provides capabilities to load and cache XML schema definitions. You can also validate source documents with registered XML schema definitions
     *
     * @return SchemaValidator
     */
    public function newSchemaValidator() {}

    /**
     * Report the Java Saxon version
     *
     * @return string
     */
    public function version() {}

    /**
     * Enables the ability to use PHP functions as XSLT functions. Accepts as parameter the full path of the Saxon/C PHP Extension library. This is needed to do the callbacks.
     *
     * @param string $library The full path of the Saxon/C PHP Extension library. This is needed to do the callbacks.
     * @return void
     */
    public function registerPHPFunctions($library) {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class XsltProcessor {

    /**
     * Perform a one shot transformation. The result is stored in the supplied outputfile name.
     *
     * @param string $sourceFileName
     * @param string $stylesheetFileName
     * @param string $outputfileName
     * @return void
     */
    public function transformFileToFile($sourceFileName, $stylesheetFileName, $outputfileName) {}

    /**
     * Perform a one shot transformation. The result is returned as a string. If there are failures then a null is returned.
     *
     * @param string $sourceFileName
     * @param string $stylesheetFileName
     * @return string|null
     */
    public function transformFileToString($sourceFileName, $stylesheetFileName) {}

    /**
     * Perform a one shot transformation. The result is returned as an {@link XdmValue}.
     *
     * @param string $fileName
     * @return XdmValue
     */
    public function transformFileToValue($fileName) {}

    /**
     * Perform the transformation based upon cached stylesheet and source document.
     *
     * @return void
     */
    public function transformToFile() {}

    /**
     * @return string
     */
    public function transformToString() {}

    /**
     * Perform the transformation based upon cached stylesheet and any source document. Result returned as an {@link XdmValue} object. If there are failures then a null is returned
     *
     * @return XdmValue|null
     */
    public function transformToValue() {}

    /**
     * Compile a stylesheet supplied by file name
     *
     * @param string $fileName
     * @return void
     */
    public function compileFromFile($fileName) {}

    /**
     * Compile a stylesheet received as a string.
     *
     * @param string $str
     * @return void
     */
    public function compileFromString($str) {}

    /**
     * Compile a stylesheet received as an {@link XdmNode}.
     *
     * @param XdmNode $node
     * @return void
     */
    public function compileFromValue($node) {}

    /**
     * Set the output file name of where the transformation result is sent
     *
     * @param string $fileName
     * @return void
     */
    public function setOutputFile($fileName) {}

    /**
     * The source used for a query or stylesheet. Requires an {@link XdmValue} object
     *
     * @param XdmValue $value
     * @return void
     */
    public function setSourceFromXdmValue($value) {}

    /**
     * The source used for a query or stylesheet. Requires a file name as string
     *
     * @param string $filename
     * @return void
     */
    public function setSourceFromFile($filename) {}

    /**
     * Set the parameters required for XSLT stylesheet
     *
     * @param string $name
     * @param XdmValue $value
     * @return void
     */
    public function setParameter($name, $value) {}

    /**
     * Set properties for the stylesheet.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setProperty($name, $value) {}

    /**
     * Clear parameter values set
     *
     * @return void
     */
    public function clearParameters() {}

    /**
     * Clear property values set
     *
     * @return void
     */
    public function clearProperties() {}

    /**
     * Clear any exception thrown
     *
     * @return void
     */
    public function exceptionClear() {}

    /**
     * Get the $i'th error code if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorCode($i) {}

    /**
     * Get the $i'th error message if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorMessage($i) {}

    /**
     * Get number of error during execution or evaluate of stylesheet
     *
     * @return int
     */
    public function getExceptionCount() {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class XQueryProcessor {

    /**
     * Compile and evaluate the query. Result returned as an XdmValue object. If there are failures then a null is returned
     *
     * @return XdmValue|null
     */
    public function runQueryToValue() {}

    /**
     * Compile and evaluate the query. Result returned as string. If there are failures then a null is returned
     *
     * @return string|null
     */
    public function runQueryToString() {}

    /**
     * Compile and evaluate the query. Save the result to file
     *
     * @param string $outfilename
     * @return void
     */
    public function runQueryToFile($outfilename) {}

    /**
     * query supplied as a string
     *
     * @param string $str
     * @return void
     */
    public function setQueryContent($str) {}

    /**
     * @param XdmItem $item
     * @return void
     */
    public function setQueryItem($item) {}

    /**
     * query supplied as a file
     *
     * @param string $filename
     * @return void
     */
    public function setQueryFile($filename) {}

    /**
     * Set the initial context item for the query. Supplied as filename
     *
     * @param string $fileName
     * @return void
     */
    public function setContextItemFromFile($fileName) {}

    /**
     * Set the initial context item for the query.
     * Any one of the objects are accepted: {@link XdmValue}, {@link XdmItem}, {@link XdmNode} and {@link XdmAtomicValue}.
     *
     * @param XdmValue|XdmItem|XdmNode|XdmAtomicValue $obj
     * @return void
     */
    public function setContextItem($obj) {}

    /**
     * Set the static base URI for a query expressions compiled using this XQuery Processor. The base URI is part of the static context, and is used to resolve any relative URIS appearing within a query
     *
     * @param string $uri
     * @return void
     */
    public function setQueryBaseURI($uri) {}

    /**
     * Declare a namespace binding as part of the static context for XPath expressions compiled using this XQuery processor
     *
     * @param string $prefix
     * @param string $namespace
     * @return void
     */
    public function declareNamespace($prefix, $namespace) {}

    /**
     * Set the parameters required for XQuery Processor
     *
     * @param string $name
     * @param XdmValue $value
     * @return void
     */
    public function setParameter($name, $value) {}

    /**
     * Set properties for Query.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setProperty($name, $value) {}

    /**
     * Clear parameter values set
     *
     * @return void
     */
    public function clearParameters() {}

    /**
     * Clear property values set
     *
     * @return void
     */
    public function clearProperties() {}

    /**
     * Clear any exception thrown
     *
     * @return void
     */
    public function exceptionClear() {}

    /**
     * Get the $i'th error code if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorCode($i) {}

    /**
     * Get the $i'th error message if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorMessage($i) {}

    /**
     * Get number of error during execution or evaluate of query
     *
     * @return int
     */
    public function getExceptionCount() {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class XPathProcessor {

    /**
     * Set the context item from a {@link XdmItem}
     *
     * @param XdmItem $item
     * @return void
     */
    public function setContextItem($item) {}

    /**
     * Set the context item from file
     *
     * @param string $fileName
     * @return void
     */
    public function setContextFile($fileName) {}

    /**
     * Evaluate the XPath expression, returning the effective boolean value of the result.
     *
     * @param string $xpathStr
     * @return bool
     */
    public function effectiveBooleanValue($xpathStr) {}

    /**
     * Compile and evaluate an XPath expression, supplied as a character string. Result is an {@link XdmValue}
     *
     * @param string $xpathStr
     * @return XdmValue
     */
    public function evaluate($xpathStr) {}

    /**
     * Compile and evaluate an XPath expression whose result is expected to be a single item, with a given context item. The expression is supplied as a character string.
     *
     * @param string $xpathStr
     * @return XdmItem
     */
    public function evaluateSingle($xpathStr) {}

    /**
     * Declare a namespace binding as part of the static context for XPath expressions compiled using this {@link XPathProcessor}
     *
     * @param $prefix
     * @param $namespace
     * @return void
     */
    public function declareNamespace($prefix, $namespace) {}

    /**
     * Set the static base URI for XPath expressions compiled using this XQuery Processor. The base URI is part of the static context, and is used to resolve any relative URIS appearing within a query
     *
     * @param string $uri
     * @return void
     */
    public function setBaseURI($uri) {}

    /**
     * Set the parameters required for XQuery Processor
     *
     * @param string $name
     * @param XdmValue $value
     * @return void
     */
    public function setParameter($name, $value) {}

    /**
     * Set properties for Query.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setProperty($name, $value) {}

    /**
     * Clear parameter values set
     *
     * @return void
     */
    public function clearParameters() {}

    /**
     * Clear property values set
     *
     * @return void
     */
    public function clearProperties() {}

    /**
     * Clear any exception thrown
     *
     * @return void
     */
    public function exceptionClear() {}

    /**
     * Get the $i'th error code if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorCode($i) {}

    /**
     * Get the $i'th error message if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorMessage($i) {}

    /**
     * Get number of error during execution or evaluate of stylesheet and query, respectively
     *
     * @return int
     */
    public function getExceptionCount() {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class SchemaValidator {

    /**
     * The instance document to be validated. Supplied as an Xdm Node
     *
     * @param XdmNode $node
     * @return void
     */
    public function setSourceNode($node) {}

    /**
     * The instance document to be validated. Supplied file name is resolved and accessed
     *
     * @param string $fileName
     * @return void
     */
    public function setOutputFile($fileName) {}

    /**
     * Register the Schema which is given as file name.
     *
     * @param string $fileName
     * @return void
     */
    public function registerSchemaFromFile($fileName) {}

    /**
     * Register the Schema which is given as a string representation.
     *
     * @param string $schemaStr
     * @return void
     */
    public function registerSchemaFromString($schemaStr) {}

    /**
     * Validate an instance document supplied as a Source object. Assume source document has already been supplied through accessor methods
     *
     * @param string|null $filename The name of the file to be validated. $filename can be null, in that case it is assumed source document has already been supplied through accessor methods
     * @return void
     */
    public function validate($filename = null) {}

    /**
     * Validate an instance document supplied as a Source object with the validated document returned to the calling program.
     *
     * @param string|null $filename The name of the file to be validated. $filename can be null, in that case it is assumed source document has already been supplied through accessor methods
     * @return XdmNode
     */
    public function validateToNode($filename = null) {}

    /**
     * Get the validation report produced after validating the source document. The reporting feature is switched on via setting the property on the {@link SchemaValidator): $validator->setProperty('report', 'true').
     *
     * @return XdmNode
     */
    public function getValidationReport() {}

    /**
     * Set the parameters required for XQuery Processor
     *
     * @param string $name
     * @param XdmValue $value
     * @return void
     */
    public function setParameter($name, $value) {}

    /**
     * Set properties for Schema Validator.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setProperty($name, $value) {}

    /**
     * Clear parameter values set
     *
     * @return void
     */
    public function clearParameters() {}

    /**
     * Clear property values set
     *
     * @return void
     */
    public function clearProperties() {}

    /**
     * Clear any exception thrown
     *
     * @return void
     */
    public function exceptionClear() {}

    /**
     * Get the $i'th error code if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorCode($i) {}

    /**
     * Get the $i'th error message if there are any errors
     *
     * @param int $i
     * @return string
     */
    public function getErrorMessage($i) {}

    /**
     * Get number of error during execution of the validator
     *
     * @return int
     */
    public function getExceptionCount() {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class XdmValue {

    /**
     * Get the first item in the sequence
     *
     * @return XdmItem
     */
    public function getHead() {}

    /**
     * Get the n'th item in the value, counting from zero
     *
     * @param int $index
     * @return XdmItem
     */
    public function itemAt($index) {}

    /**
     * Get the number of items in the sequence
     *
     * @return int
     */
    public function size() {}

    /**
     * Add item to the sequence at the end.
     *
     * @param XdmItem $item
     */
    public function addXdmItem($item) {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class XdmItem extends XdmValue {

    /**
     * Get the string value of the item. For a node, this gets the string value of the node. For an atomic value, it has the same effect as casting the value to a string. In all cases the result is the same as applying the XPath string() function.
     *
     * @return string
     */
    public function getStringValue() {}

    /**
     * Determine whether the item is a node value or not.
     *
     * @return bool
     */
    public function isNode() {}

    /**
     * Determine whether the item is an atomic value or not.
     *
     * @return bool
     */
    public function isAtomic() {}

    /**
     * Provided the item is an atomic value we return the {@link XdmAtomicValue} otherwise return null
     *
     * @return XdmAtomicValue|null
     */
    public function getAtomicValue() {}

    /**
     * Provided the item is a node value we return the {@link XdmNode} otherwise return null
     *
     * @return XdmNode|null
     */
    public function getNodeValue() {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class XdmNode extends XdmItem {

    /**
     * Get the string value of the item. For a node, this gets the string value of the node.
     *
     * @return string
     */
    public function getStringValue() {}

    /**
     * Get the kind of node
     *
     * @return int
     */
    public function getNodeKind() {}

    /**
     * Get the name of the node, as a EQName
     *
     * @return string
     */
    public function getNodeName() {}

    /**
     * Determine whether the item is an atomic value or a node. This method will return FALSE as the item is not atomic
     *
     * @return false
     */
    public function isAtomic() {}

    /**
     * Get the count of child node at this current node
     *
     * @return int
     */
    public function getChildCount() {}

    /**
     * Get the count of attribute nodes at this node
     *
     * @return int
     */
    public function getAttributeCount() {}

    /**
     * Get the n'th child node at this node. If the child node selected does not exist then return null
     *
     * @param int $index
     * @return XdmNode|null
     */
    public function getChildNode($index) {}

    /**
     * Get the parent of this node. If parent node does not exist then return null
     *
     * @return XdmNode|null
     */
    public function getParent() {}

    /**
     * Get the n'th attribute node at this node. If the attribute node selected does not exist then return null
     *
     * @param int $index
     * @return XdmNode|null
     */
    public function getAttributeNode($index) {}

    /**
     * Get the n'th attribute node value at this node. If the attribute node selected does not exist then return null
     *
     * @param int $index
     * @return string|null
     */
    public function getAttributeValue($index) {}
}

/**
 * @link https://www.saxonica.com/saxon-c/doc/html/index.html#php-api
 */
class XdmAtomicValue extends XdmItem {

    /**
     * Get the string value of the item. For an atomic value, it has the same effect as casting the value to a string. In all cases the result is the same as applying the XPath string() function.
     *
     * @return string
     */
    public function getStringValue() {}

    /**
     * Get the value converted to a boolean using the XPath casting rules
     *
     * @return bool
     */
    public function getBooleanValue() {}

    /**
     * Get the value converted to a double using the XPath casting rules. If the value is a string, the XSD 1.1 rules are used, which means that the string "+INF" is recognised
     *
     * @return float
     */
    public function getDoubleValue() {}

    /**
     * Get the value converted to an integer using the XPath casting rules
     *
     * @return int
     */
    public function getLongValue() {}

    /**
     * Determine whether the item is an atomic value or a node. Return TRUE if the item is an atomic value
     *
     * @return true
     */
    public function isAtomic() {}
}
