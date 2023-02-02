<?php

namespace MongoDB\BSON;

use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\UnexpectedValueException;

/**
 * Represents a BSON timestamp, which is an internal MongoDB type not intended for general date storage.
 * @link https://php.net/manual/en/class.mongodb-bson-timestamp.php
 */
final class Timestamp implements TimestampInterface, Type, \Serializable, JsonSerializable
{
    /**
     * Construct a new Timestamp
     * @link https://php.net/manual/en/mongodb-bson-timestamp.construct.php
     * @param int $increment
     * @param int $timestamp
     */
    final public function __construct($increment, $timestamp) {}

    /**
     * Returns the string representation of this Timestamp
     * @link https://php.net/manual/en/mongodb-bson-timestamp.tostring.php
     * @return string
     */
    final public function __toString() {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the increment component of this TimestampInterface
     * @link https://secure.php.net/manual/en/mongodb-bson-timestampinterface.getincrement.php
     * @return int
     * @since 1.3.0
     */
    final public function getIncrement() {}

    /**
     * Returns the timestamp component of this TimestampInterface
     * @link https://secure.php.net/manual/en/mongodb-bson-timestampinterface.gettimestamp.php
     * @return int
     * @since 1.3.0
     */
    final public function getTimestamp() {}

    /**
     * Serialize a Timestamp
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-timestamp.serialize.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function serialize() {}

    /**
     * Unserialize a Timestamp
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-timestamp.unserialize.php
     * @param string $serialized
     * @return void
     * @throws InvalidArgumentException on argument parsing errors or if the properties are invalid
     * @throws UnexpectedValueException if the properties cannot be unserialized (i.e. serialized was malformed)
     */
    final public function unserialize($serialized) {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-timestamp.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize() {}
}
