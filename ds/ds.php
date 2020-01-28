<?php

/**
 * Stubs for the ds extension: https://pecl.php.net/package/ds
 * Copied from PHPStan: https://github.com/phpstan/phpstan-src/blob/master/stubs/ext-ds.stub
 */

namespace Ds;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use OutOfBoundsException;
use OutOfRangeException;
use Traversable;
use UnderflowException;

/**
 * @extends Traversable
 */
interface Collection extends Traversable, Countable, JsonSerializable
{
    /**
     * @return Collection
     */
    public function copy(): Collection;

    /**
     * @return array
     */
    public function toArray(): array;
}

final class Deque implements IteratorAggregate, ArrayAccess, Sequence
{
    /**
     * @return Deque
     */
    public function copy(): Deque
    {
    }

    /**
     * @param iterable|null $values
     */
    public function __construct($values = null)
    {
    }

    /**
     * @param iterable $values
     * @return Deque
     */
    public function merge($values): Deque
    {
    }

    /**
     * @param callable|null $callback
     * @return Deque
     */
    public function filter(callable $callback = null): Deque
    {
    }

    /**
     * @param callable $callback
     * @return Deque
     */
    public function map(callable $callback): Deque
    {
    }

    /**
     * @return Deque
     */
    public function reversed(): Deque
    {
    }

    /**
     * @return Deque
     */
    public function slice(int $offset, ?int $length = null): Deque
    {
    }
}

final class Map implements IteratorAggregate, ArrayAccess, Collection
{
    /**
     * @return Map
     */
    public function copy(): Map
    {
    }

    /**
     * @param iterable|null $values
     */
    public function __construct($values = null)
    {
    }

    /**
     * @param callable $callback
     */
    public function apply(callable $callback)
    {
    }

    /**
     * @return Pair
     * @throws UnderflowException
     */
    public function first(): Pair
    {
    }

    /**
     * @return Pair
     * @throws UnderflowException
     */
    public function last(): Pair
    {
    }

    /**
     * @return Pair
     * @throws OutOfRangeException
     */
    public function skip(int $position): Pair
    {
    }

    /**
     * @param iterable $values
     * @return Map
     */
    public function merge($values): Map
    {
    }

    /**
     * @param Map $map
     * @return Map
     */
    public function intersect(Map $map): Map
    {
    }

    /**
     * @param Map $map
     * @return Map
     */
    public function diff(Map $map): Map
    {
    }

    /**
     * @param mixed $key
     */
    public function hasKey($key): bool
    {
    }

    /**
     * @param mixed $value
     */
    public function hasValue($value): bool
    {
    }

    /**
     * @param callable|null $callback
     * @return Map
     */
    public function filter(callable $callback = null): Map
    {
    }

    /**
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     * @throws OutOfBoundsException
     */
    public function get($key, $default = null)
    {
    }

    /**
     * @return Set
     */
    public function keys(): Set
    {
    }

    /**
     * @param callable $callback
     * @return Map
     */
    public function map(callable $callback): Map
    {
    }

    /**
     * @return Sequence
     */
    public function pairs(): Sequence
    {
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function put($key, $value)
    {
    }

    /**
     * @param iterable $values
     */
    public function putAll($values)
    {
    }

    /**
     * @param callable $callback
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null)
    {
    }

    /**
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     * @throws \OutOfBoundsException
     */
    public function remove($key, $default = null)
    {
    }

    /**
     * @return Map
     */
    public function reversed(): Map
    {
    }

    /**
     * @return Map
     */
    public function slice(int $offset, ?int $length = null): Map
    {
    }

    /**
     * @param callable|null $comparator
     */
    public function sort(callable $comparator = null)
    {
    }

    /**
     * @param callable|null $comparator
     * @return Map
     */
    public function sorted(callable $comparator = null): Map
    {
    }

    /**
     * @param callable|null $comparator
     */
    public function ksort(callable $comparator = null)
    {
    }

    /**
     * @param callable|null $comparator
     * @return Map
     */
    public function ksorted(callable $comparator = null): Map
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
    }

    /**
     * @return Sequence
     */
    public function values(): Sequence
    {
    }

    /**
     * @param Map $map
     * @return Map
     */
    public function union(Map $map): Map
    {
    }

    /**
     * @param Map $map
     * @return Map
     */
    public function xor(Map $map): Map
    {
    }
}

final class Pair implements JsonSerializable
{
    /**
     * @var mixed
     */
    public $key;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function __construct($key = null, $value = null)
    {
    }

    /**
     * @return Pair
     */
    public function copy(): Pair
    {
    }
}

/**
 * @extends Collection
 */
