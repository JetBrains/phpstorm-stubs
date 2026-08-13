<?php

namespace Dom;

/**
 * This class provides a number of methods for performing operations that are independent of any
 * particular instance of the document object model.
 *
 * This is the modern, spec-compliant equivalent of DOMImplementation.
 *
 * @link https://php.net/manual/en/class.dom-implementation.php
 * @since 8.4
 */
class Implementation
{
    public function createDocumentType(string $qualifiedName, string $publicId, string $systemId): DocumentType {}

    public function createDocument(?string $namespace, string $qualifiedName, ?DocumentType $doctype = null): XMLDocument {}

    public function createHTMLDocument(?string $title = null): HTMLDocument {}
}

/**
 * This represents immutable information about namespaces of an element. This decouples namespaces
 * from attributes, which was incorrectly intertwined for the old DOM classes.
 * @link https://php.net/manual/en/class.dom-namespaceinfo.php
 * @since 8.4
 */
final readonly class NamespaceInfo
{
    public readonly ?string $prefix;
    public readonly ?string $namespaceURI;
    public readonly Element $element;

    private function __construct() {}
}

/**
 * Represents a live list of nodes.
 *
 * This is the modern, spec-compliant equivalent of DOMNodeList.
 *
 * @link https://php.net/manual/en/class.dom-nodelist.php
 * @since 8.4
 * @template TNode of Node Should be template-covariant but DocBlock::getTagsByName() does not support it
 * @implements \IteratorAggregate<int, TNode>
 */
class NodeList implements \IteratorAggregate, \Countable
{
    public int $length;

    public function count(): int {}

    /**
     * @return \Iterator<int, TNode>
     */
    public function getIterator(): \Iterator {}

    /** @return TNode|null */
    public function item(int $index): ?Node {}
}
/**
 * Represents the set of attributes on an element.
 * @link https://php.net/manual/en/class.dom-namednodemap.php
 * @since 8.4
 * @implements \IteratorAggregate<array-key, Attr>
 */
class NamedNodeMap implements \IteratorAggregate, \Countable
{
    public int $length;

    public function item(int $index): ?Attr {}

    public function getNamedItem(string $qualifiedName): ?Attr {}

    public function getNamedItemNS(?string $namespace, string $localName): ?Attr {}

    public function count(): int {}

    /**
     * @return \Iterator<array-key, Attr>
     */
    public function getIterator(): \Iterator {}
}
/**
 * Represents a named node map for entities and notation nodes of the DTD.
 * @link https://php.net/manual/en/class.dom-dtdnamednodemap.php
 * @since 8.4
 *
 * @template TDtdNode of Entity|Notation Should be template-covariant but DocBlock::getTagsByName() does not support it
 * @implements \IteratorAggregate<string, TDtdNode>
 */
class DtdNamedNodeMap implements \IteratorAggregate, \Countable
{
    public int $length;

    /** @return TDtdNode|null */
    public function item(int $index): Entity|Notation|null {}

    /** @return TDtdNode|null */
    public function getNamedItem(string $qualifiedName): Entity|Notation|null {}

    /** @return TDtdNode|null */
    public function getNamedItemNS(?string $namespace, string $localName): Entity|Notation|null {}

    public function count(): int {}

    /** @return \Iterator<string, TDtdNode> */
    public function getIterator(): \Iterator {}
}
/**
 * Represents a static set of elements.
 * @link https://php.net/manual/en/class.dom-htmlcollection.php
 * @since 8.4
 * @implements \IteratorAggregate<array-key, Element>
 */
class HTMLCollection implements \IteratorAggregate, \Countable
{
    public int $length;

    public function item(int $index): ?Element {}

    public function namedItem(string $key): ?Element {}

    public function count(): int {}

    /**
     * @return \Iterator<array-key, Element>
     */
    public function getIterator(): \Iterator {}
}
/**
 * Allows to use XPath 1.0 queries on HTML or XML documents.
 *
 * This is the modern, spec-compliant equivalent of DOMXPath.
 *
 * @link https://php.net/manual/en/class.dom-xpath.php
 * @since 8.4
 */
final class XPath
{
    public Document $document;
    public bool $registerNodeNamespaces;

    public function __construct(Document $document, bool $registerNodeNS = true) {}

    /** @return null|bool|float|string|NodeList<Node> */
    public function evaluate(string $expression, ?Node $contextNode = null, bool $registerNodeNS = true): null|bool|float|string|NodeList {}

    /** @return NodeList<Node> */
    public function query(string $expression, ?Node $contextNode = null, bool $registerNodeNS = true): NodeList {}

    public function registerNamespace(string $prefix, string $namespace): bool {}

    public function registerPhpFunctions(string|array|null $restrict = null): void {}

    public function registerPhpFunctionNS(string $namespaceURI, string $name, callable $callable): void {}

