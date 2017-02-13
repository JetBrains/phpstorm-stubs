<?php
/**
 * PHPStorm stub file for Standard PHP Library(SPL) Iterator classes.
 *
 * @link http://php.net/manual/en/spl.iterators.php
 */

/**
 * An Iterator that iterates over several iterators one after the other.
 *
 * @link http://php.net/manual/en/class.appenditerator.php
 */
class AppendIterator extends IteratorIterator
{
    /**
     * Constructs an AppendIterator
     *
     * @link  http://php.net/manual/en/appenditerator.construct.php
     * @since 5.1.0
     */
    public function __construct() { }

    /**
     * Appends an iterator
     *
     * @link  http://php.net/manual/en/appenditerator.append.php
     *
     * @param Iterator $iterator <p>
     *                           The iterator to append.
     *                           </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function append(Iterator $iterator) { }

    /**
     * Gets the current value
     *
     * @link  http://php.net/manual/en/appenditerator.current.php
     * @return mixed The current value if it is valid or &null; otherwise.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * The getArrayIterator method
     *
     * @link  http://php.net/manual/en/appenditerator.getarrayiterator.php
     * @return ArrayIterator containing the appended iterators.
     * @since 5.1.0
     */
    public function getArrayIterator() { }

    /**
     * Gets an inner iterator
     *
     * @link  http://php.net/manual/en/appenditerator.getinneriterator.php
     * @return Iterator the current inner Iterator.
     * @since 5.1.0
     */
    public function getInnerIterator() { }

    /**
     * Gets an index of iterators
     *
     * @link  http://php.net/manual/en/appenditerator.getiteratorindex.php
     * @return int The index of iterators.
     * @since 5.1.0
     */
    public function getIteratorIndex() { }

    /**
     * Gets the current key
     *
     * @link  http://php.net/manual/en/appenditerator.key.php
     * @return mixed The current key if it is valid or null otherwise.
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Moves to the next element
     *
     * @link  http://php.net/manual/en/appenditerator.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Rewinds the Iterator
     *
     * @link  http://php.net/manual/en/appenditerator.rewind.php
     * @return void
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Checks validity of the current element
     *
     * @link  http://php.net/manual/en/appenditerator.valid.php
     * @return bool true on success or false on failure.
     * @since 5.1.0
     */
    public function valid() { }
}

/**
 * This iterator allows to unset and modify values and keys while iterating
 * over Arrays and Objects.
 *
 * @link http://php.net/manual/en/class.arrayiterator.php
 */
class ArrayIterator implements Iterator, ArrayAccess, SeekableIterator, Serializable, Countable
{
    const ARRAY_AS_PROPS = 2;
    const STD_PROP_LIST = 1;

    /**
     * Construct an ArrayIterator
     *
     * @link  http://php.net/manual/en/arrayiterator.construct.php
     *
     * @param array $array The array or object to be iterated on.
     * @param int   $flags Flags to control the behaviour of the ArrayObject object.
     *
     * @see   ArrayObject::setFlags()
     * @since 5.0.0
     */
    public function __construct(array $array = [], $flags = 0) { }

    /**
     * Append an element
     *
     * @link  http://php.net/manual/en/arrayiterator.append.php
     *
     * @param mixed $value <p>
     *                     The value to append.
     *                     </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function append($value) { }

    /**
     * Sort array by values
     *
     * @link  http://php.net/manual/en/arrayiterator.asort.php
     * @return void
     * @since 5.2.0
     */
    public function asort() { }

    /**
     * Count elements
     *
     * @link  http://php.net/manual/en/arrayiterator.count.php
     * @return int The number of elements or public properties in the associated
     * array or object, respectively.
     * @since 5.0.0
     */
    public function count() { }

    /**
     * Return current array entry
     *
     * @link  http://php.net/manual/en/arrayiterator.current.php
     * @return mixed The current array entry.
     * @since 5.0.0
     */
    public function current() { }

    /**
     * Get array copy
     *
     * @link  http://php.net/manual/en/arrayiterator.getarraycopy.php
     * @return array A copy of the array, or array of public properties
     * if ArrayIterator refers to an object.
     * @since 5.0.0
     */
    public function getArrayCopy() { }

    /**
     * Get flags
     *
     * @link  http://php.net/manual/en/arrayiterator.getflags.php
     * @return string The current flags.
     * @since 5.1.0
     */
    public function getFlags() { }

    /**
     * Return current array key
     *
     * @link  http://php.net/manual/en/arrayiterator.key.php
     * @return mixed The current array key.
     * @since 5.0.0
     */
    public function key() { }

    /**
     * Sort array by keys
     *
     * @link  http://php.net/manual/en/arrayiterator.ksort.php
     * @return void
     * @since 5.2.0
     */
    public function ksort() { }

    /**
     * Sort an array naturally, case insensitive
     *
     * @link  http://php.net/manual/en/arrayiterator.natcasesort.php
     * @return void
     * @since 5.2.0
     */
    public function natcasesort() { }

    /**
     * Sort an array naturally
     *
     * @link  http://php.net/manual/en/arrayiterator.natsort.php
     * @return void
     * @since 5.2.0
     */
    public function natsort() { }

    /**
     * Move to next entry
     *
     * @link  http://php.net/manual/en/arrayiterator.next.php
     * @return void
     * @since 5.0.0
     */
    public function next() { }

    /**
     * Check if offset exists
     *
     * @link  http://php.net/manual/en/arrayiterator.offsetexists.php
     *
     * @param string $index <p>
     *                      The offset being checked.
     *                      </p>
     *
     * @return bool true if the offset exists, otherwise false
     * @since 5.0.0
     */
    public function offsetExists($index) { }

    /**
     * Get value for an offset
     *
     * @link  http://php.net/manual/en/arrayiterator.offsetget.php
     *
     * @param string $index <p>
     *                      The offset to get the value from.
     *                      </p>
     *
     * @return mixed The value at offset <i>index</i>.
     * @since 5.0.0
     */
    public function offsetGet($index) { }

    /**
     * Set value for an offset
     *
     * @link  http://php.net/manual/en/arrayiterator.offsetset.php
     *
     * @param string $index  <p>
     *                       The index to set for.
     *                       </p>
     * @param string $newval <p>
     *                       The new value to store at the index.
     *                       </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($index, $newval) { }

    /**
     * Unset value for an offset
     *
     * @link  http://php.net/manual/en/arrayiterator.offsetunset.php
     *
     * @param string $index <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($index) { }

    /**
     * Rewind array back to the start
     *
     * @link  http://php.net/manual/en/arrayiterator.rewind.php
     * @return void
     * @since 5.0.0
     */
    public function rewind() { }

