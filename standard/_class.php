<?php
/**
 * PHPStorm stub file for PHP pre-defined classes.
 */

/**
 * Interface to provide accessing objects as arrays.
 *
 * @link http://php.net/manual/en/class.arrayaccess.php
 */
interface ArrayAccess
{
    /**
     * Whether a offset exists
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset);

    /**
     * Offset to retrieve
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset);

    /**
     * Offset to set
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value);

    /**
     * Offset to unset
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset);
}

/**
 * Interface for external iterators or objects that can be iterated
 * themselves internally.
 *
 * @link http://php.net/manual/en/class.iterator.php
 */
interface Iterator extends Traversable
{
    /**
     * Return the current element
     *
     * @link  http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current();

    /**
     * Return the key of the current element
     *
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key();

    /**
     * Move forward to next element
     *
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next();

    /**
     * Rewind the Iterator to the first element
     *
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind();

    /**
     * Checks if current position is valid
     *
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid();
}

/**
 * Interface to create an external Iterator.
 *
 * @link http://php.net/manual/en/class.iteratoraggregate.php
 */
interface IteratorAggregate extends Traversable
{
    /**
     * Retrieve an external iterator
     *
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator();
}

/**
 * Interface for customized serializing.
 *
 * @link http://php.net/manual/en/class.serializable.php
 */
interface Serializable
{
    /**
     * String representation of object
     *
     * @link  http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize();

    /**
     * Constructs the object
     *
     * @link  http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized <p>
     *                           The string representation of the object.
     *                           </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized);
}

/**
 * Throwable is the base interface for any object that can be thrown via a throw statement in PHP 7,
 * including Error and Exception.
 *
 * @link  http://php.net/manual/en/class.throwable.php
 * @since 7.0
 */
interface Throwable
{
    /**
     * Gets a string representation of the thrown object
     *
     * @link  http://php.net/manual/en/throwable.tostring.php
     * @return string <p>Returns the string representation of the thrown object.</p>
     * @since 7.0
     */
    public function __toString();

    /**
     * Gets the exception code
     *
     * @link  http://php.net/manual/en/throwable.getcode.php
     * @return int <p>
     * Returns the exception code as integer in
     * {@see Exception} but possibly as other type in
     * {@see Exception} descendants (for example as
     * string in {@see PDOException}).
     * </p>
     * @since 7.0
     */
    public function getCode();

    /**
     * Gets the file in which the exception occurred
     *
     * @link  http://php.net/manual/en/throwable.getfile.php
     * @return string Returns the name of the file from which the object was thrown.
     * @since 7.0
     */
    public function getFile();

    /**
     * Gets the line on which the object was instantiated
     *
     * @link  http://php.net/manual/en/throwable.getline.php
     * @return int Returns the line number where the thrown object was instantiated.
     * @since 7.0
     */
    public function getLine();

    /**
     * Gets the message
     *
     * @link  http://php.net/manual/en/throwable.getmessage.php
     * @return string
     * @since 7.0
     */
    public function getMessage();

    /**
     * Returns the previous Throwable
     *
     * @link  http://php.net/manual/en/throwable.getprevious.php
     * @return Throwable Returns the previous {@see Throwable} if available, or <b>NULL</b> otherwise.
     * @since 7.0
     */
    public function getPrevious();

    /**
     * Gets the stack trace
     *
     * @link  http://php.net/manual/en/throwable.gettrace.php
     * @return array <p>
     * Returns the stack trace as an array in the same format as
     * {@see debug_backtrace()}.
     * </p>
     * @since 7.0
     */
    public function getTrace();