    public static function quote(string $str): string {}
}
/**
 * Represents a set of tokens in an attribute (e.g. class names).
 * @link https://php.net/manual/en/class.dom-tokenlist.php
 * @since 8.4
 */
final class TokenList implements \IteratorAggregate, \Countable
{
    private function __construct() {}
    public int $length;

    /**
     * Returns a token from the list
     *
     * Returns a token from the list at index.
     *
     * @link https://php.net/manual/en/dom-tokenlist.item.php
     * @param int $index The token index.
     * @return string|null Returns the token at index or null when the index is out of bounds.
     */
    public function item(int $index): ?string {}

    /**
     * Returns whether the list contains a given token
     *
     * Returns whether the list contains token.
     *
     * @link https://php.net/manual/en/dom-tokenlist.contains.php
     * @param string $token The token.
     * @return bool Returns true if the list contains token, false otherwise.
     */
    public function contains(string $token): bool {}

    /**
     * Adds the given tokens to the list
     *
     * Adds the given tokens to the list, but not any that were already present.
     *
     * @link https://php.net/manual/en/dom-tokenlist.add.php
     * @param string $tokens The tokens to add.
     * @return void No value is returned.
     * @throws \ValueError Throws a ValueError if a token contains any null bytes. Throws a
     * @throws \DOMException with code Dom\SYNTAX_ERR if a token is the empty string. Throws a
     * @throws \DOMException with code Dom\INVALID_CHARACTER_ERR if a token contains any ASCII
     * whitespace.
     */
    public function add(string ...$tokens): void {}

    /**
     * Removes the given tokens from the list
     *
     * Removes the given tokens from the list, but ignores any that were not present.
     *
     * @link https://php.net/manual/en/dom-tokenlist.remove.php
     * @param string $tokens The tokens to remove.
     * @return void No value is returned.
     * @throws \ValueError Throws a ValueError if a token contains any null bytes. Throws a
     * @throws \DOMException with code Dom\SYNTAX_ERR if a token is the empty string. Throws a
     * @throws \DOMException with code Dom\INVALID_CHARACTER_ERR if a token contains any ASCII
     * whitespace.
     */
    public function remove(string ...$tokens): void {}

    /**
     * Toggles the presence of a token in the list
     *
     * Toggles the presence of token in the list.
     *
     * @link https://php.net/manual/en/dom-tokenlist.toggle.php
     * @param string $token The token to toggle.
     * @param bool|null $force If force is provided, setting it to true will add the token, and
     * setting it to false will remove the token.
     * @return bool Returns true if the token is in the list after the call, false otherwise.
     * @throws \ValueError Throws a ValueError if a token contains any null bytes. Throws a
     * @throws \DOMException with code Dom\SYNTAX_ERR if a token is the empty string. Throws a
     * @throws \DOMException with code Dom\INVALID_CHARACTER_ERR if a token contains any ASCII
     * whitespace.
     */
    public function toggle(string $token, ?bool $force = null): bool {}

    /**
     * Replaces a token in the list with another one
     * @link https://php.net/manual/en/dom-tokenlist.replace.php
     * @param string $token The token to replace.
     * @param string $newToken The new token.
     * @return bool Returns true if token was in the list, false otherwise.
     * @throws \ValueError Throws a ValueError if a token contains any null bytes. Throws a
     * @throws \DOMException with code Dom\SYNTAX_ERR if a token is the empty string. Throws a
     * @throws \DOMException with code Dom\INVALID_CHARACTER_ERR if a token contains any ASCII
     * whitespace.
     */
    public function replace(string $token, string $newToken): bool {}

    /**
     * Returns whether the given token is supported
     *
     * Returns whether token is in the associated attribute's supported tokens.
     *
     * @link https://php.net/manual/en/dom-tokenlist.supports.php
     * @param string $token The token.
     * @return bool Returns true on success or false on failure.
     * @throws \TypeError Throws a TypeError when the attribute does not define a supported tokens
     * list.
     */
    public function supports(string $token): bool {}
    public string $value;

    /**
     * Returns the number of tokens in the list
     * @link https://php.net/manual/en/dom-tokenlist.count.php
     * @return int The number of tokens in the list.
     */
    public function count(): int {}

    /**
     * Returns an iterator over the token list
     * @link https://php.net/manual/en/dom-tokenlist.getiterator.php
     * @return \Iterator An iterator over the token list.
     */
    public function getIterator(): \Iterator {}
}
/**
 * This is the modern, spec-compliant equivalent of DOMParentNode.
 * @link https://php.net/manual/en/class.dom-parentnode.php
 * @since 8.4
 */
interface ParentNode
{
    /**
     * Appends nodes after the last child node
     *
     * Appends one or many nodes to the list of children after the last child node.
     *
     * @link https://php.net/manual/en/dom-parentnode.append.php
     * @param Node|string $nodes The nodes to append. Strings are automatically converted to text
     * nodes.
     * @return void No value is returned.
     */
    public function append(Node|string ...$nodes): void;

