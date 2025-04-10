<?php

namespace MongoDB\BSON;

use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Stringable;

/**
 * Represents a BSON timestamp, which is an internal MongoDB type not intended for general date storage.
 * @link https://php.net/manual/en/class.mongodb-bson-timestamp.php
 */
final class Timestamp implements TimestampInterface, JsonSerializable, Type, Stringable
{
    /**
     * Construct a new Timestamp
     * @link https://php.net/manual/en/mongodb-bson-timestamp.construct.php
     */
    final public function __construct(int $increment, int $timestamp) {}

    /**
     * Returns the string representation of this Timestamp
     * @link https://php.net/manual/en/mongodb-bson-timestamp.tostring.php
     */
    final public function __toString(): string {}

    public static function __set_state(array $properties): self {}

    /**
     * Returns the increment component of this TimestampInterface
     * @link https://secure.php.net/manual/en/mongodb-bson-timestampinterface.getincrement.php
     * @since 1.3.0
     */
    final public function getIncrement(): int {}

    /**
     * Returns the timestamp component of this TimestampInterface
     * @link https://secure.php.net/manual/en/mongodb-bson-timestampinterface.gettimestamp.php
     * @since 1.3.0
     */
    final public function getTimestamp(): int {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-timestamp.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize(): mixed {}
}