    /**
     * Seek to position
     *
     * @link  http://php.net/manual/en/arrayiterator.seek.php
     *
     * @param int $position <p>
     *                      The position to seek to.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function seek($position) { }

    /**
     * Serialize
     *
     * @link  http://php.net/manual/en/arrayiterator.serialize.php
     * @return string The serialized <b>ArrayIterator</b>.
     * @since 5.3.0
     */
    public function serialize() { }

    /**
     * Set behaviour flags
     *
     * @link  http://php.net/manual/en/arrayiterator.setflags.php
     *
     * @param string $flags <p>
     *                      A bitmask as follows:
     *                      0 = Properties of the object have their normal functionality
     *                      when accessed as list (var_dump, foreach, etc.).
     *                      1 = Array indices can be accessed as properties in read/write.
     *                      </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function setFlags($flags) { }

    /**
     * User defined sort
     *
     * @link  http://php.net/manual/en/arrayiterator.uasort.php
     *
     * @param string $cmp_function <p>
     *                             The compare function used for the sort.
     *                             </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function uasort($cmp_function) { }

    /**
     * User defined sort
     *
     * @link  http://php.net/manual/en/arrayiterator.uksort.php
     *
     * @param string $cmp_function <p>
     *                             The compare function used for the sort.
     *                             </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function uksort($cmp_function) { }

    /**
     * Unserialize
     *
     * @link  http://php.net/manual/en/arrayiterator.unserialize.php
     *
     * @param string $serialized <p>
     *                           The serialized ArrayIterator object to be unserialized.
     *                           </p>
     *
     * @return string The <b>ArrayIterator</b>.
     * @since 5.3.0
     */
    public function unserialize($serialized) { }

    /**
     * Check whether array contains more entries
     *
     * @link  http://php.net/manual/en/arrayiterator.valid.php
     * @return bool
     * @since 5.0.0
     */
    public function valid() { }
}

/**
 * This object supports cached iteration over another iterator.
 *
 * @link http://php.net/manual/en/class.cachingiterator.php
 */
class CachingIterator extends IteratorIterator implements ArrayAccess, Countable
{
    const CALL_TOSTRING = 1;
    const CATCH_GET_CHILD = 16;
    const FULL_CACHE = 256;
    const TOSTRING_USE_CURRENT = 4;
    const TOSTRING_USE_INNER = 8;
    const TOSTRING_USE_KEY = 2;

    /**
     * Construct a new CachingIterator object for the iterator.
     *
     * @link  http://php.net/manual/en/cachingiterator.construct.php
     *
     * @param Iterator $iterator
     * @param          $flags [optional]
     *
     * @since 5.0
     */
    public function __construct(Iterator $iterator, $flags = self::CALL_TOSTRING) { }

    /**
     * Return the string representation of the current element
     *
     * @link  http://php.net/manual/en/cachingiterator.tostring.php
     * @return string The string representation of the current element.
     * @since 5.0
     */
    public function __toString() { }

    /**
     * The number of elements in the iterator
     *
     * @link  http://php.net/manual/en/cachingiterator.count.php
     * @return void The count of the elements iterated over.
     * @since 5.2.2
     */
    public function count() { }

    /**
     * Return the current element
     *
     * @link  http://php.net/manual/en/cachingiterator.current.php
     * @return mixed
     * @since 5.0
     */
    public function current() { }

    /**
     * The getCache purpose
     *
     * @link  http://php.net/manual/en/cachingiterator.getcache.php
     * @return array Description...
     * @since 5.2.0
     */
    public function getCache() { }

    /**
     * Get flags used
     *
     * @link  http://php.net/manual/en/cachingiterator.getflags.php
     * @return int Bitmask of the flags
     * @since 5.2.0
     */
    public function getFlags() { }

    /**
     * Returns the inner iterator
     *
     * @link  http://php.net/manual/en/cachingiterator.getinneriterator.php
     * @return Iterator an object implementing the Iterator interface.
     * @since 5.0
     */
    public function getInnerIterator() { }

    /**
     * Check whether the inner iterator has a valid next element
     *
     * @link  http://php.net/manual/en/cachingiterator.hasnext.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function hasNext() { }

    /**
     * Return the key for the current element
     *
     * @link  http://php.net/manual/en/cachingiterator.key.php
     * @return mixed
     * @since 5.0
     */
    public function key() { }

    /**
     * Move the iterator forward
     *
     * @link  http://php.net/manual/en/cachingiterator.next.php
     * @return void
     * @since 5.0
     */
    public function next() { }

    /**
     * The offsetExists purpose
     *
     * @link  http://php.net/manual/en/cachingiterator.offsetexists.php
     *
     * @param string $index <p>
     *                      The index being checked.
     *                      </p>
     *
     * @return bool true if an entry referenced by the offset exists, false otherwise.
     * @since 5.2.0
     */
    public function offsetExists($index) { }

    /**
     * The offsetGet purpose
     *
     * @link  http://php.net/manual/en/cachingiterator.offsetget.php
     *
     * @param string $index <p>
     *                      Description...
     *                      </p>
     *
     * @return void Description...
     * @since 5.2.0
     */
    public function offsetGet($index) { }

    /**
     * The offsetSet purpose
     *
     * @link  http://php.net/manual/en/cachingiterator.offsetset.php
     *
     * @param string $index  <p>
     *                       The index of the element to be set.
     *                       </p>
     * @param string $newval <p>
     *                       The new value for the <i>index</i>.
     *                       </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function offsetSet($index, $newval) { }

    /**
     * The offsetUnset purpose
     *
     * @link  http://php.net/manual/en/cachingiterator.offsetunset.php
     *
     * @param string $index <p>
     *                      The index of the element to be unset.
     *                      </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function offsetUnset($index) { }

    /**
     * Rewind the iterator
     *
     * @link  http://php.net/manual/en/cachingiterator.rewind.php
     * @return void
     * @since 5.0
     */
    public function rewind() { }

    /**
     * The setFlags purpose
     *
     * @link  http://php.net/manual/en/cachingiterator.setflags.php
     *
     * @param int $flags Bitmask of the flags to set.
     *
     * @return void
     * @since 5.2.0
     */
    public function setFlags($flags) { }

    /**
     * Check whether the current element is valid
     *
     * @link  http://php.net/manual/en/cachingiterator.valid.php
     * @return bool true on success or false on failure.
     * @since 5.0
     */
    public function valid() { }
}

/**
 * Filtered iterator using the callback to determine which items are accepted or rejected.
 *
 * @link  http://www.php.net/manual/en/class.callbackfilteriterator.php
 * @since 5.4.0
 */