    /**
     * Prepends nodes before the first child node
     *
     * Prepends one or many nodes to the list of children before the first child node.
     *
     * @link https://php.net/manual/en/dom-parentnode.prepend.php
     * @param Node|string $nodes The nodes to prepend. Strings are automatically converted to text
     * nodes.
     * @return void No value is returned.
     */
    public function prepend(Node|string ...$nodes): void;

    /**
     * Replace children in node
     * @link https://php.net/manual/en/dom-parentnode.replacechildren.php
     * @param Node|string $nodes The nodes replacing the children. Strings are automatically
     * converted to text nodes.
     * @return void No value is returned.
     */
    public function replaceChildren(Node|string ...$nodes): void;

    /**
     * Returns the first element that matches the CSS selectors
     *
     * Returns the first element that matches the CSS selectors specified in selectors.
     *
     * @link https://php.net/manual/en/dom-parentnode.queryselector.php
     * @param string $selectors A string containing one or more CSS selectors.
     * @return Element|null Returns the first Dom\Element that matches selectors. Returns null if no
     * element matches.
     * @throws \DOMException Throws a DOMException with code Dom\SYNTAX_ERR when selectors is not a
     * valid CSS selector string.
     */
    public function querySelector(string $selectors): ?Element;

    /**
     * Returns a collection of elements that match the CSS selectors
     *
     * Returns a collection of elements that match the CSS selectors specified in selectors.
     *
     * @link https://php.net/manual/en/dom-parentnode.queryselectorall.php
     * @return NodeList<Element>
     */
    public function querySelectorAll(string $selectors): NodeList;
}
/**
 * This is the modern, spec-compliant equivalent of DOMChildNode.
 * @link https://php.net/manual/en/class.dom-childnode.php
 * @since 8.4
 */
interface ChildNode
{
    /**
     * Removes the node
     * @link https://php.net/manual/en/dom-childnode.remove.php
     * @return void No value is returned.
     */
    public function remove(): void;

    /**
     * Adds nodes before the node
     *
     * Adds the passed nodes before the node.
     *
     * @link https://php.net/manual/en/dom-childnode.before.php
     * @param Node|string $nodes Nodes to be added before the node. Strings are automatically
     * converted to text nodes.
     * @return void No value is returned.
     */
    public function before(Node|string ...$nodes): void;

    /**
     * Adds nodes after the node
     *
     * Adds the passed nodes after the node.
     *
     * @link https://php.net/manual/en/dom-childnode.after.php
     * @param Node|string $nodes Nodes to be added after the node. Strings are automatically
     * converted to text nodes.
     * @return void No value is returned.
     */
    public function after(Node|string ...$nodes): void;

    /**
     * Replaces the node with new nodes
     * @link https://php.net/manual/en/dom-childnode.replacewith.php
     * @param Node|string $nodes The replacement nodes. Strings are automatically converted to text
     * nodes.
     * @return void No value is returned.
     */
    public function replaceWith(Node|string ...$nodes): void;
}
/**
 * @since 8.4
 */
enum AdjacentPosition implements \BackedEnum, \UnitEnum
{
    case BeforeBegin = "beforebegin";
    case AfterBegin = "afterbegin";
    case BeforeEnd = "beforeend";
    case AfterEnd = "afterend";

    public static function cases(): array {}

    public static function from(string|int $value): static {}

    public static function tryFrom(string|int $value): ?static {}
}
/**
 * This is the modern, spec-compliant equivalent of DOMNode.
 * @link https://php.net/manual/en/class.dom-node.php
 * @since 8.4
 */
class Node
{
    final private function __construct() {}
    public int $nodeType;
    public string $nodeName;
    public string $baseURI;
    public bool $isConnected;
    public ?Document $ownerDocument;

    public function getRootNode(array $options = []): Node {}
    public ?Node $parentNode;
    public ?Element $parentElement;

    public function hasChildNodes(): bool {}

    /** @var NodeList<Node> */
    public NodeList $childNodes;
    public ?Node $firstChild;
    public ?Node $lastChild;
    public ?Node $previousSibling;
    public ?Node $nextSibling;
    public ?string $nodeValue;
    public ?string $textContent;

    public function normalize(): void {}

    public function cloneNode(bool $deep = false): Node {}

    public function isEqualNode(?Node $otherNode): bool {}

    public function isSameNode(?Node $otherNode): bool {}
    public const int DOCUMENT_POSITION_DISCONNECTED = 0x01;
    public const int DOCUMENT_POSITION_PRECEDING = 0x02;
    public const int DOCUMENT_POSITION_FOLLOWING = 0x04;
    public const int DOCUMENT_POSITION_CONTAINS = 0x08;
    public const int DOCUMENT_POSITION_CONTAINED_BY = 0x10;
    public const int DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC = 0x20;

