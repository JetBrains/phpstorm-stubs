<?php

/**
 * PHP Data Structure stubs, a PECL extension
 * @version 2.0.0
 * @author Dominic Guhl <dominic.guhl@posteo.de>
 * @copyright © 2019 PHP Documentation Group
 * @license CC-BY 3.0, https://www.php.net/manual/en/cc.license.php
 */

namespace Ds;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

/**
 * Creates a sequence containing the given values.
 * @template TValue
 * @param iterable<TValue> $values
 * @return Seq<TValue>
 * @since PECL ds 2.0.0
 */
function seq(iterable $values = []): Seq {}

/**
 * Creates a map containing the given values.
 * @template TKey
 * @template TValue
 * @param iterable<TKey, TValue> $values
 * @return Map<TKey, TValue>
 * @since PECL ds 2.0.0
 */
function map(iterable $values = []): Map {}

/**
 * Creates a set containing the given values.
 * @template TValue
 * @param iterable<TValue> $values
 * @return Set<TValue>
 * @since PECL ds 2.0.0
 */
function set(iterable $values = []): Set {}

/**
 * Creates a heap containing the given values.
 * @template TValue
 * @param iterable<TValue> $values
 * @param null|callable(TValue, TValue): int $comparator
 * @return Heap<TValue>
 * @since PECL ds 2.0.0
 */
function heap(iterable $values = [], ?callable $comparator = null): Heap {}

/**
 * Key allows objects to define custom equality when used as map keys or set values.
 * @since PECL ds 2.0.0
 */
interface Key
{
    /**
     * Determines whether another value is equal to this instance.
     * @param mixed $other
     */
    public function equals($other): bool;

    /**
     * Returns a value used as this object's hash.
     * @return mixed
     */
    public function hash();
}

/**
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 * @implements ArrayAccess<int, TValue>
 * @since PECL ds 2.0.0
 */
final class Seq implements Countable, IteratorAggregate, JsonSerializable, ArrayAccess
{
    public const MIN_CAPACITY = 8;

    /**
     * @param iterable<TValue> $values
     */
    public function __construct(iterable $values = []) {}

    public function allocate(int $capacity): void {}

    /**
     * @param callable(TValue): TValue $callback
     */
    public function apply(callable $callback): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /**
     * @param TValue ...$values
     */
    public function contains(...$values): bool {}

    /**
     * @return Seq<TValue>
     */
    public function copy(): Seq {}

    public function count(): int {}

    /**
     * @param null|callable(TValue): bool $callback
     * @return Seq<TValue>
     */
    public function filter(?callable $callback = null): Seq {}

    /**
     * @param TValue $value
     * @return int|false
     */
    public function find($value) {}

    /**
     * @return TValue
     */
    public function first() {}

    /**
     * @return Traversable<int, TValue>
     */
    public function getIterator(): Traversable {}

    /**
     * @return TValue
     */
    public function get(int $index) {}

    /**
     * @param TValue ...$values
     */
    public function insert(int $index, ...$values): void {}

    public function isEmpty(): bool {}

    public function join(string $glue = ''): string {}

    /**
     * @return array<int, TValue>
     */
    public function jsonSerialize(): array {}

    /**
     * @return TValue
     */
    public function last() {}

    /**
     * @template TReturn
     * @param callable(TValue): TReturn $callback
     * @return Seq<TReturn>
     */
    public function map(callable $callback): Seq {}

    /**
     * @param iterable<TValue> $values
     * @return Seq<TValue>
     */
    public function merge($values): Seq {}

    /**
     * @return TValue
     */
    public function pop() {}

    /**
     * @param TValue ...$values
     */
    public function push(...$values): void {}

    /**
     * @template TInitial
     * @template TReturn
     * @param callable(TInitial|TReturn|null, TValue): TReturn $callback
     * @param TInitial|null $initial
     * @return TReturn|null
     */
    public function reduce(callable $callback, $initial = null) {}

    /**
     * @return TValue
     */
    public function remove(int $index) {}

    public function reverse(): void {}

