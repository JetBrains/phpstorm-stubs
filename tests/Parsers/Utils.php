<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Utils
{
    public static function flattenArray(array $arr, bool $group)
    {
        return iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($arr)), $group);
    }

    /**
     * @param Since|Deprecated $tag
     * @return bool
     */
    public static function versionIsMajor($tag): bool
    {
        return (bool)preg_match('/[1-9]+\.\d+/',$tag->getVersion());
    }
}