    public function compareDocumentPosition(Node $other): int {}

    public function contains(?Node $other): bool {}

    public function lookupPrefix(?string $namespace): ?string {}

    public function lookupNamespaceURI(?string $prefix): ?string {}

    public function isDefaultNamespace(?string $namespace): bool {}

    public function insertBefore(Node $node, ?Node $child): Node {}

    public function appendChild(Node $node): Node {}

    public function replaceChild(Node $node, Node $child): Node {}

    public function removeChild(Node $child): Node {}

    public function getLineNo(): int {}

    public function getNodePath(): string {}

    public function C14N(bool $exclusive = false, bool $withComments = false, ?array $xpath = null, ?array $nsPrefixes = null): string|false {}

    public function C14NFile(string $uri, bool $exclusive = false, bool $withComments = false, ?array $xpath = null, ?array $nsPrefixes = null): int|false {}

    public function __sleep(): array {}

    public function __wakeup(): void {}
}
/**
 * This represents a document fragment, which can be used as a container for other nodes.
 *
 * This is the modern, spec-compliant equivalent of DOMDocumentFragment.
 *
 * @link https://php.net/manual/en/class.dom-documentfragment.php
 * @since 8.4
 */
class DocumentFragment extends Node implements ParentNode
{
    public ?Element $firstElementChild;
    public ?Element $lastElementChild;
    public int $childElementCount;

    /**
     * @since 8.5
     */
    public \Dom\HTMLCollection $children;

    public function appendXml(string $data): bool {}

    public function append(Node|string ...$nodes): void {}

    public function prepend(Node|string ...$nodes): void {}

    public function replaceChildren(Node|string ...$nodes): void {}

    public function querySelector(string $selectors): ?Element {}

    /** @return NodeList<Element> */
    public function querySelectorAll(string $selectors): NodeList {}
}
/**
 * Represents an entire HTML or XML document; serves as the root of the document tree.
 *
 * This is the modern, spec-compliant equivalent of DOMDocument. It is the base class for
 * Dom\XMLDocument and Dom\HTMLDocument.
 *
 * @link https://php.net/manual/en/class.dom-document.php
 * @since 8.4
 */
class Document extends Node implements ParentNode
{
    /** @readonly */
    public Implementation $implementation;
    public string $URL;
    public string $documentURI;
    public string $characterSet;
    public string $charset;
    public string $inputEncoding;
    public ?DocumentType $doctype;
    public ?Element $documentElement;

    /**
     * @since 8.5
     */
    public \Dom\HTMLCollection $children;

    public function getElementsByTagName(string $qualifiedName): HTMLCollection {}

    public function getElementsByTagNameNS(?string $namespace, string $localName): HTMLCollection {}

    public function createElement(string $localName): Element {}

    public function createElementNS(?string $namespace, string $qualifiedName): Element {}

    public function createDocumentFragment(): DocumentFragment {}

    public function createTextNode(string $data): Text {}

    public function createCDATASection(string $data): CDATASection {}

    public function createComment(string $data): Comment {}

    public function createProcessingInstruction(string $target, string $data): ProcessingInstruction {}

    public function importNode(?Node $node, bool $deep = false): Node {}

    public function adoptNode(Node $node): Node {}

    public function createAttribute(string $localName): Attr {}

    public function createAttributeNS(?string $namespace, string $qualifiedName): Attr {}
    public ?Element $firstElementChild;
    public ?Element $lastElementChild;
    public int $childElementCount;

    public function getElementById(string $elementId): ?Element {}

    public function registerNodeClass(string $baseClass, ?string $extendedClass): void {}

    public function schemaValidate(string $filename, int $flags = 0): bool {}

    public function schemaValidateSource(string $source, int $flags = 0): bool {}

    public function relaxNgValidate(string $filename): bool {}

    public function relaxNgValidateSource(string $source): bool {}

    public function append(Node|string ...$nodes): void {}

    public function prepend(Node|string ...$nodes): void {}

    public function replaceChildren(Node|string ...$nodes): void {}

    public function importLegacyNode(\DOMNode $node, bool $deep = false): Node {}

    public function querySelector(string $selectors): ?Element {}

    /** @return NodeList<Element> */
    public function querySelectorAll(string $selectors): NodeList {}

    /**
     * @since 8.5
     */
    public function getElementsByClassName(string $classNames): HTMLCollection {}
    public ?HTMLElement $body;
    public ?HTMLElement $head;
    public string $title;
}
/**
 * Represents an HTML document.
 * @link https://php.net/manual/en/class.dom-htmldocument.php
 * @since 8.4
 */