class CallbackFilterIterator extends FilterIterator implements Iterator
{
    /**
     * Creates a filtered iterator using the callback to determine which items are accepted or rejected.
     *
     * @param Iterator $iterator The iterator to be filtered.
     * @param callable $callback The callback, which should return TRUE to accept the current item or FALSE otherwise.
     *                           May be any valid callable value.
     *                           The callback should accept up to three arguments: the current item, the current key
     *                           and the iterator, respectively.
     *                           <code> function my_callback($current, $key, $iterator) </code>
     *
     * @link http://www.php.net/manual/en/callbackfilteriterator.construct.php
     */
    public function __construct(Iterator $iterator, callable $callback) { }

    /**
     * This method calls the callback with the current value, current key and the inner iterator.
     * The callback is expected to return TRUE if the current item is to be accepted, or FALSE otherwise.
     *
     * @link http://www.php.net/manual/en/callbackfilteriterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     */
    public function accept() { }
}

/**
 * The DirectoryIterator class provides a simple interface for viewing
 * the contents of filesystem directories.
 *
 * @link http://php.net/manual/en/class.directoryiterator.php
 */
class DirectoryIterator extends SplFileInfo implements Iterator, SeekableIterator
{
    /**
     * Constructs a new directory iterator from a path
     *
     * @link  http://php.net/manual/en/directoryiterator.construct.php
     *
     * @param $path
     *
     * @since 5.0
     */
    public function __construct($path) { }

    /**
     * Return the current DirectoryIterator item.
     *
     * @link  http://php.net/manual/en/directoryiterator.current.php
     * @return DirectoryIterator The current <b>DirectoryIterator</b> item.
     * @since 5.0
     */
    public function current() { }

    /**
     * Determine if current DirectoryIterator item is '.' or '..'
     *
     * @link  http://php.net/manual/en/directoryiterator.isdot.php
     * @return bool true if the entry is . or ..,
     * otherwise false
     * @since 5.0
     */
    public function isDot() { }

    /**
     * Return the key for the current DirectoryIterator item
     *
     * @link  http://php.net/manual/en/directoryiterator.key.php
     * @return string The key for the current <b>DirectoryIterator</b> item.
     * @since 5.0
     */
    public function key() { }

    /**
     * Move forward to next DirectoryIterator item
     *
     * @link  http://php.net/manual/en/directoryiterator.next.php
     * @return void
     * @since 5.0
     */
    public function next() { }

    /**
     * Rewind the DirectoryIterator back to the start
     *
     * @link  http://php.net/manual/en/directoryiterator.rewind.php
     * @return void
     * @since 5.0
     */
    public function rewind() { }

    /**
     * Seek to a DirectoryIterator item
     *
     * @link  http://php.net/manual/en/directoryiterator.seek.php
     *
     * @param int $position <p>
     *                      The zero-based numeric position to seek to.
     *                      </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function seek($position) { }

    /**
     * Check whether current DirectoryIterator position is a valid file
     *
     * @link  http://php.net/manual/en/directoryiterator.valid.php
     * @return bool true if the position is valid, otherwise false
     * @since 5.0
     */
    public function valid() { }
}

/**
 * The EmptyIterator class for an empty iterator.
 *
 * @link http://www.php.net/manual/en/class.emptyiterator.php
 */
class EmptyIterator implements Iterator
{
    /**
     * Return the current element
     *
     * @link  http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current() { }

    /**
     * Return the key of the current element
     *
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key() { }

    /**
     * Move forward to next element
     *
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next() { }

    /**
     * Rewind the Iterator to the first element
     *
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind() { }

    /**
     * Checks if current position is valid
     *
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid() { }
}

/**
 * The Filesystem iterator
 *
 * @link http://php.net/manual/en/class.filesystemiterator.php
 */
class FilesystemIterator extends DirectoryIterator implements Traversable
{
    const CURRENT_AS_FILEINFO = 0;
    const CURRENT_AS_PATHNAME = 32;
    const CURRENT_AS_SELF = 16;
    const CURRENT_MODE_MASK = 240;
    const FOLLOW_SYMLINKS = 512;
    const KEY_AS_FILENAME = 256;
    const KEY_AS_PATHNAME = 0;
    const KEY_MODE_MASK = 3840;
    const NEW_CURRENT_AND_KEY = 256;
    const SKIP_DOTS = 4096;
    const UNIX_PATHS = 8192;

    /**
     * Constructs a new filesystem iterator
     *
     * @link  http://php.net/manual/en/filesystemiterator.construct.php
     *
     * @param $path
     * @param $flags [optional]
     *
     * @since 5.3.0
     */
    public function __construct($path, $flags) { }

    /**
     * The current file
     *
     * @link  http://php.net/manual/en/filesystemiterator.current.php
     * @return mixed The filename, file information, or $this depending on the set flags.
     * See the FilesystemIterator constants.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Get the handling flags
     *
     * @link  http://php.net/manual/en/filesystemiterator.getflags.php
     * @return int The integer value of the set flags.
     * @since 5.3.0
     */
    public function getFlags() { }

    /**
     * Retrieve the key for the current file
     *
     * @link  http://php.net/manual/en/filesystemiterator.key.php
     * @return string the pathname or filename depending on the set flags.
     * See the FilesystemIterator constants.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to the next file
     *
     * @link  http://php.net/manual/en/filesystemiterator.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Rewinds back to the beginning
     *
     * @link  http://php.net/manual/en/filesystemiterator.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Sets handling flags
     *
     * @link  http://php.net/manual/en/filesystemiterator.setflags.php
     *
     * @param int $flags [optional] <p>
     *                   The handling flags to set.
     *                   See the FilesystemIterator constants.
     *                   </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function setFlags($flags = null) { }
}

/**
 * This abstract iterator filters out unwanted values. This class should be extended to
 * implement custom iterator filters. The <b>FilterIterator::accept</b>
 * must be implemented in the subclass.
 *
 * @link http://php.net/manual/en/class.filteriterator.php
 */
abstract class FilterIterator extends IteratorIterator
{
    /**
     * Construct a filterIterator
     *
     * @link  http://php.net/manual/en/filteriterator.construct.php
     *
     * @param Iterator $iterator
     *
     * @since 5.1.0
     */
    public function __construct(Iterator $iterator) { }

    /**
     * Check whether the current element of the iterator is acceptable
     *
     * @link  http://php.net/manual/en/filteriterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     * @since 5.1.0
     */
    abstract public function accept();

    /**
     * Get the current element value
     *
     * @link  http://php.net/manual/en/filteriterator.current.php
     * @return mixed The current element value.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * Get the inner iterator
     *
     * @link  http://php.net/manual/en/filteriterator.getinneriterator.php
     * @return Iterator The inner iterator.
     * @since 5.1.0
     */
    public function getInnerIterator() { }

