<?php

namespace MongoDB\BSON;

use DateTimeInterface;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\UnexpectedValueException;

/**
 * Represents a BSON date.
 * @link https://php.net/manual/en/class.mongodb-bson-utcdatetime.php
 */
final class UTCDateTime implements Type, UTCDateTimeInterface, \Serializable, \JsonSerializable
{
    /**
     * Construct a new UTCDateTime
     * @link https://php.net/manual/en/mongodb-bson-utcdatetime.construct.php
     * @param int|float|string|DateTimeInterface $milliseconds
     */
    final public function __construct($milliseconds = null) {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the DateTime representation of this UTCDateTime
     * @link https://php.net/manual/en/mongodb-bson-utcdatetime.todatetime.php
     * @return \DateTime
     */
    final public function toDateTime() {}

    /**
     * Returns the string representation of this UTCDateTime
     * @link https://php.net/manual/en/mongodb-bson-utcdatetime.tostring.php
     * @return string
     */
    final public function __toString() {}

    /**
     * Serialize a UTCDateTime
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-utcdatetime.serialize.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function serialize() {}

    /**
     * Unserialize a UTCDateTime
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-utcdatetime.unserialize.php
     * @param string $serialized
     * @return void
     * @throws InvalidArgumentException on argument parsing errors or if the properties are invalid
     * @throws UnexpectedValueException if the properties cannot be unserialized (i.e. serialized was malformed)
     */
    final public function unserialize($serialized) {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-utcdatetime.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize() {}
}