    /**
     * @return Seq<TValue>
     */
    public function reversed(): Seq {}

    public function rotate(int $rotations): void {}

    /**
     * @param TValue $value
     */
    public function set(int $index, $value): void {}

    /**
     * @return TValue
     */
    public function shift() {}

    /**
     * @return Seq<TValue>
     */
    public function slice(int $index, ?int $length = null): Seq {}

    /**
     * @param null|callable(TValue, TValue): int $comparator
     */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param null|callable(TValue, TValue): int $comparator
     * @return Seq<TValue>
     */
    public function sorted(?callable $comparator = null): Seq {}

    /**
     * @return int|float
     */
    public function sum() {}

    /**
     * @return array<int, TValue>
     */
    public function toArray(): array {}

    /**
     * @param TValue ...$values
     */
    public function unshift(...$values): void {}

    /**
     * @return array<int, TValue>
     */
    public function __serialize(): array {}

    public function __unserialize(array $data): void {}

    public function offsetExists(mixed $offset): bool {}

    public function offsetGet(mixed $offset): mixed {}

    public function offsetSet(mixed $offset, mixed $value): void {}

    public function offsetUnset(mixed $offset): void {}
}

/**
 * @template TKey
 * @template TValue
 * @implements IteratorAggregate<TKey, TValue>
 * @implements ArrayAccess<TKey, TValue>
 * @since PECL ds 2.0.0
 */
final class Map implements Countable, IteratorAggregate, JsonSerializable, ArrayAccess
{
    public const MIN_CAPACITY = 8;

    /**
     * @param iterable<TKey, TValue> $values A traversable object or an array to use for the initial
     * values.
     */
    public function __construct(iterable $values = []) {}

    public function allocate(int $capacity): void {}

    /**
     * @param callable(TKey, TValue): TValue $callback
     * <code>callback ( mixed $key , mixed $value ): mixed</code>
     * <br/>A callable to apply to each value in the map. The callback should return what the value
     * should be replaced by.
     */
    public function apply(callable $callback): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /**
     * @return Map<TKey, TValue> Returns a shallow copy of the map.
     */
    public function copy(): Map {}

    public function count(): int {}

    /**
     * @return Map<TKey, TValue> The result of removing all keys from the current instance that are
     * present in a given map.
     */
    public function diff(Map $map): Map {}

    /**
     * @param null|callable(TKey, TValue): bool $callback
     * <code>callback ( mixed $key , mixed $value ): bool</code>
     * <br/>Optional callable which returns true if the pair should be included, false otherwise. If
     * a callback is not provided, only values which are true (see converting to boolean) will be
     * included.
     * @return Map<TKey, TValue> A new map containing all the pairs for which either the callback
     * returned true, or all values that convert to true if a callback was not provided.
     */
    public function filter(?callable $callback = null): Map {}

    /**
     * @return Pair<TKey, TValue> The first pair in the map.
     */
    public function first(): Pair {}

    /**
     * @param TKey $key The key to look up.
     * @param TValue|null $default The optional default value, returned if the key could not be
     * found.
     * @return TValue|null The value mapped to the given key, or the default value if provided and
     * the key could not be found in the map.
     */
    public function get($key, $default = null) {}

    /** @return Traversable<TKey, TValue> */
    public function getIterator(): Traversable {}

    /**
     * @param TKey $key The key to look for.
     */
    public function hasKey($key): bool {}

    /**
     * @param TValue $value The value to look for.
     */
    public function hasValue($value): bool {}

    /**
     * @return Map<TKey, TValue> The key intersection of the current instance and another map.
     */
    public function intersect(Map $map): Map {}

    public function isEmpty(): bool {}

    /** @return mixed */
    public function jsonSerialize(): mixed {}

    /**
     * @return Set<TKey> A Ds\Set containing all the keys of the map.
     */
    public function keys(): Set {}