    /**
     * Get the current key
     *
     * @link  http://php.net/manual/en/filteriterator.key.php
     * @return mixed The current key.
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Move the iterator forward
     *
     * @link  http://php.net/manual/en/filteriterator.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Rewind the iterator
     *
     * @link  http://php.net/manual/en/filteriterator.rewind.php
     * @return void
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Check whether the current element is valid
     *
     * @link  http://php.net/manual/en/filteriterator.valid.php
     * @return bool true if the current element is valid, otherwise false
     * @since 5.1.0
     */
    public function valid() { }
}

/**
 * Iterates through a file system in a similar fashion to
 * <b>glob</b>.
 *
 * @link http://php.net/manual/en/class.globiterator.php
 */
class GlobIterator extends FilesystemIterator implements Iterator, SeekableIterator, Countable
{
    /**
     * Construct a directory using glob
     *
     * @link  http://php.net/manual/en/globiterator.construct.php
     *
     * @param $path
     * @param $flags [optional]
     *
     * @since 5.3.0
     */
    public function __construct($path, $flags) { }

    /**
     * Get the number of directories and files
     *
     * @link  http://php.net/manual/en/globiterator.count.php
     * @return int The number of returned directories and files, as an
     * integer.
     * @since 5.3.0
     */
    public function count() { }
}

/**
 * The <b>InfiniteIterator</b> allows one to
 * infinitely iterate over an iterator without having to manually
 * rewind the iterator upon reaching its end.
 *
 * @link http://php.net/manual/en/class.infiniteiterator.php
 */
class InfiniteIterator extends IteratorIterator
{
    /**
     * Constructs an InfiniteIterator
     *
     * @link  http://php.net/manual/en/infiniteiterator.construct.php
     *
     * @param Iterator $iterator
     *
     * @since 5.1.0
     */
    public function __construct(Iterator $iterator) { }

    /**
     * Moves the inner Iterator forward or rewinds it
     *
     * @link  http://php.net/manual/en/infiniteiterator.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }
}

/**
 * This iterator wrapper allows the conversion of anything that is
 * Traversable into an Iterator.
 * It is important to understand that most classes that do not implement
 * Iterators have reasons as most likely they do not allow the full
 * Iterator feature set. If so, techniques should be provided to prevent
 * misuse, otherwise expect exceptions or fatal errors.
 *
 * @link http://php.net/manual/en/class.iteratoriterator.php
 */
class IteratorIterator implements Iterator, OuterIterator
{
    /**
     * Create an iterator from anything that is traversable
     *
     * @link  http://php.net/manual/en/iteratoriterator.construct.php
     *
     * @param Traversable $iterator
     *
     * @since 5.1.0
     */
    public function __construct(Traversable $iterator) { }

    /**
     * Get the current value
     *
     * @link  http://php.net/manual/en/iteratoriterator.current.php
     * @return mixed The value of the current element.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * Get the inner iterator
     *
     * @link  http://php.net/manual/en/iteratoriterator.getinneriterator.php
     * @return Iterator The inner iterator as passed to IteratorIterator::__construct.
     * @since 5.1.0
     */
    public function getInnerIterator() { }

    /**
     * Get the key of the current element
     *
     * @link  http://php.net/manual/en/iteratoriterator.key.php
     * @return mixed The key of the current element.
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Forward to the next element
     *
     * @link  http://php.net/manual/en/iteratoriterator.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Rewind to the first element
     *
     * @link  http://php.net/manual/en/iteratoriterator.rewind.php
     * @return void
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Checks if the iterator is valid
     *
     * @link  http://php.net/manual/en/iteratoriterator.valid.php
     * @return bool true if the iterator is valid, otherwise false
     * @since 5.1.0
     */
    public function valid() { }
}

/**
 * The <b>LimitIterator</b> class allows iteration over
 * a limited subset of items in an <b>Iterator</b>.
 *
 * @link http://php.net/manual/en/class.limititerator.php
 */
class LimitIterator extends IteratorIterator
{
    /**
     * Construct a LimitIterator
     *
     * @link  http://php.net/manual/en/limititerator.construct.php
     *
     * @param Iterator $iterator
     * @param          $offset [optional]
     * @param          $count  [optional]
     *
     * @since 5.1.0
     */
    public function __construct(Iterator $iterator, $offset, $count) { }

    /**
     * Get current element
     *
     * @link  http://php.net/manual/en/limititerator.current.php
     * @return mixed the current element or null if there is none.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * Get inner iterator
     *
     * @link  http://php.net/manual/en/limititerator.getinneriterator.php
     * @return Iterator The inner iterator passed to <b>LimitIterator::__construct</b>.
     * @since 5.1.0
     */
    public function getInnerIterator() { }

    /**
     * Return the current position
     *
     * @link  http://php.net/manual/en/limititerator.getposition.php
     * @return int The current position.
     * @since 5.1.0
     */
    public function getPosition() { }

    /**
     * Get current key
     *
     * @link  http://php.net/manual/en/limititerator.key.php
     * @return mixed the key for the current item.
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Move the iterator forward
     *
     * @link  http://php.net/manual/en/limititerator.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Rewind the iterator to the specified starting offset
     *
     * @link  http://php.net/manual/en/limititerator.rewind.php
     * @return void
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Seek to the given position
     *
     * @link  http://php.net/manual/en/limititerator.seek.php
     *
     * @param int $position <p>
     *                      The position to seek to.
     *                      </p>
     *
     * @return int the offset position after seeking.
     * @since 5.1.0
     */
    public function seek($position) { }

    /**
     * Check whether the current element is valid
     *
     * @link  http://php.net/manual/en/limititerator.valid.php
     * @return bool true on success or false on failure.
     * @since 5.1.0
     */
    public function valid() { }
}

/**
 * An Iterator that sequentially iterates over all attached iterators
 *
 * @link http://php.net/manual/en/class.multipleiterator.php
 */
class MultipleIterator implements Iterator
{
    const MIT_KEYS_ASSOC = 2;
    const MIT_KEYS_NUMERIC = 0;
    const MIT_NEED_ALL = 1;
    const MIT_NEED_ANY = 0;

    /**
     * Constructs a new MultipleIterator
     *
     * @link  http://php.net/manual/en/multipleiterator.construct.php
     *
     * @param $flags [optional] Defaults to MultipleIterator::MIT_NEED_ALL | MultipleIterator::MIT_KEYS_NUMERIC
     *
     * @since 5.3.0
     */
    public function __construct($flags) { }