final class HTMLDocument extends Document
{
    /**
     * Creates an empty HTML document
     *
     * Creates an empty HTML document without any elements.
     *
     * @link https://php.net/manual/en/dom-htmldocument.createempty.php
     * @param string $encoding The character encoding of the document, used for serialization when
     * calling the save methods.
     * @return HTMLDocument An empty HTML document.
     */
    public static function createEmpty(string $encoding = "UTF-8"): HTMLDocument {}

    /**
     * Parses an HTML document from a file
     *
     * Parses an HTML document from a file, according to the living standard.
     *
     * @link https://php.net/manual/en/dom-htmldocument.createfromfile.php
     * @param string $path The path to the file to parse.
     * @param int $options Bitwise OR of the libxml option constants. It is also possible to pass
     * Dom\HTML_NO_DEFAULT_NS to disable the use of the HTML namespace and the template element.
     * This should only be used if the implications are properly understood.
     * @param string|null $overrideEncoding The encoding that the document was created in. If not
     * provided, it will attempt to determine the encoding that is most likely used.
     * @return HTMLDocument The parsed document as an Dom\HTMLDocument instance.
     * @throws \ValueError Throws a ValueError if path contains null bytes or contains "%00". Throws
     * a ValueError if options contains an invalid option. Throws a ValueError if overrideEncoding
     * is an unknown encoding.
     * @throws \Exception Throws an Exception if the file could not be opened.
     */
    public static function createFromFile(string $path, int $options = 0, ?string $overrideEncoding = null): HTMLDocument {}

    /**
     * Parses an HTML document from a string
     *
     * Parses an HTML document from a string, according to the living standard.
     *
     * @link https://php.net/manual/en/dom-htmldocument.createfromstring.php
     * @param string $source The string containing the HTML to parse.
     * @param int $options Bitwise OR of the libxml option constants. It is also possible to pass
     * Dom\HTML_NO_DEFAULT_NS to disable the use of the HTML namespace and the template element.
     * This should only be used if the implications are properly understood.
     * @param string|null $overrideEncoding The encoding that the document was created in. If not
     * provided, it will attempt to determine the encoding that is most likely used.
     * @return HTMLDocument The parsed document as an Dom\HTMLDocument instance.
     * @throws \ValueError Throws a ValueError if options contains an invalid option. Throws a
     * ValueError if overrideEncoding is an unknown encoding.
     */
    public static function createFromString(string $source, int $options = 0, ?string $overrideEncoding = null): HTMLDocument {}

    /**
     * Serializes the document as an XML string
     * @link https://php.net/manual/en/dom-htmldocument.savexml.php
     * @param Node|null $node The node to serialize. If not provided, the entire document is
     * serialized.
     * @param int $options Additional Options. The LIBXML_NOEMPTYTAG and LIBXML_NOXMLDECL options
     * are supported. Prior to PHP 8.3.0, only the LIBXML_NOEMPTYTAG option is supported.
     * @return string|false The serialized XML document string in the current document encoding, or
     * false on failure.
     */
    public function saveXml(?Node $node = null, int $options = 0): string|false {}

    /**
     * Serializes the document as an XML file
     * @link https://php.net/manual/en/dom-htmldocument.savexmlfile.php
     * @param string $filename The path to the file to save to.
     * @param int $options Additional Options. The LIBXML_NOEMPTYTAG and LIBXML_NOXMLDECL options
     * are supported. Prior to PHP 8.3.0, only the LIBXML_NOEMPTYTAG option is supported.
     * @return int|false The number of bytes written on success, or false on failure.
     * @throws \ValueError Throws a ValueError if filename is an empty string or contains any null
     * bytes.
     */
    public function saveXmlFile(string $filename, int $options = 0): int|false {}

    /**
     * Serializes the document as an HTML string
     * @link https://php.net/manual/en/dom-htmldocument.savehtml.php
     * @param Node|null $node The node to serialize. If not provided, the entire document is
     * serialized.
     * @return string The serialized HTML document string in the current document encoding.
     */
    public function saveHtml(?Node $node = null): string {}

    /**
     * Serializes the document as an HTML file
     * @link https://php.net/manual/en/dom-htmldocument.savehtmlfile.php
     * @param string $filename The path to the file to save to.
     * @return int|false The number of bytes written on success, or false on failure.
     * @throws \ValueError Throws a ValueError if filename is an empty string or contains any null
     * bytes.
     */
    public function saveHtmlFile(string $filename): int|false {}
}
/**
 * Represents an XML document.
 * @link https://php.net/manual/en/class.dom-xmldocument.php
 * @since 8.4
 */
final class XMLDocument extends Document
{
    public static function createEmpty(string $version = "1.0", string $encoding = "UTF-8"): XMLDocument {}

    public static function createFromFile(string $path, int $options = 0, ?string $overrideEncoding = null): XMLDocument {}

