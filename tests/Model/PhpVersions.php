<?php
declare(strict_types=1);

namespace StubTests\Model;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use RuntimeException;

/**
 * @property-read $firstSupported
 * @property-read $latestSupported
 */
class PhpVersions implements ArrayAccess, IteratorAggregate
{
    private array $versions = [5.3, 5.4, 5.5, 5.6, 7.0, 7.1, 7.2, 7.3, 7.4, 8.0];

    public function __get(string $name)
    {
        return match ($name) {
            'firstSupported' => $this->versions[0],
            'latestSupported' => end($this->versions),
            default => throw new RuntimeException('Incorrect php version')
        };
    }

    public function offsetExists($offset): bool
    {
        return isset($this->versions[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->versions[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->versions[] = $value;
        } else {
            $this->versions[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->versions[$offset]);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->versions);
    }
}