    /**
     * Attaches iterator information
     *
     * @link  http://php.net/manual/en/multipleiterator.attachiterator.php
     *
     * @param Iterator $iterator <p>
     *                           The new iterator to attach.
     *                           </p>
     * @param string   $infos    [optional] <p>
     *                           The associative information for the Iterator, which must be an
     *                           integer, a string, or null.
     *                           </p>
     *
     * @return void Description...
     * @since 5.3.0
     */
    public function attachIterator(Iterator $iterator, $infos = null) { }

    /**
     * Checks if an iterator is attached
     *
     * @link  http://php.net/manual/en/multipleiterator.containsiterator.php
     *
     * @param Iterator $iterator <p>
     *                           The iterator to check.
     *                           </p>
     *
     * @return void true on success or false on failure.
     * @since 5.3.0
     */
    public function containsIterator(Iterator $iterator) { }

    /**
     * Gets the number of attached iterator instances
     *
     * @link  http://php.net/manual/en/multipleiterator.countiterators.php
     * @return void The number of attached iterator instances (as an integer).
     * @since 5.3.0
     */
    public function countIterators() { }

    /**
     * Gets the registered iterator instances
     *
     * @link  http://php.net/manual/en/multipleiterator.current.php
     * @return void An array of all registered iterator instances,
     * or false if no sub iterator is attached.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Detaches an iterator
     *
     * @link  http://php.net/manual/en/multipleiterator.detachiterator.php
     *
     * @param Iterator $iterator <p>
     *                           The iterator to detach.
     *                           </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function detachIterator(Iterator $iterator) { }

    /**
     * Gets the flag information
     *
     * @link  http://php.net/manual/en/multipleiterator.getflags.php
     * @return int Information about the flags, as an integer.
     * @since 5.3.0
     */
    public function getFlags() { }

    /**
     * Gets the registered iterator instances
     *
     * @link  http://php.net/manual/en/multipleiterator.key.php
     * @return array An array of all registered iterator instances,
     * or false if no sub iterator is attached.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Moves all attached iterator instances forward
     *
     * @link  http://php.net/manual/en/multipleiterator.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Rewinds all attached iterator instances
     *
     * @link  http://php.net/manual/en/multipleiterator.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Sets flags
     *
     * @link  http://php.net/manual/en/multipleiterator.setflags.php
     *
     * @param int $flags <p>
     *                   The flags to set, according to the
     *                   Flag Constants
     *                   </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function setFlags($flags) { }

    /**
     * Checks the validity of sub iterators
     *
     * @link  http://php.net/manual/en/multipleiterator.valid.php
     * @return void true if one or all sub iterators are valid depending on flags,
     * otherwise false
     * @since 5.3.0
     */
    public function valid() { }
}

/**
 * This iterator cannot be rewinded.
 *
 * @link http://php.net/manual/en/class.norewinditerator.php
 */
class NoRewindIterator extends IteratorIterator
{
    /**
     * Construct a NoRewindIterator
     *
     * @link  http://php.net/manual/en/norewinditerator.construct.php
     *
     * @param Iterator $iterator
     *
     * @since 5.1.0
     */
    public function __construct(Iterator $iterator) { }

    /**
     * Get the current value
     *
     * @link  http://php.net/manual/en/norewinditerator.current.php
     * @return mixed The current value.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * Get the inner iterator
     *
     * @link  http://php.net/manual/en/norewinditerator.getinneriterator.php
     * @return Iterator The inner iterator, as passed to <b>NoRewindIterator::__construct</b>.
     * @since 5.1.0
     */
    public function getInnerIterator() { }

    /**
     * Get the current key
     *
     * @link  http://php.net/manual/en/norewinditerator.key.php
     * @return mixed The current key.
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Forward to the next element
     *
     * @link  http://php.net/manual/en/norewinditerator.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Prevents the rewind operation on the inner iterator.
     *
     * @link  http://php.net/manual/en/norewinditerator.rewind.php
     * @return void
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Validates the iterator
     *
     * @link  http://php.net/manual/en/norewinditerator.valid.php
     * @return bool true on success or false on failure.
     * @since 5.1.0
     */
    public function valid() { }
}

/**
 * This extended FilterIterator allows a recursive iteration using RecursiveIteratorIterator that only shows those
 * elements which have children.
 *
 * @link http://php.net/manual/en/class.parentiterator.php
 */
class ParentIterator extends RecursiveFilterIterator
{
    /**
     * Constructs a ParentIterator
     *
     * @link  http://php.net/manual/en/parentiterator.construct.php
     *
     * @param RecursiveIterator $iterator
     *
     * @since 5.1.0
     */
    public function __construct(RecursiveIterator $iterator) { }

    /**
     * Determines acceptability
     *
     * @link  http://php.net/manual/en/parentiterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     * @since 5.1.0
     */
    public function accept() { }

    /**
     * Return the inner iterator's children contained in a RecursiveFilterIterator
     *
     * @link  http://php.net/manual/en/recursivefilteriterator.getchildren.php
     * @return ParentIterator containing the inner iterator's children.
     * @since 5.1.0
     */
    public function getChildren() { }

    /**
     * Check whether the inner iterator's current element has children
     *
     * @link  http://php.net/manual/en/recursivefilteriterator.haschildren.php
     * @return bool true if the inner iterator has children, otherwise false
     * @since 5.1.0
     */
    public function hasChildren() { }
}

/**
 * This iterator allows to unset and modify values and keys while iterating over Arrays and Objects
 * in the same way as the ArrayIterator. Additionally it is possible to iterate
 * over the current iterator entry.
 *
 * @link http://php.net/manual/en/class.recursivearrayiterator.php
 */
class RecursiveArrayIterator extends ArrayIterator implements RecursiveIterator
{
    const CHILD_ARRAYS_ONLY = 4;

    /**
     * Returns an iterator for the current entry if it is an array or an object.
     *
     * @link  http://php.net/manual/en/recursivearrayiterator.getchildren.php
     * @return RecursiveArrayIterator An iterator for the current entry, if it is an array or object.
     * @since 5.1.0
     */
    public function getChildren() { }

    /**
     * Returns whether current entry is an array or an object.
     *
     * @link  http://php.net/manual/en/recursivearrayiterator.haschildren.php
     * @return bool true if the current entry is an array or an object,
     * otherwise false is returned.
     * @since 5.1.0
     */
    public function hasChildren() { }
}

/**
 * ...
 * @link http://php.net/manual/en/class.recursivecachingiterator.php
 */
class RecursiveCachingIterator extends CachingIterator implements Iterator, OuterIterator, RecursiveIterator
{
    /**
     * Construct
     *
     * @link  http://php.net/manual/en/recursivecachingiterator.construct.php
     *
     * @param Iterator $iterator The iterator being used.
     * @param int      $flags    [optional] The flags. Use CALL_TOSTRING to call RecursiveCachingIterator::__toString()
     *                           for every element (the default), and/or CATCH_GET_CHILD to catch exceptions when
     *                           trying to get children.
     *
     * @since 5.1.0
     */
    public function __construct(Iterator $iterator, $flags = self::CALL_TOSTRING) { }

