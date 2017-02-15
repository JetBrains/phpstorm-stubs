<?php
/**
 * PHPStorm stub file for Standard PHP Library(SPL) Miscellaneous Classes and Interfaces.
 *
 * @link http://php.net/manual/en/spl.misc.php
 */

/**
 * The <b>SplObserver</b> interface is used alongside
 * <b>SplSubject</b> to implement the Observer Design Pattern.
 *
 * @link http://php.net/manual/en/class.splobserver.php
 */
interface SplObserver
{
    /**
     * Receive update from subject
     *
     * @link  http://php.net/manual/en/splobserver.update.php
     *
     * @param SplSubject $subject <p>
     *                            The <b>SplSubject</b> notifying the observer of an update.
     *                            </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function update(SplSubject $subject);
}

/**
 * The <b>SplSubject</b> interface is used alongside
 * <b>SplObserver</b> to implement the Observer Design Pattern.
 *
 * @link http://php.net/manual/en/class.splsubject.php
 */
interface SplSubject
{
    /**
     * Attach an SplObserver
     *
     * @link  http://php.net/manual/en/splsubject.attach.php
     *
     * @param SplObserver $observer <p>
     *                              The <b>SplObserver</b> to attach.
     *                              </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function attach(SplObserver $observer);

    /**
     * Detach an observer
     *
     * @link  http://php.net/manual/en/splsubject.detach.php
     *
     * @param SplObserver $observer <p>
     *                              The <b>SplObserver</b> to detach.
     *                              </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function detach(SplObserver $observer);

    /**
     * Notify an observer
     *
     * @link  http://php.net/manual/en/splsubject.notify.php
     * @return void
     * @since 5.1.0
     */
    public function notify();
}

/**
 * This class allows objects to work as arrays.
 *
 * @link http://php.net/manual/en/class.arrayobject.php
 */
class ArrayObject implements IteratorAggregate, ArrayAccess, Serializable, Countable
{
    /**
     * Entries can be accessed as properties (read and write).
     */
    const ARRAY_AS_PROPS = 2;
    /**
     * Properties of the object have their normal functionality when accessed as list (var_dump, foreach, etc.).
     */
    const STD_PROP_LIST = 1;

    /**
     * Construct a new array object
     *
     * @link  http://php.net/manual/en/arrayobject.construct.php
     *
     * @param array|object $input          The input parameter accepts an array or an Object.
     * @param int          $flags          Flags to control the behaviour of the ArrayObject object.
     * @param string       $iterator_class Specify the class that will be used for iteration of the ArrayObject object.
     *                                     ArrayIterator is the default class used.
     *
     * @since 5.0.0
     *
     */
    public function __construct($input = null, $flags = 0, $iterator_class = 'ArrayIterator') { }

    /**
     * Appends the value
     *
     * @link  http://php.net/manual/en/arrayobject.append.php
     *
     * @param mixed $value <p>
     *                     The value being appended.
     *                     </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function append($value) { }

    /**
     * Sort the entries by value
     *
     * @link  http://php.net/manual/en/arrayobject.asort.php
     * @return void
     * @since 5.2.0
     */
    public function asort() { }

    /**
     * Get the number of public properties in the ArrayObject
     * When the <b>ArrayObject</b> is constructed from an array all properties are public.
     *
     * @link  http://php.net/manual/en/arrayobject.count.php
     * @return int The number of public properties in the ArrayObject.
     * @since 5.0.0
     */
    public function count() { }

    /**
     * Exchange the array for another one.
     *
     * @link  http://php.net/manual/en/arrayobject.exchangearray.php
     *
     * @param mixed $input <p>
     *                     The new array or object to exchange with the current array.
     *                     </p>
     *
     * @return array the old array.
     * @since 5.1.0
     */
    public function exchangeArray($input) { }

    /**
     * Creates a copy of the ArrayObject.
     *
     * @link  http://php.net/manual/en/arrayobject.getarraycopy.php
     * @return array a copy of the array. When the <b>ArrayObject</b> refers to an object
     * an array of the public properties of that object will be returned.
     * @since 5.0.0
     */
    public function getArrayCopy() { }

    /**
     * Gets the behavior flags.
     *
     * @link  http://php.net/manual/en/arrayobject.getflags.php
     * @return int the behavior flags of the ArrayObject.
     * @since 5.1.0
     */
    public function getFlags() { }

    /**
     * Create a new iterator from an ArrayObject instance
     *
     * @link  http://php.net/manual/en/arrayobject.getiterator.php
     * @return ArrayIterator An iterator from an <b>ArrayObject</b>.
     * @since 5.0.0
     */
    public function getIterator() { }

    /**
     * Gets the iterator classname for the ArrayObject.
     *
     * @link  http://php.net/manual/en/arrayobject.getiteratorclass.php
     * @return string the iterator class name that is used to iterate over this object.
     * @since 5.1.0
     */
    public function getIteratorClass() { }

