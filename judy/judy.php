<?php

// Start of judy.

/**
 * Return the PHP Judy extension version string.
 * @link https://github.com/orieg/php-judy/blob/main/API.md
 */
function judy_version(): string {}

/**
 * Return the Judy type constant for the given array.
 * @link https://github.com/orieg/php-judy/blob/main/API.md
 * @param mixed $array A Judy object to inspect.
 * @return int One of the Judy type constants.
 */
function judy_type(mixed $array): int {}

/**
 * Judy arrays are fast, memory-efficient, ordered sparse dynamic arrays.
 * A Judy object can be accessed like a PHP array and iterated with foreach.
 * @link https://github.com/orieg/php-judy/blob/main/API.md
 */
class Judy implements ArrayAccess, Countable, Iterator, JsonSerializable
{
    /**
     * Judy array as a bitset, with integer keys and boolean values.
     */
    public const BITSET = 1;

    /**
     * Judy array with integer keys and integer values.
     */
    public const INT_TO_INT = 2;

    /**
     * Judy array with integer keys and values of any type.
     */
    public const INT_TO_MIXED = 3;

    /**
     * Judy array with string keys and integer values (sorted, trie-based).
     */
    public const STRING_TO_INT = 4;

    /**
     * Judy array with string keys and values of any type (sorted, trie-based).
     */
    public const STRING_TO_MIXED = 5;

    /**
     * Judy array with integer keys and packed integer values.
     */
    public const INT_TO_PACKED = 6;

    /**
     * Judy array with string keys and values of any type (unsorted, hash-based).
     */
    public const STRING_TO_MIXED_HASH = 7;

    /**
     * Judy array with string keys and integer values (unsorted, hash-based).
     */
    public const STRING_TO_INT_HASH = 8;

    /**
     * Judy array with string keys and values of any type (adaptive storage).
     */
    public const STRING_TO_MIXED_ADAPTIVE = 9;

    /**
     * Judy array with string keys and integer values (adaptive storage).
     */
    public const STRING_TO_INT_ADAPTIVE = 10;

    /**
     * Create a new Judy array of the specified type.
     * @param int $type One of the Judy type constants (e.g. Judy::INT_TO_INT).
     * @param bool $optimizeIteration [optional] Mirror payloads into the key
     * index for faster ordered reads, at a write-path and memory cost. Only
     * Judy::STRING_TO_INT_HASH and Judy::STRING_TO_INT_ADAPTIVE honour it;
     * every other type accepts the argument and ignores it. Cannot be changed
     * after construction. Since 2.5.0.
     */
    public function __construct(int $type, bool $optimizeIteration = false) {}

    /**
     * Free the Judy array and release all associated resources.
     */
    public function __destruct() {}

    /**
     * Return the type constant of this Judy array.
     * @return int One of the Judy type constants.
     */
    public function getType(): int {}

    /**
     * Whether the optimizeIteration trade is actually in effect here.
     * Returns what was honoured, not what was asked for: a type that cannot
     * mirror its payload accepts the constructor argument and returns false.
     * @link https://github.com/orieg/php-judy/blob/main/API.md
     * @return bool True if payloads are mirrored into the key index.
     * @since 2.5.0
     */
    public function isIterationOptimized(): bool {}

    /**
     * Free the entire Judy array.
     * @return int The number of bytes freed.
     */
    public function free(): int {}

    /**
     * Return the memory used by the internal Judy structure.
     * @return int|null Memory used in bytes, or null for string-keyed types
     * (JudySL/JudyHS do not provide memory accounting).
     */
    public function memoryUsage(): ?int {}

    /**
     * Return the number of elements, optionally within an inclusive key range.
     * All key types are supported; string-keyed types require string bounds
     * and compare them lexicographically. Counts without materialising the
     * range, so prefer it to count($judy->keys($start, $end)).
     *
     * The bounds are keys, not offsets. Prior to 2.5.0 the parameters were
     * named $index_start/$index_end, and string bounds were accepted but
     * ignored on string-keyed types, returning the whole-array count.
     * @param mixed $start [optional] Inclusive lower bound; null for unbounded.
     * @param mixed $end [optional] Inclusive upper bound; null for unbounded.
     * @return int The number of elements in the range.
     */
    public function size(mixed $start = null, mixed $end = null): int {}

    /**
     * Return the number of elements. Implements Countable.
     */
    public function count(): int {}

