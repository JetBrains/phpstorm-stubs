<?php

use JetBrains\PhpStorm\Internal\TentativeType;
use JetBrains\PhpStorm\Pure;

/**
 * @link https://wiki.php.net/rfc/iterable
 */
interface iterable {}

/**
 * Interface to detect if a class is traversable using foreach.
 * Abstract base interface that cannot be implemented alone.
 * Instead it must be implemented by either {@see IteratorAggregate} or {@see Iterator}.
 *
 * @link https://php.net/manual/en/class.traversable.php
 * @template TKey
 * @template-covariant TValue
 *
 * @template-implements iterable<TKey, TValue>
 */
interface Traversable extends iterable {}

/**
 * Interface to create an external Iterator.
 * @link https://php.net/manual/en/class.iteratoraggregate.php
 * @template TKey
 * @template-covariant TValue
 * @template-implements Traversable<TKey, TValue>
 */
interface IteratorAggregate extends Traversable
{
    /**
     * Retrieve an external iterator
     * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable<TKey, TValue>|TValue[] An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @throws Exception on failure.
     */
    #[TentativeType]
    public function getIterator(): Traversable;
}

/**
 * Interface for external iterators or objects that can be iterated
 * themselves internally.
 * @link https://php.net/manual/en/class.iterator.php
 * @template TKey
 * @template-covariant TValue
 * @template-implements Traversable<TKey, TValue>
 */
interface Iterator extends Traversable
{
    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return TValue Can return any type.
     */
    #[TentativeType]
    public function current(): mixed;

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    #[TentativeType]
    public function next(): void;

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return TKey|null TKey on success, or null on failure.
     */
    #[TentativeType]
    public function key(): mixed;

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    #[TentativeType]
    public function valid(): bool;

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    #[TentativeType]
    public function rewind(): void;
}

/**
 * Interface to provide accessing objects as arrays.
 * @link https://php.net/manual/en/class.arrayaccess.php
 * @template TKey
 * @template TValue
 */
interface ArrayAccess
{
    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return bool true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    #[TentativeType]
    public function offsetExists($offset): bool;

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return TValue Can return all value types.
     */
    #[TentativeType]
    public function offsetGet($offset): mixed;

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param TKey $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param TValue $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    #[TentativeType]
    public function offsetSet($offset, $value): void;

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param TKey $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    #[TentativeType]
    public function offsetUnset($offset): void;
}

/**
 * Interface for customized serializing.<br>
 * As of PHP 8.1.0, a class which implements Serializable without also implementing `__serialize()` and `__unserialize()`
 * will generate a deprecation warning.
 * @link https://php.net/manual/en/class.serializable.php
 */
interface Serializable
{
    /**
     * String representation of object.
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string|null The string representation of the object or null
     * @throws Exception Returning other type than string or null
     */
    public function serialize();

    /**
     * Constructs the object.
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $data The string representation of the object.
     * @return void
     */
    public function unserialize($data);
}

/**
 * Classes implementing <b>Countable</b> can be used with the
 * <b>count</b> function.
 * @link https://php.net/manual/en/class.countable.php
 */
interface Countable
{
    /**
     * Count elements of an object
     * @link https://php.net/manual/en/countable.count.php
     * @return int<0,max> The custom count as an integer.
     * <p>
     * The return value is cast to an integer.
     * </p>
     */
    #[TentativeType]
    public function count(): int;
}

/**
 * Created by typecasting to object.
 * @link https://php.net/manual/en/reserved.classes.php
 */
class stdClass {}

/**
 * Exception is the base class for
 * all Exceptions.
 * @link https://php.net/manual/en/class.exception.php
 */
class Exception
{
    /** The error message */
    protected $message;

    /** The error code */
    protected $code;

    /** The filename where the error happened  */
    protected $file;

    /** The line where the error happened */
    protected $line;

    /**
     * Construct the exception. Note: The message is NOT binary safe.
     * @link https://php.net/manual/en/exception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param null|Exception $previous [optional] The previous throwable used for the exception chaining.
     */
    #[Pure]
    public function __construct($message = '', $code = 0, Exception $previous = null) {}

    /**
     * Gets the Exception message
     * @link https://php.net/manual/en/exception.getmessage.php
     * @return string the Exception message as a string.
     */
    #[Pure]
    final public function getMessage(): string {}

    /**
     * Gets the Exception code
     * @link https://php.net/manual/en/exception.getcode.php
     * @return mixed|int the exception code as integer in
     * <b>Exception</b> but possibly as other type in
     * <b>Exception</b> descendants (for example as
     * string in <b>PDOException</b>).
     */
    #[Pure]
    final public function getCode() {}

    /**
     * Gets the file in which the exception occurred
     * @link https://php.net/manual/en/exception.getfile.php
     * @return string the filename in which the exception was created.
     */
    #[Pure]
    final public function getFile(): string {}