    /**
     * Gets the stack trace as a string
     *
     * @link  http://php.net/manual/en/throwable.gettraceasstring.php
     * @return string Returns the stack trace as a string.
     * @since 7.0
     */
    public function getTraceAsString();
}

/**
 * Interface to detect if a class is traversable using &foreach;.
 *
 * @link http://php.net/manual/en/class.traversable.php
 */
interface Traversable
{
}

/**
 * ArithmeticError is thrown when an error occurs while performing mathematical operations.
 * In PHP 7.0, these errors include attempting to perform a bitshift by a negative amount,
 * and any call to {@see intdiv()} that would result in a value outside the possible bounds of an integer.
 *
 * @link  http://php.net/manual/en/class.arithmeticerror.php
 * @since 7.0
 */
class ArithmeticError extends Error
{
}

/**
 * AssertionError is thrown when an assertion made via {@see assert()} fails.
 *
 * @link  http://php.net/manual/en/class.assertionerror.php
 * @since 7.0
 */
class AssertionError extends Error
{
}

/**
 * Class used to represent anonymous functions.
 * <p>Anonymous functions, implemented in PHP 5.3, yield objects of this type.
 * This fact used to be considered an implementation detail, but it can now be relied upon.
 * Starting with PHP 5.4, this class has methods that allow further control of the anonymous function after it has been
 * created.
 * <p>Besides the methods listed here, this class also has an __invoke method.
 * This is for consistency with other classes that implement calling magic, as this method is not used for calling the
 * function.
 *
 * @link http://www.php.net/manual/en/class.closure.php
 */
final class Closure
{
    /**
     * This method exists only to disallow instantiation of the Closure class.
     * Objects of this class are created in the fashion described on the anonymous functions page.
     *
     * @link http://www.php.net/manual/en/closure.construct.php
     */
    private function __construct() { }

    /**
     * This method is a static version of Closure::bindTo().
     *
     * See the documentation of that method for more information.
     *
     * @static
     * @link http://www.php.net/manual/en/closure.bind.php
     *
     * @param Closure $closure  The anonymous functions to bind.
     * @param object  $newthis  The object to which the given anonymous function should be bound, or NULL for the
     *                          closure to be unbound.
     * @param mixed   $newscope The class scope to which associate the closure is to be associated, or 'static' to keep
     *                          the current one. If an object is given, the type of the object will be used instead.
     *                          This determines the visibility of protected and private methods of the bound object.
     *
     * @return Closure Returns the newly created Closure object or FALSE on failure
     */
    public static function bind(Closure $closure, $newthis, $newscope = 'static') { }

    /**
     * @param callable $callable
     *
     * @return Closure
     * @since 7.1
     */
    public static function fromCallable(callable $callable) { }

    /**
     * This is for consistency with other classes that implement calling magic,
     * as this method is not used for calling the function.
     *
     * @param mixed $_ [optional]
     *
     * @return mixed
     * @link http://www.php.net/manual/en/class.closure.php
     */
    public function __invoke(...$_) { }

    /**
     * Duplicates the closure with a new bound object and class scope
     *
     * @link http://www.php.net/manual/en/closure.bindto.php
     *
     * @param object $newthis  The object to which the given anonymous function should be bound, or NULL for the
     *                         closure to be unbound.
     * @param mixed  $newscope The class scope to which associate the closure is to be associated, or 'static' to keep
     *                         the current one. If an object is given, the type of the object will be used instead.
     *                         This determines the visibility of protected and private methods of the bound object.
     *
     * @return Closure Returns the newly created Closure object or FALSE on failure
     */
    public function bindTo($newthis, $newscope = 'static') { }

    /**
     * Temporarily binds the closure to $newthis, and calls it with any given parameters.
     *
     * @link  http://php.net/manual/en/closure.call.php
     *
     * @param object $newthis    The object to bind the closure to for the duration of the call.
     * @param mixed  $parameters [optional] Zero or more parameters, which will be given as parameters to the closure.
     *
     * @return mixed
     * @since 7.0
     */
    public function call($newthis, ...$parameters) { }
}

/**
 * DivisionByZeroError is thrown when an attempt is made to divide a number by zero.
 *
 * @link  http://php.net/manual/en/class.divisionbyzeroerror.php
 * @since 7.0
 */
class DivisionByZeroError extends Error
{
}

/**
 * Error is the base class for all internal PHP error exceptions.
 *
 * @link  http://php.net/manual/en/class.error.php
 * @since 7.0
 */
class Error implements Throwable
{
    /**
     * Construct the error object.
     *
     * @link http://php.net/manual/en/error.construct.php
     *
     * @param string    $message  [optional] The Error message to throw.
     * @param int       $code     [optional] The Error code.
     * @param Throwable $previous [optional] The previous Throwable used for the exception chaining.
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null) { }

    /**
     * Gets a string representation of the thrown object
     *
     * @link  http://php.net/manual/en/throwable.tostring.php
     * @return string <p>Returns the string representation of the thrown object.</p>
     * @since 7.0
     */
    public function __toString() { }