    /**
     * Return the inner iterator's children as a RecursiveCachingIterator
     *
     * @link  http://php.net/manual/en/recursivecachingiterator.getchildren.php
     * @return RecursiveCachingIterator The inner iterator's children, as a RecursiveCachingIterator.
     * @since 5.1.0
     */
    public function getChildren() { }

    /**
     * Check whether the current element of the inner iterator has children
     *
     * @link  http://php.net/manual/en/recursivecachingiterator.haschildren.php
     * @return bool true if the inner iterator has children, otherwise false
     * @since 5.1.0
     */
    public function hasChildren() { }
}

/**
 * (PHP 5 >= 5.4.0)<br>
 * RecursiveCallbackFilterIterator from a RecursiveIterator
 *
 * @link http://www.php.net/manual/en/class.recursivecallbackfilteriterator.php
 */
class RecursiveCallbackFilterIterator extends CallbackFilterIterator implements OuterIterator, RecursiveIterator
{
    /**
     * Create a RecursiveCallbackFilterIterator from a RecursiveIterator
     *
     * @param RecursiveIterator $iterator The recursive iterator to be filtered.
     * @param string            $callback The callback, which should return TRUE to accept the current item or FALSE
     *                                    otherwise. See Examples. May be any valid callable value.
     *
     * @link http://www.php.net/manual/en/recursivecallbackfilteriterator.getchildren.php
     */
    public function __construct(RecursiveIterator $iterator, $callback) { }

    /**
     * Returns an iterator for the current entry.
     *
     * @link http://www.php.net/manual/en/recursivecallbackfilteriterator.haschildren.php
     * @return RecursiveCallbackFilterIterator containing the children.
     */
    public function getChildren() { }

    /**
     * Check whether the inner iterator's current element has children
     *
     * @link http://php.net/manual/en/recursiveiterator.haschildren.php
     * @return bool Returns TRUE if the current element has children, FALSE otherwise.
     */
    public function hasChildren() { }
}

/**
 * The <b>RecursiveDirectoryIterator</b> provides
 * an interface for iterating recursively over filesystem directories.
 *
 * @link http://php.net/manual/en/class.recursivedirectoryiterator.php
 */
class RecursiveDirectoryIterator extends FilesystemIterator implements Iterator, SeekableIterator, RecursiveIterator
{
    /**
     * Constructs a RecursiveDirectoryIterator
     *
     * @link  http://php.net/manual/en/recursivedirectoryiterator.construct.php
     *
     * @param $path
     * @param $flags [optional]
     *
     * @since 5.1.2
     */
    public function __construct($path, $flags) { }

    /**
     * The current file
     *
     * @link  http://php.net/manual/en/filesystemiterator.current.php
     * @return mixed The filename, file information, or $this depending on the set flags.
     * See the FilesystemIterator constants.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * Returns an iterator for the current entry if it is a directory
     *
     * @link  http://php.net/manual/en/recursivedirectoryiterator.getchildren.php
     * @return Iterator An iterator for the current entry, if it is a directory.
     * @since 5.1.0
     */
    public function getChildren() { }

    /**
     * Get sub path
     *
     * @link  http://php.net/manual/en/recursivedirectoryiterator.getsubpath.php
     * @return string The sub path (sub directory).
     * @since 5.1.0
     */
    public function getSubPath() { }

    /**
     * Get sub path and name
     *
     * @link  http://php.net/manual/en/recursivedirectoryiterator.getsubpathname.php
     * @return string The sub path (sub directory) and filename.
     * @since 5.1.0
     */
    public function getSubPathname() { }

    /**
     * Returns whether current entry is a directory and not '.' or '..'
     *
     * @link  http://php.net/manual/en/recursivedirectoryiterator.haschildren.php
     *
     * @param bool $allow_links [optional] <p>
     *                          </p>
     *
     * @return bool whether the current entry is a directory, but not '.' or '..'
     * @since 5.0
     */
    public function hasChildren($allow_links = null) { }

    /**
     * Retrieve the key for the current file
     *
     * @link  http://php.net/manual/en/filesystemiterator.key.php
     * @return string the pathname or filename depending on the set flags.
     * See the FilesystemIterator constants.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to the next file
     *
     * @link  http://php.net/manual/en/filesystemiterator.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Rewinds back to the beginning
     *
     * @link  http://php.net/manual/en/filesystemiterator.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }
}

/**
 * This abstract iterator filters out unwanted values for a <b>RecursiveIterator</b>.
 * This class should be extended to implement custom filters.
 * The <b>RecursiveFilterIterator::accept</b> must be implemented in the subclass.
 *
 * @link http://php.net/manual/en/class.recursivefilteriterator.php
 */
abstract class RecursiveFilterIterator extends FilterIterator implements Iterator, OuterIterator, RecursiveIterator
{
    /**
     * Create a RecursiveFilterIterator from a RecursiveIterator
     *
     * @link  http://php.net/manual/en/recursivefilteriterator.construct.php
     *
     * @param RecursiveIterator $iterator
     *
     * @since 5.1.0
     */
    public function __construct(RecursiveIterator $iterator) { }

    /**
     * Return the inner iterator's children contained in a RecursiveFilterIterator
     *
     * @link  http://php.net/manual/en/recursivefilteriterator.getchildren.php
     * @return RecursiveFilterIterator containing the inner iterator's children.
     * @since 5.1.0
     */
    public function getChildren() { }

    /**
     * Check whether the inner iterator's current element has children
     *
     * @link  http://php.net/manual/en/recursivefilteriterator.haschildren.php
     * @return bool true if the inner iterator has children, otherwise false
     * @since 5.1.0
     */
    public function hasChildren() { }
}

/**
 * Can be used to iterate through recursive iterators.
 *
 * @link http://php.net/manual/en/class.recursiveiteratoriterator.php
 */
class RecursiveIteratorIterator implements Iterator, OuterIterator
{
    const CATCH_GET_CHILD = 16;
    const CHILD_FIRST = 2;
    const LEAVES_ONLY = 0;
    const SELF_FIRST = 1;

    /**
     * Construct a RecursiveIteratorIterator
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.construct.php
     *
     * @param Traversable $iterator
     * @param             $mode  [optional]
     * @param             $flags [optional]
     *
     * @since 5.1.3
     */
    public function __construct(Traversable $iterator, $mode, $flags) { }

