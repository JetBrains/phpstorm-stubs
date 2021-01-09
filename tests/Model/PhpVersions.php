<?php
declare(strict_types=1);

namespace StubTests\Model;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use RuntimeException;

class PhpVersions implements ArrayAccess, IteratorAggregate
{
    private static array $versions = [5.3, 5.4, 5.5, 5.6, 7.0, 7.1, 7.2, 7.3, 7.4, 8.0];

    public static function getLatest()
    {
        return end(self::$versions);
    }

    public static function getFirst()
    {
        return self::$versions[0];
    }

    public function offsetExists($offset): bool
    {
        return isset(self::$versions[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? self::$versions[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('Unsupported operation');
    }

    public function offsetUnset($offset)
    {
        throw new RuntimeException('Unsupported operation');
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator(self::$versions);
    }
}