    /**
     * Gets the exception code
     *
     * @link  http://php.net/manual/en/throwable.getcode.php
     * @return int <p>
     * Returns the exception code as integer in
     * {@see Exception} but possibly as other type in
     * {@see Exception} descendants (for example as
     * string in {@see PDOException}).
     * </p>
     * @since 7.0
     */
    public function getCode() { }

    /**
     * Gets the file in which the exception occurred
     *
     * @link  http://php.net/manual/en/throwable.getfile.php
     * @return string Returns the name of the file from which the object was thrown.
     * @since 7.0
     */
    public function getFile() { }

    /**
     * Gets the line on which the object was instantiated
     *
     * @link  http://php.net/manual/en/throwable.getline.php
     * @return int Returns the line number where the thrown object was instantiated.
     * @since 7.0
     */
    public function getLine() { }

    /***
     * Gets the message
     *
     * @link  http://php.net/manual/en/throwable.getmessage.php
     * @return string
     * @since 7.0
     */
    public function getMessage() { }

    /**
     * Returns the previous Throwable
     *
     * @link  http://php.net/manual/en/throwable.getprevious.php
     * @return Throwable Returns the previous {@see Throwable} if available, or <b>NULL</b> otherwise.
     * @since 7.0
     */
    public function getPrevious() { }

    /**
     * Gets the stack trace
     *
     * @link  http://php.net/manual/en/throwable.gettrace.php
     * @return array <p>
     * Returns the stack trace as an array in the same format as
     * {@see debug_backtrace()}.
     * </p>
     * @since 7.0
     */
    public function getTrace() { }

    /**
     * Gets the stack trace as a string
     *
     * @link  http://php.net/manual/en/throwable.gettraceasstring.php
     * @return string Returns the stack trace as a string.
     * @since 7.0
     */
    public function getTraceAsString() { }
}

/**
 * An Error Exception.
 *
 * @link http://php.net/manual/en/class.errorexception.php
 */
class ErrorException extends Exception
{
    protected $severity;

    /**
     * ErrorException constructor.
     *
     * Starting with PHP 7.0 $previous accepts a Throwable and not just an Exception.
     *
     * @link  http://php.net/manual/en/errorexception.construct.php
     *
     * @param string    $message  [optional] The Exception message to throw.
     * @param int       $code     [optional] The Exception code.
     * @param int       $severity [optional] The severity level of the exception.
     * @param string    $filename [optional] The filename where the exception is thrown.
     * @param int       $lineno   [optional] The line number where the exception is thrown.
     * @param Throwable $previous [optional] The previous Throwable used for the exception chaining.
     *
     * @since 5.1.0
     * @since 7.0.0
     */
    public function __construct(
        $message = '',
        $code = 0,
        $severity = 1,
        $filename = __FILE__,
        $lineno = __LINE__,
        Throwable $previous = null
    )
    {
    }

    /**
     * Gets the exception severity
     *
     * @link  http://php.net/manual/en/errorexception.getseverity.php
     * @return int the severity level of the exception.
     * @since 5.1.0
     */
    final public function getSeverity() { }
}

/**
 * Exception is the base class for
 * all Exceptions.
 *
 * @link http://php.net/manual/en/class.exception.php
 */
class Exception implements Throwable
{
    protected $code;
    protected $file;
    protected $line;
    protected $message;

    /**
     * Construct the exception. Note: The message is NOT binary safe.
     *
     * @link  http://php.net/manual/en/exception.construct.php
     *
     * @param string    $message  [optional] The Exception message to throw.
     * @param int       $code     [optional] The Exception code.
     * @param Throwable $previous [optional] The previous Throwable used for the exception chaining.
     *
     * @since 5.1.0
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null) { }

    /**
     * String representation of the exception
     *
     * @link  http://php.net/manual/en/exception.tostring.php
     * @return string the string representation of the exception.
     * @since 5.1.0
     */
    public function __toString() { }

    /**
     * Gets the Exception code
     *
     * @link  http://php.net/manual/en/exception.getcode.php
     * @return mixed|int the exception code as integer in
     * <b>Exception</b> but possibly as other type in
     * <b>Exception</b> descendants (for example as
     * string in <b>PDOException</b>).
     * @since 5.1.0
     */
    final public function getCode() { }