    /**
     * Locate the Nth index present in the array (1-based).
     * @param mixed $nth_index The ordinal position to look up.
     * @return mixed The index at the given position. Only supported for
     * integer-keyed types; returns null for string-keyed types.
     */
    public function byCount(mixed $nth_index): mixed {}

    /**
     * Search (inclusive) for the first index present that is equal to or
     * greater than the given index.
     * @param mixed $index [optional] Integer or string index to start from.
     * @return mixed The corresponding index in the array.
     */
    public function first(mixed $index = null): mixed {}

    /**
     * Search (exclusive) for the next index present that is greater than
     * the given index.
     * @param mixed $index Integer or string index to start from.
     * @return mixed The corresponding index in the array.
     */
    public function searchNext(mixed $index): mixed {}

    /**
     * Search (inclusive) for the last index present that is equal to or
     * less than the given index.
     * @param mixed $index [optional] Integer or string index to start from.
     * @return mixed The corresponding index in the array.
     */
    public function last(mixed $index = null): mixed {}

    /**
     * Search (exclusive) for the previous index present that is less than
     * the given index.
     * @param mixed $index Integer or string index to start from.
     * @return mixed The corresponding index in the array.
     */
    public function prev(mixed $index): mixed {}

    /**
     * Search (inclusive) for the first absent index that is equal to or
     * greater than the given index. Integer-keyed types only.
     * @param mixed $index [optional] Integer index to start from.
     * @return mixed The corresponding absent index, or null for string-keyed types.
     */
    public function firstEmpty(mixed $index = null): mixed {}

    /**
     * Search (exclusive) for the next absent index greater than the given
     * index. Integer-keyed types only.
     * @param mixed $index Integer index to start from.
     * @return mixed The corresponding absent index, or null for string-keyed types.
     */
    public function nextEmpty(mixed $index): mixed {}

    /**
     * Search (inclusive) for the last absent index that is equal to or
     * less than the given index. Integer-keyed types only.
     * @param mixed $index [optional] Integer index to start from.
     * @return mixed The corresponding absent index, or null for string-keyed types.
     */
    public function lastEmpty(mixed $index = null): mixed {}

    /**
     * Search (exclusive) for the previous absent index less than the given
     * index. Integer-keyed types only.
     * @param mixed $index Integer index to start from.
     * @return mixed The corresponding absent index, or null for string-keyed types.
     */
    public function prevEmpty(mixed $index): mixed {}

    /**
     * Return a new Judy array containing all indices present in either array.
     * For integer-valued types, values from the other array overwrite on
     * duplicate keys.
     */
    public function union(Judy $other): Judy {}

    /**
     * Return a new Judy array containing only indices present in both arrays.
     * For integer-valued types, values from this array are used.
     */
    public function intersect(Judy $other): Judy {}

    /**
     * Return a new Judy array containing indices present in this array but
     * not in the other.
     */
    public function diff(Judy $other): Judy {}

    /**
     * Return a new Judy array containing indices present in exactly one of
     * the arrays (symmetric difference).
     */
    public function xor(Judy $other): Judy {}

    /**
     * Merge another Judy array into this one in-place. Both arrays must use
     * the same key category (both integer-keyed or both string-keyed).
     * Existing keys are overwritten.
     */
    public function mergeWith(Judy $other): void {}

    /**
     * Return a new Judy array containing entries in the [$start, $end]
     * range (inclusive). For string-keyed types, comparison is lexicographic.
     */
    public function slice(mixed $start, mixed $end): Judy {}

    /**
     * Check whether the given offset exists in the array.
     */
    public function offsetExists(mixed $offset): bool {}

    /**
     * Return the value at the given offset.
     */
    public function offsetGet(mixed $offset): mixed {}

    /**
     * Set the value at the given offset.
     */
    public function offsetSet(mixed $offset, mixed $value): void {}

    /**
     * Remove the element at the given offset.
     */
    public function offsetUnset(mixed $offset): void {}

    /**
     * Return data suitable for json_encode(). Implements JsonSerializable.
     */
    public function jsonSerialize(): mixed {}

    /**
     * Return serialization data as ['type' => int, 'data' => array].
     */
    public function __serialize(): array {}

    /**
     * Restore a Judy array from serialized data.
     */
    public function __unserialize(array $data): void {}

