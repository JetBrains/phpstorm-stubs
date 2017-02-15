<?php
/**
 * PHPStorm stub file for Standard PHP Library(SPL) Data Structures classes.
 *
 * @link http://php.net/manual/en/spl.datastructures.php
 */

/**
 * The SplDoublyLinkedList class provides the main functionalities of a doubly linked list.
 *
 * @link http://php.net/manual/en/class.spldoublylinkedlist.php
 */
class SplDoublyLinkedList implements Iterator, Countable, ArrayAccess
{
    const IT_MODE_DELETE = 1;
    const IT_MODE_FIFO = 0;
    const IT_MODE_KEEP = 0;
    const IT_MODE_LIFO = 2;

    /**
     * Add/insert a new value at the specified index
     *
     * @param mixed $index  The index where the new value is to be inserted.
     * @param mixed $newval The new value for the index.
     *
     * @link  http://php.net/spldoublylinkedlist.add
     * @return void
     * @since 5.5.0
     */
    public function add($index, $newval) { }

    /**
     * Peeks at the node from the beginning of the doubly linked list
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.bottom.php
     * @return mixed The value of the first node.
     * @since 5.3.0
     */
    public function bottom() { }

    /**
     * Counts the number of elements in the doubly linked list.
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.count.php
     * @return int the number of elements in the doubly linked list.
     * @since 5.3.0
     */
    public function count() { }

    /**
     * Return current array entry
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.current.php
     * @return mixed The current node value.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Returns the mode of iteration
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.getiteratormode.php
     * @return int the different modes and flags that affect the iteration.
     * @since 5.3.0
     */
    public function getIteratorMode() { }

    /**
     * Checks whether the doubly linked list is empty.
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.isempty.php
     * @return bool whether the doubly linked list is empty.
     * @since 5.3.0
     */
    public function isEmpty() { }

    /**
     * Return current node index
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.key.php
     * @return mixed The current node index.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to next entry
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Returns whether the requested $index exists
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.offsetexists.php
     *
     * @param mixed $index <p>
     *                     The index being checked.
     *                     </p>
     *
     * @return bool true if the requested <i>index</i> exists, otherwise false
     * @since 5.3.0
     */
    public function offsetExists($index) { }

    /**
     * Returns the value at the specified $index
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.offsetget.php
     *
     * @param mixed $index <p>
     *                     The index with the value.
     *                     </p>
     *
     * @return mixed The value at the specified <i>index</i>.
     * @since 5.3.0
     */
    public function offsetGet($index) { }

    /**
     * Sets the value at the specified $index to $newval
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.offsetset.php
     *
     * @param mixed $index  <p>
     *                      The index being set.
     *                      </p>
     * @param mixed $newval <p>
     *                      The new value for the <i>index</i>.
     *                      </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function offsetSet($index, $newval) { }

    /**
     * Unsets the value at the specified $index
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.offsetunset.php
     *
     * @param mixed $index <p>
     *                     The index being unset.
     *                     </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function offsetUnset($index) { }

    /**
     * Pops a node from the end of the doubly linked list
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.pop.php
     * @return mixed The value of the popped node.
     * @since 5.3.0
     */
    public function pop() { }

    /**
     * Move to previous entry
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.prev.php
     * @return void
     * @since 5.3.0
     */
    public function prev() { }

    /**
     * Pushes an element at the end of the doubly linked list
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.push.php
     *
     * @param mixed $value <p>
     *                     The value to push.
     *                     </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function push($value) { }

    /**
     * Rewind iterator back to the start
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Serializes the storage
     *
     * @link  http://php.net/manual/ru/spldoublylinkedlist.unserialize.php
     * @return string The serialized string.
     * @since 5.4.0
     */
    public function serialize() { }

    /**
     * Sets the mode of iteration
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.setiteratormode.php
     *
     * @param int $mode <p>
     *                  There are two orthogonal sets of modes that can be set:
     *                  </p>
     *                  The direction of the iteration (either one or the other):
     *                  <b>SplDoublyLinkedList::IT_MODE_LIFO</b> (Stack style)
     *
     * @return void
     * @since 5.3.0
     */
    public function setIteratorMode($mode) { }

