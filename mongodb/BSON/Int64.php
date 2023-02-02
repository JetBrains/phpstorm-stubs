<?php

namespace MongoDB\BSON;

use JetBrains\PhpStorm\Deprecated;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\UnexpectedValueException;

/**
 * BSON type for a 64-bit integer. This class cannot be instantiated and is only created during BSON decoding when a 64-bit
 * integer cannot be represented as a PHP integer on a 32-bit platform. Versions of the driver before 1.5.0 would throw an
 * exception when attempting to decode a 64-bit integer on a 32-bit platform.
 * During BSON encoding, objects of this class will convert back to a 64-bit integer type. This allows 64-bit integers to be
 * roundtripped through a 32-bit PHP environment without any loss of precision. The __toString() method allows the 64-bit integer
 * value to be accessed as a string.
 *
 * @since 1.5.0
 * @link https://secure.php.net/manual/en/class.mongodb-bson-int64.php
 */
#[Deprecated]
final class Int64 implements Type, \Serializable, \JsonSerializable
{
    final private function __construct() {}

    /**
     * Serialize an Int64
     * @link https://www.php.net/manual/en/mongodb-bson-int64.serialize.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function serialize() {}

    /**
     * Unserialize an Int64
     * @link https://www.php.net/manual/en/mongodb-bson-int64.unserialize.php
     * @param string $serialized
     * @return void
     * @throws InvalidArgumentException on argument parsing errors or if the properties are invalid
     * @throws UnexpectedValueException if the properties cannot be unserialized (i.e. serialized was malformed)
     */
    final public function unserialize($serialized) {}

    /**
     * Returns a representation that can be converted to JSON
     * @link https://www.php.net/manual/en/mongodb-bson-int64.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize() {}

    /**
     * Returns the Symbol as a string
     * @return string Returns the string representation of this Symbol.
     */
    final public function __toString() {}
}