    /**
     * Sort the entries by key
     *
     * @link  http://php.net/manual/en/arrayobject.ksort.php
     * @return void
     * @since 5.2.0
     */
    public function ksort() { }

    /**
     * Sort an array using a case insensitive "natural order" algorithm
     *
     * @link  http://php.net/manual/en/arrayobject.natcasesort.php
     * @return void
     * @since 5.2.0
     */
    public function natcasesort() { }

    /**
     * Sort entries using a "natural order" algorithm
     *
     * @link  http://php.net/manual/en/arrayobject.natsort.php
     * @return void
     * @since 5.2.0
     */
    public function natsort() { }

    /**
     * Returns whether the requested index exists
     *
     * @link  http://php.net/manual/en/arrayobject.offsetexists.php
     *
     * @param mixed $index <p>
     *                     The index being checked.
     *                     </p>
     *
     * @return bool true if the requested index exists, otherwise false
     * @since 5.0.0
     */
    public function offsetExists($index) { }

    /**
     * Returns the value at the specified index
     *
     * @link  http://php.net/manual/en/arrayobject.offsetget.php
     *
     * @param mixed $index <p>
     *                     The index with the value.
     *                     </p>
     *
     * @return mixed The value at the specified index or false.
     * @since 5.0.0
     */
    public function offsetGet($index) { }

    /**
     * Sets the value at the specified index to newval
     *
     * @link  http://php.net/manual/en/arrayobject.offsetset.php
     *
     * @param mixed $index  <p>
     *                      The index being set.
     *                      </p>
     * @param mixed $newval <p>
     *                      The new value for the <i>index</i>.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($index, $newval) { }

    /**
     * Unsets the value at the specified index
     *
     * @link  http://php.net/manual/en/arrayobject.offsetunset.php
     *
     * @param mixed $index <p>
     *                     The index being unset.
     *                     </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($index) { }

    /**
     * Serialize an ArrayObject
     *
     * @link  http://php.net/manual/en/arrayobject.serialize.php
     * @return string The serialized representation of the <b>ArrayObject</b>.
     * @since 5.3.0
     */
    public function serialize() { }

    /**
     * Sets the behavior flags.
     *
     * @link  http://php.net/manual/en/arrayobject.setflags.php
     *
     * @param int $flags <p>
     *                   The new ArrayObject behavior.
     *                   It takes on either a bitmask, or named constants. Using named
     *                   constants is strongly encouraged to ensure compatibility for future
     *                   versions.
     *                   </p>
     *                   <p>
     *                   The available behavior flags are listed below. The actual
     *                   meanings of these flags are described in the
     *                   predefined constants.
     *                   <table>
     *                   ArrayObject behavior flags
     *                   <tr valign="top">
     *                   <td>value</td>
     *                   <td>constant</td>
     *                   </tr>
     *                   <tr valign="top">
     *                   <td>1</td>
     *                   <td>
     *                   ArrayObject::STD_PROP_LIST
     *                   </td>
     *                   </tr>
     *                   <tr valign="top">
     *                   <td>2</td>
     *                   <td>
     *                   ArrayObject::ARRAY_AS_PROPS
     *                   </td>
     *                   </tr>
     *                   </table>
     *                   </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function setFlags($flags) { }

    /**
     * Sets the iterator classname for the ArrayObject.
     *
     * @link  http://php.net/manual/en/arrayobject.setiteratorclass.php
     *
     * @param string $iterator_class <p>
     *                               The classname of the array iterator to use when iterating over this object.
     *                               </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function setIteratorClass($iterator_class) { }

    /**
     * Sort the entries with a user-defined comparison function and maintain key association
     *
     * @link  http://php.net/manual/en/arrayobject.uasort.php
     *
     * @param callback $cmp_function <p>
     *                               Function <i>cmp_function</i> should accept two
     *                               parameters which will be filled by pairs of entries.
     *                               The comparison function must return an integer less than, equal
     *                               to, or greater than zero if the first argument is considered to
     *                               be respectively less than, equal to, or greater than the
     *                               second.
     *                               </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function uasort($cmp_function) { }

    /**
     * Sort the entries by keys using a user-defined comparison function
     *
     * @link  http://php.net/manual/en/arrayobject.uksort.php
     *
     * @param callback $cmp_function <p>
     *                               The callback comparison function.
     *                               </p>
     *                               <p>
     *                               Function <i>cmp_function</i> should accept two
     *                               parameters which will be filled by pairs of entry keys.
     *                               The comparison function must return an integer less than, equal
     *                               to, or greater than zero if the first argument is considered to
     *                               be respectively less than, equal to, or greater than the
     *                               second.
     *                               </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function uksort($cmp_function) { }

    /**
     * Unserialize an ArrayObject
     *
     * @link  http://php.net/manual/en/arrayobject.unserialize.php
     *
     * @param string $serialized <p>
     *                           The serialized <b>ArrayObject</b>.
     *                           </p>
     *
     * @return void The unserialized <b>ArrayObject</b>.
     * @since 5.3.0
     */
    public function unserialize($serialized) { }
}