    /**
     * Shifts a node from the beginning of the doubly linked list
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.shift.php
     * @return mixed The value of the shifted node.
     * @since 5.3.0
     */
    public function shift() { }

    /**
     * Peeks at the node from the end of the doubly linked list
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.top.php
     * @return mixed The value of the last node.
     * @since 5.3.0
     */
    public function top() { }

    /**
     * Unserializes the storage
     *
     * @link  http://php.net/manual/ru/spldoublylinkedlist.serialize.php
     *
     * @param string $serialized The serialized string.
     *
     * @return void
     * @since 5.4.0
     */
    public function unserialize($serialized) { }

    /**
     * Prepends the doubly linked list with an element
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.unshift.php
     *
     * @param mixed $value <p>
     *                     The value to unshift.
     *                     </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function unshift($value) { }

    /**
     * Check whether the doubly linked list contains more nodes
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.valid.php
     * @return bool true if the doubly linked list contains any more nodes, false otherwise.
     * @since 5.3.0
     */
    public function valid() { }
}

/**
 * The SplFixedArray class provides the main functionalities of array. The
 * main differences between a SplFixedArray and a normal PHP array is that
 * the SplFixedArray is of fixed length and allows only integers within
 * the range as indexes. The advantage is that it allows a faster array
 * implementation.
 *
 * @link http://php.net/manual/en/class.splfixedarray.php
 */
class SplFixedArray implements Iterator, ArrayAccess, Countable
{
    /**
     * Constructs a new fixed array
     *
     * @link  http://php.net/manual/en/splfixedarray.construct.php
     *
     * @param int $size [optional]
     *
     * @since 5.3.0
     */
    public function __construct($size = 0) { }

    /**
     * Import a PHP array in a <b>SplFixedArray</b> instance
     *
     * @link  http://php.net/manual/en/splfixedarray.fromarray.php
     *
     * @param array $array        <p>
     *                            The array to import.
     *                            </p>
     * @param bool  $save_indexes [optional] <p>
     *                            Try to save the numeric indexes used in the original array.
     *                            </p>
     *
     * @return SplFixedArray an instance of <b>SplFixedArray</b>
     * containing the array content.
     * @since 5.3.0
     */
    public static function fromArray(array $array, $save_indexes = true) { }

    /**
     * Returns the size of the array
     *
     * @link  http://php.net/manual/en/splfixedarray.count.php
     * @return int the size of the array.
     * @since 5.3.0
     */
    public function count() { }

    /**
     * Return current array entry
     *
     * @link  http://php.net/manual/en/splfixedarray.current.php
     * @return mixed The current element value.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Gets the size of the array
     *
     * @link  http://php.net/manual/en/splfixedarray.getsize.php
     * @return int the size of the array, as an integer.
     * @since 5.3.0
     */
    public function getSize() { }

    /**
     * Return current array index
     *
     * @link  http://php.net/manual/en/splfixedarray.key.php
     * @return int The current array index.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to next entry
     *
     * @link  http://php.net/manual/en/splfixedarray.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Returns whether the requested index exists
     *
     * @link  http://php.net/manual/en/splfixedarray.offsetexists.php
     *
     * @param int $index <p>
     *                   The index being checked.
     *                   </p>
     *
     * @return bool true if the requested <i>index</i> exists, otherwise false
     * @since 5.3.0
     */
    public function offsetExists($index) { }

    /**
     * Returns the value at the specified index
     *
     * @link  http://php.net/manual/en/splfixedarray.offsetget.php
     *
     * @param int $index <p>
     *                   The index with the value.
     *                   </p>
     *
     * @return mixed The value at the specified <i>index</i>.
     * @since 5.3.0
     */
    public function offsetGet($index) { }

