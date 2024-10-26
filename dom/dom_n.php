<?php

namespace Dom;

/**
 * @since 8.4
 */
class Implementation {}

/**
 * @since 8.4
 */
final readonly class NamespaceInfo {}

/**
 * @since 8.4
 */
class NodeList implements \IteratorAggregate, \Countable {}
/**
 * @since 8.4
 */
class NamedNodeMap implements \IteratorAggregate, \Countable {}
/**
 * @since 8.4
 */
class DtdNamedNodeMap implements \IteratorAggregate, \Countable {}
/**
 * @since 8.4
 */
class HTMLCollection implements \IteratorAggregate, \Countable {}
/**
 * @since 8.4
 */
final class XPath {}
/**
 * @since 8.4
 */
final class TokenList implements \IteratorAggregate, \Countable {}
/**
 * @since 8.4
 */
interface ParentNode {}
/**
 * @since 8.4
 */
interface ChildNode {}
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
 * @since 8.4
 */
class Node {}
/**
 * @since 8.4
 */
class DocumentFragment extends Node implements ParentNode {}
/**
 * @since 8.4
 */
class Document extends Node implements ParentNode {}
/**
 * @since 8.4
 */
final class HTMLDocument extends Document {}
/**
 * @since 8.4
 */
final class XMLDocument extends Document {}
/**
 * @since 8.4
 */
class CharacterData extends Node implements ChildNode {}
/**
 * @since 8.4
 */
class Attr extends Node {}
/**
 * @since 8.4
 */
class Element extends Node implements ParentNode, ChildNode {}
/**
 * @since 8.4
 */
class HTMLElement extends Element {}
/**
 * @since 8.4
 */
class Text extends CharacterData {}
/**
 * @since 8.4
 */
class Comment extends CharacterData {}
/**
 * @since 8.4
 */
class CDATASection extends Text {}
/**
 * @since 8.4
 */
class DocumentType extends Node implements ChildNode {}
/**
 * @since 8.4
 */
class Notation extends Node {}
/**
 * @since 8.4
 */
class Entity extends Node {}
/**
 * @since 8.4
 */
class EntityReference extends Node {}
/**
 * @since 8.4
 */
class ProcessingInstruction extends CharacterData {}
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