    /**
     * Gets the file in which the exception occurred
     *
     * @link  http://php.net/manual/en/exception.getfile.php
     * @return string the filename in which the exception was created.
     * @since 5.1.0
     */
    final public function getFile() { }

    /**
     * Gets the line in which the exception occurred
     *
     * @link  http://php.net/manual/en/exception.getline.php
     * @return int the line number where the exception was created.
     * @since 5.1.0
     */
    final public function getLine() { }

    /**
     * Gets the Exception message
     *
     * @link  http://php.net/manual/en/exception.getmessage.php
     * @return string the Exception message as a string.
     * @since 5.1.0
     */
    final public function getMessage() { }

    /**
     * Returns previous Exception
     *
     * @link  http://php.net/manual/en/exception.getprevious.php
     * @return Exception the previous <b>Exception</b> if available
     * or null otherwise.
     * @since 5.3.0
     */
    final public function getPrevious() { }

    /**
     * Gets the stack trace
     *
     * @link  http://php.net/manual/en/exception.gettrace.php
     * @return array the Exception stack trace as an array.
     * @since 5.1.0
     */
    final public function getTrace() { }

    /**
     * Gets the stack trace as a string
     *
     * @link  http://php.net/manual/en/exception.gettraceasstring.php
     * @return string the Exception stack trace as a string.
     * @since 5.1.0
     */
    final public function getTraceAsString() { }

    /**
     * Clone the exception
     *
     * @link  http://php.net/manual/en/exception.clone.php
     * @return void
     * @since 5.1.0
     */
    final private function __clone() { }
}

/**
 * Generator objects are returned from generators, cannot be instantiated via new.
 *
 * @link http://www.php.net/manual/en/class.generator.php
 * @link https://wiki.php.net/rfc/generators
 */
final class Generator implements Iterator
{
    /**
     * Cannot be instantiated via new.
     */
    private function __construct() { }

    /**
     * Returns whatever was passed to yield or null if nothing was passed or the generator is already closed.
     *
     * @return mixed
     */
    public function current() { }

    /**
     * Returns whatever was passed to return or null if nothing.
     * Throws an exception if the generator is still valid.
     *
     * @link https://wiki.php.net/rfc/generator-return-expressions
     * @return mixed|null
     */
    public function getReturn() { }

    /**
     * Returns the yielded key or, if none was specified, an auto-incrementing key or null if the generator is
     * already closed.
     *
     * @return mixed
     */
    public function key() { }

    /**
     * Resumes the generator (unless the generator is already closed).
     *
     * @return void
     */
    public function next() { }

    /**
     * Throws an exception if the generator is currently after the first yield.
     *
     * @return void
     */
    public function rewind() { }

    /**
     * Sets the return value of the yield expression and resumes the generator (unless the generator is already
     * closed).
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function send($value) { }

    /**
     * Throws an exception at the current suspension point in the generator.
     *
     * @param Exception $exception
     *
     * @return mixed
     */
    public function PS_UNRESERVE_PREFIX_throw(Exception $exception) { }

    /**
     * Returns false if the generator has been closed, true otherwise.
     *
     * @return bool
     */
    public function valid() { }
}

/**
 * ParseError is thrown when an error occurs while parsing PHP code, such as when {@see eval()} is called.
 *
 * @link  http://php.net/manual/en/class.parseerror.php
 * @since 7.0
 */
class ParseError extends Error
{
}

/**
 * There are three scenarios where a TypeError may be thrown.
 * The first is where the argument type being passed to a function does not match its corresponding declared
 * parameter type. The second is where a value being returned from a function does not match the declared function
 * return type. The third is where an invalid number of arguments are passed to a built-in PHP function (strict mode
 * only).
 *
 * @link  http://php.net/manual/en/class.typeerror.php
 * @since 7.0
 */
class TypeError extends Error
{
}

/**
 * Created when trying to unserialize without a class definition available.
 *
 * Cannot be instantiated by new.
 *
 * @link http://php.net/manual/en/language.oop5.serialization.php
 */
final class __PHP_Incomplete_Class
{
    public $__PHP_Incomplete_Class_Name = '';

    /**
     * Cannot be instantiated via new.
     */
    private function __construct() { }
}

/**
 * Created by typecasting to object.
 *
 * @link  http://php.net/manual/en/reserved.classes.php
 * @since 4.0.0
 * @since 5.0.0
 * @since 7.0.0
 */
class stdClass
{
}