    /**
     * Sets a new value at a specified index
     *
     * @link  http://php.net/manual/en/splfixedarray.offsetset.php
     *
     * @param int   $index  <p>
     *                      The index being set.
     *                      </p>
     * @param mixed $newval <p>
     *                      The new value for the <i>index</i>.
     *                      </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function offsetSet($index, $newval) { }

    /**
     * Unsets the value at the specified $index
     *
     * @link  http://php.net/manual/en/splfixedarray.offsetunset.php
     *
     * @param int $index <p>
     *                   The index being unset.
     *                   </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function offsetUnset($index) { }

    /**
     * Rewind iterator back to the start
     *
     * @link  http://php.net/manual/en/splfixedarray.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Change the size of an array
     *
     * @link  http://php.net/manual/en/splfixedarray.setsize.php
     *
     * @param int $size <p>
     *                  The new array size.
     *                  </p>
     *
     * @return int
     * @since 5.3.0
     */
    public function setSize($size) { }

    /**
     * Returns a PHP array from the fixed array
     *
     * @link  http://php.net/manual/en/splfixedarray.toarray.php
     * @return array a PHP array, similar to the fixed array.
     * @since 5.3.0
     */
    public function toArray() { }

    /**
     * Check whether the array contains more elements
     *
     * @link  http://php.net/manual/en/splfixedarray.valid.php
     * @return bool true if the array contains any more elements, false otherwise.
     * @since 5.3.0
     */
    public function valid() { }
}

/**
 * The SplHeap class provides the main functionalities of an Heap.
 *
 * @link http://php.net/manual/en/class.splheap.php
 */
abstract class SplHeap implements Iterator, Countable
{
    /**
     * Counts the number of elements in the heap.
     *
     * @link  http://php.net/manual/en/splheap.count.php
     * @return int the number of elements in the heap.
     * @since 5.3.0
     */
    public function count() { }

    /**
     * Return current node pointed by the iterator
     *
     * @link  http://php.net/manual/en/splheap.current.php
     * @return mixed The current node value.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Extracts a node from top of the heap and sift up.
     *
     * @link  http://php.net/manual/en/splheap.extract.php
     * @return mixed The value of the extracted node.
     * @since 5.3.0
     */
    public function extract() { }

    /**
     * Inserts an element in the heap by sifting it up.
     *
     * @link  http://php.net/manual/en/splheap.insert.php
     *
     * @param mixed $value <p>
     *                     The value to insert.
     *                     </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function insert($value) { }

    /**
     * Checks whether the heap is empty.
     *
     * @link  http://php.net/manual/en/splheap.isempty.php
     * @return bool whether the heap is empty.
     * @since 5.3.0
     */
    public function isEmpty() { }

    /**
     * Return current node index
     *
     * @link  http://php.net/manual/en/splheap.key.php
     * @return mixed The current node index.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to the next node
     *
     * @link  http://php.net/manual/en/splheap.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Recover from the corrupted state and allow further actions on the heap.
     *
     * @link  http://php.net/manual/en/splheap.recoverfromcorruption.php
     * @return void
     * @since 5.3.0
     */
    public function recoverFromCorruption() { }

    /**
     * Rewind iterator back to the start (no-op)
     *
     * @link  http://php.net/manual/en/splheap.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Peeks at the node from the top of the heap
     *
     * @link  http://php.net/manual/en/splheap.top.php
     * @return mixed The value of the node on the top.
     * @since 5.3.0
     */
    public function top() { }

    /**
     * Check whether the heap contains more nodes
     *
     * @link  http://php.net/manual/en/splheap.valid.php
     * @return bool true if the heap contains any more nodes, false otherwise.
     * @since 5.3.0
     */
    public function valid() { }