    /**
     * Begin children
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.beginchildren.php
     * @return void
     * @since 5.1.0
     */
    public function beginChildren() { }

    /**
     * Begin Iteration
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.beginiteration.php
     * @return void
     * @since 5.1.0
     */
    public function beginIteration() { }

    /**
     * Get children
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.callgetchildren.php
     * @return RecursiveIterator A <b>RecursiveIterator</b>.
     * @since 5.1.0
     */
    public function callGetChildren() { }

    /**
     * Has children
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.callhaschildren.php
     * @return bool true if the element has children, otherwise false
     * @since 5.1.0
     */
    public function callHasChildren() { }

    /**
     * Access the current element value
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.current.php
     * @return mixed The current elements value.
     * @since 5.0
     */
    public function current() { }

    /**
     * End children
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.endchildren.php
     * @return void
     * @since 5.1.0
     */
    public function endChildren() { }

    /**
     * End Iteration
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.enditeration.php
     * @return void
     * @since 5.1.0
     */
    public function endIteration() { }

    /**
     * Get the current depth of the recursive iteration
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.getdepth.php
     * @return int The current depth of the recursive iteration.
     * @since 5.0
     */
    public function getDepth() { }

    /**
     * Get inner iterator
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.getinneriterator.php
     * @return Iterator The current active sub iterator.
     * @since 5.1.0
     */
    public function getInnerIterator() { }

    /**
     * Get max depth
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.getmaxdepth.php
     * @return mixed The maximum accepted depth, or false if any depth is allowed.
     * @since 5.1.0
     */
    public function getMaxDepth() { }

    /**
     * The current active sub iterator
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.getsubiterator.php
     *
     * @param $level [optional]
     *
     * @return RecursiveIterator The current active sub iterator.
     * @since 5.0
     */
    public function getSubIterator($level) { }

    /**
     * Access the current key
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.key.php
     * @return mixed The current key.
     * @since 5.0
     */
    public function key() { }

    /**
     * Move forward to the next element
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.next.php
     * @return void
     * @since 5.0
     */
    public function next() { }

    /**
     * Next element
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.nextelement.php
     * @return void
     * @since 5.1.0
     */
    public function nextElement() { }

    /**
     * Rewind the iterator to the first element of the top level inner iterator
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.rewind.php
     * @return void
     * @since 5.0
     */
    public function rewind() { }

    /**
     * Set max depth
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.setmaxdepth.php
     *
     * @param string $max_depth [optional] <p>
     *                          The maximum allowed depth. Default -1 is used
     *                          for any depth.
     *                          </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function setMaxDepth($max_depth) { }

    /**
     * Check whether the current position is valid
     *
     * @link  http://php.net/manual/en/recursiveiteratoriterator.valid.php
     * @return bool true if the current position is valid, otherwise false
     * @since 5.0
     */
    public function valid() { }
}

/**
 * This recursive iterator can filter another recursive iterator via a regular expression.
 *
 * @link http://php.net/manual/en/class.recursiveregexiterator.php
 */
class RecursiveRegexIterator extends RegexIterator implements RecursiveIterator
{
    /**
     * Creates a new RecursiveRegexIterator.
     *
     * @link  http://php.net/manual/en/recursiveregexiterator.construct.php
     *
     * @param RecursiveIterator $iterator   The iterator to apply this regex filter to.
     * @param string            $regex      The regular expression to match.
     * @param int               $mode       [optional] Operation mode, see RegexIterator::setMode() for a list of
     *                                      modes.
     * @param int               $flags      [optional] Special flags, see RegexIterator::setFlags() for a list of
     *                                      available flags.
     * @param int               $preg_flags [optional] The regular expression flags. These flags depend on the
     *                                      operation mode parameter
     *
     * @since 5.2.0
     */
    public function __construct(RecursiveIterator $iterator, $regex, $mode, $flags, $preg_flags) { }

    /**
     * Returns an iterator for the current entry.
     *
     * @link  http://php.net/manual/en/recursiveregexiterator.getchildren.php
     * @return RecursiveRegexIterator An iterator for the current entry, if it can be iterated over by the inner
     *                                iterator.
     * @since 5.2.0
     */
    public function getChildren() { }

    /**
     * Returns whether an iterator can be obtained for the current entry.
     *
     * @link  http://php.net/manual/en/recursiveregexiterator.haschildren.php
     * @return bool true if an iterator can be obtained for the current entry, otherwise returns false.
     * @since 5.2.0
     */
    public function hasChildren() { }
}

/**
 * Allows iterating over a <b>RecursiveIterator</b> to generate an ASCII graphic tree.
 *
 * @link http://php.net/manual/en/class.recursivetreeiterator.php
 */
class RecursiveTreeIterator extends RecursiveIteratorIterator
{
    const BYPASS_CURRENT = 4;
    const BYPASS_KEY = 8;
    const PREFIX_END_HAS_NEXT = 3;
    const PREFIX_END_LAST = 4;
    const PREFIX_LEFT = 0;
    const PREFIX_MID_HAS_NEXT = 1;
    const PREFIX_MID_LAST = 2;
    const PREFIX_RIGHT = 5;

    /**
     * Construct a RecursiveTreeIterator
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.construct.php
     *
     * @param RecursiveIterator|IteratorAggregate $iterator
     * @param int                                 $flags            [optional]
     * @param int                                 $caching_it_flags [optional]
     * @param int                                 $mode             [optional]
     *
     * @since 5.3.0
     */
    public function __construct(
        $iterator,
        $flags = RecursiveTreeIterator::BYPASS_KEY,
        $caching_it_flags = CachingIterator::CATCH_GET_CHILD,
        $mode = RecursiveIteratorIterator::SELF_FIRST
    ) {
    }

    /**
     * Begin children
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.beginchildren.php
     * @return void
     * @since 5.3.0
     */
    public function beginChildren() { }

    /**
     * Begin iteration
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.beginiteration.php
     * @return RecursiveIterator A <b>RecursiveIterator</b>.
     * @since 5.3.0
     */
    public function beginIteration() { }

    /**
     * Get children
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.callgetchildren.php
     * @return RecursiveIterator A <b>RecursiveIterator</b>.
     * @since 5.3.0
     */
    public function callGetChildren() { }

    /**
     * Has children
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.callhaschildren.php
     * @return bool true if there are children, otherwise false
     * @since 5.3.0
     */
    public function callHasChildren() { }

    /**
     * Get current element
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.current.php
     * @return string the current element prefixed and postfixed.
     * @since 5.3.0
     */
    public function current() { }

    /**
     * End children
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.endchildren.php
     * @return void
     * @since 5.3.0
     */
    public function endChildren() { }

