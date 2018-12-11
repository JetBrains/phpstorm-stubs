<?php

namespace StubTests\Parsers;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Utils
{
    public static function flattenArray(array $arr, bool $group)
    {
        return iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($arr)), $group);
    }
}