    public static function createFromString(string $source, int $options = 0, ?string $overrideEncoding = null): XMLDocument {}
    public string $xmlEncoding;
    public bool $xmlStandalone;
    public string $xmlVersion;
    public bool $formatOutput;

    public function createEntityReference(string $name): EntityReference {}

    public function validate(): bool {}

    public function xinclude(int $options = 0): int {}

    public function saveXml(?Node $node = null, int $options = 0): string|false {}

    public function saveXmlFile(string $filename, int $options = 0): int|false {}
}
/**
 * Represents nodes with character data. No nodes directly correspond to this class, but other nodes
 * do inherit from it.
 *
 * This is the modern, spec-compliant equivalent of DOMCharacterData.
 *
 * @link https://php.net/manual/en/class.dom-characterdata.php
 * @since 8.4
 */
class CharacterData extends Node implements ChildNode
{
    public ?Element $previousElementSibling;
    public ?Element $nextElementSibling;
    public string $data;
    public int $length;

    /**
     * Extracts a range of data from the character data
     *
     * Returns the specified substring.
     *
     * @link https://php.net/manual/en/dom-characterdata.substringdata.php
     * @param int $offset Start offset of substring to extract.
     * @param int $count The number of characters to extract.
     * @return string The specified substring. If the sum of offset and count exceeds the length,
     * then all UTF-8 codepoints to the end of the data are returned.
     */
    public function substringData(int $offset, int $count): string {}

    /**
     * Append the string to the end of the character data of the node
     *
     * Append the string data to the end of the character data of the node.
     *
     * @link https://php.net/manual/en/dom-characterdata.appenddata.php
     * @param string $data The string to append.
     */
    public function appendData(string $data): void {}

    /**
     * Insert a string at the specified UTF-8 codepoint offset
     *
     * Inserts string data at position offset.
     *
     * @link https://php.net/manual/en/dom-characterdata.insertdata.php
     * @param int $offset The character offset at which to insert.
     * @param string $data The string to insert.
     */
    public function insertData(int $offset, string $data): void {}

    /**
     * Remove a range of characters from the character data
     *
     * Deletes count characters starting from position offset.
     *
     * @link https://php.net/manual/en/dom-characterdata.deletedata.php
     * @param int $offset The offset from which to start removing.
     * @param int $count The number of characters to delete. If the sum of offset and count exceeds
     * the length, then all characters to the end of the data are deleted.
     */
    public function deleteData(int $offset, int $count): void {}

    /**
     * Replace a substring within the character data
     *
     * Replace count characters starting from position offset with data.
     *
     * @link https://php.net/manual/en/dom-characterdata.replacedata.php
     * @param int $offset The offset from which to start replacing.
     * @param int $count The number of characters to replace. If the sum of offset and count exceeds
     * the length, then all characters to the end of the data are replaced.
     * @param string $data The string with which the range must be replaced.
     */
    public function replaceData(int $offset, int $count, string $data): void {}

    /**
     * Removes the character data node
     * @link https://php.net/manual/en/dom-characterdata.remove.php
     * @return void No value is returned.
     */
    public function remove(): void {}

    /**
     * Adds nodes before the character data
     *
     * Adds the passed nodes before the character data.
     *
     * @link https://php.net/manual/en/dom-characterdata.before.php
     * @param Node|string $nodes Nodes to be added before the node. Strings are automatically
     * converted to text nodes.
     * @return void No value is returned.
     */
    public function before(Node|string ...$nodes): void {}

    /**
     * Adds nodes after the character data
     *
     * Adds the passed nodes after the character data.
     *
     * @link https://php.net/manual/en/dom-characterdata.after.php
     * @param Node|string $nodes Nodes to be added after the node. Strings are automatically
     * converted to text nodes.
     * @return void No value is returned.
     */
    public function after(Node|string ...$nodes): void {}

    /**
     * Replaces the character data with new nodes
     * @link https://php.net/manual/en/dom-characterdata.replacewith.php
     * @param Node|string $nodes The replacement nodes. Strings are automatically converted to text
     * nodes.
     * @return void No value is returned.
     */
    public function replaceWith(Node|string ...$nodes): void {}
}
/**
 * Dom\Attr represents an attribute in the Dom\Element object.
 *
 * This is the modern, spec-compliant equivalent of DOMAttr.
 *
 * @link https://php.net/manual/en/class.dom-attr.php
 * @since 8.4
 */
class Attr extends Node
{
    public ?string $namespaceURI;
    public ?string $prefix;
    public string $localName;
    public string $name;
    public string $value;
    public ?Element $ownerElement;
    public bool $specified;

