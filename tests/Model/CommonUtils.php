<?php

namespace StubTests\Model;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class CommonUtils
{
    /**
     * @param array $array
     * @param bool $group
     * @return array
     */
    public static function flattenArray(array $array, $group)
    {
        return iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($array)), $group);
    }

    /**
     * @template T
     * @template S
     *
     * @param list<T> $array
     * @param callable(T): list<S> $callback
     * @return list<S>
     */
    public static function array_flat_map(array $array, callable $callback) {
        return array_merge(...array_map($callback, $array));
    }
}
