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

interface Collection extends Traversable, Countable, JsonSerializable
{
	public function copy(): Collection;

	public function toArray(): array;
}

final class Deque implements IteratorAggregate, ArrayAccess, Sequence
{
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
	 */
	public function merge($values): Deque
	{
	}

	public function filter(?callable $callback = null): Deque
	{
	}

	public function map(callable $callback): Deque
	{
	}

	public function reversed(): Deque
	{
	}

	public function slice(int $offset, ?int $length = null): Deque
	{
	}
}

final class Map implements IteratorAggregate, ArrayAccess, Collection
{
	public function copy(): Map
	{
	}

	/**
	 * @param iterable|null $values
	 */
	public function __construct($values = null)
	{
	}

	public function apply(callable $callback)
	{
	}

	/**
	 * @throws UnderflowException
	 */
	public function first(): Pair
	{
	}

	/**
	 * @throws UnderflowException
	 */
	public function last(): Pair
	{
	}

	/**
	 * @throws OutOfRangeException
	 */
	public function skip(int $position): Pair
	{
	}

	/**
	 * @param iterable $values
	 */
	public function merge($values): Map
	{
	}

	public function intersect(Map $map): Map
	{
	}

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

	public function filter(?callable $callback = null): Map
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

	public function keys(): Set
	{
	}

	public function map(callable $callback): Map
	{
	}

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

	public function reversed(): Map
	{
	}

	public function slice(int $offset, ?int $length = null): Map
	{
	}

	public function sort(?callable $comparator = null)
	{
	}

	public function sorted(?callable $comparator = null): Map
	{
	}

	public function ksort(?callable $comparator = null)
	{
	}

	public function ksorted(?callable $comparator = null): Map
	{
	}

	public function toArray(): array
	{
	}

	public function values(): Sequence
	{
	}

	public function union(Map $map): Map
	{
	}

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

	public function copy(): Pair
	{
	}
}

interface Sequence extends Collection
{
	public function apply(callable $callback);

	/**
	 * @param mixed ...$values
	 */
	public function contains(...$values): bool;

	public function filter(?callable $callback = null): Sequence;

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

	public function join(?string $glue = null): string;

	/**
	 * @return mixed
	 * @throws \UnderflowException
	 */
	public function last();

	public function map(callable $callback): Sequence;

	/**
	 * @param iterable $values
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
	 * @param mixed $initial
	 * @return mixed
	 */
	public function reduce(callable $callback, $initial = null);

	/**
	 * @return mixed
	 * @throws \OutOfRangeException
	 */
	public function remove(int $index);

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

	public function slice(int $index, ?int $length = null): Sequence;

	public function sort(?callable $comparator = null);

	public function sorted(?callable $comparator = null): Sequence;

	/**
	 * @param mixed ...$values
	 */
	public function unshift(...$values);
}


final class Vector implements IteratorAggregate, ArrayAccess, Sequence
{
	public function copy(): Vector
	{
	}

	/**
	 * @param iterable|null $values
	 */
	public function __construct($values = null)
	{
	}

	public function reversed(): Vector
	{
	}

	public function slice(int $offset, ?int $length = null): Sequence
	{
	}

	public function sorted(?callable $comparator = null): Vector
	{
	}

	public function filter(?callable $callback = null): Vector
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

	public function copy(): Set
	{
	}

	public function diff(Set $set): Set
	{
	}

	public function filter(?callable $callback = null): Set
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

	public function reversed(): Set
	{
	}

	public function slice(int $index, ?int $length = null): Set
	{
	}

	public function sort(?callable $comparator = null): void
	{
	}

	public function sorted(?callable $comparator = null): Set
	{
	}

	public function toArray(): array
	{
	}

	public function union(Set $set): Set
	{
	}

	public function xor(Set $set): Set
	{
	}
}