    /**
     * Checks if attribute is a defined ID
     *
     * This function checks if the attribute is a defined ID. According to the DOM standard this
     * requires a DTD which defines the attribute ID to be of type ID. To utilise this method the
     * document must be validated at parse time by passing LIBXML_DTDVALID as an option.
     *
     * @link https://php.net/manual/en/dom-attr.isid.php
     * @return bool Returns true if this attribute is a defined ID, false otherwise.
     */
    public function isId(): bool {}

    /**
     * Changes the qualified name or namespace of an attribute
     *
     * This method changes the qualified name or namespace of an attribute.
     *
     * @link https://php.net/manual/en/dom-attr.rename.php
     * @param string|null $namespaceURI The new namespace URI of the attribute.
     * @param string $qualifiedName The new qualified name of the attribute.
     * @return void No value is returned.
     * @throws \DOMException DOMException with code Dom\NAMESPACE_ERR Raised if there is an error
     * with the namespace, as determined by qualifiedName. DOMException with code
     * Dom\INVALID_MODIFICATION_ERR Raised if there already exists an attribute in the element with
     * the same qualified name.
     */
    public function rename(?string $namespaceURI, string $qualifiedName): void {}
}
/**
 * Represents an element.
 *
 * This is the modern, spec-compliant equivalent of DOMElement.
 *
 * @link https://php.net/manual/en/class.dom-element.php
 * @since 8.4
 */
class Element extends Node implements ParentNode, ChildNode
{
    public ?string $namespaceURI;
    public ?string $prefix;
    public string $localName;
    public string $tagName;
    public string $id;
    public string $className;

    /**
     * @since 8.5
     */
    public \Dom\HTMLCollection $children;

    /** @readonly */
    public TokenList $classList;

    public function hasAttributes(): bool {}
    public NamedNodeMap $attributes;

    public function getAttributeNames(): array {}

    public function getAttribute(string $qualifiedName): ?string {}

    public function getAttributeNS(?string $namespace, string $localName): ?string {}

    public function setAttribute(string $qualifiedName, string $value): void {}

    public function setAttributeNS(?string $namespace, string $qualifiedName, string $value): void {}

    public function removeAttribute(string $qualifiedName): void {}

    public function removeAttributeNS(?string $namespace, string $localName): void {}

    public function toggleAttribute(string $qualifiedName, ?bool $force = null): bool {}

    public function hasAttribute(string $qualifiedName): bool {}

    public function hasAttributeNS(?string $namespace, string $localName): bool {}

    public function getAttributeNode(string $qualifiedName): ?Attr {}

    public function getAttributeNodeNS(?string $namespace, string $localName): ?Attr {}

    public function setAttributeNode(Attr $attr): ?Attr {}

    public function setAttributeNodeNS(Attr $attr): ?Attr {}

    public function removeAttributeNode(Attr $attr): Attr {}

    public function getElementsByTagName(string $qualifiedName): HTMLCollection {}

    public function getElementsByTagNameNS(?string $namespace, string $localName): HTMLCollection {}

    public function insertAdjacentElement(AdjacentPosition $where, Element $element): ?Element {}

    public function insertAdjacentText(AdjacentPosition $where, string $data): void {}
    public ?Element $firstElementChild;
    public ?Element $lastElementChild;
    public int $childElementCount;
    public ?Element $previousElementSibling;
    public ?Element $nextElementSibling;

    public function setIdAttribute(string $qualifiedName, bool $isId): void {}

    public function setIdAttributeNS(?string $namespace, string $qualifiedName, bool $isId): void {}

    public function setIdAttributeNode(Attr $attr, bool $isId): void {}

    public function remove(): void {}

    public function before(Node|string ...$nodes): void {}

    public function after(Node|string ...$nodes): void {}

    public function replaceWith(Node|string ...$nodes): void {}

    public function append(Node|string ...$nodes): void {}

    public function prepend(Node|string ...$nodes): void {}

    public function replaceChildren(Node|string ...$nodes): void {}

    public function querySelector(string $selectors): ?Element {}

    /** @return NodeList<Element> */
    public function querySelectorAll(string $selectors): NodeList {}

    public function closest(string $selectors): ?Element {}

    public function matches(string $selectors): bool {}
    public string $innerHTML;
    public string $outerHTML;
    public string $substitutedNodeValue;

    /** @return list<NamespaceInfo> */
    public function getInScopeNamespaces(): array {}

    /** @return list<NamespaceInfo> */
    public function getDescendantNamespaces(): array {}

    public function rename(?string $namespaceURI, string $qualifiedName): void {}

    /**
     * @since 8.5
     */
    public function getElementsByClassName(string $classNames): HTMLCollection {}

    /**
     * @since 8.5
     */
    public function insertAdjacentHTML(\Dom\AdjacentPosition $where, string $string): void {}
}
/**
 * Represents an element in the HTML namespace.
 * @link https://php.net/manual/en/class.dom-htmlelement.php
 * @since 8.4
 */
