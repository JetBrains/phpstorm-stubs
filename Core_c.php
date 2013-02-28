<?php

// Start of Core v.5.3.6-13ubuntu3.2

/**
 * Created by typecasting to object.
 * @link http://php.net/manual/en/reserved.classes.php
 */
class stdClass {
}

/**
 * Interface to detect if a class is traversable using &foreach;.
 * @link http://php.net/manual/en/class.traversable.php
 */
interface Traversable {
}

/**
 * Interface to create an external Iterator.
 * @link http://php.net/manual/en/class.iteratoraggregate.php
 */
interface IteratorAggregate extends Traversable {

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator();
}

/**
 * Interface for external iterators or objects that can be iterated
 * themselves internally.
 * @link http://php.net/manual/en/class.iterator.php
 */
interface Iterator extends Traversable {

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current();

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next();

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key();

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid();

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind();
}

/**
 * Interface to provide accessing objects as arrays.
 * @link http://php.net/manual/en/class.arrayaccess.php
 */
interface ArrayAccess {

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset);

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset);

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value);

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset);
}

/**
 * Interface for customized serializing.
 * @link http://php.net/manual/en/class.serializable.php
 */
interface Serializable {

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize();

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized);
}

/**
 * Exception is the base class for
 * all Exceptions.
 * @link http://php.net/manual/en/class.exception.php
 */
class Exception {
    protected $message;
    protected $code;
    protected $file;
    protected $line;


    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Clone the exception
     * @link http://php.net/manual/en/exception.clone.php
     * @return void
     */
    final private function __clone() { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Construct the exception. Note: The message is NOT binary safe.
     * @link http://php.net/manual/en/exception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param Exception $previous [optional] The previous exception used for the exception chaining. Since 5.3.0
     */
    public function __construct($message = "", $code = 0, Exception $previous = null) { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Gets the Exception message
     * @link http://php.net/manual/en/exception.getmessage.php
     * @return string the Exception message as a string.
     */
    final public function getMessage() { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Gets the Exception code
     * @link http://php.net/manual/en/exception.getcode.php
     * @return mixed|int the exception code as integer in
     * <b>Exception</b> but possibly as other type in
     * <b>Exception</b> descendants (for example as
     * string in <b>PDOException</b>).
     */
    final public function getCode() { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Gets the file in which the exception occurred
     * @link http://php.net/manual/en/exception.getfile.php
     * @return string the filename in which the exception was created.
     */
    final public function getFile() { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Gets the line in which the exception occurred
     * @link http://php.net/manual/en/exception.getline.php
     * @return int the line number where the exception was created.
     */
    final public function getLine() { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Gets the stack trace
     * @link http://php.net/manual/en/exception.gettrace.php
     * @return array the Exception stack trace as an array.
     */
    final public function getTrace() { }

    /**
     * (PHP 5 &gt;= 5.3.0)<br/>
     * Returns previous Exception
     * @link http://php.net/manual/en/exception.getprevious.php
     * @return Exception the previous <b>Exception</b> if available
     * or null otherwise.
     */
    final public function getPrevious() { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Gets the stack trace as a string
     * @link http://php.net/manual/en/exception.gettraceasstring.php
     * @return string the Exception stack trace as a string.
     */
    final public function getTraceAsString() { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of the exception
     * @link http://php.net/manual/en/exception.tostring.php
     * @return string the string representation of the exception.
     */
    public function __toString() { }
}

/**
 * An Error Exception.
 * @link http://php.net/manual/en/class.errorexception.php
 */
class ErrorException extends Exception {

    protected $severity;


    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the exception
     * @link http://php.net/manual/en/errorexception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param int $severity [optional] The severity level of the exception.
     * @param string $filename [optional] The filename where the exception is thrown.
     * @param int $lineno [optional] The line number where the exception is thrown.
     * @param Exception $previous [optional] The previous exception used for the exception chaining.
     */
    public function __construct($message = "", $code = 0, $severity = 1, $filename = __FILE__, $lineno = __LINE__, $previous) { }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Gets the exception severity
     * @link http://php.net/manual/en/errorexception.getseverity.php
     * @return int the severity level of the exception.
     */
    final public function getSeverity() { }
}

/**
 * Class used to represent anonymous functions.
 * <p>Anonymous functions, implemented in PHP 5.3, yield objects of this type.
 * This fact used to be considered an implementation detail, but it can now be relied upon.
 * Starting with PHP 5.4, this class has methods that allow further control of the anonymous function after it has been created.
 * <p>Besides the methods listed here, this class also has an __invoke method.
 * This is for consistency with other classes that implement calling magic, as this method is not used for calling the function.
 */
final class Closure {

    /**
     * This method exists only to disallow instantiation of the Closure class.
     * Objects of this class are created in the fashion described on the anonymous functions page.
     * @link http://www.php.net/manual/en/closure.construct.php
     */
    private function __construct() { }

    public function __invoke() { }

    /**
     * Closure::bindTo � Duplicates the closure with a new bound object and class scope
     * @link http://www.php.net/manual/en/closure.bindto.php
     * @param object $newthis The object to which the given anonymous function should be bound, or NULL for the closure to be unbound.
     * @param mixed $newscope The class scope to which associate the closure is to be associated, or 'static' to keep the current one.
     * If an object is given, the type of the object will be used instead.
     * This determines the visibility of protected and private methods of the bound object.
     * @return Closure Returns the newly created Closure object or FALSE on failure
     */
    function bindTo($newthis, $newscope = 'static') { }

    /**
     * This method is a static version of Closure::bindTo().
     * See the documentation of that method for more information.
     * @static
     * @link http://www.php.net/manual/en/closure.bind.php
     * @param Closure $closure The anonymous functions to bind.
     * @param object $newthis The object to which the given anonymous function should be bound, or NULL for the closure to be unbound.
     * @param mixed $newscope The class scope to which associate the closure is to be associated, or 'static' to keep the current one.
     * If an object is given, the type of the object will be used instead.
     * This determines the visibility of protected and private methods of the bound object.
     * @return Closure Returns the newly created Closure object or FALSE on failure
     */
    static function bind(Closure $closure, $newthis, $newscope = 'static') { }
}

?>