    /**
     * Compare elements in order to place them correctly in the heap while sifting up.
     *
     * @link  http://php.net/manual/en/splheap.compare.php
     *
     * @param mixed $value1 <p>
     *                      The value of the first node being compared.
     *                      </p>
     * @param mixed $value2 <p>
     *                      The value of the second node being compared.
     *                      </p>
     *
     * @return int Result of the comparison, positive integer if <i>value1</i> is greater than <i>value2</i>, 0 if they
     *             are equal, negative integer otherwise.
     * </p>
     * <p>
     * Having multiple elements with the same value in a Heap is not recommended. They will end up in an arbitrary
     * relative position.
     * @since 5.3.0
     */
    abstract protected function compare($value1, $value2);
}

/**
 * The SplMaxHeap class provides the main functionalities of a heap, keeping the maximum on the top.
 *
 * @link http://php.net/manual/en/class.splmaxheap.php
 */
class SplMaxHeap extends SplHeap implements Traversable
{
    /**
     * Compare elements in order to place them correctly in the heap while sifting up.
     *
     * @link  http://php.net/manual/en/splmaxheap.compare.php
     *
     * @param mixed $value1 <p>
     *                      The value of the first node being compared.
     *                      </p>
     * @param mixed $value2 <p>
     *                      The value of the second node being compared.
     *                      </p>
     *
     * @return void Result of the comparison, positive integer if <i>value1</i> is greater than <i>value2</i>, 0 if
     *              they are equal, negative integer otherwise.
     * </p>
     * <p>
     * Having multiple elements with the same value in a Heap is not recommended. They will end up in an arbitrary
     * relative position.
     * @since 5.3.0
     */
    protected function compare($value1, $value2) { }
}

/**
 * The SplMinHeap class provides the main functionalities of a heap, keeping the minimum on the top.
 *
 * @link http://php.net/manual/en/class.splminheap.php
 */
class SplMinHeap extends SplHeap implements Traversable
{
    /**
     * Counts the number of elements in the heap.
     *
     * @link  http://php.net/manual/en/splheap.count.php
     * @return int the number of elements in the heap.
     * @since 5.3.0
     */
    public function count() { }

    /**
     * Return current node pointed by the iterator
     *
     * @link  http://php.net/manual/en/splheap.current.php
     * @return mixed The current node value.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Extracts a node from top of the heap and sift up.
     *
     * @link  http://php.net/manual/en/splheap.extract.php
     * @return mixed The value of the extracted node.
     * @since 5.3.0
     */
    public function extract() { }

    /**
     * Inserts an element in the heap by sifting it up.
     *
     * @link  http://php.net/manual/en/splheap.insert.php
     *
     * @param mixed $value <p>
     *                     The value to insert.
     *                     </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function insert($value) { }

    /**
     * Checks whether the heap is empty.
     *
     * @link  http://php.net/manual/en/splheap.isempty.php
     * @return bool whether the heap is empty.
     * @since 5.3.0
     */
    public function isEmpty() { }

    /**
     * Return current node index
     *
     * @link  http://php.net/manual/en/splheap.key.php
     * @return mixed The current node index.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to the next node
     *
     * @link  http://php.net/manual/en/splheap.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Recover from the corrupted state and allow further actions on the heap.
     *
     * @link  http://php.net/manual/en/splheap.recoverfromcorruption.php
     * @return void
     * @since 5.3.0
     */
    public function recoverFromCorruption() { }

    /**
     * Rewind iterator back to the start (no-op)
     *
     * @link  http://php.net/manual/en/splheap.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Peeks at the node from the top of the heap
     *
     * @link  http://php.net/manual/en/splheap.top.php
     * @return mixed The value of the node on the top.
     * @since 5.3.0
     */
    public function top() { }

    /**
     * Check whether the heap contains more nodes
     *
     * @link  http://php.net/manual/en/splheap.valid.php
     * @return bool true if the heap contains any more nodes, false otherwise.
     * @since 5.3.0
     */
    public function valid() { }