    /**
     * @param null|callable(TKey, TKey): int $comparator The comparison function must return an
     * integer less than, equal to, or greater than zero if the first argument is considered to be
     * respectively less than, equal to, or greater than the second. Returning non-integer values
     * from the comparison function, such as float, will result in an internal cast to int of the
     * callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value
     * of 0, which will compare such values as equal.
     */
    public function ksort(?callable $comparator = null): void {}

    /**
     * @param null|callable(TKey, TKey): int $comparator The comparison function must return an
     * integer less than, equal to, or greater than zero if the first argument is considered to be
     * respectively less than, equal to, or greater than the second. Returning non-integer values
     * from the comparison function, such as float, will result in an internal cast to int of the
     * callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value
     * of 0, which will compare such values as equal.
     * @return Map<TKey, TValue> Returns a copy of the map, sorted by key.
     */
    public function ksorted(?callable $comparator = null): Map {}

    /**
     * @return Pair<TKey, TValue> The last pair of the map.
     */
    public function last(): Pair {}

    /**
     * @template TReturn
     * @param callable(TKey, TValue): TReturn $callback
     * <code>callback ( mixed $key , mixed $value ): mixed</code>
     * <br/>A callable to apply to each value in the map. The callable should return what the key
     * will be mapped to in the resulting map.
     * @return Map<TKey, TReturn> The result of applying a callback to each value in the map. The
     * keys and values of the current instance won't be affected.
     */
    public function map(callable $callback): Map {}

    /**
     * @param iterable<TKey, TValue> $values A traversable object or an array.
     * @return Map<TKey, TValue> The result of associating all keys of a given traversable object or
     * array with their corresponding values, combined with the current instance. The current
     * instance won't be affected.
     */
    public function merge($values): Map {}

    /**
     * @return Seq<Pair<TKey, TValue>> Ds\Sequence containing all the pairs of the map.
     */
    public function pairs(): Seq {}

    /**
     * @param TKey $key The key to associate the value with.
     * @param TValue $value The value to be associated with the key.
     */
    public function put($key, $value): void {}

    /** @param iterable<TKey, TValue> $values */
    public function putAll($values): void {}

    /**
     * @template TInitial
     * @template TReturn
     * @param callable(TInitial|TReturn|null, TKey, TValue): TReturn $callback
     * <code>callback ( mixed $carry , mixed $key , mixed $value ): mixed</code>
     * <br/>$carry - The return value of the previous callback, or initial if it's the first
     * iteration.
     * <br/>$key - The key of the current iteration.
     * <br/>$value - The value of the current iteration.
     * @param TInitial|null $initial The initial value of the carry value. Can be null.
     * @return TReturn|null The return value of the final callback.
     */
    public function reduce(callable $callback, $initial = null) {}

    /**
     * @param TKey $key The key to remove.
     * @param TValue|null $default The optional default value, returned if the key could not be
     * found.
     * @return TValue|null The value that was removed, or the default value if provided and the key
     * could not be found in the map.
     */
    public function remove($key, $default = null) {}

    public function reverse(): void {}

    /**
     * @return Map<TKey, TValue> A reversed copy of the map. The current instance is not affected.
     */
    public function reversed(): Map {}

    /**
     * @return Pair<TKey, TValue> Returns the Ds\Pair at the given position.
     */
    public function skip(int $position): Pair {}

    /**
     * @return Map<TKey, TValue> A subset of the map defined by a starting index and length.
     */
    public function slice(int $index, ?int $length = null): Map {}

    /**
     * @param null|callable(TValue, TValue): int $comparator The comparison function must return an
     * integer less than, equal to, or greater than zero if the first argument is considered to be
     * respectively less than, equal to, or greater than the second. Returning non-integer values
     * from the comparison function, such as float, will result in an internal cast to int of the
     * callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value
     * of 0, which will compare such values as equal.
     */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param null|callable(TValue, TValue): int $comparator The comparison function must return an
     * integer less than, equal to, or greater than zero if the first argument is considered to be
     * respectively less than, equal to, or greater than the second. Returning non-integer values
     * from the comparison function, such as float, will result in an internal cast to int of the
     * callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value
     * of 0, which will compare such values as equal.
     * @return Map<TKey, TValue> Returns a copy of the map, sorted by value.
     */
    public function sorted(?callable $comparator = null): Map {}

