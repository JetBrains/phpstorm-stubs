<?php
declare(strict_types=1);

namespace StubTests\Model;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use ReturnTypeWillChange;
use RuntimeException;

class PhpVersions implements ArrayAccess, IteratorAggregate
{
    private static $versions = [5.3, 5.4, 5.5, 5.6, 7.0, 7.1, 7.2, 7.3, 7.4, 8.0, 8.1];

    public static function getLatest()
    {
        return end(self::$versions);
    }

    public static function getFirst(): float
    {
        return self::$versions[0];
    }

    public function offsetExists($offset): bool
    {
        return isset(self::$versions[$offset]);
    }

    #[ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? self::$versions[$offset] : null;
    }

    #[ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('Unsupported operation');
    }

    #[ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        throw new RuntimeException('Unsupported operation');
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator(self::$versions);
    }
}
