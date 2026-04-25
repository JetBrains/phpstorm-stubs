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
 * @param iterable<TValue>|null $values
 * @return Seq<TValue>
 * @since PECL ds 2.0.0
 */
function seq($values = null): Seq {}

/**
 * Creates a map containing the given values.
 * @template TKey
 * @template TValue
 * @param iterable<TKey, TValue>|null $values
 * @return Map<TKey, TValue>
 * @since PECL ds 2.0.0
 */
function map($values = null): Map {}

/**
 * Creates a set containing the given values.
 * @template TValue
 * @param iterable<TValue>|null $values
 * @return Set<TValue>
 * @since PECL ds 2.0.0
 */
function set($values = null): Set {}

/**
 * Creates a heap containing the given values.
 * @template TValue
 * @param iterable<TValue>|null $values
 * @param null|callable(TValue, TValue): int $comparator
 * @return Heap<TValue>
 * @since PECL ds 2.0.0
 */
function heap($values = null, ?callable $comparator = null): Heap {}

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
     * @param iterable<TValue>|null $values
     */
    public function __construct($values = null) {}

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

    public function __unserialize($data): void {}

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
 */
final class Map implements Countable, IteratorAggregate, JsonSerializable, ArrayAccess
{
    public const MIN_CAPACITY = 8;

    /**
     * @param iterable<TKey, TValue>|null $values
     */
    public function __construct($values = null) {}

    public function allocate(int $capacity): void {}

    /**
     * @param callable(TKey, TValue): TValue $callback
     */
    public function apply(callable $callback): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /** @return Map<TKey, TValue> */
    public function copy(): Map {}

    public function count(): int {}

    /** @return Map<TKey, TValue> */
    public function diff(Map $map): Map {}

    /**
     * @param null|callable(TKey, TValue): bool $callback
     * @return Map<TKey, TValue>
     */
    public function filter(?callable $callback = null): Map {}

    /** @return Pair<TKey, TValue> */
    public function first(): Pair {}

    /**
     * @param TKey $key
     * @param TValue|null $default
     * @return TValue|null
     */
    public function get($key, $default = null) {}

    /** @return Traversable<TKey, TValue> */
    public function getIterator(): Traversable {}

    /** @param TKey $key */
    public function hasKey($key): bool {}

    /** @param TValue $value */
    public function hasValue($value): bool {}

    /** @return Map<TKey, TValue> */
    public function intersect(Map $map): Map {}

    public function isEmpty(): bool {}

    /** @return mixed */
    public function jsonSerialize(): mixed {}

    /** @return Set<TKey> */
    public function keys(): Set {}

    /** @param null|callable(TKey, TKey): int $comparator */
    public function ksort(?callable $comparator = null): void {}

    /**
     * @param null|callable(TKey, TKey): int $comparator
     * @return Map<TKey, TValue>
     */
    public function ksorted(?callable $comparator = null): Map {}

    /** @return Pair<TKey, TValue> */
    public function last(): Pair {}

    /**
     * @template TReturn
     * @param callable(TKey, TValue): TReturn $callback
     * @return Map<TKey, TReturn>
     */
    public function map(callable $callback): Map {}

    /**
     * @param iterable<TKey, TValue> $values
     * @return Map<TKey, TValue>
     */
    public function merge($values): Map {}

    /** @return Seq<Pair<TKey, TValue>> */
    public function pairs(): Seq {}

    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function put($key, $value): void {}

    /** @param iterable<TKey, TValue> $values */
    public function putAll($values): void {}

    /** @return mixed */
    public function reduce(callable $callback, $initial = null) {}

    /**
     * @param TKey $key
     * @param TValue|null $default
     * @return TValue|null
     */
    public function remove($key, $default = null) {}

    public function reverse(): void {}

    /** @return Map<TKey, TValue> */
    public function reversed(): Map {}

    /** @return Pair<TKey, TValue> */
    public function skip(int $position): Pair {}

    /** @return Map<TKey, TValue> */
    public function slice(int $index, ?int $length = null): Map {}

    /** @param null|callable(TValue, TValue): int $comparator */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param null|callable(TValue, TValue): int $comparator
     * @return Map<TKey, TValue>
     */
    public function sorted(?callable $comparator = null): Map {}

