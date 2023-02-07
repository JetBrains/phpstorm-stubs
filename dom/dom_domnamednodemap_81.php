<?php

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;
use JetBrains\PhpStorm\Internal\TentativeType;

/**
 * The DOMNamedNodeMap class
 * @link https://php.net/manual/en/class.domnamednodemap.php
 * @see https://github.com/JetBrains/phpstorm-stubs/pull/1526#issuecomment-1419394807
 *
 * @since 8.1
 */
class DOMNamedNodeMap implements IteratorAggregate, Countable
{
    /**
     * The number of nodes in the map. The range of valid child node indices is 0 to length - 1 inclusive.
     * @var int
     * @readonly
     */
    public $length;

    /**
     * Retrieves a node specified by name
     * @link https://php.net/manual/en/domnamednodemap.getnameditem.php
     * @param string $qualifiedName <p>
     * The nodeName of the node to retrieve.
     * </p>
     * @return DOMNode|null A node (of any type) with the specified nodeName, or
     * null if no node is found.
     */
    #[TentativeType]
    public function getNamedItem(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $qualifiedName): ?DOMNode
    {
    }

    /**
     * @param DOMNode $arg
     */
    public function setNamedItem(DOMNode $arg)
    {
    }

    /**
     * @param $name [optional]
     */
    public function removeNamedItem($name)
    {
    }

    /**
     * Retrieves a node specified by index
     * @link https://php.net/manual/en/domnamednodemap.item.php
     * @param int $index <p>
     * Index into this map.
     * </p>
     * @return DOMNode|null The node at the indexth position in the map, or null
     * if that is not a valid index (greater than or equal to the number of nodes
     * in this map).
     */
    #[TentativeType]
    public function item(
        #[PhpStormStubsElementAvailable(from: '5.3', to: '7.0')] $index = 0,
        #[PhpStormStubsElementAvailable(from: '7.1')] #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $index
    ): ?DOMNode {
    }

    /**
     * Retrieves a node specified by local name and namespace URI
     * @link https://php.net/manual/en/domnamednodemap.getnameditemns.php
     * @param string $namespace <p>
     * The namespace URI of the node to retrieve.
     * </p>
     * @param string $localName <p>
     * The local name of the node to retrieve.
     * </p>
     * @return DOMNode|null A node (of any type) with the specified local name and namespace URI, or
     * null if no node is found.
     */
    #[TentativeType]
    public function getNamedItemNS(
        #[PhpStormStubsElementAvailable(from: '5.3', to: '7.4')] $namespaceURI = '',
        #[PhpStormStubsElementAvailable(from: '8.0')] ?string $namespace,
        #[PhpStormStubsElementAvailable(from: '5.3', to: '7.4')] $localName = '',
        #[PhpStormStubsElementAvailable(from: '8.0')] string $localName
    ): ?DOMNode {
    }

    /**
     * @param DOMNode $arg [optional]
     */
    public function setNamedItemNS(DOMNode $arg)
    {
    }

    /**
     * @param $namespace [optional]
     * @param $localName [optional]
     */
    public function removeNamedItemNS($namespace, $localName)
    {
    }

    /**
     * @return int<0,max>
     * @since 7.2
     */
    #[TentativeType]
    public function count(): int
    {
    }

    /**
     * @return Iterator
     * @since 8.0
     */
    public function getIterator(): Iterator
    {
    }
}