interface Sequence extends Collection
{
    /**
     * @param callable $callback
     */
    public function apply(callable $callback);

    /**
     * @param mixed ...$values
     */
    public function contains(...$values): bool;

    /**
     * @param callable|null $callback
     * @return Sequence
     */
    public function filter(callable $callback = null): Sequence;

    /**
     * @param mixed $value
     * @return int|false
     */
    public function find($value);

    /**
     * @return mixed
     * @throws \UnderflowException
     */
    public function first();

    /**
     * @return mixed
     * @throws \OutOfRangeException
     */
    public function get(int $index);

    /**
     * @param mixed ...$values
     * @throws \OutOfRangeException
     */
    public function insert(int $index, ...$values);

    /**
     * @param string $glue
     * @return string
     */
    public function join(string $glue = null): string;

    /**
     * @return mixed
     * @throws \UnderflowException
     */
    public function last();

    /**
     * @param callable $callback
     * @return Sequence
     */
    public function map(callable $callback): Sequence;

    /**
     * @param iterable $values
     * @return Sequence
     */
    public function merge($values): Sequence;

    /**
     * @return mixed
     * @throws \UnderflowException
     */
    public function pop();

    /**
     * @param mixed ...$values
     */
    public function push(...$values);

    /**
     * @param callable $callback
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null);

    /**
     * @return mixed
     * @throws \OutOfRangeException
     */
    public function remove(int $index);

    /**
     * @return Sequence
     */
    public function reversed(): Sequence;

    /**
     * @param mixed $value
     * @throws \OutOfRangeException
     */
    public function set(int $index, $value);

    /**
     * @return mixed
     * @throws \UnderflowException
     */
    public function shift();

    /**
     * @return Sequence
     */
    public function slice(int $index, ?int $length = null): Sequence;

    /**
     * @param callable|null $comparator
     */
    public function sort(callable $comparator = null);

    /**
     * @param callable|null $comparator
     * @return Sequence
     */
    public function sorted(callable $comparator = null): Sequence;

    /**
     * @param mixed ...$values
     */
    public function unshift(...$values);
}


final class Vector implements IteratorAggregate, ArrayAccess, Sequence
{
    /**
     * @return Vector
     */
    public function copy(): Vector
    {
    }

    /**
     * @param iterable|null $values
     */
    public function __construct($values = null)
    {
    }

    /**
     * @return Vector
     */
    public function reversed(): Vector
    {
    }

    /**
     * @return Vector
     */
    public function slice(int $offset, ?int $length = null): Sequence
    {
    }

    /**
     * @param callable|null $comparator
     * @return Vector
     */
    public function sorted(callable $comparator = null): Vector
    {
    }

    /**
     * @param callable|null $callback
     * @return Vector
     */
    public function filter(callable $callback = null): Vector
    {
    }
}

final class Set implements ArrayAccess, Collection, Traversable
{
    /**
     * @param mixed ...$values
     */
    public function add(...$values): void
    {
    }

    /**
     * @param iterable|null $values
     */
    public function __construct($values = null)
    {
    }

    /**
     * @param mixed ...$values
     */
    public function contains(...$values): bool
    {
    }

    /**
     * @return Set
     */
    public function copy(): Set
    {
    }

    /**
     * @param Set $set
     * @return Set
     */
    public function diff(Set $set): Set
    {
    }

    /**
     * @param callable|null $callback
     * @return Set
     */
    public function filter(callable $callback = null): Set
    {
    }

    /**
     * @return mixed
     * @throws \UnderflowException
     */
    public function first()
    {
    }

    /**
     * @return mixed
     * @throws \OutOfRangeException
     */
    public function get(int $index)
    {
    }

    /**
     * @param Set $set
     * @return Set
     */
    public function intersect(Set $set): Set
    {
    }

    /**
     * @return mixed
     * @throws \UnderflowException
     */
    public function last()
    {
    }

    /**
     * @param iterable $values
     * @return Set
     */
    public function merge($values): Set
    {
    }

    /**
     * @param mixed ...$values
     */
    public function remove(...$values): void
    {
    }

    /**
     * @return Set
     */
    public function reversed(): Set
    {
    }

    /**
     * @return Set
     */
    public function slice(int $index, ?int $length = null): Set
    {
    }

    /**
     * @param callable|null $comparator
     */
    public function sort(callable $comparator = null): void
    {
    }

    /**
     * @param callable|null $comparator
     * @return Set
     */
    public function sorted(callable $comparator = null): Set
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
    }

    /**
     * @param Set $set
     * @return Set
     */
    public function union(Set $set): Set
    {
    }

    /**
     * @param Set $set
     * @return Set
     */
    public function xor(Set $set): Set
    {
    }
}
