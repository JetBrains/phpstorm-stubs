<?php
/**
 * PHPStorm stub file for GNU Multiple Precision(GMP) classes.
 *
 * @link http://php.net/manual/en/book.gmp.php
 */

/**
 * A GMP number. These objects support overloaded arithmetic, bitwise and comparison operators.
 *
 * __Note:__
 * No object oriented interface is provided to manipulate GMP objects. Please use the procedural GMP API.
 *
 * @link http://php.net/manual/en/class.gmp.php
 */
class GMP implements Serializable
{
    /**
     * String representation of object
     *
     * @link  http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize() { }

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
    public function unserialize($serialized) { }
}