    /**
     * Compare elements in order to place them correctly in the heap while sifting up.
     *
     * @link  http://php.net/manual/en/splminheap.compare.php
     *
     * @param mixed $value1 <p>
     *                      The value of the first node being compared.
     *                      </p>
     * @param mixed $value2 <p>
     *                      The value of the second node being compared.
     *                      </p>
     *
     * @return void Result of the comparison, positive integer if <i>value1</i> is lower than <i>value2</i>, 0 if they
     *              are equal, negative integer otherwise.
     * </p>
     * <p>
     * Having multiple elements with the same value in a Heap is not recommended. They will end up in an arbitrary
     * relative position.
     * @since 5.3.0
     */
    protected function compare($value1, $value2) { }
}

/**
 * The SplObjectStorage class provides a map from objects to data or, by
 * ignoring data, an object set. This dual purpose can be useful in many
 * cases involving the need to uniquely identify objects.
 *
 * @link http://php.net/manual/en/class.splobjectstorage.php
 */
class SplObjectStorage implements Countable, Iterator, Serializable, ArrayAccess
{
    /**
     * Adds all objects from another storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.addall.php
     *
     * @param SplObjectStorage $storage <p>
     *                                  The storage you want to import.
     *                                  </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function addAll($storage) { }

    /**
     * Adds an object in the storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.attach.php
     *
     * @param object $object <p>
     *                       The object to add.
     *                       </p>
     * @param mixed  $data   [optional] <p>
     *                       The data to associate with the object.
     *                       </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function attach($object, $data = null) { }

    /**
     * Checks if the storage contains a specific object
     *
     * @link  http://php.net/manual/en/splobjectstorage.contains.php
     *
     * @param object $object <p>
     *                       The object to look for.
     *                       </p>
     *
     * @return bool true if the object is in the storage, false otherwise.
     * @since 5.1.0
     */
    public function contains($object) { }

    /**
     * Returns the number of objects in the storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.count.php
     * @return int The number of objects in the storage.
     * @since 5.1.0
     */
    public function count() { }

    /**
     * Returns the current storage entry
     *
     * @link  http://php.net/manual/en/splobjectstorage.current.php
     * @return object The object at the current iterator position.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * Removes an object from the storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.detach.php
     *
     * @param object $object <p>
     *                       The object to remove.
     *                       </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function detach($object) { }

    /**
     * Calculate a unique identifier for the contained objects
     *
     * @link  http://php.net/manual/en/splobjectstorage.gethash.php
     *
     * @param $object <p>
     *                object whose identifier is to be calculated.
     *
     * @return string A string with the calculated identifier.
     * @since 5.4.0
     */
    public function getHash($object) { }

    /**
     * Returns the data associated with the current iterator entry
     *
     * @link  http://php.net/manual/en/splobjectstorage.getinfo.php
     * @return mixed The data associated with the current iterator position.
     * @since 5.3.0
     */
    public function getInfo() { }

    /**
     * Returns the index at which the iterator currently is
     *
     * @link  http://php.net/manual/en/splobjectstorage.key.php
     * @return int The index corresponding to the position of the iterator.
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Move to the next entry
     *
     * @link  http://php.net/manual/en/splobjectstorage.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Checks whether an object exists in the storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.offsetexists.php
     *
     * @param object $object <p>
     *                       The object to look for.
     *                       </p>
     *
     * @return bool true if the object exists in the storage,
     * and false otherwise.
     * @since 5.3.0
     */
    public function offsetExists($object) { }

    /**
     * Returns the data associated with an <type>object</type>
     *
     * @link  http://php.net/manual/en/splobjectstorage.offsetget.php
     *
     * @param object $object <p>
     *                       The object to look for.
     *                       </p>
     *
     * @return mixed The data previously associated with the object in the storage.
     * @since 5.3.0
     */
    public function offsetGet($object) { }

