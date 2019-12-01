<?php

/**
 * PHP Data Structure stubs, a PECL extension
 * @version 1.0.0
 * @author Dominic Guhl <dominic.guhl@posteo.de>
 * @copyright © 2019 PHP Documentation Group
 * @license CC-BY 3.0, https://www.php.net/manual/en/cc.license.php
 */

namespace Ds {

    use Countable;
    use JsonSerializable;
    use OutOfRangeException;
    use Traversable;
    use UnderflowException;

    /**
     * Collection is the base interface which covers functionality common to all
     * the data structures in this library. It guarantees that all structures
     * are traversable, countable, and can be converted to json using
     * json_encode().
     * @package Ds
     */
    interface Collection extends Traversable, Countable, JsonSerializable
    {
        /**
         * Removes all values from the collection.
         * @link https://www.php.net/manual/en/ds-collection.clear.php
         */
        public function clear(): void;

        /**
         * Returns a shallow copy of the collection.
         * @link https://www.php.net/manual/en/ds-collection.copy.php
         * @return Collection
         */
        public function copy(): Collection;

        /**
         * Returns whether the collection is empty.
         * @link https://www.php.net/manual/en/ds-collection.isempty.php
         * @return bool
         */
        public function isEmpty(): bool;

        /**
         * Converts the collection to an array.
         * <p>Note: Casting to an array is not supported yet.
         * @link https://www.php.net/manual/en/ds-collection.toarray.php
         * @return array An array containing all the values in the same order as
         * the collection.
         */
        public function toArray(): array;
    }

    /**
     * Hashable is an interface which allows objects to be used as keys. It’s
     * an alternative to spl_object_hash(), which determines an object’s hash
     * based on its handle: this means that two objects that are considered
     * equal by an implicit definition would not treated as equal because they
     * are not the same instance.
     *
     * hash() is used to return a scalar value to be used as the object's hash
     * value, which determines where it goes in the hash table. While this value
     * does not have to be unique, objects which are equal must have the same
     * hash value.
     *
     * equals() is used to determine if two objects are equal. It's guaranteed
     * that the comparing object will be an instance of the same class as the
     * subject.
     * @package Ds
     */
    interface Hashable
    {
        /**
         * Determines whether another object is equal to the current instance.
         *
         * This method allows objects to be used as keys in structures such as
         * Ds\Map and Ds\Set, or any other lookup structure that honors this
         * interface.
         *
         * Note: It's guaranteed that $obj is an instance of the same class.
         *
         * Caution: It's important that objects which are equal also have the
         * same hash value.
         * @see https://www.php.net/manual/en/ds-hashable.hash.php
         * @link https://www.php.net/manual/en/ds-hashable.equals.php
         * @param object $obj The object to compare the current instance to,
         * which is always an instance of the same class.
         *
         * @return bool True if equal, false otherwise.
         */
        public function equals($obj): bool;

        /**
         * Returns a scalar value to be used as the hash value of the objects.
         *
         * While the hash value does not define equality, all objects that are
         * equal according to Ds\Hashable::equals() must have the same hash
         * value. Hash values of equal objects don't have to be unique, for
         * example you could just return TRUE for all objects and nothing
         * would break - the only implication would be that hash tables then
         * turn into linked lists because all your objects will be hashed to
         * the same bucket. It's therefore very important that you pick a good
         * hash value, such as an ID or email address.
         *
         * This method allows objects to be used as keys in structures such as
         * Ds\Map and Ds\Set, or any other lookup structure that honors this
         * interface.
         *
         * Caution: Do not pick a value that might change within the object,
         * such as a public property. Hash table lookups would fail because
         * the hash has changed.
         *
         * Caution: All objects that are equal must have the same hash value.
         *
         * @return mixed A scalar value to be used as this object's hash value.
         * @link https://www.php.net/manual/en/ds-hashable.hash.php
         */
        public function hash();
    }

    /**
     * A Sequence describes the behaviour of values arranged in a single,
     * linear dimension. Some languages refer to this as a "List". It’s
     * similar to an array that uses incremental integer keys, with the
     * exception of a few characteristics:
     * <li>Values will always be indexed as [0, 1, 2, …, size - 1].
     * <li>Only allowed to access values by index in the range [0, size - 1].
     * <p><p>
     *  <p>Use cases:
     *
     * <li>Wherever you would use an array as a list (not concerned with keys).
     * <li>A more efficient alternative to SplDoublyLinkedList and SplFixedArray.
     * @package Ds
     */
    interface Sequence extends Collection
    {
        /**
         * Ensures that enough memory is allocated for a required capacity.
         * This removes the need to reallocate the internal as values are added.
         *
         * @param int $capacity The number of values for which capacity should
         * be allocated.<p>Note: Capacity will stay the same if this value is
         * less than or equal to the current capacity.
         * @link https://www.php.net/manual/en/ds-sequence.allocate.php
         */
        public function allocate(int $capacity): void;