    /**
     * End iteration
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.enditeration.php
     * @return void
     * @since 5.3.0
     */
    public function endIteration() { }

    /**
     * Get current entry
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.getentry.php
     * @return string the part of the tree built for the current element.
     * @since 5.3.0
     */
    public function getEntry() { }

    /**
     * Get the postfix
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.getpostfix.php
     * @return string to place after the current element.
     * @since 5.3.0
     */
    public function getPostfix() { }

    /**
     * Get the prefix
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.getprefix.php
     * @return string the string to place in front of current element
     * @since 5.3.0
     */
    public function getPrefix() { }

    /**
     * Get the key of the current element
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.key.php
     * @return string the current key prefixed and postfixed.
     * @since 5.3.0
     */
    public function key() { }

    /**
     * Move to next element
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.next.php
     * @return void
     * @since 5.3.0
     */
    public function next() { }

    /**
     * Next element
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.nextelement.php
     * @return void
     * @since 5.3.0
     */
    public function nextElement() { }

    /**
     * Rewind iterator
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.rewind.php
     * @return void
     * @since 5.3.0
     */
    public function rewind() { }

    /**
     * Set a part of the prefix
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.setprefixpart.php
     *
     * @param int    $part  <p>
     *                      One of the RecursiveTreeIterator::PREFIX_* constants.
     *                      </p>
     * @param string $value <p>
     *                      The value to assign to the part of the prefix specified in <i>part</i>.
     *                      </p>
     *
     * @return void
     * @since 5.3.0
     */
    public function setPrefixPart($part, $value) { }

    /**
     * Check validity
     *
     * @link  http://php.net/manual/en/recursivetreeiterator.valid.php
     * @return bool true if the current position is valid, otherwise false
     * @since 5.3.0
     */
    public function valid() { }
}

/**
 * This iterator can be used to filter another iterator based on a regular expression.
 *
 * @link http://php.net/manual/en/class.regexiterator.php
 */
class RegexIterator extends FilterIterator implements Iterator, OuterIterator
{
    /**
     * Return all matches for the current entry @see preg_match_all
     */
    const ALL_MATCHES = 2;
    /**
     * Return the first match for the current entry @see preg_match
     */
    const GET_MATCH = 1;
    /**
     * Only execute match (filter) for the current entry @see preg_match
     */
    const MATCH = 0;
    /**
     * Replace the current entry (Not fully implemented yet) @see preg_replace
     */
    const REPLACE = 4;
    /**
     * Returns the split values for the current entry @see preg_split
     */
    const SPLIT = 3;
    /**
     * Special flag: Match the entry key instead of the entry value.
     */
    const USE_KEY = 1;
    public $replacement;

    /**
     * Create a new RegexIterator
     *
     * @link  http://php.net/manual/en/regexiterator.construct.php
     *
     * @param Iterator $iterator   The iterator to apply this regex filter to.
     * @param string   $regex      The regular expression to match.
     * @param int      $mode       [optional] Operation mode, see RegexIterator::setMode() for a list of modes.
     * @param int      $flags      [optional] Special flags, see RegexIterator::setFlags() for a list of available
     *                             flags.
     * @param int      $preg_flags [optional] The regular expression flags. These flags depend on the operation mode
     *                             parameter
     *
     * @since 5.2.0
     */
    public function __construct(Iterator $iterator, $regex, $mode = self::MATCH, $flags = 0, $preg_flags = 0) { }

    /**
     * Get accept status
     *
     * @link  http://php.net/manual/en/regexiterator.accept.php
     * @return bool true if a match, false otherwise.
     * @since 5.2.0
     */
    public function accept() { }

    /**
     * Get flags
     *
     * @link  http://php.net/manual/en/regexiterator.getflags.php
     * @return int the set flags.
     * @since 5.2.0
     */
    public function getFlags() { }

    /**
     * Returns operation mode.
     *
     * @link  http://php.net/manual/en/regexiterator.getmode.php
     * @return int the operation mode.
     * @since 5.2.0
     */
    public function getMode() { }

    /**
     * Returns the regular expression flags.
     *
     * @link  http://php.net/manual/en/regexiterator.getpregflags.php
     * @return int a bitmask of the regular expression flags.
     * @since 5.2.0
     */
    public function getPregFlags() { }

    /**
     * Returns current regular expression
     *
     * @link  http://www.php.net/manual/en/regexiterator.getregex.php
     * @return string
     * @since 5.4.0
     */
    public function getRegex() { }

    /**
     * Sets the flags.
     *
     * @link  http://php.net/manual/en/regexiterator.setflags.php
     *
     * @param int $flags <p>
     *                   The flags to set, a bitmask of class constants.
     *                   </p>
     *                   <p>
     *                   The available flags are listed below. The actual
     *                   meanings of these flags are described in the
     *                   predefined constants.
     *                   <table>
     *                   <b>RegexIterator</b> flags
     *                   <tr valign="top">
     *                   <td>value</td>
     *                   <td>constant</td>
     *                   </tr>
     *                   <tr valign="top">
     *                   <td>1</td>
     *                   <td>
     *                   RegexIterator::USE_KEY
     *                   </td>
     *                   </tr>
     *                   </table>
     *                   </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function setFlags($flags) { }

    /**
     * Sets the operation mode.
     *
     * @link  http://php.net/manual/en/regexiterator.setmode.php
     *
     * @param int $mode <p>
     *                  The operation mode.
     *                  </p>
     *                  <p>
     *                  The available modes are listed below. The actual
     *                  meanings of these modes are described in the
     *                  predefined constants.
     *                  <table>
     *                  <b>RegexIterator</b> modes
     *                  <tr valign="top">
     *                  <td>value</td>
     *                  <td>constant</td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>0</td>
     *                  <td>
     *                  RegexIterator::MATCH
     *                  </td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>1</td>
     *                  <td>
     *                  RegexIterator::GET_MATCH
     *                  </td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>2</td>
     *                  <td>
     *                  RegexIterator::ALL_MATCHES
     *                  </td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>3</td>
     *                  <td>
     *                  RegexIterator::SPLIT
     *                  </td>
     *                  </tr>
     *                  <tr valign="top">
     *                  <td>4</td>
     *                  <td>
     *                  RegexIterator::REPLACE
     *                  </td>
     *                  </tr>
     *                  </table>
     *                  </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function setMode($mode) { }

    /**
     * Sets the regular expression flags.
     *
     * @link  http://php.net/manual/en/regexiterator.setpregflags.php
     *
     * @param int $preg_flags <p>
     *                        The regular expression flags. See <b>RegexIterator::__construct</b>
     *                        for an overview of available flags.
     *                        </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function setPregFlags($preg_flags) { }
}