    /** @return int|float */
    public function sum() {}

    /** @return array<TKey, TValue> */
    public function toArray(): array {}

    /** @return Map<TKey, TValue> */
    public function union(Map $map): Map {}

    /** @return Seq<TValue> */
    public function values(): Seq {}

    /** @return Map<TKey, TValue> */
    public function xor(Map $map): Map {}

    public function __serialize(): array {}

    public function __unserialize($data): void {}

    public function offsetExists(mixed $offset): bool {}

    public function offsetGet(mixed $offset): mixed {}

    public function offsetSet(mixed $offset, mixed $value): void {}

    public function offsetUnset(mixed $offset): void {}
}

/**
 * @template TKey
 * @template TValue
 */
final readonly class Pair implements JsonSerializable
{
    /** @var TKey */
    public readonly mixed $key;

    /** @var TValue */
    public readonly mixed $value;

    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function __construct($key, $value) {}

    /** @return array{key: TKey, value: TValue} */
    public function jsonSerialize(): array {}

    /** @return array{key: TKey, value: TValue} */
    public function toArray(): array {}

    /** @return array{key: TKey, value: TValue} */
    public function __serialize(): array {}

    public function __unserialize($data): void {}
}

/**
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 * @implements ArrayAccess<int, TValue>
 */
final class Set implements Countable, IteratorAggregate, JsonSerializable, ArrayAccess
{
    public const MIN_CAPACITY = 8;

    /** @param iterable<TValue>|null $values */
    public function __construct($values = null) {}

    /** @param TValue ...$values */
    public function add(...$values): void {}

    public function allocate(int $capacity): void {}

    public function capacity(): int {}

    public function clear(): void {}

    /** @param TValue ...$values */
    public function contains(...$values): bool {}

    /** @return Set<TValue> */
    public function copy(): Set {}

    public function count(): int {}

    /** @return Set<TValue> */
    public function diff(Set $set): Set {}

    /**
     * @param null|callable(TValue): bool $callback
     * @return Set<TValue>
     */
    public function filter(?callable $callback = null): Set {}

    /** @return TValue */
    public function first() {}

    /** @return TValue */
    public function get(int $index) {}

    /** @return Traversable<int, TValue> */
    public function getIterator(): Traversable {}

    /** @return Set<TValue> */
    public function intersect(Set $set): Set {}

    public function isEmpty(): bool {}

    public function join(string $glue = ''): string {}

    /** @return array<int, TValue> */
    public function jsonSerialize(): array {}

    /** @return TValue */
    public function last() {}

    /**
     * @template TReturn
     * @param callable(TValue): TReturn $callback
     * @return Set<TReturn>
     */
    public function map(callable $callback): Set {}

    /**
     * @param iterable<TValue> $values
     * @return Set<TValue>
     */
    public function merge($values): Set {}

    /** @return mixed */
    public function reduce(callable $callback, $initial = null) {}

    /** @param TValue ...$values */
    public function remove(...$values): void {}

    public function reverse(): void {}

    /** @return Set<TValue> */
    public function reversed(): Set {}

    /** @return Set<TValue> */
    public function slice(int $index, ?int $length = null): Set {}

    /** @param null|callable(TValue, TValue): int $comparator */
    public function sort(?callable $comparator = null): void {}

    /**
     * @param null|callable(TValue, TValue): int $comparator
     * @return Set<TValue>
     */
    public function sorted(?callable $comparator = null): Set {}

    /** @return int|float */
    public function sum() {}

    /** @return array<int, TValue> */
    public function toArray(): array {}

    /** @return Set<TValue> */
    public function union(Set $set): Set {}

    /** @return Set<TValue> */
    public function xor(Set $set): Set {}

    public function __serialize(): array {}

    public function __unserialize($data): void {}

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
     * @param iterable<TValue>|null $values
     * @param null|callable(TValue, TValue): int $comparator
     */
    public function __construct($values = null, ?callable $comparator = null) {}

    public function allocate(int $capacity): void {}

    public function capacity(): int {}

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

    public function __unserialize($data): void {}
}