class HTMLElement extends Element {}
/**
 * The Dom\Text class inherits from Dom\CharacterData and represents a text node.
 *
 * This is the modern, spec-compliant equivalent of DOMText.
 *
 * @link https://php.net/manual/en/class.dom-text.php
 * @since 8.4
 */
class Text extends CharacterData
{
    /**
     * Breaks this node into two nodes at the specified offset
     *
     * Breaks this node into two nodes at the specified offset, keeping both in the tree as
     * siblings.
     *
     * @link https://php.net/manual/en/dom-text.splittext.php
     * @param int $offset The offset at which to split, starting from 0.
     * @return Text The new node of the same type, which contains all the content at and after the
     * offset.
     */
    public function splitText(int $offset): Text {}
    public string $wholeText;
}
/**
 * Represents comment nodes, characters delimited by <!-- and -->.
 *
 * This is the modern, spec-compliant equivalent of DOMComment.
 *
 * @link https://php.net/manual/en/class.dom-comment.php
 * @since 8.4
 */
class Comment extends CharacterData {}
/**
 * The Dom\CDATASection class inherits from Dom\Text for textual representation of CData constructs.
 *
 * This is the modern, spec-compliant equivalent of DOMCdataSection.
 *
 * @link https://php.net/manual/en/class.dom-cdatasection.php
 * @since 8.4
 */
class CDATASection extends Text {}
/**
 * Each Dom\Document has a doctype attribute whose value is either null or a Dom\DocumentType
 * object.
 *
 * This is the modern, spec-compliant equivalent of DOMImplementation.
 *
 * @link https://php.net/manual/en/class.dom-documenttype.php
 * @since 8.4
 */
class DocumentType extends Node implements ChildNode
{
    public string $name;
    public DtdNamedNodeMap $entities;
    public DtdNamedNodeMap $notations;
    public string $publicId;
    public string $systemId;
    public ?string $internalSubset;

    public function remove(): void {}

    public function before(Node|string ...$nodes): void {}

    public function after(Node|string ...$nodes): void {}

    public function replaceWith(Node|string ...$nodes): void {}
}
/**
 * @since 8.4
 */
class Notation extends Node
{
    public string $publicId;
    public string $systemId;
}
/**
 * This interface represents a known entity, either parsed or unparsed, in an XML document.
 *
 * This is the modern, spec-compliant equivalent of DOMEntity.
 *
 * @link https://php.net/manual/en/class.dom-entity.php
 * @since 8.4
 */
class Entity extends Node
{
    public ?string $publicId;
    public ?string $systemId;
    public ?string $notationName;
}
/**
 * This is the modern, spec-compliant equivalent of DOMEntityReference.
 * @link https://php.net/manual/en/class.dom-entityreference.php
 * @since 8.4
 */
class EntityReference extends Node {}
/**
 * This represents a processing instruction (PI) node. These are meant to indicate data areas meant
 * for processing by specific applications.
 *
 * This is the modern, spec-compliant equivalent of DOMProcessingInstruction.
 *
 * @link https://php.net/manual/en/class.dom-processinginstruction.php
 * @since 8.4
 */
class ProcessingInstruction extends CharacterData
{
    public string $target;
}
/**
 * @since 8.4
 */
class Sqlite {}
/**
 * @since 8.4
 */
class RandomError {}
/**
 * @since 8.4
 */
class BrokenRandomEngineError {}
/**
 * @since 8.4
 */
class RandomException {}
/**
 * @since 8.4
 */
class Mysql {}
/**
 * Gets a Dom\Attr or Dom\Element object from a SimpleXMLElement object
 *
 * This function takes the given attribute or element node (a SimpleXMLElement instance) and creates
 * a Dom\Attr or Dom\Element node, respectively. The new Dom\Node refers to the same underlying XML
 * node as the SimpleXMLElement.
 *
 * @link https://php.net/manual/en/function.dom-ns-import-simplexml.php
 * @since 8.4
 */
function import_simplexml(object $node): Attr|Element {}

/**
 * @since 8.4
 */
const INDEX_SIZE_ERR = 1, STRING_SIZE_ERR = 2, HIERARCHY_REQUEST_ERR = 3, WRONG_DOCUMENT_ERR = 4, INVALID_CHARACTER_ERR = 5;
/**
 * @since 8.4
 */
const NO_DATA_ALLOWED_ERR = 6, NO_MODIFICATION_ALLOWED_ERR = 7, NOT_FOUND_ERR = 8, NOT_SUPPORTED_ERR = 9, INUSE_ATTRIBUTE_ERR = 10;
/**
 * @since 8.4
 */
const INVALID_STATE_ERR = 11, SYNTAX_ERR = 12, INVALID_MODIFICATION_ERR = 13, NAMESPACE_ERR = 14, VALIDATION_ERR = 16, HTML_NO_DEFAULT_NS = 2147483648;
