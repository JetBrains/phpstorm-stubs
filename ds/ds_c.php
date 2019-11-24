<?php

/**
 * PHP Data Structure PECL extension stubs
 * @version 1.0.0
 * @author dominic.guhl@posteo.de
 */

namespace Ds {

    /**
     * Collection is the base interface which covers functionality common to all
     * the data structures in this library. It guarantees that all structures
     * are traversable, countable, and can be converted to json using
     * json_encode().
     * @package Ds
     */
    abstract class Collection implements \Traversable, \Countable, \JsonSerializable {
        /**
         * Removes all values from the collection.
         *
         * @link https://www.php.net/manual/en/ds-collection.clear.php
         */
        abstract public function clear(): void;

        /**
         * Returns a shallow copy of the collection.
         * @return Collection
         */
        abstract public function copy(): Collection;

        /**
         * Returns whether the collection is empty.
         * @return bool
         */
        abstract public function isEmpty(): bool;

        /**
         * Converts the collection to an array.
         * <p>Note: Casting to an array is not supported yet.
         * @return array An array containing all the values in the same order as
         * the collection.
         */
        abstract public function toArray(): array;
    }

}