    /**
     * Associates data to an object in the storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.offsetset.php
     *
     * @param object $object <p>
     *                       The object to associate data with.
     *                       </p>
     * @param mixed  $data   [optional] <p>
     *                       The data to associate with the object.
     *                       </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function offsetSet($object, $data = null) { }

    /**
     * Removes an object from the storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.offsetunset.php
     *
     * @param object $object <p>
     *                       The object to remove.
     *                       </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function offsetUnset($object) { }

    /**
     * Removes objects contained in another storage from the current storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.removeall.php
     *
     * @param SplObjectStorage $storage <p>
     *                                  The storage containing the elements to remove.
     *                                  </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function removeAll($storage) { }

    /**
     * Removes all objects except for those contained in another storage from the current storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.removeallexcept.php
     *
     * @param SplObjectStorage $storage <p>
     *                                  The storage containing the elements to retain in the current storage.
     *                                  </p>
     *
     * @return void
     * @since 5.3.6
     */
    public function removeAllExcept($storage) { }

    /**
     * Rewind the iterator to the first storage element
     *
     * @link  http://php.net/manual/en/splobjectstorage.rewind.php
     * @return void
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Serializes the storage
     *
     * @link  http://php.net/manual/en/splobjectstorage.serialize.php
     * @return string A string representing the storage.
     * @since 5.2.2
     */
    public function serialize() { }

    /**
     * Sets the data associated with the current iterator entry
     *
     * @link  http://php.net/manual/en/splobjectstorage.setinfo.php
     *
     * @param mixed $data <p>
     *                    The data to associate with the current iterator entry.
     *                    </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function setInfo($data) { }

    /**
     * Unserializes a storage from its string representation
     *
     * @link  http://php.net/manual/en/splobjectstorage.unserialize.php
     *
     * @param string $serialized <p>
     *                           The serialized representation of a storage.
     *                           </p>
     *
     * @return void
     * @since 5.2.2
     */
    public function unserialize($serialized) { }

    /**
     * Returns if the current iterator entry is valid
     *
     * @link  http://php.net/manual/en/splobjectstorage.valid.php
     * @return bool true if the iterator entry is valid, false otherwise.
     * @since 5.1.0
     */
    public function valid() { }
}

/**
 * The SplPriorityQueue class provides the main functionalities of an
 * prioritized queue, implemented using a heap.
 *
 * @link http://php.net/manual/en/class.splpriorityqueue.php
 */
class SplPriorityQueue implements Iterator, Countable
{
    const EXTR_BOTH = 3;
    const EXTR_DATA = 1;
    const EXTR_PRIORITY = 2;

    /**
     * Compare priorities in order to place elements correctly in the heap while sifting up.
     *
     * @link  http://php.net/manual/en/splpriorityqueue.compare.php
     *
     * @param mixed $priority1 <p>
     *                         The priority of the first node being compared.
     *                         </p>
     * @param mixed $priority2 <p>
     *                         The priority of the second node being compared.
     *                         </p>
     *
     * @return int Result of the comparison, positive integer if <i>priority1</i> is greater than <i>priority2</i>, 0
     *             if they are equal, negative integer otherwise.
     * </p>
     * <p>
     * Multiple elements with the same priority will get dequeued in no particular order.
     * @since 5.3.0
     */
    public function compare($priority1, $priority2) { }

    /**
     * Counts the number of elements in the queue.
     *
     * @link  http://php.net/manual/en/splpriorityqueue.count.php
     * @return int the number of elements in the queue.
     * @since 5.3.0
     */
    public function count() { }

    /**
     * Return current node pointed by the iterator
     *
     * @link  http://php.net/manual/en/splpriorityqueue.current.php
     * @return mixed The value or priority (or both) of the current node, depending on the extract flag.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Extracts a node from top of the heap and sift up.
     *
     * @link  http://php.net/manual/en/splpriorityqueue.extract.php
     * @return mixed The value or priority (or both) of the extracted node, depending on the extract flag.
     * @since 5.3.0
     */
    public function extract() { }

