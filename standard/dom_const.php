<?php
/**
 * PHPStorm stub file for DOM constants.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */

/**
 * If the specified range of text does not fit into a
 * <b>DOMString</b>.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOMSTRING_SIZE_ERR = 2;
/**
 * If any node is inserted somewhere it doesn't belong
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_HIERARCHY_REQUEST_ERR = 3;
/**
 * If index or size is negative, or greater than the allowed value.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_INDEX_SIZE_ERR = 1;
/**
 * If an attempt is made to add an attribute that is already in use elsewhere.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_INUSE_ATTRIBUTE_ERR = 10;
/**
 * If a parameter or an operation is not supported by the underlying object.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_INVALID_ACCESS_ERR = 15;
/**
 * If an invalid or illegal character is specified, such as in a name.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_INVALID_CHARACTER_ERR = 5;
/**
 * If an attempt is made to modify the type of the underlying object.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_INVALID_MODIFICATION_ERR = 13;
/**
 * If an attempt is made to use an object that is not, or is no longer, usable.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_INVALID_STATE_ERR = 11;
/**
 * If an attempt is made to create or change an object in a way which is
 * incorrect with regard to namespaces.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_NAMESPACE_ERR = 14;
/**
 * If an attempt is made to reference a node in a context where it does not exist.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_NOT_FOUND_ERR = 8;
/**
 * If the implementation does not support the requested type of object or operation.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_NOT_SUPPORTED_ERR = 9;
/**
 * If data is specified for a node which does not support data.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_NO_DATA_ALLOWED_ERR = 6;
/**
 * If an attempt is made to modify an object where modifications are not allowed.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_NO_MODIFICATION_ALLOWED_ERR = 7;
/**
 * Error code not part of the DOM specification. Meant for PHP errors.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_PHP_ERR = 0;
/**
 * If an invalid or illegal string is specified.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_SYNTAX_ERR = 12;
/**
 * If a call to a method such as insertBefore or removeChild would make the Node
 * invalid with respect to "partial validity", this exception would be raised and
 * the operation would not be done.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_VALIDATION_ERR = 16;
/**
 * If a node is used in a different document than the one that created it.
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const DOM_WRONG_DOCUMENT_ERR = 4;
const XML_ATTRIBUTE_CDATA = 1;
const XML_ATTRIBUTE_DECL_NODE = 16;
const XML_ATTRIBUTE_ENTITY = 6;
const XML_ATTRIBUTE_ENUMERATION = 9;
const XML_ATTRIBUTE_ID = 2;
const XML_ATTRIBUTE_IDREF = 3;
const XML_ATTRIBUTE_IDREFS = 4;
const XML_ATTRIBUTE_NMTOKEN = 7;
const XML_ATTRIBUTE_NMTOKENS = 8;
/**
 * Node is a <b>DOMAttr</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_ATTRIBUTE_NODE = 2;
const XML_ATTRIBUTE_NOTATION = 10;
/**
 * Node is a <b>DOMCharacterData</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_CDATA_SECTION_NODE = 4;
/**
 * Node is a <b>DOMComment</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_COMMENT_NODE = 8;
/**
 * Node is a <b>DOMDocumentFragment</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_DOCUMENT_FRAG_NODE = 11;
/**
 * Node is a <b>DOMDocument</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_DOCUMENT_NODE = 9;
/**
 * Node is a <b>DOMDocumentType</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_DOCUMENT_TYPE_NODE = 10;
const XML_DTD_NODE = 14;
const XML_ELEMENT_DECL_NODE = 15;
/**
 * Node is a <b>DOMElement</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_ELEMENT_NODE = 1;
const XML_ENTITY_DECL_NODE = 17;
/**
 * Node is a <b>DOMEntity</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_ENTITY_NODE = 6;
/**
 * Node is a <b>DOMEntityReference</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_ENTITY_REF_NODE = 5;
const XML_HTML_DOCUMENT_NODE = 13;
const XML_LOCAL_NAMESPACE = 18;
const XML_NAMESPACE_DECL_NODE = 18;
/**
 * Node is a <b>DOMNotation</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_NOTATION_NODE = 12;
/**
 * Node is a <b>DOMProcessingInstruction</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_PI_NODE = 7;
/**
 * Node is a <b>DOMText</b>
 *
 * @link http://php.net/manual/en/dom.constants.php
 */
const XML_TEXT_NODE = 3;