        /**
         * Updates all values by applying a callback function to each value in
         * the sequence.
         * @param callable $callback A callable to apply to each value in the
         * sequence. The callback should return what the value should be
         * replaced by.<p>
         * <code>callback ( mixed $value ) : mixed</code>
         * @link https://www.php.net/manual/en/ds-sequence.apply.php
         */
        public function apply(callable $callback): void;

        /**
         * Returns the current capacity.
         * @return int The current capacity.
         * @link https://www.php.net/manual/en/ds-sequence.capacity.php
         */
        public function capacity(): int;

        /**
         * Determines if the sequence contains all values.
         * @param mixed $values Values to check.
         * @return bool FALSE if any of the provided values are not in the
         * sequence, TRUE otherwise.
         * @link https://www.php.net/manual/en/ds-sequence.contains.php
         */
        public function contains(...$values): bool;

        /**
         * Creates a new sequence using a callable to determine which values
         * to include.
         * @param callable $callback Optional callable which returns TRUE if the
         * value should be included, FALSE otherwise. If a callback is not
         * provided, only values which are TRUE (see converting to boolean) will
         * be included.<p>
         * <code>callback ( mixed $value ) : bool</code>
         * @return Sequence A new sequence containing all the values for which
         * either the callback returned TRUE, or all values that convert to
         * TRUE if a callback was not provided.
         * @link https://www.php.net/manual/en/ds-sequence.filter.php
         */
        public function filter(callable $callback = null): Sequence;

        /**
         * Returns the index of the value, or FALSE if not found.
         * @param mixed $value The value to find.
         * @return int|bool The index of the value, or FALSE if not found.
         * @link https://www.php.net/manual/en/ds-sequence.find.php
         */
        public function find($value);

        /**
         * Returns the first value in the sequence.
         * @return mixed The first value in the sequence.
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-sequence.first.php
         */
        public function first();

        /**
         * Returns the value at a given index.
         * @param int $index The index to access, starting at 0.
         * @return mixed The value at the requested index.
         * @throws OutOfRangeException if the index is not valid.
         * @link https://www.php.net/manual/en/ds-sequence.get.php
         */
        public function get(int $index);

        /**
         * Inserts values into the sequence at a given index.
         *
         * @param int $index The index at which to insert. 0 <= index <= count
         * <p> Note: You can insert at the index equal to the number of values.
         * @param mixed ...$values The value or values to insert.
         * @throws OutOfRangeException if the index is not valid.
         * @link https://www.php.net/manual/en/ds-sequence.insert.php
         */
        public function insert(int $index, ...$values): void;

        /**
         * Joins all values together as a string using an optional separator
         * between each value.
         * @param string $glue An optional string to separate each value.
         * @return string All values of the sequence joined together as a
         * string.
         * @link https://www.php.net/manual/en/ds-sequence.join.php
         */
        public function join(string $glue = ''): string;

        /**
         * Returns the last value in the sequence.
         * @return mixed The last value in the sequence.
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-sequence.last.php
         */
        public function last();

        /**
         * Returns the result of applying a callback function to each value in
         * the sequence.
         * @param callable $callback A callable to apply to each value in the
         * sequence.
         * The callable should return what the new value will be in the new
         * sequence.
         * <code>callback ( mixed $value ) : mixed</code>
         * @return Sequence The result of applying a callback to each value in
         * the sequence.<p>Note: The values of the current instance won't be
         * affected.
         * @link https://www.php.net/manual/en/ds-sequence.map.php
         */
        public function map(callable $callback): Sequence;

        /**
         * Returns the result of adding all given values to the sequence.
         * @param mixed $values A traversable object or an array.
         * @return Sequence The result of adding all given values to the
         * sequence, effectively the same as adding the values to a copy,
         * then returning that copy.
         * @link https://www.php.net/manual/en/ds-sequence.merge.php
         */
        public function merge($values): Sequence;

        /**
         * Removes and returns the last value.
         * @return mixed The removed last value.
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-sequence.pop.php
         */
        public function pop();

        /**
         * Adds values to the end of the sequence.
         * @param mixed ...$values The values to add.
         */
        public function push(...$values): void;