    /**
     * Gets the line in which the exception occurred
     * @link https://php.net/manual/en/exception.getline.php
     * @return int the line number where the exception was created.
     */
    #[Pure]
    final public function getLine(): int {}

    /**
     * Gets the stack trace
     * @link https://php.net/manual/en/exception.gettrace.php
     * @return array the Exception stack trace as an array.
     */
    #[Pure]
    final public function getTrace(): array {}

    /**
     * Returns previous Exception
     * @link https://php.net/manual/en/exception.getprevious.php
     * @return null|Throwable Returns the previous {@see Throwable} if available, or <b>NULL</b> otherwise.
     * or null otherwise.
     */
    #[Pure]
    final public function getPrevious(): ?Throwable {}

    /**
     * Gets the stack trace as a string
     * @link https://php.net/manual/en/exception.gettraceasstring.php
     * @return string the Exception stack trace as a string.
     */
    #[Pure]
    final public function getTraceAsString(): string {}

    /**
     * String representation of the exception
     * @link https://php.net/manual/en/exception.tostring.php
     * @return string the string representation of the exception.
     */
    #[TentativeType]
    public function __toString(): string {}

    #[TentativeType]
    public function __wakeup(): void {}

    /**
     * Clone the exception
     * Tries to clone the Exception, which results in Fatal error.
     * @link https://php.net/manual/en/exception.clone.php
     * @return void
     * @since 5.4
     */
    final private function __clone(): void {}
}

class ValueError {}

/**
 * An Error Exception.
 * @link https://php.net/manual/en/class.errorexception.php
 */
class ErrorException extends Exception
{
    protected $severity;

    /**
     * Constructs the exception
     * @link https://php.net/manual/en/errorexception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param int $severity [optional] The severity level of the exception.
     * @param string $filename [optional] The filename where the exception is thrown.
     * @param int $line [optional] The line number where the exception is thrown.
     * @param Exception $previous [optional] The previous exception used for the exception chaining.
     */
    #[Pure]
    public function __construct($message = '', $code = 0, $severity = 1, $filename = __FILE__, $line = __LINE__, Exception $previous = null) {}

    /**
     * Gets the exception severity
     * @link https://php.net/manual/en/errorexception.getseverity.php
     * @return int the severity level of the exception.
     */
    final public function getSeverity(): int {}
}

/**
 * Class used to represent anonymous functions.
 * <p>Anonymous functions, implemented in PHP 5.3, yield objects of this type.
 * This fact used to be considered an implementation detail, but it can now be relied upon.
 * Starting with PHP 5.4, this class has methods that allow further control of the anonymous function after it has been created.
 * <p>Besides the methods listed here, this class also has an __invoke method.
 * This is for consistency with other classes that implement calling magic, as this method is not used for calling the function.
 * @link https://secure.php.net/manual/en/class.closure.php
 */
final class Closure
{
    /**
     * This method exists only to disallow instantiation of the Closure class.
     * Objects of this class are created in the fashion described on the anonymous functions page.
     * @link https://secure.php.net/manual/en/closure.construct.php
     */
    private function __construct() {}

    /**
     * This method is a static version of Closure::bindTo().
     * See the documentation of that method for more information.
     * @link https://secure.php.net/manual/en/closure.bind.php
     * @param Closure $closure The anonymous functions to bind.
     * @param object|null $newThis The object to which the given anonymous function should be bound, or NULL for the closure to be unbound.
     * @param mixed $newScope The class scope to which associate the closure is to be associated, or 'static' to keep the current one.
     * If an object is given, the type of the object will be used instead.
     * This determines the visibility of protected and private methods of the bound object.
     * @return Closure|false Returns the newly created Closure object or FALSE on failure
     */
    public static function bind(Closure $closure, ?object $newThis, object|string|null $newScope = 'static'): ?Closure {}

    /**
     * This is for consistency with other classes that implement calling magic,
     * as this method is not used for calling the function.
     * @param mixed ...$_ [optional]
     * @return mixed
     * @link https://secure.php.net/manual/en/class.closure.php
     */
    public function __invoke(...$_) {}

    /**
     * Duplicates the closure with a new bound object and class scope
     * @link https://secure.php.net/manual/en/closure.bindto.php
     * @param object|null $newThis The object to which the given anonymous function should be bound, or NULL for the closure to be unbound.
     * @param mixed $newScope The class scope to which associate the closure is to be associated, or 'static' to keep the current one.
     * If an object is given, the type of the object will be used instead.
     * This determines the visibility of protected and private methods of the bound object.
     * @return Closure|false Returns the newly created Closure object or FALSE on failure
     */
    public function bindTo(?object $newThis, object|string|null $newScope = 'static'): ?Closure {}
}