    /**
     * Inserts an element in the queue by sifting it up.
     *
     * @link  http://php.net/manual/en/splpriorityqueue.insert.php
     *
     * @param mixed $value    <p>
     *                        The value to insert.
     *                        </p>
     * @param mixed $priority <p>
     *                        The associated priority.
     *                        </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function insert($value, $priority) { }

    /**
     * Checks whether the queue is empty.
     *
     * @link  http://php.net/manual/en/splpriorityqueue.isempty.php
     * @return bool whether the queue is empty.
     * @since 5.3.0
     */
    public function isEmpty() { }

    /**
     * Return current node index
     *
     * @link  http://php.net/manual/en/splpriorityqueue.key.php
     * @return mixed The current node index.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to the next node
     *
     * @link  http://php.net/manual/en/splpriorityqueue.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Recover from the corrupted state and allow further actions on the queue.
     *
     * @link  http://php.net/manual/en/splpriorityqueue.recoverfromcorruption.php
     * @return void
     * @since 5.3.0
     */
    public function recoverFromCorruption() { }

    /**
     * Rewind iterator back to the start (no-op)
     *
     * @link  http://php.net/manual/en/splpriorityqueue.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Sets the mode of extraction
     *
     * @link  http://php.net/manual/en/splpriorityqueue.setextractflags.php
     *
     * @param int $flags <p>
     *                   Defines what is extracted by <b>SplPriorityQueue::current</b>,
     *                   <b>SplPriorityQueue::top</b> and
     *                   <b>SplPriorityQueue::extract</b>.
     *                   </p>
     *                   <b>SplPriorityQueue::EXTR_DATA</b> (0x00000001): Extract the data
     *
     * @return void
     * @since 5.3.0
     */
    public function setExtractFlags($flags) { }

    /**
     * Peeks at the node from the top of the queue
     *
     * @link  http://php.net/manual/en/splpriorityqueue.top.php
     * @return mixed The value or priority (or both) of the top node, depending on the extract flag.
     * @since 5.3.0
     */
    public function top() { }

    /**
     * Check whether the queue contains more nodes
     *
     * @link  http://php.net/manual/en/splpriorityqueue.valid.php
     * @return bool true if the queue contains any more nodes, false otherwise.
     * @since 5.3.0
     */
    public function valid() { }
}

/**
 * The SplQueue class provides the main functionalities of a queue implemented using a doubly linked list.
 *
 * @link http://php.net/manual/en/class.splqueue.php
 */
class SplQueue extends SplDoublyLinkedList implements Traversable
{
    /**
     * Dequeues a node from the queue
     *
     * @link  http://php.net/manual/en/splqueue.dequeue.php
     * @return mixed The value of the dequeued node.
     * @since 5.3.0
     */
    public function dequeue() { }

    /**
     * Adds an element to the queue.
     *
     * @link  http://php.net/manual/en/splqueue.enqueue.php
     *
     * @param mixed $value <p>
     *                     The value to enqueue.
     *                     </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function enqueue($value) { }

    /**
     * Sets the mode of iteration
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.setiteratormode.php
     *
     * @param int $mode <p>
     *                  There are two orthogonal sets of modes that can be set:
     *                  </p>
     *                  The direction of the iteration (either one or the other):
     *
     * @since 5.3.0
     * <b>SplDoublyLinkedList::IT_MODE_LIFO</b> (Stack style)
     * @return void
     */
    public function setIteratorMode($mode) { }
}

/**
 * The SplStack class provides the main functionalities of a stack implemented using a doubly linked list.
 *
 * @link http://php.net/manual/en/class.splstack.php
 */
class SplStack extends SplDoublyLinkedList implements Traversable
{
    /**
     * Sets the mode of iteration
     *
     * @link  http://php.net/manual/en/spldoublylinkedlist.setiteratormode.php
     *
     * @param int $mode <p>
     *                  There are two orthogonal sets of modes that can be set:
     *                  </p>
     *                  The direction of the iteration (either one or the other):
     *                  <b>SplDoublyLinkedList::IT_MODE_LIFO</b> (Stack style)
     *
     * @return void
     * @since 5.3.0
     */
    public function setIteratorMode($mode) { }
}