    /**
     * @return int|float The sum of all the values in the map as either a float or int depending on
     * the values in the map.
     */
    public function sum() {}

    /**
     * @return array<TKey, TValue> An array containing all the values in the same order as the map.
     */
    public function toArray(): array {}

    /**
     * @return Map<TKey, TValue> A new map containing all the pairs of the current instance as well
     * as another map.
     */
    public function union(Map $map): Map {}

    /**
     * @return Seq<TValue> A Ds\Sequence containing all the values of the map.
     */
    public function values(): Seq {}

    /**
     * @return Map<TKey, TValue> A new map containing keys in the current instance as well as
     * another map, but not in both.
     */
    public function xor(Map $map): Map {}

    public function __serialize(): array {}

    public function __unserialize(array $data): void {}

    public function offsetExists(mixed $offset): bool {}

    public function &offsetGet(mixed $offset): mixed {}

    public function offsetSet(mixed $offset, mixed $value): void {}

    public function offsetUnset(mixed $offset): void {}
}

/**
 * @template TKey
 * @template TValue
 * @since PECL ds 2.0.0
 */
final readonly class Pair implements JsonSerializable
{
    /** @var TKey */
    public mixed $key;

    /** @var TValue */
    public mixed $value;

    /**
     * @param TKey $key The key.
     * @param TValue $value The value.
     */
    public function __construct($key, $value) {}

    /** @return array{key: TKey, value: TValue} */
    public function jsonSerialize(): array {}

    /**
     * @return array{key: TKey, value: TValue} An array containing all the values in the same order
     * as the pair.
     */
    public function toArray(): array {}

    /** @return array{key: TKey, value: TValue} */
    public function __serialize(): array {}

    public function __unserialize(array $data): void {}
}

/**
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 * @implements ArrayAccess<int, TValue>
 * @since PECL ds 2.0.0
 */
final class Set implements Countable, IteratorAggregate, JsonSerializable, ArrayAccess
{
    public const MIN_CAPACITY = 8;

    /**
     * @param iterable<TValue> $values A traversable object or an array to use for the initial
     * values.
     */
    public function __construct(iterable $values = []) {}

    /**
     * @param TValue ...$values Values to add to the set.
     */
    public function add(...$values): void {}

    public function allocate(int $capacity): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /**
     * @param TValue ...$values Values to check.
     */
    public function contains(...$values): bool {}

    /**
     * @return Set<TValue> Returns a shallow copy of the set.
     */
    public function copy(): Set {}

    public function count(): int {}

    /**
     * @return Set<TValue> A new set containing all values that were not in the other set.
     */
    public function diff(Set $set): Set {}

    /**
     * @param null|callable(TValue): bool $callback
     * <code>callback ( mixed $value ): bool</code>
     * <br/>Optional callable which returns true if the value should be included, false otherwise.
     * If a callback is not provided, only values which are true (see converting to boolean) will be
     * included.
     * @return Set<TValue> A new set containing all the values for which either the callback
     * returned true, or all values that convert to true if a callback was not provided.
     */
    public function filter(?callable $callback = null): Set {}

    /**
     * @return TValue The first value in the set.
     */
    public function first() {}

    /**
     * @return TValue The value at the requested index.
     */
    public function get(int $index) {}

    /** @return Traversable<int, TValue> */
    public function getIterator(): Traversable {}

    /**
     * @return Set<TValue> The intersection of the current instance and another set.
     */
    public function intersect(Set $set): Set {}

    public function isEmpty(): bool {}

    public function join(string $glue = ''): string {}

    /** @return array<int, TValue> */
    public function jsonSerialize(): array {}

    /**
     * @return TValue The last value in the set.
     */
    public function last() {}

    /**
     * @template TReturn
     * @param callable(TValue): TReturn $callback The callback to apply to each value in the set
     * must have the following signature:
     * <code>callback ( mixed $value ): mixed</code>
     * @return Set<TReturn> Returns a new Ds\Set instance where each value is the result of applying
     * the callback to each value of the set.
     */
    public function map(callable $callback): Set {}

