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
         * @param callable $callback <p><p>
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


    /**
     * A Vector is a sequence of values in a contiguous buffer that grows and
     * shrinks automatically. It’s the most efficient sequential structure
     * because a value’s index is a direct mapping to its index in the buffer,
     * and the growth factor isn't bound to a specific multiple or exponent.
     * <p><p>
     * <h3>Strengths
     * <li>Supports array syntax (square brackets).
     * <li>Uses less overall memory than an array for the same number of values.
     * <li>Automatically frees allocated memory when its size drops low enough.
     * <li>Capacity does not have to be a power of 2.
     * <li>get(), set(), push(), pop() are all O(1).
     * <p>
     * <h3>Weaknesses
     * <li>shift(), unshift(), insert() and remove() are all O(n).
     *
     * @package Ds
     */
    class Vector implements Sequence
    {

        const MIN_CAPACITY = 10;

        /**
         * Ensures that enough memory is allocated for a required capacity.
         * This removes the need to reallocate the internal as values are added.
         * @param int $capacity The number of values for which capacity should
         * be allocated.
         * <p>Note: Capacity will stay the same if this value is less than or
         * equal to the current capacity.
         * @link https://www.php.net/manual/en/ds-vector.allocate.php
         */
        public function allocate(int $capacity): void
        {
        }

        /**
         * Updates all values by applying a callback function to each value in
         * the vector.
         * @param callable $callback
         * <code>callback ( mixed $value ) : mixed</code>
         * A callable to apply to each value in the vector. The callback should
         * return what the value should be replaced by.
         * @link https://www.php.net/manual/en/ds-vector.apply.php
         */
        public function apply(callable $callback): void
        {
        }

        /**
         * @inheritDoc
         * @return int The current capacity.
         * @link https://www.php.net/manual/en/ds-vector.capacity.php
         */
        public function capacity(): int
        {
        }

        /**
         * Removes all values from the vector.
         * @link https://www.php.net/manual/en/ds-vector.clear.php
         */
        public function clear(): void
        {
        }

        /**
         * Determines if the vector contains all values.
         * @param mixed ...$values Values to check.
         * @return bool FALSE if any of the provided values are not in the
         * vector, TRUE otherwise.
         * @link https://www.php.net/manual/en/ds-sequence.contains.php
         */
        public function contains(...$values): bool
        {
        }

        /**
         *Returns a shallow copy of the vector.
         * @return Vector Returns a shallow copy of the vector.
         */
        public function copy(): Vector
        {
        }

        /**
         * Creates a new vector using a callable to determine which values to
         * include.
         *
         * @param callable $callback
         * Optional callable which returns TRUE if the value should be included,
         * FALSE otherwise. If a callback is not provided, only values which are
         * TRUE (see converting to boolean)  will be included.
         * <code>callback ( mixed $value ) : bool</code>
         * @return Vector A new vector containing all the values for which
         * either the callback returned TRUE, or all values that convert to
         * TRUE if a callback was not provided.
         * @link https://www.php.net/manual/en/ds-sequence.filter.php
         */
        public function filter(callable $callback = null): Vector
        {
        }

        /**
         * Returns the index of the value, or FALSE if not found.
         * @param mixed $value The value to find.
         * @return mixed|bool The index of the value, or FALSE if not found.
         * <p>Note: Values will be compared by value and by type.
         * @link https://www.php.net/manual/en/ds-sequence.find.php
         */
        public function find(mixed $value)
        {
        }

        /**
         * Returns the first value in the vector.
         * @return mixed
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-sequence.first.php
         */
        public function first()
        {
        }

        /**
         * Returns the value at a given index.
         * @param int $index The index to access, starting at 0.
         * @return mixed
         * @link https://www.php.net/manual/en/ds-sequence.get.php
         */
        public function get(int $index)
        {
        }

        /**
         * Inserts values into the sequence at a given index.
         *
         * @param int $index The index at which to insert. 0 <= index <= count
         * Note:<br>
         * You can insert at the index equal to the number of values.
         * @param array $values The value or values to insert.
         * @link https://www.php.net/manual/en/ds-sequence.insert.php
         */
        public function insert(int $index, ...$values): void
        {
        }

        /**
         * Joins all values together as a string using an optional separator between each value.
         *
         * @param string|null $glue An optional string to separate each value.
         * @return string All values of the sequence joined together as a string.
         * @link https://www.php.net/manual/en/ds-sequence.join.php
         */
        public function join(?string $glue = null): string
        {
        }

        /**
         * Returns the last value in the sequence.
         *
         * @return mixed The last value in the sequence.
         * @link https://www.php.net/manual/en/ds-sequence.last.php
         */
        public function last()
        {
        }

        /**
         * Returns the result of applying a callback function to each value in the sequence.
         *
         * @param callable $callback A callable to apply to each value in the sequence.
         * <br>The callable should return what the new value will be in the new sequence.
         *
         * @return Vector
         * @link https://www.php.net/manual/en/ds-sequence.map.php
         */
        public function map(callable $callback): Vector
        {
        }

        /**
         * Returns the result of adding all given values to the sequence.
         *
         * @param Traversable|array $values A traversable object or an array.
         * @return Vector The result of adding all given values to the sequence, effectively the same as adding the
         * values to a copy, then returning that copy.<br>
         * Note:<br>
         * The current instance won't be affected.
         * @link https://www.php.net/manual/en/ds-sequence.merge.php
         */
        public function merge($values): Vector
        {
        }

        /**
         * Removes and returns the last value.
         *
         * @return mixed
         * @link https://www.php.net/manual/en/ds-sequence.pop.php
         */
        public function pop()
        {
        }

        /**
         * Adds values to the end of the sequence.
         * @param array $values
         * @link https://www.php.net/manual/en/ds-sequence.push.php
         */
        public function push(...$values): void
        {
        }

        /**
         * Reduces the sequence to a single value using a callback function.
         * @param callable $callback <br>
         * <code>callback ( mixed $carry , mixed $value ) : mixed</code><br>
         * <b>carry</b> The return value of the previous callback, or initial if it's the first iteration.<br>
         * <b>value</b> The value of the current iteration.
         * @param mixed $initial The initial value of the carry value. Can be NULL.
         *
         * @return mixed|void The return value of the final callback.
         *
         * @link https://www.php.net/manual/en/ds-sequence.reduce.php
         */
        public function reduce(callable $callback, $initial = null)
        {
        }

        /**
         * Removes and returns a value by index.
         * @param int $index The index of the value to remove.
         * @return mixed The value that was removed.
         * @link https://www.php.net/manual/en/ds-sequence.remove.php
         */
        public function remove(int $index)
        {
        }

        /**
         * Reverses the sequence in-place.
         * @link https://www.php.net/manual/en/ds-sequence.reverse.php
         */
        public function reverse(): void
        {
        }

        /**
         * Returns a reversed copy of the sequence.
         * @return Vector A reversed copy of the sequence.<br>
         * Note: The current instance is not affected.
         * @link https://www.php.net/manual/en/ds-sequence.reversed.php
         */
        public function reversed(): Vector
        {
        }

        /**
         * Rotates the sequence by a given number of rotations, which is equivalent to successively calling $sequence->push($sequence->shift()) if the number of rotations is positive, or $sequence->unshift($sequence->pop()) if negative.
         * @param int $rotations The number of times the sequence should be rotated.
         */
        public function rotate(int $rotations): void
        {
        }

        /**
         * Updates a value at a given index.
         * @param int $index The index of the value to update.
         * @param mixed $value The new value.
         * @throws OutOfRangeException if the index is not valid.
         */
        public function set(int $index, $value): void
        {
        }

        /**
         * Removes and returns the first value.
         * @return mixed The first value, which was removed.
         * @throws UnderflowException if empty.
         */
        public function shift()
        {
        }

        /**
         * Creates a sub-sequence of a given range.
         * @param int $index The index at which the sub-sequence starts. If positive, the sequence will start at that
         * index in the sequence. If negative, the sequence will start that far from the end.
         * @param int|null $length If a length is given and is positive, the resulting sequence will have up to that many values in it. If the length results in an overflow, only values up to the end of the sequence will be included. If a length is given and is negative, the sequence will stop that many values from the end. If a length is not provided, the resulting sequence will contain all values between the index and the end of the sequence.
         * @return Vector
         */
        public function slice(int $index, int $length = null): Vector
        {
        }

        /**
         * Sorts the sequence in-place, using an optional comparator function.
         * @param callable $comparator The comparison function must return an integer less than, equal to, or greater
         * than zero if the first argument is considered to be respectively less than, equal to, or greater than the
         * second. Note that before PHP 7.0.0 this integer had to be in the range from -2147483648 to 2147483647.<br>
         * <code>callback ( mixed $a, mixed $b ) : int</code>
         * Caution: Returning non-integer values from the comparison function, such as float, will result in an
         * internal cast to integer of the callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as equal.
         */
        public function sort(callable $comparator = null): void
        {
        }

        /**
         * Returns a sorted copy, using an optional comparator function.
         * @param callable $comparator The comparison function must return an integer less than, equal to, or greater
         * than zero if the first argument is considered to be respectively less than, equal to, or greater than the
         * second. Note that before PHP 7.0.0 this integer had to be in the range from -2147483648 to 2147483647.<br>
         * <code>callback ( mixed $a, mixed $b ) : int</code>
         * Caution: Returning non-integer values from the comparison function, such as float, will result in an
         * internal cast to integer of the callback's return value. So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as equal.
         * @return Vector Returns a sorted copy of the sequence.
         */
        public function sorted(callable $comparator): Vector
        {
        }

        /**
         * Returns the sum of all values in the sequence.<br>
         * Note: Arrays and objects are considered equal to zero when calculating the sum.
         * @return float
         */
        public function sum(): float
        {
        }

        /**
         * Adds values to the front of the sequence, moving all the current values forward to make room for the new values.
         * @param mixed $values The values to add to the front of the sequence.<br>
         * Note: Multiple values will be added in the same order that they are passed
         */
        public function unshift($values): void
        {
        }

        /**
         * Count elements of an object
         * @link https://php.net/manual/en/countable.count.php
         * @return int The custom count as an integer.
         * </p>
         * <p>
         * The return value is cast to an integer.
         * @since 5.1
         */
        public function count(): int
        {
        }

        /**
         * Returns whether the collection is empty.
         * @link https://www.php.net/manual/en/ds-collection.isempty.php
         * @return bool
         */
        public function isEmpty(): bool
        {
        }

        /**
         * Converts the collection to an array.
         * <p>Note: Casting to an array is not supported yet.
         * @link https://www.php.net/manual/en/ds-collection.toarray.php
         * @return array An array containing all the values in the same order as
         * the collection.
         */
        public function toArray(): array
        {
        }

        /**
         * @inheritDoc
         */
        public function jsonSerialize()
        {
        }
    }

    class Deque implements Sequence
    {
        /**
         * Count elements of an object
         * @link https://php.net/manual/en/countable.count.php
         * @return int The custom count as an integer.
         * </p>
         * <p>
         * The return value is cast to an integer.
         * @since 5.1
         */
        public function count(): int
        {
        }

        /**
         * Removes all values from the deque.
         * @link https://www.php.net/manual/en/ds-deque.clear.php
         */
        public function clear(): void
        {
        }

        /**
         * Returns a shallow copy of the deque.
         * @link https://www.php.net/manual/en/ds-deque.copy.php
         * @return Collection
         */
        public function copy(): Collection
        {
        }

        /**
         * Returns whether the deque is empty.
         * @link https://www.php.net/manual/en/ds-deque.isempty.php
         * @return bool
         */
        public function isEmpty(): bool
        {
        }

        /**
         * Converts the deque to an array.
         * <p>Note: Casting to an array is not supported yet.
         * @link https://www.php.net/manual/en/ds-deque.toarray.php
         * @return array An array containing all the values in the same order as
         * the deque.
         */
        public function toArray(): array
        {
        }

        /**
         * Ensures that enough memory is allocated for a required capacity.
         * This removes the need to reallocate the internal as values are added.
         *
         * @param int $capacity The number of values for which capacity should
         * be allocated.<p>Note: Capacity will stay the same if this value is
         * less than or equal to the current capacity.
         * <p>Note: Capacity will always be rounded up to the nearest power of 2.
         * @link https://www.php.net/manual/en/ds-deque.allocate.php
         */
        public function allocate(int $capacity): void
        {
        }

        /**
         * Updates all values by applying a callback function to each value in
         * the deque.
         * @param callable $callback A callable to apply to each value in the
         * deque. The callback should return what the value should be
         * replaced by.<p>
         * <code>callback ( mixed $value ) : mixed</code>
         * @link https://www.php.net/manual/en/ds-deque.apply.php
         */
        public function apply(callable $callback): void
        {
        }

        /**
         * Returns the current capacity.
         * @return int The current capacity.
         * @link https://www.php.net/manual/en/ds-deque.capacity.php
         */
        public function capacity(): int
        {
        }

        /**
         * Determines if the deque contains all values.
         * @param mixed $values Values to check.
         * @return bool FALSE if any of the provided values are not in the
         * deque, TRUE otherwise.
         * @link https://www.php.net/manual/en/ds-deque.contains.php
         */
        public function contains(...$values): bool
        {
        }

        /**
         * Creates a new deque using a callable to determine which values
         * to include.
         * @param callable $callback Optional callable which returns TRUE if the
         * value should be included, FALSE otherwise. If a callback is not
         * provided, only values which are TRUE (see converting to boolean) will
         * be included.<p>
         * <code>callback ( mixed $value ) : bool</code>
         * @return Deque A new deque containing all the values for which
         * either the callback returned TRUE, or all values that convert to
         * TRUE if a callback was not provided.
         * @link https://www.php.net/manual/en/ds-deque.filter.php
         */
        public function filter(callable $callback = null): Deque
        {
        }

        /**
         * Returns the index of the value, or FALSE if not found.
         * @param mixed $value The value to find.
         * @return int|bool The index of the value, or FALSE if not found.
         * @link https://www.php.net/manual/en/ds-deque.find.php
         */
        public function find($value)
        {
        }

        /**
         * Returns the first value in the deque.
         * @return mixed The first value in the deque.
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-deque.first.php
         */
        public function first()
        {
        }

        /**
         * Returns the value at a given index.
         * @param int $index The index to access, starting at 0.
         * @return mixed The value at the requested index.
         * @throws OutOfRangeException if the index is not valid.
         * @link https://www.php.net/manual/en/ds-deque.get.php
         */
        public function get(int $index)
        {
        }

        /**
         * Inserts values into the deque at a given index.
         *
         * @param int $index The index at which to insert. 0 <= index <= count
         * <p> Note: You can insert at the index equal to the number of values.
         * @param mixed ...$values The value or values to insert.
         * @throws OutOfRangeException if the index is not valid.
         * @link https://www.php.net/manual/en/ds-deque.insert.php
         */
        public function insert(int $index, ...$values): void
        {
        }

        /**
         * Joins all values together as a string using an optional separator
         * between each value.
         * @param string $glue An optional string to separate each value.
         * @return string All values of the deque joined together as a
         * string.
         * @link https://www.php.net/manual/en/ds-deque.join.php
         */
        public function join(string $glue = ''): string
        {
        }

        /**
         * Returns the last value in the deque.
         * @return mixed The last value in the deque.
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-deque.last.php
         */
        public function last()
        {
        }

        /**
         * Returns the result of applying a callback function to each value in
         * the deque.
         * @param callable $callback A callable to apply to each value in the
         * deque.
         * The callable should return what the new value will be in the new
         * deque.
         * <code>callback ( mixed $value ) : mixed</code>
         * @return Deque The result of applying a callback to each value in
         * the deque.<p>Note: The values of the current instance won't be
         * affected.
         * @link https://www.php.net/manual/en/ds-deque.map.php
         */
        public function map(callable $callback): Deque
        {
        }

        /**
         * Returns the result of adding all given values to the deque.
         * @param mixed $values A traversable object or an array.
         * @return Deque The result of adding all given values to the
         * deque, effectively the same as adding the values to a copy,
         * then returning that copy.
         * @link https://www.php.net/manual/en/ds-deque.merge.php
         */
        public function merge($values): Deque
        {
        }

        /**
         * Removes and returns the last value.
         * @return mixed The removed last value.
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-deque.pop.php
         */
        public function pop()
        {
        }

        /**
         * Adds values to the end of the deque.
         * @param mixed ...$values The values to add.
         */
        public function push(...$values): void
        {
        }

        /**
         * Reduces the deque to a single value using a callback function.
         * @param callable $callback <p><p>
         * <code>
         * callback ( mixed $carry , mixed $value ) : mixed</code>
         * <b>$carry</b> The return value of the previous callback, or initial if it's
         * the first iteration.<p>
         * <b>$value</b> The value of the current iteration.
         * @param mixed $initial The initial value of the carry value. Can be NULL.
         * @return mixed The return value of the final callback.
         * @link https://www.php.net/manual/en/ds-deque.reduce.php
         */
        public function reduce(callable $callback, $initial = null)
        {
        }

        /**
         * Removes and returns a value by index.
         * @param int $index The index of the value to remove.
         * @return mixed The value that was removed.
         * @link https://www.php.net/manual/en/ds-deque.remove.php
         */
        public function remove(int $index)
        {
        }

        /**
         * Reverses the deque in-place.
         * @link https://www.php.net/manual/en/ds-deque.reverse.php
         */
        public function reverse(): void
        {
        }

        /**
         * Returns a reversed copy of the deque.
         * @return Deque A reversed copy of the deque.
         * <p>Note: The current instance is not affected.
         */
        public function reversed(): Deque
        {
        }

        /**
         * Rotates the deque by a given number of rotations, which is
         * equivalent to successively calling
         * $deque->push($deque->shift()) if the number of rotations is
         * positive, or $deque->unshift($deque->pop()) if negative.
         * @param int $rotations The number of times the deque should be
         * rotated.
         * @link https://www.php.net/manual/en/ds-deque.rotate.php
         */
        public function rotate(int $rotations): void
        {
        }

        /**
         * Updates a value at a given index.
         * @param int $index The index of the value to update.
         * @param mixed $value The new value.
         * @throws OutOfRangeException if the index is not valid.
         * @link https://www.php.net/manual/en/ds-deque.set.php
         */
        public function set(int $index, $value): void
        {
        }

        /**
         * Removes and returns the first value.
         * @return mixed
         * @throws UnderflowException if empty.
         * @link https://www.php.net/manual/en/ds-deque.shift.php
         */
        public function shift()
        {
        }

        /**
         * Creates a sub-deque of a given range.
         * @param int $index The index at which the sub-deque starts.
         * If positive, the deque will start at that index in the deque.
         * If negative, the deque will start that far from the end.
         * @param int|null $length If a length is given and is positive, the
         * resulting deque will have up to that many values in it. If the
         * length results in an overflow, only values up to the end of the
         * deque will be included. If a length is given and is negative,
         * the deque will stop that many values from the end. If a length
         * is not provided, the resulting deque will contain all values
         * between the index and the end of the deque.
         * @return Deque A sub-deque of the given range.
         * @link https://www.php.net/manual/en/ds-deque.slice.php
         */
        public function slice(int $index, int $length = null): Deque
        {
        }

        /**
         * Sorts the deque in-place, using an optional comparator function.
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
         * @link https://www.php.net/manual/en/ds-deque.sort.php
         */
        public function sort(callable $comparator = null): void
        {
        }

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
         * @return Deque Returns a sorted copy of the deque.
         * @link https://www.php.net/manual/en/ds-deque.sort.php
         */
        public function sorted(callable $comparator): Deque
        {
        }

        /**
         * Returns the sum of all values in the deque.
         * <p>Note: Arrays and objects are considered equal to zero when
         * calculating the sum.
         * @return float|int The sum of all the values in the deque as
         * either a float or int depending on the values in the deque.
         */
        public function sum(): float
        {
        }

        /**
         * Adds values to the front of the deque, moving all the current
         * values forward to make room for the new values.
         * @param mixed $values The values to add to the front of the deque.
         * <p>Note: Multiple values will be added in the same order that they
         * are passed.
         */
        public function unshift($values): void
        {
        }

        /**
         * Specify data which should be serialized to JSON
         * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
         * @return mixed data which can be serialized by <b>json_encode</b>,
         * which is a value of any type other than a resource.
         * @since 5.4
         */
        public function jsonSerialize()
        {
        }


    }
}