    /**
     * Convert the Judy array to a native PHP array, optionally limited to an
     * inclusive key range. Uses native C iteration internally, faster than a
     * manual foreach. A bounded read is one traversal writing straight into
     * the returned array, so prefer it to slice($start, $end)->toArray().
     * @param mixed $start [optional] Inclusive lower bound; null for unbounded.
     * Since 2.5.0.
     * @param mixed $end [optional] Inclusive upper bound; null for unbounded.
     * Since 2.5.0.
     */
    public function toArray(mixed $start = null, mixed $end = null): array {}

    /**
     * Create a new Judy array from a PHP array.
     * @param int $type One of the Judy type constants.
     * @param array $data Key-value pairs to populate the array with.
     * @param bool $optimizeIteration [optional] See Judy::__construct().
     * Since 2.5.0.
     */
    public static function fromArray(int $type, array $data, bool $optimizeIteration = false): Judy {}

    /**
     * Bulk-insert entries from a PHP array into this Judy array.
     */
    public function putAll(array $data): void {}

    /**
     * Retrieve multiple values at once.
     * @param array $keys Keys to look up.
     * @return array Associative array mapping each requested key to its
     * value (or null if absent).
     */
    public function getAll(array $keys): array {}

    /**
     * Atomically increment the value at the given key. If the key does not
     * exist, it is created with the given amount. The amount may be negative.
     * @return int The new value.
     */
    public function increment(mixed $key, int $amount = 1): int {}

    /**
     * Rewind the iterator to the first element.
     */
    public function rewind(): void {}

    /**
     * Check whether the current iterator position is valid.
     */
    public function valid(): bool {}

    /**
     * Return the value at the current iterator position.
     */
    public function current(): mixed {}

    /**
     * Return the key at the current iterator position.
     */
    public function key(): mixed {}

    /**
     * Advance the iterator to the next element.
     */
    public function next(): void {}

    /**
     * Return all keys as a PHP array, optionally limited to an inclusive key
     * range. All key types are supported; string-keyed types require string
     * bounds and compare them lexicographically. This is the primitive to
     * reach for on a bounded read: one traversal writing straight into the
     * returned array, so prefer it to slice($start, $end)->keys().
     *
     * Note that a string upper bound is a bound, not a prefix match — for a
     * prefix sweep, bound with the prefix and its successor.
     * @param mixed $start [optional] Inclusive lower bound; null for unbounded.
     * Since 2.5.0.
     * @param mixed $end [optional] Inclusive upper bound; null for unbounded.
     * Since 2.5.0.
     */
    public function keys(mixed $start = null, mixed $end = null): array {}

    /**
     * Return all values as a PHP array, optionally limited to an inclusive
     * key range. The bounds are keys, not values.
     * @param mixed $start [optional] Inclusive lower bound; null for unbounded.
     * Since 2.5.0.
     * @param mixed $end [optional] Inclusive upper bound; null for unbounded.
     * Since 2.5.0.
     */
    public function values(mixed $start = null, mixed $end = null): array {}

    /**
     * Call a callback for each element, iterating in C. The callback
     * receives ($key, $value) for each element.
     */
    public function forEach(callable $callback): void {}

    /**
     * Return a new Judy array containing only elements matching the predicate.
     */
    public function filter(callable $predicate): Judy {}

    /**
     * Return a new Judy array with values transformed by the callback.
     */
    public function map(callable $transform): Judy {}

    /**
     * Return the sum of all values in the array. For BITSET, returns the
     * population count.
     */
    public function sumValues(): int|float {}

    /**
     * Return the average of all values, or null if the array is empty.
     * For BITSET, always returns 1.0.
     */
    public function averageValues(): ?float {}

    /**
     * Return the number of keys in the [$start, $end] range (inclusive).
     * Integer-keyed types only — it answers from libJudy's O(1) population
     * cache, which the JudySL/JudyHS string stores do not have, and throws on
     * a string-keyed array. To count a range on string keys, use
     * Judy::size($start, $end).
     */
    public function populationCount(mixed $start = 0, mixed $end = -1): int {}

    /**
     * Delete all keys in the [$start, $end] range (inclusive).
     * @return int The number of elements deleted.
     */
    public function deleteRange(mixed $start, mixed $end): int {}

    /**
     * Check if two Judy arrays have identical type, size, and key-value pairs.
     */
    public function equals(Judy $other): bool {}
}

// End of judy.