        /**
         * Reduces the sequence to a single value using a callback function.
         * @param callable $callback<p><p>
         * <code>
         * callback ( mixed $carry , mixed $value ) : mixed</code>
         * <b>$carry</b> The return value of the previous callback, or initial if it's
         * the first iteration.<p>
         * <b>$value</b> The value of the current iteration.
         * @param mixed $initial The initial value of the carry value. Can be NULL.
         * @return mixed The return value of the final callback.
         * @link https://www.php.net/manual/en/ds-sequence.reduce.php
         */
        public function reduce(callable $callback, $initial = null);

        /**
         * Removes and returns a value by index.
         * @param int $index The index of the value to remove.
         * @return mixed The value that was removed.
         * @link https://www.php.net/manual/en/ds-sequence.remove.php
         */
        public function remove(int $index);

        /**
         * Reverses the sequence in-place.
         * @link https://www.php.net/manual/en/ds-sequence.reverse.php
         */
        public function reverse(): void;

        /**
         * Returns a reversed copy of the sequence.
         * @return Sequence A reversed copy of the sequence.
         * <p>Note: The current instance is not affected.
         */
        public function reversed(): Sequence;

        /**
         * Rotates the sequence by a given number of rotations, which is
         * equivalent to successively calling
         * $sequence->push($sequence->shift()) if the number of rotations is
         * positive, or $sequence->unshift($sequence->pop()) if negative.
         * @param int $rotations The number of times the sequence should be
         * rotated.
         * @link https://www.php.net/manual/en/ds-sequence.rotate.php
         */
        public function rotate(int $rotations): void;

        /**
         * Updates a value at a given index.
         * @param int $index The index of the value to update.
         * @param mixed $value The new value.
         * @throws OutOfRangeException if the index is not valid.
         * @link https://www.php.net/manual/en/ds-sequence.set.php
         */
        public function set(int $index, $value): void;

        /**
         * Removes and returns the first value.
         * @return mixed
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-sequence.shift.php
         */
        public function shift();

        /**
         * Creates a sub-sequence of a given range.
         * @param int $index The index at which the sub-sequence starts.
         * If positive, the sequence will start at that index in the sequence.
         * If negative, the sequence will start that far from the end.
         * @param int|null $length If a length is given and is positive, the
         * resulting sequence will have up to that many values in it. If the
         * length results in an overflow, only values up to the end of the
         * sequence will be included. If a length is given and is negative,
         * the sequence will stop that many values from the end. If a length
         * is not provided, the resulting sequence will contain all values
         * between the index and the end of the sequence.
         * @return Sequence A sub-sequence of the given range.
         * @link https://www.php.net/manual/en/ds-sequence.slice.php
         */
        public function slice(int $index, int $length = null): Sequence;

        /**
         * Sorts the sequence in-place, using an optional comparator function.
         * @param callable|null $comparator The comparison function must return
         * an integer less than, equal to, or greater than zero if the first
         * argument is considered to be respectively less than, equal to, or
         * greater than the second. Note that before PHP 7.0.0 this integer had
         * to be in the range from -2147483648 to 2147483647.<p>
         * <code>callback ( mixed $a, mixed $b ) : int</code>
         * <p>Caution: Returning non-integer values from the comparison
         * function, such as float, will result in an internal cast to integer
         * of the callback's return value. So values such as 0.99 and 0.1 will
         * both be cast to an integer value of 0, which will compare such
         * values as equal.
         * @link https://www.php.net/manual/en/ds-sequence.sort.php
         */
        public function sort(callable $comparator = null): void;

        /**
         * Returns a sorted copy, using an optional comparator function.
         * @param callable|null $comparator The comparison function must return
         * an integer less than, equal to, or greater than zero if the first
         * argument is considered to be respectively less than, equal to, or
         * greater than the second. Note that before PHP 7.0.0 this integer had
         * to be in the range from -2147483648 to 2147483647.<p>
         * <code>callback ( mixed $a, mixed $b ) : int</code>
         * <p>Caution: Returning non-integer values from the comparison
         * function, such as float, will result in an internal cast to integer
         * of the callback's return value. So values such as 0.99 and 0.1 will
         * both be cast to an integer value of 0, which will compare such
         * values as equal.
         * @return Sequence Returns a sorted copy of the sequence.
         * @link https://www.php.net/manual/en/ds-sequence.sort.php
         */
        public function sorted(callable $comparator): Sequence;

        /**
         * Returns the sum of all values in the sequence.
         * <p>Note: Arrays and objects are considered equal to zero when
         * calculating the sum.
         * @return float|int The sum of all the values in the sequence as
         * either a float or int depending on the values in the sequence.
         */
        public function sum(): float;

        /**
         * Adds values to the front of the sequence, moving all the current
         * values forward to make room for the new values.
         * @param mixed $values The values to add to the front of the sequence.
         * <p>Note: Multiple values will be added in the same order that they
         * are passed.
         */
        public function unshift($values): void;
    }
}