    /**
     * @param iterable<TValue> $values A traversable object or an array.
     * @return Set<TValue> The result of adding all given values to the set, effectively the same as
     * adding the values to a copy, then returning that copy. The current instance won't be
     * affected.
     */
    public function merge($values): Set {}

    /**
     * @template TInitial
     * @template TReturn
     * @param callable(TInitial|TReturn|null, TValue): TReturn $callback
     * <code>callback ( mixed $carry , mixed $value ): mixed</code>
     * <br/>$carry - The return value of the previous callback, or initial if it's the first
     * iteration.
     * <br/>$value - The value of the current iteration.
     * @param TInitial|null $initial The initial value of the carry value. Can be null.
     * @return TReturn|null The return value of the final callback.
     */
    public function reduce(callable $callback, $initial = null) {}

    /**
     * @param TValue ...$values The values to remove.
     */
    public function remove(...$values): void {}

    public function reverse(): void {}

    /**
     * @return Set<TValue> A reversed copy of the set. The current instance is not affected.
     */
    public function reversed(): Set {}

    /**
     * @return Set<TValue> A sub-set of the given range.
     */
    public function slice(int $index, ?int $length = null): Set {}

    /**
     * @param null|callable(TValue, TValue): int $comparator The comparison function must return an
     * integer less than, equal to, or greater than zero if the first argument is considered to be
     * respectively less than, equal to, or greater than the second. Returning non-integer values
     * from the comparison function, such as float, will result in an internal cast to int of the
     * callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value
     * of 0, which will compare such values as equal.
     */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param null|callable(TValue, TValue): int $comparator The comparison function must return an
     * integer less than, equal to, or greater than zero if the first argument is considered to be
     * respectively less than, equal to, or greater than the second. Returning non-integer values
     * from the comparison function, such as float, will result in an internal cast to int of the
     * callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value
     * of 0, which will compare such values as equal.
     * @return Set<TValue> Returns a sorted copy of the set.
     */
    public function sorted(?callable $comparator = null): Set {}

    /**
     * @return int|float The sum of all the values in the set as either a float or int depending on
     * the values in the set.
     */
    public function sum() {}

    /**
     * @return array<int, TValue> An array containing all the values in the same order as the set.
     */
    public function toArray(): array {}

    /**
     * @return Set<TValue> A new set containing all the values of the current instance as well as
     * another set.
     */
    public function union(Set $set): Set {}

    /**
     * @return Set<TValue> A new set containing values in the current instance as well as another
     * set, but not in both.
     */
    public function xor(Set $set): Set {}

    public function __serialize(): array {}

    public function __unserialize(array $data): void {}

    public function offsetExists(mixed $offset): bool {}

    public function offsetGet(mixed $offset): mixed {}

    public function offsetSet(mixed $offset, mixed $value): void {}

    public function offsetUnset(mixed $offset): void {}
}

/**
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 * @since PECL ds 2.0.0
 */
final class Heap implements Countable, IteratorAggregate, JsonSerializable
{
    public const MIN_CAPACITY = 8;

    /**
     * @param iterable<TValue> $values
     * @param null|callable(TValue, TValue): int $comparator
     */
    public function __construct(iterable $values = [], ?callable $comparator = null) {}

    public function clear(): void {}

    /** @return Heap<TValue> */
    public function copy(): Heap {}

    public function count(): int {}

    /** @return Traversable<int, TValue> */
    public function getIterator(): Traversable {}

    public function isEmpty(): bool {}

    /** @return array<int, TValue> */
    public function jsonSerialize(): array {}

    /** @return TValue */
    public function peek() {}

    /** @return TValue */
    public function pop() {}

    /** @param TValue ...$values */
    public function push(...$values): void {}

    /** @return array<int, TValue> */
    public function toArray(): array {}

    /** @return array<int, TValue> */
    public function __serialize(): array {}

    public function __unserialize(array $data): void {}
}
