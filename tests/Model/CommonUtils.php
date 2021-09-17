<?php
declare(strict_types=1);

namespace StubTests\Model;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class CommonUtils
{
    public static function flattenArray(array $array, bool $group): array
    {
        return iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($array)), $group);
    }
}
