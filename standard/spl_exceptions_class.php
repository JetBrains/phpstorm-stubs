<?php
/**
 * PHPStorm stub file for Standard PHP Library(SPL) Exceptions classes.
 *
 * @link http://php.net/manual/en/spl.exceptions.php
 */

/**
 * Exception thrown if a callback refers to an undefined function or if some
 * arguments are missing.
 *
 * @link http://php.net/manual/en/class.badfunctioncallexception.php
 */
class BadFunctionCallException extends LogicException
{
}

/**
 * Exception thrown if a callback refers to an undefined method or if some
 * arguments are missing.
 *
 * @link http://php.net/manual/en/class.badmethodcallexception.php
 */
class BadMethodCallException extends BadFunctionCallException
{
}

/**
 * Exception thrown if a value does not adhere to a defined valid data domain.
 *
 * @link http://php.net/manual/en/class.domainexception.php
 */
class DomainException extends LogicException
{
}

/**
 * Exception thrown if an argument does not match with the expected value.
 *
 * @link http://php.net/manual/en/class.invalidargumentexception.php
 */
class InvalidArgumentException extends LogicException
{
}

/**
 * Exception thrown if a length is invalid.
 *
 * @link http://php.net/manual/en/class.lengthexception.php
 */
class LengthException extends LogicException
{
}

/**
 * Exception that represents error in the program logic. This kind of
 * exceptions should directly lead to a fix in your code.
 *
 * @link http://php.net/manual/en/class.logicexception.php
 */
class LogicException extends Exception
{
}

/**
 * Exception thrown if a value is not a valid key. This represents errors
 * that cannot be detected at compile time.
 *
 * @link http://php.net/manual/en/class.outofboundsexception.php
 */
class OutOfBoundsException extends RuntimeException
{
}

/**
 * Exception thrown when an illegal index was requested. This represents
 * errors that should be detected at compile time.
 *
 * @link http://php.net/manual/en/class.outofrangeexception.php
 */
class OutOfRangeException extends LogicException
{
}

/**
 * Exception thrown when you add an element into a full container.
 *
 * @link http://php.net/manual/en/class.overflowexception.php
 */
class OverflowException extends RuntimeException
{
}

/**
 * Exception thrown to indicate range errors during program execution.
 * Normally this means there was an arithmetic error other than
 * under/overflow. This is the runtime version of
 * <b>DomainException</b>.
 *
 * @link http://php.net/manual/en/class.rangeexception.php
 */
class RangeException extends RuntimeException
{
}

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 *
 * @link http://php.net/manual/en/class.runtimeexception.php
 */
class RuntimeException extends Exception
{
}

/**
 * Exception thrown when you try to remove an element of an empty container.
 *
 * @link http://php.net/manual/en/class.underflowexception.php
 */
class UnderflowException extends RuntimeException
{
}

/**
 * Exception thrown if a value does not match with a set of values. Typically
 * this happens when a function calls another function and expects the return
 * value to be of a certain type or value not including arithmetic or buffer
 * related errors.
 *
 * @link http://php.net/manual/en/class.unexpectedvalueexception.php
 */
class UnexpectedValueException extends RuntimeException
{
}
